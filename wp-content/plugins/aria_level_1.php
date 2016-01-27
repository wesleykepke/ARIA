<?php
/*
Plugin Name: Level 1 Song Form
Plugin URI: http://google.com
Description: Test form for a teacher registering a student of level 1. 
Author: Renee
Version: 1.0
Author URI: http://google.com
*/
/* Create fields */
function aria_create_lvl_1(){
	// Create form (move to other function probably)
	$lvl_1_form = new GF_Form("Level 1 Teacher", "");
	
	// Student name to be prepopulated and fixed
	// Do we want this as a field or modify the title
	// to prevent teachers from changing it
	$name_field = new GF_Field_Text();
	$name_field->label = "Student Name";
	$name_field->id = 1;


}


/* Modify logic */


/* Populate */


?>
