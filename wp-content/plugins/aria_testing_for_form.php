<?php
/*
Plugin Name: Aria: Testing For Form
Plugin URI: http://google.com
Description: Checks to see if the Gravity Forms plugin is enabled.  
Author: Wes
Version: 2.2
Author URI: http://wkepke.com
*/

$new_form_id;
$new_form_id = -100;

function aria_activation_func() {
  require_once(ABSPATH . 'wp-admin/includes/plugin.php');
  if (is_plugin_active('gravityforms/gravityforms.php')) {  

    aria_create_teacher_form("Sample Created");
    aria_create_student_form("Sample Created");

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
      $result = aria_create_competition_form();
    }
  }
}

function aria_initialize_confirmation($form_id) {
  $added_competition_creation_form = GFAPI::get_form(intval($form_id));
  foreach ($added_competition_creation_form['confirmations'] as $key => $value) {
    $added_competition_creation_form['confirmations'][$key]['message'] 
      = "Thanks for contacting us! We will get in touch with you shortly.";
    $added_competition_creation_form['confirmations'][$key]['type'] = "message";
    break;
  }
  GFAPI::update_form($added_competition_creation_form);
}

function aria_teacher_field_id_array() {
  // CAUTION, This array is used as a source of truth. Changing these values may
  // result in catastrophic failure. If you do not want to feel the bern, 
  // consult an aria developer before making changes to this portion of code.
  $arr = new array(
  'name' => 1,
  'email' => 2,
  'phone' => 3,
  'volunteer_preference' => 4,
  'volunteer_time' => 5,
  'student_name' => 6,
  'song_1_period' => 7,
  'song_1_composer' => 8,
  'song_1_selection' => 9,
  'song_2_period' => 10,
  'song_2_composer' => 11,
  'song_2_selection' => 12,
  'theory_score' => 13,
  'alternate_theory' => 14,
  'competition_format' => 15,
  'timing_of_pieces' => 16
  );
  return $arr;
}

function aria_create_teacher_form( $competition_name ) {
  $teacher_form = new GF_Form("{$competition_name} Teacher Registration", "");
  $field_id_arr = aria_teacher_field_id_array();

  $teacher_name_field = new GF_Field_Name();
  $teacher_name_field->label = "Name";
  $teacher_name_field->id = field_id_arr['name'];
  $teacher_name_field->isRequired = true;
  $teacher_form->fields[] = $teacher_name_field;

  $teacher_email_field = new GF_Field_Email();
  $teacher_email_field->label = "Email";
  $teacher_email_field->id = field_id_arr['email'];
  $teacher_email_field->isRequired = true;
  $teacher_form->fields[] = $teacher_email_field;

  $teacher_phone_field = new GF_Field_Phone();
  $teacher_phone_field->label = "Phone";
  $teacher_phone_field->id = field_id_arr['phone'];
  $teacher_phone_field->isRequired = true;
  $teacher_form->fields[] = $teacher_phone_field;

  $volunteer_preference_field = new GF_Field_Checkbox();
  $volunteer_preference_field->label = "Volunteer Preference";
  $volunteer_preference_field->id = field_id_arr['volunteer_preference'];
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
  $volunteer_time_field->id = field_id_arr['volunteer_time'];
  $volunteer_time_field->isRequired = false;
  $teacher_form->fields[] = $volunteer_time_field;

  $student_name_field = new GF_Field_Name();
  $student_name_field->label = "Student Name";
  $student_name_field->id = field_id_arr['student_name'];
  $student_name_field->isRequired = true;
  $teacher_form->fields[] = $student_name_field;

  $song_one_period_field = new GF_Field_Select();
  $song_one_period_field->label = "Song 1 Period";
  $song_one_period_field->id = field_id_arr['song_1_period'];
  $song_one_period_field->isRequired = true;
  $teacher->form->fields[] = $song_one_period_field;

  $song_one_composer_field = new GF_Field_Select();
  $song_one_composer_field->label = "Song 1 Composer";
  $song_one_composer_field->id = field_id_arr['song_1_composer'];
  $song_one_composer_field->isRequired = true;
  $teacher->form->fields[] = $song_one_composer_field;

  $song_one_selection_field = new GF_Field_Select();
  $song_one_selection_field->label = "Song 1 Selection";
  $song_one_selection_field->id = field_id_arr['song_1_selection'];
  $song_one_selection_field->isRequired = true;
  $teacher->form->fields[] = $song_one_selection_field;

  $song_two_period_field = new GF_Field_Select();
  $song_two_period_field->label = "Song 2 Period";
  $song_two_period_field->id = field_id_arr['song_2_period'];
  $song_two_period_field->isRequired = true;
  $teacher->form->fields[] = $song_two_period_field;

  $song_two_composer_field = new GF_Field_Select();
  $song_two_composer_field->label = "Song 2 Composer";
  $song_two_composer_field->id = field_id_arr['song_2_composer'];
  $song_two_composer_field->isRequired = true;
  $teacher->form->fields[] = $song_two_composer_field;

  $song_two_selection_field = new GF_Field_Select();
  $song_two_selection_field->label = "Song 2 Selection";
  $song_two_selection_field->id = field_id_arr['song_2_selection'];
  $song_two_selection_field->isRequired = true;
  $teacher->form->fields[] = $song_two_selection_field;

  $student_theory_score = new GF_Field_Number();
  $student_theory_score->label = "Theory Score (percentage)";
  $student_theory_score->id = field_id_arr['theory_score'];
  $student_theory_score->isRequired = false;
  $student_theory_score->numberFormat = "decimal_dot";
  $student_theory_score->rangeMin = 0;
  $student_theory_score->rangeMax = 100;
  $teacher_form->fields[] = $student_theory_score;

  $alternate_theory_field = new GF_Field_Checkbox();
  $alternate_theory_field->label = "Check if alternate theory exam was completed.";
  $alternate_theory_field->id = field_id_arr['alternate_theory'];
  $alternate_theory_field->isRequired = false;
  $alternate_theory_field->choices = array(
    array('text' => 'Alternate theory exam completed', 'value' => 'Alternate theory exam completed', 'isSelected' => false)
  );
  $teacher_form->fields[] = $alternate_theory_field;

  $competition_format_field = new GF_Field_Radio();
  $competition_format_field->label = "Format of Competition";
  $competition_format_field->id = field_id_arr['competition_format'];
  $competition_format_field->isRequired = false;
  $competition_format_field->choices = $volunteer_preference_field->choices = array(
    array('text' => 'Traditional', 'value' => 'Traditional', 'isSelected' => false),
    array('text' => 'Competitive', 'value' => 'Competitive', 'isSelected' => false),
    array('text' => 'Master Class (if upper level)', 'value' => 'Master Class', 'isSelected' => false)
  );
  $teacher_form->fields[] = $competition_format_field;

  $timing_of_pieces_field = new GF_Field_Number();
  $timing_of_pieces_field->label = "Timing of pieces (minutes)";
  $timing_of_pieces_field->id = field_id_arr['timing_of_pieces'];
  $timing_of_pieces_field->isRequired = false;
  $timing_of_pieces_field->numberFormat = "decimal_dot";
  $teacher_form->fields[] = $timing_of_pieces_field;

  $result = GFAPI::add_form($teacher_form->createFormArray());
  aria_initialize_confirmation($result);
}

