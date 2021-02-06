<?php
namespace Elementor;

class Practice_Rec_Playback_Widget extends Widget_Base {

	public function get_name() {
		return 'practice-rec-playback';
	}

	public function get_title() {
		return 'Practice > Record & Playback Audio';
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
				'label' => __( 'No Controls', 'elementor' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
    $settings = $this->get_settings_for_display();
    echo "<div class='recorder-box'>
  	  <button class='recordButton dual'>Record</button>
  	  <button class='stopButton dual' disabled>Stop</button>
  	  <ol class='recordingsList'></ol>
    </div>";
  }

	protected function _content_template() {
  }

}
