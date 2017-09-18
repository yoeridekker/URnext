<?php

// Set global for posts loop counter
global $i;

// Get the default header 
get_header();

// Get the banner for the category archive
get_template_part('parts/banner'); 

// Get the breadcrumbs
$show_breadcrumbs = get_urnext_option( 'category', 'show_breadcrumbs' );
if( (int) $show_breadcrumbs === 1){
    get_template_part('parts/breadcrumbs');
}
?>
<!-- start main content -->
<div class="content-panel" data-section-name="content" id="main-content">

    <?php 
    $i = 0;

    if ( have_posts() ) : ?>

        <div class="archive-intro intro">
            <div class="container centered">
                <h1 class="archive-title light-weight centered underline after-text-color faded">
                    <?php single_cat_title(''); ?>
                </h1>
                <?php if ( category_description() ) : ?>
                    <div class="archive-meta centered"><?php echo category_description(); ?></div>
                <?php endif; ?>
                <div class="centered">
                    <a href="#" class="btn center-button button text-color border-text-color">Hello</a>
                    <a href="#" class="btn center-button button text-color border-text-color">World</a>
                </div>
            </div>
        </div>

        <!-- start the grid -->
        <div class="grid">

            <!-- set grid sizer, do not remove! -->
            <div class="sizer"></div>
            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part('loop','post'); ?>

            <?php $i++; endwhile; ?>

        </div>
        <!-- end the grid -->

        <?php get_template_part('parts/pagination'); ?>

    <?php else: ?>

        <?php get_template_part('loop','none'); ?>

    <?php endif; ?>

</div>

<?php
// Get the default footer, ommit php closing tag for header output
get_footer();