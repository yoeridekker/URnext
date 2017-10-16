<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_action('wp_ajax_nopriv_more_post_ajax', 'urnext_more_post_ajax'); 
add_action('wp_ajax_more_post_ajax', 'urnext_more_post_ajax');

function urnext_more_post_ajax(){

    // Init global again for ajax calls
    urnext_register_theme_globals();
    
    $i      = 0;
    $args   = array(); 
    $data   = array();
    $return = array();

    // Loop request data
    foreach( $_POST['data'] as $k => $v ){
        $data[$k] = ( (string) $v === '0' || (string) $v === '' ) ? null : sanitize_text_field( $v );
    }

    // Set the layout 
    $layout = (int) get_urnext_option('grid_layout') === 1 ? 'grid' : 'list' ;

    // Debug request data
    $return['request'] = $data;

    // Paged query
    $paged = isset( $data['paged'] ) && (int) $data['paged'] > 0 ? ( (int) $data['paged'] + 1 ) : 1 ;
    $args['paged'] = $paged;
    
    // Date query 
    $date_query = array();
    // For the year
    if( isset( $data['year'] ) && $data['year'] !== null ){
        $date_query['year'] = (int) $data['year'];
    }
    // For the month
    if( isset( $data['month'] ) && $data['month'] !== null ){
        $date_query['month'] = (int) $data['month'];
    }
    // For the week
    if( isset( $data['week'] ) && $data['week'] !== null ){
        $date_query['week'] = (int) $data['week'];
    }
    // For the day
    if( isset( $data['day'] ) && $data['day'] !== null ){
        $date_query['day'] = (int) $data['day'];
    }

    // Add the date query
    $args['date_query'] = $date_query;

    $tax_query = array();
    
    // For the category
    if( isset( $data['category'] ) && $data['category'] !== null ){
        $tax_query[] = array(
            'taxonomy'         => 'category',
            'terms'            => (int) $data['category'],
            'field'            => 'term_id',
            'operator'         => 'IN',
            'include_children' => false,
        );
        
    }

    // For the tag
    if( isset( $data['tag'] ) && $data['tag'] !== null ){
        $tax_query[] = array(
            'taxonomy'         => 'post_tag',
            'terms'            => (string) $data['tag'],
            'field'            => 'slug',
            'operator'         => 'IN',
            'include_children' => false,
        );
        
    }
    // Add the tax query
    $args['tax_query'] = $tax_query;
    
    // Post-type 
    if( isset( $data['type'] ) && $data['type'] !== null ){
        $args['post_type'] = (string) $data['type'];
    }

    // Search 
    if( isset( $data['search'] ) && $data['search'] !== null ){
        $args['s'] = (string) $data['search'];
    }

    // Debug query arguments
    $return['args'] = $args;

    // The Query
    $query = new WP_Query( $args );
    
    // Start content rendering
    ob_start();
    
    // Loop results
    if( $query->have_posts() ){
        while ( $query->have_posts() ){
            $query->the_post();
            get_template_part('loop','post');
            $i++;
        }
    }
    
    // Get results
    $content = ob_get_clean();
    
    // Set return html
    $return['html'] = $content;
    $return['layout'] = get_urnext_option('grid_layout') ;

    $return['found_posts'] = $query->found_posts;
    $return['max_num_pages'] = $query->max_num_pages;

    // Output 
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode( $return );
    die;
}

add_action('wp_ajax_nopriv_urnext_get_cart_count', 'urnext_get_cart_count');
add_action('wp_ajax_urnext_get_cart_count', 'urnext_get_cart_count');
function urnext_get_cart_count(){
    $cart_totals = WC()->cart->get_cart_contents_count();
    $return = array(
        'count' => (int) $cart_totals
    );
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode( $return );
    die;
}

add_action('wp_ajax_nopriv_urnext_get_cart_contents', 'urnext_get_cart_contents');
add_action('wp_ajax_urnext_get_cart_contents', 'urnext_get_cart_contents');
function urnext_get_cart_contents(){
    ob_start();
    woocommerce_mini_cart();
    $content = ob_get_clean();
    echo html_entity_decode( $content );
    die;
}