<?php
namespace Elementor;

use \Elementor\ElementsKit_Widget_hotspot_Handler as Handler;
use \ElementsKit_Lite\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if (! defined( 'ABSPATH' ) ) exit;

class ElementsKit_Widget_hotspot extends Widget_Base {
    use \ElementsKit_Lite\Widgets\Widget_Notice;

    public $base;

    public function get_name() {
        return Handler::get_name();
    }

    public function get_title() {
        return Handler::get_title();
    }

    public function get_icon() {
        return Handler::get_icon();
    }

    public function get_categories() {
        return Handler::get_categories();
    }


    protected function _register_controls() {
        $this->start_controls_section(
            'section_tab', [
                'label' =>esc_html__( 'Hotspot', 'elementskit-lite' ),
            ]
        );

        $this->add_control(
            'ekit_hotspot_style_choosers',
            [
                'label' => esc_html__('Choose Style', 'elementskit-lite'),
                'type' => ElementsKit_Controls_Manager::IMAGECHOOSE,
                'default' => 'tultip_style',
                'options' => [
                    'tultip_style' => [
                        'title' => esc_html__( 'Image style 1', 'elementskit-lite' ),
                        'imagelarge' => Handler::get_url() . 'assets/imagechoose/tooltip-style.png',
                        'imagesmall' => Handler::get_url() . 'assets/imagechoose/tooltip-style.png',
                        'width' => '50%',
                    ],
                    'following_line_style' => [
                        'title' => esc_html__( 'Image style 2', 'elementskit-lite' ),
                        'imagelarge' => Handler::get_url() . 'assets/imagechoose/following_line_style.png',
                        'imagesmall' => Handler::get_url() . 'assets/imagechoose/following_line_style.png',
                        'width' => '50%',
                    ],
                ],
            ]
        );

        $this->add_control(
            'ekit_hotspot_background_image', [
                'label'		 => esc_html__( 'Background Map Image', 'elementskit-lite' ),
                'type'		 => Controls_Manager::MEDIA,
                'default'	 => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
			'ekit_hotspot_show_glow',
			[
				'label' => __( 'Show Glow', 'elementskit-lite' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'elementskit-lite' ),
				'label_off' => __( 'Hide', 'elementskit-lite' ),
				'return_value' => 'yes',
                'default' => 'yes',
			]
		);

        $this->add_control(
			'ekit_hotspot_tigger_on_hover_or_click',
			[
				'label' => __( 'Click Or Hover', 'elementskit-lite' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hover', 'elementskit-lite' ),
				'label_off' => __( 'Click', 'elementskit-lite' ),
				'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'ekit_hotspot_style_choosers' => 'tultip_style'
                ]
			]
        );
        
        $this->add_control(
			'ekit_hotspot_all_time_show_hide',
			[
				'label' => __( 'Active Or Not', 'elementskit-lite' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'elementskit-lite' ),
				'label_off' => __( 'Hide', 'elementskit-lite' ),
				'return_value' => 'yes',
                'default' => 'no',
			]
		);

        // Hotspot point

        $hotspot_point = new \Elementor\Repeater();

        $hotspot_point->add_control(
            'ekit_hotspot_title', [
                'label' => esc_html__( 'Title', 'elementskit-lite' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'South Carolina Data Center' , 'elementskit-lite' ),
                'label_block' => true,
            ]
        );

        $hotspot_point->add_control(
			'ekit_hotspot_address',
			[
				'label' => __( 'Description', 'elementskit-lite' ),
				'type' => Controls_Manager::WYSIWYG,
				'placeholder' => __( 'Type your description here', 'elementskit-lite' ),
			]
		);

        $hotspot_point->add_control(
			'ekit_hotspot_follow_line_direction',
			[
				'label' => __( 'Line Direction', 'elementskit-lite' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ekit_hotspot_follow_line_left_top',
				'options' => [
					'ekit_hotspot_follow_line_top'  => __( 'Top', 'elementskit-lite' ),
                    'ekit_hotspot_follow_line_left'  => __( 'Left', 'elementskit-lite' ),
					'ekit_hotspot_follow_line_right' => __( 'Right', 'elementskit-lite' ),
                    'ekit_hotspot_follow_line_bottom' => __( 'Bottom', 'elementskit-lite' ),
					'ekit_hotspot_follow_line_left_top'  => __( 'Left Top', 'elementskit-lite' ),
					'ekit_hotspot_follow_line_left_bottom'  => __( 'Left Bottom', 'elementskit-lite' ),
					'ekit_hotspot_follow_line_right_top' => __( 'Right Top', 'elementskit-lite' ),
					'ekit_hotspot_follow_line_right_bottom' => __( 'Right Bottom', 'elementskit-lite' ),
				],
			]
        );
        
        $hotspot_point->add_responsive_control(
            'ekit_hotspot_position_follow_line_top',
            [
                'label'		 => esc_html__( 'Bottom', 'elementskit-lite' ),
                'type'		 => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'		 => [
                    'px' => [
                        'min'	 => -100,
                        'max'	 => 500,
                        'step'	 => 1,
                    ],
                    '%'	 => [
                        'min'	 => -100,
                        'max'	 => 100,
                        'step'	 => 1,
                    ],
                ],
                'selectors'	 => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.hotspot-following-line-style.ekit_hotspot_follow_line_left_top .ekit-location_outer' => 'bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}}.hotspot-following-line-style.ekit_hotspot_follow_line_right_top .ekit-location_outer' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ekit_hotspot_follow_line_direction' => ['ekit_hotspot_follow_line_left_top', 'ekit_hotspot_follow_line_right_top']
                ]
            ]
        );

        $hotspot_point->add_responsive_control(
            'ekit_hotspot_position_follow_line_straight',
            [
                'label'		 => esc_html__( 'Bottom', 'elementskit-lite' ),
                'type'		 => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'		 => [
                    'px' => [
                        'min'	 => -100,
                        'max'	 => 500,
                        'step'	 => 1,
                    ],
                    '%'	 => [
                        'min'	 => -100,
                        'max'	 => 100,
                        'step'	 => 1,
                    ],
                ],
                'selectors'	 => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.hotspot-following-line-straight.ekit_hotspot_follow_line_right .ekit-location_outer' => 'bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}}.hotspot-following-line-straight.ekit_hotspot_follow_line_top .ekit-location_outer' => 'bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}}.hotspot-following-line-straight.ekit_hotspot_follow_line_left .ekit-location_outer' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ekit_hotspot_follow_line_direction' => ['ekit_hotspot_follow_line_right', 'ekit_hotspot_follow_line_top', 'ekit_hotspot_follow_line_left']
                ]
            ]
        );
        
        $hotspot_point->add_responsive_control(
            'ekit_hotspot_position_follow_line_bottom',
            [
                'label'		 => esc_html__( 'Top', 'elementskit-lite' ),
                'type'		 => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'		 => [
                    'px' => [
                        'min'	 => -100,
                        'max'	 => 500,
                        'step'	 => 1,
                    ],
                    '%'	 => [
                        'min'	 => -100,
                        'max'	 => 100,
                        'step'	 => 1,
                    ],
                ],
                'selectors'	 => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.hotspot-following-line-style.ekit_hotspot_follow_line_left_bottom .ekit-location_outer' => 'top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} {{CURRENT_ITEM}}.hotspot-following-line-style.ekit_hotspot_follow_line_right_bottom .ekit-location_outer' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ekit_hotspot_follow_line_direction' => ['ekit_hotspot_follow_line_left_bottom', 'ekit_hotspot_follow_line_right_bottom']
                ]
            ]
        );

        $hotspot_point->add_control(
            'ekit_hotspot_logo',
            [
                'label' => esc_html__( 'Choose Image', 'elementskit-lite' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $hotspot_point->add_responsive_control(
            'ekit_hotspot_point_left_pos',
            [
                'label'		 => esc_html__( 'Left', 'elementskit-lite' ),
                'type'		 => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'		 => [
                    'px' => [
                        'min'	 => 0,
                        'max'	 => 100,
                        'step'	 => 1,
                    ],
                    '%'	 => [
                        'min'	 => 0,
                        'max'	 => 100,
                        'step'	 => 1,
                    ],
                ],
                'selectors'	 => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ekit_hotspot_point_show_right_bottom_pos!' => 'yes'
                ]
            ]
        );
        $hotspot_point->add_responsive_control(
            'ekit_hotspot_point_top_pos',
            [
                'label'		 => esc_html__( 'Top', 'elementskit-lite' ),
                'type'		 => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'		 => [
                    'px' => [
                        'min'	 => 0,
                        'max'	 => 100,
                        'step'	 => 1,
                    ],
                    '%'	 => [
                        'min'	 => 0,
                        'max'	 => 100,
                        'step'	 => 1,
                    ],
                ],
                'selectors'	 => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ekit_hotspot_point_show_right_bottom_pos!' => 'yes'
                ]
            ]
        );

        $hotspot_point->add_control(
			'ekit_hotspot_point_show_right_bottom_pos',
			[
				'label' => esc_html__( 'Right and bottom?', 'elementskit-lite' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementskit-lite' ),
				'label_off' => esc_html__( 'Hide', 'elementskit-lite' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $hotspot_point->add_responsive_control(
            'ekit_hotspot_point_right_pos',
            [
                'label'		 => esc_html__( 'Right', 'elementskit-lite' ),
                'type'		 => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'		 => [
                    'px' => [
                        'min'	 => 0,
                        'max'	 => 100,
                        'step'	 => 1,
                    ],
                    '%'	 => [
                        'min'	 => 0,
                        'max'	 => 100,
                        'step'	 => 1,
                    ],
                ],
                'selectors'	 => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ekit_hotspot_point_show_right_bottom_pos' => 'yes'
                ]
            ]
        );
        $hotspot_point->add_responsive_control(
            'ekit_hotspot_point_bottom_pos',
            [
                'label'		 => esc_html__( 'Bottom', 'elementskit-lite' ),
                'type'		 => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'		 => [
                    'px' => [
                        'min'	 => 0,
                        'max'	 => 100,
                        'step'	 => 1,
                    ],
                    '%'	 => [
                        'min'	 => 0,
                        'max'	 => 100,
                        'step'	 => 1,
                    ],
                ],
                'selectors'	 => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ekit_hotspot_point_show_right_bottom_pos' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'ekit_location_repeater',
            [
                'label' => esc_html__( 'Repeater List', 'elementskit-lite' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $hotspot_point->get_controls(),
                'default' => [
                    [
                        // repeater 1
                        'ekit_hotspot_title' => esc_html__( 'South Carolina Data Center', 'elementskit-lite' ),
                        'ekit_hotspot_address' => esc_html__( 'Item content. Click the edit button to change this text.', 'elementskit-lite' ),
                        'ekit_hotspot_point_left_pos' => [
                            'unit'	 => '%',
                            'size'	 => 18,
                        ],
                        'ekit_hotspot_point_top_pos' => [
                            'unit'	 => '%',
                            'size'	 => 29,
                        ],
                    ],
                    [
                        // repeater 2
                        'ekit_hotspot_title' => esc_html__( 'South Carolina Data Center', 'elementskit-lite' ),
                        'ekit_hotspot_address' => esc_html__( 'Item content. Click the edit button to change this text.', 'elementskit-lite' ),
                        'ekit_hotspot_point_left_pos' => [
                            'unit'	 => '%',
                            'size'	 => 49,
                        ],
                        'ekit_hotspot_point_top_pos' => [
                            'unit'	 => '%',
                            'size'	 => 30,
                        ],
                    ],
                    [
                        // repeter 4
                        'ekit_hotspot_title' => esc_html__( 'South Carolina Data Center', 'elementskit-lite' ),
                        'ekit_hotspot_address' => esc_html__( 'Item content. Click the edit button to change this text.', 'elementskit-lite' ),
                        'ekit_hotspot_point_left_pos' => [
                            'unit'	 => '%',
                            'size'	 => 36,
                        ],
                        'ekit_hotspot_point_top_pos' => [
                            'unit'	 => '%',
                            'size'	 => 4,
                        ],
                    ],
                    [
                        // repeter 5
                        'ekit_hotspot_title' => esc_html__( 'South Carolina Data Center', 'elementskit-lite' ),
                        'ekit_hotspot_address' => esc_html__( 'Item content. Click the edit button to change this text.', 'elementskit-lite' ),
                        'ekit_hotspot_point_left_pos' => [
                            'unit'	 => '%',
                            'size'	 => 55,
                        ],
                        'ekit_hotspot_point_top_pos' => [
                            'unit'	 => '%',
                            'size'	 => 40,
                        ],
                    ],
                ],
                'title_field' => '{{{ ekit_hotspot_title }}}',
            ]
        );


        $this->end_controls_section();

        /**
         *
         * Content Style
         *
         */
        $this->start_controls_section(
            'ekit_hotspot_content_section', [
                'label'	 => esc_html__( 'Content', 'elementskit-lite' ),
                'tab'	 => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ekit_hotspot_content_bg',
                'label' => esc_html__( 'Background', 'elementskit-lite' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .media',
            ]
        );

        $this->add_control(
			'ekit_hotspot_spacing',
			[
				'label' => __( 'Padding', 'elementskit-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit-location_inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        
        $this->add_responsive_control(
			'ekit_hotspot_location_wraper_width',
			[
				'label' => __( 'Width', 'elementskit-lite' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 350,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ekit-location_outer' => 'min-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .hotspot-following-line-style .ekit-hotspot-horizontal-line' => 'width: calc({{SIZE}}{{UNIT}} / 2.18) !important;',
				],
			]
        );
        
        
		$this->add_control(
			'ekit_hotspot_location_wraper_text_align',
			[
				'label' => __( 'Alignment', 'elementskit-lite' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementskit-lite' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'elementskit-lite' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elementskit-lite' ),
						'icon' => 'fa fa-align-right',
					],
                ],
                'selectors'=> [
                    '{{WRAPPER}} .ekit-location_outer' => 'text-align: {{VALUE}};'
                ],
				'default' => 'left',
				'toggle' => true,
			]
		);
        
        $this->add_control(
			'ekit_hotspot_show_caret',
			[
				'label' => __( 'Show Caret', 'elementskit-lite' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'elementskit-lite' ),
				'label_off' => __( 'Hide', 'elementskit-lite' ),
				'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
			]
		);

        $this->add_control(
            'ekit_hotspot_arrow_color', [
                'label'		 => esc_html__( 'Caret Background', 'elementskit-lite' ),
                'type'		 => Controls_Manager::COLOR,
                'default'	 => '',
                'selectors'	 => [
                    '{{WRAPPER}} .ekit_hotspot_arrow:before'  => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'ekit_hotspot_show_caret' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ekit_hotspot_indicatior_section', [
                'label'	 => esc_html__( 'Pointer', 'elementskit-lite' ),
                'tab'	 => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ekit_hotspot_indicator_background', [
                'label'		 => esc_html__( 'Background Color', 'elementskit-lite' ),
                'type'		 => Controls_Manager::COLOR,
                'default'	 => '',
                'selectors'	 => [
                    '{{WRAPPER}} .ekit-location_indicator'  => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'ekit_hotspot_indicator_size',
			[
				'label' => __( 'Pointer Size', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 34,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ekit-wid-con .ekit-location_indicator' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
        );
        
        $this->add_control(
			'ekit_hotspot_indicator_border_radius',
			[
				'label' => __( 'Border Radius', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit-wid-con .ekit-location_indicator' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ekit_hotspot_indicator_box_shadow',
				'label' => __( 'Box Shadow', 'elementskit-lite' ),
				'selector' => '{{WRAPPER}} .ekit-location_indicator',
			]
        );
        
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ekit_hotspot_indicator_border',
				'label' => __( 'Border', 'elementskit-lite' ),
				'selector' => '{{WRAPPER}} .ekit-location_indicator',
			]
		);

        $this->add_responsive_control(
            'ekit_hotspot_indicatorpoint_background', [
                'label'		 => esc_html__( 'Point Color', 'elementskit-lite' ),
                'type'		 => Controls_Manager::COLOR,
                'default'	 => '',
                'selectors'	 => [
                    '{{WRAPPER}} .ekit-location_indicator:after'  => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .hotspot-following-line-style .ekit-hotspot-vertical-line'  => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .hotspot-following-line-style .ekit-hotspot-horizontal-line'  => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .hotspot-following-line-straight .ekit-hotspot-horizontal-line'  => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekit_hotspot_indicatorpoint_color', [
                'label'		 => esc_html__( 'Glow Color', 'elementskit-lite' ),
                'type'		 => Controls_Manager::COLOR,
                'default'	 => '',
                'selectors'	 => [
                    '{{WRAPPER}} .ekit-location_indicator'  => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'ekit_hotspot_show_glow' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        // --- Title Style
        $this->start_controls_section(
			'ekit_hotspot_title_style_tab',
			[
				'label' => __( 'Title', 'plugin-name' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ekit_hotspot_title_typography',
				'label' => __( 'Typography', 'elementskit-lite' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .ekit-hotspot-title',
			]
		);

        $this->add_responsive_control(
            'ekit_hotspot_title_color', [
                'label'		 => esc_html__( 'Text Color', 'elementskit-lite' ),
                'type'		 => Controls_Manager::COLOR,
                'default'	 => '#000',
                'selectors'	 => [
                    '{{WRAPPER}} .ekit-hotspot-title'  => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_responsive_control(
			'ekit_hotspot_title_margin',
			[
				'label' => __( 'Margin', 'elementskit-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit-hotspot-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
        
        // --- Description Style
        $this->start_controls_section(
			'ekit_hotspot_description_style_tab',
			[
				'label' => __( 'Description', 'plugin-name' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ekit_hotspot_description_typography',
				'label' => __( 'Typography', 'elementskit-lite' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .ekit-location-des > *, {{WRAPPER}} .ekit-location-des',
			]
		);

        $this->add_responsive_control(
            'ekit_hotspot_description_color', [
                'label'		 => esc_html__( 'Text Color', 'elementskit-lite' ),
                'type'		 => Controls_Manager::COLOR,
                'default'	 => '#000',
                'selectors'	 => [
                    // '{{WRAPPER}} .ekit-location-des > *'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ekit-location-des'  => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'ekit_hotspot_description_margin',
			[
				'label' => __( 'Margin', 'elementskit-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit-location-des' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
        
        // --- Image Style
        $this->start_controls_section(
			'ekit_hotspot_logo_style_tab',
			[
				'label' => __( 'Image', 'plugin-name' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );
        
        $this->add_control(
			'ekit_hotspot_location_wraper_image_position',
			[
				'label' => __( 'Image Position', 'elementskit-lite' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'media',
				'options' => [
					'media flex-column'  => __( 'Top', 'elementskit-lite' ),
					'media' => __( 'Left', 'elementskit-lite' ),
					'media flex-row-reverse' => __( 'Right', 'elementskit-lite' ),
					'media flex-column-reverse' => __( 'Bottom', 'elementskit-lite' ),
				],
			]
        );

        $this->add_responsive_control(
			'ekit_hotspot_logo_margin',
			[
				'label' => __( 'Margin', 'elementskit-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit-wid-con .ekit_hotspot_image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
        
        $this->add_responsive_control(
			'ekit_hotspot_logo_width',
			[
				'label' => __( 'Width', 'elementskit-lite' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 30,
				],
				'selectors' => [
                    '{{WRAPPER}} .ekit-wid-con .ekit_hotspot_image > img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

        $this->insert_pro_message();
    }

    protected function render( ) {
        echo '<div class="ekit-wid-con" >';
        $this->render_raw();
        echo '</div>';
    }

    protected function render_raw( ) {

        $settings = $this->get_settings_for_display();

        extract($settings); ?>

        <div class="ekit-location-groups">
            <div class="ekit-map-image text-center">
                <img src="<?php echo esc_url($ekit_hotspot_background_image['url']); ?>" alt="map">
            </div>
            <div class="ekit-location-wraper clearfix">
                <?php

                    if($ekit_location_repeater != '') {

                    foreach ($ekit_location_repeater as $key => $location) {  
                
                    $hotspot_line_class = '';
                    if (
                        $location['ekit_hotspot_follow_line_direction'] === 'ekit_hotspot_follow_line_left_top' || 
                        $location['ekit_hotspot_follow_line_direction'] === 'ekit_hotspot_follow_line_left_bottom' || 
                        $location['ekit_hotspot_follow_line_direction'] === 'ekit_hotspot_follow_line_right_top' || 
                        $location['ekit_hotspot_follow_line_direction'] === 'ekit_hotspot_follow_line_right_bottom' ) {
                        $hotspot_line_class = 'hotspot-following-line-style';
                    } else {
                        $hotspot_line_class = 'hotspot-following-line-straight';
                    }
                    
                    require Handler::get_dir() . 'style/'.$ekit_hotspot_style_choosers.'.php';
                    
                    }; }; 
                ?>

            </div><!-- .location-wraper END -->
        </div>
    <?php
    }
    protected function _content_template() { }
}