<?php
/*
Plugin Name: Aria: Testing if form exists
Plugin URI: http://google.com
Description: Checks to see if the Gravity Forms plugin is enabled.  
Author: Wes
Version: 1.2
Author URI: http://wkepke.com
*/

function aria_activation_func() {
  require_once(ABSPATH . 'wp-admin/includes/plugin.php');
  if (is_plugin_active('gravityforms/gravityforms.php')) {  
    // Get all forms from gravity forms
    $forms = GFAPI::get_forms();

    // Set the form index of the Competition Creation Form.
    $index = -1;

    // Loop th rough each form to see if the form was previously created.
    foreach ($forms as $form) {
      if($form['title'] == "Test Registration Form") {
        $index =  $form['id'];
      }
    }

    // form does not exist; create new form 
    if ($index == -1) {
      $competition_creation_form = new GF_Form("Test Registration Form", "This shows that a form has been created");
      
      // First Name Field
      $first_name_field = new GF_Field_Text();
      $first_name_field->label = "Name: ";
      $first_name_field->id = 1;
      $first_name_field->isRequired = true;
      $first_name_field->size = 'medium';

      // Teacher Field
      $teacher_field = new GF_Field_Select();
      $teacher_field->label = "Teacher: ";
      $teacher_field->id = 2;
      $teacher_field->isRequired = true;
      $teacher_field->size = 'medium';

      // Level field
      $level_field = new GF_Field_Select();
      $level_field->label = "Level: ";
      $level_field->id = 3;
      $level_field->isRequired = true;
      $level_field->size = 'medium';

      // Period field
      $period_field = new GF_Field_Select();
      $period_field->label = "Period: ";
      $period_field->id = 4;
      $period_field->isRequired = true;
      $period_field->size = 'medium';

      // Songs
      $song_field = new GF_Field_Select();
      $song_field->label = "Song: ";
      $song_field->id = 5;
      $song_field->isRequired = true;
      $song_field->size = 'medium';

      $competition_creation_form->fields[] = $first_name_field;
      $competition_creation_form->fields[] = $teacher_field;
      $competition_creation_form->fields[] = $level_field;
      $competition_creation_form->fields[] = $period_field;
      $competition_creation_form->fields[] = $song_field;

      $result = GFAPI::add_form($competition_creation_form->createFormArray());
    
      add_filter( 'gform_pre_render_' . $result, 'aria_populate_posts', 3 );
      add_filter( 'gform_pre_validation_' . $result, 'aria_populate_posts' );
      add_filter( 'gform_pre_submission_filter_' . $result, 'aria_populate_posts' );
      add_filter( 'gform_admin_pre_render_' . $result, 'aria_populate_posts' );
 
      add_filter( 'gform_pre_render_' . $result, 'aria_modify_logic', 2 );

    }

    // form exists; dynamically populate droptown 
    else {
      add_filter('gform_field_value_Choices', 'aria_dynamically_populate_teachers');
      //echo 'create competition form exits, made it through filter';
      //die;
      $competition_creation_form = GFAPI::get_form(14); 
      //echo 'Competition Title: ' . $competition_creation_form['title'] . '</br>';
      //echo 'First field label: ' . $competition_creation_form['fields'][0]->label . '</br>';
       

      $index = 0;  
      foreach( $form['fields'] as $field ) {
        //echo 'Field #' . $index . ': ' . $field->type. '<br/>';
        $index++; 
        //die;  
      } 
    }

  }
}

function aria_populate_posts( $form ) {

    foreach ( $form['fields'] as &$field ) {

        if ( $field['id'] != 4 ){//|| strpos( $field->cssClass, 'populate-posts' ) === false ) {
       // echo '<h1 id="aria_second_plugin_css">not field 4: field' . $field['id']. '</h1>';
             continue;
        }

        // you can add additional parameters here to alter the posts that are retrieved
        // more info: [http://codex.wordpress.org/Template_Tags/get_posts](http://codex.wordpress.org/Template_Tags/get_posts)
        //$posts = get_posts( 'numberposts=-1&post_status=publish' );

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

  //$form['description'] = 'modified';
  return $form;
}


function aria_modify_logic( $form ) {

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
    
//          echo '<h1 id="aria_second_plugin_css">field: ' . $field['label']. '</h1>';
  }
  return $form;
}
register_activation_hook(__FILE__, 'aria_activation_func'); 
