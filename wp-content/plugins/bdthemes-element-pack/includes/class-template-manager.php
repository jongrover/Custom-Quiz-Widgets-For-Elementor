<?php

namespace ElementPack\Includes;

use Elementor\Plugin;
use Elementor\Api;

class Element_Pack_Template_Manager {

	/**
	 * @var null
	 */
	private static $instance = null;

	/**
	 * @var string
	 */
	protected $option = 'ep_elements_categories';

	/**
	 * @var string
	 * Our template resources server
	 */
	public static $template_server = 'http://bdthemes.co/template-library/';

	/**
	 * Element Pack templates API route
	 *
	 * @var string
	 */
	public static $api_route = 'v1/';

	/**
	 * Get element pack prefix
	 * @return string
	 *
	 */
	public function get_prefix() {
		return 'ep_';
	}

	/**
	 * Element Pack Template ID
	 * @return string
	 */
	public function get_id() {
		return 'ep-templates';
	}

	/**
	 * template manager initializer
	 */
	public function init() {



		// Register ep-templates source
		add_action( 'elementor/init', [ $this, 'register_templates_source' ] );

		if ( defined( 'Elementor\Api::LIBRARY_OPTION_KEY' ) ) {
			// Add Element Pack templates save to elementor library options
			add_filter( 'option_' . Api::LIBRARY_OPTION_KEY, [ $this, 'prepend_categories' ] );
		}

		// Register template request to elementor ajax action
		add_action( 'elementor/ajax/register_actions', [ $this, 'register_ajax_actions' ], 20 );
	}

	/**
	 * Register Element Pack template source to elementor template manager
	 */
	public function register_templates_source() {

		require BDTEP_INC_PATH . 'class-template-library.php';

		$elementor = Plugin::instance();
		$elementor->templates_manager->register_source( 'Element_Pack_Template_Source' );

	}

	/**
	 * @return string
	 * make element pack transient category key for dynamic as per version
	 */
	public function category_transient_key() {
		return 'ep_template_categories_' . BDTEP_VER;
	}

	/**
	 * @return array|mixed
	 * get categories from element pack remote server and set to transient
	 */
	public function get_categories() {

		$categories = get_transient( $this->category_transient_key() );

		if ( ! $categories ) {
			$categories = $this->remote_get_categories();
			set_transient( $this->category_transient_key(), $categories, WEEK_IN_SECONDS );
		}

		return $categories;
	}

	/**
	 * @return array|mixed
	 * retrieve element pack categories from remote server with api route
	 */
	public function remote_get_categories() {

		$final_url = self::$template_server . self::$api_route . 'categories/';
		$response  = wp_remote_get( $final_url, [ 'timeout' => 60 ] );
		$body      = wp_remote_retrieve_body( $response );
		$body      = json_decode( $body, true );

		return !empty( $body['data'] ) ? $body['data'] : [];

	}

	/**
	 * @param $categories_data
	 * @return mixed
	 * push element pack custom categories to elementor template category
	 */
	public function prepend_categories( $categories_data ) {

		$categories_list = $this->get_categories();

		if ( !empty( $categories_list ) ) {

			$categories_data['types_data']['block']['categories'] = array_merge( $categories_list, $categories_data['types_data']['block']['categories'] );

			return $categories_data;

		} else {
			return $categories_data;
		}

	}

	/**
	 * register ajax action for get all element pack template
	 * @param $ajax
	 */
	public function register_ajax_actions( $ajax ) {
		if ( ! isset( $_REQUEST['actions'] ) ) {
			return;
		}

		$actions = json_decode( stripslashes( $_REQUEST['actions'] ), true );
		$data    = false;

		foreach ( $actions as $id => $action_data ) {
			if ( ! isset( $action_data['get_template_data'] ) ) {
				$data = $action_data;
			}
		}

		// not have data
		if ( ! $data ) { return; }

		// data is set
		if ( ! isset( $data['data'] ) ) { return; }

		$data = $data['data'];

		// don't have template id
		if ( empty( $data['template_id'] ) ) { return; }

		// not element pack template
		if ( false === strpos( $data['template_id'], $this->get_prefix() ) ) { return; }

		$ajax->register_ajax_action( 'get_template_data', [ $this, 'get_ep_template_data' ] );
	}

	/**
	 * Get element pack template data for ajax action
	 * @param $args
	 * @return mixed
	 */
	public function get_ep_template_data( $args ) {

		$source = Plugin::instance()->templates_manager->get_source( $this->get_id() );

		$data = $source->get_data( $args );

		return $data;
	}

	/**
	 * Element Pack template manager instance
	 * @return Element_Pack_Template_Manager|null
	 */
	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
}