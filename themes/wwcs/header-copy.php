<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wwcs
 */
global $current_user, $wp_roles;
get_currentuserinfo();
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@700&family=Quicksand:wght@300&display=swap" rel="stylesheet">
	<?php wp_head();
    global $woocommerce;
    $count = $woocommerce->cart->cart_contents_count;
    $nonce = wp_create_nonce('logout-' . $current_user->ID);
    ?>

</head>


<body>
<?php wp_body_open(); ?>
<div id="page" class="site">
<!-- <a class="sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'wwcs' ); ?></a> -->

	<header id="masthead" class="site-header">
 <div class="container-fluid top-bar" style="margin:0;padding:0;">
		      <div class="row">
                  <div class="col-md-4 text-left">
                      <a class="navbar-brand" href="/"><img style="width:45%;" src="/wp-content/uploads/2021/09/panache_logo.png"></a>
                  </div>
                  <div class="col-md-5 text-center" style="padding-top:1.5em;">
                     <?php echo do_shortcode("[wws_return_location_data]") ?>
                  </div>
		          <div class="col-md-3 pt-1 text-right dancer">


                      <ul class="navbar-nav">
                          <li class="nav-item d-inline float-right">
                            <?php
                            global $user_ID,
                                   $user_identity;
                            if (!$user_ID) { ?>
                        <a class="btn btn-watch loginbtn" href="/login/">Log in </a></div>

                        </div>
                        <?php }

                            if($user_ID && $user_ID != 0) { // is logged in ?>
                     
                            <p class="text-white" style="display: inline-block;float:right;padding-right: 50px;font-size:18px;">  Hi <?php
                                //print_r($current_user);
                                echo $current_user->user_login; ?>
                                  <a title="Your profile page" href="<?php echo home_url() . '/dance-captain/' . get_the_author_meta( 'user_login', wp_get_current_user()->ID ); ?>" >
                                      <img src="/wp-content/uploads/2021/10/dancer-2-e1622667179728-1.png" alt="Blue dancer silhouette graphical icon" style="width:30px;"></a>
                              <?php

                              if($count < 1)
                              {
                                  ?>
                                  <span style="margin-left: 6px;margin-right: 6px;color:#fff;">|</span>
                                  <i class="fas fa-shopping-basket" title="basket is empty" style="color:hotpink;opacity:0.8;"></i>
                                 <!-- <a title="Cart Empty"><img src="/wp-content/uploads/2021/09/cart-73-24.png"></a>-->
                              <?php } else { ?>
                                  <span style="margin-left: 6px;margin-right: 6px;color:#fff;">|</span>
                                  <a data-toggle="modal" data-target="#cartModal"><i class="fas fa-shopping-basket" style="color:hotpink;"></i><sup style="color:#fff;padding:2px;"><?php echo $woocommerce->cart->cart_contents_count ?></sup></a>

                              <?php } ?>
                                <span style="margin-left: 6px;margin-right: 6px;color:#fff;">|</span>
        <!--                        <form method="post" action="/logout">
                                    <?php /*wp_nonce_field( 'name_of_my_action', 'name_of_nonce_field' ); */?>
                                </form>-->
                                <a style="font-size: 12px;" href="https://panachedancefitness.com/logout/?action=logout">Logout?</a>
                            </p>
                          <?php } ?>
                          </li>

                      </ul>
     <br>


		          </div>
		      </div>
      <nav class="navbar navbar-expand-md navbar-dark oneb" role="navigation">
                     <button class="navbar-toggler" type="button" data-toggle="collapse"
                         data-target="#bs-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1"
                         aria-expanded="false"
                         aria-label="<?php esc_attr_e( 'Toggle navigation', 'your-theme-slug' ); ?>">
                         <span class="navbar-toggler-icon"></span>
                     </button>
                   
                         <div class="navstyle">
                             <?php
                                wp_nav_menu( array(
                                    'theme_location'    => 'primary',
                                    'depth'             => 2,
                                    'container'         => 'div',
                                    'container_class'   => 'collapse navbar-collapse',
                                    'container_id'      => 'bs-navbar-collapse-1',
                                    'menu_class'        => 'navbar-nav mr-auto',
                                    'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                                    'walker'            => new WP_Bootstrap_Navwalker(),
                                    ) ); ?>
                         </div>
                   
                 </nav>

    </header>

</div>



