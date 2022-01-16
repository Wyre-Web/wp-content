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

		echo '<h1 class="text-center eventnone ">We are not sure when our next event will be, but check back soon for an update!</h1> ';
		endif;

    ?>
</div>
<?php get_footer();?>
