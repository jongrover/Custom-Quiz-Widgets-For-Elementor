<?php
/**
 * Plugin Name: Speaker
 * Plugin URI: https://1.envato.market/speaker
 * Description: Create an audio version of your posts, with a selection of more than 235+ voices across more than 40 languages and variants.
 * Author: Merkulove
 * Version: 3.1.0
 * Author URI: https://1.envato.market/cc-merkulove
 * Requires PHP: 7.1
 * Requires at least: 3.0
 * Tested up to: 5.5
 * Text Domain: speaker
 **/

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

namespace Merkulove;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/** Include plugin autoloader for additional classes. */
require __DIR__ . '/src/autoload.php';

/** Includes the autoloader for libraries installed with Composer. */
require __DIR__ . '/vendor/autoload.php';

use Merkulove\Speaker\Helper;
use Merkulove\Speaker\MetaBox;
use Merkulove\Speaker\Settings;
use Merkulove\Speaker\TabUpdates;
use Merkulove\Speaker\WPBakery;
use Merkulove\Speaker\Elementor;
use Merkulove\Speaker\SubPlugins;
use Merkulove\Speaker\Shortcodes;
use Merkulove\Speaker\AdminStyles;
use Merkulove\Speaker\FrontStyles;
use Merkulove\Speaker\PluginHelper;
use Merkulove\Speaker\AdminScripts;
use Merkulove\Speaker\FrontScripts;
use Merkulove\Speaker\PluginUpdater;
use Merkulove\Speaker\SpeakerCaster;
use Merkulove\Speaker\DeveloperBoard;
use Merkulove\Speaker\CheckCompatibility;

/**
 * SINGLETON: Core class used to instantiate and control a Speaker plugin.
 *
 * @since 1.0.0
 **/
final class Speaker {

    /**
     * Plugin version.
     *
     * @string version
     * @since 1.0.0
     **/
    public static $version;

    /**
     * Plugin name.
     *
     * @string version
     * @since 3.0.4
     **/
    public static $name;

    /**
     * Use minified libraries if SCRIPT_DEBUG is turned off.
     *
     * @since 1.0.0
     **/
    public static $suffix;

    /**
     * URL (with trailing slash) to plugin folder.
     *
     * @var string
     * @since 1.0.0
     **/
    public static $url;

    /**
     * PATH to plugin folder.
     *
     * @var string
     * @since 1.0.0
     **/
    public static $path;

    /**
     * Plugin base name.
     *
     * @var string
     * @since 1.0.0
     **/
    public static $basename;

	/**
	 * Plugin admin menu base.
	 *
	 * @var string
	 * @since 3.0.0
	 **/
	public static $menu_base;

    /**
     * Plugin slug base.
     *
     * @var string
     * @since 3.0.5
     **/
    public static $slug;

    /**
     * Full path to main plugin file.
     *
     * @var string
     * @since 3.0.5
     **/
    public static $plugin_file;

    /**
     * The one true Speaker.
     *
     * @var Speaker
     * @since 1.0.0
     **/
    private static $instance;

    /**
     * Sets up a new plugin instance.
     *
     * @since 1.0.0
     * @access public
     **/
    private function __construct() {

	    /** Initialize main variables. */
	    $this->initialization();

    }

	/**
	 * Setup the plugin.
	 *
	 * @since 3.0.0
	 * @access public
     *
	 * @return void
	 **/
	public function setup() {

	    /** Do critical initial checks. */
	    if ( ! CheckCompatibility::get_instance()->do_initial_checks( true ) ) { return; }

	    /** Send install Action to our host. */
        self::send_install_action();

		/** Define hooks that runs on both the front-end as well as the dashboard. */
		$this->both_hooks();

		/** Define public hooks. */
		$this->public_hooks();

		/** Define admin hooks. */
		$this->admin_hooks();

	}

