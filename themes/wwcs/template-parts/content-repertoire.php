<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */
defined( 'ABSPATH' ) || exit;

global $product;
$product_id = $product->ID;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
?>
    <div style="margin-bottom: 10px;padding-left:5%!important;" <?php wc_product_class( 'col-md-3 text-center', $product ); ?>>

        <div class="inner-prod w-100" style="background-color: rgba(26,26,26,0.8);padding-bottom:35px;">
            <div class="w-100" style="min-height: 50px;padding-left: 15px;">
                <?php do_action('woocommerce_before_shop_loop_item','wws_get_product_terms'); ?>

            </div>

            <?php
            /**
             * Hook: woocommerce_before_shop_loop_item_title.
             *
             * @hooked woocommerce_show_product_loop_sale_flash - 10
             * @hooked woocommerce_template_loop_product_thumbnail - 10
             */
            remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail');
            do_action( 'woocommerce_before_shop_loop_item_title' );


            /**
             * Hook: woocommerce_shop_loop_item_title.
             *
             * @hooked woocommerce_template_loop_product_title - 10
             */
            do_action( 'woocommerce_shop_loop_item_title' );


            /**
             * Hook: woocommerce_after_shop_loop_item_title.
             *
             * @hooked wws_get_fields_product -10
             * @hooked woocommerce_template_loop_price
             *
             */
            remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
            do_action('woocommerce_after_shop_loop_item_title','wws_get_fields_product'); ?>
            <?php
            /**
             * Hook: woocommerce_after_shop_loop_item.
             *
             * @hooked woocommerce_template_loop_product_link_close - 5
             * @hooked woocommerce_template_loop_add_to_cart - 10
             */
            remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
            do_action('woocommerce_after_shop_loop_item', 'wws_assign_product_button');


            ?>
        </div>
    </div>
