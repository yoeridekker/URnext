<header class="meta">

    <span class="by">
        <span class="lnr lnr-user"></span>
        <span><?php _e('Written by','urnext'); ?></span>
        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php _e('Written by','urnext'); ?> <?php the_author(); ?>"><?php the_author(); ?></a>
    </span>

    <span class="on">
        <span class="lnr lnr-calendar-full"></span>
        <span><?php _e('Published on','urnext'); ?></span>
        <a href="<?php echo get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ); ?>" title="<?php _e('Published on','urnext'); ?> <?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></a>
    </span>

    <span class="in">
        <span class="lnr lnr-tag"></span>
        <span><?php _e('Posted in','urnext'); ?></span>
        <?php the_category( ', ', 'single' ); ?>
    </span>

    <?php if ( has_excerpt() ) : ?>
        <!-- start the excerpt -->
        <summary class="excerpt"><?php the_excerpt(); ?></summary>
        <!-- end the excerpt -->
    <?php endif; ?>

</header>