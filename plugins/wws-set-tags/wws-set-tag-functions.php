<?php
/**
 * Plugin Name: WWS Favourites Plugin
 * Description: This plugin contains custom functions.
 * Author: Wyre Web Solutions
 * Version: 0.1
 * @global WC_Checkout $checkout
 *
 */
//Our custom post type function

global $post;
global $woocommerce;

//Our custom post type function
function create_posttype_notes() {
    register_post_type( 'notes',
        // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Notes' ),
                'singular_name' => __( 'Note' )
            ),
            'public' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'publicly_queryable' => true,
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array('title','custom-fields'),
            'rewrite'           => array('slug' => 'notes'),
            //'taxonomies'          => array( 'category' ),
        )

    );
}
add_action( 'init', 'create_posttype_notes');
//$post_id = $post->ID;
add_action('acf/init', 'my_acf_form_init');
function my_acf_form_init() {

    // Check function exists.
    if( function_exists('acf_register_form') ) {

        // Register form.
        acf_register_form(array(
            'id'       => 'add_prod',
             'field_groups' => array(8071),
            //'fields' => array(92),
            'form' => true,
            'post_id'  => 'new_post',
            'post_content' => false, // This will show the content field
            'post_title'  => true,
            //'post_attributes' => true,
            'return' => '/choreography-store',
            //'html_after_fields' => $html_after,

        'new_post' => array(
            'post_type' => 'product',
            'post_status'	=> 'publish'
        ),
            'submit_value' => __("Create Product", 'acf'),
            'html_submit_spinner' => '<span class="acf-spinner"></span>',
        ));
        $html_before = '<a href="/choreography-store/#'. $_GET['id'] .'" class="btn btn-watch">Back to Choreography Store</a>';
        acf_register_form(array(
            'id'       => 'edit_prod',
            'field_groups' => array(8071),
            //'fields' => array(92),
            'form' => true,
            'post_id'  => $_GET['id'],
            'post_content' => false, // This will show the content field
            'post_title'  => true,
            //'post_attributes' => true,
            'return' => '/choreography-store/#'.$_GET['id'],
            'html_before_fields' => $html_before,
            'post_status' => 'publish',
            'post_type' => 'product',
            'submit_value' => __("Update Product", 'acf'),
            'html_submit_spinner' => '<span class="acf-spinner"></span>',
        ));
        acf_register_form(array(
            'id'       => 'add_notes',
            'field_groups' => array(7708),
            //'fields' => array(92),
            'form' => true,
            'post_id'  => 'new_post',
            'post_content' => false, // This will show the content field
            'return' => '/shop/repertoire',
            //'html_after_fields' => $html_after,
        'new_post' => array(
            'post_type' => 'notes',
            'post_title' => 'User note #'. rand(),
            'post_status'	=> 'publish'
        ),
            'submit_value' => __("Save Note", 'acf'),
            'html_submit_spinner' => '<span class="acf-spinner"></span>',
        ));
        acf_register_form(array(
            'id'       => 'edit_notes',
            'field_groups' => array(7708),
            'form' => true,
            'post_id'  => get_the_id(),
            'post_content' => false, // This will show the content field
            'post_title'  => true,
            //'post_attributes' => true,
            'return' => '/shop/repertoire',
            //'html_after_fields' => $html_after,
            'post_status' => 'publish',
            'post_type' => 'notes',
            'submit_value' => __("Save Note", 'acf'),
            'html_submit_spinner' => '<span class="acf-spinner"></span>',
        ));
        acf_register_form(array(
            'id' => 'edit-profile',
            'field_groups' => array(175),
            'new_post' => false,
            'post_id'  => $_GET['id'],
            'post_title'  => false,
            'post_type' => 'profiles',
            'form' => true,
            'post_status' => 'publish',
            'return' => '/dance-captain/'.wp_get_current_user()->user_nicename,
            'submit_value' => __("Update Profile", 'acf'),
            'html_submit_spinner' => '<span class="acf-spinner"></span>',
        ));

    }
}
//local field group for products overrides any settings on the front-end


