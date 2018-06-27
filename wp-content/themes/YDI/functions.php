<?php
/**
 * Created by PhpStorm.
 * User: comficker
 * Date: 11/18/17
 * Time: 15:17
 */


add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );
add_image_size( 'single-post-thumbnail', 227, 132 );
add_image_size( 'tailieu-post-thumbnail', 310, 445 );
function custom_nav_class($classes, $item){
    $classes[] = "custom-class-".$item->menu_order;
    return $classes;
}
//add_filter('nav_menu_css_class' , 'custom_nav_class' , 0 , 0);
register_nav_menus( array(
    'top'    => __( 'Top Menu', 'YDI' ),
    'social' => __( 'Social Links Menu', 'YDI' ),
) );

register_nav_menus( array(
    'second'    => __( 'Second Menu', 'YDI' ),
    'social' => __( 'Social Links Menu', 'YDI' ),
) );

function atg_menu_classes($classes, $item, $args) {

    if($args->theme_location == 'top') {
        $classes[] = 'middle even sf-depth-1 sf-no-children';
    }
    return $classes;
}
add_filter('nav_menu_css_class','atg_menu_classes',1,3);
function atg_menu_second_classes($classes, $item, $args) {

    if($args->theme_location == 'second') {
        $classes[] = 'leaf';
    }
    return $classes;
}
add_filter('nav_menu_css_class','atg_menu_second_classes',1,3);

register_sidebar( array(
    'name' => __( 'Sidebar First', 'YDI' ),
    'id' => 'sidebar-first',
    'description' => __( 'The first sidebar', 'YDI' ),
    'before_widget' => '<div class="content">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
) );

register_sidebar( array(
    'name' => __( 'Sidebar Second', 'YDI' ),
    'id' => 'sidebar-second',
    'description' => __( 'The second sidebar', 'YDI' ),
    'before_widget' => '<section id="block-block-7" class="block block-block block-odd">',
    'after_widget' => '</section>',
    'before_title' => '<h2>',
    'after_title' => '</h2>',
) );

register_sidebar( array(
    'name' => __( 'Blog 6 Homepage', 'YDI' ),
    'id' => 'block-block-6',
    'description' => __( 'The first sidebar', 'YDI' ),
    'before_widget' => '<div class="content">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
) );

register_sidebar( array(
    'name' => __( '3 block in homepage', 'YDI' ),
    'id' => 'block-views-info-blocks-block',
    'description' => __( 'The second sidebar', 'YDI' ),
    'before_widget' => '<div class="views-row">',
    'after_widget' => '</div>',
    'before_title' => '<div class="views-field views-field-title"><span class="field-content">',
    'after_title' => '</span></div>',
) );

register_sidebar( array(
    'name' => __( 'Footer', 'YDI' ),
    'id' => 'footer',
    'description' => __( 'The footer sidebar', 'YDI' ),
    'before_widget' => '<div style="float: right; text-align:right; width:600px;">',
    'after_widget' => '</div>',
    'before_title' => '<h5>',
    'after_title' => '</h5>',
) );

