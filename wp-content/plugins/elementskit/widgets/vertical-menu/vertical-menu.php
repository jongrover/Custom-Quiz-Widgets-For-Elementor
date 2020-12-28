<?php

namespace Elementor;

use \Elementor\ElementsKit_Widget_Vertical_Menu_Handler as Handler;
use \ElementsKit_Lite\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class ElementsKit_Widget_Vertical_Menu extends Widget_Base {
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

    public function get_menus(){
        $list = [];
        $menus = wp_get_nav_menus();
        foreach($menus as $menu){
            $list[$menu->slug] = $menu->name;
        }

        return $list;
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'elementskit_vertical_menu_content_tab',
            [
                'label' => esc_html__('Vertical menu settings', 'elementskit-lite'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'elementskit_nav_menu',
            [
                'label'     =>esc_html__( 'Select menu', 'elementskit-lite' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $this->get_menus(),
            ]
		);
        
        $this->add_control(
			'elementskit_vertical_menu_badge_position',
			[
				'label' => __( 'Badge Position', 'elementskit-lite' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Right', 'elementskit-lite' ),
				'label_off' => __( 'Left', 'elementskit-lite' ),
				'return_value' => 'yes',
			]
        );
        
        $this->add_control(
			'elementskit_vertical_menu_show_toggle',
			[
				'label' => __( 'Toggle', 'elementskit-lite' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'elementskit-lite' ),
				'label_off' => __( 'Hide', 'elementskit-lite' ),
				'return_value' => 'yes',
			]
        );

        $this->add_control(
			'elementskit_vertical_menu_show_active_or_not',
			[
				'label' => __( 'Show Toggle Menu', 'elementskit-lite' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'elementskit-lite' ),
				'label_off' => __( 'Hide', 'elementskit-lite' ),
                'return_value' => 'yes',
                'condition' => [
                    'elementskit_vertical_menu_show_toggle' => 'yes'
                ]
			]
		);
        
        $this->add_control(
			'elementskit_vertical_menu_toggle_title',
			[
				'label' => __( 'Title', 'elementskit-lite' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'All Categories', 'elementskit-lite' ),
                'placeholder' => __( 'Type your title here', 'elementskit-lite' ),
                'condition' => [
                    'elementskit_vertical_menu_show_toggle' => 'yes'
                ]
			]
        );
        
        $this->start_controls_tabs(
            'elementskit_vertical_nav_menu_tabs',
            [
                'condition' => [
                    'elementskit_vertical_menu_show_toggle' => 'yes'
                ]
            ]
		);
			// right icon
			$this->start_controls_tab(
				'elementskit_vertical_nav_menu_right_icon_tab',
				[
					'label' => esc_html__( 'Icon Left', 'elementskit-lite' ),
				]
            );

            $this->add_control(
                'elementskit_vertical_menu_toggle_title_icon_right',
                [
                    'label' => __( 'Menu Icon Left', 'elementskit-lite' ),
                    'type' => Controls_Manager::ICONS,
                ]
            );
            
            $this->end_controls_tab();

            // left icon
			$this->start_controls_tab(
				'elementskit_vertical_nav_menu_left_icon_tab',
				[
					'label' => esc_html__( 'Icon Right', 'elementskit-lite' ),
				]
            );
            
            $this->add_control(
                'elementskit_vertical_menu_toggle_title_icon_left',
                [
                    'label' => __( 'Menu Icon Right', 'elementskit-lite' ),
                    'type' => Controls_Manager::ICONS,
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->add_control(
            'submenu_click_area',
            [
                'label'         => esc_html__('Submenu Click Area', 'elementskit'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__('Icon', 'elementskit'),
                'label_off'     => esc_html__('Text', 'elementskit'),
                'return_value'  => 'icon',
                'default'       => 'icon',
            ]
        );
		
        $this->end_controls_section();
		
        $this->insert_pro_message();
        
        // Toggle Button Style
        $this->start_controls_section(
			'elementskit_vertical_menu_toggle_style_tab',
			[
				'label' => __( 'Toggle Button', 'plugin-name' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'elementskit_vertical_menu_show_toggle' => 'yes'
                ]
			]
        );
        
        $this->start_controls_tabs(
            'elementskit_vertical_menu_toggle_style_control_tabs'
		);
			// Normal
			$this->start_controls_tab(
				'elementskit_vertical_menu_toggle_style_noraml_tab',
				[
					'label' => esc_html__( 'Normal', 'elementskit-lite' ),
				]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'ekit_vertical_menu_toggle_content_typography',
                    'label' => __( 'Typography', 'elementskit-lite' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .ekit-vertical-menu-tigger',
                ]
            );

            $this->add_control(
                'ekit_vertical_menu_toggle_title_color',
                [
                    'label' => __( 'Color', 'elementskit-lite' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ekit-vertical-menu-tigger' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'ekit_vertical_menu_toggle_background',
                    'label' => __( 'Background', 'elementskit-lite' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .ekit-vertical-menu-tigger',
                ]
            );

            $this->add_control(
                'ekit_vertical_menu_toggle_padding',
                [
                    'label' => __( 'Padding', 'elementskit-lite' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ekit-vertical-menu-tigger' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'ekit_vertical_menu_toggle_border_radius',
                [
                    'label' => __( 'Border Radius', 'elementskit-lite' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ekit-vertical-menu-tigger' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );    

            $this->end_controls_tab();

            // Active
			$this->start_controls_tab(
				'elementskit_vertical_menu_toggle_style_active_tab',
				[
					'label' => esc_html__( 'Active', 'elementskit-lite' ),
				]
            );
            
            $this->add_control(
                'ekit_vertical_menu_toggle_title_color_active',
                [
                    'label' => __( 'Color', 'elementskit-lite' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .vertical-menu-active .ekit-vertical-menu-tigger' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'ekit_vertical_menu_toggle_background_active',
                    'label' => __( 'Background', 'elementskit-lite' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .vertical-menu-active .ekit-vertical-menu-tigger',
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
        
        // Menu container
        $this->start_controls_section(
			'ekit_vertical_menu_container_style_tab',
			[
				'label' => __( 'Menu Container', 'plugin-name' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_vertical_menu_container_background',
				'label' => __( 'Background', 'elementskit-lite' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ekit-vertical-navbar-nav',
			]
        );
        
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ekit_vertical_menu_container_box_shadow',
				'label' => __( 'Box Shadow', 'elementskit-lite' ),
				'selector' => '{{WRAPPER}} .ekit-vertical-navbar-nav',
			]
        );
        
        $this->add_control(
			'ekit_vertical_menu_container_border_radius',
			[
				'label' => __( 'Border Radius', 'elementskit-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit-vertical-navbar-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
        
        // Menu items
        $this->start_controls_section(
			'ekit_vertical_menu_items_style_tab',
			[
				'label' => __( 'Menu Items', 'plugin-name' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->start_controls_tabs(
            'elementskit_vertical_menu_items_style_control_tabs'
		);
			// Normal
			$this->start_controls_tab(
				'elementskit_vertical_menu_items_style_noraml_tab',
				[
					'label' => esc_html__( 'Normal', 'elementskit-lite' ),
				]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'ekit_vertical_menu_items_content_typography',
                    'label' => __( 'Typography', 'elementskit-lite' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .ekit-vertical-navbar-nav>li>a',
                ]
            );

            $this->add_control(
                'ekit_vertical_menu_items_title_color',
                [
                    'label' => __( 'Color', 'elementskit-lite' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ekit-vertical-navbar-nav>li>a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'ekit_vertical_menu_items_padding',
                [
                    'label' => __( 'Padding', 'elementskit-lite' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ekit-vertical-navbar-nav>li>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_control(
                'ekit_vertical_menu_items_icon_padding',
                [
                    'label' => __( 'Icon Spacing', 'elementskit-lite' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ekit-vertical-navbar-nav>li>a .ekit-menu-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'ekit_vertical_menu_items_border',
                    'label' => __( 'Border', 'elementskit-lite' ),
                    'selector' => '{{WRAPPER}} .ekit-vertical-navbar-nav>li',
                ]
            );

            $this->end_controls_tab();

            // Hover
			$this->start_controls_tab(
				'elementskit_vertical_menu_items_style_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'elementskit-lite' ),
				]
            );
            
            $this->add_control(
                'ekit_vertical_menu_items_title_color_active',
                [
                    'label' => __( 'Color', 'elementskit-lite' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ekit-vertical-navbar-nav>li>a:hover' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .ekit-vertical-navbar-nav>li:hover>a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

		$this->end_controls_section();
        
        // Sub Menu items
        $this->start_controls_section(
			'ekit_vertical_sub_menu_items_style_tab',
			[
				'label' => __( 'Sub Menu Items', 'plugin-name' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->start_controls_tabs(
            'elementskit_vertical_sub_menu_items_style_control_tabs'
		);
			// Normal
			$this->start_controls_tab(
				'elementskit_vertical_sub_menu_items_style_noraml_tab',
				[
					'label' => esc_html__( 'Normal', 'elementskit-lite' ),
				]
            );

            $this->add_responsive_control(
                'ekit_vertical_sub_menu_container_width',
                [
                    'label' => esc_html__( 'Width', 'elementskit-lite' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 220,
                            'max' => 700,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ekit-vertical-navbar-nav .elementskit-dropdown' => 'max-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'ekit_vertical_sub_menu_items_content_typography',
                    'label' => __( 'Typography', 'elementskit-lite' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .ekit-vertical-navbar-nav .elementskit-dropdown>li>a',
                ]
            );

            $this->add_control(
                'ekit_vertical_sub_menu_items_title_color',
                [
                    'label' => __( 'Color', 'elementskit-lite' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ekit-vertical-navbar-nav .elementskit-dropdown>li>a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'ekit_vertical_sub_menu_items_padding',
                [
                    'label' => __( 'Padding', 'elementskit-lite' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ekit-vertical-navbar-nav .elementskit-dropdown>li>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'ekit_vertical_sub_menu_items_border',
                    'label' => __( 'Border', 'elementskit-lite' ),
                    'selector' => '{{WRAPPER}} .ekit-vertical-navbar-nav .elementskit-dropdown>li',
                ]
            );

            $this->end_controls_tab();

            // Hover
			$this->start_controls_tab(
				'elementskit_vertical_sub_menu_items_style_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'elementskit-lite' ),
				]
            );
            
            $this->add_control(
                'ekit_vertical_sub_menu_items_title_color_active',
                [
                    'label' => __( 'Color', 'elementskit-lite' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ekit-vertical-navbar-nav .elementskit-dropdown>li>a:hover' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .ekit-vertical-navbar-nav .elementskit-dropdown>li:hover>a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

		$this->end_controls_section();
    }

	protected function render( ) {
		$settings = $this->get_settings_for_display();
        echo '<div class="ekit-wid-con">';
            $this->render_raw();
        echo '</div>';
    }

    protected function vertical_menu_icon($props, $classname) {
        if ($props && $props['value'] !== '') {
            if ($props['library'] !== 'svg') { ?>
                <i class="<?php echo esc_attr($props['value'] .' '. $classname); ?> vertical-menu-icon"></i>
            <?php } else { ?>
                <img class="<?php echo esc_attr($classname); ?> vertical-menu-icon" src="<?php echo esc_url($props['value']['url']); ?>" alt="vertical menu icon">
            <?php }
        }
    }

    protected function render_raw( ) {
		$settings = $this->get_settings_for_display();
        extract($settings);

        if ($elementskit_nav_menu !== '') {
        ?>
        <div 
            class="ekit-vertical-main-menu-wraper <?php echo esc_attr($elementskit_vertical_menu_show_toggle == 'yes' ? 'ekit-vertical-main-menu-on-click' : '') ?> <?php echo esc_attr($elementskit_vertical_menu_show_active_or_not == 'yes' ? 'vertical-menu-active' : '') ?> <?php echo esc_attr($elementskit_vertical_menu_badge_position == 'yes' ? 'badge-position-right' : 'badge-position-left') ?>"
        >
            <?php if ($elementskit_vertical_menu_show_toggle == 'yes') { ?>
            <a href="#" class="ekit-vertical-menu-tigger">
                <?php $this->vertical_menu_icon($elementskit_vertical_menu_toggle_title_icon_right, 'vertical-menu-right-icon'); ?>
                <?php if ($elementskit_vertical_menu_toggle_title !== '') { ?>
                <span class="ekit-vertical-menu-tigger-title"><?php echo esc_html($elementskit_vertical_menu_toggle_title);?></span>
                <?php }; ?>
                <?php $this->vertical_menu_icon($elementskit_vertical_menu_toggle_title_icon_left, 'vertical-menu-left-icon'); ?>
            </a>
            <?php }; ?>
            <?php
                if($settings['elementskit_nav_menu'] != '' && wp_get_nav_menu_items($settings['elementskit_nav_menu']) !== false && count(wp_get_nav_menu_items($settings['elementskit_nav_menu'])) > 0){
                    $args = [
                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'container'       => 'div',
                        'container_id'    => 'ekit-vertical-megamenu',
                        'container_class' => 'ekit-vertical-menu-container',
                        'menu_id'         => 'vertical-main-menu',
                        'menu'         	  => $settings['elementskit_nav_menu'],
                        'menu_class'      => 'ekit-vertical-navbar-nav submenu-click-on-' . $settings['submenu_click_area'],
                        'depth'           => 4,
                        'echo'            => true,
                        'fallback_cb'     => 'wp_page_menu',
                        'walker'          => (class_exists('\ElementsKit_Lite\ElementsKit_Menu_Walker') ? new \ElementsKit_Lite\ElementsKit_Menu_Walker() : '' )
                    ];
        
                    wp_nav_menu($args);
                }
            ?>
        </div>
        <?php
        } else { ?>
        <div class="container">
            <div class="alert alert-danger" role="alert">
                <?php echo esc_html__('Please Select Menu', 'elementskit-lite'); ?>  
            </div>
        </div>
        <?php }
    }
    protected function _content_template() { }
}