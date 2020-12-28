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

use Google\ApiCore\ApiException;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * SINGLETON: Class adds Speaker Metabox for selected Post types.
 *
 * @since 3.0.0
 * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 **/
final class MetaBox {

	/**
	 * The one true MetaBox.
	 *
	 * @var MetaBox
	 * @since 3.0.0
	 **/
	private static $instance;

	/**
	 * Sets up a new MetaBox instance.
	 *
	 * @since 3.0.0
	 * @access public
	 **/
	private function __construct() {

		add_action( 'add_meta_boxes', [ $this, 'meta_box' ] );

	}

	/**
	 * Add Meta Box for Post/Page.
	 *
	 * @since 3.0.0
	 * @access public
	 **/
	public function meta_box() {

		/** Get selected post types. */
		$screens = Settings::get_instance()->options['cpt_support'];

		foreach ( $screens as $screen ) {

			/** Add Speaker Metabox */
			add_meta_box(
				'mdp_speaker_box_id',
				'Speaker',
				[ $this, 'meta_box_html' ],
				$screen,
				'side',
				'core'
			);

		}

	}

	/**
	 * Render Meta Box.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function meta_box_html() {

		/** Show audio player if audio exist. */
		SpeakerCaster::get_instance()->the_player();

		/** Show "Generate Audio" button if Post already saved and published. */
		$status = get_post_status();
		if ( 'publish' !== $status ) :

            /** Show warning for unpublished posts. */
            $this->meta_box_html_status();

		elseif ( post_password_required() ) :

            /** Show warning for password protected posts. */
            $this->meta_box_html_password();

		elseif ( Settings::get_instance()->options['dnd-api-key'] ) :

            /** Show generate button. */
           $this->meta_box_html_generate();

