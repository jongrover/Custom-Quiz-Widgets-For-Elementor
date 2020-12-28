<?php
namespace Elementor;

class ElementsKit_Widget_Motion_Text_Handler extends \ElementsKit_Lite\Core\Handler_Widget{

    static function get_name() {
		return 'elementskit-motion-text';
	}

	static function get_title() {
		return esc_html__( 'Motion Text', 'elementskit-lite' );
	}

	static function get_icon() {
		return 'eicon-animation-text ekit-widget-icon ';
	}

	static function get_categories() {
		return [ 'elementskit' ];
	}

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'motion-text/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'motion-text/';
    }
}