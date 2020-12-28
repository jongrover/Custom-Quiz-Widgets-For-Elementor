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
use Merkulove\SpeakerUtilities;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * SINGLETON: Class used to implement plugin settings.
 *
 * @since 1.0.0
 * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 **/
final class Settings {

	/**
	 * Speaker Plugin settings.
	 *
	 * @var array()
	 * @since 1.0.0
	 **/
	public $options = [];

	/**
	 * The one true Settings.
	 *
	 * @var Settings
	 * @since 1.0.0
	 **/
	private static $instance;

	/**
	 * Sets up a new Settings instance.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	private function __construct() {

		/** Get plugin settings. */
		$this->get_options();

	}

	/**
	 * Render Tabs Headers.
	 *
	 * @param string $current - Selected tab key.
	 *
	 * @since 3.0.0
	 * @access public
	 **/
	public function print_tabs( $current ) {

		/** Get available tabs. */
        $tabs = $this->get_tabs();

		/** Render Tabs. */
		?>
        <aside class="mdc-drawer">
            <div class="mdc-drawer__content">
                <nav class="mdc-list">
                    <?php

                    /** Render logo in plugin settings. */
                    $this->render_logo();

                    /** Render settings tabs. */
                    $this->render_tabs( $tabs, $current );

					/** Helpful links. */
					$this->support_link();

					/** Activation Status. */
					PluginActivation::get_instance()->display_status();

					?>
                </nav>
            </div>
        </aside>
		<?php
	}

    /**
     * Render settings tabs.
     *
     * @param array $tabs       - Array of available tabs.
     * @param string $current   - Slug of active tab.
     *
     * @access private
     * @since  3.0.0
     *
     * @return void
     **/
	private function render_tabs( $tabs, $current ) {

	    ?>
        <hr class="mdc-plugin-menu">
        <hr class="mdc-list-divider">
        <h6 class="mdc-list-group__subheader"><?php echo esc_html__( 'Plugin settings', 'speaker' ) ?></h6>
        <?php

        /** Plugin settings tabs. */
        foreach ( $tabs as $tab => $value ) {

            /** Prepare CSS classes. */
            $classes = [];
            $classes[] = 'mdc-list-item';

            /** Mark Active Tab. */
            if ( $tab === $current ) {
                $classes[] = 'mdc-list-item--activated';
            }

            /** Hide Developer tab before multiple clicks on logo. */
            if ( 'developer' === $tab ) {
                $classes[] = 'mdp-developer';
                $classes[] = 'mdc-hidden';
                $classes[] = 'mdc-list-item--activated';
            }

            /** Prepare link. */
            $link = '?page=mdp_speaker_settings&tab=' . $tab;

            ?>
            <a class="<?php esc_attr_e( implode( ' ', $classes ) ); ?>" href="<?php esc_attr_e( $link ); ?>">
                <i class='material-icons mdc-list-item__graphic' aria-hidden='true'><?php esc_html_e( $value['icon'] ); ?></i>
                <span class='mdc-list-item__text'><?php esc_html_e( $value['name'] ); ?></span>
            </a>
            <?php
        }

    }

    /**
     * Return an array of available tabs in plugin settings.
     *
     * @access private
     * @since 3.0.0
     *
     * @return array
     **/
	private function get_tabs() {

        $tabs = [];

        /** Check for required extensions. */
        if ( CheckCompatibility::get_instance()->do_settings_checks( true ) ) {

            $tabs['voice'] = [
                'icon' => 'tune',
                'name' => esc_html__( 'Voice', 'speaker' )
            ];

            /** Adds key dependent tabs: design, css, assignments. */
            $tabs = $this->add_key_dependent_tabs( $tabs );

        }

        /** Adds activation tab. */
        $tabs = $this->add_activation_tab( $tabs );

        $tabs['status'] = [
            'icon' => 'info',
            'name' => esc_html__( 'Status', 'speaker' )
        ];

        $tabs['updates'] = [
            'icon' => 'update',
            'name' => esc_html__( 'Updates', 'speaker' )
        ];

        $tabs['uninstall'] = [
            'icon' => 'delete_sweep',
            'name' => esc_html__( 'Uninstall', 'speaker' )
        ];

        /** Adds a developer tab. */
        $tabs = $this->add_developer_tab( $tabs );

        return $tabs;

    }

    /**
     * Adds key dependent tabs: design, css, assignments.
     *
     * @param array $tabs - Array of tabs to show in plugin settings.
     *
     * @access private
     * @since  3.0.0
     *
     * @return array - Array of tabs to show in plugin settings.
     **/
    private function add_key_dependent_tabs( $tabs ) {

        /** Show this tabs only if we have key file. */
        if ( ! $this->options['dnd-api-key'] ) { return $tabs; }

        $tabs['design'] = [
            'icon' => 'brush',
            'name' => esc_html__( 'Design', 'speaker' )
        ];

        /** @noinspection ClassConstantCanBeUsedInspection */
        if ( class_exists( '\Merkulove\SpeakerUtilities' ) ) {

            $tabs['post_types'] = [
                'icon' => 'article',
                'name' => esc_html__( 'Post Types', 'speaker' )
            ];

        }

        $tabs['css'] = [
            'icon' => 'code',
            'name' => esc_html__( 'Custom CSS', 'speaker' )
        ];

        $tabs['assignments'] = [
            'icon' => 'flag',
            'name' => esc_html__( 'Assignments', 'speaker' )
        ];

        return $tabs;

    }

    /**
     * Adds activation tab if plugin published on CodeCanyon.
     *
     * @param array $tabs - Array of tabs to show in plugin settings.
     *
     * @access private
     * @since  3.0.0
     *
     * @return array - Array of tabs to show in plugin settings.
     **/
    private function add_activation_tab( $tabs ) {

        /** Enable Activation tab only if plugin have Envato ID. */
        $plugin_id = EnvatoItem::get_instance()->get_id();

        if ( $plugin_id > 0 ) {

            $tabs['activation'] = [
                'icon' => 'vpn_key',
                'name' => esc_html__( 'Activation', 'speaker' )
            ];

        }

        return $tabs;

    }

    /**
     * Adds a developer tab if all the necessary conditions are met.
     *
     * @param array $tabs - Array of tabs to show in plugin settings.
     *
     * @access private
     * @since  3.0.0
     *
     * @return array - Array of tabs to show in plugin settings.
     **/
    private function add_developer_tab( $tabs ) {

        /** Output Developer tab only if DEBUG mode enabled. */
        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {

            $tabs['developer'] = [
                'icon' => 'developer_board',
                'name' => esc_html__( 'Developer', 'speaker' )
            ];

        }

        return $tabs;

    }

    /**
     * Render logo and Save changes button in plugin settings.
     *
     * @access private
     * @since 3.0.0
     *
     * @return void
     **/
	private function render_logo() {

	    ?>
        <div class="mdc-drawer__header mdc-plugin-fixed">
            <!--suppress HtmlUnknownAnchorTarget -->
            <a class="mdc-list-item mdp-plugin-title" href="#wpwrap">
                <i class="mdc-list-item__graphic" aria-hidden="true">
                    <img src="<?php echo esc_attr( Speaker::$url . 'images/logo-color.svg' ); ?>" alt="<?php echo esc_html__( 'Speaker', 'speaker' ) ?>">
                </i>
                <span class="mdc-list-item__text">
                    <?php echo esc_html__( 'Speaker', 'speaker' ) ?>
                    <sup><?php echo esc_html__( 'ver.', 'speaker' ) . esc_html( Speaker::$version ); ?></sup>
                </span>
            </a>
            <button type="submit" name="submit" id="submit" class="mdc-button mdc-button--dense mdc-button--raised">
                <span class="mdc-button__label"><?php echo esc_html__( 'Save changes', 'speaker' ) ?></span>
            </button>
        </div>
        <?php

    }

	/**
	 * Displays useful links for an activated and non-activated plugin.
	 *
	 * @since 3.0.0
     *
     * @return void
	 **/
	public function support_link() { ?>

        <hr class="mdc-list-divider">
        <h6 class="mdc-list-group__subheader"><?php echo esc_html__( 'Helpful links', 'speaker' ) ?></h6>

        <a class="mdc-list-item" href="https://docs.merkulov.design/tag/speaker/" target="_blank">
            <i class="material-icons mdc-list-item__graphic" aria-hidden="true"><?php echo esc_html__( 'collections_bookmark' ) ?></i>
            <span class="mdc-list-item__text"><?php echo esc_html__( 'Documentation', 'speaker' ) ?></span>
        </a>

		<?php if ( PluginActivation::get_instance()->is_activated() ) : /** Activated. */ ?>
            <a class="mdc-list-item" href="https://1.envato.market/speaker-support" target="_blank">
                <i class="material-icons mdc-list-item__graphic" aria-hidden="true"><?php echo esc_html__( 'mail' ) ?></i>
                <span class="mdc-list-item__text"><?php echo esc_html__( 'Get help', 'speaker' ) ?></span>
            </a>
            <a class="mdc-list-item" href="https://1.envato.market/cc-downloads" target="_blank">
                <i class="material-icons mdc-list-item__graphic" aria-hidden="true"><?php echo esc_html__( 'thumb_up' ) ?></i>
                <span class="mdc-list-item__text"><?php echo esc_html__( 'Rate this plugin', 'speaker' ) ?></span>
            </a>
		<?php endif; ?>

        <a class="mdc-list-item" href="https://1.envato.market/cc-merkulove" target="_blank">
            <i class="material-icons mdc-list-item__graphic" aria-hidden="true"><?php echo esc_html__( 'store' ) ?></i>
            <span class="mdc-list-item__text"><?php echo esc_html__( 'More plugins', 'speaker' ) ?></span>
        </a>
		<?php

	}

	/**
	 * Add plugin settings page.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function add_settings_page() {

		add_action( 'admin_menu', [ $this, 'add_admin_menu' ] );
		add_action( 'admin_init', [ $this, 'settings_init' ] );

	}

	/**
	 * Create Voice Tab.
	 *
	 * @since 3.0.0
	 * @access public
	 **/
    public function tab_voice() {

	    /** Voice Tab. */
	    $group_name = 'SpeakerOptionsGroup';
	    $section_id = 'mdp_speaker_pluginPage_section';
	    register_setting( $group_name, 'mdp_speaker_settings' );
	    add_settings_section( $section_id, '', null, $group_name );

        /** Render Settings fields. */
        if ( $this->options['dnd-api-key'] ) {

            # Current Language.
            add_settings_field( 'current_language', esc_html__( 'Now used:', 'speaker' ),       [SettingsFields::class, 'current_language'], $group_name, $section_id );

            # Select Language.
            add_settings_field( 'language', esc_html__( 'Select Language:', 'speaker' ),        [SettingsFields::class, 'language' ], $group_name, $section_id );

            # Audio profile.
            add_settings_field( 'audio_profile', esc_html__( 'Audio Profile:', 'speaker' ),     [SettingsFields::class, 'audio_profile' ], $group_name, $section_id );

            # Speaking rate/speed.
            add_settings_field( 'speaking_rate', esc_html__( 'Speaking Speed:', 'speaker' ),    [SettingsFields::class, 'speaking_rate' ], $group_name, $section_id );

            # Pitch.
            add_settings_field( 'pitch', esc_html__( 'Pitch:', 'speaker' ),                     [SettingsFields::class, 'pitch' ], $group_name, $section_id );

            # Volume Gain
            //add_settings_field( 'volume', esc_html__( 'Volume Gain:', 'speaker' ),              [SettingsFields::class, 'volume' ], $group_name, $section_id );

            # SpeakerUtilities Dependent Settings.
            /** @noinspection ClassConstantCanBeUsedInspection */
            if ( class_exists( '\Merkulove\SpeakerUtilities' ) ) {

                SpeakerUtilities::get_instance()->automatic_synthesis( $group_name, $section_id );

            }

        }

        # API Key.
        add_settings_field( 'dnd_api_key', esc_html__( 'API Key File:', 'speaker' ),            [SettingsFields::class, 'dnd_api_key'], $group_name, $section_id );

    }

	/**
	 * Create Design Tab settings.
	 *
	 * @since 3.0.0
	 * @return void
	 **/
	private function tab_design() {

		/** Create Design Tab. */
		$group = 'DesignOptionsGroup';
		$section = 'mdp_speaker_settings_page_design_section';
		register_setting( $group, 'mdp_speaker_design_settings' );
		add_settings_section( $section, '', null, $group );

		# Player Position.
		add_settings_field( 'position', esc_html__( 'Player Position:', 'speaker' ), [SettingsFields::class, 'position'], $group, $section );

		# Player Style.
		add_settings_field( 'style', esc_html__( 'Player Style:', 'speaker' ), [SettingsFields::class, 'style'], $group, $section );

		# Player background color.
		add_settings_field( 'bgcolor', esc_html__( 'Background Color:', 'speaker' ), [SettingsFields::class, 'bgcolor'], $group, $section );

		# Download link.
		add_settings_field( 'link', esc_html__( 'Download Link:', 'speaker' ), [SettingsFields::class, 'link'], $group, $section );

	}

    /**
     * Create Post Types Tab.
     *
     * @since 3.0.0
     * @access private
     **/
	private function tab_post_types() {

        /** Create Design Tab. */
        $group = 'PostTypesOptionsGroup';
        $section = 'mdp_speaker_settings_page_post_types_section';
        register_setting( $group, 'mdp_speaker_post_types_settings' );
        add_settings_section( $section, '', null, $group );

        # Post Types.
        add_settings_field( 'cpt_support', esc_html__( 'Post Types:', 'speaker' ), [SettingsFields::class, 'cpt_support'], $group, $section );

        # Default Templates.
        add_settings_field('default_templates', esc_html__( 'Speech Templates:', 'speaker' ), [SettingsFields::class, 'default_templates'], $group, $section );

    }

	/**
	 * Create Custom CSS Tab.
	 *
	 * @since 1.0.0
	 * @access private
	 **/
	private function tab_custom_css() {

		/** Custom CSS. */
		$group_name = 'SpeakerCSSOptionsGroup';
		$section_id = 'mdp_speaker_settings_page_css_section';

		/** Create settings section. */
		register_setting( $group_name, 'mdp_speaker_css_settings' );
		add_settings_section( $section_id, '', null, $group_name );

    }

	/**
	 * Generate Settings Page.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function settings_init() {

		/** Create Voice Tab. */
		$this->tab_voice();

		/** Create Design Tab. */
		$this->tab_design();

        /** @noinspection ClassConstantCanBeUsedInspection */
        if ( class_exists( '\Merkulove\SpeakerUtilities' ) ) {

            /** Create Post Types Tab. */
            $this->tab_post_types();

        }

        /** Create Assignments Tab. */
        AssignmentsTab::get_instance()->add_settings();

		/** Create Custom CSS Tab. */
		$this->tab_custom_css();

		/** Create Activation Tab. */
		PluginActivation::get_instance()->add_settings();

		/** Create Status Tab. */
		TabStatus::get_instance()->add_settings();

        /** Create Updates Tab. */
        TabUpdates::get_instance()->add_settings();

		/** Create Uninstall Tab. */
		UninstallTab::get_instance()->add_settings();

		/** Create Developer Tab. */
		DeveloperBoard::get_instance()->add_settings();

	}

	/**
	 * Add admin menu for plugin settings.
	 *
	 * @since 3.0.0
	 * @access public
	 **/
	public function add_admin_menu() {

		add_menu_page(
			esc_html__( 'Speaker Settings', 'speaker' ),
			esc_html__( 'Speaker', 'speaker' ),
			'manage_options',
			'mdp_speaker_settings',
			[ $this, 'options_page' ],
			'data:image/svg+xml;base64,' . base64_encode( file_get_contents( Speaker::$path . 'images/logo-menu.svg' ) ),
			'58.1961'// Always change digits after "." for different plugins.
		);

	}

	/**
	 * Plugin Settings Page.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function options_page() {

		if ( ! current_user_can( 'manage_options' ) ) { return; } ?>

        <!--suppress HtmlUnknownTarget -->
        <form action='options.php' method='post'>
            <div class="wrap">

				<?php
                /** Get active tab slug. */
                $tab = $this->get_active_tab();

				/** Render "Speaker settings saved!" message. */
				SettingsFields::get_instance()->render_nags();

				/** Render Tabs Headers. */
				?><section class="mdp-aside"><?php $this->print_tabs( $tab ); ?></section><?php

				/** Render Tabs Body. */
				?><section class="mdp-tab-content mdp-tab-name-<?php echo esc_attr( $tab ) ?>"><?php

					/** General Tab. */
					if ( 'voice' === $tab ) {

						echo '<h3>' . esc_html__( 'Voice Settings', 'speaker' ) . '</h3>';
						settings_fields( 'SpeakerOptionsGroup' );
						do_settings_sections( 'SpeakerOptionsGroup' );

                    /** Design Tab. */
					} elseif ( 'design' === $tab ) {

						echo '<h3>' . esc_html__( 'Design Settings', 'speaker' ) . '</h3>';
						settings_fields( 'DesignOptionsGroup' );
						do_settings_sections( 'DesignOptionsGroup' );

                    /** Post Types Tab. */
                    } elseif ( 'post_types' === $tab ) {

                        echo '<h3>' . esc_html__( 'Post Types Settings', 'speaker' ) . '</h3>';
                        settings_fields( 'PostTypesOptionsGroup' );
                        do_settings_sections( 'PostTypesOptionsGroup' );

                    /** Assignments Tab. */
					} elseif ( 'assignments' === $tab ) {

						echo '<h3>' . esc_html__( 'Assignments Settings', 'speaker' ) . '</h3>';
						settings_fields( 'SpeakerAssignmentsOptionsGroup' );
						do_settings_sections( 'SpeakerAssignmentsOptionsGroup' );
						AssignmentsTab::get_instance()->render_assignments();

                    /** Custom CSS Tab. */
                    } elseif ( 'css' === $tab ) {

						echo '<h3>' . esc_html__( 'Custom CSS', 'speaker' ) . '</h3>';
						settings_fields( 'SpeakerCSSOptionsGroup' );
						do_settings_sections( 'SpeakerCSSOptionsGroup' );
						SettingsFields::get_instance()->custom_css();

                    /** Activation Tab. */
					} elseif ( 'activation' === $tab ) {

						settings_fields( 'SpeakerActivationOptionsGroup' );
						do_settings_sections( 'SpeakerActivationOptionsGroup' );
						PluginActivation::get_instance()->render_activation();

                    /** Status tab. */
					} elseif ( 'status' === $tab ) {

						echo '<h3>' . esc_html__( 'System Requirements', 'speaker' ) . '</h3>';
                        settings_fields( 'SpeakerStatusOptionsGroup' );
                        do_settings_sections( 'SpeakerStatusOptionsGroup' );
						TabStatus::get_instance()->render_form();

                    /** Updates tab. */
                    } elseif ( 'updates' === $tab ) {

                        TabUpdates::get_instance()->render_tab_content();

                    /** Uninstall Tab. */
					} elseif ( 'uninstall' === $tab ) {

						echo '<h3>' . esc_html__( 'Uninstall Settings', 'speaker' ) . '</h3>';
						UninstallTab::get_instance()->render_form();

                    /** Developer Tab. */
					} elseif ( 'developer' === $tab ) {

						echo '<h3>' . esc_html__( 'Developer Board', 'speaker' ) . '</h3>';
						DeveloperBoard::get_instance()->render_form();

					}
					?>
                </section>
            </div>
        </form>

		<?php
	}

    /**
     * Return active tab slug.
     *
     * @access private
     * @since 3.0.0
     *
     * @return void
     **/
	private function get_active_tab() {

        /** Default Tab. */
        $tab = 'status';

        /** If the min requirements are met, show the voice tab. */
        $min_requirements = CheckCompatibility::get_instance()->do_settings_checks( false );
        if ( $min_requirements ) {
            $tab = 'voice';
        }

        /** Tab selected by user. */
        if ( isset ( $_GET['tab'] ) ) {
            $tab = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_STRING );
        }

        /** If the min requirements are not met and selected hidden tab - show the status tab. */
        if ( ( ! $min_requirements ) && in_array( $tab, ['voice', 'design', 'css', 'assignments'], true ) ) {
            $tab = 'status';
        }

        return $tab;

    }

	/**
	 * Get plugin settings with default values.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 **/
	public function get_options() {

		/** Default values. */
		$defaults = [

			# Voice Tab.
			'dnd-api-key'   => '',  // Encoded JSON API Key file.
			'language'      => 'en-US-Standard-D', // Language.
			'language-code' => 'en-US', // Language Code.
			'audio-profile' => 'handset-class-device', // Audio profile.
			'speaking-rate' => '1', // Speaking rate/speed.
			'pitch'         => '0', // Pitch.
            //'volume'        => '0.0', // Volume Gain.
			'before_audio'  => '', // Before Audio.
            'read_title'    => 'off', // Read the Title.
			'after_audio'   => '', // After audio.
			'auto_generation' => 'off',

			# Design Tab.
			'position'      => 'before-content', // Player Position.

			'style'         => 'speaker-round', // Default style.
			'bgcolor'       => 'rgba(2, 83, 238, 1)', // Tooltip background color.
			'link'          => 'none', // Download Link.

            # Post Types Tab.
            'cpt_support'   => ['post','page'], // Post Types

			# Custom CSS Tab.
            'custom_css'    => ''

		];

		/** Voice tab settings. */
		$options = get_option( 'mdp_speaker_settings' );
		$results = wp_parse_args( $options, $defaults );

		/** Design tab settings. */
		$design_settings = get_option( 'mdp_speaker_design_settings' );
		$results = wp_parse_args( $design_settings, $results );

        /** Post Types tab. */
        if ( file_exists( Speaker::$path . 'SpeakerUtilities.php' ) ) {
            $post_types_settings = get_option( 'mdp_speaker_post_types_settings' );
            $results = wp_parse_args( $post_types_settings, $results );
        }

		/** Custom CSS tab settings. */
		$custom_css_settings = get_option( 'mdp_speaker_css_settings' );
		$results = wp_parse_args( $custom_css_settings, $results );

		/** Reset API Key on fatal error. */
        if ( isset( $_GET['reset-api-key'] ) && '1' === $_GET['reset-api-key'] ) {
            $this->reset_api_key();
        }

		$this->options = $results;

	}

    /**
     * Reset API Key on fatal error.
     *
     * @since  3.0.0
     * @access public
     * @return void
     **/
	private function reset_api_key() {

	    /** Remove API Key. */
        $options = get_option( 'mdp_speaker_settings' );
        $options['dnd-api-key'] = '';

        /** Save new value. */
        update_option( 'mdp_speaker_settings', $options );

        /** Go to first tab. */
        wp_redirect( admin_url( '/admin.php?page=mdp_speaker_settings&tab=voice' ) );
        exit;

    }

	/**
	 * Main Settings Instance.
	 *
	 * Insures that only one instance of Settings exists in memory at any one time.
	 *
	 * @static
	 * @return Settings
	 * @since 3.0.0
	 **/
	public static function get_instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {

			self::$instance = new self;

		}

		return self::$instance;

	}

} // End Class Settings.
