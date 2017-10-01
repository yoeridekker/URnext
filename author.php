<?php 

// Get the default header 
get_header();

// Get the banner for the author archive
get_template_part('parts/no-banner');

// Get the breadcrumbs
$show_breadcrumbs = (int) get_urnext_option('breadcrumbs');
$hide_breadcrumbs = (int) get_urnext_option( 'author', 'hide_breadcrumbs' );
if( $show_breadcrumbs === 1 && $hide_breadcrumbs !== 1 ){
    get_template_part('parts/breadcrumbs');
}
?>

</div>
<!-- end banner wrapper -->

<!-- start main content -->
<div class="content-panel" id="main-content">

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

</div>

<?php
// Get the default footer
get_footer();