<?php
/*
Plugin Name: Aria Second Plugin
Plugin URI: http://google.com
Description: Adds a super sweet footer to your WordPress page. Testing queries from form. 
Author: Renee and Kyle
Version: 2.1
Author URI: http://wkepke.com
*/

add_action( 'init', 'aria_add_script' );

function aria_add_script(){
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script('cry1', 'http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/hmac-sha1.js' );
	wp_enqueue_script( 'cry2', 'http://crypto-js.googlecode.com/svn/tags/3.1.2/build/components/enc-base64-min.js' );
	wp_enqueue_script( 'aria', '/wp-content/plugins/aria_populate.js' );
}

function aria_second_plugin() {
	$random_number = mt_rand(100, 200); 
	echo '<h1 id="aria_second_plugin_css">This is a SUPER sweet footer that generated the random number: ' . $random_number. ' (from the range 100-200).</h1>';
/*
$search_criteria = array(
    'status'        => 'active',
    'field_filters' => array(
        array(
            'key'   => '1',
            'value' => 'Wesley'
        )
    ); 
$form_id = 15;
$entries         = GFAPI::get_entries( $form_id, $search_criteria );
*/
//	echo '<h1 id="aria_second_plugin_css">This is a SUPER sweet footer that generated the random number: ' . $random_number. ' (from the range 100-200).' . rgar( $entries[0], '1' ). '</h1>';
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
//add_action('the_post', 'aria_populate_posts');

function aria_find_form_ids() {

    $all_forms = GFAPI::get_forms();
    $form_title_to_search = 'Renee is Test';
    $form_index_holder = array(); 
    
    foreach( $all_forms as $form ) {
        if( $form['title'] == $form_title_to_search ) {
            $form_index_holder[] = $form['id'];
        }
    } 	

    foreach ( $form_index_holder as $id ) {
/*DISABLING        add_filter( 'gform_pre_render_' . $id, 'aria_populate_posts', 3 );
        add_filter( 'gform_pre_validation_' . $id, 'aria_populate_posts' );
        add_filter( 'gform_pre_submission_filter_' . $id, 'aria_populate_posts' );
        add_filter( 'gform_admin_pre_render_' . $id, 'aria_populate_posts' );
 */
//DISABLING	add_filter( 'gform_pre_render_' . $id, 'aria_modify_logic', 2 );
        //add_filter( 'gform_pre_validation_' . $id, 'aria_modify_logic', 2 );
        //add_filter( 'gform_pre_submission_filter_' . $id, 'aria_modify_logic', 2 );
        //add_filter( 'gform_admin_pre_render_' . $id, 'aria_modify_logic', 2 );
     
    }

}

  
// find all form ids and hook onto the filter
aria_find_form_ids(); 



/* Populates drop down options dynamically from song form */
/*function aria_populate_posts( $form ) {

    foreach ( $form['fields'] as &$field ) {

        if ( $field['id'] != 4 ){//|| strpos( $field->cssClass, 'populate-posts' ) === false ) {
	           continue;
        }

        $choices = array();
	$search_criteria = array(
    		'status'        => 'active',
    		'field_filters' => array(
        		array(
           			'key'   => '3',
            			'value' => 'Level One'
        		),
			array(
				'key' => '4',
				'value' => 'Baroque'
			)
    		)	
	);

	// id of song form
	$form_id = 17;

	$entries         = GFAPI::get_entries( $form_id, $search_criteria );

        foreach ( $entries as $entry ) {
            $choices[] = array( 'text' => rgar( $entry, '1'), 'value' => rgar( $entry, '1' ));
	 }

        // update 'Select a Post' to whatever you'd like the instructive option to be
        $field->placeholder = 'Select a Song';
        $field->choices = $choices;
    
	$form['description'] = 'populate last';
	}


	$option = isset($_POST['input_2']) ? $_POST['input_2'] : false;
	if( $option ){

       		echo '<h1 id="aria_second_plugin_css">'. $option .'</h1>';
	}
	else{
       		echo '<h1 id="aria_second_plugin_css">task option required</h1>';

	}


	//$form['description'] = 'modified';
	return $form;
}

*/
function aria_modify_logic( $form ) {

  echo '<h1> ARIA MODIFY LOGIC </h1>';

	$form['description'] = 'conditional last';
	// create array of periods
	$periods = array( 'Baroque', 'Classical', 'Contemporary', 'Romantic' );
	$levels = array( 'One', 'Two', 'Three' );
	
	foreach ( $form['fields'] as &$field ) {
		//$field['conditionallogic'] = true;
		// Show if field name contains classical
       		//echo '<h1 id="aria_second_plugin_css">field: ' . $field['label']. '</h1>';
		$rulesList = array();
		foreach( $periods as $period ) {
			if( strpos($field['label'], $period ) !== false ){
				$rulesList[] = array(
					'fieldId' => 6,
					'operator' => 'is',
					'value' => $period
				);

       		echo '<h1 id="aria_second_plugin_css">found field: ' . $field['label']. ' for ' . $period . '</h1>';
			}
       		//echo '<h1 id="aria_second_plugin_css">found field: ' . $field['label']. ' for ' . $period . '</h1>';
		}
		foreach( $levels as $level ){
			if( strpos($field['label'], $level ) !== false ){
				$rulesList[] = array(
					'fieldId' => 3,
					'operator' => 'is',
					'value' => $level
				);
			}

		}
		if( count( $rulesList ) != 0 ){
			$field['conditionalLogic'] = array(
				'actionType' => 'show',
				'logicType' => 'all',
				'rules' => $rulesList
			);
		}
		
//       		echo '<h1 id="aria_second_plugin_css">field: ' . $field['label']. '</h1>';
	}
	return $form;
}
?>
