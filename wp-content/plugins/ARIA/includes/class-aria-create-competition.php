<?php

/**
 * The file that defines create competition functionality.
 *
 * A class definition that includes attributes and functions that allow the
 * festival chairman to create new music competitions for NNMTA.
 *
 * @link       http://wesleykepke.github.io/ARIA/
 * @since      1.0.0
 *
 * @package    ARIA
 * @subpackage ARIA/includes
 */

// Require the ARIA API
require_once("class-aria-api.php");

/**
 * The create competition class.
 *
 * @since      1.0.0
 * @package    ARIA
 * @subpackage ARIA/includes
 * @author     KREW
 */
class ARIA_Create_Competition {

  /**
   * This function will create the form that can create new competitions.
   *
   * This function is called in "class-aria-activator.php" and is responsible for
   * creating the form that allows the festival chairman to create new music
   * competitions (if this form does not already exist). If no such form exists,
   * this function will create a new form designed specifically for creating new
   * music competitions.
   *
   * @since 1.0.0
   * @author KREW
   */
  public static function aria_create_competition_activation() {
    // if the form for creating music competitions doesn't exist, create a new form
    $form_id = aria_get_create_competition_form_id();
    if ($form_id === -1) {
      aria_create_competition_form();
    }
  }

  /**
   * This function will create new registration forms for students and parents.
   *
   * This function is responsible for creating new registration forms for both
   * students and parents. This function will only create new registration forms
   * for students and parents if it is used ONLY in conjunction with the form
   * used to create new music competitions.
   *
   * @param Entry Object  $entry  The entry that was just submitted
   * @param Form Object   $form   The form used to submit entries
   *
   * @since 1.0.0
   * @author KREW
   */
  public static function aria_create_teacher_and_student_forms($entry, $form) {
    // make sure the create competition form is calling this function
    if ($form['id'] === aria_get_create_competition_form_id()) {
      wp_die("NICE!");
      //aria_create_student_form($entry[$field_mapping['Name of Competition']]);
      //aria_create_teacher_form($entry[$field_mapping['Name of Competition']]);
    }
    else {
      wp_die('ERROR: No form currently exists that allows the festival chairman
      to create a new music competition');
    }
  }

  /**
   * This function will create a new form for creating music competitions.
   *
   * This function is responsible for creating and adding all of the associated
   * fields that are necessary for the festival chairman to create new music
   * competitions.
   *
   * @since 1.0.0
   * @author KREW
   */
  public static function aria_create_competition_form() {
    $competition_creation_form = new GF_Form("ARIA: Create a Competition", "");

    // name
    $competition_name_field = new GF_Field_Text();
    $competition_name_field->label = "Name of Competition";
    $competition_name_field->id = 1;
    $competition_name_field->isRequired = true;

    // date of the competition
    $competition_date_field = new GF_Field_Date();
    $competition_date_field->label = "Date of Competition";
    $competition_date_field->id = 2;
    $competition_date_field->isRequired = false;
    $competition_date_field->calendarIconType = 'calendar';
    $competition_date_field->dateType = 'datepicker';

    // location
    $competition_location_field = new GF_Field_Address();
    $competition_location_field->label = "Location of Competition";
    $competition_location_field->id = 3;
    $competition_location_field->isRequired = false;
    $competition_location_field = aria_add_default_address_inputs($competition_location_field);

    // student registration start date
    $student_registration_start_date_field = new GF_Field_Date();
    $student_registration_start_date_field->label = "Student Registration Start Date";
    $student_registration_start_date_field->id = 4;
    $student_registration_start_date_field->isRequired = false;
    $student_registration_start_date_field->calendarIconType = 'calendar';
    $student_registration_start_date_field->dateType = 'datepicker';

    // student registration deadline
    $student_registration_end_date_field = new GF_Field_Date();
    $student_registration_end_date_field->label = "Student Registration End Date";
    $student_registration_end_date_field->id = 5;
    $student_registration_end_date_field->isRequired = false;
    $student_registration_end_date_field->calendarIconType = 'calendar';
    $student_registration_end_date_field->dateType = 'datepicker';

    // teacher registration start date
    $teacher_registration_start_date_field = new GF_Field_Date();
    $teacher_registration_start_date_field->label = "Teacher Registration Start Date";
    $teacher_registration_start_date_field->id = 6;
    $teacher_registration_start_date_field->isRequired = false;
    $teacher_registration_start_date_field->calendarIconType = 'calendar';
    $teacher_registration_start_date_field->dateType = 'datepicker';

    // teacher registration deadline
    $teacher_registration_end_date_field = new GF_Field_Date();
    $teacher_registration_end_date_field->label = "Teacher Registration Start Date";
    $teacher_registration_end_date_field->id = 7;
    $teacher_registration_end_date_field->isRequired = false;
    $teacher_registration_end_date_field->calendarIconType = 'calendar';
    $teacher_registration_end_date_field->dateType = 'datepicker';

    // assign all of the previous attributes to our newly created form
    $competition_creation_form->fields[] = $competition_name_field;
    $competition_creation_form->fields[] = $competition_date_field;
    $competition_creation_form->fields[] = $competition_location_field;
    $competition_creation_form->fields[] = $student_registration_start_date_field;
    $competition_creation_form->fields[] = $student_registration_end_date_field;
    $competition_creation_form->fields[] = $teacher_registration_start_date_field;
    $competition_creation_form->fields[] = $teacher_registration_end_date_field;

    // custom submission message to let the festival chairman know the creation was
    // a success
    $successful_submission_message = 'Congratulations! A new music competition has been created.';
    $successful_submission_message .= ' There are now two new forms for students and teacher to use';
    $successful_submission_message .= ' for registration. The name for each new form is prepended with';
    $successful_submission_message .= ' the name of the new music competition previously created.';
    $competition_creation_form->confirmation['type'] = 'message';
    $competition_creation_form->confirmation['message'] = $successful_submission_message;

    // add the new form to the festival chairman's dashboard
    $new_form_id = GFAPI::add_form($competition_creation_form->createFormArray());

    // Make sure the new form was added without error
    if (is_wp_error($new_form_id)) {
      wp_die($new_form_id->get_error_message());
    }

    /*
    add a customized confirmation message

    this is done after the form has been added so that the initial confirmation
    hash has been added to the object
    */
    /*
    $added_competition_creation_form = GFAPI::get_form(intval($new_form_id));
    if (is_wp_error($added_competition_creation_form_id)) {
    wp_die($added_competition_creation_form->get_error_message());
    }

    $added_competition_creation_form->confirmation['type'] = 'message';
    $successful_submission_message = 'Congratulations! A new music competition has been created.';
    $successful_submission_message .= ' There are now two new forms for students and teacher to use';
    $successful_submission_message .= ' for registration. The name for each new form is prepended with';
    $successful_submission_message .= ' the name of the new music competition previously created.';
    $added_competition_creation_form->confirmation['message'] = $successful_submission_message;
    GFAPI::update_form($added_competition_creation_form);
    */
  }
}
