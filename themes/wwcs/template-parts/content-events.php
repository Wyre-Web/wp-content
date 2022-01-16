<?php
/*Template name: Events
    
    */
$img = get_field('ev_picture');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="container jumbotron events">

<div class="container pesingle">
    <div class="row">
    	<div class="col-12">
 <h1><?php the_title();?></h1><br>
 </div></div>
  <div class="row">
    	<div class="col-4">
    <img src="<?php echo esc_url($img['url']); ?>"/>
    <br><h4><?php
$location = get_field('event_location');
if( $location ) {

    // Loop over segments and construct HTML.
    $address_first = '';
    foreach( array('street_number', 'street_name') as $i => $k ) {
        if( isset( $location[ $k ] ) ) {
            $address_first .= sprintf( '<span class="segment-%s">%s</span> ', $k, $location[ $k ] );
        }
    }
      // Trim trailing comma.
    $address_first = trim( $address_first, '' );

     $address_second = '';
 foreach( array('town', 'post_code') as $i => $k ) {
        if( isset( $location[ $k ] ) ) {
            $address_second .= sprintf( '<span class="segment-%s">%s</span>' , $k, $location[ $k ] );
        }
    }
    // Trim trailing comma.
    $address_second = trim( $address_second, '' );

   echo '<br><p>' . $address_first . '<br>' . $address_second . '</p><br>';
}?>
    </div>
     	<div class="col-8">
     	   <h4 class="edt"><?php the_field('ev_date')?></h4>
     	   <br>
     	    <h4> 	<?php the_field('ev_description');?></h4><br>


   <?php  if (get_field('first_class')){ 
    	  echo '<h4>Performance Times</h4><br><ul><li>' . get_field('first_class') . '</li>';
    	  } ?>
    	   <?php if (get_field('second_class')){ 
    	  echo '<li>' . get_field('second_class') . '</li>';
    	  } ?>
    	      <?php if (get_field('third_class')){ 
    	  echo 'li>' . get_field('third_class') . '</li>';
    	  } ?>
    	     <?php if (get_field('fourth_class')){ 
    	  echo '<li>' . get_field('fourth_class') . '</li>';
    	  } ?> 
    	   <?php if (get_field('fifth_class')){ 
    	  echo '<li>' . get_field('fifth_class') . '</li>';
    	  }  ?> </ul>
    	    </div>
               </div>   
</div></div>
</article>

                
        
        