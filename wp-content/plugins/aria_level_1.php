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
	$name_field->allowsPrepopulate = true;
	$name_field->isRequired = true;

	// Theory test score
	$theory_field = new GF_Field_Number();
	$theory_field->label = "Theory test score (percentage)";
	$theory_field->id = 2;
	$theory_field->isRequired = false; 	// not sure


	// Song 1
	// See admin label

		// Period selection
		$period_select_1 = new GF_Field_Select();
		$period_select_1->label = "Song 1 Period";
		$period_select_1->id = 3;
		$period_select_1->isRequired = true;
		$period_select_1->choices = aria_get_periods();


		// Composer selection
			// Filter by period
		// Loop through each composer
			// when do we want to populate the drop down options
			// will need to know how many fields to create

			for( $period = 1; $period <= 4; $period++ )
			{
				// Look for all composers of this period
				$search_criteria = array(
						'status' => 'active';
						'field_filters' => array(
								array(
										'key'	=> '1', 'value' => $period
									)
							)
					);
			}

		// Song selection
		// Filter by period and composer


	// Song 2

	// Format

		// Lower
			// traditional
			// non-competitive

		// Upper
			// traditional
			// non-competitive
			// master

	// Timing (nearest minute? minute second?)
}

function aria_get_periods(){
	$periods = array();
	$periods[] = array(
			'id' 	=> '1';
			'label' => 'Baroque';
			'name' 	=> '';
		);
	$periods[] = array(
		'id' 	=> '2';
		'label' => 'Classical';
		'name' 	=> '';
	);
	$periods[] = array(
		'id' 	=> '3';
		'label' => 'Romantic';
		'name' 	=> '';
	);
	$periods[] = array(
		'id' 	=> '4';
		'label' => 'Contemporary';
		'name' 	=> '';
	);
	return $periods;
}

/* Modify logic */


/* Populate */


?>
