<?php
/**
 * Created by PhpStorm.
 * User: hoaint
 * Date: 6/2/2015
 * Time: 1:42 PM
 */

add_action('widgets_init', 'custom_load_widgets');

function custom_load_widgets()
{
    register_widget('NewsWidget');
    register_widget('CarouselWidget');
    register_widget('ContactWidget');
    register_widget('WelcomeWidget');
    register_widget('SocialWidget');
    register_widget('ButtonWidget');
    register_widget('FeaturedLinksWidget');
}