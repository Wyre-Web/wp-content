<?php
get_header();


/**
 * Fires following the 'Strength indicator' meter in the user password reset form.
 *
 * @since 3.9.0
 *
 * @param WP_User $user User object of the user whose password is being reset.
 */
$user = wp_get_current_user();
do_action( 'resetpass_form', $user );

?>
<input type="hidden" name="rp_key" value="<?php echo esc_attr( $rp_key ); ?>" />
<p class="submit reset-pass-submit">
    <button type="button" class="button wp-generate-pw hide-if-no-js" aria-expanded="true"><?php _e( 'Generate Password' ); ?></button>
    <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e( 'Save Password' ); ?>" />
</p>
</form>
</div>