<?php
/**
 * Created by PhpStorm.
 * User: hoaint
 * Date: 6/2/2015
 * Time: 10:21 AM
 */
add_action('genesis_after_header', 'stickyAlias', 4);
function stickyAlias()
{
    echo '<div id="stickyalias"></div>';
}