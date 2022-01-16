<?php
/**
 * Plugin Name: WWS Rehearsals Plugin
 * Description: This plugin contains custom functions.
 * Author: Wyre Web Solutions
 * Version: 0.1
 */
//Our custom post type function


//require get_template_directory() . 'templates/page-form-tuesday.php';


function create_posttype_rehearsals() {
    register_post_type( 'rehearsals',
   // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Rehearsals' ),
                'singular_name' => __( 'Rehearsal' )
            ),
            'public' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
            'rewrite'           => array('slug' => 'rehearsals'),
              'taxonomies'          => array( 'category' ),
            ));
}
add_action( 'init', 'create_posttype_rehearsals');


function rehearsals_tag() {   
  register_taxonomy_for_object_type('post_tag', 'rehearsals');
}
add_action('init', 'rehearsals_tag');


function se339534_author_any_post_types ($query ) {

    // apply changes only for author archive page
    if ( ! is_author() || ! $query->is_main_query() )
        return;

    $query->set('post_type', 'any');
}
add_action( 'pre_get_posts', 'se339534_author_any_post_types' );

