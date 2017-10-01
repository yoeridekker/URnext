<?php
/**
 * The default template for displaying page content
 *
 * Used for page.php
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
    <div class="row">
        <div data-wow-offset="10" data-wow-delay="0s" class="wow slideInLeft col-md-12 text-color">
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
    </div>
</div>
<div class="clear"></div>