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
		return 'fa fa-question-circle';
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

		// $this->add_control(
		// 	'question',
		// 	[
		// 		'label' => __( 'Question', 'elementor' ),
		// 		'label_block' => true,
		// 		'type' => Controls_Manager::TEXT,
		// 		'placeholder' => __( 'Enter a question here', 'elementor' ),
		// 	]
		// );
    //
    // $this->add_control(
		// 	'a',
		// 	[
		// 		'label' => __( 'Answer A.', 'elementor' ),
		// 		'label_block' => true,
		// 		'type' => Controls_Manager::TEXT,
		// 		'placeholder' => __( 'Enter answer A here', 'elementor' ),
		// 	]
		// );
    //
    // $this->add_control(
		// 	'b',
		// 	[
		// 		'label' => __( 'Answer B.', 'elementor' ),
		// 		'label_block' => true,
		// 		'type' => Controls_Manager::TEXT,
		// 		'placeholder' => __( 'Enter answer B here', 'elementor' ),
		// 	]
		// );
    //
    // $this->add_control(
		// 	'c',
		// 	[
		// 		'label' => __( 'Answer C.', 'elementor' ),
		// 		'label_block' => true,
		// 		'type' => Controls_Manager::TEXT,
		// 		'placeholder' => __( 'Enter answer C here', 'elementor' ),
		// 	]
		// );
    //
    // $this->add_control(
		// 	'correct',
		// 	[
		// 		'label' => __( 'Correct Answer', 'elementor' ),
		// 		'label_block' => true,
		// 		'type' => Controls_Manager::SELECT,
		// 		'default' => 'a',
    //     'options' => [
    //       'a' => __( 'A', 'elementor'),
    //       'b' => __( 'B', 'elementor'),
    //       'c' => __( 'C', 'elementor'),
    //     ],
		// 	]
		// );

		$this->end_controls_section();
	}

	protected function render() {
    $settings = $this->get_settings_for_display();
    echo "<style>.recorder-box{padding:1rem}button{height:3.5rem;min-width:2rem;border:none;border-radius:.15rem;background:#ed341d;margin-left:2px;box-shadow:inset 0 -.15rem 0 rgba(0,0,0,.2);cursor:pointer;display:inline-block;justify-content:center;align-items:center;color:#fff;font-weight:700;font-size:1.5rem}button:focus,button:hover{outline:0;background:#c72d1c}button::-moz-focus-inner{border:0}button:active{box-shadow:inset 0 1px 0 rgba(0,0,0,.2);line-height:3rem}button:disabled{pointer-events:none;background:#d3d3d3}button:first-child{margin-left:0}audio{display:inline-block;width:300px;margin-top:.2rem}li{list-style:none;margin-bottom:1rem}.recordingsList{display:block;margin:1rem 0 0;padding:0}.recordingsList li audio{display:inline-block}.recordingsList li a{display:inline-block;margin:0;padding:1.25rem 1rem 1rem;vertical-align:top;font-size:2rem;color:#000;cursor:pointer}.recordingsList li a:hover{text-decoration:none;color:red}</style>
					<div class='recorder-box'>
        	  <button class='recordButton'>Record</button>
        	  <button class='stopButton' disabled>Stop</button>
        	  <ol class='recordingsList'></ol>
          </div>";
  }

	protected function _content_template() {
  }

}
