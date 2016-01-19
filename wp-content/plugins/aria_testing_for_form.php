<?php
/*
Plugin Name: Aria: Testing if form exists
Plugin URI: http://google.com
Description: Checks to see if the Gravity Forms plugin is enabled.  
Author: Wes
Version: 1.2
Author URI: http://wkepke.com
*/

function aria_activation_func() {
  require_once(ABSPATH . 'wp-admin/includes/plugin.php');
  if (is_plugin_active('gravityforms/gravityforms.php')) {  
    // Get all forms from gravity forms
    $forms = GFAPI::get_forms();

    // Set the form index of the Competition Creation Form.
    $index = -1;

    // Loop th rough each form to see if the form was previously created.
    foreach ($forms as $form) {
      if($form['title'] == "Test Registration Form") {
        $index =  $form['id'];
      }
    }

    // form does not exist; create new form 
    if ($index == -1) {
      $competition_creation_form = new GF_Form("Test Registration Form", "This shows that a form has been created");
      
      // First Name Field
      $first_name_field = new GF_Field_Text();
      $first_name_field->label = "Name: ";
      $first_name_field->id = 1;
      $first_name_field->isRequired = true;
      $first_name_field->size = 'medium';

      // Teacher Field
      $teacher_field = new GF_Field_Select();
      $teacher_field->label = "Teacher: ";
      $teacher_field->id = 2;
      $teacher_field->isRequired = true;
      $teacher_field->size = 'medium';

      // Level field
      $level_field = new GF_Field_Select();
      $level_field->label = "Level: ";
      $level_field->id = 3;
      $level_field->isRequired = true;
      $level_field->size = 'medium';

      // Period field
      $period_field = new GF_Field_Select();
      $period_field->label = "Period: ";
      $period_field->id = 4;
      $period_field->isRequired = true;
      $period_field->size = 'medium';

      // Songs
      $song_field = new GF_Field_Select();
      $song_field->label = "Song: ";
      $song_field->id = 5;
      $song_field->isRequired = true;
      $song_field->size = 'medium';

      $competition_creation_form->fields[] = $first_name_field;
      $competition_creation_form->fields[] = $teacher_field;
      $competition_creation_form->fields[] = $level_field;
      $competition_creation_form->fields[] = $period_field;
      $competition_creation_form->fields[] = $song_field;

      $result = GFAPI::add_form($competition_creation_form->createFormArray());
    
      // require(ABSPATH . 'wp-content/plugins/aria_second_plugin.php');

      // add_filter( 'gform_pre_render_' . $result, 'aria_populate_posts', 3 );
      // add_filter( 'gform_pre_validation_' . $result, 'aria_populate_posts' );
      // add_filter( 'gform_pre_submission_filter_' . $result, 'aria_populate_posts' );
      // add_filter( 'gform_admin_pre_render_' . $result, 'aria_populate_posts' );
 
      // add_filter( 'gform_pre_render_' . $result, 'aria_modify_logic', 2 );

    }

    // form exists; dynamically populate droptown 
    else {
      add_filter('gform_field_value_Choices', 'aria_dynamically_populate_teachers');
      //echo 'create competition form exits, made it through filter';
      //die;
      $competition_creation_form = GFAPI::get_form(14); 
      //echo 'Competition Title: ' . $competition_creation_form['title'] . '</br>';
      //echo 'First field label: ' . $competition_creation_form['fields'][0]->label . '</br>';
       

      $index = 0;  
      foreach( $form['fields'] as $field ) {
        //echo 'Field #' . $index . ': ' . $field->type. '<br/>';
        $index++; 
        //die;  
      } 
    }

  }
}

function aria_dynamically_populate_teachers($value) {
  $teachers = "harris";  
  //$teachers = array('harris', 'leverington', 'sengupta', 'dascalu');
  return $teachers;  
}

register_activation_hook(__FILE__, 'aria_activation_func'); 
