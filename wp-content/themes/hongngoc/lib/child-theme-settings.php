<?php

class Child_Theme_Settings extends Genesis_Admin_Boxes
{

    function __construct()
    {
        // Specify a unique page ID.
        $page_id = 'child';
        // Set it as a child to genesis, and define the menu and page titles
        $menu_ops = array(
            'submenu' => array(
                'parent_slug' => 'genesis',
                'page_title' => 'Genesis - Child Theme Settings',
                'menu_title' => 'Child Theme Settings',
            )
        );
        // Set up page options. These are optional, so only uncomment if you want to change the defaults
        $page_ops = array(
            //	'screen_icon'       => 'options-general',
            //	'save_button_text'  => 'Save Settings',
            //	'reset_button_text' => 'Reset Settings',
            //	'save_notice_text'  => 'Settings saved.',
            //	'reset_notice_text' => 'Settings reset.',
        );
        // Give it a unique settings field.
        // You'll access them from genesis_get_option( 'option_name', 'child-settings' );
        $settings_field = CHILD_SETTINGS_FIELD;
        // Set the default values
        $default_settings = array(
            'service_boxes' => 1,
            'service_cat_num' => 10
        );
        // Create the Admin Page
        $this->create($page_id, $menu_ops, $page_ops, $settings_field, $default_settings);
        // Initialize the Sanitization Filter
        add_action('genesis_settings_sanitizer_init', array($this, 'sanitization_filters'));
    }

    function sanitization_filters()
    {
        genesis_add_option_filter('safe_html', $this->settings_field,
            array(
                'service_boxes',
                'service_cat_num'
            ));
    }

    function help()
    {
        $screen = get_current_screen();
        $screen->add_help_tab(array(
            'id' => 'sample-help',
            'title' => 'Sample Help',
            'content' => '<p>Help content goes here.</p>',
        ));
    }

    function metaboxes()
    {
        add_meta_box('servicePageBox', 'Giao diện trang Dịch Vụ', array($this, 'servicePageBox'), $this->pagehook, 'main', 'high');
    }

    function servicePageBox()
    {

        ?>
        <p><span
                class="description"><?php _e('Các thiết lập này được áp dụng cho việc sử dụng giao diện hiển thị theo (Trang Dịch Vụ)', 'hTheme'); ?></span>
        </p>

        <hr class="div"/>

        <p>
            <label
                for="<?php $this->field_id('service_boxes'); ?>"><?php _e('Số lượng chuyên mục sử dụng giao diện này:', 'hTheme'); ?></label>
            <input type="text" name="<?php $this->field_name('service_boxes'); ?>"
                   id="<?php $this->field_id('service_boxes'); ?>"
                   value="<?php echo esc_attr($this->get_field_value('service_boxes')); ?>" size="2"/>
        </p>


        <?php
        $total_service_boxes = $this->get_field_value('service_boxes');
        for ($i = 1; $i <= $total_service_boxes; $i++) {
            ?>
            <p>
                <label
                    for="<?php $this->field_id('service_cat_' . $i); ?>"><?php _e('Chọn chuyên mục sử dụng giao diện Dịch vụ:', 'hTheme'); ?></label>
                <?php
                wp_dropdown_categories(array(
                    'selected' => $this->get_field_value('service_cat_' . $i),
                    'name' => $this->get_field_name('service_cat_' . $i),
                    'orderby' => 'Name', 'hierarchical' => 1,
                    'show_option_all' => __('All Categories', 'hTheme'),
                    'hide_empty' => '0'
                ));
                ?>
            </p>
        <?php
        }
        ?>

        <p>
            <label
                for="<?php $this->field_id('service_cat_num'); ?>"><?php _e('Số lượng bài viết trên trang:', 'hTheme'); ?></label>
            <input type="text" name="<?php $this->field_name('service_cat_num'); ?>"
                   id="<?php $this->field_id('service_cat_num'); ?>"
                   value="<?php echo esc_attr($this->get_field_value('service_cat_num')); ?>" size="2"/>
        </p>
    <?php

    }
}

function be_add_child_theme_settings()
{
    global $_child_theme_settings;
    $_child_theme_settings = new Child_Theme_Settings;
}

add_action('genesis_admin_menu', 'be_add_child_theme_settings');