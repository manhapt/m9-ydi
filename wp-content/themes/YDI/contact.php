<?php
/**
 * Template Name: Full Width Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<?php get_header(); ?>
    <div id="main-wrapper">
        <div id="main" class="clearfix">
            <div id="content" class="column" role="main">
                <div class="panel-flexible panels-flexible-1 clearfix" id="contacts">
                    <?php
                    while ( have_posts() ) : the_post();

                        get_template_part( 'theme-parts/page/content', 'page' );

                        // If comments are open or we have at least one comment, load up the comment templates.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;

                    endwhile; // End of the loop.
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>