function aria_student_field_id_array() {
  // CAUTION, This array is used as a source of truth. Changing these values may
  // result in catastrophic failure. If you do not want to feel the bern, 
  // consult an aria developer before making changes to this portion of code.
   $arr = new array(
    'parent_name' => 1,
    'parent_email' => 2,
    'student_name' => 3,
    'student_birthday' => 4,
    'teacher_name' => 5,
    'not_listed_teacher_name' => 6,
    'available_festival_days' => 7,
    'preferred_command_performance' => 8,
    'compliance_statement' => 9
  );
  return arr;
}

function aria_create_student_form( $competition_name ) {
  $student_form = new GF_Form("{$competition_name} Student Registration", "");
  $field_id_array = aria_student_field_id_array();

  $parent_name_field = new GF_Field_Name();
  $parent_name_field->label = "Parent Name";
  $parent_name_field->id = $field_id_array['parent_name'];
  $parent_name_field->isRequired = true;
  $parent_form->fields[] = $parent_name_field;

  $parent_email_field = new GF_Field_Email();
  $parent_email_field->label = "Parent's Email";
  $parent_email_field->id = $field_id_array['parent_email'];
  $parent_email_field->isRequired = true;
  $student_form->fields[] = $parent_email_field;

  $student_name_field = new GF_Field_Name();
  $student_name_field->label = "Student Name";
  $student_name_field->description = "Please capitalize your child's first ".
  "and last names and double check the spelling.  The way you type the name ".
  "here is the way it will appear on all awards and in the Command ".
  "Performance program.";
  $student_name_field->id = $field_id_array['student_name'];
  $student_name_field->isRequired = true;
  $student_form->fields[] = $student_name_field;

  $student_birthday_date_field = new GF_Field_Date();
  $student_birthday_date_field->label = "Student Birthday";
  $student_birthday_date_field->id = $field_id_array['student_birthday'];
  $student_birthday_date_field->isRequired = true;
  $student_birthday_date_field->calendarIconType = 'calendar';
  $student_birthday_date_field->dateType = 'datepicker';
  $student_form->fields[] = $student_birthday_date_field;

  $piano_teachers_field = new GF_Field_Select();
  $piano_teachers_field->label = "Piano Teacher's Name";
  $piano_teachers_field->id = $field_id_array['teacher_name'];
  $piano_teachers_field->isRequired = false;
  $piano_teachers_field->description = "TBD";
  $student_form->fields[] = $piano_teachers_field;

  $teacher_missing_field = new GF_Field_Text();
  $teacher_missing_field->label = "If your teacher's name is not listed, ".
  "enter name below.";
  $teacher_missing_field->id = $field_id_array['not_listed_teacher_name'];
  $teacher_missing_field->isRequired = false;
  $student_form->fields[] = $teacher_missing_field;

  $available_times = new GF_Field_Checkbox();
  $available_times->label = "Available Festival Days (check all available times)";
  $available_times->id = $field_id_array['available_festival_days'];
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
  $command_times->id = $field_id_array['preferred_command_performance'];
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
  $compliance_field->id = $field_id_array['compliance_statement'];
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
  aria_initialize_confirmation($result);
}

