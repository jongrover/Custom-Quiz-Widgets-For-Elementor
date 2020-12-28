<?php
/* * * * * * * * * * * * * * * * * * * * *
 *
 *  ██████╗ ███╗   ███╗ ██████╗ ███████╗
 * ██╔═══██╗████╗ ████║██╔════╝ ██╔════╝
 * ██║   ██║██╔████╔██║██║  ███╗█████╗
 * ██║   ██║██║╚██╔╝██║██║   ██║██╔══╝
 * ╚██████╔╝██║ ╚═╝ ██║╚██████╔╝██║
 *  ╚═════╝ ╚═╝     ╚═╝ ╚═════╝ ╚═╝
 *
 * @package  : OMGF
 * @author   : Daan van den Bergh
 * @copyright: (c) 2020 Daan van den Bergh
 * @url      : https://daan.dev
 * * * * * * * * * * * * * * * * * * * */

defined( 'ABSPATH' ) || exit;

class OMGF_Admin_Settings extends OMGF_Admin
{
	/**
	 * Settings Fields
	 */
	const OMGF_SETTINGS_FIELD_OPTIMIZE  = 'omgf-optimize-settings';
	const OMGF_SETTINGS_FIELD_DETECTION = 'omgf-detection-settings';
	const OMGF_SETTINGS_FIELD_ADVANCED  = 'omgf-advanced-settings';
	
	/**
	 * Option Values
	 */
	const OMGF_OPTIMIZATION_MODE       = [
		'manual' => 'Manual (default)',
		'auto'   => 'Automatic'
	];
	const OMGF_FONT_PROCESSING_OPTIONS = [
		'replace' => 'Replace (default)',
		'remove'  => 'Remove only'
	];
	const OMGF_FONT_DISPLAY_OPTIONS    = [
		'swap'     => 'Swap (recommended)',
		'auto'     => 'Auto',
		'block'    => 'Block',
		'fallback' => 'Fallback',
		'optional' => 'Optional'
	];
	const OMGF_FORCE_SUBSETS_OPTIONS   = [
		'arabic'              => 'Arabic',
		'bengali'             => 'Bengali',
		'chinese-hongkong'    => 'Chinese (Hong Kong)',
		'chinese-simplified'  => 'Chinese (Simplified)',
		'chinese-traditional' => 'Chinese (Traditional)',
		'cyrillic'            => 'Cyrillic',
		'cyrillic-ext'        => 'Cyrillic Extended',
		'devanagari'          => 'Devanagari',
		'greek'               => 'Greek',
		'greek-ext'           => 'Greek Extended',
		'gujarati'            => 'Gujarati',
		'gurmukhi'            => 'Gurmukhi',
		'hebrew'              => 'Hebrew',
		'japanese'            => 'Japanese',
		'kannada'             => 'Kannada',
		'khmer'               => 'Khmer',
		'korean'              => 'Korean',
		'latin'               => 'Latin',
		'latin-ext'           => 'Latin Extended',
		'malayalam'           => 'Malayalam',
		'myanmar'             => 'Myanmar',
		'oriya'               => 'Oriya',
		'sinhala'             => 'Sinhala',
		'tamil'               => 'Tamil',
		'telugu'              => 'Telugu',
		'thai'                => 'Thai',
		'tibetan'             => 'Tibetan',
		'vietnamese'          => 'Vietnamese'
	];
	
	/**
	 * Optimize Fonts
	 */
	const OMGF_OPTIMIZE_SETTING_DISPLAY_OPTION      = 'omgf_display_option';
	const OMGF_OPTIMIZE_SETTING_MANUAL_OPTIMIZE_URL = 'omgf_manual_optimize_url';
	const OMGF_OPTIMIZE_SETTING_OPTIMIZATION_MODE   = 'omgf_optimization_mode';
	const OMGF_OPTIMIZE_SETTING_OPTIMIZED_FONTS     = 'omgf_optimized_fonts';
	const OMGF_OPTIMIZE_SETTING_OPTIMIZE_EDIT_ROLES = 'omgf_optimize_edit_roles';
	const OMGF_OPTIMIZE_SETTING_PRELOAD_FONTS       = 'omgf_preload_fonts';
	const OMGF_OPTIMIZE_SETTING_UNLOAD_FONTS        = 'omgf_unload_fonts';
	const OMGF_OPTIMIZE_SETTING_UNLOAD_STYLESHEETS  = 'omgf_unload_stylesheets';
	
