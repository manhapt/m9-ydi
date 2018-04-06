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
<tr>
    <td><?php $id ?></td>
    <td><?php the_title();?></td>
    <td><?php the_field('diachi') ?></td>
    <td><?php the_field('giao_viên_tin_học') ?></td>
</tr>