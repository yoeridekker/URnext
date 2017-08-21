<?php 

/**
* Load requirements
*/
require_once('includes/urnext-options.php');

/**
* Register menu
*/
add_action( 'after_setup_theme', 'register_primary_menu' );
function register_primary_menu() {
   register_nav_menu( 'primary', __( 'Primary Menu', 'urnext' ) );
}

/**
* Enable post thumbnails
*/
add_theme_support( 'post-thumbnails' ); 

/**
* Enable post formats
*/
add_theme_support( 'post-formats', array( 'video', 'image' ) );

/**
* Proper way to enqueue scripts and styles.
*/
function urnext_load_scripts() {
    
    wp_enqueue_style( 'reset', get_template_directory_uri() . '/assets/css/reset.css' );
    wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
    wp_enqueue_style( 'animate-style', get_template_directory_uri() . '/assets/css/animate.css' );
    wp_enqueue_style( 'urnext-style', get_stylesheet_uri() );

    wp_enqueue_script( 'particles', get_template_directory_uri() . '/assets/js/particles.min.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'scrollify', get_template_directory_uri() . '/assets/js/scrollify.js', array('jquery'), '1.0.17', true );
    wp_enqueue_script( 'tether', get_template_directory_uri() . '/assets/js/tether.min.js', array('jquery'), '4.0.0', true );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.0.0', true );
    wp_enqueue_script( 'wow', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), '4.0.0', true );

    //wp_enqueue_script( 'fitcolumns', get_template_directory_uri() . '/assets/vendor/isotope/layout-modes/fit-columns.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/vendor/isotope/isotope.pkgd.js', array('jquery'), '1.0.0', true );

    wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'scrollify', 'bootstrap'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'urnext_load_scripts' );

add_filter('show_admin_bar', '__return_false');

/**
* Register our sidebars and widgetized areas.
*/
function urnext_widgets_init() {
    register_sidebar( 
        array(
            'name'          => 'Right sidebar',
            'id'            => 'right_sidebar',
            'before_widget' => '<div>',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="underline after-text-color faded wide">',
            'after_title'   => '</h2>',
        )
    );

}
add_action( 'widgets_init', 'urnext_widgets_init' );