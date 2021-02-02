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
		wp_enqueue_script('audio-playback', get_stylesheet_directory_uri() . '/js/audio-playback.js', 'jquery', null, true );
	}
}

add_action( 'wp_enqueue_scripts', 'AstraChild_enqueue_child_scripts' );
