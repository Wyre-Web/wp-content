<?php
/*Template name: Reviews
    
    */

?>
<div class="row">
    <div class="col-12">
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
</div>


