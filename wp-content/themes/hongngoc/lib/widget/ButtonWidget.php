<?php

/**
 * Created by PhpStorm.
 * User: hoaint
 * Date: 6/6/2015
 * Time: 7:44 AM
 */
class ButtonWidget extends WP_Widget
{
    protected $buttonRepository;

    function __construct()
    {
        $this->buttonRepository = array(
            'title' => '',
            'text' => '',
            'link' => ''
        );

        $widget_ops = array(
            'classname' => 'button-content-info button-info',
            'description' => __('Hiển thị thông tin nút tùy biến', 'hTheme'),
        );

        $control_ops = array(
            'id_base' => 'button-info',
            'width' => 344,
            'height' => 350,
        );

        parent::__construct('button-info', __('Hồng Ngọc - Nút tùy biến', 'hTheme'), $widget_ops, $control_ops);
    }

    function widget($args, $instance)
    {
        $instance = wp_parse_args((array)$instance, $this->buttonRepository);

        echo $args['before_widget'];

        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title'], $instance, $this->id_base) . $args['after_title'];
        }

        if (!empty($instance['text']) || !empty($instance['link'])) {
            echo '<a class="button-icon" href="' . $instance['link'] . '" title="' . $instance['text'] . '">' . $instance['text'] . '</a>';
        }

//        if (!empty($instance['link'])) {
//            echo '<a class="button-icon" href="' . $instance['link'] . '" title="Facebook">Facebook</a>';
//        }

        echo $args['after_widget'];
    }

    function update($new_instance, $old_instance)
    {

        $new_instance['title'] = strip_tags($new_instance['title']);
        return $new_instance;
    }

    function form($instance)
    {

        $instance = wp_parse_args((array)$instance, $this->buttonRepository);

        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Tiêu đề', 'hTheme'); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>"
                   value="<?php echo esc_attr($instance['title']); ?>" class="widefat"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text hiển thị', 'hTheme'); ?>:
            </label>
            <input type="text" id="<?php echo $this->get_field_id('text'); ?>"
                   name="<?php echo $this->get_field_name('text'); ?>"
                   value="<?php echo esc_attr($instance['text']); ?>" class="widefat"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Đường dẫn', 'hTheme'); ?>:
            </label>
            <input type="text" id="<?php echo $this->get_field_id('link'); ?>"
                   name="<?php echo $this->get_field_name('link'); ?>"
                   value="<?php echo esc_attr($instance['link']); ?>" class="widefat"/>
        </p>

    <?php
    }
}