<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
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

	$typography_mixed_fonts = array_merge( options_typography_get_os_fonts() , options_typography_get_google_fonts() );
	asort($typography_mixed_fonts);

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
	$imagepath =  get_stylesheet_directory_uri() . '/admin/images/';

	$options = array();

/*-----------------------------------------------------------------------------------*/

/* STYLES */

	$options[] = array( "name" => "Styles",
						"type" => "heading");
					
	// General Styles					
	$options[] = array( "name" => "Framework Styles (Twitter Bootstrap)",
						"desc" => "All of the settings in this section influence the styling of the<br>Twitter Bootstrap framework on which this site is built.",
						"id" => "bs_info_general",
						"class" => "hidden",										
						"type" => "info");										
						
	$options[] = array( "name" => "Body Background Color (@bodyBackground)",
						"desc" => "The color of the body background. The default setting is WHITE <strong>( #FFFFFF )</strong>.",
						"id" => "bs_bodybackground",
						"std" => "#FFFFFF",
						"type" => "color");	
						
	$options[] = array( "name" => "Define Color - Blue (@blue)",
						"desc" => "This defines the default shade of BLUE used on the website. The default setting is <strong>( #049cdb )</strong>.",
						"id" => "bs_blue",
						"std" => "#049cdb",
						"type" => "color");	
						
	$options[] = array( "name" => "Define Color - Dark Blue (@blueDark)",
						"desc" => "This defines the default shade of DARK blue used on the website. The default setting is <strong>( #0064cd )</strong>.",
						"id" => "bs_bluedark",
						"std" => "#0064cd",
						"type" => "color");							
						
	$options[] = array( "name" => "Define Color - Green (@green)",
						"desc" => "This defines the default shade of GREEN used on the website. The default setting is <strong>( #46a546 )</strong>.",
						"id" => "bs_green",
						"std" => "#46a546",
						"type" => "color");		
						
	$options[] = array( "name" => "Define Color - Red (@red)",
						"desc" => "This defines the default shade of RED used on the website. The default setting is <strong>( #9d261d )</strong>.",
						"id" => "bs_red",
						"std" => "#9d261d",
						"type" => "color");	
						
	$options[] = array( "name" => "Define Color - Yellow (@yellow)",
						"desc" => "This defines the default shade of YELLOW used on the website. The default setting is <strong>( #ffc40d )</strong>.",
						"id" => "bs_yellow",
						"std" => "#ffc40d",
						"type" => "color");
						
	$options[] = array( "name" => "Define Color - Orange (@orange)",
						"desc" => "This defines the default shade of ORANGE used on the website. The default setting is <strong>( #f89406 )</strong>.",
						"id" => "bs_orange",
						"std" => "#f89406",
						"type" => "color");
						
	$options[] = array( "name" => "Define Color - Pink (@pink)",
						"desc" => "This defines the default shade of PINK used on the website. The default setting is <strong>( #c3325f )</strong>.",
						"id" => "bs_pink",
						"std" => "#c3325f",
						"type" => "color");
						
	$options[] = array( "name" => "Define Color - Purple (@purple)",
						"desc" => "This defines the default shade of PURPLE used on the website. The default setting is <strong>( #7a43b6 )</strong>.",
						"id" => "bs_purple",
						"std" => "#7a43b6",
						"type" => "color");

	// Iconography			
	$options[] = array( "name" => "Iconography",
						"desc" => "This website theme utilizes the Font Awesome icon font. You may control its display.",
						"id" => "bs_info_iconography",
						"class" => "hidden",										
						"type" => "info");			
					
	$options[] = array( "name" => "Icon Color (@iconFontAwesome)",
						"desc" => "The color of the meta icons. The default setting is black <strong>( #000000 )</strong>.",
						"id" => "bs_iconfontawesome",
						"std" => "#000000",
						"type" => "color");	
							
	// Navbar	General				
	$options[] = array( "name" => "Top Navigation Bar (Navbar)",
						"desc" => "Set the general specs for the navbar.",
						"id" => "bs_info_navbar",							
						"type" => "info");	
						
	$options[] = array( "name" => "Navbar Collapse Width (@navbarCollapseWidth)",
						"desc" => "Set the width at which the menu collapses into an icon button that toggles open a vertical iteration of the menu. This is relevant for mobile devices. <br>The default is <strong>( 979px )</strong>.",
						"id" => "bs_navbarcollapsewidth",
						"std" => "979px",
						"class" => "mini",
						"type" => "text");						
						
	$options[] = array( "name" => "Navbar Height (@navbarHeight)",
						"desc" => "Set the height of the navbar in pixels. <br>The default is <strong>( 40px )</strong>.",
						"id" => "bs_navbarheight",
						"std" => "40px",
						"class" => "mini",
						"type" => "text");	
						
	// Navbar	Default LIGHT			
	$options[] = array( "name" => "Navbar Default (LIGHT)",
						"desc" => "This version of the navbar is the light color scheme. By default it is gray text on a white to light gray gradient bar.",
						"id" => "bs_info_navbardefault",							
						"type" => "info");																
						
	$options[] = array( "name" => "Text Color - DEFAULT (@navbarText)",
						"desc" => "The default color of text in the navbar. <br>The default setting is gray <strong>( #555555 )</strong>.",
						"id" => "bs_navbartext",
						"std" => "#555555",
						"type" => "color");						

	$options[] = array( "name" => "Link Text Color - INACTIVE (@navbarLinkColor)",
						"desc" => "The color of links in the navbar. <br>The default setting is gray <strong>( #555555 )</strong>.",
						"id" => "bs_navbarlinkcolor",
						"std" => "#555555",
						"type" => "color");

	$options[] = array( "name" => "Link Text Color - HOVER (@navbarLinkColorHover)",
						"desc" => "The color of links in the navbar when you hover the mouse over them. <br>The default setting is dark gray <strong>( #333333 )</strong>.",
						"id" => "bs_navbarlinkcolorhover",
						"std" => "#333333",
						"type" => "color");	
						
	$options[] = array( "name" => "Link Background Color - HOVER (@navbarLinkBackgroundHover)",
						"desc" => "The background color of hover links in the navbar. <br>The default setting is <strong>( transparent )</strong>.",
						"id" => "bs_navbarlinkbackgroundhover",
						"std" => "transparent",
						"type" => "color");										

	$options[] = array( "name" => "Link Text Color - ACTIVE (@navbarLinkColorActive)",
						"desc" => "The color of the text in active links in the navbar. <br>The default setting is gray <strong>( #555555 )</strong>.",
						"id" => "bs_navbarlinkcoloractive",
						"std" => "#555555",
						"type" => "color");

	$options[] = array( "name" => "Link Background Color - ACTIVE (@navbarLinkBackgroundActive)",
						"desc" => "The background color of active links in the navbar. <br>The default setting is near white <strong>( #E5E5E5 )</strong>.",
						"id" => "bs_navbarlinkbackgroundactive",
						"std" => "#E5E5E5",
						"type" => "color");

	$options[] = array( "name" => "Navbar Gradient - BASE (@navbarBackground)",
						"desc" => "If your browser supports it, the navbar is displayed with a gradient effect from top to bottom. This option sets the <em>BOTTOM</em> of the gradient. <br>The default setting is near white <strong>( #F2F2F2 )</strong>.",
						"id" => "bs_navbarbackground",
						"std" => "#F2F2F2",
						"type" => "color");
						
	$options[] = array( "name" => "Navbar Gradient - HIGHLIGHT (@navbarBackgroundHighlight)",
						"desc" => "If your browser supports it, the navbar is displayed with a gradient effect from top to bottom. This option sets the <em>TOP</em> of the gradient. <br>The default setting is white <strong>( #FFFFFF )</strong>.",
						"id" => "bs_navbarbackgroundhighlight",
						"std" => "#FFFFFF",
						"type" => "color");							

	$options[] = array( "name" => "Navbar Border (@navbarBorder)",
						"desc" => "The border color of the navbar. <br>The default setting is light gray <strong>( #D4D4D4 )</strong>.",
						"id" => "bs_navbarborder",
						"std" => "#D4D4D4",
						"type" => "color");
						
	$options[] = array( "name" => "Navbar Brand Color (@navbarBrandColor)",
						"desc" => "For branding purposes, if the website name is displayed as HTML text rather than an image, then it will appear in the navbar in the color specified here. <br>The default setting is gray <strong>( #555555 )</strong>.",
						"id" => "bs_navbarbrandcolor",
						"std" => "#555555",
						"type" => "color");										
									
	// Navbar	Inverse DARK		
	$options[] = array( "name" => "Navbar Inverse (DARK)",
						"desc" => "This version of the navbar is the dark color scheme. By default it is light gray text on a black to dark gray gradient bar.",
						"id" => "bs_info_navbarinverse",							
						"type" => "info");		
						
	$options[] = array( "name" => "Text Color - DEFAULT (@navbarInverseText)",
						"desc" => "The default color of text in the navbar. <br>The default setting is light gray <strong>( #999999 )</strong>.",
						"id" => "bs_navbarinversetext",
						"std" => "#999999",
						"type" => "color");						

	$options[] = array( "name" => "Link Text Color - INACTIVE (@navbarInverseLinkColor)",
						"desc" => "The color of links in the navbar. <br>The default setting is light gray <strong>( #999999 )</strong>.",
						"id" => "bs_navbarinverselinkcolor",
						"std" => "#999999",
						"type" => "color");

	$options[] = array( "name" => "Link Text Color - HOVER (@navbarInverseLinkColorHover)",
						"desc" => "The color of links in the navbar when you hover the mouse over them. <br>The default setting is white <strong>( #FFFFFF )</strong>.",
						"id" => "bs_navbarinverselinkcolorhover",
						"std" => "#FFFFFF",
						"type" => "color");	
						
	$options[] = array( "name" => "Link Background Color - HOVER (@navbarInverseLinkBackgroundHover)",
						"desc" => "The background color of hover links in the navbar. <br>The default setting is <strong>( transparent )</strong>.",
						"id" => "bs_navbarinverselinkbackgroundhover",
						"std" => "transparent",
						"type" => "color");										

	$options[] = array( "name" => "Link Text Color - ACTIVE (@navbarInverseLinkColorActive)",
						"desc" => "The color of the text in active links in the navbar. <br>The default setting is light gray <strong>( #999999 )</strong>.",
						"id" => "bs_navbarinverselinkcoloractive",
						"std" => "#999999",
						"type" => "color");

	$options[] = array( "name" => "Link Background Color - ACTIVE (@navbarInverseLinkBackgroundActive)",
						"desc" => "The background color of active links in the navbar. <br>The default setting is near black <strong>( #111111 )</strong>.",
						"id" => "bs_navbarinverselinkbackgroundactive",
						"std" => "#111111",
						"type" => "color");																
						
	$options[] = array( "name" => "Navbar Gradient - BASE (@navbarInverseBackground)",
						"desc" => "If your browser supports it, the navbar is displayed with a gradient effect from top to bottom. This option sets the <em>BOTTOM</em> of the gradient for the inverted version of the navbar. <br>The default setting is near black <strong>( #111111 )</strong>.",
						"id" => "bs_navbarinversebackground",
						"std" => "#111111",
						"type" => "color");

	$options[] = array( "name" => "Navbar Gradient - HIGHLIGHT (@navbarInverseBackgroundHighlight)",
						"desc" => "If your browser supports it, the navbar is displayed with a gradient effect from top to bottom. This option sets the <em>TOP</em> of the gradient. <br>The default setting is dark gray <strong>( #222222 )</strong>.",
						"id" => "bs_navbarinversebackgroundhighlight",
						"std" => "#222222",
						"type" => "color");		
						
	$options[] = array( "name" => "Navbar Border (@navbarInverseBorder)",
						"desc" => "The border color of the navbar. <br>The default setting is dark gray <strong>( #252525 )</strong>.",
						"id" => "bs_navbarinverseborder",
						"std" => "#252525",
						"type" => "color");
						
	$options[] = array( "name" => "Navbar Brand Color (@navbarInverseBrandColor)",
						"desc" => "For branding purposes, if the website name is displayed as HTML text rather than an image, then it will appear in the navbar in the color specified here. <br>The default setting is light gray <strong>( #999999 )</strong>.",
						"id" => "bs_navbarinversebrandcolor",
						"std" => "#999999",
						"type" => "color");							
																
