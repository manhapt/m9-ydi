<?php
/**
 * Template Name: Document
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<?php get_header(); ?>
    <div id="main-wrapper">
        <div id="main" class="clearfix">
            <div id="sidebar-first" class="column sidebar">
                <div class="section">
                    <div class="region region-sidebar-second">
                        <?php
                        while (have_posts()) : the_post();
                            ?>
                            <section id="block-block-7" class="block block-block block-odd">
                                <h2>
                                    <?php the_title(sprintf('<a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a>'); ?>
                                </h2>
                                <div style="float:left; width:100%">
                                    <?php the_content(); ?>
                                    <div class="panel-pane pane-custom pane-1" style="border-top: 1px solid #2f568a; padding: 15px 0px;">
                                        <?php
                                            $posts = get_posts(array(
                                                'post_type' => 'tai_lieu',
                                                'nopaging' => true, // to show all posts in this taxonomy, could also use 'numberposts' => -1 instead
                                            ));
                                            foreach($posts as $post):
                                                get_template_part( 'theme-parts/post/content', 'tailieu' );
                                            endforeach;
                                        ?>
                                    </div>
                                </div>
                            </section>
                            <?php
                        endwhile;
                        ?>
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