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

<div class="container-fluid">
	<div class="row">
	<div class="container jumbotron">
<h2 class="text-center jumtitle">Virtual Rehearsals</h2><br>

        	<?php ///if ( have_posts() ) : ?>
        
        	<?php
			/* Start the Loop */
			//while ( have_posts() ) :
			//	the_post();	
              
                $args = array( 
    'post_type' => 'rehearsals',
    'post_status' => 'publish',
    'meta_key' => 're_venue',
	'posts_per_page' => -1, 
   // 'orderby' => 'ID',
  //  'order' => 'DESC'

);

    $loop = new WP_Query( $args );  
?>
<?php
if( $loop->have_posts() ):   ?>

<?php  while ( have_posts() ) : the_post(); ?>

	<?php			/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );?>
			
				<?php		endwhile;
			
		

		else :

			get_template_part( 'template-parts/content', 'none' );?>
			
	<?php	endif;
wp_reset_postdata();

    ?>
</div>
		</div>

</div>
<?php get_footer();


