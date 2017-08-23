<?php 

function urnext_create_posttypes() {
    register_post_type( 'gallery',
        array(
            'labels' => array(
                'name' => __( 'Gallery', 'urnext' ),
                'singular_name' => __( 'Gallery', 'urnext' )
            ),
            'public'        => false,
            'show_ui'       => true,
            'show_in_menu'  => true,
            'has_archive'   => false,
            'menu_position' => 21,
            'menu_icon'     => 'dashicons-images-alt',
            'hierarchical'  => false,
            'supports'      => array('title', 'editor', 'thumbnail', 'page-attributes')
        )
    );

    register_taxonomy( 'galleries', 'gallery', 
        array(
            'hierarchical'          => false,
            'labels'                => array(
                'name'              => _x( 'Galleries', 'taxonomy general name', 'urnext' ),
                'singular_name'     => _x( 'Gallery', 'taxonomy singular name', 'urnext' ),
            ),
            'show_ui'               => true,
            'show_admin_column'     => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var'             => false,
        )
    );

  }
  add_action( 'init', 'urnext_create_posttypes' );