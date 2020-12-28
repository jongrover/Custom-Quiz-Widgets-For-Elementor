<?php
namespace Elementor;

use \Elementor\ElementsKit_Widget_Woo_Category_List_Handler as Handler;
use \ElementsKit_Lite\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

defined('ABSPATH') || exit;

class ElementsKit_Widget_Woo_Category_List extends Widget_Base {
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
			'ekit_section_filter',
			[
				'label' => esc_html__( 'Filter', 'elementskit-lite' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'ekit_source',
			[
				'label' => esc_html__( 'Filter by', 'metform' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'by_id',
				'options' => [
					''  => esc_html__( 'All', 'metform' ),
					'by_id'  => esc_html__( 'Manual Selection', 'metform' ),
					'by_parent' => esc_html__( 'By Parent', 'metform' ),
				],
			]
		);

		$this->add_control(
			'ekit_categories',
			[
                'label'   => esc_html__( 'Categories', 'elementskit-lite' ),
				'type'    => ElementsKit_Controls_Manager::AJAXSELECT2,
                'options' => 'ajaxselect2/product_cat',
                'label_block' => true,
                'multiple'  => true,
                'condition' => [
                    'ekit_source' => 'by_id',
                ],
			]
		);

		$this->add_control(
			'ekit_parent',
			[
                'label'   => esc_html__( 'Parent', 'elementskit-lite' ),
                'type'    => ElementsKit_Controls_Manager::AJAXSELECT2,
                'default'   => '0',
                'options' => 'ajaxselect2/product_cat',
                'label_block' => true,
                'multiple'  => false,
                'condition' => [
                    'ekit_source' => 'by_parent',
                ],                
			]
		);

		$this->add_control(
			'ekit_orderby',
			[
				'label'   => esc_html__( 'Order by', 'elementskit-lite' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'name',
				'options' => [
					'default'     => esc_html__( 'Default', 'elementskit-lite' ),
					'name'        => esc_html__( 'Name', 'elementskit-lite' ),
					'slug'        => esc_html__( 'Slug', 'elementskit-lite' ),
					'description' => esc_html__( 'Description', 'elementskit-lite' ),
					'count'       => esc_html__( 'Count', 'elementskit-lite' ),
				],
			]
		);

		$this->add_control(
			'ekit_order',
			[
				'label'   => esc_html__( 'Order', 'elementskit-lite' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc'  => esc_html__( 'ASC', 'elementskit-lite' ),
					'desc' => esc_html__( 'DESC', 'elementskit-lite' ),
				],
			]
		);

		$this->add_control(
			'ekit_wcl_hide_uncat_cat',
			[
				'label'        => __('Remove uncategorized category', 'plugin-domain'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'your-plugin'),
				'label_off'    => __('Hide', 'your-plugin'),
				'return_value' => 'yes',
				'default'      => '',
				'condition' => [
					'ekit_source' => '',
				],
			]
		);


		$this->add_control(
			'hide_empty_cat',
			[
				'label'   => esc_html__( 'Hide Empty Category', 'elementskit-lite' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ekit_section_woocommerce_layout',
			[
				'label' => esc_html__( 'Layout', 'elementskit-lite' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'ekit_product_description_position',
			[
				'label'   => esc_html__( 'Label Postion', 'elementskit-lite' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'inside',
				'options' => [
                    'inside' 	=> esc_html__('Inside Thumb', 'elementskit-lite'),
                    'outside' 	=> esc_html__('Outside Thumb', 'elementskit-lite'),
				],
			]
		);

		$this->add_control(
            'ekit_featured_cat',
            [
                'label' => esc_html__('Enable featured category?', 'elementskit-lite'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' =>esc_html__( 'Yes', 'elementskit-lite' ),
                'label_off' =>esc_html__( 'No', 'elementskit-lite' ),
            ]
		);
		
		$this->add_control(
            'ekit_featured_cat_image',
            [
                'label' => esc_html__( 'Choose Image', 'elementskit-lite' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'ekit_featured_cat' => 'yes'
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
		);

		$this->add_responsive_control(
			'ekit_columns',
			[
				'label'   => esc_html__( 'Columns', 'elementskit-lite' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				'default' => '3',
			]
		);


		$this->add_responsive_control(
			'ekit_item_gap',
			[
				'label'   => esc_html__( 'Item Gap', 'elementskit-lite' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 6,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					// '{{WRAPPER}} ul.products'                            => 'margin: -{{SIZE}}px -{{SIZE}}px 0',
					// '(desktop){{WRAPPER}} .products li.product-category' => 'width: calc( 100% / {{columns.SIZE}} ); border: {{SIZE}}px solid transparent',
					// '(tablet){{WRAPPER}} .products li.product-category'  => 'width: calc( 100% / 2 ); border: {{SIZE}}px solid transparent',
					// '(mobile){{WRAPPER}} .products li.product-category'  => 'width: calc( 100% / 1 ); border: {{SIZE}}px solid transparent',
					'{{WRAPPER}} .ekit-woo-category-list-container .woocommerce ul.products .product-category'        => 'padding: {{SIZE}}px',
				],
				'frontend_available' => true,
			]
		);


		$this->add_control(
			'ekit_number',
			[
				'label'   => esc_html__( 'Categories Count', 'elementskit-lite' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '4',
			]
		);

		$this->add_control(
			'ekit_show_title',
			[
				'label'   => esc_html__( 'Title', 'elementskit-lite' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'ekit_show_product_count',
			[
				'label'   => esc_html__( 'Product count', 'elementskit-lite' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ekit_section_style_item',
			[
				'label' => esc_html__( 'Item', 'elementskit-lite' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_item_style' );

		$this->start_controls_tab(
			'ekit_tab_item_normal',
			[
				'label' => esc_html__( 'Normal', 'elementskit-lite' ),
			]
		);

		$this->add_control(
			'ekit_item_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'elementskit-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce .product-category a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_item_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementskit-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .woocommerce .product-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'ekit_item_border',
				'label'     => esc_html__( 'Item Border', 'elementskit-lite' ),
				'selector'  => '{{WRAPPER}} .woocommerce .product-category a',
			]
		);

		$this->add_responsive_control(
			'ekit_item_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'elementskit-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .woocommerce .product-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ekit_item_box_shadow',
				'selector' => '{{WRAPPER}} .woocommerce .product-category a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ekit_tab_item_hover',
			[
				'label' => esc_html__( 'Hover', 'elementskit-lite' ),
			]
		);

		$this->add_control(
			'ekit_item_hover_background',
			[
				'label'     => esc_html__( 'Background Color', 'elementskit-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce .product-category a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ekit_item_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'elementskit-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce .product-category a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_item_hover_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'elementskit-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .woocommerce .product-category a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ekit_item_hover_shadow',
				'selector' => '{{WRAPPER}} .woocommerce .product-category a:hover',
			]
		);

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'ekit_section_style_image',
			[
				'label' => esc_html__( 'Image', 'elementskit-lite' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ekit_use_category_image_height_width',
			[
				'label' => esc_html__( 'Use Height Width', 'elementskit-lite' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementskit-lite' ),
				'label_off' => esc_html__( 'Hide', 'elementskit-lite' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_responsive_control(
			'ekit_woo_cat_image_height',
			[
				'label' => esc_html__( 'Height', 'elementskit-lite' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woocommerce .product-category a img' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ekit_use_category_image_height_width' => 'yes'
				]
			]
		);
		
		$this->add_responsive_control(
			'ekit_woo_cat_image_width',
			[
				'label' => esc_html__( 'Width', 'elementskit-lite' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woocommerce .product-category a img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ekit_use_category_image_height_width' => 'yes'
				]
			]
		);
		
		$this->start_controls_tabs( 'ekit_tabs_image_style' );

		$this->start_controls_tab(
			'ekit_tab_image_normal',
			[
				'label' => esc_html__( 'Normal', 'elementskit-lite' ),
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'ekit_image_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .woocommerce .product-category a img',
			]
		);

		$this->add_responsive_control(
			'ekit_image_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'elementskit-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .woocommerce .product-category a img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ekit_tab_image_hover',
			[
				'label' => esc_html__( 'Hover', 'elementskit-lite' ),
			]
		);

		$this->add_control(
			'ekit_image_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'elementskit-lite' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'ekit_image_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .woocommerce .product-category a:hover img' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_image_hover_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'elementskit-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .woocommerce .product-category a:hover img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'ekit_section_style_title',
			[
				'label' => esc_html__( 'Label', 'elementskit-lite' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ekit_section_label_height',
			[
				'label' => esc_html__( 'Height', 'elementskit-lite' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' 	=> 'px',
					'size'	=> 90
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woocommerce .product-category .woocommerce-loop-category__title' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_title_margin',
			[
				'label'      => esc_html__( 'Margin', 'elementskit-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .woocommerce .product-category .woocommerce-loop-category__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_title_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementskit-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .woocommerce .product-category .woocommerce-loop-category__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_title_align',
			[
				'label'   => esc_html__( 'Horizontal Alignment', 'elementskit-lite' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left'    => [
						'title' => esc_html__( 'Left', 'elementskit-lite' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementskit-lite' ),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementskit-lite' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'selectors' => [
					// '{{WRAPPER}} .woocommerce .product-category .woocommerce-loop-category__title' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_title_vertical_align',
			[
				'label' => esc_html__( 'Vertical Alignment', 'elementskit-lite' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => esc_html__( 'Top', 'elementskit-lite' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__( 'Middle', 'elementskit-lite' ),
						'icon' => 'fa fa-align-center',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'elementskit-lite' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'condition'	=> [
					'ekit_product_description_position'	=> 'inside'
				]
			]
		);

		$this->add_control(
            'ekit_section_style_cat_title',
            [
                'label' => esc_html__( 'Category Title:', 'elementskit-lite' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ekit_title_typography',
				'label'    => esc_html__( 'Typography', 'elementskit-lite' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .woocommerce .product-category .woocommerce-loop-category__title',
			]
		);

		$this->start_controls_tabs( 'ekit_tabs_title_style' );

		$this->start_controls_tab(
			'ekit_tab_title_normal',
			[
				'label' => esc_html__( 'Normal', 'elementskit-lite' ),
			]
		);

		$this->add_control(
			'ekit_title_color',
			[
				'label'     => esc_html__( 'Color', 'elementskit-lite' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .woocommerce .product-category .woocommerce-loop-category__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'		=> 'ekit_cat_title_bg_color',
				'selector'	=> '{{WRAPPER}} .woocommerce .product-category .woocommerce-loop-category__title'
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ekit_tab_title_hover',
			[
				'label' => esc_html__( 'Hover', 'elementskit-lite' ),
			]
		);

		$this->add_control(
			'ekit_hover_title_color',
			[
				'label'     => esc_html__( 'Color', 'elementskit-lite' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '#333',
				'selectors' => [
					'{{WRAPPER}} .woocommerce .product-category a:hover .woocommerce-loop-category__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'		=> 'ekit_cat_hover_title_bg_color',
				'default' => 'rgba(0, 0, 0, 0.5)',
				'selector'	=> '{{WRAPPER}} .woocommerce .product-category a:hover .woocommerce-loop-category__title'
			]
		);

		$this->end_controls_tab();
		
		$this->end_controls_tabs();

		// product count
		$this->add_control(
            'ekit_section_style_product_count',
            [
                'label' => esc_html__( 'Product Count:', 'elementskit-lite' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ekit_section_product_count_typography',
				'label'    => esc_html__( 'Typography', 'elementskit-lite' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .woocommerce .product-category .woocommerce-loop-category__title .count',
			]
		);

		$this->start_controls_tabs('ekit_section_product_count_tabs');
			$this->start_controls_tab(
				'ekit_section_product_count_tab_normal',
				[
					'label'	=> esc_html__('Normal', 'elementskit-lite')
				]
			);

			$this->add_control(
				'ekit_section_product_count_tab_normal_color',
				[
					'label'     => esc_html__( 'Color', 'elementskit-lite' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .woocommerce .product-category .woocommerce-loop-category__title .count' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'ekit_section_product_count_tab_hover',
				[
					'label'	=> esc_html__('Hover', 'elementskit-lite')
				]
			);

			$this->add_control(
				'ekit_section_product_count_tab_hover_color',
				[
					'label'     => esc_html__( 'Color', 'elementskit-lite' ),
					'type'      => Controls_Manager::COLOR,
					'default'	=> '#333',
					'selectors' => [
						'{{WRAPPER}} .woocommerce .product-category a:hover .woocommerce-loop-category__title .count' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Featured Cat
		$this->start_controls_section(
			'ekit_section_featured_cat',
			[
				'label' => esc_html__( 'Featured Category', 'elementskit-lite' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'	=> [
					'ekit_featured_cat' => 'yes'
				],
			]
		);

		$this->add_responsive_control(
			'ekit_section_featured_cat_width',
			[
				'label' => esc_html__( 'Width', 'elementskit-lite' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' 	=> '%',
					'size'	=> 50
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ekit-woo-category-list-container.ekit-woo-featured-cat-container .ekit-woo-featured-cat' => 'flex: 0 0 {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
            'ekit_section_style_featured_cat_label',
            [
                'label' => esc_html__( 'Label:', 'elementskit-lite' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'ekit_featured_cat_label_height',
			[
				'label' => esc_html__( 'Height', 'elementskit-lite' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' 	=> 'px',
					'size'	=> 90
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ekit-woo-featured-cat-container .ekit-woo-featured-cat .woocommerce .product-category .woocommerce-loop-category__title' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_featured_cat_title_margin',
			[
				'label'      => esc_html__( 'Margin', 'elementskit-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ekit-woo-featured-cat-container .ekit-woo-featured-cat .woocommerce .product-category .woocommerce-loop-category__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_featured_cat_title_padding',
			[
				'label'      => esc_html__( 'Padding', 'elementskit-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ekit-woo-featured-cat-container .ekit-woo-featured-cat .woocommerce .product-category .woocommerce-loop-category__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_featured_cat_title_align',
			[
				'label'   => esc_html__( 'Horizontal Alignment', 'elementskit-lite' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left'    => [
						'title' => esc_html__( 'Left', 'elementskit-lite' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementskit-lite' ),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementskit-lite' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'selectors' => [
					// '{{WRAPPER}} .woocommerce .product-category .woocommerce-loop-category__title' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_featured_cat_title_vertical_align',
			[
				'label' => esc_html__( 'Vertical Alignment', 'elementskit-lite' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => esc_html__( 'Top', 'elementskit-lite' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__( 'Middle', 'elementskit-lite' ),
						'icon' => 'fa fa-align-center',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'elementskit-lite' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'center',
				'toggle' => true,
			]
		);

		$this->add_control(
            'ekit_section_style_featured_cat_title',
            [
                'label' => esc_html__( 'Category Title:', 'elementskit-lite' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ekit_featured_cat_title_typography',
				'label'    => esc_html__( 'Typography', 'elementskit-lite' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .ekit-woo-featured-cat-container .ekit-woo-featured-cat .woocommerce .product-category .woocommerce-loop-category__title',
			]
		);

		$this->start_controls_tabs( 'ekit_featured_cat_tabs_title_style' );

		$this->start_controls_tab(
			'ekit_tab_featured_cat_title_normal',
			[
				'label' => esc_html__( 'Normal', 'elementskit-lite' ),
			]
		);

		$this->add_control(
			'ekit_featured_cat_title_color',
			[
				'label'     => esc_html__( 'Color', 'elementskit-lite' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ekit-woo-featured-cat-container .ekit-woo-featured-cat .woocommerce .product-category .woocommerce-loop-category__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'		=> 'ekit_featured_cat_title_bg_color',
				'selector'	=> '{{WRAPPER}} .ekit-woo-featured-cat-container .ekit-woo-featured-cat .woocommerce .product-category .woocommerce-loop-category__title'
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ekit_tab_featured_cat_title_hover',
			[
				'label' => esc_html__( 'Hover', 'elementskit-lite' ),
			]
		);

		$this->add_control(
			'ekit_featured_cat_hover_title_color',
			[
				'label'     => esc_html__( 'Color', 'elementskit-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ekit-woo-featured-cat-container .ekit-woo-featured-cat:hover .woocommerce .product-category .woocommerce-loop-category__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'		=> 'ekit_featured_cat_hover_title_bg_color',
				'default' => 'rgba(0, 0, 0, 0.5)',
				'selector'	=> '{{WRAPPER}} .ekit-woo-featured-cat-container .ekit-woo-featured-cat:hover .woocommerce .product-category .woocommerce-loop-category__title'
			]
		);

		$this->end_controls_tab();
		
		$this->end_controls_tabs();

		// product count
		$this->add_control(
            'ekit_section_style_featured_cat_product_count',
            [
                'label' => esc_html__( 'Product Count:', 'elementskit-lite' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ekit_featured_cat_product_count_typography',
				'label'    => esc_html__( 'Typography', 'elementskit-lite' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .ekit-woo-featured-cat-container .ekit-woo-featured-cat .woocommerce .product-category .woocommerce-loop-category__title .count',
			]
		);

		$this->start_controls_tabs('ekit_featured_cat_product_count_tabs');
			$this->start_controls_tab(
				'ekit_featured_cat_product_count_tab_normal',
				[
					'label'	=> esc_html__('Normal', 'elementskit-lite')
				]
			);

			$this->add_control(
				'ekit_featured_cat_product_count_tab_normal_color',
				[
					'label'     => esc_html__( 'Color', 'elementskit-lite' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ekit-woo-featured-cat-container .ekit-woo-featured-cat .woocommerce .product-category .woocommerce-loop-category__title .count' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'ekit_featured_cat_product_count_tab_hover',
				[
					'label'	=> esc_html__('Hover', 'elementskit-lite')
				]
			);

			$this->add_control(
				'ekit_featured_cat_product_count_tab_hover_color',
				[
					'label'     => esc_html__( 'Color', 'elementskit-lite' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ekit-woo-featured-cat-container .ekit-woo-featured-cat .woocommerce .product-category a:hover .woocommerce-loop-category__title .count' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->insert_pro_message();
	}

	public function render() {
		echo '<div class="ekit-wid-con" >';
			$this->render_raw();
        echo '</div>';
	}
	
	public function get_cat_info(){
		$settings = $this->get_settings();

		// featured cat settings
		$is_featured = $settings['ekit_featured_cat'];
		$featured_image = $settings['ekit_featured_cat_image'];
		// get shop link for all category
		$featured_link = class_exists( 'WooCommerce' ) ? get_permalink( wc_get_page_id( 'shop' ) ) : '';
		// get prodcut count for all category
		$posts = class_exists( 'WooCommerce' ) ? wp_count_posts( 'product' ) : '';
		$count_post = !empty($posts) ? $posts->publish : 0;

		$this->add_render_attribute(
			[
				'ekit-cat-list-columns' => [
					'class' => [
						'woocommerce',
						'ekit-cat-items',
						'columns-' . $settings['ekit_columns'],
						'ekit-cat-list-tablet-columns-'. $settings['ekit_columns_tablet'],
						'ekit-cat-list-mobile-columns-'. $settings['ekit_columns_mobile'],
					],
				],
			]
		);


		$exc_cat = '';

		if(!empty($settings['ekit_wcl_hide_uncat_cat'])) {

			$uncat = get_term_by( 'slug', 'uncategorized', 'product_cat' );

			if(!empty($uncat)) {

				$exc_cat = $uncat->term_id;
			}
		}

		$args = [
			'limit'      => '-1', // -1 for all, no limit
            'orderby'    => $settings['ekit_orderby'],
            'order'      => $settings['ekit_order'],
            'hide_empty' => $settings['hide_empty_cat'] == 'yes',
            'taxonomy'   => 'product_cat',
			'pad_counts' => true,
			'exclude' => $exc_cat,
        ];


		if($settings['ekit_orderby'] == 'default') {
			$args['meta_key'] = 'order';
			$args['orderby'] = 'meta_value_num';
		}


        if('by_id' == $settings['ekit_source']){
            $args['include'] = $settings['ekit_categories'];
        }elseif ('by_parent' == $settings['ekit_source']) {
			$args['parent'] = $settings['ekit_parent'];
		}else{
			$args['include'] = '';
		}

		$all_categories = get_categories( $args );
		
		// Featured cat content
		if($is_featured == 'yes') :	
			?>
				<a href="<?php echo ($featured_link) ? esc_url( $featured_link ) : ''; ?>" class="ekit-woo-featured-cat" style="background-image: url(<?php echo esc_url($featured_image && $featured_image['url'] ?  $featured_image['url']  : ''); ?>)">
					<div class="woocommerce">
						<ul class="products">
							<li class="product-category">
								<h2 class="woocommerce-loop-category__title"><?php esc_html_e('All Categories', 'elementskit-lite'); ?><mark class="count"><?php echo esc_html($count_post); ?> <?php echo esc_html__('Products', 'elementskit-lite')?></mark></h2>
							</li>
						</ul>
					</div>
				</a>
			<?php
		endif;
		// End Featured cat content

		echo '<div '. $this->get_render_attribute_string( 'ekit-cat-list-columns' ) .'>';
			echo '<ul class="products">';
			foreach ($all_categories as $cat) {
				$thumbnail_id   = get_term_meta( $cat->term_id, 'thumbnail_id', true );
				$raw_image = wp_get_attachment_url( $thumbnail_id );
				$demo_image = plugin_dir_url( __FILE__ ).'assets/image/woocommerce-placeholder-300x300.png';
				$image = ($raw_image != false) ? $raw_image : $demo_image;

				$product_count = $settings['ekit_show_product_count'] === 'yes' ? '<mark class="count">'.esc_html($cat->count." products").'</mark>' : '';
				$cat_name = $settings['ekit_show_title'] === 'yes' ? esc_html($cat->name) : '';
				$product_title = $settings['ekit_show_title'] === 'yes' && $settings['ekit_show_title'] === 'yes' ? '<span>'. $cat_name .'</span>' : '';

				$output = '<li class="product-category product"><a href="'. get_term_link($cat->slug, 'product_cat') .'"><img src="'.$image.'" alt="'. $cat->name .'"/><h2 class="woocommerce-loop-category__title">'. $product_title . $product_count .'</h2></a>';


				echo \ElementsKit_Lite\Utils::render($output);
			}
			echo '</ul>';
		echo '</div>';

	}

	private function render_raw() {
		$settings = $this->get_settings();
		// featured cat settings
		$is_featured = $settings['ekit_featured_cat'];
		$featuredCls = $is_featured == 'yes' ? 'ekit-woo-featured-cat-container' : '';

		$this->add_render_attribute(
			[
				'ekit-cat-list-alignment' => [
					'class' => [
						'ekit-woo-category-list-container',
						$featuredCls,
						// ekit-featured-cat-vertical-align
						'ekit-featured-cat-title-vertical-align-' . 		esc_attr( $settings['ekit_featured_cat_title_vertical_align'] ),
						'ekit-featured-cat-title-tablet-vertical-align-' . 	esc_attr( $settings['ekit_featured_cat_title_vertical_align_tablet'] ),
						'ekit-featured-cat-title-mobile-vertical-align-' . 	esc_attr( $settings['ekit_featured_cat_title_vertical_align_mobile'] ),

						// ekit-featured-cat-horizontal-align
						'ekit-featured-cat-title-align-'. 			esc_attr( $settings['ekit_featured_cat_title_align'] ),
						'ekit-featured-cat-title-tablet-align-' . 	esc_attr( $settings['ekit_featured_cat_title_align_tablet'] ),
						'ekit-featured-cat-title-mobile-align-' . 	esc_attr( $settings['ekit_featured_cat_title_align_mobile'] ),

						// ekit-featured-cat-horizontal-align
						'ekit-woo-category-list-align-'. 		esc_attr( $settings['ekit_title_align'] ),
						'ekit-woo-category-list-tablet-align-'. esc_attr( $settings['ekit_title_align_tablet'] ),
						'ekit-woo-category-list-mobile-align-'. esc_attr( $settings['ekit_title_align_mobile'] ),

						// ekit-featured-cat-vertical-align
						'ekit-woo-category-list-vertical-align-'. 			esc_attr( $settings['ekit_title_vertical_align'] ),
						'ekit-woo-category-list-tablet-vertical-align-'. 	esc_attr( $settings['ekit_title_vertical_align_tablet'] ),
						'ekit-woo-category-list-mobile-vertical-align-'. 	esc_attr( $settings['ekit_title_vertical_align_mobile'] ),

						// label position
						'ekit-wc-label-position-' . esc_attr($settings['ekit_product_description_position'])
					],
				],
			]
		);

		// end featured cat settings
		

		echo "<div " . $this->get_render_attribute_string( 'ekit-cat-list-alignment' ) . ">"; 
			$this->get_cat_info();
		echo "</div>";
	}

}