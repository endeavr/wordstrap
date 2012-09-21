<?php
/*-----------------------------------------------------------------------------------*/
/* General Admin Functions
/*-----------------------------------------------------------------------------------*/

/**
 * Initialize anything needed for admin panel to run.
 *
 * @since 2.0.0
 */
 
function wordstrap_admin_init() {
	
	/*------------------------------------------------------*/
	/* Admin Modules
	/*------------------------------------------------------*/
	
	// Common Assets
	define( 'WORDSTRAP_ADMIN_ASSETS_URL', WS_FRAMEWORK_URL . '/admin/assets/' );
	define( 'WORDSTRAP_ADMIN_ASSETS_DIRECTORY', WS_FRAMEWORK_DIRECTORY . '/admin/assets/');
	
	// Options Framework
	define( 'WS_OPTIONS_FRAMEWORK_URL', WS_FRAMEWORK_URL . '/admin/modules/options/' );
	define( 'WS_OPTIONS_FRAMEWORK_DIRECTORY', WS_FRAMEWORK_DIRECTORY . '/admin/modules/options/');
	
	// Sliders Framework
	define( 'SLIDERS_FRAMEWORK_URL', WS_FRAMEWORK_URL . '/admin/modules/sliders/' );
	define( 'SLIDERS_FRAMEWORK_DIRECTORY', WS_FRAMEWORK_DIRECTORY . '/admin/modules/sliders/');
	
	// Builder Framework
	define( 'BUILDER_FRAMEWORK_URL', WS_FRAMEWORK_URL . '/admin/modules/builder/' );
	define( 'BUILDER_FRAMEWORK_DIRECTORY', WS_FRAMEWORK_DIRECTORY . '/admin/modules/builder/');
			
	// Sidebar Framework
	define( 'SIDEBARS_FRAMEWORK_URL', WS_FRAMEWORK_URL . '/admin/modules/sidebars/' );
	define( 'SIDEBARS_FRAMEWORK_DIRECTORY', WS_FRAMEWORK_DIRECTORY . '/admin/modules/sidebars/');
	
}

/**
 * Non-modular Admin Assets
 *
 * @since 2.0.0
 */

if( ! function_exists( 'wordstrap_non_modular_assets' ) ) {
	function wordstrap_non_modular_assets() {
		global $pagenow;
		if( $pagenow == 'post-new.php' || $pagenow == 'post.php' ) {
			wp_enqueue_style( 'ws_meta_box-styles', WORDSTRAP_ADMIN_ASSETS_DIRECTORY.'css/meta-box.css', false, false, 'screen' );
			wp_enqueue_script( 'ws_meta_box-scripts', WORDSTRAP_ADMIN_ASSETS_DIRECTORY . 'js/meta-box.min.js', array('jquery') );
		}
	}
}

/**
 * On activation of the theme, redirect user to the theme options
 * panel.
 *
 * @since 2.0.0
 */

if( ! function_exists( 'wordstrap_theme_activation' ) ) {
	function wordstrap_theme_activation(){
		global $pagenow;
		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) )
			header( 'Location: '.admin_url( 'themes.php?page=options-framework' ) );
	}
}

/**
 * Gather all assignments for posts into a single 
 * array organized by post ID.
 *
 * @since 2.0.0
 *
 * @param $posts array all posts from WP's get_posts()
 * @return $assignments array assignments from all posts organized by ID
 */

function wordstrap_get_assignment_conflicts( $posts ) {
	
	// Setup $conflicts/$non_conflicts arrays
	$non_conflicts = array();
	$conflicts = array();
	$locations = wordstrap_get_sidebar_locations();
	foreach( $locations as $location) {
		$conflicts[$location['location']['id']] = array();
		$non_conflicts[$location['location']['id']] = array();
	}

	// Loop through sidebar posts to construct two arrays side-by-side.
	// As we build the $non_conflicts arrays, we will be able to build
	// the $conflicts arrays off to the side by checking if items already
	// exist in the $non_conflicts.
	foreach( $posts as $post ) {
		
		// Determine location sidebar is assigned to.
		$location = get_post_meta( $post->ID, 'location', true );
		
		// Only run check if a location exists and this 
		// is not a floating widget area.
		if( $location && $location != 'floating' ) {
			$assignments = get_post_meta( $post->ID, 'assignments', true );
			if( is_array( $assignments ) && ! empty( $assignments ) ) {
				foreach( $assignments as $key => $assignmnet ) {
					if( in_array( $key, $non_conflicts[$location] ) ) {
						if( ! in_array( $key, $conflicts[$location] ) ) {
							$conflicts[$location][] = $key;
						}	
					} else {
						$non_conflicts[$location][] = $key;
					}
				}
			}
			
			
		}
	}
	return $conflicts;
}

/**
 * Hijack and modify default WP's "Page Attributes" 
 * meta box.
 *
 * @since 2.0.0
 */ 
 
function wordstrap_hijack_page_atts() {
	if( wordstrap_supports( 'meta', 'hijack_atts' ) ) {
		remove_meta_box( 'pageparentdiv', 'page', 'side' );
		add_meta_box( 'wordstrap_pageparentdiv', __( 'Page Attributes', WS_GETTEXT_DOMAIN ), 'wordstrap_page_attributes_meta_box', 'page', 'side', 'core' );
	}
}

/**
 * Saved data from Hi-jacked "Page Attributes"
 * meta box.
 *
 * @since 2.0.0
 */ 
 
function wordstrap_save_page_atts( $post_id ) {
	if( wordstrap_supports( 'meta', 'hijack_atts' ) ) {
		// Save sidebar layout
		if( isset( $_POST['_ws_sidebar_layout'] ) )
			update_post_meta( $post_id, '_ws_sidebar_layout', $_POST['_ws_sidebar_layout'] );
		// Save custom layout
		if( isset( $_POST['_ws_custom_layout'] ) )
			update_post_meta( $post_id, '_ws_custom_layout', $_POST['_ws_custom_layout'] );
	}
}