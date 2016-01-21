<?php
/*
Plugin Name: Aria First Plugin
Plugin URI: http://google.com
Description: Testing email functionality. 
Author: Wes
Version: 3.0
Author URI: http://wkepke.com
*/


function aria_add_activation() {

	$new_entry = array(); 
	$new_entry[] = array(
		"3" => "Level Two",
		"4" => "Classical",
		"1" => "Kyle's Waltz",
		"2" => "Kyle Lee"
	);
	$new_entry[] = array(
		"3" => "Level Three",
		"4" => "Baroque",
		"1" => "Ernest's Concerto",
		"2" => "Ernest Lee"
	);
	

	//print_r($new_entry);
	//die; 

	/*
	This snippet of code will print Level, Period, Song Name, and Composer. 
	*/
	$form = GFFormsModel::get_form_meta(17);
	foreach ($form['fields'] as $field) {
		echo "Field id #$field->id has field label: $field->label </br>";
		//echo "Field name: $field->name </br>"; prints nothing 
	}
	//die("Printed all fields"); 

	//  entry was added without error	
	$success = array();
	$success = GFAPI::add_entries($new_entry, 17); 
	$entry_id = NULL; 

	if (is_wp_error($success)) {
		die($success->get_error_message()); 
	}
	else {
		foreach($success as $id) {
			echo "New entry number is: " . $id;
			$entry_id = $id; 		
		}
	}

	// search for the newly created entry (using get_entries - plural)
	/*
	$search_criteria = array();
	$search_criteria['field_filters'][] = array('key' => "Level", 'value' => "Level One"); 
	$search_criteria['field_filters'][] = array('key' => "Period", 'value' => "Baroque"); 
	$search_criteria['field_filters'][] = array('key' => "Song Name", 'value' => "Symphony #420"); 
	$search_criteria['field_filters'][] = array('key' => "Composer", 'value' => "Bach"); 

	//$entries = GFAPI::get_entries(17, $search_criteria); 
	$entries = GFAPI::get_entries(17); 

	print_r($entries[0]);
	echo "</br>";
	echo $entries[0][3] . "</br>" . "</br>"; 
 
	//die;

	if (is_wp_error($entries)) {
		die($entries->get_error_message());
	}
	else {
		echo "There are " . count($entries) . " entries in form #17. </br>";
       if (is_wp_error($entry)) {
                die($entry->get_error_message());
        }

$result		foreach($entries as $entry) {
			//if ($entry["Song Name"] == "Symphony #420") {
			echo "Matching entry has id: " . $entry["id"] . "</br>"; 
		//}
	}
	
	die("???");
	}

	// test using get_entry
	/* this isn't working 
	*/

/*
	$entry = GFAPI::get_entry($entry_id);
	if (is_wp_error($entry)) {
		die($entry->get_error_message()); 	
	}
	else {
		echo "Entry id: $entry_id </br>"; 
		echo "Should be Level: " . $entry['Level'] . "</br>"; 
	}
	die; 

/* this works
	$entry = GFAPI::get_entry(153);
	if (is_wp_error($entry)) {
		die($entry->get_error_message());
	} 
	else {
		print_r($entry);
$result		die; 
	}

*/
}


function aria_entry_tester() {
	$new_entry = array(
		"form_id" => "37",
		"1" => "Kyle"
	);

	$success = array();
	$success = GFAPI::add_entry($new_entry); 
	$entry_id = NULL; 

	if (is_wp_error($success)) {
		die($success->get_error_message()); 
	}
	else {
		//die("id: $success"); 
		//foreach($success as $id) {
		//	echo "New entry number is: " . $id;
		//	$entry_id = $id; 		
		//}
		//die;
	}

	$entries = GFAPI::get_entries(37);
	//var_dump($entries);
	//die; 

}


add_action('wp_footer', 'aria_add_activation'); 

//register_activation_hook(__FILE__, "aria_entry_tester"); 


/*
if ($success == WP_Error) {
	die("Didn't work"); 
}
*/


/*

wp_mail works (01/19/2016)

function aria_first_plugin() {
	es);
$random_number = mt_rand(0, 55); 
	//echo '<h1 id="aria_first_plugin_css">This is a SUPER sweet footer that generated the random number: ' . $random_number. ' (from the range 0-55).</h1>';
	$message = "This is a SUPER sweet footer that generated the random number: " . $random_number . " (from the range 0-55).";
	$to = "wesleykepke@nevada.unr.edu";
	$subject = "NNMTA teacher registration";
	if (!wp_mail($to, $subject, $message)) {
		die("Email not sent correctly"); 
	}
}

add_action('admin_notices', 'aria_first_plugin', 6);  
*/
?>
