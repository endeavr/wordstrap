<?php
/*
 * This file tends to be included in any development.
 * In a sentence, in every case where you don't want to use WP-LESS as a standalone.
 * 
 * Once included, it's up to you to use the available toolkit for your needs.
 * 
 * = How to use? =
 * 
 * 1. In your theme, include the `wp-less` anywhere you want. (eg: `wp-content/themes/yourtheme/lib/wp-less`)
 * 2. Include the required files in your functions.php file. (eg: `require dirname(__FILE__).'/lib/wp-less/bootstreap-theme.php`)
 * 3. The `$WPLessPlugin` is available for your
 * 
 * In case you need to access the $WPLessPlugin variable outside the include scope, simply do that:
 * `$WPLessPlugin = WPLessPlugin::getInstance();`
 * 
 * And to apply automatic building on page display:
 * `add_action('wp_print_styles', array($WPLessPlugin, 'processStylesheets'));`
 * Or apply all hooks with:
 * `$WPLessPlugin->dispatch();`
 * 
 * You can rebuild all stylesheets at any time with:
 * `$WPLessPlugin->processStylesheets();`
 * 
 * Or a specific stylesheet:
 * `wp_enqueue_style('my_css', 'path/to/my/style.css');`
 * `$WPLessPlugin->processStylesheet('my_css');`
 * 
 * = Filters and hooks aren't enough =
 * 
 * Build your own flavour and manage it the way you want. Simply extends WPLessPlugin and/or WPLessConfiguration.
 * Dig in the code to see what to configure. I tried to make things customizable without extending classes!
 */

/*
 * This will be effective only if the plugin is not activated.
 * You can then redistribute your theme with this loader fearlessly.
 */
if (!class_exists('WPLessPlugin'))
{
  require dirname(__FILE__).'/lib/Plugin.class.php';
  $WPLessPlugin = WPPluginToolkitPlugin::create('WPLess', __FILE__, 'WPLessPlugin');
}

if (!is_admin())
{

	if ( of_get_option('alienship_enable_custom_styles',1) ) {
	
		wp_enqueue_style('bs_less_variables_custom', get_template_directory_uri().'/less/custom/variables.less', array(), '1.0', 'screen,projection'); 
	
	    	$bs_color_link = of_get_option('alienship_color_link');
		if ($bs_color_link) { 
		$WPLessPlugin->addVariable('@linkColor', $bs_color_link);
		}
		
		$bs_color_link_hover = of_get_option('alienship_color_link_hover');
		if ($bs_color_link_hover) { 
		$WPLessPlugin->addVariable('@linkColorHover', $bs_color_link_hover);
		}
		
	    	$bs_color_navbar_text = of_get_option('alienship_color_navbar_text');
		if ($bs_color_navbar_text) { 
		$WPLessPlugin->addVariable('@navbarText', $bs_color_navbar_text);
		}	
		
	    	$bs_color_navbar_link = of_get_option('alienship_color_navbar_link');
		if ($bs_color_navbar_link) { 
		$WPLessPlugin->addVariable('@navbarLinkColor', $bs_color_navbar_link);
		}
		
	    	$bs_color_navbar_link_hover = of_get_option('alienship_color_navbar_link_hover');
		if ($bs_color_navbar_link_hover) { 
		$WPLessPlugin->addVariable('@navbarLinkColorHover', $bs_color_navbar_link_hover);
		}
		
	    	$bs_color_navbar_link_hover_bg = of_get_option('alienship_color_navbar_link_hover_bg');
		if ($bs_color_navbar_link_hover_bg) { 
		$WPLessPlugin->addVariable('@navbarLinkBackgroundHover', $bs_color_navbar_link_hover_bg);
		}	
		
	    	$bs_color_navbar_link_active = of_get_option('alienship_color_navbar_link_active');
		if ($bs_color_navbar_link_active) { 
		$WPLessPlugin->addVariable('@navbarLinkColorActive', $bs_color_navbar_link_active);
		}	
		
	    	$bs_color_navbar_link_active_bg = of_get_option('alienship_color_navbar_link_active_bg');
		if ($bs_color_navbar_link_active_bg) { 
		$WPLessPlugin->addVariable('@navbarLinkBackgroundActive', $bs_color_navbar_link_active_bg);
		}
		
	    	$bs_color_navbar_bg1 = of_get_option('alienship_color_navbar_bg1');
		if ($bs_color_navbar_bg1) { 
		$WPLessPlugin->addVariable('@navbarBackground', $bs_color_navbar_bg1);
		}	
		
	    	$bs_color_navbar_bg2 = of_get_option('alienship_color_navbar_bg2');
		if ($bs_color_navbar_bg2) { 
		$WPLessPlugin->addVariable('@navbarBackgroundHighlight', $bs_color_navbar_bg2);
		}				
		
	    	$bs_color_navbar_search_bg = of_get_option('alienship_color_navbar_search_bg');
		if ($bs_color_navbar_search_bg) { 
		$WPLessPlugin->addVariable('@navbarSearchBackground', $bs_color_navbar_search_bg);
		}
		
	    	$bs_color_navbar_search_bg_focused = of_get_option('alienship_color_navbar_search_bg_focused');
		if ($bs_color_navbar_search_bg_focused) { 
		$WPLessPlugin->addVariable('@navbarSearchBackgroundFocus', $bs_color_navbar_search_bg_focused);
		}		
		
	    	$bs_color_navbar_search_placeholder = of_get_option('alienship_color_navbar_search_placeholder');
		if ($bs_color_navbar_search_placeholder) { 
		$WPLessPlugin->addVariable('@navbarSearchPlaceholderColor', $bs_color_navbar_search_placeholder);
		}
		
	} else {
		wp_enqueue_style('bs_less_variables', get_template_directory_uri().'/less/variables.less', array(), '1.0', 'screen,projection');
	}
		
	wp_enqueue_style('bs_less', get_template_directory_uri().'/less/bootstrap.less', array(), '1.0', 'screen,projection');

	if ( of_get_option('alienship_responsive',1) ) { 	
		wp_enqueue_style('bs_responsive', get_template_directory_uri().'/less/responsive.less', array(), '1.0', 'screen,projection');
	}
	
	add_action('wp_print_styles', array($WPLessPlugin, 'processStylesheets'));
	
}

?>