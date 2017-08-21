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

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
            ?>
        </div>
        <div class="clear"></div>
    </div>

<?php endwhile;

// Get the default footer
get_footer();
?>