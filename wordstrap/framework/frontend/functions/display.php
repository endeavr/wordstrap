<?php
/*-----------------------------------------------------------------------------------*/
/* <head>
/*-----------------------------------------------------------------------------------*/

/**
 * Display <head>
 * Default display for action: wordstrap_head
 *
 * @since 2.1.0
 */

if( ! function_exists( 'wordstrap_head_default' ) ) {
	function wordstrap_head_default() {
		
		// Charset meta
		echo '<meta charset="'.get_bloginfo( 'charset' ).'" />'."\n";
		
		// Viewport meta
		if( wordstrap_get_option( 'responsive_css', null, 'true' ) != 'false' )
			echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">'."\n";
		
		// <title> tag
		echo '<title>';
		wordstrap_title();
		echo "</title>\n";
		
		// XFN
		echo '<link rel="profile" href="http://gmpg.org/xfn/11" />'."\n";
		
		// Theme style.css
		echo '<link rel="stylesheet" type="text/css" media="all" href="'.get_bloginfo( 'stylesheet_url' ).'" />'."\n";
		
		// Pingback
		echo '<link rel="pingback" href="'.get_bloginfo( 'pingback_url' ).'" />'."\n";
		
		// HTML5 for old IE browsers
		echo "<!--[if lt IE 9]>\n";
		echo '<script src="'.get_template_directory_uri().'/framework/frontend/assets/js/html5.js" type="text/javascript"></script>';
		echo "<![endif]-->\n";
		
		// Comment reply JS
		if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
		
		// Standard WP head hook
		wp_head();
	}
}


/**
 * Display <title>
 * Default display for action: wordstrap_title
 *
 * @since 2.0.0
 */

if( ! function_exists( 'wordstrap_title_default' ) ) {
	function wordstrap_title_default() {
		global $page, $paged;
		wp_title( '|', true, 'right' );
		// Add the blog name.
		bloginfo( 'name' );
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( wordstrap_get_local( 'page_num' ), max( $paged, $page ) );
	}
}

/*-----------------------------------------------------------------------------------*/
/* Header
/*-----------------------------------------------------------------------------------*/

/**
 * Default display for action: wordstrap_header_above
 *
 * @since 2.0.0
 */
 
if( ! function_exists( 'wordstrap_header_above_default' ) ) {
	function wordstrap_header_above_default() {		
		echo '<div class="header-above">';
		wordstrap_display_sidebar( 'ad_above_header' );
		echo '</div><!-- .header-above (end) -->';
	}
}

/**
 * Default display for action: wordstrap_header_content
 *
 * @since 2.0.0
 */

if( ! function_exists( 'wordstrap_header_content_default' ) ) {
	function wordstrap_header_content_default() {
		?>
		<div id="header_content">
			<div class="container">
				<div class="inner">
					<?php 
					wordstrap_header_logo();
					wordstrap_header_addon();
					?>
					<div class="clear"></div>
				</div><!-- .inner (end) -->
			</div><!-- .container (end) -->
		</div><!-- #header_content (end) -->
		<?php
	}
}

/**
 * Default display for action: wordstrap_header_logo
 *
 * @since 2.0.0
 */

if( ! function_exists( 'wordstrap_header_logo_default' ) ) {
	function wordstrap_header_logo_default() {
		$option = wordstrap_get_option( 'logo' );
		$classes = 'header_logo header_logo_'.$option['type'];
		if( $option['type'] == 'custom' && isset( $option['custom_tagline'] ) && $option['custom_tagline'] )
			$classes .= ' header_logo_has_tagline';
		if( $option['type'] == 'title_tagline' )
			$classes .= ' header_logo_has_tagline';
		?>
		<div class="<?php echo $classes; ?>">
			<?php
			if( is_array( $option ) && isset( $option['type'] ) ) {
				switch( $option['type'] ) {
					case 'title' :
						echo '<h1 class="ws-text-logo"><a href="'.home_url().'" title="'.get_bloginfo('name').'">'.get_bloginfo('name').'</a></h1>';
						break;
					case 'title_tagline' :
						echo '<h1 class="ws-text-logo"><a href="'.home_url().'" title="'.get_bloginfo('name').'">'.get_bloginfo('name').'</a></h1>';
						echo '<span class="tagline">'.get_bloginfo('description').'</span>';
						break;
					case 'custom' :
						echo '<h1 class="ws-text-logo"><a href="'.home_url().'" title="'.$option['custom'].'">'.$option['custom'].'</a></h1>';
						if( $option['custom_tagline'] )
							echo '<span class="tagline">'.$option['custom_tagline'].'</span>';
						break;
					case 'image' :
						echo '<a href="'.home_url().'" title="'.get_bloginfo('name').'" class="ws-image-logo"><img src="'.$option['image'].'" alt="'.get_bloginfo('name').'" /></a>';
						break;
				}
			}
			?>
		</div><!-- .tbc_header_logo (end) -->
		<?php
	}
}

