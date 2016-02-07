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
}
