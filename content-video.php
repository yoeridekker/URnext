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
            <div class="intro">
                <div class="container centered">

                    <!-- start the title -->    
                    <h1 class="headadjust light-weight underline after-text-color faded">
                        <?php the_title(''); ?>
                    </h1>
                    <!-- end the title -->

                    <div>
                        <?php _e('By','urnext'); ?>
                        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="btn center-button button small text-color border-text-color"><?php the_author(); ?></a>
                        <?php _e('on','urnext'); ?>
                        <a href="#" class="btn center-button button small text-color border-text-color"><?php the_date(); ?></a>
                        <?php _e('in','urnext'); ?> 
                        <?php 
                        $post_categories = wp_get_post_categories( get_the_ID() );
                        foreach( $post_categories as $cat_id ): $cat = get_category( $cat_id ); ?>
                            <a href="<?php echo esc_url( get_category_link( $cat_id ) ); ?>" class="btn center-button button small text-color border-text-color"><?php echo $cat->name; ?></a>
                        <?php endforeach; ?>
                    </div>
  
                    <?php if ( has_excerpt() ) : ?>
                        <!-- start the excerpt -->
                        <div class="archive-meta"><?php the_excerpt(); ?></div>
                        <!-- end the excerpt -->
                    <?php endif; ?>

                    <!-- start the tags -->
                    <?php the_tags( __('Tagged with', 'urnext') . ': <div class="buttons center-button small text-color border-text-color">', '', '</div>' ); ?> 
                    <!-- end the tags -->

                </div>
            </div>
        </div>
    </div>
</div>

<?php get_template_part('parts/gallery'); ?>

<div class="container">
    <div class="row">
        <div class="wow slideInLeft col-md-12 text-color" data-wow-offset="10" data-wow-delay="0s">
            
            <article id="post-<?php the_ID(); ?>" <?php post_class('textadjust'); ?>>
                <?php the_content(); ?>
                <?php 
                wp_link_pages( 
                    array(
                        'before' => '<div class="page-links buttons small">' . esc_html__( 'Pages:', 'urnext' ),
                        'after'  => '</div>',
                    )
                ); 
                ?>
            </article>

            <div class="wow slideInUp full-width text-color" data-wow-offset="10" data-wow-delay="0s">
                <div class="post-navigation ">
                    <div class="buttons left border-text-color text-color inherit-border"><?php previous_post_link('%link'); ?></div>
                    <div class="buttons right border-text-color text-color inherit-border" ><?php next_post_link('%link'); ?></div>
                </div>
            </div>

            <?php 
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ):
                comments_template();
            endif; 
            ?>
        </div>
    </div>
    <div class="clear"></div>
</div>