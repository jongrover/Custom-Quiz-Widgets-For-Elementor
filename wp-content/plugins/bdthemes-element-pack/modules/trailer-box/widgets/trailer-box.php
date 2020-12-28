<?php
namespace ElementPack\Modules\TrailerBox\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Trailer_Box extends Widget_Base {

	public function get_name() {
		return 'bdt-trailer-box';
	}

	public function get_title() {
		return BDTEP . esc_html__( 'Trailer Box', 'bdthemes-element-pack' );
	}

	public function get_icon() {
		return 'bdt-wi-trailer-box';
	}

	public function get_categories() {
		return [ 'element-pack' ];
	}

	public function get_keywords() {
		return [ 'trailer', 'box' ];
	}

	public function get_style_depends() {
		return [ 'ep-trailer-box' ];
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/3AR5RlBAAYg';
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_content_layout',
			[
				'label' => esc_html__( 'Layout', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'pre_title',
			[
				'label'       => esc_html__( 'Pre Title', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => esc_html__( 'Trailer box pre title', 'bdthemes-element-pack' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => esc_html__( 'Trailer box title', 'bdthemes-element-pack' ),
				'default'     => esc_html__( 'Trailer Box Title', 'bdthemes-element-pack' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'content',
			[
				'label'       => esc_html__( 'Content', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::WYSIWYG,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => esc_html__( 'Trailer box text' , 'bdthemes-element-pack' ),
				'default'     => esc_html__( 'I am Trailer Box Description Text. You can change me anytime from settings.' , 'bdthemes-element-pack' ),
				'label_block' => true,
			]
		);

		$this->add_responsive_control(
			'content_width',
			[
				'label' => esc_html__( 'Content Width', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-trailer-box-desc' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'origin',
			[
				'label'   => esc_html__( 'Origin', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bottom-left',
				'options' => element_pack_position(),
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'   => esc_html__( 'Alignment', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::CHOOSE,
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
					'justify' => [
						'title' => esc_html__( 'Justified', 'bdthemes-element-pack' ),
						'icon'  => 'fas fa-align-justify',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'description'  => 'Use align for matching position',
				'default'      => '',
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Maximum Width', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'separator'	=> 'before',
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label'   => esc_html__( 'Minimum Height', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 400,
				],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 1024,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-trailer-box' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'link_type',
			[
				'label'   => __( 'Link', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''       => __( 'None', 'bdthemes-element-pack' ),
					'button' => __( 'Button', 'bdthemes-element-pack' ),
					'item'   => __( 'Item', 'bdthemes-element-pack' ),
				],
			]
		);

		$this->add_control(
			'button',
			[
				'label'       => esc_html__( 'link', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => 'http://your-link.com',
				'default'     => [
					'url' => '#',
				],
				'condition' => [
					'link_type!' => '',
				],
			]
		);

		$this->add_control(
			'title_tags',
			[
				'label'   => __( 'Title HTML Tag', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_button',
			[
				'label'     => esc_html__( 'Button', 'bdthemes-element-pack' ),
				'condition' => [
					'link_type' => 'button',
				],
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'       => esc_html__( 'Text', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => esc_html__( 'View Details', 'bdthemes-element-pack' ),
				'default'     => esc_html__( 'View Details', 'bdthemes-element-pack' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label' => esc_html__( 'Icon', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label'   => esc_html__( 'Icon Position', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'left'  => esc_html__( 'Before', 'bdthemes-element-pack' ),
					'right' => esc_html__( 'After', 'bdthemes-element-pack' ),
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label'   => esc_html__( 'Icon Spacing', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 8,
				],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container .bdt-trailer-box-button-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-widget-container .bdt-trailer-box-button-icon-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_position',
			[
				'label'   => esc_html__( 'Button Position', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => element_pack_position(),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_pre_title',
			[
				'label' => __( 'Pre Title', 'bdthemes-element-pack' ),
				'condition' => [
					'pre_title!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'pre_title_x_position',
			[
				'label'   => __( 'X Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -800,
						'max' => 800,
					],
				],
			]
		);

		$this->add_responsive_control(
			'pre_title_y_position',
			[
				'label'   => __( 'Y Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -800,
						'max' => 800,
					],
				],
			]
		);

		$this->add_responsive_control(
			'pre_title_rotate',
			[
				'label'   => __( 'Rotate', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min'  => -180,
						'max'  => 180,
						'step' => 5,
					],
				],
				'selectors' => [
					'(desktop){{WRAPPER}} .bdt-trailer-box .bdt-trailer-box-desc-inner .bdt-trailer-box-pre-title' => 'transform: translate({{pre_title_x_position.SIZE}}px, {{pre_title_y_position.SIZE}}px) rotate({{SIZE}}deg);',
					'(tablet){{WRAPPER}} .bdt-trailer-box .bdt-trailer-box-desc-inner .bdt-trailer-box-pre-title' => 'transform: translate({{pre_title_x_position_tablet.SIZE}}px, {{pre_title_y_position_tablet.SIZE}}px) rotate({{SIZE}}deg);',
					'(mobile){{WRAPPER}} .bdt-trailer-box .bdt-trailer-box-desc-inner .bdt-trailer-box-pre-title' => 'transform: translate({{pre_title_x_position_mobile.SIZE}}px, {{pre_title_y_position_mobile.SIZE}}px) rotate({{SIZE}}deg);',
				],
			]
		);

		$this->add_control(
			'pre_title_hide',
			[
				'label'       => __( 'Hide at', 'bdthemes-element-pack' ),
				'description' => __( 'Some cases you need to hide it because when you set heading at outer position mobile device can show wrong width in that case you can hide it at mobile or tablet device. if you set overflow hidden on section or body so you don\'t need it.', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'm',
				'options'     => [
					''  => esc_html__('Nothing', 'bdthemes-element-pack'),
					'm' => esc_html__('Tablet and Mobile ', 'bdthemes-element-pack'),
					's' => esc_html__('Mobile', 'bdthemes-element-pack'),
				],
			]
		);

		$this->end_controls_section();

		//Style

		$this->start_controls_section(
			'section_trailer_box_style',
			[
				'label' => esc_html__( 'Trailer Box', 'bdthemes-element-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'trailer_box_content_padding',
			[
				'label'      => esc_html__( 'Content Padding', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-trailer-box .bdt-trailer-box-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_trailer_box_style' );

		$this->start_controls_tab(
			'tab_trailer_box_normal',
			[
				'label' => esc_html__( 'Normal', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'pre_title_heading',
			[
				'label'     => esc_html__( 'Pre Title', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'pre_title!' => '',
				],
			]
		);

		$this->add_control(
			'pre_title_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-trailer-box .bdt-trailer-box-pre-title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'pre_title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'pre_title_border',
				'label'       => __( 'Border', 'bdthemes-element-pack' ),
				'selector'    => '{{WRAPPER}} .bdt-trailer-box .bdt-trailer-box-pre-title',
				'condition' => [
					'pre_title!' => '',
				],
			]
		);

		$this->add_control(
			'pre_title_border_radius',
			[
				'label'      => __( 'Border Radius', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-trailer-box .bdt-trailer-box-pre-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'pre_title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'tb_pre_title_shadow',
				'selector' => '{{WRAPPER}} .bdt-trailer-box .bdt-trailer-box-desc-inner .bdt-trailer-box-pre-title',
				'condition' => [
					'pre_title!' => '',
				],
			]
		);

		$this->add_control(
			'tb_pre_title_opacity',
			[
				'label' => __( 'Opacity', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0.05,
						'max'  => 1,
						'step' => 0.05,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-trailer-box .bdt-trailer-box-desc-inner .bdt-trailer-box-pre-title' => 'opacity: {{SIZE}};',
				],
				'condition' => [
					'pre_title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'pre_title_typography',
				'label'     => esc_html__( 'Typography', 'bdthemes-element-pack' ),
				'selector'  => '{{WRAPPER}} .bdt-trailer-box .bdt-trailer-box-pre-title',
				'condition' => [
					'pre_title!' => '',
				],
			]
		);

		$this->add_control(
			'title_heading',
			[
				'label'     => esc_html__( 'Title', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-trailer-box .bdt-trailer-box-title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'title_typography',
				'label'     => esc_html__( 'Typography', 'bdthemes-element-pack' ),
				'selector'  => '{{WRAPPER}} .bdt-trailer-box .bdt-trailer-box-title',
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_control(
			'description_heading',
			[
				'label'     => esc_html__( 'Description', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'content!' => '',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-trailer-box .bdt-trailer-box-text' => 'color: {{VALUE}};',
				],
				'condition' => [
					'content!' => '',
				],
			]
		);

		$this->add_control(
			'text_spacing',
			[
				'label' => esc_html__('Sapce', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-trailer-box .bdt-trailer-box-text' => 'margin-top: {{SIZE}}px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'text_typography',
				'label'     => esc_html__( 'Typography', 'bdthemes-element-pack' ),
				'selector'  => '{{WRAPPER}} .bdt-trailer-box .bdt-trailer-box-text',
				'condition' => [
					'content!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_trailer_box_hover',
			[
				'label' => esc_html__( 'Hover', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'pre_title_heading_hover',
			[
				'label'     => esc_html__( 'Pre Title', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'pre_title!' => '',
				],
			]
		);

		$this->add_control(
			'pre_title_color_hover',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-trailer-box:hover .bdt-trailer-box-pre-title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'pre_title!' => '',
				],
			]
		);

		$this->add_control(
			'pre_title_border_color_hover',
			[
				'label'     => esc_html__( 'Border Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-trailer-box:hover .bdt-trailer-box-pre-title' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'pre_title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'tb_pre_title_shadow_hover',
				'selector' => '{{WRAPPER}} .bdt-trailer-box:hover .bdt-trailer-box-desc-inner .bdt-trailer-box-pre-title',
				'condition' => [
					'pre_title!' => '',
				],
			]
		);

		$this->add_control(
			'tb_pre_title_opacity_hover',
			[
				'label' => __( 'Opacity', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0.05,
						'max'  => 1,
						'step' => 0.05,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-trailer-box:hover .bdt-trailer-box-desc-inner .bdt-trailer-box-pre-title' => 'opacity: {{SIZE}};',
				],
				'condition' => [
					'pre_title!' => '',
				],
			]
		);

		$this->add_control(
			'title_heading_hover',
			[
				'label'     => esc_html__( 'Title', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-trailer-box:hover .bdt-trailer-box-title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_control(
			'description_heading_hover',
			[
				'label'     => esc_html__( 'Description', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'content!' => '',
				],
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-trailer-box:hover .bdt-trailer-box-text' => 'color: {{VALUE}};',
				],
				'condition' => [
					'content!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'item_animation',
			[
				'label'        => esc_html__( 'Animation', 'bdthemes-element-pack' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'content',
				'prefix_class' => 'bdt-item-transition-',				
				'render_type'  => 'ui',
				'options'      => [
					'content'    => esc_html__( 'Content', 'bdthemes-element-pack' ),
					'scale-up'   => esc_html__( 'Image Scale Up', 'bdthemes-element-pack' ),
					'scale-down' => esc_html__( 'Image Scale Down', 'bdthemes-element-pack' ),
					'none'       => esc_html__( 'None', 'bdthemes-element-pack' ),
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',
			[
				'label'     => esc_html__( 'Button', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'link_type' => 'button',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container a.bdt-trailer-box-button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-widget-container a.bdt-trailer-box-button svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'     => esc_html__( 'Background Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.bdt-trailer-box-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label'     => esc_html__( 'Text Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.elementor-widget-bdt-trailer-box:hover a.bdt-trailer-box-button' => 'color: {{VALUE}};',
					'{{WRAPPER}}.elementor-widget-bdt-trailer-box:hover a.bdt-trailer-box-button svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label'     => esc_html__( 'Background Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.elementor-widget-bdt-trailer-box:hover a.bdt-trailer-box-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-widget-bdt-trailer-box:hover a.bdt-trailer-box-button' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_animation',
			[
				'label' => esc_html__( 'Animation', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'border',
				'label'       => esc_html__( 'Border', 'bdthemes-element-pack' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} a.bdt-trailer-box-button',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} a.bdt-trailer-box-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_shadow',
				'selector' => '{{WRAPPER}} a.bdt-trailer-box-button',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => esc_html__( 'Padding', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} a.bdt-trailer-box-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'button_spacing',
			[
				'label'      => esc_html__( 'Spacing', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} a.bdt-trailer-box-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'label'    => esc_html__( 'Typography', 'bdthemes-element-pack' ),
				'selector' => '{{WRAPPER}} a.bdt-trailer-box-button',
			]
		);

		$this->end_controls_section();

		// Background Overlay
		$this->start_controls_section(
			'section_advanced_background_overlay',
			[
				'label'     => esc_html__( 'Background Overlay', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_ADVANCED,
				'condition' => [
					'_background_background' => [ 'classic', 'gradient' ],
				],
			]
		);

		$this->start_controls_tabs( 'tabs_background_overlay' );

		$this->start_controls_tab(
			'tab_background_overlay_normal',
			[
				'label' => esc_html__( 'Normal', 'bdthemes-element-pack' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'background_overlay',
				'selector' => '{{WRAPPER}} .elementor-widget-container > .elementor-background-overlay',
			]
		);

		$this->add_control(
			'background_overlay_opacity',
			[
				'label'   => esc_html__( 'Opacity (%)', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => .5,
				],
				'range' => [
					'px' => [
						'max'  => 1,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container > .elementor-background-overlay' => 'opacity: {{SIZE}};',
				],
				'condition' => [
					'background_overlay_background' => [ 'classic', 'gradient' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_background_overlay_hover',
			[
				'label' => esc_html__( 'Hover', 'bdthemes-element-pack' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'background_overlay_hover',
				'selector' => '{{WRAPPER}}:hover .elementor-widget-container > .elementor-background-overlay',
			]
		);

		$this->add_control(
			'background_overlay_hover_opacity',
			[
				'label'   => esc_html__( 'Opacity (%)', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => .5,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}}:hover .elementor-widget-container > .elementor-background-overlay' => 'opacity: {{SIZE}};',
				],
				'condition' => [
					'background_overlay_hover_background' => [ 'classic', 'gradient' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	public function render_button() {
		$settings = $this->get_settings_for_display();
		$target   = ($settings['button']['is_external']) ? '_blank' : '_self';

		if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// add old default
			$settings['icon'] = 'fas fa-arrow-right';
		}

		$migrated  = isset( $settings['__fa4_migrated']['button_icon'] );
		$is_new    = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

		?>

		<?php if ('button' === $settings['link_type']) : ?>
			<?php if (( '' !== $settings['button']['url'] ) and ('' !== $settings['button_text'] )) :

				$this->add_render_attribute(
					[
						'trailer-box-button' => [
							'href'   => esc_url($settings['button']['url']),
							'target' => esc_attr($target),
							'class'  => [
								'bdt-trailer-box-button',
								$settings['button_hover_animation'] ? 'elementor-animation-'.$settings['button_hover_animation'] : ''
							]
						]
					]
				);
				$this->add_render_attribute(
					[
						'trailer-box-button-position' => [
							'class'  => [
								'bdt-trailer-box-button-position',
								' bdt-position-' . $settings['button_position'],
							]
						]
					]
				);

				?>
				<div <?php echo $this->get_render_attribute_string( 'trailer-box-button-position' ); ?>>
					<a <?php echo $this->get_render_attribute_string( 'trailer-box-button' ); ?>>
						<?php echo esc_html($settings['button_text']); ?>
	
						<?php if ($settings['button_icon']['value']) : ?>
							<span class="bdt-trailer-box-button-icon-<?php echo esc_attr($settings['icon_align']); ?>">
	
								<?php if ( $is_new || $migrated ) :
									Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true', 'class' => 'fa-fw' ] );
								else : ?>
									<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
								<?php endif; ?>
	
							</span>
						<?php endif; ?>
	
					</a>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<?php
	}

	public function render() {
		$settings               = $this->get_settings_for_display();
		$target   = ($settings['button']['is_external']) ? '_blank' : '_self';
		
		$origin                 = ' bdt-position-' . $settings['origin'];
		$has_background_overlay = in_array( $settings['background_overlay_background'], [ 'classic', 'gradient' ] ) ||
		in_array( $settings['background_overlay_hover_background'], [ 'classic', 'gradient' ] );
		

		if ( $has_background_overlay ) : ?>
			<div class="elementor-background-overlay"></div>
		<?php endif; ?>

		<?php if ('item' === $settings['link_type']) : ?>
			<div onclick="window.open('<?php echo esc_url($settings['button']['url']); ?>','<?php echo esc_attr($target); ?>');" style="cursor: pointer;">
		<?php endif; ?>

		<?php if ($settings['pre_title']) {

			$this->add_render_attribute(
				[
					'avd-hclass' => [
						'class' => [
							'bdt-trailer-box-pre-title',
							$settings['pre_title_hide'] ? 'bdt-visible@'. $settings['pre_title_hide'] : '',
						],
					],
				]
			);
		} 
		
		$this->add_render_attribute('bdt-trailer-box-title', 'class', 'bdt-trailer-box-title');
		
		?>

			<div class="bdt-trailer-box bdt-position-relative">
				<div class="bdt-trailer-box-desc <?php echo esc_attr($origin); ?>">
					<div class="bdt-trailer-box-desc-inner">
						<?php if ( '' !== $settings['pre_title'] ) : ?>
							<div <?php echo $this->get_render_attribute_string( 'avd-hclass' );?>>
								<?php echo wp_kses( $settings['pre_title'], element_pack_allow_tags('title') ); ?>
							</div>
						<?php endif; ?>

						<?php if ( '' !== $settings['title'] ) : ?>
							<<?php echo esc_html($settings['title_tags']); ?> <?php echo $this->get_render_attribute_string('bdt-trailer-box-title'); ?>>
								<?php echo wp_kses( $settings['title'], element_pack_allow_tags('title') ); ?>
							</<?php echo esc_html($settings['title_tags']); ?>>
						<?php endif; ?>

						<?php if ( '' !== $settings['content'] ) : ?>
							<div class="bdt-trailer-box-text"><?php echo wp_kses_post($settings['content']); ?></div>
						<?php endif; ?>

						<?php if ( ! $settings['button_position']) : ?>
							<?php $this->render_button(); ?>
						<?php endif; ?>
					</div>
					
				</div>
				
			</div>

			<?php if ( $settings['button_position']) : ?>
				<?php $this->render_button(); ?>
			<?php endif; ?>

		<?php if ('item' === $settings['link_type']) : ?>
			</div>
		<?php endif; ?>

		<?php
	}
}
