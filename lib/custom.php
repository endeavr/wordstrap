<?php

//** GENERAL CUSTOM FUNCTIONS **//

if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }

   // WordStrap Theme Options
   	require_once locate_template('/admin/functions.php');
   // Include the options.php file explicitly in order to enable compatibility with the WordPress Front End Theme Customizer.
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
     
   // Register Additional Sidebars (Dynamic Widget Areas)
     function ws_widgets_init() {
     
		register_sidebar(array(
		'name'          => __('Super Footer Col 1', 'roots'),
		'id'            => 'sidebar-superfooter-col1',
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
		));
		
		register_sidebar(array(
		'name'          => __('Super Footer Col 2', 'roots'),
		'id'            => 'sidebar-superfooter-col2',
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
		));
		
		register_sidebar(array(
		'name'          => __('Super Footer Col 3', 'roots'),
		'id'            => 'sidebar-superfooter-col3',
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
		));		
		
	}
	add_action('widgets_init', 'ws_widgets_init');
	
//** CUSTOM HOOKS, ACTIONS, + FILTERS **//	

// Get Some Global Variable Options
$ws_bodyoption = of_get_option('ws_bodyoption');

$ws_headercontainer = of_get_option('ws_headercontainer');
$ws_headeroption = of_get_option('ws_headeroption');

$ws_mastcontainer = of_get_option('ws_mastcontainer');
$ws_mastoption = of_get_option('ws_mastoption');

$ws_navbartype = of_get_option('ws_navbartype');
$ws_navbarscheme = of_get_option('ws_navbarscheme');
$ws_navbarfixed = of_get_option('ws_navbarfixed');
$ws_navbarposition = of_get_option('ws_navbarposition');
$ws_navbarheight = of_get_option('ws_navbarheight');
	
$ws_mastheight = of_get_option('ws_mastheight');

$ws_wrapcontainer = of_get_option('ws_wrapcontainer');
$ws_wrapoption = of_get_option('ws_wrapoption');

$ws_sidebaroption = of_get_option('ws_sidebaroption');

$ws_footercontainer = of_get_option('ws_footercontainer');
$ws_footeroption = of_get_option('ws_footeroption');

$ws_colophoncontainer = of_get_option('ws_colophoncontainer');
$ws_colophonoption = of_get_option('ws_colophonoption');

// Place the NAVBAR via the appropriate HEADER 'THA' hook

	function ws_navbar_placement ( $ws_navbar_placement ) {
		$ws_navbar_placement = get_template_part('templates/header/topnav');	
	}
	
	if ( $ws_navbarposition == 'navbar-pos-top' ) {
		add_filter ('tha_header_top','ws_navbar_placement');
	}
	if ( $ws_navbarposition == 'navbar-pos-btm' ) {
		add_filter ('tha_header_bottom','ws_navbar_placement');
	}	

// Filter Body Class	
function ws_body_class($classes) {
	global $ws_bodyoption, $ws_navbarfixed;
	if ( $ws_bodyoption == 'gradient' ) : $classes[] = 'gradient'; endif;
	//if ( $ws_navbarfixed == 'navbar-fixed' ) : $classes[] = 'body-navbar-fixed-top'; endif;
	return $classes;
}

add_filter('body_class', 'ws_body_class');	

// Register WordStrap Hooks
define( 'WS_HOOKS_VERSION', '1.0' );
add_theme_support( 'ws_hooks', array ( 'all','ws_affix','ws_navbar_class','ws_header_class' ) );
function ws_current_theme_supports ( $bool, $args, $registered ) {
	return in_array( $args[0], $registered[0] ) || in_array( 'all', $registered[0] );
}
add_filter( 'current_theme_supports-ws_hooks', 'ws_current_theme_supports', 10, 3 );
		
// Register AFFIX class

	function ws_affix( $ws_affix = '') {
		// Separates properties with a single space, collates properties for affix data element
		echo ws_affix_data( $ws_affix );
	}	
	
	function ws_affix_data( $ws_affix = '' ) {
		$ws_affix = ' data-spy="affix" data-offset-top="100"';
		return apply_filters( 'ws_affix', $ws_affix );
	}
	
