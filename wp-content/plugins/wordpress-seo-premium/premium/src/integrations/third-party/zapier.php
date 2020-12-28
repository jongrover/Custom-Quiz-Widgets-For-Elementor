<?php

namespace Yoast\WP\SEO\Integrations\Third_Party;

use Yoast\WP\SEO\Conditionals\Zapier_Conditional;
use Yoast\WP\SEO\Helpers\Options_Helper;
use Yoast\WP\SEO\Integrations\Integration_Interface;
use Yoast\WP\SEO\Presenters\Admin\Alert_Presenter;
use WPSEO_Shortlinker;
use WPSEO_Admin_Utils;
use WPSEO_Admin_Asset_Manager;

/**
 * Zapier integration.
 */
class Zapier implements Integration_Interface {

	/**
	 * The options helper.
	 *
	 * @var Options_Helper
	 */
	private $options;

	/**
	 * Whether Yoast SEO is connected to Zapier.
	 *
	 * @var bool
	 */
	private $is_connected = false;

	/**
	 * Represents the admin asset manager.
	 *
	 * @var WPSEO_Admin_Asset_Manager
	 */
	protected $asset_manager;

	/**
	 * Returns the conditionals based in which this loadable should be active.
	 *
	 * @return array
	 */
	public static function get_conditionals() {
		return [ Zapier_Conditional::class ];
	}

	/**
	 * Zapier constructor.
	 *
	 * @param Options_Helper            $options       The options helper.
	 * @param WPSEO_Admin_Asset_Manager $asset_manager The admin asset manager.
	 */
	public function __construct(
		Options_Helper $options,
		WPSEO_Admin_Asset_Manager $asset_manager
	) {
		$this->options       = $options;
		$this->asset_manager = $asset_manager;
	}

	/**
	 * Initializes the integration.
	 *
	 * This is the place to register hooks and filters.
	 *
	 * @return void
	 */
	public function register_hooks() {
		// Add the Zapier toggle to the Integrations tab in the admin.
		\add_filter( 'wpseo_integration_toggles', [ $this, 'add_integration_toggle' ] );
		\add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
	}

	/**
	 * Enqueues the required assets.
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		$this->asset_manager->enqueue_style( 'monorepo' );
		\wp_enqueue_script( 'clipboard' );
	}

	/**
	 * Adds integration toggles to the Integrations to be loaded.
	 *
	 * @param array $integration_toggles The feature toggles to extend.
	 *
	 * @return array
	 */
	public function add_integration_toggle( array $integration_toggles ) {
		$integration_toggles[] = (object) [
			/* translators: %s: Zapier. */
			'name'    => \sprintf( \esc_html__( '%s integration', 'wordpress-seo-premium' ), 'Zapier' ),
			'setting' => 'zapier_integration_active',
			'after'   => $this->toggle_after(),
			'order'   => 20, // The SEMrush integration on Free has order => 10.
		];

		return $integration_toggles;
	}

	/**
	 * Gets the stored Zapier API Key.
	 *
	 * @return string The Zapier API Key.
	 */
	private function get_zapier_api_key() {
		return 'aiudoasd678asd';
	}

	/**
	 * Returns additional content to be displayed after the Zapier toggle.
	 *
	 * @return string The additional content.
	 */
	private function toggle_after() {
		if ( $this->is_connected ) {
			return $this->get_connected_content();
		}

		return $this->get_not_connected_content();
	}

	/**
	 * Returns additional content to be displayed when Zapier is connected.
	 *
	 * @return string The additional content.
	 */
	private function get_connected_content() {
		$alert = new Alert_Presenter(
			\sprintf(
				/* translators: 1: Yoast SEO, 2: Zapier. */
				\esc_html__( '%1$s is successfully connected to %2$s! Go to your %2$s Dashboard to create and activate your first Zap.', 'wordpress-seo-premium' ),
				'Yoast SEO',
				'Zapier'
			),
			'success'
		);

		$output  = '<div id="zapier-connection">';
		$output .= $alert->present();
		$output .= '<p><a href="#somelink" class="yoast-button yoast-button--primary" type="button">' . \sprintf(
			/* translators: %s: Zapier. */
			\esc_html__( 'Go to your %s Dashboard', 'wordpress-seo-premium' ),
			'Zapier'
		) . '</a></p>';
		$output .= '<p>' . \sprintf(
			/* translators: 1: Zapier, 2: The Zapier API Key. */
			\esc_html__( '%1$s uses this API Key: %2$s', 'wordpress-seo-premium' ),
			'Zapier',
			'<strong>' . $this->get_zapier_api_key() . '</strong>'
		) . '</p>';
		$output .= '<p><button type="button" class="yoast-button yoast-button--secondary">' . \esc_html__( 'Reset API Key', 'wordpress-seo-premium' ) . '</button></p>';
		$output .= '</div>';

		return $output;
	}

	/**
	 * Returns additional content to be displayed when Zapier is not connected.
	 *
	 * @return string The additional content.
	 */
	private function get_not_connected_content() {
		$alert = new Alert_Presenter(
			\sprintf(
				/* translators: 1: Yoast SEO, 2: Zapier. */
				\esc_html__( '%1$s is not connected to %2$s. You can set up a connection below.', 'wordpress-seo-premium' ),
				'Yoast SEO',
				'Zapier'
			),
			'info'
		);

		$output  = '<div id="zapier-connection">';
		$output .= $alert->present();
		$output .= '<p>';
		$output .= \sprintf(
			/* translators: 1: Yoast SEO, 2: Zapier, 3: link start tag, 4: link closing tag. */
			\esc_html__( 'Connecting %1$s to %2$s means you can instantly share your published posts with 2000+ destinations like Twitter, Facebook and much more. %3$sRead more about %2$s%4$s.', 'wordpress-seo-premium' ),
			'Yoast SEO',
			'Zapier',
			'<a href="' . \esc_url( WPSEO_Shortlinker::get( 'https://yoa.st/2ai' ) ) . '" target="_blank">',
			WPSEO_Admin_Utils::get_new_tab_message() . '</a>'
		);
		$output .= '</p>';

		$output .= '<div class="yoast-field-group">';
		$output .= '<div class="yoast-field-group__title yoast-field-group__title--light">';
		$output .= '<label for="zapier-api-key">' . \sprintf(
			/* translators: %s: Zapier. */
			\esc_html__( '%s will ask for an API key. Use this one:', 'wordpress-seo-premium' ),
			'Zapier'
		) . '</label>';
		$output .= '</div>';
		$output .= '<div class="yoast-field-group__inline">';
		$output .= '<input class="yoast-field-group__inputfield" readonly type="text" id="zapier-api-key" name="wpseo[zapier_integration_api_key]" value="sample value">';
		$output .= '<button type="button" class="yoast-button yoast-button--secondary" id="copy-zapier-api-key" data-clipboard-target="#zapier-api-key">' . \esc_html__( 'Copy to clipboard', 'wordpress-seo-premium' ) . '</button><br />';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '<p><a href="#somelink" class="yoast-button yoast-button--primary" type="button">' . \sprintf(
			/* translators: %s: Zapier. */
			\esc_html__( 'Connect with %s', 'wordpress-seo-premium' ),
			'Zapier'
		) . '</a></p>';
		$output .= '</div>';

		return $output;
	}
}
