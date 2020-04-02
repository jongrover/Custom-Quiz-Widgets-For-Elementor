<?php
namespace Elementor;

class Question_Drag_Drop_Widget extends Widget_Base {

	public function get_name() {
		return 'question-drag-drop';
	}

	public function get_title() {
		return 'Question > Drag & Drop';
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
			'sentence_start',
			[
				'label' => __( 'Start of Sentence', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter the words that go at the start of the sentence here (or leave blank)', 'elementor' ),
			]
		);

    $this->add_control(
			'w1',
			[
				'label' => __( 'Arrangeable Word 1', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter first arrangeable word here', 'elementor' ),
			]
		);

    $this->add_control(
			'w2',
			[
				'label' => __( 'Arrangeable Word 2', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter second arrangeable word here', 'elementor' ),
			]
		);

    $this->add_control(
			'w3',
			[
				'label' => __( 'Arrangeable Word 3', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter third arrangeable word here', 'elementor' ),
			]
		);

		$this->add_control(
			'w4',
			[
				'label' => __( 'Arrangeable Word 4', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter fourth arrangeable word here', 'elementor' ),
			]
		);

		$this->add_control(
			'w5',
			[
				'label' => __( 'Arrangeable Word 5', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter fifth arrangeable word here', 'elementor' ),
			]
		);

    $this->add_control(
			'sentence_end',
			[
				'label' => __( 'End of Sentence', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter the words that go at the end of the sentence here (or leave blank)', 'elementor' ),
			]
		);

		$this->add_control(
			'correct_sentence',
			[
				'label' => __( 'Full Corrected Sentence', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter the full corrected sentence here', 'elementor' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
    $settings = $this->get_settings_for_display();
		if(!empty($settings[sentence_start])){
			$sentence_start = "<span class='sentence-start'>$settings[sentence_start] </span>";
		} else {
			$sentence_start = ""
		}
		if(!empty($settings[sentence_end])){
			$sentence_end = "<span class='sentence-end'>$settings[sentence_end]</span>";
		} else {
			$sentence_end = "";
		}
		if (!empty($settings[w1])) {
			$w1 = "<li class='word' style='display: inline-block; margin: 0; border: 1px solid #000000; padding: 5px 10px; cursor: pointer;'>$settings[w1] </li>"
		} else {
			$w1 = "";
		}
		if (!empty($settings[w2])) {
			$w2 = "<li class='word' style='display: inline-block; margin: 0; border: 1px solid #000000; padding: 5px 10px; cursor: pointer;'>$settings[w2] </li>"
		} else {
			$w2 = "";
		}
		if (!empty($settings[w3])) {
			$w3 = "<li class='word' style='display: inline-block; margin: 0; border: 1px solid #000000; padding: 5px 10px; cursor: pointer;'>$settings[w3] </li>"
		} else {
			$w3 = "";
		}
		if (!empty($settings[w4])) {
			$w4 = "<li class='word' style='display: inline-block; margin: 0; border: 1px solid #000000; padding: 5px 10px; cursor: pointer;'>$settings[w4] </li>"
		} else {
			$w4 = "";
		}
		if (!empty($settings[w5])) {
			$w5 = "<li class='word' style='display: inline-block; margin: 0; border: 1px solid #000000; padding: 5px 10px; cursor: pointer;'>$settings[w5] </li>"
		} else {
			$w5 = "";
		}
    echo "<div class='question-box'>
		        <div class='sentence' data-answer='$settings[correct_sentence]' style='margin: 0 0 10px 0;'>
              ".$sentence_start."
              <ul class='words place-words' style='display: inline-block; margin: 0; padding: 0; width: auto; min-width: 135px; height: 30px; border: 1px dashed #cccccc; vertical-align: bottom;'></ul>
              ".$sentence_start."
            </div>
            <ul class='words supply-words'>".$w1.$w2.$w3.$w4.$w5."</ul>
						<span class='response' style='display:inline-block;margin:0px 0px 0px 5px;'></span>
          </div>
          <script>
          jQuery(function () {
						jQuery('.words').sortable({
						  connectWith: '.place-words, .supply-words',
						  beforeStop: function () {
								var answer = jQuery(this).parent().find('.sentence').data('answer');
						    if (jQuery(this).parent().find('.supply-words').text() === '') {
						      var sentence_start = jQuery(this).parent().find('.sentence-start').text(),
						          placed_words = jQuery(this).parent().find('.place-words').text(),
						          sentence_end = jQuery(this).parent().find('.sentence-end').text(),
						          solution = sentence_start+placed_words+sentence_end;
						      if (solution === answer) {
						        console.log('correct');
						        jQuery(this).parent().find('.place-words').css('{background: lime}');
										jQuery(this).parent().find('.response').html('<span style=\"background:lime;border:1px solid green;padding:3px 5px;\">Correct!</span>');
						      } else {
						        console.log('wrong');
						        jQuery(this).parent().find('.place-words').css('{background: pink}');
										jQuery(this).parent().find('.response').html('<span style=\"background:pink;border:1px solid red;padding:3px 5px;\">Incorrect, try again!</span>');
						      }
						    }
						  }
						 });
						jQuery('.words').disableSelection();
          });
          </script>";
  }

	protected function _content_template() {
  }

}
