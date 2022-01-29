<?php
/*
 * Template Name: Author
 **/

global $wp_query;
get_header();     
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
$author_id = $_GET["id"];
$author_id = intval($author_id);
$author_data = get_userdata($author_id);
$author_nicename = get_user_meta($author_id, 'user_nicename' );
$author_name = $author_data->display_name;
//var_dump($author_nicename);
//var_dump($author_data);

$id = get_the_ID();

/*$this_user_id = $_GET['id'];
$this_user_id = intval($this_user_id);*/
$profile_query = new $wp_query(
    array(
        'post_type' => "profiles",
        'author' => $author_id,

    ));


global $post;

$profile_data = wp_list_pluck($profile_query, 'ID');

$post_author = intval($profile_data["post_author"]);
$profile_id = $profile_data["post"];



if ($author_id == get_current_user_id()) {
    if($profile_id) {?>
    <div class="container admincont text-center">
        <div class="btn-group">
            <button type="button" class="btn btn-lg"><a href="<?php echo WP_HOME ?>edit-profile/?id=<?php echo $profile_id ?>" role="button">Edit Profile</a></button>
            <button type="button" class="btn btn-lg"> <a href="<?php echo WP_HOME ?>add-rehearsal" role="button">Add Rehearsal</a></button>
            <button type="button" class="btn btn-lg"> <a href="<?php echo WP_HOME ?>add-review" role="button">Add Review</a></button>
        </div>
    </div>

<?php
    }
}

if($profile_id == null) {

    echo '<div class="container" style="margin-top: 50px!important;background-color: #fff;padding: 50px!important;">';
    if($author_id == get_current_user_id()){
        echo '<p style="color:#000000!important;font-family: PT Sans,sans-serif;font-weight:700;">'.$author_name.', please add your profile information <a style="color:deeppink!important;" href="'.WP_HOME.'add-profile">here ...</a></p>';
    }
echo '<h2 style="color:#000000!important;font-size:22px;font-weight: 700;">Sorry,&nbsp;'. $author_name .'&nbsp;hasn\'t added any profile information &nbsp<i style="font-size:26px;" class="far fa-frown"></i></h2></div>';
}
         if(have_posts()) :
?>
             <div class="container-fluid">
         <div class="row">
      <?php       while($profile_query -> have_posts()) :
               $profile_query ->the_post();?>
                <div class="col-xl-10 col-lg-10 col-sm-12 col-md-12 offset-lg-1 offset-xl-1">
            <div class="jumb jumbotron  starbg">
                <div class="innerjumbo">
                               <div class="row justify-content-md-center">       
                                   <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                    <?php   $image = get_field('dc_profile_picture');
if( !empty( $image ) ): ?>
    <img class="rounded" src="<?php echo esc_url($image['url'],'profile-size'); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
<?php endif; ?>          
                      
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5">
                            <div id="profcollapse">
                                <h2>Hi <br> I'm <?php echo get_the_author_meta('nickname'); ?></h2>

                                <p class="collapse" id="collapseProfile" aria-expanded="false">
                              <?php  if (get_field('dc_bio'))  {
                                                echo the_field('dc_bio');
                                                }  ?>
                                                </p>
                                <a role="button" class="collapsed" data-toggle="collapse" href="#collapseProfile"
                                    aria-expanded="false" aria-controls="collapseProfile"></a>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 text-center card cardp">
                            <div> 
                                <h2 class="text-center">Let's get Social!</h2>


                                <a href="tel: <?php echo get_the_author_meta('phone'); ?>"><img
                                        src="/wp-content/uploads/2021/09/mobile-phone-8-64.png"></a>

                                <a href="mailto:<?php echo get_the_author_meta('user_email') ?>"><img
                                        src="/wp-content/uploads/2021/09/email-14-64.png"></a>

