
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
    if( is_active_sidebar( 'left_footer' ) ) {
        $footer_count++;
    }else{
        unset( $footer_widgets[$footer_key] );
    }
}

// Calculate the footer widget width class
$footer_width = ( 12 / $footer_count );
$footer_width_class = sprintf('col-sm-6 col-md-%s', $footer_width );

?>
<!-- start footer -->
<footer class="footer bg-footer-color footer-text-color">
    <div class="container">
        <div class="row">
        <?php foreach( $footer_widgets as $footer_widget ): ?>
            <div class="<?php echo $footer_width_class; ?> text-color widget-area border-footer-text-color">
                <?php dynamic_sidebar( $footer_widget ); ?>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6 footer-text-color widget-area border-footer-text-color">
                    Hello world
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->
<?php wp_footer(); ?>
</body>
</html>