/*
	$options[] = array( "name" => "Navbar search box background color",
						"desc" => "The color of the search box in the top navbar. The default setting is <strong>#626262</strong>.",
						"id" => "wordstrap_style_navbar_search_bg",
						"std" => "#626262",
						"type" => "color");

	$options[] = array( "name" => "Navbar search box background color when focused",
						"desc" => "The color of the search box when it's in focus. The default setting is <strong>#FFFFFF</strong>.",
						"id" => "wordstrap_style_navbar_search_bg_focused",
						"std" => "#FFFFFF",
						"type" => "color");					

	$options[] = array( "name" => "Navbar search box placeholder text color",
						"desc" => "The color of the default placeholder text in the search bar. The default setting is <strong>#CCCCCC</strong>.",
						"id" => "wordstrap_style_navbar_search_placeholder",
						"std" => "#CCCCCC",
						"type" => "color");
*/		

	// Dropdowns		
	$options[] = array( "name" => "Dropdowns",
						"desc" => "Set the appearance of dropdowns. Most prominently, these will appear as the sub menus for the navbar, but they may also be utilized in other components.",
						"id" => "bs_info_dropdowns",							
						"type" => "info");		
						
	$options[] = array( "name" => "Background Color (@dropdownBackground)",
						"desc" => "The default setting is white <strong>( #FFFFFF )</strong>.",
						"id" => "bs_dropdownbackground",
						"std" => "#FFFFFF",
						"type" => "color");	
