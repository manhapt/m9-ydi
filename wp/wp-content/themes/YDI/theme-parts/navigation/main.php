<div class="region region-menu">
    <div id="block-superfish-1" class="block block-superfish block-odd">
        <div class="content">
            <?php
            wp_nav_menu(
                array(
                    'theme_location'  => 'top',
                    'menu'            => '',
                    'container'       => false,
                    'container_class' => 'menu-{menu slug}-container',
                    'container_id'    => '',
                    'menu_class'      => 'menu',
                    'menu_id'         => '',
                    'echo'            => true,
                    'fallback_cb'     => 'wp_page_menu',
                    'before'          => '',
                    'after'           => '',
                    'link_before'     => '',
                    'link_after'      => '',
                    'items_wrap'      => '<ul id="superfish-1" class="sf-menu main-menu sf-horizontal sf-style-default sf-total-items-7 sf-parent-items-1 sf-single-items-6">%3$s</ul>',
                    'depth'           => 0,
                    'walker'          => ''
                )
            );
            ?>
        </div><!-posttent -->
    </div><!-- /.block -->
</div>