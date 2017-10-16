<?php
/**
 * The right sidebar template for displaying page/post content
 *
 * Used on template-right-sidebar.php
 *
 * @package URnext
 * @since URnext 1.0.0
 *
**/

global $post;

?>

<div class="container">
    <div class="row">
        <div class="wow slideInDown col-md-12 text-color" data-wow-offset="100" data-wow-duration="1s" data-wow-delay="0s">
            <div class="archive-intro intro">
                <div class="container centered">
                    <h1 class="archive-title underline after-text-color faded">
                        <?php the_title(''); ?>
                    </h1>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<div class="container">
    <div class="row" id="sidebar-container">
        <div data-wow-offset="10" data-wow-delay="0s" class="wow slideInLeft col-lg-9 text-color">
            <article id="post-<?php the_ID(); ?>" <?php post_class('article-content text-color border-text-color'); ?>>
                <?php the_content(); ?>
                <div class="clear"></div>
            </article>
            <?php get_template_part('parts/link-pages'); ?>
            <div class="clear"></div>

            <?php 
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ):
                comments_template();
            endif; 
            ?>
            <div class="clear"></div>
        </div>

      
        <!-- primary-sidebar -->
        <aside id="sidebar" data-wow-delay="0s" data-wow-offset="10" class="wow textadjust slideInRight col-lg-3 text-color right-sidebar widget-area" role="complementary">
            <div id="inner-sidebar">
                <div class="sidebar__inner">
                    <?php dynamic_sidebar( 'right_sidebar' ); ?>
                </div>
            </div>
            <div class="clear"></div>
        </aside>
        <!-- #primary-sidebar -->

        
    </div>
</div>
<div class="clear"></div>