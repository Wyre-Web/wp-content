<?php
/**
 * Plugin Name: WWS Profile Plugin
 * Description: This plugin contains custom functions.
 * Author: Wyre Web Solutions
 * Version: 0.1
 */
//Our custom post type function
function create_posttype_profile() {
    register_post_type( 'profiles',
   // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Profiles' ),
                'singular_name' => __( 'Profile' )
            ),
            'public' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
            'rewrite'           => array('slug' => 'profiles'),
             'taxonomies'          => array( 'category' ),
            )
 
    );
}
add_action( 'init', 'create_posttype_profile');


/**
 * Rewrite author base to custom
 *
 * @return void
 */
function lwp_2610_author_base_rewrite() {
    global $wp_rewrite;
    $author_base_db = get_option( 'lwp_author_base' );
    if ( !empty( $author_base_db ) ) {
        $wp_rewrite->author_base = $author_base_db;
    }
}

add_action( 'init', 'lwp_2610_author_base_rewrite' );

/**
 * Render textinput for Author base
 * Callback for the add_settings_function()
 *
 * @return void
 */
function lwp_2610_author_base_render_field() {
    global $wp_rewrite;
    printf(
        '<input name="lwp_author_base" id="lwp_author_base" type="text" value="%s" class="regular-text code">',
        esc_attr( $wp_rewrite->author_base )
    );
}

/**
 * Add a setting field for Author Base to the "Optional" Section
 * of the Permalinks Page
 *
 * @return void
 */
function lwp_2610_author_base_add_settings_field() {
    add_settings_field(
        'lwp_author_base',
        esc_html__( 'Author base' ),
        'lwp_2610_author_base_render_field',
        'permalink',
        'optional',
        array( 'label_for' => 'lwp_author_base' )
    );
}

add_action( 'admin_init', 'lwp_2610_author_base_add_settings_field' );

/**
 * Sanitize and save the given Author Base value to the database
 *
 * @return void
 */
function lwp_2610_author_base_update() {
    $author_base_db = get_option( 'lwp_author_base' );

    if ( isset( $_POST['lwp_author_base'] ) &&
        isset( $_POST['permalink_structure'] ) &&
        check_admin_referer( 'update-permalink' )
    ) {
        $author_base = sanitize_title( $_POST['lwp_author_base'] );

        if ( empty( $author_base ) ) {
            add_settings_error(
                'lwp_author_base',
                'lwp_author_base',
                esc_html__( 'Invalid Author Base.' ),
                'error'
            );
        } elseif ( $author_base_db != $author_base ) {
            update_option( 'lwp_author_base', $author_base );
        }

    }
}

add_action( 'admin_init', 'lwp_2610_author_base_update' );