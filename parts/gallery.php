
<?php if( function_exists('get_field') && $gallery = get_field('gallery') ): ?>
    <?php if( count( $gallery ) > 0 ): ?>
    <div class="slick-holder">
        <div class="slick-gallery" data-featherlight-gallery data-featherlight-filter="a">
            <?php foreach( $gallery as $gallery_item ): ?>
                <div class="slideitem">
                    <div class="slidecontent" style="background-image:url(<?php echo esc_url( $gallery_item['sizes']['large'] ); ?>);"></div>
                    <div class="caption bg-body-color text-color centered">
                        <a href="<?php echo esc_url( $gallery_item['url'] ); ?>" class="btn center-button button text-color">
                            <span class="lnr lnr-magnifier text-color"></span>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
<?php endif; ?>