	/**
	 * Detection Settings
	 */
	const OMGF_DETECTION_SETTING_FONT_PROCESSING = 'omgf_font_processing';
	
	/**
	 * Advanced Settings
	 */
	const OMGF_ADV_SETTING_CACHE_PATH   = 'omgf_cache_dir';
	const OMGF_ADV_SETTING_CACHE_URI    = 'omgf_cache_uri';
	const OMGF_ADV_SETTING_CDN_URL      = 'omgf_cdn_url';
	const OMGF_ADV_SETTING_UNINSTALL    = 'omgf_uninstall';
	const OMGF_ADV_SETTING_RELATIVE_URL = 'omgf_relative_url';
	
	/**
	 * Miscellaneous
	 */
	const OMGF_OPTIONS_GENERAL_PAGE_OPTIMIZE_WEBFONTS = 'options-general.php?page=optimize-webfonts';
	const FFWP_WORDPRESS_PLUGINS_OMGF_PRO             = 'https://ffwp.dev/wordpress/omgf-pro/';
	
	/** @var string $active_tab */
	private $active_tab;
	
	/** @var string $page */
	private $page;
	
	/** @var string $plugin_text_domain */
	private $plugin_text_domain = 'host-webfonts-local';
	
	/**
	 * OMGF_Admin_Settings constructor.
	 */
	public function __construct () {
		parent::__construct();
		
		$this->active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : self::OMGF_SETTINGS_FIELD_OPTIMIZE;
		$this->page       = isset( $_GET['page'] ) ? $_GET['page'] : '';
		
		add_action( 'admin_menu', [ $this, 'create_menu' ] );
		add_filter( 'plugin_action_links_' . plugin_basename( OMGF_PLUGIN_FILE ), [ $this, 'create_settings_link' ] );
		
		if ( $this->page !== 'optimize-webfonts' ) {
			return;
		}
		
		// Tabs
		add_action( 'omgf_settings_tab', [ $this, 'optimize_fonts_tab' ], 0 );
		add_action( 'omgf_settings_tab', [ $this, 'detection_settings_tab' ], 1 );
		add_action( 'omgf_settings_tab', [ $this, 'advanced_settings_tab' ], 2 );
		
		// Content
		add_action( 'omgf_settings_content', [ $this, 'optimize_fonts_content' ], 0 );
		add_action( 'omgf_settings_content', [ $this, 'detection_settings_content' ], 1 );
		add_action( 'omgf_settings_content', [ $this, 'advanced_settings_content' ], 2 );
	}
	
	/**
	 * Creates the menu item.
	 */
	public function create_menu () {
		add_options_page(
			'OMGF',
			'Optimize Google Fonts',
			'manage_options',
			'optimize-webfonts',
			[ $this, 'create_settings_page' ]
		);
		
		// @formatter:off
		add_action( 'admin_init', [ $this, 'register_settings' ] );
		// @formatter:on
	}
	
	/**
	 * Display the settings page.
	 */
	public function create_settings_page () {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( __( "You're not cool enough to access this page.", $this->plugin_text_domain ) );
		}
		?>
        <div class="wrap omgf">
            <h1><?= apply_filters( 'omgf_settings_page_title', __( 'OMGF | Optimize My Google Fonts', $this->plugin_text_domain ) ); ?></h1>

            <p>
				<?= get_plugin_data( OMGF_PLUGIN_FILE )['Description']; ?>
            </p>

            <div class="settings-column left">
                <h2 class="omgf-nav nav-tab-wrapper">
					<?php do_action( 'omgf_settings_tab' ); ?>
                </h2>
				
				<?php do_action( 'omgf_settings_content' ); ?>
            </div>

