<?php

/**
 * Fired during plugin activation.
 *
 * @link       http://aria.cse.unr.edu
 * @since      1.0.0
 *
 * @package    aria-create-competition
 * @subpackage aria-create-competition/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    aria-create-competition
 * @subpackage aria-create-competition/includes
 * @author     KREW (Kyle, Renee, Ernest, and Wes)
 */
class ARIA_Create_Competition_Activator {

	/**
	 * Function that performs all processing that occurs during plugin activation.
	 *
	 * This function is called by WordPress during plugin activation and performs
	 * some checking to ensure that certain dependencies, such as GravityForms, 
	 * are installed. 
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		// check if GravityForms is installed
		require_once(ABSPATH . 'wp-admin/includes/plugin.php');
		if (!is_plugin_active('gravityforms/gravityforms.php')) {
			// possibly display some sort of error message here so user knows whats up?

			//add_action('admin-notices', array( &$this, 'aria_admin_error_notice')); 

			echo '<p>GF not enabled!</p>';

			// adding js alert - doesn't work.. 
			/*
			echo '<script language="javascript">';
			echo 'alert("You must have the Gravity Forms plugin enabled to create competitions.")';
			echo '</script>'; 
			*/

			//die(); // may replace


		}

		//  check 
	}

	/**
	 * Presents an error to the festival chairman if GravityForms is not enabled. 
	 *
	 * @since     1.0.2
	 * @return    void
	 */
	public function aria_admin_error_notice() {
		?>
		<div class="error notice">
		<p><?php _e('You must have the Gravity Forms plugin enabled to create competitions.
						Please enable GravityForms and reactivate plugin.'); ?></p>
		</div>
		<?php
	}

	/*
	private function aria_admin_error_notice() {
		$class = "error"; // displays error msg with white background and red left border
		$message = "You must have the Gravity Forms plugin enabled to create competitions.";
		$message .= " ";
		echo "<div class=\" $class \"><h5> $message </h5></div>"; 
	} */
}
