<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
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
                    <?php if ( has_excerpt() ) : ?>
                        <div class="archive-meta"><?php the_excerpt(); ?></div>
                    <?php endif; ?>
                    <div>
                        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="btn center-button button text-color border-text-color"><?php _e('By','urnext'); ?>: <?php the_author(); ?></a>
                        <?php 
                        $post_categories = wp_get_post_categories( get_the_ID() );
                        foreach( $post_categories as $cat_id ): $cat = get_category( $cat_id ); ?>
                            <a href="#" class="btn center-button button text-color border-text-color"><?php echo $cat->name; ?></a>
                        <?php endforeach; ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_template_part('parts/gallery'); ?>

<div class="container">
    <div class="row">
        <div data-wow-offset="10" data-wow-delay="0s" class="wow slideInLeft <?php echo is_active_sidebar( 'right_sidebar' ) ? 'col-lg-8' : 'col-md-12';?> text-color">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php the_content(); ?>
            </article>

            <?php 
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ):
                comments_template();
            endif; 
            ?>
        </div>

        <?php if ( is_active_sidebar( 'right_sidebar' ) ) : ?>
            <div id="sidebar" data-wow-delay="0s" data-wow-offset="10" class="wow slideInRight col-lg-4 text-color right-sidebar widget-area" role="complementary">
                <?php dynamic_sidebar( 'right_sidebar' ); ?>
            </div><!-- #primary-sidebar -->
        <?php endif; ?>

        <div class="wow slideInUp col-md-12 text-color" data-wow-offset="100" data-wow-duration="1s" data-wow-delay="0s">
            <div class="post-navigation ">
                <div class="buttons left border-text-color text-color"><?php previous_post_link('%link'); ?></div>
                <div class="buttons right border-text-color text-color" ><?php next_post_link('%link'); ?></div>
            </div>
        </div>

    </div>
    <div class="clear"></div>
</div>