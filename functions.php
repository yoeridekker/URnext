<?php 
/**
* Set defines
*/
define('WOOCOMMERCE_USE_CSS', false);

/**
* Load requirements
*/
require_once('includes/class-tgm-plugin-activation.php');
require_once('includes/acf.php');
require_once('includes/fonts.php');
require_once('includes/theme-options.php');
require_once('includes/urnext-options.php');
require_once('includes/add-child-theme.php');
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
* Set ACF in lite mode
* This will disable the user interface on the backed
*/
//define( 'ACF_LITE', true );

/**
* Register theme globals
*/
global $urnext_theme_globals;
$urnext_theme_globals = array();

add_action( 'wp', 'register_theme_globals' );

/**
* register_theme_globals
* Description: Will loop all the possible theme and customizer options 
*/
function register_theme_globals() {
    global $urnext_options, $urnext_theme_globals, $urnext_theme_settings;

    // Get the options from the theme customizer
    foreach( $urnext_options as $urnext_option ){
        foreach( $urnext_option['settings'] as $setting => $details ){
            $value = get_theme_mod($setting);
            $urnext_theme_globals[ $setting ] = ( $value === '' && isset( $details['default'] ) ) ? $details['default'] : $value ;
        }
    }

    // Get the options from the theme options page
    foreach( $urnext_theme_settings as $setting_name => $details ){
        $opt_name = 'urnext_theme_option_name_' . $setting_name;
        $settings = get_option( $opt_name );
        if( $settings && !empty($settings) ){
            foreach( $settings as $setting_key => $setting_value ){
                $urnext_theme_globals[ $setting_key ] = $setting_value;
            }
        }
    }
    
    /*
    echo '<pre>';
    var_dump( $urnext_theme_globals );
    die;
    */
}

function get_urnext_option( $setting, $section = false ){
    global $urnext_theme_globals;
    
    if( $section && isset( $urnext_theme_globals[$section] ) ){
        if( isset( $urnext_theme_globals[$section][$setting] ) ){
            return $urnext_theme_globals[$section][$setting];
        }
    }else{
        if( isset( $urnext_theme_globals[$setting] ) ){
            return $urnext_theme_globals[$setting];
        }
    }

    return false;
}

