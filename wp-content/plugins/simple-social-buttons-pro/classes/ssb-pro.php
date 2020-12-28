<?php

/**
 *  Simple Social Buttons Pro
 */

class Simple_Social_Buttons_Pro {

	public $popup_option    = '';
	public $media_option    = '';
	public $flyin_option    = '';
	public $advanced_option = '';

	/**
	 * User selected click to tweet option.
	 *
	 * @since 1.2.0
	 * @var string
	 */
	public $ctt_option = '';

	/**
	 * The name and ID of the download on WPBrigade.com for this plugin.
	 */
	const SSB_PRODUCT_NAME = 'Simple Social Buttons Pro';
	const SSB_PRODUCT_ID   = 1835;


	/**
	 * The URL of the our store.
	 */
	const SSB_SITE_URL = 'https://wpbrigade.com/';


	/**
	 * The WP options registration data key.
	 */
	const REGISTRATION_DATA_OPTION_KEY = 'ssb_pro_registration_data';


	/**
	 * Auto run function when object created.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function __construct() {

		$this->set_popup_option();
		$this->set_media_option();
		$this->set_flyin_option();
		$this->set_advanced_option();
		$this->set_ctt_option();
		$this->_includes();

		add_action( 'wp_enqueue_scripts', array( $this, 'add_scripts' ) );
		add_action( 'ssb_add_pro_submenu', array( $this, '_add_pro_submenu' ), 11 );
		add_filter( 'ssb_settings_panel', array( $this, 'settings_panel' ) );
		add_filter( 'ssb_setting_fields', array( $this, 'setting_fields' ), 10, 2 );
		// add_filter( 'ssb_positions_options', array( $this, 'positions_options' ) );
		add_filter( 'ssb_sidebar_fields', array( $this, 'sidebar_fields' ) );
		add_filter( 'ssb_inline_fields', array( $this, 'inline_fields' ) );

		add_action( 'wp_head', array( $this, 'include_popup' ) );
		add_action( 'wp_footer', array( $this, 'include_flyin' ) );
		add_action( 'admin_init', array( $this, 'init_plugin_updater' ), 0 );
		add_action( 'admin_init', array( $this, 'manage_license' ) );
		add_filter( 'the_content', array( $this, 'include_media' ), 99999 );

		add_action( 'wp_head', array( $this, 'extra_css' ), 90 );
		add_shortcode( 'SBCTT', array( $this, 'ssb_ctt_render' ) );

	}



	/**
	 * Render clcick to tweet short code.
	 *
	 * @param array $atts attriutes of the shortcode.
	 *
	 * @access public
	 * @since 1.2.0
	 * @return string
	 */
	public function ssb_ctt_render( $atts ) {
		$atts            = shortcode_atts(
			array(
				'front'       => '',
				'tweet'       => '',
				'theme'       => '',
				'hide_button' => '',
				'hide_link'   => '',
				'include_via' => 'true',
			),
			$atts,
			'SBCTT'
		);
		$extra_option    = $this->advanced_option;
		$twitter_handle  = isset( $extra_option['twitter_handle'] ) ? $extra_option['twitter_handle'] : '';
		$ctt_option      = $this->ctt_option;
		$ctt_hide_link   = isset( $ctt_option['hide_link'] ) ? $ctt_option['hide_link'] : '';
		$ctt_hide_button = isset( $ctt_option['hide_button'] ) ? $ctt_option['hide_button'] : '';

		ob_start();
		$permalink  = apply_filters( 'ssb_ctt_url', get_permalink() );
		$theme      = $atts['theme'] ? $atts['theme'] : $ctt_option['theme'];
		$front_text = $atts['front'];
		$tweet_text = $atts['tweet'] ? $atts['tweet'] : $atts['front'];
		$via        = ( 'true' == $atts['include_via'] ) ? '&via=' . $twitter_handle : '';

		// hide link.
		if ( empty( $atts['hide_link'] ) && '1' == $ctt_hide_link ) {
			$permalink = 0;
		}

		if ( 'true' == $atts['hide_link'] ) {
			$permalink = 0;
		}

		// hide button.
		$hide_button = '';
		if ( empty( $atts['hide_button'] ) && '1' == $ctt_hide_button ) {
				$hide_button = 'hide-button';
		}

		if ( 'true' == $atts['hide_button'] ) {
			$hide_button = 'hide-button';
		}

		// include via.
		if ( '1' == $ctt_option['include_via'] ) {
			$via    = '&via=' . $twitter_handle;
		}
		if ( 'true' !== $atts['include_via'] ) {
			$via = '';
		}
		$url = "https://twitter.com/share?text=$tweet_text&url=$permalink" . $via;

		?>
		<div class="ssb-ctt-wrapper <?php esc_attr_e( $hide_button ); ?> <?php esc_attr_e( $theme ); ?> ">
			<a data-href="<?php echo $url; ?>" rel="nofollow"
				onclick="javascript:window.open(this.dataset.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
				<span class="ssb-ctt">
					<span class="ssb-ctt-text">
						<?php echo $front_text; ?>
					</span>
					<span class="ssb-ctt-btn">
						<?php echo __( 'Click to tweet', 'simple-social-button-pro' ); ?>

						<svg version="1.1" id="twitter_icon_ctt" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
							x="0px" y="0px" width="17.1px" height="14px" viewBox="0 0 17.1 14" enable-background="new 0 0 17.1 14"
							xml:space="preserve">
							<g>
								<path fill="" d="M8.7,1.7c0.7-1.2,2.1-1.9,3.5-1.7c0.9,0.1,1.5,0.6,2.2,1.1c0.7-0.2,1.5-0.5,2.2-0.8
									c-0.3,0.7-0.8,1.4-1.5,1.9c0.7-0.1,1.3-0.4,2-0.5c-0.5,0.7-1.2,1.2-1.8,1.8c0.1,2.5-0.7,5.1-2.4,7C11.2,12.7,8.2,14,5.4,14
									c-1.9,0.1-3.8-0.6-5.4-1.5c1.8,0.2,3.7-0.4,5.1-1.5c-1.5,0-2.7-1.1-3.2-2.4c0.5,0,1,0,1.5,0C2.6,8.3,1.8,7.7,1.2,6.8
									C0.8,6.2,0.7,5.5,0.6,4.9c0.5,0.2,1,0.4,1.5,0.5C1.5,4.7,0.8,3.9,0.7,3C0.5,2.2,0.8,1.4,1.1,0.6c0.7,0.7,1.4,1.5,2.2,2
									c1.5,1,3.2,1.6,5,1.7C8.3,3.4,8.2,2.5,8.7,1.7z" />
							</g>
						</svg>
					</span>
				</span>
			</a>
		</div>
		<?php
		$output = ob_get_clean();
		return $output;

	}

