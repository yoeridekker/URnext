<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>



<div class="wow slideInDown col-md-12 text-color" data-wow-offset="100" data-wow-duration="1s" data-wow-delay="0s">
    <div class="archive-intro intro">
        <div class="container centered">
            <h1 class="archive-title light-weight underline after-text-color faded">
                <?php the_title(''); ?>
            </h1>
            <?php if ( has_excerpt() ) : ?>
                <div class="archive-meta"><?php the_excerpt(); ?></div>
            <?php endif; ?>
            <div>
                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="btn center-button button text-color border-text-color"><?php _e('By','urnext'); ?>: <?php the_author(); ?></a>
                <a href="#" class="btn center-button button text-color border-text-color">World</a>
            </div>
        </div>
    </div>
</div>


<div data-wow-offset="10" data-wow-delay="0s" class="wow slideInLeft <?php echo is_active_sidebar( 'right_sidebar' ) ? 'col-lg-8' : 'col-md-12';?> text-color">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php the_content(); ?>
    </article>
</div>

<?php if ( is_active_sidebar( 'right_sidebar' ) ) : ?>
    <div id="sidebar" data-wow-delay="0s" data-wow-offset="10" class="wow slideInRight col-lg-4 text-color right-sidebar widget-area" role="complementary">
        <?php dynamic_sidebar( 'right_sidebar' ); ?>
    </div><!-- #primary-sidebar -->
<?php endif; ?>

