<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package URnext
 * @since 1.0.0
 */

// Set global for posts loop counter
global $i;

// Get the default header 
get_header();

// Get the banner for the archive
get_template_part('parts/no-banner'); 

// Get the breadcrumbs
$show_breadcrumbs = get_urnext_option( 'search', 'show_breadcrumbs' );
if( (int) $show_breadcrumbs === 1){
    get_template_part('parts/breadcrumbs');
}

$i = 0;
?>

<!-- start main content -->
<div class="content-panel" data-section-name="content" id="main-content">

    <div class="archive-intro intro">
        <div class="container centered">
            <h1 class="headadjust light-weight centered underline after-text-color faded">
                <?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', '_s' ), '<span>' . get_search_query() . '</span>' );
				?>    
            </h1>
        </div>
    </div>

    <?php if ( have_posts() ) : ?>

        <!-- start the grid -->
        <div class="grid">
        
            <!-- set grid sizer, do not remove! -->
            <div class="sizer"></div>
            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part('loop','post'); ?>

            <?php $i++; endwhile; ?>

        </div>
        <!-- end the grid -->

        <?php get_template_part('parts/pagination', 'search'); ?>
    
    <?php else: ?>
        <?php get_template_part('loop','none'); ?>
    <?php endif; ?>
</div>

<?php
// Get the default footer
get_footer();