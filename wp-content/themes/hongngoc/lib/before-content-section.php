<?php
/**
 * Created by PhpStorm.
 * User: hoaint
 * Date: 6/8/2015
 * Time: 9:37 AM
 */
add_action('genesis_before_content', 'customBeforeContent');

function customBeforeContent()
{
    if (is_active_sidebar('contact-section')) {
        echo '<div class="contact-section">';
        dynamic_sidebar('contact-section');
        echo '</div>';
    }
}
