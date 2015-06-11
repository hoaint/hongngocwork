<?php

/**
 * Created by PhpStorm.
 * User: hoaint
 * Date: 6/5/2015
 * Time: 8:19 AM
 */
class ContactWidget extends WP_Widget
{
    protected $contactRepository;

    function __construct()
    {
        $this->contactRepository = array(
            'title' => '',
            'address' => '',
            'phone' => '',
            'email' => ''
        );

        $widget_ops = array(
            'classname' => 'contact-content-info contact-info',
            'description' => __('Hiển thị thông tin liên hệ, địa chỉ, số điện thoại', 'hTheme'),
        );

        $control_ops = array(
            'id_base' => 'contact-info',
            'width' => 344,
            'height' => 350,
        );

        parent::__construct('contact-info', __('Hồng Ngọc - Thông tin liên hệ', 'hTheme'), $widget_ops, $control_ops);
    }

    function widget($args, $instance)
    {
        $instance = wp_parse_args((array)$instance, $this->contactRepository);

        echo $args['before_widget'];

        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title'], $instance, $this->id_base) . $args['after_title'];
            echo '<div class="widget-effect"></div>';
        }
        echo '<div class="main-contact-info">';
        if (!empty($instance['address'])) {
            echo '<div class="address-section">';
            echo '<div class="address-icon"></div>';
            echo '<span>';
            echo $instance['address'];
            echo '</span>';
            echo '</div>';
        }

        if (!empty($instance['phone'])) {
            echo '<div class="phone-section">';
            echo '<div class="phone-icon"></div>';
            echo '<span>';
            echo $instance['phone'];
            echo '</div>';
        }

        if (!empty($instance['email'])) {
            echo '<div class="email-section">';
            echo '<div class="email-icon"></div>';
            echo '<span>';
            echo $instance['email'];
            echo '</span>';
            echo '</div>';
        }
        echo '</div>';
        echo $args['after_widget'];
    }

    function update($new_instance, $old_instance)
    {

        $new_instance['title'] = strip_tags($new_instance['title']);
        return $new_instance;
    }

    function form($instance)
    {

        $instance = wp_parse_args((array)$instance, $this->contactRepository);

        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Tiêu đề', 'hTheme'); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>"
                   value="<?php echo esc_attr($instance['title']); ?>" class="widefat"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Địa chỉ', 'hTheme'); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id('address'); ?>"
                   name="<?php echo $this->get_field_name('address'); ?>"
                   value="<?php echo esc_attr($instance['address']); ?>" class="widefat"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Điện thoại', 'hTheme'); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id('phone'); ?>"
                   name="<?php echo $this->get_field_name('phone'); ?>"
                   value="<?php echo esc_attr($instance['phone']); ?>" class="widefat"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email', 'hTheme'); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id('email'); ?>"
                   name="<?php echo $this->get_field_name('email'); ?>"
                   value="<?php echo esc_attr($instance['email']); ?>" class="widefat"/>
        </p>

    <?php
    }
}