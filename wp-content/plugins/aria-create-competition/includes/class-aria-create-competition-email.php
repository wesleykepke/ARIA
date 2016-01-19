<?php

/**
 * Provides the "Create Competition" plugin with email functionality. 
 *
 * This class defines all code necessary for the "Create Competition" plugin
 * to be able to send emails at specific points in time. 
 *
 * @since      1.0.0
 * @package    aria-create-competition
 * @subpackage aria-create-competition/includes
 * @author     KREW (Kyle, Renee, Ernest, and Wes)
 */
class ARIA_Create_Competition_Teacher_Registration_Email {

   /**
    * Creates the custom hook that will be used to send emails. 
    */
   public static function aria_add_email_hook() {
      // create custom hook for cron scheduling  
      add_action('aria_email_cron_hook', array(&$this, 'aria_send_email'));  
   }

   /**
    * Defines the time that the emails will be sent out. 
    */
   public static function aria_set_send_time( $time_to_send_emails ) {
      // use WordPress API to schedule send time
      $unix_time_version = strtotime($time_to_send_emails); 
      wp_schedule_single_event($unix_time_version, 'aria_email_cron_hook'); 
   }

   /**
    * Sends the email to the recipient at the specified time. 
    */  
   public static function aria_send_email() {

      // obtain (in array) the email addresses of teachers in the event

      // loop through the list of teachers and generate a custom message
         // "you have n students registered..."

      // (for all teachers) call the wp_mail function  
   }

}
