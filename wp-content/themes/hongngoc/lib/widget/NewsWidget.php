<?php

/**
 * Created by PhpStorm.
 * User: hoaint
 * Date: 6/2/2015
 * Time: 1:39 PM
 */
class NewsWidget extends WP_Widget
{
    protected $newsRepository;

    public function __construct()
    {
        $this->newsRepository = array(
            'title' => '',
            'posts_cat' => '',
            'posts_num' => 1,
            'posts_offset' => 0,
            'orderby' => '',
            'order' => '',
            'exclude_displayed' => 0,
            'show_image' => 0,
            'image_alignment' => '',
            'image_size' => '',
            'show_gravatar' => 0,
            'gravatar_alignment' => '',
            'gravatar_size' => '',
            'show_title' => 0,
            'show_byline' => 0,
            'post_info' => '[post_date] ' . __('Bởi', 'hTheme') . ' [post_author_posts_link] [post_comments]',
            'show_content' => 'excerpt',
            'content_limit' => '',
            'more_text' => __('[Xem thêm...]', 'hTheme'),
            'extra_num' => '',
            'extra_title' => '',
            'more_from_category' => '',
            'more_from_category_text' => __('Xem thêm...', 'hTheme')
        );
        $widget_ops = array(
            'classname' => 'featured-content-news featured-news',
            'description' => __('Hiển thị bài viết đặc trưng với hình thu nhỏ', 'hTheme'),
        );

        $control_ops = array(
            'id_base' => 'featured-news',
            'width' => 505,
            'height' => 350,
        );

        parent::__construct('featured-news', __('Hồng Ngọc - Bài viết đặc trưng', 'hTheme'), $widget_ops, $control_ops);
    }

    function widget($args, $instance)
    {

        global $wp_query, $_genesis_displayed_ids;

        //* Merge with newsRepository
        $instance = wp_parse_args((array)$instance, $this->newsRepository);

        echo $args['before_widget'];

        //* Set up the author bio
        if (!empty($instance['title'])) {
            echo '<h2 class="news-title">
                <a href="' . esc_url(get_category_link($instance['posts_cat'])) .
                '" title="' . esc_attr(get_cat_name($instance['posts_cat'])) . '">'
                . apply_filters('widget_title', $instance['title'], $instance, $this->id_base) . '
                </a>
                </h2>';

            if (!empty($instance['more_from_category']) && !empty($instance['posts_cat']))
                printf(
                    '<p class="more-from-category"><a href="%1$s" title="%2$s" rel="nofollow">%3$s</a></p>',
                    esc_url(get_category_link($instance['posts_cat'])),
                    esc_attr(get_cat_name($instance['posts_cat'])),
                    esc_html($instance['more_from_category_text'])
                );
        }

        $query_args = array(
            'post_type' => 'post',
            'cat' => $instance['posts_cat'],
            'showposts' => $instance['posts_num'],
            'offset' => $instance['posts_offset'],
            'orderby' => $instance['orderby'],
            'order' => $instance['order'],
        );

        //* Exclude displayed IDs from this loop?
        if ($instance['exclude_displayed'])
            $query_args['post__not_in'] = (array)$_genesis_displayed_ids;

        $wp_query = new WP_Query($query_args);

        if (have_posts()) : while (have_posts()) : the_post();

            $_genesis_displayed_ids[] = get_the_ID();

            genesis_markup(array(
                'html5' => '<article %s>',
                'xhtml' => sprintf('<div class="%s">', implode(' ', get_post_class())),
                'context' => 'entry',
            ));

            $image = genesis_get_image(array(
                'format' => 'html',
                'size' => $instance['image_size'],
                'context' => 'featured-post-widget',
                'attr' => genesis_parse_attr('entry-image-widget'),
            ));

            if ($instance['show_image'] && $image)
                printf('<a href="%s" title="%s" class="%s box-effect">%s<span class="hover-effect"></span></a>', get_permalink(), the_title_attribute('echo=0'), esc_attr($instance['image_alignment']), $image);

            if (!empty($instance['show_gravatar'])) {
                echo '<span class="' . esc_attr($instance['gravatar_alignment']) . '">';
                echo get_avatar(get_the_author_meta('ID'), $instance['gravatar_size']);
                echo '</span>';
            }

            if ($instance['show_title'])
                echo genesis_html5() ? '<header class="entry-header">' : '';

            if (!empty($instance['show_title'])) {

                $title = get_the_title() ? get_the_title() : __('(Không có tiêu đề)', 'hTheme');

                if (genesis_html5())
                    printf('<h3 class="entry-title"><a href="%s">%s</a></h3>', get_permalink(), esc_html($title));
                else
                    printf('<h3><a href="%s">%s</a></h3>', get_permalink(), esc_html($title));

            }

            if (!empty($instance['show_byline']) && !empty($instance['post_info']))
                printf(genesis_html5() ? '<p class="entry-meta">%s</p>' : '<p class="byline post-info">%s</p>', do_shortcode($instance['post_info']));

            if ($instance['show_title'])
                echo genesis_html5() ? '</header>' : '';

            if (!empty($instance['show_content'])) {

                echo genesis_html5() ? '<div class="entry-content">' : '';

                if ('excerpt' == $instance['show_content']) {
                    the_excerpt();
                } elseif ('content-limit' == $instance['show_content']) {
                    the_content_limit((int)$instance['content_limit'], '<span>' . esc_html($instance['more_text']) . '</span>');
                } else {

                    global $more;

                    $orig_more = $more;
                    $more = 0;

                    the_content(esc_html($instance['more_text']));

                    $more = $orig_more;

                }

                echo genesis_html5() ? '</div>' : '';

            }

            genesis_markup(array(
                'html5' => '</article>',
                'xhtml' => '</div>',
            ));

        endwhile; endif;

        wp_reset_query();

        if (!empty($instance['extra_num'])) {
            if (!empty($instance['extra_title']))
                echo $args['before_title'] . esc_html($instance['extra_title']) . $args['after_title'];

            $offset = intval($instance['posts_num']) + intval($instance['posts_offset']);

            $query_args = array(
                'cat' => $instance['posts_cat'],
                'showposts' => $instance['extra_num'],
                'offset' => $offset,
            );

            $wp_query = new WP_Query($query_args);

            $listitems = '';

            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    $_genesis_displayed_ids[] = get_the_ID();
                    $listitems .= sprintf('<li><a href="%s">%s</a></li>', get_permalink(), get_the_title());
                }

                if (mb_strlen($listitems) > 0)
                    printf('<ul>%s</ul>', $listitems);
            }

