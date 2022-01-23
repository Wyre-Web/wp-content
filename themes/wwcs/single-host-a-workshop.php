
<?php get_header(); ?>
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-lg-8 col-md-12 col-sm-12">
		    <div class="jumbotron">
	    	<?php while ( have_posts() ) : the_post(); ?>
			<br>	<h1>New Host a Workshop Enquiry</h1><br>
				
				    <?php the_content(); ?>
	<div class="row">
		 	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">   <p class="valuedata">Full Name: </p>	</div> 	<div class="col-lg-8 col-md-6 col-sm-6 col-xs-6"> <p class="valued"><?php the_field('full_name'); ?></p>		</div> 		 		   
		   	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">  <p class="valuedata">Location: </p>		</div> 	 	<div class="col-lg-8 col-md-6 col-sm-6 col-xs-6"> <p class="valued"><?php the_field('where_are_you_based'); ?></p>	</div> 	
		     	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">  <p class="valuedata">How many participants:   </p>	</div> 		<div class="col-lg-8 col-md-6 col-sm-6 col-xs-6"> 	 <p class="valued"><?php the_field('how_many_participants_would_you_expect'); ?></p>	</div> 	
		    	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6"> <p class="valuedata">Preference:   </p>	</div> 		 	<div class="col-lg-8 col-md-6 col-sm-6 col-xs-6"> <p class="valued"><?php the_field('would_you_prefer_the_workshop_day_to_be'); ?></p>		</div> 		 		   
		    	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">  <p class="valuedata">Tel:</p>	</div> 		<div class="col-lg-8 col-md-6 col-sm-6 col-xs-6"> 	 <p class="valued"> <?php the_field('contact_tel'); ?></p>	</div> 	
		</div>
    </div>
    <?php endwhile; ?>

		<!-- #content -->
	</div><!-- #primary -->
</div></div>
<?php get_footer(); ?>