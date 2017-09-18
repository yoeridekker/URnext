<?php
// Get the default header 
get_header();

// Get the banner
get_template_part('parts/banner');

// Get the breadcrumbs
$show_breadcrumbs = get_urnext_option( 'post', 'show_breadcrumbs' );
if( (int) $show_breadcrumbs === 1){
    get_template_part('parts/breadcrumbs');
}
?>

<!-- start main content -->
<div class="content-panel" data-section-name="content" id="main-content">

<?php 
// Start the Loop.
while ( have_posts() ) : the_post(); ?>

    <?php 
    /*
    * Include the post format-specific template for the content. If you want to
    * use this in a child theme, then include a file called called content-___.php
    * (where ___ is the post format) and that will be used instead.
    */
    get_template_part( 'content', get_post_format() );
    ?>

<?php endwhile; ?>

</div>

<?php
// Get the default footer
get_footer();