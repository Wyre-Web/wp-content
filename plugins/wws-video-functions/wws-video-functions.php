<?php
/**
 * Plugin Name: WWS Video Functions
 * Description: This plugin contains custom functions related to the sale of streamable content
 * Author: Wyre Web Solutions
 * Version: 0.1
 */


//add_shortcode('panache_order_history','panache_get_customer_purchase_history');
function panache_get_customer_purchase_history()
{
    //get user
    $current_user = wp_get_current_user();
    $user_id = $current_user->ID;

    //check if valid user
    if (0 == $user_id) return;
    //create array
    $args = array(
        'numberposts' => -1,
        'meta_key' => '_customer_user',
        'meta_value' => $user_id,
        'post_type' => 'shop_order',
        'post_status' => 'wc-completed',

    );
    //pass $args and get user purchase history
    $customer_orders = get_posts($args);

    ?>

    <?php
    //loop through and grab the product_id
    //if (!$customer_orders) echo 'No orders';
    //empty variable array to update with product_ids
    $product_ids = array();
    //get order items
    foreach ($customer_orders as $customer_order) {

        $order = wc_get_order($customer_order->ID);
        $items = $order->get_items();

        //var_dump($order, $status);

        //loop through items grab each product_id to store in product_ids
        foreach ($items as $item) {
            $product_id = $item->get_product_id();
            $product_ids[] = $product_id;

        }

    }
    return $product_ids;
}

//get the current product's category name
function get_current_product_category()
{
    global $post;
    $terms = get_the_terms($post->ID, 'product_cat');
    foreach ($terms as $term) {
        // $product_cat_id = $term->term_id;
        $product_cat_name = $term->name;
    }
    echo $product_cat_name;
}

/**
 * Auto Complete all WooCommerce orders.
 */
add_action('woocommerce_thankyou', 'custom_woocommerce_auto_complete_order');
function custom_woocommerce_auto_complete_order($order_id)
{
    if (!$order_id) {
        return;
    }

    $order = wc_get_order($order_id);
    $order->update_status('completed');
}

add_action('woocommerce_after_shop_loop_item', 'get_star_rating');
function get_star_rating()
{
    global $woocommerce, $product;
    $average = $product->get_average_rating();

    echo '<span style="width:' . (($average / 5) * 100) . '%"><strong itemprop="ratingValue" class="rating">' . $average . '</strong> ' . __('out of 5', 'woocommerce') . '</span>';
}

// Reviews
add_action('woocommerce_review_before', 'woocommerce_review_display_gravatar', 10);
add_action('woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10);
add_action('woocommerce_review_meta', 'woocommerce_review_display_meta', 10);

/**
 * Register custom query vars
 *
 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/query_vars
 */
function wws_register_query_vars($vars)
{
    $vars[] = 'u_location';
    return $vars;
}

add_filter('query_vars', 'wws_register_query_vars');
/**
 * Build a custom query based on several conditions
 * The pre_get_posts action gives developers access to the $query object by reference
 * any changes you make to $query are made directly to the original object - no return value is requested
 *
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts
 *
 */
function wws_pre_get_posts($query)
{
    // check if the user is requesting an admin page
    // or current query is not the main query
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    // edit the query only when post type is 'accommodation'
    // if it isn't, return
    if (!is_post_type_archive('rehearsals')) {
        return;
    }

    $meta_query = array();

    // add meta_query elements
    if (!empty(get_query_var('u_location'))) {
        $meta_query[] = array('key' => 're_location', 'value' => get_query_var('u_location'), 'compare' => 'LIKE');
    }


    if (count($meta_query) > 1) {
        $meta_query['relation'] = 'AND';
    }

    if (count($meta_query) > 0) {
        $query->set('meta_query', $meta_query);
    }
}

add_action('pre_get_posts', 'wws_pre_get_posts', 1);

function wws_setup()
{
    add_shortcode('wws_return_location_data', 'wws_return_location_data');
}

add_action('init', 'wws_setup');
function wws_return_location_data() //: array
{
    global $post;

    // The Query
// meta_query expects nested arrays even if you only have one query
    $wws_query = new WP_Query(array('post_type' => 'rehearsals', 'posts_per_page' => '-1', 'meta_query' => array(array('key' => 're_location'))));

// The Loop
    if ($wws_query->have_posts()) {
    ?>

<!--    <select class="chosen-select custom-select custom-select-lg mb-3 form-control" aria-label="Upcoming Rehearsals" aria-expanded="false" autocomplete="off" style="width:100%!important;" data-placeholder="Find a Panache Dance Fitness rehearsal near you..." onchange="location = this.value">
        <option value=""></option>-->
        <div id="search">
        <div id="search-icon" class="text-center"><i class="fa-solid fa-magnifying-glass"></i> </div> <input class="search form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="search for Panache Dance Fitness Classes in your area.." title="Find a class...">

<div id="results-wrap">
        <ul id="myUL">
    <?php
        while ($wws_query->have_posts()) {
            $wws_query->the_post();
            //var_dump($wws_query);
            $location = get_field('re_location');
            if ($location) {
                // Get the data into usable array
                $addresses = array(array($location));
            }
            //var_dump($addresses);
            foreach ($addresses as $venue) { //loop through $addresses array and add each instance to $venue
                $captain = get_the_author_meta('user_nicename');
                $post_id = $post->ID;
                $post_title = get_the_title();
                $address = $venue[0]['address']; //declare address as variable
                $post_code = $venue[0]['post_code'];
                $url = '/dance-captain/'. $captain .'/';
               echo '<li><a href="'. $url .'"><span style="color:#f50a99;">'. $post_title . '</span> &nbsp;- ' . $address .',&nbsp;'. $post_code .'</a></li>';
            }
        }
        ?>

        <?php
    }
?>
    </ul>
    </div>
    </div>
 <!--   </select>-->

    <?php
    wp_reset_postdata();
}