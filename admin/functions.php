<?php

/* 
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */
 
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}
 
 /* 
 * In this demo an additional css file is loaded into the
 * Options Panel in order to override specific default styling
 */
 
if ( is_admin() ) {
    $of_page= 'appearance_page_options-framework';
    add_action( "admin_print_styles-$of_page", 'optionsframework_custom_css', 100);
}

/* 
 * The css loaded is inside /css/options-custom.css
 * If you are using a parent theme instead of a child theme
 * make sure to use get_template_directory_uri() instead.
 */
 
function optionsframework_custom_css () {
	wp_register_style( 'optionsframework_custom_css', get_template_directory_uri() .'/admin/css/options-custom.css' );
	wp_enqueue_style( 'optionsframework_custom_css' );
	wp_register_style( 'fontawesome_css', get_template_directory_uri() .'/admin/css/font-awesome.css' );
	wp_enqueue_style( 'fontawesome_css' );
}

 /**
 * Returns an array of system fonts
 * Feel free to edit this, update the font fallbacks, etc.
 */

function options_typography_get_os_fonts() {
	// OS Font Defaults
	$os_faces = array(
		'Arial, sans-serif' => 'Arial',
		'"Avant Garde", sans-serif' => 'Avant Garde',
		'Cambria, Georgia, serif' => 'Cambria',
		'Copse, sans-serif' => 'Copse',
		'Garamond, "Hoefler Text", Times New Roman, Times, serif' => 'Garamond',
		'Georgia, serif' => 'Georgia',
		'"Helvetica Neue", Helvetica, sans-serif' => 'Helvetica Neue',
		'Tahoma, Geneva, sans-serif' => 'Tahoma'
	);
	return $os_faces;
}

/**
 * Returns a select list of Google fonts
 * Feel free to edit this, update the fallbacks, etc.
 */

function options_typography_get_google_fonts() {
	// Google Font Defaults
	$google_faces = array(
		'Amarante, serif' => 'Amarante',
		'Arvo, serif' => 'Arvo',
		'Bangers, sans-serif' => 'Bangers',
		'Bitter, serif' => 'Bitter',
		'Black Ops One, sans-serif' => 'Black Ops One',
		'Bree Serif, serif' => 'Bree Serif',
		'Cherry Cream Soda, sans-serif' => 'Cherry Cream Soda',
		'Codystar, sans-serif' => 'Codystar',
		'Copse, sans-serif' => 'Copse',
		'Courgette, serif' => 'Courgette',
		'Crushed, sans-serif' => 'Crushed',
		'Cuprum, sans-serif' => 'Cuprum',
		'Diplomata SC, serif' => 'Diplomata SC',
		'Droid Sans, sans-serif' => 'Droid Sans',
		'Droid Serif, serif' => 'Droid Serif',
		'Eagle Lake, serif' => 'Eagle Lake',
		'Gorditas, serif' => 'Gorditas',
		'Exo, sans-serif' => 'Exo',
		'IM Fell French Canon SC, serif' => 'IM Fell French Canon SC',
		'Lato, sans-serif' => 'Lato',
		'Limelight, serif' => 'Limelight',
		'Lobster, cursive' => 'Lobster',
		'Love Ya Like A Sister, serif' => 'Love Ya Like A Sister',
		'Mate SC, serif' => 'Mate SC',
		'Merienda One, serif' => 'Merienda One',
		'Metal Mania, serif' => 'Metal Mania',
		'Michroma, sans-serif' => 'Micrhoma',
		'Mystery Quest, serif' => 'Mystery Quest',
		'Nobile, sans-serif' => 'Nobile',
		'Nunito, sans-serif' => 'Nunito',
		'Open Sans, sans-serif' => 'Open Sans',
		'Oswald, sans-serif' => 'Oswald',
		'Pacifico, cursive' => 'Pacifico',
		'Philosopher, serif' => 'Philosopher',
		'Play, sans-serif' => 'Play',
		'PT Sans, sans-serif' => 'PT Sans',
		'Rokkitt, serif' => 'Rokkit',
		'Unkempt, serif' => 'Unkempt',
		'Quando, serif' => 'Quando',
		'Quattrocento, serif' => 'Quattrocento',
		'Raleway, cursive' => 'Raleway',
		'Ubuntu, sans-serif' => 'Ubuntu',
		'Yanone Kaffeesatz, sans-serif' => 'Yanone Kaffeesatz'		
	);
	return $google_faces;
}

