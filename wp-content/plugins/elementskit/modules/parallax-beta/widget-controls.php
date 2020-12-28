<?php

namespace Elementor;

class ElementsKit_Widget_Effect_Controls
{
    public function __construct()
    {
        add_action('elementor/element/common/_section_style/after_section_end', [$this, 'register_controls'], 5, 2);
    }

    public function register_controls($control, $args)
    {
        $control->start_controls_section(
            'ekit_widget_effects',
            [
                'label' => esc_html__('ElementsKit Effects', 'elemenetskit'),
                'tab' => Controls_Manager::TAB_ADVANCED,
            ]
        );

        $control->add_control(
            'ekit_we_effect_on', [
                'label' => esc_html__('Effect Type', 'elementskit'),
                'render_type' => 'none',
                'frontend_available' => true,
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__('None', 'elementskit'),
                    'css' => esc_html__('CSS effect', 'elementskit'),
                    'scrolleffect' => esc_html__('On Scroll effect', 'elementskit'),
                    'mouseeffect' => esc_html__('Mouse move effect', 'elementskit'),
                ],
            ]
        );

/*
 * CSS animation begin
 */
        $control->add_control(
            'ekit_we_css_animation_fx',
            [
                'label' => esc_html__('CSS Animation', 'elemenetskit'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'elemenetskit'),
                'render_type' => 'ui',
                'label_off' => esc_html__('Off', 'elemenetskit'),
                'condition' => [
                    'ekit_we_effect_on' => 'css',
                ],
            ]
        );
        $control->add_responsive_control(
            'ekit_we_css_animation',
            [
                'label' => esc_html__('Animation', 'elemenetskit'),
                'type' => Controls_Manager::SELECT2,
                'render_type' => 'ui',
                'default' => 'ekit-fade',
                'options' => [
                    'ekit-fade' => 'Fade',
                    'ekit-rotate' => 'Rotate',
                    'ekit-bounce' => 'Bounce',
                    'ekit-zoom' => 'Zoom',
                    'ekit-rotate-box' => 'RotateBox',
                    'ekit-left-right' => 'Left Right',
                    'bounce' => 'Bounce 2',
                    'flash' => 'Flash',
                    'pulse' => 'Pulse',
                    'shake' => 'Shake',
                    'headShake' => 'HeadShake',
                    'swing' => 'Swing',
                    'tada' => 'Tada',
                    'wobble' => 'Wobble',
                    'jello' => 'Jello',
                ],
                'condition' => [
                    'ekit_we_css_animation_fx' => 'yes',
                    'ekit_we_effect_on' => 'css',
                ],
                'selectors' => [
                    "{{WRAPPER}} .elementor-widget-container" => '-webkit-animation-name:{{UNIT}}',
                    "{{WRAPPER}} .elementor-widget-container" => 'animation-name:{{UNIT}}',
                ],
            ]
        );

        $control->add_control(
            'ekit_we_css_animation_speed',
            [
                'label' => esc_html__('Animation speed', 'elemenetskit'),
                'type' => Controls_Manager::NUMBER,
                'render_type' => 'ui',
                'default' => '5',
                'min' => 1,
                'step' => 100,
                'condition' => [
                    'ekit_we_css_animation_fx' => 'yes',
                    'ekit_we_effect_on' => 'css',
                ],
                'selectors' => [
                    "{{WRAPPER}} .elementor-widget-container" => '-webkit-animation-duration:{{UNIT}}s',
                    "{{WRAPPER}} .elementor-widget-container" => 'animation-duration:{{UNIT}}s',
                ],
            ]
        );
        $control->add_control(
            'ekit_we_css_animation_iteration_count',
            [
                'label' => esc_html__('Animation Iteration Count', 'elemenetskit'),
                'type' => Controls_Manager::SELECT,
                'render_type' => 'ui',
                'default' => 'infinite',
                'options' => [
                    'infinite' => esc_html__('Infinite', 'elemenetskit'),
                    'unset' => esc_html__('Unset', 'elemenetskit'),
                ],
                'condition' => [
                    'ekit_we_effect_on' => 'css',
                    'ekit_we_css_animation_fx' => 'yes',
                ],
                'selectors' => [
                    "{{WRAPPER}} .elementor-widget-container" => 'animation-iteration-count:{{UNIT}}',
                ],
            ]
        );
        $control->add_control(
            'ekit_we_css_animation_direction',
            [
                'label' => esc_html__('Animation Direction', 'elemenetskit'),
                'render_type' => 'ui',
                'type' => Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'normal' => esc_html__('Normal', 'elemenetskit'),
                    'reverse' => esc_html__('Reverse', 'elemenetskit'),
                    'alternate' => esc_html__('Alternate', 'elemenetskit'),
                ],
                'condition' => [
                    'ekit_we_effect_on' => 'css',
                    'ekit_we_css_animation_fx' => 'yes',
                ],
                'selectors' => [
                    "{{WRAPPER}} .elementor-widget-container" => 'animation-direction:{{UNIT}}',
                ],
            ]
        );

        $control->add_control(
            'ekit_wex_hr_2',
            [
                'type' => Controls_Manager::DIVIDER,
                'condition' => [
                    'ekit_we_effect_on!' => 'none',
                ],
            ]
        );

