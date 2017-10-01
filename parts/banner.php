<?php 
/**
 * Banner template part
 *
 * @package URnext
 * @since 1.0.0
 */

// Get the post
global $post;

// Show banner, by default (bool) true
$banner = true;

// Check for overwrite
$select_banner = (string) urnext_get_meta( get_the_ID(), 'urnext_select_banner' );
if( $select_banner === 'none' ):
    $banner = false;
endif;

// Get the shortcode
$shortcode = (string) urnext_get_meta( get_the_ID(), 'urnext_banner_shortcode' );

// Get the caption
$caption = (string) urnext_get_meta( get_the_ID(), 'urnext_banner_caption' );

// Set caption styling
$caption_style = '';

// Caption class
$caption_class = 'container';

// Get caption width
$caption_width = (string) urnext_get_meta( get_the_ID(), 'urnext_caption_width' );
if( $caption_width !== '' ){
    $caption_style.= sprintf('width: %s%s;', $caption_width, '%' );
    $caption_class = '';
}

// Get caption background color and opacity
$caption_background = (string) urnext_get_meta( get_the_ID(), 'urnext_caption_background_color' );
$caption_opacity    = (string) urnext_get_meta( get_the_ID(), 'urnext_caption_background_opacity' );
if( $caption_background !== '' ){
    if( $caption_opacity !== '' ){
        $caption_style.= sprintf('background-color: %s;', urnext_hex2rgba( $caption_background, ( (int) $caption_opacity / 100 ) ) );
    }else{
        $caption_style.= sprintf('background-color: %s;', $caption_background );
    }
}

// Caption left offset
$caption_left_offset = (string) urnext_get_meta( get_the_ID(), 'urnext_caption_left_offset' );
if( $caption_left_offset !== '' ){
    $caption_style.= sprintf('left: %s%s;', $caption_left_offset, '%' );
}

// Check if we have a featured image for the banner
$has_banner = has_post_thumbnail();

// Get the banner image if we have a featured image
$banner_image = $has_banner ? get_the_post_thumbnail_url( null , 'urnext-banner' ) : false ;

// check for overwrite 
$overwrite_banner = urnext_get_meta( get_the_ID(), 'urnext_banner_image' );

// Check if we have an overwrite
if( $overwrite_banner ):
    //var_dump( $overwrite_banner );
    $has_banner     = true;
    $banner_image   = $overwrite_banner['sizes']['urnext-banner'];
endif;

// Default style
$style = '';

// Default class
$class = 'auto-height';

// Set background image and remove auto-height class
if( $has_banner ):
    $class = 'has-banner';
    $style.= sprintf('background-image:url(%s)', esc_url( $banner_image ) );
endif;

// Add overwrites for home of frontpage
$home_banner = (string) get_header_image();
if( is_home() && $home_banner !== '' ):
    
    $caption = (string) get_urnext_option( 'header_caption_text' );
    
    $class = 'has-banner';
    $banner = true;
    $has_banner = true;
    $style.= sprintf('background-image:url(%s)', esc_url( $home_banner ) );
endif;


if( $banner ): ?>

    <?php if( $select_banner === 'shortcode' ): ?>
        <!-- start banner -->
        <div id="banner" class="content-panel bg-header-color auto-height">
            <?php echo do_shortcode( $shortcode ); ?>
        </div>
        <!-- end banner -->

    <?php elseif( $has_banner || $caption ): ?>

        <!-- start banner -->
        <div id="banner" class="content-panel bg-header-color <?php echo $class; ?>" style="<?php echo $style; ?>;">
            
            <div id="header-overlay" class="bg-header-overlay-color"></div>
            
            <?php if( !$has_banner || $caption ): ?>
                <!-- start caption -->
                <div style="<?php echo $caption_style; ?>" class="wow fadeInDownBig ontop header-text-color as-table inset-content full-height <?php echo $caption_class; ?>" data-wow-duration="0.8s" data-wow-delay="0.5s">
                    <div class="row as-row full-height">
                        <div class="col-md-8 as-cell full-height">
                            <div class="buttons center-button inherit-border after-header-text-color header-text-color">
                                <?php echo apply_filters('the_content',$caption); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="clear"></div>
                </div>
                <!-- end caption -->
            <?php endif; ?>
            
            <!-- start scroll down button -->
            <div id="scroll-down" class="border-header-text-color">
                <span class="lnr lnr-chevron-down header-text-color"></span>
            </div>
            <!-- end scroll down button -->

        </div>
        <!-- end banner -->

    <?php else: ?>
         <!-- start no-banner -->
        <div id="no-banner" class="content-panel bg-header-color"></div>
        <!-- end nobanner -->
    <?php endif; ?>

<?php else: ?>
    <!-- start no-banner -->
    <div id="no-banner" class="content-panel bg-header-color"></div>
    <!-- end nobanner -->
<?php endif; ?>