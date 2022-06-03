<?php
/**
 * wwcs functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wwcs
 */

/**
 * Enqueue scripts and styles.
 */
function wwcs_scripts() {
    
wp_enqueue_style( 'wwcs-style',   get_stylesheet_directory_uri() . '/style.css');

 
wp_enqueue_style( 'wwcs-bs4', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css');

wp_enqueue_style( 'wwcs-fa', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css');
//wp_enueue_script( 'wwcs-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', true );
wp_enqueue_script( 'wwcs-bs4', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js', array('jquery'), '', true );
wp_enqueue_script( 'wwcs-popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', array('jquery'), '', true );

if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
}
}
add_action( 'wp_enqueue_scripts', 'wwcs_scripts' );


if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'wwcs_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wwcs_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on wwcs, use a find and replace
		 * to change 'wwcs' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wwcs', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
	


		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
			    'author',
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'wwcs_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'wwcs_setup' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wwcs_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wwcs_content_width', 640 );
}
add_action( 'after_setup_theme', 'wwcs_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wwcs_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wwcs' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wwcs' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar( array(
			'name' => 'Footer Sidebar 1',
			'id' => 'footer-sidebar-1',
			'description' => 'Appears in the footer area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
			) );
			register_sidebar( array(
			'name' => 'Footer Sidebar 2',
			'id' => 'footer-sidebar-2',
			'description' => 'Appears in the footer area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
			) );
			register_sidebar( array(
			'name' => 'Footer Sidebar 3',
			'id' => 'footer-sidebar-3',
			'description' => 'Appears in the footer area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
			) );
					register_sidebar( array(
			'name' => 'Footer Sidebar 4',
			'id' => 'footer-sidebar-4',
			'description' => 'Appears in the footer area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
			) );
			register_sidebar( array(
			'name' => 'Filter-area-1',
			'id' => 'filter-area-1',
			'description' => 'Appears in the footer area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
			) );
				register_sidebar( array(
			'name' => 'Filter-area-2',
			'id' => 'filter-area-2',
			'description' => 'Appears in the footer area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
			) );
				register_sidebar( array(
			'name' => 'Filter-area-3',
			'id' => 'filter-area-3',
			'description' => 'Appears in the footer area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
			) );
				register_sidebar( array(
			'name' => 'Filter-area-4',
			'id' => 'filter-area-4',
			'description' => 'Appears in the footer area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
			) );
}
add_action( 'widgets_init', 'wwcs_widgets_init' );



function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'wwcs' ),
   'unprimary' => __('unprimary', 'wwcs' ),
) );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/////////////
//add_action( 'wp_login_failed', 'front_end_login_fail' );  // hook failed login
//
//function front_end_login_fail( $username ) {
//	$referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come //from?
	// if there's a valid referrer, and it's not the default log-in screen
//	if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
///		wp_redirect( $referrer . '?login=failed' );  // redirect back to referrer with appended URL (will be https://panache.nic-edesign.com/login/?login=failed )
//		exit;
//	}
//}


// After setup theme hook adds WC support
function wwcs_add_woocommerce_support() {
    add_theme_support( 'woocommerce' ); // <<<< here
}
add_image_size( 'profile-size', 160, 160, true ); // 220 pixels wide by 180 pixels tall, hard crop mode
if ( has_post_thumbnail() ) { 
    the_post_thumbnail( 'profile-size' ); 
}

add_filter('acf/load_value/name=dc_profile_image', 'my_acf_load_value', 10, 3);
////////////////////////
function acf_set_featured_image_profile( $value, $post_id, $field  ){
    
    if($value != ''){
	    //Add the value which is the image ID to the _thumbnail_id meta data for the current post
	    add_post_meta($post_id, '_thumbnail_id', $value);
    }
     return $value;
}
add_filter('acf/update_value/name=dc_profile_picture', 'acf_set_featured_image_profile', 10, 3);

add_filter( 'wp_mail_from', 'wpse_new_mail_from' );     
function wpse_new_mail_from( $old ) {
    return 'pananchedancefitness@hotmail.com'; // Edit it with your email address
}

add_filter('wp_mail_from_name', 'wpse_new_mail_from_name');
function wpse_new_mail_from_name( $old ) {
    return 'Pananche Dance Fitness'; // Edit it with your/company name
}





// returns longitude and latitude from a location
function wwcs_get_lat_and_lng($origin){
    $api_key = "AIzaSyDRVC9kCSkVuwRSC8bX-9_17qxFtK9YZZA";
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($origin)."&key=".$api_key;
    $result_string = file_get_contents($url);
    ?>
<?php
    $result = json_decode($result_string, true);
    $result1[]=$result['results'][0];
    $result2[]=$result1[0]['geometry'];
    $result3[]=$result2[0]['location'];
    return $result3[0];
}
function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyDRVC9kCSkVuwRSC8bX-9_17qxFtK9YZZA');
}
add_action('acf/init', 'my_acf_init');


function w4dev_get_terms_orderby( $orderby, $args ) {
    if ( ! empty( $args['include'] ) && empty( $orderby ) ) {
        $ids = implode(',', array_map('absint', $args['include']) );
         $days = get_field('re_days');
	                
        $orderby = get_the_terms($days->post_id, 'post_tag');
    }
    return $orderby;
}
add_filter( 'get_terms_orderby', 'w4dev_get_terms_orderby', 10, 2 );


//function new_login_redirect( $redirect_to, $request, $user ){
  //  return home_url('/choreography-store');
//}
//add_filter( 'login_redirect', 'new_login_redirect', 10, 3 );



add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}


