<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>


<!--
<article id="post-<?php the_ID(); ?>" <?php post_class('container inset-content'); ?>>
    
    <?php the_title(); ?>
    <?php the_content(); ?>
</article><
-->

<div class="grid">
    <?php 
    $string = '
        <div class="grid-item" style="background-image:url(https://unsplash.it/400?image=529);">
            <div class="inner">
                <h3>Working on heights</h3>
                <p>Some short text for this tile...</p>
                <span class="date">15 feb. 2017</span>
            </div>
            <div class="corner"></div>
        </div>
        <div class="grid-item no-image"><div class="inner">hello</div><div class="corner"></div></div>
        <div class="grid-item half" style="background-image:url(https://unsplash.it/600?image=625);"><div class="inner">goodbye</div><div class="corner"></div></div>
        <div class="grid-item no-image"><div class="inner">hello</div><div class="corner"></div></div>
        <div class="grid-item" style="background-image:url(https://unsplash.it/300?image=527);"><div class="inner">hello</div><div class="corner"></div></div>
        <div class="grid-item no-image"><div class="inner">hello</div><div class="corner"></div></div>
    ';
    echo str_repeat( $string , 4 ); ?>
</div>
