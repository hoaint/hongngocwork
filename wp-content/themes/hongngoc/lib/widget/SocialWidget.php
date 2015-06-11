<?php

/**
 * Created by PhpStorm.
 * User: hoaint
 * Date: 6/5/2015
 * Time: 11:04 AM
 */
class SocialWidget extends WP_Widget
{
    protected $socialRepository;

    function __construct()
    {
        $this->socialRepository = array(
            'title' => '',
            'facebook' => '',
            'google' => '',
            'twitter' => ''
        );

        $widget_ops = array(
            'classname' => 'social-content-info social-info',
            'description' => __('Hiển thị thông tin mạng xã hội', 'hTheme'),
        );

        $control_ops = array(
            'id_base' => 'social-info',
            'width' => 344,
            'height' => 350,
        );

        parent::__construct('social-info', __('Hồng Ngọc - Mạng xã hội', 'hTheme'), $widget_ops, $control_ops);
    }

    function widget($args, $instance)
    {
        $instance = wp_parse_args((array)$instance, $this->socialRepository);

        echo $args['before_widget'];

        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title'], $instance, $this->id_base) . $args['after_title'];
        }

        if (!empty($instance['facebook'])) {
            //echo '<div class="facebook-icon">';
            echo '<a class="social-icon facebook-icon" href="' . $instance['facebook'] . '" title="Facebook">Facebook</a>';
            //echo '</div>';
        }

        if (!empty($instance['google'])) {
            //echo '<div class="facebook-icon">';
            echo '<a class="social-icon google-icon" href="' . $instance['google'] . '" title="Facebook">Facebook</a>';
            //echo '</div>';
        }

        if (!empty($instance['twitter'])) {
            //echo '<div class="facebook-icon">';
            echo '<a class="social-icon twitter-icon" href="' . $instance['twitter'] . '" title="Facebook">Facebook</a>';
            //echo '</div>';
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

        $instance = wp_parse_args((array)$instance, $this->socialRepository);

        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Tiêu đề', 'hTheme'); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>"
                   value="<?php echo esc_attr($instance['title']); ?>" class="widefat"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Đường dẫn facebook', 'hTheme'); ?>:
            </label>
            <input type="text" id="<?php echo $this->get_field_id('facebook'); ?>"
                   name="<?php echo $this->get_field_name('facebook'); ?>"
                   value="<?php echo esc_attr($instance['facebook']); ?>" class="widefat"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('google'); ?>"><?php _e('Đường dẫn google', 'hTheme'); ?>:
            </label>
            <input type="text" id="<?php echo $this->get_field_id('google'); ?>"
                   name="<?php echo $this->get_field_name('google'); ?>"
                   value="<?php echo esc_attr($instance['google']); ?>" class="widefat"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Đường dẫn twitter', 'hTheme'); ?>:
            </label>
            <input type="text" id="<?php echo $this->get_field_id('twitter'); ?>"
                   name="<?php echo $this->get_field_name('twitter'); ?>"
                   value="<?php echo esc_attr($instance['twitter']); ?>" class="widefat"/>
        </p>

    <?php
    }
}