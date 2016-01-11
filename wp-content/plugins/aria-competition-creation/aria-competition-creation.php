<?php

/**
 * @wordpress-plugin
 * Plugin Name: ARIA Competion Creation
 * Plugin URI: https://github.com/wesleykepke/ARIA
 * Description: This plugin allows the festival chairman to create a new music competition.
 * Version: 1.0.0 
 * Author: KREW
 * Author URI: https://github.com/wesleykepke/ARIA
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: aria-competition-creation
 * Domain Path: /languages 
 *
 * @package aria-competition-creation
 */

// if not called by WordPress, discontinue
if (!defined('WPINC')) {
	die(); 
}

/**
 * this code executes during plugin activation and is written in 
 * includes/aria-competition-creation-activator.php
 */
function activate_aria_competition_creation_plugin() {
	require_once(plugin_dir_path(__FILE__) . 'includes/aria-competition-creation-activator.php');
	Aria_Competition_Creation_Activator::activate(); 
}

/**
 * this code executes during plugin deactivation and is written in
 * includes/aria-competition-creation-deactivator.php
 */
function deactivate_aria_competition_creation_plugin() {
	require_once(plugin_dir_path(__FILE__) . 'includes/aria-competition-creation-deactivator.php');
	Aria_Competition_Creation_Deactivator::deactivate();  
}

// register the activation and deactivation functions
register_activation_hook(__FILE__, 'activate_aria_competition_creation_plugin');
register_deactivation_hook(__FILE__, 'deactivate_aria_competition_creation_plugin');

  

?>