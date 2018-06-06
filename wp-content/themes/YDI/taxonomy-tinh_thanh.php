<?php get_header(); ?>
    <div id="main-wrapper">
        <div id="main" class="clearfix">
            <aside id="sidebar-first" class="column sidebar" role="complementary" style="width:240px;">
                <div class="section">
                    <div class="region region-sidebar-first">
                        <section id="block-block-7" class="block block-block block-odd">
                            <div class="content">
                                <ul>
                                    <?php
                                    global $wp;
                                    $current_url = home_url(add_query_arg(array(),$wp->request)).'/';
                                    foreach( get_terms( 'tinh_thanh', array( 'hide_empty' => false, 'parent' => 0 ) ) as $parent_term ) {
                                        foreach( get_terms( 'tinh_thanh', array( 'hide_empty' => false, 'parent' => $parent_term->term_id ) ) as $child_term ) {
                                            if (strcmp($current_url, get_term_link($child_term)) == 0) {
                                                echo '<li style="background:url('.get_stylesheet_directory_uri().'/assets/images/sta.png) top left no-repeat; padding:0px 0px 5px 25px; color:#fff; font-weight:bold; font-size:13px;"><a href="'.get_term_link($child_term).'">';
                                            } else {
                                                echo '<li><a href="'.get_term_link($child_term).'">';
                                            }
                                            echo $child_term->name.' ('.$child_term->count.')';
                                            echo '</a></li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div><!-- /.content -->
                        </section>
                    </div><!-- /.section -->
            </aside><!-- /#sidebar-first -->

            <aside id="sidebar-second" class="column sidebar" role="complementary" style="width:774px;">
                <div class="section">
                    <div class="region region-sidebar-second">
                        <section id="block-block-7" class="block block-block block-odd">
                            <p style="background:#152C4A; border-radius:8px; -moz-border-radius:8px; -webkit-border-radius:8px; text-align:justify; color:#fff; padding:10px;">
                                <strong><?php the_archive_title( '<a class="page-title">', '</a>' );?></strong>
                            </p>
                            <div class="content">
                                <table class="teacher" cellspacing="0" cellpadding="0">
                                    <tbody>
                                    <tr class="tr">
                                        <td>TT</td>
                                        <td>Tên trường</td>
                                        <td>Địa chỉ</td>
                                        <td>Giáo viên tin học</td>
                                    </tr>
                                    <?php
                                    $idx = 1;
                                    while ( have_posts() ) : the_post();
                                        ?>
                                        <tr>
                                            <td><?php echo($idx); ?></td>
                                            <td><?php the_title();?></td>
                                            <td><?php the_field('diachi') ?></td>
                                            <td><?php the_field('giao_viên_tin_học') ?></td>
                                        </tr>
                                    <?php
                                        $idx++;
                                    endwhile;
                                    ?>
                                    </tbody>
                                </table>
                            </div><!-- /.content -->
                        </section><!-- /.block -->
                    </div><!-- /.section -->
            </aside><!-- /#sidebar-second -->
            <div id="content" class="column" role="main">




            </div><!-- /#content -->
        </div><!-- /#main -->
    </div>
<?php get_footer(); ?>