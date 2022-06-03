<?php
/*
 * Template Name: DC Content
 * Template Post Type: post, rehearsals
 */

get_header();
$current_user = wp_get_current_user(); // grab user info  from the database

if ( is_user_logged_in() && current_user_can( 'dance_captain' )  || current_user_can('administrator')) :


?>
<div class="container jumbotron text-center">
	<h1>
	    	<?php 
	    	the_title();?></h1>
	    	<?php while ( have_posts() ) : the_post(); 
		
				
				  the_content(); 
endwhile;?>

</div>

<?php
endif;
get_footer();
