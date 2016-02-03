<?php
/*
Plugin Name: Aria: Testing Query Params
Plugin URI: http://google.com
Description: Sets a query param to herp.
Author: Ernest
Version: 2.2
Author URI: http://wkepke.com
*/

function my_page_template_redirect()
{
    if( is_page( 'competition-creation-tester' ) && get_query_var('stop', -1) != -1)
    {
        wp_redirect( home_url() );
        exit();
    }
}
add_action( 'template_redirect', 'my_page_template_redirect' );

function test_query_params($entry, $form) {  
  $param_val = get_query_var('herp', -1);
  if ($param_val != -1) {
    wp_die($param_val);
  }
}
add_action('gform_after_submission', 'test_query_params', 10, 2);

function add_query_vars_filter( $vars ){
  $vars[] = 'herp';
  $vars[] .= 'stop';
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

function query_activation_func() {

}
register_activation_hook(__FILE__, 'query_activation_func'); 