/*						
	$options[] = array( "name" => "Border Color (@dropdownBorder)",
						"desc" => "The default setting is <strong>( # )</strong>.",
						"id" => "bs_dropdownborder",
						"std" => "#",
						"type" => "color");		
*/						
						
	$options[] = array( "name" => "Top Divider Color (@dropdownDividerTop)",
						"desc" => "The default setting is light gray <strong>( #E5E5E5 )</strong>.",
						"id" => "bs_dropdowndividertop",
						"std" => "#E5E5E5",
						"type" => "color");
						
	$options[] = array( "name" => "Bottom Divider Color (@dropdownDividerBottom)",
						"desc" => "The default setting is white <strong>( #FFFFFF )</strong>.",
						"id" => "bs_dropdowndivderbottom",
						"std" => "#FFFFFF",
						"type" => "color");
						
	$options[] = array( "name" => "Link Color (@dropdownLinkColor)",
						"desc" => "The default setting is dark gray <strong>( #333333 )</strong>.",
						"id" => "bs_dropdownlinkcolor",
						"std" => "#333333",
						"type" => "color");
						
	$options[] = array( "name" => "Link Hover Color (@dropdownLinkColorHover)",
						"desc" => "The default setting is white <strong>( #FFFFFF )</strong>.",
						"id" => "bs_dropdownlinkcolorhover",
						"std" => "#FFFFFF",
						"type" => "color");
						
	$options[] = array( "name" => "Link Hover Background Color (@dropdownLinkBackgroundHover)",
						"desc" => "The default setting is dark blue <strong>( #0064cd )</strong>.",
						"id" => "bs_dropdownlinkbackgroundhover",
						"std" => "#0064cd",
						"type" => "color");
						
	$options[] = array( "name" => "Link Active Color (@dropdownLinkColorActive)",
						"desc" => "The default setting is dark gray <strong>( #333333 )</strong>.",
						"id" => "bs_dropdownlinkcoloractive",
						"std" => "#333333",
						"type" => "color");	
						
	$options[] = array( "name" => "Link Active Background Color (@dropdownLinkBackgroundActive)",
						"desc" => "The default setting is blue <strong>( #049cdb )</strong>.",
						"id" => "bs_dropdownlinkbackgroundactive",
						"std" => "#049cdb",
						"type" => "color");										
						
	// Forms		
	$options[] = array( "name" => "Forms",
						"desc" => "Set the appearance of forms. Most prominently, this will influence the display of the contact form, but form fields may also be utilized in other components.",
						"id" => "bs_info_forms",							
						"type" => "info");	
						
	$options[] = array( "name" => "Placeholder Text Color (@placeholderText)",
						"desc" => "Set the color of the placeholder text in the form field. The default setting is light gray <strong>( #999999 )</strong>.",
						"id" => "bs_placeholdertext",
						"std" => "#999999",
						"type" => "color");							
						
	$options[] = array( "name" => "Background Color (@inputBackground)",
						"desc" => "Set the background color of the form field. The default setting is white <strong>( #FFFFFF )</strong>.",
						"id" => "bs_inputbackground",
						"std" => "#FFFFFF",
						"type" => "color");	
						
	$options[] = array( "name" => "Border Color (@inputBorder)",
						"desc" => "Set the border color of the form field. The default setting is light gray <strong>( #CCCCCC )</strong>.",
						"id" => "bs_inputborder",
						"std" => "#CCCCCC",
						"type" => "color");		
						
	$options[] = array( "name" => "Border Radius (@inputBorderRadius)",
						"desc" => "This controls the rounded corners of the form field. 0px would render it as a right angle. At most, set this to 10px. The default setting is <strong>( 3px )</strong>.",
						"id" => "bs_inputborderradius",
						"std" => "3px",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => "Disabled Background (@inputnDisabledBackground)",
						"desc" => "The default setting is near white <strong>( #EEEEEE )</strong>.",
						"id" => "bs_inputdisabledbackground",
						"std" => "#EEEEEE",
						"type" => "color");
						
	$options[] = array( "name" => "Actions Background (@inputActionsBackground)",
						"desc" => "The default setting is near white <strong>( #F5F5F5 )</strong>.",
						"id" => "bs_inputactionsbackground",
						"std" => "#F5F5F5",
						"type" => "color");	
						
	// Form States & Alerts		
	$options[] = array( "name" => "Form States & Alerts",
						"desc" => "Set the appearance of certain types of form states and alerts. Most prominently, these will be used for various types of notifications. <br><strong>NOTE:</strong> The border style is automatically set based on the background color selections.",
						"id" => "bs_info_formstatesalerts",							
						"type" => "info");	
						
	$options[] = array( "name" => "Warning Text Color (@WarningText)",
						"desc" => "The default setting is <strong>( #C09853 )</strong>.",
						"id" => "bs_warningtext",
						"std" => "#C09853",
						"type" => "color");			
						
	$options[] = array( "name" => "Warning Background (@WarningBackground)",
						"desc" => "The default setting is <strong>( #FCF8E3 )</strong>.",
						"id" => "bs_warningbackground",
						"std" => "#FCF8E3",
						"type" => "color");				
						
	$options[] = array( "name" => "Error Text Color (@errorText)",
						"desc" => "The default setting is <strong>( #b94a48)</strong>.",
						"id" => "bs_errortext",
						"std" => "#b94a48",
						"type" => "color");			
						
	$options[] = array( "name" => "Error Background (@errorBackground)",
						"desc" => "The default setting is <strong>( #f2dede )</strong>.",
						"id" => "bs_errorbackground",
						"std" => "#f2dede",
						"type" => "color");		
						
	$options[] = array( "name" => "Success Text Color (@successText)",
						"desc" => "The default setting is <strong>( #468847 )</strong>.",
						"id" => "bs_successtext",
						"std" => "#468847",
						"type" => "color");			
						
	$options[] = array( "name" => "Success Background (@successBackground)",
						"desc" => "The default setting is <strong>( #dff0d8 )</strong>.",
						"id" => "bs_successbackground",
						"std" => "#dff0d8",
						"type" => "color");
						
	$options[] = array( "name" => "Info Text Color (@infoText)",
						"desc" => "The default setting is <strong>( #3a87ad )</strong>.",
						"id" => "bs_infotext",
						"std" => "#3a87ad",
						"type" => "color");			
						
	$options[] = array( "name" => "Info Background (@infoBackground)",
						"desc" => "The default setting is <strong>( #d9edf7 )</strong>.",
						"id" => "bs_infobackground",
						"std" => "#d9edf7",
						"type" => "color");	
						
	// Buttons		
	$options[] = array( "name" => "Buttons",
						"desc" => "Set the gradient background for the default button, inverse button, and certain types of alert buttons. <br><strong>NOTE:</strong> the primary button class is automatically styled based on the default link color choice in the typography settings.",
						"id" => "bs_info_buttons",							
						"type" => "info");	
						
	$options[] = array( "name" => "Default Button Gradient - BASE (@btnBackground)",
						"desc" => "The default setting is white <strong>( #FFFFFF )</strong>.",
						"id" => "bs_btnbackground",
						"std" => "#FFFFFF",
						"type" => "color");	
						
	$options[] = array( "name" => "Default Button Gradient - HIGHLIGHT (@btnBackgroundHighlight)",
						"desc" => "The default setting is near white <strong>( #E6E6E6 )</strong>.",
						"id" => "bs_btnbackgroundhighlight",
						"std" => "#E6E6E6",
						"type" => "color");	
