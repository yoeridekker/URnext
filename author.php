<?php 

// Set global for posts loop counter
global $i;

// Get the default header 
get_header();

// Get the banner for the author archive
get_template_part('parts/no-banner'); 

// Get the breadcrumbs
$show_breadcrumbs = get_urnext_option( 'author', 'show_breadcrumbs' );
if( (int) $show_breadcrumbs === 1){
    get_template_part('parts/breadcrumbs');
}

// Loop the authors posts
$i = 0;
?>

<!-- start main content -->
<div class="content-panel" data-section-name="content" id="main-content">

<?php if ( have_posts() ) : ?>

    <div class="grid">

        <!-- set grid sizer, do not remove! -->
        <div class="sizer"></div>
        
        <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part('loop','post'); ?>
        
        <?php $i++; endwhile; ?>

    </div>
 
<?php else: ?>

    <?php get_template_part('loop','none'); ?>

<?php endif; ?>

</div>

<?php
// Get the default footer
get_footer();