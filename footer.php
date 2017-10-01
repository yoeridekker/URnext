</section>
<?php 
// Footer layout
$footer_widgets = array(
    'left_footer',
    'middle_left_footer',
    'middle_right_footer',
    'right_footer'
);

// Footer widget count
$footer_count = 0;
foreach( $footer_widgets as $footer_key => $footer_widget ){
    if( is_active_sidebar( $footer_widget ) ) {
        $footer_count++;
    }else{
        unset( $footer_widgets[$footer_key] );
    }
}

// Calculate the footer widget width class
$footer_width = $footer_count > 0 ? ( 12 / $footer_count ) : 12 ;
$footer_width_class = sprintf('col-md-6 col-lg-%s', $footer_width );

?>
<!-- start footer -->
<footer id="footer" class="border-footer-border-color footer bg-footer-color footer-text-color">
    <div class="container">
        <div class="row">
        <?php if( $footer_count > 0 ): ?>
            <?php foreach( $footer_widgets as $footer_widget ): ?>
                <div class="<?php echo $footer_width_class; ?> footer-column border-footer-border-color text-color widget-area">
                    <?php dynamic_sidebar( $footer_widget ); ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
    </div>

    <div class="copyright border-footer-border-color">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 text-left footer-text-color widget-area border-footer-text-color">
                    <?php echo get_urnext_option('copyright_text');?>
                </div>  

                <div class="col-md-6 col-sm-6 text-right footer-text-color widget-area border-footer-text-color">
                    <div class="float-right">
                        <?php if( (int) get_urnext_option('footer_social_icons') === 1 ): ?>
                            <?php echo urnext_social_icons('margedleft', 'as-inline-block float-right', 'padded5'); ?>
                        <?php endif; ?>
                    </div>
                    <?php if( (int) get_urnext_option('footer_menu') === 1 ): ?>
                        <?php wp_nav_menu(
                            array(
                                'theme_location'    => 'disclaimer',
                                'container'         => false,
                                'menu_id'           => 'menu-disclaimer-menu',
                                'menu_class'        => 'float-right footer-text-color border-footer-text-color',
                                'fallback_cb'       => '__return_false'
                            )
                        ); ?>
                    <?php endif; ?>
                </div>
                
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->
<?php wp_footer(); ?>
</body>
</html>