<?php

namespace Elementor;

defined('ABSPATH') || exit;

use Elementor\ElementsKit_Widget_Dribble_Feed_Handler as Handler;
use \ElementsKit_Lite\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;


class ElementsKit_Widget_Dribble_Feed extends Widget_Base {

	public $base;


	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		wp_register_script('ekit-dribble-feed-script-handle', Handler::get_url() . 'assets/js/script.js', ['elementor-frontend'], \ElementsKit_Lite::version(), true);
	}


	public function get_script_depends() {
		return ['ekit-dribble-feed-script-handle'];
	}


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

    private function controls_section( $config, $callback ){

		// New configs
		$newConfig = [ 'label' => $config['label'] ];
		
		// Formatting configs
		if(isset($config['tab'])) $newConfig['tab'] = $config['tab'];
		if(isset($config['condition'])) $newConfig['condition'] = $config['condition'];

		// Start section
		$this->start_controls_section( $config['key'],  $config);

		// Call the callback function
		call_user_func(array($this, $callback));

		// End section
		$this->end_controls_section();
	}
    
    private function controls_section_arrow_icon(){

		$root = '.ekit-feed-item-dribble .ekit-feed-item--go-arrow a';
		$icon = $root . ' i';

        // Circle
		$this->add_control( 'ekit_dribbble_feed_arrow_icon_circle_heading', [
			'label'     => esc_html__('Circle', 'elementskit'),
			'type'      => Controls_Manager::HEADING
        ]);

        // Circle size
		$this->add_responsive_control(
			'ekit_dribbble_feed_arrow_icon_circle_size', [
				'label' => __( 'Circle Size', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [ 'min' => 24, 'max' => 96, 'step' => 4 ],
					'em' => [ 'min' => 1.5, 'max' => 6, 'step' => 0.2 ],
				],
				'default' => [ 'unit' => 'px', 'size' => 40 ],
				'tablet_default' => [ 'unit' => 'px', 'size' => 40 ],
				'mobile_default' => [ 'unit' => 'px', 'size' => 40 ],
				'selectors' => [
					'{{WRAPPER}} ' . $root => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
				],
			]
        );

        // Circle background
        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name'      => 'ekit_dribbble_feed_arrow_icon_circle_background',
                'label'     => esc_html__( 'Background', 'elementskit' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} ' . $root
            ]
        );

        // Icon
		$this->add_control( 'ekit_dribbble_feed_arrow_icon_icon_heading', [
			'label'     => esc_html__('Icon', 'elementskit'),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
        ]);

        // ekit_dribbble_feed_arrow_icons
        $this->add_control(
            'ekit_dribbble_feed_arrow_icons', [
                'label' => esc_html__( 'Header Icon', 'elementskit' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'ekit_dribbble_feed_arrow_icon',
                'default' => [
                    'value' => 'icon icon-right-arrow1',
                    'library' => 'ekiticons',
                ],
                'label_block' => true
            ]
        );

        // ekit_dribbble_feed_arrow_icon_size
		$this->add_responsive_control(
			'ekit_dribbble_feed_arrow_icon_size', [
				'label' => __( 'Icon Size', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [ 'min' => 0, 'max' => 96, 'step' => 4 ],
					'em' => [ 'min' => 0, 'max' => 6, 'step' => 0.2 ],
				],
				'default' => [ 'unit' => 'px', 'size' => 20 ],
				'tablet_default' => [ 'unit' => 'px', 'size' => 20 ],
				'mobile_default' => [ 'unit' => 'px', 'size' => 20 ],
				'selectors' => [
					'{{WRAPPER}} ' . $icon => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
        );

        // ekit_dribbble_feed_arrow_icon_color
        $this->add_control(
			'ekit_dribbble_feed_arrow_icon_color', [
				'label'     => __('Icon Color', 'elementskit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $icon => 'color: {{VALUE}}',
				],
			]
		);
    }


	protected function _register_controls() {

	
        // ==========================
        // Start layout section
        // ==========================
        $this->start_controls_section(
            'ekit_feed_layout_section', [
                'label' => esc_html__( 'Layout', 'elementskit' ),
            ]
        );

        // Card style [ekit_feed_card_styles]
		$this->add_control(
            'ekit_feed_card_styles',
            [
                'label' => esc_html__('Choose Style', 'elementskit'),
                'type' => ElementsKit_Controls_Manager::IMAGECHOOSE,
                'default' => 'style1',
                'options' => [
					'style1' => [
						'title' => esc_html__( 'Default', 'elementskit' ),
                        'imagelarge' => Handler::get_url() . 'assets/images/style-1.png',
                        'imagesmall' => Handler::get_url() . 'assets/images/style-1.png',
                        'width' => '33.33%',
					],
					'style2' => [
						'title' => esc_html__( 'Grid Style without image', 'elementskit' ),
                        'imagelarge' => Handler::get_url() . 'assets/images/style-2.png',
                        'imagesmall' => Handler::get_url() . 'assets/images/style-2.png',
                        'width' => '33.33%',
					],
					'style3' => [
						'title' => esc_html__( 'Image with Ratting', 'elementskit' ),
                        'imagelarge' => Handler::get_url() . 'assets/images/style-3.png',
                        'imagesmall' => Handler::get_url() . 'assets/images/style-3.png',
                        'width' => '33.33%',
					],
					'style4' => [
						'title' => esc_html__( 'image style 4', 'elementskit' ),
                        'imagelarge' => Handler::get_url() . 'assets/images/style-4.png',
                        'imagesmall' => Handler::get_url() . 'assets/images/style-4.png',
                        'width' => '33.33%',
					],
					'style5' => [
						'title' => esc_html__( 'image style 5', 'elementskit' ),
                        'imagelarge' => Handler::get_url() . 'assets/images/style-5.png',
                        'imagesmall' => Handler::get_url() . 'assets/images/style-5.png',
                        'width' => '33.33%',
					]
				],
            ]
        );

        // Flex column count
        $this->add_responsive_control(
            'ekit_feed_flex_column_count', [
                'label'     => esc_html__( 'Column Count', 'elementskit' ),
                'type'      => Controls_Manager::SELECT,
                'default' => 'col-3',
                'tablet_default' => 'col-6',
                'mobile_default' => 'col-12',
                'options'   => [
                    'col-12' => esc_html__('1', 'elementskit'),
                    'col-6' => esc_html__('2', 'elementskit'),
                    'col-4' => esc_html__('3', 'elementskit'),
                    'col-3' => esc_html__('4', 'elementskit'),
                    'col-2' => esc_html__('6', 'elementskit'),
                ]
            ]
        );


        $this->end_controls_section();
        // ==========================
        // ENd layout section
        // ==========================
        
        // ==========================
        // Start widget style section
        // ==========================
        $this->start_controls_section(
            'ekit_feed_widget_style_section_heading', [
                'label' => esc_html__( 'Widget styles', 'elementskit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // ekit_review_widget_background
        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name'      => 'ekit_feed_widget_background',
                'label'     => esc_html__( 'Widget Background', 'elementskit' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .ekit-feed-wrapper-dribble'
                ]
        );

        // Widget padding
        $this->add_responsive_control(
            'ekit_feed_widget_padding',
            [
                'label'      => esc_html__( 'Padding', 'elementskit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .ekit-feed-wrapper-dribble' => 
                        'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'  => [
                    'top' => 1, 'right' => 1,
                    'bottom' => 1, 'left' => 1,
                    'unit' => 'em', 'isLinked' => true,
                ],
                'tablet_default'  => [
                    'top' => '8', 'right' => '8',
                    'bottom' => '8', 'left' => '8',
                    'unit' => 'px', 'isLinked' => true,
                 ],
                 'mobile_default'  => [
                    'top' => '8', 'right' => '8',
                    'bottom' => '8', 'left' => '8',
                    'unit' => 'px', 'isLinked' => true,
                 ],
            ]
        );

        $this->end_controls_section();
        // ==========================
        // End widget style section
        // ==========================

        // ==========================
        // Start feed header styles
        // ==========================
        $this->start_controls_section(
            'ekit_feed_header_styles_section', [
                'label' => esc_html__( 'Feed Header', 'elementskit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        // Feed header title color
        $this->add_control(
            'ekit_feed_header_name_color', [
                'label' => __( 'Primary Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ekit-feed-header-dribble .ekit-feed-header--name' => 'color: {{VALUE}}',
                ],
            ]
        );
        // Feed header desc and location color
        $this->add_control(
            'ekit_feed_header_desc_and_location_color', [
                'label' => __( 'Secondary Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ekit-feed-header-dribble .ekit-feed-header--desc' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .ekit-feed-header-dribble .ekit-feed-header--location' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        // Feed header typography
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'ekit_feed_header_typography',
                'label' => __( 'Typography', 'elementskit' ),
                'selector' => '{{WRAPPER}} .ekit-feed-header-dribble',
            ]
        );

        // Feed header background
        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name'      => 'ekit_feed_header_background',
                'label'     => esc_html__( 'Background', 'elementskit' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '
                    {{WRAPPER}} .ekit-feed-header-dribble'
                ,
            ]
        );

        // Feed header padding
        $this->add_responsive_control(
            'ekit_feed_header_padding',
            [
                'label'      => esc_html__( 'Padding', 'elementskit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .ekit-feed-header-dribble' => 
                        'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'  => [
                    'top' => 1, 'right' => 1,
                    'bottom' => 1, 'left' => 1,
                    'unit' => 'em', 'isLinked' => true,
                ],
            ]
        );

        // Feed header margin
        $this->add_responsive_control(
            'ekit_feed_header_margin', [
                'label' => esc_html__( 'Margin', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'  => [
                    'top' => 0, 'right' => 0,
                    'bottom' => 1, 'left' => 0,
                    'unit' => 'em', 'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ekit-feed-header-dribble' => 
                        'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Feed header border heading
        $this->add_control(
            'ekit_feed_header_border_heading', [
                'label' => esc_html__( 'Border', 'elementskit' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        // Feed header border
        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name'     => 'ekit_feed_header_border_type',
                'label'    => esc_html__( 'Border Type', 'elementskit' ),
                'selector' => '{{WRAPPER}} .ekit-feed-header-dribble',
            ]
        );
        // Feed header border radius
        $this->add_control(
            'ekit_feed_header_border_radius', [
                'label' => esc_html__( 'Border Radius', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ekit-feed-header-dribble' => 
                        'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ==========================
        // End feed header styles
        // ==========================


        // ==========================
        // Start feed item cards
        // ==========================
        $this->start_controls_section(
            'ekit_feed_cards_section_heading', [
                'label' => esc_html__( 'Cards Container', 'elementskit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // Feed item cards background
        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name'      => 'ekit_feed_cards_background',
                'label'     => esc_html__( 'Background', 'elementskit' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .ekit-feed-items-wrapper'
                ]
        );


        // Feed item cards padding
        $this->add_responsive_control(
            'ekit_feed_item_cards_padding', [
                'label' => esc_html__( 'Padding', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'  => [
                    'top' => 1, 'right' => 1,
                    'bottom' => 0, 'left' => 1,
                    'unit' => 'em', 'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ekit-feed-items-wrapper-dribble' => 
                        'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();
        // ==========================
        // End feed cards
        // ==========================


        // ==========================
        // Start feed item card
        // ==========================
        $this->start_controls_section(
            'ekit_feed_item_card_section_heading', [
                'label' => esc_html__( 'Feed Card', 'elementskit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // Feed item card background
        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name'      => 'ekit_feed_card_background',
                'label'     => esc_html__( 'Background', 'elementskit' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .ekit-feed-item-dribble'
                ]
        );

        // Feed item card margin
        $this->add_responsive_control(
            'ekit_feed_item_card_margin', [
                'label' => esc_html__( 'Margin', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'  => [
                    'top' => 0, 'right' => 0,
                    'bottom' => 1, 'left' => 0,
                    'unit' => 'em', 'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ekit-feed-item-dribble' => 
                        'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();
        // ==========================
        // End feed item card
        // ==========================

        // Top right brand logo
        $this->controls_section(
            [ 
                'label' => esc_html__('Arrow Icon', 'elementskit'),  
                'key' => 'ekit_dribbble_feed_arrow_icon',       
                'tab' => Controls_Manager::TAB_STYLE
            ], 
            'controls_section_arrow_icon'
        );

	}


	protected function render() {
		echo '<div class="ekit-wid-con" >';
		$this->render_raw();
		echo '</div>';
	}


	protected function render_raw() {

        $settings  = $this->get_settings_for_display();
        extract($settings);
		$widget_id = $this->get_id();

		$config = Handler::get_config();

		if(empty($config['access_token'])) : ?>

            <h1><?php echo esc_html__('Dribbble Feed', 'elementskit') ?></h1>
            <div><?php echo esc_html__('Please Get a access token first', 'elementskit') ?></div>

		<?php else:

			$feed = Handler::get_feed($config['access_token']);

			if($feed === false) : ?>

                <h1><?php echo esc_html__('Data retrieved failed!', 'elementskit') ?></h1>

			<?php else :
                $profile = null;
                $items = !empty($feed) ? $feed : [];
            ?>

                <!-- Start Markup  -->
                <div class="ekit-feed-wrapper ekit-feed-wrapper-dribble">

                    <?php if($profile): ?>
                    <!-- Start feed header -->
                    <div class="ekit-feed-header ekit-feed-header-dribble">
                        <!-- Start header left -->
                        <div class="header-left">
                            <!-- Start thumbnail -->
                            <div class="ekit-feed-header--thumbnail">
                                <?php 
                                $thumbnail = !empty($profile['thumbnail']) 
                                    ? $profile['thumbnail'] 
                                    : Handler::get_url() . 'assets/images/profile-thumbnail.png'
                                ?>
                                <img src="<?php echo $thumbnail ?>" alt="<?php echo $profile['title'] ?>">
                            </div>
                            <!-- End thumbnail -->
                            <div>
                                <h4 class='ekit-feed-header--name'>
                                    <?php echo $profile['title'] ?>
                                </h4>

                                <!-- Start Location -->
                                <?php if(!empty($profile['location'])):?>
                                    <div class='ekit-feed-header--location'>
                                        <i class="icon icon-map-marker"></i>
                                        <p><?php echo $profile['location'] ?></p>
                                    </div>
                                <?php endif ?>
                                <!-- End Location -->

                                <!-- Start description -->
                                <?php if(!empty($profile['description'])):?>
                                    <div class='ekit-feed-header--desc'>
                                        <i class="icon icon-information"></i>
                                        <p><?php echo $profile['description'] ?></p>
                                    </div>
                                <?php endif ?>
                                <!-- End description -->

                            </div>
                        </div>
                        <!-- End header left -->
                        <div class="header-right">
                            <div class="ekit-feed-header--actions">
                                <a href="<?php echo $profile['link'] ?>" target="_" class="btn btn-primary btn-pill">
                                    <?php echo esc_html__('Follow', 'elementskit') ?>
                                </a>
                                <a href="<?php echo $profile['link'] ?>" target="_" class="btn btn-primary-outlined btn-pill">
                                    <?php echo esc_html__('Message', 'elementskit') ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- End feed header -->
                    <?php endif ?>

                    <!-- Start feed items -->
                    <div class="ekit-feed-items-wrapper ekit-feed-items-wrapper-dribble">
                        <div class="row">
                            <?php foreach($items as $item): ?>
                                <div class='<?php  echo esc_attr($ekit_feed_flex_column_count) ?>'>
                                    <!-- Start feed item -->
                                    <div class="ekit-feed-item ekit-feed-item-dribble <?php echo $ekit_feed_card_styles ?>">
                                        <div class="ekit-feed-item--cover">
                                            <img src="<?php echo $item->images->normal ?>" alt="<?php echo $item->title ?>">
                                            <div class="ekit-feed-item--go-arrow">
                                                <a href="<?php echo $item->html_url ?>" target="_">
                                                    <!-- <i class="icon icon-right-arrow1"></i> -->
                                                    <?php
                                                        $migrated = isset( $settings['__fa4_migrated']['ekit_dribbble_feed_arrow_icons'] );
                                                        $is_new = empty( $ekit_dribbble_feed_arrow_icon );
                                                        if ( $is_new || $migrated ) :
                                                            \Elementor\Icons_Manager::render_icon( $ekit_dribbble_feed_arrow_icons, [ 'aria-hidden' => 'true'] );
                                                        else : ?>
                                                            <i class="<?php echo $ekit_dribbble_feed_arrow_icon; ?>" aria-hidden="true"></i>
                                                        <?php endif;
                                                    ?>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="ekit-feed-item--info">
                                            <?php if(
                                                $ekit_feed_card_styles == 'style3' || 
                                                $ekit_feed_card_styles == 'style4' ||
                                                $ekit_feed_card_styles == 'style5'
                                            ): ?>
                                            <div class="ekit-feed-item--title">
                                                <h4><?php echo $item->title ?></h4>
                                            </div>
                                            <?php endif ?>


                                            <?php 
                                                //$item->likes_count = '16K';
                                            ?>

                                            <!-- Start Feed item overview -->
                                            <?php if($ekit_feed_card_styles != 'style1' && (!empty($item->likes_count) || !empty($item->views_count) || !empty($item->comments_count))):?> 
                                                <div class="ekit-feed-item--overview">
                                                    <?php if(!empty($item->likes_count)):?>
                                                        <div class="likes">
                                                            <span><i class="icon icon-like1"></i> <?php echo $item->likes_count?></span>
                                                        </div>
                                                    <?php endif ?>
                                                    <?php if(!empty($item->views_count)):?>
                                                        <div class="views">
                                                            <span><i class="icon icon-eye"></i> <?php echo $item->views_count?></span>
                                                        </div>
                                                    <?php endif ?>
                                                    <?php if(!empty($item->comments_count)):?>
                                                        <div class="comments">
                                                            <span><i class="icon icon-comment2"></i> <?php echo $item->comments_count?></span>
                                                        </div>
                                                    <?php endif ?>
                                                </div>
                                            <?php endif ?>
                                            <!-- End Feed item overview -->

                                        </div>
                                    </div>
                                    <!-- End feed item -->
                                </div>
                            <?php endforeach ?>
                        </div>
                        <?php /* if(!empty($feed)): */ ?>
                            <!-- <div class="ekit-feed-items-load-more">
                                <a href="#" class="btn">Load More</a>
                            </div> -->
                        <?php /* endif */ ?>
                    </div>
                    <!-- End feed items -->
                </div>
                <!-- End Markup  -->
            <?php endif ;

			// echo '<pre>';
			// print_r($feed);
			// echo '</pre>';

		endif;

	}
}
