<?php
/**
 * Setup all core theme options of framework, which can 
 * then be altered at the theme level.
 *
 * @uses $_wordstrap_options 
 * @since 2.1.0
 *
 * Layout
 *	- Header
 *		- logo
 *	- Main
 *		- breadcrumbs
 *		- sidebar_layout
 *	- Footer
 *		- start_footer_cols
 *		- footer_setup
 *		- footer_col_1
 *		- footer_col_2
 *		- footer_col_3
 *		- footer_col_4
 *		- footer_col_5
 *		- end_footer_cols
 *		- footer_copyright
 * Content
 *	- Homepage
 *		- homepage_content
 *		- homepage_custom_layout
 *	- Single Posts
 *		- single_meta
 *		- single_thumbs
 *		- single_comments
 *	- Primary Posts Display
 *		- blog_thumbs
 *		- blog_content
 *		- blog_categories
 *		- start_featured
 *		- blog_featured
 *		- blog_slider
 *		- end_featured
 *	- Archives
 *		- archive_title
 *		- archive_thumbs
 *		- archive_content
 * Configuration
 *	- Responsiveness
 *		- responsive_css
 *		- mobile_nav
 *	- Analytics
 *		- analytics
 */

if( ! function_exists( 'wordstrap_get_core_options' ) ) {
	function wordstrap_get_core_options() {
		
		/*-------------------------------------------------------*/
		/* Setup Helper Items
		/*-------------------------------------------------------*/
		
		// If using image radio buttons, define a directory path
		$imagepath =  get_template_directory_uri() . '/framework/admin/assets/images/';
	
		// Generate sidebar layout options
		$sidebar_layouts = array();
		$layouts = wordstrap_sidebar_layouts();
		foreach( $layouts as $layout )
			$sidebar_layouts[$layout['id']] = $imagepath.'layout-'.$layout['id'].'.png';
		
		// Generate sliders options
		$custom_sliders = array();
		$sliders = get_posts('post_type=ws_slider&numberposts=-1');
		if( ! empty( $sliders ) ) {
			foreach( $sliders as $slider )
				$custom_sliders[$slider->post_name] = $slider->post_title;
		} else {
			$custom_sliders['null'] = __( 'You haven\'t created any custom sliders yet.', WS_GETTEXT_DOMAIN );
		}		
		
		// Pull all the categories into an array
		$options_categories = array();  
		$options_categories_obj = get_categories();
		foreach ($options_categories_obj as $category) {
	    	$options_categories[$category->cat_ID] = $category->cat_name;
		}
		
		// Custom Layouts
		$custom_layouts = array();
		$custom_layout_posts = get_posts('post_type=ws_layout&numberposts=-1');
		if( ! empty( $custom_layout_posts ) ) {
			foreach( $custom_layout_posts as $layout )
				$custom_layouts[$layout->post_name] = $layout->post_title;
		} else {
			$custom_layouts['null'] = __( 'You haven\'t created any custom layouts yet.', WS_GETTEXT_DOMAIN );
		}
	
		/*-------------------------------------------------------*/
		/* Layout
		/*-------------------------------------------------------*/
		
		$layout_options = array(
			// Section: Header
			'header' => array(
				'name' => __( 'Header', WS_GETTEXT_DOMAIN ),
				'options' => array(	
					'logo' => array( 
						'name' 		=> __( 'Logo', WS_GETTEXT_DOMAIN ),
						'desc' 		=> __( 'Configure the primary branding logo for the header of your site.', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'logo',
						'std' 		=> array( 'type' => 'image', 'image' => get_template_directory_uri().'/assets/images/logo.png' ),
						'type' 		=> 'logo'
					)
				) // End header options
			),
			// Section: Main
			'main' => array(
				'name' => __( 'Main', WS_GETTEXT_DOMAIN ),
				'options' => array(	
					'breadcrumbs' => array(	
						'name' 		=> __( 'Breadcrumbs', WS_GETTEXT_DOMAIN ),
						'desc'		=> __( 'Select whether you\'d like breadcrumbs to show throughout the site or not.', WS_GETTEXT_DOMAIN ),
						'id'		=> 'breadcrumbs',
						'std'		=> 'show',
						'type' 		=> 'select',
						'options'	=> array(
							'show' => __( 'Yes, show breadcrumbs.', WS_GETTEXT_DOMAIN ),
							'hide' => __( 'No, hide breadcrumbs.', WS_GETTEXT_DOMAIN )
						)
					),
					'sidebar_layout' => array( 
						'name' 		=> __( 'Default Sidebar Layout', WS_GETTEXT_DOMAIN ),
						'desc' 		=> __( 'Choose the default sidebar layout for the main content area of your site.<br><br><em>Note: This will be the default sidebar layout throughout your site, but you can be override this setting for any specific page or custom layout.</em>', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'sidebar_layout',
						'std' 		=> 'sidebar_right',
						'type' 		=> 'images',
						'options' 	=> $sidebar_layouts
					)
				) // End main options
			),
			// Section: Footer
			'footer' => array(
				'name' => __( 'Footer', WS_GETTEXT_DOMAIN ),
				'options' => array(	
					'start_footer_cols' => array( 
						'type'		=> 'subgroup_start',
						'class'		=> 'columns'
					),
					'footer_setup' => array( 
						'name'		=> __( 'Setup Columns', WS_GETTEXT_DOMAIN ),
						'desc'		=> __( 'Choose the number of columns along with the corresponding width configurations.', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'footer_setup',
						'type'		=> 'columns',
						'options'	=> 'standard'
					),
					'footer_col_1' => array( 
						'name'		=> __( 'Footer Column #1', WS_GETTEXT_DOMAIN ),
						'desc'		=> __( 'Configure the content for the first column.', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'footer_col_1',
						'type'		=> 'content',
						'class'		=> 'col_1',
						'options'	=> array( 'widget', 'page', 'raw' )
					),
					'footer_col_2' => array( 
						'name'		=> __( 'Footer Column #2', WS_GETTEXT_DOMAIN ),
						'desc'		=> __( 'Configure the content for the second column.', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'footer_col_2',
						'type'		=> 'content',
						'class'		=> 'col_2',
						'options'	=> array( 'widget', 'page', 'raw' )
					),
					'footer_col_3' => array( 
						'name'		=> __( 'Footer Column #3', WS_GETTEXT_DOMAIN ),
						'desc'		=> __( 'Configure the content for the third column.', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'footer_col_3',
						'type'		=> 'content',
						'class'		=> 'col_3',
						'options'	=> array( 'widget', 'page', 'raw' )
					),
					'footer_col_4' => array( 
						'name'		=> __( 'Footer Column #4', WS_GETTEXT_DOMAIN ),
						'desc'		=> __( 'Configure the content for the fourth column.', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'footer_col_4',
						'type'		=> 'content',
						'class'		=> 'col_4',
						'options'	=> array( 'widget', 'page', 'raw' )
					),
					'footer_col_5' => array( 
						'name'		=> __( 'Footer Column #5', WS_GETTEXT_DOMAIN ),
						'desc'		=> __( 'Configure the content for the fifth column.', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'footer_col_5',
						'type'		=> 'content',
						'class'		=> 'col_5',
						'options'	=> array( 'widget', 'page', 'raw' ) 
					),
					'end_footer_cols' => array( 
						'type'		=> 'subgroup_end'
					),
					'footer_copyright' => array(
						'name' 		=> __( 'Footer Copyright Text', WS_GETTEXT_DOMAIN ),
						'desc' 		=> __( 'Enter the copyright text you\'d like to show in the footer of your site.', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'footer_copyright',
						'std' 		=> '(c) '.date('Y').' '.get_bloginfo('site_title').' - Web Design by <a href="http://www.jloft.com" target="_blank">Jason Loftis</a>',
						'type' 		=> 'text'
					)	
				) // End footer options
			)
		);
		
		/*-------------------------------------------------------*/
		/* Content
		/*-------------------------------------------------------*/
		
		$content_options = array(
			// Section: Homepage
			'homepage' => array(
				'name' => __( 'Homepage', WS_GETTEXT_DOMAIN ),
				'options' => array(	
					'homepage_content' => array( 
						'name' 		=> __( 'Homepage Content', WS_GETTEXT_DOMAIN ),
						'desc' 		=> __( 'Select the content you\'d like to show on your homepage. Note that for this setting to take effect, you must go to Settings > Reading > Frontpage displays, and select "your latest posts."', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'homepage_content',
						'std' 		=> 'posts',
						'type' 		=> 'radio',
						'options' 	=> array(
							'posts'			=> __( 'Posts', WS_GETTEXT_DOMAIN ),
							'custom_layout' => __( 'Custom Layout', WS_GETTEXT_DOMAIN )
						)
					),
					'homepage_custom_layout' => array( 
						'name' 		=> __( 'Select Custom Layout', WS_GETTEXT_DOMAIN ),
						'desc' 		=> __( 'Select from the custom layouts you\'ve built under the <a href="admin.php?page=builder_ws">Builder</a> section.', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'homepage_custom_layout',
						'std' 		=> '',
						'type' 		=> 'select',
						'options' 	=> $custom_layouts
					)
				) // End home options
			),
			// Section: Single Posts
			'single' => array(
				'name' => __( 'Single Posts', WS_GETTEXT_DOMAIN ),
				'desc' => __( 'These settings will only apply to vewing single posts. This means that any settings you set here will <strong>not</strong> effect any posts that appear in a post list or post grid.', WS_GETTEXT_DOMAIN ),
				'options' => array(	
					'single_meta' => array( 
						'name' 		=> __( 'Show meta information at top of posts?', WS_GETTEXT_DOMAIN ),
						'desc' 		=> __( 'Select if you\'d like the meta information (date posted, author, etc) to show at the top of the post. If you\'re going for a portfolio-type setup, you may want to hide the meta info.', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'single_meta',
						'std' 		=> 'show',
						'type' 		=> 'radio',
						'options' 	=> array(
							'show'		=> __( 'Show meta info.', WS_GETTEXT_DOMAIN ),
							'hide' 		=> __( 'Hide meta info.', WS_GETTEXT_DOMAIN )
						) 
					),			
					'single_thumbs' => array( 
						'name' 		=> __( 'Show featured images at top of posts?', WS_GETTEXT_DOMAIN ),
						'desc' 		=> __( 'Choose how you want your featured images to show at the top of the posts. It can be useful to turn this off if you want to have featured images over on your blogroll or post grid sections, but you don\'t want them to show on the actual posts themeselves.', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'single_thumbs',
						'std' 		=> 'small',
						'type' 		=> 'radio',
						'options' 	=> array(
							'small'		=> __( 'Show small thumbnails.', WS_GETTEXT_DOMAIN ),
							'full' 		=> __( 'Show full-width thumbnails.', WS_GETTEXT_DOMAIN ),
							'hide' 		=> __( 'Hide thumbnails.', WS_GETTEXT_DOMAIN )
						)
					),		
					'single_comments' => array( 
						'name' 		=> __( 'Show comments below posts?', WS_GETTEXT_DOMAIN ),
						'desc' 		=> __( 'Select if you\'d like to completely hide comments or not below the post.', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'single_comments',
						'std' 		=> 'show',
						'type' 		=> 'radio',
						'options' 	=> array(
							'show'		=> __( 'Show comments.', WS_GETTEXT_DOMAIN ),
							'hide' 		=> __( 'Hide comments.', WS_GETTEXT_DOMAIN )
						)
					)
				) // End single options
			),
			// Section: Primary Posts Display
			'blog' => array(
				'name' => __( 'Primary Posts Display', WS_GETTEXT_DOMAIN ),
				'desc' => __( 'These settings apply to your primary posts page that you\'ve selected under Settings > Reading and <strong>all</strong> instances of the "Post List" page template. Note that if you want to use the post list page template for multiple pages with different categories on each, you can accomplish this on each specific page with custom fields - <a href="http://vimeo.com/32754998">Learn More</a>.', WS_GETTEXT_DOMAIN ),
				'options' => array(	
					'blog_thumbs' => array( 
						'name' 		=> __( 'Featured Images', WS_GETTEXT_DOMAIN ),
						'desc' 		=> __( 'Select the size of the blog\'s post thumbnail or whether you\'d like to hide them all together when posts are listed.', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'blog_thumbs',
						'std' 		=> 'small',
						'type' 		=> 'radio',
						'options' 	=> array(
							'small'		=> __( 'Show small thumbnails.', WS_GETTEXT_DOMAIN ),
							'full' 		=> __( 'Show full-width thumbnails.', WS_GETTEXT_DOMAIN ),
							'hide' 		=> __( 'Hide thumbnails.', WS_GETTEXT_DOMAIN )
						)
					),
					'blog_content' => array( 
						'name' 		=> __( 'Show excerpts or full content?', WS_GETTEXT_DOMAIN ),
						'desc' 		=> __( 'Choose whether you want to show full content or post excerpts only.<br><br><em>Note: Because this theme uses post formats, this option will not apply to all post formats.</em>', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'blog_content',
						'std' 		=> 'content',
						'type' 		=> 'radio',
						'options' 	=> array(
							'content'	=> __( 'Show full content.', WS_GETTEXT_DOMAIN ),
							'excerpt' 	=> __( 'Show excerpt only.', WS_GETTEXT_DOMAIN )
						)
					),
					'blog_categories' => array( 
						'name' 		=> __( 'Exclude Categories', WS_GETTEXT_DOMAIN ),
						'desc' 		=> __( 'Select any categories you\'d like to be excluded from your blog.', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'blog_categories',
						'type' 		=> 'multicheck',
						'options' 	=> $options_categories
					),			
					'start_featured' => array( 
						'type'		=> 'subgroup_start',
				    	'class'		=> 'show-hide'
				    ),
					'blog_featured' => array( 
						'name'		=> __( 'Featured Area', WS_GETTEXT_DOMAIN ),
						'desc'		=> __( 'Show slider above blog?', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'blog_featured',
						'type'		=> 'checkbox',
						'class'		=> 'trigger'
					),
											
					'blog_slider' => array( 
						'name'		=> __( 'Featured Slider', WS_GETTEXT_DOMAIN ),
						'desc'		=> __( 'Select a slider from you custom-made sliders. Sliders are created <a href="admin.php?page=slider_ws" target="_blank">here</a>.', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'blog_slider',
						'type'		=> 'select',
						'options'	=> $custom_sliders,
						'class'		=> 'hide receiver'
					),	
					'end_featured' => array( 
						'type'		=> 'subgroup_end'
					)
				) // End blog options
			),
			// Section: Archives
			'archives' => array(
				'name' => __( 'Archives', WS_GETTEXT_DOMAIN ),
				'desc' => __( 'These settings apply any time you\'re viewing search results or posts specific to a category, tag, date, author, etc.', WS_GETTEXT_DOMAIN ),
				'options' => array(		
					'archive_title' => array( 
						'name' 		=> __( 'Show title on archive pages?', WS_GETTEXT_DOMAIN ),
						'desc' 		=> __( 'Choose whether or not you want the title to show on tag archives, category archives, date archives, author archives and search result pages.', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'archive_title',
						'std' 		=> 'false',
						'type' 		=> 'radio',
						'options' 	=> array(
							'true'	=> __( 'Yes, show main title at the top of archive pages.', WS_GETTEXT_DOMAIN ),
							'false' => __( 'No, hide the title.', WS_GETTEXT_DOMAIN )
						)
					),
					'archive_thumbs' => array( 
						'name' 		=> __( 'Show featured images on archive pages?', WS_GETTEXT_DOMAIN ),
						'desc' 		=> __( 'Choose whether or not you want featured images to show on tag archives, category archives, date archives, author archives and search result pages.', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'archive_thumbs',
						'std' 		=> 'small',
						'type' 		=> 'radio',
						'options' 	=> array(
							'small'		=> __( 'Show small thumbnails.', WS_GETTEXT_DOMAIN ),
							'full' 		=> __( 'Show full-width thumbnails.', WS_GETTEXT_DOMAIN ),
							'hide' 		=> __( 'Hide thumbnails.', WS_GETTEXT_DOMAIN )
						)
					),
					'archive_content' => array( 
						'name' 		=> __( 'Show excerpts or full content?', WS_GETTEXT_DOMAIN ),
						'desc' 		=> __( 'Choose whether you want to show full content or post excerpts only.', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'archive_content',
						'std' 		=> 'excerpt',
						'type' 		=> 'radio',
						'options' 	=> array(
							'content'	=> __( 'Show full content.', WS_GETTEXT_DOMAIN ),
							'excerpt' 	=> __( 'Show excerpt only.', WS_GETTEXT_DOMAIN )
						)
					)
				) // End archives options
			)
		);
		
		/*-------------------------------------------------------*/
		/* Configuration
		/*-------------------------------------------------------*/
		
		$config_options = array(
			// Section: Responsiveness
			'responsiveness' => array(
				'name' => __( 'Responsiveness', WS_GETTEXT_DOMAIN ),
				'options' => array(		
					'responsive_css' => array( 
						'name' 		=> __( 'Tablets and Mobile Devices', WS_GETTEXT_DOMAIN ),	
						'desc' 		=> __( 'This theme comes with a special stylesheet that will target the screen resolution of your website vistors and show them a slightly modified design if their screen resolution matches common sizes for a tablet or a mobile device.', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'responsive_css',
						'std' 		=> 'true',
						'type' 		=> 'radio',
						'options' 	=> array(
							'true'		=> __( 'Yes, apply special styles to tablets and mobile devices.', WS_GETTEXT_DOMAIN ),
							'false' 	=> __( 'No, allow website to show normally on tablets and mobile devices.', WS_GETTEXT_DOMAIN )
						)
					),
					'mobile_nav' => array( 
						'name' 		=> __( 'Mobile Navigation', WS_GETTEXT_DOMAIN ),	
						'desc' 		=> __( 'Select how you\'d like the <em>Primary Navigation</em> displayed on mobile devices. While the graphic navigation may be more visually appealing, if your navigation is more complex with many dropdown items, you possibly could be providing a better user experience to mobile users by having the navigation converted into a simple select menu.', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'mobile_nav',
						'std' 		=> 'mobile_nav_graphic',
						'type' 		=> 'radio',
						'options' 	=> array(
							'mobile_nav_graphic'	=> __( 'Display graphic navigation.', WS_GETTEXT_DOMAIN ),
							'mobile_nav_select' 	=> __( 'Display simple select menu.', WS_GETTEXT_DOMAIN )
						)
					)
				) // End Responsiveness options
			),
			// Section: Analytics
			'analytics' => array(
				'name' => __( 'Analytics', WS_GETTEXT_DOMAIN ),
				'options' => array(		
					'analytics' => array( 
						'name' 		=> __( 'Analytics Code', WS_GETTEXT_DOMAIN ),	
						'desc' 		=> __( 'Paste in the code provided by your Analytics service.<br><br>If you\'re looking for a free analytics service, definitely check out <a href="http://www.google.com/analytics/">Google Analytics</a>.', WS_GETTEXT_DOMAIN ),
						'id' 		=> 'analytics',
						'type' 		=> 'textarea'
					)
				) // End archives options
			)	
		);
	
		/*-------------------------------------------------------*/
		/* Finalize
		/*-------------------------------------------------------*/
		
		$options = array(
			'layout' 	=> array( 
				'name' 		=> __( 'Layout', WS_GETTEXT_DOMAIN ),
				'sections' 	=> $layout_options
			),
			'content' 	=> array( 
				'name' 		=> __( 'Content', WS_GETTEXT_DOMAIN ),
				'sections' 	=> $content_options
			),
			'config' 	=> array( 
				'name' 		=> __( 'Configuration', WS_GETTEXT_DOMAIN ),
				'sections' 	=> $config_options
			)
		);
		return apply_filters( 'wordstrap_core_options', $options );
	}
}

/**
 * This sets up the global theme options after 
 * the theme level has had a chance to make 
 * modifications, as well as formatting properly 
 * to go into the Options Framework. It gets hooked 
 * in at  after_theme_setup but w/priority 1000.
 *
 * @uses $_wordstrap_options
 * @uses $_wordstrap_core_options 
 * @since 2.1.0
 */

if( ! function_exists( 'wordstrap_format_options' ) ) {
	function wordstrap_format_options() {
		global $_wordstrap_core_options;
		global $_wordstrap_options;
		$_wordstrap_options = array();
		// Tab Level
		foreach( $_wordstrap_core_options as $tab_id => $tab ) {	
			// Insert Tab Heading
			$_wordstrap_options['tab_'.$tab_id] = array(
				'name' => $tab['name'],
				'type' => 'heading'
			);
			// Section Level
			if( $tab['sections'] ) {
				foreach( $tab['sections'] as $section_id => $section ) {
					// Start section
					$_wordstrap_options['start_section_'.$section_id] = array( 
						'name' => $section['name'],		
						'type' => 'section_start'
					);
					if( isset( $section['desc'] ) ) {
						$_wordstrap_options['start_section_'.$section_id]['desc'] = $section['desc'];
					}
					// Options Level
					if( $section['options'] ) {
						foreach( $section['options'] as $option_id => $option ) {
							$_wordstrap_options[$option_id] = $option;
						}
					}
					// End section
					$_wordstrap_options['end_section_'.$section_id] = array( 	
						'type' => 'section_end'
					);
				}
			}
		}
		// Apply filters
		$_wordstrap_options = apply_filters( 'wordstrap_formatted_options', $_wordstrap_options );
	}
}

/**
 * This retrieves the theme options based on the 
 * global $_wordstrap_options array created in 
 * wordstrap_format_options()
 *
 * @uses $_wordstrap_options 
 * @since 2.1.0
 */

if( ! function_exists( 'wordstrap_get_formatted_options' ) ) {
	function wordstrap_get_formatted_options() {
		global $_wordstrap_options;
		return apply_filters( 'wordstrap_formatted_options', $_wordstrap_options );
	}
}

/**
 * Get theme option
 *
 * @since 2.0.0
 * @uses $_wordstrap_theme_settings
 *
 * @param string $primary The primary ID of the option
 * @param string $secondary This would be the option ID only if we're grabbing it from a multi-dimensional array
 * @param string $default Default option to be used, and if not set, we'll pull from options array
 */

if( ! function_exists( 'wordstrap_get_option' ) ) {
	function wordstrap_get_option( $primary, $seconday = null, $default = null ) {
		global $_wordstrap_theme_settings; // We pull from a global array, so we're not using WordPress's get_option every single time.
		$options = $_wordstrap_theme_settings;
		if( isset( $options[$primary] ) ) {
			if( $seconday ) {
				if( is_array( $options[$primary] ) && isset( $options[$primary][$seconday] ) )
					$option = $options[$primary][$seconday];
			} else {
				$option = $options[$primary];
			}
		}
		if( ! isset( $option ) ) {
			if( $default ) {
				$option = $default;
			} else {
				$default_options = of_get_default_values();
				if( isset( $default_options[$primary] ) ) {
					if( $seconday ) {
						if( is_array( $default_options[$primary] ) && isset( $default_options[$primary][$seconday] ) )
							$option = $default_options[$primary][$seconday];
					} else {
						$option = $default_options[$primary];
					}
				}
			}
		}
		if( ! isset( $option ) ) $option = null;
		return $option;
	}
}

/**
 * Add theme option tab.
 *
 * @since 2.1.0
 *
 * @param string $tab_id ID of tab to add
 * @param string $tab_name Name of the tab to add
 * @param boolean $top Whether the tab should be added to the start or not
 */

if( ! function_exists( 'wordstrap_add_option_tab' ) ) {
	function wordstrap_add_option_tab( $tab_id, $tab_name, $top = false ) {
		global $_wordstrap_core_options;
		
		if( $top ) {
			// Add tab to the top of array 
			$new_options = array();
			$new_options[$tab_id] = array( 
				'name' 		=> $tab_name,
				'sections' 	=> array()
			);
			$_wordstrap_core_options = array_merge( $new_options, $_wordstrap_core_options );			
		} else {
			// Add tab to the end of global array
			$_wordstrap_core_options[$tab_id] = array( 
				'name' 		=> $tab_name,
				'sections' 	=> array()
			);
		}
	}
}

/**
 * Remove theme option tab.
 *
 * @since 2.1.0
 *
 * @param string $tab_id ID of tab to add
 */

if( ! function_exists( 'wordstrap_remove_option_tab' ) ) {
	function wordstrap_remove_option_tab( $tab_id ) {
		global $_wordstrap_core_options;
		unset( $_wordstrap_core_options[$tab_id] );
	}
}

/**
 * Add theme option section.
 *
 * @since 2.1.0
 *
 * @param string $tab_id ID of tab section will be located in
 * @param string $section_id ID of new section
 * @param string $section_name Name of new section
 * @param string $section_desc Description of new section
 * @param array $options Options array formatted for Options Framework
 * @param boolean $top Whether the option should be added to the top or not
 */

if( ! function_exists( 'wordstrap_add_option_section' ) ) {
	function wordstrap_add_option_section( $tab_id, $section_id, $section_name, $section_desc = null, $options = null, $top = false ) {
		global $_wordstrap_core_options;
		
		// Make sure tab exists
		if( ! isset( $_wordstrap_core_options[$tab_id] ) )
			return;
		
		// Format options array
		$new_options = array();
		if( $options ) {
			foreach( $options as $option ) {
				if( isset( $option['id'] ) ) {
					$new_options[$option['id']] = $option;
				}
			}
		}
		
		// Add new section to top or bottom
		if( $top ) {
			$previous_sections = $_wordstrap_core_options[$tab_id]['sections'];
			$_wordstrap_core_options[$tab_id]['sections'] = array(
				$section_id => array(
					'name' => $section_name,
					'desc' => $section_desc,
					'options' => $new_options
				)
			);
			$_wordstrap_core_options[$tab_id]['sections'] = array_merge( $_wordstrap_core_options[$tab_id]['sections'], $previous_sections );
		} else {
			$_wordstrap_core_options[$tab_id]['sections'][$section_id] = array(
				'name' => $section_name,
				'desc' => $section_desc,
				'options' => $new_options
			);
		}
	}
}

/**
 * Remove theme option section.
 *
 * @since 2.1.0
 *
 * @param string $tab_id ID of tab that section to remove belongs to
 * @param string $section_id ID of section to remove
 */

if( ! function_exists( 'wordstrap_remove_option_section' ) ) {
	function wordstrap_remove_option_section( $tab_id, $section_id ) {
		global $_wordstrap_core_options;
		unset( $_wordstrap_core_options[$tab_id]['sections'][$section_id] );
	}
}

/**
 * Add theme option.
 *
 * @since 2.1.0
 *
 * @param string $tab_id ID of tab to add option to
 * @param string $section_id ID of section to add to
 * @param array $option attributes for option, formatted for Options Framework
 * @param string $option_id ID of of your option, note that this id must also be present in $option array
 */

if( ! function_exists( 'wordstrap_add_option' ) ) {
	function wordstrap_add_option( $tab_id, $section_id, $option_id, $option ) {
		global $_wordstrap_core_options;
		if( isset( $_wordstrap_core_options[$tab_id] ) )
			if( isset( $_wordstrap_core_options[$tab_id]['sections'][$section_id] ) )
				$_wordstrap_core_options[$tab_id]['sections'][$section_id]['options'][$option_id] = $option;
	}
}

/**
 * Remove theme option.
 *
 * @since 2.1.0
 *
 * @param string $tab_id ID of tab to add option to
 * @param string $section_id ID of section to add to
 * @param string $option_id ID of of your option
 */
 
if( ! function_exists( 'wordstrap_remove_option' ) ) {
	function wordstrap_remove_option( $tab_id, $section_id, $option_id ) {
		global $_wordstrap_core_options;
		if( isset( $_wordstrap_core_options[$tab_id] ) ) {
			if( isset( $_wordstrap_core_options[$tab_id]['sections'][$section_id] ) ) {
				if( isset( $_wordstrap_core_options[$tab_id]['sections'][$section_id]['options'][$option_id] ) ) {
					// If option has element's ID as key, we can find and 
					// remove it faster.
					unset( $_wordstrap_core_options[$tab_id]['sections'][$section_id]['options'][$option_id] );
				} else {
					// If this is an option added by a child theme or plugin, 
					// and it doesn't have the element's ID as the key, this 
					// is how we can remove it.
					foreach( $_wordstrap_core_options[$tab_id]['sections'][$section_id]['options'] as $key => $value ) {
						if( $value['id'] == $option_id ) {
							unset( $_wordstrap_core_options[$tab_id]['sections'][$section_id]['options'][$key] );
						}
					}
				}
			}
		}
	}
}

/**
 * Remove theme option.
 *
 * @since 2.1.0
 *
 * @param string $tab_id ID of tab to add option to
 * @param string $section_id ID of section to add to
 * @param string $option_id ID of of your option
 * @param string $att Attribute of option to change
 * @param string $value New value for attribute
 */
 
if( ! function_exists( 'wordstrap_edit_option' ) ) {
	function wordstrap_edit_option( $tab_id, $section_id, $option_id, $att, $value ) {
		global $_wordstrap_core_options;
		if( isset( $_wordstrap_core_options[$tab_id] ) )
			if( isset( $_wordstrap_core_options[$tab_id]['sections'][$section_id] ) )
				if( isset( $_wordstrap_core_options[$tab_id]['sections'][$section_id]['options'][$option_id] ) )
					$_wordstrap_core_options[$tab_id]['sections'][$section_id]['options'][$option_id][$att] = $value;
	}
}

/**
 * For each theme, we use a unique identifier to store 
 * the theme's options in the database based on the current 
 * name of the theme. This is can be filtered with 
 * "wordstrap_option_id".
 *
 * @since 2.1.0
 */

if( ! function_exists( 'wordstrap_get_option_name' ) ) {
	function wordstrap_get_option_name() {
	
		// This gets the theme name from the stylesheet (lowercase and without spaces)
		if( function_exists( 'wp_get_theme' ) ) {
			// Use wp_get_theme for WP 3.4+
			$theme_data = wp_get_theme( get_stylesheet() );
			$themename = preg_replace('/\W/', '', strtolower( $theme_data->get('Name') ) );
		} else {
			// Deprecated theme data retrieval
			$themename = get_theme_data( get_stylesheet_directory() . '/style.css');
			$themename = $themename['Name'];
			$themename = preg_replace('/\W/', '', strtolower( $themename ) );
		}
		
		// This is what ID the options will be saved under in the database. 
		// By default, it's generated from the current installed theme. 
		// So that means if you activate a child theme, you'll then need 
		// re-configure theme options.
		return apply_filters( 'wordstrap_option_id', $themename );
	}
}