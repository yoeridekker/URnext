<?php 
$sticky_header = (bool) get_urnext_option('sticky_header');
$has_mobile_menu = wp_nav_menu(
    array(
        'echo' => false,
        'theme_location'=> 'mobile',
        'fallback_cb' => '__return_false' // Use the primary menu if mobile is undefined
    )
);
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="bg-body-color">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<!-- favicons -->
    <?php wp_head(); ?>
</head>

<!-- start page output -->
<body <?php body_class('no-overflow font bg-body-color ' . get_urnext_option('layout') ); ?>>
   
    <!-- start siteloader -->
    <div id="siteloader" class="bg-body-color">
        <ul id="spinners">
            <li class="selected">
                <?php echo urnext_get_spinner( get_urnext_option('page_loader') );?>
            </li>
        </ul>
    </div>
    <!-- end siteloader -->

    <!-- mobile menu -->
    <?php 
    wp_nav_menu(
        array(
            'container'         => 'nav',
            'container_id'      => 'meanmenu',
            'menu_id'           => 'meanmenu-menu',
            'theme_location'    => ( $has_mobile_menu ? 'mobile' : 'primary' )
        )
    ); 
    ?>
    <!-- end mobile menu -->

    <!-- start navbar -->
    <nav id="navbar" class="navbar navbar <?php if( $sticky_header ) echo 'sticky-top'; ?> navbar-light bg-top-bar-color">
        <div class="container" style="position:initial">
            <div class="row">
            <div class="col-lg-12">
            <!-- start branding -->
            <a class="navbar-brand" href="<?php echo site_url(); ?>">
                <?php if( $logo = get_urnext_option('logo') ): ?>
                    <img src="<?php echo $logo; ?>" class="d-inline-block align-top" title="<?php echo get_bloginfo('name');?>" alt="<?php echo esc_html__('Logo','urnext'); ?> <?php echo get_bloginfo('name');?>">
                <?php else: ?>
                    <span class="top-bar-text-color"><?php echo get_bloginfo('name');?></span>
                <?php endif; ?>
            </a>
            <!-- end branding -->

            <?php if( (int) get_urnext_option('main_menu_type') === 1 ): ?>
            <!-- start megadrop menu -->
            <?php wp_nav_menu(
                array(
                    'theme_location'    => 'primary',
                    'container'         => 'nav',
                    'container_id'      => 'megadropmenu',
                    'menu_id'           => 'menu-primary-menu',
                    'menu_class'        => 'mainmenu border-menu-color top-bar-text-color',
                    'walker'            => new MegaDrop_Walker_Nav_Menu()
                )
            ); ?>
            <!-- end megadrop menu -->
            <?php endif;?>

            <div class="side-actions">

                <!-- start search button -->
                <a href="#" id="search" class="toggler search-button">
                    <span class="lnr lnr-magnifier top-bar-text-color"></span>
                </a>
                <!-- end search button -->

                <!-- start search form -->
                <div class="overlay bg-menu-color" id="search-overlay">
                    <div class="ontop container as-table full-height">
                        <div class="row as-row full-height">
                            <div class="col-md-12 as-cell full-height centered menu-text-color">
                                <form action="<?php echo site_url(); ?>" method="get">
                                    <input autocomplete="off" id="urnext-searchinput"  type="text" name="s" class="menu-text-color searchbar border-menu-text-color" value="<?php echo isset( $_POST['s'] ) && !empty( $_POST['s'] ) ? sanitize_text_field( $_POST['s'] ) : '' ; ?>" placeholder="<?php esc_html_e('Search the website...','urnext'); ?>">
                                    <input type="submit" class="border-menu-text-color menu-text-color btn button center" value="<?php esc_html_e('search','urnext');?>">
                                </form>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <!-- end search form --> 

                <?php if( URNEXT_WOOCOMMERCE_ACTIVE ): ?>
                <!-- start cart -->
                <a href="#" id="urnext-cart" class="cart-button cart-tooltip" title="Hello">
                    <span class="lnr lnr-cart top-bar-text-color"></span>
                    <span class="count bg-header-color header-text-color" style="display:none;"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                </a>
                <!-- end cart -->
                <?php endif; ?>

                <?php if( (int) get_urnext_option('main_menu_type') === 2 ): ?>
                    <!-- start genie menu button -->
                    <div class="toggler toggle-button bg-menu-color menu-text-color transition03" id="toggle">
                        <span class="bg-menu-text-color bar top"></span>
                        <span class="bg-menu-text-color bar middle"></span>
                        <span class="bg-menu-text-color bar bottom"></span>
                    </div>
                    <!-- end genie menu button -->

                    <!-- start genie menu overlay -->
                    <nav class="overlay headadjust overlay-genie" id="genie-overlay" data-steps="m 701.56545,809.01175 35.16718,0 0,19.68384 -35.16718,0 z;m 698.9986,728.03569 41.23353,0 -3.41953,77.8735 -34.98557,0 z;m 687.08153,513.78234 53.1506,0 C 738.0505,683.9161 737.86917,503.34193 737.27015,806 l -35.90067,0 c -7.82727,-276.34892 -2.06916,-72.79261 -14.28795,-292.21766 z;m 403.87105,257.94772 566.31246,2.93091 C 923.38284,513.78233 738.73561,372.23931 737.27015,806 l -35.90067,0 C 701.32034,404.49318 455.17312,480.07689 403.87105,257.94772 z;M 51.871052,165.94772 1362.1835,168.87863 C 1171.3828,653.78233 738.73561,372.23931 737.27015,806 l -35.90067,0 C 701.32034,404.49318 31.173122,513.78234 51.871052,165.94772 z;m 52,26 1364,4 c -12.8007,666.9037 -273.2644,483.78234 -322.7299,776 l -633.90062,0 C 359.32034,432.49318 -6.6979288,733.83462 52,26 z;m 0,0 1439.999975,0 0,805.99999 -1439.999975,0 z">
                        <svg id="genie" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 1440 806" preserveAspectRatio="none">
                            <path class="pathfill-menu-color" d="m 701.56545,809.01175 35.16718,0 0,19.68384 -35.16718,0 z"/>
                        </svg>
                        <?php wp_nav_menu(
                            array(
                                'theme_location'    => 'primary',
                                'container'         => false,
                                'menu_class'        => 'mainmenu menu-text-color'
                            )
                        ); ?>
                    </nav>
                    <!-- end genie menu overlay -->
                <?php endif; ?>
                </div>
            </div>
            </div>
        </div>
    </nav>
    <!-- end navbar -->

    <!-- start page wrapper -->
    <section id="page-wrapper" class="bg-page-color">

        <!-- start banner wrapper -->
        <div id="banner-wrapper">