<?php if (get_field('dc_facebook'));{ ?>
                                <a href="<?php echo the_field('dc_facebook');?>"><img
                                        src="/wp-content/uploads/2021/09/facebook-4-64.png"></a>
                      <?php }  ?>          
                                <?php if (get_field('dc_instagram'));{ ?>
                                <a href="<?php echo the_field('dc_instagram'); ?>"><img
                                        src="/wp-content/uploads/2021/09/instagram-4-64.png"></a>
 <?php }  ?>
                            </div>
                         <?php if (get_field('dc_booking_link')); { ?>
                            <div class="booking">
                                <p>To book my Rehearsals, click the button and you will be redirected to my online
                                    bookings.</p> <a class="btn btn-info" href="<?php  the_field('dc_booking_link');?>">Book Rehearsal</a>
                            </div>
                            <?php } ?>
                        </div>
               
                   
                          </div>
                 </div>
            </div>
          
        </div>
    </div></div>
       <?php endwhile;?>
                        
                       <?php endif;?>  

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-10 col-lg-10 col-sm-12 col-md-12 offset-lg-1 offset-xl-1">
            <div class="jumb jumbotron ">
                <div class="innerjumbo">
                    <h2 class="text-center">Rehearsals</h2>
                    <div class="row">
                        <?php
                             $rehearsals_query = new WP_Query(
                                array(
                                'post_type' => 'rehearsals',
                                'author' => $author_id,
                                'meta_key' => 're_days',
                                'orderby' => 'meta_value',
                                'order' => 'ASC',
                                'meta_query' => array(
                                    array(
                                        'key' => 're_days',
                                        'value'=>1,
                                       'compare'=> '!='))));
                             if(! $rehearsals_query->have_posts()) {
                                 echo '<h2 style="font-size:22px;font-weight: 700;">Sorry there are no rehearsals scheduled by this Dance Captain &nbsp;<i style="font-size:26px;" class="far fa-frown"></i></h2>';
                             }
                                   if($rehearsals_query->have_posts()) :
                                   
                                        while($rehearsals_query -> have_posts()) :
                                            $rehearsals_query->the_post();
                                         $days = get_field('re_days');
                                         	if (($days) === 'a')  : ?>
