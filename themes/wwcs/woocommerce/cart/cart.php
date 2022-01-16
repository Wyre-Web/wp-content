<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined('ABSPATH') || exit; ?>
  <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
<?php
global $post;
global $product;

//meta = get_post_meta($product_id);



do_action('woocommerce_before_cart_table'); ?>
<!--Section: Block Content-->
<section>
    <div class="container-fluid p-4">
        <a class="btn oneb float-left text-white" href="/shop/"><img src="/wp-content/uploads/2021/09/arrow-83-24.png" alt="back arrow"> &nbsp;&nbsp;&nbsp;Back to Shop</a>
    </div>
<?php
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
    if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
    $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
    ?>
    <!--Grid row-->
    <div class="row woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

        <!--Grid column-->
        <div class="col-lg-8">
            <!--<pre class="text-white">
                <?php /*var_dump($meta); */?>
            </pre>-->
            <!-- Card -->
            <div class="mb-3">
                <div class="pt-4 wish-list">

                    <div class="row mb-4">
                        <div class="col-md-5 col-lg-3 col-xl-3">
                            <div class="mb-3 mb-md-0 text-center">

                                <?php
                                $product_name = $_product->get_name();
                                ?>
                                <img class="w-100" src="/wp-content/uploads/2021/09/panache_logo.png" alt="Panache Dance Fitness Logo">
                                <p style="font-size: 11px;"><strong><?php echo $product_name; ?></strong></p>
                                <p style="font-size: 11px;margin-top:-8px;"><strong>Choreographer: <?php  the_field('choreographer', $product_id); ?></strong></p>


                            </div>
                        </div>
                        <div class="col-md-7 col-lg-9 col-xl-9">
                            <div>


                                <div class="d-flex justify-content-between w-100 pt-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="text-white"><?php echo $product_name; ?> </h5>
                                        </div>
                                        <div class="col-6 pr-4">
                                        <h5 class="text-white text-right">
                                            <?php
                                            echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                            ?></h5>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-2 text-muted text-uppercase small">Panache Dance Fitness Streamed Content</p>
                                        </div>

                                    </div>
                                    <div>


                                    </div>
                                </div>
            <?php
/*                                echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
                                    */?>

                                <div class="d-flex justify-content-between align-items-right">
                                    <div class="product_remove">
                                        <?php
                                        echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                            'woocommerce_cart_item_remove_link',
                                            sprintf(
                                                '<a href="%s" class="btn btn-danger text-white" aria-label="%s" data-product_id="%s" data-product_sku="%s">Remove <img src="/wp-content/uploads/2021/09/delete-24.png"></a>',
                                                esc_url(wc_get_cart_remove_url($cart_item_key)),
                                                esc_html__('Remove this item', 'woocommerce'),
                                                esc_attr($product_id),
                                                esc_attr($_product->get_sku())
                                            ),
                                            $cart_item_key
                                        );
                                        ?>

                                    </div>
                                    <div class="product-price"
                                         data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
                                        <p class="mb-0"><span><strong id="summary">
                              </strong></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">


                </div>
            </div>

        </div>
        <!--Grid column-->
   <?php         }
        } ?>
        <!--Grid column-->
        <div class="col-lg-4">

            <!-- Card -->
            <div class="mb-3" style="margin-top:-110px!important;">
                <div class="pl-2">
                    <h1>Cart Totals</h1>

                    <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>
                    <h5 class="font-weight-normal text-white"><br />Subtotal: <span class="float-right"> <?php wc_cart_totals_order_total_html(); ?></span> </h5>
                    <hr />
                    <h5 class="font-weight-normal text-white">Total:  <span class="float-right"> <?php wc_cart_totals_order_total_html(); ?></span></h5>
                    <br>
                    <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn btn-primary w-100 text-white">
                        <?php esc_html_e( 'Proceed to checkout', 'woocommerce' ); ?> <img src="/wp-content/uploads/2021/09/checkout-24.png" alt="checkout icon">
                    </a>


                    <!--TODO: Add dynamic checkout link -->
                <!--    <button type="button" class="btn btn-primary btn-block">go to checkout</button>-->

                </div>
            </div>

        </div>
        <!--Grid column-->

    </div>
    <!-- Grid row -->

</section>



</form>
<?php //do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">
    <?php
   // do_action( 'woocommerce_cart_collaterals' );
    ?>
</div>

