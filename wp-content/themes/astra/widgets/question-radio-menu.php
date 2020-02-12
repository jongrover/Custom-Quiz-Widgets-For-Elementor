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
        ],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
    $settings = $this->get_settings_for_display();
    echo "<div class='question-box'>$settings[question]<br>
		        <form class="question-radio" data-correct='$settings[correct]'>
						  <input type="radio" name="answer-radio" value="a"> $settings[a]<br>
						  <input type="radio" name="answer-radio" value="b"> $settings[b]<br>
						  <input type="radio" name="answer-radio" value="c"> $settings[c]<br>
						</form>
						<span class='response' style='display:inline-block;margin:0px 0px 0px 5px;'></span>
          </div>
          <script>
          jQuery(function () {
            jQuery('.question-radio').find('input[name=answer-radio]').change(function () {
              var correct = jQuery(this).parent().data('correct');
              var answer = jQuery(this).parent().find('input[name=answer-radio]:checked').val();
              if (answer === correct) {
                jQuery(this).parent().next('.response').html('<span style=\"background:lime;border:1px solid green;padding:3px 5px;\">Correct!</span>');
              } else {
                jQuery(this).parent().next('.response').html('<span style=\"background:pink;border:1px solid red;padding:3px 5px;\">Incorrect, try again!</span>');
              }
            });
          });
          </script>";
  }

	protected function _content_template() {
  }

}
