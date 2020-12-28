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

use Merkulove\Speaker\SpeakerCaster;

/** @noinspection PhpUnused */
class vceSpeaker {

	/**
	 * Get things started.
     *
     * @since 3.0.0
	 * @access public
	 **/
	public function __construct() {

		/** Speaker VC Element map. */
        $this->vce_speaker_map();

		/** Shortcode for Speaker Element. */
		add_shortcode('vce_speaker', [$this, 'vce_speaker_render'] );

	}

	/**
	 * Shortcode [vce_speaker] output.
	 *
	 * @param $atts array - Shortcode parameters.
	 *
	 * @since 3.0.0
	 * @access public
     *
     * @return false|string
	 **/
	public function vce_speaker_render( $atts ) {

	    /** Prepare element parameters. */
		$css = '';

		extract( shortcode_atts( [
			'css' => ''
		], $atts ) );

		/** Prepare custom css from css_editor. */
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, '' ), 'vce_speaker', $atts );

		ob_start(); ?>
		<div class="mdp-vce-speaker-box <?php echo esc_attr( $css_class ); ?>" ><?php echo SpeakerCaster::get_instance()->get_player(); ?></div>
		<?php

		return ob_get_clean();
	}

	/**
	 * Speaker VC Element map.
     *
     * @return void
	 **/
	public function vce_speaker_map() {

		vc_map( [
			'name'                      => esc_html__( 'Speaker', 'speaker' ),
			'description'               => esc_html__( 'Create an audio version of your posts, with a selection of more than 200 voices across 35+ languages and variants.', 'speaker' ),
			'base'                      => 'vce_speaker',
			'icon'                      => 'icon-vce-speaker',
			'category'                  => esc_html__( 'Social', 'speaker' ),
			'show_settings_on_create'   => false,
			'params'                    => [
				[
					'param_name'    => 'css',
					'type'          => 'css_editor',
					'heading'       => esc_html__( 'Css', 'speaker' ),
					'group'         => esc_html__( 'Design options', 'speaker' ),
				]
			],
		] );

	}

} // END Class vceSpeaker.

/** Run Speaker Element. */
new vceSpeaker();