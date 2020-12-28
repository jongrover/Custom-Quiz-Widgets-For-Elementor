<?php
namespace ElementPack\Modules\TimeZone\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit();
}

class Time_Zone extends Widget_Base
{

    public function get_name()
    {
        return 'bdt-time-zone';
    }

    public function get_title()
    {
        return BDTEP . esc_html__('Time Zone', 'bdthemes-element-pack');
    }

    public function get_icon()
    {
        return 'bdt-wi-time-zone';
    }

    public function get_categories()
    {
        return ['element-pack'];
    }

    public function get_keywords()
    {
        return ['time', 'zone'];
    }

    public function get_style_depends()
    {
        return ['ep-time-zone'];
    }

    public function get_script_depends()
    {
        return ['bdt-uikit-icons', 'jclock', 'ep-time-zone'];
    }

    public function get_custom_help_url() {
        return 'https://youtu.be/WOMIk_FVRz4';
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'section_content_additional',
            [
                'label' => __('Time Zone', 'bdthemes-element-pack'),
            ]
        );

        // $this->add_control(
        //     'custom_gmt',
        //     [
        //         'label'        => __('Custom GMT', 'bdthemes-element-pack'),
        //         'type'         => \Elementor\Controls_Manager::SWITCHER,
        //         'return_value' => 'yes',
        //     ]
        // );

        $this->add_control(
            'select_gmt',
            [
                'label'   => __('Select GMT', 'bdthemes-element-pack'),
                'type'    => \Elementor\Controls_Manager::SELECT2,
                'options' => [
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
                    'custom' => __('Custom GMT', 'bdthemes-element-pack'),
                ],
                'default' => ['+1'],

            ]
        );

