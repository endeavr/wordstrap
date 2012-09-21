<?php
/**
 * Setup all global vars for use with API functions.
 *
 * @since 2.1.0
 */

if( ! function_exists( 'wordstrap_api_init' ) ) { 
	function wordstrap_api_init() {
		
		global $_wordstrap_core_options;
		global $_wordstrap_core_elements;
		global $_wordstrap_customizer_sections;
		global $_wordstrap_registered_elements;
		global $_wordstrap_user_sample_layouts;
		global $_wordstrap_remove_sample_layouts;
		global $_wordstrap_user_sidebar_locations;
		global $_wordstrap_remove_sidebar_locations;
		global $_wordstrap_user_sliders;
		global $_wordstrap_user_stylesheets;
		global $_wordstrap_remove_stylesheets;
		
		// Options
		$_wordstrap_core_options = wordstrap_get_core_options(); // Filters must be applied before framework. 
		$_wordstrap_customizer_sections = array();
		
		// Core elements with options
		$_wordstrap_core_elements = wordstrap_get_core_elements(); // Filters must be applied before framework. 
		
		// Single dimensional array of elements
		$_wordstrap_registered_elements = array();
		foreach( $_wordstrap_core_elements as $element )
			$_wordstrap_registered_elements[] = $element['info']['id'];
		
		// Sample layouts
		$_wordstrap_user_sample_layouts = array();
		$_wordstrap_remove_sample_layouts = array();
		
		// Sidebars
		$_wordstrap_user_sidebar_locations = array();
		$_wordstrap_remove_sidebar_locations = array();
		
		// Sliders
		$_wordstrap_user_sliders = array();
		
		// User Stylesheets
		$_wordstrap_user_stylesheets = array(
			'1' => array(),	// Level 1: Before Framework styles
			'2' => array(),	// Level 2: After Framework styles
			'3' => array(),	// Level 3: After Theme styles
			'4' => array()	// Level 4: After Theme Options-generated styles
		);
		
		// Stylesheets to remove
		$_wordstrap_remove_stylesheets = array();
	}
}

/**
 * Setup the config array for which features the 
 * framework supports. This can easily be filtered, so the 
 * theme author has a chance to disable the framework's 
 * various features. The filter is this:
 *
 * wordstrap_global_config
 *
 * @since 2.0.0
 */

if( ! function_exists( 'wordstrap_setup' ) ) { 
	function wordstrap_setup() {
		$setup = array(
			'primary' => array(
				'sliders' 			=> true,			// Sliders
				'sidebars'			=> true,			// Custom sidebars
				'builder'			=> true				// Custom layouts
			),
			'admin' => array(
				'options'			=> true,			// Entire Admin presence
				'sliders' 			=> true,			// Sliders page
				'builder'			=> true,			// Layouts page
				'sidebars'			=> true				// Sidebars page
			),
			'meta' => array(
				'hijack_atts'		=> true,			// Hijack and modify "Page Attributes"
				'page_options'		=> true,			// Meta box for basic page options
				'post_options'		=> true				// Meta box for basic post options
			),
			'featured' => array(
				'archive'			=> false,			// Featured area on/off by default
				'blog'				=> false,			// Featured area on/off by default
				'grid'				=> false,			// Featured area on/off by default
				'page'				=> false,			// Featured area on/off by default
				'single'			=> false			// Featured area on/off by default
			),
			'featured_below' => array(
				'archive'			=> false,			// Featured area on/off by default
				'blog'				=> false,			// Featured area on/off by default
				'grid'				=> false,			// Featured area on/off by default
				'page'				=> false,			// Featured area on/off by default
				'single'			=> false			// Featured area on/off by default
			),
			'comments' => array(
				'pages'				=> false,			// Comments on pages
				'posts'				=> true,			// Commments on posts
			)
		);
		return apply_filters( 'wordstrap_global_config', $setup );
	}
}

/**
 * Test whether an feature is currently supported.
 *
 * @since 2.0.0
 *
 * @param string $group admin or frontend
 * @param string $feature feature key to check
 * @return boolean
 */

if( ! function_exists( 'wordstrap_supports' ) ) {  
	function wordstrap_supports( $group, $feature ) {
		$setup = wordstrap_setup();
		if( isset( $setup[$group][$feature] ) && $setup[$group][$feature] )
			return true;
		else
			return false;
	}
}

/**
 * Get capability for admin module so WordPress 
 * can test this against current user-role.
 *
 * @since 2.1.0
 *
 * @param string $module Module ID to check
 * @return boolean
 */

if( ! function_exists( 'wordstrap_admin_module_cap' ) ) {  
	function wordstrap_admin_module_cap( $module ) {
		// Setup default capabilities
		$module_caps = array(
			'builder' => 'edit_theme_options', 		// Role: Administrator
			'options' => 'edit_theme_options',		// Role: Administrator
			'sidebars' => 'edit_theme_options',		// Role: Administrator
			'sliders' => 'edit_theme_options'		// Role: Administrator
		);
		$module_caps = apply_filters( 'wordstrap_admin_module_caps', $module_caps );
		
		// Setup capability
		$cap = '';
		if( isset( $module_caps[$module] ) )
			$cap = $module_caps[$module];
		
		return $cap;
	}
}

