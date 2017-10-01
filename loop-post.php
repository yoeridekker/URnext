<?php 

// Globals
global $post; 

$class      = '';
$layout     = (int) get_urnext_option('grid_layout') === 1 ? 'grid' : 'list' ;
$type       = get_post_format();
$imgagesize = $layout === 'grid' ? 'large' : 'medium' ;
$image      = has_post_thumbnail() ? get_the_post_thumbnail_url( null, $imgagesize) : false ;
$class     .= $image ? ' image' : ' no-image' ;
$class     .= ' post-format-' . $type;
$style      = $image ? sprintf('background-image:url(%s);', $image ) : '' ;
?>

<?php if( $layout === 'grid' ): ?>

    <!-- start grid item -->
    <article class="<?php echo urnext_grid_column_classes(); ?> border-page-color grid-item<?php echo $class; ?>" style="<?php echo $style; ?>">
        <div class="inner primary-text-color">
            <h3 class="primary-text-color"><?php the_title(); ?></h3>
            <span class="date primary-text-color"><?php the_time( get_option('date_format') ) ?></span>
            <?php if( (int) get_urnext_option('grid_show_excerpt') === 1 && has_excerpt() ): ?>
                <?php the_excerpt(); ?>
            <?php endif; ?>
            <div class="centered primary-text-color">
                <a href="<?php the_permalink(); ?>" class="primary-text-color btn center-button button small"><?php _e('Read more', 'urnext'); ?></a>
            </div>
        </div>
        <div class="corner bg-primary-color"></div>
    </article>
    <!-- end grid item -->

<?php else: ?>

    <!-- start list item -->
    <article class="list-item<?php echo $class; ?>">
        <div class="bg-primary-color slide-panel" style="<?php echo $style; ?>"></div>
        <a href="<?php the_permalink(); ?>">
            <h3 class="text-color"><?php the_title(); ?></h3>
        </a>
        <span class="date text-color textadjust"><?php the_time( get_option('date_format') ) ?></span>
        <div class="text-color textadjust">
            <a href="<?php the_permalink(); ?>" class="textadjust border-text-color text-color btn center-button button small">
                <?php _e('Read more', 'urnext'); ?>
            </a>
        </div>
    </article>
    <div class="bordered border-text-color"></div>
    <!-- end list item -->

<?php endif; ?>