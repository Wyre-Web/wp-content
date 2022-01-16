<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package 
 */

get_header();
$user_id = wp_get_current_user()->ID;
$nonce = wp_create_nonce('login-' . $user_id);


?>
  	<div class="container-fluid">
		<div class="row">
		  
		<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 offset-lg-4 offset-xl-4 jumbotron">	
	
		       		<?php
                    $args = array(
                       'echo' => 'true',
                      'redirect' => 'https://panachedancefitness.com/choreography-store/',
                    );
                    wp_login_form($args);

		?>
           <p style="font-family: 'PT Sans', sans-serif;font-size:16px;font-weight: 700;">Forgot password? Click <a href="/reset-password">here</a> to reset.</p>

  </div>  </div>  </div>
<?php
get_footer();
