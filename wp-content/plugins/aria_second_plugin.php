<?php
/*
Plugin Name: Aria Second Plugin
Plugin URI: http://google.com
Description: Adds a super sweet footer to your WordPress page. Now with a settings menu. 
Author: Renee and Kyle
Version: 1.0
Author URI: http://wkepke.com
*/


function aria_second_plugin() {
	$random_number = mt_rand(100, 200); 
	//echo '<h1 id="aria_second_plugin_css">This is a SUPER sweet footer that generated the random number: ' . $random_number. ' (from the range 100-200).</h1>';
$search_criteria = array(
    'status'        => 'active',
    'field_filters' => array(
        array(
            'key'   => '1',
            'value' => 'Wesley'
        )
    )
);
$form_id = 15;
$entries         = GFAPI::get_entries( $form_id, $search_criteria );
echo '<h1 id="aria_second_plugin_css">This is a SUPER sweet footer that generated the random number: ' . $random_number. ' (from the range 100-200).' . rgar( $entries[0], '1' ). '</h1>';
}

add_action('wp_footer', 'aria_second_plugin', 6); 

function aria_second_plugin_css() {
	// check if language flows from right to left
	$x = is_rtl() ? 'left' : 'right';
	echo "
	<style type='text/css'>
	#aria_second_plugin_css {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;
		margin: 0;
		font-size: 18px; 
	}
	</style>
	";
}

add_action('wp_footer', 'aria_second_plugin_css'); 

?>
