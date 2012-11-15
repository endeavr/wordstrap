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
	require_once dirname( __FILE__ ) . '/inc/options-backup.php';
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

 /* 
 * Create an array of patterns from directory of images
 */
 
 function options_patterns_get_file_list( $directory_path, $filetype, $directory_uri ) {
    $patterns = array();
    $pattern_files = array();
    if ( is_dir( $directory_path ) ) {
        $pattern_files = glob( $directory_path . "*.$filetype", GLOB_BRACE);
        foreach (array_reverse( $pattern_files ) as $file ) {
            $file_name = str_replace( $directory_path, '', $file);
            $file = str_replace( $directory_path, site_url().$directory_uri, $file);
            $patterns[ $file_name ] = $file;
        }
    }
    return $patterns;
}

 /**
 * Returns an array of system fonts
 * Feel free to edit this, update the font fallbacks, etc.
 * http://www.awayback.com/revised-font-stack/
 * http://cssfontstack.com
 */

function options_typography_get_os_fonts_serif() {
	// OS Font Defaults
	$os_serif_faces = array(
		'Georgia, serif' => '# OPERATING SYSTEM SERIF (Section Title...do not select)',
		'Baskerville, "Baskerville Old Face", "Hoefler Text", Palatino, "Palatino Linotype", Garamond, "Times New Roman", serif' => 'Baskerville',
		'"Bodoni MT", Didot, "Didot LT STD", "Hoefler Text", Garamond, "Times New Roman", serif' => 'Bodoni MT',
		'"Book Antiqua", Palatino, "Palatino Linotype", "Palatino LT STD", Georgia, serif' => 'Book Antiqua',
		'"Big Caslon", "Book Antiqua", "Palatino Linotype", Georgia, serif' => 'Big Caslon',
		'"Calisto MT", "Bookman Old Style", Bookman, "Goudy Old Style", Garamond, "Hoefler Text", "Bitstream Charter", Georgia, serif' => 'Calisto MT',
		'Cambria, Georgia, serif' => 'Cambria',
		'Didot, "Didot LT STD", "Hoefler Text", Garamond, "Times New Roman", serif' => 'Didot',
		'Garamond, Baskerville, "Baskerville Old Face", "Hoefler Text", "Times New Roman", serif;' => 'Garamond',
		'Georgia, Times, "Times New Roman", serif' => 'Georgia',
		'"Goudy Old Style", Garamond, "Big Caslon", "Times New Roman", serif' => 'Goudy Old Style',
		'"Hoefler Text", Constantia, Palatino, "Palatino Linotype", "Book Antiqua", Georgia, serif' => 'Hoefler Text',
		'"Lucida Bright", Georgia, serif' => 'Lucida Bright',
		'Palatino, "Palatino Linotype", "Palatino LT STD", "Book Antiqua", Georgia, serif' => 'Palatino',
		'Perpetua, Baskerville, "Big Caslon", "Palatino Linotype", Palatino, "URW Palladio L", "Nimbus Roman No9 L", serif' => 'Perpetua',
		'Rockwell, "Courier Bold", Courier, Georgia, Times, "Times New Roman", serif' => 'Rockwell',
		'"Times New Roman", Times, Baskerville, Georgia, serif' => 'Times New Roman',
	);
	return $os_serif_faces;
}

function options_typography_get_os_fonts_sans() {
	// OS Font Defaults
	$os_sans_faces = array(
		'Arial, sans-serif' => '# OPERATING SYSTEM SANS-SERIF (Section Title...do not select)',
		'Arial, "Helvetica Neue", Helvetica, sans-serif' => 'Arial',
		'"Avant Garde", Avantgarde, "Century Gothic", CenturyGothic, "AppleGothic", sans-serif' => 'Avant Garde',
		'Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif' => 'Calibri',
		'Candara, Calibri, Segoe, "Segoe UI", Optima, Arial, sans-serif' => 'Candara',
		'"Century Gothic", CenturyGothic, AppleGothic, sans-serif' => 'Century Gothic',
		'"Franklin Gothic Medium", "Franklin Gothic", "ITC Franklin Gothic", Arial, sans-serif' => 'Franklin Gothic Medium',
		'Futura, "Trebuchet MS", Arial, sans-serif' => 'Futura',
		'Geneva, Tahoma, Verdana, sans-serif' => 'Geneva',
		'"Gill Sans", "Gill Sans MT", Calibri, sans-serif' => 'Gill Sans',
		'"Helvetica Neue", Helvetica, Arial, sans-serif' => 'Helvetica Neue',
		'"Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Geneva, Verdana, Tahoma, sans-serif' => 'Lucida Grande',
		'Optima, Segoe, "Segoe UI", Candara, Calibri, Arial, sans-serif' => 'Optima',
		'Segoe, "Segoe UI", "Helvetica Neue", Arial, sans-serif' => 'Segoe',
		'Tahoma, Geneva, Verdana, sans-serif' => 'Tahoma',
		'"Trebuchet MS", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Tahoma, sans-serif' => 'Trebuchet MS',
		'Verdana, Geneva, sans-serif' => 'Verdana'
	);
	return $os_sans_faces;
}