// Adds a custom rule type.
add_filter( 'acf/location/rule_types', function( $choices ){
    $choices[ __("Other",'acf') ]['wc_prod_attr'] = 'WC Product Attribute';
    return $choices;
} );

// Adds custom rule values.
add_filter( 'acf/location/rule_values/wc_prod_attr', function( $choices ){
    foreach ( wc_get_attribute_taxonomies() as $attr ) {
        $pa_name = wc_attribute_taxonomy_name( $attr->attribute_name );
        $choices[ $pa_name ] = $attr->attribute_label;
    }
    return $choices;
} );

// Matching the custom rule.
add_filter( 'acf/location/rule_match/wc_prod_attr', function( $match, $rule, $options ){
    if ( isset( $options['taxonomy'] ) ) {
        if ( '==' === $rule['operator'] ) {
            $match = $rule['value'] === $options['taxonomy'];
        } elseif ( '!=' === $rule['operator'] ) {
            $match = $rule['value'] !== $options['taxonomy'];
        }
    }
    return $match;
}, 10, 3 );

//ACF PRICE FIELD
add_filter( 'woocommerce_product_get_price', 'wws_get_product_price', 20, 2 );
add_filter( 'woocommerce_product_get_regular_price', 'wws_get_product_price', 20, 2 );
function wws_get_product_price( $price, $product ) {
    //if ( $product->is_type('dish') ) {
        $price = get_field( 'price', $product->get_id() );
    //}
    return $price;
}
//ACF PRODUCT ATTRIBUTES
//add_filter( 'woocommerce_product_get_attributes', 'wws_get_product_attributes', 20, 2 );
//add_filter( 'woocommerce_product_get_regular_price', 'wws_get_product_price', 20, 2 );
/*function wws_get_product_attributes( $attributes, $product ) {
    //if ( $product->is_type('dish') ) {
    $attributes = get_field( 'track_type_fe', $product->get_id() );
    //}
    return $attributes;
}*/
/*add_shortcode('wws_custom_product_fields', 'wws_custom_product_fields');
add_action('woocommerce_after_shop_loop_item_title', 'wws_custom_product_fields');*/
global $product;


// array of filters (field key => field name)
$GLOBALS['my_query_filters'] = array(
    'field_61a302e7753ad'	=> 'video_category',
    'field_61a39dceb746d'	=> 'product_attributes',
    'field_61be110ff1397' => 'notes_product_id',
    '_price' => 'price',
    //'field_61ca31234d0cd' => 'price',

);


// action



