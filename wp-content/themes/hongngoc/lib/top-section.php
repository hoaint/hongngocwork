<?php
/**
 * Created by PhpStorm.
 * User: hoaint
 * Date: 6/1/2015
 * Time: 11:11 AM
 */

add_action('genesis_before', 'topSection', 5);

function topSection()
{
    if (is_active_sidebar('top-section')) {
        echo '<div class="top-section">';
        echo '<div class="wrap">';
        dynamic_sidebar('top-section');
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div class="top-section">';
        echo '';
        echo '</div>';
    }
}
