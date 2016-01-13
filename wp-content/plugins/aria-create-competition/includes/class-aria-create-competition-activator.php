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
		// check if GravityForms is activated
		require_once(ABSPATH . 'wp-admin/includes/plugin.php');
		if (!is_plugin_active('gravityforms/gravityforms.php')) {
			// inform user that GravityForms must be activated
			add_action('admin_notices', array( &$this, 'aria_admin_error_notice_gf'));
			do_action('admin_notices'); 
			die;  
		}

		//  check 
	}

	/**
	 * Presents an error to the festival chairman if Gravity Forms is not enabled. 
	 *
	 * @since     1.0.2
	 * @return    void
	 */
	function aria_admin_error_notice_gf() {
		?>
		<div class="error notice">
			<p>
				<?php 
					_e('ARIA: Testing for Gravity Forms was not acivated; 
						please activate the Gravity Forms plugin.'); 
				?>
			</p>
		</div>
		<?php
	}
}
