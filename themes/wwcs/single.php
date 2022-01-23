<?php
/*
 * Template Name: DC Content
 * Template Post Type: post, rehearsals
 */

get_header();
<<<<<<< Updated upstream
get_header();
$current_user = wp_get_current_user(); // grab user info  from the database

if ( is_user_logged_in() && current_user_can( 'dance_captain' )  || current_user_can('administrator')) :

?>
<div class="container jumbotron text-center">
	
	    	<?php while ( have_posts() ) : the_post(); 
		
				
				  the_content(); 
endwhile;?>

</div>

<?php
endif;
=======
?>

	<main id="primary" class="site-main">

	<div class="container jumbotron pesingle">
	<div class="row">
 <div class="col-xl-7 col-lg-7 col-md-12 col-xs-12 text-center " style="margin: 0 auto;">
    
   <br>
    <h1><?php the_title();?></h1>
<?php the_content();?>
</div></div></div></main>
<?php

>>>>>>> Stashed changes
get_footer();
