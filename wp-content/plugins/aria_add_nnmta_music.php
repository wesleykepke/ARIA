<?php
/*
Plugin Name: Aria: Add NNMTA Music 
Plugin URI: http://google.com
Description: This plugin will allow the frstival chairman to upload songs to the NNMTA music database.  
Author: KREW (Kyle, Renee, Ernest, and Wes)
Version: 1.0.0
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

/** 
 * This function will find the ID of the form used as the NNMTA music database. 
 *
 * This function will iterate through all of the active form objects and return the 
 * ID of the form that is used to store all NNMTA music. 
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
    wp_die('Form ' . $nnmta_music_database_form_name . ' does not exist. Please create it and try again.');
  }

  return $nnmta_music_database_form_id; 
}

/** 
 * This function will find the file path of the csv file that the user has uploaded. 
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
function aria_get_csv_song_file_path($entry, $form) {
  $aria_csv_field_id = 4;
  $aria_csv_name = $entry[strval($aria_csv_field_id)];
  $aria_csv_atomic_strings = explode('/', $aria_csv_name);
  $aria_csv_full_file_path = '/var/www/html/wp-content/uploads/testpath/'; // this may need to change
  $aria_csv_full_file_path .= $aria_csv_atomic_strings[count($aria_csv_atomic_strings) - 1];
  return $aria_csv_full_file_path; 
}

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
function aria_add_music_from_csv($entry, $form) {
  $num_song_elements_no_image = 5;
  $num_song_elements_with_image = 6;  

  // locate the full path of the csv file 
  $csv_music_file = aria_get_csv_song_file_path($entry, $form); 

  // parse csv file and add all music data to an array 
  $all_songs = array();
  if (($file_ptr = fopen($csv_music_file, "r")) !== FALSE) {
    while (($single_song_data = fgetcsv($file_ptr, 1000, ",")) !== FALSE) {
      
      //print_r($aria_single_song_data);
      //wp_die(); 

      if (count($single_song_data) === $num_song_elements_no_image) { // no image 
        $all_songs[] = array (
          '1' => $single_song_data[0],
          '2' => $single_song_data[1],
          '3' => $single_song_data[2],
          '4' => $single_song_data[3],
          '5' => $single_song_data[4],
        );
      }
      elseif (count($single_song_data) === $num_song_elements_with_image) { // image
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
  
  // add all song data from array into the database 
  $new_song_ids = GFAPI::add_entries($all_songs, aria_get_nnmta_database_form_id());
  if (is_wp_error($new_song_ids)) {
    wp_die($new_song_ids->get_error_message());
  }   
	
  // remove filename from upload folder	
  unlink($csv_music_file); 
}

// register with the correct form
$aria_song_upload_form_id = aria_get_song_upload_form_id(); 
$aria_song_upload_hook = 'gform_after_submission_' . strval($aria_song_upload_form_id);
add_action($aria_song_upload_hook, 'aria_add_music_from_csv', 10, 2); 