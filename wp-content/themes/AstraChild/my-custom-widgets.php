<?php

class My_Elementor_Widgets {

	protected static $instance = null;

	public static function get_instance() {
		if ( ! isset( static::$instance ) ) {
			static::$instance = new static;
		}

		return static::$instance;
	}

	protected function __construct() {
		require_once('widgets/question-select-menu.php');
		require_once('widgets/question-radio-menu.php');
		require_once('widgets/question-drag-drop.php');
		require_once('widgets/practice-rec-playback.php');
		require_once('widgets/prev-next-buttons.php');
		require_once('widgets/audio-playback.php');
		require_once('widgets/audio-playback-simple.php');
		require_once('widgets/audio-playback-simple-2.php');
		require_once('widgets/audio-playback-simple-3.php');
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}

	public function register_widgets() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Question_Select_Menu_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Question_Radio_Menu_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Question_Drag_Drop_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Practice_Rec_Playback_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Prev_Next_Buttons_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Audio_Playback_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Audio_Playback_Simple_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Audio_Playback_Simple_2_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Audio_Playback_Simple_3_Widget() );
	}

}

add_action( 'init', 'my_elementor_init' );
function my_elementor_init() {
	My_Elementor_Widgets::get_instance();
}
