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

// Set the sidebar to false by default 
$sidebar = false;

// Try to get the overwrite from the page
$show_sidebar = urnext_get_meta( $post->ID, 'show_sidebar' );

// Check if the overwrite is default
if( $show_sidebar === 'yes' || $show_sidebar === 'no' ){
    $sidebar = ( $show_sidebar === 'yes' ) ? 'page_sidebar' : false ;
}else{
    $sidebar = (int) get_urnext_option( 'page', 'show_sidebars' ) === 1 ? 'page_sidebar' : false ;
}

$has_sidebar = $sidebar ? is_active_sidebar( $sidebar ) : false ;
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
        <div data-wow-offset="10" data-wow-delay="0s" class="wow slideInLeft <?php echo $has_sidebar ? 'col-lg-9' : 'col-md-12';?> text-color">
            <div id="post-<?php the_ID(); ?>" <?php post_class('article-content text-color border-text-color'); ?>>
                <?php the_content(); ?>
                <div class="clear"></div>
            </div>
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

        <?php if ( $has_sidebar ) : ?>
            <!-- primary-sidebar -->
            <aside id="sidebar" data-wow-delay="0s" data-wow-offset="10" class="wow textadjust slideInRight col-lg-3 text-color right-sidebar widget-area" role="complementary">
                <div id="inner-sidebar">
                    <div class="sidebar__inner">
                        <?php dynamic_sidebar( $sidebar ); ?>
                    </div>
                </div>
                <div class="clear"></div>
            </aside>
            <!-- #primary-sidebar -->
        <?php endif; ?>
        
    </div>
</div>
<div class="clear"></div>