<div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
         <div class="card">
           <div class="card-body">
             <h5 class="card-title">Monday</h5>
             <p class="card-text"><?php the_title(); ?><br>
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
                                            echo $address_first . '<br>' . $address_second . '<hr>';}
                                            if (get_field('re_venue') == "Virtual")  {
                                                echo get_field('re_venue') . '<br>';
                                                }?>
                                                
 Impact Level:   <?php the_field('impact_type');?><br>
  <div class="cardicons">   <?php  echo '<a class="info" href="' .  get_permalink() .'">more <i class="fa-solid fa-circle-info"> </i></a>';
                                             ?>
   <?php   if (get_field('re_location'))  {
                                                echo '<i class="fa-solid fa-map-location"> </i>';
                                                }
                                                    if (get_field('re_parking'))  {
                                                echo ' <i class="fa-solid fa-square-parking"> </i>';
                                                }  ?>

                                                                </div>
             </p>
           </div>
         </div>    
           <div class="delcont text-center">
                                        <?php if ($post->post_author == strval($current_user->ID)) {
                                                    echo '<a style="width:49%;background-color:rgb(246,235,255) ;" class="btn float-left text-center" role="button" onclick="return ConfirmDelete(this.href)"
                                            href="'.get_delete_post_link($post->ID).'" title="Delete this rehearsal?"><i class="fa-solid fa-trash-can" style="color: red;"></i></a>
                                            <a style="width:49%;border-radius: 0!important;border:0!important;" class="btn btn-info float-left text-center" href="/edit-rehearsal/?id='. $post->ID .'" title="Edit this rehearsal?"><i style="color:#fff" class="fas fa-edit"></i></a>';}?>
                                    </div>
                                      </div>
         <?php elseif  (($days) === 'b')  : ?>
         <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3"> 
         <div class="card">
           <div class="card-body">
             <h5 class="card-title">Tuesday</h5>
              <p class="card-text"><?php the_title(); ?><br>
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
                                            echo $address_first . '<br>' . $address_second . '<hr>';}
                                            if (get_field('re_venue') == "Virtual")  {
                                                echo get_field('re_venue') . '<br>';
                                                }?>
                                                
 Impact Level:   <?php the_field('impact_type');?><br>
  <div class="cardicons">   <?php  echo '<a class="info" href="' .  get_permalink() .'">more <i class="fa-solid fa-circle-info"> </i></a>';
                                             ?>
   <?php   if (get_field('re_location'))  {
                                                echo '<i class="fa-solid fa-map-location"> </i>';
                                                }
                                                    if (get_field('re_parking'))  {
                                                echo ' <i class="fa-solid fa-square-parking"> </i>';
                                                }  ?>

                                  
                                   
                                    </div>
             </p>
           </div>
         </div>    
           <div class="delcont text-center">
                                        <?php if ($post->post_author == $current_user->ID) {
                                            echo '<a style="width:49%;background-color:rgb(246,235,255) ;" class="btn float-left text-center" role="button" onclick="return ConfirmDelete(this.href)"
                                            href="' .get_delete_post_link($post->ID).'" title="Delete this rehearsal?"><i class="fa-solid fa-trash-can" style="color: red;"></i></a>
                                            <a style="width:49%;border-radius: 0!important;border:0!important;" class="btn btn-info float-left text-center" href="/edit-rehearsal/?id='. $post->ID .'" title="Edit this rehearsal?"><i style="color:#fff" class="fas fa-edit"></i></a>';
                                        }?>
                                    </div>
                                      </div>
         <?php elseif  (($days) === 'c') : ?>
         <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
         <div class="card">
           <div class="card-body">
             <h5 class="card-title">Wednesday</h5>
              <p class="card-text"><?php the_title(); ?><br>
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
                                            echo $address_first . '<br>' . $address_second . '<br>' ;}
                                            if (get_field('re_venue') == "Virtual")  {
                                                echo get_field('re_venue') . '<br>';
                                                }?>
 Impact Level:   <?php the_field('impact_type');?><hr>
  <div class="cardicons">   <?php  echo '<a class="info" href="' .  get_permalink() .'">more <i class="fa-solid fa-circle-info"> </i></a>';
                                             ?>
   <?php   if (get_field('re_location'))  {
                                                echo '<i class="fa-solid fa-map-location"> </i>';
                                                }
                                                    if (get_field('re_parking'))  {
                                                echo ' <i class="fa-solid fa-square-parking"> </i>';
                                                }  ?>
                                                

                        

                                 
                         </div>          
             </p>
           </div>   
         </div>
         <div class="delcont text-center">
                                        <?php if ($post->post_author == $current_user->ID) {
                                            echo '<a style="width:49%;background-color:rgb(246,235,255) ;" class="btn float-left text-center" role="button" onclick="return ConfirmDelete(this.href)"
                                            href="' .get_delete_post_link($post->ID).'" title="Delete this rehearsal?"><i class="fa-solid fa-trash-can" style="color: red;"></i></a>
                                            <a style="width:49%;border-radius: 0!important;border:0!important;" class="btn btn-info float-left text-center" href="/edit-rehearsal/?id='. $post->ID .'" title="Edit this rehearsal?"><i style="color:#fff" class="fas fa-edit"></i></a>';
                                        }?>
                                    </div>
         
         </div>
         <?php elseif (($days) === 'd')  : ?>
            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
         <div class="card" >
           <div class="card-body">
             <h5 class="card-title">Thursday</h5>
             <p class="card-text"><?php the_title(); ?><br>
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
                                            echo $address_first . '<br>' . $address_second . '<hr>';}
                                            if (get_field('re_venue') == "Virtual")  {
                                                echo get_field('re_venue') . '<br>';
                                                }?>
 Impact Level:   <?php the_field('impact_type');?><br>
<div class="cardicons">    <?php  echo '<a class="info" href="' .  get_permalink() .'">more <i class="fa-solid fa-circle-info"> </i></a>';
                                             ?>
  <?php   if (get_field('re_location'))  {
                                                echo '<i class="fa-solid fa-map-location"> </i>';
                                                }
                                                    if (get_field('re_parking'))  {
                                                echo ' <i class="fa-solid fa-square-parking"> </i>';
                                                }  ?>
                                 
                                 
                               

                                    </div>
             </p>
           </div>    
         </div>
        <div class="delcont text-center">
                                        <?php if ($post->post_author == $current_user->ID) {
                                            echo '<a style="width:49%;background-color:rgb(246,235,255) ;" class="btn float-left text-center" role="button" onclick="return ConfirmDelete(this.href)"
                                            href="' .get_delete_post_link($post->ID).'" title="Delete this rehearsal?"><i class="fa-solid fa-trash-can" style="color: red;"></i></a>
                                            <a style="width:49%;border-radius: 0!important;border:0!important;" class="btn btn-info float-left text-center" href="/edit-rehearsal/?id='. $post->ID .'" title="Edit this rehearsal?"><i style="color:#fff" class="fas fa-edit"></i></a>';
                                        }?>

                                    </div>
         </div>
         <?php elseif (($days) === 'e')  : ?>
            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
         <div class="card" >
           <div class="card-body">
             <h5 class="card-title">Friday</h5>
             <p class="card-text"><?php the_title(); ?><br>
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
                                            echo $address_first . '<br>' . $address_second . '<hr>';}
                                            if (get_field('re_venue') == "Virtual")  {
                                                echo get_field('re_venue') . '<br>';
                                                }?>
 Impact Level:   <?php the_field('impact_type');?><br>
