<?php
// Get the default header 
get_header();

// Start the Loop.
while ( have_posts() ) : the_post(); ?>

    <div class="container">
        <div class="row">

            <?php 
            /*
            * Include the post format-specific template for the content. If you want to
            * use this in a child theme, then include a file called called content-___.php
            * (where ___ is the post format) and that will be used instead.
            */
            get_template_part( 'content', get_post_format() );
            ?>
        </div>
        <div class="clear"></div>
    </div>

<?php endwhile;

// Get the default footer
get_footer();
?>