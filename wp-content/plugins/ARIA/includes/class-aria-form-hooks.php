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
	 *
   * @since 1.0.0
   * @author KREW
   */
  public static function aria_after_student_submission($form, $entry) {
    // Get the forms that are related to this form

    // Make hashes for teacher and student
      // Hash for teacher (just has the teacher name)
      // Hash for student (student name and entry date)

    // Search through the teacher form to see if the teacher has an entry made
      // If the teacher exists, add the student hash to the students array
      // If not make a new entry in the form

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
