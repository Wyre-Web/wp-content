<?php

defined( 'ABSPATH' ) || exit;

get_header();

$args = array(
        'post_type' => 'product',
        'posts_per_page' => '-1',
);

$loop = new WP_Query( $args );

?>
    <style>
        span.woocommerce-Price-amount {
            display: none!important;
        }
    </style>
    <header class="container-fluid text-center">

            <h1 class="page-title" style="color:#fff!important;">My Repertoire</h1>
            <hr style="border-top: 1px solid rgba(255,255,255,0.1);" >
    </header>

    <section class="container-fluid repertoire">

    <div class="row">
    <div class="col-md-2 prod-filters" style="padding-left:10px!important">
        <div class="inner-filt" style="padding: 20px 10px 10px;background-color: rgba(26,26,26,0.7) !important;border-image: linear-gradient(to right, #fc1ade 0%, #349af2 100% );!important;">

        </div>
    </div>
    <div class="col-md-10">

    <div class="row" style="margin-left:0!important;margin-right:0!important;">
    <?php
    if( $loop->have_posts() ) {
        while (have_posts()) {
            the_post();

            get_template_part('template-parts/content', 'my-repertoire');

        }
    }
?>
    </div>
    </div>

    </div>
    </section>
<?php

get_footer();