/**
 * Default display for action: wordstrap_header_main_menu
 *
 * @since 2.0.0
 */

if( ! function_exists( 'wordstrap_header_menu_default' ) ) {
	function wordstrap_header_menu_default() {
		if( wordstrap_get_option( 'responsive_css', null, 'true' ) != 'false' && wordstrap_get_option( 'mobile_nav', null, 'mobile_nav_select' ) != 'mobile_nav_graphic' )
			echo wordstrap_nav_menu_select( apply_filters( 'wordstrap_responsive_menu_location', 'primary' ) );
		?>
		<nav id="access" role="navigation">
			<div class="container">
				<div class="content">
					<?php wp_nav_menu( array( 'menu_id' => 'primary-menu', 'menu_class' => 'sf-menu','container' => '', 'theme_location' => 'primary', 'fallback_cb' => 'wordstrap_primary_menu_fallback' ) ); ?>
					<?php wordstrap_header_menu_addon(); ?>
					<div class="clear"></div>
				</div><!-- .content (end) -->
			</div><!-- .container (end) -->
		</nav><!-- #access (end) -->
		<?php
	}
}

/*-----------------------------------------------------------------------------------*/
/* Footer
/*-----------------------------------------------------------------------------------*/

/**
 * Default display for action: wordstrap_footer_content
 *
 * @since 2.0.0
 */

if( ! function_exists( 'wordstrap_footer_content_default' ) ) {
	function wordstrap_footer_content_default() {
		// Grab the setup
		$footer_setup = wordstrap_get_option( 'footer_setup' );
		// Make sure there's actually a footer option in the theme setup
		if( is_array( $footer_setup ) ) {
			// Only move forward if user has selected for columns to show
			if( $footer_setup['num'] > 0 ) {
				// Build array of columns
				$i = 1;
				$columns = array();
				$num = $footer_setup['num'];
				while( $i <= $num ) {
					$columns[] = wordstrap_get_option( 'footer_col_'.$i );
					$i++;
				}
				?>
				<div class="footer_content">
					<div class="container">
						<div class="content">
							<div class="grid-protection">
								<?php wordstrap_columns( $num, $footer_setup['width'][$num], $columns ); ?>
								<div class="clear"></div>
							</div><!-- .grid-protection (end) -->
						</div><!-- .content (end) -->
					</div><!-- .container (end) -->
				</div><!-- .footer_content (end) -->
				<?php
			}
		}
	}
}

/**
 * Default display for action: wordstrap_footer_sub_content
 *
 * @since 2.0.0
 */
 
if( ! function_exists( 'wordstrap_footer_sub_content_default' ) ) {
	function wordstrap_footer_sub_content_default() {
		?>
		<div id="footer_sub_content">
			<div class="container">
				<div class="content">
					<div class="copyright">
						<span class="copyright-inner">
							<?php echo apply_filters( 'wordstrap_footer_copyright', wordstrap_get_option( 'footer_copyright' ) ); ?>
						</span>
					</div><!-- .copyright (end) -->
					<div class="footer-nav">
						<span class="footer-inner">
							<?php wp_nav_menu( array( 'menu_id' => 'footer-menu', 'container' => '', 'fallback_cb' => '', 'theme_location' => 'footer', 'depth' => 1 ) ); ?>
						</span>
					</div><!-- .copyright (end) -->
					<div class="clear"></div>
				</div><!-- .content (end) -->
			</div><!-- .container (end) -->
		</div><!-- .footer_sub_content (end) -->
		<?php
	}
}

/**
 * Default display for action: wordstrap_footer_below
 *
 * @since 2.0.0
 */

if( ! function_exists( 'twordstrap_footer_below_default' ) ) {
	function wordstrap_footer_below_default() {		
		echo '<div class="footer-below">';
		wordstrap_display_sidebar( 'ad_below_footer' );
		echo '</div><!-- .footer-below (end) -->';
	}
}


/*-----------------------------------------------------------------------------------*/
/* Sidebars/Widget Areas
/*-----------------------------------------------------------------------------------*/

/**
 * Default display for action: wordstrap_fixed_sidebar_before
 *
 * @since 2.0.0
 */

if( ! function_exists( 'wordstrap_fixed_sidebar_before_default' ) ) {
	function wordstrap_fixed_sidebar_before_default( $side ) {
		echo '<div class="fixed-sidebar '.$side.'-sidebar">';
		echo '<div class="fixed-sidebar-inner">';
	}
}

/**
 * Default display for action: wordstrap_fixed_sidebar_after
 *
 * @since 2.0.0
 */

if( ! function_exists( 'wordstrap_fixed_sidebar_after_default' ) ) {
	function wordstrap_fixed_sidebar_after_default() {
		echo '</div><!-- .fixed-sidebar-inner (end) -->';
		echo '</div><!-- .fixed-sidebar (end) -->';
	}
}

/*-----------------------------------------------------------------------------------*/
/* Featured Area (above)
/*-----------------------------------------------------------------------------------*/
	
/**
 * Default display for action: wordstrap_featured_start
 *
 * @since 2.0.0
 */

if( ! function_exists( 'wordstrap_featured_start_default' ) ) {
	function wordstrap_featured_start_default() {
		$classes = '';
		$featured = wordstrap_config( 'featured' );
		if( $featured ) {
			foreach( $featured as $class )
				$classes .= " $class";

		}
		?>
		<!-- FEATURED (start) -->
		
		<div id="featured">
			<div class="featured-inner<?php echo $classes; ?>">
				<div class="featured-content">
		<?php
	}
}

/**
 * Default display for action: wordstrap_featured_end
 *
 * @since 2.0.0
 */
 
if( ! function_exists( 'wordstrap_featured_end_default' ) ) {
	function wordstrap_featured_end_default() {
		?>
					<div class="clear"></div>
				</div><!-- .featured-content (end) -->
			</div><!-- .featured-inner (end) -->
		</div><!-- #featured (end) -->
		
		<!-- FEATURED (end) -->
		<?php
	}
}

/**
 * Default display for action: wordstrap_featured_blog
 *
 * @since 2.1.0
 */

