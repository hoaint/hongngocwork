<?php
/**
 * Created by PhpStorm.
 * User: hoaint
 * Date: 6/8/2015
 * Time: 11:59 AM
 */

remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'showServices');

//add_action('genesis_before_entry', 'customBeforeEntry');
//function customBeforeEntry()
//{
//    if (is_active_sidebar('before-loop-section')) {
//        echo '<div class="before-loop-section">';
//        dynamic_sidebar('before-loop-section');
//        echo '</div>';
//    }
//}

function showServices()
{
    if (is_category()) {
        $currentCatId = get_query_var('cat');
        $services = childGenesisGetOption('service_boxes');
        $check = false;

        for ($i = 1; $i <= $services; $i++) {
            if ($currentCatId == childGenesisGetOption('service_cat_' . $i)) {
                $check = true;
            }
        }

        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $args = (array(
            'cat' => $currentCatId,
            'showposts' => childGenesisGetOption('service_cat_num'),
            'paged' => $paged,
        ));

        if ($check == true) {
            echo '<div class="services-section">';
            findPostsByCategory($args, 'main-service', 'style-service-image', 'services');
            echo '</div>';

        } else {
            echo '<div class="slider-carousel-posts">';
            dynamic_sidebar('before-loop-section');
            echo '</div>';
            echo '<div class="posts-section">';
            findPostsByCategory($args, 'main-post', 'style-news-image', 'posts');
            echo '</div>';
        }
    } else {
        genesis_do_loop();
    }
}

genesis();