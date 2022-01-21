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

if ( current_user_can( 'dance-captains' )  || current_user_can('administrator') ) :
/*$nonce = $_REQUEST['_wpnonce'];
$action = $_REQUEST['action'];
$user_id = wp_get_current_user()->ID;
$referrer = $_SERVER['HTTP_REFERER'];
//print_r($referrer);
if(strstr($referrer, 'https://panache.nic-edesign.com/login/')) {
    if (wp_verify_nonce($nonce, 'login-' . $user_id)) {
       // echo 'Security passed';
    } else {
      //  echo 'nonce invalid';
        // die( __( 'Security check', 'textdomain' ) );
    }
}*/
global $woocommerce;
$search = get_search_query();
//var_dump($woocommerce);
$args = array(
    'post_type' => 'product',
    'status' => 'publish',
    'limit' => -1,

);

$product_data = wc_get_products($args); // Run the $arg through WC_Product_Query (just like WP_Query)
/*$prices = array();
foreach ($product_data as $the_product) {
    $prices[] = $the_product->price;
}

$price_list = array_unique($prices);*/

/*if(! in_array(' ', array_unique($prices))) {

}*/
/*$prices_unique = json_encode(array_unique($prices));
var_dump($prices_unique);
$prices_list = explode(' ', $prices_unique);
var_dump($prices_list);*/
$cust_history = panache_get_customer_purchase_history();
get_header( 'shop' );
?>
    <header class="container-fluid text-center woocommerce-products-header">
        <style>

            input[type="submit"] {
                padding:5px;
            }
        </style>

            <h1 class="woocommerce-products-header__title page-title" style="color:#fff!important;padding-top:15px;padding-bottom:15px;">Choreography Store</h1>
        <hr style="border-top: 1px solid rgba(255,255,255,0.1);" >

    </header>


    <section class="container-fluid shop">

    <div class="row" style="margin-left: 0!important;">


    <div class="col-md-12">

<?php wc_print_notices() ?>
        <div class="w-100 row" style="padding-left:5%!important;padding-top:8px;!important;padding-bottom:2px!important;margin-bottom: 10px!important;">

            <div class="col-md-2" style="margin-right:10px!important;">
                <div class="dropdown">
                    <button style="width:95%;" type="button" id="price_filter" class="btn btn-price-filter dropdown-toggle" data-toggle="dropdown">
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
                    <button type="button" style="width:95%!important;" id="chor_filter" class="btn btn-price-filter dropdown-toggle" data-toggle="dropdown">
                        Filter by choreographer:
                    </button>
                    <div class="dropdown-menu">
                        <?php echo do_shortcode('[choreographer_list_filter]') ?>
                    </div>
                </div>
            </div>
            <div class="col-md-5">


                <?php echo do_shortcode('[pan_product_search_filter]') ?>
            </div>


        </div>
        <hr>
    <div class="row" style="margin-left:0!important;margin-right:0!important;">

    <?php
   // echo do_shortcode('[product_filter_tags]');

/*        while ($product_data->have_posts() ) {
           $product_data->the_post();*/
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

            if(!in_array($product_id, $cust_history)) {
                ?>
                <div style="margin-bottom: 10px;padding-left:2.5%!important;" class="col-md-3 text-center" id="<?php echo $product_id ?>">

                    <div class="inner-prod" style="width:90%!important;padding-bottom:35px;position:relative;min-height:23em;">

                        <div class="w-100" style="min-height: 40px;">
                            <?php
                            if($fitness_track == true) { ?>
                                <p class="float-left" style="color:#fff!important;font-size:12px;padding:3px;background-color: #000000;"><i class="fas fa-burn" style="color: #ffa600;font-size:16px!important;"></i>&nbsp;fitness track</p>
                           <?php
                            }
                            if (current_user_can('administrator') || current_user_can('site_owner') )  {
                                echo '<a title="Edit '.$title.'?" style="font-size:15px;padding:2px;float:left;margin-left:5px;" href="/edit-panache-video-product/?id=' . $product_id . '" class="edit-prod"><i style="color:#000000;" class="fas fa-edit"></i></a>';
                            }
                            echo '<span class="wishlist-title float-right">' . esc_attr__("Add $title to wishlist", "text-domain") . '</span><a class="wishlist-toggle" style="float: right!important;padding:5px!important" data-product="' . esc_attr($product_id) . '" href="#" title="' . esc_attr__("Add to wishlist", "text-domain") . '"><i style="font-size:20px;color:#4b4b4b;opacity: 0.8;" class="far fa-heart"></i></a>';
                            ?>

                        </div>
                    <h3 style="color:#000000!important;font-weight: 700!important;min-height:2em;">
                        <?php
                        if($title) {

                            echo $title.'<br />';

                        }

                        ?>
                    </h3>
                        <hr style="border-top: 1px solid purple;"/>
                        <?php
                        if($tags) { ?>
                            <div class="prod-fields text-left">
                                <div style="min-height:9em">
                                <?php
                                foreach ($tags as $tag) {
                                    echo '<p style="font-size: 16px!important;color: #000;font-family: PT Sans!important;font-weight: 700!important;">'.$tag->name.'</p>';
                                    //var_dump($artist);
                                }
                                ?>

                                </div>
                            </div>
                                <div class="w-100" style="padding-left: 15px;padding-bottom:25px;">
                                    <p title="choreographer" style="float:left!important;font-family: PT Sans!important;display: inline-block!important;font-size:18px!important;font-weight: 700!important;">
                                    <img src="/wp-content/uploads/2021/10/dancer-2-e1622667179728-1-e1637930243563.png" style="width:30px!important;float: left!important;" alt="dancer icon">

                                        <?php
                                        if($choreographers) {
                                            foreach ($choreographers as $choreographer) {
                                                echo $choreographer["display_name"].'&nbsp;&nbsp;';
                                            }
                                        }
                                        ?>
                                    </p>

                                </div>
                            <hr style="border-top: purple!important;">
                                <div class="row">

                                    <div class="col-md-12 text-center" style="padding-right:35px;position:absolute;bottom:0;">
                                        <h2 class="woocommerce-loop-product__title float-right" style="width:20%;color: #000000;">£<?php echo $price ?></h2>
                                      <a href="<?php echo $link ?>" class="button product_type_simple text-center" style="margin-left:3px;background-color: #480082!important;width:33%!important;float:left;font-size:12px;" ><i class="fas fa-play "></i>
                                      </a>
                                       <?php echo '<a class="button btn btn-success text-center product_type_simple" style="width:33%!important;float:left;margin-left: 3px;font-size:12px;background-color: #00824d" href="?add-to-cart=' . $product_id .'"><i class="fas fa-shopping-basket"></i>
                                        </a>';
                                      // do_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
                                       ?>
                                    </div>
                                </div>

                            <?php
                        }


                        ?>
                    </div>

                    </div>

                <?php



        }
        }
    ?>
    </div>
    </div>
</div>

        </section>
   <?php
endif;
get_footer();