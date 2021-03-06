<?php
/**
 * This template will produce a template with a fullwidth layout
 * The content is stretched over the complete container width and shows no sidebars
 *
 * Template Name: Contact Page Compressed
 * Template Post Type: page
 *
 * @package URnext
 * @since 1.0.0
 */

$show_map = (int) get_urnext_option('show_map');

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
    <?php 
    // Start the Loop.
    while ( have_posts() ) : the_post(); ?>

        <div class="container">
            <div class="row">
                <div class="wow slideInDown col-md-12 text-color" data-wow-offset="100">
                    <div class="archive-intro intro">
                        <div class="container centered">
                            <h1 class="archive-title underline after-text-color faded">
                                <?php the_title(''); ?>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        
        <div class="container">
            <div class="row">
                <div data-wow-offset="100" class="wow slideInLeft col-md-<?php echo $show_map === 1 ? '5' : '12' ; ?> text-color">
                    <div id="post-<?php the_ID(); ?>" <?php post_class('article-content text-color border-text-color'); ?>>
                        <?php the_content(); ?>
                        <div class="clear"></div>
                        <?php get_template_part('parts/link-pages'); ?>
                        <div class="clear"></div>
                    </div>
                </div>

                <?php if( $show_map === 1 ): ?>
                    <div data-wow-offset="100" class="wow slideInright col-md-7 text-color">
                        <div id="contact-map"></div>
                    </div>
                <?php endif; ?>
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
    <?php endwhile; ?>
</article>

<?php 
// Get the default footer
get_footer();