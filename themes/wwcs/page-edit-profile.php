<?php

acf_form_head();

?>
<body style="background-color:#2b2b2b!important;">
<?php get_header(); ?>
<div class="container" style="margin-top:15px!important;padding-top: 10px!important;padding-bottom:10px!important;background-color: #fff!important;">
    <a href="<?php echo home_url() . '/dance-captain/' . get_the_author_meta( 'user_nicename', wp_get_current_user()->ID.'/?id='. wp_get_current_user()->ID ); ?>" >Back to Profile</a>

    <h1 style="background-color: rgba(253,206,255,0.5) !important;padding:7px;font-size: 22px!important;font-weight: 700;">Edit your profile <?php echo wp_get_current_user()->display_name ?></h1>
    <?php
    acf_form('edit-profile');
    ?>
</div>
<?php
get_footer();
?>
</body>
