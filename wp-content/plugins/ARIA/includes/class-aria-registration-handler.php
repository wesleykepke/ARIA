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
	public static function aria_send_registration_emails() {

	}

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
				wp_die('Error: The form titled ' . $value . " does not exist.");
			}
		}
		return $form_ids;
	}

	/**
	 * Function for searching through student-master to find a student.
	 */
   public static function aria_find_student_entry($student_master_form_id, $student_name) {
     // 3 is the value of student name. Should import the fields id array to
     // make this safer.
     $search_criteria = array(
       'field_filters' => array(
         'mode' => 'any',
         array(
           'key' => '3',
           'value' => $student_name
         )
       )
     );
     $entries = GFAPI::get_entries($student_master_form_id, $search_criteria);

     if(count($entries) == 1 && rgar($entries[0], 3) == $student_name) {
       return entries[0];
     }

     return false;
   }

	/**
	 * Function for searching through teacher-master to find a teacher.
	 */
   public static function aria_find_teacher_entry($teacher_master_form_id, $teacher_name) {
     $search_criteria = array(
       'field_filters' => array(
         'mode' => 'any',
         array(
           'key' => '1',
           'value' => $teacher_name
         )
       )
     );

     $entries = GFAPI::get_entries($teacher_master_form_id, $search_criteria);
     if(count($entries) == 1 && rgar($entries[0], 1) == $teacher_name) {
       return entries[0];
     }

     return false;
   }

	/**
	 * Function to check if a student is assigned to a teacher.
	 */
   public static function aria_check_student_teacher_relationship($teacher_master_form_id, $student_name, $teacher_name) {
     // Get the teacher entry
     $teacher_entry = self::aria_find_teacher_entry($teacher_master_form_id, $teacher_name);

     // return if teacher entry does not exist.
     if($teacher_entry == false) return false;

     // get the array of students the teacher is assigned.
     $students = rgar($teacher_entry, '6');

     // find the student name in the array of students.
     foreach($students as $student) {
       if ($student == $student_name) return true;
     }
     return false;
   }

	/**
	 * Function to add a student-teacher relationship in the teacher-master.
	 */
   public static function aria_add_student_teacher_relationship($teacher_master_form_id, $student_name, $teacher_name) {
     // Get the teacher entry
     $teacher_entry = self::aria_find_teacher_entry($teacher_master_form_id, $teacher_name);

     // return if teacher entry does not exist.
     if($teacher_entry == false) return false;

     // find the student name in the array of students.
     $teacher_entry['6'][] = $student_name;
   }


	/**
	 * Function to add an entry in student-master from the student.
	 *
	 * This function will add a student entry from the student competition forn 
	 * to the student master form. 
	 *
	 * @param 	$student_entry 	Associative Array 	The student entry to add to the 
	 * student master form
	 * @param 	$prepended_title 	String 	The series of forms pertaining to the competition 	
	 *
	 * @author KREW 
	 * @since 1.0.0
	 */
	private static function aria_add_student_to_student_master($student_entry, $prepended_title) {
		$all_forms = self::aria_find_related_forms_ids($prepended_title);

		// error checking to ensure $student_entry is indeed a student entry?

		$student_entry_array = array($student_entry); 
		$entries = GFAPI::add_entries($student_entry_array, $all_forms["Student Form"]);
		if (is_wp_error($entries)) {
			wp_die($entries->get_error_message()); 
		}
	}

	/**
	 * Function to check if student-teacher relationship exists based on link
	 * variables.
	 */
   public static function aria_check_student_teacher_relationship_from_url($teacher_master_form_id, $teacher_hash, $student_hash) {
     return self::aria_check_student_teacher_relationship($teacher_master_form_id, base64_decode($teacher_hash), base64_decode($student_hash));
   }

	/**
	 * Function to get pre-populate values based on teacher-master.
	 */

	/**
	 * Function to get pre-populate values based on student-master.
	 */

	/**
	 * Function to update student-master from student-public.
	 *
	 * This function is responsible for updating information in the student 
	 * master form as new information regarding the student is determined.
	 *
	 * @param 	???
	 *
	 * @author KREW
	 * @since 1.0.0
	 */
	private static function aria_update_student_master() {

	}
}
