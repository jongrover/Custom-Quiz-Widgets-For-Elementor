<?php
namespace ElementPack\Modules\AdvancedCounter\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit();
}

class Advanced_Counter extends Widget_Base
{

    public function get_name()
    {
        return 'bdt-advanced-counter';
    }

    public function get_title()
    {
        return BDTEP . esc_html__('Advanced Counter', 'bdthemes-element-pack');
    }

    public function get_icon()
    {
        return 'bdt-wi-advanced-counter';
    }

    public function get_categories()
    {
        return ['element-pack'];
    }

    public function get_style_depends()
    {
        return ['ep-advanced-counter'];
    }

    public function get_keywords()
    {
        return ['advanced', 'counter'];
    }

    public function get_script_depends()
    {
        return ['bdt-uikit-icons', 'countUp', 'ep-advanced-counter'];
    }

    public function get_custom_help_url() {
        return 'https://youtu.be/Ydok6ImEQvE';
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_content_counter_box',
            [
                'label' => __('Counter Layout', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'show_icon',
            [
                'label'            => __('Show Icon', 'bdthemes-element-pack'),
                'type'             => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'icon_type',
            [
                'label'        => esc_html__('Icon Type', 'bdthemes-element-pack'),
                'type'         => Controls_Manager::CHOOSE,
                'toggle'       => false,
                'default'      => 'icon',
                'prefix_class' => 'bdt-icon-type-',
                'render_type'  => 'template',
                'options'      => [
                    'icon'  => [
                        'title' => esc_html__('Icon', 'bdthemes-element-pack'),
                        'icon'  => 'fas fa-star',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'bdthemes-element-pack'),
                        'icon'  => 'far fa-image',
                    ],
                ],
                'condition' => [
                    'show_icon' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'selected_icon',
            [
                'label'            => __('Icon', 'bdthemes-element-pack'),
                'type'             => Controls_Manager::ICONS,
                'default'          => [
                    'value'   => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'render_type'      => 'template',
                'condition'        => [
                    'icon_type' => 'icon',
                    'show_icon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'image',
            [
                'label'       => __('Image Icon', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::MEDIA,
                'render_type' => 'template',
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition'   => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'count_start',
            [
                'label'       => __('Counter Start Number', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => __('1', 'bdthemes-element-pack'),
                'placeholder' => __('Enter your Counter Number', 'bdthemes-element-pack'),
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'content_number',
            [
                'label'       => __('Counter End Number', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => __('2020', 'bdthemes-element-pack'),
                'placeholder' => __('Enter your Counter Number', 'bdthemes-element-pack'),
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'show_separator',
            [
                'label'     => __('Separator', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'content_text',
            [
                'label'       => __('Counter Text', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Cool Number', 'bdthemes-element-pack'),
                'placeholder' => __('Enter your content text', 'bdthemes-element-pack'),
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'counter_number_size',
            [
                'label'   => __('Text HTML Tag', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'h4',
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

        $this->add_control(
            'position',
            [
                'label'        => __('Icon Position', 'bdthemes-element-pack'),
                'type'         => Controls_Manager::CHOOSE,
                'default'      => 'top',
                'options'      => [
                    'left'  => [
                        'title' => __('Left', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'top'   => [
                        'title' => __('Top', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => __('Right', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'elementor-position-',
                'toggle'       => false,
                'render_type'  => 'template',
                'condition'   => [
                    'show_icon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'icon_inline',
            [
                'label'     => __('Icon Inline', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'position' => ['left', 'right'],
                ],
            ]
        );

        $this->add_control(
            'icon_vertical_alignment',
            [
                'label'        => __('Icon Vertical Alignment', 'bdthemes-element-pack'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'top'    => [
                        'title' => __('Top', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => __('Middle', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'default'      => 'top',
                'toggle'       => false,
                'prefix_class' => 'elementor-vertical-align-',
                'condition'    => [
                    'position'    => ['left', 'right'],
                    'icon_inline' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label'     => __('Alignment', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'    => [
                        'title' => __('Left', 'bdthemes-element-pack'),
                        'icon'  => 'fas fa-align-left',
                    ],
                    'center'  => [
                        'title' => __('Center', 'bdthemes-element-pack'),
                        'icon'  => 'fas fa-align-center',
                    ],
                    'right'   => [
                        'title' => __('Right', 'bdthemes-element-pack'),
                        'icon'  => 'fas fa-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'bdthemes-element-pack'),
                        'icon'  => 'fas fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'top_icon_vertical_offset',
			[
				'label' => esc_html__('Icon Vertical Offset', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
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
						'min' => 0,
						'max' => 200,
					],
				],
				'condition' => [
					'position' => 'top',
				],
			]
		);

		$this->add_responsive_control(
			'top_icon_horizontal_offset',
			[
				'label' => esc_html__('Icon Horizontal Offset', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'default' => [
					'size' => 0,
				],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'condition' => [
					'position' => 'top',
				],
				'selectors' => [
					'(desktop){{WRAPPER}} .bdt-advanced-counter-icon' => 'transform: translate({{top_icon_horizontal_offset.SIZE}}{{UNIT}}, -{{top_icon_vertical_offset.SIZE}}px);',
					'(tablet){{WRAPPER}} .bdt-advanced-counter-icon' => 'transform: translate({{top_icon_horizontal_offset_tablet.SIZE}}{{UNIT}}, -{{top_icon_vertical_offset_tablet.SIZE}}px);',
					'(mobile){{WRAPPER}} .bdt-advanced-counter-icon' => 'transform: translate({{top_icon_horizontal_offset_mobile.SIZE}}{{UNIT}}, -{{top_icon_vertical_offset_mobile.SIZE}}px);',
				],
			]
		);

		$this->add_responsive_control(
			'left_right_icon_horizontal_offset',
			[
				'label' => esc_html__('Icon Horizontal Offset', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
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
						'min'  => -200,
						'max'  => 200,
					],
				],
				'condition' => [
					'position' => ['left', 'right'],
				],
			]
		);

		$this->add_responsive_control(
			'left_right_icon_vertical_offset',
			[
				'label' => esc_html__('Icon Vertical Offset', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'default' => [
					'size' => 0,
				],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'condition' => [
					'position' => ['left', 'right'],
				],
				'selectors' => [
					'(desktop){{WRAPPER}} .bdt-advanced-counter-icon' => 'transform: translate({{left_right_icon_horizontal_offset.SIZE}}{{UNIT}}, {{left_right_icon_vertical_offset.SIZE}}{{UNIT}});',
					'(tablet){{WRAPPER}} .bdt-advanced-counter-icon' => 'transform: translate({{left_right_icon_horizontal_offset_tablet.SIZE}}{{UNIT}}, {{left_right_icon_vertical_offset_tablet.SIZE}}{{UNIT}});',
					'(mobile){{WRAPPER}} .bdt-advanced-counter-icon' => 'transform: translate({{left_right_icon_horizontal_offset_mobile.SIZE}}{{UNIT}}, {{left_right_icon_vertical_offset_mobile.SIZE}}{{UNIT}});',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_additional',
            [
                'label' => __('Additional Options', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'language_input',
            [
                'label'       => __('Language', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => __('0,1,2,3,4,5,6,7,8,9'), 
                'placeholder' => __('Enter your language number', 'bdthemes-element-pack'),
                'rows'        => 10,
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'decimal_symbol',
            [
                'label'       => __('Decimal Symbol', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('.', 'bdthemes-element-pack'),
                'placeholder' => __('Enter your Decimal Symbol', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'decimal_places',
            [
                'label'       => __('Decimal places', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => __('0', 'bdthemes-element-pack'),
                'placeholder' => __('Enter your Decimal places', 'bdthemes-element-pack'),
            ]
        );
        
        $this->add_control(
            'duration',
            [
                'label'       => __('Duration', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => __('2', 'bdthemes-element-pack'),
                'placeholder' => __('Enter your Duration', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'use_easing',
            [
                'label'     => __('Use Easing', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes'
            ]
        );    
        
        $this->add_control(
            'use_grouping',
            [
                'label'     => __('Use Grouping', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no'
            ]
        );

        $this->add_control(
            'counter_separator',
            [
                'label'       => __('Separator Symbol', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __(',', 'bdthemes-element-pack'),
                'placeholder' => __('Enter your Decimal places', 'bdthemes-element-pack'),
                'condition'   => [
                    'use_grouping' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'counter_prefix',
            [
                'label'       => __('Prefix', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('Enter your Prefix', 'bdthemes-element-pack'),
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'counter_suffix',
            [
                'label'       => __('Suffix', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('Enter your Suffix', 'bdthemes-element-pack'),
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'indicator',
            [
                'label'     => __('Indicator', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SWITCHER,
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_indicator',
            [
                'label'     => __('Indicator', 'bdthemes-element-pack'),
                'condition' => [
                    'indicator' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'indicator_width',
            [
                'label'     => __('Width', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 10,
                        'step' => 2,
                        'max'  => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-indicator-svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'indicator_horizontal_offset',
            [
                'label'          => __('Horizontal Offset', 'bdthemes-element-pack'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'size' => 0,
                ],
                'tablet_default' => [
                    'size' => 0,
                ],
                'mobile_default' => [
                    'size' => 0,
                ],
                'range'          => [
                    'px' => [
                        'min'  => -300,
                        'step' => 2,
                        'max'  => 300,
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'indicator_vertical_offset',
            [
                'label'          => __('Vertical Offset', 'bdthemes-element-pack'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'size' => 0,
                ],
                'tablet_default' => [
                    'size' => 0,
                ],
                'mobile_default' => [
                    'size' => 0,
                ],
                'range'          => [
                    'px' => [
                        'min'  => -300,
                        'step' => 2,
                        'max'  => 300,
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'indicator_rotate',
            [
                'label'          => esc_html__('Rotate', 'bdthemes-element-pack'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'size' => 0,
                ],
                'tablet_default' => [
                    'size' => 0,
                ],
                'mobile_default' => [
                    'size' => 0,
                ],
                'range'          => [
                    'px' => [
                        'min'  => -360,
                        'max'  => 360,
                        'step' => 5,
                    ],
                ],
                'selectors'      => [
                    '(desktop){{WRAPPER}} .bdt-indicator-svg' => 'transform: translate({{indicator_horizontal_offset.SIZE}}px, {{indicator_vertical_offset.SIZE}}px) rotate({{SIZE}}deg);',
                    '(tablet){{WRAPPER}} .bdt-indicator-svg'  => 'transform: translate({{indicator_horizontal_offset_tablet.SIZE}}px, {{indicator_vertical_offset_tablet.SIZE}}px) rotate({{SIZE}}deg);',
                    '(mobile){{WRAPPER}} .bdt-indicator-svg'  => 'transform: translate({{indicator_horizontal_offset_mobile.SIZE}}px, {{indicator_vertical_offset_mobile.SIZE}}px) rotate({{SIZE}}deg);',
                ],
            ]
        );

        $this->end_controls_section();

        //Style
        $this->start_controls_section(
            'section_style_counter_box',
            [
                'label'      => __('Icon/Image', 'bdthemes-element-pack'),
                'tab'        => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_icon' => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs('icon_colors');

        $this->start_controls_tab(
            'icon_colors_normal',
            [
                'label' => __('Normal', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => __('Icon Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter .bdt-advanced-counter-icon-wrapper' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-advanced-counter .bdt-advanced-counter-icon-wrapper svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type!' => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'icon_background',
                'selector'  => '{{WRAPPER}} .bdt-advanced-counter .bdt-advanced-counter-icon-wrapper',
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-advanced-counter .bdt-advanced-counter-icon-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'icon_border',
                'selector'    => '{{WRAPPER}} .bdt-advanced-counter .bdt-advanced-counter-icon-wrapper',
            ]
        );

        $this->add_control(
            'icon_radius',
            [
                'label'      => esc_html__('Radius', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-advanced-counter .bdt-advanced-counter-icon-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
                'condition'  => [
                    'icon_radius_advanced_show!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'icon_radius_advanced_show',
            [
                'label' => __('Advanced Radius', 'bdthemes-element-pack'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'icon_radius_advanced',
            [
                'label'       => esc_html__('Radius', 'bdthemes-element-pack'),
                'description' => sprintf(__('For example: <b>%1s</b> or Go <a href="%2s" target="_blank">this link</a> and copy and paste the radius value.', 'bdthemes-element-pack'), '75% 25% 43% 57% / 46% 29% 71% 54%', 'https://9elements.github.io/fancy-border-radius/'),
                'type'        => Controls_Manager::TEXT,
                'size_units'  => ['px', '%'],
                'default'     => '75% 25% 43% 57% / 46% 29% 71% 54%',
                'selectors'   => [
                    '{{WRAPPER}} .bdt-advanced-counter .bdt-advanced-counter-icon-wrapper'     => 'border-radius: {{VALUE}}; overflow: hidden;',
                    '{{WRAPPER}} .bdt-advanced-counter .bdt-advanced-counter-icon-wrapper img' => 'border-radius: {{VALUE}}; overflow: hidden;',
                ],
                'condition'   => [
                    'icon_radius_advanced_show' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_shadow',
                'selector' => '{{WRAPPER}} .bdt-advanced-counter .bdt-advanced-counter-icon-wrapper',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'icon_typography',
                'selector'  => '{{WRAPPER}} .bdt-advanced-counter .bdt-advanced-counter-icon-wrapper',
                'condition' => [
                    'icon_type!' => 'image',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_space',
            [
                'label'     => __('Spacing', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-position-right .bdt-advanced-counter-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.elementor-position-left .bdt-advanced-counter-icon'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.elementor-position-top .bdt-advanced-counter-icon'   => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}} .bdt-advanced-counter-icon'                  => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_fullwidth',
            [
                'label'     => __('Image Fullwidth', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter .bdt-advanced-counter-icon-wrapper' => 'width: 100%;box-sizing: border-box;',
                ],
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'      => __('Size', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'vh', 'vw'],
                'range'      => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-advanced-counter .bdt-advanced-counter-icon-wrapper' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'image_fullwidth',
                            'operator' => '==',
                            'value'    => '',
                        ],
                        [
                            'name'     => 'icon_type',
                            'operator' => '==',
                            'value'    => 'icon',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'rotate',
            [
                'label'     => __('Rotate', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 0,
                    'unit' => 'deg',
                ],
                'range'     => [
                    'deg' => [
                        'max' => 360,
                        'min' => -360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter .bdt-advanced-counter-icon-wrapper i'   => 'transform: rotate({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .bdt-advanced-counter .bdt-advanced-counter-icon-wrapper img' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'icon_background_rotate',
            [
                'label'     => __('Background Rotate', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 0,
                    'unit' => 'deg',
                ],
                'range'     => [
                    'deg' => [
                        'max' => 360,
                        'min' => -360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter .bdt-advanced-counter-icon-wrapper' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'image_icon_heading',
            [
                'label'     => __('Image Effect', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'      => 'css_filters',
                'selector'  => '{{WRAPPER}} .bdt-advanced-counter img',
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'image_opacity',
            [
                'label'     => __('Opacity', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter img' => 'opacity: {{SIZE}};',
                ],
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'background_hover_transition',
            [
                'label'     => __('Transition Duration', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 0.3,
                ],
                'range'     => [
                    'px' => [
                        'max'  => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter img' => 'transition-duration: {{SIZE}}s',
                ],
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_hover',
            [
                'label' => __('Hover', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label'     => __('Icon Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter:hover .bdt-advanced-counter-icon-wrapper' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-advanced-counter:hover .bdt-advanced-counter-icon-wrapper svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type!' => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'icon_hover_background',
                'selector'  => '{{WRAPPER}} .bdt-advanced-counter:hover .bdt-advanced-counter-icon-wrapper:after',
            ]
        );

        $this->add_control(
            'icon_effect',
            [
                'label'        => __('Effect', 'bdthemes-element-pack'),
                'type'         => Controls_Manager::SELECT,
                'prefix_class' => 'bdt-icon-effect-',
                'default'      => 'none',
                'options'      => [
                    'none' => __('None', 'bdthemes-element-pack'),
                    'a'    => __('Effect A', 'bdthemes-element-pack'),
                    'b'    => __('Effect B', 'bdthemes-element-pack'),
                    'c'    => __('Effect C', 'bdthemes-element-pack'),
                    'd'    => __('Effect D', 'bdthemes-element-pack'),
                    'e'    => __('Effect E', 'bdthemes-element-pack'),
                ],
            ]
        );

        $this->add_control(
            'icon_hover_border_color',
            [
                'label'     => __('Border Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter:hover .bdt-advanced-counter-icon-wrapper' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'icon_border_border!' => '',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_radius',
            [
                'label'      => esc_html__('Radius', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-advanced-counter:hover .bdt-advanced-counter-icon-wrapper'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                    '{{WRAPPER}} .bdt-advanced-counter:hover .bdt-advanced-counter-icon-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_hover_shadow',
                'selector' => '{{WRAPPER}} .bdt-advanced-counter:hover .bdt-advanced-counter-icon-wrapper',
            ]
        );

        $this->add_control(
            'icon_hover_rotate',
            [
                'label'     => __('Rotate', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'unit' => 'deg',
                ],
                'range'     => [
                    'deg' => [
                        'max' => 360,
                        'min' => -360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter:hover .bdt-advanced-counter-icon-wrapper i'   => 'transform: rotate({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .bdt-advanced-counter:hover .bdt-advanced-counter-icon-wrapper img' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_background_rotate',
            [
                'label'     => __('Background Rotate', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'unit' => 'deg',
                ],
                'range'     => [
                    'deg' => [
                        'max' => 360,
                        'min' => -360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter:hover .bdt-advanced-counter-icon-wrapper' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'image_icon_hover_heading',
            [
                'label'     => __('Image Effect', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'      => 'css_filters_hover',
                'selector'  => '{{WRAPPER}} .bdt-advanced-counter:hover .bdt-advanced-counter-icon-wrapper img',
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'image_opacity_hover',
            [
                'label'     => __('Opacity', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter:hover .bdt-advanced-counter-icon-wrapper img' => 'opacity: {{SIZE}};',
                ],
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_counter_number',
            [
                'label' => __('Counter Number', 'bdthemes-element-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_counter_number_style');

        $this->start_controls_tab(
            'tab_counter_number_style_normal',
            [
                'label' => __('Normal', 'bdthemes-element-pack'),
            ]
        );

        $this->add_responsive_control(
            'counter_number_bottom_space',
            [
                'label'     => __('Spacing', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter-number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'counter_number_color',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter-content .bdt-advanced-counter-number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'counter_number_typography',
                'selector' => '{{WRAPPER}} .bdt-advanced-counter-content .bdt-advanced-counter-number',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_counter_number_style_hover',
            [
                'label' => __('Hover', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'counter_number_color_hover',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter:hover .bdt-advanced-counter-content .bdt-advanced-counter-number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'counter_number_typography_hover',
                'selector' => '{{WRAPPER}} .bdt-advanced-counter:hover .bdt-advanced-counter-content .bdt-advanced-counter-number',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_content_text',
            [
                'label' => __('Counter Text', 'bdthemes-element-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_content_text_style');

        $this->start_controls_tab(
            'tab_content_text_style_normal',
            [
                'label' => __('Normal', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'content_text_color',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter-content .bdt-advanced-counter-content-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_text_typography',
                'selector' => '{{WRAPPER}} .bdt-advanced-counter-content .bdt-advanced-counter-content-text',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_content_text_style_hover',
            [
                'label' => __('Hover', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'content_text_color_hover',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter:hover .bdt-advanced-counter-content .bdt-advanced-counter-content-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_text_typography_hover',
                'selector' => '{{WRAPPER}} .bdt-advanced-counter:hover .bdt-advanced-counter-content .bdt-advanced-counter-content-text',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_counter_number_separator',
            [
                'label'     => __('Separator', 'bdthemes-element-pack'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_separator' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'counter_number_separator_type',
            [
                'label'   => esc_html__('Separator Type', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'line',
                'options' => [
                    'line'        => esc_html__('Line', 'bdthemes-element-pack'),
                    'bloomstar'   => esc_html__('Bloomstar', 'bdthemes-element-pack'),
                    'bobbleaf'    => esc_html__('Bobbleaf', 'bdthemes-element-pack'),
                    'demaxa'      => esc_html__('Demaxa', 'bdthemes-element-pack'),
                    'fill-circle' => esc_html__('Fill Circle', 'bdthemes-element-pack'),
                    'finalio'     => esc_html__('Finalio', 'bdthemes-element-pack'),
                    'jemik'       => esc_html__('Jemik', 'bdthemes-element-pack'),
                    'leaf-line'   => esc_html__('Leaf Line', 'bdthemes-element-pack'),
                    'multinus'    => esc_html__('Multinus', 'bdthemes-element-pack'),
                    'rotate-box'  => esc_html__('Rotate Box', 'bdthemes-element-pack'),
                    'sarator'     => esc_html__('Sarator', 'bdthemes-element-pack'),
                    'separk'      => esc_html__('Separk', 'bdthemes-element-pack'),
                    'slash-line'  => esc_html__('Slash Line', 'bdthemes-element-pack'),
                    'tripline'    => esc_html__('Tripline', 'bdthemes-element-pack'),
                    'vague'       => esc_html__('Vague', 'bdthemes-element-pack'),
                    'zigzag-dot'  => esc_html__('Zigzag Dot', 'bdthemes-element-pack'),
                    'zozobe'      => esc_html__('Zozobe', 'bdthemes-element-pack'),
                ],
                //'render_type' => 'none',
            ]
        );

        $this->add_control(
            'counter_number_separator_border_style',
            [
                'label'     => esc_html__('Separator Style', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'solid',
                'options'   => [
                    'solid'  => esc_html__('Solid', 'bdthemes-element-pack'),
                    'dotted' => esc_html__('Dotted', 'bdthemes-element-pack'),
                    'dashed' => esc_html__('Dashed', 'bdthemes-element-pack'),
                    'groove' => esc_html__('Groove', 'bdthemes-element-pack'),
                ],
                'condition' => [
                    'counter_number_separator_type' => 'line',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter .bdt-number-separator' => 'border-top-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'counter_number_separator_line_color',
            [
                'label'     => esc_html__('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'counter_number_separator_type' => 'line',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter .bdt-number-separator' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'counter_number_separator_height',
            [
                'label'     => __('Height', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 15,
                    ],
                ],
                'condition' => [
                    'counter_number_separator_type' => 'line',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter .bdt-number-separator' => 'border-top-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'counter_number_separator_width',
            [
                'label'      => __('Width', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 300,
                    ],
                ],
                'condition'  => [
                    'counter_number_separator_type' => 'line',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-advanced-counter .bdt-number-separator' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'counter_number_separator_svg_fill_color',
            [
                'label'     => esc_html__('Fill Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'counter_number_separator_type!' => 'line',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter .bdt-number-separator-wrapper svg *' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'counter_number_separator_svg_stroke_color',
            [
                'label'     => esc_html__('Stroke Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'counter_number_separator_type!' => 'line',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter .bdt-number-separator-wrapper svg *' => 'stroke: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'counter_number_separator_svg_width',
            [
                'label'      => __('Width', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 300,
                    ],
                ],
                'condition'  => [
                    'counter_number_separator_type!' => 'line',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-advanced-counter .bdt-number-separator-wrapper > *' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'counter_number_separator_spacing',
            [
                'label'     => __('Separator Spacing', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter .bdt-number-separator-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_indicator',
            [
                'label'     => __('Indicator', 'bdthemes-element-pack'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'indicator' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'indicator_style',
            [
                'label'   => __('Indicator Style', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => __('Style 1', 'bdthemes-element-pack'),
                    '2' => __('Style 2', 'bdthemes-element-pack'),
                    '3' => __('Style 3', 'bdthemes-element-pack'),
                    '4' => __('Style 4', 'bdthemes-element-pack'),
                    '5' => __('Style 5', 'bdthemes-element-pack'),
                ],
            ]
        );

        $this->add_control(
            'indicator_fill_color',
            [
                'label'     => __('Fill Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-indicator-svg svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'indicator_stroke_color',
            [
                'label'     => __('Stroke Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-indicator-svg svg' => 'stroke: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
 

        $this->start_controls_section(
            'section_style_additional',
            [
                'label' => __('Additional', 'bdthemes-element-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => esc_html__('Content Inner Padding', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-advanced-counter .bdt-advanced-counter-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_inline_spacing',
            [
                'label'     => __('Icon Inline Spacing', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'position'    => ['left', 'right'],
                    'icon_inline' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-advanced-counter .bdt-icon-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render_icon()
    {
        $settings = $this->get_settings_for_display();

        $has_icon = !empty($settings['selected_icon']);

        $has_image = !empty($settings['image']['url']);

        if ($has_image and 'image' == $settings['icon_type']) {
            $this->add_render_attribute('image-icon', 'src', $settings['image']['url']);
            $this->add_render_attribute('image-icon', 'alt', $settings['content_text']);
        }

        if (!$has_icon && !empty($settings['selected_icon']['value'])) {
            $has_icon = true;
        }

        ?>
            <?php if ( 'yes' == $settings['show_icon'] ) : ?>
                <?php if ($has_icon or $has_image): ?>
                <div class="bdt-advanced-counter-icon">
                    <span class="bdt-advanced-counter-icon-wrapper">

                        <?php if ($has_icon and 'icon' == $settings['icon_type']) { ?>
                            <?php Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']); ?>
                        <?php } elseif ($has_image and 'image' == $settings['icon_type']) {?>
                            <img <?php echo $this->get_render_attribute_string('image-icon'); ?>>
                        <?php }?>

                    </span>
                </div>
                <?php endif;?>
            <?php endif;?>

		<?php
    }

    protected function render_icon_heading()
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('advanced-counter-content-number', 'class', 'bdt-advanced-counter-number');
        if ('yes' == $settings['icon_inline']) {
            $this->add_render_attribute('advanced-counter-icon-heading', 'class', 'bdt-icon-heading bdt-flex bdt-flex-middle');
        }
        if ('right' == $settings['position']) {
            $this->add_render_attribute('advanced-counter-icon-heading', 'class', 'bdt-flex-row-reverse');
        }
        ?>
		<div <?php echo $this->get_render_attribute_string('advanced-counter-icon-heading'); ?>>
			<?php $this->render_icon();?>
			<div class="bdt-counter-box-title-wrapper">
			<?php if ($settings['content_number']): ?>
				<div <?php echo $this->get_render_attribute_string('advanced-counter-content-number'); ?>>
                    <span <?php echo $this->get_render_attribute_string('content_number'); ?>>
                        <?php echo wp_kses($settings['content_number'], element_pack_allow_tags('title')); ?>
                    </span>
				</div>
				<?php endif;?>
			</div>
		</div>
		<?php

    }

    protected function render_heading()
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('advanced-counter-content-number', 'class', 'bdt-advanced-counter-number');
        ?>

		<?php if ($settings['content_number']): ?>
		<div <?php echo $this->get_render_attribute_string('advanced-counter-content-number'); ?>>
                <span class="bdt-count-this" id="bdt-advanced-counter-data-<?php echo  $this->get_id(); ?>" <?php echo $this->get_render_attribute_string('content_number'); ?>>
					<?php echo wp_kses($settings['content_number'], element_pack_allow_tags('title')); ?>
				</span>
		</div>
		<?php endif;?>
		<?php
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('content_text', 'class', 'bdt-advanced-counter-content-text');
        $this->add_inline_editing_attributes('content_number', 'none');
        $this->add_inline_editing_attributes('content_text');
        $this->add_render_attribute('advanced-counter', 'class', 'bdt-advanced-counter');
        // echo $countStart;
        $this->add_render_attribute(
            [
                'advanced_counter_data' => [
                    'data-settings' => [
                        wp_json_encode(array_filter([
                            "id"                    => 'bdt-advanced-counter-data-' . $this->get_id(),
                            "countStart"            => $settings['count_start'],
                            "countNumber"           => $settings['content_number'],
                            "language"              => explode(',', $settings['language_input']), 
                            "decimalPlaces"         => $settings['decimal_places'],
                            "duration"              => $settings['duration'],
                            "useEasing"             => $settings['use_easing'],
                            "useGrouping"           => $settings['use_grouping'],
                            "counterSeparator"      => $settings['counter_separator'],
                            "decimalSymbol"         => $settings['decimal_symbol'],
                            "counterPrefix"         => $settings['counter_prefix'],
                            "counterSuffix"         => $settings['counter_suffix'],

                        ])
                    ),
                    ],
                ],
            ]
        );
        // end send unique data            
        ?>
		<div <?php echo $this->get_render_attribute_string('advanced-counter'); ?> <?php echo $this->get_render_attribute_string('advanced_counter_data'); ?> >
        <?php if ('' == $settings['icon_inline']): ?>
            <?php $this->render_icon();?>
        <?php endif;?>
        <div class="bdt-advanced-counter-content">
            <?php if ('yes' == $settings['icon_inline']): ?>
                <?php $this->render_icon_heading();?>
            <?php else: ?>
                <?php $this->render_heading();?>
            <?php endif;?>
            <?php if ($settings['show_separator']): ?>
            <?php if ('line' == $settings['counter_number_separator_type']): ?>
                <div class="bdt-number-separator-wrapper">
                    <div class="bdt-number-separator"></div>
                </div>
            <?php elseif ('line' != $settings['counter_number_separator_type']): ?>
                <div class="bdt-number-separator-wrapper">
                    <?php
                    $svg_image = BDTEP_ASSETS_PATH . 'images/separator/' . $settings['counter_number_separator_type'] . '.svg';

                if (file_exists($svg_image)) {
                    ob_start();
                    include $svg_image;
                    $svg_image = ob_get_clean();
                    echo wp_kses($svg_image, element_pack_allow_tags('svg'));
                }
            ?>
				</div>
				<?php endif;?>
				<?php endif;?>
				<?php if ($settings['content_text']): ?>
					<<?php echo esc_html($settings['counter_number_size']); ?> <?php echo $this->get_render_attribute_string('content_text'); ?>>
						<?php echo wp_kses($settings['content_text'], element_pack_allow_tags('text')); ?>
					</<?php echo esc_html($settings['counter_number_size']); ?>>
				<?php endif;?>
			</div>
		</div>

		<?php if ($settings['indicator']): ?>
			<div class="bdt-indicator-svg bdt-svg-style-<?php echo esc_attr($settings['indicator_style']); ?>">
				<?php echo element_pack_svg_icon('arrow-' . $settings['indicator_style']); ?>
			</div>
		<?php endif;?>

		<?php
    }

 

}