function options_typography_get_os_fonts_mono() {
	// OS Font Defaults
	$os_mono_faces = array(
		'Courier, monospace' => '# OPERATING SYSTEM MONOSPACE (Section Title...do not select)',
		'"Andale Mono", AndaleMono, monospace' => 'Andale Mono',
		'Consolas, monaco, monospace' => 'Consolas',
		'"Courier New", Courier, "Lucida Sans Typewriter", "Lucida Typewriter", monospace' => 'Courier New',
		'"Lucida Console", "Lucida Sans Typewriter", Monaco, "Bitstream Vera Sans Mono", monospace' => 'Lucida Console',
		'"Lucida Sans Typewriter", "Lucida Console", Monaco, "Bitstream Vera Sans Mono", monospace' => 'Lucida Sans Typewriter',
		'Monaco, Menlo, Consolas, "Lucida Console", "Courier New", monospace' => 'Monaco'
	);
	return $os_mono_faces;
}


/**
 * Returns lists of Google fonts
 * Feel free to edit these arrays, update the fallbacks, etc.
 */

function options_typography_get_google_fonts_serif() {
	$google_serif_faces = array(
		'serif' => '# GOOGLE SERIF (Section Title...do not select)',	
		'Bitter, serif' => 'Bitter',
		'"Bree Serif", serif' => 'Bree Serif',
		'"Crete Round", serif' => 'Crete Round',
		'"Droid Serif", serif' => 'Droid Serif',
		'"Fanwood Text", serif' => 'Fanwood Text',
		'"Josefin Slab", serif' => 'Josefin Slab',
		'Mate, serif' => 'Mate',
		'Philosopher, serif' => 'Philosopher',
		'Rokkitt, serif' => 'Rokkit',
		'Trykker, serif' => 'Trykker',
		'Quando, serif' => 'Quando',
		'Quattrocento, serif' => 'Quattrocento'	
	);
	return $google_serif_faces;
}

function options_typography_get_google_fonts_sans() {
	$google_sans_faces = array(
		'sans-serif' => '# GOOGLE SANS-SERIF (Section Title...do not select)',
		'"Droid Sans", sans-serif' => 'Droid Sans',
		'Exo, sans-serif' => 'Exo',
		'Geo, sans-serif' => 'Geo',
		'"Josefin Sans", sans-serif' => 'Josefin Sans',
		'Lato, sans-serif' => 'Lato',
		'Marvel, sans-serif' => 'Marvel',
		'Nobile, sans-serif' => 'Nobile',
		'Nunito, sans-serif' => 'Nunito',
		'"Open Sans", sans-serif' => 'Open Sans',
		'Play, sans-serif' => 'Play',
		'"PT Sans", sans-serif' => 'PT Sans',
		'Ubuntu, sans-serif' => 'Ubuntu'
	);
	return $google_sans_faces;
}		

function options_typography_get_google_fonts_mono() {
	$google_mono_faces = array(
		'monospace' => '# GOOGLE MONOSPACE (Section Title...do not select)',
		'"Ubuntu Mono", monospace' => 'Ubuntu Mono',
		'"Nova Mono", monospace' => 'Nova Mono',
		'"PT Mono", monospace' => 'PT Mono',
		'"Droid Sans Mono", monospace' => 'Droid Sans Mono',	
	);
	return $google_mono_faces;
}	

