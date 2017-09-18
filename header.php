<?php 
$sticky_header = (bool) get_theme_mod('sticky_header');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="bg-body-color">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- favicons -->
    <?php wp_head(); ?>
    <script>
        var hideHeaderOnScroll = <?php echo get_theme_mod('hide_header') ? 'true' : 'false' ; ?>;
    </script>
</head>

<!-- start page output -->
<body <?php body_class('font bg-body-color ' . get_theme_mod('layout') ); ?>>
   
    <!-- start siteloader -->
    <div id="siteloader" class="bg-body-color">
        <div class="spinner"></div>
    </div>
    <!-- end siteloader -->

    <!-- start top bar 
    <div id="top-bar" class="bg-body-color">
        Hello
    </div>
     end top bar -->

    <!-- start menu button -->
    <div class="toggler toggle-button top-bar-text-color" id="toggle">
        <span class="bg-top-bar-text-color bar top"></span>
        <span class="bg-top-bar-text-color bar middle"></span>
        <span class="bg-top-bar-text-color bar bottom"></span>
    </div>
    <!-- end menu button -->

    <!-- start search button -->
    <a href="#" id="search" class="toggler search-button">
        <span class="lnr lnr-magnifier top-bar-text-color"></span>
    </a>
    <!-- end search button -->

    <?php if( URNEXT_WOOCOMMERCE_ACTIVE ): ?>
    <!-- start cart -->
    <a href="<?php echo wc_get_cart_url(); ?>" id="cart" class="cart-button add-tooltip" title="Hello">
        <span class="lnr lnr-cart top-bar-text-color"></span>
        <?php if( WC()->cart->get_cart_contents_count() > 0 ): ?>
            <span class="count bg-header-color header-text-color"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
        <?php endif; ?>
    </a>
    <!-- end cart -->
    <?php endif; ?>

    <!-- start navbar -->
    <nav id="navbar" class="navbar navbar <?php if( $sticky_header ) echo 'sticky-top'; ?> navbar-light bg-top-bar-color">
        <div class="full-width">
            <a class="navbar-brand" href="<?php echo site_url(); ?>">
                <?php if( $logo = get_theme_mod('logo') ): ?>
                    <img src="<?php echo $logo; ?>" class="d-inline-block align-top" title="<?php echo get_bloginfo('name');?>" alt="<?php echo __('Logo','urnext'); ?> <?php echo get_bloginfo('name');?>">
                <?php else: ?>
                    <span class="top-bar-text-color"><?php echo get_bloginfo('name');?></span>
                <?php endif; ?>
            </a>
        </div>
    </nav>
    <!-- end navbar -->

    <!-- start search form -->
    <div class="overlay bg-menu-color" id="search-overlay">
        <div class="ontop container as-table full-height">
            <div class="row as-row full-height">
                <div class="col-md-12 as-cell full-height centered menu-text-color">
                    <form action="" method="post">
                        <input autocomplete="off" type="text" name="s" class="menu-text-color searchbar border-menu-text-color" value="<?php echo isset( $_POST['s'] ) && !empty( $_POST['s'] ) ? sanitize_text_field( $_POST['s'] ) : '' ; ?>" placeholder="<?php _e('Search the website...','urnext'); ?>">
                        <input type="submit" class="border-menu-text-color menu-text-color btn button center" value="<?php _e('search','urnext');?>">
                    </form>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!-- end search form -->

    <!-- start menu overlay -->
    <nav class="overlay bg-menu-color headadjust" id="overlay">
        <?php 
        wp_nav_menu(
            array(
                'theme_location'    => 'primary',
                'container'         => false,
                'menu_class'        => 'menu-text-color'
            )
        );
        ?>
    </nav>
    <!-- end menu overlay -->