/**
 * Compress a chunk of code to output.
 *
 * @since 2.0.0
 * 
 * @param string $buffer Text to compress
 * @param string $buffer Buffered text 
 */

if( ! function_exists( 'wordstrap_compress' ) ) {  
	function wordstrap_compress( $buffer ) {
		/* remove comments */
		$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
		/* remove tabs, spaces, newlines, etc. */
		$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
		return $buffer;
	}
}

/**
 * Register any post types used with framework.
 * 
 * @since 2.0.0
 */
if( ! function_exists( 'wordstrap_register_posts' ) ) {  
	function wordstrap_register_posts() {
		
		// Sliders
		if( wordstrap_supports( 'primary', 'sliders' ) ) {
			$args = array(
				'labels' 			=> array( 'name' => 'Sliders', 'singular_name' => 'Slider' ),
				'public'			=> false,
				//'show_ui' 		=> true,	// Can uncomment for debugging
				'query_var' 		=> true,
				'capability_type' 	=> 'post',
				'hierarchical' 		=> false,
				'rewrite' 			=> false,
				'supports' 			=> array( 'title', 'custom-fields', 'editor' ), // needs to support 'editor' for image to be inserted properly
				'can_export'		=> true
			);
			register_post_type( 'ws_slider', $args );
		}
		
		// Custom Sidebars
		if( wordstrap_supports( 'primary', 'sidebars' ) ) {
			$args = array(
				'labels' 			=> array( 'name' => 'Widget Areas', 'singular_name' => 'Widget Area' ),
				'public'			=> false,
				//'show_ui' 		=> true,	// Can uncomment for debugging
				'query_var' 		=> true,
				'capability_type' 	=> 'post',
				'hierarchical' 		=> false,
				'rewrite' 			=> false,
				'supports' 			=> array( 'title', 'custom-fields' ), 
				'can_export'		=> true
			);
			register_post_type( 'ws_sidebar', $args );
		}
		
		// Custom Layouts
		if( wordstrap_supports( 'primary', 'builder' ) ) {
			$args = array(
				'labels' 			=> array( 'name' => 'Layouts', 'singular_name' => 'Layout' ),
				'public'			=> false,
				//'show_ui' 		=> true,	// Can uncomment for debugging
				'query_var' 		=> true,
				'capability_type' 	=> 'post',
				'hierarchical' 		=> false,
				'rewrite' 			=> false,
				'supports' 			=> array( 'title', 'custom-fields' ), 
				'can_export'		=> true
			);
			register_post_type( 'ws_layout', $args );
		}
	}
}

/**
 * Retrieves a post id given a post's slug and post type.
 *
 * @since 2.0.0
 * @uses $wpdb
 *
 * @param string $slug slug of post
 * @param string $post_type post type for post.
 * @return string $id ID of post.
 */
if( ! function_exists( 'wordstrap_post_id_by_name' ) ) { 
	function wordstrap_post_id_by_name( $slug, $post_type ) {
		global $wpdb;
		$null = null;
		$slug = sanitize_title( $slug );
		
		// Grab posts from DB (hopefully there's only one!)
		$posts = $wpdb->get_results( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_name = %s AND (post_type = %s)", $slug, $post_type ));
		
		// If no results, return null
		if ( empty($posts) )
			return $null;
		
		// Run through our results and return the ID of the first. 
		// Hopefully there was only one result, but if there was 
		// more than one, we'll just return a single ID.
		foreach ( $posts as $post )
			if( $post->ID )
				return $post->ID;
		
		// If for some odd reason, there was no ID in the returned 
		// post ID's, return nothing.
		return $null;
	}
}

/**
 * Register theme's nav menus.
 *
 * @since 2.0.0
 */

if( ! function_exists( 'wordstrap_register_navs' ) ) { 
	function wordstrap_register_navs() {
		$menus = array(
			'primary' => __( 'Primary Navigation', WS_GETTEXT_DOMAIN ),
			'footer' => __( 'Footer Navigation', WS_GETTEXT_DOMAIN )
		);
		$menus = apply_filters( 'wordstrap_nav_menus', $menus );
		register_nav_menus( $menus );
	}
}

/**
 * Any occurances of WordPress's add_theme_support() happen here.
 * Can override function from Child Theme.
 *
 * @since 2.0.0
 */

if( ! function_exists( 'wordstrap_add_theme_support' ) ) {
	function wordstrap_add_theme_support() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
	}
}

/**
 * Add items to admin menu bar. This needs to be here in general 
 * functions because admin bar appears on frontend as well.
 *
 * @since 2.0.0
 */

