<?php 
// Get the default header 
get_header();
?>

<?php 
// Get the banner for the category archive
get_template_part('parts/banner'); 
?>
<!-- start main content -->
<div class="content-panel" data-section-name="content" id="main-content">

<?php 
$i = 0;

if ( have_posts() ) : ?>

    <div class="archive-intro intro">
        <div class="container centered">
            <h1 class="archive-title light-weight centered underline after-text-color faded">
                <?php single_cat_title(''); ?>
            </h1>
            <?php if ( category_description() ) : ?>
                <div class="archive-meta centered"><?php echo category_description(); ?></div>
            <?php endif; ?>
            <div class="centered">
                <a href="#" class="btn center-button button text-color border-text-color">Hello</a>
                <a href="#" class="btn center-button button text-color border-text-color">World</a>
            </div>
        </div>
    </div>

    <div class="grid">

        <!-- set grid sizer, do not remove! -->
        <div class="sizer"></div>
        
        <?php while ( have_posts() ) : the_post(); ?>

            <?php 
            // Define the archive inline styles
            $class = ( $i % 3 == 0 ) ? ' half' : '' ;
            $bg    = get_post_meta('background_color');
            $color = get_post_meta('text_color');
            $image = has_post_thumbnail() ? get_the_post_thumbnail_url() : false ;
            $class.= $image ? ' image' : ' no-image' ;
            $style = $image ? sprintf('background-image:url(%s);', $image ) : '' ;
            $style.= $bg ? sprintf('background-color: %s;', $bg ) : '' ;
            $style.= $color ? sprintf('color: %s;', $color ) : '' ;
            ?>
            
            <!-- start grid item -->
            <div class="grid-item<?php echo $class; ?>" style="<?php echo $style; ?>">
                <div class="inner header-text-color ">
                    <h3 class="headadjust header-text-color "><?php the_title(); ?></h3>
                    <span class="date header-text-color  textadjust"><?php the_time( get_option('date_format') ) ?></span>
                    <div class="centered header-text-color ">
                        <a href="<?php the_permalink(); ?>" class="textadjust header-text-color btn center-button button"><?php _e('Read more', 'urnext'); ?></a>
                    </div>
                </div>
                <div class="corner bg-header-color"></div>
            </div>
            <!-- end grid item -->
        
        <?php $i++; endwhile; ?>

    </div>
 
<?php else: ?>
    <p><?php _e('Sorry, no posts matched your criteria.', 'urnext'); ?></p>
<?php endif; ?>

</div>

<?php
// Get the default footer
get_footer();
?>