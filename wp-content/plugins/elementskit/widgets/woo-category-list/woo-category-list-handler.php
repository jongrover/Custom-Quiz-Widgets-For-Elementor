<?php
namespace Elementor;


class ElementsKit_Widget_Woo_Category_List_Handler extends \ElementsKit_Lite\Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-woo-category-list';
    }

    static function get_title() {
        return esc_html__( 'Woo Category List', 'elementskit-lite' );
    }

    static function get_icon() {
        return 'ekit-widget-icon eicon-product-categories';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'woo-category-list/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'woo-category-list/';
    }
}