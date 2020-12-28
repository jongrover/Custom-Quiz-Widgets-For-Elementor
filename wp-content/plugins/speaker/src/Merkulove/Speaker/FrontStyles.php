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
final class FrontStyles {

	/**
	 * The one true FrontStyles.
	 *
	 * @var FrontStyles
	 * @since 3.0.0
	 **/
	private static $instance;

	/**
	 * Sets up a new FrontStyles instance.
	 *
	 * @since 3.0.0
	 * @access public
	 **/
	private function __construct() {

		/** Add plugin styles. */
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ] );

		/** Remove WP mediaElement if set Default Browser Player */
		if ( 'speaker-browser-default' === Settings::get_instance()->options['style'] ) {

			/** Remove media element styles and scripts. */
			add_filter( 'wp_audio_shortcode_library', '__return_empty_string', 11 );

		}

	}

	/**
	 * Add plugin styles.
	 *
	 * @since 3.0.0
	 * @return void
	 **/
	public function enqueue_styles() {

		/** Checks if plugin should work on this page. */
		if ( ! AssignmentsTab::get_instance()->display() ) { return; }

		wp_enqueue_style( 'mdp-speaker', Speaker::$url . 'css/speaker' . Speaker::$suffix . '.css', [], Speaker::$version );

		/** Add custom CSS. */
		wp_add_inline_style( 'mdp-speaker', Settings::get_instance()->options['custom_css'] );

	}

	/**
	 * Main FrontStyles Instance.
	 *
	 * Insures that only one instance of FrontStyles exists in memory at any one time.
	 *
	 * @static
	 * @return FrontStyles
	 * @since 3.0.0
	 **/
	public static function get_instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {

			self::$instance = new self;

		}

		return self::$instance;

	}

} // End Class FrontStyles.
