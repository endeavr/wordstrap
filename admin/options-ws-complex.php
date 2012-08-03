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

	// Test data
	$test_array = array(
		'one' => __('One', 'options_framework_theme'),
		'two' => __('Two', 'options_framework_theme'),
		'three' => __('Three', 'options_framework_theme'),
		'four' => __('Four', 'options_framework_theme'),
		'five' => __('Five', 'options_framework_theme')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_framework_theme'),
		'two' => __('Pancake', 'options_framework_theme'),
		'three' => __('Omelette', 'options_framework_theme'),
		'four' => __('Crepe', 'options_framework_theme'),
		'five' => __('Waffle', 'options_framework_theme')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

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

/* INFO */		

	$options[] = array( "name" => "Info",
						"type" => "heading");
						
	$options[] = array( "name" => "Welcome to the Theme Options Control Panel",
					"desc" => "Using the settings provided, you may significantly alter the website's design, enable and disable features, and control what content is displayed and where.",
					"type" => "info");	
										
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
						"id" => "alienship_postmeta_date",
						"std" => 1,
						"type" => "checkbox");
						
	$options[] = array( "name" => "Show post author?",
						"desc" => "Displays the author of a post. Default is show. Uncheck this box to hide post author.",
						"id" => "alienship_postmeta_author",
						"std" => 1,
						"type" => "checkbox");						

	$options[] = array( "name" => "Show post categories?",
						"desc" => "Displays the categories in which a post was published. Default is show. Uncheck this box to hide post categories.",
						"id" => "alienship_postmeta_categories",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Show post categories on the index/posts page?",
						"desc" => "Displays the post categories on the index/posts page - as defined in Settings > Reading. Default is show. Uncheck this box to hide post categories on the index/posts page.",
						"id" => "alienship_postmeta_categories_index",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Show post tags?",
						"desc" => "Displays the tags attached to a post. Default is show. Uncheck this box to hide post tags.",
						"id" => "alienship_postmeta_tags",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Show post tags on the index/posts page?",
						"desc" => "Displays the post tags on the index/posts page - as defined in Settings > Reading. Default is show. Uncheck this box to hide post tags on the index/posts page.",
						"id" => "alienship_postmeta_tags_index",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Show link for # of comments / leave a comment?",
						"desc" => "Displays the number of comments and/or a Leave a comment message on posts. Default is show. Uncheck this box to hide.",
						"id" => "alienship_postmeta_comments_link",
						"std" => 1,
						"type" => "checkbox");

	// Featured Posts						
	$options[] = array( "name" => "Featured Posts",
						"desc" => "This feature displays certain posts in a photo slider at the top of your post index. This is a good way to make special content stand out. You can feature any post here, according to the criteria you choose below. Don't forget to assign featured images to your posts in the post editor!",						
						"type" => "info");
							
	$options[] = array( "name" => "Enable featured posts?",
						"desc" => "Check this box to turn on featured posts functionality. Set the options below to determine how your featured posts will work. Default is disabled.",
						"id" => "alienship_featured_posts",
						"std" => 0,
						"type" => "checkbox");

	$options[] = array( "name" => "Featured Posts Tag",
						"desc" => "The tag you select here determines which posts show in the featured posts slider. Example: if you were to select the moo tag, posts tagged with moo would be displayed in your slider. Don't forget to attach your featured images in the post editor!",
						"id" => "alienship_featured_posts_tag",
						"std" => "feature",
						"type" => "select",
						"class" => "mini",
						"class" => "hidden",
						"options" => $options_tags);


	$options[] = array( "name" => "Maximum # of Featured Posts to display",
						"desc" => "Select the maximum number of posts you want to display in the featured posts slider. The default is three.",
						"id" => "alienship_featured_posts_maxnum",
						"std" => "3",
						"type" => "radio",
						"class" => "hidden",
						"options" => array("1" => "One","2" => "Two","3" => "Three","4" => "Four","5" => "Five"));

	$options[] = array( "name" => "Duplicate featured posts",
						"desc" => "Show posts from the featured content section in the rest of the body. Default is Hide.",
						"id" => "alienship_featured_posts_show_dupes",
						"std" => 0,
						"type" => "radio",
						"class" => "hidden",
						"options" => array("1" => "Show duplicate posts","0" => "Hide duplicate posts"));

	$options[] = array( "name" => "Featured post image width",
						"desc" => "Enter the width (in pixels) you want the featured images to be. Default is 745 pixels.",
						"id" => "alienship_featured_posts_image_width",
						"std" => "745",
						"class" => "mini",
						"class" => "hidden",
						"type" => "text");

	$options[] = array( "name" => "Featured post image height",
						"desc" => "Enter the height (in pixels) you want the featured images to be. Default is 350 pixels.",
						"id" => "alienship_featured_posts_image_height",
						"std" => "350",
						"class" => "mini",
						"class" => "hidden",
						"type" => "text");	
						
	// Footer
	$options[] = array( "name" => "Footer",
						"desc" => "",
						"type" => "info");

	$options[] = array( "name" => "Enable custom footer text?",
						"desc" => "Default is disabled. Check this box to use custom footer text. Fill in your text below.",
						"id" => "alienship_footer",
						"std" => 0,
						"type" => "checkbox");

	$options[] = array( "name" => "Custom footer text",
						"desc" => "Enter the text here that you would like displayed at the bottom of your site. This setting will be ignored if you do not enable \"Show custom footer text\" above.",
						"id" => "alienship_footer_text",
						"std" => "",
						"class" => "hidden",
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
						"id" => "alienship_navbar_show",
						"std" => 1,
						"type" => "checkbox");	
						
						// Navbar Brand
						$options_array_navbar_brand = array(
							"one" => "Website name as font text",
							"two" => "Website brand as image");
						
	$options[] = array( "name" => "Brand Image or Font Text?",
						"desc" => "Should the navbar utilize simple font text to convey the website name or display images to convey the website branding?",
						"id" => "alienship_navbar_brand",

						"type" => "select",
						"options" => $options_array_navbar_brand);
						
	$options[] = array( "name" => "Website brand name",
						"desc" => "Fill in the website brand name as you wish it to appear in the navbar.",
						"id" => "alienship_navbar_brand_font_text",
						"class" => "hidden",
						"type" => "text");						
						
	$options[] = array( "name" => "Upload the brand&#39;s Logo Mark image",
						"desc" => "Upload an image to use as the brand&#39;s Logo Mark in the top navigation bar.",
						"id" => "alienship_navbar_brand_logo_mark",
						"class" => "hidden",
						"type" => "upload");
						
	$options[] = array( "name" => "Upload the brand&#39;s Logo Text image",
						"desc" => "Upload an image to use as the brand&#39;s Logo Text in the top navigation bar.",
						"id" => "alienship_navbar_brand_logo_text",
						"class" => "hidden",
						"type" => "upload");						

	$options[] = array( "name" => "Show search in navbar?",
						"desc" => "Default is enabled. Uncheck this box to turn it off.",
						"id" => "alienship_navbar_search",
						"std" => 1,
						"type" => "checkbox");
						
	$options[] = array( "name" => "Include auxiliary items in navbar?",
						"desc" => "Default is enabled. Uncheck this box to turn it off.",
						"id" => "alienship_navbar_aux",
						"std" => 1,
						"type" => "checkbox");						
						
	// Breadcrumbs
	$options[] = array( "name" => "Breadcrumbs",
						"desc" => "",						
						"type" => "info");							

	$options[] = array( "name" => "Show Breadcrumb Navigation?",
						"desc" => "Default is show. Uncheck this box to hide breadcrumbs.",
						"id" => "alienship_breadcrumbs",
						"std" => 1,
						"type" => "checkbox");
						
	// Content Navigation
	$options[] = array( "name" => "Content Navigation",	
						"desc" => "",				
						"type" => "info");								

	$options[] = array( "name" => "Show content navigation above posts?",
						"desc" => "Displays links to next and previous posts above the current post and above the posts on the index page. Default is hide. Check this box to show content nav above posts.",
						"id" => "alienship_content_nav_above",
						"std" => 0,
						"type" => "checkbox");

	$options[] = array( "name" => "Show content navigation below posts?",
						"desc" => "Displays links to next and previous posts below the current post and below the posts on the index page. Default is show. Uncheck this box to hide content nav above posts.",
						"id" => "alienship_content_nav_below",
						"std" => 1,
						"type" => "checkbox");
						