		/**
		 * Setting popup setting.
		 *
		 * @access public
		 * @since 1.0.0
		 * @return void
		 */
	public function set_popup_option() {
		$this->popup_option = get_option( 'ssb_popup' );
	}

	/**
	 * Setting media options.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function set_media_option() {
		$this->media_option = get_option( 'ssb_media' );
	}

	/**
	 * Setting flyin options.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function set_flyin_option() {
		$this->flyin_option = get_option( 'ssb_flyin' );
	}

	/**
	 * Setting advanced options.
	 *
	 * @access public
	 * @since 1.0.5
	 * @return void
	 */
	public function set_advanced_option() {
		$this->advanced_option = get_option( 'ssb_advanced' );
	}

		/**
		 * Setting popup setting.
		 *
		 * @access public
		 * @since 1.0.0
		 * @return void
		 */
	public function set_ctt_option() {
		$this->ctt_option = get_option( 'ssb_click_to_tweet' );
		// if some one upgrading to 1.2.0 and click to tweet settings not saved.
		if ( ! $this->ctt_option ) {
			ssb_pro_default_settings();
		}

	}

	/**
	 * Include necessary files
	 *
	 * @access      private
	 * @since       1.0.0
	 * @return      void
	 */
	private function _includes() {

		include_once SSB_PRO_PLUGIN_DIR . '/inc/SSB_PRO_SL_Plugin_Updater.php';
	}


	/**
	 * Add Fron-End Scripts.
	 *
	 * @access public
	 * @since 1.0
	 * @return void
	 */
	public function add_scripts() {

		wp_enqueue_style( 'ssb-pro-front-style', plugins_url( 'assets/css/front.css', SSB_PRO_ROOT_PATH ), array(), SSB_PRO_VERSION );
		wp_enqueue_script( 'ssb-pro-front-script', plugins_url( 'assets/js/front.js', SSB_PRO_ROOT_PATH ), array( 'jquery' ), SSB_PRO_VERSION );
		wp_localize_script(
			'ssb-pro-front-script',
			'ssb_settings',
			array(
				'trigger_before_leaving'  => $this->_get_settings( 'popup', 'trigger_before_leaving', '0' ),
				'trigger_after_scrolling' => $this->_get_settings( 'popup', 'trigger_after_scrolling', '0' ),
				'media_share'             => $this->_get_settings( 'media', 'media_share_description', 'title' ),
				'fb_id'                   => $this->_get_settings( 'advanced', 'facebook_app_id', '' ),
				'flyin_time_interval'     => $this->_get_settings( 'flyin', 'time_interval', '' ),
				'popup_time_interval'     => $this->_get_settings( 'popup', 'time_interval', '' ),
			)
		);
	}


	/**
	 * Add Pro SubMenu.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function _add_pro_submenu() {

		add_submenu_page(
			'simple-social-buttons',
			esc_html__( 'Activate your license to get automatic plugin updates and premium support.', 'simple-social-buttons' ),
			' <b style="color:#5fcf80">' . esc_html__( 'License Manager', 'simple-social-buttons-pro' ) . '</b>',
			'edit_posts',
			'ssb-lincense',
			array(
				__CLASS__,
				'_pro_submenu_page',
			)
		);
	}


	/**
	 * Include files for Pro submenu pages
	 *
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public static function _pro_submenu_page() {

		$screen = get_current_screen();

		if ( strpos( $screen->base, 'ssb-lincense' ) !== false ) {

			include_once SSB_PRO_PLUGIN_DIR . '/inc/license-manager.php';
		}
	}


	/**
	 * Get options
	 *
	 * @param  string $section Section Name.
	 * @param  string $value   Field Name.
	 * @param  string $default Default Value.
	 *
	 * @param string $name
	 * @since 1.0
	 * @return mixed
	 */
	public function _get_settings( $section, $value, $default = false ) {
		$section = $section . '_option';
		$_arr    = $this->$section;
		return isset( $_arr[ $value ] ) && ! empty( $_arr[ $value ] ) ? $_arr[ $value ] : $default;
	}

	/**
	 * Include Custom Css.
	 * User css customization css added.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function extra_css() {
		include_once SSB_PRO_PLUGIN_DIR . '/inc/custom-css.php';
	}


	/**
	 * Add Share Buttons on Media.
	 *
	 * @since 1.0
	 */
	public function include_media( $content ) {

		global $_ssb_pr;
		// Return Content if hide ssb.
		if ( get_post_meta( get_the_id(), $_ssb_pr->hideCustomMetaKey, true ) == 'true' ) {
			return $content;
		}

		if ( isset( $_ssb_pr->selected_position['media'] ) && in_array( $_ssb_pr->get_post_type(), $this->_get_settings( 'media', 'posts', array() ) ) ) {

			preg_match_all( '/<img [^>]*>/s', $content, $images_array );
			foreach ( $images_array[0] as $image ) {
				if ( false !== strpos( $image, 'class="ngg_' ) ) {
					continue;
				}

				preg_match( '@src="([^"]+)"@', $image, $image_src );

				$extra_class = 'simplesocialbuttons-media-' . $this->media_option['display_position'];
				if ( $this->media_option['hide_mobile'] ) {
					$extra_class .= ' simplesocialbuttons-mobile-hidden'; }

				$_selected_network = apply_filters( 'ssb_media_social_networks', $_ssb_pr->selected_networks );

				$extra_data = $extra_data       = array(
					'class'    => $extra_class,
					'position' => 'media',
				);

				$icons       = $_ssb_pr->generate_buttons_code( $_selected_network, false, false, $extra_data );
				$replacement = '<div class="ssb_social_media_wrapper">' . $image . $icons . '</div>';
				$content     = str_replace( $image, $replacement, $content );
			}
		}
		return $content;
	}