/*
 *-----------------------------------------------------------------------------------------------------------

 * tcss transform begin
 */
        $control->add_control(
            'ekit_we_css_transform_fx',
            [
                'label' => esc_html__('CSS Transform', 'elementskit'),
                'render_type' => 'ui',
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'condition' => [
                    'ekit_we_effect_on' => 'css',
                ],
            ]
        );

        $control->add_control(
            'ekit_we_css_transform_fx_translate_toggle',
            [
                'label' => esc_html__('Translate', 'elementskit'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'render_type' => 'ui',
                'return_value' => 'yes',
                'condition' => [
                    'ekit_we_css_transform_fx' => 'yes',
                    'ekit_we_effect_on' => 'css',
                ],
            ]
        );

        $control->start_popover();

        $control->add_responsive_control(
            'ekit_we_css_transform_fx_translate_x',
            [
                'label' => esc_html__('Left-RIght', 'elementskit'),
                'type' => Controls_Manager::SLIDER,
                'render_type' => 'ui',
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'condition' => [
                    'ekit_we_css_transform_fx_translate_toggle' => 'yes',
                    'ekit_we_effect_on' => 'css',
                    'ekit_we_css_transform_fx' => 'yes',
                ],
            ]
        );

        $control->add_responsive_control(
            'ekit_we_css_transform_fx_translate_y',
            [
                'label' => esc_html__('Top Right', 'elementskit'),
                'render_type' => 'ui',
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'condition' => [
                    'ekit_we_effect_on' => 'css',
                    'ekit_we_css_transform_fx_translate_toggle' => 'yes',
                    'ekit_we_css_transform_fx' => 'yes',
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}} .elementor-widget-container' =>
                    'transform:'
                    . 'translate({{ekit_we_css_transform_fx_translate_x.SIZE || 0}}px, {{ekit_we_css_transform_fx_translate_y.SIZE || 0}}px);',
                    '(tablet){{WRAPPER}} .elementor-widget-container' =>
                    'transform:'
                    . 'translate({{ekit_we_css_transform_fx_translate_x_tablet.SIZE || 0}}px, {{ekit_we_css_transform_fx_translate_y_tablet.SIZE || 0}}px);',
                    '(mobile){{WRAPPER}} .elementor-widget-container' =>
                    'transform:'
                    . 'translate({{ekit_we_css_transform_fx_translate_x_mobile.SIZE || 0}}px, {{ekit_we_css_transform_fx_translate_y_mobile.SIZE || 0}}px);',
                ],
            ]
        );

        $control->end_popover();

        $control->add_control(
            'ekit_we_css_transform_fx_rotate_toggle',
            [
                'label' => esc_html__('Rotate', 'elementskit'),
                'render_type' => 'ui',
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'condition' => [
                    'ekit_we_effect_on' => 'css',
                    'ekit_we_css_transform_fx' => 'yes',
                ],
            ]
        );

        $control->start_popover();

        $control->add_responsive_control(
            'ekit_we_css_transform_fx_rotate_z',
            [
                'label' => esc_html__('Rotate Round (Z)', 'elementskit'),
                'render_type' => 'ui',
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -180,
                        'max' => 180,
                    ],
                ],
                'condition' => [
                    'ekit_we_css_transform_fx_rotate_toggle' => 'yes',
                    'ekit_we_effect_on' => 'css',
                    'ekit_we_css_transform_fx' => 'yes',
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}} .elementor-widget-container' =>
                    'transform:'
                    . 'translate({{ekit_we_css_transform_fx_translate_x.SIZE || 0}}px, {{ekit_we_css_transform_fx_translate_y.SIZE || 0}}px) '
                    . 'rotateX({{ekit_we_css_transform_fx_rotate_x.SIZE || 0}}deg) rotateY({{ekit_we_css_transform_fx_rotate_y.SIZE || 0}}deg) rotateZ({{ekit_we_css_transform_fx_rotate_z.SIZE || 0}}deg);',
                    '(tablet){{WRAPPER}} .elementor-widget-container' =>
                    'transform:'
                    . 'translate({{ekit_we_css_transform_fx_translate_x_tablet.SIZE || 0}}px, {{ekit_we_css_transform_fx_translate_y_tablet.SIZE || 0}}px) '
                    . 'rotateX({{ekit_we_css_transform_fx_rotate_x_tablet.SIZE || 0}}deg) rotateY({{ekit_we_css_transform_fx_rotate_y_tablet.SIZE || 0}}deg) rotateZ({{ekit_we_css_transform_fx_rotate_z_tablet.SIZE || 0}}deg);',
                    '(mobile){{WRAPPER}} .elementor-widget-container' =>
                    'transform:'
                    . 'translate({{ekit_we_css_transform_fx_translate_x_mobile.SIZE || 0}}px, {{ekit_we_css_transform_fx_translate_y_mobile.SIZE || 0}}px) '
                    . 'rotateX({{ekit_we_css_transform_fx_rotate_x_mobile.SIZE || 0}}deg) rotateY({{ekit_we_css_transform_fx_rotate_y_mobile.SIZE || 0}}deg) rotateZ({{ekit_we_css_transform_fx_rotate_z_mobile.SIZE || 0}}deg);',
                ],
            ]
        );

        $control->add_responsive_control(
            'ekit_we_css_transform_fx_rotate_x',
            [
                'label' => esc_html__('Rotate Top Bottom (X)', 'elementskit'),
                'render_type' => 'ui',
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -180,
                        'max' => 180,
                    ],
                ],
                'condition' => [
                    'ekit_we_effect_on' => 'css',
                    'ekit_we_css_transform_fx_rotate_toggle' => 'yes',
                    'ekit_we_css_transform_fx' => 'yes',
                ],
            ]
        );

        $control->add_responsive_control(
            'ekit_we_css_transform_fx_rotate_y',
            [
                'label' => esc_html__('Rotate Let-Right (Y)', 'elementskit'),
                'type' => Controls_Manager::SLIDER,
                'render_type' => 'ui',
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -180,
                        'max' => 180,
                    ],
                ],
                'condition' => [
                    'ekit_we_effect_on' => 'css',
                    'ekit_we_css_transform_fx_rotate_toggle' => 'yes',
                    'ekit_we_css_transform_fx' => 'yes',
                ],
            ]
        );

        $control->end_popover();

        $control->add_control(
            'ekit_we_css_transform_fx_scale_toggle',
            [
                'label' => esc_html__('Scale', 'elementskit'),
                'render_type' => 'ui',
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'condition' => [
                    'ekit_we_effect_on' => 'css',
                    'ekit_we_css_transform_fx' => 'yes',
                ],
            ]
        );

        $control->start_popover();

        $control->add_responsive_control(
            'ekit_we_css_transform_fx_scale_x',
            [
                'label' => esc_html__('Scale Left-right (X)', 'elementskit'),
                'render_type' => 'ui',
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => .1,
                    ],
                ],
                'condition' => [
                    'ekit_we_css_transform_fx_scale_toggle' => 'yes',
                    'ekit_we_effect_on' => 'css',
                    'ekit_we_css_transform_fx' => 'yes',
                ],
            ]
        );

        $control->add_responsive_control(
            'ekit_we_css_transform_fx_scale_y',
            [
                'label' => esc_html__('Scale Top Bottom (Y)', 'elementskit'),
                'type' => Controls_Manager::SLIDER,
                'render_type' => 'ui',
                'size_units' => ['px'],
                'default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => .1,
                    ],
                ],
                'condition' => [
                    'ekit_we_css_transform_fx_scale_toggle' => 'yes',
                    'ekit_we_effect_on' => 'css',
                    'ekit_we_css_transform_fx' => 'yes',
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}} .elementor-widget-container' =>
                    'transform:'
                    . 'translate({{ekit_we_css_transform_fx_translate_x.SIZE || 0}}px, {{ekit_we_css_transform_fx_translate_y.SIZE || 0}}px) '
                    . 'rotateX({{ekit_we_css_transform_fx_rotate_x.SIZE || 0}}deg) rotateY({{ekit_we_css_transform_fx_rotate_y.SIZE || 0}}deg) rotateZ({{ekit_we_css_transform_fx_rotate_z.SIZE || 0}}deg) '
                    . 'scaleX({{ekit_we_css_transform_fx_scale_x.SIZE || 1}}) scaleY({{ekit_we_css_transform_fx_scale_y.SIZE || 1}});',
                    '(tablet){{WRAPPER}} .elementor-widget-container' =>
                    'transform:'
                    . 'translate({{ekit_we_css_transform_fx_translate_x_tablet.SIZE || 0}}px, {{ekit_we_css_transform_fx_translate_y_tablet.SIZE || 0}}px) '
                    . 'rotateX({{ekit_we_css_transform_fx_rotate_x_tablet.SIZE || 0}}deg) rotateY({{ekit_we_css_transform_fx_rotate_y_tablet.SIZE || 0}}deg) rotateZ({{ekit_we_css_transform_fx_rotate_z_tablet.SIZE || 0}}deg) '
                    . 'scaleX({{ekit_we_css_transform_fx_scale_x_tablet.SIZE || 1}}) scaleY({{ekit_we_css_transform_fx_scale_y_tablet.SIZE || 1}});',
                    '(mobile){{WRAPPER}} .elementor-widget-container' =>
                    'transform:'
                    . 'translate({{ekit_we_css_transform_fx_translate_x_mobile.SIZE || 0}}px, {{ekit_we_css_transform_fx_translate_y_mobile.SIZE || 0}}px) '
                    . 'rotateX({{ekit_we_css_transform_fx_rotate_x_mobile.SIZE || 0}}deg) rotateY({{ekit_we_css_transform_fx_rotate_y_mobile.SIZE || 0}}deg) rotateZ({{ekit_we_css_transform_fx_rotate_z_mobile.SIZE || 0}}deg) '
                    . 'scaleX({{ekit_we_css_transform_fx_scale_x_mobile.SIZE || 1}}) scaleY({{ekit_we_css_transform_fx_scale_y_mobile.SIZE || 1}});',
                ],
            ]
        );

        $control->end_popover();

        $control->add_control(
            'ekit_we_css_transform_fx_skew_toggle',
            [
                'label' => esc_html__('Skew', 'elementskit'),
                'render_type' => 'ui',
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'condition' => [
                    'ekit_we_effect_on' => 'css',
                    'ekit_we_css_transform_fx' => 'yes',
                ],
            ]
        );

        $control->start_popover();

        $control->add_responsive_control(
            'ekit_we_css_transform_fx_skew_x',
            [
                'label' => esc_html__('Skew Left-right (X)', 'elementskit'),
                'render_type' => 'ui',
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'px' => [
                        'min' => -180,
                        'max' => 180,
                    ],
                ],
                'condition' => [
                    'ekit_we_css_transform_fx_skew_toggle' => 'yes',
                    'ekit_we_effect_on' => 'css',
                    'ekit_we_css_transform_fx' => 'yes',
                ],
            ]
        );

        $control->add_responsive_control(
            'ekit_we_css_transform_fx_skew_y',
            [
                'label' => esc_html__('Skew Top Bottom (Y)', 'elementskit'),
                'render_type' => 'ui',
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'px' => [
                        'min' => -180,
                        'max' => 180,
                    ],
                ],
                'condition' => [
                    'ekit_we_css_transform_fx_skew_toggle' => 'yes',
                    'ekit_we_effect_on' => 'css',
                    'ekit_we_css_transform_fx' => 'yes',
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}} .elementor-widget-container' =>
                    'transform:'
                    . 'translate({{ekit_we_css_transform_fx_translate_x.SIZE || 0}}px, {{ekit_we_css_transform_fx_translate_y.SIZE || 0}}px) '
                    . 'rotateX({{ekit_we_css_transform_fx_rotate_x.SIZE || 0}}deg) rotateY({{ekit_we_css_transform_fx_rotate_y.SIZE || 0}}deg) rotateZ({{ekit_we_css_transform_fx_rotate_z.SIZE || 0}}deg) '
                    . 'scaleX({{ekit_we_css_transform_fx_scale_x.SIZE || 1}}) scaleY({{ekit_we_css_transform_fx_scale_y.SIZE || 1}}) '
                    . 'skew({{ekit_we_css_transform_fx_skew_x.SIZE || 0}}deg, {{ekit_we_css_transform_fx_skew_y.SIZE || 0}}deg);',
                    '(tablet){{WRAPPER}} .elementor-widget-container' =>
                    'transform:'
                    . 'translate({{ekit_we_css_transform_fx_translate_x_tablet.SIZE || 0}}px, {{ekit_we_css_transform_fx_translate_y_tablet.SIZE || 0}}px) '
                    . 'rotateX({{ekit_we_css_transform_fx_rotate_x_tablet.SIZE || 0}}deg) rotateY({{ekit_we_css_transform_fx_rotate_y_tablet.SIZE || 0}}deg) rotateZ({{ekit_we_css_transform_fx_rotate_z_tablet.SIZE || 0}}deg) '
                    . 'scaleX({{ekit_we_css_transform_fx_scale_x_tablet.SIZE || 1}}) scaleY({{ekit_we_css_transform_fx_scale_y_tablet.SIZE || 1}}) '
                    . 'skew({{ekit_we_css_transform_fx_skew_x_tablet.SIZE || 0}}deg, {{ekit_we_css_transform_fx_skew_y_tablet.SIZE || 0}}deg);',
                    '(mobile){{WRAPPER}} .elementor-widget-container' =>
                    'transform:'
                    . 'translate({{ekit_we_css_transform_fx_translate_x_mobile.SIZE || 0}}px, {{ekit_we_css_transform_fx_translate_y_mobile.SIZE || 0}}px) '
                    . 'rotateX({{ekit_we_css_transform_fx_rotate_x_mobile.SIZE || 0}}deg) rotateY({{ekit_we_css_transform_fx_rotate_y_mobile.SIZE || 0}}deg) rotateZ({{ekit_we_css_transform_fx_rotate_z_mobile.SIZE || 0}}deg) '
                    . 'scaleX({{ekit_we_css_transform_fx_scale_x_mobile.SIZE || 1}}) scaleY({{ekit_we_css_transform_fx_scale_y_mobile.SIZE || 1}}) '
                    . 'skew({{ekit_we_css_transform_fx_skew_x_mobile.SIZE || 0}}deg, {{ekit_we_css_transform_fx_skew_y_mobile.SIZE || 0}}deg);',
                ],
            ]
        );

        $control->end_popover();

