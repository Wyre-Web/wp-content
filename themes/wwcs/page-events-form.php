<?php
/*
 * Template Name: Add Event
 */
acf_form_head();
get_header(); ?>

	<div class="container-fluid">
	<div class="row">
	    <div class="col-12">
	        	<div class="container">
	     <div class="jumbotron">
	            
	     <h1>Add Event</h1>
	        
	        <?php
if ( ! ( is_user_logged_in() || current_user_can('front_end_post') ) ) {
    echo '<p>You must be a registered author to post.</p>';
} else {
 acf_form(array(
         'post_id' => 'new_post',
         'field_group' => array(167), // Used ID of the field groups here.
         'post_title' => true, // This will show the title filed
         'post_content' => false, // This will show the content field
         'form' => true,
         'honeypot' => true,
         'new_post' => array(
             'post_type' => 'events',
             'post_status' => 'publish' // You may use other post statuses like draft, private etc.
         ),
       	'return'			=> home_url('events'),
         'submit_value' => 'Submit',
     ));

}
?>	<br>
	</div><!-- #primary -->
</div>
</div>
</div>
</div>
<?php

get_footer();