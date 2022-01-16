<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MoZone
 */
 $args = array(
        'posts_per_page' => 1, /* how many post you need to display */
        'offset' => 0,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_type' => 'training-days', /* your post type name */
        'post_status' => 'publish'
    );
get_header();
?>
<div class="container-fluid stage">
<div class="container ">
	   <br> <h1 class="entry-title text-center"><img class="lstar" src="/wp-content/uploads/2021/10/leftstar.png">TRAINING DAYS<img class="rstar" src="/wp-content/uploads/2021/10/star1.png"></h1>
      <br> 
      <div class="happy"></div>
   <?php $query = new WP_Query($args);
    if ($query->have_posts()) :?>
       
      <?php  while ($query->have_posts()) : $query->the_post();
        
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );
?><?php
		endif;

    ?>
          <div class="hairdown"></div>
</div></div>
<?php get_footer();?>