	/**
	 * Add PopUp Settings.
	 *
	 * @access public
	 * @since 1.0
	 * @return void
	 */
	public function include_popup() {

		global $_ssb_pr;

		// Return Content if hide ssb.
		if ( get_post_meta( get_the_id(), $_ssb_pr->hideCustomMetaKey, true ) == 'true' ) {
			return;
		}

		if ( isset( $_ssb_pr->selected_position['popup'] ) && in_array( $_ssb_pr->get_post_type(), $this->_get_settings( 'popup', 'posts', array() ) ) ) {

			$show_total = false;
			$show_count = false;
			// Show Total at the end.
			if ( $this->popup_option['total_share'] ) {
				$show_total = true;
			}

			$child_class = '';
			if ( $this->popup_option['share_counts'] ) {
				$show_count  = true;
				$child_class = 'ssb_counter-activate';
			}
			$extra_class = '';
			$title       = $this->_get_settings( 'popup', 'title', 'Simple Share Buttons' );
			$message     = $this->_get_settings( 'popup', 'message' );

			$_selected_network = apply_filters( 'ssb_popup_social_networks', $_ssb_pr->selected_networks );
			if ( $this->popup_option['hide_mobile'] ) {
				$extra_class .= ' simplesocialbuttons-mobile-hidden ';
			}
			$extra_class .= 'simplesocialbuttons-popup-' . $this->popup_option['animation']; // Animation class.

			$ssb_buttonscode  = '<div class="simplesocialbuttons-popup ssb_hidden ' . $extra_class . '" data-ssbscroll="' . $this->popup_option['trigger_after_scrolling_value'] . '">';
			$ssb_buttonscode .= '<div class="simplesocialbuttons__popup__overlay"></div>';
			$ssb_buttonscode .= '<div class="simplesocialbuttons__content">';
			$ssb_buttonscode .= '<div class="simplesocialbuttons__close">×</div>';
			$ssb_buttonscode .= '<h2>' . $title . '</h2>';
			$ssb_buttonscode .= '<p>' . $message . '</p>';
			$extra_class      = $child_class . ' simplesocialbuttons-align-' . $this->popup_option['icon_alignment'];
			$extra_data       = array(
				'class'    => $extra_class,
				'position' => 'popup',
			);
			$ssb_buttonscode .= $_ssb_pr->generate_buttons_code( $_selected_network, $show_count, $show_total, $extra_data ) . "\n";
			$ssb_buttonscode .= '</div>' . "\n";
			$ssb_buttonscode .= '</div>' . "\n";
			echo $ssb_buttonscode;
		}
	}

	/**
	 * Add Share FlyIn Settings.
	 *
	 * @access public
	 * @since 1.0
	 * @return private
	 */
	public function include_flyin() {

		global $_ssb_pr;

		// Return Content if hide ssb.
		if ( get_post_meta( get_the_id(), $_ssb_pr->hideCustomMetaKey, true ) == 'true' ) {
			return;
		}

		if ( isset( $_ssb_pr->selected_position['flyin'] ) && in_array( $_ssb_pr->get_post_type(), $this->_get_settings( 'flyin', 'posts', array() ) ) ) {

			$show_total = false;
			$show_count = false;
			// Show Total at the end.
			if ( $this->flyin_option['total_share'] ) {
				$show_total = true;
			}

			$child_class = '';
			if ( $this->flyin_option['share_counts'] ) {
				$show_count  = true;
				$child_class = ' ssb_counter-activate ';
			}

			$extra_class = '';
			$title       = $this->_get_settings( 'flyin', 'title', 'Simple Social FlyIn' );
			$message     = $this->_get_settings( 'flyin', 'message' );

			if ( $this->flyin_option['hide_mobile'] ) {
				$extra_class .= ' simplesocialbuttons-mobile-hidden ';
			}
			$extra_class .= 'simplesocialbuttons-flyin-' . $this->flyin_option['animation']; // Animation class.

			$ssb_buttonscode  = '<div class="simplesocialbuttons-flyin simplesocialbuttons-flyin-hide simplesocialbuttons-flyin-' . $this->flyin_option['postion'] . ' ' . $extra_class . '">';
			$ssb_buttonscode .= '<div class="simplesocialflyin__close">×</div>';
			$ssb_buttonscode .= '<h2>' . $title . '</h2>';
			$ssb_buttonscode .= '<p>' . $message . '</p>';

			$_selected_network = apply_filters( 'ssb_flyin_social_networks', $_ssb_pr->selected_networks );
			$extra_class       = $child_class . 'simplesocialbuttons-align-' . $this->flyin_option['icon_alignment'];
			$extra_data        = array(
				'class'    => $extra_class,
				'position' => 'flyin',
			);
			$ssb_buttonscode  .= $_ssb_pr->generate_buttons_code( $_selected_network, $show_count, $show_total, $extra_data ) . "\n";
			$ssb_buttonscode  .= '</div>' . "\n";

			echo $ssb_buttonscode;

		}
	}

	/**
	 * Add Custom Colors Fields for Inline Buttons Settings.
	 *
	 * @param  array $fields Array of old fields.
	 * @return array  Return Array of new + old fields.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return array
	 */
	public function inline_fields( $fields ) {

		$fields     = $this->clean_add( $fields );
		$new_fields = array(
			array(
				'name'     => 'use_custom_color',
				'label'    => __( 'Use Custom Colors', 'simple-social-buttons-pro' ),
				'desc'     => '<h4>Color Settings</h4><p>If Background or Hover Background is not defined below, the default network colors will be used for that element.</p>',
				'type'     => 'ssb_checkbox',
				'priority' => '65',

			),
			array(
				'name'     => 'background_color',
				'label'    => __( 'Background Color', 'simple-social-buttons-pro' ),
				'type'     => 'ssb_color',
				'default'  => '',
				'priority' => '70',
			),
			array(
				'name'     => 'hover_background_color',
				'label'    => __( 'Hover Background Color', 'simple-social-buttons-pro' ),
				'type'     => 'ssb_color',
				'default'  => '',
				'priority' => '75',
			),
			array(
				'name'     => 'icon_color',
				'label'    => __( 'Icon Color', 'simple-social-buttons-pro' ),
				'type'     => 'ssb_color',
				'default'  => '',
				'priority' => '80',
			),
			array(
				'name'     => 'hover_icon_color',
				'label'    => __( 'Hover Icon Color', 'simple-social-buttons-pro' ),
				'type'     => 'ssb_color',
				'default'  => '',
				'priority' => '85',
			),
		);

		$fields = array_merge( $fields, $new_fields );

		usort( $fields, array( $this, 'sort_array' ) );

		return $fields;

	}

