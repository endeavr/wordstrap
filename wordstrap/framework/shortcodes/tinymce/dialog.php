<?php 
//Setup URL to WordPres
$absolute_path = __FILE__;
$path_to_wp = explode( 'wp-content', $absolute_path );
$wp_url = $path_to_wp[0];

//Access WordPress
require_once( $wp_url.'/wp-load.php' );

//URL to TinyMCE plugin folder
$plugin_url = get_template_directory_uri().'/framework/shortcodes/tinymce/';

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<body>
	<div id="wordstrap-dialog">
		<div id="wordstrap-options-buttons" class="clear">
			<div class="alignleft">
			   <h3><?php _e( 'Shortcode Options', WS_GETTEXT_DOMAIN ); ?></h3>
			</div>
			<div class="alignright">
			 	<input type="button" id="wordstrap-cancel-button" class="button" name="cancel" value="Cancel" accesskey="C" />
			    <input type="button" id="wordstrap-insert-button" class="button-primary" name="insert" value="Insert" accesskey="I" />
			</div>
			<div class="clear"></div><!--/.clear-->
		</div><!-- #wordstrap-options-buttons(end) -->
		<div id="wordstrap-shortcode-options">
			<table id="wordstrap-options-table" class="widefat">
			</table>
		</div>
		<div class="clear"></div>
		<!--<script type="text/javascript" src="<?php echo $plugin_url; ?>layout/js/tab-control.js"></script>-->
		<script type="text/javascript" src="<?php echo $plugin_url; ?>layout/js/dialog-js.php"></script>
	</div><!-- #wordstrap-dialog (end) -->
</body>
</html>