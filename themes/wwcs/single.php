<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wwcs
 */

get_header();
get_header();
$current_user = wp_get_current_user(); // grab user info  from the database

if ( is_user_logged_in() && current_user_can( 'dance_captain' )  || current_user_can('administrator')) :

?>
<div class="container-fluid">
	
	    	<?php while ( have_posts() ) : the_post(); 
		
				
				  the_content(); 
endwhile;?>

</div>

<?php
endif;
get_footer();