/*-----------------------------------------------------------------------------------*/						
						
/* STYLES */

	$options[] = array( "name" => "Styles",
						"type" => "heading");
					
	// General Styles					
	$options[] = array( "name" => "General Styles",
						"desc" => "Set some basic universal styles.<br> <em>NOTE:</em> There is no need to make a custom selection for each item.<br> If no selection is made, the default setting will be used.",
						"class" => "hidden",										
						"type" => "info");	
						
						// Body Background
						$options_array_body_bg = array(
							'color' => '',
							'image' => '',
							'repeat' => 'repeat',
							'position' => 'top center',
							'attachment'=>'scroll' );						
						
	$options[] = array(
						'name' =>  __('Website Background Color/Image', 'options_framework_theme'),
						'desc' => __('Change the background style.', 'options_framework_theme'),
						'id' => 'alienship_style_body_bg',
						'std' => $options_array_body_bg,
						'type' => 'background' );							
						
	$options[] = array( "name" => "Content text color",
						"desc" => "The color of standard content text. The default setting is dark gray #333333.",
						"id" => "alienship_style_text",
						"std" => "#333333",
						"type" => "color");																	
	$options[] = array( "name" => "Link text color",
						"desc" => "The color of links (the &lt;a&gt; element). The default setting is blue #0088CC.",
						"id" => "alienship_style_link",
						"std" => "#0088CC",
						"type" => "color");
						
	$options[] = array( "name" => "Horizontal rule color",
						"desc" => "The color of horizontal rules (the &lt;hr&gt; element). The default setting is light gray #EEEEEE.",
						"id" => "alienship_style_hr",
						"std" => "#EEEEEE",
						"type" => "color");													
	
	// Meta Icons					
	$options[] = array( "name" => "Meta Icons",
						"desc" => "Select the icon set that best matches this website's style.",
						"type" => "info");
						
						$options_array_select_icons = array(
						"black" => "BLACK icon set",
						"white" => "WHITE icon set",
						"custom" => "Upload a CUSTOM icon set");
						
	$options[] = array( "name" => "Icon Set Options",
						"desc" => "Choose between either the black or white icon sets or upload a custom set.",
						"id" => "alienship_style_icons",
						"std" => "black",
						"type" => "select",
						"options" => $options_array_select_icons);		
																
	$options[] = array( "name" => "Custom Icon Set",
						"desc" => "Upload a sprite image to replace the default icon set.",
						"id" => "alienship_icons_custom",
						"type" => "upload");						
	
	// Navbar					
	$options[] = array( "name" => "Top Navigation Bar",
						"desc" => "Choose the top navigation menu scheme.",							
						"type" => "info");	
						
	$options[] = array( "name" => "Default text color",
						"desc" => "The height of the navbar in pixels (i.e. 60px).",
						"id" => "alienship_style_navbar_height",
						"std" => "60px",
						"type" => "text");											
						
	$options[] = array( "name" => "Default text color",
						"desc" => "The default color of text in the navbar. The default setting #999999.",
						"id" => "alienship_style_navbar_text",
						"std" => "#999999",
						"type" => "color");						

	$options[] = array( "name" => "Link text color",
						"desc" => "The color of links in the navbar. The default setting #999999.",
						"id" => "alienship_style_navbar_link",
						"std" => "#999999",
						"type" => "color");

	$options[] = array( "name" => "Hover link text color",
						"desc" => "The color of links in the navbar when you hover the mouse over them. The default setting #FFFFFF.",
						"id" => "alienship_style_navbar_link_hover",
						"std" => "#FFFFFF",
						"type" => "color");					

	$options[] = array( "name" => "Active link text color",
						"desc" => "The color of the text in active links in the navbar. The default setting #FFFFFF.",
						"id" => "alienship_style_navbar_link_active",
						"std" => "#FFFFFF",
						"type" => "color");

	$options[] = array( "name" => "Active link background color",
						"desc" => "The background color of active links in the navbar. The default setting #222222.",
						"id" => "alienship_style_navbar_link_active_bg",
						"std" => "#222222",
						"type" => "color");

	$options[] = array( "name" => "Navbar background gradient - base color",
						"desc" => "If your browser supports it, the Top Menu navbar is displayed with a gradient effect from top to bottom. This option sets the bottom of the gradient. The default setting #222222.",
						"id" => "alienship_style_navbar_bg1",
						"std" => "#222222",
						"type" => "color");

	$options[] = array( "name" => "Navbar background gradient - highlight color",
						"desc" => "If your browser supports it, the Top Menu navbar is displayed with a gradient effect from top to bottom. This option sets the top of the gradient. The default setting is #333333.",
						"id" => "alienship_style_navbar_bg2",
						"std" => "#333333",
						"type" => "color");

	$options[] = array( "name" => "Navbar search box background color",
						"desc" => "The color of the search box in the top navbar. The default setting #626262.",
						"id" => "alienship_style_navbar_search_bg",
						"std" => "#626262",
						"type" => "color");

	$options[] = array( "name" => "Navbar search box background color when focused",
						"desc" => "The color of the search box when it's in focus. The default setting #FFFFFF.",
						"id" => "alienship_style_navbar_search_bg_focused",
						"std" => "#FFFFFF",
						"type" => "color");					

	$options[] = array( "name" => "Navbar search box placeholder text color",
						"desc" => "The color of the default placeholder text in the search bar. The default setting #CCCCCC.",
						"id" => "alienship_style_navbar_search_placeholder",
						"std" => "#CCCCCC",
						"type" => "color");
						
