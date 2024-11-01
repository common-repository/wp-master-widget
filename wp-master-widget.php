<?php

/**
 *
 * @link              //wpmaster.com
 * @since             1.0.0
 * @package           Wp_Master_Widget
 *
 * @wordpress-plugin
 * Plugin Name:       WP Master Widget
 * Plugin URI:        //wpmaster.com/plugins/wp-master-widget
 * Description:       WP Master Widget is an advanced WordPress widget that allows easy styling and organization for text, fontawesome icon, image, and more types of elements.
 * Version:           1.0.0
 * Author:            WP Master
 * Author URI:        //wpmaster.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-master-widget
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-master-widget-activator.php
 */
function activate_wp_master_widget() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-master-widget-activator.php';
	Wp_Master_Widget_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-master-widget-deactivator.php
 */
function deactivate_wp_master_widget() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-master-widget-deactivator.php';
	Wp_Master_Widget_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_master_widget' );
register_deactivation_hook( __FILE__, 'deactivate_wp_master_widget' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-master-widget.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_master_widget() {

	$plugin = new Wp_Master_Widget();
	$plugin->run();

}
run_wp_master_widget();
