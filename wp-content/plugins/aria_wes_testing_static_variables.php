<?php
/*
Plugin Name: Aria: Wes Testing Scope
Plugin URI: http://google.com
Description: ??? QUE LASTIMA ???
Author: Wes
Version: 1.0
Author URI: http://wkepke.com
*/

 class scope_aria {
	 private $music_db_id;

  public static function getIdOfMusicDB() {
		wp_die("Form ID: " . self::getIdOfMusicDB_Helper());
	}

	 private static function getIdOfMusicDB_Helper() {
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

add_action('gform_after_submission_15', 'getIdOfMusicDB', 10, 0);