/*-----------------------------------------------------------------------------------*/

/* FONTS */

	$options[] = array( "name" => "Fonts",
						"type" => "heading");					

	$options[] = array( "name" => "Custom Fonts",
						"desc" => "Choose the fonts you want to use on your site.<br> <em>NOTE:</em> There is no need to make a custom selection for each item.<br> If no selection is made, the default setting will be used.",					
						"type" => "info");
						
						// Array Fonts Source
						$options_array_fonts_source = array(
							'standard' => 'Standard Font Stacks',
							'google' => 'Google Web Fonts');				
						
	$options[] = array( 'name' => "Source of Fonts",
						'desc' => "Do you want to specify standard font stacks or do you wish to load custom fonts from Google?",
						'id' => 'alienship_fonts_source',
						'std' => 'standard',
						'type' => 'radio',
						'options' => $options_array_fonts_source);
						
	$options[] = array( "name" => "Standard Font Stacks",
						"desc" => "",	
						"fold" => "alienship_fonts",						
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
						'id' => 'alienship_fonts_standard_sans',
						'std' => '',
						'type' => 'select',
						'options' => $options_array_fonts_standard_sans);					
										
						
	$options[] = array( "name" => "Google Web Fonts",
						"desc" => "",				
						"type" => "info");

/*-----------------------------------------------------------------------------------*/

