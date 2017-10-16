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

// Set the sidebar to false by default 
$sidebar = false;

// Try to get the overwrite from the page
$show_sidebar = urnext_get_meta( $post->ID, 'show_sidebar' );

// Check if the overwrite is default
if( $show_sidebar === 'yes' || $show_sidebar === 'no' ){
    $sidebar = ( $show_sidebar === 'yes' ) ? 'right_sidebar' : false ;
}else{
    $sidebar = (int) get_urnext_option( 'post', 'show_sidebars' ) === 1 ? 'right_sidebar' : false ;
}

$has_sidebar = $sidebar ? is_active_sidebar( $sidebar ) : false ;

?>
<div class="container">
    <div class="row">
        <div class="col-md-12 text-color" data-wow-offset="100" data-wow-duration="1s" data-wow-delay="0s">
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
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="<?php echo $has_sidebar ? 'col-md-9' : 'col-md-12';?> text-color">
            
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

        <?php if ( $has_sidebar ) : ?>
            <aside id="sidebar" class="textadjust col-md-3 text-color right-sidebar widget-area" role="complementary">
                <div id="inner-sidebar">    
                    <?php dynamic_sidebar( $sidebar ); ?>
                </div>
            </aside>
        <?php endif; ?>

       

    </div>
    <div class="clear"></div>
</div>