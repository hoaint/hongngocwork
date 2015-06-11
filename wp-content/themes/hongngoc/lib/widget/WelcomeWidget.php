<?php

/**
 * Created by PhpStorm.
 * User: hoaint
 * Date: 6/5/2015
 * Time: 9:10 AM
 */
class WelcomeWidget extends WP_Widget
{
    protected $welcomeRepository;

    function __construct()
    {
        $this->welcomeRepository = array(
            'title' => '',
            'message' => ''
        );

        $widget_ops = array(
            'classname' => 'welcome-content-info welcome-info',
            'description' => __('Hiển thị thông tin tóm tắt công ty', 'hTheme'),
        );

        $control_ops = array(
            'id_base' => 'welcome-info',
            'width' => 344,
            'height' => 350,
        );

        parent::__construct('welcome-info', __('Hồng Ngọc - Thông tin tóm tắt', 'hTheme'), $widget_ops, $control_ops);
    }

    function widget($args, $instance)
    {
        $instance = wp_parse_args((array)$instance, $this->welcomeRepository);

        echo $args['before_widget'];

        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title'], $instance, $this->id_base) . $args['after_title'];
        }

        if (!empty($instance['message'])) {
            echo '<div class="message-section">';
            echo $instance['message'];
            echo '</div>';
        }

        echo $args['after_widget'];
    }

    function update($new_instance, $old_instance)
    {

        $new_instance['title'] = strip_tags($new_instance['title']);
        return $new_instance;
    }

    function form($instance)
    {

        $instance = wp_parse_args((array)$instance, $this->welcomeRepository);

        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Tiêu đề', 'hTheme'); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>"
                   value="<?php echo esc_attr($instance['title']); ?>" class="widefat"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('message'); ?>"><?php _e('Thông tin', 'hTheme'); ?>:</label>
            <textarea id="<?php echo $this->get_field_id('message'); ?>"
                      name="<?php echo $this->get_field_name('message'); ?>"
                      value="<?php echo esc_attr($instance['message']); ?>" class="widefat"
                      rows="10"><?php echo esc_attr($instance['message']); ?></textarea>
        </p>

    <?php
    }
}