/* JAVASCRIPT */

	$options[] = array( "name" => "jQuery",
						"type" => "heading");

	$options[] = array( "name" => "Javascript Plugins Information",
						"desc" => "Read the description provided with each plugin. Some of these plugins require another plugin to function properly (Example: Carousel requires Transitions for the animation to work).<br> Disable any plugins that you aren't using.",						
						"type" => "info");					

	$options[] = array( "name" => "Transitions",
						"desc" => "Transitions are used to animate things such as the carousel, modals, fade out alerts, etc. * Required for animation in plugins.",
						"id" => "alienship_js_transitions",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => "Alerts",
						"desc" => "The alert plugin is a tiny class for adding close functionality to alerts. * Requires Transitions if you want them to fade out on close.",
						"id" => "alienship_js_alerts",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Modals",
						"desc" => "Message boxes that slide down and fade in from the top of the page. Default setting is disabled. * Requires Transitions to function properly.",
						"id" => "alienship_js_modals",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Dropdown Menus",
						"desc" => "Add dropdown menus in the navbar, tabs, and pills.",
						"id" => "alienship_js_dropdowns",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Scrollspy",
						"desc" => "Use scrollspy to automatically update the links in your navbar to show the current active link based on scroll position. Default setting is disabled.",
						"id" => "alienship_js_scrollspy",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Tabs",
						"desc" => "Make tabs and pills more useful by allowing them to toggle through tabbable panes of content.",
						"id" => "alienship_js_tabs",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Tooltips",
						"desc" => "Tooltips that use CSS3 for animations and data-attributes for local title storage.",
						"id" => "alienship_js_tooltips",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Popovers",
						"desc" => "Add small overlays of content, like those on the iPad, to any element for housing secondary information. * Requires Tooltips.",
						"id" => "alienship_js_popovers",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Buttons",
						"desc" => "Do more with buttons. Control button states or create groups of buttons for more components like toolbars.",
						"id" => "alienship_js_buttons",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Collapse",
						"desc" => "Get base styles and flexible support for collapsible components like accordions and navigation.",
						"id" => "alienship_js_collapse",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Carousel",
						"desc" => "Create a merry-go-round of any content you wish to provide in an interactive slideshow of content. * Required for Featured Posts.",
						"id" => "alienship_js_carousel",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Typeahead",
						"desc" => "A basic, easily extended plugin for quickly creating elegant typeaheads with any form text input. Default setting is disabled.",
						"id" => "alienship_js_typeahead",
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
						"id" => "alienship_analytics",
						"std" => 0,
						"folds" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Analytics code",
						"desc" => "Enter your analytics tracking code here (WITH the &lt;script&gt; and &lt;/script&gt; tags). Note: Any text you include here will be included in your pages, EVEN IF IT IS INCORRECT. Double check your code! If the analytics option is not enabled above, this text will be ignored.",
						"id" => "alienship_analytics_code",
						"fold" => "alienship_analytics",
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
						"id" => "alienship_wp_disable_admin_bar",
						"std" => 0,
						"type" => "checkbox");						
	
	// Mobile					
	$options[] = array( "name" => "Mobile Options",
						"desc" => "Improve website performance on mobile devices.",
						"type" => "info");						
						
	$options[] = array( "name" => "Enable Responsive Design?",
						"desc" => "Responsive design allows your site and its components to scale according to a range of resolutions and devices to provide a consistent experience. In other words, it looks good on computers, tablets, and smartphones. Default is enabled. If you don't need it, uncheck this box to turn it off.",
						"id" => "alienship_mobile_responsive",
						"std" => 1,
						"type" => "checkbox");						
	
	// Login Screen					
	$options[] = array( "name" => "Login Screen",
						"desc" => "Customize the website's login screen.",
						"type" => "info");

	$options[] = array( "name" => "Enable custom image on login page?",
						"desc" => "Enable this option and upload an image below to display a custom image on the login/register page. This replaces the default WordPress image. Default is disabled.",
						"id" => "alienship_custom_login_image",
						"std" => 0,
						"folds" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Upload a custom image for the login page",
						"desc" => "Upload an image to use as a custom image on the login/register page. FOR BEST RESULTS: upload an image that is 274 x 63 pixels.",
						"id" => "alienship_custom_login_image_file",
						"fold" => "alienship_custom_login_image",
						"type" => "upload");						
	
	// Outgoing Email
	$options[] = array( "name" => "Customize outgoing emails",
						"desc" => "This section allows you to override the default WordPress settings for outgoing email sender information. Instead of an email coming from \"WordPress\", you can make it say anything you want. You can do the same with the sender email address, and the return address that is used if any problems occur during delivery. \r\n &nbsp;\r\nThe default setting is enabled, and it uses your site name as the From Name and your Site Admin email address as the From address and Return Path. You can change these defaults below. If you disable this feature your site will send emails using the WordPress defaults.",
						"type" => "info");

	$options[] = array( "name" => "Enable custom sender features?",
						"desc" => "Turn on the custom sender features. Unless you specify custom values below, this tells the Theme to send emails that use your site name in the From field and your site admin email as the sender and return addresses. To set your own custom information, select the box below and type in your own values. Default setting is enabled.",
						"id" => "alienship_phpmailer_rewrite",
						"std" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "Enable customized sender information?",
						"desc" => "This allows you to customize the sender information of emails coming from your site. You must turn on \"Enable custom sender features\" above for this to work. NOTE: If you enable this option, fill in ALL fields below - otherwise your email may not work properly. Default setting is disabled.",
						"id" => "alienship_phpmailer_rewrite_custom",
						"std" => 0,
						"folds" => 1,
						"type" => "checkbox");

	$options[] = array( "name" => "From Name",
						"desc" => "Enter the name you want to use in the From: field.",
						"id" => "alienship_phpmailer_rewrite_custom_from_name",
						"std" => "",
						"fold" => "alienship_phpmailer_rewrite_custom",
						"type" => "text");

	$options[] = array( "name" => "From Email Address",
						"desc" => "Enter the Sender email address you want to use in the From: field.",
						"id" => "alienship_phpmailer_rewrite_custom_from_email",
						"std" => "",
						"fold" => "alienship_phpmailer_rewrite_custom",
						"type" => "text");

	$options[] = array( "name" => "Return Email Address",
						"desc" => "Enter the return email address you want to use in case a problem happens during delivery.",
						"id" => "alienship_phpmailer_rewrite_custom_sender",
						"std" => "",
						"fold" => "alienship_phpmailer_rewrite_custom",
						"type" => "text");	

																			
	return $options;

}

