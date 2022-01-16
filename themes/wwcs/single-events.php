<?php 
/* Template Name: Events Page */
get_header();
$clock = get_field('ev_date_and_time');

?>

<div class="container pesingle">
    <div class="row">
    	<div class="col-12">
 
                <h4><?php the_title(); ?></h4>
                <h4 id="datetime"></h4>
                
<script type="text/javascript">

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
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("datetime").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
</script>          
    
                
          
           </div>  
         </div> </div>    </div>
         
    <?php     get_footer();