	/**
	 * Initialize main variables.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 **/
	public function initialization() {

		/** Get Plugin version. */
	    self::$version = $this->get_plugin_data( 'Version' );

        /** Plugin slug. */
        self::$slug = $this->get_plugin_data( 'TextDomain' );

        /** Get Plugin name. */
        self::$name = $this->get_plugin_data( 'Name' );

		/** Gets the plugin URL (with trailing slash). */
		self::$url = plugin_dir_url( __FILE__ );

		/** Gets the plugin PATH. */
		self::$path = plugin_dir_path( __FILE__ );

		/** Use minified libraries if SCRIPT_DEBUG is turned off. */
		self::$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		/** Set plugin basename. */
		self::$basename = plugin_basename( __FILE__ );

		/** Plugin settings page base. */
		self::$menu_base = 'toplevel_page_mdp_speaker_settings';

        /** Full path to main plugin file. */
        self::$plugin_file = __FILE__;

	}

	/**
	 * Define hooks that runs on both the front-end as well as the dashboard.
	 *
	 * @since 3.0.0
	 * @access private
	 *
	 * @return void
	 **/
	private function both_hooks() {

		/** Load the plugin text domain for translation. */
		PluginHelper::get_instance()->load_plugin_textdomain();

		/** Load plugin settings. */
		Settings::get_instance();

        /** Register WPBakery Elements. */
        $this->register_wpbakery_elements();

        /** Register Elementor Widgets. */
        $this->register_elementor_widgets();

        /** Adds all the necessary shortcodes. */
        Shortcodes::get_instance();

	}

	/**
	 * Register all of the hooks related to the public-facing functionality.
	 *
	 * @since 3.0.0
	 * @access private
	 *
	 * @return void
	 **/
	private function public_hooks() {

		/** Work only on frontend area. */
		if ( is_admin() ) { return; }

		/** Load CSS for Frontend Area. */
		FrontStyles::get_instance();

		/** Load JavaScripts for Frontend Area. */
		FrontScripts::get_instance();

		/** Add player code to page. */
		SpeakerCaster::get_instance()->add_player();

		/** Speaker use custom page template to parse content without garbage. */
        add_filter( 'template_include', [SpeakerCaster::class, 'speaker_page_template'], PHP_INT_MAX );

        /** Hide admin bar for Speech Template Editor. */
        SpeakerCaster::hide_admin_bar();

	}

	/**
	 * Register all of the hooks related to the admin area functionality.
	 *
	 * @since 3.0.0
	 * @access private
	 *
	 * @return void
	 **/
	private function admin_hooks() {

		/** Work only in admin area. */
		if ( ! is_admin() ) { return; }

		/** Remove notices, add links in plugin list, show admin warnings, remove wp copyrights. */
		PluginHelper::get_instance()->add_actions();

		/** Create folder for audio files. */
		Helper::get_instance()->create_speaker_folder();

		/** Plugin update mechanism enable only if plugin have Envato ID. */
		PluginUpdater::get_instance();

		/** Add plugin settings page. */
		Settings::get_instance()->add_settings_page();

		/** Add Ajax handlers and before_delete_post action. */
		SpeakerCaster::get_instance()->add_actions();

		/** Add Meta Box for selected post types. */
		MetaBox::get_instance();

		/** Add admin styles. */
		AdminStyles::get_instance();

		/** Add admin javascript. */
		AdminScripts::get_instance();

		/** Add Ajax handlers for Developer Board. */
		DeveloperBoard::add_ajax();

        /** Add Ajax handlers for Updates Tab. */
        TabUpdates::add_ajax();

        /** Load stand-alone plugins. */
        SubPlugins::get_instance()->load_sub_plugins();

	}

    /**
     * Registers a WPBakery element.
     *
     * @return void
     * @since 3.0.0
     * @access public
     **/
    public function register_elementor_widgets() {

        /** Initialize Elementor widgets. */
        Elementor::get_instance();

    }

