<?php
/*Template name: Rehearsals - more info */

get_header(); ?>


    <?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>

    <div id="post-<?php the_ID(); ?>" >


 <?php get_field('imapct_type'); ?> <br>
		 <?php get_field('re_parking'); ?> <br>
		 <?php get_field('re_additional_parking_information'); ?> <br>
		 <?php get_field('price'); ?> <br>
		 <?php get_field('re_promotion'); ?> <br>
		 <?php get_field('re_offers'); ?> <br>
		 <?php get_field('offer_price'); ?> <br>
		 <?php get_field('regular_price'); ?> <br>
		 <?php get_field('offer_information'); ?> <br>
		 <?php get_field('is_booking_esssential'); ?><br>
		 
		 
		<?php 	 endwhile;
		endif;
	?>


</div>
<?php get_footer();

