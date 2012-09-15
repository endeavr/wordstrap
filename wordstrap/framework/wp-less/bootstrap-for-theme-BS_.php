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
  require_once get_template_directory() . '/lib/wp-less/lib/Plugin.class.php';
  $WPLessPlugin = WPPluginToolkitPlugin::create('WPLess', __FILE__, 'WPLessPlugin');
  include_once get_template_directory() . '/lib/wp-less/lib/helper/ThemeHelper.php';
  $WPLessHelper = WPPluginToolkitPlugin::create('WPLess', __FILE__, 'WPLessHelper');  
  
/* Definitely need to set the upload directory. This overrides the Roots theme setting it to "assets" folder in root directory. */
  $theme_root_uri = get_theme_root_uri().'/wordstrap';
  $theme_root = get_theme_root() . '/wordstrap';
  $WPLessPlugin->getConfiguration()->setUploadUrl($theme_root_uri);
  $WPLessPlugin->getConfiguration()->setUploadDir($theme_root);
}

if (!is_admin())
{

// Scaffolding	

    	$bs_bodyBackground = of_get_option('bs_bodybackground');
	$WPLessPlugin->addVariable('@bodyBackground', $bs_bodyBackground);
	
	/* Moved this variable into the baseFont fields under Typography */
    	// $bs_textColor = of_get_option('bs_textColor');
	// $WPLessPlugin->addVariable('@textColor', $bs_textColor);		
	
// Links
	
    	$bs_linkColor = of_get_option('bs_linkcolor');
	$WPLessPlugin->addVariable('@linkColor', $bs_linkColor);
/*	
    	$bs_linkColorHover = of_get_option('bs_linkcolorhover');
	$WPLessPlugin->addVariable('@linkColorHover', $bs_linkColorHover);
*/
	
// Colors
	
    	$bs_blue = of_get_option('bs_blue');
	$WPLessPlugin->addVariable('@blue', $bs_blue);	
	
    	$bs_blueDark = of_get_option('bs_bluedark');
	$WPLessPlugin->addVariable('@blueDark', $bs_blueDark);	
	
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

/*
	$bs_gridColumns = of_get_option('bs_gridcolumns');
	$WPLessPlugin->addVariable('@gridColumns', $bs_gridColumns);
	
	$bs_gridColumnsWidth = of_get_option('bs_gridcolumnswidth');
	$WPLessPlugin->addVariable('@gridColumnsWidth', $bs_gridColumnsWidth);
	
	$bs_gridGutterWidth = of_get_option('bs_gridgutterwidth');
	$WPLessPlugin->addVariable('@gridGutterWidth', $bs_gridGutterWidth);
*/	

// Fluid Grid System	

/*	
	$bs_fluidGridColumnWidth = of_get_option('bs_fluidgridcolumnwidth');
	$WPLessPlugin->addVariable('@fluidGridColumnWidth', $bs_fluidGridColumnWidth);
	
	$bs_fluidGridGutterWidth = of_get_option('bs_fluidgridgutterwidth');
	$WPLessPlugin->addVariable('@fluidGridGutterWidth', $bs_fluidGridGutterWidth);
*/
	
// Typography	

	$bs_sansFontFamily = of_get_option('bs_sansfontfamily');
	$WPLessPlugin->addVariable('@sansFontFamily', $bs_sansFontFamily);
	
	$bs_serifFontFamily = of_get_option('bs_seriffontfamily');
	$WPLessPlugin->addVariable('@serifFontFamily', $bs_serifFontFamily);
	
	$bs_monoFontFamily = of_get_option('bs_monofontfamily');
	$WPLessPlugin->addVariable('@monoFontFamily', $bs_monoFontFamily);
	
	$bs_altFontFamily = of_get_option('bs_altfontfamily');
	$WPLessPlugin->addVariable('@altFontFamily', $bs_altFontFamily);
	
	$bs_baseFont = of_get_option('bs_basefont');
		$bs_baseFontSize = $bs_baseFont['size'];
		$bs_baseFontFamily = $bs_baseFont['face'];
		$bs_textColor = $bs_baseFont['color']; // The textColor variable was moved from Scaffolding and incorporated into the baseFont options.
	$bs_baseLineHeight = of_get_option('bs_baselineheight');	
			$WPLessPlugin->addVariable('@baseFontSize', $bs_baseFontSize);
			$WPLessPlugin->addVariable('@baseFontFamily', $bs_baseFontFamily);
			$WPLessPlugin->addVariable('@baseLineHeight', $bs_baseLineHeight);
			$WPLessPlugin->addVariable('@textColor', $bs_textColor);
	
	$bs_headingsFont = of_get_option('bs_headingsfont');
		$bs_headingsFontFamily = $bs_headingsFont['face'];
		$bs_headingsFontWeight = $bs_headingsFont['style'];	
		$bs_headingsColor = $bs_headingsFont['color'];
			$WPLessPlugin->addVariable('@headingsFontFamily', $bs_headingsFontFamily);
			$WPLessPlugin->addVariable('@headingsFontWeight', $bs_headingsFontWeight);
			$WPLessPlugin->addVariable('@headingsColor', $bs_headingsColor);	
	
	// The h1 variables are custom additions and require the ws.type.less file.
	$bs_h1Font = of_get_option('bs_h1font');
		$bs_h1FontSize = $bs_h1Font['size'];
		$bs_h1FontFamily = $bs_h1Font['face'];
		$bs_h1FontWeight = $bs_h1Font['style'];	
		$bs_h1Color = $bs_h1Font['color'];
	$bs_h1LineHeight = of_get_option('bs_h1lineheight');	
			$WPLessPlugin->addVariable('@h1FontSize', $bs_h1FontSize);
			$WPLessPlugin->addVariable('@h1FontFamily', $bs_h1FontFamily);
			$WPLessPlugin->addVariable('@h1FontWeight', $bs_h1FontWeight);
			$WPLessPlugin->addVariable('@h1LineHeight', $bs_h1LineHeight);	
			$WPLessPlugin->addVariable('@h1Color', $bs_h1Color);		

// Hero Unit		
	$bs_heroUnitBackground = of_get_option('bs_herounitbackground');
		$WPLessPlugin->addVariable('@heroUnitBackground', $bs_heroUnitBackground);
/*
	$bs_heroUnitHeadingColor = of_get_option('bs_herounitheadingcolor');
		$WPLessPlugin->addVariable('@heroUnitHeadingColor', $bs_heroUnitHeadingColor);
	$bs_heroUnitLeadColor = of_get_option('bs_herounitleadcolor');
		$WPLessPlugin->addVariable('@heroUnitLeadColor', $bs_heroUnitLeadColor);
*/
	
// Tables

/*
	$bs_tableBackground = of_get_option('bs_tablebackground');
	$WPLessPlugin->addVariable('@tableBackground', $bs_tableBackground);
*/

	$bs_tableBackgroundAccent = of_get_option('bs_tablebackgroundaccent');
	$WPLessPlugin->addVariable('@tableBackgroundAccent', $bs_tableBackgroundAccent);	
	
	$bs_tableBackgroundHover = of_get_option('bs_tablebackgroundhover');
	$WPLessPlugin->addVariable('@tableBackgroundHover', $bs_tableBackgroundHover);	
	
	$bs_tableBorder = of_get_option('bs_tableborder');
	$WPLessPlugin->addVariable('@tableBorder', $bs_tableBorder);											
	
// Navbar	General

	$bs_navbarCollapseWidth = of_get_option('bs_navbarcollapsewidth');
		$WPLessPlugin->addVariable('@navbarCollapseWidth', $bs_navbarCollapseWidth);
    	$bs_navbarHeight = of_get_option('bs_navbarheight');
		$WPLessPlugin->addVariable('@navbarHeight', $bs_navbarHeight);
	
// Navbar	Default (Light)
	
    	$bs_navbarBackground = of_get_option('bs_navbarbackground');
		$WPLessPlugin->addVariable('@navbarBackground', $bs_navbarBackground);
/*
    	$bs_navbarBackgroundHighlight = of_get_option('bs_navbarbackgroundhighlight');
		$WPLessPlugin->addVariable('@navbarBackgroundHighlight', $bs_navbarBackgroundHighlight);	
    	$bs_navbarBorder = of_get_option('bs_navbarborder');
		$WPLessPlugin->addVariable('@navbarBorder', $bs_navbarBorder);			
*/					
    	$bs_navbarText = of_get_option('bs_navbartext');
		$WPLessPlugin->addVariable('@navbarText', $bs_navbarText);	
    	$bs_navbarLinkColor = of_get_option('bs_navbarlinkcolor'); 
		$WPLessPlugin->addVariable('@navbarLinkColor', $bs_navbarLinkColor);
    	$bs_navbarLinkColorHover = of_get_option('bs_navbarlinkcolorhover');
		$WPLessPlugin->addVariable('@navbarLinkColorHover', $bs_navbarLinkColorHover);	
    	$bs_navbarLinkColorActive = of_get_option('bs_navbarlinkcoloractive');
		$WPLessPlugin->addVariable('@navbarLinkColorActive', $bs_navbarLinkColorActive);
/*	
    	$bs_navbarLinkBackgroundHover = of_get_option('bs_navbarlinkbackgroundhover');
		$WPLessPlugin->addVariable('@navbarLinkBackgroundHover', $bs_navbarLinkBackgroundHover);	

    	$bs_navbarLinkBackgroundActive = of_get_option('bs_navbarlinkbackgroundactive');
		$WPLessPlugin->addVariable('@navbarLinkBackgroundActive', $bs_navbarLinkBackgroundActive);
*/		
    	$bs_navbarBrandColor = of_get_option('bs_navbarbrandcolor');
		$WPLessPlugin->addVariable('@navbarBrandColor', $bs_navbarBrandColor);	
		
// Navbar Inverse (Dark)
	
    	$bs_navbarInverseBackground = of_get_option('bs_navbarinversebackground');
		$WPLessPlugin->addVariable('@navbarInverseBackground', $bs_navbarInverseBackground);
/*
    	$bs_navbarInverseBackgroundHighlight = of_get_option('bs_navbarinversebackgroundhighlight');
		$WPLessPlugin->addVariable('@navbarInverseBackgroundHighlight', $bs_navbarInverseBackgroundHighlight);	
    	$bs_navbarInverseBorder = of_get_option('bs_navbarinverseborder');
		$WPLessPlugin->addVariable('@navbarInverseBorder', $bs_navbarInverseBorder);			
*/			
    	$bs_navbarInverseText = of_get_option('bs_navbarinversetext');
		$WPLessPlugin->addVariable('@navbarInverseText', $bs_navbarInverseText);	
    	$bs_navbarInverseLinkColor = of_get_option('bs_navbarinverselinkcolor'); 
		$WPLessPlugin->addVariable('@navbarInverseLinkColor', $bs_navbarInverseLinkColor);
    	$bs_navbarInverseLinkColorHover = of_get_option('bs_navbarinverselinkcolorhover');
		$WPLessPlugin->addVariable('@navbarInverseLinkColorHover', $bs_navbarInverseLinkColorHover);	
    	$bs_navbarInverseLinkColorActive = of_get_option('bs_navbarinverselinkcoloractive');
		$WPLessPlugin->addVariable('@navbarInverseLinkColorActive', $bs_navbarInverseLinkColorActive);
/*	
    	$bs_navbarInverseLinkBackgroundHover = of_get_option('bs_navbarinverselinkbackgroundhover');
		$WPLessPlugin->addVariable('@navbarInverseLinkBackgroundHover', $bs_navbarInverseLinkBackgroundHover);	

    	$bs_navbarInverseLinkBackgroundActive = of_get_option('bs_navbarinverselinkbackgroundactive');
		$WPLessPlugin->addVariable('@navbarInverseLinkBackgroundActive', $bs_navbarInverseLinkBackgroundActive);
*/		
    	$bs_navbarInverseBrandColor = of_get_option('bs_navbarinversebrandcolor');
		$WPLessPlugin->addVariable('@navbarInverseBrandColor', $bs_navbarInverseBrandColor);			
/*	
    	$bs_navbarSearchBackground = of_get_option('bs_navbarsearchbackground');
		$WPLessPlugin->addVariable('@navbarSearchBackground', $bs_navbarSearchBackground);
    	$bs_navbarSearchBackgroundFocus = of_get_option('bs_navbarsearchbackgroundfocus');
		$WPLessPlugin->addVariable('@navbarSearchBackgroundFocus', $bs_navbarSearchBackgroundFocus);
    	$bs_navbarSearchBorder = of_get_option('bs_navbarsearchborder');
		$WPLessPlugin->addVariable('@navbarSearchBorder', $bs_navbarSearchBorder);				
    	$bs_navbarSearchPlaceholderColor = of_get_option('bs_navbarsearchplaceholdercolor'); 
		$WPLessPlugin->addVariable('@navbarSearchPlaceholderColor', $bs_navbarSearchPlaceholderColor);
*/		
	
// Dropdowns	
	
    	$bs_dropdownBackground = of_get_option('bs_dropdownbackground');
		$WPLessPlugin->addVariable('@dropdownBackground', $bs_dropdownBackground);
/*
	$bs_dropdownBorder = of_get_option('bs_dropdownborder');
		$WPLessPlugin->addVariable('@dropdownBorder', $bs_dropdownBorder);
*/
	$bs_dropdownDividerTop = of_get_option('bs_dropdowndividertop');
		$WPLessPlugin->addVariable('@dropdownDividerTop', $bs_dropdownDividerTop);		
	$bs_dropdownDividerBottom = of_get_option('bs_dropdowndividerbottom');
		$WPLessPlugin->addVariable('@dropdownDividerBottom', $bs_dropdownDividerBottom);			
	
	$bs_dropdownLinkColor = of_get_option('bs_dropdownlinkcolor');
		$WPLessPlugin->addVariable('@dropdownLinkColor', $bs_dropdownLinkColor);
			
	$bs_dropdownLinkColorHover = of_get_option('bs_dropdownlinkcolorhover');
		$WPLessPlugin->addVariable('@dropdownLinkColorHover', $bs_dropdownLinkColorHover);	
	$bs_dropdownLinkBackgroundHover = of_get_option('bs_dropdownlinkbackgroundhover');
		$WPLessPlugin->addVariable('@dropdownLinkBackgroundHover', $bs_dropdownLinkBackgroundHover);
		
	$bs_dropdownLinkColorActive = of_get_option('bs_dropdownlinkcoloractive');
		$WPLessPlugin->addVariable('@dropdownLinkColorActive', $bs_dropdownLinkColorActive);	
	$bs_dropdownLinkBackgroundActive = of_get_option('bs_dropdownlinkbackgroundactive');
		$WPLessPlugin->addVariable('@dropdownLinkBackgroundActive', $bs_dropdownLinkBackgroundActive);		
	
// Forms

	$bs_placeholderText = of_get_option('bs_placeholdertext');
	$WPLessPlugin->addVariable('@placeholderText', $bs_placeholderText);
	
	$bs_inputBackground = of_get_option('bs_inputbackground');
	$WPLessPlugin->addVariable('@inputBackground', $bs_inputBackground);
	
	$bs_inputBorder = of_get_option('bs_inputborder');
		$WPLessPlugin->addVariable('@inputBorder', $bs_inputBorder);
	$bs_inputBorderRadius = of_get_option('bs_inputborderradius');
		$WPLessPlugin->addVariable('@inputBorderRadius', $bs_inputBorderRadius);
	
	$bs_inputDisabledBackground = of_get_option('bs_inputdisabledbackground');
	$WPLessPlugin->addVariable('@inputDisabledBackground', $bs_inputDisabledBackground);
	
	$bs_inputActionsBackground = of_get_option('bs_inputactionsbackground');
	$WPLessPlugin->addVariable('@inputActionsBackground', $bs_inputActionsBackground);
	
	/* Moved the btnPrimary variables to the Buttons section. */
	// $bs_btnPrimaryBackground = of_get_option('bs_btnPrimaryBackground');
	//	$WPLessPlugin->addVariable('@btnPrimaryBackground', $bs_btnPrimaryBackground);
	// $bs_btnPrimaryBackgroundHighlight = of_get_option('bs_btnPrimaryBackgroundHighlight');
	//	$WPLessPlugin->addVariable('@btnPrimaryBackgroundHighlight', $bs_btnPrimaryBackgroundHighlight);
	
// Form States & Alerts

	$bs_warningText = of_get_option('bs_warningtext');
		$WPLessPlugin->addVariable('@warningText', $bs_warningText);
	$bs_warningBackground = of_get_option('bs_warningbackground');
		$WPLessPlugin->addVariable('@warningBackground', $bs_warningBackground);
	
	$bs_errorText = of_get_option('bs_errortext');
		$WPLessPlugin->addVariable('@errorText', $bs_errorText);
	$bs_errorBackground = of_get_option('bs_errorbackground');
		$WPLessPlugin->addVariable('@errorBackground', $bs_errorBackground);
	
	$bs_successText = of_get_option('bs_successtext');
		$WPLessPlugin->addVariable('@successText', $bs_successText);
	$bs_successBackground = of_get_option('bs_successbackground');
		$WPLessPlugin->addVariable('@successBackground', $bs_successBackground);
	
	$bs_infoText = of_get_option('bs_infotext');
		$WPLessPlugin->addVariable('@infoText', $bs_infoText);
	$bs_infoBackground = of_get_option('bs_infobackground');
		$WPLessPlugin->addVariable('@infoBackground', $bs_infoBackground);	
	
// Buttons

	$bs_btnBackground = of_get_option('bs_btnbackground');
		$WPLessPlugin->addVariable('@btnBackground', $bs_btnBackground);	
/*		
	$bs_btnBackgroundHighlight = of_get_option('bs_btnbackgroundhighlight');
		$WPLessPlugin->addVariable('@btnBackgroundHighlight', $bs_btnBackgroundHighlight);

	$bs_btnBorder = of_get_option('bs_btnborder');
		$WPLessPlugin->addVariable('@btnBorder', $bs_btnBorder);
*/
	$bs_btnPrimaryBackground = of_get_option('bs_btnprimarybackground');
		$WPLessPlugin->addVariable('@btnPrimaryBackground', $bs_btnPrimaryBackground);	
/*		
	$bs_btnPrimaryBackgroundHighlight = of_get_option('bs_btnprimarybackgroundhighlight');
		$WPLessPlugin->addVariable('@btnPrimaryBackgroundHighlight', $bs_btnPrimaryBackgroundHighlight);
*/	
	$bs_btnInfoBackground = of_get_option('bs_btninfobackground');
		$WPLessPlugin->addVariable('@btnInfoBackground', $bs_btnInfoBackground);	
/*
	$bs_btnInfoBackgroundHighlight = of_get_option('bs_btninfobackgroundhighlight');
		$WPLessPlugin->addVariable('@btnInfoBackgroundHighlight', $bs_btnInfoBackgroundHighlight);	
*/		
	$bs_btnSuccessBackground = of_get_option('bs_btnsuccessbackground');
		$WPLessPlugin->addVariable('@btnSuccessBackground', $bs_btnSuccessBackground);	
/*
	$bs_btnSuccessBackgroundHighlight = of_get_option('bs_btnsuccessbackgroundhighlight');
		$WPLessPlugin->addVariable('@btnSuccessBackgroundHighlight', $bs_btnSuccessBackgroundHighlight);			
*/		
	$bs_btnWarningBackground = of_get_option('bs_btnwarningbackground');
		$WPLessPlugin->addVariable('@btnWarningBackground', $bs_btnWarningBackground);	
/*
	$bs_btnWarningBackgroundHighlight = of_get_option('bs_btnwarningbackgroundhighlight');
		$WPLessPlugin->addVariable('@btnWarningBackgroundHighlight', $bs_btnWarningBackgroundHighlight);		
*/		
	$bs_btnDangerBackground = of_get_option('bs_btndangerbackground');
		$WPLessPlugin->addVariable('@btnDangerBackground', $bs_btnDangerBackground);	
/*
	$bs_btnDangerBackgroundHighlight = of_get_option('bs_btndangerbackgroundhighlight');
		$WPLessPlugin->addVariable('@btnDangerBackgroundHighlight', $bs_btnDangerBackgroundHighlight);	
*/		
	$bs_btnInverseBackground = of_get_option('bs_btninversebackground');
		$WPLessPlugin->addVariable('@btnInverseBackground', $bs_btnInverseBackground);	
/*
	$bs_btnInverseBackgroundHighlight = of_get_option('bs_btninversebackgroundhighlight');
		$WPLessPlugin->addVariable('@btnInverseBackgroundHighlight', $bs_btnInverseBackgroundHighlight);
*/
	
// Pagination

	$bs_paginationBackground = of_get_option('bs_paginationbackground');
	$WPLessPlugin->addVariable('@paginationBackground', $bs_paginationBackground);
	
	$bs_paginationBorder = of_get_option('bs_paginationborder');
	$WPLessPlugin->addVariable('@paginationBorder', $bs_paginationBorder);
	
	$bs_paginationActiveBackground = of_get_option('bs_paginationactivebackground');
	$WPLessPlugin->addVariable('@paginationActiveBackground', $bs_paginationActiveBackground);	
	
// Tooltips and Popovers

	$bs_tooltipColor = of_get_option('bs_tooltipcolor');
		$WPLessPlugin->addVariable('@tooltipColor', $bs_tooltipColor);
	$bs_tooltipBackground = of_get_option('bs_tooltipbackground');
		$WPLessPlugin->addVariable('@tooltipBackground', $bs_tooltipBackground);	
	$bs_tooltipArrowWidth = of_get_option('bs_tooltiparrowwidth');
		$WPLessPlugin->addVariable('@tooltipArrowWidth', $bs_tooltipArrowWidth);
/*
	$bs_tooltipArrowColor = of_get_option('bs_tooltiparrowcolor');
		$WPLessPlugin->addVariable('@tooltipArrowColor', $bs_tooltipArrowColor);
*/
		
	$bs_popoverBackground = of_get_option('bs_popoverbackground');
		$WPLessPlugin->addVariable('@popoverBackground', $bs_popoverBackground);
	$bs_popoverArrowWidth = of_get_option('bs_popoverarrowwidth');
		$WPLessPlugin->addVariable('@popoverArrowWidth', $bs_popoverArrowWidth);
/*
	$bs_popoverArrowColor = of_get_option('bs_popoverarrowcolor');
		$WPLessPlugin->addVariable('@popoverArrowColor', $bs_popoverArrowColor);
	$bs_popoverTitleBackground = of_get_option('bs_popovertitlebackground');
		$WPLessPlugin->addVariable('@popoverTitleBackground', $bs_popoverTitleBackground);		
*/
								
// Misc

    	$bs_hrBorder = of_get_option('bs_hrborder');
	$WPLessPlugin->addVariable('@hrBorder', $bs_hrBorder);		
	
	$bs_wellBackground = of_get_option('bs_wellbackground');
	$WPLessPlugin->addVariable('@wellBackground', $bs_wellBackground);
	
// FontAwesome Icons (sets the color of the icons)	

	$bs_iconFontAwesome = of_get_option('bs_iconfontawesome');
	$WPLessPlugin->addVariable('@iconFontAwesome', $bs_iconFontAwesome);	


	wp_enqueue_style('bs_less_bootstrap_custom', get_template_directory_uri(). '/assets/css/less/ws.bootstrap.less', array(), '1.0', 'screen,projection');
	wp_enqueue_style('bs_less_responsive_custom', get_template_directory_uri(). '/assets/css/less/ws.responsive.less', array(), '1.0', 'screen,projection');

add_action('wp_print_styles', array($WPLessPlugin, 'processStylesheets'));
	
}

?>