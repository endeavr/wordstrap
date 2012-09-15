<?php
/*-----------------------------------------------------------------------------------*/
/* Front-end Action Functions
/*-----------------------------------------------------------------------------------*/

// <head>
function wordstrap_head() { do_action( 'wordstrap_head' ); }
function wordstrap_title() { do_action( 'wordstrap_title' ); }

// Before and after site
function wordstrap_before() { do_action( 'wordstrap_before' ); } // No default hooked function
function wordstrap_after() { do_action( 'wordstrap_after' ); } // No default hooked function

// Header
function wordstrap_header_top() { do_action( 'wordstrap_header_top' ); } // No default hooked function
function wordstrap_header_above() { do_action( 'wordstrap_header_above' ); }
function wordstrap_header_content() { do_action( 'wordstrap_header_content' ); }
function wordstrap_header_logo() { do_action( 'wordstrap_header_logo' ); }
function wordstrap_header_addon() { do_action( 'wordstrap_header_addon' ); } // No default hooked function
function wordstrap_header_menu() { do_action( 'wordstrap_header_menu' ); }
function wordstrap_header_menu_addon() { do_action( 'wordstrap_header_menu_addon' ); } // No default hooked function
function wordstrap_header_before() { do_action( 'wordstrap_header_before' ); } // No default hooked function
function wordstrap_header_after() { do_action( 'wordstrap_header_after' ); } // No default hooked function

// Featured area
function wordstrap_featured_start() { do_action( 'wordstrap_featured_start' ); }
function wordstrap_featured( $type ) { do_action( 'wordstrap_featured_'.$type ); } // Only default hooked action is wordstrap_featured_{blog}
function wordstrap_featured_end() { do_action( 'wordstrap_featured_end' ); }

// Featured area below
function wordstrap_featured_below_start() { do_action( 'wordstrap_featured_below_start' ); }
function wordstrap_featured_below( $type ) { do_action( 'wordstrap_featured_below_'.$type ); } // No default hooked function
function wordstrap_featured_below_end() { do_action( 'wordstrap_featured_below_end' ); }

// Main content area
function wordstrap_main_start() { do_action( 'wordstrap_main_start' ); }
function wordstrap_main_top() { do_action( 'wordstrap_main_top' ); }
function wordstrap_main_bottom() { do_action( 'wordstrap_main_bottom' ); }
function wordstrap_main_end() { do_action( 'wordstrap_main_end' ); }
function wordstrap_breadcrumbs() { do_action( 'wordstrap_breadcrumbs' ); }
function wordstrap_before_layout() { do_action( 'wordstrap_before_layout' ); } // No default hooked function
function wordstrap_sidebars( $position ) { do_action( 'wordstrap_sidebars', $position ); }

// Footer
function wordstrap_footer_above() { do_action( 'wordstrap_footer_above' ); }  // No default hooked function
function wordstrap_footer_content() { do_action( 'wordstrap_footer_content' ); }
function wordstrap_footer_sub_content() { do_action( 'wordstrap_footer_sub_content' ); }
function wordstrap_footer_below() { do_action( 'wordstrap_footer_below' ); }
function wordstrap_footer_before() { do_action( 'wordstrap_footer_before' ); } // No default hooked function
function wordstrap_footer_after() { do_action( 'wordstrap_footer_after' ); } // No default hooked function

// Content
function wordstrap_content_top() { do_action( 'wordstrap_content_top' ); }
function wordstrap_blog_meta() { do_action( 'wordstrap_blog_meta' ); }
function wordstrap_blog_tags() { do_action( 'wordstrap_blog_tags' ); }
function wordstrap_the_post_thumbnail( $location = 'primary', $size = '', $link = true, $allow_filters = true, $gallery = 'gallery' ) { do_action( 'wordstrap_the_post_thumbnail', $location, $size, $link, $allow_filters, $gallery ); }
function wordstrap_blog_content( $type ) { do_action( 'wordstrap_blog_content', $type ); }
function wordstrap_single_footer() { do_action( 'wordstrap_single_footer' ); }
function wordstrap_page_footer() { do_action( 'wordstrap_page_footer' );}