<?php
namespace ElementPack\Modules\Tooltip;

use Elementor\Elementor_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
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
		return 'bdt-tooltip';
	}

	public function register_controls_widget_tooltip($widget, $widget_id, $args) {
		static $widgets = [
			'_section_style', /* Section */
		];

		if ( ! in_array( $widget_id, $widgets ) ) {
			return;
		}

		$widget->add_control(
			'element_pack_widget_tooltip',
			[
				'label'        => BDTEP_CP . esc_html__( 'Use Tooltip?', 'bdthemes-element-pack' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'bdthemes-element-pack' ),
				'label_off'    => esc_html__( 'No', 'bdthemes-element-pack' ),
				'render_type'  => 'template',
				'separator'    => 'before',
			]
		);

		$widget->start_controls_tabs( 'element_pack_widget_tooltip_tabs' );

		$widget->start_controls_tab(
			'element_pack_widget_tooltip_settings_tab',
			[
				'label' => esc_html__( 'Settings', 'bdthemes-element-pack' ),
				'condition' => [
					'element_pack_widget_tooltip' => 'yes',
				],
			]
		);

		$widget->add_control(
			'element_pack_widget_tooltip_text',
			[
				'label'       => esc_html__( 'Description', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXTAREA,
				'render_type' => 'template',
				'default'     => 'This is Tooltip',
				'dynamic'     => [ 'active' => true ],
				'condition'   => [
					'element_pack_widget_tooltip' => 'yes',
				],
			]
		);

		$widget->add_control(
			'element_pack_widget_tooltip_placement',
			[
				'label'   => esc_html__( 'Placement', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top',
				'options' => [
					'top-start'    => esc_html__( 'Top Left', 'bdthemes-element-pack' ),
					'top'          => esc_html__( 'Top', 'bdthemes-element-pack' ),
					'top-end'      => esc_html__( 'Top Right', 'bdthemes-element-pack' ),
					'bottom-start' => esc_html__( 'Bottom Left', 'bdthemes-element-pack' ),
					'bottom'       => esc_html__( 'Bottom', 'bdthemes-element-pack' ),
					'bottom-end'   => esc_html__( 'Bottom Right', 'bdthemes-element-pack' ),
					'left'         => esc_html__( 'Left', 'bdthemes-element-pack' ),
					'right'        => esc_html__( 'Right', 'bdthemes-element-pack' ),
				],
				'render_type'  => 'template',
				'condition' => [
					'element_pack_widget_tooltip' => 'yes',
				],
			]
		);

		$widget->add_control(
			'element_pack_widget_tooltip_animation',
			[
				'label'   => esc_html__( 'Animation', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'shift-toward',
				'options' => [
					'shift-away'   => esc_html__( 'Shift-Away', 'bdthemes-element-pack' ),
					'shift-toward' => esc_html__( 'Shift-Toward', 'bdthemes-element-pack' ),
					'fade'         => esc_html__( 'Fade', 'bdthemes-element-pack' ),
					'scale'        => esc_html__( 'Scale', 'bdthemes-element-pack' ),
					'perspective'  => esc_html__( 'Perspective', 'bdthemes-element-pack' ),
				],
				'render_type'  => 'template',
				'condition' => [
					'element_pack_widget_tooltip' => 'yes',
				],
			]
		);

		$widget->add_control(
			'element_pack_widget_tooltip_x_offset',
			[
				'label'   => esc_html__( 'Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 0,
				'min'     => -1000,
				'max'     => 1000,
				'step'    => 1,
				'condition' => [
					'element_pack_widget_tooltip' => 'yes',
				],
			]
		);

		$widget->add_control(
			'element_pack_widget_tooltip_y_offset',
			[
				'label'   => esc_html__( 'Distance', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 0,
				'min'     => -1000,
				'max'     => 1000,
				'step'    => 1,
				'condition' => [
					'element_pack_widget_tooltip' => 'yes',
				],
			]
		);

		$widget->add_control(
			'element_pack_widget_tooltip_arrow',
			[
				'label'        => esc_html__( 'Arrow', 'bdthemes-element-pack' ),
				'type'         => Controls_Manager::SWITCHER,
				'condition'    => [
					'element_pack_widget_tooltip' => 'yes',
				],
			]
		);

		$widget->end_controls_tab();

		$widget->start_controls_tab(
			'element_pack_widget_tooltip_styles_tab',
			[
				'label' => esc_html__( 'Style', 'bdthemes-element-pack' ),
				'condition' => [
					'element_pack_widget_tooltip' => 'yes',
				],
			]
		);

		$widget->add_responsive_control(
			'element_pack_widget_tooltip_width',
			[
				'label'      => esc_html__( 'Width', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [
					'px', 'em',
				],
				'range'      => [
					'px' => [
						'min' => 50,
						'max' => 500,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .tippy-tooltip' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'element_pack_widget_tooltip' => 'yes',
				],
				'render_type'  => 'template',
			]
		);

		
		$widget->add_control(
			'element_pack_widget_tooltip_color',
			[
				'label'  => esc_html__( 'Text Color', 'bdthemes-element-pack' ),
				'type'   => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tippy-tooltip' => 'color: {{VALUE}}',
				],
				'condition' => [
					'element_pack_widget_tooltip' => 'yes',
				],
			]
		);
		
		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'element_pack_widget_tooltip_background',
				'selector' => '{{WRAPPER}} .tippy-tooltip, {{WRAPPER}} .tippy-tooltip .tippy-backdrop',
				'condition' => [
					'element_pack_widget_tooltip' => 'yes',
				],
			]
		);

		$widget->add_control(
			'element_pack_widget_tooltip_arrow_color',
			[
				'label'  => esc_html__( 'Arrow Color', 'bdthemes-element-pack' ),
				'type'   => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tippy-popper[x-placement^=left] .tippy-arrow'  => 'border-left-color: {{VALUE}}',
					'{{WRAPPER}} .tippy-popper[x-placement^=right] .tippy-arrow' => 'border-right-color: {{VALUE}}',
					'{{WRAPPER}} .tippy-popper[x-placement^=top] .tippy-arrow'   => 'border-top-color: {{VALUE}}',
					'{{WRAPPER}} .tippy-popper[x-placement^=bottom] .tippy-arrow'=> 'border-bottom-color: {{VALUE}}',
				],
				'condition' => [
					'element_pack_widget_tooltip'       => 'yes',
				],
				'separator' => 'after',
			]
		);

		$widget->add_responsive_control(
			'element_pack_widget_tooltip_padding',
			[
				'label'      => __( 'Padding', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tippy-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'render_type'  => 'template',
				'condition' => [
					'element_pack_widget_tooltip' => 'yes',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'element_pack_widget_tooltip_border',
				'label'       => esc_html__( 'Border', 'bdthemes-element-pack' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .tippy-tooltip',
				'condition' => [
					'element_pack_widget_tooltip' => 'yes',
				],
			]
		);

		$widget->add_responsive_control(
			'element_pack_widget_tooltip_border_radius',
			[
				'label'      => __( 'Border Radius', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tippy-tooltip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'element_pack_widget_tooltip' => 'yes',
				],
			]
		);

		$widget->add_control(
			'element_pack_widget_tooltip_text_align',
			[
				'label'   => esc_html__( 'Text Alignment', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left'    => [
						'title' => esc_html__( 'Left', 'bdthemes-element-pack' ),
						'icon'  => 'fas fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'bdthemes-element-pack' ),
						'icon'  => 'fas fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'bdthemes-element-pack' ),
						'icon'  => 'fas fa-align-right',
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .tippy-tooltip .tippy-content' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'element_pack_widget_tooltip' => 'yes',
				],
				'separator' => 'before',
			]
		);

		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'element_pack_widget_tooltip_box_shadow',
				'selector' => '{{WRAPPER}} .tippy-tooltip',
				'condition' => [
					'element_pack_widget_tooltip' => 'yes',
				],
			]
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'element_pack_widget_tooltip_typography',
				'selector' => '{{WRAPPER}} .tippy-tooltip .tippy-content',
				'condition' => [
					'element_pack_widget_tooltip' => 'yes',
				],
			]
		);

		$widget->end_controls_tab();

		$widget->end_controls_tabs();



	}


	public function widget_tooltip_before_render($widget) {    		
		$settings = $widget->get_settings_for_display();

		if( $settings['element_pack_widget_tooltip'] == 'yes' ) {
			$element_id = $widget->get_settings( '_element_id' );
			if (empty($element_id)) {
				$id = 'bdt-widget-tooltip-'.$widget->get_id();
				$widget->add_render_attribute( '_wrapper', 'id', $id, true );
			} else {
				$id = $widget->get_settings( '_element_id' );
			}
			
			$widget->add_render_attribute( '_wrapper', 'class', 'bdt-tippy-tooltip' );
			$widget->add_render_attribute( '_wrapper', 'data-tippy', '', true );

			if (!empty($settings['element_pack_widget_tooltip_text'])) {
				$widget->add_render_attribute( '_wrapper', 'data-tippy-content', $settings['element_pack_widget_tooltip_text'], true );
			}
			if (!empty($settings['element_pack_widget_tooltip_placement'])) {
				$widget->add_render_attribute( '_wrapper', 'data-tippy-placement', $settings['element_pack_widget_tooltip_placement'], true );
			}
			if (!empty($settings['element_pack_widget_tooltip_arrow'])) {
				$widget->add_render_attribute( '_wrapper', 'data-tippy-arrow', 'true', true );
			}
			if (!empty($settings['element_pack_widget_tooltip_animation'])) {
				$widget->add_render_attribute( '_wrapper', 'data-tippy-animation', $settings['element_pack_widget_tooltip_animation'], true );
			}
			
			if (!empty($settings['element_pack_widget_tooltip_x_offset']) or !empty($settings['element_pack_widget_tooltip_y_offset']) ) {
				$xoffset = ( !empty($settings['element_pack_widget_tooltip_x_offset'] ) ? $settings['element_pack_widget_tooltip_x_offset'] : '0' ) ;
				$yoffset = ( !empty($settings['element_pack_widget_tooltip_y_offset'] ) ? $settings['element_pack_widget_tooltip_y_offset'] : '0' ) ;
				$offset  = $xoffset .','. $yoffset;
				$widget->add_render_attribute( '_wrapper', 'data-tippy-offset', $offset, true );
			}
			

			// tooltip javascript need to load
			wp_enqueue_script( 'popper' );
			wp_enqueue_script( 'tippyjs' );

			

		}
	}

	protected function add_actions() {

		add_action( 'elementor/element/before_section_end', [ $this, 'register_controls_widget_tooltip' ], 10, 3 );
		add_action( 'elementor/frontend/widget/before_render', [ $this, 'widget_tooltip_before_render' ], 10, 1 );

	}
}