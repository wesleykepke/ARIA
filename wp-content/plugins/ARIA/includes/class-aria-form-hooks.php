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
	 * @param	$form		GF Forms Object		The form this function is attached to.
	 * @param $entry 	GF Entry Object 	The entry that is returned after form submission.
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
		// If the teacher exists, add the student hash to the students array
		if ($teacher_entry != false) {
				$teacher_entry[(string) teacher_master_fields['students']][] = $student_hash;
		}
    
		// If not make a new entry in the form
		if (!$teacher_exists) {

		}

    // Make a new student master entry with the student hash
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
