<?php
/*
Plugin Name: Autoptimize Helper
Plugin URI: http://blog.futtta.be/autoptimize
Description: Autoptimize Helper contains some helper functions to make Autoptimize even more flexible
Author: Frank Goossens (futtta)
Version: 0.2
Author URI: http://blog.futtta.be/ 
*/

add_filter('autoptimize_filter_noptimize','disable_for_users');

function disable_for_users() {
	if ( is_user_logged_in() !==false ) {
		return true;
	} else {
		return false;
	}
}