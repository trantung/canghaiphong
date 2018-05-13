<?php
require_once dirname( __FILE__ ) . '/core/theme-style.php';
require_once dirname( __FILE__ ) . '/core/aq_resizer.php';
require_once dirname( __FILE__ ) . '/core/content_limit.php';
require_once dirname( __FILE__ ) . '/core/wp-dimox-breadcrumbs.php';
require_once dirname( __FILE__ ) . '/core/widget.php';

if( function_exists('acf_add_options_page') ) {
    // add parent
    $parent = acf_add_options_page(array(
        'page_title' 	=> 'Theme Options',
        'menu_title' 	=> 'Theme Options',
        'redirect' 		=> 'Home'
    ));
    // add sub page
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Home',
        'menu_title' 	=> 'Home',
        'parent_slug' 	=> $parent['menu_slug'],
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Header',
        'menu_title' 	=> 'Header',
        'parent_slug' 	=> $parent['menu_slug'],
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Footer',
        'menu_title' 	=> 'Footer',
        'parent_slug' 	=> $parent['menu_slug'],
    ));

}



function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyCPe9HPLT4GDHYsjddNPCKJy_7g53L073Q');
}

add_action('acf/init', 'my_acf_init');


// khai báo ảnh đại diện cho bài viết
add_theme_support( 'post-thumbnails' );

//khai bao menu
register_nav_menus( array(
    'main-menu' => 'Main Menu',
) );

register_sidebar(array(
    'name' => 'Sidebar Home',// Tên của sidebar

    'id' => 'sidebar-home', // id buộc phải viết thường

    'description' => 'Khu vực sidebar hiển thị dưới mỗi bài viết',

    'before_widget' => '<aside id="%1$s" class="widget %2$s">',

    'after_widget' => '</aside>',

    'before_title' => '<h3>',

    'after_title' => '</h3>'

));

register_sidebar(array(
    'name' => 'Sidebar',// Tên của sidebar

    'id' => 'sidebar', // id buộc phải viết thường

    'description' => 'Khu vực sidebar hiển thị dưới mỗi bài viết',

    'before_widget' => '<aside id="%1$s" class="widget %2$s">',

    'after_widget' => '</aside>',

    'before_title' => '<h3>',

    'after_title' => '</h3>'

));

function headerimagedefault(){
    $header_iamge = get_field('image','options');
    echo '<section>';
    echo '<div class="masshead">';
    echo '<img src="'.$header_iamge['url'].'" />';
    echo '</div>';
    echo '</section>';
}

function headerimagebyme(){
    if( is_category() || is_tax()){
        $queried_object = get_queried_object();
        $taxonomy = $queried_object->taxonomy;
        $cat_id = $queried_object->term_id;

        $header_iamge = get_field('image', $taxonomy . '_' . $cat_id);
        if($header_iamge){
            echo '<section>';
            echo '<div class="masshead">';
            echo '<img src="'.$header_iamge['url'].'" />';
            echo '</div>';
            echo '</section>';
        }else{
            headerimagedefault();
        }
    }
    elseif(is_single() || is_page() ){
        $post_id = get_the_ID();
        $header_iamge = get_field('image',$post_id);
        if($header_iamge){
            echo '<section>';
            echo '<div class="masshead">';
            echo '<img src="'.$header_iamge['url'].'" />';
            echo '</div>';
            echo '</section>';
        }else{
            headerimagedefault();
        }
    }else{
        headerimagedefault();
    }
}


function my_acf_google_map_api( $api ){

    $api['key'] = 'AIzaSyDcEwsSEJGbs5gt8Ny0rCzBcvZpXMk0saM';

    return $api;

}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

function get_title_category_in_post($id,$post_type='category'){
    $termcown=0;
    $terms = get_the_terms( $id , $post_type );
    if($terms ){
        foreach ( $terms as $term ) {
            if($termcown>0){
                echo ', ';
            }

            $title = $term->name;
            echo '<a href="'.get_category_link($term).'">'.$title.'</a>';
            $termcown++;
        }
    }
}

function check_title_category_in_post($id,$post_type='category'){
    $terms = get_the_terms( $id , $post_type );
    if($terms){
        return true;
    }else{
        return false;
    }
}


add_action('init','md_create_gallery');
function md_create_gallery()
{
    $labels = array(
        'name'               => _x('gallery', 'gallery General Name', TEXT_DOMAIN),
        'singular_name'      => _x('gallery Item', 'gallery Singular Name', TEXT_DOMAIN),
        'add_new'            => _x('Add new', 'Thêm gallery Name', TEXT_DOMAIN),
        'add_new_item'       => __('Add New gallery', TEXT_DOMAIN),
        'edit_item'          => __('Sửa gallery', TEXT_DOMAIN),
        'new_item'           => __('New gallery', TEXT_DOMAIN),
        'view_item'          => __('View gallery', TEXT_DOMAIN),
        'search_items'       => __('Search gallery', TEXT_DOMAIN),
        'not_found'          => __('Nothing found', TEXT_DOMAIN),
        'not_found_in_trash' => __('Nothing found in Trash', TEXT_DOMAIN),
        'parent_item_colon'  => ''
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'query_var'          => true,
        //'menu_icon' => THEME_PATH . '/plazart/assets/images/sanpham-icon.png',
        'rewrite'            => true,
        'capability_type'    => 'post',
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array('title','editor','revisions','thumbnail','author','excerpt'), //'editor', 'excerpt', 'comments',
        'rewrite'            => array('slug' => 'gallery', 'with_front' => true ),
        //'has_archive'        => 'sanpham'
    );
    register_post_type('gallery', $args);
    register_taxonomy(
        "gallery-category", array( "gallery" ), array(
        "hierarchical"   => true,
        "label"          => "Category gallery",
        "singular_label" => "gallery Categories",
        "rewrite"        => true ));
    register_taxonomy_for_object_type('gallery-category', 'gallery');
}