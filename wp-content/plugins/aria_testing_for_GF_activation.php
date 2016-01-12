<?php
/*
Plugin Name: Aria: Testing for Gravity Forms
Plugin URI: http://google.com
Description: Checks to see if the Gravity Forms plugin is enabled.  
Author: Wes
Version: 1.1
Author URI: http://wkepke.com
*/

function aria_add_admin_notice() {
	?>
	<div class="update-nag notice">
		<p>
			<?php
			_e('Gravity Forms is not activated. Please activate Gravity Forms and try again'); 
			?>
		</p>
	</div>
	<?php
}

/*
function aria_check_GF() {
	require_once(ABSPATH . 'wp-admin/includes/plugin.php');
	if (is_plugin_active('gravityforms/gravityforms.php')) {
		return true; 	
	}
	else {
		return false; 
	}
}
*/

function aria_activation_func() {
	require_once(ABSPATH . 'wp-admin/includes/plugin.php');
	if (!is_plugin_active('gravityforms/gravityforms.php')) {
		add_action('admin-notices', 'aria_add_admin_notice'); 
		do_action('admin-notices');
		die();  	
	}
	else {
		echo "dmsakdnsa";
	}
}

register_activation_hook(__FILE__, 'aria_activation_func'); 

?>