function options_typography_get_google_serif_fonts() {
	// Google Font Defaults
	$google_serif_faces = array(
		'Amarante, serif' => 'Amarante',
		'Arvo, serif' => 'Arvo',
		'Bitter, serif' => 'Bitter',
		'Bree Serif, serif' => 'Bree Serif',
		'Courgette, serif' => 'Courgette',
		'Diplomata SC, serif' => 'Diplomata SC',
		'Droid Serif, serif' => 'Droid Serif',
		'Eagle Lake, serif' => 'Eagle Lake',
		'Gorditas, serif' => 'Gorditas',
		'Exo, sans-serif' => 'Exo',
		'IM Fell French Canon SC, serif' => 'IM Fell French Canon SC',
		'Limelight, serif' => 'Limelight',
		'Love Ya Like A Sister, serif' => 'Love Ya Like A Sister',
		'Mate SC, serif' => 'Mate SC',
		'Merienda One, serif' => 'Merienda One',
		'Metal Mania, serif' => 'Metal Mania',
		'Mystery Quest, serif' => 'Mystery Quest',
		'Philosopher, serif' => 'Philosopher',
		'Rokkitt, serif' => 'Rokkit',
		'Unkempt, serif' => 'Unkempt',
		'Quando, serif' => 'Quando',
		'Quattrocento, serif' => 'Quattrocento'	
	);
	return $google_serif_faces;
}

function options_typography_get_google_sans_fonts() {
	// Google Font Defaults
	$google_sans_faces = array(
		'Bangers, sans-serif' => 'Bangers',
		'Black Ops One, sans-serif' => 'Black Ops One',
		'Cherry Cream Soda, sans-serif' => 'Cherry Cream Soda',
		'Codystar, sans-serif' => 'Codystar',
		'Copse, sans-serif' => 'Copse',
		'Crushed, sans-serif' => 'Crushed',
		'Cuprum, sans-serif' => 'Cuprum',
		'Droid Sans, sans-serif' => 'Droid Sans',
		'Exo, sans-serif' => 'Exo',
		'Lato, sans-serif' => 'Lato',
		'Michroma, sans-serif' => 'Micrhoma',
		'Nobile, sans-serif' => 'Nobile',
		'Nunito, sans-serif' => 'Nunito',
		'Open Sans, sans-serif' => 'Open Sans',
		'Oswald, sans-serif' => 'Oswald',
		'Play, sans-serif' => 'Play',
		'PT Sans, sans-serif' => 'PT Sans',
		'Ubuntu, sans-serif' => 'Ubuntu',
		'Yanone Kaffeesatz, sans-serif' => 'Yanone Kaffeesatz'		
	);
	return $google_sans_faces;
}

/* 
 * Outputs the selected option panel styles inline into the <head>
 */
 
