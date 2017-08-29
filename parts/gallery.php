
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
        <div class="slick-gallery" data-featherlight-gallery data-featherlight-filter="a">
            <?php foreach( $gallery_items as $gallery_item ): ?>
                
                <?php if( has_post_thumbnail( $gallery_item->ID ) ): ?>
                    <div class="slideitem">
                        <img src="<?php echo get_the_post_thumbnail_url( $gallery_item->ID, 'large' ); ?>"> 
                        <div class="caption bg-body-color text-color centered as-table">
                            <div class="as-row">
                                <div class="as-cell centered text-color">
                                    <h4 class="heading-font blocked text-color light-weight"><?php echo $gallery_item->post_title; ?></h4>
                                    <a href="<?php echo get_the_post_thumbnail_url( $gallery_item->ID, 'full' ); ?>" class="btn center-button button text-color">
                                        <span class="lnr lnr-magnifier text-color"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--
                        <img src="<?php echo get_the_post_thumbnail_url( $gallery_item->ID, 'large' ); ?>">
                        <div class="caption bg-body-color text-color centered">
                            <h4><?php echo $gallery_item->post_title; ?></h4>
                            <div class="blocked"><?php echo apply_filters('the_content', $gallery_item->post_content ); ?></div>
                            <a href="#" class="btn center-button button small text-color border-text-color">View</a>
                        </div>
-->
                    </div>
                <?php endif; ?>

            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

<?php endif; ?>

