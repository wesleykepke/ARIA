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
    $student_hash = get_query_var("student_hash", false);
    $teacher_hash = get_query_var("teacher_hash", false);

    // If they dont exist redirect to home
    if (!$student_hash || !$teacher_hash) {
      wp_redirect( home_url() );
      exit();
    }

    // Check if the variables exist as a teacher-student combination
    // If they dont exist redirect home.
    if (!ARIA_Registration_Handler::aria_check_student_teacher_relationship($form["title"], $student_hash, $teacher_hash)) {
      wp_redirect( home_url() );
      exit();
    }
  }

  public static function aria_after_teacher_submission($form, $entry) {
    // Get the query variables from the link
    $student_hash = get_query_var("student_hash", false);
    $teacher_hash = get_query_var("teacher_hash", false);

    // Get field id arrays
    $student_master_field_ids = ARIA_Create_Master_Forms::aria_master_student_field_id_array();
    $teacher_master_field_ids = ARIA_Create_Master_Forms::aria_master_teacher_field_id_array();
    $teacher_public_field_ids = ARIA_Create_Competition::aria_master_teacher_field_id_array();

    // Update the teacher entry in the teacher master.
    $teacher_master_entry = ARIA_Registration_Handler::aria_find_teacher_entry($form["title"], $teacher_hash);
    if (!teacher_entry) {
      wp_die("Error")
    }
    $teacher_master_entry[(string) $teacher_master_field_ids['name']] = $entry[(string) $teacher_public_field_ids['name']];
    $teacher_master_entry[(string) $teacher_master_field_ids['email']] = $entry[(string) $teacher_public_field_ids['email']];
    $teacher_master_entry[(string) $teacher_master_field_ids['phone']] = $entry[(string) $teacher_public_field_ids['phone']];
    $teacher_master_entry[(string) $teacher_master_field_ids['volunteer_preference']] = $entry[(string) $teacher_public_field_ids['volunteer_preference']];
    $teacher_master_entry[(string) $teacher_master_field_ids['volunteer_time']] = $entry[(string) $teacher_public_field_ids['volunteer_time']];
    $teacher_master_entry[(string) $teacher_master_field_ids['is_judging']] = $entry[(string) $teacher_public_field_ids['is_judging']];

    // Update the student entry in the student master.
    $student_master_entry = ARIA_Registration_Handler::aria_find_student_entry($form["title"], $student_hash);
    if (!student_entry) {
      wp_die("Error")
    }

    $student_master_entry[(string) $student_master_field_ids['student_name']] = $entry[(string) $teacher_public_field_ids['student_name']];
    $student_master_entry[(string) $student_master_field_ids['song_1_period']] = $entry[(string) $teacher_public_field_ids['song_1_period']];
    $student_master_entry[(string) $student_master_field_ids['song_1_composer']] = $entry[(string) $teacher_public_field_ids['song_1_composer']];
    $student_master_entry[(string) $student_master_field_ids['song_1_selection']] = $entry[(string) $teacher_public_field_ids['song_1_selection']];
    $student_master_entry[(string) $student_master_field_ids['song_2_period']] = $entry[(string) $teacher_public_field_ids['song_2_period']];
    $student_master_entry[(string) $student_master_field_ids['song_2_composer']] = $entry[(string) $teacher_public_field_ids['song_2_composer']];
    $student_master_entry[(string) $student_master_field_ids['song_2_selection']] = $entry[(string) $teacher_public_field_ids['song_2_selection']];
    $student_master_entry[(string) $student_master_field_ids['theory_score']] = $entry[(string) $teacher_public_field_ids['theory_score']];
    $student_master_entry[(string) $student_master_field_ids['alternate_theory']] = $entry[(string) $teacher_public_field_ids['alternate_theory']];
    $student_master_entry[(string) $student_master_field_ids['competition_format']] = $entry[(string) $teacher_public_field_ids['competition_format']];
    $student_master_entry[(string) $student_master_field_ids['timing_of_pieces']] = $entry[(string) $teacher_public_field_ids['timing_of_pieces']];

    $teacher_result = GFAPI::update_entry( $teacher_master_entry );
    $student_result = GFAPI::update_entry( $student_master_entry );
  }
}

// In order to make use of query vals of these functions, this filter must be,
// added to the query vars.
function aria_add_query_vars_filter( $vars ){
  $vars[] = "teacher_hash";
  $vars[] .= "student_hash";
  return $vars;
}
add_filter( 'query_vars', 'aria_add_query_vars_filter' );
