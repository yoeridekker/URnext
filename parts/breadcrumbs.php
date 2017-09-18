<?php
/**
 * 
 * This template part is used to display the breadcrumbs
 * 
 * The breadcrumbs are generated by calling the_breadcrumb(), this function
 * can be found in the theme's functions.php file.
 *
 * @package     URnext
 * @since       1.0.0
 * @version     1.0.0
 * @author      Yoeri Dekker
 */
?>
<!-- start breadcrumbs -->
<div id="breadcrumbs" class="bg-header-color">
    <div class="container">
        <div class="row">
            <div class="col-md-12 header-text-color <?php echo get_urnext_option('breadcrumbs_align'); ?>">
                <?php echo the_breadcrumb(); ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<!-- end breadcrumbs -->