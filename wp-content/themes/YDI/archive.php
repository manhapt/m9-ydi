<?php get_header(); ?>
    <div id="main-wrapper">
        <div id="main" class="clearfix">
            <div id="sidebar-first" class="column sidebar">
                <div class="section">
                    <div class="region region-sidebar-second">
                        <?php if ( have_posts() ) : ?>
                            <header class="page-header">
                                <?php
                                echo '<h4>';
                                echo str_replace("Chuyên mục: ", "", get_the_archive_title());
                                the_archive_description( '<div class="taxonomy-description">', '</div>' );
                                echo '</h4>';
                                ?>
                            </header><!-- .page-header -->
                        <?php endif; ?>
                        <?php
                        while ( have_posts() ) : the_post();

                            get_template_part( 'theme-parts/post/content', 'page' );

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