<?php
/**
 * 
 * This template part is used to display the posts pagination for the search page
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

if( $prev_posts || $next_posts ): ?>
    <!-- start posts pagination -->
    <div id="posts-pagination">
        <div class="container">
            <div class="row fix-gutters">

                <div class="col-md-6 header-text-color">
                    <?php if( $prev_posts ): ?>
                        <div class="buttons right border-text-color text-color inherit-border">
                            <?php previous_posts_link( 'Newer search results' ); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6 header-text-color">
                    <?php if( $next_posts ): ?>
                        <div class="buttons left border-text-color text-color inherit-border">
                            <?php next_posts_link( 'Older search results', 0 ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- end posts pagination -->
<?php endif; ?>