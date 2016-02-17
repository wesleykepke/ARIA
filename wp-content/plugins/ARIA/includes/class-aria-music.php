<?php

/**
 * The file that provides music uploading/downloading functionality.
 *
 * A class definition that includes attributes and functions that allow the
 * festival chairman to upload and download music.
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
 * The create competition class.
 *
 * @since      1.0.0
 * @package    ARIA
 * @subpackage ARIA/includes
 * @author     KREW
 */
class ARIA_Music {

  /**
   * This function will parse the contents of the csv file and upload content to
   * the NNMTA music database.
   *
   * Using the csv file that the user has uploaded, this function will parse
   * through the music content for each song and add it to the NNMTA music
   * database.
   *
   * @param Entry Object  $entry  The entry object from the upload form.
   * @param Form Object   $form   The form object that contains $entry.
   *
   * @since 1.0.0
   * @author KREW
   */
  public static function aria_add_music_from_csv($entry, $form) {
    // check if the form for uploading exists
    $music_db_form_id = aria_get_nnmta_database_form_id();
    if ($music_db_form_id === -1) {
      self::aria_create_nnmta_music_form();
    }

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
            '1' => $single_song_data[2],
            '2' => $single_song_data[3],
            '3' => $single_song_data[1],
            '4' => $single_song_data[0],
            '5' => $single_song_data[4],
            '6' => $single_song_data[5],
            '7' => $single_song_data[6],

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

  /**
   * This function is responsible for creating the NNMTA music form if it does
   * not previously exist.
   *
   * This function is intended to be used in the event where the festival
   * chairman tries to upload music to the NNMTA database but no such form
   * exists for adding music.
   *
   * @author KREW
   * @since 1.0.0
   */
   private static function aria_create_nnmta_music_form() {
     $nnmta_music_form_name = "NNMTA Music Database";
     $nnmta_music_form = new GF_Form($nnmta_music_form_name, "");
     //!!!$field_id_index = 1;
     $field_id_arr = self::aria_music_field_id_array();

     /*
     // NNMTA song id
     $song_id_field = new GF_Field_Text();
     $song_id_field->label = "NNMTA Song ID";
     $song_id_field->id = $field_id_arr['song_id'];
     //$field_id_index++;
     $song_id_field->isRequired = true;
     $nnmta_music_form->fields[] = $song_id_field;
     */

     // NNMTA song name
     $song_name_field = new GF_Field_Text();
     $song_name_field->label = "Song Name";
     $song_name_field->id = $field_id_arr['song_name'];
     //$field_id_index++;
     $song_name_field->isRequired = true;
     $nnmta_music_form->fields[] = $song_name_field;

     // NNMTA song composer
     $song_composer_field = new GF_Field_Text();
     $song_composer_field->label = "Composer Name";
     $song_composer_field->id = $field_id_arr['song_composer'];
     //$field_id_index++;
     $song_composer_field->isRequired = true;
     $nnmta_music_form->fields[] = $song_composer_field;

     // NNMTA song level
     $song_level_field = new GF_Field_Text();
     $song_level_field->label = "Song Level";
     $song_level_field->id = $field_id_arr['song_level'];
     //$field_id_index++;
     $song_level_field->isRequired = true;
     $nnmta_music_form->fields[] = $song_level_field;

     // NNMTA period level
     $song_period_field = new GF_Field_Text();
     $song_period_field->label = "Song Period";
     $song_period_field->id = $field_id_arr['song_period'];
     //$field_id_index++;
     $song_period_field->isRequired = true;
     $nnmta_music_form->fields[] = $song_period_field;

     // NNMTA song image
     /*
     Currently GF_Field_Text but might need to change
     */
     $song_song_img_field = new GF_Field_Text();
     $song_song_img_field->label = "Song Image";
     $song_song_img_field->id = $field_id_arr['song_image'];
     //$field_id_index++;
     $song_song_img_field->isRequired = true;
     $nnmta_music_form->fields[] = $song_song_img_field;

     // add the new form to the festival chairman's dashboard
     $new_form_id = GFAPI::add_form($nnmta_music_form->createFormArray());

     // make sure the new form was added without error
     if (is_wp_error($new_form_id)) {
       wp_die($new_form_id->get_error_message());
     }
   }

  /**
   * This function will remove all of the music from the NNMTA music database.
   *
   * This function was created to support the scenario when the festival
   * chariman needs to update the music in the NNMTA music database. In order to
   * do this, all of the existing data is removed from the database prior to
   * adding all of the new data. This ensures that the new data is added
   * appropriately without accidentally adding old, possibly unwanted music
   * data.
   *
   * @since 1.0.0
   * @author KREW
   */
  private static function aria_remove_all_music_from_nnmta_database() {
    // to be implemented
  }

  /**
   * This function will change the default file path for uploaded files.
   *
   * In order to upload music from a file, we need to know where the music
	 * file resides. This function will set a pre-determined file path so
	 * the music data can be read from.
   *
   * @since 1.0.0
   * @author KREW
   */
  public static function aria_modify_upload($path_info, $form_id){
  	$path_info['path'] = '/var/www/html/wp-content/uploads/testpath/';
  	return $path_info;
  }

	// !!! New function
	public static function aria_music_field_id_array() {
		return array(
			'song_id' => 1,
			'song_name' => 2,
			'song_composer' => 3,
			'song_level' => 4,
			'song_period' => 5,
			'song_image' => 6
		);
	}

}
