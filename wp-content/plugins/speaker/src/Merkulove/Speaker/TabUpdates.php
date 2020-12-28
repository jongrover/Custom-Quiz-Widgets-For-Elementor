<?php
/**
 * Create an audio version of your posts, with a selection of more than 235+ voices across more than 40 languages and variants.
 * Exclusively on Envato Market: https://1.envato.market/speaker
 *
 * @encoding        UTF-8
 * @version         3.1.0
 * @copyright       Copyright (C) 2018 - 2020 Merkulove ( https://merkulov.design/ ). All rights reserved.
 * @license         Envato License https://1.envato.market/KYbje
 * @contributors    Alexander Khmelnitskiy (info@alexander.khmelnitskiy.ua), Dmitry Merkulov (dmitry@merkulov.design)
 * @support         help@merkulov.design
 **/

namespace Merkulove\Speaker;

use Merkulove\Speaker;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * SINGLETON: Class used to implement Updates tab on plugin settings page.
 *
 * @since 3.0.5
 * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 **/
final class TabUpdates {

    /**
     * Settings group name.
     *
     * @string version
     * @since 3.0.5
     **/
    public static $group;

    /**
     * Settings section name.
     *
     * @string version
     * @since 3.0.5
     **/
    public static $section;

    /**
     * Settings option name.
     *
     * @string version
     * @since 3.0.5
     **/
    public static $option_name;

    /**
     * Plugins slug.
     *
     * @var string
     * @since 3.0.5
     **/
    private static $slug;

	/**
	 * The one true TabUpdates.
	 *
	 * @var TabUpdates
	 * @since 3.0.5
	 **/
	private static $instance;

    /**
     * Sets up a new TabUpdates instance.
     *
     * @since 3.0.5
     * @access public
     **/
    private function __construct() {

        /** Initialize main variables. */
        $this->initialization();

    }

    /**
     * Initialize variables.
     *
     * @since 3.0.5
     * @access public
     *
     * @return void
     **/
    public function initialization() {

        self::$slug = Speaker::$slug;

        /** Get options group name. */
        self::$group = self::$slug . "UpdatesOptionsGroup";

        /** Get options section name. */
        self::$section = "mdp_" . self::$slug . "_settings_page_updates_section";

        /** Get option name. */
        self::$option_name = "mdp_" . self::$slug . "_updates_settings";

    }

    /**
     * Generate Updates Tab.
     *
     * @since  3.0.5
     * @access public
     *
     * @return void
     **/
	public function add_settings() {

		/** Updates Tab. */
		register_setting( self::$group, self::$option_name );
		add_settings_section( self::$section, '', null, self::$group );

        /** Check for Updates. */
        add_settings_field( 'check_updates', esc_html__( 'Check for updates:', 'speaker' ), [$this, 'check_updates'], self::$group, self::$section );

	}

    /**
     * Render Check for Updates button.
     *
     * @since 3.0.5
     * @access public
     **/
    public function check_updates() {

        UI::get_instance()->render_button(
            esc_html__( 'Check Updates', 'speaker' ),
            esc_html__( 'Press to clear all caches and check for updates.', 'speaker' ),
            [
                "name" => self::$option_name . "[check_updates]",
                "id" => self::$option_name . "-btn",
                "class" => "mdp-reset"
            ],
            'autorenew'
        );

    }

    /**
     * Render tab content with all settings fields.
     *
     * @since  3.0.5
     * @access public
     *
     * @return void
     **/
	public function render_tab_content() {

        echo '<h3>' . esc_html__( 'Updates', 'speaker' ) . '</h3>';

        settings_fields( self::$group );
        do_settings_sections( self::$group );

		/** Render "Changelog". */
		$this->render_changelog();

	}

	/**
	 * Render "Changelog" field.
	 *
	 * @since 3.0.5
	 * @access public
     *
     * @return void
	 **/
	public function render_changelog() {

        /** Do we have changelog in cache? */
	    $cache = new Cache();
        $key = 'changelog';
        $cached_changelog = $cache->get( $key, true );

        /** Show changelog from cache. */
        if ( ! empty( $cached_changelog ) ) {

            /** Print HTML changelog. */
            $cached_changelog = json_decode( $cached_changelog, true );
            $this->print_changelog( $cached_changelog[$key] );
            return;

        }

        /** Get changelog from remote host. */
        $remote_changelog = $this->get_changelog_remote();
        if ( false === $remote_changelog ) { return; }

        /** Store changelog in cache. */
        $cache->set( $key, [$key => $remote_changelog], false );

		/** Print HTML changelog. */
        $this->print_changelog( $remote_changelog );

    }

    /**
     * Get changelog from remote host.
     *
     * @since 3.0.5
     * @access public
     *
     * @return string|false
     **/
    private function get_changelog_remote() {

        /** Build changelog url. */
        $changelog_url = 'https://merkulove.host/changelog/' . self::$slug . '.html';

        /** Get fresh changelog file. */
        $changelog = wp_remote_get( $changelog_url );

        /** Check for errors. */
        if ( is_wp_error( $changelog ) || empty( $changelog['body'] ) ) { return false; }

        /** Now in $changelog we have changelog in HTML. */
        $changelog = $changelog['body'];

        /** This is not like our changelog. */
        if ( false === strpos( $changelog, '<h3>Changelog</h3>' ) ) { return false; }

        return $changelog;

    }

    /**
     * Print HTML changelog.
     *
     * @param string $changelog - Full changelog in HTML.
     *
     * @since  3.0.5
     * @access public
     *
     * @return void
     **/
    private function print_changelog( $changelog ) {

        ?><div class="mdc-changelog"><?php echo wp_kses( $changelog, Helper::get_kses_allowed_tags_svg() ); ?></div><?php

    }

    /**
     * Add Ajax handlers for Developer Board.
     *
     * @since 3.0.5
     * @access public
     *
     * @return void
     **/
    public static function add_ajax() {

        /** Reset Settings. */
        add_action( 'wp_ajax_check_updates', [self::get_instance(), 'ajax_check_updates'] );

    }

    /**
     * Ajax Reset plugin settings.
     *
     * @since 3.0.5
     * @access public
     *
     * @return void
     **/
    public static function ajax_check_updates() {

        /** Check nonce for security. */
        check_ajax_referer( 'speaker-nonce', 'nonce' );

        /** Do we need to do a full reset? */
        if ( empty( $_POST['checkUpdates'] ) ) {  wp_send_json( 'Wrong Parameter Value.' ); }

        /** Clear cache table. */
        $cache = new Cache();
        $cache->drop_cache_table();

        /** Return JSON result. */
        wp_send_json( true );

    }

	/**
	 * Main TabUpdates Instance.
	 *
	 * Insures that only one instance of TabUpdates exists in memory at any one time.
	 *
	 * @static
	 * @return TabUpdates
	 * @since 3.0.5
	 **/
	public static function get_instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {

			self::$instance = new self;

		}

		return self::$instance;

	}

} // End Class TabUpdates.
