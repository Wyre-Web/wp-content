<?php
/**
 * Plugin Name: WWS Training Days Plugin
 * Description: This plugin contains custom functions.
 * Author: Wyre Web Solutions
 * Version: 0.1
 */

//Our custom post type function
function create_posttype_trainingdays() {
    register_post_type( 'training-days',
   // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Training Days' ),
                'singular_name' => __( 'Training Day' )
            ),
            'public' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
            'rewrite'           => array('slug' => 'training-days'),
             
  'taxonomies'          => array( 'category' ),
        
 
        )
    );
}
add_action( 'init', 'create_posttype_trainingdays');
