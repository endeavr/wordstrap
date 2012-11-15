<?php 
/*
Plugin Name: WordStrap - Import/Export Options
Plugin URI: http://wordstrap.com
Description: This is a utility plugin for WordStrap with backup and restore options.
Author: Jason Loftis
Version: 1.0
Author URI: http://wordstrap.com
*/
ob_start();
function register_ws_ie_option() {	
	add_theme_page('Restore/Import Theme Options', 'Import Theme Options', 'activate_plugins', 'theme-options-import', 'ws_ie_import_option_page');
	add_theme_page('Backup/Export Theme Options', 'Export Theme Options', 'activate_plugins', 'theme-options-export', 'ws_ie_export_option_page');	
}

/*	
 *	Import feature
 */
function ws_ie_import_option_page() {
?>
	<div class="wrap">
		<div id="icon-tools" class="icon32"><br /></div>
        <h2>Restore/Import Theme Options</h2>
        <?php
			if (isset($_FILES['import']) && check_admin_referer('ie-import')) {
				if ($_FILES['import']['error'] > 0) 
					wp_die("Error happens");		
				else {
					$file_name = $_FILES['import']['name'];
					$file_ext = strtolower(end(explode(".", $file_name)));
					$file_size = $_FILES['import']['size'];
					if (($file_ext == "json") && ($file_size < 500000)) {
						$encode_options = file_get_contents($_FILES['import']['tmp_name']);
						$options_import = json_decode($encode_options, true);

						$optionsframework_data = get_option('optionsframework');
						$optionsframework_name = $optionsframework_data['id'];
						
						update_option($optionsframework_name, $options_import);
						
						echo "<div class='updated'><p>All options are restored successfully.</p></div>";
					}	
					else 
						echo "<div class='error'><p>Invalid file or file size too big.</p></div>";
				}
			}
		?>
        <p>Click the <tt>Choose File</tt> button and select a .JSON file from a previous backup of this site or another WordStrap site.</p>
        <p>Then, press the <tt>Import Theme Options File</tt> button and let Wordpress do the rest for you.</p>
        <form method='post' enctype='multipart/form-data'>
	        <p class="submit">
              	<?php wp_nonce_field('ie-import'); ?>
            	<input type='file' name='import' /><br><br>
	        	<input type='submit' class="button-primary" name='submit' value='Import Theme Options File'/>
	        </p>
        </form>
    </div>
<?php
}

/*	
 *	Export feature
 */
function ws_ie_export_option_page() {
	if (!isset($_POST['export'])) { 
?>
		<div class="wrap">
			<div id="icon-tools" class="icon32"><br /></div>
	        <h2>Backup/Export Theme Options</h2>
	        <p>When you click the <tt>Backup/Export Theme Options</tt> button, the system will generate a .JSON file for you to save on your computer.</p>
	        <p>This backup file contains all WordPress settings for the WordStrap theme framework. Note that this backup will <b>NOT</b> contain posts, pages, or any other content data. It only exports the <b>THEME OPTIONS</b>.</p>
	        <p>After exporting, you can either use the backup file to restore your settings on this site again in the future or on another WordStrap site.</p>
            <form method='post'>
	        <p class="submit">
            	<?php wp_nonce_field('ie-export'); ?>
	        	<input type='submit' class="button-primary" name='export' value='Backup All Theme Options'/>
	        </p>
            </form>
	    </div>
<?php 
  	} elseif (check_admin_referer('ie-export')) {
  	
		$blogname = str_replace(" ", "", get_option('blogname'));
		$date = date("m-d-Y");
		$json_name = $blogname."-".$date; // Namming the filename will be generated.
		
		$optionsframework_settings = get_option('optionsframework');
		$options_export = get_option( $optionsframework_settings['id'] );
		
		$json_file = json_encode( (array)$options_export); // Encode data into json data
		
		ob_clean();
		echo $json_file;
		header("Content-Type: text/json; charset=" . get_option( 'blog_charset'));
		header("Content-Disposition: attachment; filename=$json_name.json");
		exit();
	}
}
add_action('admin_menu', 'register_ws_ie_option');