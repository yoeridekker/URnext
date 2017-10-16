<?php 

// Get the default header 
get_header();

// Get the banner for the archive
get_template_part('parts/no-banner'); 

// Get the breadcrumbs
get_template_part('parts/breadcrumbs');

?>

</div>
<!-- end banner wrapper -->

<!-- start main content -->
<div class="content-panel" id="main-content">

<?php if ( have_posts() ) : ?>

    <div class="intro">
        <div class="container centered">
            <?php the_archive_title( '<h1 class="centered underline after-text-color faded">', '</h1>' ); ?>
            <?php if ( category_description() ) : ?>
                <div class="archive-meta centered"><?php echo category_description(); ?></div>
            <?php endif; ?>
        </div>
    </div>

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
    <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'urnext'); ?></p>
<?php endif; ?>

</div>
<?php
// Get the default footer
get_footer();
?>