<?php
// Get the default header 
get_header();

// Get the banner
get_template_part('parts/banner');

// Start the Loop.
while ( have_posts() ) : the_post(); ?>
    <?php 
        /*
        * Include the post format-specific template for the content. If you want to
        * use this in a child theme, then include a file called called content-___.php
        * (where ___ is the post format) and that will be used instead.
        */
        get_template_part( 'content', 'page' );
    ?>
    <div class="clear"></div>

<?php endwhile;

// Get the default footer
get_footer();
?>