function aria_add_default_address_inputs($field) {
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

function aria_create_competition_field_id_array() {
  $arr = new array(
    'competition_name' => 1,
    'competition_start_date' => 2,
    'competition_location' => 3,
    'student_registration_start_date' => 4,
    'student_registration_end_date' => 5,
    'teacher_registration_start_date' => 6,
    'teacher_registration_end_date' => 7,
    'competition_end_date' => 8
  );
  return $arr;
}

function aria_create_competition_form() {
  $competition_creation_form 
      = new GF_Form("ARIA: Create a Competition", "");
  $field_id_array = aria_create_competition_field_id_array();

  // Name Field
  $competition_name_field = new GF_Field_Text();
  $competition_name_field->label = "Name of Competition";
  $competition_name_field->id = field_id_array['competition_name'];
  $competition_name_field->isRequired = true;

  // Start Date of the competition
  $competition_start_date_field = new GF_Field_Date();
  $competition_start_date_field->label = "Date of Competition";
  $competition_start_date_field->id = field_id_array['competition_start_date'];
  $competition_start_date_field->isRequired = false;
  $competition_start_date_field->calendarIconType = 'calendar';
  $competition_start_date_field->dateType = 'datepicker';

  // End Date of the competition
  $competition_end_date_field = new GF_Field_Date();
  $competition_end_date_field->label = "Date of Competition";
  $competition_end_date_field->id = field_id_array['competition_end_date'];
  $competition_end_date_field->isRequired = false;
  $competition_end_date_field->calendarIconType = 'calendar';
  $competition_end_date_field->dateType = 'datepicker';

  // Location
  $competition_location_field = new GF_Field_Address();
  $competition_location_field->label = "Location of Competition";
  $competition_location_field->id = field_id_array['competition_location'];
  $competition_location_field->isRequired = false;
  $competition_location_field = aria_add_default_address_inputs($competition_location_field);
  
  // Student Registration start date
  $student_registration_start_date_field = new GF_Field_Date();
  $student_registration_start_date_field->label = "Student Registration Start Date";
  $student_registration_start_date_field->id = field_id_array['student_registration_start_date'];
  $student_registration_start_date_field->isRequired = false;
  $student_registration_start_date_field->calendarIconType = 'calendar';
  $student_registration_start_date_field->dateType = 'datepicker';

  // Student Registration deadline
  $student_registration_end_date_field = new GF_Field_Date();
  $student_registration_end_date_field->label = "Student Registration End Date";
  $student_registration_end_date_field->id = field_id_array['student_registration_end_date'];
  $student_registration_end_date_field->isRequired = false;
  $student_registration_end_date_field->calendarIconType = 'calendar';
  $student_registration_end_date_field->dateType = 'datepicker';

  // Teacher Registration start date
  $teacher_registration_start_date_field = new GF_Field_Date();
  $teacher_registration_start_date_field->label = "Teacher Registration Start Date";
  $teacher_registration_start_date_field->id = field_id_array['teacher_registration_start_date'];
  $teacher_registration_start_date_field->isRequired = false;
  $teacher_registration_start_date_field->calendarIconType = 'calendar';
  $teacher_registration_start_date_field->dateType = 'datepicker';

  // Teacher Registration deadline
  $teacher_registration_end_date_field = new GF_Field_Date();
  $teacher_registration_end_date_field->label = "Teacher Registration End Date";
  $teacher_registration_end_date_field->id = field_id_array['teacher_registration_end_date'];
  $teacher_registration_end_date_field->isRequired = false;
  $teacher_registration_end_date_field->calendarIconType = 'calendar';
  $teacher_registration_end_date_field->dateType = 'datepicker';

  $competition_creation_form->fields[] = $competition_name_field;
  $competition_creation_form->fields[] = $competition_start_date_field;
  $competition_creation_form->fields[] = $competition_end_date_field;
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

function aria_create_competition($entry, $form ) {
   // wp_die($competition_creation_form_id);
    //echo $competition_creation_form_id . "<br>"; 

    global $new_form_id;
    wp_die($new_form_id);

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

register_activation_hook(__FILE__, 'aria_activation_func'); 
add_action('gform_after_submission', 'aria_create_competition', 10, 2);
add_action('gform_after_submission', 'test_query_params', 10, 2);

function test_query_params($entry, $form) {
  if(isset($_GET['herp'])) {
    wp_die($_GET['herp']);
  }
}

//wp_die("Form id: " . $global_form_id);

//add_action("gform_after_submission_" . $global_form_id, "aria_create_competition", 10, 2);
//add_action("gform_after_submission_138", "aria_create_competition", 10, 2);

/*
register_activation_hook(__FILE__, array(&$aria_instance,'aria_activation_func')); 
add_action("gform_after_submission", array('Aria', "aria_create_competition"), 10, 2);
*/
