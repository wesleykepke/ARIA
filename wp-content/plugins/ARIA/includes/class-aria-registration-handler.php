<?php

/**
 * The file that defines the functionality for handling competition registration.
 *
 * A class definition that includes attributes and functions that allow the
 * registration (of students and teachers) for NNMTA competitions to operate
 * seamlessly.
 *
 * @link       http://wesleykepke.github.io/ARIA/
 * @since      1.0.0
 *
 * @package    ARIA
 * @subpackage ARIA/includes
 */

/**
 * The competition registration handler class.
 *
 * @since      1.0.0
 * @package    ARIA
 * @subpackage ARIA/includes
 * @author     KREW
*/
class ARIA_Registration_Handler {

	/**
	 * Function for sending emails.
	 */

	/**
	 * Function for returning related forms.
	 *
	 * This function will return an associative array that maps the titles of
	 * the associated forms in a music competition (student, student master,
	 * teacher, and teacher master) to their respective form IDs.
	 *
	 * @param $prepended_title	String	The prepended portion of the competition title.
	 *
	 * @author KREW
	 * @since 1.0.0
	 */
	private static function aria_find_related_forms_ids($prepended_title) {
		// make sure to get all forms! check this

		$form_ids = array(
			"Student Form" => null,
			"Student (Master) Form" => null,
			"Teacher Form" => null,
			"Teacher (Master) Form" => null
		);
		$student_form = $prepended_title + " Student Form";
		$student_master_form = $prepended_title + " Student (Master) Form";
		$teacher_form = $prepended_title + " Teacher Form";
		$teacher_master_form = $prepended_title + " Teacher (Master) Form";
		$all_forms = GFAPI::get_forms();

		foreach ($all_forms as $form) {
			switch ($form["title"]) {
				case $student_form:
					$form_ids["Student Form"] = $form["title"];
					break;

				case $student_master_form:
					$form_ids["Student (Master) Form"] = $form["title"];
					break;

				case $teacher_form:
						$form_ids["Teacher Form"] = $form["title"];
					break;

				case $teacher_master_form:
					$form_ids["Teacher (Master) Form"] = $form["title"];
					break;

				default:
					break;
			}
		}

		// make sure all forms exist
		foreach ($form_ids as $value) {
			if (!isset($value)) {
				wp_die('Error: ' . $value . ' does not exist!');
			}
		}
		return $form_ids;
	}

	/**
	 * Function for searching through student-master to find a student.
	 */

	/**
	 * Function for searching through teacher-master to find a teacher.
	 */

	/**
	 * Function to check if a student is assigned to a teacher.
	 */

	/**
	 * Function to add a student-teacher relationship in the teacher-master.
	 */

	/**
	 * Function to add an entry in student-master from the student.
	 */

	/**
	 * Function for searching through student-master to find a student.
	 */

	/**
	 * Function to check if student-teacher relationship exists based on link
	 * variables.
	 */

	/**
	 * Function to get pre-populate values based on teacher-master.
	 */

	/**
	 * Function to get pre-populate values based on student-master.
	 */

	/**
	 * Function to update student-master from student-public.
	 */

	/**
	 * Function to update teacher-master from teacher-public.
	 */
}