// Filter AFFIX class
	
	function ws_affix_navbar( $ws_affix = '' ) {
	
		global $ws_navbarfixed, $ws_navbarposition, $ws_navbarheight, $ws_mastheight;
		
		// By subtracting zero, we are able to remove the "px" from the ws_mastheight option
		$ws_data_offset_top = $ws_mastheight - 0;
		
		if ( $ws_navbarfixed == 'navbar-fixed' ) {
			if ($ws_navbarposition == 'navbar-pos-top') : $ws_affix = ' data-spy="affix" data-offset-top="'.$ws_data_offset_top.'"'; endif;
			if ($ws_navbarposition == 'navbar-pos-btm') : $ws_affix = ' data-spy="affix" data-offset-top="'.$ws_data_offset_top.'"'; endif;
		}
		else {
		$ws_affix = '';
		}
		return $ws_affix;
	}

	add_filter('ws_affix', 'ws_affix_navbar');	
	
// Register BANNER class

	function ws_banner_class( $class = '') {
		// Separates classes with a single space, collates classes for the banner element
		echo 'class="' . join( ' ', ws_banner_data( $class ) ) . '"';
	}	
	
	function ws_banner_data( $class = '' ) {
		$classes = array();
		$classes[] = 'banner';
		if ( ! empty( $class ) ) {
	                if ( !is_array( $class ) )
	                        $class = preg_split( '#\s+#', $class );
	                $classes = array_merge( $classes, $class );
	        } else {
	                // Ensure that we always coerce class to being an array.
	                $class = array();
	        }
		$classes = array_map( 'esc_attr', $classes );
		return apply_filters( 'ws_banner_class', $classes, $class );
	}
	
// Filter BANNER class

	function ws_banner_variables ( $classes ) {
		global $ws_headercontainer, $ws_headeroption;
		if ( $ws_headercontainer == 'contain' ) : $classes[] = 'container'; endif;
		if ( $ws_headeroption == 'gradient' ) : $classes[] = 'gradient'; endif;
		return $classes;		
	}
	
	add_filter ('ws_banner_class','ws_banner_variables');
	
// Register MASTHEAD class

	function ws_masthead_class( $class = '') {
		// Separates classes with a single space, collates classes for the masthead element
		echo 'class="' . join( ' ', ws_masthead_data( $class ) ) . '"';
	}	
	
	function ws_masthead_data( $class = '' ) {
		$classes = array();
		$classes[] = 'container';
		if ( ! empty( $class ) ) {
	                if ( !is_array( $class ) )
	                        $class = preg_split( '#\s+#', $class );
	                $classes = array_merge( $classes, $class );
	        } else {
	                // Ensure that we always coerce class to being an array.
	                $class = array();
	        }
		$classes = array_map( 'esc_attr', $classes );
		return apply_filters( 'ws_masthead_class', $classes, $class );
	}
	
// Filter MASTHEAD class

	function ws_masthead_variables ( $classes ) {
		global $ws_mastcontainer, $ws_mastoption;
		if ( $ws_mastcontainer == 'contain' ) : $classes[] = 'container'; endif;
		if ( $ws_mastoption == 'gradient' ) : $classes[] = 'gradient'; endif;
		return $classes;		
	}
	
	add_filter ('ws_masthead_class','ws_masthead_variables');	
	
// Register NAVBAR class

	function ws_navbar_class( $class = '') {
		// Separates classes with a single space, collates classes for the navbar element
		echo 'class="' . join( ' ', ws_navbar_data( $class ) ) . '"';
	}	
	
	function ws_navbar_data( $class = '' ) {
		$classes = array();
		$classes[] = 'navbar';
		if ( ! empty( $class ) ) {
	                if ( !is_array( $class ) )
	                        $class = preg_split( '#\s+#', $class );
	                $classes = array_merge( $classes, $class );
	        } else {
	                // Ensure that we always coerce class to being an array.
	                $class = array();
	        }
		$classes = array_map( 'esc_attr', $classes );
		return apply_filters( 'ws_navbar_class', $classes, $class );
	}
	
