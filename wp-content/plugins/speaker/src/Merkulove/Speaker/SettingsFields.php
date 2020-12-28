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
use Google\ApiCore\ApiException;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * SINGLETON: Class used to render plugin settings fields.
 *
 * @since 1.0.0
 * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 **/
final class SettingsFields {

	/**
	 * The one true SettingsFields.
	 *
	 * @var SettingsFields
	 * @since 1.0.0
	 **/
	private static $instance;

	/**
	 * Render Download link field.
	 *
	 * @since 2.0.0
	 * @access public
	 **/
	public static function link() {

		$options = [
			'none' => esc_html__( 'Do not show', 'speaker' ),
			'backend' => esc_html__( 'Backend Only', 'speaker' ),
			'frontend' => esc_html__( 'Frontend Only', 'speaker' ),
			'backend-and-frontend' => esc_html__( 'Backend and Frontend', 'speaker' )
		];

		/** Render select. */
		UI::get_instance()->render_select(
			$options,
			Settings::get_instance()->options['link'], // Selected option.
			esc_html__( 'Download link', 'speaker' ),
			esc_html__( 'Position of the Download audio link', 'speaker' ),
			[
                'name' => 'mdp_speaker_design_settings[link]',
                'id' => 'mdp-speaker-design-settings-link'
            ]
		);

	}

	/**
	 * Render Before Audio field.
	 *
	 * @since 2.0.0
	 * @access public
     *
     * @noinspection PhpUnused
	 **/
	public static function before_audio() {

		/** Render input. */
		UI::get_instance()->render_input(
			Settings::get_instance()->options['before_audio'],
			esc_html__( 'Before Audio', 'speaker'),
			esc_html__( 'Add text before audio(intro).', 'speaker' ),
			[
                'name'      => 'mdp_speaker_settings[before_audio]',
                'id'        => 'mdp-speaker-settings-before-audio',
                'maxlength' => '4500'
            ]
		);

	}

    /**
     * Render Read the Title field.
     *
     * @since 3.0.0
     * @access public
     *
     * @noinspection PhpUnused
     **/
    public static function read_title() {

        /** Render Read the Title switcher. */
        UI::get_instance()->render_switches(
            Settings::get_instance()->options['read_title'],
            esc_html__( 'Read the Title', 'speaker' ),
            esc_html__( 'Include title in audio version.', 'speaker' ),
            [
                'name' => 'mdp_speaker_settings[read_title]',
                'id' => 'mdp-speaker-settings-read-title'
            ]
        );

    }

	/**
	 * Render Auto Generation field.
	 *
	 * @since 2.0.0
	 * @access public
     *
     * @noinspection PhpUnused
	 **/
	public static function auto_generation() {

		/** Render Auto Generation switcher. */
		UI::get_instance()->render_switches(
			Settings::get_instance()->options['auto_generation'],
			esc_html__( 'Synthesize audio on save', 'speaker' ),
			esc_html__( 'This significantly increases your expenses in Google Cloud.', 'speaker' ),
			[
				'name' => 'mdp_speaker_settings[auto_generation]',
				'id' => 'mdp_speaker_settings_auto_generation'
			]
		);

	}

	/**
	 * Render After Audio field.
	 *
	 * @since 2.0.0
	 * @access public
	 *
     * @noinspection PhpUnused
     **/
	public static function after_audio() {

		/** Render input. */
		UI::get_instance()->render_input(
			Settings::get_instance()->options['after_audio'],
			esc_html__( 'After Audio', 'speaker'),
			esc_html__( 'Add a text after audio(outro).', 'speaker' ),
			[
                'name'      => 'mdp_speaker_settings[after_audio]',
                'id'        => 'mdp-speaker-settings-after-audio',
                'maxlength' => '4500'
            ]
		);

	}