if( ! function_exists( 'wordstrap_admin_menu_bar' ) ) {
	function wordstrap_admin_menu_bar() {
		global $wp_admin_bar;
		if( ! is_admin() ) {
			if( method_exists( $wp_admin_bar, 'add_menu' ) ) {
				
				// Theme Options
				if( wordstrap_supports( 'admin', 'options' ) ) {
					if( current_user_can( wordstrap_admin_module_cap( 'options' ) ) ) {	
						// Theme Options
						$wp_admin_bar->add_menu( 
							array(
								'id' => 'ws_theme_options',
								'title' => __( 'Theme Options', WS_GETTEXT_DOMAIN ),
								'parent' => 'site-name',
								'href' => admin_url( 'themes.php?page=options-framework')
							)
						);
					}
				}
				// Sidebars
				if( wordstrap_supports( 'admin', 'sidebars' ) ) {
					if( current_user_can( wordstrap_admin_module_cap( 'sidebars' ) ) ) {	
						$wp_admin_bar->add_menu( 
							array(
								'id' => 'ws_sidebars',
								'title' => __( 'Widget Areas', WS_GETTEXT_DOMAIN ),
								'parent' => 'site-name',
								'href' => admin_url( 'admin.php?page=sidebar_ws')
							)
						);
					}
				}
				// Sliders
				if( wordstrap_supports( 'admin', 'sliders' ) ) {
					if( current_user_can( wordstrap_admin_module_cap( 'sliders' ) ) ) {	
						$wp_admin_bar->add_menu( 
							array(
								'id' => 'ws_sliders',
								'title' => __( 'Sliders', WS_GETTEXT_DOMAIN ),
								'parent' => 'site-name',
								'href' => admin_url( 'admin.php?page=slider_ws')
							)
						);
					}
				}
				// Builder
				if( wordstrap_supports( 'admin', 'builder' ) ) {
					if( current_user_can( wordstrap_admin_module_cap( 'builder' ) ) ) {
						$wp_admin_bar->add_menu( 
							array(
								'id' => 'ws_builder',
								'title' => __( 'Builder', WS_GETTEXT_DOMAIN ),
								'parent' => 'site-name',
								'href' => admin_url( 'admin.php?page=builder_ws')
							)
						);
					}
				}
				
			} // end if method_exists()
		} // end if is_admin()
	}
}

/**
 * Get all sidebar layouts.
 *
 * @since 2.0.0
 *
 * @return array
 */

if( ! function_exists( 'wordstrap_sidebar_layouts' ) ) { 
	function wordstrap_sidebar_layouts() {
		$layouts = array(
			'full_width' => array(
				'name' 	=> 'Full Width',
				'id'	=> 'full_width'
			),
			'sidebar_right' => array(
				'name' 	=> 'Sidebar Right',
				'id'	=> 'sidebar_right'
			),
			'sidebar_left' => array(
				'name' 	=> 'Sidebar Left',
				'id'	=> 'sidebar_left'
			),
			'double_sidebar' => array(
				'name' 	=> 'Double Sidebar',
				'id'	=> 'double_sidebar'
			),
			'double_sidebar_left' => array(
				'name' 	=> 'Double Left Sidebars',
				'id'	=> 'double_sidebar_left'
			),
			'double_sidebar_right' => array(
				'name' 	=> 'Double Right Sidebars',
				'id'	=> 'double_sidebar_right'
			)
		);
		return apply_filters( 'wordstrap_sidebar_layouts', $layouts );
	}
}

/**
 * Get transparent textures
 *
 * @since 2.0.5
 *
 * @return array
 */

