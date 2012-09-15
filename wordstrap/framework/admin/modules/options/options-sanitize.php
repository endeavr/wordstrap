<?php

/* Text (Extended by WordStrap) */

function ws_of_sanitize_text($input) {
	$allowedtags = wordstrap_allowed_tags( false );
	$output = wp_kses( $input, $allowedtags);
	$output = str_replace( "\r\n", "\n", $output );
	return $output;
}

add_filter( 'ws_of_sanitize_text', 'ws_of_sanitize_text' );

/* Textarea */

function ws_of_sanitize_textarea($input) {
	$allowedtags = wordstrap_allowed_tags( true );
	$output = wp_kses( $input, $allowedtags);
	$output = str_replace( "\r\n", "\n", $output );
	return $output;
}

add_filter( 'ws_of_sanitize_textarea', 'ws_of_sanitize_textarea' );

/* Info */

function ws_of_sanitize_allowedtags($input) {
	$allowedtags = wordstrap_allowed_tags( false );
	$output = wpautop(wp_kses( $input, $allowedtags));
	return $output;
}

add_filter( 'ws_of_sanitize_info', 'ws_of_sanitize_allowedtags' );

/* Select */

add_filter( 'ws_of_sanitize_select', 'ws_of_sanitize_enum', 10, 2);

/* Radio */

add_filter( 'ws_of_sanitize_radio', 'ws_of_sanitize_enum', 10, 2);

/* Images */

add_filter( 'ws_of_sanitize_images', 'ws_of_sanitize_enum', 10, 2);

/* Checkbox */

function ws_of_sanitize_checkbox( $input ) {
	if ( $input ) {
		$output = "1";
	} else {
		$output = "0";
	}
	return $output;
}
add_filter( 'ws_of_sanitize_checkbox', 'ws_of_sanitize_checkbox' );

/* Multicheck */

function ws_of_sanitize_multicheck( $input, $option ) {
	$output = '';
	if ( is_array( $input ) ) {
		foreach( $option['options'] as $key => $value ) {
			$output[$key] = "0";
		}
		foreach( $input as $key => $value ) {
			if ( array_key_exists( $key, $option['options'] ) && $value ) {
				$output[$key] = "1"; 
			}
		}
	}
	return $output;
}
add_filter( 'ws_of_sanitize_multicheck', 'ws_of_sanitize_multicheck', 10, 2 );

/* Color Picker */

add_filter( 'ws_of_sanitize_color', 'ws_of_sanitize_hex' );

/* Uploader */

function ws_of_sanitize_upload( $input ) {
	$output = '';
	$filetype = wp_check_filetype($input);
	if ( $filetype["ext"] ) {
		$output = $input;
	}
	return $output;
}
add_filter( 'ws_of_sanitize_upload', 'ws_of_sanitize_upload' );

/* Check that the key value sent is valid */

function ws_of_sanitize_enum( $input, $option ) {
	$output = '';
	if ( array_key_exists( $input, $option['options'] ) ) {
		$output = $input;
	}
	return $output;
}

/* Background */

function ws_of_sanitize_background( $input ) {
	$output = wp_parse_args( $input, array(
		'color' => '',
		'image'  => '',
		'repeat'  => 'repeat',
		'position' => 'top center',
		'attachment' => 'scroll'
	) );

	$output['color'] = apply_filters( 'ws_of_sanitize_hex', $input['color'] );
	$output['image'] = apply_filters( 'ws_of_sanitize_upload', $input['image'] );
	$output['repeat'] = apply_filters( 'of_background_repeat', $input['repeat'] );
	$output['position'] = apply_filters( 'of_background_position', $input['position'] );
	$output['attachment'] = apply_filters( 'of_background_attachment', $input['attachment'] );

	return $output;
}
add_filter( 'ws_of_sanitize_background', 'ws_of_sanitize_background' );

function ws_of_sanitize_background_repeat( $value ) {
	$recognized = ws_of_recognized_background_repeat();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'of_default_background_repeat', current( $recognized ) );
}
add_filter( 'of_background_repeat', 'ws_of_sanitize_background_repeat' );

