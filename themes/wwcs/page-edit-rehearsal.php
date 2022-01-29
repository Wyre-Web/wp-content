<?php
/*
 * Template Name: Add Rehearsal

 */
acf_form_head();
get_header(); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="container">
                    <div class="jumbotron">
                        <a href="<?php echo home_url() . '/dance-captain/' . get_the_author_meta( 'user_nicename', wp_get_current_user()->ID ); ?>" >Back to Profile</a>
                        <h1>Edit Rehearsal</h1>


                        <?php
                        if ( ! ( is_user_logged_in() || current_user_can('front_end_post') ) ) {
                            echo '<p>You must be a registered author to post.</p>';
                        } else {


                            acf_form(array(
                                'post_type' => 'rehearsals',
                                'post_id' => $_GET["id"],
                                'field_groups' => array(7778), // Used ID of the field groups here.
                                'post_title' => true, // This will show the title filed
                                'post_content' => false, // This will show the content field
                                'post_status' => 'publish',
                                'form' => true,
                                'honeypot' => true,
                                'return'			=> home_url() . '/dance-captain/' . get_the_author_meta( 'user_nicename', wp_get_current_user()->ID ).'/?id='.wp_get_current_user()->ID,
                                'submit_value' => 'Edit rehearsal', 'acf',
                            ));

                        }
                        ?>	<br>
                    </div><!-- #primary -->

                </div>
            </div>
        </div>
    </div>
<?php

get_footer();