<?php

/**
 * Generates the tabs that are used in the options menu
 
 CUSTOM CHANGELOG
 1. Heading tabs function and output in 2 places -> Added the <i class="icon"></i>
 2. Added custom interface types for patterns: BODY, HEADER, MASTHEAD, NAVBAR, WRAP, SIDEBAR, FOOTER, COLOPHON.
 3. Added custom interface type: NOTE. Excluded NOTE from certain formatting / saving + made sure it is wrapped just like Info and Heading.
 4. Added custom interface types in order to wrap option sections in accordion toggle UI: INFOTOGGLE + CLOSETOGGLE. These also needed to be excluded from formatting/saving.
 
 */

function optionsframework_tabs() {

	$optionsframework_settings = get_option('optionsframework');
	$options = optionsframework_options();
	$menu = '';

	foreach ($options as $value) {
		// Heading for Navigation => Added <i class="icon"></i> ----------> 2012.10.20
		if ($value['type'] == "heading") {
			$jquery_click_hook = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($value['name']) );
			$jquery_click_hook = "of-option-" . $jquery_click_hook;
			$menu .= '<a id="'.  esc_attr( $jquery_click_hook ) . '-tab" class="nav-tab" title="' . esc_attr( $value['name'] ) . '" href="' . esc_attr( '#'.  $jquery_click_hook ) . '"><i class="icon-' . esc_attr( $value['name'] ) . '"></i><span class="heading">' . esc_html( $value['name'] ) . '</span></a>';  
		}
	}

	return $menu;
}

/**
 * Generates the options fields that are used in the form.
 */

