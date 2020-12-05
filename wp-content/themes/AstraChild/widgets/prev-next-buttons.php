<?php
namespace Elementor;

class Prev_Next_Buttons_Widget extends Widget_Base {

	public function get_name() {
		return 'prev-next-buttons';
	}

	public function get_title() {
		return 'Previous, Next Buttons';
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
    echo "<style>.prev-next-buttons-box{text-align:center}.prev-next-buttons-box a{width:120px;display:inline-block;text-align:center;margin:0;padding:10px;text-decoration:none;color:#000}.prev-next-buttons-box .prevButton{background:#26b7ee}.prev-next-buttons-box .nextButton{background:#1383e4}.prev-next-buttons-box a:hover{background:#ffcd3a}</style><div class='prev-next-buttons-box'><a class='prevButton' href='#'>Previous</a><a class='nextButton' href='#'>Next</a></div>";
  }

	protected function _content_template() {
  }

}
