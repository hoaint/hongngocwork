<?php
/**
 * Created by PhpStorm.
 * User: hoaint
 * Date: 6/2/2015
 * Time: 9:45 AM
 */
//* Enqueue sticky menu script
add_action('wp_enqueue_scripts', 'custom_enqueue_script');
function custom_enqueue_script()
{
    wp_enqueue_script('sticky-menu', CHILD_URL . '/js/sticky-header.js', array('jquery'), false, true);
    wp_enqueue_script('owl-carousel-min', CHILD_URL . '/js/owl.carousel.min.js', array('jquery'), false, true);
    wp_enqueue_script('owl-common-init', CHILD_URL . '/js/owl-common-init.js', array('jquery'), false, true);
    if (is_home()) {
        wp_enqueue_script('owl-home-init', CHILD_URL . '/js/owl-home-init.js', array('jquery'), false, true);
    } elseif (is_archive()) {
        wp_enqueue_script('owl-archive-init', CHILD_URL . '/js/owl-archive-init.js', array('jquery'), false, true);
    } elseif (is_single()) {
        wp_enqueue_script('owl-yarpp-init', CHILD_URL . '/js/owl-yarpp-init.js', array('jquery'), false, true);
    }
}

add_action('wp_enqueue_scripts', 'custom_enqueue_style_sheet');
function custom_enqueue_style_sheet()
{
    wp_enqueue_style('owl-carousel-stylesheet', CHILD_URL . '/css/owl.carousel.css', array(), PARENT_THEME_VERSION);
    wp_enqueue_style('owl-theme-stylesheet', CHILD_URL . '/css/owl.theme.css', array(), PARENT_THEME_VERSION);
    wp_enqueue_style('owl-transitions-stylesheet', CHILD_URL . '/css/owl.transitions.css', array(), PARENT_THEME_VERSION);
}