    /**
     * Registers a WPBakery element.
     *
     * @return void
     * @since 3.0.0
     * @access public
     **/
    public function register_wpbakery_elements() {

        /** Initialize WPBakery Element. */
        WPBakery::get_instance();

    }

	/**
	 * Return current plugin metadata.
     *
     * @param string $field - Field name from plugin data.
	 *
	 * @since 3.0.0
	 * @access public
	 *
	 * @return array {
	 *     Plugin data. Values will be empty if not supplied by the plugin.
	 *
	 *     @type string $Name        Name of the plugin. Should be unique.
	 *     @type string $Title       Title of the plugin and link to the plugin's site (if set).
	 *     @type string $Description Plugin description.
	 *     @type string $Author      Author's name.
	 *     @type string $AuthorURI   Author's website address (if set).
	 *     @type string $Version     Plugin version.
	 *     @type string $TextDomain  Plugin textdomain.
	 *     @type string $DomainPath  Plugins relative directory path to .mo files.
	 *     @type bool   $Network     Whether the plugin can only be activated network-wide.
	 *     @type string $RequiresWP  Minimum required version of WordPress.
	 *     @type string $RequiresPHP Minimum required version of PHP.
	 * }
	 **/
	public function get_plugin_data( $field ) {

        static $plugin_data;

        /** We already have $plugin_data. */
        if ( $plugin_data !== null ) {
            return $plugin_data[$field];
        }

        /** This is first time call of method, so prepare $plugin_data. */
        if ( ! function_exists('get_plugin_data') ) {
            require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        }

        $plugin_data = get_plugin_data( __FILE__ );

        return $plugin_data[$field];

	}

	/**
     * Return plugin version.
     *
     * @since 2.0.2
	 * @access public
     *
	 * @return string
	 **/
	public function get_version() {
		return self::$version;
	}

    /**
     * Run when the plugin is activated.
     *
     * @static
     * @since 2.0.0
     *
     * @return void
     **/
    public static function on_activation() {

        /** Security checks. */
        if ( ! current_user_can( 'activate_plugins' ) ) { return; }

	    /** We need to know plugin to activate it. */
        if ( ! isset( $_REQUEST['plugin'] ) ) { return; }

	    /** Get plugin. */
        $plugin = filter_var( $_REQUEST['plugin'], FILTER_SANITIZE_STRING );

        /** Checks that a user was referred from admin page with the correct security nonce. */
        check_admin_referer( "activate-plugin_{$plugin}" );

        /** Do critical initial checks. */
        if ( ! CheckCompatibility::get_instance()->do_initial_checks( false ) ) { return; }

        /** Send install Action to our host. */
        self::send_install_action();

    }

    /**
     * Send install Action to our host.
     *
     * @static
     * @since 1.0.1
     **/
    private static function send_install_action() {

        /** Plugin version. */
        $ver = self::get_instance()->get_version();

        /** Have we already sent 'install' for this version? */
        $opt_name = 'mdp_speaker_send_action_install';
        $ver_installed = get_option( $opt_name );

        /** Send install Action to our host. */
        if ( ! $ver_installed || $ver !== $ver_installed ) {

            /** Send install Action to our host. */
            Helper::get_instance()->send_action( 'install', 'speaker', $ver );
            update_option( $opt_name, $ver );

        }

    }

    /**
     * Main Speaker Instance.
     *
     * Insures that only one instance of Speaker exists in memory at any one time.
     *
     * @static
     * @since 1.0.0
     *
     * @return Speaker
     **/
    public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {

            self::$instance = new self;

        }

        return self::$instance;

    }

} // End Class Speaker.

/** Run when the plugin is activated. */
register_activation_hook( __FILE__, [Speaker::class, 'on_activation'] );

/** Run Speaker class once after activated plugins have loaded. */
add_action( 'plugins_loaded', [Speaker::get_instance(), 'setup'] );

