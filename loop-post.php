<?php 

// Globals
global $post, $i; 

// Define the archive inline styles
$class = ( $i % 3 == 0 ) ? ' half' : '' ;
if( $i === 0 ){
    $class = ' half';
}

$type       = get_post_format();
$image      = has_post_thumbnail() ? get_the_post_thumbnail_url() : false ;
$class     .= $image ? ' image' : ' no-image' ;
$class     .= ' post-format-' . $type;
$style      = $image ? sprintf('background-image:url(%s);', $image ) : '' ;
$fittext    = ( $class === 'half' ) ? 'headadjust' : 'textadjust' ;
?>
<!-- start grid item -->
<div class="grid-item<?php echo $class; ?>" style="<?php echo $style; ?>">
    <div class="inner header-text-color ">
        <h3 class="<?php echo $fittext; ?> header-text-color "><?php the_title(); ?></h3>
        <span class="date header-text-color textadjust"><?php the_time( get_option('date_format') ) ?></span>
        <div class="centered header-text-color textadjust">
            <a href="<?php the_permalink(); ?>" class="textadjust header-text-color btn center-button button small"><?php _e('Read more', 'urnext'); ?></a>
        </div>
    </div>
    <div class="corner bg-header-color"></div>
</div>
<!-- end grid item -->