<?php
/**
 * Created by PhpStorm.
 * User: hoaint
 * Date: 6/1/2015
 * Time: 3:27 PM
 */

add_action('genesis_setup', 'child_theme_genesis_setup', 15);

function child_theme_genesis_setup()
{
    foreach (glob(dirname(__FILE__) . '/lib/*.php') as $file) {
        require_once $file;
    }

    foreach (glob(dirname(__FILE__) . '/lib/widget/*.php') as $file) {
        require_once $file;
    }

}