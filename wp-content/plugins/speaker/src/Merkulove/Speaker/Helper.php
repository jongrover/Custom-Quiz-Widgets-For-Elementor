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

use WP_Filesystem_Direct;

/**
 * SINGLETON: Class used to implement work with WordPress filesystem.
 *
 * @since 2.0.0
 * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 **/
final class Helper {

	/**
	 * The one true Helper.
	 *
	 * @var Helper
	 * @since 1.0.0
	 **/
	private static $instance;

    /**
     * Parse a string between two strings.
     *
     * @param string $string
     * @param string $start
     * @param string $end
     *
     * @since  3.0.0
     * @access public
     *
     * @return string
     **/
	public function get_string_between( $string, $start, $end ) {

        $string = ' ' . $string;
        $ini = strpos( $string, $start );
        if ( $ini === 0 ) { return ''; }

        $ini += strlen( $start );
        $len = strpos( $string, $end, $ini ) - $ini;

        return substr( $string, $ini, $len );

    }

    /**
     * Replace merkulove.host to mirror merkulove.com
     *
     * @param string $url
     *
     * @since  3.0.0
     * @access public
     *
     * @return string
     **/
	public function replace_mirror( $url ) {

        /** Replace merkulove.host to mirror merkulove.com  */
        if ( strpos( $url, 'https://merkulove.host/' ) === 0 ) {
            $url = str_replace( 'https://merkulove.host/', 'https://merkulove.com/', $url );
        }

        return $url;

    }

