<?php
global $woocommerce;
global $product;
/**
 * The template for displaying all pages
 * Template name: Repertoire
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wwcs
 */
if(!function_exists('wc_get_products')) {
    return;
}
$args = array(
    'status' => 'publish',
    'limit' => -1,
    'return' => 'ids',
);
$wc_query = new WC_Product_Query($args); // Run the $arg through WC_Product_Query (just like WP_Query)
$wc_products = $wc_query->get_products();

//var_dump($rep_products);
$cust_history = panache_get_customer_purchase_history();
get_header( 'shop' );

?>
    <div class="container-fluid text-center" style="border-bottom: 2px solid rgba(255,255,255,0.7);">
        <h1 class="entry-title">My Repertoire</h1>
    </div>
    <section class="container-fluid shop pt-4">
    <div class="row" style="margin-left: 0!important;margin-right:0!important;">

        <div class="col-md-12">
            <?php wc_print_notices() ?>
            <div class="row">
                <div class="col-6 text-center">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-favourites" data-toggle="modal" data-target="#favouritesModal" style="width:80%;border-radius:0;padding:4px!important;">
                        View my favourites &nbsp;&nbsp;<i class="far fa-heart" style="font-weight: 900;color:#fff;"></i>
                    </button>
                </div>
                <div class="col-6 text-center">
                    <a href="/choreography-store" class="btn" style="background-color: #fff;color:#1b1b1b!important;font-weight: 700!important;width:80%;padding:4px;border-radius:0;">Go to choreography store &nbsp;&nbsp;<i style="font-weight: 900;" class="fas fa-arrow-right"></i></a>

                </div>

            </div>
            <div class="row pt-3">
<?php
foreach($wc_products as $product_id) {
    $product = wc_get_product($product_id);
     $product = $product->get_data();
     //var_dump($product);
     $product_id = $product['id'];
    $title = $product['name'];
    $choreographers = get_field('choreographer', $product_id );
    $tags = get_field('artist', $product_id);
    $current_user = wp_get_current_user();
    $user_id = $current_user->ID;
    $link = get_the_permalink($product_id);
    //$data = wws_get_fields_product();

     if(in_array($product_id, $cust_history)) { ?>
         <div class="col-md-3 text-center" style="margin-bottom:10px;">
          <div class="inner-prod text-left" style="position:relative;">
              <div class="w-100" style="position:relative;min-height:20px;">
                <?php
              echo '<span class="wishlist-title float-right">' . esc_attr__("Add to favourites", "text-domain") . '</span><a class="wishlist-toggle" style="position:absolute;right:0;padding-right:5px!important;margin:0!important;" data-product="' . esc_attr($product_id) . '" href="#" title="' . esc_attr__("Add to wishlist", "text-domain") . '"><i style="font-size:20px;color:#fff;opacity: 0.6;" class="far fa-heart"></i></a>';
               ?>
              </div>
              <h5 style="color:rgba(255,255,255,0.8);padding-left:10px;padding-top:10px"><?php echo $title ?></h5>
            <div class="prod-fields text-left" style="padding-left:10px;">
                <?php
                foreach ($tags as $tag) {
                    echo '<p style="font-size: 14px!important;color:rgba(255,255,255,0.8)">'.$tag->name.'</p>';
                }
                ?>
                 <p style="font-size: 16px;"> <img class="dance-icon" src="https://panache.nic-edesign.com/wp-content/uploads/2021/10/dancer-2-e1622667179728-1-e1637930243563.png" style="width:25px!important;" alt="dancer icon">&nbsp;
                     <?php
                     if($choreographers) {
                         foreach ($choreographers as $choreographer) {
                             echo $choreographer["display_name"].'&nbsp;&nbsp;';
                         }
                     }
                     ?>
                 </p>

                  </div>
            <a href="<?php echo $link ?>" class="btn btn-watch" style="position:absolute;bottom:0;width:100%;padding:5px;font-weight: 700;border-radius:0!important;">Watch now &nbsp;&nbsp;<i class="fas fa-play"></i></a>
          </div>

         </div>
         <?php

}
}
 ?>
        </div>

        </div>
            </div><!-- #main -->
    </section>
<?php
get_footer();



/*function populate_notes_product_name($field) {

    // only on front end
    if (is_admin()) {
        return $field;
    }
    if (isset($title)) {
        $field['value'] = $product_name;
    }
    return $field;
}
add_filter('acf/prepare_field/key=field_61be4dd71866f', 'populate_notes_product_name');*/
