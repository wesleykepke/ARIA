<?php

/**
 * The file acts like an API for functions that may be called repeatedly.
 *
 * This file lists various functions and their implementation that may be
 * used throughout ARIA. Simply require_once() this file and the all of the
 * associated functionality will be available.
 *
 * @link       http://wesleykepke.github.io/ARIA/
 * @since      1.0.0
 *
 * @package    ARIA
 * @subpackage ARIA/includes
 */

// Make sure Gravity Forms is installed and enabled
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (!is_plugin_active('gravityforms/gravityforms.php')) {
  wp_die("Error: ARIA requires the Gravity Forms plugin to be installed
  and enabled. Please enable the Gravity Forms plugin and reactivate
  ARIA.");
}

/**
 * This function will find the ID of the form used to create music competitions.
 *
 * This function will iterate through all of the active form objects and return
 * the ID of the form that is used to create music competitions. If no music
 * competition exists, the function will return -1.
 *
 * @since 1.0.0
 * @author KREW
 */
function aria_get_create_competition_form_id() {
  $create_competition_form_name = 'ARIA: Create a Competition';
  $create_competition_form_id = NULL;
  $all_active_forms = GFAPI::get_forms();

  foreach ($all_active_forms as $form) {
    if ($form['title'] === $create_competition_form_name) {
      $create_competition_form_id = $form['id'];
    }
  }

  if (!isset($create_competition_form_id)) {
    $create_competition_form_id = -1;
  }

  return $create_competition_form_id;
}

/**
 * This function will find the ID of the form used to upload songs to the
 * database.
 *
 * This function will iterate through all of the active form objects and return
 * the ID of the form that is used to upload music to the database.
 *
 * @since 1.0.0
 * @author KREW
 */
function aria_get_song_upload_form_id() {
	$upload_form_name = 'Modify Song List';
	$upload_form_name_id = NULL;
	$all_active_forms = GFAPI::get_forms();

	foreach ($all_active_forms as $form) {
		if ($form['title'] === $upload_form_name) {
			$upload_form_name_id = $form['id'];
		}
	}

	if (!isset($upload_form_name_id)) {
    $upload_form_name_id = -1;
    /*
		wp_die('Form ' . $upload_form_name . ' does not exist. Please create it and
    try again.'); */
	}

 	return $upload_form_name_id;
}

/**
 * This function will find the ID of the form used as the NNMTA music database.
 *
 * This function will iterate through all of the active form objects and return
 * the ID of the form that is used to store all NNMTA music.
 *
 * @since 1.0.0
 * @author KREW
 */
function aria_get_nnmta_database_form_id() {
	$nnmta_music_database_form_name = 'NNMTA Music Database';
	$nnmta_music_database_form_id = NULL;
	$all_active_forms = GFAPI::get_forms();

	foreach ($all_active_forms as $form) {
		if ($form['title'] === $nnmta_music_database_form_name) {
			$nnmta_music_database_form_id = $form['id'];
		}
	}

	if (!isset($nnmta_music_database_form_id)) {
    $nnmta_music_database_form_id = -1;
    /*
		wp_die('Form ' . $nnmta_music_database_form_name . ' does not exist.
    Please create it and try again.');
    */
	}

	return $nnmta_music_database_form_id;
}

/**
 * This function will find the file path of the csv music file that the user has
 * uploaded.
 *
 * This function will extract the name of the csv file that the user has
 * uploaded using the form that was specified in the
 * 'aria_get_song_upload_form_id' function. This csv file contains all of the
 * NNMTA music data. Finally, this function will return the file path so it can
 * be used in another function.
 *
 * @param Entry Object  $entry  The entry object from the upload form.
 * @param Form Object   $form   The form object that contains $entry.
 *
 * @since 1.0.0
 * @author KREW
 */
function aria_get_music_csv_file_path($entry, $form) {
	// find the field entry used to upload the csv file
	$music_csv_field_name = 'CSV File';
	$music_csv_field_id = NULL;
	foreach ($form['fields'] as $field) {
		if ($field['label'] === $music_csv_field_name) {
			$music_csv_field_id = $field['id'];
		}
	}

	if (!isset($music_csv_field_id)) {
		wp_die('Form named \'' . $form['title'] . '\' does not have a field named \''
                . $music_csv_field_name . '\'. Please create this field and try uploading
                music again.');
	}

	// parse the url and obtain the file path for the csv file
	$csv_file_url = $entry[strval($music_csv_field_id)];
	$csv_file_url_atomic_strings = explode('/', $csv_file_url);
	$csv_full_file_path = '/var/www/html/wp-content/uploads/testpath/'; // this may need to change
	$csv_full_file_path .= $csv_file_url_atomic_strings[count($csv_file_url_atomic_strings) - 1];
	return $csv_full_file_path;
}
