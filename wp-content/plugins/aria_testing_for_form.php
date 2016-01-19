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
      
      $first_name_field = new GF_Field_Text();
      $first_name_field->label = "First name: ";
      $first_name_field->id = 1;
      $first_name_field->isRequired = true;
      $first_name_field->size = 'medium';

      $competition_creation_form['fields'][] = $first_name_field;

      $result = GFAPI::add_form($competition_creation_form->createFormArray());
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