// Apply filter
add_filter('body_class', 'settings_body_class');
function settings_body_class( $classes ) {
    global $urnext_theme_globals;

    $classes[] = (int) get_urnext_option('hide_header') === 1 ? 'has-hidden-header' : 'no-hidden-header' ;
    $classes[] = (int) get_urnext_option('sticky_header') === 1 ? 'has-sticky-navbar' : 'no-sticky-navbar' ;

    return $classes;
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

/**
* Enable custom header
*/
$args = array(
	'flex-width'    => true,
	'width'         => 1280,
	'flex-height'    => true,
	'height'        => 800,
	'default-image' => get_template_directory_uri() . '/assets/images/header.jpg',
);
add_theme_support( 'custom-header', $args );

/**
* Enable post thumbnails
*/
add_theme_support( 'post-thumbnails' ); 

/**
* Enable automatic feed links
*/
add_theme_support( 'automatic-feed-links' );

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
    wp_enqueue_style( 'urnext-slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css' );
    
    wp_enqueue_style( 'urnext-socicon', get_template_directory_uri() . '/assets/css/socicon.css' );
    wp_enqueue_style( 'urnext-tooltip', get_template_directory_uri() . '/assets/css/tooltipster.css' );
    
    wp_enqueue_style( 'urnext-featherlight', get_template_directory_uri() . '/assets/css/featherlight.css' );
    wp_enqueue_style( 'urnext-eatherlight-gallery', get_template_directory_uri() . '/assets/css/featherlight.gallery.css' );

    wp_enqueue_style( 'urnext-bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
    
    // Load animations.css if animations are enabled
    if( (int) get_urnext_option('animations') === 1 ){
        wp_enqueue_style( 'urnext-animate-style', get_template_directory_uri() . '/assets/css/animate.css' );
    }

    wp_enqueue_style( 'urnext-style', get_stylesheet_uri() );

    // Only load if Woocommerce is active
    if( URNEXT_WOOCOMMERCE_ACTIVE ){
        wp_enqueue_style( 'urnext-woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css' );
    }
    
    // Only load on singular (page,post)
    if ( is_singular() ){ 
        wp_enqueue_script( "comment-reply" );
    }
    
    wp_enqueue_script( 'urnext-tooltipster', get_template_directory_uri() . '/assets/js/tooltipster.min.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'urnext-featherlight', get_template_directory_uri() . '/assets/js/featherlight.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'urnext-featherlight-gallery', get_template_directory_uri() . '/assets/js/featherlight.gallery.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'urnext-fittext', get_template_directory_uri() . '/assets/js/fittext.js', array('jquery'), '1.0.0', true );
    
    // Use slick fot the carrousel and sliders
    wp_enqueue_script( 'urnext-slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), '1.0.0', true );
    
    // Only load particles if we need it
    if( $urnext_theme_globals['particles_js'] ){
        wp_enqueue_script( 'urnext-particles', get_template_directory_uri() . '/assets/js/particles.min.js', array('jquery'), '1.0.0', true );
    }
    
    // Require bootstrap and tether
    wp_enqueue_script( 'urnext-tether', get_template_directory_uri() . '/assets/js/tether.min.js', array('jquery'), '4.0.0', true );
    wp_enqueue_script( 'urnext-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.0.0', true );
    
    // Load wow.js if animations are enabled
    if( (int) get_urnext_option('animations') === 1 ){
        wp_enqueue_script( 'urnext-wow', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), '4.0.0', true );
    }

    // Use isotope for archive grids
    wp_enqueue_script( 'urnext-isotope', get_template_directory_uri() . '/assets/vendor/isotope/isotope.pkgd.js', array('jquery'), '1.0.0', true );

    // Load the main js file
    wp_enqueue_script( 'urnext-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'urnext-bootstrap'), '1.0.0', true );

    // Localize main
    $localize = array(
        'ajaxurl'       => admin_url( 'admin-ajax.php' ),
        'animations'    => ( (int) get_urnext_option('animations') === 1 ? 1 : 0 ),
        'parallax'      => ( (int) get_urnext_option('header_parallax') === 1 ? 1 : 0 ),
    );
    
    wp_localize_script( 'urnext-main', 'localize', $localize );
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


function the_breadcrumb() {

    $html               = '';

    /* === OPTIONS === */
    $text['here']       = __('You are here: ', 'urnext'); // text for the 'Home' link
	$text['home']       = __('Home', 'urnext'); // text for the 'Home' link
	$text['category']   = __('Category %s', 'urnext'); // text for a category page
	$text['search']     = __('Search Results for "%s" Query', 'urnext'); // text for a search results page
	$text['tag']        = __('Posts Tagged "%s"', 'urnext'); // text for a tag page
	$text['author']     = __('Articles Posted by %s', 'urnext'); // text for an author page
	$text['404']        = __('Error 404', 'urnext'); // text for the 404 page
	$text['page']       = __('Page %s', 'urnext'); // text 'Page N'
	$text['cpage']      = __('Comment Page %s', 'urnext'); // text 'Comment Page N'

	$wrap_before        = '<div class="breadcrumbs header-text-color" itemscope itemtype="http://schema.org/BreadcrumbList">'; // the opening wrapper tag
	$wrap_after         = '</div><!-- .breadcrumbs -->'; // the closing wrapper tag
	$sep                = '<span class="header-text-color lnr lnr-chevron-right"></span>'; // separator between crumbs
	$sep_before         = '<span class="header-text-color hidden-xs-down sep">'; // tag before separator
    $sep_after          = '</span>'; // tag after separator
    $show_youre_here    = 1; // 1 - show the 'You are here' link, 0 - don't show
	$show_home_link     = 1; // 1 - show the 'Home' link, 0 - don't show
	$show_on_home       = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$show_current       = 1; // 1 - show current page title, 0 - don't show
	$before             = '<span class="header-text-color current">'; // tag before the current crumb
	$after              = '</span>'; // tag after the current crumb
    
    /* === END OF OPTIONS === */

    global $post;
    
	$home_url       = home_url('/');
	$link_before    = '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
	$link_after     = '</span>';
	$link_attr      = ' itemprop="item"';
	$link_in_before = '<span class="hidden-xs-down" itemprop="name">';
	$link_in_after  = '</span>';
	$link           = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
	$frontpage_id   = get_option('page_on_front');
	$parent_id      = ($post) ? $post->post_parent : '';
	$sep            = ' ' . $sep_before . $sep . $sep_after . ' ';
	$home_link      = $link_before . '<a href="' . $home_url . '"' . $link_attr . ' class="home">' . $link_in_before . $text['home'] . $link_in_after . '</a>' . $link_after;

    $youre_here = '';
    if( $show_youre_here ) $youre_here.= $before . $text['here'] . $after;

	if (is_home() || is_front_page()) {
        
		if ($show_on_home) $html.= $wrap_before . $youre_here . $home_link . $wrap_after;

	} else {

        $html.= $wrap_before . $youre_here;
        
		if ($show_home_link) $html.= $home_link;

		if ( is_category() ) {
			$cat = get_category(get_query_var('cat'), false);
			if ($cat->parent != 0) {
				$cats = get_category_parents($cat->parent, TRUE, $sep);
				$cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
				$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
				if ($show_home_link) $html.= $sep;
				$html.= $cats;
			}
			if ( get_query_var('paged') ) {
				$cat = $cat->cat_ID;
				$html.= $sep . sprintf($link, get_category_link($cat), get_cat_name($cat)) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
			} else {
				if ($show_current) $html.= $sep . $before . sprintf($text['category'], single_cat_title('', false)) . $after;
			}

		} elseif ( is_search() ) {
			if (have_posts()) {
				if ($show_home_link && $show_current) $html.= $sep;
				if ($show_current) $html.= $before . sprintf($text['search'], get_search_query()) . $after;
			} else {
				if ($show_home_link) $html.= $sep;
				$html.= $before . sprintf($text['search'], get_search_query()) . $after;
			}

		} elseif ( is_day() ) {
			if ($show_home_link) $html.= $sep;
			$html.= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $sep;
			$html.= sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'));
			if ($show_current) $html.= $sep . $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			if ($show_home_link) $html.= $sep;
			$html.= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'));
			if ($show_current) $html.= $sep . $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			if ($show_home_link && $show_current) $html.= $sep;
			if ($show_current) $html.= $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
            if ($show_home_link) $html.= $sep;
            
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $home_url . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($show_current) $html.= $sep . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $sep);
				if (!$show_current || get_query_var('cpage')) $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
				$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
				$html.= $cats;
				if ( get_query_var('cpage') ) {
					$html.= $sep . sprintf($link, get_permalink(), get_the_title()) . $sep . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
				} else {
					if ($show_current) $html.= $before . get_the_title() . $after;
				}
			}

		// custom post type
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			if ( get_query_var('paged') ) {
				$html.= $sep . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
			} else {
				if ($show_current) $html.= $sep . $before . $post_type->label . $after;
			}

		} elseif ( is_attachment() ) {
			if ($show_home_link) $html.= $sep;
			$parent = get_post($parent_id);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			if ($cat) {
				$cats = get_category_parents($cat, TRUE, $sep);
				$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
				$html.= $cats;
			}
			printf($link, get_permalink($parent), $parent->post_title);
			if ($show_current) $html.= $sep . $before . get_the_title() . $after;

		} elseif ( is_page() && !$parent_id ) {
			if ($show_current) $html.= $sep . $before . get_the_title() . $after;

		} elseif ( is_page() && $parent_id ) {
			if ($show_home_link) $html.= $sep;
			if ($parent_id != $frontpage_id) {
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					if ($parent_id != $frontpage_id) {
						$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					}
					$parent_id = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					$html.= $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) $html.= $sep;
				}
			}
			if ($show_current) $html.= $sep . $before . get_the_title() . $after;

		} elseif ( is_tag() ) {
			if ( get_query_var('paged') ) {
				$tag_id = get_queried_object_id();
				$tag = get_tag($tag_id);
				$html.= $sep . sprintf($link, get_tag_link($tag_id), $tag->name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
			} else {
				if ($show_current) $html.= $sep . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
			}

		} elseif ( is_author() ) {
			global $author;
			$author = get_userdata($author);
			if ( get_query_var('paged') ) {
				if ($show_home_link) $html.= $sep;
				$html.= sprintf($link, get_author_posts_url($author->ID), $author->display_name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
			} else {
				if ($show_home_link && $show_current) $html.= $sep;
				if ($show_current) $html.= $before . sprintf($text['author'], $author->display_name) . $after;
			}

		} elseif ( is_404() ) {
			if ($show_home_link && $show_current) $html.= $sep;
			if ($show_current) $html.= $before . $text['404'] . $after;

		} elseif ( has_post_format() && !is_singular() ) {
			if ($show_home_link) $html.= $sep;
			$html.= get_post_format_string( get_post_format() );
		}

		$html.= $wrap_after;

    }
    return $html;
}

/*
add_action( 'wp_enqueue_scripts', 'merge_all_scripts', 99999 );

function merge_all_scripts(){

    global $urnext_theme_globals, $wp_scripts, $wp_styles;
    
    if( !isset( $urnext_theme_globals['urnext_compile_js_css'] ) || (int) $urnext_theme_globals['urnext_compile_js_css'] !== 1 ){
        return false;
    }
    
    
    $wp_styles->all_deps($wp_styles->queue);

    $merged_styles	        = '';
    $merged_styles_location = get_stylesheet_directory() . DIRECTORY_SEPARATOR . 'merged-styles.css';
    $unset_styles           = array();

    if( 1 == 1 ){
    //if( !is_file( $merged_styles_location ) ){

        foreach( $wp_styles->to_do as $handle){

            if( substr( $handle, 0, 7 ) !== 'urnext-' ) continue;

            $unset_styles[] = $handle;

            $src = strtok( $wp_styles->registered[$handle]->src, '?' );

            // If src is url http / https		
            if (strpos($src, 'http') !== false){

                // Get our site url, for example: http://webdevzoom.com/wordpress
                $site_url       = site_url();
                $css_file_path  = strpos( $src, $site_url ) !== false ? str_replace( $site_url, '', $src ) : $src ;
                $css_file_path  = ltrim( $css_file_path, '/' );
                
                // Check wether file exists then merge
                if( file_exists( $css_file_path ) ) {
                    $merged_styles.= file_get_contents( $css_file_path );
                }
            }
        }
        // write the merged script into current theme directory
        file_put_contents ( $merged_styles_location , $merged_styles);
    }
    // #4. Load the URL of merged file
	wp_enqueue_style('merged-styles',  get_stylesheet_directory_uri() . '/merged-styles.css');
	
    // 5. Deregister handles
	foreach( $unset_styles as $handle ) {
		wp_deregister_style( $handle );
	}


 
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
*/

add_action( 'tgmpa_register', 'urnext_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function urnext_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'               => 'TGM Example Plugin', // The plugin name.
			'slug'               => 'tgm-example-plugin', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/lib/plugins/tgm-example-plugin.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),

		// This is an example of how to include a plugin from an arbitrary external source in your theme.
		array(
			'name'         => 'TGM New Media Plugin', // The plugin name.
			'slug'         => 'tgm-new-media-plugin', // The plugin slug (typically the folder name).
			'source'       => 'https://s3.amazonaws.com/tgm/tgm-new-media-plugin.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
			'external_url' => 'https://github.com/thomasgriffin/New-Media-Image-Uploader', // If set, overrides default API URL and points to an external URL.
		),

		// This is an example of how to include a plugin from a GitHub repository in your theme.
		// This presumes that the plugin code is based in the root of the GitHub repository
		// and not in a subdirectory ('/src') of the repository.
		array(
			'name'      => 'Adminbar Link Comments to Pending',
			'slug'      => 'adminbar-link-comments-to-pending',
			'source'    => 'https://github.com/jrfnl/WP-adminbar-comments-to-pending/archive/master.zip',
		),

		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'BuddyPress',
			'slug'      => 'buddypress',
			'required'  => false,
		),

		// This is an example of the use of 'is_callable' functionality. A user could - for instance -
		// have WPSEO installed *or* WPSEO Premium. The slug would in that last case be different, i.e.
		// 'wordpress-seo-premium'.
		// By setting 'is_callable' to either a function from that plugin or a class method
		// `array( 'class', 'method' )` similar to how you hook in to actions and filters, TGMPA can still
		// recognize the plugin as being installed.
		array(
			'name'        => 'WordPress SEO by Yoast',
			'slug'        => 'wordpress-seo',
			'is_callable' => 'wpseo_init',
		),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'urnext',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'urnext' ),
			'menu_title'                      => __( 'Install Plugins', 'urnext' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'urnext' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'urnext' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'urnext' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'urnext'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'urnext'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'urnext'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'urnext'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'urnext'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'urnext'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'urnext'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'urnext'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'urnext'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'urnext' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'urnext' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'urnext' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'urnext' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'urnext' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'urnext' ),
			'dismiss'                         => __( 'Dismiss this notice', 'urnext' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'urnext' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'urnext' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );
}