<?php
/*
Plugin Name: Aria: Add NNMTA Music
Plugin URI: http://google.com
Description: This plugin will allow the frstival chairman to upload songs to the NNMTA music database.
Author: KREW (Kyle, Renee, Ernest, and Wes)
Version: 2.0.0
Author URI: http://google.com
*/

/**
 * This function will find the ID of the form used to upload songs to the database.
 *
 * This function will iterate through all of the active form objects and return the
 * ID of the form that is used to upload music to the database.
 *
 * @since 1.0.0
 * @author KREW
 */
 /*
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
		wp_die('Form ' . $upload_form_name . ' does not exist. Please create it and try again.');
	}

 	return $upload_form_name_id;
}
*/

/**
 * This function will find the ID of the form used as the NNMTA music database.
 *
 * This function will iterate through all of the active form objects and return the
 * ID of the form that is used to store all NNMTA music.
 *
 * @since 1.0.0
 * @author KREW
 */
 /*
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
		wp_die('Form ' . $nnmta_music_database_form_name . ' does not exist. Please create it and try again.');
	}

	return $nnmta_music_database_form_id;
}
*/

/**
 * This function will find the file path of the csv music file that the user has uploaded.
 *
 * This function will extract the name of the csv file that the user has uploaded
 * using the form that was specified in the 'aria_get_song_upload_form_id' function.
 * This csv file contains all of the NNMTA music data. Finally, this function will
 * return the file path so it can be used in another function.
 *
 * @param       Entry Object    $entry  The entry object from the upload form.
 * @param       Form Object     $form   The form object that contains $entry.
 *
 * @since 1.0.0
 * @author KREW
 */
 /*
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
		wp_die('Form named \'' . $form['title'] . '\' does not have a field named \'' . $music_csv_field_name . '\'.
			Please create this field and try uploading music again.');
	}

	// parse the url and obtain the file path for the csv file
	$csv_file_url = $entry[strval($music_csv_field_id)];
	$csv_file_url_atomic_strings = explode('/', $csv_file_url);
	$csv_full_file_path = '/var/www/html/wp-content/uploads/testpath/'; // this may need to change
	$csv_full_file_path .= $csv_file_url_atomic_strings[count($csv_file_url_atomic_strings) - 1];
	return $csv_full_file_path;
}
*/

/**
 * This function will parse the contents of the csv file and upload content to the NNMTA music database.
 *
 * Using the csv file that the user has uploaded, this function will parse through the music content for
 * each song and add it to the NNMTA music database.
 *
 * @param       Entry Object    $entry  The entry object from the upload form.
 * @param       Form Object     $form   The form object that contains $entry.
 *
 * @since 1.0.0
 * @author KREW
 */
 /*
function aria_add_music_from_csv($entry, $form) {
	$num_song_elements_no_image = 5;
	$num_song_elements_with_image = 6;

	// locate the full path of the csv file
	$csv_music_file = aria_get_music_csv_file_path($entry, $form);

	// parse csv file and add all music data to an array
	$all_songs = array();
	if (($file_ptr = fopen($csv_music_file, "r")) !== FALSE) {
		// remove all data that is already in the database
		//aria_remove_all_music_from_nnmta_database();

		// add new music
		while (($single_song_data = fgetcsv($file_ptr, 1000, ",")) !== FALSE) {
			// no image
			if (count($single_song_data) === $num_song_elements_no_image) {
				$all_songs[] = array (
					'1' => $single_song_data[0],
					'2' => $single_song_data[1],
					'3' => $single_song_data[2],
					'4' => $single_song_data[3],
					'5' => $single_song_data[4],
				);
			}

			// image
			elseif (count($single_song_data) === $num_song_elements_with_image) {
				/*
				$all_songs[] = array (
					'1' => $single_song_data[0],
					'2' => $single_song_data[1],
					'3' => $single_song_data[2],
					'4' => $single_song_data[3],
					'5' => $single_song_data[4],
					'6' => $single_song_data[5],
				); */
			}
		}
	}
*/
/*
	// add all song data from array into the database
	$new_song_ids = GFAPI::add_entries($all_songs, aria_get_nnmta_database_form_id());
	if (is_wp_error($new_song_ids)) {
		wp_die($new_song_ids->get_error_message());
	}

	// remove filename from upload folder
	//print_r($all_songs);
	unlink($csv_music_file);
	unset($all_songs);
}
*/

/**
 * This function will remove all of the music from the NNMTA music database.
 *
 * This function was created to support the scenario when the festival chariman needs
 * to update the music in the NNMTA music database. In order to do this, all of the existing
 * data is removed from the database prior to adding all of the new data. This ensures
 * that the new data is added appropriately without accidentally adding old, possibly
 * unwanted music data.
 *
 * @since 2.0.0
 * @author KREW
 */
 /*
function aria_remove_all_music_from_nnmta_database() {
	$nnmta_music_database_form_id = aria_get_nnmta_database_form_id();
	$index = 0;
	$total_count = GFAPI::count_entries($nnmta_music_database_form_id);

	while ($index < $total_count) {
		$twenty_songs = GFAPI::get_entries($nnmta_music_database_form_id);
		for ($song_on_page = 0; $song_on_page < 20; $song_on_page++) {
			$deleted_song = GFAPI::delete_entry($twenty_songs[$song_on_page]['id']);
			if (is_wp_error($deleted_song)) {
				wp_die($deleted_song->get_error_message());
			}
		}
		$index += 20;
	}

/*
	foreach ($all_songs as $song) {
		$deleted_song = GFAPI::delete_entry($song['id']);
		if (is_wp_error($deleted_song)) {
			wp_die($deleted_song->get_error_message());
		}
	}
*/
//}

// register with the correct form
//$aria_song_upload_form_id = aria_get_song_upload_form_id();
//$aria_song_upload_hook = 'gform_after_submission_' . strval($aria_song_upload_form_id);
//add_action($aria_song_upload_hook, 'aria_add_music_from_csv', 10, 2); 
