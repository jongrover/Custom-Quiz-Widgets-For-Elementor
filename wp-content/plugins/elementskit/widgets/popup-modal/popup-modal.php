<?php

namespace Elementor;

defined('ABSPATH') || exit;

use Elementor\ElementsKit_Widget_Popup_Modal_Handler as Handler;

class ElementsKit_Widget_Popup_Modal extends Widget_Base
{

    public $base;
    private $key_prefix = 'ekit_popup_modal_';
    private $content = '.ekit-popup-modal__content';

    public function get_name()
    {
        return Handler::get_name();
    }

    public function get_title()
    {
        return Handler::get_title();
    }

    public function get_icon()
    {
        return Handler::get_icon();
    }

    public function get_categories()
    {
        return Handler::get_categories();
    }

    private function get_dimension($value = 1, $unit = 'em', $linked = true)
    {

        $is_arr = is_array($value);
        if ($is_arr) {$value = array_map(function ($v) {return strval($v);}, $value);} else { $value = strval($value);}

        return [
            'top' => $is_arr ? $value[0] : $value, 'right' => $is_arr ? $value[1] : $value,
            'bottom' => $is_arr ? $value[2] : $value, 'left' => $is_arr ? $value[3] : $value,
            'unit' => $unit, 'isLinked' => $linked,
        ];
    }