function ws_of_sanitize_background_position( $value ) {
	$recognized = ws_of_recognized_background_position();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'of_default_background_position', current( $recognized ) );
}
add_filter( 'of_background_position', 'ws_of_sanitize_background_position' );

function ws_of_sanitize_background_attachment( $value ) {
	$recognized = ws_of_recognized_background_attachment();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'of_default_background_attachment', current( $recognized ) );
}
add_filter( 'of_background_attachment', 'ws_of_sanitize_background_attachment' );


/* Typography */

function ws_of_sanitize_typography( $input ) {
	$output = wp_parse_args( $input, array(
		'size' 		=> '',
		'face'  	=> '',
		'style' 	=> '',
		'color' 	=> '',
		'google' 	=> ''
	) );

	$output['size']  = apply_filters( 'of_font_size', $output['size'] );
	$output['face']  = apply_filters( 'of_font_face', $output['face'] );
	$output['style'] = apply_filters( 'of_font_style', $output['style'] );
	$output['color'] = apply_filters( 'of_color', $output['color'] );
	$output['google'] = apply_filters( 'ws_of_sanitize_text', $output['google'] );

	return $output;
}
add_filter( 'ws_of_sanitize_typography', 'ws_of_sanitize_typography' );


function ws_of_sanitize_font_size( $value ) {
	$recognized = ws_of_recognized_font_sizes();
	$value = preg_replace('/px/','', $value);
	if ( in_array( (int) $value, $recognized ) ) {
		return (int) $value;
	}
	return (int) apply_filters( 'of_default_font_size', $recognized );
}
add_filter( 'of_font_face', 'ws_of_sanitize_font_face' );


function ws_of_sanitize_font_style( $value ) {
	$recognized = ws_of_recognized_font_styles();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'of_default_font_style', current( $recognized ) );
}
add_filter( 'of_font_style', 'ws_of_sanitize_font_style' );


function ws_of_sanitize_font_face( $value ) {
	$recognized = ws_of_recognized_font_faces();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'of_default_font_face', current( $recognized ) );
}
add_filter( 'of_font_face', 'ws_of_sanitize_font_face' );



/*-----------------------------------------------------------------------------------*/
/* Sanitization for custom options added by WordStrap (start)
/*-----------------------------------------------------------------------------------*/

/* Columns */

function ws_of_sanitize_columns( $input ) {

	$width_options = wordstrap_column_widths();
	$output = array();

	// Verify number of columns is an integer
	if( is_numeric( $input['num'] ) )
		$output['num'] = $input['num'];
	else
		$output['num'] = null;
	
	// Verify widths
	foreach( $input['width'] as $key => $width ) {
		$valid = false;
		foreach( $width_options[$key.'-col'] as $width_option )
			if( $width == $width_option['value'] )
				$valid = true;
		if( $valid )
			$output['width'][$key] = $width;
		else
			$output['width'][$key] = null;
	}
	
	return $output;
}

add_filter( 'ws_of_sanitize_columns', 'ws_of_sanitize_columns' );

/* Tabs */

function ws_of_sanitize_tabs( $input ) {
	
	$output = array();
	
	// Verify number of tabs is an integer
	if( is_numeric( $input['num'] ) )
		$output['num'] = $input['num'];
	else
		$output['num'] = null;
	
	// Verify style
	if( $input['style'] == 'open' || $input['style'] == 'framed' )
		$output['style'] = $input['style'];
	
	// Verify name fields and only save the right amount of names
	if( $output['num'] ) {
		$total_num = intval( $output['num'] );
		$i = 1;
		while( $i <= $total_num ) {
			$output['names']['tab_'.$i] = sanitize_text_field( $input['names']['tab_'.$i] );
			$i++;
		}
	}
	return $output;	
}

add_filter( 'ws_of_sanitize_tabs', 'ws_of_sanitize_tabs' );

/* Dynamic Content */

