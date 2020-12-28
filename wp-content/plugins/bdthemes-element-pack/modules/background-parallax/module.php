<?php
namespace ElementPack\Modules\BackgroundParallax;

use Elementor\Elementor_Base;
use Elementor\Controls_Manager;
use ElementPack;
use ElementPack\Plugin;
use ElementPack\Base\Element_Pack_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Element_Pack_Module_Base {

	public function __construct() {
		parent::__construct();
		$this->add_actions();
	}

	public function get_name() {
		return 'bdt-background-parallax';
	}

	public function register_controls_bg_parallax($section, $section_id, $args) {

		static $bg_sections = [ 'section_background' ];

		if ( !in_array( $section_id, $bg_sections ) ) { return; }
		
		$section->add_control(
			'section_parallax_on',
			[
				'label'        => BDTEP_CP . esc_html__( 'Enable Parallax?', 'bdthemes-element-pack' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'return_value' => 'yes',
				'description'  => esc_html__( 'Set parallax background by enable this option.', 'bdthemes-element-pack' ),
				'separator'    => 'before',
				'condition'    => [
					'background_background' => ['classic'],
				],
			]
		);

		$section->add_control(
			'section_parallax_x_value',
			[
				'label' => esc_html__( 'Parallax X', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'   => -500,
						'max'   => 500,
						'step' => 10,
					],
				],
				'description'  => esc_html__( 'How much x parallax move happen on scroll.', 'bdthemes-element-pack' ),
				'condition'    => [
					'section_parallax_on' => 'yes',
				],
			]
		);

		$section->add_control(
			'section_parallax_value',
			[
				'label' => esc_html__( 'Parallax Y', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'   => -500,
						'max'   => 500,
						'step' => 10,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => -200,
				],
				'description'  => esc_html__( 'How much y parallax move happen on scroll.', 'bdthemes-element-pack' ),
				'condition'    => [
					'section_parallax_on' => 'yes',
				],
			]
		);

	}


	public function parallax_before_render($section) {    		
		$settings = $section->get_settings_for_display();
		if( $section->get_settings( 'section_parallax_on' ) == 'yes' ) {
			$parallax_x = $section->get_settings( 'section_parallax_x_value' );
			$parallax_y = $section->get_settings( 'section_parallax_value' );
			if ($parallax_x['size']) {
				$section->add_render_attribute( '_wrapper', 'bdt-parallax', 'bgx: '.$parallax_x['size'] );
			}
			if ($parallax_y['size']) {
				$section->add_render_attribute( '_wrapper', 'bdt-parallax', 'bgy: '.$parallax_y['size'] );
			}
		}
	}

	protected function add_actions() {

		add_action( 'elementor/element/before_section_end', [ $this, 'register_controls_bg_parallax' ], 10, 3 );		
		add_action( 'elementor/frontend/section/before_render', [ $this, 'parallax_before_render' ], 10, 1 );

	}
}