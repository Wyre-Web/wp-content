<?php
/**
 * Plugin Name: WWS Become Dance Captain Enquiries Plugin
 * Description: This plugin contains custom functions.
 * Author: Wyre Web Solutions
 * Version: 0.1
 */

//Our custom post type function
function create_posttype_bdcenquiry() {
    register_post_type( 'dc-enquiries',
   // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Dance Captain Enquiries' ),
                'singular_name' => __( 'Dance Captain Enquiry' )
            ),
            'public' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
            'rewrite'           => array('slug' => 'dc-enquiries'),
             
  'taxonomies'          => array( 'category' ),
        
 
        )
    );
}
add_action( 'init', 'create_posttype_bdcenquiry');


function my_save_post_dc( $post_id ) {
	
	// bail early if not a contact_form post
	if( get_post_type($post_id) !== 'dc-enquiries' ) {
		return;
		}
	
	// bail early if editing in admin
	if( is_admin() ) {
			return;
			}
		// vars
		$toEmail = 'panachedancefitness@hotmail.com';
	//	$post_title = get_the_title( $post_id );
	
		$subject 	= "You have a new dance captain enquiry.";
			$post_url 	= get_permalink( $post_id );
		$message 	= "Click the link to view your entry form:\n\n";
	$message   .=  $post_url;// send email
	wp_mail($toEmail, $subject, $message  );
	
}

add_action('acf/save_post', 'my_save_post_dc');
