
<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
    echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
    return;
}

?>

    <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

        <?php if ( $checkout->get_checkout_fields() ) : ?>


            <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

            <div class="form-group" id="customer_details">
                <div class="row">
                    <div class="col-7">
                        <div id="check-wrap" class="jumbotron" style="padding:1rem!important;background-color: #fff;position:relative;">
                            <input type="button" style="position:absolute;bottom:0;left: 25px;border-bottom: 3px solid #fff!important;color:#fff!important;background-color: #5f75d9!important;padding:15px!important;" value="View address details">
                        <?php do_action( 'woocommerce_checkout_billing' ); ?>
                        </div>
                    </div>
                    <div class="col-5 pt-10">
                        <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>



                        <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                        <div id="order_review" class="woocommerce-checkout-review-order">
                            <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                        </div>

                        <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
                    </div>
                </div>

            </div>

            <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

        <?php endif; ?>



    </form>


<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>