            <div class="settings-column right">
                <div id="omgf-welcome-panel" class="welcome-panel">
					<?php $this->get_template( 'welcome' ); ?>
                </div>
            </div>
        </div>
		<?php
	}
	
	/**
	 * Register all settings.
	 *
	 * @throws ReflectionException
	 */
	public function register_settings () {
		if ( $this->active_tab !== self::OMGF_SETTINGS_FIELD_OPTIMIZE
		     && $this->active_tab !== self::OMGF_SETTINGS_FIELD_DETECTION
		     && $this->active_tab !== self::OMGF_SETTINGS_FIELD_ADVANCED
		) {
			$this->active_tab = self::OMGF_SETTINGS_FIELD_OPTIMIZE;
		}
		
		foreach ( $this->get_settings() as $constant => $value ) {
			register_setting(
				$this->active_tab,
				$value
			);
		}
	}
	
	/**
	 * Get all settings using the constants in this class.
	 *
	 * @return array
	 * @throws ReflectionException
	 */
	public function get_settings () {
		$reflection = new ReflectionClass( $this );
		$constants  = apply_filters( 'omgf_settings_constants', $reflection->getConstants() );
		
		switch ( $this->active_tab ) {
			case ( self::OMGF_SETTINGS_FIELD_DETECTION ):
				$needle = 'OMGF_DETECTION_SETTING_';
				break;
			case ( self::OMGF_SETTINGS_FIELD_ADVANCED ):
				$needle = 'OMGF_ADV_SETTING_';
				break;
			default:
				$needle = 'OMGF_OPTIMIZE_SETTING_';
		}
		
		return array_filter(
			$constants,
			function ( $key ) use ( $needle ) {
				return strpos( $key, $needle ) !== false;
			},
			ARRAY_FILTER_USE_KEY
		);
	}
	
	public function optimize_fonts_tab () {
		$this->generate_tab( self::OMGF_SETTINGS_FIELD_OPTIMIZE, 'dashicons-performance', __( 'Optimize Fonts', $this->plugin_text_domain ) );
	}
	
	/**
	 * Add Basic Settings Tab to Settings Screen.
	 */
	public function detection_settings_tab () {
		$this->generate_tab( self::OMGF_SETTINGS_FIELD_DETECTION, 'dashicons-search', __( 'Detection Settings', $this->plugin_text_domain ) );
	}
	
	/**
	 * Add Advanced Settings Tab to Settings Screen.
	 */
	public function advanced_settings_tab () {
		$this->generate_tab( self::OMGF_SETTINGS_FIELD_ADVANCED, 'dashicons-admin-settings', __( 'Advanced Settings', $this->plugin_text_domain ) );
	}
	
	/**
	 * @param      $id
	 * @param null $icon
	 * @param null $label
	 */
	private function generate_tab ( $id, $icon = null, $label = null ) {
		?>
        <a class="nav-tab dashicons-before <?= $icon; ?> <?= $this->active_tab == $id ? 'nav-tab-active' : ''; ?>"
           href="<?= $this->generate_tab_link( $id ); ?>">
			<?= $label; ?>
        </a>
		<?php
	}
	
	/**
	 * @param $tab
	 *
	 * @return string
	 */
	private function generate_tab_link ( $tab ) {
		return admin_url( self::OMGF_OPTIONS_GENERAL_PAGE_OPTIMIZE_WEBFONTS . "&tab=$tab" );
	}
	
	/**
	 *
	 */
	public function optimize_fonts_content () {
		$this->do_settings_content( self::OMGF_SETTINGS_FIELD_OPTIMIZE );
	}
	
	/**
	 * Render Basic Settings content
	 */
	public function detection_settings_content () {
		$this->do_settings_content( self::OMGF_SETTINGS_FIELD_DETECTION );
	}
	
	/**
	 * Render Advanced Settings content
	 */
	public function advanced_settings_content () {
		$this->do_settings_content( self::OMGF_SETTINGS_FIELD_ADVANCED );
	}
	
	/**
	 * @param $field
	 */
	private function do_settings_content ( $field ) {
		if ( $this->active_tab != $field ) {
			return;
		}
		?>
        <form id="<?= $field; ?>-form" name="omgf-settings-form" method="post" action="<?= admin_url( 'options.php?tab=' . $this->active_tab ); ?>"
              autocomplete="off">
			<?php
			settings_fields( $field );
			do_settings_sections( $field );
			
			do_action( 'omgf_before_settings_form_settings' );
			
			echo apply_filters( str_replace( '-', '_', $field ) . '_content', '' );
			
			do_action( 'omgf_after_settings_form_settings' );
			
			submit_button( __( 'Save Changes', $this->plugin_text_domain ), 'primary', 'submit', false );
			?>
            <a id="omgf-empty" class="omgf-empty button-cancel"><?php _e( 'Empty Cache Directory', $this->plugin_text_domain ); ?></a>
        </form>
		<?php
	}
	
	/**
	 * @param $links
	 *
	 * @return mixed
	 */
	public function create_settings_link ( $links ) {
		$adminUrl     = admin_url() . self::OMGF_OPTIONS_GENERAL_PAGE_OPTIMIZE_WEBFONTS;
		$settingsLink = "<a href='$adminUrl'>" . __( 'Settings' ) . "</a>";
		array_push( $links, $settingsLink );
		
		return $links;
	}
}
