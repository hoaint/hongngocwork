<?php

/**
 * Created by PhpStorm.
 * User: hoaint
 * Date: 6/3/2015
 * Time: 11:54 AM
 */
class FeaturedLinksWidget extends WP_Widget
{
    protected $featuredLinksRepository;

    public function __construct()
    {
        $this->featuredLinksRepository = array(
            'title' => '',
            'posts_cat' => '',
            'posts_num' => 1,
            'posts_offset' => 0,
            'orderby' => '',
            'order' => '',
            'show_title' => 0,
        );

        $widget_ops = array(
            'classname' => 'featured-links-content-news featured-links-news',
            'description' => __('Hiển thị links bài viết đặc trưng', 'hTheme'),
        );

        $control_ops = array(
            'id_base' => 'featured-links',
            'width' => 505,
            'height' => 350,
        );

        parent::__construct('featured-links', __('Hồng Ngọc - Links bài viết đặc trưng', 'hTheme'), $widget_ops, $control_ops);
    }

    function widget($args, $instance)
    {

        global $wp_query;

        //* Merge with featuredLinksRepository
        $instance = wp_parse_args((array)$instance, $this->featuredLinksRepository);

        echo $args['before_widget'];

        //* Set up the author bio
        if (!empty($instance['title'])) {
            echo '<h4>' . $instance['title'] . '</h4>';
        }

        $query_args = array(
            'post_type' => 'post',
            'cat' => $instance['posts_cat'],
            'showposts' => $instance['posts_num'],
            'offset' => $instance['posts_offset'],
            'orderby' => $instance['orderby'],
            'order' => $instance['order'],
        );

        $wp_query = new WP_Query($query_args);
        $count = 0;
        if (have_posts()) : while (have_posts()) : the_post();

            $count++;
            $effect = '';
            if ($count == $instance['posts_num']) {
                $effect = ' last-link';
            }
            genesis_markup(array(
                'html5' => '<article %s>',
                'xhtml' => sprintf('<div class="%s">', implode(' ', get_post_class())),
                'context' => 'entry',
            ));

            if ($instance['show_title'])
                echo genesis_html5() ? '<header class="entry-header">' : '';

            if (!empty($instance['show_title'])) {

                $title = get_the_title() ? get_the_title() : __('(Không có tiêu đề)', 'hTheme');

                if (genesis_html5())
                    printf('<h2 class="entry-title' . $effect . '"><a href="%s">%s</a></h2>', get_permalink(), esc_html($title));
                else
                    printf('<h2><a href="%s">%s</a></h2>', get_permalink(), esc_html($title));

            }

            if ($instance['show_title'])
                echo genesis_html5() ? '</header>' : '';

            genesis_markup(array(
                'html5' => '</article>',
                'xhtml' => '</div>',
            ));

        endwhile; endif;

        wp_reset_query();

        echo $args['after_widget'];

    }

    function update($new_instance, $old_instance)
    {

        $new_instance['title'] = strip_tags($new_instance['title']);
        return $new_instance;

    }

    function form($instance)
    {

        //* Merge with featuredLinksRepository
        $instance = wp_parse_args((array)$instance, $this->featuredLinksRepository);

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

            </div>

        </div>
    <?php

    }

}
