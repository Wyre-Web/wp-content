<?php

defined( 'ABSPATH' ) || exit;
global $post;
global $product;
global $woocommerce;

$product_id = $product->ID;
$post_id = $post->ID;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
$cust_history = panache_get_customer_purchase_history();

if(in_array($post_id, $cust_history)) {
    ?>
    <div style="margin-bottom: 10px;padding-left:5%!important;" class="col-md-3 text-center">

        <div class="inner-prod w-100" style="background-color: rgba(26,26,26,0.8);">

            <div class="w-100" style="min-height: 50px;">
                <?php
                $artist = get_field('artist');
                echo $post->get_name; //do_action('repertoire_terms','wws_get_product_terms'); ?>


            </div>


        </div>
    </div>
    <?php
} else {
    echo 'nothing found';
}