function optionsframework_fields() {

	global $allowedtags;
	$optionsframework_settings = get_option('optionsframework');

	// Gets the unique option id
	if ( isset( $optionsframework_settings['id'] ) ) {
		$option_name = $optionsframework_settings['id'];
	}
	else {
		$option_name = 'optionsframework';
	};

	$settings = get_option($option_name);
	$options = optionsframework_options();

	$counter = 0;
	$menu = '';

	foreach ( $options as $value ) {

		$counter++;
		$val = '';
		$select_value = '';
		$checked = '';
		$output = '';

		// Wrap all options
		if ( ( $value['type'] != "heading" ) && ( $value['type'] != "info" ) && ( $value['type'] != "note" ) && ( $value['type'] != "infotoggle" ) && ( $value['type'] != "closetoggle" ) ) {

			// Keep all ids lowercase with no spaces
			$value['id'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($value['id']) );

			$id = 'section-' . $value['id'];

			$class = 'section ';
			if ( isset( $value['type'] ) ) {
				$class .= ' section-' . $value['type'];
			}
			if ( isset( $value['class'] ) ) {
				$class .= ' ' . $value['class'];
			}

			$output .= '<div id="' . esc_attr( $id ) .'" class="' . esc_attr( $class ) . '">'."\n";
			if ( isset( $value['name'] ) ) {
				$output .= '<h4 class="heading">' . esc_html( $value['name'] ) . '</h4>' . "\n";
			}
			if ( $value['type'] != 'editor' ) {
				$output .= '<div class="option">' . "\n" . '<div class="controls">' . "\n";
			}
			else {
				$output .= '<div class="option">' . "\n" . '<div>' . "\n";
			}
		}

		// Set default value to $val
		if ( isset( $value['std'] ) ) {
			$val = $value['std'];
		}

		// If the option is already saved, override $val
		if ( ( $value['type'] != 'heading' ) && ( $value['type'] != 'info') && ( $value['type'] != 'note') && ( $value['type'] != "infotoggle" ) && ( $value['type'] != "closetoggle" ) ) {
			if ( isset( $settings[($value['id'])]) ) {
				$val = $settings[($value['id'])];
				// Striping slashes of non-array options
				if ( !is_array($val) ) {
					$val = stripslashes( $val );
				}
			}
		}

		// If there is a description save it for labels
		$explain_value = '';
		if ( isset( $value['desc'] ) ) {
			$explain_value = $value['desc'];
		}

		switch ( $value['type'] ) {

		// Basic text input
		case 'text':
			$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="of-input" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" type="text" value="' . esc_attr( $val ) . '" />';
			break;

		// Textarea
		case 'textarea':
			$rows = '8';

			if ( isset( $value['settings']['rows'] ) ) {
				$custom_rows = $value['settings']['rows'];
				if ( is_numeric( $custom_rows ) ) {
					$rows = $custom_rows;
				}
			}

			$val = stripslashes( $val );
			$output .= '<textarea id="' . esc_attr( $value['id'] ) . '" class="of-input" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" rows="' . $rows . '">' . esc_textarea( $val ) . '</textarea>';
			break;

		// Select Box
		case ($value['type'] == 'select'):
			$output .= '<select class="of-input" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" id="' . esc_attr( $value['id'] ) . '">';

			foreach ($value['options'] as $key => $option ) {
				$selected = '';
				if ( $val != '' ) {
					if ( $val == $key) { $selected = ' selected="selected"';}
				}
				$output .= '<option'. $selected .' value="' . esc_attr( $key ) . '">' . esc_html( $option ) . '</option>';
			}
			$output .= '</select>';
			break;


		// Radio Box
		case "radio":
			$name = $option_name .'['. $value['id'] .']';
			foreach ($value['options'] as $key => $option) {
				$id = $option_name . '-' . $value['id'] .'-'. $key;
				$output .= '<input class="of-input of-radio" type="radio" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="'. esc_attr( $key ) . '" '. checked( $val, $key, false) .' /><label for="' . esc_attr( $id ) . '">' . esc_html( $option ) . '</label>';
			}
			break;

 		// Image Selectors
 		case "images":
 			$name = $option_name .'['. $value['id'] .']';
 			foreach ( $value['options'] as $key => $option ) {
 				$selected = '';
 				$checked = '';
 				if ( $val != '' ) {
 					if ( $val == $key ) {
 						$selected = ' of-radio-img-selected';
 						$checked = ' checked="checked"';
 					}
 				}
 				$output .= '<input type="radio" id="' . esc_attr( $value['id'] .'_'. $key) . '" class="of-radio-img-radio" value="' . esc_attr( $key ) . '" name="' . esc_attr( $name ) . '" '. $checked .' />';
 				$output .= '<div class="of-radio-img-label">' . esc_html( $key ) . '</div>';
 				$output .= '<img src="' . esc_url( $option ) . '" alt="' . $option .'" class="of-radio-img-img' . $selected .'" onclick="document.getElementById(\''. esc_attr($value['id'] .'_'. $key) .'\').checked=true;" />';
 			}
 			break;
 			
 		// Info Toggle (CUSTOM) ----------> 2012.10.20
		case "infotoggle":
			$id = '';
			$class = '';
			if ( isset( $value['id'] ) ) {
				$id = 'id="' . esc_attr( $value['id'] ) . '" ';
			}
			if ( isset( $value['type'] ) ) {
				$class .= ' section-' . $value['type'];
			}
			if ( isset( $value['class'] ) ) {
				$class .= ' ' . $value['class'];
			}

			$output .= '<div ' . $id . 'class="postbox closed ' . esc_attr( $class ) . '"><div class="handlediv" title="Click to toggle"><br></div>' . "\n";
			if ( isset($value['name']) ) {
				$output .= '<h3 class="hndle"><span>' . esc_html( $value['name'] ) . '</span></h3>' . "\n";
			}
			if ( $value['desc'] ) {
				$output .= '<div class="inside"><div class="infodesc">' . apply_filters('of_sanitize_info', $value['desc'] ) . '</div>' . "\n";
			}

			break;	
			
		// Close Toggle (CUSTOM) ----------> 2012.10.20
		case "closetoggle":
			$output .= '</div></div>' . "\n";
			break;			
 			
 		// NOTE (CUSTOM) ----------> 2012.10.20
		case "note":
			$id = '';
			$class = 'section';
			if ( isset( $value['id'] ) ) {
				$id = 'id="' . esc_attr( $value['id'] ) . '" ';
			}
			if ( isset( $value['type'] ) ) {
				$class .= ' section-' . $value['type'];
			}
			if ( isset( $value['class'] ) ) {
				$class .= ' ' . $value['class'];
			}

			$output .= '<div ' . $id . 'class="' . esc_attr( $class ) . '">' . "\n";
			if ( isset($value['name']) ) {
				$output .= '<h5 class="note">' . esc_html( $value['name'] ) . '</h5>' . "\n";
			}
			if ( $value['desc'] ) {
				$output .= apply_filters('of_sanitize_info', $value['desc'] ) . "\n";
			}
			$output .= '</div>' . "\n";
			break;			
 			
 	     // BODY Pattern (CUSTOM) ----------> 2012.10.20
	     case "bodypattern":
	
			$bodybkgd = of_get_option('ws_bodybackground');
			$name = $option_name .'['. $value['id'] .']';
			foreach ( $value['options'] as $key => $option ) {
				$selected = '';
				$checked = '';
				if ( $val != '' ) {
					if ( $val == $key ) {
						$selected = ' of-radio-img-selected';
						$checked = ' checked="checked"';
					}
				}
				$output .= '<input type="radio" id="' . esc_attr( $value['id'] .'_'. $key) . '" class="of-radio-img-radio" value="' . esc_attr( $key ) . '" name="' . esc_attr( $name ) . '" '. $checked .' />';
				$output .= '<div class="of-radio-img-label">' . esc_html( $key ) . '</div>';
				$output .= '<div style="background-image:url(' . esc_url( $option ) . '); background-color:' . esc_attr( $bodybkgd ) .';" class="radio-img-css-bkgd of-radio-img-img' . $selected .'" onclick="document.getElementById(\''. esc_attr($value['id'] .'_'. $key) .'\').checked=true;"></div>';
			}
			break;										
			
		// HEADER Pattern (CUSTOM) ----------> 2012.10.20
		case "headerpattern":

			$headerbkgd = of_get_option('ws_headerbackground');
			$name = $option_name .'['. $value['id'] .']';
			foreach ( $value['options'] as $key => $option ) {
				$selected = '';
				$checked = '';
				if ( $val != '' ) {
					if ( $val == $key ) {
						$selected = ' of-radio-img-selected';
						$checked = ' checked="checked"';
					}
				}
				$output .= '<input type="radio" id="' . esc_attr( $value['id'] .'_'. $key) . '" class="of-radio-img-radio" value="' . esc_attr( $key ) . '" name="' . esc_attr( $name ) . '" '. $checked .' />';
				$output .= '<div class="of-radio-img-label">' . esc_html( $key ) . '</div>';
				$output .= '<div style="background-image:url(' . esc_url( $option ) . '); background-color:' . esc_attr( $headerbkgd ) .';" class="radio-img-css-bkgd of-radio-img-img' . $selected .'" onclick="document.getElementById(\''. esc_attr($value['id'] .'_'. $key) .'\').checked=true;"></div>';
			}
			break;			
			
		// MAST Pattern (CUSTOM) ----------> 2012.10.20
		case "mastpattern":

			$headerbkgd = of_get_option('ws_mastbackground');
			$name = $option_name .'['. $value['id'] .']';
			foreach ( $value['options'] as $key => $option ) {
				$selected = '';
				$checked = '';
				if ( $val != '' ) {
					if ( $val == $key ) {
						$selected = ' of-radio-img-selected';
						$checked = ' checked="checked"';
					}
				}
				$output .= '<input type="radio" id="' . esc_attr( $value['id'] .'_'. $key) . '" class="of-radio-img-radio" value="' . esc_attr( $key ) . '" name="' . esc_attr( $name ) . '" '. $checked .' />';
				$output .= '<div class="of-radio-img-label">' . esc_html( $key ) . '</div>';
				$output .= '<div style="background-image:url(' . esc_url( $option ) . '); background-color:' . esc_attr( $headerbkgd ) .';" class="radio-img-css-bkgd of-radio-img-img' . $selected .'" onclick="document.getElementById(\''. esc_attr($value['id'] .'_'. $key) .'\').checked=true;"></div>';
			}
			break;	
			
		// NAVBAR Pattern (CUSTOM) ----------> 2012.10.20
		case "navbarpattern":

			$headerbkgd = of_get_option('ws_navbarbackground');
			$name = $option_name .'['. $value['id'] .']';
			foreach ( $value['options'] as $key => $option ) {
				$selected = '';
				$checked = '';
				if ( $val != '' ) {
					if ( $val == $key ) {
						$selected = ' of-radio-img-selected';
						$checked = ' checked="checked"';
					}
				}
				$output .= '<input type="radio" id="' . esc_attr( $value['id'] .'_'. $key) . '" class="of-radio-img-radio" value="' . esc_attr( $key ) . '" name="' . esc_attr( $name ) . '" '. $checked .' />';
				$output .= '<div class="of-radio-img-label">' . esc_html( $key ) . '</div>';
				$output .= '<div style="background-image:url(' . esc_url( $option ) . '); background-color:' . esc_attr( $headerbkgd ) .';" class="radio-img-css-bkgd of-radio-img-img' . $selected .'" onclick="document.getElementById(\''. esc_attr($value['id'] .'_'. $key) .'\').checked=true;"></div>';
			}
			break;								
			
		// WRAP Pattern (CUSTOM) ----------> 2012.10.20
		case "wrappattern":

			$wrapbkgd = of_get_option('ws_wrapbackground');
			$name = $option_name .'['. $value['id'] .']';
			foreach ( $value['options'] as $key => $option ) {
				$selected = '';
				$checked = '';
				if ( $val != '' ) {
					if ( $val == $key ) {
						$selected = ' of-radio-img-selected';
						$checked = ' checked="checked"';
					}
				}
				$output .= '<input type="radio" id="' . esc_attr( $value['id'] .'_'. $key) . '" class="of-radio-img-radio" value="' . esc_attr( $key ) . '" name="' . esc_attr( $name ) . '" '. $checked .' />';
				$output .= '<div class="of-radio-img-label">' . esc_html( $key ) . '</div>';
				$output .= '<div style="background-image:url(' . esc_url( $option ) . '); background-color:' . esc_attr( $wrapbkgd ) .';" class="radio-img-css-bkgd of-radio-img-img' . $selected .'" onclick="document.getElementById(\''. esc_attr($value['id'] .'_'. $key) .'\').checked=true;"></div>';
			}
			break;
			
		// SIDEBAR Pattern (CUSTOM) ----------> 2012.10.20
		case "sidebarpattern":

			$headerbkgd = of_get_option('ws_sidebarbackground');
			$name = $option_name .'['. $value['id'] .']';
			foreach ( $value['options'] as $key => $option ) {
				$selected = '';
				$checked = '';
				if ( $val != '' ) {
					if ( $val == $key ) {
						$selected = ' of-radio-img-selected';
						$checked = ' checked="checked"';
					}
				}
				$output .= '<input type="radio" id="' . esc_attr( $value['id'] .'_'. $key) . '" class="of-radio-img-radio" value="' . esc_attr( $key ) . '" name="' . esc_attr( $name ) . '" '. $checked .' />';
				$output .= '<div class="of-radio-img-label">' . esc_html( $key ) . '</div>';
				$output .= '<div style="background-image:url(' . esc_url( $option ) . '); background-color:' . esc_attr( $headerbkgd ) .';" class="radio-img-css-bkgd of-radio-img-img' . $selected .'" onclick="document.getElementById(\''. esc_attr($value['id'] .'_'. $key) .'\').checked=true;"></div>';
			}
			break;			
			
		// FOOTER Pattern (CUSTOM) ----------> 2012.10.20
		case "footerpattern":

			$footerbkgd = of_get_option('ws_footerbackground');
			$name = $option_name .'['. $value['id'] .']';
			foreach ( $value['options'] as $key => $option ) {
				$selected = '';
				$checked = '';
				if ( $val != '' ) {
					if ( $val == $key ) {
						$selected = ' of-radio-img-selected';
						$checked = ' checked="checked"';
					}
				}
				$output .= '<input type="radio" id="' . esc_attr( $value['id'] .'_'. $key) . '" class="of-radio-img-radio" value="' . esc_attr( $key ) . '" name="' . esc_attr( $name ) . '" '. $checked .' />';
				$output .= '<div class="of-radio-img-label">' . esc_html( $key ) . '</div>';
				$output .= '<div style="background-image:url(' . esc_url( $option ) . '); background-color:' . esc_attr( $footerbkgd ) .';" class="radio-img-css-bkgd of-radio-img-img' . $selected .'" onclick="document.getElementById(\''. esc_attr($value['id'] .'_'. $key) .'\').checked=true;"></div>';
			}
			break;
			
		// COLOPHON Pattern (CUSTOM) ----------> 2012.10.20
		case "colophonpattern":

			$colophonbkgd = of_get_option('ws_colophonbackground');
			$name = $option_name .'['. $value['id'] .']';
			foreach ( $value['options'] as $key => $option ) {
				$selected = '';
				$checked = '';
				if ( $val != '' ) {
					if ( $val == $key ) {
						$selected = ' of-radio-img-selected';
						$checked = ' checked="checked"';
					}
				}
				$output .= '<input type="radio" id="' . esc_attr( $value['id'] .'_'. $key) . '" class="of-radio-img-radio" value="' . esc_attr( $key ) . '" name="' . esc_attr( $name ) . '" '. $checked .' />';
				$output .= '<div class="of-radio-img-label">' . esc_html( $key ) . '</div>';
				$output .= '<div style="background-image:url(' . esc_url( $option ) . '); background-color:' . esc_attr( $colophonbkgd ) .';" class="radio-img-css-bkgd of-radio-img-img' . $selected .'" onclick="document.getElementById(\''. esc_attr($value['id'] .'_'. $key) .'\').checked=true;"></div>';
			}
			break;											

		// Checkbox
		case "checkbox":
			$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="checkbox of-input" type="checkbox" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" '. checked( $val, 1, false) .' />';
			$output .= '<label class="explain" for="' . esc_attr( $value['id'] ) . '">' . wp_kses( $explain_value, $allowedtags) . '</label>';
			break;

		// Multicheck
		case "multicheck":
			foreach ($value['options'] as $key => $option) {
				$checked = '';
				$label = $option;
				$option = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($key));

				$id = $option_name . '-' . $value['id'] . '-'. $option;
				$name = $option_name . '[' . $value['id'] . '][' . $option .']';

				if ( isset($val[$option]) ) {
					$checked = checked($val[$option], 1, false);
				}

				$output .= '<input id="' . esc_attr( $id ) . '" class="checkbox of-input" type="checkbox" name="' . esc_attr( $name ) . '" ' . $checked . ' /><label for="' . esc_attr( $id ) . '">' . esc_html( $label ) . '</label>';
			}
			break;

		// Color picker
		case "color":
			$output .= '<div id="' . esc_attr( $value['id'] . '_picker' ) . '" class="colorSelector"><div style="' . esc_attr( 'background-color:' . $val ) . '"></div></div>';
			$output .= '<input class="of-color" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" id="' . esc_attr( $value['id'] ) . '" type="text" value="' . esc_attr( $val ) . '" />';
			break;

		// Uploader
		case "upload":
			$output .= optionsframework_medialibrary_uploader( $value['id'], $val, null );
			break;

			// Typography
		case 'typography':
		
			unset( $font_size, $font_style, $font_face, $font_color );
		
			$typography_defaults = array(
				'size' => '',
				'face' => '',
				'style' => '',
				'color' => ''
			);
			
			$typography_stored = wp_parse_args( $val, $typography_defaults );
			
			$typography_options = array(
				'sizes' => of_recognized_font_sizes(),
				'faces' => of_recognized_font_faces(),
				'styles' => of_recognized_font_styles(),
				'color' => true
			);
			
			if ( isset( $value['options'] ) ) {
				$typography_options = wp_parse_args( $value['options'], $typography_options );
			}

			// Font Size
			if ( $typography_options['sizes'] ) {
				$font_size = '<select class="of-typography of-typography-size" name="' . esc_attr( $option_name . '[' . $value['id'] . '][size]' ) . '" id="' . esc_attr( $value['id'] . '_size' ) . '">';
				$sizes = $typography_options['sizes'];
				foreach ( $sizes as $i ) {
					$size = $i . 'px';
					$font_size .= '<option value="' . esc_attr( $size ) . '" ' . selected( $typography_stored['size'], $size, false ) . '>' . esc_html( $size ) . '</option>';
				}
				$font_size .= '</select>';
			}

			// Font Face
			if ( $typography_options['faces'] ) {
				$font_face = '<select class="of-typography of-typography-face" name="' . esc_attr( $option_name . '[' . $value['id'] . '][face]' ) . '" id="' . esc_attr( $value['id'] . '_face' ) . '">';
				$faces = $typography_options['faces'];
				foreach ( $faces as $key => $face ) {
					$font_face .= '<option value="' . esc_attr( $key ) . '" ' . selected( $typography_stored['face'], $key, false ) . '>' . esc_html( $face ) . '</option>';
				}
				$font_face .= '</select>';
			}

			// Font Styles
			if ( $typography_options['styles'] ) {
				$font_style = '<select class="of-typography of-typography-style" name="'.$option_name.'['.$value['id'].'][style]" id="'. $value['id'].'_style">';
				$styles = $typography_options['styles'];
				foreach ( $styles as $key => $style ) {
					$font_style .= '<option value="' . esc_attr( $key ) . '" ' . selected( $typography_stored['style'], $key, false ) . '>'. $style .'</option>';
				}
				$font_style .= '</select>';
			}

			// Font Color
			if ( $typography_options['color'] ) {
				$font_color = '<div id="' . esc_attr( $value['id'] ) . '_color_picker" class="colorSelector"><div style="' . esc_attr( 'background-color:' . $typography_stored['color'] ) . '"></div></div>';
				$font_color .= '<input class="of-color of-typography of-typography-color" name="' . esc_attr( $option_name . '[' . $value['id'] . '][color]' ) . '" id="' . esc_attr( $value['id'] . '_color' ) . '" type="text" value="' . esc_attr( $typography_stored['color'] ) . '" />';
			}
	
			// Allow modification/injection of typography fields
			$typography_fields = compact( 'font_size', 'font_face', 'font_style', 'font_color' );
			$typography_fields = apply_filters( 'of_typography_fields', $typography_fields, $typography_stored, $option_name, $value );
			$output .= implode( '', $typography_fields );
			
			break;

		// Background
		case 'background':

			$background = $val;

			// Background Color
			$output .= '<div id="' . esc_attr( $value['id'] ) . '_color_picker" class="colorSelector"><div style="' . esc_attr( 'background-color:' . $background['color'] ) . '"></div></div>';
			$output .= '<input class="of-color of-background of-background-color" name="' . esc_attr( $option_name . '[' . $value['id'] . '][color]' ) . '" id="' . esc_attr( $value['id'] . '_color' ) . '" type="text" value="' . esc_attr( $background['color'] ) . '" />';

			// Background Image - New AJAX Uploader using Media Library
			if (!isset($background['image'])) {
				$background['image'] = '';
			}

			$output .= optionsframework_medialibrary_uploader( $value['id'], $background['image'], null, '',0,'image');
			$class = 'of-background-properties';
			if ( '' == $background['image'] ) {
				$class .= ' hide';
			}
			$output .= '<div class="' . esc_attr( $class ) . '">';

			// Background Repeat
			$output .= '<select class="of-background of-background-repeat" name="' . esc_attr( $option_name . '[' . $value['id'] . '][repeat]'  ) . '" id="' . esc_attr( $value['id'] . '_repeat' ) . '">';
			$repeats = of_recognized_background_repeat();

			foreach ($repeats as $key => $repeat) {
				$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $background['repeat'], $key, false ) . '>'. esc_html( $repeat ) . '</option>';
			}
			$output .= '</select>';

			// Background Position
			$output .= '<select class="of-background of-background-position" name="' . esc_attr( $option_name . '[' . $value['id'] . '][position]' ) . '" id="' . esc_attr( $value['id'] . '_position' ) . '">';
			$positions = of_recognized_background_position();

			foreach ($positions as $key=>$position) {
				$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $background['position'], $key, false ) . '>'. esc_html( $position ) . '</option>';
			}
			$output .= '</select>';

			// Background Attachment
			$output .= '<select class="of-background of-background-attachment" name="' . esc_attr( $option_name . '[' . $value['id'] . '][attachment]' ) . '" id="' . esc_attr( $value['id'] . '_attachment' ) . '">';
			$attachments = of_recognized_background_attachment();

			foreach ($attachments as $key => $attachment) {
				$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $background['attachment'], $key, false ) . '>' . esc_html( $attachment ) . '</option>';
			}
			$output .= '</select>';
			$output .= '</div>';

			break;		

		// Editor
		case 'editor':
			$output .= '<div class="explain">' . wp_kses( $explain_value, $allowedtags) . '</div>'."\n";
			echo $output;
			$textarea_name = esc_attr( $option_name . '[' . $value['id'] . ']' );
			$default_editor_settings = array(
				'textarea_name' => $textarea_name,
				'media_buttons' => false,
				'tinymce' => array( 'plugins' => 'wordpress' )
			);
			$editor_settings = array();
			if ( isset( $value['settings'] ) ) {
				$editor_settings = $value['settings'];
			}
			$editor_settings = array_merge($editor_settings, $default_editor_settings);
			wp_editor( $val, $value['id'], $editor_settings );
			$output = '';
			break;

		// Info
		case "info":
			$id = '';
			$class = 'section';
			if ( isset( $value['id'] ) ) {
				$id = 'id="' . esc_attr( $value['id'] ) . '" ';
			}
			if ( isset( $value['type'] ) ) {
				$class .= ' section-' . $value['type'];
			}
			if ( isset( $value['class'] ) ) {
				$class .= ' ' . $value['class'];
			}

			$output .= '<div ' . $id . 'class="' . esc_attr( $class ) . '">' . "\n";
			if ( isset($value['name']) ) {
				$output .= '<h4 class="heading">' . esc_html( $value['name'] ) . '</h4>' . "\n";
			}
			if ( $value['desc'] ) {
				$output .= apply_filters('of_sanitize_info', $value['desc'] ) . "\n";
			}
			$output .= '</div>' . "\n";
			break;								

		// Heading for Navigation => Added <i class="icon"></i> ----------> 2012.10.20
		case "heading":
			if ($counter >= 2) {
				$output .= '</div>'."\n";
			}
			$jquery_click_hook = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($value['name']) );
			$jquery_click_hook = "of-option-" . $jquery_click_hook;
			$menu .= '<a id="'.  esc_attr( $jquery_click_hook ) . '-tab" class="nav-tab" title="' . esc_attr( $value['name'] ) . '" href="' . esc_attr( '#'.  $jquery_click_hook ) . '"><i class="icon-' . esc_attr( $value['name'] ) . '"></i><span class="heading">' . esc_html( $value['name'] ) . '</span></a>';
			$output .= '<div class="group" id="' . esc_attr( $jquery_click_hook ) . '">';
			$output .= '<h2>' . esc_html( $value['name'] ) . '</h2>' . "\n"; // Changed to h2 instead of h3 ----------> 2012.10.20
			break;
		}

		if ( ( $value['type'] != "heading" ) && ( $value['type'] != "info" ) && ( $value['type'] != "note" ) && ( $value['type'] != "infotoggle" ) && ( $value['type'] != "closetoggle" ) ) { // Added the Note type here 2012.10.20
			$output .= '</div>';
			if ( ( $value['type'] != "checkbox" ) && ( $value['type'] != "editor" ) ) {
				$output .= '<div class="explain">' . wp_kses( $explain_value, $allowedtags) . '</div>'."\n";
			}
			$output .= '</div></div>'."\n";
		}

		echo $output;
	}
	echo '</div>';
}