<?php

wp_enqueue_script('jquery');
wp_enqueue_script('jquery-ui-core');
wp_enqueue_script('jquery-ui-sortable');

add_action('wp_footer', 'custom_widget_scripts');
function custom_widget_scripts(){
?>
	<script src="https://learnenglishfast.com/wp-content/themes/astra/js/jqueryui-touch-punch.js"></script>
	<script src="https://learnenglishfast.com/wp-content/themes/astra/js/drag-drop.js"></script>
	<script src="https://learnenglishfast.com/wp-content/themes/astra/js/radio-menu.js"></script>
	<script src="https://learnenglishfast.com/wp-content/themes/astra/js/select-menu.js"></script>
	<script src="https://learnenglishfast.com/wp-content/themes/astra/js/recorder.js"></script>
	<script src="https://learnenglishfast.com/wp-content/themes/astra/js/rec-playback.js"></script>
<?php
};

// Load custom widgets_manager
require_once('my-custom-widgets.php');

/*This file is part of AstraChild, astra child theme.

All functions of this file will be loaded before of parent theme functions.
Learn more at https://codex.wordpress.org/Child_Themes.

Note: this function loads the parent stylesheet before, then child theme stylesheet
(leave it in place unless you know what you are doing.)
*/

if ( ! function_exists( 'suffice_child_enqueue_child_styles' ) ) {
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

/*Write here your own functions */