    private function control_border($key, $selectors, $config = ['default' => '8', 'unit' => 'px', 'separator' => true, 'heading' => true])
    {

        $selectors = array_map(function ($selector) {return "{{WRAPPER}} " . $selector;}, $selectors);

        if ($config['heading']) {
            // Border heading
            $this->add_control($key, [
                'label' => esc_html__('Border', 'elementskit'),
                'type' => Controls_Manager::HEADING,
                'separator' => $config['separator'] ? 'before' : 'none',
            ]);
        }

        // Review card border
        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name' => $key . '_type',
                'label' => esc_html__('Border Type', 'elementskit'),
                'selector' => implode(',', $selectors),
            ]
        );

        $new_selectors = array();
        $border_radius = 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};';
        foreach ($selectors as $key) {$new_selectors[$key] = $border_radius;}

        // Review card border radius
        $this->add_control($key . '_radius', [
            'label' => esc_html__('Border Radius', 'elementskit'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => $new_selectors,
            'default' => [
                'top' => $config['default'], 'right' => $config['default'],
                'bottom' => $config['default'], 'left' => $config['default'],
                'unit' => $config['unit'], 'isLinked' => true,
            ],
        ]);
    }

    private function control_text($key, $selector, $exclude = [], $config = [])
    {

        // Page name color
        $this->add_control($key . '_color', [
            'label' => __('Text Color', 'elementskit'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} ' . $selector => 'color: {{VALUE}}',
            ],
        ]);

        if (!in_array("shadow", $exclude)) {
            // Page name text shadow
            $this->add_group_control(
                Group_Control_Text_Shadow::get_type(), [
                    'name' => $key . '_text_shadow',
                    'label' => __('Text Shadow', 'elementskit'),
                    'selector' => '{{WRAPPER}} ' . $selector,
                ]
            );
        }

        if (!in_array("typography", $exclude)) {
            // Page name typography
            $this->add_group_control(
                Group_Control_Typography::get_type(), [
                    'name' => $key . '_typography',
                    'label' => __('Typography', 'elementskit'),
                    'selector' => '{{WRAPPER}} ' . $selector,
                ]
            );
        }

        if (!in_array("margin", $exclude)) {
            // controls_section_overview_page_name_margin
            $value = '{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};';

            $def_margin = isset($config['def_margin'])
            ? $config['def_margin'] : ['bottom' => '16', 'unit' => 'px', 'isLinked' => false];

            $this->add_responsive_control($key . '_margin', [
                'label' => esc_html__('Margin', 'elementskit'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => $def_margin,
                'tablet_default' => $def_margin,
                'mobile_default' => $def_margin,
                'selectors' => ['{{WRAPPER}} ' . $selector => 'margin:' . $value],
            ]);
        }
    }

    private function control_button($name, $selector, $excludes = [])
    {

        // Typography
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => $this->key_prefix . $name . '_typography',
            'selector' => '{{WRAPPER}} ' . $selector,
        ]);

        if (!in_array("border", $excludes)) {
            // Border
            $this->control_border($name . '_border', [$selector], [
                'default' => '2', 'unit' => 'em',
                'separator' => false, 'heading' => false,
            ]);
        }

        // Tabs
        $this->start_controls_tabs($this->key_prefix . $name . '_tabs');

        // Tab Normal
        $this->start_controls_tab(
            $this->key_prefix . $name . '_tab_normal', [
                'label' => esc_html__('Normal', 'elementskit'),
            ]
        );

        // Tab normal background color
        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => $this->key_prefix . $name . '_background_normal',
                'label' => esc_html__('Background', 'elementskit'),
                'types' => ['classic'],
                'selector' => '{{WRAPPER}} ' . $selector,
            ]
        );

        // Tab normal text color
        $this->add_control($this->key_prefix . $name . '_color_normal',
            [
                'label' => __('Text Color', 'elementskit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $selector => 'color: {{VALUE}}',
                ],
            ]
        );

        if (!in_array('br_color', $excludes)) {
            // Tab normal border color
            $this->add_control($this->key_prefix . $name . '_border_color_normal',
                [
                    'label' => __('Border Color', 'elementskit'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ' . $selector => 'border-color: {{VALUE}}',
                    ],
                ]
            );
        }

        $this->end_controls_tab();

        // Tab Hover
        $this->start_controls_tab(
            $this->key_prefix . $name . '_tab_hover', [
                'label' => esc_html__('Hover', 'elementskit'),
            ]
        );

        // Tab hover background color
        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name' => $this->key_prefix . $name . '_background_hover',
                'label' => esc_html__('Background', 'elementskit'),
                'types' => ['classic'],
                'selector' => '{{WRAPPER}} ' . $selector . ':hover',
            ]
        );

        // Tab hover text color
        $this->add_control($this->key_prefix . $name . '_color_hover',
            [
                'label' => __('Text Color', 'elementskit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ' . $selector . ":hover" => 'color: {{VALUE}}',
                ],
            ]
        );

        if (!in_array('br_color', $excludes)) {
            // Tab hover border color
            $this->add_control($this->key_prefix . $name . '_border_color_hover',
                [
                    'label' => __('Border Color', 'elementskit'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ' . $selector . ':hover' => 'border-color: {{VALUE}}',
                    ],
                ]
            );
        }

        $this->end_controls_tab();
        $this->end_controls_tabs();
    }

    private function controls_section($config)
    {

        // New configs
        $section_config = ['label' => __($config['label'], 'elementskit')];

        // Formatting configs
        if (isset($config['tab'])) {
            $section_config['tab'] = $config['tab'];
        }

        if (isset($config['condition'])) {
            $section_config['condition'] = $config['condition'];
        }

        // Start section
        $this->start_controls_section($this->key_prefix . $config['name'] . '_section', $section_config);

        // Call the callback function
        call_user_func(array($this, 'control_section_' . $config['name']));

        // End section
        $this->end_controls_section();

    }

    private function control_section_layout()
    {
        $this->add_control(
            'ekit_popup_modal_type',
            [
                'label' => esc_html__('Modal Type', 'elementskit'),
                'type' => Controls_Manager::SELECT,
                'default' => 'ekit-modal-button',
                'options' => [
                    'ekit-modal-button' => esc_html__('Button', 'elementskit'),
                    'ekit-modal-image' => esc_html__('Image', 'elementskit'),
                ],
            ]
        );

        $this->add_control(
            'ekit_popup_modal_toggler_image',
            [
                'label' => __('Choose Image', 'plugin-domain'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'ekit_popup_modal_type' => 'ekit-modal-image',
                ],
            ]
        );
    }

    private function control_section_popup()
    {

        $key = $this->key_prefix . 'popup_';

        $this->add_responsive_control($key . 'width', [
            'label' => esc_html__('Width', 'elementskit'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', 'vw'],
            'range' => [
                'px' => ['min' => 0, 'max' => 1920, 'step' => 16],
                'vw' => ['min' => 0, 'max' => 100, 'step' => 1],
            ],
            'default' => ['unit' => 'px', 'size' => 900],
            'tablet_default' => ['unit' => 'px', 'size' => 600],
            'mobile_default' => ['unit' => 'px', 'size' => 300],
            'selectors' => [
                '{{WRAPPER}} ' . $this->content => 'width: {{SIZE}}{{UNIT}}',
            ],
        ]);

        $this->add_control($key . 'position_heading', [
            'label' => __('Position', 'elementskit'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);

        // Vertical alignment
        $this->add_responsive_control($key . 'vertical_alignment', [
            'label' => __('Vertical', 'elementskit'),
            'type' => Controls_Manager::CHOOSE,
            'default' => 'middle',
            'toggle' => true,
            'options' => [
                'top' => [
                    'title' => __('Top', 'elementskit'),
                    'icon' => 'fa fa-align-left',
                ],
                'middle' => [
                    'title' => __('Middle', 'elementskit'),
                    'icon' => 'fa fa-align-center',
                ],
                'bottom' => [
                    'title' => __('Bottom', 'elementskit'),
                    'icon' => 'fa fa-align-right',
                ],
            ],
        ]);

        // Horizontal alignment
        $this->add_responsive_control($key . 'horizontal_alignment', [
            'label' => __('Horizontal', 'elementskit'),
            'type' => Controls_Manager::CHOOSE,
            'default' => 'center',
            'toggle' => true,
            'options' => [
                'left' => [
                    'title' => __('Left', 'elementskit'),
                    'icon' => 'fa fa-align-left',
                ],
                'center' => [
                    'title' => __('Center', 'elementskit'),
                    'icon' => 'fa fa-align-center',
                ],
                'right' => [
                    'title' => __('Right', 'elementskit'),
                    'icon' => 'fa fa-align-right',
                ],
            ],
        ]);

        // Show overlay
        $this->add_control( $key . 'show_overlay', [
            'label'        => esc_html__('Show Overlay', 'elementskit'),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
            'separator'     => 'before'
        ]);

        // Close button
        $this->add_control( $key . 'show_close', [
            'label'        => esc_html__('Close Button', 'elementskit'),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes'
        ]);

        // Entrance animation
        $this->add_control( $key . 'entrance_animation', [
            'label' => __( 'Entrance Animation', 'plugin-domain' ),
            'type' => Controls_Manager::ANIMATION,
            'prefix_class' => 'animated ',
            'separator' => 'before'
        ]);

    }

    private function control_section_popup_style(){

        $key = $this->key_prefix . 'popup_';
        $selector = '.ekit-popup-modal .ekit-popup-modal__content';

        // Background
		$this->add_group_control(
			Group_Control_Background::get_type(), [
				'name'     => $key . 'background',
				'label'    => esc_html__('Popup Background', 'elementskit'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} ' . $selector,
			]
		);

        // Box shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(), [
				'name' => $key . 'box_shadow',
				'label' => __( 'Box Shadow', 'elementskit' ),
				'selector' => '{{WRAPPER}} ' . $selector
			]
		);

        // Border
		$this->control_border(  $key . 'border', 
            [ $selector ], [ 'default' => '4', 'unit' => 'px', 'separator' => true, 'heading' => true ]
		);
    }

    private function control_section_overlay(){

        $selector = '.ekit-popup-modal .ekit-popup-modal__overlay';

        // ekit_behance_feed_widget_background
		$this->add_group_control(
			Group_Control_Background::get_type(), [
				'name'     => $this->key_prefix . 'overlay_background',
				'label'    => esc_html__('Overlay Background', 'elementskit'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} ' . $selector,
			]
		);

    }

    private function control_section_close_button(){

        $key = $this->key_prefix . 'close_button_';
        $selector = '.ekit-popup-modal__close';

        // Icon
        $this->add_control( $key . 'icons', [
            'label' => esc_html__( 'Icon', 'elementskit' ),
            'type' => Controls_Manager::ICONS,
            'label_block' => true,
            'fa4compatibility' => $key . 'icon',
            'default' => [
                'value' => 'icon icon-cross',
                'library' => 'ekiticons',
            ]
        ]);

        // Vertical position
        $this->add_responsive_control( $key . 'vertical_position', [
            'label'           => esc_html__('Vertical Position', 'elementskit'),
            'type'            => Controls_Manager::SLIDER,
            'size_units'      => ['px','em'],
            'range'           => [
                'px' => [ 'min'  => 0, 'max'  => 64, 'step' => 2 ],
                'em' => [ 'min'  => 0, 'max'  => 4, 'step' => 0.2 ]
            ],
            'devices'         => ['desktop', 'tablet', 'mobile'],
            'default'         => [ 'size' => 32, 'unit' => 'px' ],
            'tablet_default'  => [ 'size' => 24, 'unit' => 'px' ],
            'mobile_default'  => [ 'size' => 16, 'unit' => 'px' ],
            'selectors'       => [
                '{{WRAPPER}} ' . $selector => 'top: {{SIZE}}{{UNIT}};',
            ]
        ]);

        // Horizontal position
        $this->add_responsive_control( $key . 'horizontal_position', [
            'label'           => esc_html__('Horizontal Position', 'elementskit'),
            'type'            => Controls_Manager::SLIDER,
            'size_units'      => ['px','em'],
            'range'           => [
                'px' => [ 'min'  => 0, 'max'  => 64, 'step' => 2 ],
                'em' => [ 'min'  => 0, 'max'  => 4, 'step' => 0.2 ]
            ],
            'devices'         => ['desktop', 'tablet', 'mobile'],
            'default'         => [ 'size' => 32, 'unit' => 'px' ],
            'tablet_default'  => [ 'size' => 24, 'unit' => 'px' ],
            'mobile_default'  => [ 'size' => 16, 'unit' => 'px' ],
            'selectors'       => [
                '{{WRAPPER}} ' . $selector => 'right: {{SIZE}}{{UNIT}};',
            ]
        ]);

        // Tabs
		$this->start_controls_tabs( $key . 'tabs', ['separator' => 'before'] );

		// Tab Normal 
        $this->start_controls_tab(
            $key . 'tab_normal', [
                'label' => esc_html__( 'Normal', 'elementskit' ),
            ]
		);

        // Tab normal background color
		$this->add_group_control(
			Group_Control_Background::get_type(), [
				'name'     => $key . 'background_normal',
				'label'    => esc_html__('Background', 'elementskit'),
				'types'    => ['classic'],
				'selector' => '{{WRAPPER}} '. $selector,
			]
		);

		// Tab normal text color
		$this->add_control( $key . 'color_normal',
			[
				'label'     => __('Color', 'elementskit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $selector => 'color: {{VALUE}}',
				],
			]
        );

		$this->end_controls_tab();

		// Tab Hover
        $this->start_controls_tab( 
            $key . 'tab_hover', [
                'label' => esc_html__( 'Hover', 'elementskit' ),
            ]
		);

        // Tab hover background color
		$this->add_group_control(
			Group_Control_Background::get_type(), [
				'name'     => $key . 'background_hover',
				'label'    => esc_html__('Background', 'elementskit'),
				'types'    => ['classic'],
				'selector' => '{{WRAPPER}} '. $selector . ':hover',
			]
		);

		// Tab hover text color
		$this->add_control( $key . 'color_hover',
			[
				'label'     => __('Color', 'elementskit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $selector . ":hover" => 'color: {{VALUE}}',
				],
			]
        );

		$this->end_controls_tab();
        $this->end_controls_tabs();
        
        // Horizontal position
        $this->add_responsive_control( $key . 'font_size', [
            'label'           => esc_html__('Size', 'elementskit'),
            'type'            => Controls_Manager::SLIDER,
            'size_units'      => ['px','em'],
            'range'           => [
                'px' => [ 'min'  => 0, 'max'  => 64, 'step' => 2 ],
                'em' => [ 'min'  => 0, 'max'  => 4, 'step' => 0.2 ]
            ],
            'devices'         => ['desktop', 'tablet', 'mobile'],
            'default'         => [ 'size' => 18, 'unit' => 'px' ],
            'tablet_default'  => [ 'size' => 15, 'unit' => 'px' ],
            'mobile_default'  => [ 'size' => 12, 'unit' => 'px' ],
            'selectors'       => [
                '{{WRAPPER}} ' . $selector => 'font-size: {{SIZE}}{{UNIT}};',
            ],
            'separator' => 'before'
        ]);
    }

    protected function _register_controls()
    {

        // Layout
        $this->controls_section([
            'name' => 'layout',
            'label' => 'Layout',
        ]);

        // Layout
        $this->controls_section([
            'name' => 'popup',
            'label' => 'Popup',
        ]);
    
        // Popup
        $this->controls_section([
            'name' => 'popup_style',
            'label' => 'Popup',
            'tab' => Controls_Manager::TAB_STYLE
        ]);

        // Overlay
        $this->controls_section([
            'name' => 'overlay',
            'label' => 'Overlay',
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                $this->key_prefix . 'popup_show_overlay' => 'yes'
            ]
        ]);
    
        // Close Button
        $this->controls_section([
            'name' => 'close_button',
            'label' => 'Close Button',
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                $this->key_prefix . 'popup_show_close' => 'yes'
            ]
        ]);

    }

    protected function render()
    {
        echo '<div class="ekit-wid-con" >';
        $this->render_raw();
        echo '</div>';
    }

    protected function render_raw()
    {

        $settings = $this->get_settings_for_display();
        extract($settings);

        ?>
        <!-- Start Markup -->


            <?php if ($ekit_popup_modal_toggler_image): ?>
                <img src="<?php echo $ekit_popup_modal_toggler_image['url'] ?>" alt="">
            <?php else: ?>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ekit-popup-modal"
                    id="ekit-popup-modal-toggler">
                    Launch demo modal
                </button>
            <?php endif?>

            <!-- Modal -->
            <div class="ekit-popup-modal show">
                <?php
                    $content_classes = '';
                    $content_classes .= "$ekit_popup_modal_popup_horizontal_alignment";
                    $content_classes .= " $ekit_popup_modal_popup_vertical_alignment";
                    $content_classes .= " $ekit_popup_modal_popup_entrance_animation";
                ?>
                <div class="ekit-popup-modal__content <?php echo $content_classes ?>">
                    <div class="ekit-popup-modal__close">
                        <?php 
                            $migrated = isset( $settings['__fa4_migrated']['ekit_popup_modal_close_button_icons'] );
                            $is_new = empty( $ekit_popup_modal_close_button_icon );
                            if ( $is_new || $migrated ) :
                                \Elementor\Icons_Manager::render_icon( $ekit_popup_modal_close_button_icons, [ 'aria-hidden' => 'true'] );
                            else : ?>
                                <i class="<?php echo $ekit_popup_modal_close_button_icon; ?>" aria-hidden="true"></i>
                            <?php endif;
                        ?>
                    </div>
                    <div class="ekit-popup-modal__title">
                        This is a popup
                    </div>
                    <div class="ekit-popup-modal__body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea nisi consectetur dignissimos. Doloremque error voluptate tempore voluptatem? Ea quasi obcaecati tempore alias? Quis consequuntur facere vel praesentium optio, at necessitatibus aliquam saepe ad omnis ab maiores, in quod animi a. Quisquam veniam eaque maxime enim totam! Molestias, repellendus expedita. Voluptas.
                    </div>
                </div>
                <?php if($ekit_popup_modal_popup_show_overlay): ?>
                    <div class="ekit-popup-modal__overlay"></div>
                <?php endif; ?>
            </div>
        <!-- End Markup -->

    <?php }}?>