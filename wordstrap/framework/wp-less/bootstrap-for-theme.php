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
  require_once get_template_directory() . '/wordstrap/framework/wp-less/lib/Plugin.class.php';
  $WPLessPlugin = WPPluginToolkitPlugin::create('WPLess', __FILE__, 'WPLessPlugin');
  include_once get_template_directory() . '/wordstrap/framework/wp-less/lib/helper/ThemeHelper.php';
  $WPLessHelper = WPPluginToolkitPlugin::create('WPLess', __FILE__, 'WPLessHelper');  
  
/* Definitely need to set the upload directory. This overrides the Roots theme setting it to "assets" folder in root directory. */

  // This gets the theme name from the stylesheet
  $theme_name = get_option( 'stylesheet' );
  
  $theme_root_uri = get_theme_root_uri().'/'.$theme_name;
  $theme_root = get_theme_root() . '/'.$theme_name;
  $WPLessPlugin->getConfiguration()->setUploadUrl($theme_root_uri);
  $WPLessPlugin->getConfiguration()->setUploadDir($theme_root);
}

if (!is_admin())
{

// Scaffolding	

	/* Moved this variable into the App.less options in the last section */
	// $ws_bodyBackground = of_get_option('ws_bodybackground');
	// $WPLessPlugin->addVariable('@bodyBackground', $ws_bodyBackground);
	
	/* Moved this variable into the baseFont fields under Typography */
    	// $ws_textColor = of_get_option('ws_textColor');
	// $WPLessPlugin->addVariable('@textColor', $ws_textColor);		
	
// Links
	
    	$ws_linkColor = of_get_option('ws_linkcolor');
	$WPLessPlugin->addVariable('@linkColor', $ws_linkColor);
/*	
    	$ws_linkColorHover = of_get_option('ws_linkcolorhover');
	$WPLessPlugin->addVariable('@linkColorHover', $ws_linkColorHover);
*/
	
// Colors
	
    	$ws_blue = of_get_option('ws_blue');
	$WPLessPlugin->addVariable('@blue', $ws_blue);	
	
    	$ws_blueDark = of_get_option('ws_bluedark');
	$WPLessPlugin->addVariable('@blueDark', $ws_blueDark);	
	
    	$ws_green = of_get_option('ws_green');
	$WPLessPlugin->addVariable('@green', $ws_green);
	
    	$ws_red = of_get_option('ws_red');
	$WPLessPlugin->addVariable('@red', $ws_red);
	
    	$ws_yellow = of_get_option('ws_yellow');
	$WPLessPlugin->addVariable('@yellow', $ws_yellow);
	
    	$ws_orange = of_get_option('ws_orange');
	$WPLessPlugin->addVariable('@orange', $ws_orange);
	
    	$ws_pink = of_get_option('ws_pink');
	$WPLessPlugin->addVariable('@pink', $ws_pink);
	
    	$ws_purple = of_get_option('ws_purple');
	$WPLessPlugin->addVariable('@purple', $ws_purple);
	
// Grid System

/*
	$ws_gridColumns = of_get_option('ws_gridcolumns');
	$WPLessPlugin->addVariable('@gridColumns', $ws_gridColumns);
	
	$ws_gridColumnsWidth = of_get_option('ws_gridcolumnswidth');
	$WPLessPlugin->addVariable('@gridColumnsWidth', $ws_gridColumnsWidth);
	
	$ws_gridGutterWidth = of_get_option('ws_gridgutterwidth');
	$WPLessPlugin->addVariable('@gridGutterWidth', $ws_gridGutterWidth);
*/	

// Fluid Grid System	

/*	
	$ws_fluidGridColumnWidth = of_get_option('ws_fluidgridcolumnwidth');
	$WPLessPlugin->addVariable('@fluidGridColumnWidth', $ws_fluidGridColumnWidth);
	
	$ws_fluidGridGutterWidth = of_get_option('ws_fluidgridgutterwidth');
	$WPLessPlugin->addVariable('@fluidGridGutterWidth', $ws_fluidGridGutterWidth);
*/
	
// Typography	

	$ws_sansFontFamily = of_get_option('ws_sansfontfamily');
	$WPLessPlugin->addVariable('@sansFontFamily', $ws_sansFontFamily);
	
	$ws_serifFontFamily = of_get_option('ws_seriffontfamily');
	$WPLessPlugin->addVariable('@serifFontFamily', $ws_serifFontFamily);
	
	$ws_monoFontFamily = of_get_option('ws_monofontfamily');
	$WPLessPlugin->addVariable('@monoFontFamily', $ws_monoFontFamily);
	
	$ws_altFontFamily = of_get_option('ws_altfontfamily');
	$WPLessPlugin->addVariable('@altFontFamily', $ws_altFontFamily);
	
	$ws_baseFont = of_get_option('ws_basefont');
		$ws_baseFontSize = $ws_baseFont['size'];
		$ws_baseFontFamily = $ws_baseFont['face'];
		$ws_textColor = $ws_baseFont['color']; // The textColor variable was moved from Scaffolding and incorporated into the baseFont options.
	$ws_baseLineHeight = of_get_option('ws_baselineheight');	
			$WPLessPlugin->addVariable('@baseFontSize', $ws_baseFontSize);
			$WPLessPlugin->addVariable('@baseFontFamily', $ws_baseFontFamily);
			$WPLessPlugin->addVariable('@baseLineHeight', $ws_baseLineHeight);
			$WPLessPlugin->addVariable('@textColor', $ws_textColor);
	
	$ws_headingsFont = of_get_option('ws_headingsfont');
		$ws_headingsFontFamily = $ws_headingsFont['face'];
		$ws_headingsFontWeight = $ws_headingsFont['style'];	
		$ws_headingsColor = $ws_headingsFont['color'];
			$WPLessPlugin->addVariable('@headingsFontFamily', $ws_headingsFontFamily);
			$WPLessPlugin->addVariable('@headingsFontWeight', $ws_headingsFontWeight);
			$WPLessPlugin->addVariable('@headingsColor', $ws_headingsColor);	
	
	// The h1 variables are custom additions and require the ws.type.less file.
	$ws_h1Font = of_get_option('ws_h1font');
		$ws_h1FontSize = $ws_h1Font['size'];
		$ws_h1FontFamily = $ws_h1Font['face'];
		$ws_h1FontWeight = $ws_h1Font['style'];	
		$ws_h1Color = $ws_h1Font['color'];
	$ws_h1LineHeight = of_get_option('ws_h1lineheight');	
			$WPLessPlugin->addVariable('@h1FontSize', $ws_h1FontSize);
			$WPLessPlugin->addVariable('@h1FontFamily', $ws_h1FontFamily);
			$WPLessPlugin->addVariable('@h1FontWeight', $ws_h1FontWeight);
			$WPLessPlugin->addVariable('@h1LineHeight', $ws_h1LineHeight);	
			$WPLessPlugin->addVariable('@h1Color', $ws_h1Color);	
	
	// Brand Font	
	$ws_brandFont = of_get_option('ws_brand_font_type');
		$ws_brandFontSize = $ws_brandFont['size'];
		$ws_brandFontFamily = $ws_brandFont['face'];
		$ws_brandFontWeight = $ws_brandFont['style'];
		$ws_brandColor = $ws_brandFont['color'];
			$WPLessPlugin->addVariable('@brandFontSize', $ws_brandFontSize);	
			$WPLessPlugin->addVariable('@brandFontFamily', $ws_brandFontFamily);
			$WPLessPlugin->addVariable('@brandFontWeight', $ws_brandFontWeight);
			$WPLessPlugin->addVariable('@brandColor', $ws_brandColor);		

// Hero Unit		
	$ws_heroUnitBackground = of_get_option('ws_herounitbackground');
		$WPLessPlugin->addVariable('@heroUnitBackground', $ws_heroUnitBackground);
/*
	$ws_heroUnitHeadingColor = of_get_option('ws_herounitheadingcolor');
		$WPLessPlugin->addVariable('@heroUnitHeadingColor', $ws_heroUnitHeadingColor);
	$ws_heroUnitLeadColor = of_get_option('ws_herounitleadcolor');
		$WPLessPlugin->addVariable('@heroUnitLeadColor', $ws_heroUnitLeadColor);
*/
	
// Tables

/*
	$ws_tableBackground = of_get_option('ws_tablebackground');
	$WPLessPlugin->addVariable('@tableBackground', $ws_tableBackground);
*/

	$ws_tableBackgroundAccent = of_get_option('ws_tablebackgroundaccent');
	$WPLessPlugin->addVariable('@tableBackgroundAccent', $ws_tableBackgroundAccent);	
	
	$ws_tableBackgroundHover = of_get_option('ws_tablebackgroundhover');
	$WPLessPlugin->addVariable('@tableBackgroundHover', $ws_tableBackgroundHover);	
	
	$ws_tableBorder = of_get_option('ws_tableborder');
	$WPLessPlugin->addVariable('@tableBorder', $ws_tableBorder);											
	
// Navbar	General

	$ws_navbarCollapseWidth = of_get_option('ws_navbarcollapsewidth');
		$WPLessPlugin->addVariable('@navbarCollapseWidth', $ws_navbarCollapseWidth);
    	$ws_navbarHeight = of_get_option('ws_navbarheight');
		$WPLessPlugin->addVariable('@navbarHeight', $ws_navbarHeight);
	
// Navbar	Default (Light)
	
    	$ws_navbarBackground = of_get_option('ws_navbarbackground');
		$WPLessPlugin->addVariable('@navbarBackground', $ws_navbarBackground);
/*
    	$ws_navbarBackgroundHighlight = of_get_option('ws_navbarbackgroundhighlight');
		$WPLessPlugin->addVariable('@navbarBackgroundHighlight', $ws_navbarBackgroundHighlight);	
    	$ws_navbarBorder = of_get_option('ws_navbarborder');
		$WPLessPlugin->addVariable('@navbarBorder', $ws_navbarBorder);			
*/					
    	$ws_navbarText = of_get_option('ws_navbartext');
		$WPLessPlugin->addVariable('@navbarText', $ws_navbarText);	
    	$ws_navbarLinkColor = of_get_option('ws_navbarlinkcolor'); 
		$WPLessPlugin->addVariable('@navbarLinkColor', $ws_navbarLinkColor);
    	$ws_navbarLinkColorHover = of_get_option('ws_navbarlinkcolorhover');
		$WPLessPlugin->addVariable('@navbarLinkColorHover', $ws_navbarLinkColorHover);	
    	$ws_navbarLinkColorActive = of_get_option('ws_navbarlinkcoloractive');
		$WPLessPlugin->addVariable('@navbarLinkColorActive', $ws_navbarLinkColorActive);
/*	
    	$ws_navbarLinkBackgroundHover = of_get_option('ws_navbarlinkbackgroundhover');
		$WPLessPlugin->addVariable('@navbarLinkBackgroundHover', $ws_navbarLinkBackgroundHover);	

    	$ws_navbarLinkBackgroundActive = of_get_option('ws_navbarlinkbackgroundactive');
		$WPLessPlugin->addVariable('@navbarLinkBackgroundActive', $ws_navbarLinkBackgroundActive);
*/		
    	$ws_navbarBrandColor = of_get_option('ws_navbarbrandcolor');
		$WPLessPlugin->addVariable('@navbarBrandColor', $ws_navbarBrandColor);	
		
// Navbar Inverse (Dark)
	
    	$ws_navbarInverseBackground = of_get_option('ws_navbarinversebackground');
		$WPLessPlugin->addVariable('@navbarInverseBackground', $ws_navbarInverseBackground);
/*
    	$ws_navbarInverseBackgroundHighlight = of_get_option('ws_navbarinversebackgroundhighlight');
		$WPLessPlugin->addVariable('@navbarInverseBackgroundHighlight', $ws_navbarInverseBackgroundHighlight);	
    	$ws_navbarInverseBorder = of_get_option('ws_navbarinverseborder');
		$WPLessPlugin->addVariable('@navbarInverseBorder', $ws_navbarInverseBorder);			
*/			
    	$ws_navbarInverseText = of_get_option('ws_navbarinversetext');
		$WPLessPlugin->addVariable('@navbarInverseText', $ws_navbarInverseText);	
    	$ws_navbarInverseLinkColor = of_get_option('ws_navbarinverselinkcolor'); 
		$WPLessPlugin->addVariable('@navbarInverseLinkColor', $ws_navbarInverseLinkColor);
    	$ws_navbarInverseLinkColorHover = of_get_option('ws_navbarinverselinkcolorhover');
		$WPLessPlugin->addVariable('@navbarInverseLinkColorHover', $ws_navbarInverseLinkColorHover);	
    	$ws_navbarInverseLinkColorActive = of_get_option('ws_navbarinverselinkcoloractive');
		$WPLessPlugin->addVariable('@navbarInverseLinkColorActive', $ws_navbarInverseLinkColorActive);
/*	
    	$ws_navbarInverseLinkBackgroundHover = of_get_option('ws_navbarinverselinkbackgroundhover');
		$WPLessPlugin->addVariable('@navbarInverseLinkBackgroundHover', $ws_navbarInverseLinkBackgroundHover);	

    	$ws_navbarInverseLinkBackgroundActive = of_get_option('ws_navbarinverselinkbackgroundactive');
		$WPLessPlugin->addVariable('@navbarInverseLinkBackgroundActive', $ws_navbarInverseLinkBackgroundActive);
*/		
    	$ws_navbarInverseBrandColor = of_get_option('ws_navbarinversebrandcolor');
		$WPLessPlugin->addVariable('@navbarInverseBrandColor', $ws_navbarInverseBrandColor);			
/*	
    	$ws_navbarSearchBackground = of_get_option('ws_navbarsearchbackground');
		$WPLessPlugin->addVariable('@navbarSearchBackground', $ws_navbarSearchBackground);
    	$ws_navbarSearchBackgroundFocus = of_get_option('ws_navbarsearchbackgroundfocus');
		$WPLessPlugin->addVariable('@navbarSearchBackgroundFocus', $ws_navbarSearchBackgroundFocus);
    	$ws_navbarSearchBorder = of_get_option('ws_navbarsearchborder');
		$WPLessPlugin->addVariable('@navbarSearchBorder', $ws_navbarSearchBorder);				
    	$ws_navbarSearchPlaceholderColor = of_get_option('ws_navbarsearchplaceholdercolor'); 
		$WPLessPlugin->addVariable('@navbarSearchPlaceholderColor', $ws_navbarSearchPlaceholderColor);
*/		
	
// Dropdowns	
	
    	$ws_dropdownBackground = of_get_option('ws_dropdownbackground');
		$WPLessPlugin->addVariable('@dropdownBackground', $ws_dropdownBackground);
/*
	$ws_dropdownBorder = of_get_option('ws_dropdownborder');
		$WPLessPlugin->addVariable('@dropdownBorder', $ws_dropdownBorder);
*/
	$ws_dropdownDividerTop = of_get_option('ws_dropdowndividertop');
		$WPLessPlugin->addVariable('@dropdownDividerTop', $ws_dropdownDividerTop);		
	$ws_dropdownDividerBottom = of_get_option('ws_dropdowndividerbottom');
		$WPLessPlugin->addVariable('@dropdownDividerBottom', $ws_dropdownDividerBottom);			
	
	$ws_dropdownLinkColor = of_get_option('ws_dropdownlinkcolor');
		$WPLessPlugin->addVariable('@dropdownLinkColor', $ws_dropdownLinkColor);
			
	$ws_dropdownLinkColorHover = of_get_option('ws_dropdownlinkcolorhover');
		$WPLessPlugin->addVariable('@dropdownLinkColorHover', $ws_dropdownLinkColorHover);	
	$ws_dropdownLinkBackgroundHover = of_get_option('ws_dropdownlinkbackgroundhover');
		$WPLessPlugin->addVariable('@dropdownLinkBackgroundHover', $ws_dropdownLinkBackgroundHover);
		
	$ws_dropdownLinkColorActive = of_get_option('ws_dropdownlinkcoloractive');
		$WPLessPlugin->addVariable('@dropdownLinkColorActive', $ws_dropdownLinkColorActive);	
	$ws_dropdownLinkBackgroundActive = of_get_option('ws_dropdownlinkbackgroundactive');
		$WPLessPlugin->addVariable('@dropdownLinkBackgroundActive', $ws_dropdownLinkBackgroundActive);		
	
// Forms

	$ws_placeholderText = of_get_option('ws_placeholdertext');
	$WPLessPlugin->addVariable('@placeholderText', $ws_placeholderText);
	
	$ws_inputBackground = of_get_option('ws_inputbackground');
	$WPLessPlugin->addVariable('@inputBackground', $ws_inputBackground);
	
	$ws_inputBorder = of_get_option('ws_inputborder');
		$WPLessPlugin->addVariable('@inputBorder', $ws_inputBorder);
	$ws_inputBorderRadius = of_get_option('ws_inputborderradius');
		$WPLessPlugin->addVariable('@inputBorderRadius', $ws_inputBorderRadius);
	
	$ws_inputDisabledBackground = of_get_option('ws_inputdisabledbackground');
	$WPLessPlugin->addVariable('@inputDisabledBackground', $ws_inputDisabledBackground);
	
	$ws_inputActionsBackground = of_get_option('ws_inputactionsbackground');
	$WPLessPlugin->addVariable('@inputActionsBackground', $ws_inputActionsBackground);
	
	/* Moved the btnPrimary variables to the Buttons section. */
	// $ws_btnPrimaryBackground = of_get_option('ws_btnPrimaryBackground');
	//	$WPLessPlugin->addVariable('@btnPrimaryBackground', $ws_btnPrimaryBackground);
	// $ws_btnPrimaryBackgroundHighlight = of_get_option('ws_btnPrimaryBackgroundHighlight');
	//	$WPLessPlugin->addVariable('@btnPrimaryBackgroundHighlight', $ws_btnPrimaryBackgroundHighlight);
	
// Form States & Alerts

	$ws_warningText = of_get_option('ws_warningtext');
		$WPLessPlugin->addVariable('@warningText', $ws_warningText);
	$ws_warningBackground = of_get_option('ws_warningbackground');
		$WPLessPlugin->addVariable('@warningBackground', $ws_warningBackground);
	
	$ws_errorText = of_get_option('ws_errortext');
		$WPLessPlugin->addVariable('@errorText', $ws_errorText);
	$ws_errorBackground = of_get_option('ws_errorbackground');
		$WPLessPlugin->addVariable('@errorBackground', $ws_errorBackground);
	
	$ws_successText = of_get_option('ws_successtext');
		$WPLessPlugin->addVariable('@successText', $ws_successText);
	$ws_successBackground = of_get_option('ws_successbackground');
		$WPLessPlugin->addVariable('@successBackground', $ws_successBackground);
	
	$ws_infoText = of_get_option('ws_infotext');
		$WPLessPlugin->addVariable('@infoText', $ws_infoText);
	$ws_infoBackground = of_get_option('ws_infobackground');
		$WPLessPlugin->addVariable('@infoBackground', $ws_infoBackground);	
	
// Buttons

	$ws_btnBackground = of_get_option('ws_btnbackground');
		$WPLessPlugin->addVariable('@btnBackground', $ws_btnBackground);	
/*		
	$ws_btnBackgroundHighlight = of_get_option('ws_btnbackgroundhighlight');
		$WPLessPlugin->addVariable('@btnBackgroundHighlight', $ws_btnBackgroundHighlight);

	$ws_btnBorder = of_get_option('ws_btnborder');
		$WPLessPlugin->addVariable('@btnBorder', $ws_btnBorder);
*/
	$ws_btnPrimaryBackground = of_get_option('ws_btnprimarybackground');
		$WPLessPlugin->addVariable('@btnPrimaryBackground', $ws_btnPrimaryBackground);	
/*		
	$ws_btnPrimaryBackgroundHighlight = of_get_option('ws_btnprimarybackgroundhighlight');
		$WPLessPlugin->addVariable('@btnPrimaryBackgroundHighlight', $ws_btnPrimaryBackgroundHighlight);
*/	
	$ws_btnInfoBackground = of_get_option('ws_btninfobackground');
		$WPLessPlugin->addVariable('@btnInfoBackground', $ws_btnInfoBackground);	
/*
	$ws_btnInfoBackgroundHighlight = of_get_option('ws_btninfobackgroundhighlight');
		$WPLessPlugin->addVariable('@btnInfoBackgroundHighlight', $ws_btnInfoBackgroundHighlight);	
*/		
	$ws_btnSuccessBackground = of_get_option('ws_btnsuccessbackground');
		$WPLessPlugin->addVariable('@btnSuccessBackground', $ws_btnSuccessBackground);	
/*
	$ws_btnSuccessBackgroundHighlight = of_get_option('ws_btnsuccessbackgroundhighlight');
		$WPLessPlugin->addVariable('@btnSuccessBackgroundHighlight', $ws_btnSuccessBackgroundHighlight);			
*/		
	$ws_btnWarningBackground = of_get_option('ws_btnwarningbackground');
		$WPLessPlugin->addVariable('@btnWarningBackground', $ws_btnWarningBackground);	
/*
	$ws_btnWarningBackgroundHighlight = of_get_option('ws_btnwarningbackgroundhighlight');
		$WPLessPlugin->addVariable('@btnWarningBackgroundHighlight', $ws_btnWarningBackgroundHighlight);		
*/		
	$ws_btnDangerBackground = of_get_option('ws_btndangerbackground');
		$WPLessPlugin->addVariable('@btnDangerBackground', $ws_btnDangerBackground);	
/*
	$ws_btnDangerBackgroundHighlight = of_get_option('ws_btndangerbackgroundhighlight');
		$WPLessPlugin->addVariable('@btnDangerBackgroundHighlight', $ws_btnDangerBackgroundHighlight);	
*/		
	$ws_btnInverseBackground = of_get_option('ws_btninversebackground');
		$WPLessPlugin->addVariable('@btnInverseBackground', $ws_btnInverseBackground);	
/*
	$ws_btnInverseBackgroundHighlight = of_get_option('ws_btninversebackgroundhighlight');
		$WPLessPlugin->addVariable('@btnInverseBackgroundHighlight', $ws_btnInverseBackgroundHighlight);
*/
	
// Pagination

	$ws_paginationBackground = of_get_option('ws_paginationbackground');
	$WPLessPlugin->addVariable('@paginationBackground', $ws_paginationBackground);
	
	$ws_paginationBorder = of_get_option('ws_paginationborder');
	$WPLessPlugin->addVariable('@paginationBorder', $ws_paginationBorder);
	
	$ws_paginationActiveBackground = of_get_option('ws_paginationactivebackground');
	$WPLessPlugin->addVariable('@paginationActiveBackground', $ws_paginationActiveBackground);	
	
// Tooltips and Popovers

	$ws_tooltipColor = of_get_option('ws_tooltipcolor');
		$WPLessPlugin->addVariable('@tooltipColor', $ws_tooltipColor);
	$ws_tooltipBackground = of_get_option('ws_tooltipbackground');
		$WPLessPlugin->addVariable('@tooltipBackground', $ws_tooltipBackground);	
	$ws_tooltipArrowWidth = of_get_option('ws_tooltiparrowwidth');
		$WPLessPlugin->addVariable('@tooltipArrowWidth', $ws_tooltipArrowWidth);
/*
	$ws_tooltipArrowColor = of_get_option('ws_tooltiparrowcolor');
		$WPLessPlugin->addVariable('@tooltipArrowColor', $ws_tooltipArrowColor);
*/
		
	$ws_popoverBackground = of_get_option('ws_popoverbackground');
		$WPLessPlugin->addVariable('@popoverBackground', $ws_popoverBackground);
	$ws_popoverArrowWidth = of_get_option('ws_popoverarrowwidth');
		$WPLessPlugin->addVariable('@popoverArrowWidth', $ws_popoverArrowWidth);
/*
	$ws_popoverArrowColor = of_get_option('ws_popoverarrowcolor');
		$WPLessPlugin->addVariable('@popoverArrowColor', $ws_popoverArrowColor);
	$ws_popoverTitleBackground = of_get_option('ws_popovertitlebackground');
		$WPLessPlugin->addVariable('@popoverTitleBackground', $ws_popoverTitleBackground);		
*/
								
// Misc

    	$ws_hrBorder = of_get_option('ws_hrborder');
	$WPLessPlugin->addVariable('@hrBorder', $ws_hrBorder);		
	
	$ws_wellBackground = of_get_option('ws_wellbackground');
	$WPLessPlugin->addVariable('@wellBackground', $ws_wellBackground);
	
// FontAwesome Icons (sets the color of the icons)	

	$ws_iconFontAwesome = of_get_option('ws_iconfontawesome');
	$WPLessPlugin->addVariable('@iconFontAwesome', $ws_iconFontAwesome);	
	
	
/* Options for the App LESS file */

// Background Colors + Patterns
	
	// BODY
	$ws_bodyOption = of_get_option('ws_bodyoption');
	$ws_bodyBackground = of_get_option('ws_bodybackground');
	$ws_bodyPattern = of_get_option('ws_bodypattern');
		$ws_bodyPatternURL = "url('../../img/patterns/$ws_bodyPattern.png')";
	$ws_bodyUpload = of_get_option('ws_bodyupload');
		$ws_bodyUploadURL = "url('$ws_bodyUpload')";
	$ws_bodyRepeat = of_get_option('ws_bodyrepeat');
	$ws_bodyAttach = of_get_option('ws_bodyattach');
	
		if ( $ws_bodyOption == 'color' ) {
			$WPLessPlugin->addVariable('@bodyBackground', $ws_bodyBackground);
			$WPLessPlugin->addVariable('@bodyPattern', 'none');
			$WPLessPlugin->addVariable('@bodyRepeat', 'no-repeat');
			$WPLessPlugin->addVariable('@bodyAttach', $ws_bodyAttach);
	    	};
	    	if ( $ws_bodyOption == 'colorpattern' ) {
	    		$WPLessPlugin->addVariable('@bodyBackground', $ws_bodyBackground);
			$WPLessPlugin->addVariable('@bodyPattern', $ws_bodyPatternURL);
			$WPLessPlugin->addVariable('@bodyRepeat', $ws_bodyRepeat);
			$WPLessPlugin->addVariable('@bodyAttach', $ws_bodyAttach);
		};
	    	if ( $ws_bodyOption == 'upload' ) {
	    		$WPLessPlugin->addVariable('@bodyBackground', $ws_bodyBackground);
			$WPLessPlugin->addVariable('@bodyPattern', $ws_bodyUploadURL);
			$WPLessPlugin->addVariable('@bodyRepeat', $ws_bodyRepeat);
			$WPLessPlugin->addVariable('@bodyAttach', $ws_bodyAttach);
		};				
	
	// CONTENT WRAP
	$ws_wrapOption = of_get_option('ws_wrapoption');
	$ws_wrapBackground = of_get_option('ws_wrapbackground');
	$ws_wrapPattern = of_get_option('ws_wrappattern');
		$ws_wrapPatternURL = "url('../../img/patterns/$ws_wrapPattern.png')";
	$ws_wrapUpload = of_get_option('ws_wrapupload');
		$ws_wrapUploadURL = "url('$ws_wrapUpload')";
	$ws_wrapRepeat = of_get_option('ws_wraprepeat');
	$ws_wrapAttach = of_get_option('ws_wrapattach');
	
		if ( $ws_wrapOption == 'transparent' ) {
			$WPLessPlugin->addVariable('@wrapBackground', 'transparent');
			$WPLessPlugin->addVariable('@wrapPattern', 'none');
			$WPLessPlugin->addVariable('@wrapRepeat', 'no-repeat');
			$WPLessPlugin->addVariable('@wrapAttach', $ws_wrapAttach);
		};
		if ( $ws_wrapOption == 'color' ) {
			$WPLessPlugin->addVariable('@wrapBackground', $ws_wrapBackground);
			$WPLessPlugin->addVariable('@wrapPattern', 'none');
			$WPLessPlugin->addVariable('@wrapRepeat', 'no-repeat');
			$WPLessPlugin->addVariable('@wrapAttach', $ws_wrapAttach);
		}; 
		if ( $ws_wrapOption == 'colorpattern' ) {
			$WPLessPlugin->addVariable('@wrapBackground', $ws_wrapBackground);
			$WPLessPlugin->addVariable('@wrapPattern', $ws_wrapPatternURL);
			$WPLessPlugin->addVariable('@wrapRepeat', $ws_wrapRepeat);
			$WPLessPlugin->addVariable('@wrapAttach', $ws_wrapAttach);
		};
	    	if ( $ws_wrapOption == 'upload' ) {
	    		$WPLessPlugin->addVariable('@wrapBackground', $ws_wrapBackground);
			$WPLessPlugin->addVariable('@wrapPattern', $ws_wrapUploadURL);
			$WPLessPlugin->addVariable('@wrapRepeat', $ws_wrapRepeat);
			$WPLessPlugin->addVariable('@wrapAttach', $ws_wrapAttach);
		};	
	
	// FOOTER	
	$ws_footerOption = of_get_option('ws_footeroption');
	$ws_footerBackground = of_get_option('ws_footerbackground');
	$ws_footerPattern = of_get_option('ws_footerpattern');
		$ws_footerPatternURL = "url('../../img/patterns/$ws_footerPattern.png')";
	$ws_footerUpload = of_get_option('ws_footerupload');
		$ws_footerUploadURL = "url('$ws_footerUpload')";
	$ws_footerRepeat = of_get_option('ws_footerrepeat');
	$ws_footerAttach = of_get_option('ws_footerattach');
	
		if ( $ws_footerOption == 'transparent' ) {
			$WPLessPlugin->addVariable('@footerBackground', 'transparent');
			$WPLessPlugin->addVariable('@footerPattern', 'none');
			$WPLessPlugin->addVariable('@footerRepeat', 'no-repeat');
			$WPLessPlugin->addVariable('@footerAttach', $ws_footerAttach);
		};
		if ( $ws_footerOption == 'color' ) {
			$WPLessPlugin->addVariable('@footerBackground', $ws_footerBackground);
			$WPLessPlugin->addVariable('@footerPattern', 'none');
			$WPLessPlugin->addVariable('@footerRepeat', 'no-repeat');
			$WPLessPlugin->addVariable('@footerAttach', $ws_footerAttach);
		}; 
		if ( $ws_footerOption == 'colorpattern' ) {
			$WPLessPlugin->addVariable('@footerBackground', $ws_footerBackground);
			$WPLessPlugin->addVariable('@footerPattern', $ws_footerPatternURL);
			$WPLessPlugin->addVariable('@footerRepeat', $ws_footerRepeat);
			$WPLessPlugin->addVariable('@footerAttach', $ws_footerAttach);
		};
	    	if ( $ws_footerOption == 'upload' ) {
	    		$WPLessPlugin->addVariable('@footerBackground', $ws_footerBackground);
			$WPLessPlugin->addVariable('@footerPattern', $ws_footerUploadURL);
			$WPLessPlugin->addVariable('@footerRepeat', $ws_footerRepeat);
			$WPLessPlugin->addVariable('@footerAttach', $ws_footerAttach);
		};	
		
// Typography Colors

	// FOOTER
	$ws_footerColor = of_get_option('ws_footercolor');
		$WPLessPlugin->addVariable('@footerColor', $ws_footerColor);
	$ws_footerLinkColor = of_get_option('ws_footerlinkcolor');
		$WPLessPlugin->addVariable('@footerLinkColor', $ws_footerLinkColor);						
	
/* Enqueue the LESS files */	

	wp_enqueue_style('ws_less_bootstrap_custom', '/wordstrap/assets/css/less/ws.bootstrap.less', array(), '1.0', 'screen,projection');
	wp_enqueue_style('ws_less_responsive_custom', '/wordstrap/assets/css/less/ws.responsive.less', array(), '1.0', 'screen,projection');
	
	if (is_child_theme()) {
		wp_enqueue_style('ws_less_app_custom', '/'.$theme_name.'/assets/css/less/ws.app.less', array(), '1.0', 'screen,projection');
	}
	if (!is_child_theme()) {
		wp_enqueue_style('ws_less_app_custom', '/wordstrap/assets/css/less/ws.app.less', array(), '1.0', 'screen,projection');
	}	

add_action('wp_print_styles', array($WPLessPlugin, 'processStylesheets'));
	
}

?>