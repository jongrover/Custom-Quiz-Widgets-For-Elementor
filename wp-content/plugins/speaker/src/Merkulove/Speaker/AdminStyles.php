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
 * SINGLETON: Class adds admin styles.
 *
 * @since 3.0.0
 * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 **/
final class AdminStyles {

	/**
	 * The one true AdminStyles.
	 *
	 * @var AdminStyles
	 * @since 3.0.0
	 **/
	private static $instance;

	/**
	 * Sets up a new AdminStyles instance.
	 *
	 * @since 3.0.0
	 * @access public
	 **/
	private function __construct() {

		/** Add admin styles. */
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_styles' ] );

	}

	/**
	 * Add CSS for admin area.
	 *
	 * @since   3.0.0
	 * @return void
	 **/
	public function admin_styles() {

		/** Plugin Settings Page. */
		$this->settings_styles();

		/** Styles for selected post types edit screen. */
		$this->edit_post_styles();

		/** Plugins page. Styles for "View version details" popup. */
		$this->plugin_update_styles();

	}

	/**
	 * Styles for selected post types edit screen.
	 *
	 * @since   3.0.0
	 * @return void
	 **/
	private function edit_post_styles() {

		/** Edit Post/Page. */
		$screen = get_current_screen();

		/** Get supported post types from plugin settings. */
        $cpt_support = Settings::get_instance()->options['cpt_support'];

		if (
		    null !== $screen &&
            $screen->base !== 'edit' &&
            in_array( $screen->post_type, $cpt_support, false )
        ) {

            /** Add class .mdc-disable to body. So we can use UI without overrides WP CSS, only for this page.  */
            add_action( 'admin_body_class', [$this, 'add_admin_class'] );

            wp_enqueue_style( 'merkulov-ui', Speaker::$url . 'css/merkulov-ui.min.css', [], Speaker::$version );
			wp_enqueue_style( 'mdp-speaker-admin-post', Speaker::$url . 'css/admin-post' . Speaker::$suffix . '.css', [], Speaker::$version );

		}

	}

	/**
	 * Styles for plugin setting page.
	 *
	 * @since   3.0.0
	 * @return void
	 **/
	private function settings_styles() {

		/** Add styles only on plugin setting page. */
		$screen = get_current_screen();

		if ( null === $screen || $screen->base !== Speaker::$menu_base ) { return; }

		wp_enqueue_style( 'merkulov-ui', Speaker::$url . 'css/merkulov-ui.min.css', [], Speaker::$version );
		wp_enqueue_style( 'dataTables', Speaker::$url . 'css/jquery.dataTables' . Speaker::$suffix . '.css', [], Speaker::$version );
		wp_enqueue_style( 'mdp-speaker-admin', Speaker::$url . 'css/admin' . Speaker::$suffix . '.css', [], Speaker::$version );

	}

	/**
	 * Styles for plugins page. "View version details" popup.
	 *
	 * @since   3.0.0
	 * @return void
	 **/
	private function plugin_update_styles() {

		/** Plugin install page, for style "View version details" popup. */
		$screen = get_current_screen();
		if ( null === $screen || $screen->base !== 'plugin-install' ) { return; }

		/** Styles only for our plugin. */
		if ( isset( $_GET['plugin'] ) && $_GET['plugin'] === 'speaker' ) {

			wp_enqueue_style( 'mdp-speaker-plugin-install', Speaker::$url . 'css/plugin-install' . Speaker::$suffix . '.css', [], Speaker::$version );

		}

	}

    /**
     * Add class to body in admin area.
     *
     * @param string $classes - Space-separated list of CSS classes.
     *
     * @since 3.0.0
     * @return string
     */
    public function add_admin_class( $classes ) {

        return $classes . ' mdc-disable ';

    }

	/**
	 * Main AdminStyles Instance.
	 *
	 * Insures that only one instance of AdminStyles exists in memory at any one time.
	 *
	 * @static
	 * @return AdminStyles
	 * @since 3.0.0
	 **/
	public static function get_instance() {

        /** @noinspection SelfClassReferencingInspection */
        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof AdminStyles ) ) {

			self::$instance = new AdminStyles;

		}

		return self::$instance;

	}

} // End Class AdminStyles.
