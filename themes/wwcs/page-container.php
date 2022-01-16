<?php
/**
 * Template name: Container
*/
get_header();
?>
<div class="container-fluid wsfront">
    <div class="row">
  <!--  <div class="col-2 text-center double">
    <img alt="star" class="star1" src="https://panache.nic-edesign.com/wp-content/uploads/2021/12/starstrip-1.png"><br><br><br>
<img alt="star" class="star" src="https://panache.nic-edesign.com/wp-content/uploads/2021/12/starstrip-1.png">
    </div>-->
    <div class="col-12">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header ">
		<?php	 the_title( '<h1 class="entry-title text-center"><img class="lstar" src="/wp-content/uploads/2021/10/leftstar.png">', '<img class="rstar" src="/wp-content/uploads/2021/10/star1.png"></h1>' ); ?>
	</header><!-- .entry-header -->

 
	<div class="entry-content">
		<?php
		the_content();
		?>
	</div><!-- .entry-content -->


</article>	</div><!-- #post-<?php the_ID(); ?> -->
<!--<div class="col-2 text-center double">
    <img alt="star" class="star1" src="https://panache.nic-edesign.com/wp-content/uploads/2021/12/starstrip-1.png"><br><br><br>
<img alt="star" class="star" src="https://panache.nic-edesign.com/wp-content/uploads/2021/12/starstrip-1.png">
    </div>-->
    </div>  </div>
<?php get_footer();