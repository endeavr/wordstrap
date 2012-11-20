<?php

/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {
    $optionsframework_settings = get_option( "optionsframework" );
    $optionsframework_settings["id"] = "ws_options";
    update_option( "optionsframework", $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace "options_framework_theme"
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	$default_sitename = get_option( "blogname" );
	
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
     $options_tags_obj = get_tags( array( "hide_empty" => false ) );
     $options_tags[""] = "Select a tag:";
     foreach ($options_tags_obj as $tag) {
         $options_tags[$tag->term_id] = $tag->name;
     }

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages( "sort_column=post_parent,menu_order" );
	$options_pages[""] = "Select a page:";
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	// Note that you may optionally reference the child theme's img directory
	$imagepath =  get_template_directory_uri() . "/assets/img/";
	$imagepath_child =  get_stylesheet_directory_uri() . "/assets/img/";
	
	// Options for the Branding
	$options_array_brand = array(
		"one" 	  => "Brand as font text",
		"two"       => "Brand as mark image + font text",
		"three"     => "Brand as a logo image",
		//"four"      => "Brand as an icon font mark + font text",
		//"five"      => "Brand as an icon font logo"
	);
	
	// Options for the Navbar Branding
	$options_array_navbarbrand = array(
		"masthead-brand" 	 => "Use the same branding as the Masthead and auto-adjust it to fit.",
		"navbar-brand"       => "Upload a unique brand image for the navbar.",
	);
	
	// Options Background Repeat Options
	$options_repeat = array(
		"repeat"    => "Repeat All",
		"no-repeat" => "No Repeat",
		"repeat-x"  => "Repeat Horizontally",
		"repeat-y"  => "Repeat Vertically" 
	);
			
	// Options Background Attachment Options
	$options_attach = array(
		"scroll"    => "Scroll",
		"fixed"     => "Fixed" 
	);
	
	// Generate Pattern Array
	$options_patterns_sheer = options_patterns_get_file_list(
	    get_template_directory() . "/assets/img/patterns-sheer/", // $directory_path
	    "{png,jpg}", // $filetype
	    get_template_directory_uri() . "/assets/img/patterns-sheer/" // $directory_uri
	);
	
	$options_patterns_opaque = options_patterns_get_file_list(
	    get_template_directory() . "/assets/img/patterns-opaque/", // $directory_path
	    "{png,jpg}", // $filetype
	    get_template_directory_uri() . "/assets/img/patterns-opaque/" // $directory_uri
	);	
	
	$options_patterns_mix = array_merge( 
		options_patterns_get_file_list(
		    get_template_directory() . "/assets/img/patterns-sheer/", // $directory_path
		    "{png,jpg}", // $filetype
		    get_template_directory_uri() . "/assets/img/patterns-sheer/" // $directory_uri
		) , 
		options_patterns_get_file_list(
		    get_template_directory() . "/assets/img/patterns-opaque/", // $directory_path
		    "{png,jpg}", // $filetype
		    get_template_directory_uri() . "/assets/img/patterns-opaque/" // $directory_uri
		)
	);
		
	
	// Options for the General Background
	$options_bkgd_general = array(
		"transparent"   => "transparent",
		"color"         => "solid background color only",
		"gradient"      => "gradient based on bkgd color",
		"patternsheer"  => "select pattern (sheer)",
		"patternopaque" => "select pattern (opaque)",
		"uploadsheer"   => "upload image (sheer)",
		"uploadopaque"  => "upload image (opaque)"
	);	
	
	// Options for the Body Background
	$options_bkgd_body = array(
		"color"         => "solid background color only",
		"gradient"      => "gradient based on bkgd color",
		"patternsheer"  => "select pattern (sheer)",
		"patternopaque" => "select pattern (opaque)",
		"uploadsheer"   => "upload image (sheer)",
		"uploadopaque"  => "upload image (opaque)"
	);
	
	// Options for the Sidebar Background
	$options_bkgd_sidebar = array(
		"auto"          => "auto generate based on content bkgd",
		"transparent"   => "transparent",
		"color"         => "solid background color only",
		"gradient"      => "gradient based on bkgd color",
		"patternsheer"  => "select pattern (sheer)",
		"patternopaque" => "select pattern (opaque)",
		"uploadsheer"   => "upload image (sheer)",
		"uploadopaque"  => "upload image (opaque)"
	);
	
	// Options for the Colophon Background
	$options_bkgd_colophon = array(
		"auto"          => "auto generate based on footer bkgd",
		"transparent"   => "transparent",
		"color"         => "solid background color only",
		"gradient"      => "gradient based on bkgd color",
		"patternsheer"  => "select pattern (sheer)",
		"patternopaque" => "select pattern (opaque)",
		"uploadsheer"   => "upload image (sheer)",
		"uploadopaque"  => "upload image (opaque)"	
	);
	
	$options = array();
	
/*---------------------------------------------------------------*/	

/* STYLES */
																						
$options[] = array( 
	"name"      => "Styles",
	"type"      => "heading" );
	
/*==============================================*/		
	
// Component Base Sizing					
$options[] = array( 
	"name"      => "Component Base Sizing",
	"desc"      => "Use these options to define the default base sizes for key components.",
	"type"      => "infotoggle" );	
	
$options["ws_baseborderradius"] = array( 
	"name"      => "Base Border Radius (@baseBorderRadius)",
	"desc"      => "The default setting is <strong>( 4px )</strong>.",
	"id"        => "ws_baseborderradius",
	"std"       => "4px",
	"class"     => "mini",
	"type"      => "text" );
	
$options["ws_borderradiuslarge"] = array( 
	"name"      => "Border Radius Large (@borderRadiusLarge)",
	"desc"      => "The default setting is <strong>( 6px )</strong>.",
	"id"        => "ws_borderradiuslarge",
	"std"       => "6px",
	"class"     => "mini",
	"type"      => "text" );
	
$options["ws_borderradiussmall"] = array( 
	"name"      => "Border Radius Small (@borderRadiusSmall)",
	"desc"      => "The default setting is <strong>( 3px )</strong>.",
	"id"        => "ws_borderradiussmall",
	"std"       => "3px",
	"class"     => "mini",
	"type"      => "text" );		
	
$options[] = array( 
	"type"      => "closetoggle" );					
	
/*--------------------*/	
		
// Define Colors					
$options[] = array( 
	"name"      => "Define Colors",
	"desc"      => "Use these options to define the default iterations of each general color.",
	"id"        => "ws_styles_definecolors",
	"type"      => "infotoggle" );															
	
$options["ws_blue"] = array( 
	"name"      => "Define Color - Blue (@blue)",
	"desc"      => "This defines the default shade of BLUE used on the website. The default setting is <strong>( #049cdb )</strong>.",
	"id"        => "ws_blue",
	"std"       => "#049cdb",
	"type"      => "color" );	
	
$options["ws_bluedark"] = array( 
	"name"      => "Define Color - Dark Blue (@blueDark)",
	"desc"      => "This defines the default shade of DARK blue used on the website. The default setting is <strong>( #026894 )</strong>.",
	"id"        => "ws_bluedark",
	"std"       => "#026894",
	"type"      => "color" );							
	
$options["ws_green"] = array( 
	"name"      => "Define Color - Green (@green)",
	"desc"      => "This defines the default shade of GREEN used on the website. The default setting is <strong>( #46a546 )</strong>.",
	"id"        => "ws_green",
	"std"       => "#46a546",
	"type"      => "color" );		
	
$options["ws_red"] = array( 
	"name"      => "Define Color - Red (@red)",
	"desc"      => "This defines the default shade of RED used on the website. The default setting is <strong>( #9d261d )</strong>.",
	"id"        => "ws_red",
	"std"       => "#9d261d",
	"type"      => "color" );	
	
$options["ws_yellow"] = array( 
	"name"      => "Define Color - Yellow (@yellow)",
	"desc"      => "This defines the default shade of YELLOW used on the website. The default setting is <strong>( #ffc40d )</strong>.",
	"id"        => "ws_yellow",
	"std"       => "#ffc40d",
	"type"      => "color" );
	
$options["ws_orange"] = array( 
	"name"      => "Define Color - Orange (@orange)",
	"desc"      => "This defines the default shade of ORANGE used on the website. The default setting is <strong>( #f89406 )</strong>.",
	"id"        => "ws_orange",
	"std"       => "#f89406",
	"type"      => "color" );
	
$options["ws_pink"] = array( 
	"name"      => "Define Color - Pink (@pink)",
	"desc"      => "This defines the default shade of PINK used on the website. The default setting is <strong>( #c3325f )</strong>.",
	"id"        => "ws_pink",
	"std"       => "#c3325f",
	"type"      => "color" );
	
$options["ws_purple"] = array( 
	"name"      => "Define Color - Purple (@purple)",
	"desc"      => "This defines the default shade of PURPLE used on the website. The default setting is <strong>( #7a43b6 )</strong>.",
	"id"        => "ws_purple",
	"std"       => "#7a43b6",
	"type"      => "color" );
	
$options[] = array( 
	"type"      => "closetoggle" );	
	
/*--------------------*/			
		
// Dropdowns		
$options[] = array( 
	"name"      => "Dropdowns",
	"desc"      => "Set the appearance of dropdowns. Most prominently, these will appear as the sub menus for the navbar, but they may also be utilized in other components.",
	"type"      => "infotoggle" );	
	
$options["ws_dropdownbackground"] = array( 
	"name"      => "Background Color (@dropdownBackground)",
	"desc"      => "The default setting is white <strong>( #FFFFFF )</strong>.",
	"id"        => "ws_dropdownbackground",
	"std"       => "#FFFFFF",
	"type"      => "color" );						
	
$options["ws_dropdowndividertop"] = array( 
	"name"      => "Top Divider Color (@dropdownDividerTop)",
	"desc"      => "The default setting is light gray <strong>( #E5E5E5 )</strong>.",
	"id"        => "ws_dropdowndividertop",
	"std"       => "#E5E5E5",
	"type"      => "color" );
	
$options["ws_dropdowndividerbottom"] = array( 
	"name"      => "Bottom Divider Color (@dropdownDividerBottom)",
	"desc"      => "The default setting is white <strong>( #FFFFFF )</strong>.",
	"id"        => "ws_dropdowndividerbottom",
	"std"       => "#FFFFFF",
	"type"      => "color" );
	
$options["ws_dropdownlinkcolor"] = array( 
	"name"      => "Link Color (@dropdownLinkColor)",
	"desc"      => "The default setting is dark gray <strong>( #333333 )</strong>.",
	"id"        => "ws_dropdownlinkcolor",
	"std"       => "#333333",
	"type"      => "color" );
	
$options["ws_dropdownlinkcolorhover"] = array( 
	"name"      => "Link Hover Color (@dropdownLinkColorHover)",
	"desc"      => "The default setting is white <strong>( #FFFFFF )</strong>.",
	"id"        => "ws_dropdownlinkcolorhover",
	"std"       => "#FFFFFF",
	"type"      => "color" );
	
$options["ws_dropdownlinkbackgroundhover"] = array( 
	"name"      => "Link Hover Background Color (@dropdownLinkBackgroundHover)",
	"desc"      => "The default setting is dark gray <strong>( #222222 )</strong>.",
	"id"        => "ws_dropdownlinkbackgroundhover",
	"std"       => "#222222",
	"type"      => "color" );
	
$options["ws_dropdownlinkcoloractive"] = array( 
	"name"      => "Link Active Color (@dropdownLinkColorActive)",
	"desc"      => "The default setting is black <strong>( #000000 )</strong>.",
	"id"        => "ws_dropdownlinkcoloractive",
	"std"       => "#000000",
	"type"      => "color" );	
	
$options["ws_dropdownlinkbackgroundactive"] = array( 
	"name"      => "Link Active Background Color (@dropdownLinkBackgroundActive)",
	"desc"      => "The default setting is light gray <strong>( #CCCCCC )</strong>.",
	"id"        => "ws_dropdownlinkbackgroundactive",
	"std"       => "#CCCCCC",
	"type"      => "color" );
	
$options[] = array( 
	"type"      => "closetoggle" );		
	
/*--------------------*/											
	
// Forms		
$options[] = array( 
	"name"      => "Forms",
	"desc"      => "Set the appearance of forms. Most prominently, this will influence the display of the contact form, but form fields may also be utilized in other components.",
	"type"      => "infotoggle" );	
	
$options["ws_placeholdertext"] = array( 
	"name"      => "Placeholder Text Color (@placeholderText)",
	"desc"      => "Set the color of the placeholder text in the form field. The default setting is light gray <strong>( #999999 )</strong>.",
	"id"        => "ws_placeholdertext",
	"std"       => "#999999",
	"type"      => "color" );							
	
$options["ws_inputbackground"] = array( 
	"name"      => "Background Color (@inputBackground)",
	"desc"      => "Set the background color of the form field. The default setting is white <strong>( #FFFFFF )</strong>.",
	"id"        => "ws_inputbackground",
	"std"       => "#FFFFFF",
	"type"      => "color" );	
	
$options["ws_inputborder"] = array( 
	"name"      => "Border Color (@inputBorder)",
	"desc"      => "Set the border color of the form field. The default setting is light gray <strong>( #CCCCCC )</strong>.",
	"id"        => "ws_inputborder",
	"std"       => "#CCCCCC",
	"type"      => "color" );		
/*	
$options["ws_inputborderradius"] = array( 
	"name"      => "Border Radius (@inputBorderRadius)",
	"desc"      => "This controls the rounded corners of the form field. 0px would render it as a right angle. At most, set this to 10px. The default setting is <strong>( 3px )</strong>.",
	"id"        => "ws_inputborderradius",
	"std"       => "3px",
	"class"     => "mini",
	"type"      => "text" );
*/	
$options["ws_inputdisabledbackground"] = array( 
	"name"      => "Disabled Background (@inputnDisabledBackground)",
	"desc"      => "The default setting is near white <strong>( #EEEEEE )</strong>.",
	"id"        => "ws_inputdisabledbackground",
	"std"       => "#EEEEEE",
	"type"      => "color" );
	
$options["ws_inputactionsbackground"] = array( 
	"name"      => "Actions Background (@inputActionsBackground)",
	"desc"      => "The default setting is near white <strong>( #F5F5F5 )</strong>.",
	"id"        => "ws_inputactionsbackground",
	"std"       => "#F5F5F5",
	"type"      => "color" );	
	
$options[] = array( 
	"type"      => "closetoggle" );	
	
/*--------------------*/		
	
// Form States & Alerts		
$options[] = array( 
	"name"      => "Form States & Alerts",
	"desc"      => "Set the appearance of certain types of form states and alerts. Most prominently, these will be used for various types of notifications. <br><br><strong>NOTE:</strong> The border style is automatically set based on the background color selections.",	
	"type"      => "infotoggle" );	
	
$options["ws_warningtext"] = array( 
	"name"      => "Warning Text Color (@WarningText)",
	"desc"      => "The default setting is <strong>( #C09853 )</strong>.",
	"id"        => "ws_warningtext",
	"std"       => "#C09853",
	"type"      => "color" );			
	
$options["ws_warningbackground"] = array( 
	"name"      => "Warning Background (@WarningBackground)",
	"desc"      => "The default setting is <strong>( #FCF8E3 )</strong>.",
	"id"        => "ws_warningbackground",
	"std"       => "#FCF8E3",
	"type"      => "color" );				
	
$options["ws_errortext"] = array( 
	"name"      => "Error Text Color (@errorText)",
	"desc"      => "The default setting is <strong>( #b94a48)</strong>.",
	"id"        => "ws_errortext",
	"std"       => "#b94a48",
	"type"      => "color" );			
	
$options["ws_errorbackground"] = array( 
	"name"      => "Error Background (@errorBackground)",
	"desc"      => "The default setting is <strong>( #f2dede )</strong>.",
	"id"        => "ws_errorbackground",
	"std"       => "#f2dede",
	"type"      => "color" );		
	
$options["ws_successtext"] = array( 
	"name"      => "Success Text Color (@successText)",
	"desc"      => "The default setting is <strong>( #468847 )</strong>.",
	"id"        => "ws_successtext",
	"std"       => "#468847",
	"type"      => "color" );			
	
$options["ws_successbackground"] = array( 
	"name"      => "Success Background (@successBackground)",
	"desc"      => "The default setting is <strong>( #dff0d8 )</strong>.",
	"id"        => "ws_successbackground",
	"std"       => "#dff0d8",
	"type"      => "color" );
	
$options["ws_infotext"] = array( 
	"name"      => "Info Text Color (@infoText)",
	"desc"      => "The default setting is <strong>( #3a87ad )</strong>.",
	"id"        => "ws_infotext",
	"std"       => "#3a87ad",
	"type"      => "color" );			
	
$options["ws_infobackground"] = array( 
	"name"      => "Info Background (@infoBackground)",
	"desc"      => "The default setting is <strong>( #d9edf7 )</strong>.",
	"id"        => "ws_infobackground",
	"std"       => "#d9edf7",
	"type"      => "color" );	
	
$options[] = array( 
	"type"      => "closetoggle" );	
	
/*--------------------*/		
	
// Buttons		
$options[] = array( 
	"name"      => "Buttons",
	"desc"      => "Set the gradient background for the default button, inverse button, and certain types of alert buttons.<br><br><strong>NOTE:</strong> the primary button class is automatically styled based on the default link color choice in the typography settings.",
	"type"      => "infotoggle" );	
	
$options["ws_btnbackground"] = array( 
	"name"      => "Default Button Gradient - BASE (@btnBackground)",
	"desc"      => "The default setting is white <strong>( #FFFFFF )</strong>.",
	"id"        => "ws_btnbackground",
	"std"       => "#FFFFFF",
	"type"      => "color" );	
					
$options["ws_btnprimarybackground"] = array( 
	"name"      => "Primary Button Gradient - BASE (@btnPrimaryBackground)",
	"desc"      => "The default setting is dark blue <strong>( #026894 )</strong>.",
	"id"        => "ws_btnprimarybackground",
	"std"       => "#049cdb",
	"type"      => "color" );	
											
$options["ws_btninfobackground"] = array( 
	"name"      => "Info Button Gradient - BASE (@btnInfoBackground)",
	"desc"      => "The default setting is white <strong>( #5bc0de )</strong>.",
	"id"        => "ws_btninfobackground",
	"std"       => "#5bc0de",
	"type"      => "color" );	
						
$options["ws_btnsuccessbackground"] = array( 
	"name"      => "Success Button Gradient - BASE (@btnSuccessBackground)",
	"desc"      => "The default setting is white <strong>( #62c462 )</strong>.",
	"id"        => "ws_btnsuccessbackground",
	"std"       => "#62c462",
	"type"      => "color" );	
						
$options["ws_btnwarningbackground"] = array( 
	"name"      => "Warning Button Gradient - BASE (@btnWarningBackground)",
	"desc"      => "The default setting is white <strong>( #fbb450 )</strong>.",
	"id"        => "ws_btnwarningbackground",
	"std"       => "#fbb450",
	"type"      => "color" );	
						
$options["ws_btndangerbackground"] = array( 
	"name"      => "Danger Button Gradient - BASE (@btnDangerBackground)",
	"desc"      => "The default setting is white <strong>( #ee5f5b )</strong>.",
	"id"        => "ws_btndangerbackground",
	"std"       => "#ee5f5b",
	"type"      => "color" );	
						
$options["ws_btninversebackground"] = array( 
	"name"      => "Inverse Button Gradient - BASE (@btnInverseBackground)",
	"desc"      => "The default setting is white <strong>( #444444 )</strong>.",
	"id"        => "ws_btninversebackground",
	"std"       => "#444444",
	"type"      => "color" );	
	
$options[] = array( 
	"type"      => "closetoggle" );	

/*--------------------*/											
																		
// Tables		
$options[] = array( 
	"name"      => "Tables",
	"desc"      => "Set the appearance of tables.",	
	"type"      => "infotoggle" );	
						
$options["ws_tablebackground"] = array( 
	"name"      => "Background Color (@tableBackground)",
	"desc"      => "The default setting is <strong>( transparent )</strong>.",
	"id"        => "ws_tablebackground",
	"std"       => "",
	"type"      => "color" );			

$options["ws_tablebackgroundaccent"] = array( 
	"name"      => "Background Accent Color (@tableBackgroundAccent)",
	"desc"      => "The default setting is near white <strong>( #F9F9F9 )</strong>.",
	"id"        => "ws_tablebackgroundaccent",
	"std"       => "#F9F9F9",
	"type"      => "color" );			
	
$options["ws_tablebackgroundhover"] = array( 
	"name"      => "Background Hover Color (@tableBackgroundHover)",
	"desc"      => "The default setting is near white <strong>( #F5F5F5 )</strong>.",
	"id"        => "ws_tablebackgroundhover",
	"std"       => "#F5F5F5",
	"type"      => "color" );	
	
$options["ws_tableborder"] = array( 
	"name"      => "Border Color (@tableBorder)",
	"desc"      => "The default setting is light gray <strong>( #DDDDDD )</strong>.",
	"id"        => "ws_tableborder",
	"std"       => "#DDDDDD",
	"type"      => "color" );	
	
$options[] = array( 
	"type"      => "closetoggle" );	
	
/*--------------------*/		
	
// Hero Unit	
$options[] = array( 
	"name"      => "Hero Layout",
	"desc"      => "Set the appearance of the Hero Layout. <br><br><strong>NOTE:</strong> Most of its style variables are inherited from other components.",
	"type"      => "infotoggle" );	
	
$options["ws_herounitbackground"] = array( 
	"name"      => "Hero Layout Background Color (@heroUnitBackground)",
	"desc"      => "The default setting is near white <strong>( #EEEEEE )</strong>.",
	"id"        => "ws_herounitbackground",
	"std"       => "#EEEEEE",
	"type"      => "color" );
	
$options["ws_herounitheadingcolor"] = array( 
	"name"      => "Hero Layout Heading Color (@heroUnitHeadingColor)",
	"desc"      => "The default setting is <strong>( inherited from the universal Headings )</strong>.",
	"id"        => "ws_herounitheadingcolor",
	"std"       => "",
	"type"      => "color" );
	
$options["ws_herounitleadcolor"] = array( 
	"name"      => "Hero Layout Lead Color (@heroUnitLeadColor)",
	"desc"      => "The default setting is <strong>( inherited from the universal Typography )</strong>.",
	"id"        => "ws_herounitleadcolor",
	"std"       => "",
	"type"      => "color" );	
	
$options[] = array( 
	"type"      => "closetoggle" );		
	
/*--------------------*/					
	
// Tooltip
$options[] = array( 
	"name"      => "Tooltip Javascript Element",
	"desc"      => "Set the appearance of the Tooltip element. NOTE: The arrow color is automatically set based on the background selecition.",	
	"type"      => "infotoggle" );	
	
$options["ws_tooltipcolor"] = array( 
	"name"      => "Tooltip Text Color (@tooltipColor)",
	"desc"      => "The default setting is white <strong>( #FFFFFF )</strong>.",
	"id"        => "ws_tooltipcolor",
	"std"       => "#FFFFFF",
	"type"      => "color" );								
	
$options["ws_tooltipbackground"] = array( 
	"name"      => "Tooltip Background Color (@tooltipBackground)",
	"desc"      => "The default setting is black <strong>( #000000 )</strong>.",
	"id"        => "ws_tooltipbackground",
	"std"       => "#000000",
	"type"      => "color" );		
	
$options["ws_tooltiparrowwidth"] = array( 
	"name"      => "Tooltip Arrow Width (@tooltipArrowWidth)",
	"desc"      => "The default setting is <strong>( 5px )</strong>.",
	"id"        => "ws_tooltiparrowwidth",
	"std"       => "5px",
	"class"     => "mini",
	"type"      => "text" );	
	
$options[] = array( 
	"type"      => "closetoggle" );	
	
/*--------------------*/		
	
// Popover
$options[] = array( 
	"name"      => "Popover Javascript Element",
	"desc"      => "Set the appearance of the Popover element. <br><br><strong>NOTE:</strong> The arrow color and title background are automatically set based on the background selecition.",	
	"type"      => "infotoggle" );									
	
$options["ws_popoverbackground"] = array( 
	"name"      => "Popover Background Color (@popoverBackground)",
	"desc"      => "The default setting is white <strong>( #FFFFFF )</strong>.",
	"id"        => "ws_popoverbackground",
	"std"       => "#FFFFFF",
	"type"      => "color" );		
	
$options["ws_popoverarrowwidth"] = array( 
	"name"      => "Popover Arrow Width (@popoverArrowWidth)",
	"desc"      => "The default setting is <strong>( 10px )</strong>.",
	"id"        => "ws_popoverarrowwidth",
	"std"       => "10px",
	"class"     => "mini",
	"type"      => "text" );	
	
$options[] = array( 
	"type"      => "closetoggle" );	
	
/*--------------------*/			
	
// Pagination
$options[] = array( 
	"name"      => "Pagination",
	"desc"      => "Set the appearance of the Pagination elements.",	
	"type"      => "infotoggle" );									
	
$options["ws_paginationbackground"] = array( 
	"name"      => "Pagination Background Color (@paginationBackground)",
	"desc"      => "The default setting is white <strong>( #FFFFFF )</strong>.",
	"id"        => "ws_paginationbackground",
	"std"       => "#FFFFFF",
	"type"      => "color" );		
	
$options["ws_paginationborder"] = array( 
	"name"      => "Pagination Border Color (@paginationBorder)",
	"desc"      => "The default setting is very light gray <strong>( #DDDDDD )</strong>.",
	"id"        => "ws_paginationborder",
	"std"       => "#DDDDDD",
	"type"      => "color" );	
	
$options["ws_paginationactivebackground"] = array( 
	"name"      => "Pagination Active Background Color (@paginationActiveBackground)",
	"desc"      => "The default setting is near white <strong>( #F5F5F5 )</strong>.",
	"id"        => "ws_paginationactivebackground",
	"std"       => "#F5F5F5",
	"type"      => "color" );	
	
$options[] = array( 
	"type"      => "closetoggle" );	
	
/*--------------------*/														
	
// Wells
$options[] = array( 
	"name"      => "Wells",
	"desc"      => "Set the appearance of the Wells element.",
	"type"      => "infotoggle" );									
	
$options["ws_wellbackground"] = array( 
	"name"      => "Wells Background Color (@wellBackground)",
	"desc"      => "The default setting is near white <strong>( #F5F5F5 )</strong>.",
	"id"        => "ws_wellbackground",
	"std"       => "#F5F5F5",
	"type"      => "color" );	
	
$options[] = array( 
	"type"      => "closetoggle" );																																														
/*-----------------------------------------------------------------------------------*/

/* TYPOGRAPHY */

$options[] = array( 
	"name"      => "Typography + Iconography",
	"type"      => "heading" );																			
	
/*==============================================*/		

// Icons + Graphics			
$options[] = array( 
	"name"      => "Iconography + Graphical Type Elements",
	"desc"      => "This website theme utilizes both a custom icon font and Font Awesome. You may control their display.",				
	"type"      => "infotoggle" );			

$options["ws_iconfontawesome"] = array( 
	"name"      => "Icon Color (@iconFontAwesome)",
	"desc"      => "The color of the meta icons. The default setting is black <strong>( #000000 )</strong>.",
	"id"        => "ws_iconfontawesome",
	"std"       => "#000000",
	"type"      => "color" );
	
$options["ws_hrborder"] = array( 
	"name"      => "Horizontal Rule Color (@hrBorder)",
	"desc"      => "The color of horizontal rules (the &lt;hr&gt; element). The default setting is medium gray <strong>( #AAAAAA )</strong>.",
	"id"        => "ws_hrborder",
	"std"       => "#AAAAAA",
	"type"      => "color" );
	
$options[] = array( 
	"type"      => "closetoggle" );		
	
/*--------------------*/													
	
// TYPE - Base Font						
$options[] = array( 
	"name"      => "Base Font",
	"desc"      => "Set the base font. This is the default for the website.",
	"type"      => "infotoggle" );																		

$options["ws_basefont"] = array( 
	"name"      => "Base Font (@baseFontSize, @baseFontFamily, @textColor)",
	"desc"      => "Select either a standard Operating System Font Stack or a custom Google Web Font from the dropdown. Adjust the size and color.",
	"id"        => "ws_basefont",
	"std"       => array( "size" => "14px", "face" => '"Helvetica Neue", Helvetica, Arial, sans-serif', "color" => "#333333"),
	"type"      => "typography",
	"options"   => array(
		"faces" => $typography_fonts_all_mix,
		"styles" => false )
	);
	
$options["ws_baselineheight"] = array( 
	"name"      => "Base Line Height (@baseLineHeight)",
	"desc"      => "Set the line height of the base font in pixels. <br>The default is <strong>( 20px )</strong>.",
	"id"        => "ws_baselineheight",
	"std"       => "20px",
	"class"     => "mini",
	"type"      => "text" );		
	
$options[] = array( 
	"type"      => "closetoggle" );	

/*--------------------*/													
	
// TYPE - Link Colors	
$options[] = array( 
	"name"      => "Hyperlink Colors",
	"desc"      => "Choose the default link colors.",	
	"type"      => "infotoggle" );
							
$options["ws_linkcolor"] = array( 
	"name"      => "Link Text Color (@linkColor)",
	"desc"      => "The color of Text Links on the site (the &lt;a&gt; element). The default setting is the standard dark blue <strong>( #00064cd )</strong>.",
	"id"        => "ws_linkcolor",
	"std"       => "#026894",
	"type"      => "color" );		
	
$options["ws_linkcolorhover"] = array( 
	"name"      => "Link Text HOVER Color (@linkColorHover)",
	"desc"      => "The color of Text Links on the site in their hover state. The default setting is generated automatically by making <strong>the Link Color 15% darker</strong>.",
	"id"        => "ws_linkcolorhover",
	"std"       => "",
	"type"      => "color" );	

$options[] = array( 
	"type"      => "closetoggle" );
		
/*--------------------*/																					

// TYPE - Font Family Defaults 	
$options[] = array( 
	"name"      => "Font Family Defaults",
	"desc"      => "Set the default font stacks for each type of font.",
	"type"      => "infotoggle" );						
														
$options["ws_sansfontfamily"] = array( 
	"name"      => "Sans-Serif Font Family (@sansFontFamily)",
	"desc"      => "Select either a standard Operating System Font Stack or a custom Google Web Font from the dropdown.",
	"id"        => "ws_sansfontfamily",
	"type"      => "select",
	"std"       => '"Helvetica Neue", Helvetica, Arial, sans-serif',
	"options"   => $typography_fonts_sans_mix );			
	
$options["ws_seriffontfamily"] = array( 
	"name"      => "Serif Font Family (@serifFontFamily)",
	"desc"      => "Select either a standard Operating System Font Stack or a custom Google Web Font from the dropdown.",
	"id"        => "ws_seriffontfamily",
	"type"      => "select",
	"std"       => 'Georgia, Times, "Times New Roman", serif',
	"options"   => $typography_fonts_serif_mix );			
	
$options["ws_monofontfamily"] = array( 
	"name"      => "Monospace Font Family (@monoFontFamily)",
	"desc"      => "Select either a standard Operating System Font Stack or a custom Google Web Font from the dropdown.",
	"id"        => "ws_monofontfamily",
	"type"      => "select",
	"std"       => 'Monaco, Menlo, Consolas, "Lucida Console", "Courier New", monospace',
	"options"   => $typography_fonts_mono_mix );	
	
$options["ws_altfontfamily"] = array( 
	"name"      => "Alt Font Family (@altFontFamily)",
	"desc"      => "Select either a standard Operating System Font Stack or a custom Google Web Font from the dropdown.",
	"id"        => "ws_altfontfamily",
	"type"      => "select",
	"std"       => 'Segoe, "Segoe UI", "Helvetica Neue", Arial, sans-serif',
	"options"   => $typography_fonts_all_mix );		
	
$options[] = array( 
	"type"      => "closetoggle" );		
	
/*--------------------*/						

// TYPE - Headings Font																				
$options[] = array( 
	"name"      => "Headings Font",
	"desc"      => "Set the defaults for all the headings fonts (h1, h2, h3, h4, h5, h6)",
	"type"      => "infotoggle" );	

$options["ws_headingsfont"] = array( 
	"name"      => "Headings Font (@headingsFontFamily, @headingsFontWeight, @headingsColor)",
	"desc"      => "Select either a standard Operating System Font Stack or a custom Google Web Font from the dropdown. Adjust the weight and color.",
	"id"        => "ws_headingsfont",
	"std"       => array( "face" => '"Helvetica Neue", Helvetica, Arial, sans-serif', "style" => "normal", "color" => "#333333"),
	"type"      => "typography",
	"options"   => array(
		"faces" => $typography_fonts_all_mix,
		"sizes" => false )
	);
	
$options[] = array( 
	"type"      => "closetoggle" );
		
/*--------------------*/		

// TYPE - H1 Font	
$options[] = array( 
	"name"      => "H1 Font (Main Titles)",
	"desc"      => "Set the specific properties of the H1 heading. The H1 is used for the post and page titles.",
	"type"      => "infotoggle" );	

$options["ws_h1font"] = array( 
	"name"      => "H1 Font (@h1FontSize, @h1FontFamily, @h1FontWeight, @h1Color)",
	"desc"      => "Select either a standard Operating System Font Stack or a custom Google Web Font from the dropdown. Adjust the size, weight, and color.",
	"id"        => "ws_h1font",
	"std"       => array( "size" => "36px", "face" => '"Helvetica Neue", Helvetica, Arial, sans-serif', "style" => "normal", "color" => "#333333"),
	"type"      => "typography",
	"options"   => array(
		"faces" => $typography_fonts_all_mix, )
	);
	
$options["ws_h1lineheight"] = array( 
	"name"      => "H1 - Line Height (@h1LineHeight)",
	"desc"      => "Set the line height of the H1 font in pixels. <br>The default is <strong>( 40px )</strong>.",
	"id"        => "ws_h1lineheight",
	"std"       => "40px",
	"class"     => "mini",
	"type"      => "text" );
	
$options[] = array( 
	"type"      => "closetoggle" );	
	
/*-----------------------------------------------------------------------------------*/

/* BODY */

$options[] = array( 
	"name"      => "Body",
	"type"      => "heading" );
	
/*==============================================*/

// BODY Background Styles					
$options[] = array( 
	"name"      => "Background Style",
	"desc"      => "Use these options to set the color and/or pattern/image background of the website body.",			
	"type"      => "infotoggle" );					
	
$options["ws_bodyoption"] = array( 
	"name"      => "Body Background Options (@bodyOption)",
	"desc"      => "",
	"id"        => "ws_bodyoption",
	"type"      => "select",
	"std"       => "color",
	"options"   => $options_bkgd_body );																
	
$options["ws_bodybackground"] = array( 
	"name"      => "Body Background Color (@bodyBackground)",
	"desc"      => "The color of the body background. The default setting is near WHITE <strong>( #FEFEFE )</strong>.",
	"id"        => "ws_bodybackground",
	"std"       => "#FEFEFE",
	"type"      => "color" );	
	
$options["ws_bodyrepeat"] = array( 
	"name"      => "Body Background Repeat Options (@bodyRepeat)",
	"desc"      => "Select how the background pattern/image should repeat.",
	"id"        => "ws_bodyrepeat",
	"type"      => "select",
	"std"       => "repeat",
	"options"   => $options_repeat );	
	
$options["ws_bodyattach"] = array( 
	"name"      => "Body Background Attachment Options (@bodyAttach)",
	"desc"      => "Select how the background pattern/image should attach.. meaning should it scroll with the page or stay fixed while everything else scrolls.",
	"id"        => "ws_bodyattach",
	"type"      => "select",
	"std"       => "fixed",
	"options"   => $options_attach );											
	
$options["ws_bodypatternsheer"] = array( 
	"name"      => "Body Background Pattern - SHEER (@bodyPattern)",
	"desc"      => "Select a repeating pattern. The patterns are sheer (semi-transparent) and will work in combination with the body background color you select above. Some are designed to work with dark color backgrounds and some light colored backgrounds.",
	"id"        => "ws_bodypatternsheer",
	"std"       => "patlight-01.png",
	"class"     => "hidden pattern-grid",
	"type"      => "bodypattern",
	"options"   => $options_patterns_sheer );
		
$options["ws_bodypatternopaque"] = array( 
	"name"      => "Body Background Pattern - OPAQUE (@bodyPattern)",
	"desc"      => "Select a repeating pattern. The patterns are opaque (non-transparent) so the body background color is irrelevant. What you see is what you get.",
	"id"        => "ws_bodypatternopaque",
	"std"       => "white_tiles.png",
	"class"     => "hidden pattern-grid",
	"type"      => "bodypattern",
	"options"   => $options_patterns_opaque );		
	
$options["ws_bodyupload"] = array( 
	"name"      =>  "Body Background Image Uploader (@bodyPattern)",
	"desc"      => "Upload an image to use as the body background. A color may also be selected, but will only be relevant if the image is semi-transparent.",
	"id"        => "ws_bodyupload",
	"class"     => "hidden",
	"type"      => "upload" );
	
$options[] = array( 
	"type"      => "closetoggle" );	
	
/*-----------------------------------------------------------------------------------*/	
	
/* HEADER */

$options[] = array( 
	"name"      => "Header",
	"type"      => "heading" );	
	
/*==============================================*/	
	
// HEADER - Display Properties
$options[] = array( 
	"name"      => "Display Properties",
	"desc"      => "Use these options to set the width, shape, shadow, padding, and margin of the website header.",			
	"type"      => "infotoggle" );		
	
$options["ws_headercontainer"] = array( 
	"name"      => "Header Containment (@headerContainer)",
	"desc"      => "Choose whether the header will take up the full width of the browser or be contained to match the content width. By default, the header spans the full width of the browser window.",
	"id"        => "ws_headercontainer",
	"std"       => "span",
	"type"      => "radio",
	"options"   => array( "span" => "Header Spans Full Browser Width", "contain" => "Contain Header to Content Width") );	
	
$options["ws_headerboxshadow"] = array( 
	"name"      => "Header Box Shadow (@headerBoxShadow)",
	"desc"      => "Choose whether the header will display a box shadow around it. By default, there is none. If the header is set to span the full width of the browser window, then the shadow will only appear below it.",
	"id"        => "ws_headerboxshadow",
	"std"       => "none",
	"type"      => "radio",
	"options"   => array( "none" => "No Box Shadow", "shadow" => "Display Box Shadow") );						
	
$options["ws_headerborderradiustop"] = array( 
	"name"      => "Header Border Radius - TOP (@headerBorderRadiusTop)",
	"desc"      => "Set the TOP border radius of the header in pixels. <br>The default is <strong>( 0px )</strong>.",
	"id"        => "ws_headerborderradiustop",
	"std"       => "0px",
	"class"     => "mini",
	"type"      => "text" );		
	
$options["ws_headerborderradiusbtm"] = array( 
	"name"      => "Header Border Radius - BOTTOM (@headerBorderRadiusBtm)",
	"desc"      => "Set the BOTTOM border radius of the header in pixels. <br>The default is <strong>( 0px )</strong>.",
	"id"        => "ws_headerborderradiusbtm",
	"std"       => "0px",
	"class"     => "mini",
	"type"      => "text" );	
	
$options["ws_headerpaddingtop"] = array( 
	"name"      => "Header Padding - TOP (@headerPaddingTop)",
	"desc"      => "By setting this padding, the masthead will be offset from the header at the top by the amount you set. The padding will allow the header background to be visible above the masthead. Input the padding in pixels (i.e. 15px). By default, the padding is 0px.",
	"id"        => "ws_headerpaddingtop",
	"std"       => "0px",
	"class"     => "mini",
	"type"      => "text" );		
	
$options["ws_headerpaddingbtm"] = array( 
	"name"      => "Header Padding - BOTTOM (@headerPaddingBtm)",
	"desc"      => "By setting this padding, the navigation will be offset from the header at the bottom by the amount you set. The padding will allow the header background to be visible below the navbar. Input the padding in pixels (i.e. 15px). By default, the padding is 0px.",
	"id"        => "ws_headerpaddingbtm",
	"std"       => "0px",
	"class"     => "mini",
	"type"      => "text" );	
	
$options["ws_headermargintop"] = array( 
	"name"      => "Header Margin - TOP (@headerMarginTop)",
	"desc"      => "Set a margin for the top of the header. This creates separation between it and the top of the browser.<br>The default is <strong>( 0px )</strong>.",
	"id"        => "ws_headermargintop",
	"std"       => "0px",
	"class"     => "mini",
	"type"      => "text" );	
	
$options[] = array( 
	"type"      => "closetoggle" );	
	
/*--------------------*/				
	
// HEADER - Background Styles
$options[] = array( 
	"name"      => "Background Style",
	"desc"      => "Use these options to set the color and/or pattern/image background of the website header.",			
	"type"      => "infotoggle" );	

$options["ws_headeroption"] = array( 
	"name"      => "Header Background Options (@headerOption)",
	"desc"      => "",
	"id"        => "ws_headeroption",
	"type"      => "select",
	"std"       => "patternsheer",
	"options"   => $options_bkgd_general );	
							
$options["ws_headerbackground"] = array( 
	"name"      => "Header Background Color (@headerBackground)",
	"desc"      => "The color of the header background. The default setting is LIGHT GRAY <strong>( #EDEDED )</strong>.",
	"id"        => "ws_headerbackground",
	"class"     => "hidden",
	"std"       => "#CCCCCC",
	"type"      => "color" );	
	
$options["ws_headerrepeat"] = array( 
	"name"      => "Header Background Repeat Options (@headerRepeat)",
	"desc"      => "Select how the background pattern/image should repeat.",
	"id"        => "ws_headerrepeat",
	"type"      => "select",
	"std"       => "repeat",
	"options"   => $options_repeat );	
	
$options["ws_headerattach"] = array( 
	"name"      => "Header Background Attachment Options (@headerAttach)",
	"desc"      => "Select how the background pattern/image should attach... meaning should it scroll with the page or stay fixed while everything else scrolls?",
	"id"        => "ws_headerattach",
	"type"      => "select",
	"std"       => "fixed",
	"options"   => $options_attach );	
	
$options["ws_headerpatternsheer"] = array( 
	"name"      => "Header Background Pattern - SHEER (@headerPattern)",
	"desc"      => "Select a repeating pattern. The patterns are sheer (semi-transparent) and will work in combination with the header background color you select above. Some are designed to work with dark color backgrounds and some light colored backgrounds.",
	"id"        => "ws_headerpatternsheer",
	"std"       => "patlight-19.png",
	"class"     => "hidden pattern-grid",
	"type"      => "headerpattern",
	"options"   => $options_patterns_sheer );
		
$options["ws_headerpatternopaque"] = array( 
	"name"      => "Header Background Pattern - OPAQUE (@headerPattern)",
	"desc"      => "Select a repeating pattern. The patterns are opaque (non-transparent) so the header background color is irrelevant. What you see is what you get.",
	"id"        => "ws_headerpatternopaque",
	"std"       => "white_tiles.png",
	"class"     => "hidden pattern-grid",
	"type"      => "headerpattern",
	"options"   => $options_patterns_opaque );	
	
$options["ws_headerupload"] = array( 
	"name"      =>  "Header Background Image Uploader (@headerPattern)",
	"desc"      => "Upload an image to use as the header background. A color may also be selected, but will only be relevant if the image is semi-transparent.",
	"id"        => "ws_headerupload",
	"class"     => "hidden",
	"type"      => "upload" );	
	
$options[] = array( 
	"type"      => "closetoggle" );			
	
/*-----------------------------------------------------------------------------------*/	

/* MASTHEAD */		

$options[] = array( 
	"name"      => "Mast", 
	"type"      => "heading" );
	
/*==============================================*/	
	
// MASTHEAD - Display Properties
$options[] = array( 
	"name"      => "Display Properties",
	"desc"      => "Use these options to set the width, shape, shadow, padding, and margin of the website masthead.",
	"type"      => "infotoggle" );	
	
$options["ws_mastheight"] = array( 
	"name"      => "Masthead Height (@mastHeight)",
	"desc"      => "Select the overall height of the Masthead in pixels (i.e. 100px). Keep in mind that this dimension determines the height of the Branding in the website Masthead.",
	"id"        => "ws_mastheight",
	"std"       => "100px",
	"class"     => "mini",
	"type"      => "text" );
	
$options["ws_mastboxshadow"] = array( 
	"name"      => "Masthead Box Shadow (@mastBoxShadow)",
	"desc"      => "Choose whether the masthead will display a box shadow around it. By default, there is none. If the mast is set to span the full width of the browser window, then the shadow will only appear below it.",
	"id"        => "ws_mastboxshadow",
	"std"       => "none",
	"type"      => "radio",
	"options"   => array( "none" => "No Box Shadow", "shadow" => "Display Box Shadow") );
	
$options["ws_mastborderradiustop"] = array( 
	"name"      => "Masthead Border Radius - TOP (@mastBorderRadiusTop)",
	"desc"      => "Set the TOP border radius of the masthead in pixels. <br>The default is <strong>( 0px )</strong>.",
	"id"        => "ws_mastborderradiustop",
	"std"       => "0px",
	"class"     => "mini",
	"type"      => "text" );		
	
$options["ws_mastborderradiusbtm"] = array( 
	"name"      => "Masthead Border Radius - BOTTOM (@mastBorderRadiusBtm)",
	"desc"      => "Set the BOTTOM border radius of the masthead in pixels. <br>The default is <strong>( 0px )</strong>.",
	"id"        => "ws_mastborderradiusbtm",
	"std"       => "0px",
	"class"     => "mini",
	"type"      => "text" );	
	
$options["ws_mastmarginbtm"] = array( 
	"name"      => "Masthead Margin - BOTTOM (@mastMarginBtm)",
	"desc"      => "Set a margin for the bottom of the masthead. This is useful if you create a unique background for the masthead and wish to create separation between it and the navbar. To create space between the masthead and the top of the header, then use the header padding settings.",
	"id"        => "ws_mastmarginbtm",
	"std"       => "0px",
	"class"     => "mini",
	"type"      => "text" );		
	
$options[] = array( 
	"type"      => "closetoggle" );		
	
/*--------------------*/			

// MASTHEAD - Brand Identity + Logo						
$options[] = array( 
	"name"      => "Brand Identity + Logo",
	"desc"      => "Define the website's visual branding. Typically, a brand includes a mark (the iconic portion of a logo) and the brand name as text (the typographic portion of a logo). These settings offer multiple ways to generate the branding in the masthead. The branding in the pinned navbar will automatically get formatted based upon the selection made here.",
	"type"      => "infotoggle" );
							
$options["ws_brand"] = array( 
	"name"      => "Branding Options",
	"desc"      => "Should the website utilize font text to convey the website name or display images to convey the website branding or a combination of both?",
	"id"        => "ws_brand",
	"std"	  => "one",
	"type"      => "select",
	"options"   => $options_array_brand );
						
$options["ws_brand_font_text"] = array( 
	"name"      => "Brand Name",
	"desc"      => "Fill in the website brand name as you wish it to appear in the site's masthead.",
	"id"        => "ws_brand_font_text",
	"std"       => $default_sitename,
	"class"     => "hidden",
	"type"      => "text" );	
	
$options["ws_brand_font_type"] = array( 
	"name"      => "Brand Typography",
	"desc"      => "Select from a list of Google web fonts along with the standard OS system fonts. Adjust the size and color.",
	"id"        => "ws_brand_font_type",
	"std"       => array( "size" => "45px", "face" => '"Helvetica Neue", Helvetica, Arial, sans-serif', "style" => "bold", "color" => "#222222" ),
	"class"     => "hidden",
	"type"      => "typography",
	"options"   => array(
		"faces" => $typography_fonts_all_mix, )
	);											
	
$options["ws_brand_mark"] = array( 
	"name"      => "Upload the brand&#39;s Mark image",
	"desc"      => "Upload an image to use as the brand&#39;s Mark. Ignore if not applicable.",
	"id"        => "ws_brand_mark",
	"class"     => "hidden",
	"type"      => "upload" );
	
$options["ws_brand_logo"] = array( 
	"name"      => "Upload the brand&#39;s Logo image",
	"desc"      => "Upload an image to use as the brand&#39;s Logo. It should be no more than 320px wide. Ignore if not applicable.",
	"id"        => "ws_brand_logo",
	"class"     => "hidden",
	"type"      => "upload" );
	
$options[] = array( 
	"type"      => "closetoggle" );	
	
/*--------------------*/	

// MASTHEAD - Leaderboard						
$options[] = array( 
	"name"      => "Masthead Leaderboard",
	"desc"      => "This defines the rest of the content in the Masthead that goes alongside the branding.",
	"type"      => "infotoggle" );
	
$options["ws_mastleaderboard"] = array( 
	"name"      => "Upload the Leaderboard image",
	"desc"      => "Upload an image to use as the Leaderboard image alongside the branding. It should be no more than 320px wide.",
	"id"        => "ws_mastleaderboard",
	"type"      => "upload" );
	
$options[] = array( 
	"type"      => "closetoggle" );	
	
/*--------------------*/	

// MASTHEAD - Background Styles	
$options[] = array( 
	"name"      => "Background Style",
	"desc"      => "Use these options to set the color and/or pattern/image background of the website masthead.",
	"type"      => "infotoggle" );		

$options["ws_mastoption"] = array( 
	"name"      => "Masthead Background Options (@mastOption)",
	"desc"      => "",
	"id"        => "ws_mastoption",
	"type"      => "select",
	"std"       => "transparent",
	"options"   => $options_bkgd_general );	
							
$options["ws_mastbackground"] = array( 
	"name"      => "Masthead Background Color (@mastBackground)",
	"desc"      => "The color of the mast background. The default setting is LIGHT GRAY <strong>( #EDEDED )</strong>.",
	"id"        => "ws_mastbackground",
	"class"     => "hidden",
	"std"       => "#CCCCCC",
	"type"      => "color" );	
	
$options["ws_mastrepeat"] = array( 
	"name"      => "Masthead Background Repeat Options (@mastRepeat)",
	"desc"      => "Select how the background pattern/image should repeat.",
	"id"        => "ws_mastrepeat",
	"type"      => "select",
	"std"       => "repeat",
	"options"   => $options_repeat );	
	
$options["ws_mastattach"] = array( 
	"name"      => "Masthead Background Attachment Options (@mastAttach)",
	"desc"      => "Select how the background pattern/image should attach... meaning should it scroll with the page or stay fixed while everything else scrolls?",
	"id"        => "ws_mastattach",
	"type"      => "select",
	"std"       => "fixed",
	"options"   => $options_attach );											
	
$options["ws_mastpatternsheer"] = array( 
	"name"      => "Masthead Background Pattern - SHEER (@mastPattern)",
	"desc"      => "Select a repeating pattern. The patterns are sheer (semi-transparent) and will work in combination with the masthead color you select above. Some are designed to work with dark color backgrounds and some light colored backgrounds.",
	"id"        => "ws_mastpatternsheer",
	"std"       => "patlight-19.png",
	"class"     => "hidden pattern-grid",
	"type"      => "mastpattern",
	"options"   => $options_patterns_sheer );
		
$options["ws_mastpatternopaque"] = array( 
	"name"      => "Masthead Background Pattern - OPAQUE (@mastPattern)",
	"desc"      => "Select a repeating pattern. The patterns are opaque (non-transparent) so the masthead background color is irrelevant. What you see is what you get.",
	"id"        => "ws_mastpatternopaque",
	"std"       => "white_tiles.png",
	"class"     => "hidden pattern-grid",
	"type"      => "mastpattern",
	"options"   => $options_patterns_opaque );	
	
$options["ws_mastupload"] = array( 
	"name"      =>  "Masthead Background Image Uploader (@mastPattern)",
	"desc"      => "Upload an image to use as the masthead background. A color may also be selected, but will only be relevant if the image is semi-transparent.",
	"id"        => "ws_mastupload",
	"class"     => "hidden",
	"type"      => "upload" );	
	
$options[] = array( 
	"type"      => "closetoggle" );		
														
/*-----------------------------------------------------------------------------------*/

/* NAVIGATION */		

$options[] = array( 
	"name"      => "Nav",
	"type"      => "heading" );
	
/*==============================================*/			
	
// Navbar	General				
$options[] = array( 
	"name"      => "Top Navigation Bar (Navbar)",
	"desc"      => "Set the general specs for the navbar.",	
	"type"      => "infotoggle" );	
	
$options["ws_navbarcollapsewidth"] = array( 
	"name"      => "Navbar Collapse Width (@navbarCollapseWidth)",
	"desc"      => "Set the width at which the menu collapses into an icon button that toggles open a vertical iteration of the menu. This is relevant for mobile devices. <br>The default is <strong>( 979px )</strong>.",
	"id"        => "ws_navbarcollapsewidth",
	"std"       => "979px",
	"class"     => "mini",
	"type"      => "text" );						
	
$options["ws_navbarheight"] = array( 
	"name"      => "Navbar Height (@navbarHeight)",
	"desc"      => "Set the height of the navbar in pixels. <br>The default is <strong>( 50px )</strong>.",
	"id"        => "ws_navbarheight",
	"std"       => "50px",
	"class"     => "mini",
	"type"      => "text" );
	
$options["ws_navbarposition"] = array( 
	"name"      => "Navbar Position",
	"desc"      => "Should the navigation be positioned at the top or bottom of the header?",
	"id"        => "ws_navbarposition",
	"std"       => "navbar-pos-btm",
	"type"      => "radio",
	"options"   => array( "navbar-pos-btm" => "Bottom Position (Below Branding)", "navbar-pos-top" => "Top Position (Above Branding)" ) );	
	
$options["ws_navbartype"] = array( 
	"name"      => "Navbar Type",
	"desc"      => "Choose the type of Top Navigation Bar to activate.",
	"id"        => "ws_navbartype",
	"std"       => "navbar-std",
	"type"      => "select",
	"options"   => array( "navbar-std" => "Standard Navigation Bar", "navbar-pills" => "Pills Navigation Bar", "navbar-tabs" => "Tabs Navigation Bar" ) );
	
$options["ws_navbarscheme"] = array( 
	"name"      => "Navbar Scheme",
	"desc"      => "Choose the scheme for the Top Navigation Bar.",
	"id"        => "ws_navbarscheme",
	"std"       => "navbar-light",
	"type"      => "select",
	"options"   => array( "navbar-light" => "Navbar Light", "navbar-dark" => "Navbar Dark", "navbar-transparent" => "Navbar Transparent" ) );
	
$options["ws_navbarfixed"] = array( 
	"name"      => "Navbar Pinning",
	"desc"      => "Should the navbar be pinned (fixed) to the top of the browser window upon scrolling?",
	"id"        => "ws_navbarfixed",
	"std"       => "navbar-fixed",
	"type"      => "radio",
	"options"   => array( "navbar-fixed" => "Navbar Pinned (Fixed)", "navbar-static" => "Navbar Scrolls Away (Static)" ) );	
	
$options["ws_navbarborderradiustop"] = array( 
	"name"      => "Navbar Border Radius (TOP) (@navbarBorderRadiusTop)",
	"desc"      => "Set the TOP border radius of the navbar in pixels. <br>The default is <strong>( 0px )</strong>.",
	"id"        => "ws_navbarborderradiustop",
	"std"       => "0px",
	"class"     => "mini",
	"type"      => "text" );		
	
$options["ws_navbarborderradiusbtm"] = array( 
	"name"      => "Navbar Border Radius (BOTTOM) (@navbarBorderRadiusBtm)",
	"desc"      => "Set the BOTTOM border radius of the navbar in pixels. <br>The default is <strong>( 0px )</strong>.",
	"id"        => "ws_navbarborderradiusbtm",
	"std"       => "0px",
	"class"     => "mini",
	"type"      => "text" );	
/*	
$options["ws_navbarsidemargins"] = array( 
	"name"      => "Navbar Side Margins (@navbarSideMargins)",
	"desc"      => "Set the margins for either side of the Navbar in pixels. <br>The default is <strong>( 0px )</strong>. Even if the Navbar is set to take up the full width of the browser, these margins will offset the Navbar from the browser edges. Don't set margins if the Navbar is set to be contained to the content width.",
	"id"        => "ws_navbarsidemargins",
	"std"       => "0px",
	"class"     => "mini",
	"type"      => "text" );
*/

$options["ws_navbarbrand"] = array( 
	"name"      => "Navbar Branding Options",
	"id"        => "ws_navbarbrand",
	"std"       => "masthead-brand",
	"type"      => "select",
	"options"   => $options_array_navbarbrand );
	
$options["ws_navbarbrandlogo"] = array( 
	"name"      => "Upload the brand&#39;s Logo image for the Navbar",
	"desc"      => "This is optional. By default, the brand image in the navbar will be whatever you set for the Masthead. But if you want a unique brand image for the navbar, then make that selection above and upload one here. Ignore if not applicable.",
	"id"        => "ws_navbarbrandlogo",
	"type"      => "upload" );

$options[] = array( 
	"type"      => "closetoggle" );
	
/*--------------------*/							
	
// Navbar	Default LIGHT			
$options[] = array( 
	"name"      => "Navbar Default (LIGHT)",
	"desc"      => "This version of the navbar is the light color scheme. By default it is gray text on a white to light gray gradient bar.",
	//"id"        => "section-ws_navbardefault",
	"type"      => "infotoggle" );																
	
$options["ws_navbartext"] = array( 
	"name"      => "Text Color - DEFAULT (@navbarText)",
	"desc"      => "The default color of text in the navbar. <br>The default setting is gray <strong>( #555555 )</strong>.",
	"id"        => "ws_navbardefaulttext",
	"std"       => "#555555",
	"type"      => "color" );						

$options["ws_navbarlinkcolor"] = array( 
	"name"      => "Link Text Color - INACTIVE (@navbarLinkColor)",
	"desc"      => "The color of links in the navbar. <br>The default setting is gray <strong>( #777777 )</strong>.",
	"id"        => "ws_navbardefaultlinkcolor",
	"std"       => "#777777",
	"type"      => "color" );

$options["ws_navbarlinkcolorhover"] = array( 
	"name"      => "Link Text Color - HOVER (@navbarLinkColorHover)",
	"desc"      => "The color of links in the navbar when you hover the mouse over them. <br>The default setting is dark gray <strong>( #333333 )</strong>.",
	"id"        => "ws_navbardefaultlinkcolorhover",
	"std"       => "#000000",
	"type"      => "color" );	
						
$options["ws_navbarlinkbackgroundhover"] = array( 
	"name"      => "Link Background Color - HOVER (@navbarLinkBackgroundHover)",
	"desc"      => "The background color of hover links in the navbar. <br>The default setting is <strong>( transparent )</strong>.",
	"id"        => "ws_navbardefaultlinkbackgroundhover",
	"std"       => "",
	"type"      => "color" );										

$options["ws_navbarlinkcoloractive"] = array( 
	"name"      => "Link Text Color - ACTIVE (@navbarLinkColorActive)",
	"desc"      => "The color of the text in active links in the navbar. <br>The default setting is gray <strong>( #555555 )</strong>.",
	"id"        => "ws_navbardefaultlinkcoloractive",
	"std"       => "#333333",
	"type"      => "color" );

$options["ws_navbarlinkbackgroundactive"] = array( 
	"name"      => "Link Background Color - ACTIVE (@navbarLinkBackgroundActive)",
	"desc"      => "The background color of active links in the navbar. <br>The default setting is <strong>( to darken the navbar background color by 5% )</strong>. So, leaving this blank will preserve the default.",
	"id"        => "ws_navbardefaultlinkbackgroundactive",
	"std"       => "",
	"type"      => "color" );

$options["ws_navbarbackground"] = array( 
	"name"      => "Navbar Gradient - BASE (@navbarBackground)",
	"desc"      => "If your browser supports it, the navbar is displayed with a gradient effect from top to bottom. This option sets the <em>BOTTOM</em> of the gradient. <br>The default setting is near white <strong>( #DDDDDD )</strong>.",
	"id"        => "ws_navbardefaultbackground",
	"std"       => "#DDDDDD",
	"type"      => "color" );

$options["ws_navbarborder"] = array( 
	"name"      => "Navbar Border (@navbarBorder)",
	"desc"      => "The border color of the navbar. <br>The default setting is light gray <strong>( #D4D4D4 )</strong>.",
	"id"        => "ws_navbardefaultborder",
	"std"       => "#D4D4D4",
	"type"      => "color" );
						
$options["ws_navbarbrandcolor"] = array( 
	"name"      => "Navbar Brand Color (@navbarBrandColor)",
	"desc"      => "For branding purposes, if the website name is displayed as HTML text rather than an image, then it will appear in the navbar in the color specified here. <br>The default setting is gray <strong>( #555555 )</strong>.",
	"id"        => "ws_navbardefaultbrandcolor",
	"std"       => "#555555",
	"type"      => "color" );
	
$options[] = array( 
	"type"      => "closetoggle" );	
	
/*--------------------*/												
				
// Navbar	Inverse DARK		
$options[] = array( 
	"name"      => "Navbar Inverse (DARK)",
	"desc"      => "This version of the navbar is the dark color scheme. By default it is light gray text on a black to dark gray gradient bar.",
	//"id"        => "section-ws_navbarinverse",
	"type"      => "infotoggle" );		
	
$options["ws_navbarinversetext"] = array( 
	"name"      => "Text Color - DEFAULT (@navbarInverseText)",
	"desc"      => "The default color of text in the navbar. <br>The default setting is light gray <strong>( #BBBBBB )</strong>.",
	"id"        => "ws_navbarinversetext",
	"std"       => "#BBBBBB",
	"type"      => "color" );						

$options["ws_navbarinverselinkcolor"] = array( 
	"name"      => "Link Text Color - INACTIVE (@navbarInverseLinkColor)",
	"desc"      => "The color of links in the navbar. <br>The default setting is light gray <strong>( #BBBBBB )</strong>.",
	"id"        => "ws_navbarinverselinkcolor",
	"std"       => "#BBBBBB",
	"type"      => "color" );

$options["ws_navbarinverselinkcolorhover"] = array( 
	"name"      => "Link Text Color - HOVER (@navbarInverseLinkColorHover)",
	"desc"      => "The color of links in the navbar when you hover the mouse over them. <br>The default setting is white <strong>( #FFFFFF )</strong>.",
	"id"        => "ws_navbarinverselinkcolorhover",
	"std"       => "#FFFFFF",
	"type"      => "color" );	
						
$options["ws_navbarinverselinkbackgroundhover"] = array( 
	"name"      => "Link Background Color - HOVER (@navbarInverseLinkBackgroundHover)",
	"desc"      => "The background color of hover links in the navbar. <br>The default setting is <strong>( transparent )</strong>.",
	"id"        => "ws_navbarinverselinkbackgroundhover",
	"std"       => "transparent",
	"type"      => "color" );										

$options["ws_navbarinverselinkcoloractive"] = array( 
	"name"      => "Link Text Color - ACTIVE (@navbarInverseLinkColorActive)",
	"desc"      => "The color of the text in active links in the navbar. <br>The default setting is light gray <strong>( #999999 )</strong>.",
	"id"        => "ws_navbarinverselinkcoloractive",
	"std"       => "#DDDDDD",
	"type"      => "color" );

$options["ws_navbarinverselinkbackgroundactive"] = array( 
	"name"      => "Link Background Color - ACTIVE (@navbarInverseLinkBackgroundActive)",
	"desc"      => "The background color of active links in the navbar. <br>The default setting is near black <strong>( #111111 )</strong>.",
	"id"        => "ws_navbarinverselinkbackgroundactive",
	"std"       => "#111111",
	"type"      => "color" );																
						
$options["ws_navbarinversebackground"] = array( 
	"name"      => "Navbar Gradient - BASE (@navbarInverseBackground)",
	"desc"      => "If your browser supports it, the navbar is displayed with a gradient effect from top to bottom. This option sets the <em>BOTTOM</em> of the gradient for the inverted version of the navbar. <br>The default setting is near black <strong>( #111111 )</strong>.",
	"id"        => "ws_navbarinversebackground",
	"std"       => "#222222",
	"type"      => "color" );
	
$options["ws_navbarinverseborder"] = array( 
	"name"      => "Navbar Border (@navbarInverseBorder)",
	"desc"      => "The border color of the navbar. <br>The default setting is dark gray <strong>( #252525 )</strong>.",
	"id"        => "ws_navbarinverseborder",
	"std"       => "#252525",
	"type"      => "color" );
					
$options["ws_navbarinversebrandcolor"] = array( 
	"name"      => "Navbar Brand Color (@navbarInverseBrandColor)",
	"desc"      => "For branding purposes, if the website name is displayed as HTML text rather than an image, then it will appear in the navbar in the color specified here. <br>The default setting is light gray <strong>( #999999 )</strong>.",
	"id"        => "ws_navbarinversebrandcolor",
	"std"       => "#BBBBBB",
	"type"      => "color" );
	
$options[] = array( 
	"type"      => "closetoggle" );	
	
/*--------------------*/		
	
// Navbar	Dropdown				
$options[] = array( 
	"name"      => "Navbar Caret + Dropdown Menu",
	"desc"      => "Set the general specs for the navbar's drop down menu and its caret symbol indicator.",
	"type"      => "infotoggle" );				
	
$options["ws_navbarcaret"] = array( 
	"name"      => "Navbar Top Menu Caret (@navbarCaret)",
	"desc"      => "Do you want the top level nav items that have a dropdown menu attached to include a downward pointing caret symbol next to the link word?",
	"id"        => "ws_navbarcaret",
	"std"       => "inline-block",
	"type"      => "radio",
	"options"   => array( "inline-block" => "Yes display the top level nav caret", "none" => "No caret") );		
	
$options["ws_navbardropdowncaret"] = array( 
	"name"      => "Navbar Dropdown Menu Caret (@navbarDropdownCaret)",
	"desc"      => "Do you want the navbar drop down menus to include a caret shape pointing up from the menu to the top level nav link?",
	"id"        => "ws_navbardropdowncaret",
	"std"       => "inline-block",
	"type"      => "radio",
	"options"   => array( "inline-block" => "Yes display the drop down menu caret", "none" => "No caret") );	
	
$options["ws_navbardropdownborderradius"] = array( 
	"name"      => "Navbar Dropdown Border Radius (@navbarDropdownBorderRadius)",
	"desc"      => "Set the border radius of the navbar dropdown menu in pixels. <br>The default is <strong>( 6px )</strong> which gives it rounded corners. Changing it to 0px will give it squared off corners.",
	"id"        => "ws_navbardropdownborderradius",
	"std"       => "6px",
	"class"     => "mini",
	"type"      => "text" );		
	
$options["ws_navbardropdownmargintop"] = array( 
	"name"      => "Navbar Dropdown Top Margin (@navbarDropdownMarginTop)",
	"desc"      => "Set the top maring of the navbar dropdown menu in pixels. <br>The default is <strong>( 2px )</strong> which creates a bit of separation between the top level navbar and the dropdown. Changing this to 0px will make the dropdown flush with the bottom of the navbar.",
	"id"        => "ws_navbardropdownmargintop",
	"std"       => "2px",
	"class"     => "mini",
	"type"      => "text" );		
	
$options[] = array( 
	"type"      => "closetoggle" );
	
/*-----------------------------------------------------------------------------------*/	
	
/* CONTENT WRAP */

$options[] = array( 
	"name"      => "Content",
	"type"      => "heading" );
	
/*==============================================*/	

// CONTENT WRAP - Display Properties
$options[] = array( 
	"name"      => "Display Properties",
	"desc"      => "Use these options to set the width, shape, shadow, padding, and margin of the website content area.",
	"type"      => "infotoggle" );	
	
$options["ws_wrapboxshadow"] = array( 
	"name"      => "Content Wrap Box Shadow (@wrapBoxShadow)",
	"desc"      => "Choose whether the content wrap will display a box shadow around it. By default, there is none. The wrap is transparent and blends in with the body background. But if the wrap has a background color and/or pattern, then adding a box shadow may be a good choice.",
	"id"        => "ws_wrapboxshadow",
	"std"       => "none",
	"type"      => "radio",
	"options"   => array( "none" => "No Box Shadow", "shadow" => "Display Box Shadow") );	
	
$options["ws_wrapborderradiustop"] = array( 
	"name"      => "Content Wrap Border Radius - TOP (@wrapBorderRadiusTop)",
	"desc"      => "Set the TOP border radius of the content wrap in pixels. <br>The default is <strong>( 0px )</strong>.",
	"id"        => "ws_wrapborderradiustop",
	"std"       => "0px",
	"class"     => "mini",
	"type"      => "text" );		
	
$options["ws_wrapborderradiusbtm"] = array( 
	"name"      => "Content Wrap Border Radius - BOTTOM (@wrapBorderRadiusBtm)",
	"desc"      => "Set the BOTTOM border radius of the content wrap in pixels. <br>The default is <strong>( 0px )</strong>.",
	"id"        => "ws_wrapborderradiusbtm",
	"std"       => "0px",
	"class"     => "mini",
	"type"      => "text" );		
	
$options["ws_wrapmargintop"] = array( 
	"name"      => "Content Wrap Margin - TOP (@wrapMarginTop)",
	"desc"      => "By setting this margin, the content area will be offset from the header by the amount you set. This is especially relevant if you've set a wrap background, box shadow, and/or border radius. Input the margin in pixels (i.e. 15px). By default, the margin is 0px.",
	"id"        => "ws_wrapmargintop",
	"std"       => "0px",
	"class"     => "mini",
	"type"      => "text" );	
	
$options["ws_wrapmarginbtm"] = array( 
	"name"      => "Content Wrap Margin - BOTTOM (@wrapMarginBtm)",
	"desc"      => "By setting this margin, the content area will be offset from the the footer by the amount you set. This is especially relevant if you've set a wrap background, box shadow, and/or border radius. Input the margin in pixels (i.e. 15px). By default, the margin is 0px.",
	"id"        => "ws_wrapmarginbtm",
	"std"       => "0px",
	"class"     => "mini",
	"type"      => "text" );	
	
$options[] = array( 
	"type"      => "closetoggle" );			
	
/*--------------------*/															
	
// CONTENT WRAP - Background Styles					
$options[] = array( 
	"name"      => "Background Style",
	"desc"      => "Use these options to set the color and/or pattern/image background of the main content area.",			
	"type"      => "infotoggle" );																					
	
$options["ws_wrapoption"] = array( 
	"name"      => "Content Wrap Background Options (@wrapOption)",
	"desc"      => "",
	"id"        => "ws_wrapoption",
	"type"      => "select",
	"std"       => "transparent",
	"options"   => $options_bkgd_general );	
							
$options["ws_wrapbackground"] = array( 
	"name"      => "Content Wrap Background Color (@wrapBackground)",
	"desc"      => "The color of the content wrap background. The default setting is WHITE <strong>( #FFFFFF )</strong>.",
	"id"        => "ws_wrapbackground",
	"class"     => "hidden",
	"std"       => "#FFFFFF",
	"type"      => "color" );	
	
$options["ws_wraprepeat"] = array( 
	"name"      => "Content Wrap Background Repeat Options (@wrapRepeat)",
	"desc"      => "Select how the background pattern/image should repeat.",
	"id"        => "ws_wraprepeat",
	"type"      => "select",
	"std"       => "repeat",
	"options"   => $options_repeat );	
	
$options["ws_wrapattach"] = array( 
	"name"      => "Content Wrap Background Attachment Options (@wrapAttach)",
	"desc"      => "Select how the background pattern/image should attach.. meaning should it scroll with the page or stay fixed while everything else scrolls.",
	"id"        => "ws_wrapattach",
	"type"      => "select",
	"std"       => "scroll",
	"options"   => $options_attach );											
	
$options["ws_wrappatternsheer"] = array( 
	"name"      => "Content Wrap Background Pattern - SHEER (@wrapPattern)",
	"desc"      => "Select a repeating pattern. The patterns are sheer (semi-transparent) and will work in combination with the content wrap background color you select above. Some are designed to work with dark color backgrounds and some light colored backgrounds.",
	"id"        => "ws_wrappatternsheer",
	"std"       => "patlight-19.png",
	"class"     => "hidden pattern-grid",
	"type"      => "wrappattern",
	"options"   => $options_patterns_sheer );
		
$options["ws_wrappatternopaque"] = array( 
	"name"      => "Content Wrap Background Pattern - OPAQUE (@wrapPattern)",
	"desc"      => "Select a repeating pattern. The patterns are opaque (non-transparent) so the content wrap background color is irrelevant. What you see is what you get.",
	"id"        => "ws_wrappatternopaque",
	"std"       => "white_tiles.png",
	"class"     => "hidden pattern-grid",
	"type"      => "wrappattern",
	"options"   => $options_patterns_opaque );	
	
$options["ws_wrapupload"] = array( 
	"name"      => "Content Wrap Background Image Uploader (@wrapPattern)",
	"desc"      => "Upload an image to use as the content wrap background. A color may also be selected, but will only be relevant if the image is semi-transparent.",
	"id"        => "ws_wrapupload",
	"class"     => "hidden",
	"type"      => "upload" );
	
$options[] = array( 
	"type"      => "closetoggle" );	
	
/*-----------------------------------------------------------------------------------*/	

/* SIDEBAR */

$options[] = array( 
	"name"      => "Sidebar",
	"type"      => "heading" );	
	
/*==============================================*/													
	
// SIDEBAR - Background Styles					
$options[] = array( 
	"name"      => "Background Style",
	"desc"      => "Use these options to set the color and/or pattern/image background of the primary sidebar area.",			
	"type"      => "infotoggle" );

$options["ws_sidebaroption"] = array( 
	"name"      => "Sidebar Background Options (@sidebarOption)",
	"desc"      => "",
	"id"        => "ws_sidebaroption",
	"type"      => "select",
	"std"       => "auto",
	"options"   => $options_bkgd_sidebar );	
							
$options["ws_sidebarbackground"] = array( 
	"name"      => "Sidebar Background Color (@sidebarBackground)",
	"desc"      => "The color of the sidebar background. The default setting is LIGHT GRAY <strong>( #EDEDED )</strong>.",
	"id"        => "ws_sidebarbackground",
	"class"     => "hidden",
	"std"       => "#EDEDED",
	"type"      => "color" );	
	
$options["ws_sidebarrepeat"] = array( 
	"name"      => "Sidebar Background Repeat Options (@sidebarRepeat)",
	"desc"      => "Select how the background pattern/image should repeat.",
	"id"        => "ws_sidebarrepeat",
	"type"      => "select",
	"std"       => "repeat",
	"options"   => $options_repeat );	
	
$options["ws_sidebarattach"] = array( 
	"name"      => "Sidebar Background Attachment Options (@sidebarAttach)",
	"desc"      => "Select how the background pattern/image should attach... meaning should it scroll with the page or stay fixed while everything else scrolls?",
	"id"        => "ws_sidebarattach",
	"type"      => "select",
	"std"       => "scroll",
	"options"   => $options_attach );											
	
$options["ws_sidebarpatternsheer"] = array( 
	"name"      => "Sidebar Background Pattern - SHEER (@sidebarPattern)",
	"desc"      => "Select a repeating pattern. The patterns are sheer (semi-transparent) and will work in combination with the sidebar background color you select above. Some are designed to work with dark color backgrounds and some light colored backgrounds.",
	"id"        => "ws_sidebarpatternsheer",
	"std"       => "patlight-19.png",
	"class"     => "hidden pattern-grid",
	"type"      => "sidebarpattern",
	"options"   => $options_patterns_sheer );
		
$options["ws_sidebarpatternopaque"] = array( 
	"name"      => "Sidebar Background Pattern - OPAQUE (@sidebarPattern)",
	"desc"      => "Select a repeating pattern. The patterns are opaque (non-transparent) so the sidebar background color is irrelevant. What you see is what you get.",
	"id"        => "ws_sidebarpatternopaque",
	"std"       => "white_tiles.png",
	"class"     => "hidden pattern-grid",
	"type"      => "sidebarpattern",
	"options"   => $options_patterns_opaque );	
	
$options["ws_sidebarupload"] = array( 
	"name"      =>  "Sidebar Background Image Uploader (@sidebarPattern)",
	"desc"      => "Upload an image to use as the content sidebar background. A color may also be selected, but will only be relevant if the image is semi-transparent.",
	"id"        => "ws_sidebarupload",
	"class"     => "hidden",
	"type"      => "upload" );	
	
$options[] = array( 
	"type"      => "closetoggle" );	

/*-----------------------------------------------------------------------------------*/	
	
/* FOOTER */

$options[] = array( 
	"name"      => "Footer",
	"type"      => "heading" );	
	
/*==============================================*/

// SUPER FOOTER - Display Properties
$options[] = array( 
	"name"      => "Super Footer Display Properties",
	"desc"      => "Use these options to set the width, shape, shadow, padding, and margin of the website Super Footer. The Super Footer contains up to 4 widgetized columns for displaying complementary content.",
	"type"      => "infotoggle" );
/*	
$options["ws_footerheight"] = array( 
	"name"      => "Colophon Height (@footerHeight)",
	"desc"      => "Set the height of the footer in pixels. <br>The default is <strong>( 200px )</strong>.",
	"id"        => "ws_footerheight",
	"std"       => "200px",
	"class"     => "mini",
	"type"      => "text" );				
*/	
$options["ws_footercontainer"] = array( 
	"name"      => "Footer Containment (@footerContainer)",
	"desc"      => "Choose whether the footer will take up the full width of the browser or be contained to match the content width. By default, the footer spans the full width of the browser window.",
	"id"        => "ws_footercontainer",
	"std"       => "span",
	"type"      => "radio",
	"options"   => array( "span" => "Footer Spans Full Browser Width", "contain" => "Contain Footer to Content Width") );
									
$options["ws_footerboxshadow"] = array( 
	"name"      => "Footer Box Shadow (@footerBoxShadow)",
	"desc"      => "Choose whether the footer will display a box shadow around it. By default, there is none because the footer spans the full width of the browser. But if you choose to contain the footer width (and you set a shadow on the content wrap), then adding shadow to the footer is a good choice.",
	"id"        => "ws_footerboxshadow",
	"std"       => "none",
	"type"      => "radio",
	"options"   => array( "none" => "No Box Shadow", "shadow" => "Display Box Shadow") );	
	
$options["ws_footerborderradiustop"] = array( 
	"name"      => "Footer Border Radius - TOP (@footerBorderRadiusTop)",
	"desc"      => "Set the TOP border radius of the footer in pixels. <br>The default is <strong>( 0px )</strong>.",
	"id"        => "ws_footerborderradiustop",
	"std"       => "0px",
	"class"     => "mini",
	"type"      => "text" );		
	
$options["ws_footerborderradiusbtm"] = array( 
	"name"      => "Footer Border Radius - BOTTOM (@footerBorderRadiusBtm)",
	"desc"      => "Set the BOTTOM border radius of the footer in pixels. <br>The default is <strong>( 0px )</strong>.",
	"id"        => "ws_footerborderradiusbtm",
	"std"       => "0px",
	"class"     => "mini",
	"type"      => "text" );	
	
$options["ws_footerpaddingtop"] = array( 
	"name"      => "Footer Padding - TOP (@footerPaddingTop)",
	"desc"      => "Set in pixels the top padding for the footer content. Typicallay, the top padding is greater than the bottom padding. The default is <strong>( 20px )</strong>.",
	"id"        => "ws_footerpaddingtop",
	"std"       => "20px",
	"class"     => "mini",
	"type"      => "text" );		
	
$options["ws_footerpaddingbtm"] = array( 
	"name"      => "Footer Padding - BOTTOM (@footerPaddingBtm)",
	"desc"      => "Set in pixels the bottom padding for the footer content. Typicallay, the bottom padding is less than the top padding. The default is <strong>( 10px )</strong>.",
	"id"        => "ws_footerpaddingbtm",
	"std"       => "10px",
	"class"     => "mini",
	"type"      => "text" );		
	
$options["ws_footermargintop"] = array( 
	"name"      => "Footer Margin - TOP (@footerMarginTop)",
	"desc"      => "Set a margin for the top of the footer. This creates separation between it and the bottom of the main content area.<br>The default is <strong>( 0px )</strong>.",
	"id"        => "ws_footermargintop",
	"std"       => "0px",
	"class"     => "mini",
	"type"      => "text" );		
	
$options["ws_footermarginbtm"] = array( 
	"name"      => "Footer Margin - BOTTOM (@footerMarginBtm)",
	"desc"      => "Set a margin for the bottom of the footer. This creates separation between it and the top of the colophon.<br>The default is <strong>( 0px )</strong>.",
	"id"        => "ws_footermarginbtm",
	"std"       => "0px",
	"class"     => "mini",
	"type"      => "text" );	
	
$options[] = array( 
	"type"      => "closetoggle" );	
	
/*--------------------*/		

// SUPER FOOTER - Typography	
$options[] = array( 
	"name"      => "Super Footer Typography",
	"desc"      => "These typography settings apply to the Super Footer.",
	"type"      => "infotoggle" );		
	
$options["ws_footercolor"] = array( 
	"name"      => "Footer Text Color (@footerColor)",
	"desc"      => "The color of Content Text in the super footer. The default setting is dark gray <strong>( #222222 )</strong>.",
	"id"        => "ws_footercolor",
	"std"       => "#222222",
	"type"      => "color" );		
	
$options["ws_footerlinkcolor"] = array( 
	"name"      => "Footer Link Text Color (@footerLinkColor)",
	"desc"      => "The color of Text Links in the super footer (the &lt;a&gt; element). The default setting is the standard dark blue <strong>( #00064cd )</strong>. <br><br><strong>NOTE:</strong> The Hover Text Color is automatically generated as 15% darker than the Link Text Color.",
	"id"        => "ws_footerlinkcolor",
	"std"       => "#026894",
	"type"      => "color" );	
	
$options["ws_footerheadingscolor"] = array( 
	"name"      => "Footer Headings Color (@footerHeadingsColor)",
	"desc"      => "The color of Headings in the super footer. The default setting is near black <strong>( #111111 )</strong>.",
	"id"        => "ws_footerheadingscolor",
	"std"       => "#111111",
	"type"      => "color" );	
	
$options[] = array( 
	"type"      => "closetoggle" );	
	
/*--------------------*/																	
	
// SUPER FOOTER - Background Style					
$options[] = array( 
	"name"      => "Super Footer Background Style",
	"desc"      => "Use these options to set the color and/or pattern/image background of the Super Footer.",		
	"type"      => "infotoggle" );																		
	
$options["ws_footeroption"] = array( 
	"name"      => "Footer Background Options (@footerOption)",
	"desc"      => "",
	"id"        => "ws_footeroption",
	"type"      => "select",
	"std"       => "color",
	"options"   => $options_bkgd_general );	
							
$options["ws_footerbackground"] = array( 
	"name"      => "Footer Background Color (@footerBackground)",
	"desc"      => "The color of the footer background. The default setting is LIGHT GRAY <strong>( #EDEDED )</strong>.",
	"id"        => "ws_footerbackground",
	"class"     => "hidden",
	"std"       => "#EDEDED",
	"type"      => "color" );	
	
$options["ws_footerrepeat"] = array( 
	"name"      => "Footer Background Repeat Options (@footerRepeat)",
	"desc"      => "Select how the background pattern/image should repeat.",
	"id"        => "ws_footerrepeat",
	"type"      => "select",
	"std"       => "repeat",
	"options"   => $options_repeat );	
	
$options["ws_footerattach"] = array( 
	"name"      => "Footer Background Attachment Options (@footerAttach)",
	"desc"      => "Select how the background pattern/image should attach... meaning should it scroll with the page or stay fixed while everything else scrolls?",
	"id"        => "ws_footerattach",
	"type"      => "select",
	"std"       => "scroll",
	"options"   => $options_attach );											
	
$options["ws_footerpatternsheer"] = array( 
	"name"      => "Footer Background Pattern - SHEER (@footerPattern)",
	"desc"      => "Select a repeating pattern. The patterns are sheer (semi-transparent) and will work in combination with the footer background color you select above. Some are designed to work with dark color backgrounds and some light colored backgrounds.",
	"id"        => "ws_footerpatternsheer",
	"std"       => "patlight-19.png",
	"class"     => "hidden pattern-grid",
	"type"      => "footerpattern",
	"options"   => $options_patterns_sheer );
		
$options["ws_footerpatternopaque"] = array( 
	"name"      => "Footer Background Pattern - OPAQUE (@footerPattern)",
	"desc"      => "Select a repeating pattern. The patterns are opaque (non-transparent) so the footer background color is irrelevant. What you see is what you get.",
	"id"        => "ws_footerpatternopaque",
	"std"       => "white_tiles.png",
	"class"     => "hidden pattern-grid",
	"type"      => "footerpattern",
	"options"   => $options_patterns_opaque );	
	
$options["ws_footerupload"] = array( 
	"name"      =>  "Footer Background Image Uploader (@footerUpload)",
	"desc"      => "Upload an image to use as the footer background. A color may also be selected, but will only be relevant if the image is semi-transparent.",
	"id"        => "ws_footerupload",
	"class"     => "hidden",
	"type"      => "upload" );	
	
$options[] = array( 
	"type"      => "closetoggle" );		

/*--------------------*/	
	
// COLOPHON - Display Properties				
$options[] = array( 
	"name"      => "Colophon Display Properties",
	"desc"      => "Use these options to set display properties for the website Colophon. The Colophon is at the very bottom of the website and contains the copyright, credits, and vital links to required documents like the Privacy Statement.",		
	"type"      => "infotoggle" );
/*	
$options["ws_colophonheight"] = array( 
	"name"      => "Colophon Height (@colophonHeight)",
	"desc"      => "Set the height of the colophon in pixels. <br>The default is <strong>( 30px )</strong>.",
	"id"        => "ws_colophonheight",
	"std"       => "30px",
	"class"     => "mini",
	"type"      => "text" );			
*/	
$options["ws_colophoncontainer"] = array( 
	"name"      => "Colophon Containment (@colophonContainer)",
	"desc"      => "Choose whether the colophon will take up the full width of the browser or be contained to match the content width. By default, the colophon spans the full width of the browser window.",
	"id"        => "ws_colophoncontainer",
	"std"       => "span",
	"type"      => "radio",
	"options"   => array( "span" => "Colophon Spans Full Browser Width", "contain" => "Contain Colophon to Content Width") );	
								
$options["ws_colophonboxshadow"] = array( 
	"name"      => "Colophon Box Shadow (@colophonBoxShadow)",
	"desc"      => "Choose whether the colophon will display a box shadow around it. By default, there is none because the colophon spans the full width of the browser. But if you choose to contain the colophon width (and you set a shadow on the content wrap), then adding shadow to the colophon is a good choice.",
	"id"        => "ws_colophonboxshadow",
	"std"       => "none",
	"type"      => "radio",
	"options"   => array( "none" => "No Box Shadow", "shadow" => "Display Box Shadow") );	
	
$options["ws_colophonborderradiustop"] = array( 
	"name"      => "Colophon Border Radius - TOP (@colophonBorderRadiusTop)",
	"desc"      => "Set the TOP border radius of the colophon in pixels. <br>The default is <strong>( 0px )</strong>.",
	"id"        => "ws_colophonborderradiustop",
	"std"       => "0px",
	"class"     => "mini",
	"type"      => "text" );		
	
$options["ws_colophonborderradiusbtm"] = array( 
	"name"      => "Colophon Border Radius - BOTTOM (@colophonBorderRadiusBtm)",
	"desc"      => "Set the BOTTOM border radius of the colophon in pixels. <br>The default is <strong>( 0px )</strong>.",
	"id"        => "ws_colophonborderradiusbtm",
	"std"       => "0px",
	"class"     => "mini",
	"type"      => "text" );	
	
$options["ws_colophonpaddingtop"] = array( 
	"name"      => "Colophon Padding - TOP (@colophonPaddingTop)",
	"desc"      => "Set in pixels the top padding for the colophon content. Typicallay, the top padding is greater than the bottom padding. The default is <strong>( 20px )</strong>.",
	"id"        => "ws_colophonpaddingtop",
	"std"       => "20px",
	"class"     => "mini",
	"type"      => "text" );		
	
$options["ws_colophonpaddingbtm"] = array( 
	"name"      => "Colophon Padding - BOTTOM (@colophonPaddingBtm)",
	"desc"      => "Set in pixels the bottom padding for the colophon content. Typicallay, the bottom padding is less than the top padding. The default is <strong>( 10px )</strong>.",
	"id"        => "ws_colophonpaddingbtm",
	"std"       => "10px",
	"class"     => "mini",
	"type"      => "text" );	
	
$options["ws_colophonmargintop"] = array( 
	"name"      => "Colophon Margin - TOP (@colophonMarginTop)",
	"desc"      => "Set a margin for the top of the colophon. This creates separation between it and the bottom of the super footer.<br>The default is <strong>( 0px )</strong>.",
	"id"        => "ws_colophonmargintop",
	"std"       => "0px",
	"class"     => "mini",
	"type"      => "text" );		
	
$options["ws_colophonmarginbtm"] = array( 
	"name"      => "Colophon Margin - BOTTOM (@colophonMarginBtm)",
	"desc"      => "Set a margin for the bottom of the colophon. This creates separation between it and the bottom of the browser.<br>The default is <strong>( 0px )</strong>.",
	"id"        => "ws_colophonmarginbtm",
	"std"       => "0px",
	"class"     => "mini",
	"type"      => "text" );	
	
$options[] = array( 
	"type"      => "closetoggle" );		
	
/*--------------------*/		

// COLOPHON - Typography	
$options[] = array( 
	"name"      => "Colophon Typography",
	"desc"      => "These typography settings apply to the Colophon.",
	"type"      => "infotoggle" );		
	
$options["ws_colophoncolor"] = array( 
	"name"      => "Colophon Text Color (@colophonColor)",
	"desc"      => "The color of Content Text in the colophon. The default setting is dark gray <strong>( #222222 )</strong>.",
	"id"        => "ws_colophoncolor",
	"std"       => "#222222",
	"type"      => "color" );		
	
$options["ws_colophonlinkcolor"] = array( 
	"name"      => "Colophon Link Text Color (@colophonLinkColor)",
	"desc"      => "The color of Text Links in the colophon (the &lt;a&gt; element). The default setting is the standard dark blue <strong>( #00064cd )</strong>. <br><br><strong>NOTE:</strong> The Hover Text Color is automatically generated as 15% darker than the Link Text Color.",
	"id"        => "ws_colophonlinkcolor",
	"std"       => "#026894",
	"type"      => "color" );
	
$options[] = array( 
	"type"      => "closetoggle" );		
	
/*--------------------*/																	
	
// COLOPHON - Background Style					
$options[] = array( 
	"name"      => "Colophon Background Style",
	"desc"      => "Use these options to set the color and/or pattern/image background of the Colophon.",		
	"id"        => "ws_colophoninfo",
	"type"      => "infotoggle" );		
	
$options["ws_colophonoption"] = array( 
	"name"      => "Colophon Background Options (@colophonOption)",
	"desc"      => "",
	"id"        => "ws_colophonoption",
	"type"      => "select",
	"std"       => "auto",
	"options"   => $options_bkgd_colophon );
	
$options[] = array( 
	"name"      => "NOTE",
	"desc"      => "You selected the <i>auto generate</i> setting for the colophon background. In most cases, there is nothing else for you to select. But when the footer background option is an opaque pattern or opaque upload image, it is necessary to set a background color and opacity for the colophon. If you don't, the defaults will be used.",		
	"id"        => "ws_colophonnote",
	"class"     => "hidden",
	"type"      => "note" );		
	
$options["ws_colophonbackground"] = array( 
	"name"      => "Colophon Background Color (@colophonBackground)",
	"desc"      => "The color of the colophon background. The default setting is LIGHT GRAY <strong>( #CCCCCC )</strong>.",
	"id"        => "ws_colophonbackground",
	"class"     => "hidden",
	"std"       => "#CCCCCC",
	"type"      => "color" );
	
$options["ws_colophonrepeat"] = array( 
	"name"      => "Colophon Background Repeat Options (@colophonRepeat)",
	"desc"      => "Select how the background pattern/image should repeat.",
	"id"        => "ws_colophonrepeat",
	"class"     => "hidden",
	"type"      => "select",
	"std"       => "repeat",
	"options"   => $options_repeat );	
	
$options["ws_colophonattach"] = array( 
	"name"      => "Colophon Background Attachment Options (@colophonAttach)",
	"desc"      => "Select how the background pattern/image should attach... meaning should it scroll with the page or stay fixed while everything else scrolls?",
	"id"        => "ws_colophonattach",
	"class"     => "hidden",
	"type"      => "select",
	"std"       => "scroll",
	"options"   => $options_attach );			
	
$options["ws_colophonbackgroundopacity"] = array( 
	"name"      => "Colophon Background Color Opacity (@colophonBackgroundOpacity)",
	"desc"      => "Select the opacity of the background color. This is especially relevant in cases where you want the footer background to show through. The default setting is 100% <strong>( 1 )</strong>. For reference, a value of 0 is transparent, a value of .25 is 25%, a value of .75 is 75%, and a value of 1 is 100%. You can input any value you wish within that range using the convention of a decimal point followed by the percentage.",
	"id"        => "ws_colophonbackgroundopacity",
	"std"       => "1", 
	"class"	  => "mini",
	"type"      => "text");										
	
$options["ws_colophonpatternsheer"] = array( 
	"name"      => "Colophon Background Pattern - SHEER (@colophonPattern)",
	"desc"      => "Select a repeating pattern. The patterns are sheer (semi-transparent) and will work in combination with the colophon background color you select above. Some are designed to work with dark color backgrounds and some light colored backgrounds.",
	"id"        => "ws_colophonpatternsheer",
	"std"       => "patlight-19.png",
	"class"     => "hidden pattern-grid",
	"type"      => "colophonpattern",
	"options"   => $options_patterns_sheer );
		
$options["ws_colophonpatternopaque"] = array( 
	"name"      => "Colophon Background Pattern - OPAQUE (@colophonPattern)",
	"desc"      => "Select a repeating pattern. The patterns are opaque (non-transparent) so the colophon background color is irrelevant. What you see is what you get.",
	"id"        => "ws_colophonpatternopaque",
	"std"       => "white_tiles.png",
	"class"     => "hidden pattern-grid",
	"type"      => "colophonpattern",
	"options"   => $options_patterns_opaque );	
	
$options["ws_colophonupload"] = array( 
	"name"      =>  "Colophon Background Image Uploader (@colophonPattern)",
	"desc"      => "Upload an image to use as the content colophon background. A color may also be selected, but will only be relevant if the image is semi-transparent.",
	"id"        => "ws_colophonupload",
	"class"     => "hidden",
	"type"      => "upload" );
	
$options[] = array( 
	"type"      => "closetoggle" );	

/*-----------------------------------------------------------------------------------*/						
				
/* META */		

$options[] = array( 
	"name"      => "Meta",
	"type"      => "heading" );	
	
/*==============================================*/					

// Post Meta
$options[] = array( 
	"name"      => "Post Meta",
	"desc"      => "Post meta information (publish date, author, categories, tags, and links to comments) is displayed on each post to provide your readers with information. Use the options below to control what is displayed.",
	"type"      => "infotoggle" );

$options[] = array( 
	"name"      => "Show publish date?",
	"desc"      => "Displays the date the article was posted. Default is show. Uncheck this box to hide post publish date.",
	"id"        => "ws_postmeta_date",
	"std"       => 1,
	"type"      => "checkbox" );
	
$options[] = array( 
	"name"      => "Show post author?",
	"desc"      => "Displays the author of a post. Default is show. Uncheck this box to hide post author.",
	"id"        => "ws_postmeta_author",
	"std"       => 1,
	"type"      => "checkbox" );						

$options[] = array( 
	"name"      => "Show post categories?",
	"desc"      => "Displays the categories in which a post was published. Default is show. Uncheck this box to hide post categories.",
	"id"        => "ws_postmeta_categories",
	"std"       => 1,
	"type"      => "checkbox" );

$options[] = array( 
	"name"      => "Show post categories on the index/posts page?",
	"desc"      => "Displays the post categories on the index/posts page - as defined in Settings > Reading. Default is show. Uncheck this box to hide post categories on the index/posts page.",
	"id"        => "ws_postmeta_categories_index",
	"std"       => 1,
	"type"      => "checkbox" );

$options[] = array( 
	"name"      => "Show post tags?",
	"desc"      => "Displays the tags attached to a post. Default is show. Uncheck this box to hide post tags.",
	"id"        => "ws_postmeta_tags",
	"std"       => 1,
	"type"      => "checkbox" );

$options[] = array( 
	"name"      => "Show post tags on the index/posts page?",
	"desc"      => "Displays the post tags on the index/posts page - as defined in Settings > Reading. Default is show. Uncheck this box to hide post tags on the index/posts page.",
	"id"        => "ws_postmeta_tags_index",
	"std"       => 1,
	"type"      => "checkbox" );

$options[] = array( 
	"name"      => "Show link for # of comments / leave a comment?",
	"desc"      => "Displays the number of comments and/or a Leave a comment message on posts. Default is show. Uncheck this box to hide.",
	"id"        => "ws_postmeta_comments_link",
	"std"       => 1,
	"type"      => "checkbox" );	
	
$options[] = array( 
	"type"      => "closetoggle" );	
	
/*-----------------------------------------------------------------------------------*/					

/* TOOLS */

$options[] = array( 
	"name"      => "Tools",
	"type"      => "heading" );
	
/*==============================================*/	
	
$options[] = array( 
	"name"      => "Analytics",
	"desc"      => "Track your site traffic.",
	"type"      => "infotoggle" );

$options[] = array( 
	"name"      => "Enable analytics?",
	"desc"      => "If you use an analytics product such as Google Analytics or Piwik, you can add your tracking code below. If you use a separate plugin for analytics, you can ignore this section. Default setting is disabled.",
	"id"        => "ws_analytics",
	"std"       => 0,
	"type"      => "checkbox" );

$options[] = array( 
	"name"      => "Analytics code",
	"desc"      => "Enter your analytics tracking code here (WITH the &lt;script&gt; and &lt;/script&gt; tags). Note: Any text you include here will be included in your pages, EVEN IF IT IS INCORRECT. Double check your code! If the analytics option is not enabled above, this text will be ignored.",
	"id"        => "ws_analytics_code",
	"type"      => "textarea" );
	
$options[] = array( 
	"type"      => "closetoggle" );	
	
/*-----------------------------------------------------------------------------------*/

/* ADVANCED */

$options[] = array( 
	"name"      => "Extras",
	"type"      => "heading" );
	
/*==============================================*/	

// WordPress					
$options[] = array( 
	"name"      => "WordPress Options",
	"desc"      => "Adjust the default WordPress settings.",						
	"type"      => "infotoggle" );							
	
$options[] = array( 
	"name"      => "Hide admin bar for all users?",
	"desc"      => "Enable this option to hide the WordPress admin bar on the front end for all users (including admins). Default setting is disabled.",
	"id"        => "ws_wp_disable_admin_bar",
	"std"       => 0,
	"type"      => "checkbox" );	
	
$options[] = array( 
	"type"      => "closetoggle" );
	
/*--------------------*/												

// Login Screen					
$options[] = array( 
	"name"      => "Login Screen",
	"desc"      => "Customize the website's login screen.",
	"type"      => "infotoggle" );

$options[] = array( 
	"name"      => "Enable custom image on login page?",
	"desc"      => "Enable this option and upload an image below to display a custom image on the login/register page. This replaces the default WordPress image. Default is disabled.",
	"id"        => "ws_custom_login_image",
	"std"       => 0,
	"type"      => "checkbox" );

$options[] = array( 
	"name"      => "Upload a custom image for the login page",
	"desc"      => "Upload an image to use as a custom image on the login/register page. FOR BEST RESULTS: upload an image that is 274 x 63 pixels.",
	"id"        => "ws_custom_login_image_file",
	"type"      => "upload" );	
	
$options[] = array( 
	"type"      => "closetoggle" );	
	
/*--------------------*/							

// Outgoing Email
$options[] = array( 
	"name"      => "Customize outgoing emails",
	"desc"      => "This section allows you to override the default WordPress settings for outgoing email sender information. Instead of an email coming from \"WordPress\", you can make it say anything you want. You can do the same with the sender email address, and the return address that is used if any problems occur during delivery. \r\n &nbsp;\r\nThe default setting is enabled, and it uses your site name as the From Name and your Site Admin email address as the From address and Return Path. You can change these defaults below. If you disable this feature your site will send emails using the WordPress defaults.",
	"type"      => "infotoggle" );

$options[] = array( 
	"name"      => "Enable custom sender features?",
	"desc"      => "Turn on the custom sender features. Unless you specify custom values below, this tells the Theme to send emails that use your site name in the From field and your site admin email as the sender and return addresses. To set your own custom information, select the box below and type in your own values. Default setting is enabled.",
	"id"        => "ws_phpmailer_rewrite",
	"std"       => 1,
	"type"      => "checkbox" );

$options[] = array( 
	"name"      => "Enable customized sender information?",
	"desc"      => "This allows you to customize the sender information of emails coming from your site. You must turn on \"Enable custom sender features\" above for this to work. NOTE: If you enable this option, fill in ALL fields below - otherwise your email may not work properly. Default setting is disabled.",
	"id"        => "ws_phpmailer_rewrite_custom",
	"std"       => 0,
	"type"      => "checkbox" );

$options[] = array( 
	"name"      => "From Name",
	"desc"      => "Enter the name you want to use in the From: field.",
	"id"        => "ws_phpmailer_rewrite_custom_from_name",
	"std"       => "",
	"type"      => "text" );

$options[] = array( 
	"name"      => "From Email Address",
	"desc"      => "Enter the Sender email address you want to use in the From: field.",
	"id"        => "ws_phpmailer_rewrite_custom_from_email",
	"std"       => "",
	"type"      => "text" );

$options[] = array( 
	"name"      => "Return Email Address",
	"desc"      => "Enter the return email address you want to use in case a problem happens during delivery.",
	"id"        => "ws_phpmailer_rewrite_custom_sender",
	"std"       => "",
	"type"      => "text" );	

$options[] = array( 
	"type"      => "closetoggle" );
															
return $options;

}

/* 
 * This function adds the html that will appear in the sidebar module of the
 * options panel.  Feel free to alter this how you see fit.
 */

add_action( 'optionsframework_after','optionscheck_display_sidebar' );

function optionscheck_display_sidebar() { ?>
	<div id="optionsframework-sidebar">
		<div class="metabox-holder">
			<div class="postbox">
				<h3>WordStrap Theme Options</h3>
					<div class="inside">
						<p>To learn more about the WordStrap theme framework, go to <a href="http://wordstrap.com">http://wordstrap.com.</a></p>
					</div>
			</div>
		</div>
	</div>
<?php }

/* Include the WordPress Front End Theme Customizer options. */
include_once dirname( __FILE__ ) . "/options-theme-customizer.php";

/* Include the custom jQuery files that show/hide items in the options panel. */
include_once dirname( __FILE__ ) . "/js/options-js-body.php";
include_once dirname( __FILE__ ) . "/js/options-js-header.php";
include_once dirname( __FILE__ ) . "/js/options-js-masthead.php";
include_once dirname( __FILE__ ) . "/js/options-js-brand.php";
include_once dirname( __FILE__ ) . "/js/options-js-nav.php";
include_once dirname( __FILE__ ) . "/js/options-js-wrap.php";
include_once dirname( __FILE__ ) . "/js/options-js-sidebar.php";
include_once dirname( __FILE__ ) . "/js/options-js-footer.php";
include_once dirname( __FILE__ ) . "/js/options-js-colophon.php";

/* Alter the position of the Theme Options admin menu link.
https://github.com/devinsays/options-framework-theme/issues/54 */
add_action( 'init', 'remove_optionsframework_add_page', 11 );
	function remove_optionsframework_add_page() {
		remove_action( 'admin_menu', 'optionsframework_add_page', 10 );
	}
add_action( 'admin_menu', 'optionsframework_add_page', 1 );