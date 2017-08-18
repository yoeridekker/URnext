<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php wp_title(); ?></title>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- favicons -->
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-body-color'); ?>>
    <div id="siteloader"></div>
    <!-- Image and text -->
    <nav id="navbar" class="navbar navbar sticky-top navbar-light bg-faded bg-header-color">
        <div class="full-width">
            <a class="navbar-brand" href="<?php echo site_url(); ?>">
                <?php if( $logo = get_theme_mod('logo') ): ?>
                    <img src="<?php echo $logo; ?>" class="d-inline-block align-top" title="<?php echo get_bloginfo('name');?>" alt="<?php echo __('Logo','urnext'); ?> <?php echo get_bloginfo('name');?>">
                <?php endif; ?>
                <span class="header-text-color">URnext</span>
            </a>
            <div class="toggle-button header-text-color" id="toggle">
                <span class="bg-header-text-color bar top"></span>
                <span class="bg-header-text-color bar middle"></span>
                <span class="bg-header-text-color bar bottom"></span>
            </div>
        </div>
    </nav>
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

    <?php 
    $style = 'height:9999px;';
    if( has_post_thumbnail() ):
        $style.= sprintf('background-image:url(%s)', get_the_post_thumbnail_url() );
    endif; 
    ?>
    <!-- start the first panel -->
    <div class="content-panel home bg-body-color" data-section-name="top" style="<?php echo $style; ?>;">
        <!-- particles.js container -->
        <div id="particles-js"></div>
        <div class="container as-table inset-content full-height">
            <div class="row as-row full-height">
                <div class="col-md-12 as-cell full-height centered">
                    <h1 class="wow fadeIn text-color light-weight" data-wow-duration="0.6s" data-wow-delay="0.3s">Hello World!</h1>
                    <p class="wow fadeIn text-color light-weight" data-wow-duration="0.6s" data-wow-delay="0.9s">
                        Lorum ipsum dolar amit...
                    </p>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!-- end the first panel -->

    <!-- start the content panel -->
    <div class="content-panel" data-section-name="content">