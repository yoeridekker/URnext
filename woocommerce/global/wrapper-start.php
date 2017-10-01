<?php
/**
 * Content wrappers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @author 		Yoeri Dekker
 * @package 	URnext
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Get the banner for the category archive
get_template_part('parts/no-banner');

// Get the breadcrumbs
$show_breadcrumbs = (int) get_urnext_option('breadcrumbs');
$hide_breadcrumbs = (int) get_urnext_option('shop', 'hide_breadcrumbs' );
if( $show_breadcrumbs === 1 && $hide_breadcrumbs !== 1 ){
    get_template_part('parts/breadcrumbs');
}
?>

</div>
<div class="content-panel" data-section-name="content" id="main-content">

<div class="container">
    <div class="row" role="main">