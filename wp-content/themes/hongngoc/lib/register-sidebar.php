<?php
/**
 * Created by PhpStorm.
 * User: hoaint
 * Date: 6/1/2015
 * Time: 11:26 AM
 */

//Register the new sidebar
genesis_register_sidebar(array(
    'id' => 'top-section',
    'name' => 'Top Section',
    'description' => 'This is a top section'
));

genesis_register_sidebar(array(
    'id' => 'news-carousel-section',
    'name' => 'News Carousel Section',
    'description' => 'This is a news carousel section'
));

genesis_register_sidebar(array(
    'id' => 'body-section',
    'name' => 'Body Section',
    'description' => 'This is a body section'
));

genesis_register_sidebar(array(
    'id' => 'partners-carousel-section',
    'name' => 'Partners Carousel Section',
    'description' => 'This is a partners carousel section'
));

genesis_register_sidebar(array(
    'id' => 'footer-section',
    'name' => 'Footer Section',
    'description' => 'This is a footer section'
));

genesis_register_sidebar( array(
    'id'			=> 'copyright',
    'name'			=> __( 'Copyright', 'hTheme' ),
    'description'	=> __( 'This is the copyright section.', 'hTheme' ),
) );

genesis_register_sidebar( array(
    'id'			=> 'social-section',
    'name'			=> __( 'Social Section', 'hTheme' ),
    'description'	=> __( 'This is the social section.', 'hTheme' ),
) );

genesis_register_sidebar( array(
    'id'			=> 'contact-section',
    'name'			=> __( 'Contact Section', 'hTheme' ),
    'description'	=> __( 'This is the contact section.', 'hTheme' ),
) );

genesis_register_sidebar( array(
    'id'			=> 'before-loop-section',
    'name'			=> __( 'Before Loop Section', 'hTheme' ),
    'description'	=> __( 'This is the before loop section.', 'hTheme' ),
) );