/*
 *-----------------------------------------------------------------------------------------------------------

 * scroll effect begin
 */

        $control->add_control(
            'ekit_we_scrolleffect_top_bottom_scroll',
            [
                'label' => esc_html__('Top-Bottom Scroll', 'elementskit'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'render_type' => 'ui',
                'frontend_available' => true,
                'return_value' => 'yes',
                'condition' => [
                    'ekit_we_effect_on' => 'scrolleffect',
                ],
            ]
        );

        $control->start_popover();

        $control->add_control(
            'ekit_we_scrolleffect_top_bottom_scroll_direction',
            [
                'label' => esc_html__('Moving to', 'elementskit'),
                'type' => Controls_Manager::SELECT,
                'default' => 'up',
                'frontend_available' => true,
                'options' => [
                    'up' => esc_html__('Top', 'elementskit'),
                    'down' => esc_html__('Bottom', 'elementskit'),
                ],
            ]
        );

        $control->add_control(
            'ekit_we_scrolleffect_top_bottom_scroll_speed',
            [
                'label' => __('Scrolling Speed', 'elementskit'),
                'frontend_available' => true,
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 4,
                ],
            ]
        );

        $control->add_control(
            'ekit_we_scrolleffect_top_bottom_scroll_position',
            [
                'label' => esc_html__('Scrolling Position', 'elementskit'),
                'type' => Controls_Manager::SLIDER,
                'frontend_available' => true,
                'default' => [
                    'sizes' => [
                        'start' => 0,
                        'end' => 100,
                    ],
                    'unit' => '%',
                ],
                'labels' => [
                    esc_html__('Bottom', 'elementskit'),
                    esc_html__('Top', 'elementskit'),
                ],
                'scales' => 1,
                'handles' => 'range',
            ]
        );

        $control->end_popover();

        $control->add_control(
            'ekit_we_scrolleffect_left_right_scroll',
            [
                'label' => esc_html__('Left-Right Scroll', 'elementskit'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'frontend_available' => true,
                'render_type' => 'ui',
                'return_value' => 'yes',
                'condition' => [
                    'ekit_we_effect_on' => 'scrolleffect',
                ],
            ]
        );

        $control->start_popover();

        $control->add_control(
            'ekit_we_scrolleffect_left_right_scroll_direction',
            [
                'label' => esc_html__('Moving to', 'elementskit'),
                'frontend_available' => true,
                'type' => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => esc_html__('Left', 'elementskit'),
                    'right' => esc_html__('Right', 'elementskit'),
                ],
            ]
        );

        $control->add_control(
            'ekit_we_scrolleffect_left_right_scroll_speed',
            [
                'label' => __('Scrolling Speed', 'elementskit'),
                'frontend_available' => true,
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 4,
                ],
            ]
        );

        $control->add_control(
            'ekit_we_scrolleffect_left_right_scroll_position',
            [
                'label' => esc_html__('Position', 'elementskit'),
                'type' => Controls_Manager::SLIDER,
                'frontend_available' => true,
                'default' => [
                    'sizes' => [
                        'start' => 0,
                        'end' => 100,
                    ],
                    'unit' => '%',
                ],
                'labels' => [
                    esc_html__('Bottom', 'elementskit'),
                    esc_html__('Top', 'elementskit'),
                ],
                'scales' => 1,
                'handles' => 'range',
            ]
        );

        $control->end_popover();

        $control->add_control(
            'ekit_we_scrolleffect_fade',
            [
                'label' => esc_html__('Fade', 'elementskit'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'frontend_available' => true,
                'render_type' => 'ui',
                'return_value' => 'yes',
                'condition' => [
                    'ekit_we_effect_on' => 'scrolleffect',
                ],
            ]
        );

        $control->start_popover();

        $control->add_control(
            'ekit_we_scrolleffect_fade_style',
            [
                'label' => esc_html__('Style', 'elementskit'),
                'type' => Controls_Manager::SELECT,
                'frontend_available' => true,
                'default' => 'fadein',
                'options' => [
                    'fadein' => esc_html__('Fade In', 'elementskit'),
                    'fadeout' => esc_html__('Fade Out', 'elementskit'),
                ],
            ]
        );

        $control->add_control(
            'ekit_we_scrolleffect_fade_opcity',
            [
                'label' => __('Opacity', 'elementskit'),
                'type' => Controls_Manager::SLIDER,
                'frontend_available' => true,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 4,
                ],
            ]
        );

        $control->add_control(
            'ekit_we_scrolleffect_fade_position',
            [
                'label' => esc_html__('Position', 'elementskit'),
                'type' => Controls_Manager::SLIDER,
                'frontend_available' => true,
                'default' => [
                    'sizes' => [
                        'start' => 0,
                        'end' => 100,
                    ],
                    'unit' => '%',
                ],
                'labels' => [
                    esc_html__('Bottom', 'elementskit'),
                    esc_html__('Top', 'elementskit'),
                ],
                'scales' => 1,
                'handles' => 'range',
            ]
        );

        $control->end_popover();

        $control->add_control(
            'ekit_we_scrolleffect_zoom',
            [
                'label' => esc_html__('Zoom', 'elementskit'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'frontend_available' => true,
                'render_type' => 'ui',
                'return_value' => 'yes',
                'condition' => [
                    'ekit_we_effect_on' => 'scrolleffect',
                ],
            ]
        );

        $control->start_popover();

        $control->add_control(
            'ekit_we_scrolleffect_zoom_style',
            [
                'label' => esc_html__('Style', 'elementskit'),
                'type' => Controls_Manager::SELECT,
                'frontend_available' => true,
                'default' => 'scaleup',
                'options' => [
                    'scaleup' => esc_html__('Zoom In', 'elementskit'),
                    'scaledown' => esc_html__('Zoom Out', 'elementskit'),
                    'scaledownup' => esc_html__('Zoom In Out', 'elementskit'),
                    'scaleupdown' => esc_html__('Zoom Out In', 'elementskit'),
                ],
            ]
        );

        $control->add_control(
            'ekit_we_scrolleffect_zoom_size',
            [
                'label' => __('Size', 'elementskit'),
                'type' => Controls_Manager::SLIDER,
                'frontend_available' => true,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 4,
                ],
            ]
        );

        $control->add_control(
            'ekit_we_scrolleffect_zoom_position',
            [
                'label' => esc_html__('Position', 'elementskit'),
                'type' => Controls_Manager::SLIDER,
                'frontend_available' => true,
                'default' => [
                    'sizes' => [
                        'start' => 0,
                        'end' => 100,
                    ],
                    'unit' => '%',
                ],
                'labels' => [
                    esc_html__('Bottom', 'elementskit'),
                    esc_html__('Top', 'elementskit'),
                ],
                'scales' => true,
                'handles' => 'range',
            ]
        );

        $control->end_popover();


        $control->add_control(
            'ekit_we_scrolleffect_blur',
            [
                'label' => esc_html__('Blur', 'elementskit'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'frontend_available' => true,
                'render_type' => 'ui',
                'return_value' => 'yes',
                'condition' => [
                    'ekit_we_effect_on' => 'scrolleffect',
                ],
            ]
        );

        $control->start_popover();

        $control->add_control(
            'ekit_we_scrolleffect_blur_style',
            [
                'label' => esc_html__('Style', 'elementskit'),
                'type' => Controls_Manager::SELECT,
                'frontend_available' => true,
                'default' => 'fadein',
                'options' => [
                    'fadein' => esc_html__('Fade In', 'elementskit'),
                    'fadeout' => esc_html__('Fade Out', 'elementskit')
                ],
            ]
        );

        $control->add_control(
            'ekit_we_scrolleffect_blur_opacity',
            [
                'label' => __('Opacity', 'elementskit'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'frontend_available' => true,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 4,
                ],
            ]
        );

        $control->add_control(
            'ekit_we_scrolleffect_blur_position',
            [
                'label' => esc_html__('Position', 'elementskit'),
                'type' => Controls_Manager::SLIDER,
                'frontend_available' => true,
                'default' => [
                    'sizes' => [
                        'start' => 0,
                        'end' => 100,
                    ],
                    'unit' => '%',
                ],
                'labels' => [
                    esc_html__('Bottom', 'elementskit'),
                    esc_html__('Top', 'elementskit'),
                ],
                'scales' => 1,
                'handles' => 'range',
            ]
        );

        $control->end_popover();

        $control->add_control(
            'ekit_we_scrolleffect_rotate',
            [
                'label' => esc_html__('Rotate', 'elementskit'),
                'frontend_available' => true,
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'render_type' => 'ui',
                'return_value' => 'yes',
                'condition' => [
                    'ekit_we_effect_on' => 'scrolleffect',
                ],
            ]
        );

        $control->start_popover();

        $control->add_control(
            'ekit_we_scrolleffect_rotate_direction',
            [
                'label' => esc_html__('Moving to', 'elementskit'),
                'type' => Controls_Manager::SELECT,
                'frontend_available' => true,
                'default' => 'left',
                'options' => [
                    'left' => esc_html__('Left', 'elementskit'),
                    'right' => esc_html__('Right', 'elementskit'),
                ],
            ]
        );

        $control->add_control(
            'ekit_we_scrolleffect_rotate_speed',
            [
                'label' => __('Speed', 'elementskit'),
                'type' => Controls_Manager::SLIDER, // 'frontend_available' => true,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 4,
                ],
            ]
        );

        $control->add_control(
            'ekit_we_scrolleffect_rotate_position',
            [
                'label' => esc_html__('Position', 'elementskit'),
                'type' => Controls_Manager::SLIDER,
                'frontend_available' => true,
                'default' => [
                    'sizes' => [
                        'start' => 0,
                        'end' => 100,
                    ],
                    'unit' => '%',
                ],
                'labels' => [
                    esc_html__('Bottom', 'elementskit'),
                    esc_html__('Top', 'elementskit'),
                ],
                'scales' => 1,
                'handles' => 'range',
            ]
        );

        $control->end_popover();


