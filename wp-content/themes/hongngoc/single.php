<?php
/**
 * Created by PhpStorm.
 * User: hoaint
 * Date: 6/10/2015
 * Time: 10:02 AM
 */

remove_action('genesis_entry_header', 'genesis_post_info', 12);
remove_action('genesis_entry_footer', 'genesis_post_meta');

add_action('genesis_entry_header', 'showFromAndImageBA');

function showFromAndImageBA()
{
    echo '<div id="before-entry-section" class="before-entry-section">';
    if (function_exists('gravity_form')) {
        gravity_form(1, false, false, false, '', false);
    }

    if (class_exists('MultiPostThumbnails')) {
        echo '<div class="before-after">';
        echo do_shortcode('[twentytwenty]' . MultiPostThumbnails::get_the_post_thumbnail(get_post_type(), 'before-image') . MultiPostThumbnails::get_the_post_thumbnail(get_post_type(), 'after-image') . '[/twentytwenty]');
        echo '</div>';
    }
    echo '</div>';
}

genesis();