<?php 
/**
* Set defines
*/
define('WOOCOMMERCE_USE_CSS', false);

/**
* Register theme globals
*/
global $urnext_social_options, $urnext_theme_globals;
$urnext_social_options = array(
    'augment',
    'bitbucket',
    'fyuse',
    'yt-gaming',
    'sketchfab',
    'mobcrush',
    'microsoft',
    'pandora',
    'messenger',
    'gamewisp',
    'bloglovin',
    'tunein',
    'gamejolt',
    'trello',
    'spreadshirt',
    '500px',
    '8tracks',
    'airbnb',
    'alliance',
    'amazon',
    'amplement',
    'android',
    'angellist',
    'apple',
    'appnet',
    'baidu',
    'bandcamp',
    'battlenet',
    'mixer',
    'bebee',
    'bebo',
    'behance',
    'blizzard',
    'blogger',
    'buffer',
    'chrome',
    'coderwall',
    'curse',
    'dailymotion',
    'deezer',
    'delicious',
    'deviantart',
    'diablo',
    'digg',
    'discord',
    'disqus',
    'douban',
    'draugiem',
    'dribbble',
    'drupal',
    'ebay',
    'ello',
    'endomodo',
    'envato',
    'etsy',
    'facebook',
    'feedburner',
    'filmweb',
    'firefox',
    'flattr',
    'flickr',
    'formulr',
    'forrst',
    'foursquare',
    'friendfeed',
    'github',
    'goodreads',
    'google',
    'googlescholar',
    'googlegroups',
    'googlephotos',
    'googleplus',
    'grooveshark',
    'hackerrank',
    'hearthstone',
    'hellocoton',
    'heroes',
    'hitbox',
    'horde',
    'houzz',
    'icq',
    'identica',
    'imdb',
    'instagram',
    'issuu',
    'istock',
    'itunes',
    'keybase',
    'lanyrd',
    'lastfm',
    'line',
    'linkedin',
    'livejournal',
    'lyft',
    'macos',
    'mail',
    'medium',
    'meetup',
    'mixcloud',
    'modelmayhem',
    'mumble',
    'myspace',
    'newsvine',
    'nintendo',
    'npm',
    'odnoklassniki',
    'openid',
    'opera',
    'outlook',
    'overwatch',
    'patreon',
    'paypal',
    'periscope',
    'persona',
    'pinterest',
    'play',
    'player',
    'playstation',
    'pocket',
    'qq',
    'quora',
    'raidcall',
    'ravelry',
    'reddit',
    'renren',
    'researchgate',
    'residentadvisor',
    'reverbnation',
    'rss',
    'sharethis',
    'skype',
    'slideshare',
    'smugmug',
    'snapchat',
    'songkick',
    'soundcloud',
    'spotify',
    'stackexchange',
    'stackoverflow',
    'starcraft',
    'stayfriends',
    'steam',
    'storehouse',
    'strava',
    'streamjar',
    'stumbleupon',
    'swarm',
    'teamspeak',
    'teamviewer',
    'technorati',
    'telegram',
    'tripadvisor',
    'tripit',
    'triplej',
    'tumblr',
    'twitch',
    'twitter',
    'uber',
    'ventrilo',
    'viadeo',
    'viber',
    'viewbug',
    'vimeo',
    'vine',
    'vkontakte',
    'warcraft',
    'wechat',
    'weibo',
    'whatsapp',
    'wikipedia',
    'windows',
    'wordpress',
    'wykop',
    'xbox',
    'xing',
    'yahoo',
    'yammer',
    'yandex',
    'yelp',
    'younow',
    'youtube',
    'zapier',
    'zerply',
    'zomato',
    'zynga'
);
$urnext_theme_globals = array();

/**
* Load requirements
*/
require_once('includes/class-tgm-plugin-activation.php');
require_once('includes/acf.php');
require_once('includes/fonts.php');
require_once('includes/theme-options.php');
require_once('includes/customizer.php');
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
require_once('includes/urnext-ajax.php');

/**
* Set ACF in lite mode
* This will disable the user interface on the backed
*/
//define( 'ACF_LITE', true );

