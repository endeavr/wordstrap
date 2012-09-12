<?php

/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {
    $optionsframework_settings = get_option('optionsframework');
    $optionsframework_settings['id'] = 'ws_options';
    update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {
	
	// Typography Font Stack Arrays
	$typography_fonts_serif_mix = array_merge( options_typography_get_os_fonts_serif() , options_typography_get_google_fonts_serif() );
	// asort($typography_fonts_serif_mix);
	$typography_fonts_sans_mix = array_merge( options_typography_get_os_fonts_sans() , options_typography_get_google_fonts_sans() );
	// asort($typography_fonts_sans_mix);
	$typography_fonts_mono_mix = array_merge( options_typography_get_os_fonts_mono() , options_typography_get_google_fonts_mono() );
	// asort($typography_fonts_mono_mix);	
	$typography_fonts_all_mix = array_merge( options_typography_get_google_fonts_display() , options_typography_get_google_fonts_serif() , options_typography_get_google_fonts_sans() , options_typography_get_os_fonts_serif(), options_typography_get_os_fonts_sans() );
	// asort($typography_fonts_brand);
	
	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
     // Pull all the tags into an array
     $options_tags = array();
     $options_tags_obj = get_tags( array('hide_empty' => false) );
     $options_tags[''] = 'Select a tag:';
     foreach ($options_tags_obj as $tag) {
         $options_tags[$tag->term_id] = $tag->name;
     }

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	// Be sure to use stylesheet_directory_uri() if using a child theme
	$imagepath =  get_stylesheet_directory_uri() . '/assets/img/';
	
	// Options Background Repeat Options
	$options_repeat = array(
			'repeat'    => 'Repeat All',
			'no-repeat' => 'No Repeat',
			'repeat-x'  => 'Repeat Horizontally',
			'repeat-y'  => 'Repeat Vertically' 
	);
			
	// Options Background Attachment Options
	$options_attach = array(
			'scroll'    => 'Scroll',
			'fixed' => 'Fixed' 
	);
	
	// Options for a Generic Background
	$options_bkgd = array(
			'transparent' => 'transparent',
			'color' => 'background color',
			'colorpattern' => 'background color with pattern',
			'upload' => 'background color with uploaded image'
	);
	
	// Options for the Body Background
	$options_body = array(
			'color' => 'background color',
			'colorpattern' => 'background color with pattern',
			'upload' => 'background color with uploaded image'
	);
			
	// Background Patterns for Dark + Light Colored Bkgds
	$options_patterns = array(
			'patlight-01' => $imagepath . 'patterns/patlight-01.png',
			'patlight-02' => $imagepath . 'patterns/patlight-02.png',
			'patlight-03' => $imagepath . 'patterns/patlight-03.png',
			'patlight-04' => $imagepath . 'patterns/patlight-04.png',
			'patlight-05' => $imagepath . 'patterns/patlight-05.png',
			'patlight-06' => $imagepath . 'patterns/patlight-06.png',
			'patlight-07' => $imagepath . 'patterns/patlight-07.png',
			'patlight-08' => $imagepath . 'patterns/patlight-08.png',
			'patlight-09' => $imagepath . 'patterns/patlight-09.png',
			'patlight-10' => $imagepath . 'patterns/patlight-10.png',
			'patlight-11' => $imagepath . 'patterns/patlight-11.png',
			'patlight-12' => $imagepath . 'patterns/patlight-12.png',
			'patlight-13' => $imagepath . 'patterns/patlight-13.png',
			'patlight-14' => $imagepath . 'patterns/patlight-14.png',
			'patlight-15' => $imagepath . 'patterns/patlight-15.png',
			'patlight-16' => $imagepath . 'patterns/patlight-16.png',
			'patlight-17' => $imagepath . 'patterns/patlight-17.png',
			'patlight-18' => $imagepath . 'patterns/patlight-18.png',
			'patlight-19' => $imagepath . 'patterns/patlight-19.png',
			'patlight-20' => $imagepath . 'patterns/patlight-20.png',
			'patlight-21' => $imagepath . 'patterns/patlight-21.png',
			'patlight-22' => $imagepath . 'patterns/patlight-22.png',
			'patlight-23' => $imagepath . 'patterns/patlight-23.png',
			'patlight-24' => $imagepath . 'patterns/patlight-24.png',
			'patlight-25' => $imagepath . 'patterns/patlight-25.png',
			'patlight-26' => $imagepath . 'patterns/patlight-26.png',
			'patlight-27' => $imagepath . 'patterns/patlight-27.png',
			'patlight-28' => $imagepath . 'patterns/patlight-28.png',
			'patlight-29' => $imagepath . 'patterns/patlight-29.png',
			'patlight-30' => $imagepath . 'patterns/patlight-30.png',
			'patlight-31' => $imagepath . 'patterns/patlight-31.png',
			'patlight-32' => $imagepath . 'patterns/patlight-32.png',
			'patdark-01' => $imagepath . 'patterns/patdark-01.png',
			'patdark-02' => $imagepath . 'patterns/patdark-02.png',
			'patdark-03' => $imagepath . 'patterns/patdark-03.png',
			'patdark-04' => $imagepath . 'patterns/patdark-04.png',
			'patdark-05' => $imagepath . 'patterns/patdark-05.png',
			'patdark-06' => $imagepath . 'patterns/patdark-06.png',
			'patdark-07' => $imagepath . 'patterns/patdark-07.png',
			'patdark-08' => $imagepath . 'patterns/patdark-08.png',
			'patdark-09' => $imagepath . 'patterns/patdark-09.png',
			'patdark-10' => $imagepath . 'patterns/patdark-10.png',
			'patdark-11' => $imagepath . 'patterns/patdark-11.png',
			'patdark-12' => $imagepath . 'patterns/patdark-12.png',
			'patdark-13' => $imagepath . 'patterns/patdark-13.png',
			'patdark-14' => $imagepath . 'patterns/patdark-14.png',
			'patdark-15' => $imagepath . 'patterns/patdark-15.png',
			'patdark-16' => $imagepath . 'patterns/patdark-16.png',
			'patdark-17' => $imagepath . 'patterns/patdark-17.png',
			'patdark-18' => $imagepath . 'patterns/patdark-18.png',
			'patdark-19' => $imagepath . 'patterns/patdark-19.png',
			'patdark-20' => $imagepath . 'patterns/patdark-20.png',
			'patdark-21' => $imagepath . 'patterns/patdark-21.png',
			'patdark-22' => $imagepath . 'patterns/patdark-22.png',
			'patdark-23' => $imagepath . 'patterns/patdark-23.png',
			'patdark-24' => $imagepath . 'patterns/patdark-24.png',
			'patdark-25' => $imagepath . 'patterns/patdark-25.png',
			'patdark-26' => $imagepath . 'patterns/patdark-26.png',
			'patdark-27' => $imagepath . 'patterns/patdark-27.png',
			'patdark-28' => $imagepath . 'patterns/patdark-28.png',
			'patdark-29' => $imagepath . 'patterns/patdark-29.png',
			'patdark-30' => $imagepath . 'patterns/patdark-30.png',
			'patdark-31' => $imagepath . 'patterns/patdark-31.png',
			'patdark-32' => $imagepath . 'patterns/patdark-32.png'
	);	
	
	// Navbar Brand
	$options_array_brand = array(
			"one" => "Website brand as font text",
			"two" => "Website brand as mark image + font text",
			"three" => "Website brand as mark image + text image"
	);		

	$options = array();

/*-----------------------------------------------------------------------------------*/


/* INFO */		

	$options[] = array( "name" => "Info + Branding",
						"type" => "heading");
						
	$options[] = array( "name" => "Brand Identity + Logo",
					"desc" => "<strong>Let's start by defining the website's branding.</strong> Typically, a brand includes a mark (the iconic portion of a logo) and the brand name as text (the typographic portion of a logo).",
					"type" => "info");
						
	$options['ws_brand'] = array( "name" => "Branding",
						"desc" => "Should the website utilize font text to convey the website name or display images to convey the website branding or a combination of both?",
						"id" => "ws_brand",
						"type" => "select",
						"options" => $options_array_brand);
						
	$options['ws_brand_font_text'] = array( "name" => "Brand Name",
						"desc" => "Fill in the website brand name as you wish it to appear in the site's masthead.",
						"id" => "ws_brand_font_text",
						"class" => "hidden",
						"type" => "text");	
						
	$options['ws_brand_font_type'] = array( 'name' => 'Brand Typography',
						'desc' => 'Select from a list of Google web fonts along with the standard OS system fonts. Adjust the size and color.',
						'id' => 'ws_brand_font_type',
						'std' => array( 'size' => '20px', 'face' => '"Helvetica Neue", Helvetica, Arial, sans-serif', 'style' => 'bold', 'color' => '#049cdb' ),
						'class' => 'hidden',
						'type' => 'typography',
						'options' => array(
							'faces' => $typography_fonts_all_mix, )
						);											
						
	$options['ws_brand_logo_mark'] = array( "name" => "Upload the brand&#39;s Logo Mark image",
						"desc" => "Upload an image to use as the brand&#39;s Logo Mark. Ignore if not applicable.",
						"id" => "ws_brand_logo_mark",
						"class" => "hidden",
						"type" => "upload");
						
	$options['ws_brand_logo_text'] = array( "name" => "Upload the brand&#39;s Logo Name Text image",
						"desc" => "Upload an image to use as the brand&#39;s Logo Name Text. Ignore if not applicable.",
						"id" => "ws_brand_logo_text",
						"class" => "hidden",
						"type" => "upload");									
										
/*-----------------------------------------------------------------------------------*/


/* STYLES */

	$options[] = array( "name" => "Styles",
						"type" => "heading");
					
	// BODY Background Styles					
	$options[] = array( "name" => "Background Style - BODY",
						"desc" => "Use these options to set the color and/or pattern/image background of the website body.",			
						"type" => "info");					
						
	$options[] = array('name' => 'Body Background Options (@bodyOption)',
						'desc' => '',
						'id' => 'ws_bodyoption',
						'type' => 'select',
						'std' => 'color',
						'options' => $options_body );																
						
	$options[] = array( "name" => "Body Background Color (@bodyBackground)",
						"desc" => "The color of the body background. The default setting is WHITE <strong>( #FFFFFF )</strong>.",
						"id" => "ws_bodybackground",
						"std" => "#FFFFFF",
						"type" => "color");	
						
	$options[] = array('name' => 'Body Background Repeat Options (@bodyRepeat)',
						'desc' => 'Select how the background pattern/image should repeat.',
						'id' => 'ws_bodyrepeat',
						'type' => 'select',
						'std' => 'repeat',
						'options' => $options_repeat );	
						
	$options[] = array('name' => 'Body Background Attachment Options (@bodyAttach)',
						'desc' => 'Select how the background pattern/image should attach.. meaning should it scroll with the page or stay fixed while everything else scrolls.',
						'id' => 'ws_bodyattach',
						'type' => 'select',
						'std' => 'fixed',
						'options' => $options_attach );											
						
	$options[] = array( "name" => "Body Background Pattern (@bodyPattern)",
						'desc' => "Select a repeating pattern. The patterns are semi-transparent and will work in combination with the body color you select above. Some are designed to work with dark color backgrounds and some light colored backgrounds.",
						'id' => "ws_bodypattern",
						'std' => "patlight-01",
						'type' => "bodypattern",
						'options' => $options_patterns );	
						
	$options[] = array( 'name' =>  "Body Background Image Uploader (@bodyPattern)",
						'desc' => "Upload an image to use as the body background. A color may also be selected, but will only be relevant if the image is semi-transparent.",
						'id' => "ws_bodyupload",
						'class' => 'hidden',
						'type' => 'upload' );	
						
	// CONTENT WRAP Background Styles					
	$options[] = array( "name" => "Background Style - CONTENT WRAPPER",
						"desc" => "Use these options to set the color and/or pattern/image background of the website content area.",			
						"type" => "info");																					
						
	$options[] = array('name' => 'Content Wrap Background Options (@wrapOption)',
						'desc' => '',
						'id' => 'ws_wrapoption',
						'type' => 'select',
						'std' => 'transparent',
						'options' => $options_bkgd );	
												
	$options[] = array( "name" => "Content Wrap Background Color (@wrapBackground)",
						"desc" => "The color of the content wrap background. The default setting is WHITE <strong>( #FFFFFF )</strong>.",
						"id" => "ws_wrapbackground",
						'class' => 'hidden',
						"std" => "#FFFFFF",
						"type" => "color");	
						
	$options[] = array('name' => 'Content Wrap Background Repeat Options (@wrapRepeat)',
						'desc' => 'Select how the background pattern/image should repeat.',
						'id' => 'ws_wraprepeat',
						'type' => 'select',
						'std' => 'repeat',
						'options' => $options_repeat );	
						
	$options[] = array('name' => 'Content Wrap Background Attachment Options (@wrapAttach)',
						'desc' => 'Select how the background pattern/image should attach.. meaning should it scroll with the page or stay fixed while everything else scrolls.',
						'id' => 'ws_wrapattach',
						'type' => 'select',
						'std' => 'scroll',
						'options' => $options_attach );											
						
	$options[] = array( "name" => "Content Wrap Background Pattern (@wrapPattern)",
						'desc' => "Select a repeating pattern. The patterns are semi-transparent and will work in combination with the content wrap color you select above. Some are designed to work with dark color backgrounds and some light colored backgrounds.",
						'id' => "ws_wrappattern",
						'std' => "patlight-01",
						'class' => 'hidden',
						'type' => "wrappattern",
						'options' => $options_patterns );	
						
	$options[] = array( 'name' =>  "Content Wrap Background Image Uploader (@wrapPattern)",
						'desc' => "Upload an image to use as the content wrap background. A color may also be selected, but will only be relevant if the image is semi-transparent.",
						'id' => "ws_wrapupload",
						'class' => 'hidden',
						'type' => 'upload' );
						
	// FOOTER Background Styles					
	$options[] = array( "name" => "Background Style - FOOTER",
						"desc" => "Use these options to set the color and/or pattern/image background of the website footer.",		
						"type" => "info");																			
						
	$options[] = array('name' => 'Footer Background Options (@footerOption)',
						'desc' => '',
						'id' => 'ws_footeroption',
						'type' => 'select',
						'std' => 'transparent',
						'options' => $options_bkgd );	
												
	$options[] = array( "name" => "Footer Background Color (@footerBackground)",
						"desc" => "The color of the content footer background. The default setting is WHITE <strong>( #FFFFFF )</strong>.",
						"id" => "ws_footerbackground",
						'class' => 'hidden',
						"std" => "#FFFFFF",
						"type" => "color");	
						
	$options[] = array('name' => 'Footer Background Repeat Options (@footerRepeat)',
						'desc' => 'Select how the background pattern/image should repeat.',
						'id' => 'ws_footerrepeat',
						'type' => 'select',
						'std' => 'repeat',
						'options' => $options_repeat );	
						
	$options[] = array('name' => 'Footer Background Attachment Options (@footerAttach)',
						'desc' => 'Select how the background pattern/image should attach... meaning should it scroll with the page or stay fixed while everything else scrolls?',
						'id' => 'ws_footerattach',
						'type' => 'select',
						'std' => 'scroll',
						'options' => $options_attach );											
						
	$options[] = array( "name" => "Footer Background Pattern (@footerPattern)",
						'desc' => "Select a repeating pattern. The patterns are semi-transparent and will work in combination with the content footer color you select above. Some are designed to work with dark color backgrounds and some light colored backgrounds.",
						'id' => "ws_footerpattern",
						'std' => "patlight-01",
						'class' => 'hidden',
						'type' => "footerpattern",
						'options' => $options_patterns );	
						
	$options[] = array( 'name' =>  "Footer Background Image Uploader (@footerPattern)",
						'desc' => "Upload an image to use as the content footer background. A color may also be selected, but will only be relevant if the image is semi-transparent.",
						'id' => "ws_footerupload",
						'class' => 'hidden',
						'type' => 'upload' );																	
						
	// Define Colors					
	$options[] = array( "name" => "Define Colors",
						"desc" => "Use these options to set the color and pattern of backgrounds for elements like the body, header, content wrap, and footer.",			
						"type" => "info");																
						
	$options[] = array( "name" => "Define Color - Blue (@blue)",
						"desc" => "This defines the default shade of BLUE used on the website. The default setting is <strong>( #049cdb )</strong>.",
						"id" => "ws_blue",
						"std" => "#049cdb",
						"type" => "color");	
						
	$options[] = array( "name" => "Define Color - Dark Blue (@blueDark)",
						"desc" => "This defines the default shade of DARK blue used on the website. The default setting is <strong>( #026894 )</strong>.",
						"id" => "ws_bluedark",
						"std" => "#026894",
						"type" => "color");							
						
	$options[] = array( "name" => "Define Color - Green (@green)",
						"desc" => "This defines the default shade of GREEN used on the website. The default setting is <strong>( #46a546 )</strong>.",
						"id" => "ws_green",
						"std" => "#46a546",
						"type" => "color");		
						
	$options[] = array( "name" => "Define Color - Red (@red)",
						"desc" => "This defines the default shade of RED used on the website. The default setting is <strong>( #9d261d )</strong>.",
						"id" => "ws_red",
						"std" => "#9d261d",
						"type" => "color");	
						
	$options[] = array( "name" => "Define Color - Yellow (@yellow)",
						"desc" => "This defines the default shade of YELLOW used on the website. The default setting is <strong>( #ffc40d )</strong>.",
						"id" => "ws_yellow",
						"std" => "#ffc40d",
						"type" => "color");
						
	$options[] = array( "name" => "Define Color - Orange (@orange)",
						"desc" => "This defines the default shade of ORANGE used on the website. The default setting is <strong>( #f89406 )</strong>.",
						"id" => "ws_orange",
						"std" => "#f89406",
						"type" => "color");
						
	$options[] = array( "name" => "Define Color - Pink (@pink)",
						"desc" => "This defines the default shade of PINK used on the website. The default setting is <strong>( #c3325f )</strong>.",
						"id" => "ws_pink",
						"std" => "#c3325f",
						"type" => "color");
						
	$options[] = array( "name" => "Define Color - Purple (@purple)",
						"desc" => "This defines the default shade of PURPLE used on the website. The default setting is <strong>( #7a43b6 )</strong>.",
						"id" => "ws_purple",
						"std" => "#7a43b6",
						"type" => "color");

	// Iconography			
	$options[] = array( "name" => "Iconography",
						"desc" => "This website theme utilizes the Font Awesome icon font. You may control its display.",

										
						"type" => "info");			
					
	$options[] = array( "name" => "Icon Color (@iconFontAwesome)",
						"desc" => "The color of the meta icons. The default setting is black <strong>( #000000 )</strong>.",
						"id" => "ws_iconfontawesome",
						"std" => "#000000",
						"type" => "color");	
							
	// Navbar	General				
	$options[] = array( "name" => "Top Navigation Bar (Navbar)",
						"desc" => "Set the general specs for the navbar.",
							
						"type" => "info");	
						
	$options[] = array( "name" => "Navbar Collapse Width (@navbarCollapseWidth)",
						"desc" => "Set the width at which the menu collapses into an icon button that toggles open a vertical iteration of the menu. This is relevant for mobile devices. <br>The default is <strong>( 979px )</strong>.",
						"id" => "ws_navbarcollapsewidth",
						"std" => "979px",
						"class" => "mini",
						"type" => "text");						
						
	$options[] = array( "name" => "Navbar Height (@navbarHeight)",
						"desc" => "Set the height of the navbar in pixels. <br>The default is <strong>( 40px )</strong>.",
						"id" => "ws_navbarheight",
						"std" => "50px",
						"class" => "mini",
						"type" => "text");	
						
	$options[] = array( 'name' => 'Navbar Style',
						'desc' => 'Choose the active style for the Navbar.',
						'id' => 'ws_navbarstyle',
						'std' => 'inverse',
						'type' => 'radio',
						'options' => array('default' => 'Navbar Default', 'inverse' => 'Navbar Inverse') );						
						
	// Navbar	Default LIGHT			
	$options[] = array( "name" => "Navbar Default (LIGHT)",
						"desc" => "This version of the navbar is the light color scheme. By default it is gray text on a white to light gray gradient bar.",
						
						"type" => "info");																
						
	$options[] = array( "name" => "Text Color - DEFAULT (@navbarText)",
						"desc" => "The default color of text in the navbar. <br>The default setting is gray <strong>( #555555 )</strong>.",
						"id" => "ws_navbartext",
						"std" => "#555555",
						"type" => "color");						

	$options[] = array( "name" => "Link Text Color - INACTIVE (@navbarLinkColor)",
						"desc" => "The color of links in the navbar. <br>The default setting is gray <strong>( #777777 )</strong>.",
						"id" => "ws_navbarlinkcolor",
						"std" => "#777777",
						"type" => "color");

	$options[] = array( "name" => "Link Text Color - HOVER (@navbarLinkColorHover)",
						"desc" => "The color of links in the navbar when you hover the mouse over them. <br>The default setting is dark gray <strong>( #333333 )</strong>.",
						"id" => "ws_navbarlinkcolorhover",
						"std" => "#000000",
						"type" => "color");	
/*						
	$options[] = array( "name" => "Link Background Color - HOVER (@navbarLinkBackgroundHover)",
						"desc" => "The background color of hover links in the navbar. <br>The default setting is <strong>( transparent )</strong>.",
						"id" => "ws_navbarlinkbackgroundhover",
						"std" => "transparent",
						"type" => "color");										
*/
	$options[] = array( "name" => "Link Text Color - ACTIVE (@navbarLinkColorActive)",
						"desc" => "The color of the text in active links in the navbar. <br>The default setting is gray <strong>( #555555 )</strong>.",
						"id" => "ws_navbarlinkcoloractive",
						"std" => "#333333",
						"type" => "color");
/*
	$options[] = array( "name" => "Link Background Color - ACTIVE (@navbarLinkBackgroundActive)",
						"desc" => "The background color of active links in the navbar. <br>The default setting is near white <strong>( #E5E5E5 )</strong>.",
						"id" => "ws_navbarlinkbackgroundactive",
						"std" => "#E5E5E5",
						"type" => "color");
*/
	$options[] = array( "name" => "Navbar Gradient - BASE (@navbarBackground)",
						"desc" => "If your browser supports it, the navbar is displayed with a gradient effect from top to bottom. This option sets the <em>BOTTOM</em> of the gradient. <br>The default setting is near white <strong>( #DDDDDD )</strong>.",
						"id" => "ws_navbarbackground",
						"std" => "#DDDDDD",
						"type" => "color");
/*						
	$options[] = array( "name" => "Navbar Gradient - HIGHLIGHT (@navbarBackgroundHighlight)",
						"desc" => "If your browser supports it, the navbar is displayed with a gradient effect from top to bottom. This option sets the <em>TOP</em> of the gradient. <br>The default setting is white <strong>( #FFFFFF )</strong>.",
						"id" => "ws_navbarbackgroundhighlight",
						"std" => "#FFFFFF",
						"type" => "color");							

	$options[] = array( "name" => "Navbar Border (@navbarBorder)",
						"desc" => "The border color of the navbar. <br>The default setting is light gray <strong>( #D4D4D4 )</strong>.",
						"id" => "ws_navbarborder",
						"std" => "#D4D4D4",
						"type" => "color");
*/						
	$options[] = array( "name" => "Navbar Brand Color (@navbarBrandColor)",
						"desc" => "For branding purposes, if the website name is displayed as HTML text rather than an image, then it will appear in the navbar in the color specified here. <br>The default setting is gray <strong>( #555555 )</strong>.",
						"id" => "ws_navbarbrandcolor",
						"std" => "#555555",
						"type" => "color");										
									
	// Navbar	Inverse DARK		
	$options[] = array( "name" => "Navbar Inverse (DARK)",
						"desc" => "This version of the navbar is the dark color scheme. By default it is light gray text on a black to dark gray gradient bar.",
						
						"type" => "info");		
						
	$options[] = array( "name" => "Text Color - DEFAULT (@navbarInverseText)",
						"desc" => "The default color of text in the navbar. <br>The default setting is light gray <strong>( #BBBBBB )</strong>.",
						"id" => "ws_navbarinversetext",
						"std" => "#BBBBBB",
						"type" => "color");						

	$options[] = array( "name" => "Link Text Color - INACTIVE (@navbarInverseLinkColor)",
						"desc" => "The color of links in the navbar. <br>The default setting is light gray <strong>( #999999 )</strong>.",
						"id" => "ws_navbarinverselinkcolor",
						"std" => "#999999",
						"type" => "color");

	$options[] = array( "name" => "Link Text Color - HOVER (@navbarInverseLinkColorHover)",
						"desc" => "The color of links in the navbar when you hover the mouse over them. <br>The default setting is white <strong>( #FFFFFF )</strong>.",
						"id" => "ws_navbarinverselinkcolorhover",
						"std" => "#FFFFFF",
						"type" => "color");	
/*						
	$options[] = array( "name" => "Link Background Color - HOVER (@navbarInverseLinkBackgroundHover)",
						"desc" => "The background color of hover links in the navbar. <br>The default setting is <strong>( transparent )</strong>.",
						"id" => "ws_navbarinverselinkbackgroundhover",
						"std" => "transparent",
						"type" => "color");										
*/
	$options[] = array( "name" => "Link Text Color - ACTIVE (@navbarInverseLinkColorActive)",
						"desc" => "The color of the text in active links in the navbar. <br>The default setting is light gray <strong>( #999999 )</strong>.",
						"id" => "ws_navbarinverselinkcoloractive",
						"std" => "#DDDDDD",
						"type" => "color");
/*
	$options[] = array( "name" => "Link Background Color - ACTIVE (@navbarInverseLinkBackgroundActive)",
						"desc" => "The background color of active links in the navbar. <br>The default setting is near black <strong>( #111111 )</strong>.",
						"id" => "ws_navbarinverselinkbackgroundactive",
						"std" => "#111111",
						"type" => "color");																
*/						
	$options[] = array( "name" => "Navbar Gradient - BASE (@navbarInverseBackground)",
						"desc" => "If your browser supports it, the navbar is displayed with a gradient effect from top to bottom. This option sets the <em>BOTTOM</em> of the gradient for the inverted version of the navbar. <br>The default setting is near black <strong>( #111111 )</strong>.",
						"id" => "ws_navbarinversebackground",
						"std" => "#222222",
						"type" => "color");
/*
	$options[] = array( "name" => "Navbar Gradient - HIGHLIGHT (@navbarInverseBackgroundHighlight)",
						"desc" => "If your browser supports it, the navbar is displayed with a gradient effect from top to bottom. This option sets the <em>TOP</em> of the gradient. <br>The default setting is dark gray <strong>( #222222 )</strong>.",
						"id" => "ws_navbarinversebackgroundhighlight",
						"std" => "#222222",
						"type" => "color");		
						
	$options[] = array( "name" => "Navbar Border (@navbarInverseBorder)",
						"desc" => "The border color of the navbar. <br>The default setting is dark gray <strong>( #252525 )</strong>.",
						"id" => "ws_navbarinverseborder",
						"std" => "#252525",
						"type" => "color");
*/						
	$options[] = array( "name" => "Navbar Brand Color (@navbarInverseBrandColor)",
						"desc" => "For branding purposes, if the website name is displayed as HTML text rather than an image, then it will appear in the navbar in the color specified here. <br>The default setting is light gray <strong>( #999999 )</strong>.",
						"id" => "ws_navbarinversebrandcolor",
						"std" => "#BBBBBB",
						"type" => "color");							
																
/*
	$options[] = array( "name" => "Navbar search box background color",
						"desc" => "The color of the search box in the top navbar. The default setting is <strong>#626262</strong>.",
						"id" => "ws_style_navbar_search_bg",
						"std" => "#626262",
						"type" => "color");

	$options[] = array( "name" => "Navbar search box background color when focused",
						"desc" => "The color of the search box when it's in focus. The default setting is <strong>#FFFFFF</strong>.",
						"id" => "ws_style_navbar_search_bg_focused",
						"std" => "#FFFFFF",
						"type" => "color");					

	$options[] = array( "name" => "Navbar search box placeholder text color",
						"desc" => "The color of the default placeholder text in the search bar. The default setting is <strong>#CCCCCC</strong>.",
						"id" => "ws_style_navbar_search_placeholder",
						"std" => "#CCCCCC",
						"type" => "color");
*/		

	// Dropdowns		
	$options[] = array( "name" => "Dropdowns",
						"desc" => "Set the appearance of dropdowns. Most prominently, these will appear as the sub menus for the navbar, but they may also be utilized in other components.",
							
						"type" => "info");		
						
	$options[] = array( "name" => "Background Color (@dropdownBackground)",
						"desc" => "The default setting is white <strong>( #FFFFFF )</strong>.",
						"id" => "ws_dropdownbackground",
						"std" => "#FFFFFF",
						"type" => "color");	
/*						
	$options[] = array( "name" => "Border Color (@dropdownBorder)",
						"desc" => "The default setting is <strong>( # )</strong>.",
						"id" => "ws_dropdownborder",
						"std" => "#DDDDDD",
						"type" => "color");		
*/						
						
	$options[] = array( "name" => "Top Divider Color (@dropdownDividerTop)",
						"desc" => "The default setting is light gray <strong>( #E5E5E5 )</strong>.",
						"id" => "ws_dropdowndividertop",
						"std" => "#E5E5E5",
						"type" => "color");
						
	$options[] = array( "name" => "Bottom Divider Color (@dropdownDividerBottom)",
						"desc" => "The default setting is white <strong>( #FFFFFF )</strong>.",
						"id" => "ws_dropdowndividerbottom",
						"std" => "#FFFFFF",
						"type" => "color");
						
	$options[] = array( "name" => "Link Color (@dropdownLinkColor)",
						"desc" => "The default setting is dark gray <strong>( #333333 )</strong>.",
						"id" => "ws_dropdownlinkcolor",
						"std" => "#333333",
						"type" => "color");
						
	$options[] = array( "name" => "Link Hover Color (@dropdownLinkColorHover)",
						"desc" => "The default setting is white <strong>( #FFFFFF )</strong>.",
						"id" => "ws_dropdownlinkcolorhover",
						"std" => "#FFFFFF",
						"type" => "color");
						
	$options[] = array( "name" => "Link Hover Background Color (@dropdownLinkBackgroundHover)",
						"desc" => "The default setting is dark blue <strong>( #026894 )</strong>.",
						"id" => "ws_dropdownlinkbackgroundhover",
						"std" => "#026894",
						"type" => "color");
						
	$options[] = array( "name" => "Link Active Color (@dropdownLinkColorActive)",
						"desc" => "The default setting is dark gray <strong>( #000000 )</strong>.",
						"id" => "ws_dropdownlinkcoloractive",
						"std" => "#000000",
						"type" => "color");	
						
	$options[] = array( "name" => "Link Active Background Color (@dropdownLinkBackgroundActive)",
						"desc" => "The default setting is blue <strong>( #049cdb )</strong>.",
						"id" => "ws_dropdownlinkbackgroundactive",
						"std" => "#049cdb",
						"type" => "color");										
						
	// Forms		
	$options[] = array( "name" => "Forms",
						"desc" => "Set the appearance of forms. Most prominently, this will influence the display of the contact form, but form fields may also be utilized in other components.",
						
						"type" => "info");	
						
	$options[] = array( "name" => "Placeholder Text Color (@placeholderText)",
						"desc" => "Set the color of the placeholder text in the form field. The default setting is light gray <strong>( #999999 )</strong>.",
						"id" => "ws_placeholdertext",
						"std" => "#999999",
						"type" => "color");							
						
	$options[] = array( "name" => "Background Color (@inputBackground)",
						"desc" => "Set the background color of the form field. The default setting is white <strong>( #FFFFFF )</strong>.",
						"id" => "ws_inputbackground",
						"std" => "#FFFFFF",
						"type" => "color");	
						
	$options[] = array( "name" => "Border Color (@inputBorder)",
						"desc" => "Set the border color of the form field. The default setting is light gray <strong>( #CCCCCC )</strong>.",
						"id" => "ws_inputborder",
						"std" => "#CCCCCC",
						"type" => "color");		
						
	$options[] = array( "name" => "Border Radius (@inputBorderRadius)",
						"desc" => "This controls the rounded corners of the form field. 0px would render it as a right angle. At most, set this to 10px. The default setting is <strong>( 3px )</strong>.",
						"id" => "ws_inputborderradius",
						"std" => "3px",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => "Disabled Background (@inputnDisabledBackground)",
						"desc" => "The default setting is near white <strong>( #EEEEEE )</strong>.",
						"id" => "ws_inputdisabledbackground",
						"std" => "#EEEEEE",
						"type" => "color");
						
	$options[] = array( "name" => "Actions Background (@inputActionsBackground)",
						"desc" => "The default setting is near white <strong>( #F5F5F5 )</strong>.",
						"id" => "ws_inputactionsbackground",
						"std" => "#F5F5F5",
						"type" => "color");	
						
	// Form States & Alerts		
	$options[] = array( "name" => "Form States & Alerts",
						"desc" => "Set the appearance of certain types of form states and alerts. Most prominently, these will be used for various types of notifications. <br><strong>NOTE:</strong> The border style is automatically set based on the background color selections.",
							
						"type" => "info");	
						
	$options[] = array( "name" => "Warning Text Color (@WarningText)",
						"desc" => "The default setting is <strong>( #C09853 )</strong>.",
						"id" => "ws_warningtext",
						"std" => "#C09853",
						"type" => "color");			
						
	$options[] = array( "name" => "Warning Background (@WarningBackground)",
						"desc" => "The default setting is <strong>( #FCF8E3 )</strong>.",
						"id" => "ws_warningbackground",
						"std" => "#FCF8E3",
						"type" => "color");				
						
	$options[] = array( "name" => "Error Text Color (@errorText)",
						"desc" => "The default setting is <strong>( #b94a48)</strong>.",
						"id" => "ws_errortext",
						"std" => "#b94a48",
						"type" => "color");			
						
	$options[] = array( "name" => "Error Background (@errorBackground)",
						"desc" => "The default setting is <strong>( #f2dede )</strong>.",
						"id" => "ws_errorbackground",
						"std" => "#f2dede",
						"type" => "color");		
						
	$options[] = array( "name" => "Success Text Color (@successText)",
						"desc" => "The default setting is <strong>( #468847 )</strong>.",
						"id" => "ws_successtext",
						"std" => "#468847",
						"type" => "color");			
						
	$options[] = array( "name" => "Success Background (@successBackground)",
						"desc" => "The default setting is <strong>( #dff0d8 )</strong>.",
						"id" => "ws_successbackground",
						"std" => "#dff0d8",
						"type" => "color");
						
	$options[] = array( "name" => "Info Text Color (@infoText)",
						"desc" => "The default setting is <strong>( #3a87ad )</strong>.",
						"id" => "ws_infotext",
						"std" => "#3a87ad",
						"type" => "color");			
						
	$options[] = array( "name" => "Info Background (@infoBackground)",
						"desc" => "The default setting is <strong>( #d9edf7 )</strong>.",
						"id" => "ws_infobackground",
						"std" => "#d9edf7",
						"type" => "color");	
						
	// Buttons		
	$options[] = array( "name" => "Buttons",
						"desc" => "Set the gradient background for the default button, inverse button, and certain types of alert buttons. <br><strong>NOTE:</strong> the primary button class is automatically styled based on the default link color choice in the typography settings.",
							
						"type" => "info");	
						
	$options[] = array( "name" => "Default Button Gradient - BASE (@btnBackground)",
						"desc" => "The default setting is white <strong>( #FFFFFF )</strong>.",
						"id" => "ws_btnbackground",
						"std" => "#FFFFFF",
						"type" => "color");	
/*						
	$options[] = array( "name" => "Default Button Gradient - HIGHLIGHT (@btnBackgroundHighlight)",
						"desc" => "The default setting is near white <strong>( #E6E6E6 )</strong>.",
						"id" => "ws_btnbackgroundhighlight",
						"std" => "#E6E6E6",
						"type" => "color");	
*/						
	$options[] = array( "name" => "Primary Button Gradient - BASE (@btnPrimaryBackground)",
						"desc" => "The default setting is dark blue <strong>( #026894 )</strong>.",
						"id" => "ws_btnprimarybackground",
						"std" => "#049cdb",
						"type" => "color");	
/*						
	$options[] = array( "name" => "Primary Button Gradient - HIGHLIGHT (@btnPrimaryBackgroundHighlight)",
						"desc" => "The default setting is blue <strong>( #049cdb )</strong>.",
						"id" => "ws_btnprimarybackgroundhighlight",
						"std" => "#049cdb",
						"type" => "color");	
*/												
	$options[] = array( "name" => "Info Button Gradient - BASE (@btnInfoBackground)",
						"desc" => "The default setting is white <strong>( #5bc0de )</strong>.",
						"id" => "ws_btninfobackground",
						"std" => "#5bc0de",
						"type" => "color");	
/*						
	$options[] = array( "name" => "Info Button Gradient - HIGHLIGHT (@btnInfoBackgroundHighlight)",
						"desc" => "The default setting is near white <strong>( #2f96b4 )</strong>.",
						"id" => "ws_btninfobackgroundhighlight",
						"std" => "#2f96b4",
						"type" => "color");
*/						
	$options[] = array( "name" => "Success Button Gradient - BASE (@btnSuccessBackground)",
						"desc" => "The default setting is white <strong>( #62c462 )</strong>.",
						"id" => "ws_btnsuccessbackground",
						"std" => "#62c462",
						"type" => "color");	
/*						
	$options[] = array( "name" => "Success Button Gradient - HIGHLIGHT (@btnSuccessBackgroundHighlight)",
						"desc" => "The default setting is near white <strong>( #51a351 )</strong>.",
						"id" => "ws_btnsuccessbackgroundhighlight",
						"std" => "#51a351",
						"type" => "color");
*/						
	$options[] = array( "name" => "Warning Button Gradient - BASE (@btnWarningBackground)",
						"desc" => "The default setting is white <strong>( #fbb450 )</strong>.",
						"id" => "ws_btnwarningbackground",
						"std" => "#fbb450",
						"type" => "color");	
/*						
	$options[] = array( "name" => "Warning Button Gradient - HIGHLIGHT (@btnWarningBackgroundHighlight)",
						"desc" => "The default setting is near white <strong>( #f89406 )</strong>.",
						"id" => "ws_btnwarningbackgroundhighlight",
						"std" => "#f89406",
						"type" => "color");
*/						
	$options[] = array( "name" => "Danger Button Gradient - BASE (@btnDangerBackground)",
						"desc" => "The default setting is white <strong>( #ee5f5b )</strong>.",
						"id" => "ws_btndangerbackground",
						"std" => "#ee5f5b",
						"type" => "color");	
/*						
	$options[] = array( "name" => "Danger Button Gradient - HIGHLIGHT (@btnDangerBackgroundHighlight)",
						"desc" => "The default setting is near white <strong>( #bd362f )</strong>.",
						"id" => "ws_btndangerbackgroundhighlight",
						"std" => "#bd362f",
						"type" => "color");
*/						
	$options[] = array( "name" => "Inverse Button Gradient - BASE (@btnInverseBackground)",
						"desc" => "The default setting is white <strong>( #444444 )</strong>.",
						"id" => "ws_btninversebackground",
						"std" => "#444444",
						"type" => "color");	
/*						
	$options[] = array( "name" => "Inverse Button Gradient - HIGHLIGHT (@btnInverseBackgroundHighlight)",
						"desc" => "The default setting is near white <strong>( #222222 )</strong>.",
						"id" => "ws_btninversebackgroundhighlight",
						"std" => "#222222",
						"type" => "color");
*/										
																							
	// Tables		
	$options[] = array( "name" => "Tables",
						"desc" => "Set the appearance of tables.",
							
						"type" => "info");	
/*						
	$options[] = array( "name" => "Background Color (@tableBackground)",
						"desc" => "The default setting is <strong>( transparent )</strong>.",
						"id" => "ws_tablebackground",
						"std" => "transparent",
						"type" => "color");			
*/
	$options[] = array( "name" => "Background Accent Color (@tableBackgroundAccent)",
						"desc" => "The default setting is near white <strong>( #F9F9F9 )</strong>.",
						"id" => "ws_tablebackgroundaccent",
						"std" => "#F9F9F9",
						"type" => "color");			
						
	$options[] = array( "name" => "Background Hover Color (@tableBackgroundHover)",
						"desc" => "The default setting is near white <strong>( #F5F5F5 )</strong>.",
						"id" => "ws_tablebackgroundhover",
						"std" => "#F5F5F5",
						"type" => "color");	
						
	$options[] = array( "name" => "Border Color (@tableBorder)",
						"desc" => "The default setting is light gray <strong>( #DDDDDD )</strong>.",
						"id" => "ws_tableborder",
						"std" => "#DDDDDD",
						"type" => "color");	
						
	// Hero Unit	
	$options[] = array( "name" => "Hero Layout",
						"desc" => "Set the appearance of the Hero Layout. <br><strong>NOTE:</strong> Most of its style variables are inherited from other components.",
						
						"type" => "info");	
						
	$options[] = array( "name" => "Hero Layout Background Color (@heroUnitBackground)",
						"desc" => "The default setting is near white <strong>( #EEEEEE )</strong>.",
						"id" => "ws_herounitbackground",
						"std" => "#EEEEEE",
						"type" => "color");			
						
	// Tooltip
	$options[] = array( "name" => "Tooltip Javascript Element",
						"desc" => "Set the appearance of the Tooltip element. NOTE: The arrow color is automatically set based on the background selecition.",
							
						"type" => "info");	
						
	$options[] = array( "name" => "Tooltip Text Color (@tooltipColor)",
						"desc" => "The default setting is white <strong>( #FFFFFF )</strong>.",
						"id" => "ws_tooltipcolor",
						"std" => "#FFFFFF",
						"type" => "color");								
						
	$options[] = array( "name" => "Tooltip Background Color (@tooltipBackground)",
						"desc" => "The default setting is black <strong>( #000000 )</strong>.",
						"id" => "ws_tooltipbackground",
						"std" => "#000000",
						"type" => "color");		
						
	$options[] = array( "name" => "Tooltip Arrow Width (@tooltipArrowWidth)",
						"desc" => "The default setting is <strong>( 5px )</strong>.",
						"id" => "ws_tooltiparrowwidth",
						"std" => "5px",
						"class" => "mini",
						"type" => "text");	
						
	// Popover
	$options[] = array( "name" => "Popover Javascript Element",
						"desc" => "Set the appearance of the Popover element. <br><strong>NOTE:</strong> The arrow color and title background are automatically set based on the background selecition.",
							
						"type" => "info");									
						
	$options[] = array( "name" => "Popover Background Color (@popoverBackground)",
						"desc" => "The default setting is white <strong>( #FFFFFF )</strong>.",
						"id" => "ws_popoverbackground",
						"std" => "#FFFFFF",
						"type" => "color");		
						
	$options[] = array( "name" => "Popover Arrow Width (@popoverArrowWidth)",
						"desc" => "The default setting is <strong>( 10px )</strong>.",
						"id" => "ws_popoverarrowwidth",
						"std" => "10px",
						"class" => "mini",
						"type" => "text");		
						
	// Pagination
	$options[] = array( "name" => "Pagination",
						"desc" => "Set the appearance of the Pagination elements.",
							
						"type" => "info");									
						
	$options[] = array( "name" => "Pagination Background Color (@paginationBackground)",
						"desc" => "The default setting is white <strong>( #FFFFFF )</strong>.",
						"id" => "ws_paginationbackground",
						"std" => "#FFFFFF",
						"type" => "color");		
						
	$options[] = array( "name" => "Pagination Border Color (@paginationBorder)",
						"desc" => "The default setting is very light gray <strong>( #DDDDDD )</strong>.",
						"id" => "ws_paginationborder",
						"std" => "#DDDDDD",
						"type" => "color");	
						
	$options[] = array( "name" => "Pagination Active Background Color (@paginationActiveBackground)",
						"desc" => "The default setting is near white <strong>( #F5F5F5 )</strong>.",
						"id" => "ws_paginationactivebackground",
						"std" => "#F5F5F5",
						"type" => "color");													
						
	// Wells
	$options[] = array( "name" => "Wells",
						"desc" => "Set the appearance of the Wells element.",
						
						"type" => "info");									
						
	$options[] = array( "name" => "Wells Background Color (@wellBackground)",
						"desc" => "The default setting is near white <strong>( #F5F5F5 )</strong>.",
						"id" => "ws_wellbackground",
						"std" => "#F5F5F5",
						"type" => "color");																									

																												
/*-----------------------------------------------------------------------------------*/

/* TYPOGRAPHY */

	$options[] = array( "name" => "Typography",
						"type" => "heading");	
						
	$options[] = array( "name" => "Custom Fonts & Type Colors",
						"desc" => "Choose the fonts and type colors you want to use on your site.",	
			
						"type" => "info");		
/*						
	$options[] = array( "name" => "Content Text Color (@textColor)",
						"desc" => "The color of standard content text. The default setting is dark gray <strong>( #333333 )</strong>.",
						"id" => "ws_textcolor",
						"std" => "#333333",
						"type" => "color");											
*/							
	$options[] = array( "name" => "Link Text Color (@linkColor)",
						"desc" => "The color of Text Links on the site (the &lt;a&gt; element). The default setting is the standard dark blue <strong>( #00064cd )</strong>. <br><strong>NOTE:</strong> The Hover Text Color is automatically generated as 15% darker than the Link Text Color.",
						"id" => "ws_linkcolor",
						"std" => "#026894",
						"type" => "color");		
						
/*	
	$options[] = array( "name" => "Text Hyperlink HOVER Color (@linkColorHover)",
						"desc" => "The color of text links on the site in their hover state. The default setting is the link color but 15% darker.",
						"id" => "ws_linkColorHover",
						"std" => "darken(@linkColor, 15%)",
						"type" => "color");			
*/																							
						
	$options[] = array( "name" => "Horizontal Rule Color (@hrBorder)",
						"desc" => "The color of horizontal rules (the &lt;hr&gt; element). The default setting is very light gray <strong>( #EEEEEE )</strong>.",
						"id" => "ws_hrborder",
						"std" => "#EEEEEE",
						"type" => "color");	
						
	$options[] = array( "name" => "Footer Text Color (@footerColor)",
						"desc" => "The color of text in the footer. The default setting is light gray <strong>( #DDDDDD )</strong>.",
						"id" => "ws_footercolor",
						"std" => "#DDDDDD",
						"type" => "color");		
						
	$options[] = array( "name" => "Footer Link Text Color (@footerLinkColor)",
						"desc" => "The color of Text Links in the footer (the &lt;a&gt; element). The default setting is white <strong>( #FFFFFF )</strong>. <br><strong>NOTE:</strong> The Hover Text Color is automatically generated as 15% darker than the Link Text Color.",
						"id" => "ws_footerlinkcolor",
						"std" => "#FFFFFF",
						"type" => "color");													
						
	$options[] = array( "name" => "Font Family Defaults",
						"desc" => "",
						
						"type" => "info");						
																			
	$options[] = array('name' => 'Sans-Serif Font Family (@sansFontFamily)',
						'desc' => 'Select either a standard Operating System Font Stack or a custom Google Web Font from the dropdown.',
						'id' => 'ws_sansfontfamily',
						'type' => 'select',
						'std' => '"Helvetica Neue", Helvetica, Arial, sans-serif',
						'options' => $typography_fonts_sans_mix );			
						
	$options[] = array('name' => 'Serif Font Family (@serifFontFamily)',
						'desc' => 'Select either a standard Operating System Font Stack or a custom Google Web Font from the dropdown.',
						'id' => 'ws_seriffontfamily',
						'type' => 'select',
						'std' => 'Georgia, Times, "Times New Roman", serif',
						'options' => $typography_fonts_serif_mix );			
						
	$options[] = array('name' => 'Monospace Font Family (@monoFontFamily)',
						'desc' => 'Select either a standard Operating System Font Stack or a custom Google Web Font from the dropdown.',
						'id' => 'ws_monofontfamily',
						'type' => 'select',
						'std' => 'Monaco, Menlo, Consolas, "Lucida Console", "Courier New", monospace',
						'options' => $typography_fonts_mono_mix );	
						
	$options[] = array('name' => 'Alt Font Family (@altFontFamily)',
						'desc' => 'Select either a standard Operating System Font Stack or a custom Google Web Font from the dropdown.',
						'id' => 'ws_altfontfamily',
						'type' => 'select',
						'std' => 'Segoe, "Segoe UI", "Helvetica Neue", Arial, sans-serif',
						'options' => $typography_fonts_all_mix );												
						
											
						
	$options[] = array( "name" => "Base Font",
						"desc" => "",
						
						"type" => "info");																		

	$options[] = array( 'name' => 'Base Font (@baseFontSize, @baseFontFamily, @textColor)',
						'desc' => 'Select either a standard Operating System Font Stack or a custom Google Web Font from the dropdown. Adjust the size and color.',
						'id' => 'ws_basefont',
						'std' => array( 'size' => '14px', 'face' => '"Helvetica Neue", Helvetica, Arial, sans-serif', 'color' => '#333333'),
						'type' => 'typography',
						'options' => array(
							'faces' => $typography_fonts_all_mix,
							'styles' => false )
						);
						
	$options[] = array( "name" => "Base Line Height (@baseLineHeight)",
						"desc" => "Set the line height of the base font in pixels. <br>The default is <strong>( 20px )</strong>.",
						"id" => "ws_baselineheight",
						"std" => "20px",
						"class" => "mini",
						"type" => "text");						
																									
	$options[] = array( "name" => "Headings Font",
						"desc" => "",
						
						"type" => "info");	

	$options[] = array( 'name' => 'Headings Font (@headingsFontFamily, @headingsFontWeight, @headingsColor)',
						'desc' => 'Select either a standard Operating System Font Stack or a custom Google Web Font from the dropdown. Adjust the weight and color.',
						'id' => 'ws_headingsfont',
						'std' => array( 'face' => '"Helvetica Neue", Helvetica, Arial, sans-serif', 'style' => 'normal', 'color' => '#333333'),
						'type' => 'typography',
						'options' => array(
							'faces' => $typography_fonts_all_mix,
							'sizes' => false )
						);
						
	$options[] = array( "name" => "H1 Font (Main Titles)",
						"desc" => "",
					
						"type" => "info");	

	$options[] = array( 'name' => 'H1 Font (@h1FontSize, @h1FontFamily, @h1FontWeight, @h1Color)',
						'desc' => 'Select either a standard Operating System Font Stack or a custom Google Web Font from the dropdown. Adjust the size, weight, and color.',
						'id' => 'ws_h1font',
						'std' => array( 'size' => '36px', 'face' => '"Helvetica Neue", Helvetica, Arial, sans-serif', 'style' => 'normal', 'color' => '#333333'),
						'type' => 'typography',
						'options' => array(
							'faces' => $typography_fonts_all_mix, )
						);
						
	$options[] = array( "name" => "H1 - Line Height (@h1LineHeight)",
						"desc" => "Set the line height of the H1 font in pixels. <br>The default is <strong>( 40px )</strong>.",
						"id" => "ws_h1lineheight",
						"std" => "40px",
						"class" => "mini",
						"type" => "text");	
						

/*-----------------------------------------------------------------------------------*/



/* NAVIGATION */		

	$options[] = array( "name" => "Navigation",
						"type" => "heading");
															
	// Navbar
	$options[] = array( "name" => "Navbar",
						"desc" => "",					
						"type" => "info");						

	$options[] = array( "name" => "Display Top Navigation Bar?",
						"desc" => "Check to Display the top navbar on your site, even if there's no menu assigned in Appearance > Menu. Uncheck this box to hide it. Default is enabled.",
						"id" => "ws_navbar_show",
						"std" => 1,
						"type" => "checkbox");						

	$options[] = array( "name" => "Show search in navbar?",
						"desc" => "Default is enabled. Uncheck this box to turn it off.",
						"id" => "ws_navbar_search",
						"std" => 1,
						"type" => "checkbox");
						
	$options[] = array( "name" => "Include auxiliary items in navbar?",
						"desc" => "Default is enabled. Uncheck this box to turn it off.",
						"id" => "ws_navbar_aux",
						"std" => 1,
						"type" => "checkbox");						
						
	// Breadcrumbs
	$options[] = array( "name" => "Breadcrumbs",
						"desc" => "",						
						"type" => "info");							

	$options[] = array( "name" => "Show Breadcrumb Navigation?",
						"desc" => "Default is show. Uncheck this box to hide breadcrumbs.",
						"id" => "ws_breadcrumbs",
						"std" => 1,
						"type" => "checkbox");
						
	// Content Navigation
	$options[] = array( "name" => "Content Navigation",	
						"desc" => "",				
						"type" => "info");								

	$options[] = array( "name" => "Show content navigation above posts?",
						"desc" => "Displays links to next and previous posts above the current post and above the posts on the index page. Default is hide. Check this box to show content nav above posts.",
						"id" => "ws_content_nav_above",
						"std" => 0,
						"type" => "checkbox");

	$options[] = array( "name" => "Show content navigation below posts?",
						"desc" => "Displays links to next and previous posts below the current post and below the posts on the index page. Default is show. Uncheck this box to hide content nav above posts.",
						"id" => "ws_content_nav_below",
						"std" => 1,
						"type" => "checkbox");
						
/*-----------------------------------------------------------------------------------*/						
									
/* CONTENT */		

	$options[] = array( "name" => "Content",
						"type" => "heading");					

	// Post Meta
	$options[] = array( "name" => "Post Meta",
						"desc" => "Post meta information (publish date, author, categories, tags, and links to comments) is displayed on each post to provide your readers with information. Use the options below to control what is displayed.",
						"type" => "info");

	$options[] = array( "name" => "Show publish date?",
						"desc" => "Displays the date the article was posted. Default is show. Uncheck this box to hide post publish date.",
						"id" => "ws_postmeta_date",
						"std" => 1,
						"type" => "checkbox");
						
	$options[] = array( "name" => "Show post author?",
						"desc" => "Displays the author of a post. Default is show. Uncheck this box to hide post author.",
						"id" => "ws_postmeta_author",
						"std" => 1,
						"type" => "checkbox");						

	$options[] = array( "name" => "Show post categories?",
						"desc" => "Displays the categories in which a post was published. Default is show. Uncheck this box to hide post categories.",
						"id" => "ws_postmeta_categories",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Show post categories on the index/posts page?",
						"desc" => "Displays the post categories on the index/posts page - as defined in Settings > Reading. Default is show. Uncheck this box to hide post categories on the index/posts page.",
						"id" => "ws_postmeta_categories_index",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Show post tags?",
						"desc" => "Displays the tags attached to a post. Default is show. Uncheck this box to hide post tags.",
						"id" => "ws_postmeta_tags",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Show post tags on the index/posts page?",
						"desc" => "Displays the post tags on the index/posts page - as defined in Settings > Reading. Default is show. Uncheck this box to hide post tags on the index/posts page.",
						"id" => "ws_postmeta_tags_index",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Show link for # of comments / leave a comment?",
						"desc" => "Displays the number of comments and/or a Leave a comment message on posts. Default is show. Uncheck this box to hide.",
						"id" => "ws_postmeta_comments_link",
						"std" => 1,
						"type" => "checkbox");	
						
	// Footer
	$options[] = array( "name" => "Footer",
						"desc" => "",
						"type" => "info");

	$options[] = array( "name" => "Enable custom footer text?",
						"desc" => "Default is disabled. Check this box to use custom footer text. Fill in your text below.",
						"id" => "ws_footer",
						"std" => 0,
						"type" => "checkbox");

	$options[] = array( "name" => "Custom footer text",
						"desc" => "Enter the text here that you would like displayed at the bottom of your site. This setting will be ignored if you do not enable \"Show custom footer text\" above.",
						"id" => "ws_footer_text",
						"std" => "",
						"class" => "hidden",
						"type" => "text");											

/*-----------------------------------------------------------------------------------*/					
						


/* JAVASCRIPT */

	$options[] = array( "name" => "jQuery",
						"type" => "heading");

	$options[] = array( "name" => "Javascript Plugins Information",
						"desc" => "Read the description provided with each plugin. Some of these plugins require another plugin to function properly (Example: Carousel requires Transitions for the animation to work).<br> Disable any plugins that you aren't using.",						
						"type" => "info");					

	$options[] = array( "name" => "Transitions",
						"desc" => "Transitions are used to animate things such as the carousel, modals, fade out alerts, etc. * Required for animation in plugins.",
						"id" => "ws_js_transitions",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => "Alerts",
						"desc" => "The alert plugin is a tiny class for adding close functionality to alerts. * Requires Transitions if you want them to fade out on close.",
						"id" => "ws_js_alerts",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Modals",
						"desc" => "Message boxes that slide down and fade in from the top of the page. Default setting is disabled. * Requires Transitions to function properly.",
						"id" => "ws_js_modals",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Dropdown Menus",
						"desc" => "Add dropdown menus in the navbar, tabs, and pills.",
						"id" => "ws_js_dropdowns",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Scrollspy",
						"desc" => "Use scrollspy to automatically update the links in your navbar to show the current active link based on scroll position. Default setting is disabled.",
						"id" => "ws_js_scrollspy",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Tabs",
						"desc" => "Make tabs and pills more useful by allowing them to toggle through tabbable panes of content.",
						"id" => "ws_js_tabs",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Tooltips",
						"desc" => "Tooltips that use CSS3 for animations and data-attributes for local title storage.",
						"id" => "ws_js_tooltips",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Popovers",
						"desc" => "Add small overlays of content, like those on the iPad, to any element for housing secondary information. * Requires Tooltips.",
						"id" => "ws_js_popovers",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Buttons",
						"desc" => "Do more with buttons. Control button states or create groups of buttons for more components like toolbars.",
						"id" => "ws_js_buttons",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Collapse",
						"desc" => "Get base styles and flexible support for collapsible components like accordions and navigation.",
						"id" => "ws_js_collapse",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Carousel",
						"desc" => "Create a merry-go-round of any content you wish to provide in an interactive slideshow of content. * Required for Featured Posts.",
						"id" => "ws_js_carousel",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Typeahead",
						"desc" => "A basic, easily extended plugin for quickly creating elegant typeaheads with any form text input. Default setting is disabled.",
						"id" => "ws_js_typeahead",
						"std" => 1,
						"type" => "checkbox");

/*-----------------------------------------------------------------------------------*/

/* TOOLS */

	$options[] = array( "name" => "Tools",
						"type" => "heading");
						
	$options[] = array( "name" => "Analytics",
						"desc" => "Track your site traffic.",
						"type" => "info");

	$options[] = array( "name" => "Enable analytics?",
						"desc" => "If you use an analytics product such as Google Analytics or Piwik, you can add your tracking code below. If you use a separate plugin for analytics, you can ignore this section. Default setting is disabled.",
						"id" => "ws_analytics",
						"std" => 0,
						"folds" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Analytics code",
						"desc" => "Enter your analytics tracking code here (WITH the &lt;script&gt; and &lt;/script&gt; tags). Note: Any text you include here will be included in your pages, EVEN IF IT IS INCORRECT. Double check your code! If the analytics option is not enabled above, this text will be ignored.",
						"id" => "ws_analytics_code",
						"fold" => "ws_analytics",
						"type" => "textarea");
						
/*-----------------------------------------------------------------------------------*/

/* ADVANCED */

	$options[] = array( "name" => "Extras",
						"type" => "heading");
	
	// WordPress					
	$options[] = array( "name" => "WordPress Options",
						"desc" => "Adjust the default WordPress settings.",						
						"type" => "info");							
						
	$options[] = array( "name" => "Hide admin bar for all users?",
						"desc" => "Enable this option to hide the WordPress admin bar on the front end for all users (including admins). Default setting is disabled.",
						"id" => "ws_wp_disable_admin_bar",
						"std" => 0,
						"type" => "checkbox");											
	
	// Login Screen					
	$options[] = array( "name" => "Login Screen",
						"desc" => "Customize the website's login screen.",
						"type" => "info");

	$options[] = array( "name" => "Enable custom image on login page?",
						"desc" => "Enable this option and upload an image below to display a custom image on the login/register page. This replaces the default WordPress image. Default is disabled.",
						"id" => "ws_custom_login_image",
						"std" => 0,
						"folds" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Upload a custom image for the login page",
						"desc" => "Upload an image to use as a custom image on the login/register page. FOR BEST RESULTS: upload an image that is 274 x 63 pixels.",
						"id" => "ws_custom_login_image_file",
						"fold" => "ws_custom_login_image",
						"type" => "upload");						
	
	// Outgoing Email
	$options[] = array( "name" => "Customize outgoing emails",
						"desc" => "This section allows you to override the default WordPress settings for outgoing email sender information. Instead of an email coming from \"WordPress\", you can make it say anything you want. You can do the same with the sender email address, and the return address that is used if any problems occur during delivery. \r\n &nbsp;\r\nThe default setting is enabled, and it uses your site name as the From Name and your Site Admin email address as the From address and Return Path. You can change these defaults below. If you disable this feature your site will send emails using the WordPress defaults.",
						"type" => "info");

	$options[] = array( "name" => "Enable custom sender features?",
						"desc" => "Turn on the custom sender features. Unless you specify custom values below, this tells the Theme to send emails that use your site name in the From field and your site admin email as the sender and return addresses. To set your own custom information, select the box below and type in your own values. Default setting is enabled.",
						"id" => "ws_phpmailer_rewrite",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Enable customized sender information?",
						"desc" => "This allows you to customize the sender information of emails coming from your site. You must turn on \"Enable custom sender features\" above for this to work. NOTE: If you enable this option, fill in ALL fields below - otherwise your email may not work properly. Default setting is disabled.",
						"id" => "ws_phpmailer_rewrite_custom",
						"std" => 0,
						"folds" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "From Name",
						"desc" => "Enter the name you want to use in the From: field.",
						"id" => "ws_phpmailer_rewrite_custom_from_name",
						"std" => "",
						"fold" => "ws_phpmailer_rewrite_custom",
						"type" => "text");

	$options[] = array( "name" => "From Email Address",
						"desc" => "Enter the Sender email address you want to use in the From: field.",
						"id" => "ws_phpmailer_rewrite_custom_from_email",
						"std" => "",
						"fold" => "ws_phpmailer_rewrite_custom",
						"type" => "text");

	$options[] = array( "name" => "Return Email Address",
						"desc" => "Enter the return email address you want to use in case a problem happens during delivery.",
						"id" => "ws_phpmailer_rewrite_custom_sender",
						"std" => "",
						"fold" => "ws_phpmailer_rewrite_custom",
						"type" => "text");	

																			
	return $options;

}

/* Include the WordPress Front End Theme Customizer options. */
include_once dirname( __FILE__ ) . '/options-theme-customizer.php';

/* Include the custom jQuery files that show/hide items in the options panel. */
include_once dirname( __FILE__ ) . '/options-js-body.php';
include_once dirname( __FILE__ ) . '/options-js-wrap.php';
include_once dirname( __FILE__ ) . '/options-js-footer.php';
include_once dirname( __FILE__ ) . '/options-js-brand.php';