<?php
/**
 * Template name: Register
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lodc
 */

get_header();

global $wpdb, $user_ID;  
//Check whether the user is already logged in  
if ($user_ID) 
{  
   
    // They're already logged in, so we bounce them back to the homepage.  
   
    header( 'Location:' . home_url() );  
   
} else
 {  

  
?>  
  	<div id="div" class="site-main container-fluid">
		<div class="row">
		
		<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 offset-lg-4 offset-xl-4">	
		
		<div class="jumbotron pinky">
		    	<h1 class="text-center">Register</h1>
	<div class="formcf">
	    
                                                <form method="post" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" class="wp-user-form">
                                <div class="login-username">
                                        <label for="user_login"><?php _e('Username'); ?>: </label>
                                        <input type="text" name="user_login" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_login" tabindex="101" />
                                </div>
                                <div class="login-password">
                                        <label for="user_email"><?php _e('Your Email'); ?>: </label>
                                        <input type="text" name="user_email" value="<?php echo esc_attr(stripslashes($user_email)); ?>" size="25" id="user_email" tabindex="102" />
                                </div>
                                <div class="login_fields">
                                        <?php do_action('register_form'); ?>
                                        <input type="submit" name="user-submit" value="<?php _e('Sign up!'); ?>" class="user-submit" tabindex="103" />
                                        <?php $register = $_GET['register']; if($register == true) { echo '<p>Check your email to set your password!</p>'; } ?>
                                        <input type="hidden" name="redirect_to" value="<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>?register=true" />
                                        <input type="hidden" name="user-cookie" value="1" />
                                </div>
                        </form>
  </div>  </div>  </div></div>  </div>
<?php }
get_footer(); ?>