if( ! function_exists( 'wordstrap_get_textures' ) ) {  
	function wordstrap_get_textures() {
		$imagepath = get_template_directory_uri().'/framework/frontend/assets/images/textures/';
		$textures = array(
			'boxy' => array( 
				'name' 		=> __( 'Boxy', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'boxy.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'carbon_classic' => array( 
				'name' 		=> __( 'Carbon Classic', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'carbon_classic.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'carbon_diagonal' => array( 
				'name' 		=> __( 'Carbon Diagonol', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'carbon_diagonal.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'carbon_weave' => array( 
				'name' 		=> __( 'Carbon Weave', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'carbon_weave.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'chex' => array( 
				'name' 		=> __( 'Chex', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'chex.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'concrete' => array( 
				'name' 		=> __( 'Concrete', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'concrete.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'cross' => array( 
				'name' 		=> __( 'Crosses', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'cross.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'denim' => array( 
				'name' 		=> __( 'Denim', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'denim.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'diagnol_thin' => array( 
				'name' 		=> __( 'Diagonal (thin)', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'diagnol_thin.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'diagnol_thick' => array( 
				'name' 		=> __( 'Diagonal (thick)', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'diagnol_thick.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'diamonds' => array( 
				'name' 		=> __( 'Diamonds', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'diamonds.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'grid' => array( 
				'name' 		=> __( 'Grid', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'grid.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'grunge' => array( 
				'name' 		=> __( 'Grunge', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'grunge.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'honey_comb' => array( 
				'name' 		=> __( 'Honey Comb', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'honey_comb.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'leather' => array( 
				'name' 		=> __( 'Leather', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'leather.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'metal' => array( 
				'name' 		=> __( 'Metal', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'metal.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'mosaic' => array( 
				'name' 		=> __( 'Mosaic', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'mosaic.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'noise' => array( 
				'name' 		=> __( 'Noise', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'noise.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'paper' => array( 
				'name' 		=> __( 'Paper', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'paper.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'plaid' => array( 
				'name' 		=> __( 'Plaid', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'plaid.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'rubber' => array( 
				'name' 		=> __( 'Rubber', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'rubber.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'squares' => array( 
				'name' 		=> __( 'Squares', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'squares.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'textile' => array( 
				'name' 		=> __( 'Textile', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'textile.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'vertical_fabric' => array( 
				'name' 		=> __( 'Vertical Fabric', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'vertical_fabric.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'vintage' => array( 
				'name' 		=> __( 'Vintage', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'vintage.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'wood' => array( 
				'name' 		=> __( 'Wood', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'wood.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'wood_planks' => array( 
				'name' 		=> __( 'Wood Planks', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'wood_planks.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'divider' => array( 
				'name' 		=> __( '---------------', WS_GETTEXT_DOMAIN ),
				'url' 		=> null,
				'position' 	=> null,
				'repeat' 	=> null,
			),
			'boxy_light' => array( 
				'name' 		=> __( 'Light Boxy', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'boxy_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'carbon_classic_light' => array( 
				'name' 		=> __( 'Light Carbon Classic', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'carbon_classic_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'carbon_diagonal_light' => array( 
				'name' 		=> __( 'Light Carbon Diagonol', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'carbon_diagonal_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'carbon_weave_light' => array( 
				'name' 		=> __( 'Light Carbon Weave', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'carbon_weave_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'chex_light' => array( 
				'name' 		=> __( 'Light Chex', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'chex_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'concrete_light' => array( 
				'name' 		=> __( 'Light Concrete', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'concrete_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'cross_light' => array( 
				'name' 		=> __( 'Light Crosses', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'cross_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'denim_light' => array( 
				'name' 		=> __( 'Light Denim', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'denim_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'diagnol_thin_light' => array( 
				'name' 		=> __( 'Light Diagonal (thin)', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'diagnol_thin_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'diagnol_thick_light' => array( 
				'name' 		=> __( 'Light Diagonal (thick)', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'diagnol_thick_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'diamonds_light' => array( 
				'name' 		=> __( 'Light Diamonds', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'diamonds_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'grid_light' => array( 
				'name' 		=> __( 'Light Grid', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'grid_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'grunge_light' => array( 
				'name' 		=> __( 'Light Grunge', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'grunge_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'honey_comb_light' => array( 
				'name' 		=> __( 'Light Honey Comb', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'honey_comb_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'leather_light' => array( 
				'name' 		=> __( 'Light Leather', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'leather_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'metal_light' => array( 
				'name' 		=> __( 'Light Metal', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'metal_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'mosaic_light' => array( 
				'name' 		=> __( 'Light Mosaic', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'mosaic_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'noise_light' => array( 
				'name' 		=> __( 'Light Noise', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'noise_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'paper_light' => array( 
				'name' 		=> __( 'Light Paper', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'paper_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'plaid_light' => array( 
				'name' 		=> __( 'Light Plaid', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'plaid_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'rubber_light' => array( 
				'name' 		=> __( 'Light Rubber', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'rubber_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'squares_light' => array( 
				'name' 		=> __( 'Light Squares', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'squares_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'textile_light' => array( 
				'name' 		=> __( 'Light Textile', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'textile_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'vertical_fabric_light' => array( 
				'name' 		=> __( 'Light Vertical Fabric', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'vertical_fabric_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'vintage_light' => array( 
				'name' 		=> __( 'Light Vintage', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'vintage_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'wood_light' => array( 
				'name' 		=> __( 'Light Wood', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'wood_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			),
			'wood_planks_light' => array( 
				'name' 		=> __( 'Light Wood Planks', WS_GETTEXT_DOMAIN ),
				'url' 		=> $imagepath.'wood_planks_light.png',
				'position' 	=> '0 0',
				'repeat' 	=> 'repeat',
			)
	
		);
		return apply_filters( 'wordstrap_textures', $textures );
	}
}

/**
 * Generates array to be used in a select option 
 * type of the options framework.
 *
 * @since 2.0.0
 *
 * @param $type string type of select to return
 * @return $select array items for select
 */
 
function wordstrap_get_select( $type ) {
	$select = array();
	switch( $type ) {
		
		// Pages
		case 'pages' :
			$pages_select = array();
			$pages = get_pages();
			if( ! empty( $pages ) )
				foreach( $pages as $page )
					$select[$page->post_name] = $page->post_title;
			else
				$select['null'] = __( 'No pages exist.', WS_GETTEXT_DOMAIN );
			break;
		
		// Categories
		case 'categories' :
			$select['all'] = __( '<strong>All Categories</strong>', WS_GETTEXT_DOMAIN );
			$categories = get_categories();
			foreach( $categories as $category )
				$select[$category->slug] = $category->name;
			break;
		
		// Sliders	
		case 'sliders' : 
			$sliders = get_posts( 'post_type=ws_slider&numberposts=-1' );
			if( ! empty( $sliders ) )
				foreach( $sliders as $slider )
					$select[$slider->post_name] = $slider->post_title;
			else
				$select['null'] = __( 'You haven\'t created any custom sliders yet.', WS_GETTEXT_DOMAIN );
			break;
			
		// Floating Sidebars
		case 'sidebars' :
			$sidebars = get_posts('post_type=ws_sidebar&numberposts=-1');
			if( ! empty( $sidebars ) ) {
				foreach( $sidebars as $sidebar ) {
					$location = get_post_meta( $sidebar->ID, 'location', true );
					if( $location == 'floating' )
						$select[$sidebar->post_name] = $sidebar->post_title;
				}
			} // Handle error message for no sidebars outside of this function
			break;
		
	}
	return $select;
}

/**
 * All color classes.
 *
 * @since 2.0.0
 *
 * @return $colors array all colors in framework filtered
 */
 
function wordstrap_colors() {
	$colors = array(
		'default'		=> __( 'Default Color', WS_GETTEXT_DOMAIN ),
		'black' 		=> __( 'Black', WS_GETTEXT_DOMAIN ),
		'blue' 			=> __( 'Blue', WS_GETTEXT_DOMAIN ),
		'brown' 		=> __( 'Brown', WS_GETTEXT_DOMAIN ),
		'dark_blue'		=> __( 'Dark Blue', WS_GETTEXT_DOMAIN ),
		'dark_brown' 	=> __( 'Dark Brown', WS_GETTEXT_DOMAIN ),
		'dark_green' 	=> __( 'Dark Green', WS_GETTEXT_DOMAIN ),
		'green' 		=> __( 'Green', WS_GETTEXT_DOMAIN ),
		'mauve' 		=> __( 'Mauve', WS_GETTEXT_DOMAIN ),
		'orange'		=> __( 'Orange', WS_GETTEXT_DOMAIN ),
		'pearl'			=> __( 'Pearl', WS_GETTEXT_DOMAIN ),
		'pink'			=> __( 'Pink', WS_GETTEXT_DOMAIN ),
		'purple'		=> __( 'Purple', WS_GETTEXT_DOMAIN ),
		'red'			=> __( 'Red', WS_GETTEXT_DOMAIN ),
		'slate_grey'	=> __( 'Slate Grey', WS_GETTEXT_DOMAIN ),
		'silver'		=> __( 'Silver', WS_GETTEXT_DOMAIN ),
		'steel_blue'	=> __( 'Steel Blue', WS_GETTEXT_DOMAIN ),
		'teal'			=> __( 'Teal', WS_GETTEXT_DOMAIN ),
		'yellow'		=> __( 'Yellow', WS_GETTEXT_DOMAIN ),
		'wheat'			=> __( 'Wheat', WS_GETTEXT_DOMAIN ),
		'white'			=> __( 'White', WS_GETTEXT_DOMAIN )
	);
	return apply_filters( 'wordstrap_colors', $colors );
}

/**
 * Stats
 *
 * @since 2.1.0
 */

function wordstrap_stats() {
	// API Key
	$api_key = 'y0zr2c64abc1qvebamzpnk4m3izccxpxxlfh';
	// Start of Metrics
	global $wpdb;
	$data = get_transient( 'presstrends_data' );
	if( ! $data || $data == '' ){
		$api_base = 'http://api.presstrends.io/index.php/api/sites/update/api/';
		$url = $api_base . $api_key . '/';
		// Theme Data (by Jason)
		$data = array();
		if( function_exists( 'wp_get_theme' ) ) {
			// Use wp_get_theme for WP 3.4+
			$theme_data = wp_get_theme( get_template() );
			$data['theme_name'] = str_replace( ' ', '', $theme_data->get('Name') ); // remove spaces to fix presstrend's bug
			$data['theme_version'] = str_replace( ' ', '', $theme_data->get('Version') ); // remove spaces to fix presstrend's bug		
		} else {
			// Deprecated theme data retrieval
			$theme_data = get_theme_data( get_template_directory() . '/style.css' );
			$data['theme_version'] = str_replace( ' ', '', $theme_data['Version'] ); // remove spaces to fix presstrend's bug
			$data['theme_name'] = str_replace( ' ', '', $theme_data['Name'] ); // remove spaces to fix presstrend's bug
		} 
		// Continue on ...
		$count_posts = wp_count_posts();
		$count_pages = wp_count_posts('page');
		$comments_count = wp_count_comments();
		//$theme_data = get_theme_data(get_stylesheet_directory() . '/style.css');
		$plugin_count = count(get_option('active_plugins'));
		$all_plugins = get_plugins();
		$plugin_name = ''; // (added by Jason)
		foreach( $all_plugins as $plugin_file => $plugin_data ){
			$plugin_name .= $plugin_data['Name'];
			$plugin_name .= '&';
		}
		$posts_with_comments = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}posts WHERE post_type='post' AND comment_count > 0");
		if( $count_posts->publish > 0  ) // fix by Jason
			$comments_to_posts = number_format(($posts_with_comments / $count_posts->publish) * 100, 0, '.', '');
		$pingback_result = $wpdb->get_var('SELECT COUNT(comment_ID) FROM '.$wpdb->comments.' WHERE comment_type = "pingback"');
		$data['url'] = stripslashes(str_replace(array('http://', '/', ':' ), '', site_url()));
		$data['posts'] = $count_posts->publish;
		$data['pages'] = $count_pages->publish;
		$data['comments'] = $comments_count->total_comments;
		$data['approved'] = $comments_count->approved;
		$data['spam'] = $comments_count->spam;
		$data['pingbacks'] = $pingback_result;
		$data['post_conversion'] = $comments_to_posts;
		//$data['theme_version'] = $theme_data['Version'];
		//$data['theme_name'] = $theme_data['Name'];
		$data['site_name'] = str_replace( ' ', '', get_bloginfo( 'name' ));
		$data['plugins'] = $plugin_count;
		$data['plugin'] = urlencode($plugin_name);
		$data['wpversion'] = get_bloginfo('version');
		foreach ( $data as $k => $v ) {
			$url .= $k . '/' . $v . '/';
		}
		// Manually set theme name to avoid confusion with feed
		if( defined( 'WS_THEME_NAME' ) )
			$data['theme_name'] = WS_THEME_NAME;
		// Send response and set transient
		$response = wp_remote_get( $url );
		set_transient('presstrends_data', $data, 60*60*24); // 1 day transient
	}
}

/**
 * Add custom stylesheet
 *
 * @since 2.1.0
 * 
 * @param string $handle ID for this stylesheet
 * @param string $src URL to stylesheet
 * @param int $level Level determines where stylesheet gets placed - 1, 2, 3, 4
 * @param string $ver Version of stylesheet
 * @param string $media Type of media target for stylesheet
 */

if( ! function_exists( 'wordstrap_add_stylesheet' ) ) {
	function wordstrap_add_stylesheet( $handle, $src, $level = 4, $ver = null, $media = 'all' ) {
		if( ! is_admin() ) {
			global $_wordstrap_user_stylesheets;
			$_wordstrap_user_stylesheets[$level][] = array(
				'handle' 	=> $handle,
				'src' 		=> $src,
				'level' 	=> $level,
				'ver' 		=> $ver,
				'media' 	=> $media
			);
		}		
	}
}

/**
 * Remove custom stylesheet
 *
 * @since 2.1.0
 * 
 * @param string $handle ID for this stylesheet
 */

if( ! function_exists( 'wordstrap_remove_stylesheet' ) ) {
	function wordstrap_remove_stylesheet( $handle ) {
		if( ! is_admin() ) {
			global $_wordstrap_remove_stylesheets;
			$_wordstrap_remove_stylesheets[] = $handle;
		}		
	}
}

/**
 * Remove all stylesheets that have been appplied 
 * to $_wordstrap_remove_stylesheets. This gets 
 * hooked into "wp_print_styles".
 *
 * @since 2.1.0
 * 
 * @param string $handle ID for this stylesheet
 */

if( ! function_exists( 'wordstrap_deregister_stylesheets' ) ) {
	function wordstrap_deregister_stylesheets( $handle ) {
		global $_wordstrap_remove_stylesheets;
		if( $_wordstrap_remove_stylesheets )
			foreach( $_wordstrap_remove_stylesheets as $handle )
				wp_deregister_style( $handle );
	}
}

/**
 * Register Image Sizes
 *
 * @since 2.1.0
 */

if( ! function_exists( 'wordstrap_add_image_sizes' ) ) {
	function wordstrap_add_image_sizes() {
		
		// Content Width
		$content_width = apply_filters( 'wordstrap_content_width', 940 ); // Default width of primary content area
		
		// Crop sizes
		$sizes = array(
			'ws_large' => array(
				'width' 	=> $content_width,	// 940 => Full width thumb for 1-col page
				'height' 	=> 9999,
				'crop' 		=> false
			),
			'ws_medium' => array(
				'width' 	=> 620, 			// 620 => Full width thumb for 2-col/3-col page
				'height'	=> 9999,
				'crop' 		=> false
			),
			'ws_small' => array(
				'width' 	=> 195,				// Square'ish thumb floated left
				'height' 	=> 195,
				'crop' 		=> false
			),
			'square_small' => array(
				'width' 	=> 130,				// Square small thumbnail
				'height' 	=> 130,
				'crop' 		=> true
			),
			'square_smaller' => array(
				'width' 	=> 70,				// Square smaller thumbnail
				'height' 	=> 70,
				'crop' 		=> true
			),
			'square_smallest' => array(
				'width' 	=> 45,				// Square smallest thumbnail
				'height' 	=> 45,
				'crop' 		=> true
			),
			'slider-large' => array(
				'width' 	=> 940,				// Slider full-size image
				'height' 	=> 350,
				'crop' 		=> true
			),
			'slider-staged' => array(
				'width' 	=> 550,				// Slider staged image
				'height' 	=> 340,
				'crop' 		=> true
			),
			'grid_fifth_1' => array(
				'width' 	=> 200,				// 1/5 Column
				'height' 	=> 125,
				'crop' 		=> true
			),
			'grid_3' => array(
				'width' 	=> 240,				// 1/4 Column
				'height' 	=> 150,
				'crop' 		=> true
			),
			'grid_4' => array(
				'width' 	=> 320,				// 1/3 Column
				'height' 	=> 200,
				'crop' 		=> true
			),
			'grid_6' => array(
				'width' 	=> 472,				// 1/2 Column
				'height' 	=> 295,
				'crop' 		=> true
			)
		);
		$sizes = apply_filters( 'wordstrap_image_sizes', $sizes );
		
		// Add image sizes
		foreach( $sizes as $size => $atts )
			add_image_size( $size, $atts['width'], $atts['height'], $atts['crop'] );
	}
}

/**
 * Show theme's image thumb sizes when inserting 
 * an image in a post or page.
 *
 * This function gets added as a filter to WP's 
 * image_size_names_choose
 *
 * @since 2.1.0
 */

if( ! function_exists( 'wordstrap_image_size_names_choose' ) ) {
	function wordstrap_image_size_names_choose( $sizes ) {
		$wordstrap_sizes = array(
			'ws_small' 		=> 'TB Small',
			'ws_medium' 	=> 'TB Medium',
			'ws_large' 		=> 'TB Large',
			'slider-large' 	=> 'Slider Full Width',
			'slider-staged' => 'Slider Staged',
			'grid_fifth_1' 	=> '1/5 Column of Grid',
			'grid_3' 		=> '1/4 Column of Grid',
			'grid_4' 		=> '1/3 Column of Grid',
			'grid_6' 		=> '1/2 Column of Grid'
		);
		$wordstrap_sizes = apply_filters( 'wordstrap_choose_sizes', $wordstrap_sizes );
		return array_merge( $sizes, $wordstrap_sizes );
	}
}

/**
 * Set allowed tags in the admin panel. This works by 
 * adding the framework's allowed admin tags to WP's 
 * global $allowedtags.
 *
 * @since 2.0.0
 * Note: Moved to /framework/api/helpers.php in v2.1.0
 *
 * @param $type string type of field 'text' or 'textarea'
 */

function wordstrap_allowed_tags( $extended = false ) {
	
	global $allowedtags;
	$tags = $allowedtags;
	
	// Tags to add
	$addons = array(
		'a' => array(
			'href' => array(),
			'title' => array(),
			'class' => array(),
			'id'	=> array(),
			'style' => array(),
			'rel' => array(),
			'target' => array()
		),
		'img' => array(
			'alt' => array(),
			'title' => array(),
			'src' => array(),
			'class' => array(),
			'id'	=> array(),
			'style' => array()
		),
		'br' => array()
	);
	$addons = apply_filters( 'wordstrap_allowed_tags_basic', $addons );
	
	// Add in extended HTML tags
	if( $extended ) {
		$extended_addons = array(
			'h1' => array(
				'class' => array(),
				'id'	=> array(),
				'style' => array()
			),
			'h2' => array(
				'class' => array(),
				'id'	=> array(),
				'style' => array()
			),
			'h3' => array(
				'class' => array(),
				'id'	=> array(),
				'style' => array()
			),
			'h4' => array(
				'class' => array(),
				'id'	=> array(),
				'style' => array()
			),
			'h5' => array(
				'class' => array(),
				'id'	=> array(),
				'style' => array()
			),
			'h6' => array(
				'class' => array(),
				'id'	=> array(),
				'style' => array()
			),
			'script' => array(
				'type' => array(),
				'src' => array()
			),
			'div' => array(
				'class' => array(),
				'id'	=> array(),
				'style' => array()
			),
			'p' => array(
				'class' => array(),
				'id'	=> array(),
				'style' => array()
			),
			'ul' => array(
				'class' => array(),
				'id'	=> array(),
				'style' => array()
			),
			'li' => array(
				'class' => array(),
				'id'	=> array(),
				'style' => array()
			),
			'iframe' => array(
				'style' => array(),
				'width' => array(),
				'height' => array(),
				'src' => array(),
				'frameborder' => array(),
				'allowfullscreen' => array(),
				'webkitAllowFullScreen' => array(),
				'mozallowfullscreen' => array()
			)
		);
		$extended_addons = apply_filters( 'wordstrap_allowed_tags_extended', $extended_addons );
		$addons = array_merge( $addons, $extended_addons );
	}
	
	// Add the addons to the final array
	$tags = array_merge( $tags, $addons );
	
	return apply_filters( 'wordstrap_allowed_tags', $tags );
	
}

/**
 * Generates default column widths for column element.
 *
 * @since 2.0.0
 * Note: Moved to /framework/api/helpers.php in v2.1.0
 */

function wordstrap_column_widths() {
	$widths = array (
		'1-col' => array (					// User selects 1 columns
			array(
				'name' 	=> '100%',
				'value' => 'grid_12',
			)
		),
		'2-col' => array (					// User selects 2 columns
			array(
				'name' 	=> '20% | 80%',
				'value' => 'grid_fifth_1-grid_fifth_4',
			),
			array(
				'name' 	=> '25% | 75%',
				'value' => 'grid_3-grid_9',
			),
			array(
				'name' 	=> '30% | 70%',
				'value' => 'grid_tenth_3-grid_tenth_7',
			),
			array(
				'name' 	=> '33% | 66%',
				'value' => 'grid_4-grid_8',
			),
			array(
				'name' 	=> '50% | 50%',
				'value' => 'grid_6-grid_6',
			),
			array(
				'name' 	=> '66% | 33%',
				'value' => 'grid_8-grid_4',
			),
			array(
				'name' 	=> '70% | 30%',
				'value' => 'grid_tenth_7-grid_tenth_3',
			),
			array(
				'name' 	=> '75% | 25%',
				'value' => 'grid_9-grid_3',
			),
			array(
				'name' 	=> '80% | 20%',
				'value' => 'grid_fifth_4-grid_fifth_1',
			)
		),
		'3-col' => array (					// User selects 3 columns
			array(
				'name' 	=> '33% | 33% | 33%',
				'value' => 'grid_4-grid_4-grid_4',
			),
			array(
				'name' 	=> '25% | 25% | 50%',
				'value' => 'grid_3-grid_3-grid_6',
			),
			array(
				'name' 	=> '25% | 50% | 25%',
				'value' => 'grid_3-grid_6-grid_3',
			),
			array(
				'name' 	=> '50% | 25% | 25% ',
				'value' => 'grid_6-grid_3-grid_3',
			),
			array(
				'name' 	=> '20% | 20% | 60%',
				'value' => 'grid_fifth_1-grid_fifth_1-grid_fifth_3',
			),
			array(
				'name' 	=> '20% | 60% | 20%',
				'value' => 'grid_fifth_1-grid_fifth_3-grid_fifth_1',
			),
			array(
				'name' 	=> '60% | 20% | 20%',
				'value' => 'grid_fifth_3-grid_fifth_1-grid_fifth_1',
			),
			array(
				'name' 	=> '40% | 40% | 20%',
				'value' => 'grid_fifth_2-grid_fifth_2-grid_fifth_1',
			),
			array(
				'name' 	=> '40% | 20% | 40%',
				'value' => 'grid_fifth_2-grid_fifth_1-grid_fifth_2',
			),
			array(
				'name' 	=> '20% | 40% | 40%',
				'value' => 'grid_fifth_1-grid_fifth_2-grid_fifth_2',
			),
			array(
				'name' 	=> '30% | 30% | 40%',
				'value' => 'grid_tenth_3-grid_tenth_3-grid_fifth_2',
			),
			array(
				'name' 	=> '30% | 40% | 30%',
				'value' => 'grid_tenth_3-grid_fifth_2-grid_tenth_3',
			),
			array(
				'name' 	=> '40% | 30% | 30%',
				'value' => 'grid_fifth_2-grid_tenth_3-grid_tenth_3',
			)
		),
		'4-col' => array (					// User selects 4 columns
			array(
				'name' 	=> '25% | 25% | 25% | 25%',
				'value' => 'grid_3-grid_3-grid_3-grid_3',
			),
			array(
				'name' 	=> '20% | 20% | 20% | 40%',
				'value' => 'grid_fifth_1-grid_fifth_1-grid_fifth_1-grid_fifth_2',
			),
			array(
				'name' 	=> '20% | 20% | 40% | 20%',
				'value' => 'grid_fifth_1-grid_fifth_1-grid_fifth_2-grid_fifth_1',
			),
			array(
				'name' 	=> '20% | 40% | 20% | 20%',
				'value' => 'grid_fifth_1-grid_fifth_2-grid_fifth_1-grid_fifth_1',
			),
			array(
				'name' 	=> '40% | 20% | 20% | 20%',
				'value' => 'grid_fifth_2-grid_fifth_1-grid_fifth_1-grid_fifth_1',
			)
		),
		'5-col' => array (						// User selects 5 columns
			array(
				'name' 	=> '20% | 20% | 20% | 20% | 20%',
				'value' => 'grid_fifth_1-grid_fifth_1-grid_fifth_1-grid_fifth_1-grid_fifth_1',
			)
		)
	);
	return apply_filters( 'wordstrap_column_widths', $widths );
}

/**
 * Setup all possible assignments (i.e. WordPress conditionals) 
 * that could be assigned to an item. An example where this is 
 * currently used is to assign custom sidebars to various WP 
 * conditionals.
 *
 * @since 2.0.0
 * Note: Moved to /framework/api/helpers.php in v2.1.0
 */
 
function wordstrap_conditionals_config() {
	$conditionals = array(
		'pages' => array(
			'id'	=> 'pages',
			'name'	=> __( 'Pages', WS_GETTEXT_DOMAIN ),
			'empty'	=> __( 'No pages to display.', WS_GETTEXT_DOMAIN )
		),
		'posts' => array(
			'id'	=> 'posts',
			'name'	=> __( 'Posts', WS_GETTEXT_DOMAIN ),
			'empty'	=> __( 'No posts to display.', WS_GETTEXT_DOMAIN )
		),
		'posts_in_category' => array(
			'id'	=> 'posts_in_category',
			'name'	=> __( 'Posts in Category', WS_GETTEXT_DOMAIN ),
			'empty'	=> __( 'No categories to display.', WS_GETTEXT_DOMAIN )
		),
		'categories' => array(
			'id'	=> 'categories',
			'name'	=> __( 'Category Archives', WS_GETTEXT_DOMAIN ),
			'empty'	=> __( 'No categories to display.', WS_GETTEXT_DOMAIN )
		),
		'tags' => array(
			'id'	=> 'tags',
			'name'	=> __( 'Tag Archives', WS_GETTEXT_DOMAIN ),
			'empty'	=> __( 'No tags to display.', WS_GETTEXT_DOMAIN )
		),
		'top' => array(
			'id'	=> 'top',
			'name'	=> __( 'Hierarchy', WS_GETTEXT_DOMAIN ),
			'items'	=> array(
				'home' 			=> __( 'Homepage', WS_GETTEXT_DOMAIN ),
				'posts' 		=> __( 'All Posts', WS_GETTEXT_DOMAIN ),
				'pages' 		=> __( 'All Pages', WS_GETTEXT_DOMAIN ),
				'archives' 		=> __( 'All Archives', WS_GETTEXT_DOMAIN ),
				'categories'	=> __( 'All Category Archives', WS_GETTEXT_DOMAIN ),
				'tags' 			=> __( 'All Tag Archives', WS_GETTEXT_DOMAIN ),
				'authors' 		=> __( 'All Author Archives', WS_GETTEXT_DOMAIN ),
				'search' 		=> __( 'Search Results', WS_GETTEXT_DOMAIN ),
				'404' 			=> __( '404 Page', WS_GETTEXT_DOMAIN )
			)
		)
	);
	return apply_filters( 'wordstrap_conditionals_config', $conditionals );
}