<div class="cardicons">  
                                    <?php  echo '<a class="info" href="' .  get_permalink() .'">more <i class="fa-solid fa-circle-info"> </i></a>';
                                             ?>
   <?php   if (get_field('re_location'))  {
                                                echo '<i class="fa-solid fa-map-location"> </i>';
                                                }
                                                    if (get_field('re_parking'))  {
                                                echo ' <i class="fa-solid fa-square-parking"> </i>';
                                                }  ?>

                               
                            </div>     
             </p>
           </div>   
         </div>
             <div class="delcont text-center">
                                        <?php if ($post->post_author == $current_user->ID) {
                                            echo '<a style="width:49%;background-color:rgb(246,235,255) ;" class="btn float-left text-center" role="button" onclick="return ConfirmDelete(this.href)"
                                            href="' .get_delete_post_link($post->ID).'" title="Delete this rehearsal?"><i class="fa-solid fa-trash-can" style="color: red;"></i></a>
                                            <a style="width:49%;border-radius: 0!important;border:0!important;" class="btn btn-info float-left text-center" href="/edit-rehearsal/?id='. $post->ID .'" title="Edit this rehearsal?"><i style="color:#fff" class="fas fa-edit"></i></a>';
                                        }?>
                                    </div>
         </div>
         <?php elseif  (($days) === 'f')  : ?>
            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
         <div class="card">
           <div class="card-body">
             <h5 class="card-title"><?php the_title(); ?>Saturday</h5>
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
                                            echo $address_first . '<br>' . $address_second . '<hr>';}
                                            if (get_field('re_venue') == "Virtual")  {
                                                echo get_field('re_venue') . '<br>';
                                                }?>
 Impact Level:   <?php the_field('impact_type');?>
 <div class="cardicons">  <?php  echo '<a class="info" href="' .  get_permalink() .'">more <i class="fa-solid fa-circle-info"> </i></a>';
                                             ?>   <?php   if (get_field('re_location'))  {
                                                echo '<br><i class="fa-solid fa-map-location"> </i>';
                                                }
                                                    if (get_field('re_parking'))  {
                                                echo ' <i class="fa-solid fa-square-parking"> </i>';
                                                }  ?>

                                   

                                   
                           </div>      
             </p>
           </div>
         </div>   
    <div class="delcont text-center">
                                        <?php if ($post->post_author == $current_user->ID) {
                                            echo '<a style="width:49%;background-color:rgb(246,235,255) ;" class="btn float-left text-center" role="button" onclick="return ConfirmDelete(this.href)"
                                            href="' .get_delete_post_link($post->ID).'" title="Delete this rehearsal?"><i class="fa-solid fa-trash-can" style="color: red;"></i></a>
                                            <a style="width:49%;border-radius: 0!important;border:0!important;" class="btn btn-info float-left text-center" href="/edit-rehearsal/?id='. $post->ID .'" title="Edit this rehearsal?"><i style="color:#fff" class="fas fa-edit"></i></a>';
                                        }?>
                                    </div>
         </div>
         <?php elseif	(($days) === 'g')  : ?>
            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
         <div class="card" >
           <div class="card-body">
             <h5 class="card-title">Sunday</h5>
          
            <p class="card-text"><?php the_title(); ?><br>
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
                                            echo $address_first . '<br>' . $address_second . '<hr>';}
                                            if (get_field('re_venue') == "Virtual")  {
                                                echo get_field('re_venue') . '<br><br>';
                                                }?>
 Impact Level:   <?php the_field('impact_type');?><br>
