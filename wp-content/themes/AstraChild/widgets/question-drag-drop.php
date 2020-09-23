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

    # Sanititize input
		$settings[sentence_start] = trim($settings[sentence_start]);
		$settings[sentence_end] = trim($settings[sentence_end]);
		$settings[w1] = trim($settings[w1]);
		$settings[w2] = trim($settings[w2]);
		$settings[w3] = trim($settings[w3]);
		$settings[w4] = trim($settings[w4]);
		$settings[w5] = trim($settings[w5]);
		$settings[correct_sentence] = trim($settings[correct_sentence]);

    echo "<div class='question-box'>
		        <div class='sentence' data-answer='$settings[correct_sentence]' style='margin: 0 0 10px 0;'>
              <span class='sentence-start'>$settings[sentence_start] </span>
              <ul class='words place-words' style='display: inline-block; margin: 0 0 10px 0; padding: 0; height: 41px; min-width: 100px; border: 1px dashed #cccccc; vertical-align: bottom;'></ul>
              <span class='sentence-end'>$settings[sentence_end]</span>
							<ul class='words supply-words' style='margin: 0; display: block;'><li class='word' style='display: inline-block; border: 1px solid #000000; padding: 5px 10px; cursor: pointer;'>$settings[w1] </li><li class='word' style='display: inline-block; border: 1px solid #000000; padding: 5px 10px; cursor: pointer;'>$settings[w2] </li><li class='word' style='display: inline-block; border: 1px solid #000000; padding: 5px 10px; cursor: pointer;'>$settings[w3] </li><li class='word' style='display: inline-block; border: 1px solid #000000; padding: 5px 10px; cursor: pointer;'>$settings[w4] </li><li class='word' style='display: inline-block; border: 1px solid #000000; padding: 5px 10px; cursor: pointer;'>$settings[w5] </li></ul>
							<span class='response' style='display:block; margin: 0px 0px 0px 5px;'></span>
            </div>
          </div>";
  }

	protected function _content_template() {
  }

}