/*function my_pre_get_posts( $query ) {

    // bail early if is in admin
    if( is_admin() ) return;


    // bail early if not main query
    // - allows custom code / plugins to continue working
    if( !$query->is_main_query() ) return;


    // get meta query
    $meta_query = $query->get('meta_query');


    // loop over filters
    foreach( $GLOBALS['my_query_filters'] as $key => $name ) {

        // continue if not found in url
        if( empty($_GET[ $name ]) ) {

            continue;

        }


        // get the value for this filter
        $value = explode(',', $_GET[ $name ]);


        // append meta query
        $meta_query = array(
            'key'		=> $name,
            'value'		=> $value,
            'compare'	=> 'IN',
        );

    }
    // update meta query
    $query->set('meta_query', $meta_query);
}*/
add_shortcode('wws_get_fields_product', 'wws_get_fields_product');
add_action('woocommerce_after_shop_loop_item_title','wws_get_fields_product');
add_action('wws_get_fields_product','wws_get_fields_product');
function wws_get_fields_product() {
    global $product;
    $product_id = $product->ID;
    $choreographers = get_field('choreographer', $product_id );
    $tags = get_field('artist');
    $price = get_field('price', $product_id);

        if($tags) { ?>
            <div class="prod-fields text-left">
                <div class="field-wrap" style="min-height:7em">
                <?php
        foreach ($tags as $tag) {
          echo '<p style="font-size: 17px;color:rgba(255,255,255,0.8)">'.$tag->name.'</p>';
        }
        ?>
                </div>
              <div class="w-100" style="min-height:6em">
                  <p>
                      <img src="/wp-content/uploads/2021/10/dancer-2-e1622667179728-1-e1637930243563.png" style="width:25px!important;float:left;" alt="dancer icon">&nbsp;&nbsp;

                      <?php
                      if($choreographers) {
                          foreach ($choreographers as $choreographer) {
                                  echo '<a class="chor" style="color:#fff!important;font-size:17px;font-weight: bold!important;" href="/dance-captain/' . $choreographer["user_nicename"] . '">' . $choreographer["display_name"] . '</a>. ';
                          }
                      }
                      ?>

                  </p>

                   </div> 
                   <div class="row">

                   <div class="col-md-12" style="padding-right:50px;position: absolute;bottom:35px;">
                       <?php if (current_user_can('administrator') || current_user_can('site_owner') )  {
                           echo '<a style="font-size:14px;background-color:#000;padding:3px;" class="float-left" href="/edit-panache-video-product/?id='. get_the_id() .'" class="edit-prod">Edit Product ?</a>';
                       } ?>
                   <h2 style="background-color: rgba(255,255,255,0.9);color:#1b1b1b!important;padding:3px;float:right;font-size: 22px;font-weight: 700!important;">£<?php echo $price ?></h2>
                   </div>
                   </div>
            </div>
            <?php
}
}
add_shortcode('tag_cloud', 'get_tag_cloud');
function get_tag_cloud() {
    echo do_blocks('<!-- wp:legacy-widget {"idBase":"woocommerce_product_tag_cloud","instance":{"encoded":"YToxOntzOjU6InRpdGxlIjtzOjEyOiJQcm9kdWN0IHRhZ3MiO30=","hash":"e7a4ed5f8d80133bee466f84ab00c7ec","raw":{"title":"Product tags"}}} /-->');
}
add_shortcode('wws_get_fields_product_rep', 'wws_get_fields_product_rep');
add_action('wws_get_fields_product_rep','wws_get_fields_product_rep');
function wws_get_fields_product_rep() {
/*    global $product;
    $product_id = $product->ID;*/
    //$meta = array();
    //$meta = get_post_meta(get_the_id());
    // print_r($meta);
    //$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
    //$author_id = get_the_author_meta('ID');
    $choreographers = get_field('choreographer');
/*    foreach($choreographers as $choreographer) {
        $choreographer = $choreographer["display_name"];
    }*/

    $tags = get_field('artist');

    //var_dump($choreographer);

    $price = get_field('price');
    //var_dump($choreographer );


    if($tags) { ?>
        <div class="prod-fields text-left">
            <?php
            foreach ($tags as $tag) {
                echo '<p style="font-size: 14px!important;color:rgba(255,255,255,0.8)">'.$tag->name.'</p>';
                //var_dump($artist);
            }
            ?>

            <div class="w-100">
                <img src="/wp-content/uploads/2021/10/dancer-2-e1622667179728-1-e1637930243563.png" style="width:25px!important;" alt="dancer icon">&nbsp;&nbsp;
                <ul>
                    <?php
                    if($choreographers) {
                        foreach ($choreographers as $choreographer) {
                            echo '<li style="color:#fff!important;display: inline!important;float:left!important;font-size:15px!important;font-weight: 700!important;width::35%!important;">'.$choreographer["display_name"].'</li>';
                        }
                    }
                    ?>
                </ul>

            </div>
            <div class="row">
                <div class="col-md-6 text-center">
                    <img src="/wp-content/uploads/2021/09/panache_logo-e1637930443491.png" style="width:70%!important;" alt="Panache dance fitness logo">
                </div>
                <div class="col-md-6 text-center">
                    <h2 class="woocommerce-loop-product__title">£&nbsp;<?php echo $price ?></h2>
                </div>
            </div>
        </div>
        <?php
    }
}



