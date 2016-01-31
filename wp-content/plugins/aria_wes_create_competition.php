<?php
/*
Plugin Name: Aria: Create Competition (Wes)
Plugin URI: http://google.com
Description: Testing email functionality. 
Author: KREW (Kyle, Renee, Ernest, and Wes)
Version: 1.0.0
Author URI: http://google.com
*/

/** 
 * This function will find the ID of the form used to upload songs to the database.
 *
 * This function will iterate through all of the active form objects and return the 
 * ID of the form that is used to upload music to the database.
 *
 * @since 1.0.0
 * @author KREW 
 */
function aria_create_competition_activation() {
  require_once(ABSPATH . 'wp-admin/includes/plugin.php');
  if (is_plugin_active('gravityforms/gravityforms.php')) {  

    self::aria_create_teacher_form("Sample Created");
    self::aria_create_student_form("Sample Created");

    // Get all forms from gravity forms
    $forms = GFAPI::get_forms();

    // Set the form index of the Competition Creation Form.
    $competition_creation_form_title = "ARIA: Create a Competition";
    $index = -1;

    // Loop through each form to see if the form was previously created.
    foreach ($forms as $form) {
      if ($form['title'] == "ARIA: Create a Competition") {
        $index =  $form['id'];
      }
    }

    // form does not exist; create new form 
    if ($index == -1) {
       $result = self::aria_create_competition_form();
    }
  }
}