// Filter NAVBAR class
	
	function ws_navbar_variables( $classes ) {
	
		global $ws_navbartype, $ws_navbarscheme, $ws_navbarfixed, $ws_navbarposition, $ws_headercontainer;
		
		if ($ws_navbartype == 'navbar-std') : $classes[] = 'navbar-std'; endif;
		if ($ws_navbartype == 'navbar-pills') : $classes[] = 'navbar-pills'; endif;
		if ($ws_navbartype == 'navbar-tabs') : $classes[] = 'navbar-tabs'; endif;		
		if ($ws_navbarscheme == 'navbar-light') : $classes[] = 'navbar-default'; endif;
		if ($ws_navbarscheme == 'navbar-dark') : $classes[] = 'navbar-inverse'; endif;
		if ($ws_navbarscheme == 'navbar-transparent') : $classes[] = 'navbar-transparent'; endif;
		if ($ws_navbarfixed == 'navbar-fixed') : $classes[] = 'navbar-fixed-top'; endif;
		if ($ws_navbarfixed == 'navbar-static') : $classes[] = 'navbar-static-top'; endif;
		if ($ws_navbarposition == 'navbar-pos-top') : $classes[] = 'navbar-pos-top'; endif;
		if ($ws_navbarposition == 'navbar-pos-btm') : $classes[] = 'navbar-pos-btm'; endif;
		if ($ws_headercontainer == 'contain') : $classes[] = 'container'; endif;
		
		return $classes;
	}

	add_filter('ws_navbar_class', 'ws_navbar_variables');
	
// Filter MENU class
	
	function ws_menu_variables( $classes ) {
	
		global $ws_navbartype;
		
		if ($ws_navbartype == 'navbar-std') : $classes['menu_class'] = 'nav nav-std'; endif;
		if ($ws_navbartype == 'navbar-pills') : $classes['menu_class'] = 'nav nav-pills'; endif;
		if ($ws_navbartype == 'navbar-tabs') : $classes['menu_class'] = 'nav nav-tabs'; endif;	
		
		return $classes;
	}

	add_filter('wp_nav_menu_args', 'ws_menu_variables');	

// Register WRAP class

	function ws_wrap_class( $class = '') {
		// Separates classes with a single space, collates classes for the wrap element
		echo 'class="' . join( ' ', ws_wrap_data( $class ) ) . '"';
	}	
	
	function ws_wrap_data( $class = '' ) {
		$classes = array();
		$classes[] = 'container';
		if ( ! empty( $class ) ) {
	                if ( !is_array( $class ) )
	                        $class = preg_split( '#\s+#', $class );
	                $classes = array_merge( $classes, $class );
	        } else {
	                // Ensure that we always coerce class to being an array.
	                $class = array();
	        }
		$classes = array_map( 'esc_attr', $classes );
		return apply_filters( 'ws_wrap_class', $classes, $class );
	}
	
// Filter WRAP class

	function ws_wrap_variables ( $classes ) {
		global $ws_wrapcontainer, $ws_wrapoption, $ws_navbarfixed;
		//if ( $ws_wrapcontainer == 'contain' ) : $classes[] = 'container'; endif;
		if ( $ws_wrapoption == 'gradient' ) : $classes[] = 'gradient'; endif;
		//if ( $ws_navbarfixed == 'navbar-fixed') : $classes[] = 'wrap-navbar-fixed-top'; endif;
		return $classes;		
	}
	
	add_filter ('ws_wrap_class','ws_wrap_variables');	
	
// Register SIDEBAR class

	function ws_sidebar_class( $class = '') {
		// Separates classes with a single space, collates classes for the sidebar element
		echo 'class="' . join( ' ', ws_sidebar_data( $class ) ) . '"';
	}	
	
	function ws_sidebar_data( $class = '' ) {
		$classes = array();
		$classes[] = 'span4';
		if ( ! empty( $class ) ) {
	                if ( !is_array( $class ) )
	                        $class = preg_split( '#\s+#', $class );
	                $classes = array_merge( $classes, $class );
	        } else {
	                // Ensure that we always coerce class to being an array.
	                $class = array();
	        }
		$classes = array_map( 'esc_attr', $classes );
		return apply_filters( 'ws_sidebar_class', $classes, $class );
	}	
	
