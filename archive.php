<?php 

// Get the default header 
get_header();

$i = 0;

if ( have_posts() ) : ?>

    <div class="archive-intro intro">
        <div class="container centered">
            <?php the_archive_title( '<h1 class="archive-title light-weight centered underline after-text-color faded">', '</h1>' ); ?>
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
            $bg    = get_field('background_color');
            $color = get_field('text_color');
            $image = has_post_thumbnail() ? get_the_post_thumbnail_url() : false ;
            $class.= $image ? ' image' : ' no-image' ;
            $style = $image ? sprintf('background-image:url(%s);', $image ) : '' ;
            $style.= $bg ? sprintf('background-color: %s;', $bg ) : '' ;
            $style.= $color ? sprintf('color: %s;', $color ) : '' ;
            ?>
            
            <!-- start grid item -->
            <div class="grid-item<?php echo $class; ?>" style="<?php echo $style; ?>">
                <div class="inner">
                    <h3 class="headadjust"><?php the_title(); ?></h3>
                    <span class="date textadjust"><?php the_time( get_option('date_format') ) ?></span>
                    <div class="centered">
                        <a href="<?php the_permalink(); ?>" class="textadjust btn center-button button"><?php _e('Read more', 'urnext'); ?></a>
                    </div>
                </div>
                <div class="corner bg-body-color"></div>
            </div>
            <!-- end grid item -->
        
        <?php $i++; endwhile; ?>

    </div>
 
<?php else: ?>
    <p><?php _e('Sorry, no posts matched your criteria.', 'urnext'); ?></p>
<?php endif; 

// Get the default footer
get_footer();
?>