function options_typography_styles() {
 	
 	// It's helpful to include an option to disable styles.  If this is selected
 	// no inline styles will be outputted into the <head>
 	
 	if ( !of_get_option( 'disable_styles' ) ) {
		$output = '';
		$input = '';
		
		if ( of_get_option( 'body_font' ) ) {
			$output .= options_typography_font_styles( of_get_option( 'body_font' ) , 'body');
		}
		
		if ( of_get_option( 'site_title_font' ) ) {
			$output .= options_typography_font_styles( of_get_option( 'site_title_font' ) , '#site-title');
		}
		
		if ( of_get_option( 'header_font' ) ) {
			$output .= options_typography_font_styles( of_get_option( 'header_font' ) , 'h1,h2,h3,h4,h5,h6');
		}
		
		if ( of_get_option( 'link_color' ) ) {
			$output .= 'a {color:' . of_get_option( 'link_color' ) . '}';
		}
		
		if ( of_get_option( 'link_hover_color' ) ) {
			$output .= 'a:hover {color:' . of_get_option( 'link_hover_color' ) . '}';
		}
		
		if ( of_get_option( 'google_font' ) ) {
			$input = of_get_option( 'google_font' );
			$output .= options_typography_font_styles( of_get_option( 'google_font' ) , '.google-font');
		}
		
		if ( of_get_option( 'google_mixed' ) ) {
			$input = of_get_option( 'google_mixed' );
			$output .= options_typography_font_styles( of_get_option( 'google_mixed' ) , '.google-mixed');
		}
		
		if ( of_get_option( 'google_mixed_2' ) ) {
			$input = of_get_option( 'google_mixed_2' );
			$output .= options_typography_font_styles( of_get_option( 'google_mixed_2' ) , '.google-mixed-2');
		}
		
		if ( of_get_option( 'wordstrap_brand_font_type' ) ) {
			$input = of_get_option( 'wordstrap_brand_font_type' );
			$output .= options_typography_font_styles( of_get_option( 'wordstrap_brand_font_type' ) , '.wordstrap_brand_font_type');
		}		
		
		if ( $output != '' ) {
			$output = "\n<style>\n" . $output . "</style>\n";
			echo $output;
		}
	}
}
add_action('wp_head', 'options_typography_styles');

/* 
 * Returns a typography option in a format that can be outputted as inline CSS
 */
 
function options_typography_font_styles($option, $selectors) {
		$output = $selectors . ' {';
		$output .= 'color:' . $option['color'] .'; ';
		$output .= 'font-family:' . $option['face'] . '; ';
		$output .= 'font-weight:' . $option['style'] . '; ';
		$output .= 'font-size:' . $option['size'] . '; ';
		$output .= 'line-height:' . $option['height'] . '; ';
		$output .= '}';
		$output .= "\n";
		return $output;
}

/**
 * Checks font options to see if a Google font is selected.
 * If so, options_typography_enqueue_google_font is called to enqueue the font.
 * Ensures that each Google font is only enqueued once.
 */
 
if ( !function_exists( 'options_typography_google_fonts' ) ) {
	function options_typography_google_fonts() {
		$all_google_fonts = array_keys( options_typography_get_google_fonts() );
		// Define all the options that possibly have a unique Google font
		// $google_font = of_get_option('google_font', 'Rokkitt, serif');
		$google_mixed = of_get_option('google_mixed', false);
		// $google_mixed_2 = of_get_option('google_mixed_2', 'Arvo, serif');
		$wordstrap_brand_font_type = of_get_option('wordstrap_brand_font_type', false);		
		// Get the font face for each option and put it in an array
		$selected_fonts = array(
			// $google_font['face'],
			$google_mixed['face'],
			// $google_mixed_2['face'],
			$wordstrap_brand_font_type['face'] );			
		// Remove any duplicates in the list
		$selected_fonts = array_unique($selected_fonts);
		// Check each of the unique fonts against the defined Google fonts
		// If it is a Google font, go ahead and call the function to enqueue it
		foreach ( $selected_fonts as $font ) {
			if ( in_array( $font, $all_google_fonts ) ) {
				options_typography_enqueue_google_font($font);
			}
		}
	}
}

add_action( 'wp_enqueue_scripts', 'options_typography_google_fonts' );

/**
 * Enqueues the Google $font that is passed
 */
 
function options_typography_enqueue_google_font($font) {
	$font = explode(',', $font);
	$font = $font[0];
	// Certain Google fonts need slight tweaks in order to load properly
	// Like our friend "Raleway"
	if ( $font == 'Raleway' )
		$font = 'Raleway:100';
	$font = str_replace(" ", "+", $font);
	wp_enqueue_style( "options_typography_$font", "http://fonts.googleapis.com/css?family=$font", false, null, 'all' );
}

?>