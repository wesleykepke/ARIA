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
    $competition_creation_form_title = "ARIA: Create a Competition";
    $index = -1;

    // Loop through each form to see if the form was previously created.
    foreach ($forms as $form) {
      if($form['title'] == "ARIA: Create a Competition") {
        $index =  $form['id'];
      }
    }

    // form does not exist; create new form 
    if ($index == -1) {
      $result = aria_create_competition_form();
      wp_die("This is the result: " . $result);
    }
  }
}
register_activation_hook(__FILE__, 'aria_activation_func'); 


function aria_create_competition_form() {
//   $competition_creation_form 
//       = new GF_Form("ARIA: Create a Competition", "");
  
//   // Name Field
//   $competition_name_field = new GF_Field_Text();
//   $competition_name_field->label = "Name of Competition";
//   $competition_name_field->id = 1;
//   $competition_name_field->isRequired = true;

//   // Date of the competition
//   $competition_date_field = new GF_Field_Date();
//   $competition_date_field->label = "Date of Competition";
//   $competition_date_field->id = 2;
//   $competition_date_field->isRequired = false;

//   // Location
//   $competition_location_field = new GF_Field_Address();
//   $competition_location_field->label = "Location of Competition";
//   $competition_location_field->id = 3;
//   $competition_location_field->isRequired = false;

//   // Student Registration start date
//   $student_registration_start_date_field = new GF_Field_Date();
//   $student_registration_start_date_field->label = "Student Registration Start Date";
//   $student_registration_start_date_field->id = 4;
//   $student_registration_start_date_field->isRequired = false;

//   // Student Registration deadline
//   $student_registration_end_date_field = new GF_Field_Date();
//   $student_registration_end_date_field->label = "Student Registration End Date";
//   $student_registration_end_date_field->id = 5;
//   $student_registration_end_date_field->isRequired = false;

//   // Teacher Registration start date
//   $teacher_registration_start_date_field = new GF_Field_Date();
//   $teacher_registration_start_date_field->label = "Teacher Registration Start Date";
//   $teacher_registration_start_date_field->id = 6;
//   $teacher_registration_start_date_field->isRequired = false;

//   // Teacher Registration deadline
//   $teacher_registration_end_date_field = new GF_Field_Date();
//   $teacher_registration_end_date_field->label = "Teacher Registration Start Date";
//   $teacher_registration_end_date_field->id = 7;
//   $teacher_registration_end_date_field->isRequired = false;

//   $competition_creation_form->fields[] = $competition_name_field;
//   $competition_creation_form->fields[] = $competition_date_field;
//   $competition_creation_form->fields[] = $competition_location_field;
//   $competition_creation_form->fields[] = $student_registration_start_date_field;
//   $competition_creation_form->fields[] = $student_registration_end_date_field;
//   $competition_creation_form->fields[] = $teacher_registration_start_date_field;
//   $competition_creation_form->fields[] = $teacher_registration_end_date_field;
  $create_competition_form_json = '{"title":"Aria: Create a Competition","description":"","labelPlacement":"top_label","descriptionPlacement":"below","button":{"type":"text","text":"Submit","imageUrl":""},"fields":[{"type":"text","id":1,"label":"Name of Competition","adminLabel":"","isRequired":true,"size":"medium","errorMessage":"","inputs":null,"labelPlacement":"","descriptionPlacement":"","subLabelPlacement":"","placeholder":"","multipleFiles":false,"maxFiles":"","calculationFormula":"","calculationRounding":"","enableCalculation":"","disableQuantity":false,"displayAllCategories":false,"inputMask":false,"inputMaskValue":"","allowsPrepopulate":false,"formId":54,"pageNumber":1,"description":"","inputType":"","cssClass":"","inputName":"","adminOnly":false,"noDuplicates":false,"defaultValue":"","choices":"","conditionalLogic":""},{"type":"date","id":2,"label":"Start Date of Competition","adminLabel":"","isRequired":true,"size":"medium","errorMessage":"","inputs":[{"id":"2.1","label":"Month","name":"","placeholder":"Month","defaultValue":""},{"id":"2.2","label":"Day","name":"","placeholder":"Day","defaultValue":""},{"id":"2.3","label":"Year","name":"","placeholder":"Year","defaultValue":""}],"labelPlacement":"","descriptionPlacement":"","subLabelPlacement":"","placeholder":"","multipleFiles":false,"maxFiles":"","calculationFormula":"","calculationRounding":"","enableCalculation":"","disableQuantity":false,"displayAllCategories":false,"inputMask":false,"inputMaskValue":"","dateType":"datedropdown","calendarIconType":"none","calendarIconUrl":"","allowsPrepopulate":false,"formId":54,"pageNumber":1,"description":"","inputType":"","cssClass":"","inputName":"","adminOnly":false,"noDuplicates":false,"defaultValue":"","choices":"","conditionalLogic":"","dateFormat":""},{"type":"date","id":3,"label":"End Date of Competition","adminLabel":"","isRequired":false,"size":"medium","errorMessage":"","inputs":[{"id":"3.1","label":"Month","name":"","placeholder":"Month","defaultValue":""},{"id":"3.2","label":"Day","name":"","placeholder":"Day","defaultValue":""},{"id":"3.3","label":"Year","name":"","placeholder":"Year","defaultValue":""}],"labelPlacement":"","descriptionPlacement":"","subLabelPlacement":"","placeholder":"","multipleFiles":false,"maxFiles":"","calculationFormula":"","calculationRounding":"","enableCalculation":"","disableQuantity":false,"displayAllCategories":false,"inputMask":false,"inputMaskValue":"","dateType":"datedropdown","calendarIconType":"none","calendarIconUrl":"","allowsPrepopulate":false,"formId":54,"pageNumber":1,"description":"","inputType":"","cssClass":"","inputName":"","adminOnly":false,"noDuplicates":false,"defaultValue":"","choices":"","conditionalLogic":"","dateFormat":""},{"type":"address","id":4,"label":"Location","adminLabel":"","isRequired":true,"size":"medium","errorMessage":"","inputs":[{"id":"4.1","label":"Street Address","name":""},{"id":"4.2","label":"Address Line 2","name":""},{"id":"4.3","label":"City","name":""},{"id":"4.4","label":"State \/ Province","name":""},{"id":"4.5","label":"ZIP \/ Postal Code","name":""},{"id":"4.6","label":"Country","name":""}],"labelPlacement":"","descriptionPlacement":"","subLabelPlacement":"","placeholder":"","multipleFiles":false,"maxFiles":"","calculationFormula":"","calculationRounding":"","enableCalculation":"","disableQuantity":false,"addressType":"international","defaultState":"","defaultProvince":"","defaultCountry":"United States","displayAllCategories":false,"inputMask":false,"inputMaskValue":"","allowsPrepopulate":false,"formId":54,"pageNumber":1,"description":"","inputType":"","cssClass":"","inputName":"","adminOnly":false,"noDuplicates":false,"defaultValue":"","choices":"","conditionalLogic":""}],"version":"1.9.14","id":54,"useCurrentUserAsAuthor":true,"postContentTemplateEnabled":false,"postTitleTemplateEnabled":false,"postTitleTemplate":"","postContentTemplate":"","lastPageButton":null,"pagination":null,"firstPageCssClass":null,"notifications":{"56a16efcedd4d":{"id":"56a16efcedd4d","to":"{admin_email}","name":"Admin Notification","event":"form_submission","toType":"email","subject":"New submission from {form_title}","message":"{all_fields}"}},"confirmations":{"56a16efd01d2a":{"id":"56a16efd01d2a","name":"Default Confirmation","isDefault":true,"type":"message","message":"Thanks for contacting us! We will get in touch with you shortly.","url":"","pageId":"","queryString":""}},"is_active":"1","date_created":"2016-01-21 23:51:24","is_trash":"0"}';

  $result = GFAPI::add_form(json_decode($create_competition_form_json));
//   add_action( 'gform_after_submission_' . $result, 'aria_create_competition', 10, 2);

  return $result;
}

function aria_create_competition( $entry, $form ) {
  $competition_student_form 
      = new GF_Form( rgar($entry, '1') . " Student Registration", "");
  $result = GFAPI::add_form($competition_student_form->createFormArray());
  wp_die($result);
}


