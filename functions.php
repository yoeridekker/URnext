<?php 
/**
* Set defines
*/
define('WOOCOMMERCE_USE_CSS', false);

/**
* Load requirements
*/

//define( 'ACF_LITE', true );
require_once('includes/theme-options.php');
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

if ( ! isset( $content_width ) ) {
	$content_width = 1140;
}

$args = array(
	'flex-width'    => true,
	'width'         => 1600,
	'flex-height'    => true,
	'height'        => 800,
	'default-image' => get_template_directory_uri() . '/images/header.jpg',
);
add_theme_support( 'custom-header', $args );
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
add_theme_support( 'post-formats', array( 'video', 'image', 'aside' ) );

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
if ( class_exists( 'woocommerce' ) ) { 
    define('URNEXT_WOOCOMMERCE_ACTIVE', true ); 
} else {
    define('URNEXT_WOOCOMMERCE_ACTIVE', false ); 
}

/**
* Proper way to enqueue scripts and styles.
*/
function urnext_load_scripts() {
    
    global $urnext_theme_globals;

    wp_enqueue_style( 'urnext-reset', get_template_directory_uri() . '/assets/css/reset.css' );
    wp_enqueue_style( 'urnext-slick', get_template_directory_uri() . '/assets/css/slick.css' );
    wp_enqueue_style( 'urnext-tooltip', get_template_directory_uri() . '/assets/css/tooltipster.css' );
    
    wp_enqueue_style( 'urnext-featherlight', get_template_directory_uri() . '/assets/css/featherlight.css' );
    wp_enqueue_style( 'urnext-eatherlight-gallery', get_template_directory_uri() . '/assets/css/featherlight.gallery.css' );

    wp_enqueue_style( 'urnext-slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css' );
    wp_enqueue_style( 'urnext-bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
    wp_enqueue_style( 'urnext-animate-style', get_template_directory_uri() . '/assets/css/animate.css' );
    wp_enqueue_style( 'style', get_stylesheet_uri() );

    if( URNEXT_WOOCOMMERCE_ACTIVE ){
        wp_enqueue_style( 'urnext-woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css' );
    }
    
    if ( is_singular() ){ 
        wp_enqueue_script( "comment-reply" );
    }
    
    wp_enqueue_script( 'urnext-tooltipster', get_template_directory_uri() . '/assets/js/tooltipster.min.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'urnext-featherlight', get_template_directory_uri() . '/assets/js/featherlight.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'urnext-featherlight-gallery', get_template_directory_uri() . '/assets/js/featherlight.gallery.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'urnext-fittext', get_template_directory_uri() . '/assets/js/fittext.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'urnext-slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), '1.0.0', true );
    
    // Only load particles if we need it
    if( $urnext_theme_globals['particles_js'] ){
        wp_enqueue_script( 'urnext-particles', get_template_directory_uri() . '/assets/js/particles.min.js', array('jquery'), '1.0.0', true );
    }
    wp_enqueue_script( 'urnext-scrollify', get_template_directory_uri() . '/assets/js/scrollify.js', array('jquery'), '1.0.17', true );
    wp_enqueue_script( 'urnext-tether', get_template_directory_uri() . '/assets/js/tether.min.js', array('jquery'), '4.0.0', true );
    wp_enqueue_script( 'urnext-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.0.0', true );
    wp_enqueue_script( 'urnext-wow', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), '4.0.0', true );

    // Use isotope for archive grids
    wp_enqueue_script( 'urnext-isotope', get_template_directory_uri() . '/assets/vendor/isotope/isotope.pkgd.js', array('jquery'), '1.0.0', true );

    // Load the main js file
    wp_enqueue_script( 'urnext-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'urnext-bootstrap'), '1.0.0', true );

    // Localize main
    wp_localize_script( 'urnext-main', 'localize', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'urnext_load_scripts' );

add_action('wp_ajax_nopriv_urnext_get_cart_contens', 'urnext_get_cart_contens');
add_action('wp_ajax_urnext_get_cart_contens', 'urnext_get_cart_contens');
function urnext_get_cart_contens(){
    echo 'Cart content:';
    die;
}
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


add_action( 'wp_enqueue_scripts', 'merge_all_scripts', 99999 );

function merge_all_scripts(){

	global $wp_scripts, $wp_styles;
    
    $wp_styles->all_deps($wp_styles->queue);

    $merged_styles	= '';
    $merged_styles_location = get_stylesheet_directory() . DIRECTORY_SEPARATOR . 'merged-styles.css';
    
    if( !is_file( $merged_styles_location ) ){

        
        foreach( $wp_styles->to_do as $handle){

            if( strpos( $handle, 'urnext-') === false ) continue;

            $src = strtok( $wp_styles->registered[$handle]->src, '?'); 
            // If src is url http / https		
            if (strpos($src, 'http') !== false)
            {
                // Get our site url, for example: http://webdevzoom.com/wordpress
                $site_url = site_url();
                $css_file_path = strpos($src, $site_url) !== false ? str_replace($site_url, '', $src) : $src ;
                $css_file_path = ltrim($css_file_path, '/');
                
                // Check wether file exists then merge
                if( file_exists($css_file_path) ) {
                    $merged_styles.=  file_get_contents($css_file_path);
                }
            }
        }
        // write the merged script into current theme directory
        file_put_contents ( $merged_styles_location , $merged_styles);
    }
    // #4. Load the URL of merged file
	wp_enqueue_style('merged-styles',  get_stylesheet_directory_uri() . '/merged-styles.css');
	
    // 5. Deregister handles
	foreach( $wp_styles->to_do as $handle ) {
		if( strpos( $handle, 'urnext-' ) !== false ) wp_deregister_style( $handle );
	}

	/*
		#1. Reorder the handles based on its dependency, 
			The result will be saved in the to_do property ($wp_scripts->to_do)
    */
    
    
	$wp_scripts->all_deps($wp_scripts->queue);	
	
	// New file location: E:xampp\htdocs\wordpresswp-content\theme\wdc\merged-script.js
	$merged_file_location = get_stylesheet_directory() . DIRECTORY_SEPARATOR . 'merged-script.js';
	
	$merged_script	= '';
	if( !is_file( $merged_file_location ) ){
        // Loop javascript files and save to $merged_script variable
        foreach( $wp_scripts->to_do as $handle) {
            if( strpos( $handle, 'urnext-') === false ) continue;
            // Clean up url, for example wp-content/themes/wdc/main.js?v=1.2.4 become wp-content/themes/wdc/main.js
            
            $src = strtok($wp_scripts->registered[$handle]->src, '?');
            
            // 2. Combine javascript file.
            // If src is url http / https		
            if (strpos($src, 'http') !== false)
            {
                // Get our site url, for example: http://webdevzoom.com/wordpress
                $site_url = site_url();
            
                if (strpos($src, $site_url) !== false)
                    $js_file_path = str_replace($site_url, '', $src);
                else
                    $js_file_path = $src;
  
                $js_file_path = ltrim($js_file_path, '/');
            }
            else 
            {			
                $js_file_path = ltrim($src, '/');
            }
            
            // Check wether file exists then merge
            if  (file_exists($js_file_path)) 
            {
                // #3. Check for wp_localize_script
                $localize = '';
                if ( @key_exists('data', $wp_scripts->registered[$handle]->extra ) ) {
                    $localize = $wp_scripts->registered[$handle]->extra['data'] . ';';
                }
                $merged_script .=  $localize . file_get_contents($js_file_path) . ';';
            }
        }
        
        // write the merged script into current theme directory
        file_put_contents ( $merged_file_location , $merged_script);
    }

	// #4. Load the URL of merged file
	wp_enqueue_script('merged-script',  get_stylesheet_directory_uri() . '/merged-script.js');
	
	// 5. Deregister handles
	foreach( $wp_scripts->to_do as $handle ) 
	{
		if( strpos( $handle, 'urnext-' ) !== false ) wp_deregister_script($handle);
    }
    
}