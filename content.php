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



<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <?php the_title(); ?>
    <?php the_content(); ?>
</article><!-- #post-## -->
