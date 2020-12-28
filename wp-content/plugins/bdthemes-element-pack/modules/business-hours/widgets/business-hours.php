<?php
namespace ElementPack\Modules\BusinessHours\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Schemes;
use Elementor\Repeater;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Business_Hours extends Widget_Base {

    //protected $_has_template_content = false;

    public function get_name() {
        return 'bdt-business-hours';
    }

    public function get_title() {
        return BDTEP . esc_html__( 'Business Hours', 'bdthemes-element-pack' );
    }

    public function get_icon() {
        return 'bdt-wi-business-hours';
    }

    public function get_categories() {
        return [ 'element-pack' ];
    }

    public function get_keywords() {
        return [ 'business', 'hours', 'time', 'duty', 'schedule' ];
    }

    public function get_style_depends() {
        return [ 'ep-business-hours' ];
    }

    public function get_script_depends() {
        return [ 'jclock', 'ep-business-hours' ];
    }

    public function get_custom_help_url() {
        return 'https://youtu.be/1QfZ-os75rQ';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_business_houes_layout',
            [
                'label' => esc_html__( 'Layout', 'bdthemes-element-pack' ),
            ]
        );

        $this->add_control(
            'business_hour_style',
            [
                'label'     => esc_html__( 'Style', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'default'  => esc_html__( 'Static', 'bdthemes-element-pack' ),
                    'dynamic' => esc_html__( 'Dynamic', 'bdthemes-element-pack' ),
                ],
                'default'   => 'default',
            ]
        );

        $this->add_control(
            'dynamic_timezone',
            [
                'label'   => esc_html__( 'Timezone', 'bdthemes-element-pack' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default'    => 'Website Time',
                    '-0'     => __('UT or UTC - GMT -0', 'bdthemes-element-pack'),
                    '+1'     => __('CET - GMT+1', 'bdthemes-element-pack'),
                    '+2'     => __('EET - GMT+2', 'bdthemes-element-pack'),
                    '+3'     => __('MSK - GMT+3', 'bdthemes-element-pack'),
                    '+4'     => __('SMT - GMT+4', 'bdthemes-element-pack'),
                    '+5'     => __('PKT - GMT+5', 'bdthemes-element-pack'),
                    '+5.5'   => __('IND - GMT+5.5', 'bdthemes-element-pack'),
                    '+6'     => __('OMSK / BD - GMT+6', 'bdthemes-element-pack'),
                    '+7'     => __('CXT - GMT+7', 'bdthemes-element-pack'),
                    '+8'     => __('CST / AWST / WST - GMT+8', 'bdthemes-element-pack'),
                    '+9'     => __('JST - GMT+9', 'bdthemes-element-pack'),
                    '+10'    => __('EAST - GMT+10', 'bdthemes-element-pack'),
                    '+11'    => __('SAKT - GMT+11', 'bdthemes-element-pack'),
                    '+12'    => __('IDLE  - GMT+12', 'bdthemes-element-pack'),
                    '+13'    => __('NZDT  - GMT+13', 'bdthemes-element-pack'),
                    '-1'     => __('WAT  - GMT-1', 'bdthemes-element-pack'),
                    '-2'     => __('AT  - GMT-2', 'bdthemes-element-pack'),
                    '-3'     => __('ART  - GMT-3', 'bdthemes-element-pack'),
                    '-4'     => __('AST  - GMT-4', 'bdthemes-element-pack'),
                    '-5'     => __('EST  - GMT-5', 'bdthemes-element-pack'),
                    '-6'     => __('CST  - GMT-6', 'bdthemes-element-pack'),
                    '-7'     => __('MST  - GMT-7', 'bdthemes-element-pack'),
                    '-8'     => __('PST  - GMT-8', 'bdthemes-element-pack'),
                    '-9'     => __('AKST  - GMT-9', 'bdthemes-element-pack'),
                    '-10'    => __('HST  - GMT-10', 'bdthemes-element-pack'),
                    '-11'    => __('NT  - GMT-11', 'bdthemes-element-pack'),
                    '-12'    => __('IDLW  - GMT-12', 'bdthemes-element-pack'),
                    'custom'       => "Custom",
                ],
                'condition'		=> [
                    'business_hour_style' => 'dynamic',
                ],
            ]
        );

        $this->add_control(
            'custom_timezone_input',
            [
                'label'  => esc_html__( 'Custom Timezone', 'bdthemes-element-pack' ),
                'type'   => Controls_Manager::TEXT,
                'defaut' => '+6',
                'placeholder' => '+6',
                'condition' => [
                    'dynamic_timezone' => 'custom',
                    'business_hour_style' => 'dynamic',
                ]
            ]
        );

        $this->add_control(
            'show_header',
            [
                'label' => esc_html__( 'Show Header', 'bdthemes-element-pack' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_business_days_layout',
            [
                'label' => esc_html__( 'Business Days & Times', 'bdthemes-element-pack' ),
                'condition' =>[
                    'business_hour_style' => 'default',
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'enter_day',
            [
                'label'       => esc_html__( 'Enter Day', 'bdthemes-element-pack' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => 'Monday',
            ]
        );

        $repeater->add_control(
            'enter_time',
            [
                'label'       => esc_html__( 'Enter Time', 'bdthemes-element-pack' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => '10:00 AM - 6:00 PM',
            ]
        );

        $repeater->add_control(
            'current_styling_heading',
            [
                'label'     => esc_html__( 'Styling', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'highlight_this',
            [
                'label'        => esc_html__( 'Style This Day', 'bdthemes-element-pack' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'no',
                'separator'    => 'before',
            ]
        );

        $repeater->add_control(
            'single_business_day_color',
            [
                'label'     => esc_html__( 'Day Color', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::COLOR,
                //'scheme'    => [
                    //'type'  => Schemes\Color::get_type(),
                    //'value' => Schemes\Color::COLOR_2,
                //],
                'default'   => '#db6159',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .bdt-business-day-off' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'highlight_this' => 'yes',
                ],
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'single_business_timing_color',
            [
                'label'     => esc_html__( 'Time Color', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::COLOR,
                //'scheme'    => [
                    //'type'  => Schemes\Color::get_type(),
                    //'value' => Schemes\Color::COLOR_4,
                //],
                'default'   => '#db6159',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .bdt-business-time-off' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'highlight_this' => 'yes',
                ],
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'single_business_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-business-hours-inner {{CURRENT_ITEM}}.border-divider' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'highlight_this' => 'yes',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'business_days_times',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'enter_day'  => esc_html__( 'Monday', 'bdthemes-element-pack' ),
                        'enter_time' => esc_html__( '10:00 AM - 6:00 PM', 'bdthemes-element-pack' ),
                    ],
                    [
                        'enter_day'  => esc_html__( 'Tuesday', 'bdthemes-element-pack' ),
                        'enter_time' => esc_html__( '10:00 AM - 6:00 PM', 'bdthemes-element-pack' ),
                    ],
                    [
                        'enter_day'  => esc_html__( 'Wednesday', 'bdthemes-element-pack' ),
                        'enter_time' => esc_html__( '10:00 AM - 6:00 PM', 'bdthemes-element-pack' ),
                    ],
                    [
                        'enter_day'  => esc_html__( 'Thursday', 'bdthemes-element-pack' ),
                        'enter_time' => esc_html__( '10:00 AM - 6:00 PM', 'bdthemes-element-pack' ),
                    ],
                    [
                        'enter_day'  => esc_html__( 'Friday', 'bdthemes-element-pack' ),
                        'enter_time' => esc_html__( '10:00 AM - 6:00 PM', 'bdthemes-element-pack' ),
                    ],
                    [
                        'enter_day'      => esc_html__( 'Saturday', 'bdthemes-element-pack' ),
                        'enter_time'     => esc_html__( '10:00 AM - 6:00 PM', 'bdthemes-element-pack' ),
                    ],
                    [
                        'enter_day'      => esc_html__( 'Sunday', 'bdthemes-element-pack' ),
                        'enter_time'     => esc_html__( 'Closed', 'bdthemes-element-pack' ),
                        'highlight_this' => esc_html__( 'yes', 'bdthemes-element-pack' ),
                    ],
                ],
                'title_field' => '{{{ enter_day }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_header',
            [
                'label'     => esc_html__( 'Header', 'bdthemes-element-pack' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'show_header' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'show_current_time',
            [
                'label'   => esc_html__( 'Show Current Time', 'bdthemes-element-pack' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'show_current_date',
            [
                'label'   => esc_html__( 'Show Current Date', 'bdthemes-element-pack' ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_responsive_control(
            'bs_header_text_align',
            [
                'label'   => __( 'Alignment', 'bdthemes-element-pack' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'bdthemes-element-pack' ),
                        'icon'  => 'fas fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'bdthemes-element-pack' ),
                        'icon'  => 'fas fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'bdthemes-element-pack' ),
                        'icon'  => 'fas fa-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justified', 'bdthemes-element-pack' ),
                        'icon'  => 'fas fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-business-hours .bdt-business-hours-header' => 'text-align: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();

        // start for second repetaer

        $this->start_controls_section(
            'section_dynamic_repeater',
            [
                'label' => __( 'Dynamic Days & Times', 'bdthemes-element-pack' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' =>[
                    'business_hour_style' => 'dynamic',
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'dynamic_enter_day',
            [
                'label'   => esc_html__( 'Select Day', 'bdthemes-element-pack' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'Monday',
                'options' => [
                    'Sunday'    => 'Sunday',
                    'Monday'    => 'Monday',
                    'Tuesday'   => 'Tuesday',
                    'Wednesday' => 'Wednesday',
                    'Thursday'  => 'Thursday',
                    'Friday'    => 'Friday',
                    'Saturday'  => 'Saturday',
                ],
            ]
        );

        $repeater->add_control(
            'dynamic_enter_day_level',
            [
                'label'       => esc_html__( 'Day Level', 'bdthemes-element-pack' ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [ 'active' => true, ],
            ]
        );

        $repeater->add_control(
            'dynamic_start_time',
            [
                'label'       => esc_html__( 'Start Time', 'bdthemes-element-pack' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '09:00 AM',
                'placeholder' => '09:00 AM',
                'dynamic'     => [ 'active' => true, ],
                'condition'	  => [
                    'dynamic_close_this!' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'dynamic_end_time',
            [
                'label'       => esc_html__( 'End Time', 'bdthemes-element-pack' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '05:00 PM',
                'placeholder' => '05:00 PM',
                'dynamic'     => [ 'active' => true, ],
                'condition'	  => [
                    'dynamic_close_this!' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'dynamic_close_this',
            [
                'label'        => esc_html__( 'Close This Day', 'bdthemes-element-pack' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'no',
                'separator'    => 'before',
            ]
        );

        $repeater->add_control(
            'dynamic_close_text',
            [
                'label'       => esc_html__( 'Close Level', 'bdthemes-element-pack' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'Closed',
                'dynamic'     => [ 'active' => true, ],
                'condition'	  => [
                    'dynamic_close_this' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'dynamic_current_styling_heading',
            [
                'label'     => esc_html__( 'Styling', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'dynamic_highlight_this',
            [
                'label'        => esc_html__( 'Style This Day', 'bdthemes-element-pack' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'no',
                'separator'    => 'before',
            ]
        );

        $repeater->add_control(
            'dynamic_single_business_day_color',
            [
                'label'     => esc_html__( 'Day Color', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::COLOR,
                //'scheme'    => [
                    //'type'  => Schemes\Color::get_type(),
                    //'value' => Schemes\Color::COLOR_2,
                //],
                'default'   => '#db6159',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .bdt-business-day-off' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'dynamic_highlight_this' => 'yes',
                ],
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'dynamic_single_business_timing_color',
            [
                'label'     => esc_html__( 'Time Color', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::COLOR,
                //'scheme'    => [
                    //'type'  => Schemes\Color::get_type(),
                    //'value' => Schemes\Color::COLOR_4,
                //],
                'default'   => '#db6159',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .bdt-business-time-off' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'dynamic_highlight_this' => 'yes',
                ],
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'dynamic_single_business_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-business-hours-inner {{CURRENT_ITEM}}.border-divider' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'dynamic_highlight_this' => 'yes',
                ],
                'separator' => 'before',
            ]
        );


        $this->add_control( 
            'dynamic_days_times',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [

                    [
                        'dynamic_enter_day'  => esc_html__( 'Monday', 'bdthemes-element-pack' ),
                        'dynamic_start_time' => esc_html__( '09:00 AM', 'bdthemes-element-pack' ),
                        'dynamic_end_time'   => esc_html__( '05:00 PM', 'bdthemes-element-pack' ),
                    ],

                    [
                        'dynamic_enter_day'  => esc_html__( 'Tuesday', 'bdthemes-element-pack' ),
                        'dynamic_start_time' => esc_html__( '09:00 AM', 'bdthemes-element-pack' ),
                        'dynamic_end_time'   => esc_html__( '05:00 PM', 'bdthemes-element-pack' ),
                    ],

                    [
                        'dynamic_enter_day'  => esc_html__( 'Wednesday', 'bdthemes-element-pack' ),
                        'dynamic_start_time' => esc_html__( '09:00 AM', 'bdthemes-element-pack' ),
                        'dynamic_end_time'   => esc_html__( '05:00 PM', 'bdthemes-element-pack' ),
                    ],

                    [
                        'dynamic_enter_day'  => esc_html__( 'Thursday', 'bdthemes-element-pack' ),
                        'dynamic_start_time' => esc_html__( '09:00 AM', 'bdthemes-element-pack' ),
                        'dynamic_end_time'   => esc_html__( '05:00 PM', 'bdthemes-element-pack' ),
                    ],

                    [
                        'dynamic_enter_day'  => esc_html__( 'Friday', 'bdthemes-element-pack' ),
                        'dynamic_start_time' => esc_html__( '09:00 AM', 'bdthemes-element-pack' ),
                        'dynamic_end_time'   => esc_html__( '05:00 PM', 'bdthemes-element-pack' ),
                    ],

                    [
                        'dynamic_enter_day'  => esc_html__( 'Saturday', 'bdthemes-element-pack' ),
                        'dynamic_start_time' => esc_html__( '09:00 AM', 'bdthemes-element-pack' ),
                        'dynamic_end_time'   => esc_html__( '05:00 PM', 'bdthemes-element-pack' ),
                    ],

                    [
                        'dynamic_enter_day'      => esc_html__( 'Sunday', 'bdthemes-element-pack' ),
                        'dynamic_start_time'     => esc_html__( '09:00 AM', 'bdthemes-element-pack' ),
                        'dynamic_end_time'   => esc_html__( '05:00 PM', 'bdthemes-element-pack' ),
                        'dynamic_close_this'   => 'yes',
                        'dynamic_close_text'   => 'Closed',
                        'dynamic_highlight_this' => esc_html__( 'yes', 'bdthemes-element-pack' ),
                    ],
                ],
                'title_field' => '{{{ dynamic_enter_day }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_dynamic_additional',
            [
                'label' => __( 'Additional', 'bdthemes-element-pack' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' =>[
                    'business_hour_style' => 'dynamic',
                ]
            ]
        );


        $this->add_control(
            'dynamic_open_day',
            [
                'label'       => esc_html__( 'Open Status', 'bdthemes-element-pack' ),
                'type'        => Controls_Manager::WYSIWYG,
                'default'     => 'Office Open. Right now we are available for service.',
                'dynamic'     => [ 'active' => true, ],
                'condition'	  => [
                    'business_hour_style' => 'dynamic',
                ],
            ]
        );

        $this->add_control(
            'dynamic_close_day',
            [
                'label'       => esc_html__( 'Close Status', 'bdthemes-element-pack' ),
                'type'        => Controls_Manager::WYSIWYG,
                'default'     => 'Office Closed. Right now we are not available.',
                'dynamic'     => [ 'active' => true, ],
                'condition'	  => [
                    'business_hour_style' => 'dynamic',
                ],
            ]
        );

        $this->add_control(
            'dynamic_time_separator',
            [
                'label'       => esc_html__( 'Separator', 'bdthemes-element-pack' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '-',
                'dynamic'     => [ 'active' => true, ],
                'condition'	  => [
                    'business_hour_style' => 'dynamic',
                ],
                'separator'	  => 'before',
            ]
        );



        $this->end_controls_section();

        // end for second repetaer

        $this->start_controls_section(
            'style_bs_header',
            [
                'label' => esc_html__( 'Header', 'bdthemes-element-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_header' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .bdt-business-hours .bdt-business-hours-header',
            ]
        );

        $this->add_responsive_control(
            'bs_header_padding',
            [
                'label'      => esc_html__( 'Padding', 'bdthemes-element-pack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-business-hours .bdt-business-hours-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'bs_header_current_time_heading',
            [
                'label'      => esc_html__( 'Current Time', 'bdthemes-element-pack' ),
                'type'       => Controls_Manager::HEADING,
                'separator'  => 'before',
                'condition' => [
                    'show_current_time' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'current_time_color',
            [
                'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-business-hours .bdt-business-hours-header .bdt-business-hours-current-time' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_current_time' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'current_time_text_shadow',
                'label' => __( 'Text Shadow', 'bdthemes-element-pack' ),
                'selector' => '{{WRAPPER}} .bdt-business-hours .bdt-business-hours-header .bdt-business-hours-current-time',
                'condition' => [
                    'show_current_time' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'current_time_typography',
                'selector'  => '{{WRAPPER}} .bdt-business-hours .bdt-business-hours-header .bdt-business-hours-current-time',
                'condition' => [
                    'show_current_time' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'bs_current_time_sapcing',
            [
                'label' => esc_html__( 'Spacing', 'bdthemes-element-pack' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-business-hours .bdt-business-hours-header .bdt-business-hours-current-time' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_current_time' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'bs_header_current_date_heading',
            [
                'label'      => esc_html__( 'Current Date', 'bdthemes-element-pack' ),
                'type'       => Controls_Manager::HEADING,
                'separator'  => 'before',
                'condition' => [
                    'show_current_date' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'current_date_color',
            [
                'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-business-hours .bdt-business-hours-header .bdt-business-hours-current-date' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_current_date' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'current_date_text_shadow',
                'label' => __( 'Text Shadow', 'bdthemes-element-pack' ),
                'selector' => '{{WRAPPER}} .bdt-business-hours .bdt-business-hours-header .bdt-business-hours-current-date',
                'condition' => [
                    'show_current_date' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'current_date_typography',
                'selector'  => '{{WRAPPER}} .bdt-business-hours .bdt-business-hours-header .bdt-business-hours-current-date',
                'condition' => [
                    'show_current_date' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'bs_current_date_sapcing',
            [
                'label' => esc_html__( 'Spacing', 'bdthemes-element-pack' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-business-hours .bdt-business-hours-header .bdt-business-hours-current-date' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_current_date' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_bs_general',
            [
                'label' => esc_html__( 'General', 'bdthemes-element-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'section_bs_list_padding',
            [
                'label'      => esc_html__( 'Row Spacing', 'bdthemes-element-pack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default' => ['top' => 5, 'right' => 5, 'bottom' => 5, 'left' => 5],
                'selectors'  => [
                    '{{WRAPPER}} div.bdt-business-hours-inner div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'bs_genarel_padding',
            [
                'label'      => esc_html__( 'Padding', 'bdthemes-element-pack' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-business-hours .bdt-business-hours-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_bs_divider',
            [
                'label' => esc_html__( 'Divider', 'bdthemes-element-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'day_divider',
            [
                'label'        => esc_html__( 'Divider', 'bdthemes-element-pack' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'day_divider_style',
            [
                'label'     => esc_html__( 'Style', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'solid'  => esc_html__( 'Solid', 'bdthemes-element-pack' ),
                    'dotted' => esc_html__( 'Dotted', 'bdthemes-element-pack' ),
                    'dashed' => esc_html__( 'Dashed', 'bdthemes-element-pack' ),
                ],
                'default'   => 'solid',
                'selectors' => [
                    '{{WRAPPER}} .bdt-business-hours div.bdt-business-hours-inner div.border-divider:not(:first-child)' => 'border-top-style: {{VALUE}};',
                ],
                'condition' => [
                    'day_divider' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'day_divider_color',
            [
                'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#e8e8e8',
                'selectors' => [
                    '{{WRAPPER}} .bdt-business-hours div.bdt-business-hours-inner div.border-divider:not(:first-child)' => 'border-top-color: {{VALUE}};',
                ],
                'condition' => [
                    'day_divider' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'day_divider_weight',
            [
                'label'     => esc_html__( 'Weight', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 1,
                    'unit' => 'px',
                ],
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-business-hours div.bdt-business-hours-inner div.border-divider:not(:first-child)' => 'border-top-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'day_divider' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_business_day_style',
            [
                'label' => esc_html__( 'Day and Time', 'bdthemes-element-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bs_note_heading',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw'  => sprintf( '<p style="font-size: 12px;font-style: italic;line-height: 1.4;color: #a4afb7;">%s</p>', esc_html__( 'Note: By default, the color & typography options will inherit from parent styling. If you wish you can override that styling from here.', 'bdthemes-element-pack' ) ),
            ]
        );

        $this->add_responsive_control(
            'business_hours_day_align',
            [
                'label'     => esc_html__( 'Day Alignment', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'bdthemes-element-pack' ),
                        'icon'  => 'fas fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'bdthemes-element-pack' ),
                        'icon'  => 'fas fa-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'bdthemes-element-pack' ),
                        'icon'  => 'fas fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} div.bdt-business-hours-inner .heading-date' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'business_hours_time_align',
            [
                'label'     => esc_html__( 'Time Alignment', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'bdthemes-element-pack' ),
                        'icon'  => 'fas fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'bdthemes-element-pack' ),
                        'icon'  => 'fas fa-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'bdthemes-element-pack' ),
                        'icon'  => 'fas fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} div.bdt-business-hours-inner .heading-time' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'business_day_color',
            [
                'label'     => esc_html__( 'Day Color', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::COLOR,
                // 'scheme'    => [
                //     'type'  => Schemes\Color::get_type(),
                //     'value' => Schemes\Color::COLOR_3,
                // ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-business-day' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-widget-container' => 'overflow: hidden;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__( 'Day Typography', 'bdthemes-element-pack' ),
                'name'     => 'business_day_typography',
                //'scheme'   => Schemes\Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .heading-date',
            ]
        );

        $this->add_control(
            'business_timing_color',
            [
                'label'     => esc_html__( 'Time Color', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::COLOR,
                // 'scheme'    => [
                //     'type'  => Schemes\Color::get_type(),
                //     'value' => Schemes\Color::COLOR_3,
                // ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-business-time' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__( 'Time Typography', 'bdthemes-element-pack' ),
                'name'     => 'business_timings_typography',
                //'scheme'   => Schemes\Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .heading-time',
            ]
        );

        $this->add_control(
            'business_hours_striped',
            [
                'label'        => esc_html__( 'Striped Effect', 'bdthemes-element-pack' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'business_hours_striped_odd_color',
            [
                'label'     => esc_html__( 'Striped Odd Rows Color', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#eaeaea',
                'selectors' => [
                    '{{WRAPPER}} .border-divider:nth-child(odd)' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'business_hours_striped' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'striped_effect_even',
            [
                'label'     => esc_html__( 'Striped Even Rows Color', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .border-divider:nth-child(even)' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'business_hours_striped' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'dynamic_business_day_separator',
            [
                'label' => esc_html__( 'Separator', 'bdthemes-element-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'dynamic_time_separator!' => '',
                ],
            ]
        );

        $this->add_control(
            'dynamic_separator_color',
            [
                'label'     => esc_html__( 'Separator Color', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dynamic-separator' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'dynamic_business_msg',
            [
                'label' => esc_html__( 'Message', 'bdthemes-element-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'business_hour_style' => 'dynamic',
                ], 
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__( 'Typography', 'bdthemes-element-pack' ),
                'name'     => 'business_dynamic_msg_typography',
                //'scheme'   => Schemes\Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .bdt-business-hours .bdt-live-status',
            ]
        );

        $this->add_control(
            'dynamic_business_msg_sapcing',
            [
                'label' => esc_html__( 'Top Spacing', 'bdthemes-element-pack' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-business-hours  .bdt-live-status' => 'padding-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();




    }

    public function set_time_zone(){
        $settingsTimeZone = $this->get_settings_for_display();
        if($settingsTimeZone['business_hour_style'] != 'default'){ //static & dynamic checking
            if($settingsTimeZone['dynamic_timezone'] != 'default'){ // timezone default checking
                // $ct_input = $settingsTimeZone['custom_timezone_input']; // ct = custom timezone
                // dynamic_timezone
                if($settingsTimeZone['dynamic_timezone'] == 'custom'){ // timezone custom checking
                    $ct_input = (isset($settingsTimeZone['custom_timezone_input']) && !empty($settingsTimeZone['custom_timezone_input'])) ? $settingsTimeZone['custom_timezone_input'] : '+6';
                }else{
                    $ct_input = $settingsTimeZone['dynamic_timezone'];
                }
                
                return $this->set_gmt_zone($ct_input);
            }else{
                return $this->set_gmt_zone(get_option('gmt_offset'));
            }
        }
    }

    public function set_gmt_zone($reseive){
        // $min    = 60 * get_option('gmt_offset');
        $min    = 60 * $reseive;
        $sign   = $min < 0 ? "-" : "+";
        $absmin = abs($min);
// $tz     = sprintf("UTC%s%02d:%02d", $sign, $absmin/60, $absmin%60);
        $tz     = sprintf("%s%02d", $sign, $absmin/60, $absmin%60);
        $data = gmdate("g:i:s A", time() + 3600*($tz+date("I")));
        return $data;
    }


    public function render() {
        $settings = $this->get_settings_for_display();
        $timeNotation	= (get_option('time_format') == 'H:i') ? '24h' : '12h';
        $ct_input = get_option('gmt_offset');

        // echo $ct_input;

        if($settings['dynamic_timezone'] == 'custom'){
           $ct_input = (isset($settings['custom_timezone_input']) && !empty($settings['custom_timezone_input'])) ? $settings['custom_timezone_input'] : '+6';
       }else{
        $ct_input = $settings['dynamic_timezone'];
    }

    
    $this->add_render_attribute(
        [
            'bdt-business-hours-data' => [ 
                'data-settings' => [
                    wp_json_encode(array_filter([
                        "id"         => 'business-hours-' . $this->get_id(),
                        'business_hour_style' => $settings['business_hour_style'] == 'default'? 'static' : 'dynamic',
                        "dynamic_timezone_default"   =>  get_option('gmt_offset'),
                        "dynamic_timezone"   => ($settings['dynamic_timezone'] == 'default') ?  get_option('gmt_offset') : $ct_input,
                        "timeNotation" => $timeNotation,
                    ])
                ),
                ],
            ],
        ]
    );


    ?>

    <div class="bdt-business-hours" <?php echo $this->get_render_attribute_string('bdt-business-hours-data'); ?>>

        <?php if ('yes' == $settings['show_header']) : ?>
            <div class="bdt-business-hours-header">

                <?php if ('yes' == $settings['show_current_time']) : ?>
                    <div class="bdt-business-hours-current-time">
                        <?php
                        if($settings['business_hour_style'] == 'default'){
                            echo date( get_option('time_format'), current_time( 'timestamp' ) );
                        }else{
                            $cur_time   =   strtotime($this->set_time_zone());
                            echo date( 'h:i a', $cur_time);
                        }
                        ?>

                    </div>
                <?php endif; ?>

                <?php if ('yes' == $settings['show_current_date']) : ?>
                    <div class="bdt-business-hours-current-date">
                        <?php
                        if($settings['business_hour_style'] == 'default'){
                            echo date( get_option( 'date_format' ), current_time( 'timestamp' ) );
                        }else{
                            $cur_time   =   strtotime(  $this->set_time_zone()  );
                            echo date( get_option( 'date_format' ), $cur_time);
                        }

                            // echo date( 'F d, Y', current_time( 'timestamp' ) );

                        ?>

                    </div>
                <?php endif; ?>

            </div>
        <?php endif; ?>


        <?php
        if($settings['business_hour_style'] == 'default'){
            if ( count( $settings['business_days_times'] ) ) {
                $count = 0;
                ?>
                <div class="bdt-business-hours-inner">
                    <?php
                    foreach ( $settings['business_days_times'] as $item ) {
                        $day_settings = $this->get_repeater_setting_key( 'enter_day', 'business_days_times', $count );
                        $this->add_inline_editing_attributes( $day_settings );

                        $time_settings = $this->get_repeater_setting_key( 'enter_time', 'business_days_times', $count );
                        $this->add_inline_editing_attributes( $time_settings );

                        $this->add_render_attribute( 'bdt-inner-element', 'class', 'bdt-inner bdt-grid bdt-grid-small', true );
                        $this->add_render_attribute( 'bdt-inner-heading-time', 'class', 'inner-heading-time' );
                        $this->add_render_attribute( 'bdt-bs-background' . $item['_id'], 'class', 'elementor-repeater-item-' . $item['_id'] );
                        $this->add_render_attribute( 'bdt-bs-background' . $item['_id'], 'class', 'border-divider' );

                        if ( 'yes' === $item['highlight_this'] ) {
                            $this->add_render_attribute( 'bdt-bs-background' . $item['_id'], 'class', 'bdt-highlight-bg' );
                        } elseif ( 'yes' === $settings['business_hours_striped'] ) {
                            $this->add_render_attribute( 'bdt-bs-background' . $item['_id'], 'class', 'stripes' );
                        }

                        $this->add_render_attribute( 'bdt-highlight-day' . $item['_id'], 'class', 'heading-date bdt-width-1-2' );
                        $this->add_render_attribute( 'bdt-highlight-time' . $item['_id'], 'class', 'heading-time bdt-width-1-2' );

                        if ( 'yes' === $item['highlight_this'] ) {
                            $this->add_render_attribute( 'bdt-highlight-day' . $item['_id'], 'class', 'bdt-business-day-off' );
                            $this->add_render_attribute( 'bdt-highlight-time' . $item['_id'], 'class', 'bdt-business-time-off' );
                        } else {
                            $this->add_render_attribute( 'bdt-highlight-day' . $item['_id'], 'class', 'bdt-business-day' );
                            $this->add_render_attribute( 'bdt-highlight-time' . $item['_id'], 'class', 'bdt-business-time' );
                        }
                        ?>
                        <div <?php echo $this->get_render_attribute_string( 'bdt-bs-background' . $item['_id'] ); ?>>
                            <div <?php echo $this->get_render_attribute_string( 'bdt-inner-element' ); ?>>
                                <span <?php echo $this->get_render_attribute_string( 'bdt-highlight-day' . $item['_id'] ); ?>>
                                 <span <?php echo $this->get_render_attribute_string( $day_settings ); ?>><?php echo esc_html($item['enter_day']); ?></span>
                             </span>

                             <?php if ( ! empty($item['enter_time']) ) : ?>
                                <span <?php echo $this->get_render_attribute_string( 'bdt-highlight-time' . $item['_id'] ); ?>>
                                  <span <?php echo $this->get_render_attribute_string( 'bdt-inner-heading-time' ); ?>>
                                   <span <?php echo $this->get_render_attribute_string( $time_settings ); ?>><?php echo esc_html($item['enter_time']); ?></span>
                               </span>
                           </span>
                       <?php endif; ?>
                   </div>
               </div>
               <?php
               $count++;
           } ?>
       </div>
   <?php } }else{
    $this->dynamicRender();
}?>

</div>
<?php
}



public function dynamicRender(){
    $settings = $this->get_settings_for_display();
    if ( count( $settings['dynamic_days_times'] ) ) {
        $count = 0;
        $availabelStatus = null;
        ?>
        <div class="bdt-business-hours-inner">
            <?php
            foreach ( $settings['dynamic_days_times'] as $item ) {
                $day_settings = $this->get_repeater_setting_key( 'dynamic_enter_day', 'dynamic_days_times', $count );
                $this->add_inline_editing_attributes( $day_settings );

                $time_settings = $this->get_repeater_setting_key( 'dynamic_enter_time', 'dynamic_days_times', $count );
                $this->add_inline_editing_attributes( $time_settings );

                $this->add_render_attribute( 'bdt-inner-element', 'class', 'bdt-inner bdt-grid bdt-grid-small', true );
                $this->add_render_attribute( 'bdt-inner-heading-time', 'class', 'inner-heading-time' );
                $this->add_render_attribute( 'bdt-bs-background' . $item['_id'], 'class', 'elementor-repeater-item-' . $item['_id'] );
                $this->add_render_attribute( 'bdt-bs-background' . $item['_id'], 'class', 'border-divider' );

                if ( 'yes' === $item['dynamic_highlight_this'] ) {
                    $this->add_render_attribute( 'bdt-bs-background' . $item['_id'], 'class', 'bdt-highlight-bg' );
                }elseif ( 'yes' === $settings['business_hours_striped'] ) {
                    $this->add_render_attribute( 'bdt-bs-background' . $item['_id'], 'class', 'stripes' );
                }

                $this->add_render_attribute( 'bdt-highlight-day' . $item['_id'], 'class', 'heading-date bdt-width-1-2' );
                $this->add_render_attribute( 'bdt-highlight-time' . $item['_id'], 'class', 'heading-time bdt-width-1-2' );

                if ( 'yes' === $item['dynamic_highlight_this'] ) {
                    $this->add_render_attribute( 'bdt-highlight-day' . $item['_id'], 'class', 'bdt-business-day-off' );
                    $this->add_render_attribute( 'bdt-highlight-time' . $item['_id'], 'class', 'bdt-business-time-off' );
                } else {
                    $this->add_render_attribute( 'bdt-highlight-day' . $item['_id'], 'class', 'bdt-business-day' );
                    $this->add_render_attribute( 'bdt-highlight-time' . $item['_id'], 'class', 'bdt-business-time' );
                }
                
                ?>
                <div <?php echo $this->get_render_attribute_string( 'bdt-bs-background' . $item['_id'] ); ?>>
                    <div <?php echo $this->get_render_attribute_string( 'bdt-inner-element' ); ?>>
                     <span <?php echo $this->get_render_attribute_string( 'bdt-highlight-day' . $item['_id'] ); ?>>
                        <span <?php echo $this->get_render_attribute_string( $day_settings ); ?>>
                           <?php
                           if($item['dynamic_enter_day_level'] == '')
                            echo esc_html( ucwords($item['dynamic_enter_day']) );
                        else
                            echo esc_html( $item['dynamic_enter_day_level'] );
                        ?>

                    </span>
                </span>
                
                <?php //if ( ! empty($item['dynamic_start_time']) ) : ?>
                <span <?php echo $this->get_render_attribute_string( 'bdt-highlight-time' . $item['_id'] ); ?>>
                   <span <?php echo $this->get_render_attribute_string( 'bdt-inner-heading-time' ); ?>>
                      <span <?php echo $this->get_render_attribute_string( $time_settings ); ?>>

                         <?php
                         if ($item['dynamic_close_this'] !='yes'){
                            echo esc_html($item['dynamic_start_time']);
                        }else{
                            echo esc_html($item['dynamic_close_text']);
                            
                        }
                        
                        ?>

                    </span>
                    <span class="dynamic-separator">
                        <?php
                        if ($item['dynamic_close_this'] !='yes')
                           echo esc_html($settings['dynamic_time_separator']);
                       ?>
                    </span>
                <span>
                 <?php
                    if ($item['dynamic_close_this'] !='yes'){
                       echo esc_html($item['dynamic_end_time']);
                   }
                   $thisDay = substr(ucwords($item['dynamic_enter_day']), 0,3);
                                               // echo $thisDay;
                                               // echo date('D');
                   if($settings['dynamic_timezone'] == 'default'){
                       $cur_Date   =   date('D') ;
                   }else{
                       $cur_Date   =   strtotime(  $this->set_time_zone()  );
                       $cur_Date   =    date('D', $cur_Date)  ;
                   }
                   if($cur_Date == $thisDay){

                       if ($item['dynamic_end_time'] !=''  && $item['dynamic_close_this'] !='yes') {
                           $availabelStatus = 'Open-'.
                           $item['dynamic_enter_day'].'-'.
                           $item['dynamic_start_time'].'-'.
                           $item['dynamic_end_time'];
                       }else{
                           $availabelStatus = 'Closed-'.
                           $item['dynamic_enter_day'];
                       }
                  }

                  ?>
                </span>
        </span>
    </span>
    <?php //endif; ?>
</div>
</div>
<?php
$count++;
}
$officeStatus = $settings['dynamic_open_day'];
$officeStatusLogic = 'open';

$exStats = explode('-', $availabelStatus);
                    // print_r($exStats);
if(isset($exStats['1'])){
    if($exStats['0'] == 'Closed'){
        $closeDay = ucwords(substr($exStats['1'], 0,3));
    }
}



if(isset($closeDay)){
    if($closeDay == date('D')){
        $officeStatus = $settings['dynamic_close_day'];
        $officeStatusLogic = 'close';
    }
}


 // echo $settings['dynamic_close_this'];

// echo date('D');


                    //by time
if(isset($exStats['2']) && isset($exStats['3'])){
    $st_time    =   strtotime($exStats['2']);
    $end_time   =   strtotime($exStats['3']);
                        // $cur_time   =   strtotime('now');
    if($settings['dynamic_timezone'] == 'default'){
                            // $cur_time   =   strtotime(date( 'g:i:s A', current_time( 'timestamp' ) ));
        $cur_time   =   strtotime( $this->set_time_zone() );;
    }else{
        $cur_time   =   strtotime(  $this->set_time_zone()  );
        $cur_time   =   strtotime( date('g:i:s A', $cur_time) );
                            // echo date('D, g:i:s A ', $cur_time);
    }
                        // echo date('D, g:i:s A ', $st_time);
                        // echo date('D, g:i:s A ', $end_time);
    if($cur_time >= $st_time && $cur_time <= $end_time){
        $officeStatus = $settings['dynamic_open_day'];
        $officeStatusLogic = 'open';
    }else{
        $officeStatus = $settings['dynamic_close_day'];
        $officeStatusLogic = 'close';
    }
}


?>

</div>
<div class="bdt-live-status">
    <?php
    if($officeStatusLogic == 'open'):
        ?>
        <div class="bdt-alert-success" bdt-alert >
            <a class="bdt-alert-close" bdt-close></a>

            <?php echo $officeStatus; ?>

        </div>
        <?php else: ?>
            <div class="bdt-alert-danger" bdt-alert >
                <a class="bdt-alert-close" bdt-close></a>

                <?php echo $officeStatus; ?>

            </div>
            <?php
        endif;
        ?>
    </div>

<?php }
}

}
