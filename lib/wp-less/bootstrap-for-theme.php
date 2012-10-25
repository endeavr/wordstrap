<?php
/*
 * Defines LESS variables based on the options panel settings and compiles all LESS into cached CSS files.
 */
if (!class_exists('WPLessPlugin'))
{
  require_once get_template_directory() . '/lib/wp-less/lib/Plugin.class.php';
  $WPLessPlugin = WPPluginToolkitPlugin::create('WPLess', __FILE__, 'WPLessPlugin');
  include_once get_template_directory() . '/lib/wp-less/lib/helper/ThemeHelper.php';
  $WPLessHelper = WPPluginToolkitPlugin::create('WPLess', __FILE__, 'WPLessHelper');  

  // This gets the theme name from the stylesheet
  $theme_name = get_option( 'stylesheet' );
  // Sets the upload directory
  $theme_root_uri = get_theme_root_uri();
  $theme_root = get_theme_root();  
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

    	$ws_linkColorHover = of_get_option('ws_linkcolorhover');
    		if ( $ws_linkColorHover == '' ) {
		    	$WPLessPlugin->addVariable('@linkColorHover', 'darken(@linkColor, 15%)');
	    	}
	    	if ( $ws_linkColorHover != '' ) {
		    	$WPLessPlugin->addVariable('@linkColorHover', $ws_linkColorHover);
	    	}
	
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
	
// Typography
	$ws_sansFontFamily = of_get_option('ws_sansfontfamily');
	$WPLessPlugin->addVariable('@sansFontFamily', $ws_sansFontFamily);
	
	$ws_serifFontFamily = of_get_option('ws_seriffontfamily');
	$WPLessPlugin->addVariable('@serifFontFamily', $ws_serifFontFamily);
	
	$ws_monoFontFamily = of_get_option('ws_monofontfamily');
	$WPLessPlugin->addVariable('@monoFontFamily', $ws_monoFontFamily);
	
	$ws_altFontFamily = of_get_option('ws_altfontfamily');
	$WPLessPlugin->addVariable('@altFontFamily', $ws_altFontFamily);
	
	/* NOTE: The textColor variable was moved from Scaffolding and incorporated into the baseFont options. */
	$ws_baseFont = of_get_option('ws_basefont');
		$ws_baseFontSize = $ws_baseFont['size'];
		$ws_baseFontFamily = $ws_baseFont['face'];
		$ws_textColor = $ws_baseFont['color']; 
		
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
	
	/* NOTE: The h1 variables are custom additions and require the ws.type.less file. */
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
	$ws_heroUnitHeadingColor = of_get_option('ws_herounitheadingcolor');
		if ( $ws_heroUnitHeadingColor == '' ) {
		    	$WPLessPlugin->addVariable('@heroUnitHeadingColor', 'transparent');
	    	}
	    	if ( $ws_heroUnitHeadingColor != '' ) {
		    	$WPLessPlugin->addVariable('@heroUnitHeadingColor', $ws_heroUnitHeadingColor);
	    	}
	$ws_heroUnitLeadColor = of_get_option('ws_herounitleadcolor');
		if ( $ws_heroUnitLeadColor == '' ) {
		    	$WPLessPlugin->addVariable('@heroUnitLeadColor', 'transparent');
	    	}
	    	if ( $ws_heroUnitLeadColor != '' ) {
		    	$WPLessPlugin->addVariable('@heroUnitLeadColor', $ws_heroUnitLeadColor);
	    	}
	
// Tables	
	$ws_tableBackground = of_get_option('ws_tablebackground');
		if ( $ws_tableBackground == '' ) {
		    	$WPLessPlugin->addVariable('@tableBackground', 'transparent');
	    	}
	    	if ( $ws_tableBackground != '' ) {
		    	$WPLessPlugin->addVariable('@tableBackground', $ws_tableBackground);
	    	}
	$ws_tableBackgroundAccent = of_get_option('ws_tablebackgroundaccent');
		$WPLessPlugin->addVariable('@tableBackgroundAccent', $ws_tableBackgroundAccent);	
	$ws_tableBackgroundHover = of_get_option('ws_tablebackgroundhover');
		$WPLessPlugin->addVariable('@tableBackgroundHover', $ws_tableBackgroundHover);	
	$ws_tableBorder = of_get_option('ws_tableborder');
		$WPLessPlugin->addVariable('@tableBorder', $ws_tableBorder);											
	
// NAVBAR - General
	$ws_navbarCollapseWidth = of_get_option('ws_navbarcollapsewidth');
		$WPLessPlugin->addVariable('@navbarCollapseWidth', $ws_navbarCollapseWidth);
    	$ws_navbarHeight = of_get_option('ws_navbarheight');
		$WPLessPlugin->addVariable('@navbarHeight', $ws_navbarHeight);
	$ws_navbarBorderRadiusTop = of_get_option('ws_navbarborderradiustop');
		$WPLessPlugin->addVariable('@navbarBorderRadiusTop', $ws_navbarBorderRadiusTop);
	$ws_navbarBorderRadiusBtm = of_get_option('ws_navbarborderradiusbtm');
		$WPLessPlugin->addVariable('@navbarBorderRadiusBtm', $ws_navbarBorderRadiusBtm);	
		
	$ws_navbarPosition = of_get_option('ws_navbarposition');
	$ws_navbarFixed = of_get_option('ws_navbarfixed');
		if ( $ws_navbarPosition == 'navbar-pos-top' && $ws_navbarFixed == 'navbar-fixed' ) {
			$WPLessPlugin->addVariable('@brandMarginTop', $ws_navbarHeight); 
		}
		if ( $ws_navbarPosition == 'navbar-pos-btm' || $ws_navbarFixed == 'navbar-static' ) {
			$WPLessPlugin->addVariable('@brandMarginTop', '0px'); 
		}		
		
// NAVBAR - Dropdown + Carets
	$ws_navbarCaret = of_get_option('ws_navbarcaret');
		$WPLessPlugin->addVariable('@navbarCaret', $ws_navbarCaret);
	$ws_navbarDropdownCaret = of_get_option('ws_navbardropdowncaret');
		$WPLessPlugin->addVariable('@navbarDropdownCaret', $ws_navbarDropdownCaret);
	$ws_navbarDropdownBorderRadius = of_get_option('ws_navbardropdownborderradius');
		$WPLessPlugin->addVariable('@navbarDropdownBorderRadius', $ws_navbarDropdownBorderRadius);	
	$ws_navbarDropdownMarginTop = of_get_option('ws_navbardropdownmargintop');
		$WPLessPlugin->addVariable('@navbarDropdownMarginTop', $ws_navbarDropdownMarginTop);					
	
// NAVBAR Scheme - Default (Light)
    	$ws_navbarBackground = of_get_option('ws_navbardefaultbackground');
		$WPLessPlugin->addVariable('@navbarBackground', $ws_navbarBackground);	
    	$ws_navbarBorder = of_get_option('ws_navbardefaultborder');
		$WPLessPlugin->addVariable('@navbarBorder', $ws_navbarBorder);			
					
    	$ws_navbarText = of_get_option('ws_navbardefaulttext');
		$WPLessPlugin->addVariable('@navbarText', $ws_navbarText);	
    	$ws_navbarLinkColor = of_get_option('ws_navbardefaultlinkcolor'); 
		$WPLessPlugin->addVariable('@navbarLinkColor', $ws_navbarLinkColor);
    	$ws_navbarLinkColorHover = of_get_option('ws_navbardefaultlinkcolorhover');
		$WPLessPlugin->addVariable('@navbarLinkColorHover', $ws_navbarLinkColorHover);	
    	$ws_navbarLinkColorActive = of_get_option('ws_navbardefaultlinkcoloractive');
		$WPLessPlugin->addVariable('@navbarLinkColorActive', $ws_navbarLinkColorActive);
		
    	$ws_navbarLinkBackgroundHover = of_get_option('ws_navbardefaultlinkbackgroundhover');
	    	if ( $ws_navbarLinkBackgroundHover == '' ) {
		    	$WPLessPlugin->addVariable('@navbarLinkBackgroundHover', 'transparent');
	    	}
	    	if ( $ws_navbarLinkBackgroundHover != '' ) {
		    	$WPLessPlugin->addVariable('@navbarLinkBackgroundHover', $ws_navbarLinkBackgroundHover);
	    	}
    	$ws_navbarLinkBackgroundActive = of_get_option('ws_navbardefaultlinkbackgroundactive');
		if ( $ws_navbarLinkBackgroundActive == '' ) {
		    	$WPLessPlugin->addVariable('@navbarLinkBackgroundActive', 'darken(@navbarBackground, 5%)');
	    	}
	    	if ( $ws_navbarLinkBackgroundActive != '' ) {
		    	$WPLessPlugin->addVariable('@navbarLinkBackgroundActive', $ws_navbarLinkBackgroundActive);
	    	}    	
		
    	$ws_navbarBrandColor = of_get_option('ws_navbardefaultbrandcolor');
		$WPLessPlugin->addVariable('@navbarBrandColor', $ws_navbarBrandColor);	
		
	/* NOTE: The @navbarBackgroundHighlight + the navbar border are auto-generated in the ws.variables.less file.
		They are derived from the base background color. */		
		
// NAVBAR Scheme - Inverse (Dark)
	
    	$ws_navbarInverseBackground = of_get_option('ws_navbarinversebackground');
		$WPLessPlugin->addVariable('@navbarInverseBackground', $ws_navbarInverseBackground);
    	$ws_navbarInverseBorder = of_get_option('ws_navbarinverseborder');
		$WPLessPlugin->addVariable('@navbarInverseBorder', $ws_navbarInverseBorder);
						
    	$ws_navbarInverseText = of_get_option('ws_navbarinversetext');
		$WPLessPlugin->addVariable('@navbarInverseText', $ws_navbarInverseText);	
    	$ws_navbarInverseLinkColor = of_get_option('ws_navbarinverselinkcolor'); 
		$WPLessPlugin->addVariable('@navbarInverseLinkColor', $ws_navbarInverseLinkColor);
    	$ws_navbarInverseLinkColorHover = of_get_option('ws_navbarinverselinkcolorhover');
		$WPLessPlugin->addVariable('@navbarInverseLinkColorHover', $ws_navbarInverseLinkColorHover);	
    	$ws_navbarInverseLinkColorActive = of_get_option('ws_navbarinverselinkcoloractive');
		$WPLessPlugin->addVariable('@navbarInverseLinkColorActive', $ws_navbarInverseLinkColorActive);
	
	$ws_navbarInverseLinkBackgroundHover = of_get_option('ws_navbarinverselinkbackgroundhover');	
	    	if ( $ws_navbarInverseLinkBackgroundHover == '' ) {
		    	$WPLessPlugin->addVariable('@navbarInverseLinkBackgroundHover', 'transparent');
	    	}
	    	if ( $ws_navbarInverseLinkBackgroundHover != '' ) {
		    	$WPLessPlugin->addVariable('@navbarInverseLinkBackgroundHover', $ws_navbarInverseLinkBackgroundHover);
	    	}
	$ws_navbarInverseLinkBackgroundActive = of_get_option('ws_navbarinverselinkbackgroundactive');
		if ( $ws_navbarInverseLinkBackgroundActive == '' ) {
		    	$WPLessPlugin->addVariable('@navbarInverseLinkBackgroundActive', 'darken(@navbarInverseBackground, 5%)');
	    	}
	    	if ( $ws_navbarInverseLinkBackgroundActive != '' ) {
		    	$WPLessPlugin->addVariable('@navbarInverseLinkBackgroundActive', $ws_navbarInverseLinkBackgroundActive);
	    	}
	
    	$ws_navbarInverseBrandColor = of_get_option('ws_navbarinversebrandcolor');
		$WPLessPlugin->addVariable('@navbarInverseBrandColor', $ws_navbarInverseBrandColor);	
		
	/* NOTE: The @navbarInverseBackgroundHighlight + the navbar border are auto-generated in the ws.variables.less file.
		They are derived from the base background color. */			
	
// Dropdowns
    	$ws_dropdownBackground = of_get_option('ws_dropdownbackground');
		$WPLessPlugin->addVariable('@dropdownBackground', $ws_dropdownBackground);
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
	
	/* NOTE: The dropdowns border is auto-generated in the ws.variables.less file. */	
	
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
	
	/* NOTE: Moved the btnPrimary variables to the Buttons section. */
	
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
	$ws_btnPrimaryBackground = of_get_option('ws_btnprimarybackground');
		$WPLessPlugin->addVariable('@btnPrimaryBackground', $ws_btnPrimaryBackground);	
	$ws_btnInfoBackground = of_get_option('ws_btninfobackground');
		$WPLessPlugin->addVariable('@btnInfoBackground', $ws_btnInfoBackground);	
	$ws_btnSuccessBackground = of_get_option('ws_btnsuccessbackground');
		$WPLessPlugin->addVariable('@btnSuccessBackground', $ws_btnSuccessBackground);		
	$ws_btnWarningBackground = of_get_option('ws_btnwarningbackground');
		$WPLessPlugin->addVariable('@btnWarningBackground', $ws_btnWarningBackground);	
	$ws_btnDangerBackground = of_get_option('ws_btndangerbackground');
		$WPLessPlugin->addVariable('@btnDangerBackground', $ws_btnDangerBackground);	
	$ws_btnInverseBackground = of_get_option('ws_btninversebackground');
		$WPLessPlugin->addVariable('@btnInverseBackground', $ws_btnInverseBackground);	

	/* NOTE: The button borders and all button background highlights are auto-generated in the ws.variables.less file.
		They are derived from each button's base color. */
	
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
		
	$ws_popoverBackground = of_get_option('ws_popoverbackground');
		$WPLessPlugin->addVariable('@popoverBackground', $ws_popoverBackground);
	$ws_popoverArrowWidth = of_get_option('ws_popoverarrowwidth');
		$WPLessPlugin->addVariable('@popoverArrowWidth', $ws_popoverArrowWidth);

	/* NOTE: Several of the Tooltip + Popover variables are auto-generated in the ws.variables.less file.
		They are derived from the base background color. */
		
// Wells	
	$ws_wellBackground = of_get_option('ws_wellbackground');
		$WPLessPlugin->addVariable('@wellBackground', $ws_wellBackground);		
								
// Misc

    	$ws_hrBorder = of_get_option('ws_hrborder');
		$WPLessPlugin->addVariable('@hrBorder', $ws_hrBorder);		
	
// FontAwesome Icons (sets the color of the icons)	

	$ws_iconFontAwesome = of_get_option('ws_iconfontawesome');
		$WPLessPlugin->addVariable('@iconFontAwesome', $ws_iconFontAwesome);	
	
	
/* Options for the App LESS file */

// Background Colors + Patterns
	
// BODY
	$ws_bodyOption = of_get_option('ws_bodyoption');
	$ws_bodyBackground = of_get_option('ws_bodybackground');
	$ws_bodyPatternSheer = of_get_option('ws_bodypatternsheer');
		$ws_bodyPatternSheerURL = "url('../../img/patterns-sheer/$ws_bodyPatternSheer')";
	$ws_bodyPatternOpaque = of_get_option('ws_bodypatternopaque');
		$ws_bodyPatternOpaqueURL = "url('../../img/patterns-opaque/$ws_bodyPatternOpaque')";
	$ws_bodyUpload = of_get_option('ws_bodyupload');
		$ws_bodyUploadURL = "url('$ws_bodyUpload')";
	$ws_bodyRepeat = of_get_option('ws_bodyrepeat');
	$ws_bodyAttach = of_get_option('ws_bodyattach');
	
	$WPLessPlugin->addVariable('@bodyGradient', $ws_bodyBackground);
	
		if ( $ws_bodyOption == 'color' || $ws_bodyOption == 'gradient' ) {
			$WPLessPlugin->addVariable('@bodyBackground', $ws_bodyBackground);
			$WPLessPlugin->addVariable('@bodyPattern', 'none');
			$WPLessPlugin->addVariable('@bodyRepeat', $ws_bodyRepeat);
			$WPLessPlugin->addVariable('@bodyAttach', $ws_bodyAttach);
	    	};  	    	
	    	if ( $ws_bodyOption == 'patternsheer' ) {
	    		$WPLessPlugin->addVariable('@bodyBackground', $ws_bodyBackground);
			$WPLessPlugin->addVariable('@bodyPattern', $ws_bodyPatternSheerURL);
			$WPLessPlugin->addVariable('@bodyRepeat', $ws_bodyRepeat);
			$WPLessPlugin->addVariable('@bodyAttach', $ws_bodyAttach);
		};
	    	if ( $ws_bodyOption == 'patternopaque' ) {
	    		$WPLessPlugin->addVariable('@bodyBackground', $ws_bodyBackground);
			$WPLessPlugin->addVariable('@bodyPattern', $ws_bodyPatternOpaqueURL);
			$WPLessPlugin->addVariable('@bodyRepeat', $ws_bodyRepeat);
			$WPLessPlugin->addVariable('@bodyAttach', $ws_bodyAttach);
		};		
	    	if ( $ws_bodyOption == 'uploadsheer' || $ws_bodyOption == 'uploadopaque' ) {
	    		$WPLessPlugin->addVariable('@bodyBackground', $ws_bodyBackground);
			$WPLessPlugin->addVariable('@bodyPattern', $ws_bodyUploadURL);
			$WPLessPlugin->addVariable('@bodyRepeat', $ws_bodyRepeat);
			$WPLessPlugin->addVariable('@bodyAttach', $ws_bodyAttach);
		};	
		
// HEADER
	$ws_headerOption = of_get_option('ws_headeroption');
	$ws_headerBackground = of_get_option('ws_headerbackground');
	$ws_headerPatternSheer = of_get_option('ws_headerpatternsheer');
		$ws_headerPatternSheerURL = "url('../../img/patterns-sheer/$ws_headerPatternSheer')";
	$ws_headerPatternOpaque = of_get_option('ws_headerpatternopaque');
		$ws_headerPatternOpaqueURL = "url('../../img/patterns-opaque/$ws_headerPatternOpaque')";	
	$ws_headerUpload = of_get_option('ws_headerupload');
		$ws_headerUploadURL = "url('$ws_headerUpload')";
	$ws_headerRepeat = of_get_option('ws_headerrepeat');
	$ws_headerAttach = of_get_option('ws_headerattach');
	
	$WPLessPlugin->addVariable('@headerGradient', $ws_headerBackground);
	
		if ( $ws_headerOption == 'transparent' ) {
			$WPLessPlugin->addVariable('@headerBackground', 'transparent');
			$WPLessPlugin->addVariable('@headerPattern', 'none');
			$WPLessPlugin->addVariable('@headerRepeat', 'no-repeat');
			$WPLessPlugin->addVariable('@headerAttach', $ws_headerAttach);
		};
		if ( $ws_headerOption == 'color' || $ws_headerOption == 'gradient' ) {
			$WPLessPlugin->addVariable('@headerBackground', $ws_headerBackground);
			$WPLessPlugin->addVariable('@headerPattern', 'none');
			$WPLessPlugin->addVariable('@headerRepeat', $ws_headerRepeat);
			$WPLessPlugin->addVariable('@headerAttach', $ws_headerAttach);
		};
		if ( $ws_headerOption == 'patternsheer' ) {
			$WPLessPlugin->addVariable('@headerBackground', $ws_headerBackground);
			$WPLessPlugin->addVariable('@headerPattern', $ws_headerPatternSheerURL);
			$WPLessPlugin->addVariable('@headerRepeat', $ws_headerRepeat);
			$WPLessPlugin->addVariable('@headerAttach', $ws_headerAttach);
		};
		if ( $ws_headerOption == 'patternopaque' ) {
			$WPLessPlugin->addVariable('@headerBackground', $ws_headerBackground);
			$WPLessPlugin->addVariable('@headerPattern', $ws_headerPatternOpaqueURL);
			$WPLessPlugin->addVariable('@headerRepeat', $ws_headerRepeat);
			$WPLessPlugin->addVariable('@headerAttach', $ws_headerAttach);
		};		
	    	if ( $ws_headerOption == 'uploadsheer' || $ws_headerOption == 'uploadopaque' ) {
	    		$WPLessPlugin->addVariable('@headerBackground', $ws_headerBackground);
			$WPLessPlugin->addVariable('@headerPattern', $ws_headerUploadURL);
			$WPLessPlugin->addVariable('@headerRepeat', $ws_headerRepeat);
			$WPLessPlugin->addVariable('@headerAttach', $ws_headerAttach);
		};	
		
	$ws_headerContainer = of_get_option('ws_headercontainer');
		$WPLessPlugin->addVariable('@headerContainer', $ws_headerContainer);	
			
	$ws_headerBoxShadow = of_get_option('ws_headerboxshadow');	
	if ( $ws_headerBoxShadow == 'none' ) {
		$WPLessPlugin->addVariable('@headerBoxShadow', 'none');		
	}	
	if ( $ws_headerBoxShadow == 'shadow' ) {
		$WPLessPlugin->addVariable('@headerBoxShadow', '0 1px 5px 1px rgba(0,0,0,.15)');		
	}
	
	$ws_headerBorderRadiusTop = of_get_option('ws_headerborderradiustop');
		$WPLessPlugin->addVariable('@headerBorderRadiusTop', $ws_headerBorderRadiusTop);	
	$ws_headerBorderRadiusBtm = of_get_option('ws_headerborderradiusbtm');
		$WPLessPlugin->addVariable('@headerBorderRadiusBtm', $ws_headerBorderRadiusBtm);	
	$ws_headerPaddingTop = of_get_option('ws_headerpaddingtop');
		$WPLessPlugin->addVariable('@headerPaddingTop', $ws_headerPaddingTop);	
	$ws_headerPaddingBtm = of_get_option('ws_headerpaddingbtm');
		$WPLessPlugin->addVariable('@headerPaddingBtm', $ws_headerPaddingBtm);
	$ws_headerMarginTop = of_get_option('ws_headermargintop');
		$WPLessPlugin->addVariable('@headerMarginTop', $ws_headerMarginTop);			
		
// MASTHEAD
	$ws_mastOption = of_get_option('ws_mastoption');
	$ws_mastBackground = of_get_option('ws_mastbackground');
	$ws_mastPatternSheer = of_get_option('ws_mastpatternsheer');
		$ws_mastPatternSheerURL = "url('../../img/patterns-sheer/$ws_mastPatternSheer')";
	$ws_mastPatternOpaque = of_get_option('ws_mastpatternopaque');
		$ws_mastPatternOpaqueURL = "url('../../img/patterns-opaque/$ws_mastPatternOpaque')";
	$ws_mastUpload = of_get_option('ws_mastupload');
		$ws_mastUploadURL = "url('$ws_mastUpload')";
	$ws_mastRepeat = of_get_option('ws_mastrepeat');
	$ws_mastAttach = of_get_option('ws_mastattach');
	
	$WPLessPlugin->addVariable('@mastGradient', $ws_mastBackground);
	
		if ( $ws_mastOption == 'transparent' ) {
			$WPLessPlugin->addVariable('@mastBackground', 'transparent');
			$WPLessPlugin->addVariable('@mastPattern', 'none');
			$WPLessPlugin->addVariable('@mastRepeat', 'no-repeat');
			$WPLessPlugin->addVariable('@mastAttach', $ws_mastAttach);
		};
		if ( $ws_mastOption == 'color' || $ws_mastOption == 'gradient' ) {
			$WPLessPlugin->addVariable('@mastBackground', $ws_mastBackground);
			$WPLessPlugin->addVariable('@mastPattern', 'none');
			$WPLessPlugin->addVariable('@mastRepeat', $ws_mastRepeat);
			$WPLessPlugin->addVariable('@mastAttach', $ws_mastAttach);
		};
		if ( $ws_mastOption == 'patternsheer' ) {
			$WPLessPlugin->addVariable('@mastBackground', $ws_mastBackground);
			$WPLessPlugin->addVariable('@mastPattern', $ws_mastPatternSheerURL);
			$WPLessPlugin->addVariable('@mastRepeat', $ws_mastRepeat);
			$WPLessPlugin->addVariable('@mastAttach', $ws_mastAttach);
		};
		if ( $ws_mastOption == 'patternopaque' ) {
			$WPLessPlugin->addVariable('@mastBackground', $ws_mastBackground);
			$WPLessPlugin->addVariable('@mastPattern', $ws_mastPatternOpaqueURL);
			$WPLessPlugin->addVariable('@mastRepeat', $ws_mastRepeat);
			$WPLessPlugin->addVariable('@mastAttach', $ws_mastAttach);
		};
	    	if ( $ws_mastOption == 'uploadsheer' || $ws_mastOption == 'uploadopaque' ) {
	    		$WPLessPlugin->addVariable('@mastBackground', $ws_mastBackground);
			$WPLessPlugin->addVariable('@mastPattern', $ws_mastUploadURL);
			$WPLessPlugin->addVariable('@mastRepeat', $ws_mastRepeat);
			$WPLessPlugin->addVariable('@mastAttach', $ws_mastAttach);
		};	
			
	$ws_mastBoxShadow = of_get_option('ws_mastboxshadow');	
	if ( $ws_mastBoxShadow == 'none' ) {
		$WPLessPlugin->addVariable('@mastBoxShadow', 'none');		
	}	
	if ( $ws_mastBoxShadow == 'shadow' ) {
		$WPLessPlugin->addVariable('@mastBoxShadow', '0 1px 5px 1px rgba(0,0,0,.15)');		
	}
		
	$ws_mastHeight = of_get_option('ws_mastheight');
		$WPLessPlugin->addVariable('@mastHeight', $ws_mastHeight);
	$ws_mastBorderRadiusTop = of_get_option('ws_mastborderradiustop');
		$WPLessPlugin->addVariable('@mastBorderRadiusTop', $ws_mastBorderRadiusTop);
	$ws_mastBorderRadiusBtm = of_get_option('ws_mastborderradiusbtm');
		$WPLessPlugin->addVariable('@mastBorderRadiusBtm', $ws_mastBorderRadiusBtm);
	$ws_mastMarginBtm = of_get_option('ws_mastmarginbtm');
		$WPLessPlugin->addVariable('@mastMarginBtm', $ws_mastMarginBtm);				
					
// CONTENT WRAP
	$ws_wrapOption = of_get_option('ws_wrapoption');
	$ws_wrapBackground = of_get_option('ws_wrapbackground');
	$ws_wrapPatternSheer = of_get_option('ws_wrappatternsheer');
		$ws_wrapPatternSheerURL = "url('../../img/patterns-sheer/$ws_wrapPatternSheer')";
	$ws_wrapPatternOpaque = of_get_option('ws_wrappatternopaque');
		$ws_wrapPatternOpaqueURL = "url('../../img/patterns-opaque/$ws_wrapPatternOpaque')";
	$ws_wrapUpload = of_get_option('ws_wrapupload');
		$ws_wrapUploadURL = "url('$ws_wrapUpload')";
	$ws_wrapRepeat = of_get_option('ws_wraprepeat');
	$ws_wrapAttach = of_get_option('ws_wrapattach');
	
	$WPLessPlugin->addVariable('@wrapGradient', $ws_wrapBackground);
	
		if ( $ws_wrapOption == 'transparent' ) {
			$WPLessPlugin->addVariable('@wrapBackground', 'transparent');
			$WPLessPlugin->addVariable('@wrapPattern', 'none');
			$WPLessPlugin->addVariable('@wrapRepeat', 'no-repeat');
			$WPLessPlugin->addVariable('@wrapAttach', $ws_wrapAttach);
		};
		if ( $ws_wrapOption == 'color' || $ws_wrapOption == 'gradient' ) {
			$WPLessPlugin->addVariable('@wrapBackground', $ws_wrapBackground);
			$WPLessPlugin->addVariable('@wrapPattern', 'none');
			$WPLessPlugin->addVariable('@wrapRepeat', $ws_wrapRepeat);
			$WPLessPlugin->addVariable('@wrapAttach', $ws_wrapAttach);
		}; 
		if ( $ws_wrapOption == 'patternsheer' ) {
			$WPLessPlugin->addVariable('@wrapBackground', $ws_wrapBackground);
			$WPLessPlugin->addVariable('@wrapPattern', $ws_wrapPatternSheerURL);
			$WPLessPlugin->addVariable('@wrapRepeat', $ws_wrapRepeat);
			$WPLessPlugin->addVariable('@wrapAttach', $ws_wrapAttach);
		};
		if ( $ws_wrapOption == 'patternopaque' ) {
			$WPLessPlugin->addVariable('@wrapBackground', $ws_wrapBackground);
			$WPLessPlugin->addVariable('@wrapPattern', $ws_wrapPatternOpaqueURL);
			$WPLessPlugin->addVariable('@wrapRepeat', $ws_wrapRepeat);
			$WPLessPlugin->addVariable('@wrapAttach', $ws_mastAttach);
		};
	    	if ( $ws_wrapOption == 'uploadsheer' || $ws_wrapOption == 'uploadopaque' ) {
	    		$WPLessPlugin->addVariable('@wrapBackground', $ws_wrapBackground);
			$WPLessPlugin->addVariable('@wrapPattern', $ws_wrapUploadURL);
			$WPLessPlugin->addVariable('@wrapRepeat', $ws_wrapRepeat);
			$WPLessPlugin->addVariable('@wrapAttach', $ws_wrapAttach);
		};	
		
	$ws_wrapBoxShadow = of_get_option('ws_wrapboxshadow');	
	if ( $ws_wrapBoxShadow == 'none' ) {
		$WPLessPlugin->addVariable('@wrapBoxShadow', 'none');		
	}	
	if ( $ws_wrapBoxShadow == 'shadow' ) {
		$WPLessPlugin->addVariable('@wrapBoxShadow', '0 1px 5px 1px rgba(0,0,0,.15)');		
	}
	
	$ws_wrapBorderRadiusTop = of_get_option('ws_wrapborderradiustop');
		$WPLessPlugin->addVariable('@wrapBorderRadiusTop', $ws_wrapBorderRadiusTop);	
	$ws_wrapBorderRadiusBtm = of_get_option('ws_wrapborderradiusbtm');
		$WPLessPlugin->addVariable('@wrapBorderRadiusBtm', $ws_wrapBorderRadiusBtm);	
	$ws_wrapMarginTop = of_get_option('ws_wrapmargintop');
		$WPLessPlugin->addVariable('@wrapMarginTop', $ws_wrapMarginTop);	
	$ws_wrapMarginBtm = of_get_option('ws_wrapmarginbtm');
		$WPLessPlugin->addVariable('@wrapMarginBtm', $ws_wrapMarginBtm);

		
// SIDEBAR
	$ws_sidebarOption = of_get_option('ws_sidebaroption');
	$ws_sidebarBackground = of_get_option('ws_sidebarbackground');
	$ws_sidebarPatternSheer = of_get_option('ws_sidebarpatternsheer');
		$ws_sidebarPatternSheerURL = "url('../../img/patterns-sheer/$ws_sidebarPatternSheer')";
	$ws_sidebarPatternOpaque = of_get_option('ws_sidebarpatternopaque');
		$ws_sidebarPatternOpaqueURL = "url('../../img/patterns-opaque/$ws_sidebarPatternOpaque')";
	$ws_sidebarUpload = of_get_option('ws_sidebarupload');
		$ws_sidebarUploadURL = "url('$ws_sidebarUpload')";
	$ws_sidebarRepeat = of_get_option('ws_sidebarrepeat');
	$ws_sidebarAttach = of_get_option('ws_sidebarattach');
	
	$WPLessPlugin->addVariable('@sidebarGradient', $ws_sidebarBackground);
	
		if ( $ws_sidebarOption == 'transparent' ) {
			$WPLessPlugin->addVariable('@sidebarBackground', 'transparent');
			$WPLessPlugin->addVariable('@sidebarPattern', 'none');
			$WPLessPlugin->addVariable('@sidebarRepeat', 'no-repeat');
			$WPLessPlugin->addVariable('@sidebarAttach', $ws_sidebarAttach);
		};
		if ( $ws_sidebarOption == 'color' || $ws_sidebarOption == 'gradient' ) {
			$WPLessPlugin->addVariable('@sidebarBackground', $ws_sidebarBackground);
			$WPLessPlugin->addVariable('@sidebarPattern', 'none');
			$WPLessPlugin->addVariable('@sidebarRepeat', $ws_sidebarRepeat);
			$WPLessPlugin->addVariable('@sidebarAttach', $ws_sidebarAttach);
		}; 
		if ( $ws_sidebarOption == 'patternsheer' ) {
			$WPLessPlugin->addVariable('@sidebarBackground', $ws_sidebarBackground);
			$WPLessPlugin->addVariable('@sidebarPattern', $ws_sidebarPatternSheerURL);
			$WPLessPlugin->addVariable('@sidebarRepeat', $ws_sidebarRepeat);
			$WPLessPlugin->addVariable('@sidebarAttach', $ws_sidebarAttach);
		};
		if ( $ws_sidebarOption == 'patternopaque' ) {
			$WPLessPlugin->addVariable('@sidebarBackground', $ws_sidebarBackground);
			$WPLessPlugin->addVariable('@sidebarPattern', $ws_sidebarPatternOpaqueURL);
			$WPLessPlugin->addVariable('@sidebarRepeat', $ws_sidebarRepeat);
			$WPLessPlugin->addVariable('@sidebarAttach', $ws_sidebarAttach);
		};
	    	if ( $ws_sidebarOption == 'uploadsheer' || $ws_sidebarOption == 'uploadopaque' ) {
	    		$WPLessPlugin->addVariable('@sidebarBackground', $ws_sidebarBackground);
			$WPLessPlugin->addVariable('@sidebarPattern', $ws_sidebarUploadURL);
			$WPLessPlugin->addVariable('@sidebarRepeat', $ws_sidebarRepeat);
			$WPLessPlugin->addVariable('@sidebarAttach', $ws_sidebarAttach);
		};
		if ( $ws_sidebarOption == 'auto' && $ws_wrapOption != 'transparent' && $ws_wrapOption != 'uploadopaque' ) {
	    		$WPLessPlugin->addVariable('@sidebarBackground', 'darken(@wrapBackground, 3%)');
			$WPLessPlugin->addVariable('@sidebarPattern', 'none');
			$WPLessPlugin->addVariable('@sidebarRepeat', 'no-repeat');
			$WPLessPlugin->addVariable('@sidebarAttach', $ws_sidebarAttach);
		};
		if ( $ws_sidebarOption == 'auto' && $ws_wrapOption == 'transparent' || $ws_wrapOption == 'uploadopaque' ) {
	    		$WPLessPlugin->addVariable('@sidebarBackground', 'transparent');
			$WPLessPlugin->addVariable('@sidebarPattern', 'none');
			$WPLessPlugin->addVariable('@sidebarRepeat', 'no-repeat');
			$WPLessPlugin->addVariable('@sidebarAttach', $ws_sidebarAttach);
		};		
			
	
// FOOTER	
	$ws_footerOption = of_get_option('ws_footeroption');
	$ws_footerBackground = of_get_option('ws_footerbackground');
	$ws_footerPatternSheer = of_get_option('ws_footerpatternsheer');
		$ws_footerPatternSheerURL = "url('../../img/patterns-sheer/$ws_footerPatternSheer')";
	$ws_footerPatternOpaque = of_get_option('ws_footerpatternopaque');
		$ws_footerPatternOpaqueURL = "url('../../img/patterns-opaque/$ws_footerPatternOpaque')";
	$ws_footerUpload = of_get_option('ws_footerupload');
		$ws_footerUploadURL = "url('$ws_footerUpload')";
	$ws_footerRepeat = of_get_option('ws_footerrepeat');
	$ws_footerAttach = of_get_option('ws_footerattach');
	
	$WPLessPlugin->addVariable('@footerGradient', $ws_footerBackground);
	
		if ( $ws_footerOption == 'transparent' ) {
			$WPLessPlugin->addVariable('@footerBackground', 'transparent');
			$WPLessPlugin->addVariable('@footerPattern', 'none');
			$WPLessPlugin->addVariable('@footerRepeat', 'no-repeat');
			$WPLessPlugin->addVariable('@footerAttach', $ws_footerAttach);
		};
		if ( $ws_footerOption == 'color' || $ws_footerOption == 'gradient' ) {
			$WPLessPlugin->addVariable('@footerBackground', $ws_footerBackground);
			$WPLessPlugin->addVariable('@footerPattern', 'none');
			$WPLessPlugin->addVariable('@footerRepeat', $ws_footerRepeat);
			$WPLessPlugin->addVariable('@footerAttach', $ws_footerAttach);
		}; 
		if ( $ws_footerOption == 'patternsheer' ) {
			$WPLessPlugin->addVariable('@footerBackground', $ws_footerBackground);
			$WPLessPlugin->addVariable('@footerPattern', $ws_footerPatternSheerURL);
			$WPLessPlugin->addVariable('@footerRepeat', $ws_footerRepeat);
			$WPLessPlugin->addVariable('@footerAttach', $ws_footerAttach);
		};
		if ( $ws_footerOption == 'patternopaque' ) {
			$WPLessPlugin->addVariable('@footerBackground', $ws_footerBackground);
			$WPLessPlugin->addVariable('@footerPattern', $ws_footerPatternOpaqueURL);
			$WPLessPlugin->addVariable('@footerRepeat', $ws_footerRepeat);
			$WPLessPlugin->addVariable('@footerAttach', $ws_footerAttach);
		};
	    	if ( $ws_footerOption == 'uploadsheer' || $ws_footerOption == 'uploadopaque' ) {
	    		$WPLessPlugin->addVariable('@footerBackground', $ws_footerBackground);
			$WPLessPlugin->addVariable('@footerPattern', $ws_footerUploadURL);
			$WPLessPlugin->addVariable('@footerRepeat', $ws_footerRepeat);
			$WPLessPlugin->addVariable('@footerAttach', $ws_footerAttach);
		};	
		
	$ws_footerContainer = of_get_option('ws_footercontainer');
		$WPLessPlugin->addVariable('@footerContainer', $ws_footerContainer);	
		
	$ws_footerBoxShadow = of_get_option('ws_footerboxshadow');	
	if ( $ws_footerBoxShadow == 'none' ) {
		$WPLessPlugin->addVariable('@footerBoxShadow', 'none');		
	}	
	if ( $ws_footerBoxShadow == 'shadow' ) {
		$WPLessPlugin->addVariable('@footerBoxShadow', '0 1px 5px 1px rgba(0,0,0,.15)');		
	}
	
	$ws_footerBorderRadiusTop = of_get_option('ws_footerborderradiustop');
		$WPLessPlugin->addVariable('@footerBorderRadiusTop', $ws_footerBorderRadiusTop);	
	$ws_footerBorderRadiusBtm = of_get_option('ws_footerborderradiusbtm');
		$WPLessPlugin->addVariable('@footerBorderRadiusBtm', $ws_footerBorderRadiusBtm);
		
	// Footer Typography
	$ws_footerColor = of_get_option('ws_footercolor');
		$WPLessPlugin->addVariable('@footerColor', $ws_footerColor);
	$ws_footerLinkColor = of_get_option('ws_footerlinkcolor');
		$WPLessPlugin->addVariable('@footerLinkColor', $ws_footerLinkColor);	
	$ws_footerHeadingsColor = of_get_option('ws_footerheadingscolor');
		$WPLessPlugin->addVariable('@footerHeadingsColor', $ws_footerHeadingsColor);	
		
		
// COLOPHON
	$ws_colophonOption = of_get_option('ws_colophonoption');
	$ws_colophonBackground = of_get_option('ws_colophonbackground');
	$ws_colophonBackgroundOpacity = of_get_option('ws_colophonbackgroundopacity');
	$ws_colophonPatternSheer = of_get_option('ws_colophonpatternsheer');
		$ws_colophonPatternSheerURL = "url('../../img/patterns-sheer/$ws_colophonPatternSheer')";
	$ws_colophonPatternOpaque = of_get_option('ws_colophonpatternopaque');
		$ws_colophonPatternOpaqueURL = "url('../../img/patterns-opaque/$ws_colophonPatternOpaque')";
	$ws_colophonUpload = of_get_option('ws_colophonupload');
		$ws_colophonUploadURL = "url('$ws_colophonUpload')";
	$ws_colophonRepeat = of_get_option('ws_colophonrepeat');
	$ws_colophonAttach = of_get_option('ws_colophonattach');
	
	$WPLessPlugin->addVariable('@colophonGradient', $ws_colophonBackground);
	
		if ( $ws_colophonOption == 'transparent' ) {
			$WPLessPlugin->addVariable('@colophonBackground', $ws_colophonBackground);
	    		$WPLessPlugin->addVariable('@colophonBackgroundOpacity', '0');
			$WPLessPlugin->addVariable('@colophonPattern', 'none');
			$WPLessPlugin->addVariable('@colophonRepeat', 'no-repeat');
			$WPLessPlugin->addVariable('@colophonAttach', $ws_colophonAttach);
		};
		if ( $ws_colophonOption == 'color' || $ws_colophonOption == 'gradient' ) {
			$WPLessPlugin->addVariable('@colophonBackground', $ws_colophonBackground);
			$WPLessPlugin->addVariable('@colophonBackgroundOpacity', $ws_colophonBackgroundOpacity);
			$WPLessPlugin->addVariable('@colophonPattern', 'none');
			$WPLessPlugin->addVariable('@colophonRepeat', $ws_colophonRepeat);
			$WPLessPlugin->addVariable('@colophonAttach', $ws_colophonAttach);
		}; 
		if ( $ws_colophonOption == 'patternsheer' ) {
			$WPLessPlugin->addVariable('@colophonBackground', $ws_colophonBackground);
			$WPLessPlugin->addVariable('@colophonBackgroundOpacity', $ws_colophonBackgroundOpacity);
			$WPLessPlugin->addVariable('@colophonPattern', $ws_colophonPatternSheerURL);
			$WPLessPlugin->addVariable('@colophonRepeat', $ws_colophonRepeat);
			$WPLessPlugin->addVariable('@colophonAttach', $ws_colophonAttach);
		};
		if ( $ws_colophonOption == 'patternopaque' ) {
			$WPLessPlugin->addVariable('@colophonBackground', $ws_colophonBackground);
			$WPLessPlugin->addVariable('@colophonBackgroundOpacity', $ws_colophonBackgroundOpacity);
			$WPLessPlugin->addVariable('@colophonPattern', $ws_colophonPatternOpaqueURL);
			$WPLessPlugin->addVariable('@colophonRepeat', $ws_colophonRepeat);
			$WPLessPlugin->addVariable('@colophonAttach', $ws_colophonAttach);
		};
	    	if ( $ws_colophonOption == 'uploadsheer' || $ws_colophonOption == 'uploadopaque' ) {
	    		$WPLessPlugin->addVariable('@colophonBackground', $ws_colophonBackground);
	    		$WPLessPlugin->addVariable('@colophonBackgroundOpacity', $ws_colophonBackgroundOpacity);
			$WPLessPlugin->addVariable('@colophonPattern', $ws_colophonUploadURL);
			$WPLessPlugin->addVariable('@colophonRepeat', $ws_colophonRepeat);
			$WPLessPlugin->addVariable('@colophonAttach', $ws_colophonAttach);
		};
		if ( $ws_colophonOption == 'auto' && $ws_footerOption != 'transparent' && $ws_footerOption != 'uploadopaque' && $ws_footerOption != 'patternopaque' ) {
	    		$WPLessPlugin->addVariable('@colophonBackground', 'darken(@footerBackground, 20%)');
	    		$WPLessPlugin->addVariable('@colophonBackgroundOpacity', $ws_colophonBackgroundOpacity);
			$WPLessPlugin->addVariable('@colophonPattern', 'none');
			$WPLessPlugin->addVariable('@colophonRepeat', 'no-repeat');
			$WPLessPlugin->addVariable('@colophonAttach', $ws_colophonAttach);
		};
		if ( $ws_colophonOption == 'auto' && $ws_footerOption == 'patternopaque' || $ws_footerOption == 'uploadopaque' ) {
	    		$WPLessPlugin->addVariable('@colophonBackground', $ws_colophonBackground);
	    		$WPLessPlugin->addVariable('@colophonBackgroundOpacity', $ws_colophonBackgroundOpacity);
			$WPLessPlugin->addVariable('@colophonPattern', 'none');
			$WPLessPlugin->addVariable('@colophonRepeat', 'no-repeat');
			$WPLessPlugin->addVariable('@colophonAttach', $ws_colophonAttach);
		};	
		if ( $ws_colophonOption == 'auto' && $ws_footerOption == 'transparent' ) {
	    		$WPLessPlugin->addVariable('@colophonBackground', $ws_colophonBackground);
	    		$WPLessPlugin->addVariable('@colophonBackgroundOpacity', '0');
			$WPLessPlugin->addVariable('@colophonPattern', 'none');
			$WPLessPlugin->addVariable('@colophonRepeat', 'no-repeat');
			$WPLessPlugin->addVariable('@colophonAttach', $ws_colophonAttach);
		};		
		
		
	$ws_colophonContainer = of_get_option('ws_colophoncontainer');
		$WPLessPlugin->addVariable('@colophonContainer', $ws_colophonContainer);	
		
	$ws_colophonBoxShadow = of_get_option('ws_colophonboxshadow');	
	if ( $ws_colophonBoxShadow == 'none' ) {
		$WPLessPlugin->addVariable('@colophonBoxShadow', 'none');		
	}	
	if ( $ws_colophonBoxShadow == 'shadow' ) {
		$WPLessPlugin->addVariable('@colophonBoxShadow', '0 1px 5px 1px rgba(0,0,0,.15)');		
	}
	
	$ws_colophonBorderRadiusTop = of_get_option('ws_colophonborderradiustop');
		$WPLessPlugin->addVariable('@colophonBorderRadiusTop', $ws_colophonBorderRadiusTop);	
	$ws_colophonBorderRadiusBtm = of_get_option('ws_colophonborderradiusbtm');
		$WPLessPlugin->addVariable('@colophonBorderRadiusBtm', $ws_colophonBorderRadiusBtm);
	$ws_colophonPaddingTop = of_get_option('ws_colophonpaddingtop');
		$WPLessPlugin->addVariable('@colophonPaddingTop', $ws_colophonPaddingTop);	
	$ws_colophonPaddingBtm = of_get_option('ws_colophonpaddingbtm');
		$WPLessPlugin->addVariable('@colophonPaddingBtm', $ws_colophonPaddingBtm);
	$ws_colophonMarginTop = of_get_option('ws_colophonmargintop');
		$WPLessPlugin->addVariable('@colophonMarginTop', $ws_colophonMarginTop);		
	$ws_colophonMarginBtm = of_get_option('ws_colophonmarginbtm');
		$WPLessPlugin->addVariable('@colophonMarginBtm', $ws_colophonMarginBtm);	
		
	// Colophon Typography
	$ws_colophonColor = of_get_option('ws_colophoncolor');
		$WPLessPlugin->addVariable('@colophonColor', $ws_colophonColor);
	$ws_colophonLinkColor = of_get_option('ws_colophonlinkcolor');
		$WPLessPlugin->addVariable('@colophonLinkColor', $ws_colophonLinkColor);
										
	
/* Enqueue the LESS files */	

	// wp_enqueue_style('ws_less_bootstrap_custom', '/wordstrap/assets/css/less/ws.bootstrap.less', array(), '1.0', 'screen,projection');
	// wp_enqueue_style('ws_less_responsive_custom', '/wordstrap/assets/css/less/ws.responsive.less', array(), '1.0', 'screen,projection');
	
	if (is_child_theme()) {
		wp_enqueue_style('ws_less_framework', '/'.$theme_name.'/assets/css/less/ws.framework.less', array(), '1.0', 'screen,projection');
		wp_enqueue_style('ws_less_app_custom', '/'.$theme_name.'/assets/css/less/ws.app.less', array(), '1.0', 'screen,projection');
	}
	if (!is_child_theme()) {
		wp_enqueue_style('ws_less_framework', '/wordstrap/assets/css/less/ws.framework.less', array(), '1.0', 'screen,projection');
		wp_enqueue_style('ws_less_app_custom', '/wordstrap/assets/css/less/ws.app.less', array(), '1.0', 'screen,projection');
	}	

add_action('wp_print_styles', array($WPLessPlugin, 'processStylesheets'));
	
}

?>