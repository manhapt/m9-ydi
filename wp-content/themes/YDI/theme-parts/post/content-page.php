<?php
/**
 * Template part for displaying page post in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<div class="views-row">
    <article id="node-<?php the_ID(); ?>"
             class="node node-news-events node-teaser node-odd published with-comments node-teaser clearfix">
        <header>
            <?php the_title(sprintf('<h5><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h5>'); ?>
        </header>
        <div class="content">
            <div class="field field-name-field-image-events field-type-image field-label-hidden">
                <div class="field-items">
                    <div class="field-item even">
                        <?php the_post_thumbnail('single-post-thumbnail'); ?>
                    </div>
                </div>
            </div>
            <div class="field field-name-body field-type-text-with-summary field-label-hidden">
                <div class="field-items">
                    <div class="field-item even">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . __('Pages:', 'twentyseventeen'),
                            'after' => '</div>',
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div><!-- .enposttent -->
    </article><!-- #post-## -->
</div>
