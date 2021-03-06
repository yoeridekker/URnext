<?php
// Get the default header 
get_header();

// Get the banner
get_template_part('parts/banner');

// Get the breadcrumbs
$show_breadcrumbs = (int) get_urnext_option('breadcrumbs');
$hide_breadcrumbs = (int) get_urnext_option( 'page', 'hide_breadcrumbs' );
if( $show_breadcrumbs === 1 && $hide_breadcrumbs !== 1 ){
    get_template_part('parts/breadcrumbs');
}

?>
</div>
<!-- end banner wrapper -->

<!-- start main content -->
<article class="content-panel" id="main-content">
    <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'parts/page/content' ); ?>
        <div class="clear"></div>
    <?php endwhile; ?>
</article>

<?php 
// Get the default footer
get_footer();