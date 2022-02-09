<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wwcs
 */

?>

<div id="colophon" class="container-fluid site-footer">
    <div class="row">

        <div id="footer-sidebar2" class="col-md-4 text-center">
            <?php
                if(is_active_sidebar('footer-sidebar-2')){
                dynamic_sidebar('footer-sidebar-2');
            }
            ?>
        </div>
        <div id="footer-sidebar3" class="col-md-4 text-center">
            <?php
                    if(is_active_sidebar('footer-sidebar-3')){
                    dynamic_sidebar('footer-sidebar-3');
                }
                ?>
        </div>
        <div id="footer-sidebar4" class="col-md-4 text-center">
            <?php
                    if(is_active_sidebar('footer-sidebar-4')){
                    dynamic_sidebar('footer-sidebar-4');
                }
                ?>
        </div>
    </div>

    <div class="row mtop">
        <div class="col-12 text-center">

            <p class="m">
                Copyright © 2022 | Developed by
                <a class="continue" href="https://wyrewebsolutions.co.uk">WYRE WEB SOLUTIONS</a></p>
        </div>
    </div>
</div>


<?php wp_footer(); ?>

<!-- Modal -->
<div class="modal fade mt-4" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: #1b1b1b;font-weight: 700;" id="exampleModalLabel">Your shopping
                    basket</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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


                    <?php
                        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                        $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                        ?>
                    <!--Grid row-->
                    <div style="margin-left:0!important;margin-right: 0!important;"
                        class="row woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

                        <!--Grid column-->
                        <div class="col-md-12">
                            <!--<pre class="text-white">
                <?php /*var_dump($meta); */?>
            </pre>-->
                            <!-- Card -->
                            <div class="mb-3">
                                <div class="wish-list">

                                    <div class="row">
                                        <div class="col-md-5 col-lg-3 col-xl-3">
                                            <div class="text-center p-1" style="background-color:#1b1b1b!important;">

                                                <?php
                                                    $product_name = $_product->get_name();
                                                    $choreographer = get_field('choreographer', $product_id);
                                                    $choreographer_name = $choreographer['display_name'];
                                                    ?>
                                                <img class="w-100" src="/wp-content/uploads/2021/09/panache_logo.png"
                                                    alt="Panache Dance Fitness Logo">
                                                <p style="font-size: 11px;color:#fff!important;">
                                                    <strong><?php echo $product_name; ?></strong></p>

                                                <p style="font-size: 11px;margin-top:-10px;color:#1b1b1b!important;">
                                                </p>

                                            </div>
                                        </div>
                                        <div class="col-md-7 col-lg-9 col-xl-9">
                                            <div>


                                                <div class="justify-content-between w-100">
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <p class="font-weight-bold"
                                                                style="font-size: 18px;color:#1b1b1b!important;">
                                                                <?php echo $product_name; ?> </p>
                                                        </div>
                                                        <div class="col-4">
                                                            <h5 class="text-right" style="color: #1b1b1b!important;">
                                                                <?php
                                                                   echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.

                                                                    echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                                    'woocommerce_cart_item_remove_link',
                                                                    sprintf(
                                                                    '<a href="%s" style="padding:2px!important;float:right;" title="Remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><span style="color:red!important;" aria-hidden="true">×</span></a>',
                                                                    esc_url(wc_get_cart_remove_url($cart_item_key)),
                                                                    esc_html__('Remove this item', 'woocommerce'),
                                                                    esc_attr($product_id),
                                                                    esc_attr($_product->get_sku())
                                                                    ),
                                                                    $cart_item_key
                                                                    ); ?>
                                                            </h5>
                                                        </div>
                                                        <div class="col-12" style="margin-top:-5px;">
                                                            <p style="font-size: 11px;color:#1b1b1b!important;">
                                                                <strong><?php echo the_field('stage_screen', $product_id) ?>
                                                                    &bull;&nbsp;Choreographer:<?php echo $choreographer_name ?></strong>
                                                            </p>
                                                            <p class="mb-2 font-weight-bold text-uppercase small"
                                                                style="color:#1b1b1b!important;">Panache Dance Fitness
                                                                Streamed Content <?php

                                                                    ?></p>
                                                        </div>

                                                    </div>

                                                </div>


                                                <div class="justify-content-between align-items-right">
                                                    <div class="product_remove">


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

                    </div>
                    <!-- Grid row -->

                </form>


            </div>
            <div class="modal-footer w-100">
                <div class="w-100">
                    <div style="float:right">
                        <?php do_action( 'woocommerce_before_cart_collaterals' );

                do_action( 'woocommerce_cart_collaterals' );
                ?>
                        <br>
                    </div>
                </div>
                <div class="w-100 m-0 p-0">
                    <div style="float:right">
                        <button type="button" class="btn"
                            style="background-color: #d1ecf1!important;color: #0c5460!important;border:0!important;"
                            data-dismiss="modal">Continue shopping</button>
                        <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn text-white"
                            style="background-color:#00ce74!important;border:0!important;font-weight: bold!important;">
                            <?php esc_html_e( 'Checkout now', 'woocommerce' ); ?> <img
                                src="/wp-content/uploads/2021/09/checkout-24.png" alt="checkout icon">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="favouritesModal" tabindex="-1" aria-labelledby="favouritesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="background-color: #1b1b1b;">
            <div class="modal-header text-center" id="fav-mod-head">
                <h4 class="modal-title bold" id="favouritesModalLabel">My Favourite Choreography &nbsp;&nbsp;<i
                        class="fas fa-heart" id="wish-heart"
                        style="color: #fff!important;font-weight: 900!important;"></i>&nbsp;&nbsp;<img
                        src="https://panache.nic-edesign.com/wp-content/uploads/2021/09/panache_logo-e1637930443491.png"
                        style="width: 170px;"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                echo do_shortcode('[wishlist]');
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
`<script>
    function myFunction() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }

    function myProdFunction() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myProdInput");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myProdUL");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
</script>

</body>

</html>