	/**
	 * Add Custom Colors Fields for SideBar Buttons Settings.
	 *
	 * @param  array $fields Array of old fields.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return mixed  Return Array of new + old fields.
	 */

	public function sidebar_fields( $fields ) {

		$fields     = $this->clean_add( $fields );
		$new_fields = array(
			array(
				'name'     => 'use_custom_color',
				'label'    => __( 'Use Custom Colors', 'simple-social-buttons-pro' ),
				'desc'     => '<h4>Color Settings</h4><p>If Background or Hover Background is not defined below, the default network colors will be used for that element.</p>',
				'type'     => 'ssb_checkbox',
				'priority' => '50',
			),
			array(
				'name'     => 'background_color',
				'label'    => __( 'Background Color', 'simple-social-buttons-pro' ),
				'type'     => 'ssb_color',
				'default'  => '',
				'priority' => '55',
			),
			array(
				'name'     => 'hover_background_color',
				'label'    => __( 'Hover Background Color', 'simple-social-buttons-pro' ),
				'type'     => 'ssb_color',
				'default'  => '',
				'priority' => '60',
			),
			array(
				'name'     => 'icon_color',
				'label'    => __( 'Icon Color', 'simple-social-buttons-pro' ),
				'type'     => 'ssb_color',
				'default'  => '',
				'priority' => '65',
			),
			array(
				'name'     => 'hover_icon_color',
				'label'    => __( 'Hover Icon Color', 'simple-social-buttons-pro' ),
				'type'     => 'ssb_color',
				'default'  => '',
				'priority' => '70',
			),
		);

		$fields = array_merge( $fields, $new_fields );

		usort( $fields, array( $this, 'sort_array' ) );

		return $fields;
	}


	/**
	 * Register new panel for position.
	 *
	 * @param array $positions_options existing position.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return mixed  Return Array of new + old fields.
	 */
	public function positions_options( $positions_options ) {

		$new_position = array(
			'media' => 'Media',
			'popup' => 'Popup',
			'flyin' => 'Fly In',
		);

		return array_merge( $positions_options, $new_position );
	}

	/**
	 * Add new setting section for new positions.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return mixed Return Array of new + old section.
	 */
	public function settings_panel( $old_sections ) {

		$pro_section = array(
			array(
				'id'       => 'ssb_click_to_tweet',
				'title'    => __( 'Click To Tweet', 'simple-social-buttons-pro' ),
				'priority' => '100',
			),
		);

		return array_merge( $old_sections, $pro_section );
	}

