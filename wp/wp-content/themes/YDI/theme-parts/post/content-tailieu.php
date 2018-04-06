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
<div class="tailieu">
<?php the_post_thumbnail( 'tailieu-post-thumbnail' ); ?>
<?php the_title( sprintf( '<h5><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );?>
</div>
