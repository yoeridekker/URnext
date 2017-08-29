<?php 
/**
* Set defines
*/
define('WOOCOMMERCE_USE_CSS', false);

/**
* Load requirements
*/

//define( 'ACF_LITE', true );
require_once('plugins/advanced-custom-fields/acf.php');
require_once('includes/acf.php');
require_once('includes/post-types.php');
require_once('includes/urnext-options.php');
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
* Register theme globals
*/
global $urnext_theme_globals;
$urnext_theme_globals = array();

add_action( 'wp', 'register_theme_globals' );
function register_theme_globals() {
    global $urnext_options, $urnext_theme_globals;
    foreach( $urnext_options as $urnext_option ){
        foreach( $urnext_option['settings'] as $setting => $details ){
            $value = get_theme_mod($setting);
            $urnext_theme_globals[ $setting ] = ( $value === '' && isset( $details['default'] ) ) ? $details['default'] : $value ;
        }
    }
}

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
* Enable title tag
*/
add_theme_support( 'title-tag' );

/**
* Enable post formats
*/
add_theme_support( 'post-formats', array( 'video', 'image' ) );

/**
* Enable woocommerce
*/
add_theme_support( 'woocommerce' );
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

add_filter( 'woocommerce_breadcrumb_defaults', 'urnext_change_breadcrumb_wrap' );
function urnext_change_breadcrumb_wrap( $defaults ) {
    $defaults['wrap_before'] = '<div class="text-color woocommerce-breadcrumb col-md-12" itemprop="breadcrumb">';
    $defaults['wrap_after']  = '</div>';
	return $defaults;
}

/**
* Check if woocommerce is active
*/
define('URNEXT_WOOCOMMERCE_ACTIVE', is_plugin_active( 'woocommerce/woocommerce.php') );

/**
* Proper way to enqueue scripts and styles.
*/
function urnext_load_scripts() {
    
    global $urnext_theme_globals;

    wp_enqueue_style( 'reset', get_template_directory_uri() . '/assets/css/reset.css' );
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css' );

    wp_enqueue_style( 'featherlight', get_template_directory_uri() . '/assets/css/featherlight.css' );
    wp_enqueue_style( 'eatherlight-gallery', get_template_directory_uri() . '/assets/css/featherlight.gallery.css' );

    wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css' );
    wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
    wp_enqueue_style( 'animate-style', get_template_directory_uri() . '/assets/css/animate.css' );
    wp_enqueue_style( 'urnext-style', get_stylesheet_uri() );

    if( URNEXT_WOOCOMMERCE_ACTIVE ){
        wp_enqueue_style( 'woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css' );
    }
    
    wp_enqueue_script( 'featherlight', get_template_directory_uri() . '/assets/js/featherlight.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'featherlight-gallery', get_template_directory_uri() . '/assets/js/featherlight.gallery.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'fittext', get_template_directory_uri() . '/assets/js/fittext.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), '1.0.0', true );
    
    // Only load particles if we need it
    if( $urnext_theme_globals['particles_js'] ){
        wp_enqueue_script( 'particles', get_template_directory_uri() . '/assets/js/particles.min.js', array('jquery'), '1.0.0', true );
    }
    wp_enqueue_script( 'scrollify', get_template_directory_uri() . '/assets/js/scrollify.js', array('jquery'), '1.0.17', true );
    wp_enqueue_script( 'tether', get_template_directory_uri() . '/assets/js/tether.min.js', array('jquery'), '4.0.0', true );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.0.0', true );
    wp_enqueue_script( 'wow', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), '4.0.0', true );

    // Use isotope for archive grids
    wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/vendor/isotope/isotope.pkgd.js', array('jquery'), '1.0.0', true );

    // Load the main js file
    wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'scrollify', 'bootstrap'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'urnext_load_scripts' );


/**
* Register our sidebars and widgetized areas.
*/
function urnext_widgets_init() {

    // Register right sidebar area
    register_sidebar( 
        array(
            'name'          => __('Right sidebar', 'urnext'),
            'id'            => 'right_sidebar',
            'before_widget' => '<div>',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="underline after-text-color faded wide">',
            'after_title'   => '</h2>',
        )
    );

    // Register left sidebar area
    register_sidebar( 
        array(
            'name'          => __('Left sidebar', 'urnext'),
            'id'            => 'left_sidebar',
            'before_widget' => '<div>',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="underline after-text-color faded wide">',
            'after_title'   => '</h2>',
        )
    );

    // Register left footer area
    register_sidebar( 
        array(
            'name'          => __('Left footer', 'urnext'),
            'id'            => 'left_footer',
            'before_widget' => '<div class="footer-text-color">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="underline after-footer-text-color footer-text-color faded wide">',
            'after_title'   => '</h3>',
        )
    );

    // Register left middle footer area
    register_sidebar( 
        array(
            'name'          => __('Middle left footer', 'urnext'),
            'id'            => 'middle_left_footer',
            'before_widget' => '<div class="footer-text-color">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="underline after-footer-text-color footer-text-color faded wide">',
            'after_title'   => '</h3>',
        )
    );

    // Register middle footer area
    register_sidebar( 
        array(
            'name'          => __('Middle right footer', 'urnext'),
            'id'            => 'middle_right_footer',
            'before_widget' => '<div class="footer-text-color">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="underline after-text-color footer-text-color faded wide">',
            'after_title'   => '</h3>',
        )
    );


    // Register right footer area
    register_sidebar( 
        array(
            'name'          => __('Right footer', 'urnext'),
            'id'            => 'right_footer',
            'before_widget' => '<div class="footer-text-color">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="underline after-text-color footer-text-color faded wide">',
            'after_title'   => '</h3>',
        )
    );

    // Register shop sidebar area
    register_sidebar( 
        array(
            'name'          => __('Shop sidebar', 'urnext'),
            'id'            => 'shop',
            'before_widget' => '<div class="">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="underline after-text-color footer-text-color faded wide">',
            'after_title'   => '</h3>',
        )
    );

}
add_action( 'widgets_init', 'urnext_widgets_init' );