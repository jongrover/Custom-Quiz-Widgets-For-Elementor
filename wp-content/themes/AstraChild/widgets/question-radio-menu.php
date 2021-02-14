<?php
namespace Elementor;

class Question_Radio_Menu_Widget extends Widget_Base {

	public function get_name() {
		return 'question-radio-menu';
	}

	public function get_title() {
		return 'Question > Radio Menu';
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
				'label' => __( 'Content', 'elementor' ),
			]
		);

		$this->add_control(
			'question',
			[
				'label' => __( 'Question', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter a question here', 'elementor' ),
			]
		);

    $this->add_control(
			'a',
			[
				'label' => __( 'Answer A.', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter answer A here', 'elementor' ),
			]
		);

    $this->add_control(
			'b',
			[
				'label' => __( 'Answer B.', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter answer B here', 'elementor' ),
			]
		);

    $this->add_control(
			'c',
			[
				'label' => __( 'Answer C.', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter answer C here', 'elementor' ),
			]
		);

		$this->add_control(
			'd',
			[
				'label' => __( 'Answer D.', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter answer D here', 'elementor' ),
			]
		);

    $this->add_control(
			'correct',
			[
				'label' => __( 'Correct Answer', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => 'a',
        'options' => [
          'a' => __( 'A', 'elementor'),
          'b' => __( 'B', 'elementor'),
          'c' => __( 'C', 'elementor'),
					'd' => __( 'D', 'elementor'),
        ],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
    $settings = $this->get_settings_for_display();
    echo "<div class='question-box'>$settings[question]<br>
		        <form class='question-radio' data-correct='$settings[correct]'>
						  <input type='radio' name='answer-radio' value='a'> $settings[a]<br>
						  <input type='radio' name='answer-radio' value='b'> $settings[b]<br>
						  <input type='radio' name='answer-radio' value='c'> $settings[c]<br>
							<input type='radio' name='answer-radio' value='d'> $settings[d]
						</form>
						<span class='response' style='display:inline-block;margin:0px 0px 0px 5px;'></span>
          </div>";
  }

	protected function _content_template() {
  }

}
