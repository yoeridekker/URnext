<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package URnext
 * @since URnext 1.0
 */

// Get the header
get_header(); 

// Get the banner for the archive
get_template_part('parts/no-banner'); 

// Get the breadcrumbs
$show_breadcrumbs = get_urnext_option( '404', 'show_breadcrumbs' );
if( (int) $show_breadcrumbs === 1){
    get_template_part('parts/breadcrumbs');
}

?>

<!-- start main content -->
<div class="content-panel error-404" data-section-name="content" id="main-content">

    <?php get_search_form(); ?>
    <?php get_template_part( 'loop', 'none' ); ?>
    <div class="clear"></div>

</div>

<?php 
// Get the default footer
get_footer();