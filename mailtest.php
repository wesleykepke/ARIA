<?php 

// Set $to as the email you want to send the test to.
$to = "wesleykepke@nevada.unr.edu";
 
// No need to make changes below this line.
 
// Email subject and body text.
$subject = 'wp_mail function test';
$message = 'This is a test of the wp_mail function: wp_mail is working';
$headers = 'From: Wesley Kepke <wesleykepke@nevada.unr.edu>' . "\r\n";
 
// Load WP components, no themes.
define('WP_USE_THEMES', false);
require('wp-load.php');
 
// send test message using wp_mail function.
$sent_message = wp_mail( $to, $subject, $message, $headers );
//display message based on the result.
if ( $sent_message ) {
    // The message was sent.
    echo 'The test message was sent. Check your email inbox.';
} else {
    // The message was not sent.
    echo 'The message was not sent (using wp_mail)!';
}