function ws_of_sanitize_content( $input ) {
	
	$allowedtags = wordstrap_allowed_tags( true );
	$output = array();
	
	// Verify type
	$types = array( 'widget', 'page', 'raw' );
	if( in_array( $input['type'], $types ) )
		$output['type'] = $input['type'];
	else
		$output['type'] = null;
	
	// Add type's corresponding option
	switch( $output['type'] ) {
		case 'widget' :
			if( isset( $input['sidebar'] ) )
				$output['sidebar'] = $input['sidebar'];
			else
				$output['sidebar'] = null;
			break;
		case 'page' :
			$output['page'] = $input['page'];
			break;
		case 'raw' :
			$output['raw'] = wp_kses( $input['raw'], $allowedtags );
			$output['raw'] = str_replace( "\r\n", "\n", $output['raw'] );
			isset( $input['raw_format'] ) ? $output['raw_format'] = '1' : $output['raw_format'] = '0';
			break;
	}
	
	return $output;	
}

add_filter( 'ws_of_sanitize_content', 'ws_of_sanitize_content' );

/* Logo */

function ws_of_sanitize_logo( $input ) {
	
	$output = array();
	
	// Type 
	if( is_array( $input ) && isset( $input['type'] ) )
		$output['type'] = $input['type'];
	
	if( isset( $output['type'] ) ) {
		switch( $output['type'] ) {
			case 'custom' :
				if( isset( $input['custom'] ) )
					$output['custom'] = sanitize_text_field( $input['custom'] );
				if( isset( $input['custom_tagline'] ) )
					$output['custom_tagline'] = sanitize_text_field( $input['custom_tagline'] );
				break;
			case 'image' :
				$filetype = wp_check_filetype( $input['image'] );
				if ( $filetype["ext"] )
					$output['image'] = $input['image'];
				else
					$output['image'] = null;
				break;
		}
	}

	return $output;
}

add_filter( 'ws_of_sanitize_logo', 'ws_of_sanitize_logo' );

/* Social Media Buttons */

function ws_of_sanitize_social_media( $input ) {
	if( ! empty( $input['sources'] ) ) {
		// The option is being sent from the actual 
		// Theme Options page and so it hasn't been 
		// formatted yet.
		$output = array();
		if( ! empty( $input['includes'] ) ) {
			foreach( $input['includes'] as $include ) {
				if( isset( $input['sources'][$include] ) )	
					$output[$include] = $input['sources'][$include];
			}
		}
	} else {
		// The option has already been formatted, 
		// so let it on through.
		$output = $input;
	}	
	return $output;
}

add_filter( 'ws_of_sanitize_social_media', 'ws_of_sanitize_social_media' );

/* Conditionals */

function ws_of_sanitize_conditionals( $input, $sidebar_slug = null, $sidebar_id = null ) {
	$conditionals = wordstrap_conditionals_config();
	$output = array();
	foreach( $input as $type => $group ) {
		foreach( $group as $item_id ) {
			switch( $type ) {
				case 'page' :
					$page_id = wordstrap_post_id_by_name( $item_id, 'page' );
					$page = get_page( $page_id );
					$name = $page->post_title;
					break;
				case 'post' :
					$post_id = wordstrap_post_id_by_name( $item_id, 'post' );
					$post = get_post( $post_id );
					$name = $post->post_title;
					break;
				case 'posts_in_category' :
					$category = get_category_by_slug( $item_id );
					$name = $category->slug;
					break;
				case 'category' :
					$category = get_category_by_slug( $item_id );
					$name = $category->slug;
					break;
				case 'tag' :
					$tag = get_term_by( 'slug', $item_id, 'post_tag' );
					$name = $tag->name;
					break;
				case 'top' :
					$name = $conditionals['top']['items'][$item_id];
					break;
			}
			$output[$type.'_'.$item_id] = array(
				'type' 		=> $type,
				'id' 		=> $item_id,
				'name' 		=> $name,
				'post_slug' => $sidebar_slug,
				'post_id' 	=> $sidebar_id
			);
		}
	}
	return $output;
}

add_filter( 'ws_of_sanitize_conditionals', 'ws_of_sanitize_conditionals', 10, 3 );

/*-----------------------------------------------------------------------------------*/
/* Sanitization for custom options added by WordStrap (end)
/*-----------------------------------------------------------------------------------*/



/**
 * Get recognized background repeat settings
 *
 * @return   array
 *
 */
