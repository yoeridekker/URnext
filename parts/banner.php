<?php 
$particles  = get_theme_mod('particles_js'); 
$has_banner = has_post_thumbnail();
$style      = 'height:9999px;';
if( $has_banner ):
    $style.= sprintf('background-image:url(%s)', get_the_post_thumbnail_url() );
endif;

?>

<?php if( $has_banner && ( is_page() || is_single() ) ): ?>
    <!-- start the first panel -->
    <div class="content-panel home bg-header-color" data-section-name="top" style="<?php echo $style; ?>;">
        
        <?php if( $particles ): ?>
            <!-- particles.js container -->
            <div id="particles-js"></div>
        <?php endif; ?>
        
        <div id="header-overlay" class="bg-header-overlay-color"></div>
        <div class="ontop container as-table inset-content full-height">
            <div class="row as-row full-height">
                <div class="col-md-12 as-cell full-height centered header-text-color">
                    <h1 class="heading-font wow fadeIn header-text-color light-weight" data-wow-duration="0.6s" data-wow-delay="0.3s">Hello World!</h1>
                    <p class="wow fadeIn header-text-color light-weight" data-wow-duration="0.6s" data-wow-delay="0.9s">
                        Lorum ipsum dolar amit...
                    </p>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!-- end the first panel -->
<?php else: ?>
    <!-- start the first panel -->
    <div class="content-panel home bg-header-color auto-height" data-section-name="top">

        <?php if( $particles ): ?>
            <!-- particles.js container -->
            <div id="particles-js"></div>
        <?php endif; ?>
        <div id="header-overlay" class="bg-header-overlay-color"></div>

        <div class="ontop container as-table inset-content full-height">
            <div class="row as-row full-height">
                <div class="col-md-12 as-cell full-height centered header-text-color">
                    <h1 class="heading-font wow fadeIn header-text-color light-weight" data-wow-duration="0.6s" data-wow-delay="0.3s">Hello World!</h1>
                    <p class="wow fadeIn header-text-color light-weight" data-wow-duration="0.6s" data-wow-delay="0.9s">
                        Lorum ipsum dolar amit...
                    </p>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!-- end the first panel -->
<?php endif; ?>