<div class="cardicons">  
                                    <?php  echo '<a class="info" href="' .  get_permalink() .'">more <i class="fa-solid fa-circle-info"> </i></a>';
                                             ?>  <?php   if (get_field('re_location'))  {
                                                echo '<i class="fa-solid fa-map-location"> </i>';
                                                }
                                                    if (get_field('re_parking'))  {
                                                echo ' <i class="fa-solid fa-square-parking"> </i>';
                                                }  ?>


                                  
             </p>
         
         </div>
         </div>
         <div class="delcont text-center">
                                        <?php if ($post->post_author == $current_user->ID) {
                                            echo '<a style="width:49%;background-color:rgb(246,235,255) ;" class="btn float-left text-center" role="button" onclick="return ConfirmDelete(this.href)"
                                            href="' .get_delete_post_link($post->ID).'" title="Delete this rehearsal?"><i class="fa-solid fa-trash-can" style="color: red;"></i></a>
                                            <a style="width:49%;border-radius: 0!important;border:0!important;" class="btn btn-info float-left text-center" href="/edit-rehearsal/?id='. $post->ID .'" title="Edit this rehearsal?"><i style="color:#fff" class="fas fa-edit"></i></a>';
                                        }?>
                                    </div>
                     </div>               
         </div>

       <?php   endif; 
endwhile;
            endif;
        echo '</div>';
			
   
    /* Restore original Post Data */
    wp_reset_postdata();
?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
        <div class="row">
            <div class="col-xl-10 col-lg-10 col-sm-12 col-md-12 offset-lg-1 offset-xl-1">
                <div class="jumb revjumb jumbotron ">
                    <div class="innerjumbo">
 <h2 class="text-center"> Reviews for the Dance Captain: <span class="dcname"><?php echo get_the_author_meta('display_name', $author_id); ?></span></h2> <hr>
       
       
        <?php

$reviews_query = new WP_Query(
     array(
         'post_type' => "reviews",
      'author' => intval($author_id),
      'posts_per_page' => 3
         ));
         if(! $reviews_query->have_posts()) {

                 echo '<h2 style="font-size:22px;font-weight: 700;">Sorry there are no reviews for this Dance Captain &nbsp;<i style="font-size:26px;" class="far fa-frown"></i></h2>';

         }
         if($reviews_query->have_posts()) :?>
          <div class="row">
      <?php       while($reviews_query -> have_posts()) :
               $reviews_query ->the_post();?>

            
<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
  <div class="cardwrapper">
	<div class="card reviewcard" id="reviewcard">
		<div class="card-top text-center">
			<br>
			<h3 class="card-title revtitle">STAR RATING</h3>
			<?php if(get_field('stars') === '1'):?>
				<span class="starb">&#9733;</span><?php endif;?>
				<?php if(get_field('stars') === '2'):?>
				<span class="starb">&#9733;&#9733;</span><?php endif;?>
				<?php if(get_field('stars') === '3'):?>
				<span class="starb">&#9733;&#9733;&#9733;</span><?php endif;?>
				<?php if(get_field('stars') === '4'):?>
				<span class="starb">&#9733;&#9733;&#9733;&#9733;</span><?php endif;?>
			<?php if(the_field('stars') === '5'):?>
			<span class="starb">&#9733;&#9733;&#9733;&#9733;&#9733;</span><?php endif;?>
		
		</div>
		<div class="card-body">
		
				<h4 class="card-title">
				    
             <?php echo the_field('title'); ?>
                <hr>
		Cast Member - <span class="dcname"><?php the_field('rev_name');?></span> says: </h4>
			<p class="collapse" id="collapseReview" aria-expanded="false"><i>"<?php the_field('re_review');?>"</i></p>
			<a role="button" class="collapsed" data-toggle="collapse" href="#collapseReview" aria-expanded="false"
				aria-controls="collapseReview"></a>
				</div>
	</div>
  <div class="delcont text-center">		<?php if ($post->post_author == $current_user->ID) { 
                                                    echo '<a class="delete btn btn-danger" role="button" onclick="return ConfirmDelete(this.href)"
                                            href="'.get_delete_post_link($post->ID).'">Delete Review &nbsp; <i class="fa-solid fa-trash-can"></i></a>';}?>
</div></div></div>
        <?php
                 endwhile;?>
   </div>

                 
<?php endif;
    /* Restore original Post Data */
    wp_reset_postdata(); 
  
 
 ?>
</div></div></div>
    </div>
    </div>
         <script>
                function ConfirmDelete() {
                    var x = confirm("Are you sure you want to delete?");
                    if (x)
                        return true;
                    else
                        return false;
                }
            </script>
    <?php  get_footer();
    