        endif;
	}

    /**
     * Show warning for unpublished posts.
     *
     * @since 3.0.0
     * @access public
     *
     * @return void
     **/
	private function meta_box_html_status() {
        ?>
        <div class="mdp-warning">
            <?php esc_html_e( 'Publish a post before you can generate an audio version.', 'speaker' ); ?>
        </div>
        <?php
    }

    /**
     * Show warning for password protected posts.
     *
     * @since 3.0.0
     * @access public
     *
     * @return void
     **/
    private function meta_box_html_password() {
        ?>
        <div class="mdp-warning">
            <?php esc_html_e( 'Speaker reads only publicly available posts.', 'speaker' ); ?><br>
            <?php esc_html_e( 'Remove the password from the post, create an audio version, then close the post again with a password.', 'speaker' ); ?><br>
            <?php esc_html_e( 'This is a necessary safety measure.', 'speaker' ); ?>
        </div>
        <?php
    }

    /**
     * Show generate button.
     *
     * @since 3.0.0
     * @access public
     *
     * @return void
     **/
    private function meta_box_html_generate() {

        /** Checks if there is audio for the current post. */
        $audio_exists = SpeakerCaster::get_instance()->audio_exists();
        ?>
        <div class="mdp-speaker-meta-box-controls">

            <div>
                <?php

                /** Generate with Speech Template button. */
                $this->speech_template_generate();

                ?>
            </div>

            <div>
                <button id="mdp_speaker_generate" type="button"
                        class="button-large components-button is-button is-primary is-large">
                    <?php if ( $audio_exists ) : ?>
                        <?php esc_html_e( 'Re-create audio', 'speaker' ); ?>
                    <?php else : ?>
                        <?php esc_html_e( 'Create audio', 'speaker' ); ?>
                    <?php endif; ?>
                </button>

                <?php if ( $audio_exists ) : ?>
                    <button id="mdp_speaker_remove" type="button"
                            class="button-large components-button button-link-delete is-button is-default is-large">
                        <?php esc_html_e( 'Remove', 'speaker' ); ?>
                    </button>
                <?php endif; ?>
            </div>

        </div>
        <?php

    }

    /**
     * Generate with Speech Template button.
     *
     * @since 3.0.0
     * @access public
     *
     * @return void
     **/
    public function speech_template_generate() {

        /** Return default ST for current post type. */
        $default = $this->get_default_st();

        ?>
        <div class="mdp-speaker-st-controls">
            <?php

            /** @noinspection ClassConstantCanBeUsedInspection */
            if ( class_exists( '\Merkulove\SpeakerUtilities' ) ) : ?>

                <?php \Merkulove\SpeakerUtilities::get_instance()->render_speech_template_controls( $default ); ?>

            <?php endif; ?>
        </div>

        <div>
            <?php

            /** Prepare options for ST select. */
            $options = $this->get_st_options();

            /** Does this post have custom template? */
            $custom_st = get_post_meta( get_the_ID(), 'mdp_speaker_custom_speech_template', true );

            $selected = $default;
            if ( $custom_st ) {
                $selected = $custom_st;
            }

            /** @noinspection ClassConstantCanBeUsedInspection */
            if ( ! class_exists( '\Merkulove\SpeakerUtilities' ) ) {
                $selected = 'content';
            }

            /** Render Speech Template Select. */
            UI::get_instance()->render_select(
                $options,
                $selected, // Selected template.
                esc_html__( 'Speech Template', 'speaker' ),
                esc_html__( 'Select one of the ', 'speaker' ) .
                '<a href="https://docs.merkulov.design/speech-templates/" target="_blank">' .
                    esc_html__( 'Speech Templates', 'speaker' ) .
                '</a>' .
                esc_html__( ' or create a new one.', 'speaker' ),
                [
                    'name' => 'mdp_speaker_speech_templates_template',
                    'id' => 'mdp-speaker-speech-templates-template'
                ]
            );

            ?>
        </div>

        <?php

        add_action( 'admin_footer', [$this, 'render_template_editor'] );

    }

    /**
     * Add speech template editor form to the page.
     *
     * @since  3.0.0
     * @access public
     *
     * @throws ApiException
     * @return void
     **/
    public function render_template_editor() {
        ?>
        <div id="mdp-speaker-template-speech-template-editor" class="mdc-hidden">
            <div id="mdp-speaker-speech-template-editor-box">
                <iframe id="mdp-speaker-speech-template-editor-iframe" src=""></iframe>
                <div class="mdp-iframe-preloader"><div></div></div>
                <div class="mdp-side-panel">
                    <header>
                        <h4 class="mdp-title"><?php esc_html_e( 'Speech Template Editor', 'speaker' ); ?><span>beta</span></h4>
                        <button class="mdp-close-btn mdc-icon-button material-icons mdc-ripple-upgraded mdc-ripple-upgraded--unbounded" title="<?php esc_html_e( 'Close Speech Template Editor', 'speaker' ); ?>">close</button>
                    </header>

                    <main>

                        <?php $this->render_template_name(); // Render template name filed. ?>

                        <div class="mdp-list-box">
                            <p class="mdp-stb-subtitle mdc-hidden"><?php esc_html_e( 'Template Elements', 'speaker' ); ?></p>
                            <ul id="mdp-speaker-st-list" class="mdc-list mdc-list--two-line"></ul>
                            <p class="mdp-stb-info"><?php esc_html_e( 'Click on one of the elements in the page preview to add this element for speech synthesis.', 'speaker' ); ?></p>
                            <p class="mdp-stb-info mdp-help-1 mdc-hidden"><?php esc_html_e( 'Drag and drag an item to change the voicing order.', 'speaker' ); ?></p>
                            <p class="mdp-stb-info mdp-help-2 mdc-hidden"><?php esc_html_e( 'Click on the pencil icon to edit an item.', 'speaker' ); ?></p>
                            <p class="mdp-stb-info mdp-help-3 mdc-hidden"><?php esc_html_e( 'Ctrl+Click or ⌘+Click to simulate a click to the page to open a tab or hidden content.', 'speaker' ); ?></p>

                            <p class="mdp-stb-help">
                                <span class="material-icons">info</span>
                                <a href="https://docs.merkulov.design/speech-templates/" target="_blank" rel="noopener"><?php esc_html_e( 'Need help?', 'speaker' ); ?></a>
                            </p>
                        </div>

                        <div id="mdp-speaker-element-form" class="mdc-hidden">

                            <div class="mdp-element-form-wrap">

                                <div class="mdp-element-form">

                                    <div>
                                        <?php

                                        /** Render form title and close button. */
                                        $this->render_header();

                                        /** Render element name filed. */
                                        $this->render_name();

                                        /** Render xPath input. */
                                        $this->render_xpath();

                                        /** Render content textarea. */
                                        $this->render_content();

                                        /** Render Language. */
                                        $this->render_language();

                                        /** Render Say As. */
                                        $this->render_say_as();

                                        /** Render Emphasis. */
                                        $this->render_emphasis();

                                        /** Render Pause Time. */
                                        $this->render_pause_time();

                                        /** Render Pause Strength. */
                                        $this->render_pause_strength();

                                        ?>

                                    </div>

                                </div>
                                <button class="mdp-close-btn mdc-icon-button material-icons mdc-ripple-upgraded mdc-ripple-upgraded--unbounded" title="Close Element Editor">close</button>

                                <?php
                                /** Render Actions Buttons. */
                                $this->render_dialog_actions();
                                ?>

                            </div>

                        </div>

                    </main>

                    <footer>
                        <div class="mdc-menu-surface--anchor">
                            <button class="mdp-add-btn mdc-button mdc-button--outlined mdc-ripple-upgraded">
                                <span class="mdc-button__ripple"></span>
                                <i class="material-icons mdc-button__icon">add</i>
                                <span class="mdc-button__label"><?php esc_html_e( 'Add Element', 'speaker' ); ?></span>
                            </button>

                            <div class="mdc-menu mdc-menu-surface" data-open="false">
                                <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical" tabindex="-1">
                                    <li class="mdp-add-element mdc-list-item" role="menuitem">
                                        <span class="mdc-list-item__text"><?php esc_html_e( 'Element', 'speaker' ); ?></span>
                                    </li>
                                    <li class="mdp-add-text mdc-list-item" role="menuitem">
                                        <span class="mdc-list-item__text"><?php esc_html_e( 'Text', 'speaker' ); ?></span>
                                    </li>
                                    <li class="mdp-add-pause mdc-list-item" role="menuitem">
                                        <span class="mdc-list-item__text"><?php esc_html_e( 'Pause', 'speaker' ); ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <button class="mdp-st-save-btn mdc-button mdc-button--dense mdc-button--raised mdc-ripple-upgraded" disabled="disabled">
                            <span class="mdc-button__ripple"></span>
                            <span class="mdc-button__label"><?php esc_html_e( 'Save Speech Template', 'speaker' ); ?></span>
                        </button>
                    </footer>

                </div>
            </div>
        </div>
        <?php

    }


    /**
     * Render dialog buttons.
     *
     * @since  3.0.0
     * @access public
     *
     * @return void
     **/
    private function render_dialog_actions() {
        ?>
        <footer class="mdc-dialog__actions">
            <button class="mdp-cancel-btn mdc-button mdc-button--outlined mdc-ripple-upgraded">
                <span class="mdc-button__ripple"></span>
                <span class="mdc-button__label"><?php esc_html_e( 'Cancel', 'speaker' ); ?></span>
            </button>
            <button class="mdp-save-btn mdc-button mdc-button--dense mdc-button--raised mdc-ripple-upgraded">
                <span class="mdc-button__ripple"></span>
                <span class="mdc-button__label"><?php esc_html_e( 'Save', 'speaker' ); ?></span>
            </button>
        </footer>
        <?php
    }

    /**
     * Render content textarea.
     *
     * @since  3.0.0
     * @access public
     *
     * @return void
     **/
    private function render_content() {

        ?><div class="mdp-speaker-content-box"><?php

        /** Render Content textarea. */
        UI::get_instance()->render_textarea(
            '',
            esc_html__( 'Content', 'speaker'),
            esc_html__( 'This content will be voiced.', 'speaker' ),
            [
                'name'  => 'mdp-speaker-element-form-content',
                'id'    => 'mdp-speaker-element-form-content'
            ]
        );

        ?></div><?php

    }

    /**
     * Render xPath input.
     *
     * @since  3.0.0
     * @access public
     *
     * @return void
     **/
    private function render_xpath() {

        ?><div class="mdp-speaker-xpath-box"><?php

        /** Render xPath input. */
        UI::get_instance()->render_input(
            '',
            esc_html__( 'xPath', 'speaker'),
            esc_html__( 'Enter xPath for selecting part to speech. Edit this field only if you understand what you are doing.', 'speaker' ),
            [
                'name'          => 'mdp-speaker-element-form-xpath',
                'id'            => 'mdp-speaker-element-form-xpath',
                'spellcheck'    => 'false'
            ]
        );

        ?></div><?php

    }

    /**
     * Render template name field.
     *
     * @since  3.0.0
     * @access public
     *
     * @return void
     **/
    private function render_template_name() {

        ?><div class="mdp-speaker-template-name-box"><?php

        /** Render Template Name input. */
        UI::get_instance()->render_input(
            'New Template',
            esc_html__( 'Template Name', 'speaker'),
            '',
            [
                'name'      => 'mdp-speaker-template-name',
                'id'        => 'mdp-speaker-template-name',
                'required'  => 'required'
            ]
        );

        ?></div><?php

    }

    /**
     * Render element name filed.
     *
     * @since  3.0.0
     * @access public
     *
     * @return void
     **/
    private function render_name() {

        ?><div class="mdp-speaker-name-box"><?php

        /** Render Name input. */
        UI::get_instance()->render_input(
            '',
            esc_html__( 'Name', 'speaker'),
            esc_html__( 'Enter name for current item. This field will not be voiced.', 'speaker' ),
            [
                'name'      => 'mdp-speaker-element-form-name',
                'id'        => 'mdp-speaker-element-form-name',
                'required'  => 'required'
            ]
        );

        ?></div><?php

    }

    /**
     * Render form title and close button.
     *
     * @since  3.0.0
     * @access public
     *
     * @return void
     **/
    private function render_header() {
        ?>
        <h3 class="mdp-title"></h3>
        <?php
    }

    /**
     * Render Languages fields.
     *
     * @since  3.0.0
     * @access public
     *
     * @throws ApiException
     * @return void
     **/
    private function render_language() {

        ?>
        <div class="mdp-speaker-voice-box">
            <div><?php esc_html_e( 'Voice now used:', 'speaker' ); ?></div>

            <?php
            /** Render current language. */
            SettingsFields::current_language();
            ?>

            <?php
            /** Render languages. */
            SettingsFields::language();
            ?>

        </div>
        <?php

    }

    /**
     * Render Say as field in element edit form.
     *
     * @since 3.0.0
     * @access public
     *
     * @return void
     **/
    private function render_say_as() {

        /** Prepare options for select. */
        $options = [
            'none'       => esc_html__( 'None', 'speaker' ),
            'cardinal'   => esc_html__( 'Cardinal', 'speaker' ),
            'ordinal'    => esc_html__( 'Ordinal', 'speaker' ),
            'characters' => esc_html__( 'Characters', 'speaker' ),
            'fraction'   => esc_html__( 'Fraction', 'speaker' ),
            'expletive'  => esc_html__( 'Expletive', 'speaker' ),
            'unit'       => esc_html__( 'Unit', 'speaker' ),
            'verbatim'   => esc_html__( 'Verbatim', 'speaker' ),
            // TODO: Add date and time
        ];

        ?><div class="mdp-speaker-say-as-box"><?php

        /** Render select. */
        UI::get_instance()->render_select(
            $options,
            '',
            esc_html__( 'Say As', 'speaker' ),
            esc_html__( 'This option lets you indicate information about the type of text construct that is contained within the element.', 'speaker' ),
            [
                'name' => 'mdp-speaker-element-form-say-as',
                'id' => 'mdp-speaker-element-form-say-as'
            ]
        );

        ?></div><?php

    }

    /**
     * Render Pause Strength field in element edit form.
     *
     * @since 3.0.0
     * @access public
     *
     * @return void
     **/
    private function render_pause_strength() {

        /** Prepare options for select. */
        $options = [
            'none'     => esc_html__( 'None', 'speaker' ),
            'x-weak'   => esc_html__( 'X-Weak', 'speaker' ),
            'weak'     => esc_html__( 'Weak', 'speaker' ),
            'medium'   => esc_html__( 'Medium', 'speaker' ),
            'strong'   => esc_html__( 'Strong', 'speaker' ),
            'x-strong' => esc_html__( 'X-Strong', 'speaker' ),
        ];

        ?><div class="mdp-speaker-strength-box"><?php

        /** Render select. */
        UI::get_instance()->render_select(
            $options,
            '',
            esc_html__( 'Strength', 'speaker' ),
            esc_html__( 'Sets the strength of the output\'s prosodic break by relative terms.', 'speaker' ),
            [
                'name' => 'mdp-speaker-element-form-strength',
                'id' => 'mdp-speaker-element-form-strength'
            ]
        );

        ?></div><?php

    }

    /**
     * Render Pause Time field in element edit form.
     *
     * @since 3.0.0
     * @access public
     *
     * @return void
     **/
    private function render_pause_time() {

        ?><div class="mdp-speaker-time-box"><?php

        /** Render slider. */
        UI::get_instance()->render_slider(
            '300',
            50,
            10000,
            50,
            esc_html__( 'Time', 'speaker'),
            esc_html__( 'Current length of the pause:', 'speaker') . ' <strong>300</strong> ' . esc_html__( 'ms', 'speaker' ),
            [
                'name' => 'mdp-speaker-element-form-time',
                'class' => 'mdc-slider-width',
                'id' => 'mdp-speaker-element-form-time'
            ],
            false
        );

        ?></div><?php
    }

    /**
     * Render Emphasis field in element edit form.
     *
     * @since 3.0.0
     * @access public
     *
     * @return void
     **/
    private function render_emphasis() {

        /** Prepare options for select. */
        $options = [
            'none'     => esc_html__( 'None', 'speaker' ),
            'strong'   => esc_html__( 'Strong', 'speaker' ),
            'moderate' => esc_html__( 'Moderate', 'speaker' ),
            'reduced'  => esc_html__( 'Reduced', 'speaker' ),
        ];

        ?><div class="mdp-speaker-emphasis-box"><?php

        /** Render select. */
        UI::get_instance()->render_select(
            $options,
            '',
            esc_html__( 'Emphasis', 'speaker' ),
            esc_html__( 'This option lets you add or remove emphasis from text contained by the element.', 'speaker' ),
            [
                'name' => 'mdp-speaker-element-form-emphasis',
                'id' => 'mdp-speaker-element-form-emphasis'
            ]
        );

        ?></div><?php

    }

    /**
     * Return array with all Speech Templates.
     *
     * @since  3.0.0
     * @access public
     *
     * @return array
     **/
    public function get_st_options() {

        $options = [ 'content' => esc_html__( 'Content', 'speaker' ) ];

        /** @noinspection ClassConstantCanBeUsedInspection */
        if ( ! class_exists( '\Merkulove\SpeakerUtilities' ) ) {
            return $options;
        }

        /** Read all ST from settings. */
        /** In this option we store all Speech Templates. */
        $st_opt_name = 'mdp_speaker_speech_templates';

        /** Get all Speech Templates. */
        $st = get_option( $st_opt_name, false );

        /** Return if no ST. */
        if ( ! $st ) { return $options; }

        /** If We have any ST. */
        if ( count( $st )  ) {

            /** Add add ST to list. */
            foreach ( $st as $template ) {

                $options[$template['id']] = $template['name'];

            }

        }

        return $options;

    }

    /**
     * Return default ST for current post type.
     *
     * @param null $post_type
     *
     * @since  3.0.0
     * @access public
     *
     * @return string
     **/
    public function get_default_st( $post_type = null ) {

        /** Use current post type if nothing received. */
        if ( ! isset( $post_type ) ) {

            /** Retrieves the post type of the current post. */
            $post_type = get_post_type();

        }

        /** In this option we store all Speech Templates. */
        $st_opt_name = 'mdp_speaker_speech_templates';

        /** Get all Speech Templates. */
        $st = get_option( $st_opt_name, false );

        /** We haven't any ST. */
        if ( ! $st ) { return ''; }

        /** For each ST. */
        foreach ( $st as $key => $template ) {

            /** Skip if empty. */
            if ( ! isset( $st[$key]['default'] ) ) { continue; }

            /** Skip if not array. */
            if ( ! is_array( $st[$key]['default'] ) ) { continue; }

            if ( in_array( $post_type, $st[$key]['default'], false ) ) {

                return $st[$key]['id'];

            }

        }

        return '';

    }

	/**
	 * Main MetaBox Instance.
	 *
	 * Insures that only one instance of MetaBox exists in memory at any one time.
	 *
	 * @static
	 * @return MetaBox
	 * @since 3.0.0
	 **/
	public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {

			self::$instance = new self;

		}

		return self::$instance;

	}

} // End Class MetaBox.
