<?php get_header(); ?>
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-8">
		    <div class="jumbotron">
	    	<?php while ( have_posts() ) : the_post(); ?>
			<br>	<h1>New DC Enquiry</h1><br>
				
				    <?php the_content(); ?>
	<div class="row">
		 	<div class="col-4">   <p class="valuedata">Full Name: </p>	</div> 	<div class="col-10"> <p class="valued"><?php the_field('dce_full_name'); ?></p>		</div> 		 		   
		   	<div class="col-4">  <p class="valuedata">Address Line 1:  </p>		</div> 	 	<div class="col-10"> <p class="valued"><?php the_field('dce_address_line_1'); ?></p>	</div> 	
		     	<div class="col-4">  <p class="valuedata">Town:  </p>	</div> 		<div class="col-10"> 	 <p class="valued"><?php the_field('dce_town'); ?></p>	</div> 	
		    	<div class="col-4"> <p class="valuedata">Has Qualifications:  </p>	</div> 		 	<div class="col-10"> <p class="valued"><?php the_field('dce_do_you_have_any_dance_or_relevant_qualifications'); ?></p>		</div> 		 		   
		    	<div class="col-4"> <p class="valuedata">Qualifications:  </p>	</div> 		<div class="col-10"> 	 <p class="valued"><?php the_field('dce_please_list'); ?></p>	</div> 			 		   
		   	<div class="col-4">  <p class="valuedata">Currently teaching:  </p>	</div> 		 	<div class="col-10"> <p class="valued"><?php the_field('dce_do_you_currently_teach_any_dance_or_fitness_classes'); ?></p>	</div> 	
		    	 		   
		   	<div class="col-4">  <p class="valuedata">Brands: </p>	</div> 		<div class="col-10"> 	 <p class="valued"> <?php the_field('please_provide_more_information_on_the_classes'); ?></p>	</div> 	
		   		<div class="col-4">  <p class="valuedata">Tel:</p>	</div> 		<div class="col-10"> 	 <p class="valued"> <?php the_field('tel'); ?></p>	</div> 	
		</div>
    </div>
    <?php endwhile; ?>

		<!-- #content -->
	</div><!-- #primary -->
</div>
<?php get_footer(); ?>