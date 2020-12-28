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

use DateTime;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * SINGLETON: Used to implement System report handler class
 * responsible for generating a report for the server environment.
 *
 * @since 2.0.0
 * @author Alexandr Khmelnytsky ( info@alexander.khmelnitskiy.ua )
 **/
final class ServerReporter {

	/**
	 * The one true ServerReporter.
	 *
	 * @var ServerReporter
	 * @since 2.0.0
	 **/
	private static $instance;

	/**
	 * Get server environment reporter title.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return string Report title.
	 **/
	public function get_title() {
		return 'Server Environment';
	}

	/**
	 * Retrieve the required fields for the server environment report.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Required report fields with field ID and field label.
	 **/
	public function get_fields() {
		return [
			'os'                    => esc_html__( 'Operating System', 'speaker' ),
			'software'              => esc_html__( 'Software','speaker' ),
			'mysql_version'         => esc_html__( 'MySQL version','speaker' ),
			'php_version'           => esc_html__( 'PHP Version','speaker' ),
			'write_permissions'     => esc_html__( 'Write Permissions','speaker' ),
			'zip_installed'         => esc_html__( 'ZIP Installed','speaker' ),
			'curl_installed'        => esc_html__( 'cURL Installed','speaker' ),
			/** 'allow_url_fopen'       => esc_html__( 'allow_url_fopen','speaker' ), */
			'dom_installed'         => esc_html__( 'DOM Installed','speaker' ),
			'xml_installed'         => esc_html__( 'XML Installed','speaker' ),
			'bcmath_installed'      => esc_html__( 'BCMath Installed','speaker' ),
			'mbstring_installed'    => esc_html__( 'mbstring Installed','speaker' ),
			'server_time'           => esc_html__( 'Server Time Sync','speaker' ),
		];
	}

	/**
	 * Get server operating system.
	 * Retrieve the server operating system.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array {
	 *    Report data.
	 *
	 *    @type string $value Server operating system.
	 * }
	 */
	public function get_os() {
		return [
			'value' => PHP_OS,
		];
	}

	/**
	 * Get server software.
	 * Retrieve the server software.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array {
	 *    Report data.
	 *
	 *    @type string $value Server software.
	 * }
	 **/
	public function get_software() {
		return [
			'value' => $_SERVER['SERVER_SOFTWARE'],
		];
	}

	/**
	 * Get PHP version.
	 * Retrieve the PHP version.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array {
	 *    Report data.
	 *
	 *    @type string $value          PHP version.
	 *    @type string $recommendation Minimum PHP version recommendation.
	 *    @type bool   $warning        Whether to display a warning.
	 * }
	 **/
	public function get_php_version() {
		$result = [
			'value' => PHP_VERSION,
		];

		if ( version_compare( $result['value'], '5.6', '<' ) ) {
			$result['recommendation'] = esc_html__( 'We recommend to use php 5.6 or higher', 'speaker' );

			$result['warning'] = true;
		}

		return $result;
	}

	/**
	 * Get ZIP installed.
	 * Whether the ZIP extension is installed.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array {
	 *    Report data.
	 *
	 *    @type string $value   Yes if the ZIP extension is installed, NO otherwise.
	 *    @type bool   $warning Whether to display a warning. True if the ZIP extension is installed, False otherwise.
	 * }
	 **/
	public function get_zip_installed() {
		$zip_installed = extension_loaded( 'zip' );

		return [
			'value' => $zip_installed ? '<i class="material-icons mdc-system-yes">check_circle</i>' . esc_html__('YES', 'speaker') : '<i class="material-icons mdc-system-no">error</i>' . esc_html__('NO', 'speaker' ),
			'warning' => ! $zip_installed,
		];
	}

	/**
	 * Get allow_url_fopen enabled.
	 *
	 * @since 3.0.0
	 * @access public
	 *
	 * @return array {
	 *    Report data.
	 *
	 *    @type string $value   YES if the allow_url_fopen is enabled, NO otherwise.
	 *    @type bool   $warning Whether to display a warning. True if the allow_url_fopen is enabled, False otherwise.
	 * }
	 **/
	public function get_allow_url_fopen() {

		$allow_url_fopen = ini_get( 'allow_url_fopen' );

		return [
			'value' => $allow_url_fopen ? '<i class="material-icons mdc-system-yes">check_circle</i>' . esc_html__('YES', 'speaker') : '<i class="material-icons mdc-system-no">error</i>' . esc_html__('NO', 'speaker' ),
			'warning' => ! $allow_url_fopen,
			'recommendation' => esc_html__('You must enable allow_url_fopen option in PHP. Contact the support service of your hosting provider. They know what to do.', 'speaker' )
		];
	}

