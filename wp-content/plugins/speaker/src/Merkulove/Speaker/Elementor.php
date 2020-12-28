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
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * Class to implement Speaker Elementor Widget.
 *
 * @since 3.0.0
 * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 **/
final class Elementor {

	/**
	 * The one true Elementor.
	 *
	 * @var Elementor
	 * @since 3.0.0
	 **/
	private static $instance;

	/**
	 * Sets up a new Elementor instance.
	 *
	 * @since 3.0.0
	 * @access public
	 **/
	public function __construct() {

		/** Check for basic requirements. */
		$this->initialization();

		/** Elementor widget Editor CSS. */
		add_action( 'elementor/editor/before_enqueue_styles', [$this, 'editor_styles'] );

	}

	/**
	 * Add our css to admin editor.
	 *
	 * @since 3.0.0
	 * @access public
	 **/
	public function editor_styles() {

		wp_enqueue_style( 'mdp-speaker-elementor-admin', Speaker::$url . 'css/elementor-admin' . Speaker::$suffix . '.css', [], Speaker::$version );

	}

	/**
	 * The init process check for basic requirements and then then run the plugin logic.
	 *
	 * @since 3.0.0
	 * @access public
	 **/
	public function initialization() {

		/** Check if Elementor installed and activated. */
		if ( ! did_action( 'elementor/loaded' ) ) { return; }

		/** Register custom widgets. */
		add_action( 'elementor/widgets/widgets_registered', [$this, 'register_widgets'] );

	}

	/**
	 * Register new Elementor widgets.
	 *
	 * @since 3.0.0
	 * @access public
	 **/
	public function register_widgets() {

		/** Load and register Elementor widgets. */
		$path = Speaker::$path . 'src/Merkulove/Speaker/Elementor/widgets/';
		foreach ( new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $path ) ) as $filename ) {

			if ( substr( $filename, -14 ) === '.elementor.php' ) {

				/** @noinspection PhpIncludeInspection */
				require_once $filename;

				/** Prepare class name from file. */
				$widget_class = $filename->getBasename( '.php' );
				$widget_class = '\\' . str_replace( '.', '_', $widget_class );

                /** @noinspection PhpFullyQualifiedNameUsageInspection */
                \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $widget_class() );

			}

		}

	}

	/**
	 * Main Elementor Instance.
	 *
	 * Insures that only one instance of Elementor exists in memory at any one time.
	 *
	 * @static
	 * @return Elementor
	 * @since 3.0.0
	 **/
	public static function get_instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {

			self::$instance = new self;

		}

		return self::$instance;

	}

} // End Class Elementor.
