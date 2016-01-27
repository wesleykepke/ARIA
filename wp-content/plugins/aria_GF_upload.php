<?php

/*
Plugin Name: Aria Modify GF Upload
Plugin URI: http://google.com
Description: Testing GF file upload. Successfully modifying file path. 
Author: Renee
Version: 1.1
Author URI: http://wkepke.com
*/


/*
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
*/
function aria_modify_upload($path_info, $form_id){
	$path_info['path'] = '/var/www/html/wp-content/uploads/testpath/';
	return $path_info;
}

add_filter( 'gform_upload_path', 'aria_modify_upload', 10, 2 );

function aria_test_prepop( $value, $field, $name ){
	//echo print_r($name);
	//die;
	return 'prepop worked';
}

//add_filter( 'gform_field_value_TestPP', 'aria_test_prepop', 10, 3 );

?>
