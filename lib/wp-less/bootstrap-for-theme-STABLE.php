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
  require_once get_template_directory() . '/less/wp-less/lib/Plugin.class.php';
  $WPLessPlugin = WPPluginToolkitPlugin::create('WPLess', __FILE__, 'WPLessPlugin');
  include_once get_template_directory() . '/less/wp-less/lib/helper/ThemeHelper.php';
  $WPLessHelper = WPPluginToolkitPlugin::create('WPLess', __FILE__, 'WPLessHelper');  
  
// No need to set upload directory. Roots theme sets it to "assets" folder in root directory.  
//  $theme_root_uri = '';
//  $theme_root = '';
//  $WPLessPlugin->getConfiguration()->setUploadUrl($theme_root_uri);
//  $WPLessPlugin->getConfiguration()->setUploadDir($theme_root);
}

if (!is_admin())
{
	
    	$bs_style_body = of_get_option('wordstrap_style_body');
	$WPLessPlugin->addVariable('@bodyBackground', $bs_style_body);
	
    	$bs_style_text = of_get_option('wordstrap_style_text');
	$WPLessPlugin->addVariable('@textColor', $bs_style_text);		
	
    	$bs_style_link = of_get_option('wordstrap_style_link');
	$WPLessPlugin->addVariable('@linkColor', $bs_style_link);
	
    	$bs_style_hr = of_get_option('wordstrap_style_hr');
	$WPLessPlugin->addVariable('@hrBorder', $bs_style_hr);		
	
    	$bs_style_navbar_height = of_get_option('wordstrap_style_navbar_height');
	$WPLessPlugin->addVariable('@navbarHeight', $bs_style_navbar_height);
			
    	$bs_style_navbar_text = of_get_option('wordstrap_style_navbar_text');
	$WPLessPlugin->addVariable('@navbarText', $bs_style_navbar_text);	
	
    	$bs_style_navbar_link = of_get_option('wordstrap_style_navbar_link'); 
	$WPLessPlugin->addVariable('@navbarLinkColor', $bs_style_navbar_link);
	
    	$bs_style_navbar_link_hover = of_get_option('wordstrap_style_navbar_link_hover');
	$WPLessPlugin->addVariable('@navbarLinkColorHover', $bs_style_navbar_link_hover);	
	
    	$bs_style_navbar_link_active = of_get_option('wordstrap_style_navbar_link_active');
	$WPLessPlugin->addVariable('@navbarLinkColorActive', $bs_style_navbar_link_active);
	
    	$bs_style_navbar_link_active_bg = of_get_option('wordstrap_style_navbar_link_active_bg');
	$WPLessPlugin->addVariable('@navbarLinkBackgroundActive', $bs_style_navbar_link_active_bg);
	
    	$bs_style_navbar_bg1 = of_get_option('wordstrap_style_navbar_bg1');
	$WPLessPlugin->addVariable('@navbarBackground', $bs_style_navbar_bg1);
	
    	$bs_style_navbar_bg2 = of_get_option('wordstrap_style_navbar_bg2');
	$WPLessPlugin->addVariable('@navbarBackgroundHighlight', $bs_style_navbar_bg2);				
	
    	$bs_style_navbar_search_bg = of_get_option('wordstrap_style_navbar_search_bg');
	$WPLessPlugin->addVariable('@navbarSearchBackground', $bs_style_navbar_search_bg);
	
    	$bs_style_navbar_search_bg_focused = of_get_option('wordstrap_style_navbar_search_bg_focused');
	$WPLessPlugin->addVariable('@navbarSearchBackgroundFocus', $bs_style_navbar_search_bg_focused);		
	
    	$bs_style_navbar_search_placeholder = of_get_option('wordstrap_style_navbar_search_placeholder'); 
	$WPLessPlugin->addVariable('@navbarSearchPlaceholderColor', $bs_style_navbar_search_placeholder);
	
	wp_enqueue_style('bs_less_variables_custom', get_template_directory_uri().'/themes/wordstrap/less/variables.custom.less', array(), '1.0', 'screen,projection');
	wp_enqueue_style('bs_less_bootstrap_custom', get_template_directory_uri().'/themes/wordstrap/less/bootstrap.custom.less', array(), '1.0', 'screen,projection');
	wp_enqueue_style('bs_less_responsive_custom', get_template_directory_uri().'/themes/wordstrap/less/responsive.custom.less', array(), '1.0', 'screen,projection');

add_action('wp_print_styles', array($WPLessPlugin, 'processStylesheets'));
	
}

?>