<div id="pages-links">
<?php wp_link_pages( 
    array(
        'before'            => '<div class="centered page-links buttons center-button small text-color border-text-color">',
        'after'             => '</div>',
        'next_or_number'    => 'next',
        'nextpagelink'      => __( 'Next page', 'urnext'),
        'previouspagelink'  => __( 'Previous page', 'urnext'),
    )
); ?>
</div>