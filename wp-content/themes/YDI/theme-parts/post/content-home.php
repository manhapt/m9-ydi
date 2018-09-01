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

<div style="float:left; width:100%">
    <div style="float:left; margin:0px 10px 10px 0px; width:236px;"><?php the_post_thumbnail('single-post-thumbnail'); ?></div>
    <div style="float:left; margin:0px; width:372px;">
        <h5><?php the_title(); ?></h5>
        <div style="text-align:justify; color:#fff">
            <?php the_content(); ?>
        </div>
    </div>
</div>
