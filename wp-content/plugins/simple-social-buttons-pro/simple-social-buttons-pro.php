<?php
/*
 * Plugin Name: Simple Social Buttons Pro
 * Plugin URI: https://wpbrigade.com/wordpress/plugins/simple-social-buttons-pro/
 * Description: This is the Simple Social Buttons Pro version and it adds premium functionality on the top of core version. Please install both to use the <code>COMPLETE</code> features of <code>Simple Social Buttons</code>
 * Version: 1.2.1
 * Author: WPBrigade
 * Author URI: http://www.WPBrigade.com/
 * Text Domain: simple-social-buttons-pro
 * Domain Path: /lang
 */


define( 'SSB_PRO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SSB_PRO_ROOT_PATH', __FILE__ );
define( 'SSB_PRO_VERSION', '1.2.1' );

add_action( 'plugins_loaded', 'ssb_pr_pro_instance', 20 );
register_activation_hook( __FILE__, 'plugin_install' );

/**
 * Making Pro instance.
 *
 * @since 1.0.0
 * @return void
 */
function ssb_pr_pro_instance() {

	// check for core version
	if ( ! file_exists( WP_PLUGIN_DIR . '/simple-social-buttons/simple-social-buttons.php' ) ) {
		add_action( 'admin_notices', 'ssb_install_free' );
		return;
	}

	if ( ! class_exists( 'SimpleSocialButtonsPR' ) ) {
		add_action( 'admin_notices', 'ssb_pr_active_free' );
		return;
	}

	include_once SSB_PRO_PLUGIN_DIR . '/classes/ssb-pro.php';

}


	/**
	 * Set default settings.
	 *
	 * @since 1.2.0
	 * @return void
	 */
function plugin_install() {

	if ( ! is_multisite() ) {

		ssb_pro_default_settings();

	} else {

		global $wpdb;
		$ssb_blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
		foreach ( $ssb_blog_ids as $blog_id ) {
			switch_to_blog( $blog_id );
			ssb_pro_default_settings();
			restore_current_blog();
		}
	}

}

/**
 * Plugin default settings.
 *
 * @version 1.2.0
 * @return void
 */
function ssb_pro_default_settings() {

	if ( ! get_option( 'ssb_flyin' ) ) {
		$_default = array(
			'time_interval' => '1440',
		);
		update_option( 'ssb_flyin', $_default );
	}

	if ( ! get_option( 'ssb_popup' ) ) {
		$_default = array(
			'time_interval' => '1440',
		);
		update_option( 'ssb_popup', $_default );
	}

	if ( ! get_option( 'ssb_click_to_tweet' ) ) {
		$_default = array(
			'theme'       => 'twitter-round',
			'include_via' => '1',
		);
		update_option( 'ssb_click_to_tweet', $_default );
	}
}

/**
 * Install free notice.
 *
 * @since 1.0.0
 * @return void
 */
function ssb_install_free() {

	$action = 'install-plugin';
	$slug   = 'simple-social-buttons';
	$link   = wp_nonce_url(
		add_query_arg(
			array(
				'action' => $action,
				'plugin' => $slug,
			),
			admin_url( 'update.php' )
		),
		$action . '_' . $slug
	);

	printf(
		'<div class="notice notice-warning">
	<p>%1$s<a href="%2$s" style="text-decoration:none">%3$s</a></p></div>',
		esc_html__( 'The following required plugin is not installed &mdash; ', 'simple-social-buttons-pro' ),
		$link,
		esc_html__( 'Install Simple Social Buttons Core (Free) now', 'simple-social-buttons-pro' )
	);
}

/**
 * Free activation notice if not installed.
 *
 * @since 1.0.0
 * @return void
 */
function ssb_pr_active_free() {
	$class   = 'notice notice-error is-dismissible';
	$message = __( 'Please activate Simple Social Buttons Core (Free) to use "Pro" add-on.', 'simple-social-buttons-pro' );

	printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
}

/**
 * Loadin pro text domain
 *
 * @since 1.0.0
 * @return void
 */
function ssb_pro_plugin_domian() {
	load_plugin_textdomain( 'simple-social-buttons-pro', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
}
add_action( 'plugins_loaded', 'ssb_pro_plugin_domian' );


