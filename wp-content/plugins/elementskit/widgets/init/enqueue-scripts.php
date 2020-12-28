<?php
namespace ElementsKit\Widgets\Init;

defined( 'ABSPATH' ) || exit;

class Enqueue_Scripts{

    public function __construct() {

        add_action( 'wp_enqueue_scripts', [$this, 'frontend_js']);
        add_action( 'wp_enqueue_scripts', [$this, 'frontend_css'], 99 );

        add_action( 'elementor/frontend/before_enqueue_scripts', [$this, 'elementor_js'] );

    }

    public function elementor_js() {
        wp_enqueue_script( 'elementskit-pro-elementor', \ElementsKit::widget_url() . 'init/assets/js/widget-scripts-pro.js',array( 'jquery', 'elementor-frontend' ), \ElementsKit::version(), true );
    }

    public function frontend_js() {
        if(is_admin()){
            return;
        }
        // your normal frontend js goes here

    }
    public function frontend_css() {
        if(!is_admin()){
            wp_enqueue_style( 'ekit-widget-styles-pro-2', \ElementsKit::widget_url() . 'init/assets/css/widget-styles-pro.css', false, \ElementsKit::version() );
        };
    }
}