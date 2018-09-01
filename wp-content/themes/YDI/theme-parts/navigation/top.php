<div id="block-menu-menu-secondary-menu" class="block block-menu block-even">
    <div class="content">
        <?php
        wp_nav_menu(
            array(
                'theme_location'  => 'second',
                'menu'            => '',
                'container'       => false,
                'container_class' => '{menu slug}',
                'container_id'    => '',
                'menu_class'      => 'menu',
                'menu_id'         => '',
                'echo'            => true,
                'fallback_cb'     => 'wp_page_menu',
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      => '<ul class="menu clearfix">%3$s</ul>',
                'depth'           => 0,
                'walker'          => ''
            )
        );
        ?>
    </div>
</div>