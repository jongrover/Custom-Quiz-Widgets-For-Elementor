<?php

namespace ElementPack\Modules\PortfolioCarousel\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Utils;

use ElementPack\Modules\QueryControl\Controls\Group_Control_Posts;

use ElementPack\Modules\PortfolioCarousel\Skins;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Portfolio_Carousel extends Widget_Base
{
    private $_query = null;

    public function get_name()
    {
        return 'bdt-portfolio-carousel';
    }

    public function get_title()
    {
        return BDTEP . esc_html__('Portfolio Carousel', 'bdthemes-element-pack');
    }

    public function get_icon()
    {
        return 'bdt-wi-portfolio-carousel';
    }

    public function get_categories()
    {
        return ['element-pack'];
    }

    public function get_keywords()
    {
        return ['portfolio', 'gallery', 'blog', 'recent', 'news', 'works', 'portfolio-carousel'];
    }

    public function get_style_depends()
    {
        return ['element-pack-font', 'ep-portfolio-carousel'];
    }

    public function get_script_depends()
    {
        return ['imagesloaded', 'tilt', 'bdt-uikit-icons', 'ep-portfolio-carousel'];
    }

    public function _register_skins()
    {
        $this->add_skin(new Skins\Skin_Abetis($this));
        $this->add_skin(new Skins\Skin_Fedara($this));
        $this->add_skin(new Skins\Skin_Trosia($this));
        $this->add_skin(new Skins\Skin_Janes($this));
    }

    // public function on_import( $element ) {
    // 	if ( ! get_post_type_object( $element['settings']['posts_post_type'] ) ) {
    // 		$element['settings']['posts_post_type'] = 'post';
    // 	}

    // 	return $element;
    // }

    // public function on_export( $element ) {
    // 	$element = Group_Control_Posts::on_export_remove_setting_from_element( $element, 'posts' );
    // 	return $element;
    // }

    public function get_query()
    {
        return $this->_query;
    }

    public function _register_controls()
    {
        $this->register_section_controls();
    }

    private function register_section_controls()
    {

        $this->start_controls_section(
            'section_carousel_layout',
            [
                'label' => __('Layout', 'bdthemes-element-pack'),
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label' => __('Columns', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 3,
                'tablet_default' => 2,
                'mobile_default' => 1,
                'options' => [
                    1 => '1',
                    2 => '2',
                    3 => '3',
                    4 => '4',
                    5 => '5',
                    6 => '6',
                ],
            ]
        );

        $this->add_control(
            'item_gap',
            [
                'label' => __('Item Gap', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 35,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
            ]
        );

        // $this->add_control(
        // 	'item_ratio',
        // 	[
        // 		'label'   => esc_html__( 'Item Height', 'bdthemes-element-pack' ),
        // 		'type'    => Controls_Manager::SLIDER,
        // 		'default' => [
        // 			'size' => 250,
        // 		],
        // 		'range' => [
        // 			'px' => [
        // 				'min'  => 50,
        // 				'max'  => 500,
        // 				'step' => 5,
        // 			],
        // 		],
        // 		'selectors' => [
        // 			'{{WRAPPER}} .bdt-gallery-thumbnail img' => 'height: {{SIZE}}px',
        // 		],
        // 	]
        // );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_query',
            [
                'label' => esc_html__('Query', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'source',
            [
                'label' => _x('Source', 'Posts Query Control', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__('Show All', 'bdthemes-element-pack'),
                    'by_name' => esc_html__('Manual Selection', 'bdthemes-element-pack'),
                ],
                'label_block' => true,
            ]
        );


        $this->add_control(
            'post_categories',
            [
                'label' => esc_html__('Categories', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SELECT2,
                'options' => element_pack_get_category('portfolio_filter'),
                'default' => [],
                'label_block' => true,
                'multiple' => true,
                'condition' => [
                    'source' => 'by_name',
                ],
            ]
        );

        $this->add_control(
            'limit',
            [
                'label' => esc_html__('Limit', 'bdthemes-element-pack'),
                'type' => Controls_Manager::NUMBER,
                'default' => 9,
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order by', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date' => esc_html__('Date', 'bdthemes-element-pack'),
                    'title' => esc_html__('Title', 'bdthemes-element-pack'),
                    'category' => esc_html__('Category', 'bdthemes-element-pack'),
                    'rand' => esc_html__('Random', 'bdthemes-element-pack'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC' => esc_html__('Descending', 'bdthemes-element-pack'),
                    'ASC' => esc_html__('Ascending', 'bdthemes-element-pack'),
                ],
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => esc_html__('Offset', 'bdthemes-element-pack'),
                'type' => Controls_Manager::NUMBER,
                'default' => 0,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_layout_additional',
            [
                'label' => esc_html__('Additional', 'bdthemes-element-pack'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label' => esc_html__('Title', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SELECT,
                'options' => element_pack_title_tags(),
                'default' => 'h4',
                'condition' => [
                    'show_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_excerpt',
            [
                'label' => esc_html__('Show Text', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'excerpt_limit',
            [
                'label' => esc_html__('Text Limit', 'bdthemes-element-pack'),
                'description' => esc_html__('It\'s just work for main content, but not working with excerpt. If you set 0 so you will get full main content.', 'bdthemes-element-pack'),
                'type' => Controls_Manager::NUMBER,
                'default' => 10,
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'strip_shortcode',
            [
                'label'   => esc_html__('Strip Shortcode', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition'   => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_category',
            [
                'label' => esc_html__('Show Category', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_link',
            [
                'label' => esc_html__('Show Link', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'both',
                'options' => [
                    'post' => esc_html__('Details Link', 'bdthemes-element-pack'),
                    'lightbox' => esc_html__('Lightbox Link', 'bdthemes-element-pack'),
                    'both' => esc_html__('Both', 'bdthemes-element-pack'),
                    'none' => esc_html__('None', 'bdthemes-element-pack'),
                ],
            ]
        );

        $this->add_control(
            'external_link',
            [
                'label' => esc_html__('Show in new Tab (Details Link/Title)', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SWITCHER,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'show_title',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'show_link',
                            'operator' => '==',
                            'values' => ['post', 'both']
                        ],
                    ]
                ],
            ]
        );

        $this->add_control(
            'link_type',
            [
                'label' => esc_html__('Link Type', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon' => esc_html__('Icon', 'bdthemes-element-pack'),
                    'text' => esc_html__('Text', 'bdthemes-element-pack'),
                ],
                'condition' => [
                    'show_link!' => 'none',
                ]
            ]
        );

        $this->add_control(
            'lightbox_animation',
            [
                'label' => esc_html__('Lightbox Animation', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => [
                    'slide' => esc_html__('Slide', 'bdthemes-element-pack'),
                    'fade' => esc_html__('Fade', 'bdthemes-element-pack'),
                    'scale' => esc_html__('Scale', 'bdthemes-element-pack'),
                ],
                'condition' => [
                    'show_link' => ['both', 'lightbox'],
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'lightbox_autoplay',
            [
                'label' => __('Lightbox Autoplay', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SWITCHER,
                'condition' => [
                    'show_link' => ['both', 'lightbox'],
                ]
            ]
        );

        $this->add_control(
            'lightbox_pause',
            [
                'label' => __('Lightbox Pause on Hover', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SWITCHER,
                'condition' => [
                    'show_link' => ['both', 'lightbox'],
                    'lightbox_autoplay' => 'yes'
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_navigation',
            [
                'label' => __('Navigation', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'navigation',
            [
                'label' => __('Navigation', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'arrows',
                'options' => [
                    'both' => esc_html__('Arrows and Dots', 'bdthemes-element-pack'),
                    'arrows-fraction' => esc_html__('Arrows and Fraction', 'bdthemes-element-pack'),
                    'arrows' => esc_html__('Arrows', 'bdthemes-element-pack'),
                    'dots' => esc_html__('Dots', 'bdthemes-element-pack'),
                    'progressbar' => esc_html__('Progress', 'bdthemes-element-pack'),
                    'none' => esc_html__('None', 'bdthemes-element-pack'),
                ],
                'prefix_class' => 'bdt-navigation-type-',
                'render_type' => 'template',
            ]
        );

        $this->add_control(
			'dynamic_bullets',
			[
				'label'     => __( 'Dynamic Bullets?', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
        );
        
        $this->add_control(
			'show_scrollbar',
			[
				'label'     => __( 'Show Scrollbar?', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SWITCHER,
			]
		);

        $this->add_control(
            'both_position',
            [
                'label' => __('Arrows and Dots Position', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'center',
                'options' => element_pack_navigation_position(),
                'condition' => [
                    'navigation' => 'both',
                ],

            ]
        );

        $this->add_control(
            'arrows_fraction_position',
            [
                'label' => __('Arrows and Fraction Position', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'center',
                'options' => element_pack_navigation_position(),
                'condition' => [
                    'navigation' => 'arrows-fraction',
                ],

            ]
        );

        $this->add_control(
            'arrows_position',
            [
                'label' => __('Arrows Position', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'center',
                'options' => element_pack_navigation_position(),
                'condition' => [
                    'navigation' => 'arrows',
                ],

            ]
        );

        $this->add_control(
            'dots_position',
            [
                'label' => __('Dots Position', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'bottom-center',
                'options' => element_pack_pagination_position(),
                'condition' => [
                    'navigation' => 'dots',
                ],

            ]
        );

        $this->add_control(
            'progress_position',
            [
                'label' => __('Progress Position', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'bottom',
                'options' => [
                    'bottom' => esc_html__('Bottom', 'bdthemes-element-pack'),
                    'top' => esc_html__('Top', 'bdthemes-element-pack'),
                ],
                'condition' => [
                    'navigation' => 'progressbar',
                ],

            ]
        );

        $this->add_control(
			'nav_arrows_icon',
			[
				'label'   => esc_html__( 'Arrows Icon', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '5',
				'options' => [
					'1' => esc_html__('Style 1', 'bdthemes-element-pack'),
					'2' => esc_html__('Style 2', 'bdthemes-element-pack'),
					'3' => esc_html__('Style 3', 'bdthemes-element-pack'),
					'4' => esc_html__('Style 4', 'bdthemes-element-pack'),
					'5' => esc_html__('Style 5', 'bdthemes-element-pack'),
					'6' => esc_html__('Style 6', 'bdthemes-element-pack'),
					'7' => esc_html__('Style 7', 'bdthemes-element-pack'),
					'8' => esc_html__('Style 8', 'bdthemes-element-pack'),
					'9' => esc_html__('Style 9', 'bdthemes-element-pack'),
					'10' => esc_html__('Style 10', 'bdthemes-element-pack'),
					'11' => esc_html__('Style 11', 'bdthemes-element-pack'),
					'12' => esc_html__('Style 12', 'bdthemes-element-pack'),
					'13' => esc_html__('Style 13', 'bdthemes-element-pack'),
					'14' => esc_html__('Style 14', 'bdthemes-element-pack'),
					'15' => esc_html__('Style 15', 'bdthemes-element-pack'),
					'16' => esc_html__('Style 16', 'bdthemes-element-pack'),
					'17' => esc_html__('Style 17', 'bdthemes-element-pack'),
					'18' => esc_html__('Style 18', 'bdthemes-element-pack'),
					'circle-1' => esc_html__('Style 19', 'bdthemes-element-pack'),
					'circle-2' => esc_html__('Style 20', 'bdthemes-element-pack'),
					'circle-3' => esc_html__('Style 21', 'bdthemes-element-pack'),
					'circle-4' => esc_html__('Style 22', 'bdthemes-element-pack'),
					'square-1' => esc_html__('Style 23', 'bdthemes-element-pack'),
				],
				'condition' => [
					'navigation' => ['arrows-fraction', 'both', 'arrows'],
				],
			]
		);

        $this->add_control(
            'hide_arrow_on_mobile',
            [
                'label' => __('Hide Arrow on Mobile ?', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [
                    'navigation' => ['arrows-fraction', 'arrows', 'both'],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_carousel_settings',
            [
                'label' => __('Carousel Settings', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'skin',
            [
                'label' => esc_html__('Layout', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'carousel',
                'options' => [
                    'carousel' => esc_html__('Carousel', 'bdthemes-element-pack'),
                    'coverflow' => esc_html__('Coverflow', 'bdthemes-element-pack'),
                ],
                'prefix_class' => 'bdt-carousel-style-',
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'coverflow_toggle',
            [
                'label' => __( 'Coverflow Effect', 'bdthemes-element-pack' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
				'condition' => [
					'skin' => 'coverflow'
				]
            ]
        );

		$this->start_popover();
		
		$this->add_control(
			'coverflow_rotate',
			[
				'label'   => esc_html__( 'Rotate', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 50,
				],
				'range' => [
					'px' => [
						'min'  => -360,
						'max'  => 360,
						'step' => 5,
					],
				],
				'condition' => [
                    'coverflow_toggle' => 'yes'
				],
				'render_type'  => 'template',
			]
		);

        $this->add_control(
			'coverflow_stretch',
			[
				'label' => __( 'Stretch', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min'  => 0,
						'step' => 10,
						'max'  => 100,
					],
				],
				'condition' => [
                    'coverflow_toggle' => 'yes'
				],
				'render_type'  => 'template',
			]
		);

        $this->add_control(
			'coverflow_modifier',
			[
				'label' => __( 'Modifier', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min'  => 1,
						'step' => 1,
						'max'  => 10,
					],
				],
				'condition' => [
                    'coverflow_toggle' => 'yes'
				],
				'render_type'  => 'template',
			]
		);

		$this->add_control(
			'coverflow_depth',
			[
				'label' => __( 'Depth', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'default' => [
					'size' => 100,
				],
				'range' => [
					'px' => [
						'min'  => 0,
						'step' => 10,
						'max'  => 1000,
					],
				],
				'condition' => [
                    'coverflow_toggle' => 'yes'
				],
				'render_type'  => 'template',
			]
		);

        $this->end_popover();
        
        $this->add_control(
			'hr_05',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'skin' => 'coverflow'
				]
			]
		);

        $this->add_control(
            'match_height',
            [
                'label' => __('Item Match Height', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __('Autoplay', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',

            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => esc_html__('Autoplay Speed', 'bdthemes-element-pack'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5000,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'pauseonhover',
            [
                'label' => esc_html__('Pause on Hover', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'slides_to_scroll',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Slides to Scroll', 'bdthemes-element-pack'),
                'options' => [
                    1 => '1',
                    2 => '2',
                    3 => '3',
                    4 => '4',
                    5 => '5',
                    6 => '6',
                ],
                'default' => '1',
                'separator' => 'beafore',
            ]
        );

        $this->add_control(
            'centered_slides',
            [
                'label' => __('Center Slide', 'bdthemes-element-pack'),
                'description' => __('Use even items from Layout > Columns settings for better preview.', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',

            ]
        );

        $this->add_control(
            'grab_cursor',
            [
                'label' => __('Grab Cursor', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __('Loop', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',

            ]
        );


        $this->add_control(
            'speed',
            [
                'label' => __('Animation Speed (ms)', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 500,
                ],
                'range' => [
                    'min' => 100,
                    'max' => 5000,
                    'step' => 50,
                ],
            ]
        );

        $this->add_control(
            'observer',
            [
                'label' => __('Observer', 'bdthemes-element-pack'),
                'description' => __('When you use carousel in any hidden place (in tabs, accordion etc) keep it yes.', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_section();

        //Style
        $this->start_controls_section(
            'section_design_layout',
            [
                'label' => esc_html__('Items', 'bdthemes-element-pack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'item_border_radius',
            [
                'label' => esc_html__('Border Radius', 'bdthemes-element-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    '_skin!' => 'bdt-janes'
				],
            ]
        );


        $this->add_control(
			'overlay_style_headline',
			[
				'label'     => esc_html__('Overlay', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'_skin!' => ['bdt-janes', 'bdt-trosia'],
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_skin_abetis_background',
				'label' => __('Background', 'bdthemes-element-pack'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .bdt-portfolio-carousel.bdt-portfolio-carousel-skin-abetis .bdt-portfolio-inner:before, {{WRAPPER}} .bdt-portfolio-carousel.bdt-portfolio-carousel-skin-fedara .bdt-portfolio-inner:before',
				'condition' => [
					'_skin' => ['bdt-abetis', 'bdt-fedara']
				],
			]
		);

        $this->add_control(
            'overlay_primary_background',
            [
                'label' => esc_html__('Primary Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-portfolio-carousel.bdt-portfolio-carousel-skin-default .bdt-portfolio-content-inner:before' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    '_skin' => '',
                ],
            ]
        );

        $this->add_control(
            'overlay_secondary_background',
            [
                'label' => esc_html__('Secondary Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-portfolio-carousel.bdt-portfolio-carousel-skin-default .bdt-portfolio-content-inner:after' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    '_skin' => '',
                ],
            ]
        );

        $this->add_control(
            'portfolio_content_style_headline',
            [
                'label' => esc_html__('Content', 'bdthemes-element-pack'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
			'content_width',
			[
				'label'     => esc_html__( 'Content Width(%)', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel.bdt-portfolio-carousel-skin-janes .bdt-gallery-item .bdt-portfolio-inner .bdt-portfolio-desc' => 'right: calc(100% - {{SIZE}}%);',
				],
				'condition' => [
					'_skin' => 'bdt-janes',
				],
			]
		);

        $this->add_control(
            'portfolio_content_alignment',
            [
                'label' => __('Alignment', 'bdthemes-element-pack'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'bdthemes-element-pack'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'bdthemes-element-pack'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'bdthemes-element-pack'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'prefix_class' => 'bdt-custom-gallery-skin-fedara-style-',
                'selectors' => [
                    '{{WRAPPER}} .bdt-portfolio-carousel .bdt-portfolio-desc, {{WRAPPER}} .bdt-portfolio-carousel .bdt-portfolio-skin-fedara-desc' => 'text-align: {{VALUE}}',
                ],
                // 'condition' => [
                // 	'_skin!' => 'bdt-trosia',
                // ],
            ]
        );


        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item .bdt-gallery-item-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'desc_background_color',
            [
                'label' => esc_html__('Background Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-portfolio-carousel .bdt-portfolio-desc, {{WRAPPER}} .bdt-portfolio-carousel .bdt-portfolio-skin-fedara-desc' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    '_skin!' => 'bdt-abetis',
                ],
            ]
        );

        $this->add_control(
            'desc__padding',
            [
                'label' => esc_html__('Padding', 'bdthemes-element-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdt-portfolio-carousel .bdt-portfolio-desc, {{WRAPPER}} .bdt-portfolio-carousel .bdt-portfolio-skin-fedara-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'bdthemes-element-pack'),
                'selector' => '{{WRAPPER}} .bdt-gallery-item .bdt-gallery-item-title',
                'condition' => [
                    'show_title' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
			'title_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel.bdt-portfolio-carousel-skin-janes .bdt-gallery-item .bdt-gallery-item-tags' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_category' => 'yes',
					'_skin' => 'bdt-janes',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_excerpt',
            [
                'label' => esc_html__('Text', 'bdthemes-element-pack'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label' => esc_html__('Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-portfolio-carousel .bdt-portfolio-excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'excerpt_margin',
            [
                'label' => esc_html__('Margin', 'bdthemes-element-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .bdt-portfolio-carousel .bdt-portfolio-excerpt' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'label' => esc_html__('Typography', 'bdthemes-element-pack'),
                'selector' => '{{WRAPPER}} .bdt-portfolio-carousel .bdt-portfolio-excerpt',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_button',
            [
                'label' => esc_html__('Button', 'bdthemes-element-pack'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_link!' => 'none',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => esc_html__('Normal', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__('Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item-link, {{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item-link svg, {{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item-link span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => esc_html__('Background Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item-link' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item-link',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => esc_html__('Border', 'bdthemes-element-pack'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item-link',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'bdthemes-element-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'border_radius_advanced_show!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'border_radius_advanced_show',
            [
                'label' => __('Advanced Radius', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'border_radius_advanced',
            [
                'label' => esc_html__('Radius', 'bdthemes-element-pack'),
                'description' => sprintf(__('For example: <b>%1s</b> or Go <a href="%2s" target="_blank">this link</a> and copy and paste the radius value.', 'bdthemes-element-pack'), '30% 70% 82% 18% / 46% 62% 38% 54%', 'https://9elements.github.io/fancy-border-radius/'),
                'type' => Controls_Manager::TEXT,
                'size_units' => ['px', '%'],
                'default' => '30% 70% 82% 18% / 46% 62% 38% 54%',
                'selectors' => [
                    '{{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item-link' => 'border-radius: {{VALUE}}; overflow: hidden;',
                ],
                'condition' => [
                    'border_radius_advanced_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'bdthemes-element-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'label' => esc_html__('Typography', 'bdthemes-element-pack'),
                'selector' => '{{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item-link span',
                // 'condition' => [
                //     'link_type' => 'text',
                // ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => esc_html__('Hover', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'hover_color',
            [
                'label' => esc_html__('Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item-link:hover svg' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item-link:hover span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_hover_color',
            [
                'label' => esc_html__('Background Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item-link:hover, {{WRAPPER}} .bdt-portfolio-carousel.bdt-portfolio-carousel-skin-abetis .bdt-gallery-item-link:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item-link.bdt-link-icon:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_category',
            [
                'label' => esc_html__('Category', 'bdthemes-element-pack'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_category' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'category_color',
            [
                'label' => esc_html__('Category Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item-tags' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'category_separator_color',
            [
                'label' => esc_html__('Separator Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item-tags .bdt-gallery-item-tag-separator' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'category_background',
            [
                'label' => esc_html__('Background', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item-tags' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'category_border',
                'label' => esc_html__('Border', 'bdthemes-element-pack'),
                'selector' => '{{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item-tags',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'category_border_radius',
            [
                'label' => esc_html__('Border Radius', 'bdthemes-element-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item-tags' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'category_padding',
            [
                'label' => esc_html__('Padding', 'bdthemes-element-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item-tags' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'category_box_shadow',
                'selector' => '{{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item-tags',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'category_typography',
                'label' => esc_html__('Typography', 'bdthemes-element-pack'),
                'selector' => '{{WRAPPER}} .bdt-portfolio-carousel .bdt-gallery-item-tag',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'section_style_navigation',
			[
				'label'     => __( 'Navigation', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'conditions'   => [
					'relation' => 'or',
					'terms' => [
						[
							'name'  => 'navigation',
							'operator' => '!=',
							'value' => 'none',
						],
						[
							'name'     => 'show_scrollbar',
							'value'    => 'yes',
						],
					],
				],
			]
		);

		$this->add_control(
			'arrows_heading',
			[
				'label'     => __( 'Arrows', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->start_controls_tabs( 'tabs_navigation_arrows_style' );

		$this->start_controls_tab(
			'tabs_nav_arrows_normal',
			[
				'label' => __( 'Normal', 'bdthemes-element-pack' ),
				'condition' => [
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label'     => __( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-prev i, {{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-next i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'arrows_background',
			[
				'label'     => __( 'Background', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-prev, {{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-next' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'nav_arrows_border',
				'selector'    => '{{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-prev, {{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-next',
				'condition' => [
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-prev, {{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_padding',
			[
				'label' => esc_html__( 'Padding', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-prev, {{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'arrows_size',
			[
				'label' => __( 'Size', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-prev i,
					{{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-next i' => 'font-size: {{SIZE || 24}}{{UNIT}};',
				],
				'condition' => [
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'arrows_space',
			[
				'label' => __( 'Space', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-prev' => 'margin-right: {{SIZE}}px;',
					'{{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-next' => 'margin-left: {{SIZE}}px;',
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'     => 'both_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_nav_arrows_hover',
			[
				'label' => __( 'Hover', 'bdthemes-element-pack' ),
				'condition' => [
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'arrows_hover_color',
			[
				'label'     => __( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-prev:hover i, {{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-next:hover i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'arrows_hover_background',
			[
				'label'     => __( 'Background', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-prev:hover, {{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-next:hover' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'nav_arrows_hover_border_color',
			[
				'label'     => __( 'Border Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-prev:hover, {{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-next:hover'  => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'nav_arrows_border_border!' => '',
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'hr_1',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'navigation!' => [ 'arrows', 'arrows-fraction', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'dots_heading',
			[
				'label'     => __( 'Dots', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'navigation!' => [ 'arrows', 'arrows-fraction', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'hr_11',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'navigation!' => [ 'arrows', 'arrows-fraction', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label'     => __( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => [ 'arrows', 'arrows-fraction', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'active_dot_color',
			[
				'label'     => __( 'Active Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => [ 'arrows', 'arrows-fraction', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'dots_size',
			[
				'label' => __( 'Size', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation!' => [ 'arrows', 'arrows-fraction', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'hr_2',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
			]
		);

		$this->add_control(
			'fraction_heading',
			[
				'label'     => __( 'Fraction', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
			]
		);

		$this->add_control(
			'hr_12',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
			]
		);

		$this->add_control(
			'fraction_color',
			[
				'label'     => __( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .swiper-pagination-fraction' => 'color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
			]
		);

		$this->add_control(
			'active_fraction_color',
			[
				'label'     => __( 'Active Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .swiper-pagination-current' => 'color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'fraction_typography',
				'label'     => esc_html__( 'Typography', 'bdthemes-element-pack' ),
				//'scheme'    => Schemes\Typography::TYPOGRAPHY_4,
				'selector'  => '{{WRAPPER}} .bdt-portfolio-carousel .swiper-pagination-fraction',
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
			]
		);

		$this->add_control(
			'hr_3',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'navigation' => 'progressbar',
				],
			]
		);

		$this->add_control(
			'progresbar_heading',
			[
				'label'     => __( 'Progresbar', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'navigation' => 'progressbar',
				],
			]
		);

		$this->add_control(
			'hr_13',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'navigation' => 'progressbar',
				],
			]
		);

		$this->add_control(
			'progresbar_color',
			[
				'label'     => __( 'Bar Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .swiper-pagination-progressbar' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => 'progressbar',
				],
			]
		);

		$this->add_control(
			'progres_color',
			[
				'label'     => __( 'Progress Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .swiper-pagination-progressbar .swiper-pagination-progressbar-fill' => 'background: {{VALUE}}',
				],
				'condition' => [
					'navigation' => 'progressbar',
				],
			]
		);

		$this->add_control(
			'hr_4',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition'   => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->add_control(
			'scrollbar_heading',
			[
				'label'     => __( 'Scrollbar', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::HEADING,
				'condition'   => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->add_control(
			'hr_14',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition'   => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->add_control(
			'scrollbar_color',
			[
				'label'     => __( 'Bar Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .swiper-scrollbar' => 'background: {{VALUE}}',
				],
				'condition'   => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->add_control(
			'scrollbar_drag_color',
			[
				'label'     => __( 'Drag Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .swiper-scrollbar .swiper-scrollbar-drag' => 'background: {{VALUE}}',
				],
				'condition'   => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->add_control(
			'scrollbar_height',
			[
				'label'   => __( 'Height', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .swiper-container-horizontal > .swiper-scrollbar' => 'height: {{SIZE}}px;',
				],
				'condition'   => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->add_control(
			'hr_5',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'navi_offset_heading',
			[
				'label'     => __( 'Offset', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'hr_6',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_responsive_control(
			'arrows_ncx_position',
			[
				'label'   => __( 'Arrows Horizontal Offset', 'bdthemes-element-pack' ),
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
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows',
						],
						[
							'name'     => 'arrows_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-portfolio-carousel-arrows-ncx: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'arrows_ncy_position',
			[
				'label'   => __( 'Arrows Vertical Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'tablet_default' => [
					'size' => 40,
				],
				'mobile_default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-portfolio-carousel-arrows-ncy: {{SIZE}}px;'
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows',
						],
						[
							'name'     => 'arrows_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_acx_position',
			[
				'label'   => __( 'Arrows Horizontal Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => -60,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-prev' => 'left: {{SIZE}}px;',
					'{{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-next' => 'right: {{SIZE}}px;',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows',
						],
						[
							'name'  => 'arrows_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'dots_nnx_position',
			[
				'label'   => __( 'Dots Horizontal Offset', 'bdthemes-element-pack' ),
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
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'dots',
						],
						[
							'name'     => 'dots_position',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-portfolio-carousel-dots-nnx: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'dots_nny_position',
			[
				'label'   => __( 'Dots Vertical Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'tablet_default' => [
					'size' => 30,
				],
				'mobile_default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'dots',
						],
						[
							'name'     => 'dots_position',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-portfolio-carousel-dots-nny: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'both_ncx_position',
			[
				'label'   => __( 'Arrows & Dots Horizontal Offset', 'bdthemes-element-pack' ),
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
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'     => 'both_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-portfolio-carousel-both-ncx: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'both_ncy_position',
			[
				'label'   => __( 'Arrows & Dots Vertical Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'tablet_default' => [
					'size' => 40,
				],
				'mobile_default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'     => 'both_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-portfolio-carousel-both-ncy: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'both_cx_position',
			[
				'label'   => __( 'Arrows Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => -60,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-prev' => 'left: {{SIZE}}px;',
					'{{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-next' => 'right: {{SIZE}}px;',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'  => 'both_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'both_cy_position',
			[
				'label'   => __( 'Dots Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .bdt-dots-container' => 'transform: translateY({{SIZE}}px);',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'  => 'both_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_fraction_ncx_position',
			[
				'label'   => __( 'Arrows & Fraction Horizontal Offset', 'bdthemes-element-pack' ),
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
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows-fraction',
						],
						[
							'name'     => 'arrows_fraction_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-portfolio-carousel-arrows-fraction-ncx: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'arrows_fraction_ncy_position',
			[
				'label'   => __( 'Arrows & Fraction Vertical Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'tablet_default' => [
					'size' => 40,
				],
				'mobile_default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows-fraction',
						],
						[
							'name'     => 'arrows_fraction_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-portfolio-carousel-arrows-fraction-ncy: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'arrows_fraction_cx_position',
			[
				'label'   => __( 'Arrows Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => -60,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-prev' => 'left: {{SIZE}}px;',
					'{{WRAPPER}} .bdt-portfolio-carousel .bdt-navigation-next' => 'right: {{SIZE}}px;',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows-fraction',
						],
						[
							'name'  => 'arrows_fraction_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_fraction_cy_position',
			[
				'label'   => __( 'Fraction Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .swiper-pagination-fraction' => 'transform: translateY({{SIZE}}px);',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows-fraction',
						],
						[
							'name'  => 'arrows_fraction_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'progress_y_position',
			[
				'label'   => __( 'Progress Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .swiper-pagination-progressbar' => 'transform: translateY({{SIZE}}px);',
				],
				'condition' => [
					'navigation' => 'progressbar',
				],
			]
		);

		$this->add_responsive_control(
			'scrollbar_vertical_offset',
			[
				'label'   => __( 'Scrollbar Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-portfolio-carousel .swiper-container-horizontal > .swiper-scrollbar' => 'bottom: {{SIZE}}px;',
				],
				'condition'   => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->end_controls_section();
    }

    public function query_posts()
    {
        $settings = $this->get_settings_for_display();

        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        $args = array(
            'post_type' => 'portfolio',
            'posts_per_page' => $settings['limit'],
            'orderby' => $settings['orderby'],
            'order' => $settings['order'],
            'post_status' => 'publish',
            'paged' => $paged
        );

        if ('by_name' === $settings['source'] and !empty($settings['post_categories'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'portfolio_filter',
                'field' => 'slug',
                'terms' => $settings['post_categories'],
            );
        }

        $query = new \WP_Query($args);

        return $query;
    }

    public function render()
    {
        $settings = $this->get_settings_for_display();

        $wp_query = $this->query_posts();

        if (!$wp_query->found_posts) {
            return;
        }

        $this->render_header();

        while ($wp_query->have_posts()) {
            $wp_query->the_post();

            $this->render_post();
        }

        $this->render_footer();

        wp_reset_postdata();

    }

    public function render_thumbnail()
    {
        $settings = $this->get_settings_for_display();

        $settings['thumbnail_size'] = [
            'id' => get_post_thumbnail_id(),
        ];

        $thumbnail_html      = Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail_size');
        $placeholder_img_src = Utils::get_placeholder_image_src();
        $img_url             = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');

        if (!$thumbnail_html) {
            $thumbnail_html = '<img src="' . esc_url($placeholder_img_src) . '" alt="' . get_the_title() . '">';
        }

        ?>
        <div class="bdt-gallery-thumbnail">
            <?php echo $thumbnail_html ?>
        </div>
        <?php
    }

    public function render_title()
    {
        $settings = $this->get_settings_for_display();

        if (!$settings['show_title']) {
            return;
        }

        $tag    = $settings['title_tag'];
        $target = ($settings['external_link']) ? 'target="_blank"' : '';

        ?>
    <a href="<?php echo get_the_permalink(); ?>" <?php echo $target; ?>>
        <<?php echo $tag ?> class="bdt-gallery-item-title bdt-margin-remove">
        <?php the_title() ?>
        </<?php echo $tag ?>>
        </a>
        <?php
    }

    public function render_excerpt()
    {
        if (!$this->get_settings('show_excerpt')) {
            return;
        }

        $strip_shortcode = $this->get_settings_for_display('strip_shortcode');

        ?>
        <div class="bdt-portfolio-excerpt">
            <?php 
				if ( has_excerpt() ) {
					the_excerpt();
				} else {
					echo element_pack_custom_excerpt($this->get_settings_for_display('excerpt_limit'), $strip_shortcode);
				}
			?>
        </div>
        <?php

    }

    public function render_categories_names()
    {
        $settings = $this->get_settings_for_display();
        if (!$this->get_settings('show_category')) {
            return;
        }

        $this->add_render_attribute('portfolio-category', 'class', 'bdt-gallery-item-tags', true);

        global $post;

        $separator  = '<span class="bdt-gallery-item-tag-separator"></span>';
        $tags_array = [];

        $item_filters = get_the_terms($post->ID, 'portfolio_filter');

        foreach ($item_filters as $item_filter) {
            $tags_array[] = '<span class="bdt-gallery-item-tag">' . $item_filter->slug . '</span>';
        }

        ?>
        <div <?php echo $this->get_render_attribute_string('portfolio-category'); ?>>
            <?php echo implode($separator, $tags_array); ?>
        </div>
        <?php
    }

    public function render_overlay()
    {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute(
            [
                'content-position' => [
                    'class' => [
                        'bdt-position-center',
                    ]
                ]
            ], '', '', true
        );

        ?>
        <div <?php echo $this->get_render_attribute_string('content-position'); ?>>
            <div class="bdt-portfolio-content">
                <div class="bdt-gallery-content-inner">
                    <?php

                    $placeholder_img_src = Utils::get_placeholder_image_src();

                    $img_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');

                    if (!$img_url) {
                        $img_url = $placeholder_img_src;
                    } else {
                        $img_url = $img_url[0];
                    }

                    $this->add_render_attribute(
                        [
                            'lightbox-settings' => [
                                'class' => [
                                    'bdt-gallery-item-link',
                                    'bdt-gallery-lightbox-item',
                                    ('icon' == $settings['link_type']) ? 'bdt-link-icon' : 'bdt-link-text'
                                ],
                                'data-elementor-open-lightbox' => 'no',
                                'data-caption' => get_the_title(),
                                'href' => esc_url($img_url)
                            ]
                        ], '', '', true
                    );

                    if ('none' !== $settings['show_link'])  : ?>
                        <div class="bdt-flex-inline bdt-gallery-item-link-wrapper">
                            <?php if (('lightbox' == $settings['show_link']) || ('both' == $settings['show_link'])) : ?>
                                <a <?php echo $this->get_render_attribute_string('lightbox-settings'); ?>>
                                    <?php if ('icon' == $settings['link_type']) : ?>
                                        <span bdt-icon="icon: search"></span>
                                    <?php elseif ('text' == $settings['link_type']) : ?>
                                        <span><?php esc_html_e('ZOOM', 'bdthemes-element-pack'); ?></span>
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>

                            <?php if (('post' == $settings['show_link']) || ('both' == $settings['show_link'])) : ?>
                                <?php
                                $link_type_class = ('icon' == $settings['link_type']) ? ' bdt-link-icon' : ' bdt-link-text';
                                $target          = ($settings['external_link']) ? 'target="_blank"' : '';

                                ?>
                                <a class="bdt-gallery-item-link<?php echo esc_attr($link_type_class); ?>"
                                   href="<?php echo esc_attr(get_permalink()); ?>" <?php echo $target; ?>>
                                    <?php if ('icon' == $settings['link_type']) : ?>
                                        <span bdt-icon="icon: link"></span>
                                    <?php elseif ('text' == $settings['link_type']) : ?>
                                        <span><?php esc_html_e('VIEW', 'bdthemes-element-pack'); ?></span>
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }

    public function render_header($skin = "default")
    {
        $id              = 'bdt-portfolio-carousel-' . $this->get_id();
        $settings        = $this->get_settings_for_display();
        $elementor_vp_lg = get_option('elementor_viewport_lg');
        $elementor_vp_md = get_option('elementor_viewport_md');
        $viewport_lg     = !empty($elementor_vp_lg) ? $elementor_vp_lg - 1 : 1023;
        $viewport_md     = !empty($elementor_vp_md) ? $elementor_vp_md - 1 : 767;

        $this->add_render_attribute('portfolio-carousel', 'id', $id);
        $this->add_render_attribute('portfolio-carousel', 'class', ['bdt-portfolio-carousel', 'bdt-portfolio-carousel-skin-' . $skin]);

        if ('yes' == $settings['match_height']) {
            $this->add_render_attribute('portfolio-carousel', 'bdt-height-match', 'target: > div > div > .bdt-gallery-item');
        }

        if ('arrows' == $settings['navigation']) {
            $this->add_render_attribute('portfolio-carousel', 'class', 'bdt-arrows-align-' . $settings['arrows_position']);
        } elseif ('dots' == $settings['navigation']) {
            $this->add_render_attribute('portfolio-carousel', 'class', 'bdt-dots-align-' . $settings['dots_position']);
        } elseif ('both' == $settings['navigation']) {
            $this->add_render_attribute('portfolio-carousel', 'class', 'bdt-arrows-dots-align-' . $settings['both_position']);
        } elseif ('arrows-fraction' == $settings['navigation']) {
            $this->add_render_attribute('portfolio-carousel', 'class', 'bdt-arrows-dots-align-' . $settings['arrows_fraction_position']);
        }

        if ('arrows-fraction' == $settings['navigation']) {
            $pagination_type = 'fraction';
        } elseif ('both' == $settings['navigation'] or 'dots' == $settings['navigation']) {
            $pagination_type = 'bullets';
        } elseif ('progressbar' == $settings['navigation']) {
            $pagination_type = 'progressbar';
        } else {
            $pagination_type = '';
        }

        $this->add_render_attribute(
            [
                'portfolio-carousel' => [
                    'data-settings' => [
                        wp_json_encode(array_filter([
                            "autoplay" => ("yes" == $settings["autoplay"]) ? ["delay" => $settings["autoplay_speed"]] : false,
                            "loop" => ($settings["loop"] == "yes") ? true : false,
                            "speed" => $settings["speed"]["size"],
                            "pauseOnHover" => ("yes" == $settings["pauseonhover"]) ? true : false,
                            "slidesPerView" => (int)$settings["columns_mobile"],
                            "slidesPerGroup" => ($settings["slides_to_scroll"] > 1) ? $settings["slides_to_scroll"] : false,
                            "centeredSlides" => ($settings["centered_slides"] === "yes") ? true : false,
                            "grabCursor" => ($settings["grab_cursor"] === "yes") ? true : false,
                            "effect" => $settings["skin"],
                            "spaceBetween" => $settings["item_gap"]["size"],
                            "observer" => ($settings["observer"]) ? true : false,
                            "observeParents" => ($settings["observer"]) ? true : false,
                            "breakpoints" => [
                                (int)$viewport_md => [
                                    "slidesPerView" => (int)$settings["columns_tablet"],
                                    "spaceBetween" => $settings["item_gap"]["size"],
                                ],
                                (int)$viewport_lg => [
                                    "slidesPerView" => (int)$settings["columns"],
                                    "spaceBetween" => $settings["item_gap"]["size"],
                                ]
                            ],
                            "navigation" => [
                                "nextEl" => "#" . $id . " .bdt-navigation-next",
                                "prevEl" => "#" . $id . " .bdt-navigation-prev",
                            ],
                            "pagination" => [
                                "el" => "#" . $id . " .swiper-pagination",
                                "type" => $pagination_type,
                                "clickable" => "true",
                                'dynamicBullets' => ("yes" == $settings["dynamic_bullets"]) ? true : false, 
                            ],
                            "scrollbar" => [
								"el"            => "#" . $id . " .swiper-scrollbar",
								"hide"          => "true",
							],
							'coverflowEffect' => [
								'rotate'       => ( "yes" == $settings["coverflow_toggle"] ) ? $settings["coverflow_rotate"]["size"] : 50,
								'stretch'      => ( "yes" == $settings["coverflow_toggle"] ) ? $settings["coverflow_stretch"]["size"] : 0,
								'depth'        => ( "yes" == $settings["coverflow_toggle"] ) ? $settings["coverflow_depth"]["size"] : 100,
								'modifier'     => ( "yes" == $settings["coverflow_toggle"] ) ? $settings["coverflow_modifier"]["size"] : 1,
								'slideShadows' => true,
							],
                        ]))
                    ]
                ]
            ]
        );

        if ('lightbox' === $settings['show_link'] or 'both' === $settings['show_link']) {
            $this->add_render_attribute('portfolio-carousel', 'bdt-lightbox', 'toggle: .bdt-gallery-lightbox-item; animation:' . $settings['lightbox_animation'] . ';');
            if ($settings['lightbox_autoplay']) {
                $this->add_render_attribute('portfolio-carousel', 'bdt-lightbox', 'autoplay: 500;');

                if ($settings['lightbox_pause']) {
                    $this->add_render_attribute('portfolio-carousel', 'bdt-lightbox', 'pause-on-hover: true;');
                }
            }
        }

        ?>
        <div <?php echo $this->get_render_attribute_string('portfolio-carousel'); ?>>
        <div class="swiper-container">
        <div class="swiper-wrapper">
        <?php
    }

    public function render_navigation() {
		$settings = $this->get_settings_for_display();
		$hide_arrow_on_mobile = $settings['hide_arrow_on_mobile'] ? ' bdt-visible@m' : '';
		
		if ( 'arrows' == $settings['navigation'] ) : ?>
			<div class="bdt-position-z-index bdt-position-<?php echo esc_attr( $settings['arrows_position'] . $hide_arrow_on_mobile ); ?>">
				<div class="bdt-arrows-container bdt-slidenav-container">
					<a href="" class="bdt-navigation-prev bdt-slidenav-previous bdt-icon bdt-slidenav">
						<i class="ep-arrow-left-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
					</a>
					<a href="" class="bdt-navigation-next bdt-slidenav-next bdt-icon bdt-slidenav">
						<i class="ep-arrow-right-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
					</a>
				</div>
			</div>
		<?php endif;
	}

	public function render_pagination() {
		$settings = $this->get_settings_for_display();
		
		if ( 'dots' == $settings['navigation'] or 'arrows-fraction' == $settings['navigation'] ) : ?>
			<div class="bdt-position-z-index bdt-position-<?php echo esc_attr($settings['dots_position']); ?>">
				<div class="bdt-dots-container">
					<div class="swiper-pagination"></div>
				</div>
			</div>

		<?php elseif ( 'progressbar' == $settings['navigation'] ) : ?>
			<div class="swiper-pagination bdt-position-z-index bdt-position-<?php echo esc_attr($settings['progress_position']); ?>"></div>
		<?php endif;
	}

	public function render_both_navigation() {
		$settings = $this->get_settings_for_display();
		$hide_arrow_on_mobile = $settings['hide_arrow_on_mobile'] ? 'bdt-visible@m' : '';
		
		?>
		<div class="bdt-position-z-index bdt-position-<?php echo esc_attr($settings['both_position']); ?>">
			<div class="bdt-arrows-dots-container bdt-slidenav-container ">
				
				<div class="bdt-flex bdt-flex-middle">
					<div class="<?php echo esc_attr( $hide_arrow_on_mobile ); ?>">
						<a href="" class="bdt-navigation-prev bdt-slidenav-previous bdt-icon bdt-slidenav">
							<i class="ep-arrow-left-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
						</a>
					</div>

					<?php if ('center' !== $settings['both_position']) : ?>
						<div class="swiper-pagination"></div>
					<?php endif; ?>
					
					<div class="<?php echo esc_attr( $hide_arrow_on_mobile ); ?>">
						<a href="" class="bdt-navigation-next bdt-slidenav-next bdt-icon bdt-slidenav">
							<i class="ep-arrow-right-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>		
		<?php
	}

	public function render_arrows_fraction() {
		$settings             = $this->get_settings_for_display();
		$hide_arrow_on_mobile = $settings['hide_arrow_on_mobile'] ? 'bdt-visible@m' : '';
		
		?>
		<div class="bdt-position-z-index bdt-position-<?php echo esc_attr($settings['arrows_fraction_position']); ?>">
			<div class="bdt-arrows-fraction-container bdt-slidenav-container ">
				
				<div class="bdt-flex bdt-flex-middle">
					<div class="<?php echo esc_attr( $hide_arrow_on_mobile ); ?>">
						<a href="" class="bdt-navigation-prev bdt-slidenav-previous bdt-icon bdt-slidenav">
							<i class="ep-arrow-left-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
						</a>
					</div>

					<?php if ('center' !== $settings['arrows_fraction_position']) : ?>
						<div class="swiper-pagination"></div>
					<?php endif; ?>
					
					<div class="<?php echo esc_attr( $hide_arrow_on_mobile ); ?>">
						<a href="" class="bdt-navigation-next bdt-slidenav-next bdt-icon bdt-slidenav">
							<i class="ep-arrow-right-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>		
		<?php
	}

    public function render_footer()
    {
            $id       = 'bdt-portfolio-carousel-' . $this->get_id();
            $settings = $this->get_settings_for_display();

            ?>
            </div>
            <?php if ( 'yes' === $settings['show_scrollbar'] ) : ?>
            <div class="swiper-scrollbar"></div>
            <?php endif; ?>
        </div>

        <?php if ('both' == $settings['navigation']) : ?>
        <?php $this->render_both_navigation(); ?>
        <?php if ('center' === $settings['both_position']) : ?>
            <div class="bdt-position-z-index bdt-position-bottom">
                <div class="bdt-dots-container">
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        <?php endif; ?>
        <?php elseif ('arrows-fraction' == $settings['navigation']) : ?>
            <?php $this->render_arrows_fraction(); ?>
            <?php if ('center' === $settings['arrows_fraction_position']) : ?>
                <div class="bdt-dots-container">
                    <div class="swiper-pagination"></div>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <?php $this->render_pagination(); ?>
            <?php $this->render_navigation(); ?>
        <?php endif; ?>

        </div>

        <?php
    }


    public function render_desc()
    {
        ?>
        <div class="bdt-portfolio-desc">
            <?php
            $this->render_title();
            $this->render_excerpt();
            ?>
        </div>
        <?php
    }

    public function render_post()
    {
        $settings = $this->get_settings_for_display();
        global $post;

        $this->add_render_attribute('portfolio-item-inner', 'class', 'bdt-portfolio-inner', true);

        $this->add_render_attribute('portfolio-item', 'class', 'swiper-slide bdt-gallery-item bdt-transition-toggle', true);

        ?>
        <div <?php echo $this->get_render_attribute_string('portfolio-item'); ?>>
            <div <?php echo $this->get_render_attribute_string('portfolio-item-inner'); ?>>
                <div class="bdt-portfolio-content-inner">
                    <?php
                    $this->render_thumbnail();
                    $this->render_overlay();
                    ?>
                </div>
                <?php $this->render_desc(); ?>
                <?php $this->render_categories_names(); ?>
            </div>
        </div>
        <?php
    }
}
