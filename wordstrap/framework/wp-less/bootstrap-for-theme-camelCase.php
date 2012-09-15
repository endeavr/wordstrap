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
  
/* No need to set upload directory. Roots theme sets it to "assets" folder in root directory. */
//  $theme_root_uri = '';
//  $theme_root = '';
//  $WPLessPlugin->getConfiguration()->setUploadUrl($theme_root_uri);
//  $WPLessPlugin->getConfiguration()->setUploadDir($theme_root);
}

if (!is_admin())
{

// Scaffolding	

    	$bs_bodyBackground = of_get_option('bs_bodyBackground');
	$WPLessPlugin->addVariable('@bodyBackground', $bs_bodyBackground);
	
	/* Moved this variable into the baseFont fields under Typography */
    	// $bs_textColor = of_get_option('bs_textColor');
	// $WPLessPlugin->addVariable('@textColor', $bs_textColor);		
	
// Links
	
    	$bs_linkColor = of_get_option('bs_linkColor');
	$WPLessPlugin->addVariable('@linkColor', $bs_linkColor);
	
    	$bs_linkColorHover = of_get_option('bs_linkColorHover');
	$WPLessPlugin->addVariable('@linkColorHover', $bs_linkColorHover);
	
// Colors
	
    	$bs_blue = of_get_option('bs_blue');
	$WPLessPlugin->addVariable('@blue', $bs_blue);	
	
    	$bs_green = of_get_option('bs_green');
	$WPLessPlugin->addVariable('@green', $bs_green);
	
    	$bs_red = of_get_option('bs_red');
	$WPLessPlugin->addVariable('@red', $bs_red);
	
    	$bs_yellow = of_get_option('bs_yellow');
	$WPLessPlugin->addVariable('@yellow', $bs_yellow);
	
    	$bs_orange = of_get_option('bs_orange');
	$WPLessPlugin->addVariable('@orange', $bs_orange);
	
    	$bs_pink = of_get_option('bs_pink');
	$WPLessPlugin->addVariable('@pink', $bs_pink);
	
    	$bs_purple = of_get_option('bs_purple');
	$WPLessPlugin->addVariable('@purple', $bs_purple);
	
// Grid System

	$bs_gridColumns = of_get_option('bs_gridColumns');
	$WPLessPlugin->addVariable('@gridColumns', $bs_gridColumns);
	
	$bs_gridColumnsWidth = of_get_option('bs_gridColumnsWidth');
	$WPLessPlugin->addVariable('@gridColumnsWidth', $bs_gridColumnsWidth);
	
	$bs_gridGutterWidth = of_get_option('bs_gridGutterWidth');
	$WPLessPlugin->addVariable('@gridGutterWidth', $bs_gridGutterWidth);

// Fluid Grid System	
	
	$bs_fluidGridColumnWidth = of_get_option('bs_fluidGridColumnWidth');
	$WPLessPlugin->addVariable('@fluidGridColumnWidth', $bs_fluidGridColumnWidth);
	
	$bs_fluidGridGutterWidth = of_get_option('bs_fluidGridGutterWidth');
	$WPLessPlugin->addVariable('@fluidGridGutterWidth', $bs_fluidGridGutterWidth);
	
// Typography	

	$bs_sansFontFamily = of_get_option('bs_sansFontFamily');
	$WPLessPlugin->addVariable('@sansFontFamily', $bs_sansFontFamily);
	
	$bs_serifFontFamily = of_get_option('bs_serifFontFamily');
	$WPLessPlugin->addVariable('@serifFontFamily', $bs_serifFontFamily);
	
	$bs_monoFontFamily = of_get_option('bs_monoFontFamily');
	$WPLessPlugin->addVariable('@monoFontFamily', $bs_monoFontFamily);
	
	$bs_altFontFamily = of_get_option('bs_altFontFamily');
	$WPLessPlugin->addVariable('@altFontFamily', $bs_altFontFamily);
	
	$bs_baseFont = of_get_option('bs_baseFont');
		$bs_baseFontSize = $bs_baseFont['size'];
		$bs_baseFontFamily = $bs_baseFont['face'];
		$bs_baseLineHeight = $bs_baseFont['height'];
		$bs_textColor = $bs_baseFont['color']; /* The textColor variable was moved from Scaffolding and incorporated into the baseFont options. */
			$WPLessPlugin->addVariable('@baseFontSize', $bs_baseFontSize);
			$WPLessPlugin->addVariable('@baseFontFamily', $bs_baseFontFamily);
			$WPLessPlugin->addVariable('@baseLineHeight', $bs_baseLineHeight);
			$WPLessPlugin->addVariable('@textColor', $bs_textColor);
	
	$bs_headingsFont = of_get_option('bs_headingsFont');
		$bs_headingsFontFamily = $bs_headingsFont['face'];
		$bs_headingsFontWeight = $bs_headingsFont['style'];	
		$bs_headingsColor = $bs_headingsFont['color'];
			$WPLessPlugin->addVariable('@headingsFontFamily', $bs_headingsFontFamily);
			$WPLessPlugin->addVariable('@headingsFontWeight', $bs_headingsFontWeight);
			$WPLessPlugin->addVariable('@headingsColor', $bs_headingsColor);	
	
	/* The h1 variables are custom additions and require the type.custom.less file. */
	$bs_h1Font = of_get_option('bs_h1Font');
		$bs_h1FontSize = $bs_h1Font['size'];
		$bs_h1FontFamily = $bs_h1Font['face'];
		$bs_h1FontWeight = $bs_h1Font['style'];
		$bs_h1LineHeight = $bs_h1Font['height'];	
		$bs_h1Color = $bs_h1Font['color'];
			$WPLessPlugin->addVariable('@h1FontSize', $bs_h1FontSize);
			$WPLessPlugin->addVariable('@h1FontFamily', $bs_h1FontFamily);
			$WPLessPlugin->addVariable('@h1FontWeight', $bs_h1FontWeight);
			$WPLessPlugin->addVariable('@h1LineHeight', $bs_h1LineHeight);	
			$WPLessPlugin->addVariable('@h1Color', $bs_h1Color);		
	
	$bs_heroUnitBackground = of_get_option('bs_heroUnitBackground');
		$WPLessPlugin->addVariable('@heroUnitBackground', $bs_heroUnitBackground);
	$bs_heroUnitHeadingColor = of_get_option('bs_heroUnitHeadingColor');
		$WPLessPlugin->addVariable('@heroUnitHeadingColor', $bs_heroUnitHeadingColor);
	$bs_heroUnitLeadColor = of_get_option('bs_heroUnitLeadColor');
		$WPLessPlugin->addVariable('@heroUnitLeadColor', $bs_heroUnitLeadColor);
	
// Tables

	$bs_tableBackground = of_get_option('bs_tableBackground');
	$WPLessPlugin->addVariable('@tableBackground', $bs_tableBackground);

	$bs_tableBackgroundAccent = of_get_option('bs_tableBackgroundAccent');
	$WPLessPlugin->addVariable('@tableBackgroundAccent', $bs_tableBackgroundAccent);	
	
	$bs_tableBackgroundHover = of_get_option('bs_tableBackgroundHover');
	$WPLessPlugin->addVariable('@tableBackgroundHover', $bs_tableBackgroundHover);	
	
	$bs_tableBorder = of_get_option('bs_tableBorder');
	$WPLessPlugin->addVariable('@tableBorder', $bs_tableBorder);											
	
// Navbar	
	
    	$bs_navbarHeight = of_get_option('bs_navbarHeight');
	$WPLessPlugin->addVariable('@navbarHeight', $bs_navbarHeight);
	
    	$bs_navbarBackground = of_get_option('bs_navbarBackground');
		$WPLessPlugin->addVariable('@navbarBackground', $bs_navbarBackground);
    	$bs_navbarBackgroundHighlight = of_get_option('bs_navbarBackgroundHighlight');
		$WPLessPlugin->addVariable('@navbarBackgroundHighlight', $bs_navbarBackgroundHighlight);		
			
    	$bs_navbarText = of_get_option('bs_navbarText');
	$WPLessPlugin->addVariable('@navbarText', $bs_navbarText);	
	
    	$bs_navbarBrandColor = of_get_option('bs_navbarBrandColor');
	$WPLessPlugin->addVariable('@navbarBrandColor', $bs_navbarBrandColor);		
	
    	$bs_navbarLinkColor = of_get_option('bs_navbarLinkColor'); 
		$WPLessPlugin->addVariable('@navbarLinkColor', $bs_navbarLinkColor);
    	$bs_navbarLinkColorHover = of_get_option('bs_navbarLinkColorHover');
		$WPLessPlugin->addVariable('@navbarLinkColorHover', $bs_navbarLinkColorHover);	
    	$bs_navbarLinkColorActive = of_get_option('bs_navbarLinkColorActive');
		$WPLessPlugin->addVariable('@navbarLinkColorActive', $bs_navbarLinkColorActive);
	
    	$bs_navbarLinkBackgroundHover = of_get_option('bs_navbarLinkBackgroundHover');
		$WPLessPlugin->addVariable('@navbarLinkBackgroundHover', $bs_navbarLinkBackgroundHover);	
    	$bs_navbarLinkBackgroundActive = of_get_option('bs_navbarLinkBackgroundActive');
		$WPLessPlugin->addVariable('@navbarLinkBackgroundActive', $bs_navbarLinkBackgroundActive);
	
    	$bs_navbarSearchBackground = of_get_option('bs_navbarSearchBackground');
		$WPLessPlugin->addVariable('@navbarSearchBackground', $bs_navbarSearchBackground);
    	$bs_navbarSearchBackgroundFocus = of_get_option('bs_navbarSearchBackgroundFocus');
		$WPLessPlugin->addVariable('@navbarSearchBackgroundFocus', $bs_navbarSearchBackgroundFocus);
    	$bs_navbarSearchBorder = of_get_option('bs_navbarSearchBorder');
		$WPLessPlugin->addVariable('@navbarSearchBorder', $bs_navbarSearchBorder);				
    	$bs_navbarSearchPlaceholderColor = of_get_option('bs_navbarSearchPlaceholderColor'); 
		$WPLessPlugin->addVariable('@navbarSearchPlaceholderColor', $bs_navbarSearchPlaceholderColor);
	
// Dropdowns	
	
    	$bs_dropdownBackground = of_get_option('bs_dropdownBackground');
	$WPLessPlugin->addVariable('@', $bs_dropdownBackground);
	
	$bs_dropdownBorder = of_get_option('bs_dropdownBorder');
	$WPLessPlugin->addVariable('@dropdownBorder', $bs_dropdownBorder);	
	
	$bs_dropdownLinkColor = of_get_option('bs_dropdownLinkColor');
		$WPLessPlugin->addVariable('@dropdownLinkColor', $bs_dropdownLinkColor);	
	$bs_dropdownLinkColorHover = of_get_option('bs_dropdownLinkColorHover');
		$WPLessPlugin->addVariable('@dropdownLinkColorHover', $bs_dropdownLinkColorHover);	
	$bs_dropdownLinkBackgroundHover = of_get_option('bs_dropdownLinkBackgroundHover');
		$WPLessPlugin->addVariable('@dropdownLinkBackgroundHover', $bs_dropdownLinkBackgroundHover);
	
	$bs_dropdownDividerTop = of_get_option('bs_dropdownDividerTop');
		$WPLessPlugin->addVariable('@dropdownDividerTop', $bs_dropdownDividerTop);		
	$bs_dropdownDividerBottom = of_get_option('bs_dropdownDividerBottom');
		$WPLessPlugin->addVariable('@dropdownDividerBottom', $bs_dropdownDividerBottom);	
	
// Forms

	$bs_placeholderText = of_get_option('bs_placeholderText');
	$WPLessPlugin->addVariable('@placeholderText', $bs_placeholderText);
	
	$bs_inputBackground = of_get_option('bs_inputBackground');
	$WPLessPlugin->addVariable('@inputBackground', $bs_inputBackground);
	
	$bs_inputBorder = of_get_option('bs_inputBorder');
		$WPLessPlugin->addVariable('@inputBorder', $bs_inputBorder);
	$bs_inputBorderRadius = of_get_option('bs_inputBorderRadius');
		$WPLessPlugin->addVariable('@inputBorderRadius', $bs_inputBorderRadius);
	
	$bs_inputDisabledBackground = of_get_option('bs_inputDisabledBackground');
	$WPLessPlugin->addVariable('@inputDisabledBackground', $bs_inputDisabledBackground);
	
	$bs_formActionsBackground = of_get_option('bs_formActionsBackground');
	$WPLessPlugin->addVariable('@formActionsBackground', $bs_formActionsBackground);
	
	/* Moved the btnPrimary variables to the Buttons section. */
	// $bs_btnPrimaryBackground = of_get_option('bs_btnPrimaryBackground');
	//	$WPLessPlugin->addVariable('@btnPrimaryBackground', $bs_btnPrimaryBackground);
	// $bs_btnPrimaryBackgroundHighlight = of_get_option('bs_btnPrimaryBackgroundHighlight');
	//	$WPLessPlugin->addVariable('@btnPrimaryBackgroundHighlight', $bs_btnPrimaryBackgroundHighlight);
	
// Form States & Alerts

	$bs_warningText = of_get_option('bs_warningText');
		$WPLessPlugin->addVariable('@warningText', $bs_warningText);
	$bs_warningBackground = of_get_option('bs_warningBackground');
		$WPLessPlugin->addVariable('@warningBackground', $bs_warningBackground);
	
	$bs_errorText = of_get_option('bs_errorText');
		$WPLessPlugin->addVariable('@errorText', $bs_errorText);
	$bs_errorBackground = of_get_option('bs_errorBackground');
		$WPLessPlugin->addVariable('@errorBackground', $bs_errorBackground);
	
	$bs_successText = of_get_option('bs_successText');
		$WPLessPlugin->addVariable('@successText', $bs_successText);
	$bs_successBackground = of_get_option('bs_successBackground');
		$WPLessPlugin->addVariable('@successBackground', $bs_successBackground);
	
	$bs_infoText = of_get_option('bs_infoText');
		$WPLessPlugin->addVariable('@infoText', $bs_infoText);
	$bs_infoBackground = of_get_option('bs_infoBackground');
		$WPLessPlugin->addVariable('@infoBackground', $bs_infoBackground);	
	
// Buttons

	$bs_btnBackground = of_get_option('bs_btnBackground');
		$WPLessPlugin->addVariable('@btnBackground', $bs_btnBackground);	
	$bs_btnBackgroundHighlight = of_get_option('bs_btnBackgroundHighlight');
		$WPLessPlugin->addVariable('@btnBackgroundHighlight', $bs_btnBackgroundHighlight);
	$bs_btnBorder = of_get_option('bs_btnBorder');
		$WPLessPlugin->addVariable('@btnBorder', $bs_btnBorder);
	
	$bs_btnPrimaryBackground = of_get_option('bs_btnPrimaryBackground');
		$WPLessPlugin->addVariable('@btnPrimaryBackground', $bs_btnPrimaryBackground);	
	$bs_btnPrimaryBackgroundHighlight = of_get_option('bs_btnPrimaryBackgroundHighlight');
		$WPLessPlugin->addVariable('@btnPrimaryBackgroundHighlight', $bs_btnPrimaryBackgroundHighlight);
	
	$bs_btnInfoBackground = of_get_option('bs_btnInfoBackground');
		$WPLessPlugin->addVariable('@btnInfoBackground', $bs_btnInfoBackground);	
	$bs_btnInfoBackgroundHighlight = of_get_option('bs_btnInfoBackgroundHighlight');
		$WPLessPlugin->addVariable('@btnPrimaryBackgroundHighlight', $bs_btnInfoBackgroundHighlight);	
		
	$bs_btnSuccessBackground = of_get_option('bs_btnSuccessBackground');
		$WPLessPlugin->addVariable('@btnSuccessBackground', $bs_btnSuccessBackground);	
	$bs_btnSuccessBackgroundHighlight = of_get_option('bs_btnSuccessBackgroundHighlight');
		$WPLessPlugin->addVariable('@btnSuccessBackgroundHighlight', $bs_btnSuccessBackgroundHighlight);			
		
	$bs_btnWarningBackground = of_get_option('bs_btnWarningBackground');
		$WPLessPlugin->addVariable('@btnWarningBackground', $bs_btnWarningBackground);	
	$bs_btnWarningBackgroundHighlight = of_get_option('bs_btnWarningBackgroundHighlight');
		$WPLessPlugin->addVariable('@btnWarningBackgroundHighlight', $bs_btnWarningBackgroundHighlight);		
		
	$bs_btnDangerBackground = of_get_option('bs_btnDangerBackground');
		$WPLessPlugin->addVariable('@btnDangerBackground', $bs_btnDangerBackground);	
	$bs_btnDangerBackgroundHighlight = of_get_option('bs_btnDangerBackgroundHighlight');
		$WPLessPlugin->addVariable('@btnDangerBackgroundHighlight', $bs_btnDangerBackgroundHighlight);	
		
	$bs_btnInverseBackground = of_get_option('bs_btnInverseBackground');
		$WPLessPlugin->addVariable('@btnInverseBackground', $bs_btnInverseBackground);	
	$bs_btnInverseBackgroundHighlight = of_get_option('bs_btnInverseBackgroundHighlight');
		$WPLessPlugin->addVariable('@btnInverseBackgroundHighlight', $bs_btnInverseBackgroundHighlight);											
// Misc

    	$bs_hrBorder = of_get_option('bs_hrBorder');
	$WPLessPlugin->addVariable('@hrBorder', $bs_hrBorder);		
	
	$bs_ = of_get_option('bs_');
	$WPLessPlugin->addVariable('@', $bs_);	
	
// FontAwesome Icons (sets the color of the icons)	

	$bs_iconFontAwesome = of_get_option('bs_iconFontAwesome');
	$WPLessPlugin->addVariable('@iconFontAwesome', $bs_iconFontAwesome);	

	
	wp_enqueue_style('bs_less_variables_custom', get_template_directory_uri().'/themes/wordstrap/less/variables.custom.less', array(), '1.0', 'screen,projection');
	wp_enqueue_style('bs_less_bootstrap_custom', get_template_directory_uri().'/themes/wordstrap/less/bootstrap.custom.less', array(), '1.0', 'screen,projection');
	wp_enqueue_style('bs_less_responsive_custom', get_template_directory_uri().'/themes/wordstrap/less/responsive.custom.less', array(), '1.0', 'screen,projection');

add_action('wp_print_styles', array($WPLessPlugin, 'processStylesheets'));
	
}

?>