<?php
/**
 * TwentyTwenty
 *
 * Allows you to show before-and-after images in your blog, with an interactive slider. Uses TwentyTwenty by Zurb.
 *
 * @package   TwentyTwenty
 * @author    Corey Martin <coreym@gmail.com>
 * @license   GPL-2.0+
 * @link      http://wordpress.org/plugins
 * @copyright Plugin (c) Corey Martin, TwentyTwenty (c) ZURB
 *
 * @wordpress-plugin
 * Plugin Name:       TwentyTwenty
 * Plugin URI:        http://wordpress.org/plugins
 * Description:       Allows you to show before-and-after images in your blog, with an interactive slider. Uses TwentyTwenty by Zurb.
 * Version:           1.0
 * Author:            Corey Martin
 * Author URI:        
 * Text Domain:       twentytwenty
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: 
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

require_once( plugin_dir_path( __FILE__ ) . 'public/class-twentytwenty.php' );

register_activation_hook( __FILE__, array( 'TwentyTwenty', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'TwentyTwenty', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'TwentyTwenty', 'get_instance' ) );

/*if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-twentytwenty-admin.php' );
	add_action( 'plugins_loaded', array( 'TwentyTwenty_Admin', 'get_instance' ) );

}*/
