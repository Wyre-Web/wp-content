<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wwcs
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php 	 the_title( '<h1 class="entry-title text-center"><img class="lstar" src="/wp-content/uploads/2021/10/leftstar.png">', '<img class="rstar" src="/wp-content/uploads/2021/10/star1.png"></h1>' ); ?>
	</header><!-- .entry-header -->


 
	<div class="entry-content">
		<?php
		the_content();
		?>
	</div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->
