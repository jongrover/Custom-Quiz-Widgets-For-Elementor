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

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

use \Elementor\Widget_Base;
use Merkulove\Speaker\SpeakerCaster;

/**
 * Speaker - Custom Elementor Widget.
 *
 * @since 3.0.0
 **/
final class speaker_elementor extends Widget_Base {

	/**
	 * Return a widget name.
	 *
	 * @return string
	 * @since 3.0.0
	 **/
	public function get_name() {

		return 'mdp-e-speaker';

	}

	/**
	 * Return the widget title that will be displayed as the widget label.
	 *
	 * @return string
	 * @since 3.0.0
	 **/
	public function get_title() {

		return esc_html__( 'Speaker', 'speaker' );

	}

	/**
	 * Set the widget icon.
	 *
	 * @return string
	 * @since 3.0.0
	 */
	public function get_icon() {

		return 'mdp-e-speaker-icon';

	}

	/**
	 * Set the category of the widget.
	 *
	 * @since 3.0.0
     *
     * @return array with category names
	 **/
	public function get_categories() {

		return ['general'];

	}

	/**
	 * Get widget keywords. Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 3.0.0
	 * @access public
     *
     * @return array Widget keywords.
	 **/
	public function get_keywords() {

		return ['Merkulove', 'Speaker', 'Voice'];

	}

	/**
	 * Add the widget controls.
	 *
	 * @since 3.0.0
	 * @access protected
     *
     * @return void with category names
	 **/
	protected function _register_controls() {

		$this->start_controls_section( 'section_image', ['label' => esc_html__( 'Content', 'speaker' )] );

		    $note = '<div class="elementor-panel-alert elementor-panel-alert-info">';
		    $note .=    esc_html__( 'To configure plugin appearance go to ', 'speaker' );
		    $note .=    '<a href="' . admin_url( 'admin.php?page=mdp_speaker_settings' ) . '" target="_blank">';
		    $note .=        esc_html__( 'Speaker settings', 'speaker' );
		    $note .=    '</a>';
		    $note .=    esc_html__( ' page', 'speaker' );
            $note .= '</div>';

            $this->add_control(
                'important_note',
	            [
		            'type' => \Elementor\Controls_Manager::RAW_HTML,
		            'raw' => $note,
	            ]
            );

		$this->end_controls_section();

	}

	/**
	 * Render Frontend Output. Generate the final HTML on the frontend.
	 *
	 * @since 3.0.0
	 * @access protected
	 **/
	protected function render() {

		?><div class="mdp-e-speaker-widget"><?php echo SpeakerCaster::get_instance()->get_player(); ?></div><?php

	}

}
