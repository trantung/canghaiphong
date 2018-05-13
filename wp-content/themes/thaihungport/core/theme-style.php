<?php

function theme_styles() {
    /*
     * Hàm get_stylesheet_uri() sẽ trả về giá trị dẫn đến file style.css của theme
     */
    $ver = '1.0';
    wp_enqueue_style('OpenSans', 'https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700&amp;subset=vietnamese',[], $ver );
    wp_enqueue_style('Roboto', 'https://fonts.googleapis.com/css?family=Roboto+Condensed&amp;subset=vietnamese',[], $ver );
    wp_enqueue_style('font-awesome.min', get_template_directory_uri().'/css/font-awesome.min.css',[], $ver );
    wp_enqueue_style('resetcss', get_template_directory_uri().'/css/resetcss.css',[], $ver );
    wp_enqueue_style('bootstrap', get_template_directory_uri().'/css/bootstrap.css', [],$ver );
    wp_enqueue_style('animate', get_template_directory_uri().'/css/animate.css', [],$ver );
    wp_enqueue_style('owl.carousel.min.css', get_template_directory_uri().'/css/owl.carousel.min.css', [],$ver );
    wp_enqueue_style('owl.theme.default.min.css', get_template_directory_uri().'/css/owl.theme.default.min.css', [],$ver );
    wp_enqueue_style('jquery.fancybox.min', get_template_directory_uri().'/css/jquery.fancybox.min.css', [],$ver );
    wp_enqueue_style('jquery.idealselect.css', get_template_directory_uri().'/css/jquery.idealselect.css', [],$ver );
    wp_enqueue_style('style', get_template_directory_uri().'/style.css',[], $ver );
}
add_action( 'wp_enqueue_scripts', 'theme_styles' );

function register_front_end_scripts()
{
    $ver = '1.0';
    wp_enqueue_script('jquery-2.1.4.min.js', get_template_directory_uri().'/js/jquery-2.1.4.min.js', false, $ver, $in_footer=true);
    wp_enqueue_script('owl.carousel.min.js', get_template_directory_uri().'/js/owl.carousel.min.js', false, $ver, $in_footer=true);
    wp_enqueue_script('jquery.fancybox.min.js', get_template_directory_uri().'/js/jquery.fancybox.min.js', false, $ver, $in_footer=true);
    wp_enqueue_script('flaunt.min.js', get_template_directory_uri().'/js/flaunt.min.js', false, $ver, $in_footer=true);
    wp_enqueue_script('jquery.idealselect.min.js', get_template_directory_uri().'/js/jquery.idealselect.min.js', false, $ver, $in_footer=true);
    wp_enqueue_script('javascript.js', get_template_directory_uri().'/js/javascript.js', false, $ver, $in_footer=true);
}
add_action('wp_enqueue_scripts', 'register_front_end_scripts');