function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/css/images/panachelogo.png);
		height:130px;
		width:260px;
		background-size: 260px 130px;
		background-repeat: no-repeat;
        	padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/style-login.css' );

}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );




add_action( 'login_form_lostpassword', array(  'redirect_to_custom_lostpassword'));


/**
 * Redirects the user to the custom "Forgot your password?" page instead of
 * wp-login.php?action=lostpassword.
 */
 function redirect_to_custom_lostpassword() {
    if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
        if ( is_user_logged_in() ) {
            $this->redirect_logged_in_user();
            exit;
        }

        wp_redirect( home_url( 'reset-password' ) );
        exit;
    }
}


/**
 * Returns the message body for the password reset mail.
 * Called through the retrieve_password_message filter.
 *
 * @param string  $message    Default mail message.
 * @param string  $key        The activation key.
 * @param string  $user_login The username for the user.
 * @param WP_User $user_data  WP_User object.
 *
 * @return string   The mail message to send.
 */
 function replace_retrieve_password_message( $message, $key, $user_login, $user_data ) {
    // Create new message
    $msg  = __( 'Hello!', 'custom-login' ) . "\r\n\r\n";
    $msg .= sprintf( __( 'You asked us to reset your password for your account using the email address %s.', 'custom-login' ), $user_login ) . "\r\n\r\n";
    $msg .= __( "If this was a mistake, or you didn't ask for a password reset, just ignore this email and nothing will happen.", 'custom-login' ) . "\r\n\r\n";
    $msg .= __( 'To reset your password, visit the following address:', 'custom-login' ) . "\r\n\r\n";
    $msg .= site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' ) . "\r\n\r\n";
    $msg .= __( 'Thanks!', 'custom-login' ) . "\r\n";

    return $msg;
}

add_action( 'login_form_rp', array( 'redirect_to_custom_password_reset' ) );
add_action( 'login_form_resetpass', array( 'redirect_to_custom_password_reset'));
 function redirect_to_custom_password_reset() {
    if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
        // Verify key / login combo
        $user = check_password_reset_key( $_REQUEST['key'], $_REQUEST['login'] );
        if ( ! $user || is_wp_error( $user ) ) {
            if ( $user && $user->get_error_code() === 'expired_key' ) {
                wp_redirect( home_url( 'login?login=expiredkey' ) );
            } else {
                wp_redirect( home_url( 'login?login=invalidkey' ) );
            }
            exit;
        }

        $redirect_url = home_url( 'password-reset' );
        $redirect_url = add_query_arg( 'login', esc_attr( $_REQUEST['login'] ), $redirect_url );
        $redirect_url = add_query_arg( 'key', esc_attr( $_REQUEST['key'] ), $redirect_url );

        wp_redirect( $redirect_url );
        exit;
    }
}
add_action( 'login_form_rp', array(  'do_password_reset' ) );
add_action( 'login_form_resetpass', array(  'do_password_reset' ));

/**
 * Resets the user's password if the password reset form was submitted.
 */
function do_password_reset() {
    if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
        $rp_key = $_REQUEST['rp_key'];
        $rp_login = $_REQUEST['rp_login'];

        $user = check_password_reset_key( $rp_key, $rp_login );

        if ( ! $user || is_wp_error( $user ) ) {
            if ( $user && $user->get_error_code() === 'expired_key' ) {
                wp_redirect( home_url( 'login?login=expiredkey' ) );
            } else {
                wp_redirect( home_url( 'login?login=invalidkey' ) );
            }
            exit;
        }

        if ( isset( $_POST['pass1'] ) ) {
            if ( $_POST['pass1'] != $_POST['pass2'] ) {
                // Passwords don't match
                $redirect_url = home_url( 'password-reset' );

                $redirect_url = add_query_arg( 'key', $rp_key, $redirect_url );
                $redirect_url = add_query_arg( 'login', $rp_login, $redirect_url );
                $redirect_url = add_query_arg( 'error', 'password_reset_mismatch', $redirect_url );

                wp_redirect( $redirect_url );
                exit;
            }

            if ( empty( $_POST['pass1'] ) ) {
                // Password is empty
                $redirect_url = home_url( 'password-reset' );

                $redirect_url = add_query_arg( 'key', $rp_key, $redirect_url );
                $redirect_url = add_query_arg( 'login', $rp_login, $redirect_url );
                $redirect_url = add_query_arg( 'error', 'password_reset_empty', $redirect_url );

                wp_redirect( $redirect_url );
                exit;
            }

            // Parameter checks OK, reset password
            reset_password( $user, $_POST['pass1'] );
            wp_redirect( home_url( 'login?password=changed' ) );
        } else {
            echo "Invalid request.";
        }

        exit;
    }
}

//Adding Alphabetical sorting option to shop and product settings pages
function sip_alphabetical_shop_ordering( $sort_args ) {
$orderby_value = isset( $_GET['orderby'] ) ? woocommerce_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
if ( 'alphabetical' == $orderby_value ) {
$sort_args['orderby'] = 'title';
$sort_args['order'] = 'asc';
$sort_args['meta_key'] = '';
}
return $sort_args;
}
add_filter( 'woocommerce_get_catalog_ordering_args', 'sip_alphabetical_shop_ordering' );



function sip_custom_wc_catalog_orderby( $sortby ) {
$sortby['alphabetical'] = 'Sort by Name: Alphabetical';
return $sortby;
}
add_filter( 'woocommerce_default_catalog_orderby_options', 'sip_custom_wc_catalog_orderby' );
add_filter( 'woocommerce_catalog_orderby', 'sip_custom_wc_catalog_orderby' );