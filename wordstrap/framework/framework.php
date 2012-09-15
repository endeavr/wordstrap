<?php
/**
 * WordStrap WordPress Framework
 * 
 * @author		Jason Loftis
 * @copyright	Copyright (c) Jason Loftis
 * @link		http://jloft.com
 * @link		http://wordstrap.com
 * @package 	WordStrap WordPress Framework
 */

// Constants
define( 'WS_FRAMEWORK_VERSION', '2.1.0' );
define( 'WS_FRAMEWORK_URL', get_template_directory().'/wordstrap/framework' );
define( 'WS_FRAMEWORK_URI', get_template_directory().'/wordstrap/framework' );
define( 'WS_FRAMEWORK_DIRECTORY', get_template_directory_uri().'/wordstrap/framework' );
define( 'WS_GETTEXT_DOMAIN', 'wordstrap' );
define( 'WS_GETTEXT_DOMAIN_FRONT', 'wordstrap_frontend' );

// Load text domain (this will be modified in upcoming v2.2 framework update)
load_theme_textdomain( WS_GETTEXT_DOMAIN, get_template_directory() . '/lang' );
load_theme_textdomain( WS_GETTEXT_DOMAIN_FRONT, get_template_directory() . '/lang' );

// Run framework
if( is_admin() ) {
	
	/*------------------------------------------------------*/
	/* Admin Hooks, Filters, and Files
	/*------------------------------------------------------*/
	
	// Include files
	require_once( WS_FRAMEWORK_URL . '/admin/functions/display.php' );
	require_once( WS_FRAMEWORK_URL . '/admin/functions/locals.php' );
	require_once( WS_FRAMEWORK_URL . '/admin/functions/meta.php' );
	require_once( WS_FRAMEWORK_URL . '/admin/modules/options/options-interface.php' );
	require_once( WS_FRAMEWORK_URL . '/admin/modules/options/options-medialibrary-uploader.php' );
	require_once( WS_FRAMEWORK_URL . '/admin/modules/options/options-sanitize.php' );
	require_once( WS_FRAMEWORK_URL . '/admin/modules/options/options-framework.php' );
	require_once( WS_FRAMEWORK_URL . '/admin/modules/builder/builder-framework.php' );
	require_once( WS_FRAMEWORK_URL . '/admin/modules/sidebars/sidebars-framework.php' );
	require_once( WS_FRAMEWORK_URL . '/admin/modules/sliders/sliders-framework.php' );
	require_once( WS_FRAMEWORK_URL . '/api/builder.php' );
	require_once( WS_FRAMEWORK_URL . '/api/customizer.php' );
	require_once( WS_FRAMEWORK_URL . '/api/helpers.php' );
	require_once( WS_FRAMEWORK_URL . '/api/locals.php' );
	require_once( WS_FRAMEWORK_URL . '/api/options.php' );
	require_once( WS_FRAMEWORK_URL . '/api/sidebars.php' );
	require_once( WS_FRAMEWORK_URL . '/api/sliders.php' );
	require_once( WS_FRAMEWORK_URL . '/shortcodes/tinymce/tinymce_shortcodes.php' );
	require_once( WS_FRAMEWORK_URL . '/widgets/ws-widget-contact.php' );
	require_once( WS_FRAMEWORK_URL . '/widgets/ws-widget-mini-post-grid.php' );
	require_once( WS_FRAMEWORK_URL . '/widgets/ws-widget-mini-post-list.php' );
	require_once( WS_FRAMEWORK_URL . '/widgets/ws-widget-video.php' );
	require_once( WS_FRAMEWORK_URL . '/widgets/ws-widget-twitter.php' );
	require_once( WS_FRAMEWORK_URL . '/admin/functions/general.php' );
	
	// Initiate API
	wordstrap_api_init();
	
	// Filters
	add_filter( 'image_size_names_choose', 'wordstrap_image_size_names_choose' );
	
	// Apply initial hooks
	add_action( 'admin_enqueue_scripts', 'wordstrap_non_modular_assets' );
	add_action( 'admin_init','wordstrap_theme_activation' );
	add_action( 'after_setup_theme', 'wordstrap_register_posts', 5 );
	add_action( 'after_setup_theme', 'wordstrap_add_image_sizes' );
	add_action( 'wp_before_admin_bar_render', 'wordstrap_admin_menu_bar' );
	add_action( 'wordstrap_options_footer_text', 'optionsframework_footer_text' );
	add_action( 'admin_init', 'wordstrap_stats' );
	add_action( 'admin_menu', 'wordstrap_hijack_page_atts' );
	add_action( 'add_meta_boxes', 'wordstrap_add_meta_boxes' );
	add_action( 'save_post', 'wordstrap_save_page_atts' );
	add_action( 'save_post', 'wordstrap_save_meta_boxes' );
	add_action( 'customize_register', 'wordstrap_customizer_init' );
	add_action( 'customize_controls_print_styles', 'wordstrap_customizer_styles' );
	add_action( 'customize_controls_print_scripts', 'wordstrap_customizer_scripts' );
	
	// Apply other hooks after theme has had a chance to add filters
	add_action( 'after_setup_theme', 'wordstrap_format_options', 1000 );
	add_action( 'after_setup_theme', 'wordstrap_admin_init', 1000 );
	add_action( 'after_setup_theme', 'wordstrap_add_theme_support', 1000 );
	add_action( 'after_setup_theme', 'wordstrap_register_navs', 1000 );
	add_action( 'after_setup_theme', 'wordstrap_register_sidebars', 1000 );

	// Run theme functions
	//require_once ( get_template_directory() . '/includes/theme-functions.php' );

} else {
	
	/*------------------------------------------------------*/
	/* Front-end Hooks, Filters, and Files
	/*------------------------------------------------------*/

	// Include files
	require_once( WS_FRAMEWORK_URL . '/admin/modules/options/options-sanitize.php' );
	require_once( WS_FRAMEWORK_URL . '/admin/modules/options/options-framework.php' );
	require_once( WS_FRAMEWORK_URL . '/api/builder.php' );
	require_once( WS_FRAMEWORK_URL . '/api/customizer.php' );
	require_once( WS_FRAMEWORK_URL . '/api/helpers.php' );
	require_once( WS_FRAMEWORK_URL . '/api/locals.php' );
	require_once( WS_FRAMEWORK_URL . '/api/options.php' );
	require_once( WS_FRAMEWORK_URL . '/api/sidebars.php' );
	require_once( WS_FRAMEWORK_URL . '/api/sliders.php' );
	require_once( WS_FRAMEWORK_URL . '/frontend/functions/sliders.php' );
	require_once( WS_FRAMEWORK_URL . '/frontend/functions/builder.php' );
	require_once( WS_FRAMEWORK_URL . '/frontend/functions/parts.php' );
	require_once( WS_FRAMEWORK_URL . '/frontend/functions/actions.php' );
	require_once( WS_FRAMEWORK_URL . '/frontend/functions/helpers.php' );
	require_once( WS_FRAMEWORK_URL . '/frontend/functions/display.php' );
	require_once( WS_FRAMEWORK_URL . '/frontend/functions/general.php' );
	require_once( WS_FRAMEWORK_URL . '/shortcodes/shortcodes.php' );
	require_once( WS_FRAMEWORK_URL . '/widgets/ws-widget-contact.php' );
	require_once( WS_FRAMEWORK_URL . '/widgets/ws-widget-mini-post-grid.php' );
	require_once( WS_FRAMEWORK_URL . '/widgets/ws-widget-mini-post-list.php' );
	require_once( WS_FRAMEWORK_URL . '/widgets/ws-widget-video.php' );
	require_once( WS_FRAMEWORK_URL . '/widgets/ws-widget-twitter.php' );
	
	// Initiate API
	wordstrap_api_init();
	
	// Filters
	add_filter( 'body_class', 'wordstrap_body_class' );
	add_filter( 'oembed_result', 'wordstrap_oembed_result', 10, 2 );
	add_filter( 'embed_oembed_html', 'wordstrap_oembed_result', 10, 2 );
	add_filter( 'wp_feed_cache_transient_lifetime' , 'wordstrap_feed_transient' );
	add_filter( 'wordstrap_the_content', 'wordstrap_content_formatter' );
	add_filter( 'wordstrap_the_content', 'do_shortcode' );
	add_filter( 'image_size_names_choose', 'wordstrap_image_size_names_choose' );
	add_filter( 'wordstrap_tweet_filter', 'wordstrap_tweet_filter_default', 10, 2 );
	add_filter( 'wordstrap_sidebar_layout', 'wordstrap_wpmultisite_signup_sidebar_layout' );
	
	// Apply initial hooks
	add_action( 'pre_get_posts', 'wordstrap_homepage_posts_per_page' );
	add_action( 'after_setup_theme', 'wordstrap_register_posts', 5 );
	add_action( 'after_setup_theme', 'wordstrap_add_theme_support' );
	add_action( 'after_setup_theme', 'wordstrap_add_image_sizes' );
	add_action( 'wp_enqueue_scripts', 'wordstrap_include_scripts' );
	add_action( 'wp_print_styles', 'wordstrap_include_styles', 5 );
	add_action( 'wp_before_admin_bar_render', 'wordstrap_admin_menu_bar' );
	add_action( 'customize_register', 'wordstrap_customizer_init' );

	// Apply other hooks after theme has had a chance to add filters
	add_action( 'after_setup_theme', 'wordstrap_format_options', 1000 );
	add_action( 'after_setup_theme', 'wordstrap_register_navs', 1000 );
	add_action( 'after_setup_theme', 'wordstrap_register_sidebars', 1000 );
	add_action( 'wp', 'wordstrap_frontend_init', 5 ); // This needs to run before any plugins hook into it
	add_action( 'wp_print_styles', 'wordstrap_deregister_stylesheets', 1000 );
	
	// <head> hooks
	add_action( 'wordstrap_head', 'wordstrap_head_default' );
	add_action( 'wordstrap_title', 'wordstrap_title_default' );
	add_action( 'wp_head', 'wordstrap_closing_styles', 11 );
	
	// Header hooks
	add_action( 'wordstrap_header_above', 'wordstrap_header_above_default' );
	add_action( 'wordstrap_header_content', 'wordstrap_header_content_default' );
	add_action( 'wordstrap_header_logo', 'wordstrap_header_logo_default' );
	add_action( 'wordstrap_header_menu', 'wordstrap_header_menu_default' );
	
	// Sidebars
	add_action( 'wordstrap_fixed_sidebar_before', 'wordstrap_fixed_sidebar_before_default' );
	add_action( 'wordstrap_fixed_sidebar_after', 'wordstrap_fixed_sidebar_after_default' );
	
	// Featured area hooks
	add_action( 'wordstrap_featured_start', 'wordstrap_featured_start_default' );
	add_action( 'wordstrap_featured_end', 'wordstrap_featured_end_default' );
	add_action( 'wordstrap_featured_blog', 'wordstrap_featured_blog_default' );
	add_action( 'wordstrap_featured_below_start', 'wordstrap_featured_below_start_default' );
	add_action( 'wordstrap_featured_below_end', 'wordstrap_featured_below_end_default' );
	add_action( 'wordstrap_featured_below_blog', 'wordstrap_featured_below_blog_default' );
	
	// Main content area hooks
	add_action( 'wordstrap_main_start', 'wordstrap_main_start_default' );
	add_action( 'wordstrap_main_top', 'wordstrap_main_top_default' );
	add_action( 'wordstrap_main_bottom', 'wordstrap_main_bottom_default' );
	add_action( 'wordstrap_main_end', 'wordstrap_main_end_default' );
	add_action( 'wordstrap_breadcrumbs', 'wordstrap_breadcrumbs_default' );
	add_action( 'wordstrap_sidebars', 'wordstrap_fixed_sidebars' );
	
	// Footer
	add_action( 'wordstrap_footer_above', 'wordstrap_footer_above_default' );
	add_action( 'wordstrap_footer_content', 'wordstrap_footer_content_default' );
	add_action( 'wordstrap_footer_sub_content', 'wordstrap_footer_sub_content_default' );
	add_action( 'wordstrap_footer_below', 'wordstrap_footer_below_default' );
	add_action( 'wordstrap_footer_below', 'wordstrap_footer_below_default' );
	add_action( 'wp_footer', 'wordstrap_analytics', 999 );
	
	// Content
	add_action( 'wordstrap_content_top', 'wordstrap_content_top_default' );
	add_action( 'wordstrap_blog_meta', 'wordstrap_blog_meta_default' );
	add_action( 'wordstrap_blog_tags', 'wordstrap_blog_tags_default' );
	add_action( 'wordstrap_the_post_thumbnail', 'wordstrap_the_post_thumbnail_default', 9, 5 );
	add_action( 'wordstrap_blog_content', 'wordstrap_blog_content_default' );
	
	// Elements
	add_action( 'wordstrap_element_open', 'wordstrap_element_open_default', 9, 3 );
	add_action( 'wordstrap_element_close', 'wordstrap_element_close_default', 9, 3 );
	
	// Sliders
	add_action( 'wordstrap_standard_slider', 'wordstrap_standard_slider_default', 9, 3 );
	add_action( 'wordstrap_carrousel_slider', 'wordstrap_carrousel_slider_default', 9, 3 );
	
	// WordPress Multisite Signup
	add_action( 'before_signup_form', 'wordstrap_before_signup_form' );
	add_action( 'after_signup_form', 'wordstrap_after_signup_form' );
	
	// Run theme functions
	// require_once ( get_template_directory() . '/includes/theme-functions.php' );
		
}