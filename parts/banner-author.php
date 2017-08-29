<?php 
$particles  = get_theme_mod('particles_js'); 
?>
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
                <?php the_archive_title( '<h1 class="heading-font underline wid after-header-text-color wow fadeIn header-text-color light-weight headadjust">', '</h1>' ); ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<!-- end the first panel -->

<!-- start the content panel -->
<div class="content-panel" data-section-name="content" id="main-content">