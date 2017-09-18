<?php
/**
 * The default template for displaying page content
 *
 * Used for page.php
 *
 * @package URnext
 * @since URnext 1.0
 */
?>

<div class="container">
    <div class="row">
        <div class="wow slideInDown col-md-12 text-color" data-wow-offset="100" data-wow-duration="1s" data-wow-delay="0s">
            <div class="archive-intro intro">
                <div class="container centered">
                    <h1 class="archive-title light-weight underline after-text-color faded">
                        <?php the_title(''); ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_template_part('parts/gallery'); ?>

<div class="container">
    <div class="row">
        <div data-wow-offset="10" data-wow-delay="0s" class="wow slideInLeft <?php echo is_active_sidebar( 'page_sidebar' ) ? 'col-lg-8' : 'col-md-12';?> text-color">
            <article id="post-<?php the_ID(); ?>" <?php post_class('textadjust'); ?>>
                <?php the_content(); ?>
                <div class="clear"></div>
                <?php wp_link_pages( 
                    array(
                        'before' => '<div class="centered page-links">' . esc_html__( 'Pages:', 'urnext' ),
                        'after'  => '</div>',
                    )
                ); ?>
            </article>

            <?php 
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ):
                comments_template();
            endif; 
            ?>
        </div>

        <?php if ( is_active_sidebar( 'page_sidebar' ) ) : ?>
            <!-- primary-sidebar -->
            <div id="sidebar" data-wow-delay="0s" data-wow-offset="10" class="wow textadjust slideInRight col-lg-4 text-color right-sidebar widget-area" role="complementary">
                <?php dynamic_sidebar( 'page_sidebar' ); ?>
            </div>
            <!-- #primary-sidebar -->
        <?php endif; ?>
    </div>
</div>
<div class="clear"></div>