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

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

use Merkulove\Speaker;
use stdClass;

/**
 * SINGLETON: Class used to implement plugin update mechanism.
 *
 * @since 2.0.2
 * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 **/
final class PluginUpdater {

    /**
     * In this option we temporary store plugin info.
     **/
    private $opt_plugin_info = 'mdp_speaker_plugin_info';

    /**
     * URL from where download plugin information.
     **/
    public $plugin_info_url = 'https://merkulove.host/wp-content/plugins/mdp-purchase-validator/src/Merkulove/PurchaseValidator/CCPluginInfo.php';

    /**
     * The one true PluginUpdater.
     *
     * @var PluginUpdater
     **/
    private static $instance;

    /**
     * Sets up a new PluginUpdater instance.
     *
     * @access public
     **/
    private function __construct() {

        /** Disable if plugin don't have Envato ID. */
        if ( ! EnvatoItem::get_instance()->get_id() ) { return; }

        /** Check do we have new version? */
        add_filter( 'site_transient_update_plugins', [$this, 'update_plugins'] );
        add_filter( 'transient_update_plugins', [$this, 'update_plugins'] );

		/** Show custom update message. */
		add_action( 'in_plugin_update_message-speaker/speaker.php', [$this, 'show_plugin_update_message' ], 10, 2 );

        /** Add plugin info to View details popup.  */
        add_filter( 'plugins_api', [$this, 'plugin_info'], 20, 3 );

    }

    /**
     * Check do we have new version?
     *
     * @param $update_plugins
     * @return mixed
     **/
    public function update_plugins( $update_plugins ) {

        global $wp_version;

        /** Reset temporary cache. */
        $this->force_check();

        if ( ! is_object( $update_plugins ) ) { return $update_plugins; }

        if ( ! isset( $update_plugins->response ) || ! is_array( $update_plugins->response ) ) {
            $update_plugins->response = [];
        }

        /** This method runs multiple times, so we use short time cache.  */

        /** Get plugin information from cache or remote. */
        $plugin_info = $this->get_plugin_information();

        if ( false === $plugin_info ) { return $update_plugins; }

        /** Wrong JSON. */
        if ( null === $plugin_info ) { return $update_plugins; }

        /** When Envato return: "Error: Failed to get data for this item". */
        if ( empty( $plugin_info->version ) ) { return $update_plugins; }

        /** Show plugin update if latest version is newer. */
        $update_plugins = $this->compare_with_new( $plugin_info, $wp_version, $update_plugins );

        return $update_plugins;

    }

    /**
     * Add item_id and pid params to url before request.
     *
     * @return string
     **/
    private function prepare_url() {

        /** Check if there's a new version of plugin. */
        $url = $this->plugin_info_url . '?';
        $url .= 'item_id=' . EnvatoItem::get_instance()->get_id();

        /** If this copy is activated. */
        if ( PluginActivation::get_instance()->is_activated() ) {

            /** Add PID to url. */
            $purchase_code = get_option( 'envato_purchase_code_' . EnvatoItem::get_instance()->get_id() );
            $url .= '&pid=' . $purchase_code;

        }

        return $url;

    }

    /**
     * Show plugin update if latest version is newer.
     *
     * @param $plugin_info
     * @param $wp_version
     * @param $update_plugins
     * @return object
     **/
    private function compare_with_new( $plugin_info, $wp_version, $update_plugins ) {

        $plugin = Speaker::get_instance();
        $current_version = Speaker::$version;
        $latest_version = $plugin_info->version;

        /** If Latest version is newer, show update version. */
        if ( version_compare( $latest_version, $current_version ) > 0 ) {

            $update_plugins->response['speaker/speaker.php'] = (object)[
                'slug' => 'speaker',
                'new_version' => $latest_version, // The newest version
                'package' => $this->get_package( $plugin_info ),
                'tested' => $wp_version,
                'icons' => [
                    '2x' => $plugin::$url . 'images/logo-color.svg',
                    '1x' => $plugin::$url . 'images/logo-color.svg',
                ]
            ];

        }

        return $update_plugins;

    }

    /**
     * Download URL only for activated users.
     *
     * @param $plugin_info
     * @return string
     **/
    private function get_package( $plugin_info ) {

        $package = '';

        if ( ! empty( $plugin_info->download_url ) ) {
            $package = $plugin_info->download_url;
        }

        return $package;

    }

