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
$show_breadcrumbs = (int) get_urnext_option('breadcrumbs');
$hide_breadcrumbs = (int) get_urnext_option( '404', 'hide_breadcrumbs' );
if( $show_breadcrumbs === 1 && $hide_breadcrumbs !== 1 ){
    get_template_part('parts/breadcrumbs');
}
?>
</div>
<!-- end banner wrapper -->

<!-- start main content -->
<div class="content-panel error-404" id="main-content">
    
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 centered">
                <h1 class="underline after-text-color faded"><?php esc_html_e( 'Page not found!', 'urnext' ); ?></h1>
            </div>

            <div class="col-lg-2 hidden-md-down"></div>

            <div class="hidden-xs-down col-lg-2 col-md-3 col-sm-4 text-left">
                <h3><?php esc_html_e( 'Helpful Links', 'urnext' ); ?></h3>
                <?php wp_nav_menu( array(
                    'theme_location' => '404_pages',
                    'depth'          => 1,
                    'container'      => false,
                    'menu_id'        => 'checklist-1',
                    'menu_class'     => 'error-menu list-icon list-icon-arrow ',
                    'echo'           => 1,
                ) ); ?>
            </div>
            
            <div class="col-lg-6 col-md-9 col-sm-8 text-left">
                <h3><?php esc_html_e( 'Search Our Website', 'urnext' ); ?></h3>
                <p><?php esc_html_e( 'Can\'t find what you need? Take a moment and do a search below!', 'urnext' ); ?></p>
                <div class="search-page-search-form buttons small">
                    <?php echo get_search_form( false ); ?>
                </div>
            </div>

        </div>
    </div>
</div>

<?php 
// Get the default footer
get_footer();