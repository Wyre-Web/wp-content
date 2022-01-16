<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
if ( ! ( is_user_logged_in() || current_user_can('administrator') ) ) {
    echo '<p>You must be a registered dance captain to access this page.</p>';
    return;
} else {
    get_header();
    global $product;
    global $post;
    global $product_id;
    global $new_terms;
    global $taxonomy;

    /**
     * woocommerce_before_main_content hook.
     *
     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
     * @hooked woocommerce_breadcrumb - 20
     * DM -- overridden for wwcs bootstrap 4 theme - comments added
     */
//required
    $product = wc_get_product($post->ID);
    $product_id = $product->get_id();
    $title = $product->get_name();
    $value = $product->get_price();
    global $woocommerce;
    $count = $woocommerce->cart->cart_contents_count;
    $post_meta = get_post_meta($product_id);
    $tags = get_field('artist', $product_id);
    $choreographers = get_field('choreographer',$product_id);
?>

    <div class="container pt-2">
        <?php do_action( 'woocommerce_before_single_product' ); ?>

    </div>

<?php //while ( have_posts() ) :

     //the_post();

    $array = panache_get_customer_purchase_history();
        //$nonce = wp_create_nonce( 'add_notes' );

    //var_dump($array);
    if(in_array($product_id, $array )) {
       // echo do_shortcode('[notes_array]');
        //$nonce = wp_create_nonce("rem_from_fav_function_nonce");
        echo '<div class="container jumbotron oneb" style="padding:0.5rem!important;">';
        echo '<p class="m-0 oneb d-inline-block" style="padding:2px;font-size:14px;color:#fff!important;opacity: 0.7;">Purchased &nbsp;<img src="/wp-content/uploads/2021/09/check-mark-3-24.png" style="width:16px;margin-top:-9px!important;" alt="check mark">
        &nbsp;&nbsp;| &nbsp;&nbsp; '. $title .' - Full Choreography &nbsp;&nbsp;&nbsp; <div class="rounded-circle" style="background-color: #fff4b9;width:35px;height:35px;float:right!important;padding-left: 7px;"><a href="/add-notes/?id='. $product_id .'" title="Add choreography notes"><i style="color:#2b2b2b;" class="fas fa-pen"></i></a></div></p>
        <div class="embed-container">';

        echo the_field('vimeo_purchased_content_embed').'</div></div>';

    } elseif($value === '0.00') {
       // echo do_shortcode('[notes_array]');
        echo '<div class="container jumbotron oneb" style="padding:0.5rem!important;">';
        echo '<p class="text-white m-0 oneb d-inline-block" style="padding:2px;font-size:14px;color:#fff!important;opacity: 0.7;">Dance Captain Complimentary &nbsp;<img src="/wp-content/uploads/2021/09/check-mark-3-24.png" style="width:16px;margin-top:-9px!important;" alt="check mark">
        &nbsp;&nbsp;| &nbsp;&nbsp; ' . $title . ' - Full Choreography &nbsp;&nbsp;&nbsp;<a href="/add-notes/?id='. $product_id .'" title="Add choreography notes"><i style="color:#2b2b2b;" class="fas fa-pen"></i></a>
</p>
        <div class="embed-container">';

        echo the_field('vimeo_purchased_content_embed').'</div></div>';
    }
    else { ?>
            <div class="container p-4">
        <a class="btn oneb float-left text-white" href="/choreography-store#<?php echo $product_id ?>"><img src="/wp-content/uploads/2021/09/arrow-83-24.png" alt="back arrow"> &nbsp;&nbsp;&nbsp;Back to Shop</a>


    </div>
            <div class="container jumbotron oneb" style="padding:1.5rem!important;">
        <div class="row">
            <div class="col-sm-7">
                <div class="prod-preview">
                    <?php echo the_field('vimeo_content_preview_embed'); ?>
                        <script src="https://player.vimeo.com/api/player.js"></script>

                </div>

            </div>

            <div class="col-sm-5" style="padding-top:0px;">
                <div class="prod-dets">
                    <?php echo '<p class="d-none">Product ID: ' . $product_id . '</p>';
                     echo '<div class="w-100"><h2 class="text-white p-0" style="text-align: left!important;">' . $title .'</h2></div>';
                                            //echo '<div class="w-100 star-rating" style="height:1.7em;">' . get_star_rating() .'<br /></div>';
                     ?>

    <p class="text-white font-weight-bold" style="font-size:16px;color:#eee!important;opacity: 0.5;"><img src="/wp-content/uploads/2021/09/vimeo-5-24.png" alt="Vimeo Icon"> &nbsp;&nbsp;Panache Dance Fitness Streamed Content</p>
                    <hr style="border-top: 1px solid #eee;opacity: 0.5;">
                    <?php
                    foreach ($tags as $tag) {
                        echo '<p style="font-size: 16px!important;color:#fff!important;">'.$tag->name.'</p>';
                        //var_dump($artist);
                    }
                    ?>
                    <p style="font-size: 16px!important;color:#fff!important;">
<?php
                    if ($choreographers) {
                        foreach ($choreographers as $choreographer) {
                            echo $choreographer["display_name"] . '&nbsp;&nbsp;';
                        }
                    }

                    ?>
                    </p>
                    <hr style="border-top: 1px solid #eee;opacity: 0.5">
                   <?php echo '<h3 class="text-white pt-0">£ ' . $value . '</h3>' ?>
                    <hr style="border-top: 1px solid #eee;opacity: 0.5">
                    <?php echo apply_filters(
                    'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
                    sprintf(
                    '<a style="color:#fff!important;font-weight: 700!important;" href="%s" data-quantity="%s" class=" %s" %s>%s &nbsp;&nbsp;&nbsp;<i class="fas fa-shopping-basket"></i></a>',
                    esc_url( $product->add_to_cart_url() ),
                    esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
                    esc_attr( isset( $args['class'] ) ? $args['class'] : 'btn btn-success text-white' ),
                    isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
                    esc_html( $product->add_to_cart_text() )
                    ),
                    $product,
                    $args
                    );?>
                </div>
            </div>
        </div>
                <?php //echo do_shortcode('[recent_products per_page="4" columns="4" orderby="title" order="desc"]'); ?>
    </div>
        <?php
      //  echo the_field('vimeo_content_preview_embed');
    }

    //endwhile; // end of the loop.


?>


<?php


get_footer( 'shop' );

}

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */

