<?php
/*
YARPP Template: Thumbnails
Description: Requires a theme which supports post thumbnails
Author: mitcho (Michael Yoshitaka Erlewine)
*/
?>
<div class="register-now"><a href="#stickyalias">Đăng ký ngay</a></div>
<h3>Có thể bạn quan tâm</h3>
<?php if (have_posts()): ?>
    <ul class="related-post-carousel">
        <?php while (have_posts()) : the_post(); ?>
            <?php if (has_post_thumbnail()): ?>
                <li>
                    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                        <?php
                        $image = genesis_get_image(array(
                            'format' => 'html',
                            'size' => 'style-news-image',
                        ));
                        echo $image;
                        the_title_attribute();
                        ?>
                    </a>
                </li>
            <?php endif; ?>
        <?php endwhile; ?>
    </ul>
<?php endif; ?>
