  <?php
/**
 * Template name: rest password
 * 
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
?>
	<div class="container-fluid">
		<div class="row">
		  	
		<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 offset-lg-4 offset-xl-4">	 
		<div class="formcf">
		<h3>Lose something?</h3>
                                                <p>Enter your username or email to reset your password.</p>
                                                <form method="post"
                                                    action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>"
                                                    class="wp-user-form ">
                                                     <p class="form-group">
                                                        <label for="user_login"
                                                    ><?php _e('Username or Email'); ?>:
                                                        </label><br>
                                                        <input type="text" name="user_login" value="" size="20"
                                                            id="user_login" tabindex="1001" />
                                                    </p>
                                                     <p class="form-group">
                                                        <?php do_action('login_form', 'resetpass'); ?>
                                                        <input type="submit" name="user-submit"
                                                            value="<?php _e('Reset my password'); ?>"
                                                            class="user-submit" tabindex="1002" /><br>
                                                        <?php $reset = $_GET['reset']; if($reset == true) { echo '<p>A message will be sent to your email address.</p>'; } ?>
                                                        <input type="hidden" name="redirect_to"
                                                            value="<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>?reset=true" />
                                                        <input type="hidden" name="user-cookie" value="1" />
                                                    </p>
                                                </form>
                                                
                                                	</div>
	
	</div>
	
</div>

</div>
<?php 
get_footer();
