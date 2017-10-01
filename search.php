<?php
/**
 * The template for displaying search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package URnext
 * @since 1.0.0
 */

// Get the default header 
get_header();

// Get the banner for the archive
get_template_part('parts/no-banner');

// Get the breadcrumbs
$show_breadcrumbs = (int) get_urnext_option('breadcrumbs');
$hide_breadcrumbs = (int) get_urnext_option('search', 'hide_breadcrumbs' );
if( $show_breadcrumbs === 1 && $hide_breadcrumbs !== 1 ){
    get_template_part('parts/breadcrumbs');
}
?>
</div>
<!-- end banner wrapper -->

<!-- start main content -->
<section class="content-panel" id="main-content">

    <div class="intro">
        <div class="container centered">
            <h1 class="centered underline after-text-color faded">
                <?php printf( esc_html__( 'Search Results for: %s', 'urnext' ), '<span>' . get_search_query() . '</span>' ); ?>    
            </h1>
        </div>
    </div>

    <?php if ( have_posts() ) : ?>
        <div class="container no-padding">
            <!-- start the grid -->
            <div class="grid fix-gutters">
                <!-- set grid sizer, do not remove! -->
                <div class="sizer <?php echo urnext_grid_column_classes(); ?>"></div>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part('loop','post'); ?>
                <?php endwhile; ?>
            </div>
            <!-- end the grid -->
            <div class="clear"></div>
        </div>

        <?php get_template_part('parts/pagination'); ?>
    
    <?php else: ?>
        <?php get_template_part('loop','none'); ?>
    <?php endif; ?>
</section>

<?php
// Get the default footer
get_footer();