	/**
	 * Get cURL installed.
	 * Whether the cURL extension is installed.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array {
	 *    Report data.
	 *
	 *    @type string $value   YES if the cURL extension is installed, NO otherwise.
	 *    @type bool   $warning Whether to display a warning. True if the cURL extension is installed, False otherwise.
	 * }
	 **/
	public function get_curl_installed() {

		$curl_installed = extension_loaded( 'curl' );

		return [
			'value' => $curl_installed ? '<i class="material-icons mdc-system-yes">check_circle</i>' . esc_html__('YES', 'speaker') : '<i class="material-icons mdc-system-no">error</i>' . esc_html__('NO', 'speaker' ),
			'warning' => ! $curl_installed,
			'recommendation' => esc_html__('You must enable CURL (Client URL Library) in PHP. Contact the support service of your hosting provider. They know what to do.', 'speaker' )
		];
	}

	/**
	 * Get DOM installed.
	 * Whether the DOM extension is installed.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array {
	 *    Report data.
	 *
	 *    @type string $value   YES if the DOM extension is installed, NO otherwise.
	 *    @type bool   $warning Whether to display a warning. True if the DOM extension is installed, False otherwise.
	 * }
	 **/
	public function get_dom_installed() {

		$dom_installed = extension_loaded( 'dom' );

		return [
			'value' => $dom_installed ? '<i class="material-icons mdc-system-yes">check_circle</i>' . esc_html__('YES', 'speaker') : '<i class="material-icons mdc-system-no">error</i>' . esc_html__('NO', 'speaker' ),
			'warning' => ! $dom_installed,
			'recommendation' => esc_html__('You must enable DOM extension (Document Object Model) in PHP. It\'s used for HTML processing. Contact the support service of your hosting provider. They know what to do.', 'speaker' )
		];
	}

	/**
	 * Get XML installed.
	 * Whether the XML extension is installed.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array {
	 *    Report data.
	 *
	 *    @type string $value   YES if the XML extension is installed, NO otherwise.
	 *    @type bool   $warning Whether to display a warning. True if the XML extension is installed, False otherwise.
	 * }
	 **/
	public function get_xml_installed() {

		$xml_installed = extension_loaded( 'xml' );

		return [
			'value' => $xml_installed ? '<i class="material-icons mdc-system-yes">check_circle</i>' . esc_html__('YES', 'speaker') : '<i class="material-icons mdc-system-no">error</i>' . esc_html__('NO', 'speaker' ),
			'warning' => ! $xml_installed,
			'recommendation' => esc_html__('You must enable XML extension in PHP. It\'s used for XML processing. Contact the support service of your hosting provider. They know what to do.', 'speaker' )
		];
	}

	/**
	 * Get BCMath installed.
	 * Whether the BCMath extension is installed.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array {
	 *    Report data.
	 *
	 *    @type string $value   YES if the BCMath extension is installed, NO otherwise.
	 *    @type bool   $warning Whether to display a warning. True if the BCMath extension is installed, False otherwise.
	 * }
	 **/
	public function get_bcmath_installed() {

		$bcmath_installed = extension_loaded( 'bcmath' );

		return [
			'value' => $bcmath_installed ? '<i class="material-icons mdc-system-yes">check_circle</i>' . esc_html__('YES', 'speaker') : '<i class="material-icons mdc-system-no">error</i>' . esc_html__('NO', 'speaker' ),
			'warning' => ! $bcmath_installed,
			'recommendation' => esc_html__('You must enable BCMath extension (Arbitrary Precision Mathematics) in PHP. Contact the support service of your hosting provider. They know what to do.', 'speaker' )
		];
	}