    /**
     * Use mirror in Russia for countries under US sanctions.
     *
     * @param $url
     *
     * @since  3.0.0
     * @access public
     *
     * @return bool|string
     **/
	private function file_get_contents_curl_mirror( $url ) {

        /** Replace merkulove.host to mirror merkulove.com  */
        $url = $this->replace_mirror( $url );

        $curl = curl_init();

        curl_setopt( $curl, CURLOPT_AUTOREFERER, TRUE );
        curl_setopt( $curl, CURLOPT_HEADER, 0 );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $curl, CURLOPT_URL, $url);
        curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, TRUE );

        $data = curl_exec( $curl );

        /** Error handler. */
        if ( curl_errno( $curl ) > 0 ) { return false; }

        return $data;

    }

	/**
	 * Delete Plugin Options.
	 *
	 * @since 3.0.0
	 * @access public
	 **/
	public static function remove_settings() {

		$settings = [
			'mdp_speaker_envato_id',
			'mdp_speaker_settings',
			'mdp_speaker_design_settings',
            'mdp_speaker_post_types_settings',
			'mdp_speaker_assignments_settings',
			'mdp_speaker_uninstall_settings',
			'mdp_speaker_developer_settings',
            'mdp_speaker_send_action_install',
            'mdp_speaker_speech_templates',
			'envato_purchase_code_' . EnvatoItem::get_instance()->get_id() // Speaker item ID.
		];

		/** For Multisite. */
		if ( is_multisite() ) {

			foreach ( $settings as $key ) {

				if ( ! get_site_option( $key ) ) { continue; }

				delete_site_option( $key );

			}

			/** For Singular site. */
		} else {

			foreach ( $settings as $key ) {

				if ( ! get_option( $key ) ) { continue; }

				delete_option( $key );

			}

		}

	}

	/**
	 * Remove all stand-alone plugins.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return void
	 **/
	public function remove_sub_plugins() {

		/** Remove SpeakerUtilities.php file. */
		$SpeakerUtilities = WP_PLUGIN_DIR . '/speaker/SpeakerUtilities.php';
		if ( ! file_exists( $SpeakerUtilities ) ) { return; }

		require_once ( ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php' );
		require_once ( ABSPATH . 'wp-admin/includes/class-wp-filesystem-direct.php' );
		$fileSystemDirect = new WP_Filesystem_Direct( false );

		$fileSystemDirect->delete( $SpeakerUtilities, false, 'f' );

	}

	/**
	 * Remove all speaker audio files.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return void
	 **/
	public function remove_audio_files() {

		/** Remove /wp-content/uploads/speaker/ folder. */
		$dir = trailingslashit( wp_upload_dir()['basedir'] ) . 'speaker';
		$this->remove_directory( $dir );

	}

	/**
	 * Remove directory with all contents.
	 *
	 * @param $dir - Directory path to remove.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return void
	 **/
	public function remove_directory( $dir ) {

		require_once ( ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php' );
		require_once ( ABSPATH . 'wp-admin/includes/class-wp-filesystem-direct.php' );
		$fileSystemDirect = new WP_Filesystem_Direct( false );
		$fileSystemDirect->rmdir( $dir, true );

	}

	/**
	 * Initializes WordPress filesystem.
	 *
	 * @static
	 * @access public
	 * @since 2.0.0
	 *
	 * @return object WP_Filesystem
	 **/
	public static function init_filesystem() {

		$credentials = [];

		if ( ! defined( 'FS_METHOD' ) ) {
			define( 'FS_METHOD', 'direct' );
		}

		$method = defined( 'FS_METHOD' ) ? FS_METHOD : false;

		/** FTP */
		if ( 'ftpext' === $method ) {

			/** If defined, set credentials, else set to NULL. */
			$credentials['hostname'] = defined( 'FTP_HOST' ) ? preg_replace( '|\w+://|', '', FTP_HOST ) : null;
			$credentials['username'] = defined( 'FTP_USER' ) ? FTP_USER : null;
			$credentials['password'] = defined( 'FTP_PASS' ) ? FTP_PASS : null;

			/** FTP port. */
			if ( null !== $credentials['hostname'] && strpos( $credentials['hostname'], ':' ) ) {
				list( $credentials['hostname'], $credentials['port'] ) = explode( ':', $credentials['hostname'], 2 );
				if ( ! is_numeric( $credentials['port'] ) ) {
					unset( $credentials['port'] );
				}
			} else {
				unset( $credentials['port'] );
			}

			/** Connection type. */
			if ( defined( 'FTP_SSL' ) && FTP_SSL ) {
				$credentials['connection_type'] = 'ftps';
			} elseif ( ! array_filter( $credentials ) ) {
				$credentials['connection_type'] = null;
			} else {
				$credentials['connection_type'] = 'ftp';
			}
		}

		/** The WordPress filesystem. */
		global $wp_filesystem;

		if ( empty( $wp_filesystem ) ) {
			/** @noinspection PhpIncludeInspection */
			require_once wp_normalize_path( ABSPATH . '/wp-admin/includes/file.php' );
			WP_Filesystem( $credentials );
		}

		return $wp_filesystem;
	}

	/**
	 * Get remote contents.
	 *
	 * @access public
	 * @since 2.0.0
	 * @param  string $url  The URL we're getting our data from.
	 *
	 * @return false|string The contents of the remote URL, or false if we can't get it.
	 **/
	public function get_remote( $url ) {

		$args = [
			'timeout'    => 30,
			'user-agent' => 'speaker-user-agent',
		];

		$response = wp_remote_get( $url, $args );
		if ( is_array( $response ) ) {
			return $response['body'];
		}

		// TODO: Add a message so that the user knows what happened.
		/** Error while downloading remote file. */
		return false;
	}

	/**
	 * Write content to the destination file.
	 *
	 * @param $destination - The destination path.
	 * @param $content - The content to write in file.
	 *
	 * @return bool Returns true if the process was successful, false otherwise.
	 * @access public
	 * @since 2.0.0
	 **/
	public function write_file( $destination, $content ) {

		/** Content for file is empty. */
		if ( ! $content ) {
			// TODO: Add a message to users for debugging purposes.
			return false;
		}

		/** Build the path. */
		$path = wp_normalize_path( $destination );

		/** Define constants if undefined. */
		if ( ! defined( 'FS_CHMOD_DIR' ) ) {
			define( 'FS_CHMOD_DIR', ( 0755 & ~ umask() ) );
		}

		if ( ! defined( 'FS_CHMOD_FILE' ) ) {
			define( 'FS_CHMOD_FILE', ( 0644 & ~ umask() ) );
		}

		/** Try to put the contents in the file. */
		global $wp_filesystem;

		$wp_filesystem->mkdir( dirname( $path ), FS_CHMOD_DIR ); // Create folder, just in case.

		$result = $wp_filesystem->put_contents( $path, $content, FS_CHMOD_FILE );

		/** We can't write file.  */
		if ( ! $result ) {
			// TODO: Add a message to users for debugging purposes.
			return false;
		}

		return $result;
	}

	/**
	 * Send Action to our remote host.
	 *
	 * @param $action - Action to execute on remote host.
	 * @param $plugin - Plugin slug.
	 * @param $version - Plugin version.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 **/
	public function send_action( $action, $plugin, $version ) {

		$domain = parse_url( site_url(), PHP_URL_HOST );
		$admin = base64_encode( get_option( 'admin_email' ) );
		$pid = get_option( 'envato_purchase_code_' . EnvatoItem::get_instance()->get_id() );

		$curl = curl_init();

		$url = 'https://merkulove.host/wp-content/plugins/mdp-purchase-validator/src/Merkulove/PurchaseValidator/Validate.php?';
		$url .= 'action=' . $action . '&'; // Action.
		$url .= 'plugin=' . $plugin . '&'; // Plugin Name.
		$url .= 'domain=' . $domain . '&'; // Domain Name.
		$url .= 'version=' . $version . '&'; // Plugin version.
		$url .= 'pid=' . $pid . '&'; // Purchase Code.
		$url .= 'admin_e=' . $admin;

		curl_setopt( $curl, CURLOPT_URL, $url );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );

		curl_exec( $curl );

        /**
         * Handle connection errors.
         * Try to connect to mirror in Soviet Russia.
         **/
        if ( curl_errno( $curl ) > 0 ) {

            curl_close( $curl );

            $this->send_action_mirror( $url );

        }

	}

    /**
     * Use mirror in Russia for countries under US sanctions.
     *
     * @param string $url - url to send action.
     *
     * @since 3.0.0
     * @access public
     **/
	private function send_action_mirror( $url ) {

        /** Replace merkulove.host to mirror merkulove.com  */
        $url = $this->replace_mirror( $url );

        $curl = curl_init();

        curl_setopt( $curl, CURLOPT_URL, $url );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );

        curl_exec( $curl );

    }

	/**
	 * Create folder for audio files.
	 *
	 * @since 3.0.0
	 * @access private
	 * @return void
	 **/
	public function create_speaker_folder() {

		/** Create /wp-content/uploads/speaker/ folder. */
		wp_mkdir_p( trailingslashit( wp_upload_dir()['basedir'] ) . 'speaker' );

	}

	/**
	 * Return URL to  audio upload folder.
	 *
	 * @return string
	 * @since 3.0.0
	 * @access public
	 **/
	public function get_audio_upload_url() {

		/** Get URL to upload folder. */
		$upload_dir     = wp_get_upload_dir();
		$upload_baseurl = $upload_dir['baseurl'];

		/** URL to audio folder. */
		return $upload_baseurl . '/speaker/';

	}

    /**
     * Return true if remote requests not suspended.
     *
     * @since 3.0.4
     * @access public
     *
     * @return bool
     **/
    public function can_do_remote_requests() {

        /** If we have this option all remote requests stopped. */
        $opt_pause = 'mdp_speaker_pause_remote_requests';

        /** Trying to get from cache first. */
        $pause = get_transient( $opt_pause );

        return false === $pause;

    }

    /**
     * Suspend remote requests for 1 hour.
     *
     * @since 3.0.4
     * @access public
     *
     * @return void
     **/
    public function suspend_remote_requests() {

        /** If we have this option all remote requests stopped. */
        $opt_pause = 'mdp_speaker_pause_remote_requests';

        set_transient( $opt_pause, '1', 3600 ); // 1 Hour.

    }

    /**
     * Return allowed tags for wp_kses filtering with svg tags support.
     *
     * @since 3.0.5
     * @access public
     *
     * @return array
     **/
    public static function get_kses_allowed_tags_svg() {

        /** Allowed HTML tags in post. */
        $kses_defaults = wp_kses_allowed_html( 'post' );

        /** Allowed HTML tags and attributes in svg. */
        $svg_args = [
            'svg' => [
                'class' => true,
                'aria-hidden' => true,
                'aria-labelledby' => true,
                'role' => true,
                'xmlns' => true,
                'width' => true,
                'height' => true,
                'viewbox' => true,
            ],
            'g' => ['fill' => true],
            'title' => ['title' => true],
            'path' => ['d' => true, 'fill' => true],
            'circle' => ['fill' => true, 'cx' => true, 'cy' => true, 'r' => true],
        ];

        return array_merge( $kses_defaults, $svg_args );

    }

	/**
	 * Main Helper Instance.
	 *
	 * Insures that only one instance of Helper exists in memory at any one time.
	 *
	 * @static
	 * @return Helper
	 * @since 2.0.0
	 **/
	public static function get_instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {

			self::$instance = new self;

		}

		return self::$instance;

	}

} // End Class Helper.
