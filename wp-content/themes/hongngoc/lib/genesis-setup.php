<?php

// Add HTML5 markup structure
add_theme_support('html5');
define('NO_THUMB_IMG', get_bloginfo('stylesheet_directory') . '/images/custom/no_thumb.png');
define('CHILD_SETTINGS_FIELD', 'child-settings');

function childGenesisGetOption($key)
{
    return genesis_get_option($key, CHILD_SETTINGS_FIELD);
}

function childGenesisOption($key)
{
    genesis_option($key, CHILD_SETTINGS_FIELD);
}

add_filter('genesis_breadcrumb_args', 'remove_breadcrumbs_yourarehere_text');

function remove_breadcrumbs_yourarehere_text($args)
{
    $args['labels']['prefix'] = '';
    return $args;
}

function findPostsByCategory($args, $class, $imagesSize, $template = 'posts')
{

    $posts = new WP_Query($args);
    $count = 0;
    while ($posts->have_posts()) : $posts->the_post();

        $count++;
        $clear = '';
        $rightColumn = '';
        $style = '';

        if ($count == 1) {
            $style = ' first';
        }

        if ($count % 2 == 1) {
            $clear = ' clear';
        }

        if ($count % 2 == 0) {
            $rightColumn = ' right';
        }

        $image = genesis_get_image(array(
            'format' => 'html',
            'size' => $imagesSize,
        ));

        if ($image == null) {
            $image = NO_THUMB_IMG;
            $image = '<img src="' . $image . '" title = "' . get_the_title() . '" alt = "' . get_the_title() . '" />';
        }

        echo '<div class="' . $class . $style . $rightColumn . $clear . '">';
        printf('<a href="%s" title="%s" class="box-effect">%s<span class="hover-effect"></span></a>', get_permalink(), the_title_attribute('echo=0'), $image);

        if ($template == 'services') {
            printf('<h2><a href = "%s" title = "%s">%s</a></h2>', get_permalink(), get_the_title(), get_the_title());
            echo '<div class="' . $class . '-effect"></div>';
        }
        if ($template == 'posts') {
            echo '<div class="content-post-right">';
            printf('<h2><a href = "%s" title = "%s">%s</a></h2>', get_permalink(), get_the_title(), get_the_title());
            the_content_limit((int)genesis_get_option('content_archive_limit'), '');
            printf('<a href = "%s" title = "%s" class="more-link">%s<span class="more-text">+</span></a>', get_permalink(), get_the_title(), 'Chi tiết');
            echo '</div>';
        }

        echo '</div>';

    endwhile;

}

add_filter( 'genesis_post_title_output', 'custom_post_title_output', 15 );

function custom_post_title_output( $title ) {

    if ( is_singular() )
        $title = sprintf( '<h1 class="entry-title"><span>%s</span></h1>', apply_filters( 'genesis_post_title_text', get_the_title() ) );

    return $title;

}
