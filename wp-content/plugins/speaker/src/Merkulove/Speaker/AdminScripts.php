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
 * SINGLETON: Class adds admin scripts.
 *
 * @since 3.0.0
 * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 **/
final class AdminScripts {

	/**
	 * The one true AdminScripts.
	 *
	 * @var AdminScripts
	 * @since 3.0.0
	 **/
	private static $instance;

	/**
	 * Sets up a new AdminScripts instance.
	 *
	 * @since 3.0.0
	 * @access public
	 **/
	private function __construct() {

		/** Add admin styles. */
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );

	}

	/**
	 * Add JavaScrips for admin area.
	 *
	 * @since   3.0.0
	 * @return void
	 **/
	public function admin_scripts() {

		/** Plugin Settings Page. */
		$this->settings_scripts();

		/** Scripts for selected post types on edit screen. */
		$this->edit_post_scripts();

	}

	/**
	 * Scripts for selected post types edit screen.
	 *
	 * @since   3.0.0
	 * @return void
	 **/
	private function edit_post_scripts() {

		/** Edit screen for selected post types. */
		$screen = get_current_screen();

		/** Get supported post types from plugin settings. */
        $cpt_support = Settings::get_instance()->options['cpt_support'];

		if (
		    null !== $screen &&
            $screen->base !== 'edit' &&
            in_array( $screen->post_type, $cpt_support, false )
        ) {

            wp_enqueue_script( 'merkulov-ui', Speaker::$url . 'js/merkulov-ui' . Speaker::$suffix . '.js', [], Speaker::$version, true );
            wp_enqueue_script( 'mdp-sortable', Speaker::$url . 'js/Sortable' . Speaker::$suffix . '.js', [], Speaker::$version, true );
            wp_enqueue_script( 'dataTables', Speaker::$url . 'js/jquery.dataTables' . Speaker::$suffix . '.js', [ 'jquery' ], Speaker::$version, true );
			wp_enqueue_script( 'mdp-admin-post', Speaker::$url . 'js/admin-post' . Speaker::$suffix . '.js', ['jquery', 'mdp-sortable', 'dataTables'], Speaker::$version, true );

			/** Pass some vars to JS. */
			wp_localize_script( 'mdp-admin-post', 'mdpSpeaker', [
                'post_id'               => get_the_ID(), // Current post ID.
				'nonce'                 => wp_create_nonce( 'speaker-nonce' ), // Nonce for security.
				'audio_url'             => Helper::get_instance()->get_audio_upload_url(), // Upload folder URL.
                'voice'                 => Settings::get_instance()->options['language'], // Default voice.
                'speechTemplateCount'   => count( MetaBox::get_instance()->get_st_options() )
			] );

		}

	}

	/**
	 * Scripts for plugin setting page.
	 *
	 * @since   3.0.0
	 * @return void
	 **/
	private function settings_scripts() {

		/** Add scripts only on plugin settings page. */
		$screen = get_current_screen();
		if ( null === $screen || $screen->base !== Speaker::$menu_base ) { return; }

		wp_enqueue_script( 'merkulov-ui', Speaker::$url . 'js/merkulov-ui' . Speaker::$suffix . '.js', [], Speaker::$version, true );
		wp_enqueue_script( 'dataTables', Speaker::$url . 'js/jquery.dataTables' . Speaker::$suffix . '.js', [ 'jquery' ], Speaker::$version, true );

		wp_enqueue_script( 'mdp-speaker-admin', Speaker::$url . 'js/admin' . Speaker::$suffix . '.js', [ 'jquery', 'dataTables' ], Speaker::$version, true );
		wp_localize_script('mdp-speaker-admin', 'mdpSpeaker', [
			'ajaxURL'   => admin_url('admin-ajax.php'),
			'nonce'     => wp_create_nonce( 'speaker-nonce' ), // Nonce for security.
		] );

	}

	/**
	 * Main AdminScripts Instance.
	 *
	 * Insures that only one instance of AdminScripts exists in memory at any one time.
	 *
	 * @static
	 * @return AdminScripts
	 * @since 3.0.0
	 **/
	public static function get_instance() {

        /** @noinspection SelfClassReferencingInspection */
        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof AdminScripts ) ) {

			self::$instance = new AdminScripts;

		}

		return self::$instance;

	}

} // End Class AdminScripts.
