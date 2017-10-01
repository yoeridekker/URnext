<?php
/**
 * 
 * This template part is used to display the posts pagination
 * 
 * @package     URnext
 * @since       1.0.0
 * @version     1.0.0
 * @author      Yoeri Dekker
 */

// Get previous posts page
$prev_posts = get_previous_posts_link();

// Get next posts page
$next_posts = get_next_posts_link();

// Get the pagination type (ajax|normal), defaults to 'normal'
$pagination_type = get_urnext_option('pagination_type');

// Get layout 
$layout = (int) get_urnext_option('grid_layout') === 1 ? 'grid' : 'list' ;

if( $pagination_type === 'ajax' ): ?>

    <?php if( $next_posts ): ?>
        <!-- start ajax posts pagination -->
        <div id="posts-pagination">
            <div class="container">
                <div class="row">

                    <div class="col-md-12 header-text-color centered">
                        <button 
                            data-type="post" 
                            data-search="<?php echo get_query_var('s', 0); ?>"
                            data-year="<?php echo get_query_var('year', 0); ?>" 
                            data-month="<?php echo get_query_var('monthnum', 0); ?>" 
                            data-day="<?php echo get_query_var('day', 0); ?>" 
                            data-author="<?php echo get_query_var('author', 0); ?>" 
                            data-category="<?php echo get_query_var('cat', 0); ?>" 
                            data-tag="<?php echo get_query_var('tag', 0); ?>" 
                            data-layout="<?php echo $layout; ?>"
                            id="urnext-loadmore" 
                            class="button border-text-color text-color center">Load more
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end ajax posts pagination -->
    <?php endif; ?>

<?php else: ?>

    <?php if( $prev_posts || $next_posts ): ?>
        <!-- start posts pagination -->
        <div id="posts-pagination">
            <div class="container">
                <div class="row">

                    <div class="col-md-6 header-text-color">
                        <?php if( $prev_posts ): ?>
                            <div class="buttons right border-text-color text-color inherit-border">
                                <?php previous_posts_link( '< Newer Entries' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6 header-text-color">
                        <?php if( $next_posts ): ?>
                            <div class="buttons left border-text-color text-color inherit-border">
                                <?php next_posts_link( 'Older Entries >', 0 ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- end posts pagination -->
    <?php endif; ?>

<?php endif; ?>