/*						
	$options[] = array( "name" => "Primary Button Gradient - BASE (@btnPrimaryBackground)",
						"desc" => "The default setting is dark blue <strong>( #0064cd )</strong>.",
						"id" => "bs_btnprimarybackground",
						"std" => "#0064cd",
						"type" => "color");	
						
	$options[] = array( "name" => "Primary Button Gradient - HIGHLIGHT (@btnPrimaryBackgroundHighlight)",
						"desc" => "The default setting is blue <strong>( #049cdb )</strong>.",
						"id" => "bs_btnprimarybackgroundhighlight",
						"std" => "#049cdb",
						"type" => "color");	
*/							
						
	$options[] = array( "name" => "Info Button Gradient - BASE (@btnInfoBackground)",
						"desc" => "The default setting is white <strong>( #5bc0de )</strong>.",
						"id" => "bs_btninfobackground",
						"std" => "#5bc0de",
						"type" => "color");	
						
	$options[] = array( "name" => "Info Button Gradient - HIGHLIGHT (@btnInfoBackgroundHighlight)",
						"desc" => "The default setting is near white <strong>( #2f96b4 )</strong>.",
						"id" => "bs_btninfobackgroundhighlight",
						"std" => "#2f96b4",
						"type" => "color");
						
	$options[] = array( "name" => "Success Button Gradient - BASE (@btnSuccessBackground)",
						"desc" => "The default setting is white <strong>( #62c462 )</strong>.",
						"id" => "bs_btnsuccessbackground",
						"std" => "#62c462",
						"type" => "color");	
						
	$options[] = array( "name" => "Success Button Gradient - HIGHLIGHT (@btnSuccessBackgroundHighlight)",
						"desc" => "The default setting is near white <strong>( #51a351 )</strong>.",
						"id" => "bs_btnsuccessbackgroundhighlight",
						"std" => "#51a351",
						"type" => "color");
						
	$options[] = array( "name" => "Warning Button Gradient - BASE (@btnWarningBackground)",
						"desc" => "The default setting is white <strong>( #fbb450 )</strong>.",
						"id" => "bs_btnwarningbackground",
						"std" => "#fbb450",
						"type" => "color");	
						
	$options[] = array( "name" => "Warning Button Gradient - HIGHLIGHT (@btnWarningBackgroundHighlight)",
						"desc" => "The default setting is near white <strong>( #f89406 )</strong>.",
						"id" => "bs_btnwarningbackgroundhighlight",
						"std" => "#f89406",
						"type" => "color");
						
	$options[] = array( "name" => "Danger Button Gradient - BASE (@btnDangerBackground)",
						"desc" => "The default setting is white <strong>( #ee5f5b )</strong>.",
						"id" => "bs_btndangerbackground",
						"std" => "#ee5f5b",
						"type" => "color");	
						
	$options[] = array( "name" => "Danger Button Gradient - HIGHLIGHT (@btnDangerBackgroundHighlight)",
						"desc" => "The default setting is near white <strong>( #bd362f )</strong>.",
						"id" => "bs_btndangerbackgroundhighlight",
						"std" => "#bd362f",
						"type" => "color");
						
	$options[] = array( "name" => "Inverse Button Gradient - BASE (@btnInverseBackground)",
						"desc" => "The default setting is white <strong>( #444444 )</strong>.",
						"id" => "bs_btninversebackground",
						"std" => "#444444",
						"type" => "color");	
						
	$options[] = array( "name" => "Inverse Button Gradient - HIGHLIGHT (@btnInverseBackgroundHighlight)",
						"desc" => "The default setting is near white <strong>( #222222 )</strong>.",
						"id" => "bs_btninversebackgroundhighlight",
						"std" => "#222222",
						"type" => "color");																																																			
																									
	// Tables		
	$options[] = array( "name" => "Tables",
						"desc" => "Set the appearance of tables.",
						"id" => "bs_info_tables",							
						"type" => "info");	
						
	$options[] = array( "name" => "Background Color (@tableBackground)",
						"desc" => "The default setting is <strong>( transparent )</strong>.",
						"id" => "bs_tablebackground",
						"std" => "transparent",
						"type" => "color");			

	$options[] = array( "name" => "Background Accent Color (@tableBackgroundAccent)",
						"desc" => "The default setting is near white <strong>( #F9F9F9 )</strong>.",
						"id" => "bs_tablebackgroundaccent",
						"std" => "#F9F9F9",
						"type" => "color");			
						
	$options[] = array( "name" => "Background Hover Color (@tableBackgroundHover)",
						"desc" => "The default setting is near white <strong>( #F5F5F5 )</strong>.",
						"id" => "bs_tablebackgroundhover",
						"std" => "#F5F5F5",
						"type" => "color");	
						
	$options[] = array( "name" => "Border Color (@tableBorder)",
						"desc" => "The default setting is light gray <strong>( #DDDDDD )</strong>.",
						"id" => "bs_tableborder",
						"std" => "#DDDDDD",
						"type" => "color");	
						
	// Hero Unit	
	$options[] = array( "name" => "Hero Layout",
						"desc" => "Set the appearance of the Hero Layout. <br><strong>NOTE:</strong> Most of its style variables are inherited from other components.",
						"id" => "bs_info_hero",							
						"type" => "info");	
						
	$options[] = array( "name" => "Hero Layout Background Color (@heroUnitBackground)",
						"desc" => "The default setting is near white <strong>( #EEEEEE )</strong>.",
						"id" => "bs_herounitbackground",
						"std" => "#EEEEEE",
						"type" => "color");			
						
	// Tooltip
	$options[] = array( "name" => "Tooltip Javascript Element",
						"desc" => "Set the appearance of the Tooltip element. NOTE: The arrow color is automatically set based on the background selecition.",
						"id" => "bs_info_tooltip",							
						"type" => "info");	
						
	$options[] = array( "name" => "Tooltip Text Color (@tooltipColor)",
						"desc" => "The default setting is white <strong>( #FFFFFF )</strong>.",
						"id" => "bs_tooltipcolor",
						"std" => "#FFFFFF",
						"type" => "color");								
						
	$options[] = array( "name" => "Tooltip Background Color (@tooltipBackground)",
						"desc" => "The default setting is black <strong>( #000000 )</strong>.",
						"id" => "bs_tooltipbackground",
						"std" => "#000000",
						"type" => "color");		
						
	$options[] = array( "name" => "Tooltip Arrow Width (@tooltipArrowWidth)",
						"desc" => "The default setting is <strong>( 5px )</strong>.",
						"id" => "bs_tooltiparrowwidth",
						"std" => "5px",
						"class" => "mini",
						"type" => "text");	
						
	// Popover
	$options[] = array( "name" => "Popover Javascript Element",
						"desc" => "Set the appearance of the Popover element. <br><strong>NOTE:</strong> The arrow color and title background are automatically set based on the background selecition.",
						"id" => "bs_info_popover",							
						"type" => "info");									
						
	$options[] = array( "name" => "Popover Background Color (@popoverBackground)",
						"desc" => "The default setting is white <strong>( #FFFFFF )</strong>.",
						"id" => "bs_popoverbackground",
						"std" => "#FFFFFF",
						"type" => "color");		
						
	$options[] = array( "name" => "Popover Arrow Width (@popoverArrowWidth)",
						"desc" => "The default setting is <strong>( 10px )</strong>.",
						"id" => "bs_popoverarrowwidth",
						"std" => "10px",
						"class" => "mini",
						"type" => "text");																			

																												
