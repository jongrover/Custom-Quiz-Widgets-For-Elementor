<?php

// Load custom widgets_manager
require_once('my-custom-widgets.php');

if ( ! function_exists( 'AstraChild_enqueue_child_styles' ) ) {
	function AstraChild_enqueue_child_styles() {
	    // loading parent style
	    wp_register_style(
	      'parente2-style',
	      get_template_directory_uri() . '/style.css'
	    );

	    wp_enqueue_style( 'parente2-style' );
	    // loading child style
	    wp_register_style(
	      'childe2-style',
	      get_stylesheet_directory_uri() . '/style.css'
	    );
	    wp_enqueue_style( 'childe2-style');
	 }
}
add_action( 'wp_enqueue_scripts', 'AstraChild_enqueue_child_styles' );

if ( ! function_exists( 'AstraChild_enqueue_child_scripts' ) ) {
	function AstraChild_enqueue_child_scripts() {
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('lef-jquery-ui-touch-punch', get_stylesheet_directory_uri() . '/js/jqueryui-touch-punch.js', 'jquery-ui-core', null, true );
		wp_enqueue_script('lef-drag-drop', get_stylesheet_directory_uri() . '/js/drag-drop.js', 'jquery', null, true );
		wp_enqueue_script('lef-radio-menu', get_stylesheet_directory_uri() . '/js/radio-menu.js', 'jquery', null, true );
		wp_enqueue_script('lef-select-menu', get_stylesheet_directory_uri() . '/js/select-menu.js', 'jquery', null, true );
		wp_enqueue_script('lef-recorder', get_stylesheet_directory_uri() . '/js/recorder.js', 'jquery', null, true );
		wp_enqueue_script('lef-rec-playback', get_stylesheet_directory_uri() . '/js/rec-playback.js', 'jquery', null, true );
		wp_enqueue_script('lef-prev-next-buttons', get_stylesheet_directory_uri() . '/js/prev-next-buttons.js', 'jquery', null, true );
		wp_enqueue_script('lef-audio-playback', get_stylesheet_directory_uri() . '/js/audio-playback.js', 'jquery', null, true );
		wp_enqueue_script('lef-audio-playback-simple', get_stylesheet_directory_uri() . '/js/audio-playback-simple.js', 'jquery', null, true );
		wp_enqueue_script('lef-audio-playback-simple-2', get_stylesheet_directory_uri() . '/js/audio-playback-simple-2.js', 'jquery', null, true );
		wp_enqueue_script('lef-audio-playback-simple-3', get_stylesheet_directory_uri() . '/js/audio-playback-simple-3.js', 'jquery', null, true );
	}
}

add_action( 'wp_enqueue_scripts', 'AstraChild_enqueue_child_scripts' );

function AstraChild_enqueue_widget_styles() {
	wp_enqueue_style( 'widget-style', get_stylesheet_directory_uri() . '/css/widget-style.css',false,'1.1','all');
}

add_action( 'wp_enqueue_scripts', 'AstraChild_enqueue_widget_styles' );

// Social Icons Widget in the Header see /template-parts/header/social-widget-area.php

function AstraChild_social_widget_area_init() {
  register_sidebar( array(
    'name'          => __( 'Social Icons Header', 'childe2-style' ),
    'id'            => 'social-icons-widget',
    'description'   => __( 'Add widgets here to appear in the header at top right above the primary navigation.', 'AstraChild' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'AstraChild_social_widget_area_init' );