function ws_of_recognized_background_repeat() {
	$default = array(
		'no-repeat' => 'No Repeat',
		'repeat-x'  => 'Repeat Horizontally',
		'repeat-y'  => 'Repeat Vertically',
		'repeat'    => 'Repeat All',
		);
	return apply_filters( 'ws_of_recognized_background_repeat', $default );
}

/**
 * Get recognized background positions
 *
 * @return   array
 *
 */
function ws_of_recognized_background_position() {
	$default = array(
		'top left'      => 'Top Left',
		'top center'    => 'Top Center',
		'top right'     => 'Top Right',
		'center left'   => 'Middle Left',
		'center center' => 'Middle Center',
		'center right'  => 'Middle Right',
		'bottom left'   => 'Bottom Left',
		'bottom center' => 'Bottom Center',
		'bottom right'  => 'Bottom Right'
		);
	return apply_filters( 'ws_of_recognized_background_position', $default );
}

/**
 * Get recognized background attachment
 *
 * @return   array
 *
 */
function ws_of_recognized_background_attachment() {
	$default = array(
		'scroll' => 'Scroll Normally',
		'fixed'  => 'Fixed in Place'
		);
	return apply_filters( 'ws_of_recognized_background_attachment', $default );
}

/**
 * Sanitize a color represented in hexidecimal notation.
 *
 * @param    string    Color in hexidecimal notation. "#" may or may not be prepended to the string.
 * @param    string    The value that this function should return if it cannot be recognized as a color.
 * @return   string
 *
 */
 
function ws_of_sanitize_hex( $hex, $default = '' ) {
	if ( ws_of_validate_hex( $hex ) ) {
		return $hex;
	}
	return $default;
}

/**
 * Get recognized font sizes.
 *
 * Returns an indexed array of all recognized font sizes.
 * Values are integers and represent a range of sizes from
 * smallest to largest.
 *
 * @return   array
 */
 
function ws_of_recognized_font_sizes() {
	$sizes = range( 9, 71 );
	$sizes = apply_filters( 'ws_of_recognized_font_sizes', $sizes );
	$sizes = array_map( 'absint', $sizes );
	return $sizes;
}

/**
 * Get recognized font faces.
 *
 * Returns an array of all recognized font faces.
 * Keys are intended to be stored in the database
 * while values are ready for display in in html.
 *
 * @return   array
 *
 */
 
function ws_of_recognized_font_faces() {
	$default = array(
		'arial'     	=> 'Arial',
		'baskerville'	=> 'Baskerville',
		'georgia'   	=> 'Georgia',
		'helvetica' 	=> 'Helvetica*',
		'lucida'  		=> 'Lucida Sans',
		'palatino'  	=> 'Palatino',
		'tahoma'    	=> 'Tahoma, Geneva',
		'times'     	=> 'Times New Roman',
		'trebuchet' 	=> 'Trebuchet',
		'verdana'   	=> 'Verdana, Geneva',
		'google'		=> 'Google Font'
	);
	return apply_filters( 'ws_of_recognized_font_faces', $default );
}

/**
 * Get recognized font styles.
 *
 * Returns an array of all recognized font styles.
 * Keys are intended to be stored in the database
 * while values are ready for display in in html.
 *
 * @return   array
 *
 */

function ws_of_recognized_font_styles() {
	$default = array(
		'normal'      => 'Normal',
		'italic'      => 'Italic',
		'bold'        => 'Bold',
		'bold italic' => 'Bold Italic'
	);
	return apply_filters( 'ws_of_recognized_font_styles', $default );
}

/**
 * Is a given string a color formatted in hexidecimal notation?
 *
 * @param    string    Color in hexidecimal notation. "#" may or may not be prepended to the string.
 * @return   bool
 *
 */
 
function ws_of_validate_hex( $hex ) {
	$hex = trim( $hex );
	/* Strip recognized prefixes. */
	if ( 0 === strpos( $hex, '#' ) ) {
		$hex = substr( $hex, 1 );
	}
	else if ( 0 === strpos( $hex, '%23' ) ) {
		$hex = substr( $hex, 3 );
	}
	/* Regex match. */
	if ( 0 === preg_match( '/^[0-9a-fA-F]{6}$/', $hex ) ) {
		return false;
	}
	else {
		return true;
	}
}