<?php
/*
 * Template Name: Host WS Enquiry

 */
acf_form_head();
get_header(); ?>

	<div class="container-fluid  dcfront">
	<div class="row">
	    <div class="col-12">
	        	<div class="container">
	   	<div class="stage">
	
	<header class="entry-header ">
		<h1 class="entry-title text-center"><img class="lstar" src="/wp-content/uploads/2021/10/leftstar.png">Host a Workshop<img class="rstar" src="/wp-content/uploads/2021/10/star1.png"></h1>	</header><!-- .entry-header -->

 
	<div class="entry-content">

<div class="wp-block-columns">
<div class="wp-block-column" style="flex-basis:25%"></div>



<div class="wp-block-column" style="flex-basis:50%">
<p class="has-text-align-center">Why don’t you plan an event with your future cast members and let them experience how much fun a Panache rehearsal is?</p>
</div>



<div class="wp-block-column" style="flex-basis:25%"></div>
</div>



<p class="has-text-align-center">Have part of the show team come to your area and deliver a 2 hour workshop, first section is a dance fitness rehearsal as the second half will be a taught piece of choreography that is more complex.</p>



<p class="has-text-align-center">Have part of the show team come to your area and deliver a 2 hour workshop, first section is a dance fitness rehearsal as the second half will be a taught piece of choreography that is more complex.</p>



<p class="has-text-align-center">Tickets to be sold by yourself and to have a commission based incentive.</p>



<p class="has-text-align-center">Contact the box office for more information!</p>
</div>	</div>
	  <div class="jumbotron">     
	  <h2 class="text-center">Dance Captain Form</h2>
	        <?php

 acf_form(array(
         'post_id' => 'new_post',
         'field_group' => array(7305), // Used ID of the field groups here.
         'post_title' => false, // This will show the title filed
         'post_content' => false, // This will show the content field
         'form' => true,
         'honeypot' => true,
         'new_post' => array(
             'post_type' => 'host-a-workshop',
             'post_status' => 'publish' // You may use other post statuses like draft, private etc.
         ),
       	'return'			=> home_url('thankyou'),
         'submit_value' => 'Enquire',
     ));

?>	<br>
	</div><!-- #primary -->

</div>
</div>
</div>
</div>
<?php

get_footer();