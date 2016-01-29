<?php
/*
Plugin Name: Aria: Wes Testing Static Variables
Plugin URI: http://google.com
Description: ??? QUE LASTIMA ???  
Author: Wes
Version: 1.0
Author URI: http://wkepke.com
*/ 

global $global_doge_id;
$global_doge_id = -9; 

// THIS DOESN'T WORK 
class doge {
	public static $doge_id = -3;

	public static function doge_activate() {
		self::$doge_id = doge::doge_assign_id();
		global $global_doge_id;
		$global_doge_id = doge::doge_assign_id(); 

		//wp_die("doge_activate: " . $global_doge_id);

		//remove_all_actions("gform_after_submission");

		//add_action('gform_after_submission_154', array(&$this, 'self::doge_bark'));

		//die("In doge_activate: " . self::$doge_id);

		//wp_die("doge_activate(): " . static::$doge_id);
		//$GLOBALS["wes"] = self::$doge_id; 
	}

	public static function doge_assign_id() {
		return 69; 
	}

	public static function doge_bark($form, $entry) {
		global $global_doge_id;
		if ($global_doge_id  == 69) {
			die("In doge_bark (woof!): " . $global_doge_id);
		}
		else {
			die("In doge_bark: " . $global_doge_id );
		} 
	}
}

function wes_wes() {
	global $global_doge_id;
	$global_doge_id = 42; 
	die("global doge id: " . $global_doge_id);
}

register_activation_hook(__FILE__, 'doge::doge_activate');

//add_action('gform_after_submission_154', 'doge::doge_bark', 10, 2);

//add_action('gform_after_submission_154', 'wes_wes', 10, 0);

//remove_all_actions("gform_after_submission");


/*
class doge {
	private static $doge_id = -4;

	public static function doge_activate() {
		self::$doge_id = self::doge_assign_id();
		//wp_die("doge_activate(): " . static::$doge_id);
		//$GLOBALS["wes"] = self::$doge_id;

		//add_action('init', array(&$this, 'init'));

		//wp_die("after add_action: " . $this->doge_get_id());  
	}

	public static function doge_deactivate() {
		remove_all_actions("gform_after_submission");
	}

	public function init() {
		add_action("gform_after_submission_154", array(&$this, 'self::doge_bark'), 10, 2);
	}

	private static function doge_assign_id() {
		return 69; 
	}

	public static function doge_bark($form, $entry) {
		wp_die("doge_bark function, called from doge_activate");

		if (self::$doge_id == 69) {
			wp_die("woof");
		}
		else {
			wp_die("hi: " . self::$doge_id);
		}
	}

	public static function doge_get_id() {
		return self::$doge_id; 
	}
}
*/

//register_activation_hook(__FILE__, array(&$wes_doge, 'doge_activate'));
//register_activation_hook(__FILE__, 'doge::doge_activate');
//register_deactivation_hook(__FILE__, 'doge::doge_deactivate');

//wp_die("after activation hook " . doge::$doge_id);

//wp_die("After register activation: " . $wes_doge->doge_get_id());

//add_action("gform_after_submission_144", 'doge::doge_bark', 10, 2);