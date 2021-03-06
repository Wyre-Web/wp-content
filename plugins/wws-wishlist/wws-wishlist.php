<?php
/*
    Plugin Name: WWS Woocommerce wishlist & favourites
    Plugin URI:
    Description: Custom Ajax wishlist for WooCommerce
    Author: Wyre Web Solutions
    Version: 1.0
    Author URI: Danielo Moretti
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/*
    1. Add wishlist to product
    2. Wishlist table shortcode
    3. Wishlist option in the user profile
    4. Extend rest API for products
*/



add_action('init','plugin_init');
function plugin_init(){
    if (class_exists("Woocommerce")) {

        function wishlist_plugin_scripts_styles(){
            wp_enqueue_style( 'wishlist-style', plugins_url('/css/style.css', __FILE__ ), array(), '1.0.0' );
            wp_enqueue_script( 'wishlist-main', plugins_url('/js/main.js', __FILE__ ), array('jquery'), '', true);
            wp_localize_script(
                'wishlist-main',
                'opt',
                array(
                    'ajaxUrl'        => admin_url('admin-ajax.php'),
                    'ajaxPost'       => admin_url('admin-post.php'),
                    'restUrl'        => rest_url('wp/v2/product'),
                    'shopName'       => sanitize_title_with_dashes(sanitize_title_with_dashes(get_bloginfo('name'))),
                    'inWishlist'     => esc_html__("Already in wishlist","text-domain"),
                    'removeWishlist' => esc_html__("Remove from wishlist","text-domain"),
                    'buttonText'     => esc_html__("Details","text-domain"),
                    'error'          => esc_html__("Something went wrong, could not add to wishlist","text-domain"),
                    'noWishlist'     => esc_html__("No wishlist found","text-domain"),
                )
            );
        }
        add_action( 'wp_enqueue_scripts', 'wishlist_plugin_scripts_styles' );

        // Get current user data
        function fetch_user_data() {

            if (is_user_logged_in()){
                $current_user = wp_get_current_user();
                $current_user_wishlist = get_user_meta( $current_user->ID, 'wishlist',true);
                echo json_encode(array('user_id' => $current_user->ID,'wishlist' => $current_user_wishlist));
            }
            die();
        }
        add_action( 'wp_ajax_fetch_user_data', 'fetch_user_data' );
        add_action( 'wp_ajax_nopriv_fetch_user_data', 'fetch_user_data' );

        // Add wishlist to product
        add_action('woocommerce_before_shop_loop_item','wishlist_toggle',15);
        add_action('wishlist_toggle',25);
        function wishlist_toggle(){

                echo '<span class="wishlist-title float-right">' . esc_attr__("Add to wishlist", "text-domain") . '</span><a class="wishlist-toggle" style="float: right!important;padding:5px!important" data-product="' . esc_attr($product_id) . '" href="#" title="' . esc_attr__("Add to wishlist", "text-domain") . '"><i style="font-size:20px;color:#fff;opacity: 0.6;" class="far fa-heart"></i></a>';
 
        }

        // Wishlist option in the user profile
        add_action( 'show_user_profile', 'wishlist_user_profile_field' );
        add_action( 'edit_user_profile', 'wishlist_user_profile_field' );
        function wishlist_user_profile_field( $user ) { ?>
            <table class="form-table wishlist-data">
                <tr>
                    <th><?php echo esc_attr__("Wishlist","text-domain"); ?></th>
                    <td>
                        <input type="text" name="wishlist" id="wishlist" value="<?php echo esc_attr( get_the_author_meta( 'wishlist', $user->ID ) ); ?>" class="regular-text" />
                    </td>
                </tr>
            </table>
        <?php }

        add_action( 'personal_options_update', 'save_wishlist_user_profile_field' );
        add_action( 'edit_user_profile_update', 'save_wishlist_user_profile_field' );
        function save_wishlist_user_profile_field( $user_id ) {
            if ( !current_user_can( 'edit_user', $user_id ) ) {
                return false;
            }
            update_user_meta( $user_id, 'wishlist', $_POST['wishlist'] );
        }

        function update_wishlist_ajax(){
            if (isset($_POST["user_id"]) && !empty($_POST["user_id"])) {
                $user_id   = $_POST["user_id"];
                $user_obj = get_user_by('id', $user_id);
                if (!is_wp_error($user_obj) && is_object($user_obj)) {
                    update_user_meta( $user_id, 'wishlist', $_POST["wishlist"]);
                }
            }
            die();
        }
        add_action('admin_post_nopriv_user_wishlist_update', 'update_wishlist_ajax');
        add_action('admin_post_user_wishlist_update', 'update_wishlist_ajax');

        // Wishlist table shortcode
        add_shortcode('wishlist', 'wishlist');
        function wishlist( $atts, $content = null ) {

            extract(shortcode_atts(array(), $atts));

            return '<table class="wishlist-table table-striped table-hover loading">
                
                        <tr>
                      
                            <th>'.esc_html__("Name","text-domain").'</th>
                            <th>'.esc_html__("Price","text-domain").'</th>
                            
                            <th><!-- Left for button --></th>
                        </tr>
                    </table>';

        }

        // Extend REST API
        function rest_register_fields(){

            register_rest_field('product',
                'price',
                array(
                    'get_callback'    => 'rest_price',
                    'update_callback' => null,
                    'schema'          => null
                )
            );
        }
        add_action('rest_api_init','rest_register_fields');

        function rest_price($object,$field_name,$request){

            global $product;

            $id = $product->get_id();

            if ($id == $object['id']) {
                return $product->get_price();
            }

        }


        function maximum_api_filter($query_params) {
            $query_params['per_page']["maximum"]=100;
            return $query_params;
        }
        add_filter('rest_product_collection_params', 'maximum_api_filter');
    }
}