    /**
     * Prepare plugin info.
     *
     * @param $res
     * @param $action
     * @param $args
     * @return bool|stdClass
     * @access public
     **/
    public function plugin_info( $res, $action, $args ) {

        global $wp_version;

        /** Reset temporary cache. */
        $this->force_check();

        /** Do nothing if this is not about getting plugin information. */
        if ( $action !== 'plugin_information' ) { return false; }

		/** Do nothing if it is not our plugin. */
		if ( 'speaker' !== $args->slug ) { return false; }

        /** Trying to get from cache first. */
        $remote = $this->get_plugin_information();

        if ( ! empty( $remote->version ) ) {

            $res = new stdClass();

            $res->name = $remote->name; // Plugin name.
            $res->slug = $remote->slug; // Slug.
            $res->version = $remote->version; // Plugin version.

            $res->last_updated = $remote->last_updated;
            $res->active_installs = $remote->active_installs;

            /** Rating. */
            if( ! empty( $remote->rating ) ) {
                $res->rating = $remote->rating;
                $res->num_ratings = $remote->num_ratings;
            }

            $res->tested = $wp_version; // Tested up to WordPress version.
            $res->requires = $remote->requires; // Requires at least WordPress version.
            $res->requires_php = $remote->requires_php; // The minimum required version of PHP.

            $res->author = '<a href="' . esc_url( $remote->author_homepage ) . '" target="_blank">' . esc_html( $remote->author ) . '</a>';

            /** Prepare contributors. */
            if( ! empty( $remote->contributors ) ) {
                $contributors = [];
                foreach ( $remote->contributors as $contributor ) {
                    $contributors[] = get_object_vars( $contributor );
                }

                $res->contributors = $contributors;
            }

            $res->homepage = $remote->homepage;

            /** Download url returned only for valid PID.  */
            if( ! empty( $remote->download_url ) ) {
                $res->download_link = $remote->download_url;
                $res->trunk = $remote->download_url;
            }

            $res->sections = [
                'description' => $remote->sections->description,
                'installation' => $remote->sections->installation,
                'changelog' => $remote->sections->changelog,
            ];

            /** FAQ section. */
            if( ! empty( $remote->sections->faq ) ) {
                $res->sections['faq'] = $remote->sections->faq;
            }

            /** Reviews section. */
            if( ! empty( $remote->sections->reviews ) ) {
                $res->sections['reviews'] = $remote->sections->reviews;
            }

            /** Screenshots section. */
            if( ! empty( $remote->sections->screenshots ) ) {
                $res->sections['screenshots'] = $remote->sections->screenshots;
            }

            /** Banners. */
            if( ! empty( $remote->banners ) ) {
                $banners = [];
                foreach ( $remote->banners as $key => $banner ) {
                    $banners[$key] = $banner;
                }

                $res->banners = $banners;
            }

            return $res;

        }

        return false;

    }

    /**
     * Get plugin information from cache or remote.
     *
     * @access public
     * @return false|object
     **/
    private function get_plugin_information() {

        /** Trying to get from cache first. */
        $cache = new Cache();
        $cached_plugin_info = $cache->get( $this->opt_plugin_info, true );
        $plugin_info = $cached_plugin_info;

        /** If cache not exist, do remote request. */
        if ( empty( $cached_plugin_info ) ) {

            /** Add item_id and pid params to url before request. */
            $url = $this->prepare_url();

            /** Download plugin JSON file with the actual plugin information on our server, if cache is empty. */
            $plugin_info = wp_remote_get( $url, [
                'timeout' => 15,
                'headers' => [
                    'Accept' => 'application/json'
                ]
            ] );

            /** We’ll check whether the answer is correct. */
            if ( is_wp_error( $plugin_info ) ) {

                $cache->set( $this->opt_plugin_info, [ $this->opt_plugin_info => false ] );
                return false;

            }

            /** Have answer with wrong code. */
            if ( wp_remote_retrieve_response_code( $plugin_info ) !== 200 ) {

                $cache->set( $this->opt_plugin_info, [ $this->opt_plugin_info => false ] );
                return false;

            }

            /** Write information about plugin to transient. */
            if ( ! empty( $plugin_info['body'] ) ) {
                $cache->set( $this->opt_plugin_info, [ $this->opt_plugin_info => $plugin_info ] );
            }

        }

        if ( ! is_array( $plugin_info ) ) {
            $plugin_info = json_decode( $plugin_info, false );
            $plugin_info = json_decode( $plugin_info->mdp_speaker_plugin_info->body, false );
        }

        return $plugin_info;

    }

    /**
     * Reset temporary options on Force update check.
     *
     * @return void
     * @access public
     **/
    public function force_check() {

        /** Reset cache only once per session. */
        static $called = false;
        if ( $called ) { return; }
        $called = true;

        if ( isset( $_GET['force-check'] ) && $_GET['force-check'] === '1' ) {

            /** Clear plugin cache. */
            $cache = new Cache();
            $cache->drop_cache_table();

        }

    }

    /**
     * Show custom update messages on plugins page.
     *
     * @param $plugin_data - An array of plugin metadata.
     * @param $r - An array of metadata about the available plugin update.
     * @access public
     **/
    public function show_plugin_update_message( $plugin_data, $r ) {

        /** Message for non activated users. */
        if ( ! PluginActivation::get_instance()->is_activated() ) {
            echo '<br /><span class="mdp-line">&nbsp;</span>';
            esc_attr_e( 'Please visit the plugin page on the Envato market to ', 'speaker' );
            echo ' <a href="https://urefm" target="_blank">';
            esc_attr_e( 'download ', 'speaker' );
            echo '</a> ';
            esc_attr_e( 'the latest version.', 'speaker' );
        }

    }

    /**
     * Main PluginUpdater Instance.
     * Insures that only one instance of PluginUpdater exists in memory at any one time.
     *
     * @static
     * @return PluginUpdater
     **/
    public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {

            self::$instance = new self;

        }

        return self::$instance;
    }

}