<?php
/*
Plugin Name: Aria: Testing For Form
Plugin URI: http://google.com
Description: Checks to see if the Gravity Forms plugin is enabled.  
Author: Wes
Version: 2.2
Author URI: http://wkepke.com
*/

global $new_form_id;
$new_form_id = -100;

class Aria {
  //public static $competition_creation_form_id = -1;

  public static function aria_activation_func() {
    require_once(ABSPATH . 'wp-admin/includes/plugin.php');
    if (is_plugin_active('gravityforms/gravityforms.php')) {  
      wp_die("HERE");

      self::aria_create_teacher_form("Sample Created");
      self::aria_create_student_form("Sample Created");

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
        $result = self::aria_create_competition_form();
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
    $competition_location_field = self::aria_add_default_address_inputs($competition_location_field);
    
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
    global $new_form_id;
    $new_form_id = $result; 

    //static::$competition_creation_form_id = intval($result);

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

    //static::$competition_creation_form_id = intval($result);

    return $result;
  }

  public static function aria_initialize_confirmation($form_id) {
    $added_competition_creation_form = GFAPI::get_form(intval($form_id));
    foreach ($added_competition_creation_form['confirmations'] as $key => $value) {
      $added_competition_creation_form['confirmations'][$key]['message'] 
        = "Thanks for contacting us! We will get in touch with you shortly.";
      $added_competition_creation_form['confirmations'][$key]['type'] = "message";
      break;
    }
    GFAPI::update_form($added_competition_creation_form);
  }

  public static function aria_create_teacher_form( $competition_name ) {
    $teacher_form = new GF_Form("{$competition_name} Teacher Registration", "");
    $field_id = 1;

    $teacher_name_field = new GF_Field_Name();
    $teacher_name_field->label = "Name";
    $teacher_name_field->id = $field_id++;
    $teacher_name_field->isRequired = true;
    $teacher_form->fields[] = $teacher_name_field;

    $teacher_email_field = new GF_Field_Email();
    $teacher_email_field->label = "Email";
    $teacher_email_field->id = $field_id++;
    $teacher_email_field->isRequired = true;
    $teacher_form->fields[] = $teacher_email_field;

    $teacher_phone_field = new GF_Field_Phone();
    $teacher_phone_field->label = "Phone";
    $teacher_phone_field->id = $field_id++;
    $teacher_phone_field->isRequired = true;
    $teacher_form->fields[] = $teacher_phone_field;

    $volunteer_preference_field = new GF_Field_Checkbox();
    $volunteer_preference_field->label = "Volunteer Preference";
    $volunteer_preference_field->id = $field_id++;
    $volunteer_preference_field->isRequired = true;
    $volunteer_preference_field->choices = array(
      array('text' => 'Section Proctor', 'value' => 'Section Proctor', 'isSelected' => false),
      array('text' => 'Posting Results', 'value' => 'Posting Results', 'isSelected' => false),
      array('text' => 'Information Table', 'value' => 'Information Table', 'isSelected' => false),
      array('text' => 'Greeting and Assisting with Locating Rooms', 'value' => 'Greeting', 'isSelected' => false),
      array('text' => 'Hospitality (managing food in judges rooms)', 'value' => 'Hospitality', 'isSelected' => false)
    );
    $volunteer_preference_field->description = "Please check 1 time slot if you"
    ." have 1-3 students competing, 2 time slots if you have 4-6 students"
    ." competing, and 3 time slots if you have more than 6 students competing.";
    $teacher_form->fields[] = $volunteer_preference_field;

    $volunteer_time_field = new GF_Field_Checkbox();
    $volunteer_time_field->label = "Times Available for Volunteering";
    $volunteer_time_field->id = $field_id++;
    $volunteer_time_field->isRequired = false;
    $teacher_form->fields[] = $volunteer_time_field;

    $student_name_field = new GF_Field_Name();
    $student_name_field->label = "Student Name";
    $student_name_field->id = $field_id++;
    $student_name_field->isRequired = true;
    $teacher_form->fields[] = $student_name_field;

    $student_theory_score = new GF_Field_Number();
    $student_theory_score->label = "Theory Score (percentage)";
    $student_theory_score->id = $field_id++;
    $student_theory_score->isRequired = false;
    $student_theory_score->numberFormat = "decimal_dot";
    $student_theory_score->rangeMin = 0;
    $student_theory_score->rangeMax = 100;
    $teacher_form->fields[] = $student_theory_score;

    $alternate_theory_field = new GF_Field_Checkbox();
    $alternate_theory_field->label = "Check if alternate theory exam was completed.";
    $alternate_theory_field->id = $field_id++;
    $alternate_theory_field->isRequired = false;
    $alternate_theory_field->choices = array(
      array('text' => 'Alternate theory exam completed', 'value' => 'Alternate theory exam completed', 'isSelected' => false)
    );
    $teacher_form->fields[] = $alternate_theory_field;

    $competition_format_field = new GF_Field_Radio();
    $competition_format_field->label = "Format of Competition";
    $competition_format_field->id = $field_id++;
    $competition_format_field->isRequired = false;
    $competition_format_field->choices = $volunteer_preference_field->choices = array(
      array('text' => 'Traditional', 'value' => 'Traditional', 'isSelected' => false),
      array('text' => 'Competitive', 'value' => 'Competitive', 'isSelected' => false),
      array('text' => 'Master Class (if upper level)', 'value' => 'Master Class', 'isSelected' => false)
    );
    $teacher_form->fields[] = $competition_format_field;

    $timing_of_pieces_field = new GF_Field_Number();
    $timing_of_pieces_field->label = "Timing of pieces (minutes)";
    $timing_of_pieces_field->id = $field_id++;
    $timing_of_pieces_field->isRequired = false;
    $timing_of_pieces_field->numberFormat = "decimal_dot";
    $teacher_form->fields[] = $timing_of_pieces_field;

    $result = GFAPI::add_form($teacher_form->createFormArray());
    self::aria_initialize_confirmation($result);
  }

  public static function aria_create_student_form( $competition_name ) {
    $student_form = new GF_Form("{$competition_name} Student Registration", "");
    $field_id = 1;

    $parent_name_field = new GF_Field_Name();
    $parent_name_field->label = "Parent Name";
    $parent_name_field->id = $field_id++;
    $parent_name_field->isRequired = true;
    $parent_form->fields[] = $parent_name_field;

    $parent_email_field = new GF_Field_Email();
    $parent_email_field->label = "Parent's Email";
    $parent_email_field->id = $field_id++;
    $parent_email_field->isRequired = true;
    $student_form->fields[] = $parent_email_field;

    $student_name_field = new GF_Field_Name();
    $student_name_field->label = "Student Name";
    $student_name_field->description = "Please capitalize your child's first ".
    "and last names and double check the spelling.  The way you type the name ".
    "here is the way it will appear on all awards and in the Command ".
    "Performance program.";
    $student_name_field->id = $field_id++;
    $student_name_field->isRequired = true;
    $student_form->fields[] = $student_name_field;

    $student_birthday_date_field = new GF_Field_Date();
    $student_birthday_date_field->label = "Student Birthday";
    $student_birthday_date_field->id = $field_id++;
    $student_birthday_date_field->isRequired = true;
    $student_birthday_date_field->calendarIconType = 'calendar';
    $student_birthday_date_field->dateType = 'datepicker';
    $student_form->fields[] = $student_birthday_date_field;

    $piano_teachers_field = new GF_Field_Select();
    $piano_teachers_field->label = "Piano Teacher's Name";
    $piano_teachers_field->id = $field_id++;
    $piano_teachers_field->isRequired = false;
    $piano_teachers_field->description = "TBD";
    $student_form->fields[] = $student_birthday_date_field;

    $teacher_missing_field = new GF_Field_Text();
    $teacher_missing_field->label = "If your teacher's name is not listed, ".
    "enter name below.";
    $teacher_missing_field->id = $field_id++;
    $teacher_missing_field->isRequired = false;
    $student_form->fields[] = $teacher_missing_field;

    $available_times = new GF_Field_Checkbox();
    $available_times->label = "Available Festival Days (check all available times)";
    $available_times->id = $field_id++;
    $available_times->isRequired = true;
    $available_times->description = "There is no guarantee that scheduling ".
    "requests will be honored.";
    $available_times->choices = array(
      array('text' => 'Saturday', 'value' => 'Saturday', 'isSelected' => false),
      array('text' => 'Sunday', 'value' => 'Sunday', 'isSelected' => false)
    );
    $student_form->fields[] = $available_times;

    $command_times = new GF_Field_Checkbox();
    $command_times->label = "Preferred Command Performance Time (check all available times)";
    $command_times->id = $field_id++;
    $command_times->isRequired = true;
    $command_times->description = "Please check the Command Performance time ".
    "that you prefer in the event that your child receives a superior rating.";
    $command_times->choices = array(
      array('text' => 'Thursday 5:30', 'value' => 'Saturday', 'isSelected' => false),
      array('text' => 'Thursday 7:30', 'value' => 'Sunday', 'isSelected' => false)
    );
    $student_form->fields[] = $available_times;

    $compliance_field = new GF_Field_checkbox();
    $compliance_field->label = "Compliance Statement";
    $compliance_field->id = $field_id++;
    $compliance_field->isRequired = true;
    $compliance_field->description = "As a parent, I understand and agree to ".
    "comply with all rules, regulations, and amendments as stated in the ".
    "Festival syllabus. I am in full compliance with the laws regarding ".
    "photocopies and can provide verification of authentication of any legally ".
    "printed music. I understand that adjudicator decisions are final and ".
    "will not be contested. I know that small children may not remain in the ".
    "room during performances of non-family members. I understand that ".
    "requests for specific days/times will be scheduled if possible but cannot".
    " be guaranteed.";
    $compliance_field->choices = array(
      array('text' => 'I have read and agree with the following statement:', 'value' => 'Agree', 'isSelected' => false),
    );
    $student_form->fields[] = $compliance_field;

    $result = GFAPI::add_form($student_form->createFormArray());
    self::aria_initialize_confirmation($result);
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

  public static function aria_get_comp_id() {
    return static::$competition_creation_form_id; 
  }

};

register_activation_hook(__FILE__, array('Aria','aria_activation_func')); 

function aria_create_competition($entry, $form ) {
   // wp_die(self::$competition_creation_form_id);
    //echo self::$competition_creation_form_id . "<br>"; 

    global $new_form_id;

    if ($form['id'] == $new_form_id) {
    //if ($form['id'] == $form_id) {
      $competition_student_form 
        = new GF_Form( "Student Registration", "");
      $result = GFAPI::add_form($competition_student_form->createFormArray());
    }
    else {
      echo "form's id: " . $form['id'] . "<br>";
      echo "global form id: " . $new_form_id;
      die; 
    } 
}

add_action('gform_after_submission', 'aria_create_competition', 10, 2);

//wp_die("Form id: " . $global_form_id);

//add_action("gform_after_submission_" . $global_form_id, "Aria::aria_create_competition", 10, 2);
//add_action("gform_after_submission_138", "Aria::aria_create_competition", 10, 2);

/*
register_activation_hook(__FILE__, array(&$aria_instance,'aria_activation_func')); 
add_action("gform_after_submission", array('Aria', "aria_create_competition"), 10, 2);
*/