	/**
	 * Add new settings.
	 *
	 * @param array $setting_fields Setting fields.
	 * @param array $post_types Post fields.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return mixed array of settings
	 */
	public function setting_fields( $setting_fields, $post_types ) {
		$new_fields = array(
			'ssb_media'          => array(
				array(
					'name'    => 'display_position',
					'label'   => __( 'Position', 'simple-social-buttons-pro' ),
					'desc'    => __( '<h4>Display Settings</h4>', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_select',
					'default' => 'top-left',
					'options' => array(
						'top-left'      => 'Top Left',
						'top-right'     => 'Top Right',
						'top-center'    => 'Top Center',
						'bottom-left'   => 'Bottom left',
						'bottom-right'  => 'Bottom Right',
						'bottom-center' => 'Bottom Center',
					),
				),
				array(
					'name'  => 'icon_space',
					'label' => __( 'Add Icon Spacing', 'simple-social-buttons-pro' ),
					'type'  => 'ssb_checkbox',
				),
				array(
					'name'              => 'icon_space_value',
					'type'              => 'ssb_text',
					'label'             => 'Enter the Space in Pixel',
					'placeholder'       => '5px',
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'name'  => 'hide_mobile',
					'label' => __( 'Hide On Mobile Devices', 'simple-social-buttons-pro' ),
					'type'  => 'ssb_checkbox',
				),
				array(
					'name'  => 'use_custom_color',
					'label' => __( 'Use Custom Colors', 'simple-social-buttons-pro' ),
					'desc'  => '<h4>Color Settings</h4><p>If Background or Hover Background is not defined below, the default network colors will be used for that element.</p>',
					'type'  => 'ssb_checkbox',
				),
				array(
					'name'    => 'background_color',
					'label'   => __( 'Background Color', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_color',
					'default' => '',
				),
				array(
					'name'    => 'hover_background_color',
					'label'   => __( 'Hover Background Color', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_color',
					'default' => '',
				),
				array(
					'name'    => 'icon_color',
					'label'   => __( 'Icon Color', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_color',
					'default' => '',
				),
				array(
					'name'    => 'hover_icon_color',
					'label'   => __( 'Hover Icon Color', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_color',
					'default' => '',
				),
				array(
					'name'    => 'media_share_description',
					'label'   => __( 'Media Share Description', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_select',
					'default' => 'title',
					'options' => array(
						'title'     => 'Page/Post Title',
						'image-alt' => 'Image `alt` attribute',
					),
				),
				array(
					'name'    => 'posts',
					'label'   => __( 'Post type Settings', 'simple-social-buttons-pro' ),
					'desc'    => __( 'Multi checkbox description', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_post_types',
					'default' => array(
						'post' => 'post',
						'page' => 'page',
					),
					'options' => $post_types,
				),
			),
			'ssb_popup'          => array(
				array(
					'name'              => 'title',
					'desc'              => __( '<h4>Display Settings</h4>	', 'simple-social-buttons-pro' ),
					'type'              => 'ssb_text',
					'label'             => 'Title',
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'name'  => 'message',
					'label' => __( 'Message', 'simple-social-buttons-pro' ),
					'type'  => 'ssb_textarea',
				),
				array(
					'name'    => 'icon_alignment',
					'label'   => __( 'Icon Alignment', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_select',
					'default' => 'left',
					'options' => array(
						'left'     => 'Left',
						'centered' => 'Centered',
						'right'    => 'Right',
					),
				),
				array(
					'name'    => 'animation',
					'label'   => __( 'Animation', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_select',
					'default' => 'no-animation',
					'options' => array(
						'no-animation' => 'No',
						'scaleup'      => 'Scale Up',
						'scaledown'    => 'Scale Down',
						'up'           => 'Up',
						'down'         => 'Down',
						'fade'         => 'Fade In',
					),
				),
				array(
					'name'              => 'time_interval',
					'type'              => 'ssb_text',
					'label'             => 'Time Interval (Minutes)',
					'sanitize_callback' => 'sanitize_text_field',
					'placeholder'       => '1440',
				),
				array(
					'name'  => 'trigger_before_leaving',
					'label' => __( 'Trigger Before Leaving', 'simple-social-buttons-pro' ),
					'type'  => 'ssb_checkbox',
				),
				array(
					'name'  => 'trigger_after_scrolling',
					'label' => __( 'Trigger After Scrolling', 'simple-social-buttons-pro' ),
					'type'  => 'ssb_checkbox',
				),
				array(
					'name'              => 'trigger_after_scrolling_value',
					'type'              => 'ssb_text',
					'label'             => 'Percentage Down The Page',
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'name'  => 'share_counts',
					'label' => __( 'Display Share Counts', 'simple-social-buttons-pro' ),
					'type'  => 'ssb_checkbox',
					'help'  => __( '<p id="share-count-message" > For Facebook share count you need to add Facebook App id and secret in Advance settings tab. <br> Also For Twitter share count you need to connect your site with <a href="https://www.twitcount.com" target="_blank">twitcount.com</a> </p>', 'simple-social-buttons' ),
				),
				array(
					'name'  => 'total_share',
					'label' => __( 'Display Total Shares', 'simple-social-buttons-pro' ),
					'type'  => 'ssb_checkbox',
				),
				array(
					'name'  => 'icon_space',
					'label' => __( 'Add Icon Spacing', 'simple-social-buttons-pro' ),
					'type'  => 'ssb_checkbox',
				),
				array(
					'name'              => 'icon_space_value',
					'type'              => 'ssb_text',
					'label'             => 'Enter the Space in Pixel',
					'placeholder'       => '5px',
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'name'  => 'hide_mobile',
					'label' => __( 'Hide On Mobile Devices', 'simple-social-buttons-pro' ),
					'type'  => 'ssb_checkbox',
				),
				array(
					'name'  => 'use_custom_color',
					'label' => __( 'Use Custom Colors', 'simple-social-buttons-pro' ),
					'desc'  => '<h4>Color Settings</h4><p>If Background or Hover Background is not defined below, the default network colors will be used for that element.</p>',
					'type'  => 'ssb_checkbox',
				),
				array(
					'name'    => 'box_background_color',
					'label'   => __( 'Box Background Color', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_color',
					'default' => '',
				),
				array(
					'name'    => 'box_text_color',
					'label'   => __( 'Box Text Color', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_color',
					'default' => '',
				),
				array(
					'name'    => 'background_color',
					'label'   => __( 'Background Color', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_color',
					'default' => '',
				),
				array(
					'name'    => 'hover_background_color',
					'label'   => __( 'Hover Background Color', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_color',
					'default' => '',
				),
				array(
					'name'    => 'icon_color',
					'label'   => __( 'Icon Color', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_color',
					'default' => '',
				),
				array(
					'name'    => 'hover_icon_color',
					'label'   => __( 'Hover Icon Color', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_color',
					'default' => '',
				),
				array(
					'name'    => 'posts',
					'label'   => __( 'Post type Settings', 'simple-social-buttons-pro' ),
					'desc'    => __( 'Multi checkbox description', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_post_types',
					'default' => array(
						'post' => 'post',
						'page' => 'page',
					),
					'options' => $post_types,
				),
			),
			'ssb_flyin'          => array(
				array(
					'name'              => 'title',
					'desc'              => __( '<h4>Display Settings</h4>	', 'simple-social-buttons-pro' ),
					'type'              => 'ssb_text',
					'label'             => 'Title',
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'name'  => 'message',
					'label' => __( 'Message', 'simple-social-buttons-pro' ),
					'type'  => 'ssb_textarea',
				),
				array(
					'name'    => 'postion',
					'label'   => __( 'Position', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_select',
					'deafult' => 'bottom-right',
					'options' => array(
						'bottom-right' => 'Bottom Right',
						'bottom-left'  => 'Bottom Left',
					),
				),
				array(
					'name'    => 'animation',
					'label'   => __( 'Animation', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_select',
					'default' => 'no-animation',
					'options' => array(
						'no-animation' => 'No',
						'bottom-in'    => 'From bottom',
						'top-in'       => 'From top',
						'left-in'      => 'From left',
						'right-in'     => 'From right',
						'fade-in'      => 'Fade In',
					),
				),
				array(
					'name'  => 'share_counts',
					'label' => __( 'Display Share Counts', 'simple-social-buttons-pro' ),
					'type'  => 'ssb_checkbox',
					'help'  => __( '<p id="share-count-message" > For Facebook share count you need to add Facebook App id and secret in Advance settings tab. <br> Also For Twitter share count you need to connect your site with <a href="https://www.twitcount.com" target="_blank">twitcount.com</a> </p>', 'simple-social-buttons' ),
				),
				array(
					'name'              => 'time_interval',
					'type'              => 'ssb_text',
					'label'             => 'Time Interval (Minutes)',
					'sanitize_callback' => 'sanitize_text_field',
					'placeholder'       => '1440',
				),
				array(
					'name'  => 'total_share',
					'label' => __( 'Display Total Shares', 'simple-social-buttons-pro' ),
					'type'  => 'ssb_checkbox',
				),
				array(
					'name'  => 'icon_space',
					'label' => __( 'Add Icon Spacing', 'simple-social-buttons-pro' ),
					'type'  => 'ssb_checkbox',
				),
				array(
					'name'              => 'icon_space_value',
					'type'              => 'ssb_text',
					'label'             => 'Enter the Space in Pixel',
					'placeholder'       => '5px',
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'name'    => 'icon_alignment',
					'label'   => __( 'Icon Alignment', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_select',
					'default' => 'left',
					'options' => array(
						'left'     => 'Left',
						'centered' => 'Centered',
						'right'    => 'Right',
					),
				),
				array(
					'name'  => 'hide_mobile',
					'label' => __( 'Hide On Mobile Devices', 'simple-social-buttons-pro' ),
					'type'  => 'ssb_checkbox',
				),
				array(
					'name'  => 'use_custom_color',
					'label' => __( 'Use Custom Colors', 'simple-social-buttons-pro' ),
					'desc'  => '<h4>Color Settings</h4><p>If Background or Hover Background is not defined below, the default network colors will be used for that element.</p>',
					'type'  => 'ssb_checkbox',
				),
				array(
					'name'    => 'box_background_color',
					'label'   => __( 'Box Background Color', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_color',
					'default' => '',
				),
				array(
					'name'    => 'box_text_color',
					'label'   => __( 'Box Text Color', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_color',
					'default' => '',
				),
				array(
					'name'    => 'background_color',
					'label'   => __( 'Background Color', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_color',
					'default' => '',
				),
				array(
					'name'    => 'hover_background_color',
					'label'   => __( 'Hover Background Color', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_color',
					'default' => '',
				),
				array(
					'name'    => 'icon_color',
					'label'   => __( 'Icon Color', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_color',
					'default' => '',
				),
				array(
					'name'    => 'hover_icon_color',
					'label'   => __( 'Hover Icon Color', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_color',
					'default' => '',
				),
				array(
					'name'    => 'posts',
					'label'   => __( 'Post type Settings', 'simple-social-buttons-pro' ),
					'desc'    => __( 'Multi checkbox description', 'simple-social-buttons-pro' ),
					'type'    => 'ssb_post_types',
					'default' => array(
						'post' => 'post',
						'page' => 'page',
					),
					'options' => $post_types,
				),
			),
			'ssb_click_to_tweet' => array(
				array(
					'name'     => 'theme',
					'label'    => __( 'Design', 'simple-social-buttons' ),
					'type'     => 'ssb_select',
					'default'  => 'twitter-round',
					'options'  => array(
						'simple-twitter'    => 'Simple',
						'twitter-round'     => 'Round',
						'twitter-dark'      => 'Dark',
						'twitter-side-line' => 'Side line',
						''                  => 'Own Style',
					),
					'priority' => '5',
				),
				array(
					'name'     => 'hide_button',
					'label'    => __( 'Hide Tweet Button', 'simple-social-buttons-pro' ),
					'type'     => 'ssb_checkbox',
					'priority' => '10',
				),
				array(
					'name'     => 'hide_link',
					'label'    => __( 'Exclude Page Link', 'simple-social-buttons-pro' ),
					'type'     => 'ssb_checkbox',
					'priority' => '15',
				),
				array(
					'name'     => 'include_via',
					'label'    => __( 'Include via', 'simple-social-buttons-pro' ),
					'type'     => 'ssb_checkbox',
					'default'  => 1,
					'help'     => '<span class="ssb_uninstall_data">Twitter username from SSB Settings Advanced tab will be appended to the end of the Tweet with the text “via @username”.</span>',
					'priority' => '20',
				),
			),
		);

		return array_merge( $setting_fields, $new_fields );
	}

	/**
	 * Remove Advertisement.
	 *
	 * @param array $fields  Settings fields.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return array settings fields.
	 */
	public function clean_add( $fields ) {
		$go_pro_index = array_search( 'go_pro', array_column( $fields, 'name' ) );
		unset( $fields[ $go_pro_index ] );
		return $fields;
	}


	/**
	 * Initialize the plugin updater class.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function init_plugin_updater() {
		// Skip the plugn updater init, if the plugin is not registered, or if the license has expired.
		if ( ! $this->is_registered() || $this->has_license_expired() ) {
			// return false;
		}

		// Require the updater class, if not already present.
		if ( ! class_exists( 'SSB_PRO_SL_Plugin_Updater' ) ) {
			require_once SSB_PRO_PLUGIN_DIR . 'inc/SSB_PRO_SL_Plugin_Updater.php';
		}

		// Retrieve our license key from the DB.
		$license_key = $this->get_registered_license_key();

		// Setup the updater.
		$edd_updater = new SSB_PRO_SL_Plugin_Updater(
			self::SSB_SITE_URL,
			SSB_PRO_ROOT_PATH,
			array(
				'version' => SSB_PRO_VERSION,
				'license' => $license_key,
				'item_id' => self::SSB_PRODUCT_ID,
				'author'  => 'captian',
				'beta'    => false,
			)
		);
	}


	 // function ssb_pro_sanitize_license( $new ) {
		// $old = get_option( 'ssb_pro_license_key' );
		// if( $old && $old != $new ) {
		// delete_option( 'ssb_pro_license_status' ); // new license has been entered, so must reactivate
		// }
		// return $new;
	 // }

	/**
	 * Managing  licenses.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public static function manage_license() {

		// creates our settings in the options table
		register_setting( 'ssb_pro_license', 'ssb_pro_license_key' );

		// listen for our activate button to be clicked
		if ( isset( $_POST['ssb_pro_license_activate'] ) ) {

			$registration_data = self::activate_license( sanitize_text_field( wp_unslash( $_POST['ssb_pro_license_key'] ) ) );
		}

		// listen for our deactivate button to be clicked
		if ( isset( $_POST['ssb_pro_license_deactivate'] ) ) {

			$registration_data = self::deactivate_license( sanitize_text_field( wp_unslash( $_POST['ssb_pro_license_key'] ) ) );
		}

	}


	/**
	 * Try to activate the supplied license on our store.
	 *
	 * @param string $license License key to activate.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return array
	 */
	public static function activate_license( $license ) {
		$license = trim( $license );

		$result = array(
			'license_key'   => $license,
			'license_data'  => array(),
			'error_message' => '',
		);

		// Data to send in our API request.
		$api_params = array(
			'edd_action' => 'activate_license',
			'license'    => $license,
			'item_id'    => self::SSB_PRODUCT_ID,
			'url'        => home_url(),
		);

		// Call the custom API.
		$response = wp_remote_post(
			self::SSB_SITE_URL,
			array(
				'timeout'   => 15,
				'sslverify' => false,
				'body'      => $api_params,
			)
		);

		// Make sure the response is not WP_Error.
		if ( is_wp_error( $response ) ) {
			$result['error_message'] = $response->get_error_message() . esc_html__( 'If this error keeps displaying, please contact our support at wpbrigade.com!', 'simple-social-buttons' );

			return $result;
		}

		// Make sure the response is OK (200).
		if ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
			$result['error_message'] = esc_html__( 'An error occurred, please try again.', 'simple-social-buttons' ) . esc_html__( 'An error occurred, please try again. If this error keeps displaying, please contact our support at wpbrigade.com!', 'simple-social-buttons' );

			return $result;
		}

		// Get the response data.
		$result['license_data'] = json_decode( wp_remote_retrieve_body( $response ), true );

		// Generate the error message.
		if ( false === $result['license_data']['success'] ) {

			switch ( $result['license_data']['error'] ) {

				case 'expired':
					$result['error_message'] = sprintf(
						esc_html__( 'Your license key expired on %s.', 'simple-social-buttons' ),
						date_i18n( get_option( 'date_format' ), strtotime( $result['license_data']['expires'], current_time( 'timestamp' ) ) )
					);
					break;

				case 'revoked':
					$result['error_message'] = esc_html__( 'Your license key has been disabled.', 'simple-social-buttons' );
					break;

				case 'missing':
					$result['error_message'] = esc_html__( 'Your license key is Invalid.', 'simple-social-buttons' );
					break;

				case 'invalid':
				case 'site_inactive':
					$result['error_message'] = esc_html__( 'Your license is not active for this URL.', 'simple-social-buttons' );
					break;

				case 'item_name_mismatch':
					$result['error_message'] = sprintf( esc_html__( 'This appears to be an invalid license key for %s.', 'simple-social-buttons' ), self::SSB_PRODUCT_NAME );
					break;

				case 'no_activations_left':
					$result['error_message'] = esc_html__( 'Your license key has reached its activation limit.', 'simple-social-buttons' );
					break;

				default:
					$result['error_message'] = esc_html__( 'An error occurred, please try again.', 'simple-social-buttons' );
					break;
			}
		}

		update_option( self::REGISTRATION_DATA_OPTION_KEY, $result );

		return $result;
	}


	/**
	 * Try to deactivate the supplied license on our store.
	 *
	 * @param string $license License key to activate.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return array
	 */
	public static function deactivate_license( $license ) {
		$license = trim( $license );

		$result = array(
			'license_key'   => $license,
			'license_data'  => array(),
			'error_message' => '',
		);

		// Data to send in our API request.
		$api_params = array(
			'edd_action' => 'deactivate_license',
			'license'    => $license,
			'item_id'    => self::SSB_PRODUCT_ID,
			'url'        => home_url(),
		);

		// Call the custom API.
		$response = wp_remote_post(
			self::SSB_SITE_URL,
			array(
				'timeout'   => 15,
				'sslverify' => false,
				'body'      => $api_params,
			)
		);

		// Make sure the response is not WP_Error.
		if ( is_wp_error( $response ) ) {
			$result['error_message'] = $response->get_error_message() . esc_html__( 'If this error keeps displaying, please contact our support at wpbrigade.com!', 'simple-social-buttons' );

			return $result;
		}

		// Make sure the response is OK (200).
		if ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
			$result['error_message'] = esc_html__( 'An error occurred, please try again.', 'simple-social-buttons' ) . esc_html__( 'An error occurred, please try again. If this error keeps displaying, please contact our support at wpbrigade.com!', 'simple-social-buttons' );

			return $result;
		}

		// Get the response data.
		$result['license_data'] = json_decode( wp_remote_retrieve_body( $response ), true );

		// Generate the error message.
		if ( false === $result['license_data']['success'] ) {

			switch ( $result['license_data']['error'] ) {

				case 'expired':
					$result['error_message'] = sprintf(
						esc_html__( 'Your license key expired on %s.', 'simple-social-buttons' ),
						date_i18n( get_option( 'date_format' ), strtotime( $result['license_data']['expires'], current_time( 'timestamp' ) ) )
					);
					break;

				case 'revoked':
					$result['error_message'] = esc_html__( 'Your license key has been disabled.', 'simple-social-buttons' );
					break;

				case 'missing':
					$result['error_message'] = esc_html__( 'Your license key is Invalid.', 'simple-social-buttons' );
					break;

				case 'invalid':
				case 'site_inactive':
					$result['error_message'] = esc_html__( 'Your license is not active for this URL.', 'simple-social-buttons' );
					break;

				case 'item_name_mismatch':
					$result['error_message'] = sprintf( esc_html__( 'This appears to be an invalid license key for %s.', 'simple-social-buttons' ), self::SSB_PRODUCT_NAME );
					break;

				case 'no_activations_left':
					$result['error_message'] = esc_html__( 'Your license key has reached its activation limit.', 'simple-social-buttons' );
					break;

				default:
					$result['error_message'] = esc_html__( 'An error occurred, please try again.', 'simple-social-buttons' );
					break;
			}
		}

		update_option( self::REGISTRATION_DATA_OPTION_KEY, $result );

		return $result;
	}

	/**
	 * Check and get the license data.
	 *
	 * @param string $license The license key.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return false|array
	 */
	public static function check_license( $license ) {
		$license = trim( $license );

		$api_params = array(
			'edd_action' => 'check_license',
			'license'    => $license,
			'item_id'    => SSB_PRODUCT_ID,
			'url'        => home_url(),
		);

		// Call the custom API.
		$response = wp_remote_post(
			self::SSB_SITE_URL,
			array(
				'timeout'   => 15,
				'sslverify' => false,
				'body'      => $api_params,
			)
		);

		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
			return false;
		}

		return json_decode( wp_remote_retrieve_body( $response ), true );
	}


	/**
	 * Get the registration data helper function.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return false|array
	 */
	public static function get_registration_data() {
		return get_option( self::REGISTRATION_DATA_OPTION_KEY );
	}


	/**
	 * Check if the license is registered (has/had a valid license).
	 *
	 * @access public
	 * @since 1.0.0
	 * @return bool
	 */
	public static function is_registered() {
		$data = self::get_registration_data();

		if ( empty( $data ) ) {
			return false;
		}

		if ( ! empty( $data['license_data']['success'] ) && ! empty( $data['license_data']['license'] ) && 'valid' === $data['license_data']['license'] ) {
			return true;
		}

		return false;
	}


	/**
	 * Get the registered license key.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return bool|string
	 */
	public static function get_registered_license_key() {
		$data = self::get_registration_data();

		if ( empty( $data ) ) {
			return '';
		}

		if ( empty( $data['license_key'] ) ) {
			return '';
		}

		return $data['license_key'];
	}


	/**
	 * Get the registered license status.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return bool|string
	 */
	public static function get_registered_license_status() {
		$data = self::get_registration_data();

		if ( empty( $data ) ) {
			return '';
		}

		if ( ! empty( $data['error_message'] ) ) {
			return $data['error_message'];
		}

		switch ( $data['license_data']['license'] ) {
			case 'deactivated':
					$message = sprintf(
						esc_html__( 'Your license key has been deactivated on %s. Please Activate your license key to continue using Automatic Updates and Premium Support.', 'simple-social-buttons' ),
						'<strong>' . date_i18n( get_option( 'date_format' ), strtotime( $expiration_date, current_time( 'timestamp' ) ) ) . '</strong>'
					);
				return $message;
					break;

			case 'revoked':
				$message = esc_html__( 'Your license key has been disabled.', 'simple-social-buttons' );
				break;
		}

		return $data['license_data']['license'];
	}


	/**
	 * Check, if the registered license has expired.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return bool
	 */
	public static function has_license_expired() {
		$data = self::get_registration_data();

		if ( empty( $data ) ) {
			return true;
		}

		if ( empty( $data['license_data']['expires'] ) ) {
			return true;
		}

		// If it's a lifetime license, it never expires.
		if ( 'lifetime' == $data['license_data']['expires'] ) {
			return false;
		}

		$now             = new \DateTime();
		$expiration_date = new \DateTime( $data['license_data']['expires'] );

		$is_expired = $now > $expiration_date;

		if ( ! $is_expired ) {
			return false;
		}

		$prevent_check = get_transient( 'ssb-pro-dont-check-license' );

		if ( $prevent_check ) {
			return true;
		}

		$new_license_data = self::check_license( self::get_registered_license_key() );
		set_transient( 'ssb-pro-dont-check-license', true, DAY_IN_SECONDS );

		if ( empty( $new_license_data ) ) {
			return true;
		}

		if (
			! empty( $new_license_data['success'] ) &&
			! empty( $new_license_data['license'] ) &&
			'valid' === $new_license_data['license']
		) {
			$new_expiration_date = new \DateTime( $new_license_data['expires'] );

			$new_is_expired = $now > $new_expiration_date;

			if ( ! $new_is_expired ) {
				$data['license_data']['expires'] = $new_license_data['expires'];

				update_option( self::REGISTRATION_DATA_OPTION_KEY, $data );
			}

			return $new_is_expired;
		}

		return true;
	}


	/**
	 * Get license expiration date.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return string
	 */
	public static function get_expiration_date() {
		$data = self::get_registration_data();

		if ( empty( $data ) ) {
			return '';
		}

		return ( ! empty( $data['license_data']['expires'] ) ) ? $data['license_data']['expires'] : '';
	}

	/**
	 * chu cha chee ;)
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public static function del_license_data() {
		delete_option( 'ssb_pro_license_key' );
		delete_option( self::REGISTRATION_DATA_OPTION_KEY );
	}

	/**
	 * Sort Array by priority.
	 *
	 * @access public
	 * @since 1.0.1
	 * @return mixed sorty array
	 */
	public function sort_array( $a, $b ) {
		return $a['priority'] - $b['priority'];
	}

}

// Simple_Social_Buttons_Pro::del_license_data();
new Simple_Social_Buttons_Pro();

if ( ! function_exists( 'array_column' ) ) {

	function array_column( $input = null, $columnKey = null, $indexKey = null ) {
		// Using func_get_args() in order to check for proper number of
		// parameters and trigger errors exactly as the built-in array_column()
		// does in PHP 5.5.
		$argc   = func_num_args();
		$params = func_get_args();
		if ( $argc < 2 ) {
			trigger_error( "array_column() expects at least 2 parameters, {$argc} given", E_USER_WARNING );
			return null;
		}
		if ( ! is_array( $params[0] ) ) {
			trigger_error(
				'array_column() expects parameter 1 to be array, ' . gettype( $params[0] ) . ' given',
				E_USER_WARNING
			);
			return null;
		}
		if ( ! is_int( $params[1] )
			&& ! is_float( $params[1] )
			&& ! is_string( $params[1] )
			&& $params[1] !== null
			&& ! ( is_object( $params[1] ) && method_exists( $params[1], '__toString' ) )
		) {
			trigger_error( 'array_column(): The column key should be either a string or an integer', E_USER_WARNING );
			return false;
		}
		if ( isset( $params[2] )
			&& ! is_int( $params[2] )
			&& ! is_float( $params[2] )
			&& ! is_string( $params[2] )
			&& ! ( is_object( $params[2] ) && method_exists( $params[2], '__toString' ) )
		) {
			trigger_error( 'array_column(): The index key should be either a string or an integer', E_USER_WARNING );
			return false;
		}
		$paramsInput     = $params[0];
		$paramsColumnKey = ( $params[1] !== null ) ? (string) $params[1] : null;
		$paramsIndexKey  = null;
		if ( isset( $params[2] ) ) {
			if ( is_float( $params[2] ) || is_int( $params[2] ) ) {
				$paramsIndexKey = (int) $params[2];
			} else {
				$paramsIndexKey = (string) $params[2];
			}
		}
		$resultArray = array();
		foreach ( $paramsInput as $row ) {
			$key    = $value = null;
			$keySet = $valueSet = false;
			if ( $paramsIndexKey !== null && array_key_exists( $paramsIndexKey, $row ) ) {
				$keySet = true;
				$key    = (string) $row[ $paramsIndexKey ];
			}
			if ( $paramsColumnKey === null ) {
				$valueSet = true;
				$value    = $row;
			} elseif ( is_array( $row ) && array_key_exists( $paramsColumnKey, $row ) ) {
				$valueSet = true;
				$value    = $row[ $paramsColumnKey ];
			}
			if ( $valueSet ) {
				if ( $keySet ) {
					$resultArray[ $key ] = $value;
				} else {
					$resultArray[] = $value;
				}
			}
		}
		return $resultArray;
	}
}
