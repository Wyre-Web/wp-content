<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
$current_user = wp_get_current_user(); // grab user info  from the database

if ( is_user_logged_in() && current_user_can( 'dance_captain' )  || current_user_can('administrator')) :

    global $woocommerce;
    $search = get_search_query();
//var_dump($woocommerce);
  $args = array(
        'post_type' => 'product',
        'status' => 'publish',
      'limit' =>500,
     'order_by'       => 'date',
  //  'order'          => 'DESC'
    ); 

    $product_data = wc_get_products($args); // Run the $arg through WC_Product_Query (just like WP_Query)

    $cust_history = panache_get_customer_purchase_history();
    get_header( 'shop' );
    ?>
<header class="container-fluid text-center woocommerce-products-header">
    <style>
        input[type="submit"] {
            padding: 5px;
        }
    </style>

    <h1 class="woocommerce-products-header__title page-title"
        style="color:#fff!important;padding-top:15px;padding-bottom:15px;">Choreography Store</h1>
    <hr style="border-top: 1px solid rgba(255,255,255,0.1);">

</header>


<div class="container-fluid shop">
    <div class="row" style="margin-left: 0!important;">
        <div class="col-md-12">
            <?php wc_print_notices() ?>
            <div class="w-100 row"
                style="padding-left:5%!important;padding-top:8px;!important;padding-bottom:2px!important;margin-bottom: 10px!important;">
                <div class="col-md-2" style="margin-right:10px!important;">
                    <div class="dropdown">
                        <button style="width:95%;" type="button" id="price_filter"
                            class="btn btn-price-filter dropdown-toggle" data-toggle="dropdown">
                            Filter by price
                        </button>
                        <div class="dropdown-menu">
                            <?php
                                echo do_shortcode('[price_list_filter]')
                                ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dropdown">
                        <button type="button" style="width:95%!important;" id="chor_filter"
                            class="btn btn-price-filter dropdown-toggle" data-toggle="dropdown">
                            Filter by choreographer:
                        </button>
                        <div class="dropdown-menu">
                            <?php echo do_shortcode('[choreographer_list_filter]') ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <?php echo do_shortcode('[pan_product_search_filter]') ?>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row" style="margin-left:0!important;margin-right:0!important;">

        <?php
                    
                 foreach($product_data as $product_id) {
                        $product = wc_get_product($product_id);
                        $product = $product->get_data();
                        $product_id = $product['id'];
                        $title = $product['name'];
                        $choreographers = get_field('choreographer', $product_id );
                        $tags = get_field('artist', $product_id);
                        $price= get_field('price',$product_id);
                        $fitness_track = get_field('fitness_track',$product_id);
                        $current_user = wp_get_current_user();
                        $user_id = $current_user->ID;
                        $link = get_the_permalink($product_id);
                        $itunes = get_field('music_on_itunes',$product_id);

                        if(!in_array($product_id, $cust_history)) {
                            ?>
        <div style="margin-bottom: 10px;padding-left:5%!important;" class="col-md-3 text-center"
            id="<?php echo $product_id ?>">
            <div class="inner-prod" style="width:90%!important;position:relative;background-color: #f5f5f5;">
                <div class="w-100" style="min-height: 20px;">
                    <?php
                                        if($fitness_track == true) { ?>
                    <p class="float-left"
                        style="color:#fff!important;font-size:14px;padding:3px;background-color: #000000;"><i
                            class="fas fa-burn" style="color: #ffa600;font-size:14px!important;"></i>&nbsp;fitness
                        track</p>
                    <?php
                                        }
                                        if (current_user_can('administrator') || current_user_can('site_owner') )  {
                                            echo '<a title="Edit '.$title.'?" style="font-size:15px;padding:2px;float:left;margin-left:5px;" href="/edit-panache-video-product/?id=' . $product_id . '" class="edit-prod"><i style="color:#000000;" class="fas fa-edit"></i></a>';
                                        }
                                        echo '<span class="wishlist-title float-right">' . esc_attr__("Add $title to wishlist", "text-domain") . '</span><a class="wishlist-toggle" style="float: right!important;padding:5px!important" data-product="' . esc_attr($product_id) . '" href="#" title="' . esc_attr__("Add to wishlist", "text-domain") . '"><i style="font-size:20px;color:#4b4b4b;opacity: 0.8;" class="far fa-heart"></i></a>';
                                        ?>

                </div>
                <h5 style="color:#000000!important;font-weight: 700!important;">
                    <?php
                                        if($title) {
                                            echo $title.'<br />';
                                        }
                                        ?>
                </h5>
                <hr style="border-top: 1px solid purple;color: black;" />
                <?php
                                    if($tags) { ?>
                <div class="prod-fields text-center">
                    <h6 style="color:black ;font-weight: 600">Stage/Screen-Album-Musical</h6>
                    <div style="min-height:2em">
                        <?php
                                                foreach ($tags as $tag) {
                                                    echo '<p style="font-size: 14px!important;background-color: #f9f9f9;color: black !important;font-family: PT Sans!important;font-weight: 700!important;">'.$tag->name.'</p>';

                                                }
                                                ?>
                    </div>
                </div>
                <div class="row">

                    <div class="col-12 text-center">
                        <hr>
                        <p title="choreographer"
                            style="font-size:14px;margin-left: .1em; font-family: PT Sans!important;font-weight: 500!important;color: black !important;">
                            <img src="https://panachedancefitness.com/wp-content/uploads/2021/10/dancer-2-e1622667179728-1-e1637930243563.png"
                                style="width:30px!important; margin-right: .1em;" alt="dancer icon">
                            <?php
                                                if($choreographers) {
                                                    foreach ($choreographers as $choreographer) {
                                                        echo $choreographer["display_name"].'<br>';
                                                    }
                                                }
                                                ?>
                        </p>
                    </div>

                    <?php if ($itunes){?>

                    <div class="col-12 text-center">
                        <p style="margin-left: .8em;padding-bottom: 0;margin-bottom: 0;"><img
                                src="/wp-content/uploads/2022/02/note-16.png"><a
                                style="font-size:14px!important;font-weight: 600!important;margin-left: .1em;color:black !important;font-family: PT Sans!important;"
                                href="<?php echo $itunes; ?>">Listen on iTunes</a></p>
                    </div>
                    <?php } ?>
                </div>
                <hr style=" border-top: 1px solid purple!important;">
                <div class="row">
                    <div class="col-6 text-left">
                        <a href="<?php echo $link ?>" class="button btn product_type_simple text-center"
                            style="margin-left: 1.5em !important;width: 100% !important;background-color: #480082!important; width: 35% !important ;font-size:14px;"><i
                                class="fas fa-play "></i>
                        </a>

                        <?php echo '<a class="button btn btn-success text-center product_type_simple" style="margin-left: 1.2em !important; width: 35% !important;font-size:14px;background-color: #00824d" href="?add-to-cart=' . $product_id .'"><i class="fas fa-shopping-basket"></i>
                                        </a>';
                                                ?>
                    </div>
                    <div class="col-6 text-right">
                        <h4 class="woocommerce-loop-product__title"
                            style="padding-right: 1.5em;color: #000000;font-weight: 700!important;font-family: 'PT Sans';">
                            ??<?php echo $price ?></h4>
                    </div>
                </div>
                <?php  }  ?>
            </div>
        </div>
        <?php

                       }
                                }
                          
                  
                    ?>

    </div>
</div>

</section>
<?php
endif;
get_footer();