if( ! function_exists( 'wordstrap_featured_blog_default' ) ) {
	function wordstrap_featured_blog_default() {
		if( wordstrap_get_option( 'blog_featured', null, false ) ){
			$slider = wordstrap_get_option( 'blog_slider' );
			$type = get_post_meta( wordstrap_post_id_by_name($slider, 'ws_slider'), 'type', true );
			echo '<div class="element element-slider element-slider-'.$type.'">';
			echo '<div class="element-inner">';
			echo '<div class="element-inner-wrap">';
			wordstrap_slider( $slider );
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Featured Area (below)
/*-----------------------------------------------------------------------------------*/
	
/**
 * Default display for action: wordstrap_featured_below_start
 *
 * @since 2.1.0
 */

if( ! function_exists( 'wordstrap_featured_below_start_default' ) ) {
	function wordstrap_featured_below_start_default() {
		$classes = '';
		$featured_below = wordstrap_config( 'featured_below' );
		if( $featured_below ) {
			foreach( $featured_below as $class )
				$classes .= " $class";

		}
		?>
		<!-- FEATURED BELOW (start) -->
		
		<div id="featured_below">
			<div class="featured_below-inner<?php echo $classes; ?>">
				<div class="featured_below-content">
		<?php
	}
}

/**
 * Default display for action: wordstrap_featured_below_end
 *
 * @since 2.1.0
 */
 
if( ! function_exists( 'wordstrap_featured_below_end_default' ) ) {
	function wordstrap_featured_below_end_default() {
		?>
					<div class="clear"></div>
				</div><!-- .featured_below-content (end) -->
			</div><!-- .featured_below-inner (end) -->
		</div><!-- #featured_below (end) -->
		
		<!-- FEATURED BELOW (end) -->
		<?php
	}
}

/*-----------------------------------------------------------------------------------*/
/* Primary Content Area
/*-----------------------------------------------------------------------------------*/

/**
 * Default display for action: wordstrap_main_start
 *
 * @since 2.0.0
 */

if( ! function_exists( 'wordstrap_main_start_default' ) ) {
	function wordstrap_main_start_default() {
		?>
		<!-- MAIN (start) -->
		
		<div id="main" class="<?php wordstrap_sidebar_layout_class(); ?>">
			<div class="main-inner">
				<div class="main-content">
					<div class="grid-protection">
		<?php
	}
}

/**
 * Default display for action: wordstrap_main_end
 *
 * @since 2.0.0
 */

if( ! function_exists( 'wordstrap_main_end_default' ) ) {
	function wordstrap_main_end_default() {
		?>
						<div class="clear"></div>
					</div><!-- .grid-protection (end) -->
				</div><!-- .main-content (end) -->
			</div><!-- .main-inner (end) -->
		</div><!-- #main (end) -->
		
		<!-- MAIN (end) -->
		<?php
	}
}

/**
 * Default display for action: wordstrap_main_top
 *
 * @since 2.0.0
 */

if( ! function_exists( 'wordstrap_main_top_default' ) ) {
	function wordstrap_main_top_default() {		
		echo '<div class="main-top">';
		wordstrap_display_sidebar( 'ad_above_content' );
		echo '</div><!-- .main-top (end) -->';
	}
}

/**
 * Default display for action: wordstrap_main_top
 *
 * @since 2.0.0
 */

if( ! function_exists( 'wordstrap_main_bottom_default' ) ) {
	function wordstrap_main_bottom_default() {		
		echo '<div class="main-bottom">';
		wordstrap_display_sidebar( 'ad_below_content' );
		echo '</div><!-- .main-bottom (end) -->';
	}
}

/**
 * Default display for action: wordstrap_breadcrumbs
 *
 * @since 2.0.0
 */

if( ! function_exists( 'wordstrap_breadcrumbs_default' ) ) {
	function wordstrap_breadcrumbs_default() {
		wp_reset_query();
		global $post;
		$display = '';
		// Pages and Posts
		if( is_page() || is_single() )
			$display = get_post_meta( $post->ID, '_ws_breadcrumbs', true );
		// Standard site-wide option
		if( ! $display || $display == 'default' )
			$display = wordstrap_get_option( 'breadcrumbs', null, 'show' );
		// Disable on posts homepage
		if( is_home() )
			$display = 'hide';
		// Show breadcrumbs if not hidden
		if( $display == 'show' )
			echo wordstrap_get_breadcrumbs();
	}
}

/*-----------------------------------------------------------------------------------*/
/* Content
/*-----------------------------------------------------------------------------------*/

/**
 * Default display for action: wordstrap_content_top
 *
 * @since 2.1.0
 */

if( ! function_exists( 'wordstrap_content_top_default' ) ) {
	function wordstrap_content_top_default() {
		if( is_archive() ) {
			if( wordstrap_get_option( 'archive_title', null, 'false' ) != 'false' ) {
				echo '<div class="element element-headline primary-entry-title">';
				echo '<h1 class="entry-title">';
				wordstrap_archive_title();
				echo '</h1>';
				echo '</div><!-- .element (end) -->';
			}
		}
		if( is_page_template( 'template_list.php' ) || is_page_template( 'template_grid.php' ) ) {
			global $post;
			if( 'hide' != get_post_meta( $post->ID, '_ws_title', true ) ) {
				echo '<div class="element element-headline primary-entry-title">';
				echo '<h1 class="entry-title">';
				the_title();
				echo '</h1>';
				echo '</div><!-- .element (end) -->';
			}
			the_content();
		}
	}
}

// The following must happen within the loop!

/**
 * Default display for action: wordstrap_meta
 *
 * @since 2.0.0
 */

if( ! function_exists( 'wordstrap_blog_meta_default' ) ) {
	function wordstrap_blog_meta_default() {
		
		// Setup text strings so their run through the 
		// framework's frontend localization filter.
		$text = array(
			'by' => wordstrap_get_local( 'by' ),
			'comment' => wordstrap_get_local( 'comment' ),
			'comments' => wordstrap_get_local( 'comments' ),
			'in' => wordstrap_get_local( 'in' ),
			'no_comments' => wordstrap_get_local( 'no_comments' ),
			'posted_on' => wordstrap_get_local( 'posted_on' )

		);
		
		?>
		<div class="entry-meta">
			<span class="sep"><?php echo $text['posted_on']; ?></span>
			<time class="entry-date" datetime="<?php the_time('c'); ?>" pubdate><?php the_time( get_option('date_format') ); ?></time>
			<span class="sep"> <?php echo $text['by']; ?> </span>
			<span class="author vcard"><a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo sprintf( esc_attr__( 'View all posts by %s', WS_GETTEXT_DOMAIN ), get_the_author() ); ?>" rel="author"><?php the_author(); ?></a></span>
			<span class="sep"> <?php _e( 'in', WS_GETTEXT_DOMAIN ); ?> </span>
			<span class="category"><?php the_category(', '); ?></span>
			<?php if ( comments_open() ) : ?>
			 - <span class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">'.$text['no_comments'].'</span>', '1 '.$text['comment'], '% '.$text['comments'] ); ?>
			</span>
			<?php endif; ?>
		</div><!-- .entry-meta -->		
		<?php
	}
}

/**
 * Default display for action: wordstrap_tags
 *
 * @since 2.0.0
 */

if( ! function_exists( 'wordstrap_blog_tags_default' ) ) {
	function wordstrap_blog_tags_default() {
		the_tags( '<span class="tags">', ', ', '</span>' );
	}
}

/**
 * Default display for action: wordstrap_the_post_thumbnail
 *
 * @since 2.0.0
 */

if( ! function_exists( 'wordstrap_the_post_thumbnail_default' ) ) {
	function wordstrap_the_post_thumbnail_default( $location = 'primary', $size = '', $link = true, $allow_filters = true, $gallery = 'gallery' ) {
		echo wordstrap_get_post_thumbnail( $location, $size, $link, $allow_filters, $gallery );
	}
}

/**
 * Default display for action: wordstrap_content
 *
 * @since 2.0.0
 */

if( ! function_exists( 'wordstrap_blog_content_default' ) ) {
	function wordstrap_blog_content_default( $type ) {
		if( $type == 'content' ) {
			// Show full content
			the_content( wordstrap_get_local('read_more').' &rarr;' );
		} else {
			// Show excerpt and read more button
			the_excerpt();
			echo '<div class="clear"></div>';
			echo wordstrap_button( wordstrap_get_local( 'read_more' ), get_permalink( get_the_ID() ), 'default', '_self', 'small', 'read-more', get_the_title( get_the_ID() )  );
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Layout Builder Elements
/*-----------------------------------------------------------------------------------*/

/**
 * Default display for action: wordstrap_element_close
 *
 * @since 2.1.0
 */

if( ! function_exists( 'wordstrap_element_open_default' ) ) {
	function wordstrap_element_open_default( $type, $location, $classes ) {
		echo '<div class="'.$classes.'">';
		echo '<div class="element-inner">';
		echo '<div class="element-inner-wrap">';
	}
}

/**
 * Default display for action: wordstrap_element_close
 *
 * @since 2.1.0
 */

if( ! function_exists( 'wordstrap_element_close_default' ) ) {
	function wordstrap_element_close_default( $type, $location, $classes ) {
		echo '</div><!-- .element-inner-wrap (end) -->';
		echo '</div><!-- .element-inner (end) -->';
		echo '</div><!-- .element (end) -->';
	}
}

/*-----------------------------------------------------------------------------------*/
/* WordPress Multisite
/*-----------------------------------------------------------------------------------*/

/**
 * Before sign-up form
 *
 * @since 2.1.0
 */

if( ! function_exists( 'wordstrap_before_signup_form' ) ) {
	function wordstrap_before_signup_form() {
		wordstrap_main_start();
		wordstrap_main_top();
		// wordstrap_breadcrumbs();
		wordstrap_before_layout();
		echo '<div id="sidebar_layout">';
		echo '<div class="sidebar_layout-inner">';
		echo '<div class="grid-protection">';
	}
}

/**
 * After sign-up form
 *
 * @since 2.1.0
 */

if( ! function_exists( 'wordstrap_after_signup_form' ) ) {
	function wordstrap_after_signup_form() {
		echo '</div><!-- .grid-protection (end) -->';
		echo '</div><!-- .sidebar_layout-inner (end) -->';
		echo '</div><!-- .sidebar-layout-wrapper (end) -->';
		wordstrap_main_bottom();
		wordstrap_main_end();
	}
}