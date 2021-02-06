<?php
namespace Elementor;

class Audio_Playback_Simple_Widget extends Widget_Base {

	public function get_name() {
		return 'audio-playback-simple';
	}

	public function get_title() {
		return 'Audio Playback Simple';
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
    echo "<style>.player-box{padding:1rem;text-align:center;}button{height:2rem;min-width:2rem;border:none;border-radius:.15rem;padding:0px 10px;box-shadow:inset 0 -.15rem 0 rgba(0,0,0,.2);cursor:pointer;display:inline-block;justify-content:center;align-items:center;color:#fff;font-weight:700;font-size:1rem}.plyButton{background:green;}.stpButton{background:#555;}button:focus,button:hover{outline:0;}button::-moz-focus-inner{border:0}button:active{box-shadow:inset 0 1px 0 rgba(0,0,0,.2);}.plyButton:focus, .plyButton:hover,.plyButton:active{background:darkgreen}.stpButton:focus, .stpButton:hover,.stpButton:active{background:#333;}button:disabled{pointer-events:none;background:#d3d3d3}button:first-child{margin-left:0}.player-box audio{display:none;}</style>
    <div class='player-box'>
      <button class='plyButton'>Play</button>
      <audio controls>
        <source src='$settings[audio]' type='audio/mpeg'>
      </audio>
    </div>";
  }

	protected function _content_template() {
  }

}
