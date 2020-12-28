<?php

namespace ElementPack\Modules\DarkMode\Widgets;

use Elementor\Widget_Base;
use Elementor\Icons_Manager;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Dark_Mode extends Widget_Base
{

    public function get_name()
    {
        return 'bdt-dark-mode';
    }

    public function get_title()
    {
        return BDTEP . esc_html__('Dark Mode', 'bdthemes-element-pack');
    }

    public function get_icon()
    {
        return 'bdt-wi-dark-mode';
    }

    public function get_categories()
    {
        return ['element-pack'];
    }

    public function get_keywords()
    {
        return ['dark', 'mode', 'darkmode', 'dm'];
    }

    public function get_style_depends()
    {

        return ['ep-dark-mode'];
    }
    
    public function get_script_depends()
    {

        return ['darkmode'];
    }

    public function get_custom_help_url() {
		return 'https://youtu.be/nuYa-0sWFxU';
	}

    protected function _register_controls()
    {

        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Dark Mode', 'bdthemes-dark-mode'),
            ]
        );

        $this->add_responsive_control(
            'icon_horizontal_offset',
            [
                'label' => __('Horizontal Offset', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 32,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '.elementor-default .darkmode-toggle, .elementor-default  .darkmode-layer' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_vertical_offset',
            [
                'label' => __('Vertical Offset', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 32,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    ' .elementor-default .darkmode-toggle, .elementor-default  .darkmode-layer' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'time',
            [
                'label' => esc_html__('Animation Time', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SLIDER,
                //'size_units' => 's',
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1500,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 500,
                ],
                'selectors' => [
                    '{{WRAPPER}} .box' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

	    $this->add_control(
		    'intake_elements',
		    [
			    'type' => Controls_Manager::RAW_HTML,
			    'raw' => __( 'Note: Image can invert some cases so you need use "ignore-element" class for that image element. Background image not support in dark mode effect. So don\'t blame us for it.', 'bdthemes-element-pack' ),
			    'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',

		    ]
	    );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Dark Mode', 'bdthemes-color-mode'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_dark_mode_style');

        $this->start_controls_tab(
            'tab_day_mode_normal',
            [
                'label' => __('Day Mode', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'default_background',
            [
                'label' => esc_html__('Background', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '.darkmode-background' => 'background: {{VALUE}}',
                ],
            ]
        );

        // $this->add_control(
        //     'icon_color_day',
        //     [
        //         'label' => esc_html__('Icon Color', 'bdthemes-element-pack'),
        //         'type' => Controls_Manager::COLOR,
        //         'default' => '#fff',
        //         'selectors' => [
        //             '.darkmode-toggle i' => 'color: {{VALUE}}',
        //         ],
        //     ]
        // );

        $this->add_control(
            'day_mode_icon_background',
            [
                'label' => esc_html__('Icon Background', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'default' => '#100f2c',
                'selectors' => [
                    '.darkmode-toggle' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_dark_mode_normal',
            [
                'label' => __('Dark Mode', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'mix_color',
            [
                'label' => esc_html__('Content Mix Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        // $this->add_control(
        //     'icon_color_dark',
        //     [
        //         'label' => esc_html__('Icon Color', 'bdthemes-element-pack'),
        //         'type' => Controls_Manager::COLOR,
        //         'default' => '#000',
        //         'selectors' => [
        //             '.darkmode-toggle.darkmode-toggle--white i' => 'color: {{VALUE}}',
        //         ],
        //     ]
        // );

        $this->add_control(
            'dark_mode_icon_background',
            [
                'label' => esc_html__('Icon Background', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '.darkmode-toggle.darkmode-toggle--white' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 18,
                ],
                'selectors' => [
                    '.darkmode-toggle' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'icon_button_width',
            [
                'label' => __('Switcher Size', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 54,
                ],
                'selectors' => [
                    '.darkmode-toggle, .darkmode-layer:not(.darkmode-layer--expanded)' => 'height: {{SIZE}}{{UNIT}} !important; width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'label' => __('Border', 'bdthemes-element-pack'),
                'selector' => '.darkmode-toggle, .darkmode-layer',
            ]
        );

        $this->add_control(
            'icon_border_radius',
            [
                'label' => __('Border Radius', 'bdthemes-element-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '.darkmode-toggle, .darkmode-layer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'saveInCookies',
            [
                'label' => esc_html__('Save In Cookies', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'true',
            ]
        );

        $this->add_control(
            'autoMatchOsTheme',
            [
                'label' => esc_html__('Auto Match On Theme', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'true',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    public function render()
    {

        $settings = $this->get_settings_for_display();

        ?>

        <script>
            jQuery(document).ready(function($) {
                var options = {
                    left: 'unset', // default: 'unset'
                    time: '<?php echo $settings['time']['size'] / 1000; ?>s', // default: '0.3s'
                    mixColor: '<?php echo $settings['mix_color']; ?>', // default: '#fff'
                    backgroundColor: '<?php echo $settings['default_background']; ?>', // default: '#fff'
                    saveInCookies: '<?php echo $settings['saveInCookies']; ?>', // default: true,
                    // label: '<i class="fas fa-adjust"></i>', // default: ''  // 🌓
                    label: '🌓', // default: ''  // 🌓
                    autoMatchOsTheme: '<?php echo $settings['autoMatchOsTheme']; ?>' // default: true
                }

                const darkmode = new Darkmode(options);
                darkmode.showWidget();
            });
        </script>

    <?php
    }
}