	/**
	 * Render Player Position field.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public static function position() {

		$options = [
			"before-content" => esc_html__( 'Before Content', 'speaker' ),
			"after-content" => esc_html__( 'After Content', 'speaker' ),
			"top-fixed" => esc_html__( 'Top Fixed', 'speaker' ),
			"bottom-fixed" => esc_html__( 'Bottom Fixed', 'speaker' ),
			"before-title" => esc_html__( 'Before Title', 'speaker' ),
			"after-title" => esc_html__( 'After Title', 'speaker' ),
			"shortcode" => esc_html__( 'Shortcode [speaker]', 'speaker' )
		];

		/** Render select. */
		UI::get_instance()->render_select(
			$options,
			Settings::get_instance()->options['position'], // Selected option.
			esc_html__('Position', 'speaker' ),
			esc_html__( 'Select the Player position or use shortcode.', 'speaker' ),
			['name' => 'mdp_speaker_design_settings[position]']
		);

	}

    /**
     * Render Default Speech Templates field.
     *
     * @since 3.0.0
     * @access public
     **/
    public static function default_templates() {

        /** All available post types. */
        $custom_posts = self::get_cpt();

        /** Prepare options for ST select. */
        $options = MetaBox::get_instance()->get_st_options();

        ?>
        <div class="mdc-data-table">
            <table id="mdp-custom-posts-tbl" class="mdc-data-table__table" aria-label="<?php esc_attr_e( 'Default Speech Templates', 'speaker' ); ?>">
                <thead>
                    <tr class="mdc-data-table__header-row">
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col"><?php esc_html_e( 'Post Type', 'speaker' ); ?></th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col"><?php esc_html_e( 'Default Speech Template', 'speaker' ); ?></th>
                    </tr>
                </thead>
                <tbody class="mdc-data-table__content">
                    <?php foreach ( $custom_posts as $key => $post_type ) : ?>
                        <tr class="mdc-data-table__row">
                            <td class="mdp-post-type mdp-sc-name mdc-data-table__cell">
                                <span data-post-type="<?php esc_attr_e( $key ); ?>">
                                    <?php esc_html_e( $post_type ); ?>
                                    <span>(<?php esc_html_e( $key ); ?>)</span>
                                </span>
                            </td>
                            <td class="mdp-sc-name mdc-data-table__cell">

                                <?php

                                /** Return default ST for current post type. */
                                $default = MetaBox::get_instance()->get_default_st( $key );

                                /** Render Speech Template Select. */
                                UI::get_instance()->render_select(
                                $options,
                                $default, // Selected option.
                                esc_html__( 'Speech Template', 'speaker' ),
                                '',
                                [
                                    'name' => 'mdp_speaker_default_speech_template_for__' . $key,
                                    'id' => 'mdp-speaker-default-speech-template-for--' . $key
                                ] );

                                ?>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php

    }

	/**
	 * Render Post Types field.
	 *
	 * @since 3.0.0
	 * @access public
	 **/
	public static function cpt_support() {

		/** All available post types. */
		$options = self::get_cpt();

		UI::get_instance()->render_chosen_dropdown(
			$options,
			Settings::get_instance()->options['cpt_support'],
			esc_html__( 'Select post types for which the plugin will work.', 'speaker' ),
			[
				'name' => 'mdp_speaker_post_types_settings[cpt_support][]',
				'id' => 'mdp-speaker-post-types-settings-cpt-support',
				'multiple' => 'multiple',
			]
		);

	}

	/**
	 * Return list of Custom Post Types.
	 *
	 * @param array $cpt Array with posts types to exclude.
	 *
	 * @since 3.0.0
	 * @access private
	 * @return array
	 **/
	private static function get_cpt( $cpt = [] ) {

		$defaults = [
			'exclude' => [
                'attachment',
                'elementor_library',
                'notification'
            ],
		];

		$cpt = array_merge( $defaults, $cpt );

		$post_types_objects = get_post_types(
			[
				'public' => true,
			], 'objects'
		);

		/**
		 * Filters the list of post type objects used by plugin.
		 *
		 * @since 3.0.0
		 *
		 * @param array $post_types_objects List of post type objects used by plugin.
		 **/
		$post_types_objects = apply_filters( 'speaker/post_type_objects', $post_types_objects );

		$cpt['options'] = [];

		foreach ( $post_types_objects as $cpt_slug => $post_type ) {

			if ( in_array( $cpt_slug, $cpt['exclude'], true ) ) {
				continue;
			}

			$cpt['options'][ $cpt_slug ] = $post_type->labels->name;

		}

		return $cpt['options'];

	}

	/**
	 * Render Style field.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public static function style() {

		$options = [
			'speaker-round' => esc_html__( 'Round player', 'speaker' ),
			'speaker-rounded' => esc_html__( 'Rounded player', 'speaker' ),
			'speaker-squared' => esc_html__( 'Squared player', 'speaker' ),
			'speaker-wp-default' => esc_html__( 'WordPress default player', 'speaker' ),
			'speaker-browser-default' => esc_html__( 'Browser default player', 'speaker' )
		];

		/** Render select. */
		UI::get_instance()->render_select(
			$options,
			Settings::get_instance()->options['style'], // Selected option.
			esc_html__( 'Player Style', 'speaker' ),
			esc_html__( 'Select one of the Player styles', 'speaker' ),
			['name' => 'mdp_speaker_design_settings[style]']
		);

	}

	/**
	 * Render Player Background Color field.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public static function bgcolor() {

		/** Render colorpicker. */
		UI::get_instance()->render_colorpicker(
			Settings::get_instance()->options['bgcolor'],
			esc_html__( 'Background Color', 'speaker' ),
			esc_html__( 'Select the Player background-color', 'speaker' ),
			[
				'name' => 'mdp_speaker_design_settings[bgcolor]',
				'id' => 'mdp-speaker-bgcolor',
				'readonly' => 'readonly'
			]
		);

	}

	/**
	 * Render Pitch field.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public static function pitch() {

		/** Render slider. */
		UI::get_instance()->render_slider(
			Settings::get_instance()->options['pitch'],
			-20,
			20,
			0.1,
			esc_html__( 'Pitch', 'speaker'),
			esc_html__( 'Current pitch:', 'speaker') . ' <strong>' . esc_html( Settings::get_instance()->options['pitch'] ) . '</strong>',
			[
				'name' => 'mdp_speaker_settings[pitch]',
				'class' => 'mdc-slider-width',
				'id' => 'mdp_speaker_settings_pitch'
			],
			false
		);

	}

    /**
     * Render Volume Gain field.
     *
     * @since 3.0.0
     * @access public
     **/
    public static function volume() {

        /** Render slider. */
        UI::get_instance()->render_slider(
            Settings::get_instance()->options['volume'],
            -10,
            15,
            0.1,
            esc_html__( 'Volume Gain', 'speaker'),
            esc_html__( 'Current volume gain:', 'speaker') .
            ' <strong>' . esc_html( Settings::get_instance()->options['volume'] ) . '</strong>' .
            esc_html__( ' dB', 'speaker'),
            [
                'name' => 'mdp_speaker_settings[volume]',
                'class' => 'mdc-slider-width',
                'id' => 'mdp-speaker-settings-volume'
            ],
            false
        );

    }

	/**
	 * Render Speaking Rate/Speed field.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public static function speaking_rate() {

		/** Render slider. */
		UI::get_instance()->render_slider(
			Settings::get_instance()->options['speaking-rate'],
			0.25,
			4.0,
			0.25,
			esc_html__( 'Speaking Rate/Speed', 'speaker'),
			esc_html__( 'Speaking rate:', 'speaker') . ' <strong>' . esc_html( Settings::get_instance()->options['speaking-rate'] ) . '</strong><br>',
			[
				'name' => 'mdp_speaker_settings[speaking-rate]',
				'class' => 'mdc-slider-width',
				'id' => 'mdp_speaker_settings_rate'
			],
			false
		);

	}

	/**
	 * Render Audio Profile field.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public static function audio_profile() {

		/** Prepare options for select. */
		$options = [
			'wearable-class-device' => esc_html__( 'Smart watches and other wearables', 'speaker' ),
			'handset-class-device' => esc_html__( 'Smartphones', 'speaker' ),
			'headphone-class-device' => esc_html__( 'Earbuds or headphones', 'speaker' ),
			'small-bluetooth-speaker-class-device' => esc_html__( 'Small home speakers', 'speaker' ),
			'medium-bluetooth-speaker-class-device' => esc_html__( 'Smart home speakers', 'speaker' ),
			'large-home-entertainment-class-device' => esc_html__( 'Home entertainment systems', 'speaker' ),
			'large-automotive-class-device' => esc_html__( 'Car speakers', 'speaker' ),
			'telephony-class-application' => esc_html__( 'Interactive Voice Response', 'speaker' ),
		];

		/** Render select. */
		UI::get_instance()->render_select(
			$options,
			Settings::get_instance()->options['audio-profile'], // Selected option.
			esc_html__( 'Audio Profile', 'speaker' ),
			esc_html__( 'Optimize the synthetic speech for playback on different types of hardware.', 'speaker' ),
			['name' => 'mdp_speaker_settings[audio-profile]']
		);

	}

	/**
	 * Return language name by code.
	 *
	 * @param $lang_code - Google language code.
	 *
	 * @since 1.0.0
	 * @access public
     *
	 * @return string|false
     *
	 **/
	public static function get_lang_by_code( $lang_code ) {

		if ( is_object( $lang_code ) ) {
			$lang_code = $lang_code[0];
		}

		/** @noinspection SpellCheckingInspection */
		$languages = [
			'da-DK'  => 'Danish (Dansk)',
			'nl-NL'  => 'Dutch (Nederlands)',
			'en-AU'  => 'English (Australian)',
			'en-GB'  => 'English (UK)',
			'en-US'  => 'English (US)',
			'fr-CA'  => 'French Canada (Français)',
			'fr-FR'  => 'French France (Français)',
			'de-DE'  => 'German (Deutsch)',
			'it-IT'  => 'Italian (Italiano)',
			'ja-JP'  => 'Japanese (日本語)',
			'ko-KR'  => 'Korean (한국어)',
			'nb-NO'  => 'Norwegian (Norsk)',
			'pl-PL'  => 'Polish (Polski)',
			'pt-BR'  => 'Portuguese Brazil (Português)',
			'pt-PT'  => 'Portuguese Portugal (Portugal)',
			'ru-RU'  => 'Russian (Русский)',
			'sk-SK'  => 'Slovak (Slovenčina)',
			'es-ES'  => 'Spanish (Español)',
			'sv-SE'  => 'Swedish (Svenska)',
			'tr-TR'  => 'Turkish (Türkçe)',
			'uk-UA'  => 'Ukrainian (Українська)',
			'ar-XA'  => 'Arabic (العربية)',
			'cs-CZ'  => 'Czech (Čeština)',
			'el-GR'  => 'Greek (Ελληνικά)',
			'en-IN'  => 'Indian English',
			'fi-FI'  => 'Finnish (Suomi)',
			'vi-VN'  => 'Vietnamese (Tiếng Việt)',
			'id-ID'  => 'Indonesian (Bahasa Indonesia)',
			'fil-PH' => 'Philippines (Filipino)',
			'hi-IN'  => 'Hindi (हिन्दी)',
			'hu-HU'  => 'Hungarian (Magyar)',
			'cmn-CN' => 'Chinese (官话)',
			'cmn-TW' => 'Taiwanese Mandarin (中文(台灣))',
			'bn-IN' => 'Bengali (বাংলা)',
			'gu-IN' => 'Gujarati (ગુજરાતી)',
			'kn-IN' => 'Kannada (ಕನ್ನಡ)',
			'ml-IN' => 'Malayalam (മലയാളം)',
			'ta-IN' => 'Tamil (தமிழ்)',
			'te-IN' => 'Telugu (తెలుగు)',
			'th-TH'  => 'Thai (ภาษาไทย)',
            'yue-HK' => 'Yue Chinese',
		];

		/** If we inside, this means that a new language has added. */
		if ( ! array_key_exists( $lang_code, $languages ) ) {

		    /** Render "New Languages" message. */
			self::show_new_languages_snackbar();

			return false;

        }

		return $languages[ $lang_code ];

	}

	/**
	 * Render "New Languages" message.
	 *
	 * @return string
	 * @since 3.0.0
	 * @access public
     *
     * @return void|null
	 **/
	private static function show_new_languages_snackbar() {

		/** Run only Once. */
		static $already_run = false;
		if ( $already_run === true ) { return; }
		$already_run = true;

		/** Render "New Languages" message. */
		UI::get_instance()->render_snackbar(
			esc_html__( 'There are new languages available. Update your copy of the Speaker plugin to ensure the best compatibility.', 'speaker' ),
			'error', // Type
			-1, // Timeout
			true, // Is Closable
			[ [ 'caption' => 'Update Speaker', 'link' => 'https://1.envato.market/speaker' ] ] // Buttons
		);

        /** @noinspection UselessReturnInspection */
        return;

    }

	/**
	 * Return Voice Type.
	 *
	 * @param $lang_name - Google voice name.
	 *
	 * @return string
	 * @since 1.0.0
	 * @access public
	 **/
	public static function get_voice_type( $lang_name ) {

		$pos = strpos( $lang_name, 'Wavenet' );

		if ( $pos === false ) {
			return '<img src="' . Speaker::$url . 'images/standard.svg" alt="' . esc_attr( 'Standard' ) . '">' . esc_html( 'Standard' );
		}

        return '<img src="' . Speaker::$url . 'images/wavenet.svg" alt="' . esc_attr( 'WaveNet' ) . '">' . esc_html( 'WaveNet' );

    }

	/**
	 * Render Drag & Drop API Key field.
	 *
	 * @since 3.0.0
	 * @access public
	 **/
	public static function dnd_api_key() {

		$key_exist = false;
		if ( Settings::get_instance()->options['dnd-api-key'] ) { $key_exist = true; }

	    ?>
        <div class="mdp-dnd">
            <!--suppress HtmlFormInputWithoutLabel -->
            <div class="mdc-text-field mdc-input-width mdc-text-field--outlined mdc-hidden">
                <!--suppress HtmlFormInputWithoutLabel -->
                <input  type="text"
                        class="mdc-text-field__input"
                        name="mdp_speaker_settings[dnd-api-key]"
                        id="mdp-speaker-settings-dnd-api-key"
                        value="<?php esc_attr_e( Settings::get_instance()->options['dnd-api-key'] ); ?>"
                >
                <div class="mdc-notched-outline mdc-notched-outline--upgraded mdc-notched-outline--notched">
                    <div class="mdc-notched-outline__leading"></div>
                    <div class="mdc-notched-outline__notch">
                        <label for="mdp-speaker-settings-dnd-api-key" class="mdc-floating-label mdc-floating-label--float-above"><?php esc_html_e( 'API Key', 'speaker' ); ?></label>
                    </div>
                    <div class="mdc-notched-outline__trailing"></div>
                </div>
            </div>
            <div id="mdp-api-key-drop-zone" class="<?php if ( $key_exist ) : ?>mdp-key-uploaded<?php endif; ?>">
                <?php if ( $key_exist ) : ?>
                    <span class="material-icons">check_circle_outline</span><?php esc_html_e( 'API Key file exist', 'speaker' ); ?>
                    <span class="mdp-drop-zone-hover"><?php esc_html_e( 'Drop Key file here or click to upload', 'speaker' ); ?></span>
                <?php else : ?>
                    <span class="material-icons">cloud</span><?php esc_html_e( 'Drop Key file here or click to upload.', 'speaker' ); ?>
                <?php endif; ?>
            </div>
            <?php if ( $key_exist ) : ?>
                <div class="mdp-messages mdc-text-field-helper-line mdc-text-field-helper-text mdc-text-field-helper-text--persistent">
                    <?php esc_html_e( 'Drag and drop or click on the form to replace API key. |', 'speaker' ); ?>
                    <a href="#" class="mdp-reset-key-btn"><?php esc_html_e( 'Reset API Key', 'speaker' ); ?></a>
                </div>
            <?php else : ?>
                <div class="mdp-messages mdc-text-field-helper-line mdc-text-field-helper-text mdc-text-field-helper-text--persistent">
                    <?php esc_html_e( 'Drag and drop or click on the form to add API key.', 'speaker' ); ?>
                </div>
            <?php endif; ?>
            <input id="mdp-dnd-file-input" type="file" name="name" class="mdc-hidden" />
        </div>
        <?php

    }

	/**
	 * Render Current Language
	 */
	public static function current_language() {

		?>
        <div class="mdp-now-used">
            <div>
                <strong><?php echo esc_attr( Settings::get_instance()->options['language'] ); ?></strong>
            </div>
            <div>
                <audio controls="">
                    <source src="https://cloud.google.com/text-to-speech/docs/audio/<?php echo esc_attr( Settings::get_instance()->options['language'] ); ?>.mp3" type="audio/mp3">
                    <source src="https://cloud.google.com/text-to-speech/docs/audio/<?php echo esc_attr( Settings::get_instance()->options['language'] ); ?>.wav" type="audio/wav">
					<?php esc_html_e( 'Your browser does not support the audio element.', 'speaker' ); ?>
                </audio>
            </div>
        </div>
		<?php

	}

	/**
	 * Render Language field.
	 *
	 * @return void
	 *
	 * @throws ApiException
	 * @since 1.0.0
	 * @access public
	 *
	 * @noinspection PhpUnhandledExceptionInspection
	 **/
	public static function language() {

        /** Setting custom exception handler. */
		set_exception_handler( [ ErrorHandler::class, 'exception_handler' ] );

		/** Create client object. */
		$client = new TextToSpeechClient();

		/** Perform list voices request. */
		$response = $client->listVoices();
		$voices   = $response->getVoices();

		/** Show a warning if it was not possible to get a list of voices. */
		if ( count( $voices ) === 0 ) {

			?>
            <div class="mdp-alert-error">
                <?php esc_html_e( 'Failed to get the list of languages. 
                The request failed. It looks like a problem with your API Key File. 
                Make sure that you are using the correct key file, and that the quotas have not been exceeded. 
                If you set security restrictions on a key, make sure that the current domain is added to the exceptions.', 'speaker' ); ?>
            </div>
            <?php

			return;

		}

		/** Prepare Languages Options. */
		$options = [];
		$options[] = esc_html__( 'Select Language', 'speaker' );
		foreach ( $voices as $voice ) {

			$lang = self::get_lang_by_code( $voice->getLanguageCodes() );

			/** Skip missing language. */
			if ( false === $lang ) { continue; }

			$options[$lang] = $lang;

		}

		/** Render Language select. */
		UI::get_instance()->render_select(
			$options,
			'',
			esc_html__('Language', 'speaker' ),
			'',
			[
				'name' => 'mdp_speaker_language_filter',
				'id' => 'mdp-speaker-language-filter'
			]
		);

		?>

        <div class="mdc-text-field-helper-line mdp-speaker-helper-padding">
            <div class="mdc-text-field-helper-text mdc-text-field-helper-text--persistent"><?php esc_html_e( 'The list includes both standard and', 'speaker' ); ?>
                <a href="https://cloud.google.com/text-to-speech/docs/wavenet"
                   target="_blank"><?php esc_html_e( 'WaveNet voices', 'speaker' ); ?></a>.
				<?php esc_html_e( 'WaveNet voices are higher quality voices with different', 'speaker' ); ?>
                <a href="https://cloud.google.com/text-to-speech/pricing"
                   target="_blank"><?php esc_html_e( 'pricing', 'speaker' ); ?></a>;
				<?php esc_html_e( 'in the list, they have the voice type "WaveNet".', 'speaker' ); ?>
            </div>
        </div>

        <table id="mdp-speaker-settings-language-tbl" class="display stripe hidden">
            <thead>
            <tr>
                <th><?php esc_html_e( 'Language', 'speaker' ); ?></th>
                <th><?php esc_html_e( 'Voice', 'speaker' ); ?></th>
                <th><?php esc_html_e( 'Gender', 'speaker' ); ?></th>
            </tr>
            </thead>
            <tbody>
			<?php

			foreach ( $voices as $voice ) : ?>

                <?php
                    $lang_name = self::get_lang_by_code( $voice->getLanguageCodes() );

                    /** Skip missing language. */
                    if ( false === $lang_name ) { continue; }
                ?>

                <tr <?php if ( $voice->getName() === Settings::get_instance()->options['language'] ) { echo 'class="selected"'; } ?>>
                    <td class="mdp-lang-name">
						<?php echo esc_html( $lang_name ); // Language. ?>
                    </td>
                    <td>
                        <span class="mdp-lang-code" title="<?php echo esc_html( $voice->getLanguageCodes()[0] ); // Language Code ?>"><?php echo esc_html( $voice->getLanguageCodes()[0] ); // Language Code  ?></span>
                        -
                        <span><?php echo self::get_voice_type( $voice->getName() ); //Voice Type ?></span>
                        -
                        <span class="mdp-voice-name" title="<?php echo esc_html( $voice->getName() ); // Voice name ?>"><?php echo esc_html( substr( $voice->getName(), -1 ) ); // Voice Variant ?></span>
                    </td>
                    <td>
						<?php
						/** SSML voice gender values from TextToSpeech\V1\SsmlVoiceGender. */
						$ssmlVoiceGender = [ 'SSML_VOICE_GENDER_UNSPECIFIED', 'Male', 'Female', 'Neutral' ];

						echo '<span title="' . esc_attr( $ssmlVoiceGender[ $voice->getSsmlGender() ], 'speaker' ) . '"><img src="' . Speaker::$url . 'images/' . strtolower( $ssmlVoiceGender[ $voice->getSsmlGender() ] ) . '.svg" alt="' . esc_attr( $ssmlVoiceGender[ $voice->getSsmlGender() ], 'speaker' ) . '">' . esc_html( $ssmlVoiceGender[ $voice->getSsmlGender() ] ) . '</span>'; ?>
                    </td>
                </tr>
			<?php
			endforeach;

			$client->close();

			?>
            </tbody>

        </table>

        <input id="mdp-speaker-settings-language" type='hidden' name='mdp_speaker_settings[language]'
               value='<?php echo esc_attr( Settings::get_instance()->options['language'] ); ?>'>
        <input id="mdp-speaker-settings-language-code" type='hidden' name='mdp_speaker_settings[language-code]'
               value='<?php echo esc_attr( Settings::get_instance()->options['language-code'] ); ?>'>
		<?php

        /** Restore previous exception handler. */
        restore_exception_handler();

	}

	/**
	 * Render CSS field.
	 *
	 * @since 3.0.0
	 * @access public
	 **/
	public static function custom_css() {
		?>
		<div>
            <label>
                <textarea
                    id="mdp_custom_css_fld"
                    name="mdp_speaker_css_settings[custom_css]"
                    class="mdp_custom_css_fld"><?php echo esc_textarea( Settings::get_instance()->options['custom_css'] ); ?></textarea>
            </label>
			<p class="description"><?php esc_html_e( 'Add custom CSS here.', 'speaker' ); ?></p>
		</div>
		<?php
	}

	/**
	 * Render "Settings Saved" nags.
	 *
     * @return void
	 * @since    3.0.0
	 **/
	public function render_nags() {

		if ( ! isset( $_GET['settings-updated'] ) ) { return; }

		if ( strcmp( $_GET['settings-updated'], 'true' ) === 0 ) {

			/** Render "Settings Saved" message. */
			UI::get_instance()->render_snackbar( esc_html__( 'Settings saved!', 'speaker' ) );

		}

		if ( ! isset( $_GET['tab'] ) ) { return; }

		if ( strcmp( $_GET['tab'], "activation" ) === 0 ) {

			if ( PluginActivation::get_instance()->is_activated() ) {

				/** Render "Activation success" message. */
				UI::get_instance()->render_snackbar( esc_html__( 'Plugin activated successfully.', 'speaker' ), 'success', 5500 );

			} else {

				/** Render "Activation failed" message. */
				UI::get_instance()->render_snackbar( esc_html__( 'Invalid purchase code.', 'speaker' ), 'error', 5500 );

			}

		}

	}

	/**
	 * Main SettingsFields Instance.
	 *
	 * Insures that only one instance of SettingsFields exists in memory at any one time.
	 *
	 * @static
	 * @return SettingsFields
	 * @since 1.0.0
	 **/
	public static function get_instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {

			self::$instance = new self;

		}

		return self::$instance;

	}

} // End Class SettingsFields.
