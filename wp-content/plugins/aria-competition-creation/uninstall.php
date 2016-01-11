<?php

/**
 * Fired when the plugin is uninstalled. 
 *
 * The code in this script will remove all traces of the aria competition
 * creation plugin from the user's WordPress. 
 * 
 * @package aria-competition-creation
 */

// if not called by WordPress, discontinue
if (!defined('WP_UNINSTALL_PLUGIN')) {
	die(); 
}

?>