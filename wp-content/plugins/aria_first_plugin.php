<?php
/*
Plugin Name: Aria First Plugin
Plugin URI: http://google.com
Description: Adds a super sweet footer to your WordPress page. Now with a settings menu. 
Author: Wes
Version: 2.0
Author URI: http://wkepke.com
*/

function aria_first_plugin() {
	$random_number = mt_rand(0, 55); 
	echo '<h1 id="aria_first_plugin_css">This is a SUPER sweet footer that generated the random number: ' . $random_number. ' (from the range 0-55).</h1>';
}

add_action('wp_footer', 'aria_first_plugin', 6); 

function aria_first_plugin_css() {
	// check if language flows from right to left
	$x = is_rtl() ? 'left' : 'right';
	echo "
	<style type='text/css'>
	#aria_first_plugin_css {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;
		margin: 0;
		font-size: 18px; 
	}
	</style>
	";
}

add_action('wp_footer', 'aria_first_plugin_css'); 

add_action('admin_menu', 'aria_first_plugin_menu'); 

function aria_first_plugin_menu() {
	// adding a menu
	add_menu_page('My Plugin Settings', 
			'Plugin Settings',
			'administrator',
			'my-plugin-settings',
			'aria_first_plugin_settings_page',
			'dashicons-admin-generic'); 
}

function aria_first_plugin_settings_page() {
?>
	<div class="wrap">
	<h2>ARIA Developer Details</h2>

	<form method="post" action="options.php">
    		<?php settings_fields( 'my-plugin-settings-group' ); ?>
    		<?php do_settings_sections( 'my-plugin-settings-group' ); ?>
    		<table class="form-table">
        	
			<tr valign="top">
        		<th scope="row">ARIA Developer Name</th>
        		<td><input type="text" name="aria_developer_name" value="<?php echo esc_attr( get_option('aria_developer_name') ); ?>" /></td>
        		</tr>
       
       		 	<tr valign="top">
        		<th scope="row">ARIA Developer Email</th>
        		<td><input type="text" name="aria_developer_email" value="<?php echo esc_attr( get_option('aria_developer_email') ); ?>" /></td>
        		</tr>
		</table>
    
   	 	<?php submit_button(); ?>

	</form>
	</div>
<?php
}

add_action('admin_init', 'my_plugin_settings');

function my_plugin_settings() {
	register_setting('my-plugin-settings-group', 'aria_developer_name');
	register_setting('my-plugin-settings-group', 'aria_developer_email');  
} 

?>
