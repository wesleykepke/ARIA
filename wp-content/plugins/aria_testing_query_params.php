<?php
/*
Plugin Name: Aria: Testing Query Params
Plugin URI: http://google.com
Description: Sets a query param to herp.
Author: Ernest
Version: 2.2
Author URI: http://wkepke.com
*/


function test_query_params($entry, $form) {  
  wp_die(get_query_var('herp'));
}
add_action('gform_after_submission', 'test_query_params', 10, 2);

function add_query_vars_filter( $vars ){
  $vars[] = 'herp';
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

function query_activation_func() {

}
register_activation_hook(__FILE__, 'query_activation_func'); 
