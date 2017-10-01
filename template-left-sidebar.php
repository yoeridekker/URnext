<?php
/**
 * This template will produce a template with a sidebar on the left side
 *
 * Template Name: Left Sidebar
 * Template Post Type: post, page
 *
 * @package URnext
 * @since 1.0.0
 */

// Get the default header 
get_header();

// Get the banner
get_template_part('parts/banner');

// Get the breadcrumbs
$show_breadcrumbs = (int) get_urnext_option('breadcrumbs');
$hide_breadcrumbs = (int) get_urnext_option( get_post_type(), 'hide_breadcrumbs' );
if( $show_breadcrumbs === 1 && $hide_breadcrumbs !== 1 ){
    get_template_part('parts/breadcrumbs');
}

?>
</div>
<!-- end banner wrapper -->

<!-- start main content -->
<article class="content-panel" id="main-content">
    <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'parts/'. get_post_type().'/content', 'leftsidebar'); ?>
        <div class="clear"></div>
    <?php endwhile; ?>
</article>

<?php 
// Get the default footer
get_footer();