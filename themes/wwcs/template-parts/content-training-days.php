<?php
/*Template name: Upcoming Events
    
    */

  // if (is_category('Upcoming Events')) :
       
       $clock = get_field('td_date_time');
?>
 <div class="hairdown"></div>
  <div class="divas"></div>
<div id="post-<?php the_ID(); ?>" class="container tdbox text-center">
    
 <div id="datetimeset"><h1 id="datetime"></h1 class="h1td"><br><h2 class="h2td">TILL OUR NEXT TRAINING DAY!</h2></div>
 
                <h4 class="h4td"><?php the_field('td_description');?></h4>
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
                                                echo $address_first . '<br>' . $address_second . '<br>';}
                                                if (get_field('type') == "virtually")  {
                                                    echo '<h5 class="tdh5">This Training Day will be hosted ' . get_field('type') . '</h5><br>';
                                                    }?>
              
    </div>
 <div class="showtime"></div>
  <div class="seeyouthere"></div>

                
        <script>

// Set the date we're counting down to
var countDownDate = new Date("<?php echo $clock; ?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("datetime").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s " ;

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
  const element =   document.getElementById("datetime");
  element.innerHTML = "Next Training Day to be announced soon!";
  }
}, 1000);
</script>
            
        