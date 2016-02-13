<?php

/**
 * The file that defines create master forms functionality. Master forms will
 * serve as the systems source of truth for each competition.
 *
 * @link       http://wesleykepke.github.io/ARIA/
 * @since      1.0.0
 *
 * @package    ARIA
 * @subpackage ARIA/includes
 */

// Require the ARIA API
//require_once("class-aria-api.php");
require_once("class-aria-registration-handler.php");
require_once("class-aria-create-competition.php");

/**
 * The aria form hooks class.
 *
 * @since      1.0.0
 * @package    ARIA
 * @subpackage ARIA/includes
 * @author     KREW
 */
class ARIA_Form_Hooks {
  /**
   * This function will be the hook that is called after a student public form
   * entry is made. This is to get all information from the student form and
   * make updates in the teacher master and the student master form.
   *
   * This can be used as such:
   * add_action(
   * 'gform_after_submission_x', 'aria_after_student_submission', 10, 2
   * );
   *
   * @param  $form   GF Forms Object   The form this function is attached to.
   * @param  $entry   GF Entry Object  The entry that is returned after form submission.
   *
   * @since 1.0.0
   * @author KREW
   */
  public static function aria_after_student_submission($form, $entry) {
    // Get the forms that are related to this form
    $related_forms = ARIA_Registration_Handler::aria_find_related_forms_ids($form["title"]);
    print_r($related_forms);

    // Find out the information associated with the $entry variable
    $student_fields = ARIA_Create_Competition::aria_student_field_id_array();
    $teacher_master_fields = ARIA_Create_Master_Forms::aria_master_teacher_field_id_array();

    // Hash for teacher (just has the teacher name)
    $teacher_hash = hash("md5", $entry[$student_fields["teacher_name"]]);

    // Hash for student (student name and entry date)
    $student_name_and_entry = $entry[$student_fields["student_name"]];
    $student_name_and_entry .= $entry[$student_fields["date_created"]];
    $student_hash = hash("md5", $student_name_and_entry);

    // Search through the teacher form to see if the teacher has an entry made
    $teacher_entry = ARIA_Registration_Handler::aria_find_teacher_entry($form["title"], $teacher_hash);
    $teacher_master_fields = ARIA_Create_Master_Forms::aria_master_teacher_field_id_array();

		// If the teacher exists, add the student hash to the students array
    if ($teacher_entry !== false) {
      $teacher_entry[(string) $teacher_master_fields["students"]][] = $student_hash;
    }

		// If not make a new entry in the form
		if (!$teacher_exists) {
      $new_teacher_entry = array();
			$new_teacher_entry[] = array (
        (string) $teacher_master_fields["name"] => $entry[(string) $student_fields["not_listed_teacher_name"]],
				(string) $teacher_master_fields["email"] => null,
				(string) $teacher_master_fields["phone"] => null,
				(string) $teacher_master_fields["volunteer_preference"] => null,
				(string) $teacher_master_fields["volunteer_time"] => null,
				(string) $teacher_master_fields["students"] => array($student_hash),
				(string) $teacher_master_fields["is_judging"] => null,
				(string) $teacher_master_fields["hash"] => null
      );
			$teacher_result = GFAPI::add_entries($new_teacher_entry, $related_forms[ARIA_Registration_Handler::$TEACHER_FORM]);
			if (is_wp_error($teacher_result)) {
        wp_die($teacher_result->get_error_message());
      }
		}

    // Make a new student master entry with the student hash
    $new_student_master_entry = array();
		$new_student_master_entry[] = array(
      (string) $student_fields["parent_name"] => $entry[(string) $student_fields["parent_name"]],
      (string) $student_fields["parent_email"] => $entry[(string) $student_fields["parent_email"]],
      (string) $student_fields["student_name"] => $entry[(string) $student_fields["student_name"]],
      (string) $student_fields["student_birthday"] => $entry[(string) $student_fields["student_birthday"]],
      (string) $student_fields["teacher_name"] => $entry[(string) $student_fields["teacher_name"]],
      (string) $student_fields["not_listed_teacher_name"] => $entry[(string) $student_fields["not_listed_teacher_name"]],
      (string) $student_fields["available_festival_days"] => $entry[(string) $student_fields["available_festival_days"]],
      (string) $student_fields["preferred_command_performance"] => $entry[(string) $student_fields["preferred_command_performance"]],
      (string) $student_fields["song_1_period"] => $entry[(string) $student_fields["song_1_period"]],
      (string) $student_fields["song_1_composer"] => $entry[(string) $student_fields["song_1_composer"]],
      (string) $student_fields["song_1_selection"] => $entry[(string) $student_fields["song_1_selection"]],
      (string) $student_fields["song_2_period"] => $entry[(string) $student_fields["song_2_period"]],
      (string) $student_fields["song_2_composer"] => $entry[(string) $student_fields["song_2_composer"]],
      (string) $student_fields["song_2_selection"] => $entry[(string) $student_fields["song_2_selection"]],
      (string) $student_fields["theory_score"] => $entry[(string) $student_fields["theory_score"]],
      (string) $student_fields["alternate_theory"] => $entry[(string) $student_fields["alternate_theory"]],
      (string) $student_fields["competition_format"] => $entry[(string) $student_fields["competition_format"]],
      (string) $student_fields["timing_of_pieces"] => $entry[(string) $student_fields["timing_of_pieces"]],
      (string) $student_fields["hash"] => $entry[(string) $student_fields["hash"]]
    );
    $student_result = GFAPI::add_entries($new_student_master_entry,
                      $related_forms[ARIA_Registration_Handler::$STUDENT_MASTER]);
		if (is_wp_error($student_result)) {
      wp_die($student_result->get_error_message());
		}
  }

  public static function aria_before_teacher_render($form) {
    // Get the query variables from the link
      // If they dont exist redirect to home

    // Get the forms that are related to this form

    // Check if the variables exist as a teacher-student combination
      // If they dont exist redirect home.
  }

  public static function aria_after_teacher_submission($form, $entry) {
    // Get the forms that are related to this form

    // Update the teacher entry in the teacher master.

    // Update the student entry in the student master.
  }

}
