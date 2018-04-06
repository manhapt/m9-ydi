<?php get_header(); ?>
    <div id="main-wrapper">
        <div id="main" class="clearfix">
            <?php if (is_active_sidebar('block-block-6')) : ?>
                <div id="block-block-6" class="block block-block block-odd" role="complementary">
                    <?php dynamic_sidebar('block-block-6'); ?>
                </div>
            <?php endif; ?>
            <?php if (is_active_sidebar('block-views-info-blocks-block')) : ?>
                <div id="block-views-info-blocks-block" class="block block-views block-even">
                    <div class="content">
                        <div class="view view-info-blocks view-id-info_blocks view-display-id-block view-dom-id-d998b6809ee6dc54d53b1d7bf3a0fe9f">
                            <div class="view-content">
                                <?php dynamic_sidebar('block-views-info-blocks-block'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div id="sidebar-first" class="column sidebar">
                <div class="section">
                    <div class="region region-sidebar-second">
                        <section id="block-block-7" class="block block-block block-odd">
                            <h2>BÁO CHÍ</h2>
                            <div class="content">
                            <?php
                            $check = true;
                            $args = array( 'posts_per_page' => 7, 'category' => 53 );
                            $myposts = get_posts( $args );
                            foreach ( $myposts as $post ) : setup_postdata( $post );
                                if($check) {
                                    get_template_part('theme-parts/post/content', 'home');
                                    $check = false;
                                } else {
                                    the_title( sprintf( '<li><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></li>' );
                                }
                            endforeach; // End of the loop.
                            ?>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <?php if (is_active_sidebar('sidebar-second')) : ?>
                <div id="sidebar-second" class="column sidebar">
                    <div class="section">
                        <div class="region region-sidebar-second">
                            <?php dynamic_sidebar('sidebar-second'); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php get_footer(); ?>