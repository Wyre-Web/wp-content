 
 <div class="col-md-12 col-xl-12 col-lg-12 float-left">
         

<?php if(((get_field('re_venue') == 'Virtual') || (get_field('re_venue') == 'Both'))) : 
 $post_title = get_the_title();

$days = get_field('re_days');
if (($days) === 'a')  : 
    echo '<p style="font-size: 22px; background-color: #f3f3f3;padding:.4em;"><a href="'. home_url() . '/dance-captain/'. get_the_author_meta( 'user_nicename', wp_get_current_user()->ID ).'/?id='. wp_get_current_user()->ID .'"><span style="color:#f50a99;">' . $post_title . ' </a>'; ?>&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; Every Monday&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
<?php the_field('re_start_time')?> - <?php the_field('re_end_time');?>&nbsp;&nbsp;  &nbsp; &nbsp;&nbsp;<?php if( get_field('impact_type') ): ?>
Level of Intensity:&nbsp; &nbsp;<?php the_field('impact_type');
endif; ?> </p><?php
endif;?> <?php
$days = get_field('re_days');
if (($days) === 'b')  : 
    echo '<p style="font-size: 22px; background-color: #f3f3f3;padding:.4em;"><a href="'. home_url() . '/dance-captain/'. get_the_author_meta( 'user_nicename', wp_get_current_user()->ID ).'/?id='. wp_get_current_user()->ID .'"><span style="color:#f50a99;">' . $post_title . ' </a>'; ?>&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; Every Tuesday&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
<?php the_field('re_start_time')?> - <?php the_field('re_end_time');?>&nbsp;&nbsp;  &nbsp; &nbsp;&nbsp;<?php if( get_field('impact_type') ): ?>
Level of Intensity:&nbsp; &nbsp;<?php the_field('impact_type');
endif; ?> </p><?php
endif;?> <?php
$days = get_field('re_days');
if (($days) === 'c')  : 
    echo '<p style="font-size: 22px; background-color: #f3f3f3;padding:.4em;"><a href="'. home_url() . '/dance-captain/'. get_the_author_meta( 'user_nicename', wp_get_current_user()->ID ).'/?id='. wp_get_current_user()->ID .'"><span style="color:#f50a99;">' . $post_title . ' </a>'; ?>&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; Every Wednesday&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
<?php the_field('re_start_time')?> - <?php the_field('re_end_time');?>&nbsp;&nbsp;  &nbsp; &nbsp;&nbsp;<?php if( get_field('impact_type') ): ?>
Level of Intensity:&nbsp; &nbsp;<?php the_field('impact_type');
endif; ?> </p><?php
endif;?> <?php
$days = get_field('re_days');
if (($days) === 'd')  : 
    echo '<p style="font-size: 22px; background-color: #f3f3f3;padding:.4em;"><a href="'. home_url() . '/dance-captain/'. get_the_author_meta( 'user_nicename', wp_get_current_user()->ID ).'/?id='. wp_get_current_user()->ID .'"><span style="color:#f50a99;">' . $post_title . ' </a>'; ?>&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; Every Thursday&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
<?php the_field('re_start_time')?> - <?php the_field('re_end_time');?>&nbsp;&nbsp;  &nbsp; &nbsp;&nbsp;<?php if( get_field('impact_type') ): ?>
Level of Intensity:&nbsp; &nbsp;<?php the_field('impact_type');
endif; ?> </p><?php
endif;?> <?php
$days = get_field('re_days');
if (($days) === 'e')  : 
    echo '<p style="font-size: 22px; background-color: #f3f3f3;padding:.4em;"><a href="'. home_url() . '/dance-captain/'. get_the_author_meta( 'user_nicename', wp_get_current_user()->ID ).'/?id='. wp_get_current_user()->ID .'"><span style="color:#f50a99;">' . $post_title . ' </a>'; ?>&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; Every Friday&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
<?php the_field('re_start_time')?> - <?php the_field('re_end_time');?>&nbsp;&nbsp;  &nbsp; &nbsp;&nbsp;<?php if( get_field('impact_type') ): ?>
Level of Intensity:&nbsp; &nbsp;<?php the_field('impact_type');
endif; ?> </p><?php
endif;?> <?php
$days = get_field('re_days');
if (($days) === 'f')  : 
    echo '<p style="font-size: 22px; background-color: #f3f3f3;padding:.4em;"><a href="'. home_url() . '/dance-captain/'. get_the_author_meta( 'user_nicename', wp_get_current_user()->ID ).'/?id='. wp_get_current_user()->ID .'"><span style="color:#f50a99;">' . $post_title . ' </a>'; ?>&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; Every Saturday&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
<?php the_field('re_start_time')?> - <?php the_field('re_end_time');?>&nbsp;&nbsp;  &nbsp; &nbsp;&nbsp;<?php if( get_field('impact_type') ): ?>
Level of Intensity:&nbsp; &nbsp;<?php the_field('impact_type');
endif; ?> </p><?php
endif;?> <?php
$days = get_field('re_days');
if (($days) === 'g')  : 
    echo '<p style="font-size: 22px; background-color: #f3f3f3;padding:.4em;"><a href="'. home_url() . '/dance-captain/'. get_the_author_meta( 'user_nicename', wp_get_current_user()->ID ).'/?id='. wp_get_current_user()->ID .'"><span style="color:#f50a99;">' . $post_title . ' </a>'; ?>&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; Every Sunday&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
<?php the_field('re_start_time')?> - <?php the_field('re_end_time');?>&nbsp;&nbsp;  &nbsp; &nbsp;&nbsp;<?php if( get_field('impact_type') ): ?>
Level of Intensity:&nbsp; &nbsp;<?php the_field('impact_type');
endif; ?> </p><?php
endif;?> 



<?php
endif;
?>

</div>