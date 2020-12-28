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

/**
 * SINGLETON: Class contain information about the envato item.
 *
 * @since 1.0.0
 * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 **/
final class EnvatoItem {

    /**
     * Plugins slug.
     *
     * @var string
     * @since 3.0.5
     **/
    private static $slug;

    /**
     * Plugins Name.
     *
     * @var string
     * @since 3.0.5
     **/
    private static $plugin_name;

    /**
     * In this option we store Envato Item ID.
     *
     * @var integer
     * @since 3.0.5
     **/
    public static $opt_item_id;

	/**
	 * The one true EnvatoItem.
	 *
	 * @var EnvatoItem
	 * @since 1.0.0
	 **/
	private static $instance;

    /**
     * Sets up a new ServerReporter instance.
     *
     * @since 2.0.0
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

        /** Plugin slug. */
        self::$slug = 'speaker';

        /** Plugin name. */
        self::$plugin_name = 'Speaker';

        /** In this option we store Envato Item ID. */
        self::$opt_item_id = 'mdp_' . self::$slug . '_envato_id';

    }

	/**
	 * Return CodeCanyon Item ID.
	 *
	 * @since 1.0.0
	 * @access public
     *
	 * @return int
	 **/
	public function get_id() {

        /** Do we have Envato item id in cache? */
        $cache = new Cache();
        $key = self::$opt_item_id;
        $cached_item_id = $cache->get( $key, false );

        /** If we have valid item id from cache or not expired 0 use it. */
        if ( ( ! empty( $cached_item_id ) && (int)$cached_item_id > 0 ) || ( ! empty( $cached_item_id = $cache->get( $key, true ) ) ) ) {

            $cached_item_id = json_decode( $cached_item_id, true );

            return (int)$cached_item_id[$key];

        }

        /** If no cached item id, go to remote host for id. */
        $item_id = $this->get_remote_plugin_id();

        /** Store item id in cache. */
        $cache->set( $key, [$key => $item_id], false );

		return $item_id;

	}

	/**
	 * Return CodeCanyon Plugin ID from out server.
	 *
	 * @since 1.0.0
	 * @access public
     *
     * @return int
	 **/
	private function get_remote_plugin_id() {

	    /** Get url to request item id. */
		$url = $this->prepare_url();

        /** Get Envato item ID. */
        $item_id = wp_remote_get( $url );

        /** Check for errors. */
        if ( is_wp_error( $item_id ) || empty( $item_id['body'] ) ) { return 0; }

        /** Now in $item_id we have item id. */
        $item_id = json_decode( $item_id['body'], true );

		return (int)$item_id;

	}

    /**
     * Build url to request item id.
     *
     * @since 1.0.0
     * @access public
     *
     * @return int
     **/
	private function prepare_url() {

        /** Build URL. */
        $url = 'https://merkulove.host/wp-content/plugins/mdp-purchase-validator/src/Merkulove/PurchaseValidator/GetMyId.php';
        $url .= '?plugin_name=' . urlencode( self::$plugin_name );

        return $url;

    }

    /**
     * Return CodeCanyon Item ID.
     *
     * @since 1.0.0
     * @access public
     * @return string
     **/
    public function get_url() {

        return 'https://1.envato.market/' . self::$slug;

    }

	/**
	 * Main EnvatoItem Instance.
	 *
	 * Insures that only one instance of EnvatoItem exists in memory at any one time.
	 *
	 * @static
	 * @return EnvatoItem
	 * @since 1.0.0
	 **/
	public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {

            self::$instance = new self;

		}

		return self::$instance;

	}

} // End Class EnvatoItem.
