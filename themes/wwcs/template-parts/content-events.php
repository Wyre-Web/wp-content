<?php
/*Template name: Events
    
    */
$img = get_field('ev_picture');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container eventjumb jumbotron events">

        <div class="container pesingle">
            <div class="row">
                <div class="col-12">
                    <h1><?php the_title();?></h1><br>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <img src="<?php echo esc_url($img['url']); ?>" />
                  
                </div>
                <div class="col-4">
                    <h4 class="edt"><i class="fa-solid fa-calendar-days"></i><?php the_field('ev_date')?></h4>
                    <br>
                    <h4> <?php the_field('ev_description');?></h4><br>
                  
                </div>


                <div class="col-4">
             
                    <h4><?php
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

   echo '<br><p><i class="fa-solid fa-location-dot"></i>' . $address_first . '<br>' . $address_second . '</p><br>';
}?>
 <?php  if (get_field('book_event')){ 	 ?>
          <p>Click to  <a href="<?php echo the_field('book_event'); ?>">Book Event</a></p><?php } ?><br>

                    <?php  if (get_field('first_class')){ 
    	  echo '<h4><i class="fa-solid fa-clock"></i> Performance Times</h4><br><ul><li>' . get_field('first_class') . '</li>';
    	  } ?>
                    <?php if (get_field('second_class')){ 
    	  echo '<li>' . get_field('second_class') . '</li>';
    	  } ?>
                    <?php if (get_field('third_class')){ 
    	  echo '<li>' . get_field('third_class') . '</li>';
    	  } ?>
                    <?php if (get_field('fourth_class')){ 
    	  echo '<li>' . get_field('fourth_class') . '</li>';
    	  } ?>
                    <?php if (get_field('fifth_class')){ 
    	  echo '<li>' . get_field('fifth_class') . '</li>';
    	  }  ?> </ul>
           
            <?php  if (get_field('other_event_link')){ 	 ?>
            <a href="<?php echo the_field('other_event_link'); ?>">Other Info</a><?php } ?>
                </div>
            </div>
        </div>
    </div>
</article>