add_shortcode('get_terms','wws_get_product_terms');
add_action('woocommerce_before_shop_loop_item','wws_get_product_terms');
add_action('repertoire_terms','wws_get_product_terms');
function wws_get_product_terms() {
    //global $product;
/*    $terms_prod = get_the_terms( get_the_id(), 'pa_track-type' );
    $term_names = wp_list_pluck($terms_prod, "name");*/
/*    foreach ($term_names as $term_name) {
        $prod_terms[] = $term_name
    }*/
/*                if(is_array($term_names)) {
                    if (in_array('New', $term_names)) {
                        echo '&nbsp;&nbsp;<span class="float-left" title="New Track" id="new-attr">&#9733;</span>&nbsp;&nbsp;';
                    }
                    if (in_array('Christmas', $term_names)) {
                        echo '&nbsp;&nbsp;<span class="float-left" title="Christmas Track" id="xmas-attr">&#9731;</span>&nbsp;&nbsp;';
                    }
                    if (in_array('Fitness Track', $term_names)) {
                        echo '&nbsp;&nbsp;<span class="float-left" title="Fitness Track" id="fitness-attr">&#9832;</span>&nbsp;&nbsp;';
                    }

                }*/
    //echo $prod_terms;
}

add_action('wws_assign_product_button','wws_assign_product_button');
function wws_assign_product_button() {
    global $product;
$history_array = panache_get_customer_purchase_history();


        if (in_array(get_the_id(), $history_array)) {
            echo '  <a href="'. get_the_permalink() . '" class="button product_type_simple text-center" style="background-color: #5f75d9!important;width:100%!important;float:left;" ><i class="fas fa-play"></i></a>
                    ';


        } else {
            echo ' 
            <div class="w-100">
        <a href="'. get_the_permalink() . '" class="button product_type_simple text-center float-left" title="Watch preview?" style="background-color: #5f61d9!important;width:50%!important;border:0!important;border-radius:0!important;" ><i class="fas fa-eye"></i></a>';

echo apply_filters(
    'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
    sprintf(
        '<a href="%s" data-quantity="%s" class="button btn btn-success text-center product_type_simple  %s" style="min-width:50%!important;background-color:#00ce74!important;color:#fff!important;font-weight: 600!important;border-radius: 0!important;"><i class="fas fa-shopping-basket"></i></a>',
        esc_url($product->add_to_cart_url()),
        esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
        esc_attr(isset($args['class']) ? $args['class'] : 'btn btn-success text-white'),
        isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
        esc_html($product->add_to_cart_text())
    ),
    $product,
    $args
);
echo '</div>';
?>

<?php
        }

    //return;
    }

function populate_notes_user_id($field) {
    $current_user = wp_get_current_user();
    $user_id = $current_user->ID;
    // only on front end
    if (is_admin()) {
        return $field;
    }
    if (isset($user_id)) {
        $field['value'] = $user_id;
        $field['hidden'] = true;
    }
    return $field;
}
add_filter('acf/prepare_field/key=field_61be10c90fbb5', 'populate_notes_user_id');

function populate_notes_user_name($field) {
    $current_user = wp_get_current_user();
    $user_name = $current_user->display_name;
    // only on front end
    if (is_admin()) {
        return $field;
    }
    if (isset($user_name)) {
        $field['value'] = $user_name;
        $field['readonly'] = true;
    }
    return $field;
}
add_filter('acf/prepare_field/key=field_61bf6174dc19e', 'populate_notes_user_name');

function populate_notes_product_id($field) {
    //$nonce = $_REQUEST['_wpnonce'];
    $product_id = $_REQUEST['id'];
/*    if ( ! wp_verify_nonce( $nonce, 'add_notes' ) ) {
        // This nonce is not valid.
        die( __( 'Security check', 'textdomain' ) );
    } else {
        echo 'nonce valid';
    }*/

    if (is_admin()) {
        return $field;
    }
    if (isset($product_id)) {
        $field['value'] = $product_id;
        $field['hidden'] = true;
    }
    return $field;
}
add_filter('acf/prepare_field/key=field_61be70bf9e167', 'populate_notes_product_id');

