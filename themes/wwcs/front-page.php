<?php get_header();
global $post;
?><div class="container-fluid" style="padding-right: 0!important;padding-left: 0!important;">
<!--          <div class="row vid">
                 
    
            <div class="col-12 text-center ">-->
                <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/638151298?h=be67a19e2a&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Panache Dance Fitness Promo 2021"></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>
       
        </div>
        <div class="container-fluid">
     
     
                <div class="row dccfront">
                  
        <div class="col-md-8 offset-md-2 col-sm-12 text-center">
           
            <h1 class="font1"><br>WELCOME TO THE WORLD OF PANACHE DANCE FITNESS<br></h1>
            <h2 class="font1">WHAT IS PANACHE DANCE FITNESS?</h2><br>
            <p>This brand-new concept is a showbiz style full body workout,
                featuring iconic soundtracks from both Stage & Screen. Regardless of your dance ability this
                rehearsal will have you toe tapping and moving your body increasing your fitness levels. Having
                fun and exercising at the same time is the way forward and should never feel like a CHORE ! !
            </p><br>
            <p>The rehearsal is delivered by a highly trained Dance Captain who will showcase and teach you lots
                of fabulous different dance styles,
                you WILL become A cast member of this phenomenal brand. </p><br>
            <p>Lift your spirits high and step into the spotlight.</p>
        </div>
 
    </div>

   
          <div class="row starimg justify-content-center">
        <?php $the_query=new WP_Query(array('post_type'=> 'reviews',  'author'=> 6));
                    while ($the_query -> have_posts()) : $the_query ->the_post();?>

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
				<br>
				Cast Member - <span class="dcname"><?php the_field('rev_name');?></span> says:</h4>
			<p class="collapse" id="collapseReview" aria-expanded="false">  "<i><?php the_field('re_review');?>"</i></p>
			<a role="button" class="collapsed" data-toggle="collapse" href="#collapseReview" aria-expanded="false"
				aria-controls="collapseReview"></a>
		</div>
	</div>
</div>
</div>
          <?php
                 endwhile;?>
                     
                
    </div>
  
</div>
<?php get_footer();