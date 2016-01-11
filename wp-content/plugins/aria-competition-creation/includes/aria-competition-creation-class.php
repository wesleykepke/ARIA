<?php

/**
 * This file defines the core plugin class. 
 *
 * @package aria-competition-creation
 * @subpackage aria-competition-creation/includes
 * @author KREW
 */

class Aria_Competition_Creation {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var string $plugin_name The string used to uniquely identify this plugin.  
	 */
	protected $plugin_name; 

	/**
	 * The current version of this plugin.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var string $version The current version of the plugin.   
	 */
	protected $plugin_name; 	

	/**
	 * Define the core functionality of the plugin. 
	 *
	 * Set the plugin name and plugin version that can be used throughout
	 * the plugin. 
	 *
	 * More functionality will probably have to be added as needed. 
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->plugin_name = 'aria-competition-creation';
		$this->version = '1.0.0';
		
	}
}

?>