	/**
	 * Get mbstring installed.
	 * Whether the mbstring extension is installed.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array {
	 *    Report data.
	 *
	 *    @type string $value   YES if the mbstring extension is installed, NO otherwise.
	 *    @type bool   $warning Whether to display a warning. True if the mbstring extension is installed, False otherwise.
	 * }
	 **/
	public function get_mbstring_installed() {

		$mbstring_installed = extension_loaded( 'mbstring' );

		return [
			'value' => $mbstring_installed ? '<i class="material-icons mdc-system-yes">check_circle</i>' . esc_html__('YES', 'speaker') : '<i class="material-icons mdc-system-no">error</i>' . esc_html__('NO', 'speaker' ),
			'warning' => ! $mbstring_installed,
			'recommendation' => esc_html__('You must enable mbstring extension (Multibyte String) in PHP. Contact the support service of your hosting provider. They know what to do.', 'speaker' )
		];
	}

	/**
	 * Get server time and compare it with NTP.
	 *
	 * @since 2.0.4
	 * @access public
	 *
     * @return array
	 **/
	public function get_server_time() {

		/** Get current time from google. */
		$url = 'https://www.google.com/';
		$curl = curl_init();
		curl_setopt( $curl, CURLOPT_URL, $url );
		curl_setopt( $curl, CURLOPT_NOBODY, true );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $curl, CURLOPT_HEADER, true );

