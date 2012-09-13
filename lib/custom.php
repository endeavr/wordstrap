<?php

// Custom functions

if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }

   // WordStrap Theme Options
   	include_once locate_template('/admin/functions.php');
   // Include the options.php file directly in order to enable compatibility with the WordPress Front End Theme Customizer.
   	require_once locate_template('/admin/options.php');
   // Make the Theme Customizer more visible
   	add_action ('admin_menu', 'themedemo_admin');
   		function themedemo_admin() {
	   		// add the Customize link to the admin menu
	   		add_theme_page( 'Customize', 'Customize', 'edit_theme_options', 'customize.php' );
	   	}
	 
   // WP-LESS
     add_action('wp_enqueue_scripts', 'ws_wp_less');
     if ( ! function_exists( 'ws_wp_less' ) ):
     	function ws_wp_less() {
     		/* Load Bootstrap CSS */	     
     		require_once locate_template('/lib/wp-less/bootstrap-for-theme.php'); 
     	}
     endif;