/* Customize and extend the tyopgraphy options. Support for more font faces, and separation of weights and styles. */
function alienship_recognized_font_faces( $value ) {
    return array(
			'Helvetica Neue, Helvetica, sans-serif' => 'Helvetica Neue, Helvetica, sans-serif',
			'Open Sans, sans-serif' => 'Open Sans, sans-serif',
			'Cabin, sans-serif' => 'Cabin, sans-serif',
			'Arial, Helvetica, sans-serif' => 'Arial, Helvetica, sans-serif',
			'Verdana, Geneva, sans-serif'   => 'Verdana, Geneva, sans-serif',
			'Trebuchet, sans-serif' => 'Trebuchet, sans-serif',
			'Georgia, serif'   => 'Georgia, serif',
			'Times, Times New Romain, serif'     => 'Times New Roman, serif',
			'Tahoma, Geneva, sans-serif'    => 'Tahoma, Geneva, sans-serif',
    );
}
add_filter( 'of_recognized_font_faces', 'alienship_recognized_font_faces' );


function of_recognized_font_weights() {
	$default = array(
		'normal'      => 'Normal',
		'bold'        => 'Bold',
		'lighter'				=> 'Lighter',
		);
	return apply_filters( 'of_recognized_font_weights', $default );
}


function alienship_recognized_font_styles( $value ) {
    return array(
			'normal' => 'Normal',
			'italic' => 'Italic',
    );
}
add_filter( 'of_recognized_font_styles', 'alienship_recognized_font_styles' );


