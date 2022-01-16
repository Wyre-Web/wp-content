<?php
/*
 * Template Name: DC Enquiry

 */
acf_form_head();
get_header(); ?>

	<div class="container-fluid  wsfront">
	<div class="row">
	    <div class="col-12">
	        	<div class="container">
	<header class="entry-header ">
		<h1 class="entry-title text-center"><img class="lstar" src="/wp-content/uploads/2021/10/leftstar.png">Become a Dance Captain<img class="rstar" src="/wp-content/uploads/2021/10/star1.png"></h1>	</header><!-- .entry-header -->


	        <div class="entry-content">
  
        <p class="has-text-align-center">The training day (Master Class) and practical assessment (Audition) will be
            completed either via an online platform or the face-to-face studio environment. It consists of one full day
            (8hrs) led by a specialist tutor (part of the Panache show team).</p>
        <p class="has-text-align-center">Regardless of whether the Master Class and Audition occurs online or face
            to&nbsp;face, the Dance Captain will still receive professional support, guidance and&nbsp;training directly
            from the Panache team.</p>
        <p class="has-text-align-center">If anyone is interested to train with us and can show their competence by
            completing&nbsp;our Panache Dance Fitness training assessments; showing that they have what it&nbsp;takes to
            share in our passion for the dance fitness industry.</p>
        <p class="has-text-align-center">We are more than&nbsp;happy to support you!</p>
        <div style="height:41px" aria-hidden="true" class="wp-block-spacer"></div>
        <div class="wp-block-columns">
            <div class="wp-block-column">
                <div class="wp-block-image">
                    <figure class="aligncenter size-full"><img loading="lazy" width="64" height="64"
                            src="https://panache.nic-edesign.com/wp-content/uploads/2021/09/handshake-2-64-1.png" alt=""
                            class="wp-image-130"></figure>
                </div>
                <p class="has-text-align-center">FULL AND CONTINUED SUPPORT ON HOW TO GROW YOUR CLASSES AND LAUNCH YOUR
                    CAREER</p>
            </div>
            <div class="wp-block-column">
                <div class="wp-block-image">
                    <figure class="aligncenter size-full"><img loading="lazy" width="64" height="64"
                            src="https://panache.nic-edesign.com/wp-content/uploads/2021/09/emoticon-64.png" alt=""
                            class="wp-image-129"></figure>
              </div>
                <p class="has-text-align-center">A FUN, LIVE AND INTERACTIVE TRAINING SESSION</p>
            </div>
           <div class="wp-block-column">
                <div class="wp-block-image">
                    <figure class="aligncenter size-full"><img loading="lazy" width="64" height="64"
                            src="https://panache.nic-edesign.com/wp-content/uploads/2021/09/literature-64.png" alt=""
                            class="wp-image-131"></figure>
                </div>
                <p class="has-text-align-center">A FULL CATALOGUE OF AMAZING ROUTINES FOR YOUR FIRST CLASS</p>
            </div>
        </div>
        <div class="wp-block-columns">
            <div class="wp-block-column">
                <div class="wp-block-image">
                    <figure class="aligncenter size-full"><img loading="lazy" width="64" height="64"
                            src="https://panache.nic-edesign.com/wp-content/uploads/2021/09/old-time-camera-64.png"
                            alt="" class="wp-image-135"></figure>
                </div>
                <p class="has-text-align-center">VIDEOS AND BREAKDOWN GUIDES OF EACH ROUTINE FROM OUR BACKSTAGE AREA</p>
            </div>
          <div class="wp-block-column">
                <div class="wp-block-image">
                    <figure class="aligncenter size-full"><img loading="lazy" width="64" height="64"
                            src="https://panache.nic-edesign.com/wp-content/uploads/2021/09/instagram-64.png" alt=""
                            class="wp-image-136"></figure>
                </div>
                <p class="has-text-align-center">HELP WITH BRANDING AND MARKETING FOR KILLER SOCIAL MEDIA</p>
            </div>
            <div class="wp-block-column">
                <div class="wp-block-image">
                    <figure class="aligncenter size-full"><img loading="lazy" width="64" height="64"
                            src="https://panache.nic-edesign.com/wp-content/uploads/2021/09/star-2-64.png" alt=""
                            class="wp-image-138"></figure>
               </div>
                <p class="has-text-align-center">VIP BACKSTAGE MEMBERS AREA</p>
            </div>
        </div>
        <p class="has-text-align-center">Are you interested in becoming a Dance Captain?&nbsp;</p>
        <p class="has-text-align-center">Due to the current situation, we are now offering a chance to become Panache
            Dance Fitness certified through our new on-demand training platform. More information below:</p>
    
</div>
	  <div class="jumbotron">     
	  <h2 class="text-center">Request Form</h2>
	        <?php

 acf_form(array(
         'post_id' => 'new_post',
         'field_group' => array(7297), // Used ID of the field groups here.
         'post_title' =>false, // This will show the title filed
         'post_content' => false, // This will show the content field
         'form' => true,
         'honeypot' => true,
         'new_post' => array(
             'post_type' => 'dc-enquiries',
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
</div>
<?php

get_footer();