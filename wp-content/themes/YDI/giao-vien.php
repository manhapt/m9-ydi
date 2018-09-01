<?php
/**
 * Template Name: Teacher
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
                        while ( have_posts() ) : the_post();
                        ?>
                        <section id="teacher-section" class="block block-block block-odd">
                            <h2>
                                <?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' );?>
                            </h2>
                            <div style="float:left; width:100%">
                                <?php the_content(); ?>
                                <div class="panel-pane pane-custom pane-1" style="border-top:1px solid #2f568a; padding:15px 0px" >
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td align="center"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/map.png" /></td>
                                            <td align="center">
                                                <?php
                                                foreach( get_terms( 'tinh_thanh', array( 'hide_empty' => false, 'parent' => 0 ) ) as $parent_term ) {
                                                    echo '<div style="background:#396395; padding: 15px; text-align:left; border-radius:10px;-moz-border-radius:10px;-webkit-border-radius:10px; margin:20px 0px"><ul>';
                                                    foreach( get_terms( 'tinh_thanh', array( 'hide_empty' => false, 'parent' => $parent_term->term_id ) ) as $child_term ) {
                                                        echo '<li style="background:url('.get_stylesheet_directory_uri().'/assets/images/sta.png) top left no-repeat; padding:0px 0px 5px 25px; color:#fff; font-weight:bold;">';
                                                        echo '<a href="'.get_term_link($child_term).'">';
                                                        echo $child_term->name.' ('.$child_term->count.')';
                                                        echo '</a></li>';
                                                    }
                                                    echo '</ul></div>';
                                                }
                                                ?>
                                            </td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                        <?php
                        endwhile;
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