// Filter SIDEBAR class

	function ws_sidebar_variables ( $classes ) {
		global $ws_sidebaroption;
		if ( $ws_sidebaroption == 'gradient' ) : $classes[] = 'gradient'; endif;
		return $classes;		
	}
	
	add_filter ('ws_sidebar_class','ws_sidebar_variables');		
		
// Register FOOTER class

	function ws_footer_class( $class = '') {
		// Separates classes with a single space, collates classes for the footer element
		echo 'class="' . join( ' ', ws_footer_data( $class ) ) . '"';
	}	
	
	function ws_footer_data( $class = '' ) {
		$classes = array();
		$classes[] = 'footer';
		if ( ! empty( $class ) ) {
	                if ( !is_array( $class ) )
	                        $class = preg_split( '#\s+#', $class );
	                $classes = array_merge( $classes, $class );
	        } else {
	                // Ensure that we always coerce class to being an array.
	                $class = array();
	        }
		$classes = array_map( 'esc_attr', $classes );
		return apply_filters( 'ws_footer_class', $classes, $class );
	}
	
// Filter FOOTER class

	function ws_footer_variables ( $classes ) {
		global $ws_footercontainer, $ws_footeroption;
		if ( $ws_footercontainer == 'contain' ) : $classes[] = 'container'; endif;
		if ( $ws_footeroption == 'gradient' ) : $classes[] = 'gradient'; endif;
		return $classes;		
	}
	
	add_filter ('ws_footer_class','ws_footer_variables');	
	
// Register COLOPHON class

	function ws_colophon_class( $class = '') {
		// Separates classes with a single space, collates classes for the colophon element
		echo 'class="' . join( ' ', ws_colophon_data( $class ) ) . '"';
	}	
	
	function ws_colophon_data( $class = '' ) {
		$classes = array();
		$classes[] = 'colophon';
		if ( ! empty( $class ) ) {
	                if ( !is_array( $class ) )
	                        $class = preg_split( '#\s+#', $class );
	                $classes = array_merge( $classes, $class );
	        } else {
	                // Ensure that we always coerce class to being an array.
	                $class = array();
	        }
		$classes = array_map( 'esc_attr', $classes );
		return apply_filters( 'ws_colophon_class', $classes, $class );
	}
	
// Filter COLOPHON class

	function ws_colophon_variables ( $classes ) {
		global $ws_colophoncontainer, $ws_colophonoption;
		if ( $ws_colophoncontainer == 'contain' ) : $classes[] = 'container'; endif;
		if ( $ws_colophonoption == 'gradient' ) : $classes[] = 'gradient'; endif;
		return $classes;		
	}
	
	add_filter ('ws_colophon_class','ws_colophon_variables');	
	

//** CUSTOM Image Sizes **//	
function ws_add_image_sizes() {
    add_image_size( 'ws-thumb43', 160, 120, true );
    add_image_size( 'ws-thumb64', 160, 107, true );
    add_image_size( 'ws-postwidth', 730 );
    add_image_size( 'ws-fullwidth', 1100 );
}
add_action( 'init', 'ws_add_image_sizes' );
 
function ws_show_image_sizes($sizes) {
    $sizes['ws-thumb43'] = __( '4:3 Aspect Ratio Thumbnail', 'wordstrap' );
    $sizes['ws-thumb64'] = __( '6:4 Aspect Ratio Thumbnail', 'wordstrap' );
    $sizes['ws-postwidth'] = __( 'Post Width with Sidebar', 'wordstrap' );
    $sizes['ws-fullwidth'] = __( 'Full Width with No Sidebar', 'wordstrap' );
 
    return $sizes;
}
add_filter('image_size_names_choose', 'ws_show_image_sizes');	