/*
 *-----------------------------------------------------------------------------------------------------------
 * mouse effect begin
 */

        $control->add_control(
            'ekit_we_mouseeffect_mouse_move',
            [
                'label' => esc_html__('Mouse Move', 'elementskit'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'frontend_available' => true,
                'render_type' => 'ui',
                'return_value' => 'yes',
                'condition' => [
                    'ekit_we_effect_on' => 'mouseeffect',
                ],
            ]
        );

        $control->start_popover();

        $control->add_control(
            'ekit_we_mouseeffect_mouse_move_direction',
            [
                'label' => esc_html__('Moving to', 'elementskit'),
                'type' => Controls_Manager::SELECT,
                'frontend_available' => true,
                'default' => 'direct',
                'options' => [
                    'same' => esc_html__('Same direction', 'elementskit'),
                    'reverse' => esc_html__('Reverse direction', 'elementskit'),
                ],
            ]
        );

        $control->add_control(
            'ekit_we_mouseeffect_mouse_move_speed',
            [
                'label' => __('Speed', 'elementskit'),
                'frontend_available' => true,
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 4,
                ],
            ]
        );

        $control->end_popover();

        $control->add_control(
            'ekit_we_mouseeffect_tilt',
            [
                'label' => esc_html__('Tilt', 'elementskit'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'frontend_available' => true,
                'render_type' => 'ui',
                'return_value' => 'yes',
                'condition' => [
                    'ekit_we_effect_on' => 'mouseeffect',
                ],
            ]
        );

        $control->start_popover();

        $control->add_control(
            'ekit_we_mouseeffect_tilt_direction',
            [
                'label' => esc_html__('Direction', 'elementskit'),
                'type' => Controls_Manager::SELECT,
                'frontend_available' => true,
                'default' => 'direct',
                'options' => [
                    'direct' => esc_html__('Direct', 'elementskit'),
                    'opposite' => esc_html__('Opposite', 'elementskit'),
                ],
            ]
        );

        $control->add_control(
            'ekit_we_mouseeffect_tilt_speed',
            [
                'label' => __('Speed', 'elementskit'),
                'type' => Controls_Manager::SLIDER,
                'frontend_available' => true,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 4,
                ],
            ]
        );

        $control->end_popover();

        $control->add_control(
            'ekit_we_effect_devices',
            [
                'label' => esc_html__('Display On', 'elementskit'),
                'type' => Controls_Manager::SELECT,
                'frontend_available' => true,
                'multiple' => false,
                'label_block' => false,
                'options' => [
                    'all' => esc_html__('All Devices', 'elementskit'),
                    'desktop' => esc_html__('Desktop', 'elementskit'),
                    'desktop_tablet' => esc_html__('Desktop & Tablet', 'elementskit'),
                ],
                'default' => ['all'],
                'condition' => [
                    'ekit_we_effect_on!' => ['css', 'none'],
                ],
            ]
        );

        $control->end_controls_section();
    }
}