function options_typography_get_google_fonts_display() {
	$google_display_faces = array(
		'cursive' => '# GOOGLE DISPLAY (Section Title...do not select)',
		'Acme, sans-serif' => 'Acme',
		'Anton, sans-serif' => 'Anton',
		'Amarante, serif' => 'Amarante',
		'Arvo, serif' => 'Arvo',
		'Bangers, sans-serif' => 'Bangers',
		'Bevan, serif' => 'Bevan',
		'"Black Ops One", sans-serif' => 'Black Ops One',
		'"Cabin Sketch", sans-serif' => 'Cabin Sketch',
		'"Changa One", sans-serif' => 'Changa One',
		'"Cherry Cream Soda", sans-serif' => 'Cherry Cream Soda',
		'Codystar, sans-serif' => 'Codystar',
		'Comfortas, sans-serif' => 'Comfortas',
		'Copse, sans-serif' => 'Copse',
		'Courgette, serif' => 'Courgette',
		'Crushed, sans-serif' => 'Crushed',
		'Cuprum, sans-serif' => 'Cuprum',
		'"Diplomata SC", serif' => 'Diplomata SC',
		'"Eagle Lake", serif' => 'Eagle Lake',
		'"Francois One", sans-serif' => 'Francois One',
		'"Fredricka the Great, serif' => 'Fredricka the Great',
		'"Fredoka One", sans-serif' => 'Fredoka One',
		'Galindo, sans-serif' => 'Galindo',
		'Gorditas, serif' => 'Gorditas',
		'"IM Fell French Canon SC", serif' => 'IM Fell French Canon SC',
		'"Kotta One", serif' => 'Kotta One',
		'"Life Savers", serif' => 'Life Savers',
		'Limelight, serif' => 'Limelight',
		'"Luckiest Guy", sans-serif' => 'Luckiest Guy',	
		'Lobster, serif' => 'Lobster',
		'"Lobster Two", serif' => 'Lobster Two',
		'"Love Ya Like A Sister", serif' => 'Love Ya Like A Sister',
		'"Mate SC", serif' => 'Mate SC',
		'McLaren, sans-serif' => 'McLaren',
		'"Merienda One", serif' => 'Merienda One',
		'Metamorphous, serif' => 'Metamorphous',
		'Michroma, sans-serif' => 'Michroma',
		'"Mystery Quest", serif' => 'Mystery Quest',
		'Oregano, serif' => 'Oregano',
		'Oswald, sans-serif' => 'Oswald',
		'"Paytone One", sans-serif' => 'Paytone One',
		'Peralta, serif' => 'Peralta',
		'"Racing Sans One", sans-serif' => 'Racing Sans One',
		'Raleway, sans-serif' => 'Raleway',
		'Righteous, sans-serif' => 'Righteous',
		'"Squada One", sans-serif' => 'Squada One',
		'Syncopate, sans-serif' => 'Syncopate',
		'Ultra, serif' => 'Ultra',
		'Unkempt, serif' => 'Unkempt',
		'"Yanone Kaffeesatz", sans-serif' => 'Yanone Kaffeesatz'	
	);
	return $google_display_faces;	
}


/* 
 * Returns a typography option in a format that can be outputted as inline CSS
 */
 
function options_typography_font_styles($option, $selectors) {
		$output = $selectors . ' {';
		$output .= 'color:' . $option['color'] .'; ';
		$output .= 'font-family:' . $option['face'] . '; ';
		$output .= 'font-weight:' . $option['style'] . '; ';
		$output .= 'font-size:' . $option['size'] . '; ';
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
		$google_serif_array = array_keys( options_typography_get_google_fonts_serif() );
		$google_sans_array = array_keys( options_typography_get_google_fonts_sans() );
		$google_mono_array = array_keys( options_typography_get_google_fonts_mono() );
		$google_display_array = array_keys( options_typography_get_google_fonts_display() );
		// Define all the options that possibly have a unique Google font
		$ws_brand_font_type = of_get_option('ws_brand_font_type', false);	
		$ws_sansfontfamily = of_get_option('ws_sansfontfamily', false);
		$ws_seriffontfamily = of_get_option('ws_seriffontfamily', false);
		$ws_monofontfamily = of_get_option('ws_monofontfamily', false);
		$ws_basefont = of_get_option('ws_basefont', false);	
		$ws_headingsfont = of_get_option('ws_headingsfont', false);
		$ws_h1font = of_get_option('ws_h1font', false);
		// Get the font face for each option and put it in an array
		$selected_fonts = array(
			$ws_brand_font_type['face'],
			$ws_sansfontfamily,
			$ws_seriffontfamily,
			$ws_monofontfamily,
			$ws_basefont['face'],			
			$ws_headingsfont['face'],
			$ws_h1font['face'] );
		// Remove any duplicates in the list
		$selected_fonts = array_unique($selected_fonts);
		// Check each of the unique fonts against the defined Google fonts
		// If it is a Google font, go ahead and call the function to enqueue it
		foreach ( $selected_fonts as $font ) {
			if ( in_array( $font, $google_serif_array ) ||  in_array( $font, $google_sans_array ) || in_array( $font, $google_display_array ) || in_array( $font, $google_mono_array ) ) {
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