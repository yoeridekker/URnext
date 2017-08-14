<?php 


/**
* Proper way to enqueue scripts and styles.
*/
function urnext_load_scripts() {
   wp_enqueue_style( 'urnext-style', get_stylesheet_uri() );
   wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
   wp_enqueue_style( 'animate-style', get_template_directory_uri() . '/assets/css/animate.css' );
  
   wp_enqueue_script( 'particles', get_template_directory_uri() . '/assets/js/particles.min.js', array('jquery'), '1.0.0', true );
   wp_enqueue_script( 'scrollify', get_template_directory_uri() . '/assets/js/scrollify.js', array('jquery'), '1.0.17', true );
   wp_enqueue_script( 'tether', get_template_directory_uri() . '/assets/js/tether.min.js', array('jquery'), '4.0.0', true );
   wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.0.0', true );

   wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'scrollify', 'bootstrap'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'urnext_load_scripts' );

add_filter('show_admin_bar', '__return_false');