function alienship_sanitize_typography( $input ) {
	$output = wp_parse_args( $input, array(
		'size'  => '',
		'face'  => '',
		'style' => '',
		'weight' => '',
		'color' => ''
	) );

	$output['size']  = apply_filters( 'of_font_size', $output['size'] );
	$output['face']  = apply_filters( 'of_font_face', $output['face'] );
	$output['style'] = apply_filters( 'of_font_style', $output['style'] );
	$output['weight'] = apply_filters( 'of_font_weight', $output['weight'] );
	$output['color'] = apply_filters( 'of_color', $output['color'] );

	return $output;
}
add_filter( 'of_sanitize_typography', 'alienship_sanitize_typography' );


function of_sanitize_font_weight( $value ) {
	$recognized = of_recognized_font_weights();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'of_default_font_weight', current( $recognized ) );
}
add_filter( 'of_font_weight', 'of_sanitize_font_weight' );

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

	<script type="text/javascript">
	jQuery(document).ready(function($) {     
	
		// custom js for featured posts option	
		$('#alienship_featured_posts').click(function() {
			$('[id^=section-alienship_featured_posts_]').fadeToggle(400);
		});
		
			if ($('#alienship_featured_posts:checked').val() == undefined) {
				$('[id^=section-alienship_featured_posts_]').hide();
			};
			
			if ($('#alienship_featured_posts:checked').val() !== undefined) {
				$('[id^=section-alienship_featured_posts_]').show();
			};  
	     
	     // custom js for footer options 
		$('#alienship_footer').click(function() {
			$('[id^=section-alienship_footer_]').fadeToggle(400);
		});
		
			if ($('#alienship_footer:checked').val() == undefined) {
				$('[id^=section-alienship_footer_]').hide();
			};
			
			if ($('#alienship_footer:checked').val() !== undefined) {
				$('[id^=section-alienship_footer_]').show();
			};						
			
		// custom js for meta icon select box upon change
		$('#alienship_style_icons').change(function() {
			switch($(this).val()) {
				case "black" :
					$('[id=section-alienship_icons_custom]').hide().addClass('hidden');
				break;
				case "white" :
					$('[id=section-alienship_icons_custom]').hide().addClass('hidden');
				break;
				case "custom" :
					$('[id=section-alienship_icons_custom]').slideDown().removeClass('hidden');
				break;
			}
		});
		
		// show and hide sections on page load based off of the currently selected meta icon option 
	    	if ($('#alienship_style_icons').val() == "black") {
	        $('[id=section-alienship_icons_custom]').hide().addClass('hidden');
	        };
	    	if ($('#alienship_style_icons').val() == "white") {
	        $('[id=section-alienship_icons_custom]').hide().addClass('hidden');
	        };
		if ($('#alienship_style_icons').val() == "custom") {
	        $('[id=section-alienship_icons_custom]').show().removeClass('hidden');
	        };		    

		// custom js for navbar brand options
		$('#alienship_navbar_brand').change(function() {
			switch($(this).val()) {
				case "one":
					$('[id=section-alienship_navbar_brand_font_text]').slideDown().removeClass('hidden');
			        	$('[id=section-alienship_navbar_brand_logo_mark], [id=section-alienship_navbar_brand_logo_text]').hide().addClass('hidden');
				break;
				case "two":
					$('[id=section-alienship_navbar_brand_font_text]').hide().addClass('hidden');
			        	$('[id=section-alienship_navbar_brand_logo_mark], [id=section-alienship_navbar_brand_logo_text]').slideDown().removeClass('hidden');
				break;
			}
		});
		
		// show and hide sections on page load based off of the currently selected navbar brand option 
		if ($('#alienship_navbar_brand').val() == "one") {
			$('[id=section-alienship_navbar_brand_font_text]').show().removeClass('hidden');
		    }; 
		if ($('#alienship_navbar_brand').val() == "two") {
		     $('[id=section-alienship_navbar_brand_logo_mark], [id=section-alienship_navbar_brand_logo_text]').show().removeClass('hidden');
		    };
		    
    });
  </script>
  
<?php
}