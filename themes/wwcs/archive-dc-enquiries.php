<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MoZone
 */

get_header();
?>
<?php
$current_user = wp_get_current_user(); // grab user info  from the database 

if ( current_user_can( 'site-owner' )  || current_user_can('administrator') ) : // 'read' is the lowest  level capability ?>
	<div class="container">
<h1>Become a Dance Captain Enquiries</h1> <br>
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
			
	$post_url 	= get_permalink( $post_id );?>

<?php 	  if( $post_url ): ?>
 <p>   <?php the_time('m/j/y g:i A') ?> - <a class="button" href="<?php echo esc_url( $post_url); ?>">Click to view</a></p>
<?php endif;  

			endwhile;

			the_posts_navigation();

	
		endif;
		?>



<?php endif; // end of user capability check ?>
</div>
<?php

get_footer();
