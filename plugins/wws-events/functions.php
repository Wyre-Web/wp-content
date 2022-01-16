<?php
/**
 * Plugin Name: WWS Events Plugin
 * Description: This plugin contains custom functions.
 * Author: Wyre Web Solutions
 * Version: 0.1
 */



//Our custom post type function
function create_posttype_events() {
    register_post_type( 'events',
   // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Events' ),
                'singular_name' => __( 'Event' )
            ),
            'public' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
            'rewrite'           => array('slug' => 'events'),
       
 
        )
    );
}

add_action( 'init', 'create_posttype_events' );






 function events_tag() {
    register_taxonomy_for_object_type('post_tag', 'events');
 }
add_action('init', 'events_tag');



//////////////////
function acf_set_featured_image( $value, $post_id, $field  ){
    
    if($value != ''){
	    //Add the value which is the image ID to the _thumbnail_id meta data for the current post
	    add_post_meta($post_id, '_thumbnail_id', $value);
    }
     return $value;
}
// acf/update_value/name={$field_name} - filter for a specific field based on it's name
add_filter('acf/update_value/name=picture', 'acf_set_featured_image', 10, 3);

