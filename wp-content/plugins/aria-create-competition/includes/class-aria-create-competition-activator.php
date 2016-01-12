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

			// adding js alert
			/*
			echo '<script language="javascript">';
			echo 'alert("You must have the Gravity Forms plugin enabled to create competitions.")';
			echo '</script>'; 
			*/

			die(); // may replace
		}

		//  check 
	}
}