        $this->add_control(
            'input_gmt',
            [
                'label'       => __('Custom GMT ', 'bdthemes-element-pack'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('example: +6', 'bdthemes-element-pack'),
                'default'     => __('+6', 'bdthemes-element-pack'),
                'condition'   => [
                    'select_gmt' => 'custom',
                ],

            ]
        );

        $this->add_control(
            'time_hour',
            [
                'label'   => __('Time Format', 'bdthemes-element-pack'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '12h' => __('12 Hours', 'bdthemes-element-pack'),
                    '24h' => __('24 Hours', 'bdthemes-element-pack'),
                ],
                'default' => '12h',
            ]
        );

        $this->add_control(
            'show_date',
            [
                'label'        => __('Show Date', 'bdthemes-element-pack'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __('Show', 'bdthemes-element-pack'),
                'label_off'    => __('Hide', 'bdthemes-element-pack'),
                'return_value' => 'yes',
                'separator'    => 'before',
            ]
        );

        $this->add_control(
            'select_date_format',
            [
                'label'     => __('Date Format', 'bdthemes-element-pack'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    // '%a, %d %b'   => __('MM/dd/yy', 'bdthemes-element-pack'),
                    '%m/%d/%y'  => __('mm/dd/yy', 'bdthemes-element-pack'),
                    '%m/%d/%Y'  => __('mm/dd/yyyy', 'bdthemes-element-pack'),
                    '%m-%d-%y'  => __('mm-dd-yy', 'bdthemes-element-pack'),
                    '%m-%d-%Y'  => __('mm-dd-yyyy', 'bdthemes-element-pack'),
                    '%m %d %y'  => __('mm dd yy', 'bdthemes-element-pack'),
                    '%m %d %Y'  => __('mm dd yyyy', 'bdthemes-element-pack'),

                    '%d/%m/%y'  => __('dd/mm/yy', 'bdthemes-element-pack'),
                    '%d/%m/%Y'  => __('dd/mm/yyyy', 'bdthemes-element-pack'),
                    '%d-%m-%Y'  => __('dd-mm-yyyy', 'bdthemes-element-pack'),
                    '%d %m %Y'  => __('dd mm yyyy', 'bdthemes-element-pack'),

                    '%d/%y'     => __('dd/yy', 'bdthemes-element-pack'),
                    '%d-%y'     => __('dd-yy', 'bdthemes-element-pack'),
                    '%d%y'      => __('dd yy', 'bdthemes-element-pack'),
                    '%d/%Y'     => __('dd/yyyy', 'bdthemes-element-pack'),
                    '%d-%Y'     => __('dd-yyyy', 'bdthemes-element-pack'),
                    '%d %Y'     => __('dd yyyy', 'bdthemes-element-pack'),

                    '%b %d, %y' => __('mm dd, yy', 'bdthemes-element-pack'),
                    '%b %d, %Y' => __('mm dd, yyyy', 'bdthemes-element-pack'),

                    '%d %b, %y' => __('dd mm yy', 'bdthemes-element-pack'),
                    '%d %b, %Y' => __('dd mm yyyy', 'bdthemes-element-pack'),

                    '%y %b %d'  => __('yy mm dd', 'bdthemes-element-pack'),
                    '%Y %b %d'  => __('yyyy mm dd', 'bdthemes-element-pack'),

                    '%d %b, %Y' => __('dd mm, yyyy', 'bdthemes-element-pack'),
                    '%b-%d-%Y'  => __('mm-dd-yyyy', 'bdthemes-element-pack'),

                    '%a, %d %b' => __('day-dd-m', 'bdthemes-element-pack'),

                    'custom'    => __('Custom Format', 'bdthemes-element-pack'),
                ],
                'default'   => '%d %b, %Y',
                'condition' => [
                    'show_date' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'input_date_format',
            [
                'label'       => __('Custom Date Format', 'bdthemes-element-pack'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Type date format here', 'bdthemes-element-pack'),
                'default'     => '%a, %d %b',
                'condition'   => [
                    'select_date_format' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'show_country',
            [
                'label'        => __('Show Country', 'bdthemes-element-pack'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __('Show', 'bdthemes-element-pack'),
                'label_off'    => __('Hide', 'bdthemes-element-pack'),
                'return_value' => 'yes',
                'separator'    => 'before',
            ]
        );

        $this->add_control(
            'input_country',
            [
                'label'       => __('Type Country name ', 'bdthemes-element-pack'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('example: Bangladesh', 'bdthemes-element-pack'),
                'default'     => __('Bangladesh', 'bdthemes-element-pack'),
                'condition'   => [
                    'show_country' => 'yes',
                ],

            ]
        );

        $this->add_control(
            'timer_layout',
            [
                'label'      => __('Layout', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::CHOOSE,
                'options'    => [
                    'top'    => [
                        'title' => __('Top', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'default'    => 'top',
                'toggle'     => false,
                'conditions' => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'  => 'show_country',
                            'value' => 'yes',
                        ],
                        [
                            'name'  => 'show_date',
                            'value' => 'yes',
                        ],
                    ],
                ],
                'separator'  => 'before',
            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label'     => __('Alignment', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __('Left', 'bdthemes-element-pack'),
                        'icon'  => 'fas fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'bdthemes-element-pack'),
                        'icon'  => 'fas fa-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'bdthemes-element-pack'),
                        'icon'  => 'fas fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-time-zone-timer' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        //Style

        $this->start_controls_section(
            'section_style_time',
            [
                'label' => __('Time', 'bdthemes-element-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,

            ]
        );

        $this->add_control(
            'time_color',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-time-zone .bdt-time-zone-time' => 'color: {{VALUE}};',
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'time_typography',
                'selector' => '{{WRAPPER}} .bdt-time-zone .bdt-time-zone-time',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_date',
            [
                'label'     => __('Date', 'bdthemes-element-pack'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_date' => 'yes',
                ],

            ]
        );

        $this->add_control(
            'date_color',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-time-zone .bdt-time-zone-date' => 'color: {{VALUE}};',
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'date_typography',
                'selector' => '{{WRAPPER}} .bdt-time-zone .bdt-time-zone-date',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_country',
            [
                'label'     => __('Country', 'bdthemes-element-pack'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_country' => 'yes',
                ],

            ]
        );

        $this->add_control(
            'country_color',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-time-zone .bdt-time-zone-country' => 'color: {{VALUE}};',
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'country_typography',
                'selector' => '{{WRAPPER}} .bdt-time-zone .bdt-time-zone-country',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if ($settings['select_gmt'] == 'custom') {
            $select_gmt = $settings['input_gmt'];
        } else {
            $select_gmt = $settings['select_gmt'];
        }

        if ($settings['show_country'] == 'yes') {
            $country = $settings['input_country'];
        } else {
            $country = 'emptyCountry';
        }

        if ($settings['show_date'] == 'yes') {
            if ($settings['select_date_format'] == 'custom') {
                $dateFormat = $settings['input_date_format'];
            } else {
                $dateFormat = $settings['select_date_format'];
            }
        } else {
            $dateFormat = 'emptyDate';
        }

        $this->add_render_attribute(
            [
                'bdt_time_zone_data' => [
                    'data-settings' => [
                        wp_json_encode(array_filter([
                            "id"         => 'bdt-time-zone-data-' . $this->get_id(),
                            "gmt"        => $select_gmt,
                            "timeHour"   => $settings['time_hour'],
                            "country"    => $country,
                            "dateFormat" => $dateFormat,

                        ])
                        ),
                    ],
                ],
            ]
        );

        ?>

        <div class="bdt-time-zone bdt-time-zone-<?php echo $settings['timer_layout']; ?>" >
            <div class="bdt-time-zone-timer  " id="bdt-time-zone-data-<?php echo $this->get_id(); ?>"   <?php echo $this->get_render_attribute_string('bdt_time_zone_data'); ?>>

            </div>

        <!-- Time 24 / 12 hours
            AM / PM
            Date = Yes/ no + Date Formate
        -->

        </div>

        <?php
}

}