// Register Custom Taxonomy
function ydi_tinh_thanh() {

    $labels = array(
        'name'                       => _x( 'Tỉnh Thành', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Tỉnh Thành', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Tỉnh thành', 'text_domain' ),
        'all_items'                  => __( 'Tất cả', 'text_domain' ),
        'parent_item'                => __( 'Parent Item', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
        'new_item_name'              => __( 'Thêm mới', 'text_domain' ),
        'add_new_item'               => __( 'Thêm mới', 'text_domain' ),
        'edit_item'                  => __( 'Sửa', 'text_domain' ),
        'update_item'                => __( 'Cập nhập', 'text_domain' ),
        'view_item'                  => __( 'Xem', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Items', 'text_domain' ),
        'search_items'               => __( 'Search Items', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No items', 'text_domain' ),
        'items_list'                 => __( 'Items list', 'text_domain' ),
        'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
    );
	$args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
	register_taxonomy( 'tinh_thanh', array( 'giao_vien' ), $args );

}
add_action( 'init', 'ydi_tinh_thanh', 0 );

function tao_custom_post_type()
{

    /*
     * Biến $label để chứa các text liên quan đến tên hiển thị của Post Type trong Admin
     */
    $label = array(
        'name' => 'Trường học', //Tên post type dạng số nhiều
        'singular_name' => 'Trường học' //Tên post type dạng số ít
    );

    /*
     * Biến $args là những tham số quan trọng trong Post Type
     */
    $args = array(
        'labels' => $label, //Gọi các label trong biến $label ở trên
        'description' => 'Trường học', //Mô tả của post type
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'author',
            'thumbnail',
            'comments',
            'trackbacks',
            'revisions',
            'custom-fields'
        ), //Các tính năng được hỗ trợ trong post type
        'taxonomies' => array( 'tinh_thanh' ), //Các taxonomy được phép sử dụng để phân loại nội dung
        'hierarchical' => false, //Cho phép phân cấp, nếu là false thì post type này giống như Post, true thì giống như Page
        'public' => true, //Kích hoạt post type
        'show_ui' => true, //Hiển thị khung quản trị như Post/Page
        'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
        'show_in_nav_menus' => true, //Hiển thị trong Appearance -> Menus
        'show_in_admin_bar' => true, //Hiển thị trên thanh Admin bar màu đen.
        'menu_position' => 5, //Thứ tự vị trí hiển thị trong menu (tay trái)
        'menu_icon' => '', //Đường dẫn tới icon sẽ hiển thị
        'can_export' => true, //Có thể export nội dung bằng Tools -> Export
        'has_archive' => true, //Cho phép lưu trữ (month, date, year)
        'exclude_from_search' => false, //Loại bỏ khỏi kết quả tìm kiếm
        'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
        'capability_type' => 'post' //
    );

    register_post_type('teacher', $args); //Tạo post type với slug tên là sanpham và các tham số trong biến $args ở trên

}
/* Kích hoạt hàm tạo custom post type */
add_action('init', 'tao_custom_post_type');

// Register Custom Post Type
function tai_lieu() {

$labels = array(
    'name'                  => _x( 'Tài liệu', 'Post Type General Name', 'text_domain' ),
    'singular_name'         => _x( 'Tài liệu', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'             => __( 'Tài liệu', 'text_domain' ),
    'name_admin_bar'        => __( 'Tài liệu', 'text_domain' ),
    'archives'              => __( 'Item Archives', 'text_domain' ),
    'attributes'            => __( 'Item Attributes', 'text_domain' ),
    'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
    'all_items'             => __( 'All Items', 'text_domain' ),
    'add_new_item'          => __( 'Add New Item', 'text_domain' ),
    'add_new'               => __( 'Thêm mới', 'text_domain' ),
    'new_item'              => __( 'Tài liệu mới', 'text_domain' ),
    'edit_item'             => __( 'Sửa', 'text_domain' ),
    'update_item'           => __( 'Cập nhập', 'text_domain' ),
    'view_item'             => __( 'View Item', 'text_domain' ),
    'view_items'            => __( 'View Items', 'text_domain' ),
    'search_items'          => __( 'Search Item', 'text_domain' ),
    'not_found'             => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
    'featured_image'        => __( 'Featured Image', 'text_domain' ),
    'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
    'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
    'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
    'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
    'items_list'            => __( 'Items list', 'text_domain' ),
    'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
    'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
);
	$args = array(
        'label'                 => __( 'Tài liệu', 'text_domain' ),
        'description'           => __( 'Tài liệu', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'custom-fields' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
	register_post_type( 'tai_lieu', $args );

}
add_action( 'init', 'tai_lieu', 0 );

function eLearningCustomType()
{

    /*
     * Biến $label để chứa các text liên quan đến tên hiển thị của Post Type trong Admin
     */
    $label = array(
        'name' => 'Elearning', //Tên post type dạng số nhiều
        'singular_name' => 'Elearning' //Tên post type dạng số ít
    );

    /*
     * Biến $args là những tham số quan trọng trong Post Type
     */
    $args = array(
        'labels' => $label, //Gọi các label trong biến $label ở trên
        'description' => 'Elearning', //Mô tả của post type
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'author',
            'thumbnail',
            'comments',
            'trackbacks',
            'revisions',
            'custom-fields'
        ), //Các tính năng được hỗ trợ trong post type
        'taxonomies' => false, //Các taxonomy được phép sử dụng để phân loại nội dung
        'hierarchical' => true, //Cho phép phân cấp, nếu là false thì post type này giống như Post, true thì giống như Page
        'public' => true, //Kích hoạt post type
        'show_ui' => true, //Hiển thị khung quản trị như Post/Page
        'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
        'show_in_nav_menus' => false, //Hiển thị trong Appearance -> Menus
        'show_in_admin_bar' => true, //Hiển thị trên thanh Admin bar màu đen.
        'menu_position' => 6, //Thứ tự vị trí hiển thị trong menu (tay trái)
        'menu_icon' => '', //Đường dẫn tới icon sẽ hiển thị
        'exclude_from_search' => false, //Loại bỏ khỏi kết quả tìm kiếm
        'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
        'rewrite' => array('slug' => 'admin/e-learning/course'), // Link đến page e-learning
        'capability_type' => 'page' //
    );
}
/* Kích hoạt hàm tạo custom post type */
add_action('init', 'eLearningCustomType');