/*-----------------------------------------------------------------------------------*/

/* TYPOGRAPHY */

	$options[] = array( "name" => "Typography",
						"type" => "heading");	
						
	$options[] = array( "name" => "Custom Fonts & Type Colors",
						"desc" => "Choose the fonts and type colors you want to use on your site.",	
						"id" => "bs_info_fonts",				
						"type" => "info");		
						
	$options[] = array( "name" => "Content Text Color (@textColor)",
						"desc" => "The color of standard content text. The default setting is dark gray <strong>( #333333 )</strong>.",
						"id" => "bs_textcolor",
						"std" => "#333333",
						"type" => "color");											
							
	$options[] = array( "name" => "Link Text Color (@linkColor)",
						"desc" => "The color of Text Links on the site (the &lt;a&gt; element). The default setting is the standard dark blue <strong>( #00064cd )</strong>. <br><strong>NOTE:</strong> The Hover Text Color is automatically generated as 15% darker than the Link Text Color.",
						"id" => "bs_linkcolor",
						"std" => "#0064cd",
						"type" => "color");		
						
/*	
	$options[] = array( "name" => "Text Hyperlink HOVER Color (@linkColorHover)",
						"desc" => "The color of text links on the site in their hover state. The default setting is the link color but 15% darker.",
						"id" => "bs_linkColorHover",
						"std" => "darken(@linkColor, 15%)",
						"type" => "color");			
*/																							
						
	$options[] = array( "name" => "Horizontal Rule Color (@hrBorder)",
						"desc" => "The color of horizontal rules (the &lt;hr&gt; element). The default setting is very light gray <strong>( #EEEEEE )</strong>.",
						"id" => "bs_hrborder",
						"std" => "#EEEEEE",
						"type" => "color");										


						
						// Array Fonts Source
						$options_array_fonts_source = array(
							'standard' => 'Standard Font Stacks',
							'google' => 'Google Web Fonts');				
						
	$options[] = array( 'name' => "Source of Fonts",
						'desc' => "Do you want to specify standard font stacks or do you wish to load custom fonts from Google?",
						'id' => 'bs_fonts_source',
						'std' => 'standard',
						'type' => 'radio',
						'options' => $options_array_fonts_source);
						
	$options[] = array( "name" => "Standard Font Stacks",
						"desc" => "",	
						"fold" => "",
						"id" => "bs_fonts_standard",						
						"type" => "info");						
						
	// Array Fonts Standard Sans
	$options_array_fonts_standard_sans = array(
		'arial' => 'Arial, "Helvetica Neue", Helvetica, sans-serif;',
		'helvetica' => '"Helvetica Neue", Helvetica, Arial, sans-serif;',
		'verdana' => 'Verdana, Geneva, sans-serif;',
		'tahoma' => '',
		'lucida grande' => '',
		'futura' => '',
		'geneva' => '',
		'optima' => '',
		'segoe' => '',
		'calibri' => '',
		'gillsans' => ''
		);
						
	$options[] = array( 'name' => 'Sans Serif',
						'desc' => 'Select the default sans serif font stack.',
						'id' => 'bs_fonts_standard_sans',
						'std' => '',
						'type' => 'select',
						'options' => $options_array_fonts_standard_sans);					
										
						
	$options[] = array( "name" => "Google Web Fonts",
						"desc" => "",		
						"id" => "bs_fonts_google",		
						"type" => "info");
						
						

																						
					

