 <div class="jumbotron container-fluid">
     <h2 class="text-center"><span class="star1"></span>Reviews<span class="star2"></span></h2>
     
<?php

$reviews_query = new WP_Query(
     array(
         'post_type' => "reviews",
         'author' => $curauth->ID,
         ));
         
         if(have_posts()) :
             echo '<div class="row">';
             while($reviews_query -> have_posts()) {
               $reviews_query ->the_post();?>
               <div class="col-4">
       <div class="card reviewcard" style="width: 18rem;">
  <div class="card-top text-center">
    <br>  <h5 class="card-title revtitle">STAR RATING</h5>
     <?php if(get_field('stars') === "1"):
     ?><span class="starb">&#9733;</span><?php endif;?>
  <?php if(get_field('stars') === "2"):
     ?><span class="starb">&#9733;&#9733;</span><?php endif;?>
  <?php if(get_field('stars') === "3"):
     ?><span class="starb">&#9733;&#9733;&#9733;</span><?php endif;?>
 <?php if(get_field('stars') === "4"):
     ?><span class="starb">&#9733;&#9733;&#9733;&#9733;</span><?php endif;?>
 <?php if(get_field('stars') === "5"):?>
     <span class="starb">&#9733;&#9733;&#9733;&#9733;&#9733;</span><?php endif;?>
</div><hr>  <div class="card-body">
   
    <p class="card-text">
    <i>Cast Member - <?php the_field('rev_name');?> says:<br><br><?php the_field('re_review');?></i><p>
  </div>
</div>
</div>
<?php
            }
        echo '</div>';
			
     else:
       
 endif;
    /* Restore original Post Data */
    wp_reset_postdata(); 
  ?>
  
</div>
  