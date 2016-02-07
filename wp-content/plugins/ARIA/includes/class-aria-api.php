<?php

/**
 * The file acts like an API for functions that may be called repeatedly.
 *
 * This file lists various functions and their implementation that may be
 * used throughout ARIA. Simply require_once this file and the all of the
 * associated functionality will be available.
 *
 * @link       http://wesleykepke.github.io/ARIA/
 * @since      1.0.0
 *
 * @package    ARIA
 * @subpackage ARIA/includes
 */

// Make sure Gravity Forms is installed and enabled
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (!is_plugin_active('gravityforms/gravityforms.php')) {
  wp_die("Error: ARIA requires the Gravity Forms plugin to be installed
  and enabled. Please enable the Gravity Forms plugin and reactivate
  ARIA.");
}

/**
 * This function will find the ID of the form used to create music competitions.
 *
 * This function will iterate through all of the active form objects and return
 * the ID of the form that is used to create music competitions. If no music
 * competition exists, the function will return -1.
 *
 * @since 1.0.0
 * @author KREW
 */
function aria_get_create_competition_form_id() {
  $create_competition_form_name = 'ARIA: Create a Competition';
  $create_competition_form_id = NULL;
  $all_active_forms = GFAPI::get_forms();

  foreach ($all_active_forms as $form) {
    if ($form['title'] === $create_competition_form_name) {
      $create_competition_form_id = $form['id'];
    }
  }

  if (!isset($create_competition_form_id)) {
    $create_competition_form_id = -1;
  }

  return $create_competition_form_id;
}
