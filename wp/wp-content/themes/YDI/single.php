<?php get_header(); ?>
    <div id="main-wrapper">
        <div id="main" class="clearfix">
            <div id="sidebar-first" class="column sidebar">
                <div class="section">
                    <div class="region region-sidebar-second">
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
            <?php if ( is_active_sidebar( 'sidebar-second' ) ) : ?>
                <div id="sidebar-second" class="column sidebar">
                    <div class="section">
                        <div class="region region-sidebar-second">
                            <?php dynamic_sidebar( 'sidebar-second' ); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php get_footer(); ?>