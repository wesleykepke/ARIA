<?php

/**
 * The plugin bootstrap file. 
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://aria.cse.unr.edu
 * @since             1.0.0
 * @package           aria-create-competition
 *
 * @wordpress-plugin
 * Plugin Name:       ARIA Create Competition
 * Plugin URI:        http://aria.cse.unr.edu
 * Description:       This plugin allows the festival chairman to create a new music competition.  				
 * Version:           1.0.3
 * Author:            KREW (Kyle, Renee, Ernest, and Wes)
 * Author URI:        http://aria.cse.unr.edu
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       aria-create-competition
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-aria_create_competition-activator.php
 */
function activate_aria_create_competition() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-aria-create-competition-activator.php';
	ARIA_Create_Competition_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-aria_create_competition-deactivator.php
 */
function deactivate_aria_create_competition() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-aria-create-competition-deactivator.php';
	ARIA_Create_Competition_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_aria_create_competition' );
register_deactivation_hook( __FILE__, 'deactivate_aria_create_competition' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-aria-create-competition.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_aria_create_competition() {

	$plugin = new ARIA_Create_Competition();
	$plugin->run();

}
run_aria_create_competition();
