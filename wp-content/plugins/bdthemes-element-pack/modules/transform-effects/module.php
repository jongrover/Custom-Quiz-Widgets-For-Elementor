<?php
namespace ElementPack\Modules\TransformEffects;

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
		return 'bdt-transform-effects';
	}

	public function register_controls_widget_transform_effect($widget, $widget_id, $args) {
		static $widgets = [
			'section_effects', /* Section */
		];

		if ( ! in_array( $widget_id, $widgets ) ) {
			return;
		}

		$widget->add_control(
			'element_pack_widget_transform',
			[
				'label'        => BDTEP_CP . esc_html__( 'Use Transform?', 'bdthemes-element-pack' ),
				'description'  => esc_html__( 'Don\'t use with others addon effect so it will work abnormal.' , 'bdthemes-element-pack' ),
				'type'         => Controls_Manager::SWITCHER,
				'prefix_class' => 'bdt-motion-effect-',
				'separator'    => 'before',
			]
		);


		$widget->start_controls_tabs( 'element_pack_widget_motion_effect_tabs' );

		$widget->start_controls_tab(
			'element_pack_widget_motion_effect_tab_normal',
			[
				'label' => esc_html__( 'Normal', 'bdthemes-element-pack' ),
				'condition' => [
					'element_pack_widget_transform' => 'yes',
				],
			]
		);


		$widget->add_control(
			'element_pack_translate_toggle_normal',
			[
				'label' 		=> __( 'Translate', 'bdthemes-element-pack' ),
				'type' 			=> Controls_Manager::POPOVER_TOGGLE,
				'return_value' 	=> 'yes',
				'condition' 	=> [
					'element_pack_widget_transform' => 'yes',
				],
			]
		);

		$widget->start_popover();


		$widget->add_responsive_control(
			'element_pack_widget_effect_transx_normal',
			[
				'label'      => esc_html__( 'Translate X', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'condition' => [
					'element_pack_translate_toggle_normal' => 'yes',
					'element_pack_widget_transform' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-effect-trans-x-normal: {{SIZE}}px;'
				],
			]
		);

		$widget->add_responsive_control(
			'element_pack_widget_effect_transy_normal',
			[
				'label'      => esc_html__( 'Translate Y', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				// 'selectors' => [
				// 	'(desktop){{WRAPPER}}.bdt-motion-effect-yes.elementor-widget' => 'transform: translate({{element_pack_widget_effect_transx_normal.SIZE || 0}}px, {{element_pack_widget_effect_transy_normal.SIZE || 0}}px);',
				// 	'(tablet){{WRAPPER}}.bdt-motion-effect-yes.elementor-widget' => 'transform: translate({{element_pack_widget_effect_transx_normal_tablet.SIZE || 0}}px, {{element_pack_widget_effect_transy_normal_tablet.SIZE || 0}}px);',
				// 	'(mobile){{WRAPPER}}.bdt-motion-effect-yes.elementor-widget' => 'transform: translate({{element_pack_widget_effect_transx_normal_mobile.SIZE || 0}}px, {{element_pack_widget_effect_transy_normal_mobile.SIZE || 0}}px);',
				// ],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-effect-trans-y-normal: {{SIZE}}px;'
				],
				'condition' => [
					'element_pack_translate_toggle_normal' => 'yes',
					'element_pack_widget_transform' => 'yes',
				],
			]
		);


		$widget->end_popover();



		$widget->add_control(
			'element_pack_rotate_toggle_normal',
			[
				'label' 		=> __( 'Rotate', 'bdthemes-element-pack' ),
				'type' 			=> Controls_Manager::POPOVER_TOGGLE,
				'return_value' 	=> 'yes',
				'condition' 	=> [
					'element_pack_widget_transform' => 'yes',
				],
			]
		);

		$widget->start_popover();


		$widget->add_responsive_control(
			'element_pack_widget_effect_rotatex_normal',
			[
				'label'      => esc_html__( 'Rotate X', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => -180,
						'max'  => 180,
					],
				],
				'condition' => [
					'element_pack_rotate_toggle_normal' => 'yes',
					'element_pack_widget_transform' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-effect-rotate-x-normal: {{SIZE}}deg;'
				],
			]
		);

		$widget->add_responsive_control(
			'element_pack_widget_effect_rotatey_normal',
			[
				'label'      => esc_html__( 'Rotate Y', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => -180,
						'max'  => 180,
					],
				],
				'condition' => [
					'element_pack_rotate_toggle_normal' => 'yes',
					'element_pack_widget_transform' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-effect-rotate-y-normal: {{SIZE}}deg;'
				],
			]
		);


		$widget->add_responsive_control(
			'element_pack_widget_effect_rotatez_normal',
			[
				'label'   => __( 'Rotate Z', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min'  => -180,
						'max'  => 180,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-effect-rotate-z-normal: {{SIZE}}deg;'
				],
				'condition' => [
					'element_pack_rotate_toggle_normal' => 'yes',
					'element_pack_widget_transform' => 'yes',
				],
			]
		);


		$widget->end_popover();

		$widget->end_controls_tab();

		$widget->start_controls_tab(
			'element_pack_widget_motion_effect_tab_hover',
			[
				'label' => esc_html__( 'Hover', 'bdthemes-element-pack' ),
				'condition' => [
					'element_pack_widget_transform' => 'yes',
				],
			]
		);

		$widget->add_control(
			'element_pack_translate_toggle_hover',
			[
				'label' 		=> __( 'Translate', 'bdthemes-element-pack' ),
				'type' 			=> Controls_Manager::POPOVER_TOGGLE,
				'return_value' 	=> 'yes',
				'condition' 	=> [
					'element_pack_widget_transform' => 'yes',
				],
			]
		);

		$widget->start_popover();


		$widget->add_responsive_control(
			'element_pack_widget_effect_transx_hover',
			[
				'label'      => esc_html__( 'Translate X', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'condition' => [
					'element_pack_translate_toggle_hover' => 'yes',
					'element_pack_widget_transform' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-effect-trans-x-hover: {{SIZE}}px;'
				],
			]
		);

		$widget->add_responsive_control(
			'element_pack_widget_effect_transy_hover',
			[
				'label'      => esc_html__( 'Translate Y', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-effect-trans-y-hover: {{SIZE}}px;'
				],
				'condition' => [
					'element_pack_translate_toggle_hover' => 'yes',
					'element_pack_widget_transform' => 'yes',
				],
			]
		);


		$widget->end_popover();



		$widget->add_control(
			'element_pack_rotate_toggle_hover',
			[
				'label' 		=> __( 'Rotate', 'bdthemes-element-pack' ),
				'type' 			=> Controls_Manager::POPOVER_TOGGLE,
				'return_value' 	=> 'yes',
				'condition' 	=> [
					'element_pack_widget_transform' => 'yes',
				],
			]
		);

		$widget->start_popover();


		$widget->add_responsive_control(
			'element_pack_widget_effect_rotatex_hover',
			[
				'label'      => esc_html__( 'Rotate X', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => -180,
						'max'  => 180,
					],
				],
				'condition' => [
					'element_pack_rotate_toggle_hover' => 'yes',
					'element_pack_widget_transform' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-effect-rotate-x-hover: {{SIZE}}deg;'
				],
			]
		);

		$widget->add_responsive_control(
			'element_pack_widget_effect_rotatey_hover',
			[
				'label'      => esc_html__( 'Rotate Y', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => -180,
						'max'  => 180,
					],
				],
				'condition' => [
					'element_pack_rotate_toggle_hover' => 'yes',
					'element_pack_widget_transform' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-effect-rotate-y-hover: {{SIZE}}deg;'
				],
			]
		);


		$widget->add_responsive_control(
			'element_pack_widget_effect_rotatez_hover',
			[
				'label'   => __( 'Rotate Z', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min'  => -180,
						'max'  => 180,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-effect-rotate-z-hover: {{SIZE}}deg;'
				],
				'condition' => [
					'element_pack_rotate_toggle_hover' => 'yes',
					'element_pack_widget_transform' => 'yes',
				],
			]
		);


		$widget->end_popover();


		$widget->end_controls_tab();

		$widget->end_controls_tabs();


	}


	// public function widget_transform_effect_before_render($widget) {    		
	// 	$settings = $widget->get_settings_for_display();

	// }

	protected function add_actions() {

		add_action( 'elementor/element/before_section_end', [ $this, 'register_controls_widget_transform_effect' ], 10, 3 );
		//add_action( 'elementor/frontend/widget/before_render', [ $this, 'widget_transform_effect_before_render' ], 10, 1 );

	}
}