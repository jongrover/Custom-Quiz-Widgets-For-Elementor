<?php
namespace Elementor;

class Prev_Next_Buttons_Widget extends Widget_Base {

	public function get_name() {
		return 'prev-next-buttons';
	}

	public function get_title() {
		return 'Previous, Next Buttons';
	}

	public function get_icon() {
		return 'fa fa-arrow-circle-right';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Previous Next Button Controls', 'elementor' ),
			]
		);

		$menus = wp_get_nav_menus();
		$selectMenus = array();
		foreach($menus as $menu) {
			$menuId = $menu->term_id;
			$menuName = $menu->name;
			$selectMenus[$menuId] = $menuName;
		}

    $this->add_control(
			'menu',
			[
				'label' => __( 'Menu', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
        'options' => $selectMenus,
			]
		);

		// $activeMenu = $this->get_settings_for_display('menu');
		// $menuItems = wp_get_nav_menu_items($activeMenu);
		// $selectItems = array();
		// foreach($menuItems as $item) {
		// 	$itemId = $item->ID;
		// 	$itemTitle = $item->title;
		// 	$selectItems[$itemId] = $itemTitle;
		// }
		//
		// $this->add_control(
		// 	'page',
		// 	[
		// 		'label' => __( 'Select Current Page', 'elementor' ),
		// 		'label_block' => true,
		// 		'type' => Controls_Manager::SELECT,
		// 		'default' => '',
    //     'options' => $selectItems,
		// 	]
		// );

		$this->end_controls_section();
	}

	protected function render() {
    $settings = $this->get_settings_for_display();
		// $menuItems = wp_get_nav_menu_items($settings['menu']);
		// echo "<pre>".var_dump($menuItems)."</pre>";
    echo "<style>.prev-next-buttons-box{text-align:center}.prev-next-buttons-box a{width:120px;display:inline-block;text-align:center;margin:0;padding:10px;text-decoration:none;color:#000}.prev-next-buttons-box .prevButton{background:#26b7ee}.prev-next-buttons-box .nextButton{background:#1383e4}.prev-next-buttons-box a:hover{background:#ffcd3a}</style><div class='prev-next-buttons-box'><a class='prevButton' href='#'>Previous</a><a class='nextButton' href='#'>Next</a></div>";
  }

	protected function _content_template() {
  }

}
