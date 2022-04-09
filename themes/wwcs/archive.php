<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MoZone
 */
$current_user = wp_get_current_user(); // grab user info  from the database

if ( is_user_logged_in() && current_user_can( 'dance_captain' )  || current_user_can('administrator')) :
get_header();
?>
<div class="container-fluid wsfront">
		
       <br> <h1 class="entry-title text-center"><img class="lstar" src="/wp-content/uploads/2021/10/leftstar.png">EVENTS<img class="rstar" src="/wp-content/uploads/2021/10/star1.png"></h1>
        	<?php if ( have_posts() ) : ?>
        
        	<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();	
	
				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

		echo 
		endif;

    ?>
</div>
<?php endif; get_footer();?>