        /** @noinspection CurlSslServerSpoofingInspection */
        curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );

        /** @noinspection CurlSslServerSpoofingInspection */
        curl_setopt( $curl, CURLOPT_SSL_VERIFYHOST, 0 );

		$header = curl_exec( $curl );
		$curl_errno = curl_errno( $curl );
		curl_close( $curl );

		/** On cURL Error. */
		if ( $curl_errno ) {
			$time_ok = false;
			return [
				'value' => $time_ok ? '<i class="material-icons mdc-system-yes">check_circle</i>' . esc_html__('YES', 'speaker') : '<i class="material-icons mdc-system-no">error</i>' . esc_html__('NO', 'speaker' ),
				'warning' => ! $time_ok,
				'recommendation' => esc_html__('Failed to check time synchronization on your server. Your server\'s clock must be in sync with network time protocol - NTP.', 'speaker' )
			];
		}

		/** Convert header to array. */
		$headers = $this->get_headers_from_curl_response( $header );

		$date = '';
		if ( isset( $headers['date'] ) ) {
			$date = $headers['date'];
		}

		$date = DateTime::createFromFormat( 'D, d M Y H:i:s e', $date );

		if ( ! $date ) {
			$time_ok = false;
			return [
				'value' => $time_ok ? '<i class="material-icons mdc-system-yes">check_circle</i>' . esc_html__('YES', 'speaker') : '<i class="material-icons mdc-system-no">error</i>' . esc_html__('NO', 'speaker' ),
				'warning' => ! $time_ok,
				'recommendation' => esc_html__('Failed to check time synchronization on your server. Your server\'s clock must be in sync with network time protocol - NTP.', 'speaker' )
			];
		}

		/** Time from Google. */
		$google_time = $date->format( 'Y-m-d H:i:s e' );

		/** Your Server time in 'GMT' */
		$timezone = date_default_timezone_get();
		date_default_timezone_set( 'GMT' );
		$server_time = date('Y-m-d H:i:s e');
		date_default_timezone_set( $timezone );

		$to_time = strtotime( $google_time );
		$from_time = strtotime( $server_time );
		$diff = abs($to_time - $from_time);
		$diff = (int)$diff;

		/** If time difference more than 120 sec, show warning. */
		if ( $diff > 120 ) {
			$time_ok = false;
		} else {
			$time_ok = true;
		}

		return [
			'value' => $time_ok ? '<i class="material-icons mdc-system-yes">check_circle</i>' . esc_html__('YES', 'speaker') : '<i class="material-icons mdc-system-no">error</i>' . esc_html__('NO', 'speaker' ) . '<br>Google Time: ' . $google_time . '<br>&nbsp;&nbsp;&nbsp;Local Time: ' . $server_time,
			'warning' => ! $time_ok,
			'recommendation' => esc_html__( 'Your server\'s clock is not in sync with network time protocol - NTP. Contact the support service of your hosting provider. They know what to do.', 'speaker' )
		];

	}

	/**
	 * Convert header string to array of header values.
	 * @see https://stackoverflow.com/a/10590242
	 *
	 * @param $header_text string - Header from cURL request.
	 *
	 * @return array
	 * @since 2.0.4
	 * @access private
	 **/
	private function get_headers_from_curl_response( $header_text ) {

		/** Everybody out of the dusk. */
		$header_text = json_encode( $header_text );

		$headers = [];
		foreach ( explode( '\\r\\n', $header_text ) as $i => $line ) {

			/** Skip garbage. */
			if (  strlen( $line ) < 3 ) { continue; }

			if ( $i === 0 ) {
				$headers['http_code'] = $line;
			} else {
				list ( $key, $value ) = explode( ': ', $line );
				$headers[strtolower( $key )] = $value;
			}
		}

		return $headers;
	}

	/**
	 * Get MySQL version.
	 * Retrieve the MySQL version.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array {
	 *    Report data.
	 *
	 *    @type string $value MySQL version.
	 * }
	 **/
	public function get_mysql_version() {
		global $wpdb;

		$db_server_version = $wpdb->get_results( "SHOW VARIABLES WHERE `Variable_name` IN ( 'version_comment', 'innodb_version' )", OBJECT_K );

		return [
			'value' => $db_server_version['version_comment']->Value . ' v' . $db_server_version['innodb_version']->Value,
		];
	}

	/**
	 * Get write permissions.
	 * Check whether the required folders has writing permissions.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array {
	 *    Report data.
	 *
	 *    @type string $value   Writing permissions status.
	 *    @type bool   $warning Whether to display a warning. True if some required
	 *                          folders don't have writing permissions, False otherwise.
	 * }
	 **/
	public function get_write_permissions() {

		$paths_to_check = [
			ABSPATH => esc_html__('WordPress root directory', 'speaker' )
		];

		$write_problems = [];

		$wp_upload_dir = wp_upload_dir();

		if ( $wp_upload_dir['error'] ) {
			$write_problems[] = esc_html__('WordPress root uploads directory', 'speaker' );
		}

		$speaker_uploads_path = $wp_upload_dir['basedir'] . '/speaker';

		if ( is_dir( $speaker_uploads_path ) ) {
			$paths_to_check[ $speaker_uploads_path ] = esc_html__('Speaker uploads directory', 'speaker' );
		}

		$htaccess_file = ABSPATH . '/.htaccess';

		if ( file_exists( $htaccess_file ) ) {
			$paths_to_check[ $htaccess_file ] = esc_html__('.htaccess file', 'speaker' );
		}

		foreach ( $paths_to_check as $dir => $description ) {

			if ( ! is_writable( $dir ) ) {
				$write_problems[] = $description;
			}
		}

		if ( $write_problems ) {
			$value = '<i class="material-icons mdc-system-no">error</i>' . esc_html__('There are some writing permissions issues with the following directories/files:', 'speaker' ) . "<br> &nbsp;&nbsp;&nbsp;&nbsp;– ";

			$value .= implode( "<br> &nbsp;&nbsp;&nbsp;&nbsp;– ", $write_problems );
		} else {
			$value = '<i class="material-icons mdc-system-yes">check_circle</i>' . esc_html__('All right', 'speaker' );
		}

		return [
			'value' => $value,
			'warning' => ! ! $write_problems,
		];
	}

	/**
	 * Get report.
	 * Retrieve the report with all it's containing fields.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array {
	 *    Report fields.
	 *
	 *    @type string $name Field name.
	 *    @type string $label Field label.
	 * }
	 **/
	final public function get_report() {

		$result = [];

		foreach ( $this->get_fields() as $field_name => $field_label ) {
			$method = 'get_' . $field_name;

			$reporter_field = [
				'name' => $field_name,
				'label' => $field_label,
			];

            /** @noinspection SlowArrayOperationsInLoopInspection */
            $reporter_field = array_merge( $reporter_field, $this->$method() );
			$result[ $field_name ] = $reporter_field;
		}

		return $result;
	}

	/**
	 * Main ServerReporter Instance.
	 *
	 * Insures that only one instance of ServerReporter exists in memory at any one time.
	 *
	 * @static
	 * @return ServerReporter
	 * @since 2.0.0
	 **/
	public static function get_instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {

			self::$instance = new self;

		}

		return self::$instance;

	}

} // End Class ServerReporter.
