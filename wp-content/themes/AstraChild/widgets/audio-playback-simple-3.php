<?php
namespace Elementor;

class Audio_Playback_Simple_3_Widget extends Widget_Base {

	public function get_name() {
		return 'audio-playback-simple-3';
	}

	public function get_title() {
		return 'Audio Playback/Pause Simple';
	}

	public function get_icon() {
		return 'fa fa-play-circle';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Audio Playback Controls', 'elementor' ),
			]
		);

    $this->add_control(
			'audio',
			[
				'label' => __( 'Link to Audio File', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( '', 'elementor' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
    $settings = $this->get_settings_for_display();
		echo "<div class='player-box'>
      <button class='playButton3'>Play</button>
      <audio controls>
        <source src='$settings[audio]' type='audio/mpeg'>
      </audio>
    </div>";
  }

	protected function _content_template() {
  }

}
