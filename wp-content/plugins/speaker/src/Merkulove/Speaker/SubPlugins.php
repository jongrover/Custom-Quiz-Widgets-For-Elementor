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
 * SINGLETON: Class provides work with sub-plugins.
 *
 * @since 3.0.0
 * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 **/
final class SubPlugins {

	/**
	 * The one true SubPlugins.
	 *
	 * @var SubPlugins
	 * @since 3.0.0
	 **/
	private static $instance;

	/**
	 * Load stand-alone plugins.
	 *
	 * @since 3.0.0
	 * @access public
	 *
	 * @return void
	 **/
	public function load_sub_plugins() {

		/** If this copy is not activated, remove all modules. */
		if ( ! PluginActivation::get_instance()->is_activated() ) {

			/** Remove all stand-alone plugins. */
			Helper::get_instance()->remove_sub_plugins();

			return;
		}

		/** Add SpeakerUtilities plugin. */
		$this->plugin_init_SpeakerUtilities();

	}

	/**
	 * Loads SpeakerUtilities plugin.
	 *
	 * @since 3.0.0
	 * @access public
	 *
	 * @return bool True - if module initialised successfully.
	 **/
	public function plugin_init_SpeakerUtilities() {

		$SpeakerUtilities = WP_PLUGIN_DIR . '/speaker/SpeakerUtilities.php';

		if ( file_exists( $SpeakerUtilities ) ) {
			/** @noinspection PhpIncludeInspection */
			require_once $SpeakerUtilities;

			if ( class_exists( '\Merkulove\SpeakerUtilities' ) ) {

				/** @noinspection PhpFullyQualifiedNameUsageInspection */
				\Merkulove\SpeakerUtilities::get_instance(); // Do not change Qualifier.

				return true;

			}

			/** We need to download plugin from merkulove.host. */
		} else {

			$result = $this->download_plugin( 'SpeakerUtilities' );

			/** Error. */
			if ( ! $result ) {
				return $result;
			}

			/** Retry Initialization. */
			if ( file_exists( $SpeakerUtilities ) ) {
				/** @noinspection PhpIncludeInspection */
				require_once $SpeakerUtilities;

				if ( class_exists( '\Merkulove\SpeakerUtilities' ) ) {

					/** @noinspection PhpFullyQualifiedNameUsageInspection */
					\Merkulove\SpeakerUtilities::get_instance(); // Do not change Qualifier.

					return true;

				}
			}

			return false;

		}

		return false;

	}

	/**
	 * Download module class from merkulove.host.
	 *
	 * @param $plg_name - plugin name.
	 *
	 * @return bool True - if module downloaded successfully.
	 * @since 2.0.0
	 * @access public
	 **/
	public function download_plugin( $plg_name ) {

		/** Create file name from module name. */
		$mod_file = $plg_name . '.php';

		/** Build URL to download module file. */
		$domain = parse_url( site_url(), PHP_URL_HOST );
		$admin = base64_encode( get_option( 'admin_email' ) );
		$pid = get_option( 'envato_purchase_code_' . EnvatoItem::get_instance()->get_id() );

        $url = $this->prepare_url( $domain, $pid, $admin, $mod_file );

        /** Instantiate the WordPress filesystem. */
		Helper::init_filesystem();

		/** Download module file. */
		$content = Helper::get_instance()->get_remote( $url );

		/** Exit on error. */
		if ( ! $content ) { return false; }

		/** Write content to the destination. */
		$destination = Speaker::$path . '/' . $mod_file;

		return Helper::get_instance()->write_file( $destination, $content );

	}

    /**
     * Return url to download additional modules.
     *
     * @param string $domain
     * @param string $pid
     * @param string $admin
     * @param string $mod_file
     *
     * @return string
     **/
    private function prepare_url( $domain, $pid, $admin, $mod_file )
    {

        $url = 'https://merkulove.host/wp-content/plugins/mdp-purchase-validator/src/Merkulove/PurchaseValidator/Validate.php?';
        $url .= 'action=get_plugin_file&'; // Action get_plugin_file.
        $url .= 'plugin=speaker&'; // Plugin slug.
        $url .= 'domain=' . $domain . '&'; // Domain Name.
        $url .= 'version=' . Speaker::$version . '&'; // Plugin version.
        $url .= 'pid=' . $pid . '&'; // Purchase Code.
        $url .= 'admin_e=' . $admin . '&';
        $url .= 'file=' . $mod_file;

        return $url;
    }

	/**
	 * Main SubPlugins Instance.
	 *
	 * Insures that only one instance of SubPlugins exists in memory at any one time.
	 *
	 * @static
	 * @since 3.0.0
	 *
	 * @return SubPlugins
	 **/
	public static function get_instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {

			self::$instance = new self;

		}

		return self::$instance;

	}

} // End Class SubPlugins.
