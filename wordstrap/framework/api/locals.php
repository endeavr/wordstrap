<?php
/**
 * Setup user-read text strings. This function allows
 * to have all of the framework's common localized text 
 * strings in once place.
 *
 * The filter "wordstrap_frontend_locals"
 * can be used to add/remove strings.
 *
 * @since 2.1.0
 */

function wordstrap_get_all_locals() {
	$locals = array ( 
		'404'						=> __( 'Apologies, but the page you\'re looking for can\'t be found.', WS_GETTEXT_DOMAIN_FRONT ),
		'404_title'					=> __( '404 Error', WS_GETTEXT_DOMAIN_FRONT ),
		'archive_no_posts'			=> __( 'Apologies, but there are no posts to display.', WS_GETTEXT_DOMAIN_FRONT ),
		'archive'					=> __( 'Archive', WS_GETTEXT_DOMAIN_FRONT ),
		'by'						=> __( 'by', WS_GETTEXT_DOMAIN_FRONT ),
		'cancel_reply_link'			=> __( 'Cancel reply', WS_GETTEXT_DOMAIN_FRONT ),
		'categories'				=> __( 'Categories', WS_GETTEXT_DOMAIN_FRONT ),
		'category'					=> __( 'Category', WS_GETTEXT_DOMAIN_FRONT ),
		'comment_navigation'		=> __( 'Comment navigation', WS_GETTEXT_DOMAIN_FRONT ),
		'comment'					=> __( 'Comment', WS_GETTEXT_DOMAIN_FRONT ),
		'comments'					=> __( 'Comments', WS_GETTEXT_DOMAIN_FRONT ),
		'comments_closed'			=> __( 'Comments are closed.', WS_GETTEXT_DOMAIN_FRONT ),
		'comments_newer'			=> __( 'Newer Comments &rarr;', WS_GETTEXT_DOMAIN_FRONT ),
		'comments_no_password'		=> __( 'This post is password protected. Enter the password to view any comments.', WS_GETTEXT_DOMAIN_FRONT ),
		'comments_older'			=> __( '&larr; Older Comments', WS_GETTEXT_DOMAIN_FRONT ),
		'comments_title_single'		=> __( 'One comment on &ldquo;%2$s&rdquo;', WS_GETTEXT_DOMAIN_FRONT ),
		'comments_title_multiple'	=> __( '%1$s comments on &ldquo;%2$s&rdquo;', WS_GETTEXT_DOMAIN_FRONT ),
		'contact_us'				=> __( 'Contact Us', WS_GETTEXT_DOMAIN_FRONT ),
		'crumb_404'					=> __( 'Error 404', WS_GETTEXT_DOMAIN_FRONT ),
		'crumb_author'				=> __( 'Articles posted by', WS_GETTEXT_DOMAIN_FRONT ),
		'crumb_search'				=> __( 'Search results for', WS_GETTEXT_DOMAIN_FRONT ),
		'crumb_tag'					=> __( 'Posts tagged', WS_GETTEXT_DOMAIN_FRONT ),
		'edit_page'					=> __( 'Edit Page', WS_GETTEXT_DOMAIN_FRONT ),
		'email'						=> __( 'Email', WS_GETTEXT_DOMAIN_FRONT ),
		'home'						=> __( 'Home', WS_GETTEXT_DOMAIN_FRONT ),
		'in'						=> __( 'in', WS_GETTEXT_DOMAIN_FRONT ),
		'invalid_layout'			=> __( 'Invalid Layout ID', WS_GETTEXT_DOMAIN_FRONT ),
		'label_submit'				=> __( 'Post Comment', WS_GETTEXT_DOMAIN_FRONT ),
		'last_30'					=> __( 'The Last 30 Posts', WS_GETTEXT_DOMAIN_FRONT ),
		'login_text'				=> __( 'Log in to Reply', WS_GETTEXT_DOMAIN_FRONT ),
		'monthly_archives'			=> __( 'Monthly Archives', WS_GETTEXT_DOMAIN_FRONT ),
		'name'						=> __( 'Name', WS_GETTEXT_DOMAIN_FRONT ),
		'page'						=> __( 'Page', WS_GETTEXT_DOMAIN_FRONT ),
		'pages'						=> __( 'Pages', WS_GETTEXT_DOMAIN_FRONT ),
		'page_num'					=> __( 'Page %s', WS_GETTEXT_DOMAIN_FRONT ),
		'posted_on'					=> __( 'Posted on', WS_GETTEXT_DOMAIN_FRONT ),
		'posts_per_category'		=> __( 'Posts per category', WS_GETTEXT_DOMAIN_FRONT ),
		'navigation' 				=> __( 'Navigation', WS_GETTEXT_DOMAIN_FRONT ),
		'no_comments'				=> __( 'No Comments', WS_GETTEXT_DOMAIN_FRONT ),
		'no_slider' 				=> __( 'Slider does not exist.', WS_GETTEXT_DOMAIN_FRONT ),
		'no_slider_selected' 		=> __( 'Oops! You have not selected a slider in your layout.', WS_GETTEXT_DOMAIN_FRONT ),
		'no_video'					=> __( 'The video url could not retrieve a video.', WS_GETTEXT_DOMAIN_FRONT ),
		'read_more'					=> __( 'Read More', WS_GETTEXT_DOMAIN_FRONT ),
		'reply'						=> __( 'Reply', WS_GETTEXT_DOMAIN_FRONT ),
		'search'					=> __( 'Search the site...', WS_GETTEXT_DOMAIN_FRONT ),
		'search_no_results'			=> __( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', WS_GETTEXT_DOMAIN_FRONT ),
		'tag'						=> __( 'Tag', WS_GETTEXT_DOMAIN_FRONT ),
		'title_reply'				=> __( 'Leave a Reply', WS_GETTEXT_DOMAIN_FRONT ),
		'title_reply_to'			=> __( 'Leave a Reply to %s', WS_GETTEXT_DOMAIN_FRONT ),
		'website'					=> __( 'Website', WS_GETTEXT_DOMAIN_FRONT )
	);
	// Return with framework's filter applied
	return apply_filters( 'wordstrap_frontend_locals', $locals );
}

/**
 * Return user read text string.
 *
 * @since 2.0.0
 *
 * @param string $id Key for $locals array
 * @return string $text Localized and filtered text string
 */

if( ! function_exists( 'wordstrap_get_local' ) ) {
	function wordstrap_get_local( $id ) {
		$text = null;
		$locals = wordstrap_get_all_locals();
		// Set text string
		if( isset( $locals[$id] ) )
			$text = $locals[$id];
		return $text;
	}
}