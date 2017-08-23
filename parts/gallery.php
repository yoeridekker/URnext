
<?php if( function_exists('get_field') && $gallery = get_field('gallery') ): ?>
    
    <?php 
    $gallery_items = get_posts(
        array(
            'showposts' => -1,
            'post_type' => 'gallery',
            'tax_query' => array(
                array(
                    'taxonomy' => 'galleries',
                    'field' => 'term_id',
                    'terms' => $gallery,
                )
            )
        )
    );
    //print_r( $gallery_items ); 
    ?>

    <?php if( count( $gallery_items ) > 0 ): ?>
    <div class="slick-holder">
        <div class="slick-gallery">
            <?php foreach( $gallery_items as $gallery_item ): ?>
                
                <?php if( has_post_thumbnail( $gallery_item->ID ) ): ?>
                    <div>
                        <img src="<?php echo get_the_post_thumbnail_url( $gallery_item->ID, 'large' ); ?>">
                    </div>
                <?php endif; ?>

            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

<?php endif; ?>