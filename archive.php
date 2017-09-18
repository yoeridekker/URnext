<?php 

// Get the default header 
get_header();

// Get the banner for the archive
get_template_part('parts/banner'); 

// Get the breadcrumbs
get_template_part('parts/breadcrumbs');

$i = 0;
?>

<!-- start main content -->
<div class="content-panel" data-section-name="content" id="main-content">

<?php if ( have_posts() ) : ?>

    <div class="archive-intro intro">
        <div class="container centered">
            <?php the_archive_title( '<h1 class="archive-title light-weight centered underline after-text-color faded">', '</h1>' ); ?>
            <?php if ( category_description() ) : ?>
                <div class="archive-meta centered"><?php echo category_description(); ?></div>
            <?php endif; ?>
            <div class="centered">
                <a href="#" class="btn center-button button text-color border-text-color">Hello</a>
                <a href="#" class="btn center-button button text-color border-text-color">World</a>
            </div>
        </div>
    </div>

    <div class="grid">

        <!-- set grid sizer, do not remove! -->
        <div class="sizer"></div>
        
        <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part('loop','post'); ?>
        
        <?php $i++; endwhile; ?>

    </div>
 
<?php else: ?>
    <p><?php _e('Sorry, no posts matched your criteria.', 'urnext'); ?></p>
<?php endif; ?>

</div>
<?php
// Get the default footer
get_footer();
?>