            //* Restore original query
            wp_reset_query();
        }

        if (!empty($instance['more_from_category']) && !empty($instance['posts_cat']))
            printf(
                '<p class="more-from-category"><a href="%1$s" title="%2$s">%3$s</a></p>',
                esc_url(get_category_link($instance['posts_cat'])),
                esc_attr(get_cat_name($instance['posts_cat'])),
                esc_html($instance['more_from_category_text'])
            );

        echo $args['after_widget'];

    }

    function update($new_instance, $old_instance)
    {

        $new_instance['title'] = strip_tags($new_instance['title']);
        $new_instance['more_text'] = strip_tags($new_instance['more_text']);
        $new_instance['post_info'] = wp_kses_post($new_instance['post_info']);
        return $new_instance;

    }

    function form($instance)
    {

        //* Merge with newsRepository
        $instance = wp_parse_args((array)$instance, $this->newsRepository);

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Tiêu đề', 'hTheme'); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>"
                   value="<?php echo esc_attr($instance['title']); ?>" class="widefat"/>
        </p>

        <div class="genesis-widget-column">

            <div class="genesis-widget-column-box genesis-widget-column-box-top">

                <p>
                    <label for="<?php echo $this->get_field_id('posts_cat'); ?>"><?php _e('Chuyên mục', 'hTheme'); ?>
                        :</label>
                    <?php
                    $categories_args = array(
                        'name' => $this->get_field_name('posts_cat'),
                        'selected' => $instance['posts_cat'],
                        'orderby' => 'Name',
                        'hierarchical' => 1,
                        'show_option_all' => __('All Categories', 'hTheme'),
                        'hide_empty' => '0',
                    );
                    wp_dropdown_categories($categories_args); ?>
                </p>

                <p>
                    <label
                        for="<?php echo $this->get_field_id('posts_num'); ?>"><?php _e('Số bài viết hiển thị', 'hTheme'); ?>
                        :</label>
                    <input type="text" id="<?php echo $this->get_field_id('posts_num'); ?>"
                           name="<?php echo $this->get_field_name('posts_num'); ?>"
                           value="<?php echo esc_attr($instance['posts_num']); ?>" size="2"/>
                </p>

                <p>
                    <label
                        for="<?php echo $this->get_field_id('posts_offset'); ?>"><?php _e('Số bài viết để offset', 'hTheme'); ?>
                        :</label>
                    <input type="text" id="<?php echo $this->get_field_id('posts_offset'); ?>"
                           name="<?php echo $this->get_field_name('posts_offset'); ?>"
                           value="<?php echo esc_attr($instance['posts_offset']); ?>" size="2"/>
                </p>

                <p>
                    <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Sắp xếp', 'hTheme'); ?>
                        :</label>
                    <select id="<?php echo $this->get_field_id('orderby'); ?>"
                            name="<?php echo $this->get_field_name('orderby'); ?>">
                        <option
                            value="date" <?php selected('date', $instance['orderby']); ?>><?php _e('Thời gian', 'hTheme'); ?></option>
                        <option
                            value="title" <?php selected('title', $instance['orderby']); ?>><?php _e('Tiêu đề', 'hTheme'); ?></option>
                        <option
                            value="parent" <?php selected('parent', $instance['orderby']); ?>><?php _e('Gốc', 'hTheme'); ?></option>
                        <option
                            value="ID" <?php selected('ID', $instance['orderby']); ?>><?php _e('ID', 'hTheme'); ?></option>
                        <option
                            value="comment_count" <?php selected('comment_count', $instance['orderby']); ?>><?php _e('Số thảo luận', 'hTheme'); ?></option>
                        <option
                            value="rand" <?php selected('rand', $instance['orderby']); ?>><?php _e('Random', 'hTheme'); ?></option>
                    </select>
                </p>

                <p>
                    <label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Xếp theo thứ tự', 'hTheme'); ?>
                        :</label>
                    <select id="<?php echo $this->get_field_id('order'); ?>"
                            name="<?php echo $this->get_field_name('order'); ?>">
                        <option
                            value="DESC" <?php selected('DESC', $instance['order']); ?>><?php _e('Giảm dần (3, 2, 1)', 'hTheme'); ?></option>
                        <option
                            value="ASC" <?php selected('ASC', $instance['order']); ?>><?php _e('Tăng dần (1, 2, 3)', 'hTheme'); ?></option>
                    </select>
                </p>

                <p>
                    <input id="<?php echo $this->get_field_id('exclude_displayed'); ?>" type="checkbox"
                           name="<?php echo $this->get_field_name('exclude_displayed'); ?>"
                           value="1" <?php checked($instance['exclude_displayed']); ?>/>
                    <label
                        for="<?php echo $this->get_field_id('exclude_displayed'); ?>"><?php _e('Loại trừ các bài viết trước đây hiển thị?', 'hTheme'); ?></label>
                </p>

            </div>

            <div class="genesis-widget-column-box">

                <p>
                    <input id="<?php echo $this->get_field_id('show_gravatar'); ?>" type="checkbox"
                           name="<?php echo $this->get_field_name('show_gravatar'); ?>"
                           value="1" <?php checked($instance['show_gravatar']); ?>/>
                    <label
                        for="<?php echo $this->get_field_id('show_gravatar'); ?>"><?php _e('Hiển thị avatar', 'hTheme'); ?></label>
                </p>

                <p>
                    <label
                        for="<?php echo $this->get_field_id('gravatar_size'); ?>"><?php _e('Kích thước avatar', 'hTheme'); ?>
                        :</label>
                    <select id="<?php echo $this->get_field_id('gravatar_size'); ?>"
                            name="<?php echo $this->get_field_name('gravatar_size'); ?>">
                        <option
                            value="45" <?php selected(45, $instance['gravatar_size']); ?>><?php _e('Nhỏ (45px)', 'hTheme'); ?></option>
                        <option
                            value="65" <?php selected(65, $instance['gravatar_size']); ?>><?php _e('Bình thường (65px)', 'hTheme'); ?></option>
                        <option
                            value="85" <?php selected(85, $instance['gravatar_size']); ?>><?php _e('To (85px)', 'hTheme'); ?></option>
                        <option
                            value="125" <?php selected(105, $instance['gravatar_size']); ?>><?php _e('Đầy đủ (125px)', 'hTheme'); ?></option>
                    </select>
                </p>

                <p>
                    <label
                        for="<?php echo $this->get_field_id('gravatar_alignment'); ?>"><?php _e('Căn lề avatar', 'hTheme'); ?>
                        :</label>
                    <select id="<?php echo $this->get_field_id('gravatar_alignment'); ?>"
                            name="<?php echo $this->get_field_name('gravatar_alignment'); ?>">
                        <option value="alignnone">- <?php _e('None', 'hTheme'); ?> -</option>
                        <option
                            value="alignleft" <?php selected('alignleft', $instance['gravatar_alignment']); ?>><?php _e('Trái', 'hTheme'); ?></option>
                        <option
                            value="alignright" <?php selected('alignright', $instance['gravatar_alignment']); ?>><?php _e('Phải', 'hTheme'); ?></option>
                    </select>
                </p>

            </div>

            <div class="genesis-widget-column-box">

                <p>
                    <input id="<?php echo $this->get_field_id('show_image'); ?>" type="checkbox"
                           name="<?php echo $this->get_field_name('show_image'); ?>"
                           value="1" <?php checked($instance['show_image']); ?>/>
                    <label
                        for="<?php echo $this->get_field_id('show_image'); ?>"><?php _e('Hiển thị hình ảnh đặc trưng', 'hTheme'); ?></label>
                </p>

                <p>
                    <label
                        for="<?php echo $this->get_field_id('image_size'); ?>"><?php _e('Kích thước ảnh', 'hTheme'); ?>
                        :</label>
                    <select id="<?php echo $this->get_field_id('image_size'); ?>" class="genesis-image-size-selector"
                            name="<?php echo $this->get_field_name('image_size'); ?>">
                        <option value="thumbnail">thumbnail (<?php echo get_option('thumbnail_size_w'); ?>
                            x<?php echo get_option('thumbnail_size_h'); ?>)
                        </option>
                        <?php
                        $sizes = genesis_get_additional_image_sizes();
                        foreach ((array)$sizes as $name => $size)
                            echo '<option value="' . esc_attr($name) . '" ' . selected($name, $instance['image_size'], FALSE) . '>' . esc_html($name) . ' ( ' . $size['width'] . 'x' . $size['height'] . ' )</option>';
                        ?>
                    </select>
                </p>

                <p>
                    <label
                        for="<?php echo $this->get_field_id('image_alignment'); ?>"><?php _e('Căn lề ảnh', 'hTheme'); ?>
                        :</label>
                    <select id="<?php echo $this->get_field_id('image_alignment'); ?>"
                            name="<?php echo $this->get_field_name('image_alignment'); ?>">
                        <option value="alignnone">- <?php _e('None', 'hTheme'); ?> -</option>
                        <option
                            value="alignleft" <?php selected('alignleft', $instance['image_alignment']); ?>><?php _e('Trái', 'hTheme'); ?></option>
                        <option
                            value="alignright" <?php selected('alignright', $instance['image_alignment']); ?>><?php _e('Phải', 'hTheme'); ?></option>
                        <option
                            value="aligncenter" <?php selected('aligncenter', $instance['image_alignment']); ?>><?php _e('Giữa', 'hTheme'); ?></option>
                    </select>
                </p>

            </div>

        </div>

        <div class="genesis-widget-column genesis-widget-column-right">

            <div class="genesis-widget-column-box genesis-widget-column-box-top">

                <p>
                    <input id="<?php echo $this->get_field_id('show_title'); ?>" type="checkbox"
                           name="<?php echo $this->get_field_name('show_title'); ?>"
                           value="1" <?php checked($instance['show_title']); ?>/>
                    <label
                        for="<?php echo $this->get_field_id('show_title'); ?>"><?php _e('Hiển thị tiêu đề', 'hTheme'); ?></label>
                </p>

                <p>
                    <input id="<?php echo $this->get_field_id('show_byline'); ?>" type="checkbox"
                           name="<?php echo $this->get_field_name('show_byline'); ?>"
                           value="1" <?php checked($instance['show_byline']); ?>/>
                    <label
                        for="<?php echo $this->get_field_id('show_byline'); ?>"><?php _e('Hiển thị thông tin bài viết', 'hTheme'); ?></label>
                    <input type="text" id="<?php echo $this->get_field_id('post_info'); ?>"
                           name="<?php echo $this->get_field_name('post_info'); ?>"
                           value="<?php echo esc_attr($instance['post_info']); ?>" class="widefat"/>
                </p>

                <p>
                    <label
                        for="<?php echo $this->get_field_id('show_content'); ?>"><?php _e('Loại nội dung', 'hTheme'); ?>
                        :</label>
                    <select id="<?php echo $this->get_field_id('show_content'); ?>"
                            name="<?php echo $this->get_field_name('show_content'); ?>">
                        <option
                            value="content" <?php selected('content', $instance['show_content']); ?>><?php _e('Hiển thị nội dung', 'hTheme'); ?></option>
                        <option
                            value="excerpt" <?php selected('excerpt', $instance['show_content']); ?>><?php _e('Hiển thị tóm tắt', 'hTheme'); ?></option>
                        <option
                            value="content-limit" <?php selected('content-limit', $instance['show_content']); ?>><?php _e('Hiển thị giới hạn ký tự', 'hTheme'); ?></option>
                        <option
                            value="" <?php selected('', $instance['show_content']); ?>><?php _e('Không hiển thị nội dung', 'hTheme'); ?></option>
                    </select>
                    <br/>
                    <label
                        for="<?php echo $this->get_field_id('content_limit'); ?>"><?php _e('Giới hạn nội dung', 'hTheme'); ?>
                        <input type="text" id="<?php echo $this->get_field_id('image_alignment'); ?>"
                               name="<?php echo $this->get_field_name('content_limit'); ?>"
                               value="<?php echo esc_attr(intval($instance['content_limit'])); ?>" size="3"/>
                        <?php _e('characters', 'hTheme'); ?>
                    </label>
                </p>

                <p>
                    <label
                        for="<?php echo $this->get_field_id('more_text'); ?>"><?php _e('More Text (nếu có)', 'hTheme'); ?>
                        :</label>
                    <input type="text" id="<?php echo $this->get_field_id('more_text'); ?>"
                           name="<?php echo $this->get_field_name('more_text'); ?>"
                           value="<?php echo esc_attr($instance['more_text']); ?>"/>
                </p>

            </div>

            <div class="genesis-widget-column-box">

                <p><?php _e('Để hiển thị một danh sách có thứ tự các bài đăng khác từ thể loại này, xin vui lòng điền đầy đủ các thông tin bên dưới', 'hTheme'); ?>
                    :</p>

                <p>
                    <label for="<?php echo $this->get_field_id('extra_title'); ?>"><?php _e('Tiêu đề', 'hTheme'); ?>
                        :</label>
                    <input type="text" id="<?php echo $this->get_field_id('extra_title'); ?>"
                           name="<?php echo $this->get_field_name('extra_title'); ?>"
                           value="<?php echo esc_attr($instance['extra_title']); ?>" class="widefat"/>
                </p>

                <p>
                    <label
                        for="<?php echo $this->get_field_id('extra_num'); ?>"><?php _e('Số bài viết để hiển thị', 'hTheme'); ?>
                        :</label>
                    <input type="text" id="<?php echo $this->get_field_id('extra_num'); ?>"
                           name="<?php echo $this->get_field_name('extra_num'); ?>"
                           value="<?php echo esc_attr($instance['extra_num']); ?>" size="2"/>
                </p>

            </div>

            <div class="genesis-widget-column-box">

                <p>
                    <input id="<?php echo $this->get_field_id('more_from_category'); ?>" type="checkbox"
                           name="<?php echo $this->get_field_name('more_from_category'); ?>"
                           value="1" <?php checked($instance['more_from_category']); ?>/>
                    <label
                        for="<?php echo $this->get_field_id('more_from_category'); ?>"><?php _e('Hiển thị liên kết chuyên mục', 'hTheme'); ?></label>
                </p>

                <p>
                    <label
                        for="<?php echo $this->get_field_id('more_from_category_text'); ?>"><?php _e('Liên kết văn bản', 'hTheme'); ?>
                        :</label>
                    <input type="text" id="<?php echo $this->get_field_id('more_from_category_text'); ?>"
                           name="<?php echo $this->get_field_name('more_from_category_text'); ?>"
                           value="<?php echo esc_attr($instance['more_from_category_text']); ?>" class="widefat"/>
                </p>

            </div>

        </div>
    <?php

    }

}
