<?php

acf_form_head();

?>
<body style="background-color:#2b2b2b!important;">
<?php get_header(); ?>
<div class="container" style="margin-top:15px!important;padding-top: 10px!important;padding-bottom:10px!important;background-color: #fff!important;">
    <h1 style="display:inline-block!important;background-color: rgb(255,251,191) !important;padding:7px;font-size: 22px!important;font-weight: 700;">Add Choreography Notes</h1>
    <?php
            acf_form('add_notes');
    ?>
</div>
<?php
get_footer();
?>
</body>