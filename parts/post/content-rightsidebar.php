<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package URnext
 * @since URnext 1.0
 */

global $post;
?>

<div class="container">
    <div class="row">
        <div id="main-article" class="col-md-9 text-color">
        <div class="intro">

                <!-- start the title -->    
                <h1 class="headadjust underline after-text-color faded wide">
                    <span class="sub-before"><?php echo date_i18n( get_option( 'date_format' ), get_the_time('U') ); ?></span>
                    <?php the_title(''); ?>
                </h1>
                <!-- end the title -->

                <!-- start the meta --> 
                <?php get_template_part('parts/meta'); ?>
                <!-- end the meta --> 

            </div>
            <div id="post-<?php the_ID(); ?>" <?php post_class('article-content text-color border-text-color'); ?>>
                <?php the_content(); ?>
                <div class="clear"></div>

                <?php get_template_part('parts/link-pages'); ?>
                <div class="clear"></div>

                <!-- start the tags -->
                <?php the_tags( '<div class="buttons marged center-button small text-color border-text-color"><span class="tagged">' . esc_html__('Tagged with', 'urnext'), '</span>', '</div>' ); ?> 
                <!-- end the tags -->
                <div class="clear"></div>
            </div>
            
            <div class="full-width text-color">
                <div class="post-navigation">
                    <div class="buttons left border-text-color text-color inherit-border"><?php previous_post_link('%link'); ?></div>
                    <div class="buttons right border-text-color text-color inherit-border" ><?php next_post_link('%link'); ?></div>
                    <div class="clear"></div>
                </div>
            </div>

            <?php 
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ):
                comments_template();
            endif; 
            ?>
        </div>

        
        <aside id="sidebar" class="textadjust col-md-3 text-color right-sidebar widget-area" role="complementary">
            <div id="inner-sidebar">
                <?php dynamic_sidebar('right_sidebar'); ?>
            </div>
        </aside><!-- #primary-sidebar -->
        
    </div>
    <div class="clear"></div>
</div>