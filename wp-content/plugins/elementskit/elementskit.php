<?php

defined( 'ABSPATH' ) || exit;
/**
 * Plugin Name: ElementsKit Pro
 * Description: The most advanced addons for Elementor with tons of widgets, layout pack and powerful custom controls.
 * Plugin URI: https://products.wpmet.com/elementskit-widgets
 * Author: Wpmet
 * Version: 2.0.3
 * Author URI: https://wpmet.com/
 *
 * Text Domain: elementskit
 *
 * Elementskit is a powerful addon for Elementor page builder.
 * It has a tons of widgets to create any sites with an ease. It has some most unique
 * and powerful custom controls for elementor, such as "image picker", "ajax select", "widget area".
 * 
 */
if(!class_exists('ElementsKit')){
	final class ElementsKit{

		/**
		 * Plugin Version
		 *
		 * @since 1.0.0
		 * @var string The plugin version.
		 */
		static function version(){
			return '2.0.3';
		}

		/**
		 * Package type
		 *
		 * @since 1.1.0
		 * @var string The plugin purchase type [pro/ free].
		 */
		static function package_type(){
			return 'pro';
		}

		/**
		 * Product ID
		 *
		 * @since 1.2.6
		 * @var string The plugin ID in our server.
		 */
		static function product_id(){
			return '9';
		}

		/**
		 * Author Name
		 *
		 * @since 1.3.1
		 * @var string The plugin author.
		 */
		static function author_name(){
			return 'Wpmet';
		}

		/**
		 * Store Name
		 *
		 * @since 1.3.1
		 * @var string The store name: self site, envato.
		 */
		static function store_name(){
			return 'wpmet';
		}

		/**
		 * Minimum ElementsKit Version
		 *
		 * @since 1.0.0
		 * @var string Minimum ElementsKit version required to run the plugin.
		 */
		static function min_ekit_version(){
			return '2.0.0';
		}

		/**
		 * Plugin file
		 *
		 * @since 1.0.0
		 * @var string plugins's root file.
		 */
		static function plugin_file(){
			return __FILE__;
		}

		/**
		 * Plugin url
		 *
		 * @since 1.0.0
		 * @var string plugins's root url.
		 */
		static function plugin_url(){
			return trailingslashit(plugin_dir_url( __FILE__ ));
		}

		/**
		 * Plugin dir
		 *
		 * @since 1.0.0
		 * @var string plugins's root directory.
		 */
		static function plugin_dir(){
			return trailingslashit(plugin_dir_path( __FILE__ ));
		}

		/**
		 * Plugin's widget directory.
		 *
		 * @since 1.0.0
		 * @var string widget's root directory.
		 */
		static function widget_dir(){
			return self::plugin_dir() . 'widgets/';
		}

		/**
		 * Plugin's widget url.
		 *
		 * @since 1.0.0
		 * @var string widget's root url.
		 */
		static function widget_url(){
			return self::plugin_url() . 'widgets/';
		}


		/**
		 * API url
		 *
		 * @since 1.0.0
		 * @var string for license, layout notification related functions.
		 */
		static function api_url(){
			return 'https://api.wpmet.com/public/';
		}

		/**
		 * Account url
		 *
		 * @since 1.2.6
		 * @var string for plugin update notification, user account page.
		 */
		static function account_url(){
			return 'https://account.wpmet.com';
		}

		/**
		 * Plugin's module directory.
		 *
		 * @since 1.0.0
		 * @var string module's root directory.
		 */
		static function module_dir(){
			return self::plugin_dir() . 'modules/';
		}

		/**
		 * Plugin's module url.
		 *
		 * @since 1.0.0
		 * @var string module's root url.
		 */
		static function module_url(){
			return self::plugin_url() . 'modules/';
		}


		/**
		 * Plugin's lib directory.
		 *
		 * @since 1.0.0
		 * @var string lib's root directory.
		 */
		static function lib_dir(){
			return self::plugin_dir() . 'libs/';
		}

		/**
		 * Plugin's lib url.
		 *
		 * @since 1.0.0
		 * @var string lib's root url.
		 */
		static function lib_url(){
			return self::plugin_url() . 'libs/';
		}


		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 * @access public
		 */
		public function __construct() {
			// Load the main static helper class.
			require_once self::plugin_dir() . 'libs/notice/notice.php';

			// Load translation
			add_action( 'init', array( $this, 'i18n' ) );
			// Init Plugin
			$this->init();
		}

		/**
		 * Load Textdomain
		 *
		 * Load plugin localization files.
		 * Fired by `init` action hook.
		 *
		 * @since 1.0.0
		 * @access public
		 */
		public function i18n() {
			load_plugin_textdomain( 'elementskit', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}

		/**
		 * Initialize the plugin
		 *
		 * Checks for basic plugin requirements, if one check fail don't continue,
		 * if all check have passed include the plugin class.
		 *
		 * Fired by `plugins_loaded` action hook.
		 *
		 * @since 1.0.0
		 * @access public
		 */
		public function init() {

			// init notice class
			\Oxaim\Libs\Notice::init();
			
			// Check if ElementsKit Lite is installed and activated.
			if ( ! class_exists( 'ElementsKit_Lite' ) ) {
				$this->missing_elementskit();
				return;
			}

			// Once we get here, We have passed all validation checks so we can safely include our plugin.

			add_filter( 'elementskit/core/package_type', function($package_type){
				return 'pro';
			});

			add_action( 'elementskit_lite/before_loaded', function(){
				// Load the Handler class, it's the core class of ElementsKit.
				require_once self::plugin_dir() . 'plugin.php';
			});

		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have required Elementskit.
		 *
		 * @since 1.0.0
		 * @access public
		 */
		public function missing_elementskit() {
			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			$btn = [
				'default_class' => 'button',
				'class' => 'button-primary ', // button-primary button-secondary button-small button-large button-link
			];
			if ( file_exists( WP_PLUGIN_DIR . '/elementskit-lite/elementskit-lite.php' )) {
				$btn['text'] = esc_html__('Activate ElementsKit Lite', 'elementskit');
				$btn['url'] = wp_nonce_url( self_admin_url( 'plugins.php?action=activate&plugin=elementskit-lite/elementskit-lite.php&plugin_status=all&paged=1' ), 'activate-plugin_elementskit-lite/elementskit-lite.php' );
			} else {
				$btn['text'] = esc_html__('Install ElementsKit Lite', 'elementskit');
				$btn['url'] = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementskit-lite' ), 'install-plugin_elementskit-lite' );
			}

			\Oxaim\Libs\Notice::instance('elementskit', 'missing-elementskit-version')
			->set_type('error')
			->set_message(sprintf( esc_html__( 'ElementsKit Pro requires ElementsKit Lite, which is currently NOT RUNNING. ', 'elementskit' )))
			->set_button([
				'url' => $btn['url'],
				'text' => $btn['text'],
			])
			->call();
		}
	}

	// this is a compatiblity blank class. used in elementskit-lite/elementskit-lite.php
	// todo: convert is into a constant
	class ElementsKit_Comp{

	}
	add_action('plugins_loaded', function(){
		new ElementsKit();
	}, 115);

}