<?php
/**
 * Created by PhpStorm.
 * User: hoaint
 * Date: 6/4/2015
 * Time: 1:50 PM
 */

/** Add support for 3-column footer widgets */
add_theme_support('genesis-footer-widgets', 5);

add_action('genesis_before_footer', 'partnersCarousel');
function partnersCarousel()
{
    if (is_active_sidebar('partners-carousel-section')) {
        echo '<div class="partners-section">';
        echo '<div class="wrap">';
        echo '<div class="partner-box"><h4>Đối tác</h4></div>';
        echo '<div class="partners-carousel-section">';
        dynamic_sidebar('partners-carousel-section');
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}

add_action('genesis_before_footer', 'footerCopyright');
function footerCopyright()
{
    if (is_active_sidebar('copyright')) {
        echo '<div class="copyright-section">';
        echo '<div class="wrap">';
        dynamic_sidebar('copyright');
        echo '<div class="section-effect"></div>';
        echo '</div>';
        echo '</div>';
    }
}

remove_action('genesis_footer', 'genesis_do_footer');
add_action('genesis_footer', 'socialSection');
function socialSection()
{
    if (is_active_sidebar('social-section')) {
        dynamic_sidebar('social-section');
        echo '<div class="section-effect"></div>';
    }
}