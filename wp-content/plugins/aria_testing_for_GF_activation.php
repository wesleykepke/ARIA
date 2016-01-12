<?php
/*
Plugin Name: Aria: Testing for Gravity Forms
Plugin URI: http://google.com
Description: Checks to see if the Gravity Forms plugin is enabled.  
Author: Wes
Version: 1.0
Author URI: http://wkepke.com
*/

function aria_check_GF() {
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

require_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (!is_plugin_active('gravityforms/gravityforms.php')) {
	add_action('admin-notices', 'aria_check_GF'); 
}

?>