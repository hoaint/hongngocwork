<?php
add_image_size('slide-carousel-image', 264, 334, true);
add_image_size('slide-archive-carousel-image', 485, 250, true);
add_image_size('style-news-image', 352, 209, true);
add_image_size('style-service-image', 406, 315, true);
add_image_size('style-news-sidebar-image', 58, 58, true);

if (class_exists('MultiPostThumbnails')) {
    new MultiPostThumbnails(
        array(
            'label' => 'Ảnh trước',
            'id' => 'before-image',
            'post_type' => 'post'
        )
    );

    new MultiPostThumbnails(
        array(
            'label' => 'Ảnh sau',
            'id' => 'after-image',
            'post_type' => 'post'
        )
    );
}