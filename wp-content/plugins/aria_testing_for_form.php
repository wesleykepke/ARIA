<?php
/*
Plugin Name: Aria: Testing if form exists
Plugin URI: http://google.com
Description: Checks to see if the Gravity Forms plugin is enabled.  
Author: Wes
Version: 1.2
Author URI: http://wkepke.com
*/


register_activation_hook(__FILE__, array('Aria','aria_activation_func')); 
add_action("gform_after_submission", array('Aria', "aria_create_competition"), 10, 2);

class Aria {
  public static $competition_creation_form_id = -1;

  public static function aria_activation_func() {
    require_once(ABSPATH . 'wp-admin/includes/plugin.php');
    if (is_plugin_active('gravityforms/gravityforms.php')) {  

      // Get all forms from gravity forms
      $forms = GFAPI::get_forms();

      // Set the form index of the Competition Creation Form.
      $competition_creation_form_title = "ARIA: Create a Competition";
      $index = -1;

      // Loop through each form to see if the form was previously created.
      foreach ($forms as $form) {
        if($form['title'] == "ARIA: Create a Competition") {
          $index =  $form['id'];
        }
      }

      // form does not exist; create new form 
      if ($index == -1) {
        $result = Aria::aria_create_competition_form();
      }
    }
  }

  public static function aria_create_competition_form() {
    $competition_creation_form 
        = new GF_Form("ARIA: Create a Competition", "");
    
    // Name Field
    $competition_name_field = new GF_Field_Text();
    $competition_name_field->label = "Name of Competition";
    $competition_name_field->id = 1;
    $competition_name_field->isRequired = true;

    // Date of the competition
    $competition_date_field = new GF_Field_Date();
    $competition_date_field->label = "Date of Competition";
    $competition_date_field->id = 2;
    $competition_date_field->isRequired = false;
    $competition_date_field->calendarIconType = 'calendar';
    $competition_date_field->dateType = 'datepicker';


    // Location
    $competition_location_field = new GF_Field_Address();
    $competition_location_field->label = "Location of Competition";
    $competition_location_field->id = 3;
    $competition_location_field->isRequired = false;
    $competition_location_field = Aria::aria_add_default_address_inputs($competition_location_field);
    
    // Student Registration start date
    $student_registration_start_date_field = new GF_Field_Date();
    $student_registration_start_date_field->label = "Student Registration Start Date";
    $student_registration_start_date_field->id = 4;
    $student_registration_start_date_field->isRequired = false;
    $student_registration_start_date_field->calendarIconType = 'calendar';
    $student_registration_start_date_field->dateType = 'datepicker';


    // Student Registration deadline
    $student_registration_end_date_field = new GF_Field_Date();
    $student_registration_end_date_field->label = "Student Registration End Date";
    $student_registration_end_date_field->id = 5;
    $student_registration_end_date_field->isRequired = false;
    $student_registration_end_date_field->calendarIconType = 'calendar';
    $student_registration_end_date_field->dateType = 'datepicker';


    // Teacher Registration start date
    $teacher_registration_start_date_field = new GF_Field_Date();
    $teacher_registration_start_date_field->label = "Teacher Registration Start Date";
    $teacher_registration_start_date_field->id = 6;
    $teacher_registration_start_date_field->isRequired = false;
    $teacher_registration_start_date_field->calendarIconType = 'calendar';
    $teacher_registration_start_date_field->dateType = 'datepicker';


    // Teacher Registration deadline
    $teacher_registration_end_date_field = new GF_Field_Date();
    $teacher_registration_end_date_field->label = "Teacher Registration Start Date";
    $teacher_registration_end_date_field->id = 7;
    $teacher_registration_end_date_field->isRequired = false;
    $teacher_registration_end_date_field->calendarIconType = 'calendar';
    $teacher_registration_end_date_field->dateType = 'datepicker';


    $competition_creation_form->fields[] = $competition_name_field;
    $competition_creation_form->fields[] = $competition_date_field;
    $competition_creation_form->fields[] = $competition_location_field;
    $competition_creation_form->fields[] = $student_registration_start_date_field;
    $competition_creation_form->fields[] = $student_registration_end_date_field;
    $competition_creation_form->fields[] = $teacher_registration_start_date_field;
    $competition_creation_form->fields[] = $teacher_registration_end_date_field;

    $result = GFAPI::add_form($competition_creation_form->createFormArray());
    Aria::$competition_creation_form_id = intval($result);
    wp_die(Aria::$competition_creation_form_id);
    

    // This is done after the form has been added so that the initial confirmation
    // hash has been added to the object.
    $added_competition_creation_form = GFAPI::get_form(intval($result));
    foreach ($added_competition_creation_form['confirmations'] as $key => $value) {
      $added_competition_creation_form['confirmations'][$key]['message'] 
        = "Thanks for contacting us! We will get in touch with you shortly.";
      $added_competition_creation_form['confirmations'][$key]['type'] = "message";
      break;
    }
    GFAPI::update_form($added_competition_creation_form);

    return $result;
  }

  public static function aria_create_competition( $entry, $form ) {
    wp_die(Aria::$competition_creation_form_id);
    if ($form['id'] == Aria::$competition_creation_form_id) {
      $competition_student_form 
        = new GF_Form( "Student Registration", "");
      $result = GFAPI::add_form($competition_student_form->createFormArray());
    }
  }

  public static function aria_add_default_address_inputs($field) {
    $field->inputs = array(
      array("id" => "{$field->id}.1",
            "label" => "Street Address",
            "name" => ""),
      array("id" => "{$field->id}.2",
            "label" => "Address Line 2",
            "name" => ""),
      array("id" => "{$field->id}.3",
            "label" => "City",
            "name" => ""),
      array("id" => "{$field->id}.4",
            "label" => "State \/ Province",
            "name" => ""),
      array("id" => "{$field->id}.5",
            "label" => "ZIP \/ Postal Code",
            "name" => ""),
      array("id" => "{$field->id}.6",
            "label" => "Country",
            "name" => ""),
    );

    return $field;
  }

};