function populate_notes_product_name($field)
{
    //var_dump($_REQUEST[]);
    //$nonce = $_REQUEST['_wpnonce'];
    $product_id = $_REQUEST['id'];
    $product_name = get_the_title($product_id);
    // $product_name = ;
/*    if (!wp_verify_nonce($nonce, 'add_notes')) {
        // This nonce is not valid.
        die(__('Security check', 'textdomain'));
    } else {
*/
        if (is_admin()) {
            return $field;
        }
        if (isset($product_name)) {
            $field['value'] = $product_name;
            $field['readonly'] = true;
        }
        return $field;
    //}
}
add_filter('acf/prepare_field/key=field_61bfc7cb3d34b', 'populate_notes_product_name');

function notes_array()
{
    $current_user = wp_get_current_user();
    $current_user_id = $current_user->ID;
    $current_product_id = get_the_id();
    //$meta = get_post_meta($current_product_id);
    //var_dump($meta);
    $query = new WP_Query(array('post_type' => 'notes'));
    $posts = $query->posts;
    $note_data = array();
    foreach ($posts as $post) {
        $this_id = $post->ID;
        $meta = get_post_meta($this_id);

        $note_data["prod_id"] = $meta["notes_product_id"][0];
        $note_data["user_id"] = $meta["notes_user_id"][0];


        /*$string_data = implode(',', $note_data["product_id"]);*/
        //print_r($meta);
       // $note_data = json_encode($note_data);
        //print_r($note_data);
    }
    /*    if(in_array(array(get_the_id(), $current_user_id), $note_data)) {
            echo 'You have notes';
        } else {
            echo 'no notes';
        }*/


}
            //wp_reset_query();

add_action('notes_array', 'notes_array');
add_shortcode('notes_array', 'notes_array');



add_action( 'woocommerce_product_query', 'all_products_query' );
function all_products_query( $q ){
    $q->set( 'posts_per_page', -1 );
}
add_shortcode('profile_status','get_user_profile_status');
function get_user_profile_status($message) : string {
    $current_user_id = wp_get_current_user()->ID;
      $profiles_data = array(
              'post_type' => 'profiles'
      );
      $profiles_data = get_posts($profiles_data);

      foreach($profiles_data as $profile_data) {
         $user_ids[] = $profile_data->post_author;
      }
      if(in_array($current_user_id, $user_ids)) {
          $message = '<p style="color:#fff;background-color: green;padding:2px;font-size:11px;display:none;float:right;margin-right:20px;margin-top:-10px;">has profile</p>';
      } else {
          $message =  '<p style="color:#a80000;background-color: #fff;padding:2px;font-size:11px;display:none;float:right;margin-right:20px;margin-top:-10px;">Please add your profile </p>';
      }
      return $message;

}


add_shortcode('product_filter_tags','product_filter_tags');
    function product_filter_tags()
    {


        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'post_status' => 'publish',


        );
        $product_data = get_posts($args);
        $product_terms = array();
        foreach ($product_data as $product) {
            $product_id = $product->ID;
            $product_terms[] = get_field('artist', $product_id);
        }

        /*            $terms[] = wp_list_pluck($product_terms, "id");
                    $terms[] = wp_list_pluck($product_terms, "name");
                    $terms[] = wp_list_pluck($product_terms, "slug");*/
        $product_terms = implode(' , ', $product_terms);
        print_r($product_terms);
        //var_dump($product_terms);
        //  $product_data = new WP_Query($args);
        //$product_data = $product_data->get_products();
        //var_dump($product_data);
        /*        foreach($product_data as $product_id) {
                    $product = wc_get_product($product_id);
                    $product = $product->get_data();
                    $product_ids[] = $product['id'];


                }*/
        // var_dump($product_data);
    }
        add_shortcode('price_list_filter','price_list_filter');
        function price_list_filter() {
            $args = array(
                'post_type' => 'product',
                'status' => 'publish',
                'limit' => -1,
                'order' => 'ASC',
            );
            $product_data = wc_get_products($args); // Run the $arg through WC_Product_Query (just like WP_Query)
            $prices = array();
            foreach ($product_data as $the_product) {
                $prices[] = $the_product->price;
            }

            $price_list = array_unique($prices);

         foreach($price_list as $key => $value) {
                echo  '<a class="dropdown-item filter-dropdowns" style="color:#000!important;font-weight:700!important;border-bottom:1px solid #eee;" href="/?s=&price='. $value .'&post_type=product">£'. $value .'</a><br>';
            }
            //unset($value);
         //return $data;

        }

