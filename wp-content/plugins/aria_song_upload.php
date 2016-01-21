<?php
/*
Plugin Name: Aria: Song Upload
Plugin URI: http://google.com
Description: Testing uploading of songs to ARIA database. 
Author: Wes
Version: 1.0
Author URI: http://wkepke.com
*/

function aria_upload_songs() {
	// find sheet music file
	//$sheet_music_csv = plugin_dir_path(__FILE__) . "../uploads/musictestsheet.csv";
	$sheet_music_csv = "/var/www/html/wp-content/uploads/musicsheettest.csv"; 

	// read fiile and parse csv content
	$song_data = array(); 
	if (($file_ptr = fopen($sheet_music_csv, "r")) !== FALSE) {
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
	
}

//register_activation_hook(__FILE__, 'aria_upload_songs'); 
add_action('wp_footer', 'aria_upload_songs'); 

?>
