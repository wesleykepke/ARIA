<?php
/*
Plugin Name: Aria: Wes Testing Scope
Plugin URI: http://google.com
Description: ??? QUE LASTIMA ???
Author: Wes
Version: 1.0
Author URI: http://wkepke.com
*/

global $form_id;
$form_id = scope_aria::getIdOfMusicDB_Helper();

function aria_outside_get_formid() {
	global $form_id;
	//wp_die("Form ID: " . $form_id);
}

class scope_aria {
	private static $music_db_id;

  public static function scope_aria_activation() {
		//self::$music_db_id = self::getIdOfMusicDB_Helper();
	}

  public static function getIdOfMusicDB() {
		wp_die("Form ID: " . self::$music_db_id);
	}

	 public static function getIdOfMusicDB_Helper() {
		 $create_competition_form_name = 'ARIA: Create a Competition';
	   $create_competition_form_id = NULL;
	   $all_active_forms = GFAPI::get_forms();

	   foreach ($all_active_forms as $form) {
	     if ($form['title'] === $create_competition_form_name) {
	       $create_competition_form_id = $form['id'];
	     }
	   }

	   if (!isset($create_competition_form_id)) {
	     $create_competition_form_id = -1;
	   }

	   return $create_competition_form_id;
	 }
 }

/*
register_activation_hook(__FILE__, 'scope_aria::scope_aria_activation');
add_action('gform_after_submission_15', 'aria_outside_get_formid', 10, 0);
*/
