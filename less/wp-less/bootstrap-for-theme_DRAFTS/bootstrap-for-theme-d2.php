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
  include_once dirname(__FILE__).'/lib/helper/ThemeHelper.php';
  $WPLessHelper = WPPluginToolkitPlugin::create('WPLess', __FILE__, 'WPLessHelper');
}

if (!is_admin())
{

	$bs_color_link = of_get_option('alienship_color_link');
	if ($bs_color_link) { 
	$WPLessPlugin->addVariable('@linkColor', $bs_color_link);
	}
	
	
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/reset.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/mixins.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/scaffolding.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/grid.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/layouts.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/type.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/code.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/forms.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/tables.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/sprites.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/dropdowns.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/wells.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/component-animations.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/close.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/buttons.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/button-groups.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/alerts.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/navs.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/navbar.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/breadcrumbs.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/pagination.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/pager.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/modals.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/tooltip.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/popovers.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/thumbnails.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/labels.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/badges.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/progress-bars.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/accordion.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/carousel.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/hero-unit.less', array(), '1.0', 'screen,projection');
  wp_enqueue_style('alienship', get_template_directory_uri().'/less/utilities.less', array(), '1.0', 'screen,projection');


}

?>