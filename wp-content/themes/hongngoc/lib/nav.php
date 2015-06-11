<?php
/**
 * Created by PhpStorm.
 * User: hoaint
 * Date: 6/1/2015
 * Time: 3:50 PM
 */

// remove primary & secondary nav from default position
remove_action('genesis_after_header', 'genesis_do_nav');
remove_action('genesis_after_header', 'genesis_do_subnav');
// add primary & secondary nav to top of the page
add_action('genesis_header_right', 'genesis_do_nav');