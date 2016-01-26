<?php
/*
Plugin Name: Aria: Add Submission From Form
Plugin URI: http://google.com
Description: This plugin will save entries submitted via Gravity Forms to a database. 
Author: Wes
Version: 3.0
Author URI: http://wkepke.com
*/

/**
 * This function adds a new entry (from a .csv file) obtained via GF. 
 *
 */
function aria_add_song_from_csv($entry, $form) {

	// locate the name of the song file
	$filename_url = $entry["4"];
	//echo "Filename (url) is: " . $filename_url;
	$filename_atomic_strings = explode("/", $filename_url);
	$filename = "/var/www/html/wp-content/uploads/testpath/";
	$filename .= $filename_atomic_strings[count($filename_atomic_strings) - 1];
	//echo "<br> Filename is: " . $filename; 

	$song_data = array();
        if (($file_ptr = fopen($filename, "r")) !== FALSE) {
                while (($data = fgetcsv($file_ptr, 1000, ";")) !== FALSE) {

                        // no image 
                        if (count($data) === 4) {
                                $song_data[] = array(
                                        "1" => "$data[0]",
                                        "2" => $data[1],
                                        "3" => $data[2],
                                        "4" => $data[3]
                                );
                        }

                        // image 
                        else {
                                $song_data[] = array(
                                        "1" => $data[0],
                                        "2" => $data[1],
                                        "3" => $data[2],
                                        "4" => $data[3],
                                        "5" => $data[4]
                                );
                        }

                        /*
                        for ($i = 0; $i < count($data); $i++) {
                                echo $data[$i] . "</br>";
                        }
                        unset($data); */
                }
        }

        /*
        print_r($song_data); 
        die; 
        */

	$newly_added_entry_ids = GFAPI::add_entries($song_data, 38);    
	
	// remove filename from upload folder	
	unlink($filename); 
}

// register with the correct form
add_action("gform_after_submission_59", "aria_add_song_from_csv", 10, 2); 
