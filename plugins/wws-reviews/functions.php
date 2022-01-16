<?php
/**
 * Plugin Name: WWS Gold Star Reviews Plugin
 * Description: This plugin contains custom functions.
 * Author: Wyre Web Solutions
 * Version: 0.1
 */
//Our custom post type function
function create_posttype_reviews() {
    register_post_type( 'reviews',
   // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Reviews' ),
                'singular_name' => __( 'Review' )
            ),
            'public' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array(  'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
            'rewrite'           => array('slug' => 'reviews'),
              'taxonomies'          => array( 'category' ),
            ));
}
add_action( 'init', 'create_posttype_reviews');

add_filter( 'the_excerpt', function( $excerpt ) {
    $your_field = get_post_meta( get_the_ID(), get_field('re_review'), true );

    return $excerpt . $your_field;
} ); 
//add_filter( 'the_excerpt', function( $excerpt ) {
    // Get the current taxonomy term
 //   $term = get_queried_object(); 
//    // get the field named your_custom_field
//    $the_custom_field = get_field('re_review', $term);
    // return the excerpt followed by the_custom_field value
 //   return $excerpt . $the_custom_field; 
//} );
