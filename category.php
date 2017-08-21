<?php
// Get the default header 
get_header();

$i = 0;

if ( have_posts() ) : ?>

    <div class="archive-intro intro">
        <div class="container">
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
    <div class="sizer"></div>
    
    <?php while ( have_posts() ) : the_post(); ?>

    <?php 
    $class = ( $i % 3 == 0 ) ? ' half' : '' ;
    if( $i === 0 ) $class = ' full';
    $class.= has_post_thumbnail() ? '' : ' no-image' ;
    $style = has_post_thumbnail() ? get_the_post_thumbnail_url() : '' ;
    ?>
        <div class="grid-item<?php echo $class; ?>" style="background-image:url(<?php echo $style; ?>)">
            
            <div class="inner">
                <h3><?php the_title(); ?></h3>
                <!--<p><?php the_excerpt(); ?></p>-->
                <span class="date"><?php the_time('F jS, Y') ?></span>
                <span class="author">by <?php the_author_posts_link() ?></span>
                <div class="centered">
                    <a href="<?php the_permalink(); ?>" class="btn center-button button text-color border-text-color">Read more</a>
                </div>
            </div>
            <div class="corner"></div>
        </div>
    
    <?php $i++; endwhile; ?>

    </div>
 
<?php else: ?>
    <p>Sorry, no posts matched your criteria.</p>
<?php endif; 

// Get the default footer
get_footer();
?>