<?php 
$particles  = (bool) get_theme_mod('particles_js'); 
$has_banner = has_post_thumbnail();
$style      = '';
$class      = 'auto-height';

if( $has_banner ):
    $class = 'has-banner';
    $style.= sprintf('background-image:url(%s)', get_the_post_thumbnail_url() );
endif;

if( is_singular() ): ?>
    <!-- start banner -->
    <div id="banner" class="content-panel home bg-header-color <?php echo $class; ?>" data-section-name="top" style="<?php echo $style; ?>;">
        
        <?php if( $particles ): ?>
            <!-- start particles.js -->
            <div id="particles-js"></div>
            <!-- end particles.js -->
        <?php endif; ?>
        
        <div id="header-overlay" class="bg-header-overlay-color"></div>
        <div class="ontop container as-table inset-content full-height">
            <div class="row as-row full-height">
                <div class="col-md-12 as-cell full-height centered header-text-color">
                    <h1 class="heading-font underline wid after-header-text-color wow fadeIn header-text-color light-weight headadjust" data-wow-duration="0.6s" data-wow-delay="0.3s"><?php the_title(); ?></h1>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div id="scroll-down" class="border-header-text-color">
            <span class="lnr lnr-chevron-down header-text-color"></span>
        </div>
    </div>
    <!-- end banner -->
<?php else: ?>
    <!-- start banner -->
    <div id="banner" class="content-panel home bg-header-color auto-height" data-section-name="top">

        <?php if( $particles ): ?>
            <!-- start particles.js -->
            <div id="particles-js"></div>
            <!-- ned particles.js -->
        <?php endif; ?>
        <div id="header-overlay" class="bg-header-overlay-color"></div>

        <div class="ontop container as-table inset-content full-height">
            <div class="row as-row full-height">
                <div class="col-md-12 as-cell full-height centered header-text-color">
                    <h1 class="heading-font wow fadeIn header-text-color light-weight headadjust" data-wow-duration="0.6s" data-wow-delay="0.3s">Hello World!</h1>
                    <p class="wow fadeIn header-text-color light-weight" data-wow-duration="0.6s" data-wow-delay="0.9s">
                        Lorum ipsum dolar amit...
                    </p>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div id="scroll-down" class="border-header-text-color">
            <span class="lnr lnr-chevron-down header-text-color"></span>
        </div>
    </div>
    <!-- end banner -->
<?php endif; ?>