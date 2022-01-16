
<?php
/*
 * Template Name: Rehearsal
 * Template Post Type: post, rehearsals
 */
 get_header();
?>
<style type="text/css">
    .acf-map {
        width: 100%;
        height: 400px;
        border: #ccc solid 1px;
        margin: 20px 0;
    }

    .delete-btn {
        background-color: #10b7fe;
        color: white;
        padding: 1em;
        font-size: 1em;
        font-weight: bold;
    }

    .acf-map img {
        max-width: inherit !important;
    }

    #pe-post {
        width: 50% !important;
    }

    .pesingle {
        padding-top: 2em;
        padding-bottom: 2em;
    }
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRVC9kCSkVuwRSC8bX-9_17qxFtK9YZZA"></script>
<script type="text/javascript">
    (function ($) {

        /**
         * initMap
         *
         * Renders a Google Map onto the selected jQuery element
         *
         * @date    22/10/19
         * @since   5.8.6
         *
         * @param   jQuery $el The jQuery element.
         * @return  object The map instance.
         */
        function initMap($el) {

            // Find marker elements within map.
            var $markers = $el.find('.marker');

            // Create gerenic map.
            var mapArgs = {
                zoom: $el.data('zoom') || 16,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map($el[0], mapArgs);

            // Add markers.
            map.markers = [];
            $markers.each(function () {
                initMarker($(this), map);
            });

            // Center map based on markers.
            centerMap(map);

            // Return map instance.
            return map;
        }

        /**
         * initMarker
         *
         * Creates a marker for the given jQuery element and map.
         *
         * @date    22/10/19
         * @since   5.8.6
         *
         * @param   jQuery $el The jQuery element.
         * @param   object The map instance.
         * @return  object The marker instance.
         */
        function initMarker($marker, map) {

            // Get position from marker.
            var lat = $marker.data('lat');
            var lng = $marker.data('lng');
            var latLng = {
                lat: parseFloat(lat),
                lng: parseFloat(lng)
            };

            // Create marker instance.
            var marker = new google.maps.Marker({
                position: latLng,
                map: map
            });

            // Append to reference for later use.
            map.markers.push(marker);

            // If marker contains HTML, add it to an infoWindow.
            if ($marker.html()) {

                // Create info window.
                var infowindow = new google.maps.InfoWindow({
                    content: $marker.html()
                });

                // Show info window when marker is clicked.
                google.maps.event.addListener(marker, 'click', function () {
                    infowindow.open(map, marker);
                });
            }
        }

        /**
         * centerMap
         *
         * Centers the map showing all markers in view.
         *
         * @date    22/10/19
         * @since   5.8.6
         *
         * @param   object The map instance.
         * @return  void
         */
        function centerMap(map) {

            // Create map boundaries from all map markers.
            var bounds = new google.maps.LatLngBounds();
            map.markers.forEach(function (marker) {
                bounds.extend({
                    lat: marker.position.lat(),
                    lng: marker.position.lng()
                });
            });

            // Case: Single marker.
            if (map.markers.length == 1) {
                map.setCenter(bounds.getCenter());

                // Case: Multiple markers.
            } else {
                map.fitBounds(bounds);
            }
        }

        // Render maps on page load.
        $(document).ready(function () {
            $('.acf-map').each(function () {
                var map = initMap($(this));
            });
        });

    })(jQuery);
</script>


<div class="container jumbotron pesingle">
	<div class="row">
 <div class="col-xl-7 col-lg-7 col-md-12 col-xs-12">
    
   <br>
    <h1><?php the_title();?></h1>
  <dl>

 
<br>
<dt>Day:</dt>
	  <dd>
	      <?php if (get_field('re_days') === "a"){?>
	  Monday
	 <?php	}?> 
<?php if (get_field('re_days') === "b"){?>
	  Tuesday
	 <?php	}?> 
<?php if (get_field('re_days') === "c"){?>
	Wednesday
	 <?php	}?> 
<?php if (get_field('re_days') === "d"){?>
Thursday
	 <?php	}?> 

<?php if (get_field('re_days') === "e"){?>
	 Friday
	 <?php	}?> 
	 <?php if (get_field('re_days') === "f"){?>
	  Saturday
	 <?php	}?> 
	 <?php if (get_field('re_days') === "g"){?>
Sunday
	 <?php	}?> 

</dd>
	
<dt>	 <span>&#128340;</span> Time:</dt>

<dd>
<?php the_field('re_start_time')?> - <?php the_field('re_end_time')?>	
	  </dd>
          
 <?php if( get_field('impact_type') ): ?>
<dt>Level of Intensity: </dt><dd><?php the_field('impact_type');
endif; ?> </dd>

  <?php if( get_field('re_additional_parking_information') ): ?>
<dt> <span>&#127359;</span>Parking Information:</dt> <dd><?php the_field('re_additional_parking_information');	 
		 endif; ?>  </dd>


<?php if( get_field('price') ): ?>
		<dt>Rehearsal Price:</dt><dd>£<?php the_field('price'); 
		 endif; ?> </dd>
		 <?php if( get_field('re_code') ):?>
<dt>Promotion Code:</dt><dd><?php the_field('re_code'); endif;?> </dd>
<?php if( get_field('promotion_additional_information') ):?>
	  <dt>Promotion Additional Information: </dt><dd><?php the_field('promotion_additional_information'); endif;?> </dd>

<?php if( get_field('offer_price') ):?>
	<dt>Offer Price:</dt><dd>£<?php the_field('offer_price'); endif;?>   </dd>
	<?php if( get_field('regular_price') ):?>
		<dt>Regular Price:</dt><dd>£<?php the_field('regular_price');  endif;?> </dd>
		<?php if( get_field('offer_information') ):?>
			<dt>Offer Information:</dt><dd><?php the_field('offer_information');?>  </dd>

		 
		 <?php endif; ?> 
 
		 
		 <?php 
		 	 if( get_field('is_booking_esssential') ):
		 	 ?><dd><?php the_field('is_booking_esssential'); 	 endif; ?>  </dd>
		</dl>
</div>
 <div class="col-xl-5 col-lg-5 col-md-12 col-xs-12">
     
			<?php 
$location = get_field('re_location');
if( $location ): ?>
<br><br><h4>Location Info</h4><br>
    <div class="acf-map" data-zoom="16">
        <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
    </div>
<?php endif;?>
	 
	
		</div>
       
</div>
</div>
<?php 
get_footer();