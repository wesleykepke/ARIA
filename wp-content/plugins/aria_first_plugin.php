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
	"Level" => "Level One",
	"Period" => "Baroque",
	"Song Name" => "Symphony #420",
	"Composer" => "Bach"
); 


//print_r($new_entry);
//die; 


/*
$success = array();

$success = GFAPI::add_entries($new_entry, 17); 

if (is_wp_error($success)) {
	die($success->get_error_message()); 
}

else {
	foreach($success as $id) {
		echo "New entry number is: " . $id;
	}
	die; 
}
*/


// search for the newly created entry
$search_criteria = array();
$search_criteria['field_filters'][] = array('key' => "Level", 'value' => "Level One"); 
$search_criteria['field_filters'][] = array('key' => "Period", 'value' => "Baroque"); 
$search_criteria['field_filters'][] = array('key' => "Song Name", 'value' => "Symphony #420"); 
$search_criteria['field_filters'][] = array('key' => "Composer", 'value' => "Bach"); 

//$entries = GFAPI::get_entries(17, $search_criteria); 
$entries = GFAPI::get_entries(17); 

if (is_wp_error($entries)) {
	die($entries->get_error_message());
}
else {
	echo "There are " . count($entries) . " entries in form #17. </br>";

	foreach($entries as $entry) {
		//if ($entry["Song Name"] == "Symphony #420") {
			echo "Matching entry has id: " . $entry["id"] . "</br>"; 
		//}
	}
	die("???");
}

}

register_activation_hook(__FILE__, "aria_add_activation"); 


/*
if ($success == WP_Error) {
	die("Didn't work"); 
}
*/


/*

wp_mail works (01/19/2016)

function aria_first_plugin() {
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
/*
function aria_first_plugin_css() {
	// check if language flows from right to left
	$x = is_rtl() ? 'left' : 'right';
	echo "
	<style type='text/css'>
	#aria_first_plugin_css {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;
		margin: 0;
		font-size: 18px; 
	}
	</style>
	";
}

add_action('wp_footer', 'aria_first_plugin_css'); 
*/

?>
