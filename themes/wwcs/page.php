<?php
/**
 * Template name: offset container
 * @package wwcs
 */

get_header();
?>

	<div class="container-fluid site-main">
<div class="row">
    <div class="col-md-10 offset-md-1">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the 

		endwhile; // End of the loop.
		?>

	</div><!-- #main -->
</div>
</div>
<?php

get_footer();
