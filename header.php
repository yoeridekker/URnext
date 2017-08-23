<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php wp_title(); ?></title>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- favicons -->
    <?php wp_head(); ?>
</head>
<body <?php body_class('font bg-body-color ' . get_theme_mod('layout') ); ?>>
    <div id="siteloader" class="bg-body-color"></div>

    <div class="toggle-button top-bar-text-color" id="toggle">
        <span class="bg-top-bar-text-color bar top"></span>
        <span class="bg-top-bar-text-color bar middle"></span>
        <span class="bg-top-bar-text-color bar bottom"></span>
    </div>

    <a href="#" id="search" class="search-button">
        <span class="lnr lnr-magnifier top-bar-text-color"></span>    
    </a>

    <!-- Image and text -->
    <nav id="navbar" class="navbar navbar sticky-top navbar-light bg-top-bar-color">
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
    <nav class="overlay bg-menu-color" id="overlay">
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

    <?php get_template_part('parts/banner'); ?>

    <!-- start the content panel -->
    <div class="content-panel" data-section-name="content" id="main-content">