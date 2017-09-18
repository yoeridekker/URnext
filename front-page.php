<?php
// Get the default header 
get_header();

// Get the banner
get_template_part('parts/banner');

// Get the breadcrumbs
$show_breadcrumbs = get_urnext_option( 'frontpage', 'show_breadcrumbs' );
if( (int) $show_breadcrumbs === 1){
    get_template_part('parts/breadcrumbs');
}

?>

<!-- start main content -->
<div class="content-panel" data-section-name="content" id="main-content">

    <?php 
    // Start the Loop.
    while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'content', 'page' ); ?>
        <div class="clear"></div>

    <?php endwhile; ?>
</div>

<?php 
// Get the default footer
get_footer();