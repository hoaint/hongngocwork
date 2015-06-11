<?php
/**
 * Created by PhpStorm.
 * User: hoaint
 * Date: 6/2/2015
 * Time: 8:25 AM
 */

# Add revolution slider

add_action('genesis_after_header', 'revSliderSection', 5);
function revSliderSection()
{
    if (is_home()) {
        putRevSlider("sliderHome");
    }
}