add_shortcode('choreographer_list_filter','choreographer_list_filter');
function choreographer_list_filter() {
    $args = array(
        'post_type' => 'product',
        'status' => 'publish',
        'posts_per_page' => -1,
    );
    $product_data_2 = get_posts($args);

    foreach ($product_data_2 as $product) {
        $product_ids[] = $product->ID;
    }
    $choreog = [];
    foreach($product_ids as $product_id1) {

        $chor_array = get_field('choreographer', $product_id1);
        $choreog[] = strval($chor_array[0]["ID"]);
    }

    $chor_unique = array_unique($choreog);

    foreach($chor_unique as $user_id) {
       // echo $chor;
    $meta = get_user_meta($user_id);

    $first_name = $meta["first_name"][0];
    $last_name = $meta["last_name"][0];
    $display_name = $meta["display_name"][0];
    $image = '<img src="https://panache.nic-edesign.com/wp-content/uploads/2021/10/dancer-2-e1622667179728-1.png" style="width:25px;">';
    //var_dump($profile_picture);
        if(!empty($display_name)) {
            $display_name = $meta["display_name"][0];
        }
    elseif(! empty($first_name) && empty($last_name)) {
        //$no_last_name = "Panache";
        $display_name = $first_name .' '.'Panache';
    } elseif(! empty($last_name)) {
            $display_name = $first_name .' '.$last_name;
    }

        echo '<a style="color:#000!important;font-weight:700!important;border-bottom:1px solid #eee" class="dropdown-item filter-dropdowns" href="/search/?choreographer=' . $user_id . '&n=' . $display_name. '">'. $image .'&nbsp;'. $display_name .'</a>';
    }

}
add_shortcode('pan_product_search_filter','pan_product_search_filter');
function pan_product_search_filter() {
    //global $wp_query;
    $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => -1,

    );
    $products = get_posts($args);
   // var_dump($products);
    ?>
    <div id="prod-search">
        <input class="search form-control" style="border-radius:5px!important;" type="text" id="myProdInput" onkeyup="myProdFunction()" placeholder=" search for choreography" title="Search for choreography">

<div id="results-wrap-product">
        <ul id="myProdUL">
    <?php

            //var_dump($addresses);
            foreach ($products as $product) { //loop through $addresses array and add each instance to $venue
                $product_id = $product->ID;
                $product_title = $product->post_title;
                $product_slug = $product->post_name;
                $product_price = $product->price;
                $choreographers = get_field('choreographer', $product_id);
                $tags = get_field('artist', $product_id);
                foreach($choreographers as $choreographer){
                    $c_name = $choreographer["display_name"];

                }
                $tags = get_field('artist', $product_id);
                foreach ($tags as $tag) {
                    $prod_tags =  $tag->name;
                    //var_dump($artist);
                }

                $url = '/product/'. $product_slug;
                echo '<li><a href="'. $url .'" style="padding-right:10px;"><span style="color:#f50a99;">'. $product_title . '</span> &nbsp;<span style="color:#2b2b2b;float:right;">£ ' . $product_price .'</span><br>
                      &nbsp;<span class="muted" style="font-size:11px;display:inline-block;font-weight: 600!important;">'. $prod_tags .'&nbsp;&nbsp;<img src="https://panache.nic-edesign.com/wp-content/uploads/2021/10/dancer-2-e1622667179728-1.png" style="width:15px;">'. $c_name .'</span></a></li>';
            }

        ?>

</ul>
</div>
</div>
    <?php
}

    ?>




<?php
/*function wws_register_query_vars($vars) {
            $vars[] = 'price';
            $vars[] = 'choreographer';
            return $vars;
}
add_filter('query_vars','wws_register_query_vars');*/