/*-----------------------------------------------------------------------------------*/

/* INFO */		

	$options[] = array( "name" => "Info + Branding",
						"type" => "heading");
						
	$options[] = array( "name" => "Welcome to the Theme Options Control Panel",
					"desc" => "Using the settings provided, you may significantly alter the website's design, enable and disable features, and control what content is displayed and where.<br><br> <strong>Let's start by defining the website's branding</strong> Typically, a brand includes a mark (the iconic portion of a logo) and the brand name as text (the typographic portion of a logo).",
					"type" => "info");	
					
					// Navbar Brand
					$options_array_brand = array(
						"one" => "Website brand as font text",
						"two" => "Website brand as mark image + font text",
						"three" => "Website brand as mark image + text image");
						
	$options[] = array( "name" => "Branding",
						"desc" => "Should the website utilize font text to convey the website name or display images to convey the website branding or a combination of both?",
						"id" => "wordstrap_brand",
						"type" => "select",
						"options" => $options_array_brand);
						
	$options[] = array( "name" => "Brand Name",
						"desc" => "Fill in the website brand name as you wish it to appear in the site's masthead.",
						"id" => "wordstrap_brand_font_text",
						"class" => "hidden",
						"type" => "text");	
						
	$options[] = array( 'name' => 'Brand Typography',
						'desc' => 'Select from a list of Google web fonts along with the standard OS system fonts. Adjust the size and color.',
						'id' => 'wordstrap_brand_font_type',
						'std' => array( 'size' => '32px', 'face' => 'Georgia, serif', 'color' => '#f15081'),
						'type' => 'typography',
						'options' => array(
							'faces' => $typography_mixed_fonts,
							'styles' => false )
						);											
						
	$options[] = array( "name" => "Upload the brand&#39;s Logo Mark image",
						"desc" => "Upload an image to use as the brand&#39;s Logo Mark. Ignore if not applicable.",
						"id" => "wordstrap_brand_logo_mark",
						"class" => "hidden",
						"type" => "upload");
						
	$options[] = array( "name" => "Upload the brand&#39;s Logo Name Text image",
						"desc" => "Upload an image to use as the brand&#39;s Logo Name Text. Ignore if not applicable.",
						"id" => "wordstrap_brand_logo_text",
						"class" => "hidden",
						"type" => "upload");					
										
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
						"id" => "wordstrap_navbar_show",
						"std" => 1,
						"type" => "checkbox");						

	$options[] = array( "name" => "Show search in navbar?",
						"desc" => "Default is enabled. Uncheck this box to turn it off.",
						"id" => "wordstrap_navbar_search",
						"std" => 1,
						"type" => "checkbox");
						
	$options[] = array( "name" => "Include auxiliary items in navbar?",
						"desc" => "Default is enabled. Uncheck this box to turn it off.",
						"id" => "wordstrap_navbar_aux",
						"std" => 1,
						"type" => "checkbox");						
						
	// Breadcrumbs
	$options[] = array( "name" => "Breadcrumbs",
						"desc" => "",						
						"type" => "info");							

	$options[] = array( "name" => "Show Breadcrumb Navigation?",
						"desc" => "Default is show. Uncheck this box to hide breadcrumbs.",
						"id" => "wordstrap_breadcrumbs",
						"std" => 1,
						"type" => "checkbox");
						
	// Content Navigation
	$options[] = array( "name" => "Content Navigation",	
						"desc" => "",				
						"type" => "info");								

	$options[] = array( "name" => "Show content navigation above posts?",
						"desc" => "Displays links to next and previous posts above the current post and above the posts on the index page. Default is hide. Check this box to show content nav above posts.",
						"id" => "wordstrap_content_nav_above",
						"std" => 0,
						"type" => "checkbox");

	$options[] = array( "name" => "Show content navigation below posts?",
						"desc" => "Displays links to next and previous posts below the current post and below the posts on the index page. Default is show. Uncheck this box to hide content nav above posts.",
						"id" => "wordstrap_content_nav_below",
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
						"id" => "wordstrap_postmeta_date",
						"std" => 1,
						"type" => "checkbox");
						
	$options[] = array( "name" => "Show post author?",
						"desc" => "Displays the author of a post. Default is show. Uncheck this box to hide post author.",
						"id" => "wordstrap_postmeta_author",
						"std" => 1,
						"type" => "checkbox");						

	$options[] = array( "name" => "Show post categories?",
						"desc" => "Displays the categories in which a post was published. Default is show. Uncheck this box to hide post categories.",
						"id" => "wordstrap_postmeta_categories",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Show post categories on the index/posts page?",
						"desc" => "Displays the post categories on the index/posts page - as defined in Settings > Reading. Default is show. Uncheck this box to hide post categories on the index/posts page.",
						"id" => "wordstrap_postmeta_categories_index",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Show post tags?",
						"desc" => "Displays the tags attached to a post. Default is show. Uncheck this box to hide post tags.",
						"id" => "wordstrap_postmeta_tags",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Show post tags on the index/posts page?",
						"desc" => "Displays the post tags on the index/posts page - as defined in Settings > Reading. Default is show. Uncheck this box to hide post tags on the index/posts page.",
						"id" => "wordstrap_postmeta_tags_index",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Show link for # of comments / leave a comment?",
						"desc" => "Displays the number of comments and/or a Leave a comment message on posts. Default is show. Uncheck this box to hide.",
						"id" => "wordstrap_postmeta_comments_link",
						"std" => 1,
						"type" => "checkbox");	
						
	// Footer
	$options[] = array( "name" => "Footer",
						"desc" => "",
						"type" => "info");

	$options[] = array( "name" => "Enable custom footer text?",
						"desc" => "Default is disabled. Check this box to use custom footer text. Fill in your text below.",
						"id" => "wordstrap_footer",
						"std" => 0,
						"type" => "checkbox");

	$options[] = array( "name" => "Custom footer text",
						"desc" => "Enter the text here that you would like displayed at the bottom of your site. This setting will be ignored if you do not enable \"Show custom footer text\" above.",
						"id" => "wordstrap_footer_text",
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
						"id" => "wordstrap_js_transitions",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => "Alerts",
						"desc" => "The alert plugin is a tiny class for adding close functionality to alerts. * Requires Transitions if you want them to fade out on close.",
						"id" => "wordstrap_js_alerts",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Modals",
						"desc" => "Message boxes that slide down and fade in from the top of the page. Default setting is disabled. * Requires Transitions to function properly.",
						"id" => "wordstrap_js_modals",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Dropdown Menus",
						"desc" => "Add dropdown menus in the navbar, tabs, and pills.",
						"id" => "wordstrap_js_dropdowns",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Scrollspy",
						"desc" => "Use scrollspy to automatically update the links in your navbar to show the current active link based on scroll position. Default setting is disabled.",
						"id" => "wordstrap_js_scrollspy",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Tabs",
						"desc" => "Make tabs and pills more useful by allowing them to toggle through tabbable panes of content.",
						"id" => "wordstrap_js_tabs",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Tooltips",
						"desc" => "Tooltips that use CSS3 for animations and data-attributes for local title storage.",
						"id" => "wordstrap_js_tooltips",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Popovers",
						"desc" => "Add small overlays of content, like those on the iPad, to any element for housing secondary information. * Requires Tooltips.",
						"id" => "wordstrap_js_popovers",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Buttons",
						"desc" => "Do more with buttons. Control button states or create groups of buttons for more components like toolbars.",
						"id" => "wordstrap_js_buttons",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Collapse",
						"desc" => "Get base styles and flexible support for collapsible components like accordions and navigation.",
						"id" => "wordstrap_js_collapse",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Carousel",
						"desc" => "Create a merry-go-round of any content you wish to provide in an interactive slideshow of content. * Required for Featured Posts.",
						"id" => "wordstrap_js_carousel",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Typeahead",
						"desc" => "A basic, easily extended plugin for quickly creating elegant typeaheads with any form text input. Default setting is disabled.",
						"id" => "wordstrap_js_typeahead",
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
						"id" => "wordstrap_analytics",
						"std" => 0,
						"folds" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Analytics code",
						"desc" => "Enter your analytics tracking code here (WITH the &lt;script&gt; and &lt;/script&gt; tags). Note: Any text you include here will be included in your pages, EVEN IF IT IS INCORRECT. Double check your code! If the analytics option is not enabled above, this text will be ignored.",
						"id" => "wordstrap_analytics_code",
						"fold" => "wordstrap_analytics",
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
						"id" => "wordstrap_wp_disable_admin_bar",
						"std" => 0,
						"type" => "checkbox");											
	
	// Login Screen					
	$options[] = array( "name" => "Login Screen",
						"desc" => "Customize the website's login screen.",
						"type" => "info");

	$options[] = array( "name" => "Enable custom image on login page?",
						"desc" => "Enable this option and upload an image below to display a custom image on the login/register page. This replaces the default WordPress image. Default is disabled.",
						"id" => "wordstrap_custom_login_image",
						"std" => 0,
						"folds" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Upload a custom image for the login page",
						"desc" => "Upload an image to use as a custom image on the login/register page. FOR BEST RESULTS: upload an image that is 274 x 63 pixels.",
						"id" => "wordstrap_custom_login_image_file",
						"fold" => "wordstrap_custom_login_image",
						"type" => "upload");						
	
	// Outgoing Email
	$options[] = array( "name" => "Customize outgoing emails",
						"desc" => "This section allows you to override the default WordPress settings for outgoing email sender information. Instead of an email coming from \"WordPress\", you can make it say anything you want. You can do the same with the sender email address, and the return address that is used if any problems occur during delivery. \r\n &nbsp;\r\nThe default setting is enabled, and it uses your site name as the From Name and your Site Admin email address as the From address and Return Path. You can change these defaults below. If you disable this feature your site will send emails using the WordPress defaults.",
						"type" => "info");

	$options[] = array( "name" => "Enable custom sender features?",
						"desc" => "Turn on the custom sender features. Unless you specify custom values below, this tells the Theme to send emails that use your site name in the From field and your site admin email as the sender and return addresses. To set your own custom information, select the box below and type in your own values. Default setting is enabled.",
						"id" => "wordstrap_phpmailer_rewrite",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Enable customized sender information?",
						"desc" => "This allows you to customize the sender information of emails coming from your site. You must turn on \"Enable custom sender features\" above for this to work. NOTE: If you enable this option, fill in ALL fields below - otherwise your email may not work properly. Default setting is disabled.",
						"id" => "wordstrap_phpmailer_rewrite_custom",
						"std" => 0,
						"folds" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "From Name",
						"desc" => "Enter the name you want to use in the From: field.",
						"id" => "wordstrap_phpmailer_rewrite_custom_from_name",
						"std" => "",
						"fold" => "wordstrap_phpmailer_rewrite_custom",
						"type" => "text");

	$options[] = array( "name" => "From Email Address",
						"desc" => "Enter the Sender email address you want to use in the From: field.",
						"id" => "wordstrap_phpmailer_rewrite_custom_from_email",
						"std" => "",
						"fold" => "wordstrap_phpmailer_rewrite_custom",
						"type" => "text");

	$options[] = array( "name" => "Return Email Address",
						"desc" => "Enter the return email address you want to use in case a problem happens during delivery.",
						"id" => "wordstrap_phpmailer_rewrite_custom_sender",
						"std" => "",
						"fold" => "wordstrap_phpmailer_rewrite_custom",
						"type" => "text");	

																			
	return $options;

}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

	<script type="text/javascript">
	jQuery(document).ready(function($) {       
	     
	     // custom js for footer options 
		$('#wordstrap_footer').click(function() {
			$('[id^=section-wordstrap_footer_]').fadeToggle(400);
		});
		
			if ($('#wordstrap_footer:checked').val() == undefined) {
				$('[id^=section-wordstrap_footer_]').hide();
			};
			
			if ($('#wordstrap_footer:checked').val() !== undefined) {
				$('[id^=section-wordstrap_footer_]').show();
			};						
			
		// custom js for meta icon select box upon change
		$('#wordstrap_style_icons').change(function() {
			switch($(this).val()) {
				case "black" :
					$('[id=section-wordstrap_icons_custom]').hide().addClass('hidden');
				break;
				case "white" :
					$('[id=section-wordstrap_icons_custom]').hide().addClass('hidden');
				break;
				case "custom" :
					$('[id=section-wordstrap_icons_custom]').slideDown().removeClass('hidden');
				break;
			}
		});
		
		// show and hide sections on page load based off of the currently selected meta icon option 
	    	if ($('#wordstrap_style_icons').val() == "black") {
	        $('[id=section-wordstrap_icons_custom]').hide().addClass('hidden');
	        };
	    	if ($('#wordstrap_style_icons').val() == "white") {
	        $('[id=section-wordstrap_icons_custom]').hide().addClass('hidden');
	        };
		if ($('#wordstrap_style_icons').val() == "custom") {
	        $('[id=section-wordstrap_icons_custom]').show().removeClass('hidden');
	        };		    

		// custom js for navbar brand options
		$('#wordstrap_brand').change(function() {
			switch($(this).val()) {
				case "one":
					$('[id=section-wordstrap_brand_font_text], [id=section-wordstrap_brand_font_type]').show().removeClass('hidden');
			        	$('[id=section-wordstrap_brand_logo_mark], [id=section-wordstrap_brand_logo_text]').hide().addClass('hidden');
				break;
				case "two":
					$('[id=section-wordstrap_brand_logo_text]').hide().addClass('hidden');
					$('[id=section-wordstrap_brand_font_text], [id=section-wordstrap_brand_font_type], [id=section-wordstrap_brand_logo_mark]').show().removeClass('hidden');
				break;
				case "three":
					$('[id=section-wordstrap_brand_font_text], [id=section-wordstrap_brand_font_type]').hide().addClass('hidden');
			        	$('[id=section-wordstrap_brand_logo_mark], [id=section-wordstrap_brand_logo_text]').show().removeClass('hidden');
				break;				
			}
		});
		
		// show and hide sections on page load based off of the currently selected navbar brand option 
		if ($('#wordstrap_brand').val() == "one") {
			$('[id=section-wordstrap_brand_font_text], [id=section-wordstrap_brand_font_type]').show().removeClass('hidden');
			$('[id=section-wordstrap_brand_logo_mark], [id=section-wordstrap_brand_logo_text]').hide().addClass('hidden');
		    }; 
		if ($('#wordstrap_brand').val() == "two") {
		     $('[id=section-wordstrap_brand_logo_mark], [id=section-wordstrap_brand_font_text], [id=section-wordstrap_brand_font_type]').show().removeClass('hidden');
		     $('[id=section-wordstrap_brand_logo_text]').hide().addClass('hidden');
		    };
		if ($('#wordstrap_brand').val() == "three") {
		     $('[id=section-wordstrap_brand_logo_mark], [id=section-wordstrap_brand_logo_text]').show().removeClass('hidden');
		     $('[id=section-wordstrap_brand_font_text], [id=section-wordstrap_brand_font_type]').hide().addClass('hidden');
		    };    
		    
    });
  </script>
  
<?php
}