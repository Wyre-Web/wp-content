<?php 
/*Template name: My Rehearsals
    
    */
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
$id = get_the_ID();
$author_id = get_the_author_meta('ID');
$rehearsals_query = new WP_Query(
     array(
         'post_type' => 'rehearsals',
          'author' => $curauth->ID,
         ));
         
         if(have_posts()) :
             echo '<div class="col-3 jumbotron rehearsals"><h2 class="text-center">Rehearsals</h2>';
             while($rehearsals_query -> have_posts()) {
              $rehearsals_query->the_post();
 if( get_field('dc_booking_link')): ?>
                    <a class="btn btn-danger float-right bookingbtn" role="button"
                        href="<?php get_field('dc_booking_link') ?>">Click to Book</a>
                    <?php endif; 

	$days = get_field('re_days');
	$tags = get_the_terms($days->post_id, 'post_tag');       
	foreach($tags as $tag) : 
		if ($tag->name === 'Monday')  : ?>
		 <div class="card" style="width: 16rem;">  
	      <div class="card-body">
            <h5 class="card-title"><?php the_title(); ?><br>Monday</h5>
         <p class="card-text">
        <?php the_field('re_start_time')?> - <?php the_field('re_end_time')?> <br>  
        <?php $location = get_field('re_location');
        if( $location ) {
                $address_first = '';
                foreach( array('street_number', 'street_name') as $i => $k ) {
                if( isset( $location[ $k ] ) ) {
                $address_first .= sprintf( '<span class="segment-%s">%s</span> ', $k, $location[ $k ] );
                }
            }
                $address_first = trim( $address_first, '' );
                $address_second = '';
                foreach( array('town', 'post_code') as $i => $k ) {
                if( isset( $location[ $k ] ) ) {
                $address_second .= sprintf( '<span class="segment-%s">%s</span>' , $k, $location[ $k ] );
                }   
            }
            $address_second = trim( $address_second, '' );
      
    // Display HTML.
    echo   $address_first . '<br>' . $address_second . '<br>';}
     if (get_field('re_venue'))  {
        echo 'Type: ' . get_field('re_venue') . '<br>';
        }
    echo '<a class="btn btn-primary" href="' .  get_permalink() .'">more info</a>';
    echo '<a class="btn btn-danger" onclick="return ConfirmDelete(this.href)"
    href="'.get_delete_post_link($post->ID).'"><img src="/wp-content/uploads/2021/09/delete-24.png"></a>';?> 
    </p></div>
    </div>

    
    
    
    
    <?php elseif ($tag->name === 'Tuesday') : ?>
      	 <div class="card" style="width: 16rem;">  
	      <div class="card-body">
            <h5 class="card-title"><?php the_title(); ?><br>Tuesday</h5>
         <p class="card-text">
        <?php the_field('re_start_time')?> - <?php the_field('re_end_time')?> <br>  
        <?php $location = get_field('re_location');
        if( $location ) {
                $address_first = '';
                foreach( array('street_number', 'street_name') as $i => $k ) {
                if( isset( $location[ $k ] ) ) {
                $address_first .= sprintf( '<span class="segment-%s">%s</span> ', $k, $location[ $k ] );
                }
            }
                $address_first = trim( $address_first, '' );
                $address_second = '';
                foreach( array('town', 'post_code') as $i => $k ) {
                if( isset( $location[ $k ] ) ) {
                $address_second .= sprintf( '<span class="segment-%s">%s</span>' , $k, $location[ $k ] );
                }   
            }
            $address_second = trim( $address_second, '' );
      
    // Display HTML.
    echo   $address_first . '<br>' . $address_second . '<br>';}
     if (get_field('re_venue'))  {
        echo 'Type: ' . get_field('re_venue') . '<br>';
        }
    echo '<a class="btn btn-primary" href="' .  get_permalink() .'">more info</a>';
    echo '<a class="btn btn-danger" onclick="return ConfirmDelete(this.href)"
    href="'.get_delete_post_link($post->ID).'"><img src="/wp-content/uploads/2021/09/delete-24.png"></a>';?> 
    </p></div>
    </div>
    <?php elseif ($tag->name === 'Wednesday') : ?>
      	 <div class="card" style="width: 16rem;">  
	      <div class="card-body">
            <h5 class="card-title"><?php the_title(); ?><br>Wednesday</h5>
         <p class="card-text">
        <?php the_field('re_start_time')?> - <?php the_field('re_end_time')?> <br>  
        <?php $location = get_field('re_location');
        if( $location ) {
                $address_first = '';
                foreach( array('street_number', 'street_name') as $i => $k ) {
                if( isset( $location[ $k ] ) ) {
                $address_first .= sprintf( '<span class="segment-%s">%s</span> ', $k, $location[ $k ] );
                }
            }
                $address_first = trim( $address_first, '' );
                $address_second = '';
                foreach( array('town', 'post_code') as $i => $k ) {
                if( isset( $location[ $k ] ) ) {
                $address_second .= sprintf( '<span class="segment-%s">%s</span>' , $k, $location[ $k ] );
                }   
            }
            $address_second = trim( $address_second, '' );
      
    // Display HTML.
    echo   $address_first . '<br>' . $address_second . '<br>';}
     if (get_field('re_venue'))  {
        echo 'Type: ' . get_field('re_venue') . '<br>';
        }
    echo '<a class="btn btn-primary" href="' .  get_permalink() .'">more info</a>';
    echo '<a class="btn btn-danger" onclick="return ConfirmDelete(this.href)"
    href="'.get_delete_post_link($post->ID).'"><img src="/wp-content/uploads/2021/09/delete-24.png"></a>';?> 
    </p></div>
    </div>
    <?php elseif ($tag->name === 'Thursday') : ?>
      	 <div class="card" style="width: 16rem;">  
	      <div class="card-body">
            <h5 class="card-title"><?php the_title(); ?><br>Thursday</h5>
         <p class="card-text">
        <?php the_field('re_start_time')?> - <?php the_field('re_end_time')?> <br>  
        <?php $location = get_field('re_location');
        if( $location ) {
                $address_first = '';
                foreach( array('street_number', 'street_name') as $i => $k ) {
                if( isset( $location[ $k ] ) ) {
                $address_first .= sprintf( '<span class="segment-%s">%s</span> ', $k, $location[ $k ] );
                }
            }
                $address_first = trim( $address_first, '' );
                $address_second = '';
                foreach( array('town', 'post_code') as $i => $k ) {
                if( isset( $location[ $k ] ) ) {
                $address_second .= sprintf( '<span class="segment-%s">%s</span>' , $k, $location[ $k ] );
                }   
            }
            $address_second = trim( $address_second, '' );
      
    // Display HTML.
    echo   $address_first . '<br>' . $address_second . '<br>';}
     if (get_field('re_venue'))  {
        echo 'Type: ' . get_field('re_venue') . '<br>';
        }
    echo '<a class="btn btn-primary" href="' .  get_permalink() .'">more info</a>';
    echo '<a class="btn btn-danger" onclick="return ConfirmDelete(this.href)"
    href="'.get_delete_post_link($post->ID).'"><img src="/wp-content/uploads/2021/09/delete-24.png"></a>';?> 
    </p></div>
    </div>
    <?php elseif ($tag->name === 'Friday') : ?>
     	 <div class="card" style="width: 16rem;">  
	      <div class="card-body">
            <h5 class="card-title"><?php the_title(); ?><br>Friday</h5>
         <p class="card-text">
        <?php the_field('re_start_time')?> - <?php the_field('re_end_time')?> <br>  
        <?php $location = get_field('re_location');
        if( $location ) {
                $address_first = '';
                foreach( array('street_number', 'street_name') as $i => $k ) {
                if( isset( $location[ $k ] ) ) {
                $address_first .= sprintf( '<span class="segment-%s">%s</span> ', $k, $location[ $k ] );
                }
            }
                $address_first = trim( $address_first, '' );
                $address_second = '';
                foreach( array('town', 'post_code') as $i => $k ) {
                if( isset( $location[ $k ] ) ) {
                $address_second .= sprintf( '<span class="segment-%s">%s</span>' , $k, $location[ $k ] );
                }   
            }
            $address_second = trim( $address_second, '' );
      
    // Display HTML.
    echo   $address_first . '<br>' . $address_second . '<br>';}
     if (get_field('re_venue'))  {
        echo 'Type: ' . get_field('re_venue') . '<br>';
        }
    echo '<a class="btn btn-primary" href="' .  get_permalink() .'">more info</a>';
    echo '<a class="btn btn-danger" onclick="return ConfirmDelete(this.href)"
    href="'.get_delete_post_link($post->ID).'"><img src="/wp-content/uploads/2021/09/delete-24.png"></a>';?> 
    </p></div>
    </div>
    <?php elseif ($tag->name === 'Saturday') : ?>
        	 <div class="card" style="width: 16rem;">  
	      <div class="card-body">
            <h5 class="card-title"><?php the_title(); ?><br>Saturday</h5>
         <p class="card-text">
        <?php the_field('re_start_time')?> - <?php the_field('re_end_time')?> <br>  
        <?php $location = get_field('re_location');
        if( $location ) {
                $address_first = '';
                foreach( array('street_number', 'street_name') as $i => $k ) {
                if( isset( $location[ $k ] ) ) {
                $address_first .= sprintf( '<span class="segment-%s">%s</span> ', $k, $location[ $k ] );
                }
            }
                $address_first = trim( $address_first, '' );
                $address_second = '';
                foreach( array('town', 'post_code') as $i => $k ) {
                if( isset( $location[ $k ] ) ) {
                $address_second .= sprintf( '<span class="segment-%s">%s</span>' , $k, $location[ $k ] );
                }   
            }
            $address_second = trim( $address_second, '' );
      
    // Display HTML.
    echo   $address_first . '<br>' . $address_second . '<br>';}
     if (get_field('re_venue'))  {
        echo 'Type: ' . get_field('re_venue') . '<br>';
        }
    echo '<a class="btn btn-primary" href="' .  get_permalink() .'">more info</a>';
    echo '<a class="btn btn-danger" onclick="return ConfirmDelete(this.href)"
    href="'.get_delete_post_link($post->ID).'"><img src="/wp-content/uploads/2021/09/delete-24.png"></a>';?> 
    </p></div>
    </div>
    <?php elseif($tag->name === 'Sunday') : ?>
       	 <div class="card" style="width: 16rem;">  
	      <div class="card-body">
            <h5 class="card-title"><?php the_title(); ?><br>Sunday</h5>
         <p class="card-text">
        <?php the_field('re_start_time')?> - <?php the_field('re_end_time')?> <br>  
        <?php $location = get_field('re_location');
        if( $location ) {
                $address_first = '';
                foreach( array('street_number', 'street_name') as $i => $k ) {
                if( isset( $location[ $k ] ) ) {
                $address_first .= sprintf( '<span class="segment-%s">%s</span> ', $k, $location[ $k ] );
                }
            }
                $address_first = trim( $address_first, '' );
                $address_second = '';
                foreach( array('town', 'post_code') as $i => $k ) {
                if( isset( $location[ $k ] ) ) {
                $address_second .= sprintf( '<span class="segment-%s">%s</span>' , $k, $location[ $k ] );
                }   
            }
            $address_second = trim( $address_second, '' );
      
    // Display HTML.
    echo   $address_first . '<br>' . $address_second . '<br>';}
     if (get_field('re_venue'))  {
        echo 'Type: ' . get_field('re_venue') . '<br>';
        }
    echo '<a class="btn btn-primary" href="' .  get_permalink() .'">more info</a>';
    echo '<a class="btn btn-danger" onclick="return ConfirmDelete(this.href)"
    href="'.get_delete_post_link($post->ID).'"><img src="/wp-content/uploads/2021/09/delete-24.png"></a>';?> 
    </p></div>
    </div>

         
 <?php   endif; 
endforeach;
            }
        echo '</div>';
			
     else:
       
 endif;
    /* Restore original Post Data */
    wp_reset_postdata();
 