/**
* urnext_register_theme_globals
* Description: Will loop all the possible theme options and customizer options 
*/
add_action( 'wp', 'urnext_register_theme_globals' );
function urnext_register_theme_globals() {
    global $urnext_theme_options, $urnext_theme_globals, $urnext_theme_settings;

    // Get the options from the theme customizer
    foreach( $urnext_theme_options as $urnext_option ){
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

}

/**
 * Function urnext_get_meta() checks for existance of the ACF plugin
 * If found, it wil use the get_field() function
 * If not found, the WordPress default get_post_meta() function will be used
 *
 */
function urnext_get_meta( $post_id = null, $meta_key, $single = true ){
    if( function_exists('get_field') ){
        return get_field( $meta_key, $post_id );
    }
    return get_post_meta( $post_id, $meta_key, $single );
}

function get_urnext_option( $setting = false , $section = false ){
    global $urnext_theme_globals;
    
    // We need the section and the sepcific setting
    if( $setting && $section ){
        if( isset( $urnext_theme_globals[$section][$setting] ) ){
            return $urnext_theme_globals[$section][$setting];
        }
    }

    // We need all the values in the section 
    if( !$setting && $section ){
        if( isset( $urnext_theme_globals[$section] ) ){
            return $urnext_theme_globals[$section];
        }
    }

    // We need the specific setting
    if( $setting && !$section ){
        if( isset( $urnext_theme_globals[$setting] ) ){
            return $urnext_theme_globals[$setting];
        }
    }

    // IF nothing is set, we return false
    return false;

}

function urnext_social_icons( $ul_class = '', $li_class = '', $a_class = '' ){
    global $urnext_social_options;

    $html = '';
    if( !empty( $urnext_social_options ) ){
        $html.= sprintf('<ul class="socialbadges %s">', $ul_class );
        foreach( $urnext_social_options as $channel ){
            // check if the option exists and is set
            $link = (string) get_urnext_option( $channel );
            if( $link !== '' ){
                $html.= sprintf('<li class="%s"><a href="%s" class="%s" target="_blank"><span class="socialbadge %s socicon socicon-%s"></span></a></li>', $li_class, esc_url($link), $a_class, $channel, $channel );
            }
        }
        $html.= '</ul>';
    }
    return $html;
}

function urnext_grid_column_classes( $column_count = 3 ){
    $get_column_count = (int) get_urnext_option('grid_column_count');
    if( $get_column_count !== 0 ){
        $column_count = $get_column_count;
    }
    $grid_margin = (int) get_urnext_option('grid_column_margin') === 1 ? 'grid-margin' : 'no-grid-margin' ;
    $xl_count = ceil( 12 / $column_count ); // ≥1200px
    $lg_count = ceil( 12 / $column_count ); // ≥992px
    $md_count = $column_count > 1 ? ceil( 12 / ( $column_count - 1 ) ) : 12 ; // ≥768px
    $sm_count = $column_count > 3 ? 6 : 12 ; // ≥576px
    $xs_count = 12; // <576px

    return sprintf('%s col-xs-%s col-sm-%s col-md-%s col-lg-%s col-xl-%s', $grid_margin, $xs_count, $sm_count, $md_count, $lg_count, $xl_count);
}

// Apply filter
add_filter('body_class', 'urnext_settings_body_class');
function urnext_settings_body_class( $classes ) {
    global $urnext_theme_globals;
    $classes[] = (string) get_urnext_option('logo') !== '' ? 'logo-header' : 'text-header' ;
    $classes[] = (int) get_urnext_option('hide_header') === 1 ? 'has-hidden-header' : 'no-hidden-header' ;
    $classes[] = (int) get_urnext_option('sticky_header') === 1 ? 'has-sticky-navbar' : 'no-sticky-navbar' ;
    $classes[] = (int) get_urnext_option('header_parallax') === 1 ? 'parallax' : '' ;
    return $classes;
}

function custom_excerpt_length( $length ) {
	return 10;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/**
* Register menu
*/
add_action( 'after_setup_theme', 'urnext_register_primary_menu' );
function urnext_register_primary_menu() {
   register_nav_menu( 'primary', __( 'Primary Menu', 'urnext' ) );
   register_nav_menu( 'footer', __( 'Footer Menu', 'urnext' ) );
   register_nav_menu( '404', __( '404 Not Found Menu', 'urnext' ) );
   register_nav_menu( 'disclaimer', __( 'Footer Disclaimer Menu', 'urnext' ) );
}

/**
* Set the content width if not defined
*/
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
* Enable custom editor style
*/
add_editor_style();

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
add_theme_support(
    'post-formats',
    array(
        'video',
        'image',
        'aside',
        'gallery'
    )
);

add_image_size( 'urnext-banner', 1600, 99999, false );

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

    wp_enqueue_style( 'urnext-linearicons', get_template_directory_uri() . '/assets/css/linearicons.min.css' );
    
    wp_enqueue_style( 'urnext-bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
    
    // Load animations.css if animations are enabled
    if( (int) get_urnext_option('animations') === 1 ){
        wp_enqueue_style( 'urnext-animate-style', get_template_directory_uri() . '/assets/css/animate.css' );
    }

    // Only load if Woocommerce is active
    if( URNEXT_WOOCOMMERCE_ACTIVE ){
        wp_enqueue_style( 'urnext-woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css' );
    }

    wp_enqueue_style( 'urnext-style', get_stylesheet_uri() );

    // Load responsive styles
    wp_enqueue_style( 'urnext-responsive', get_template_directory_uri() . '/assets/css/responsive.css' );
    
    // Only load on singular (page,post)
    if ( is_singular() ){ 
        wp_enqueue_script( "comment-reply" );
    }

    wp_enqueue_script( 'urnext-html5shiv', get_template_directory_uri() . '/assets/js/html5shiv.min.js' );
    wp_script_add_data( 'urnext-html5shiv', 'conditional', 'lt IE 9' );

    wp_enqueue_script( 'urnext-tooltipster', get_template_directory_uri() . '/assets/js/tooltipster.min.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'urnext-featherlight', get_template_directory_uri() . '/assets/js/featherlight.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'urnext-featherlight-gallery', get_template_directory_uri() . '/assets/js/featherlight.gallery.js', array('jquery'), '1.0.0', true );
    
    // Use slick fot the carrousel and sliders
    wp_enqueue_script( 'urnext-slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), '1.0.0', true );
    
    // for sitcky elements
    wp_enqueue_script( 'urnext-stickykit', get_template_directory_uri() . '/assets/js/sticky-kit.js', array('jquery'), '1.0.0', true );

    // Require bootstrap and tether
    wp_enqueue_script( 'urnext-tether', get_template_directory_uri() . '/assets/js/tether.min.js', array('jquery'), '4.0.0', true );
    wp_enqueue_script( 'urnext-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.0.0', true );
    
    // Load wow.js if animations are enabled
    if( (int) get_urnext_option('animations') === 1 ){
        wp_enqueue_script( 'urnext-wow', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), '4.0.0', true );
    }

    // Use isotope for archive grids
    if( (int) get_urnext_option('grid_layout') === 1 ){
        wp_enqueue_script( 'urnext-isotope', get_template_directory_uri() . '/assets/vendor/isotope/isotope.pkgd.js', array('jquery'), '1.0.0', true );
    }

    // Load the main js file
    wp_enqueue_script( 'urnext-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'urnext-bootstrap'), '1.0.0', true );

    // Localize main
    $localize = array(
        'ajaxurl'       => admin_url( 'admin-ajax.php' ),
        'animations'    => ( (int) get_urnext_option('animations') === 1 ? 1 : 0 ),
        'hasParallax'   => ( (int) get_urnext_option('header_parallax') === 1 ? 1 : 0 ),
        'gridLayout'    => ( (int) get_urnext_option('grid_layout') === 1 ? 1 : 0 ),
        'fullHeight'    => ( (int) get_urnext_option('fullheight_header') === 1 ? 1 : 0 ),
        'squareItems'   => ( (int) get_urnext_option('square_grid_items') === 1 ? 1 : 0 ),
        'stickyHeader'  => ( (int) get_urnext_option('sticky_header') === 1 ? 1 : 0 ),
        'hideHeader'    => ( (int) get_urnext_option('hide_header') === 1 ? 1 : 0 ),
    );
    
    wp_localize_script( 'urnext-main', 'localize', $localize );
}
add_action( 'wp_enqueue_scripts', 'urnext_load_scripts' );


function urnext_enable_more_buttons_tinymce($buttons) {
    $buttons[] = 'fontsizeselect';
    $buttons[] = 'styleselect';
    $buttons[] = 'backcolor';
    $buttons[] = 'charmap';
    $buttons[] = 'hr';
    $buttons[] = 'visualaid';
    
    return $buttons;
}
add_filter('mce_buttons_3', 'urnext_enable_more_buttons_tinymce');

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
            'before_title'  => '<h3 class="after-footer-text-color footer-text-color faded wide">',
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
            'before_title'  => '<h3 class="after-footer-text-color footer-text-color faded wide">',
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
            'before_title'  => '<h3 class="after-text-color footer-text-color faded wide">',
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
            'before_title'  => '<h3 class="after-text-color footer-text-color faded wide">',
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

    // Register page sidebar area
    register_sidebar( 
        array(
            'name'          => __('Page sidebar', 'urnext'),
            'id'            => 'page_sidebar',
            'before_widget' => '<div class="">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="underline after-text-color footer-text-color faded wide">',
            'after_title'   => '</h3>',
        )
    );

}
add_action( 'widgets_init', 'urnext_widgets_init' );


function urnext_breadcrumb() {

    $html               = '';

    /* === OPTIONS === */
    $text['here']       = (int) get_urnext_option('breadcrumbs_home_link') === 1 ? __('You are here: ', 'urnext') : '' ; // text for the 'Home' link
	$text['home']       = __('Home<!--<span class="lnr lnr-home ishome"></span>-->', 'urnext'); // text for the 'Home' link
	$text['category']   = __('Category %s', 'urnext'); // text for a category page
	$text['search']     = __('Search Results for "%s" Query', 'urnext'); // text for a search results page
	$text['tag']        = __('Posts Tagged "%s"', 'urnext'); // text for a tag page
	$text['author']     = __('Articles Posted by %s', 'urnext'); // text for an author page
	$text['404']        = __('Error 404', 'urnext'); // text for the 404 page
	$text['page']       = __('Page %s', 'urnext'); // text 'Page N'
	$text['cpage']      = __('Comment Page %s', 'urnext'); // text 'Comment Page N'

    $get_sep            = (string) get_urnext_option('breadcrumbs_separator');
	$wrap_before        = '<div class="breadcrumbs header-text-color" itemscope itemtype="http://schema.org/BreadcrumbList">'; // the opening wrapper tag
	$wrap_after         = '</div><!-- .breadcrumbs -->'; // the closing wrapper tag
	$sep                =  $get_sep !== '' ? $get_sep : '<span class="header-text-color lnr lnr-chevron-right"></span>'; // separator between crumbs
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
				$html.= sprintf($link, $home_url . $slug['slug'] . '/', $post_type->labels->singular_name);
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
            $cat = get_the_category($parent->ID); 
            $cat = isset($cat[0]) ? $cat[0] : false ;
			if ($cat) {
				$cats = get_category_parents($cat, TRUE, $sep);
				$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
				$html.= $cats;
			}
			$html.= sprintf($link, get_permalink($parent), $parent->post_title);
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
        /*
		array(
			'name'               => 'Advanced Custom Fields PRO', // The plugin name.
			'slug'               => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/plugins/advanced-custom-fields-pro.zip', // The plugin source.
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '5.6.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => 'https://www.advancedcustomfields.com/pro/', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
        ),
        */
        array(
			'name'          => 'Advanced Custom Fields',
			'slug'          => 'advanced-custom-fields',
            'is_callable'   => 'get_field',
            'required'      => false,
		),
		array(
			'name'          => 'WordPress SEO by Yoast',
			'slug'          => 'wordpress-seo',
            'is_callable'   => 'wpseo_init',
            'required'      => false,
		)
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
		'id'           => 'urnext',                // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'urnext-install-plugins',// Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => false,                   // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);
	tgmpa( $plugins, $config );
}



add_action('pre_get_posts', 'urnext_adjust_sticky_query');
function urnext_adjust_sticky_query($query) {

    if ( $query->is_main_query() && is_home() ) {

        // set the number of posts per page
        $posts_per_page = get_option('posts_per_page');

        // get sticky posts array
        $sticky_posts = get_option( 'sticky_posts' );

        // if we have any sticky posts and we are at the first page
        if ( is_array($sticky_posts) && !$query->is_paged() ) {

            // count the number of sticky posts
            $sticky_count = count($sticky_posts);

            // and if the number of sticky posts is less than
            // the number we want to set:
            if ( $sticky_count < $posts_per_page ) {
                $query->set('posts_per_page', $posts_per_page - $sticky_count );
            }
        }
    }
}