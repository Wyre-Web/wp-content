<?php
/*
 * Template Name: upload
 */
acf_form_head();
get_header(); 


acf_form(array(
         'post_id' => 'new_post',
         'field_group' => array(4390), // Used ID of the field groups here.
         'post_title' => false, // This will show the title filed
         'post_content' => false, // This will show the content field
         'form' => true,
         'honeypot' => true,
         'new_post' => array(
             'post_type' => 'course',
             'post_status' => 'publish' // You may use other post statuses like draft, private etc.
         ),
       //	'return'			=> home_url('training-days'),
         'submit_value' => 'Submit',
     ));

?>