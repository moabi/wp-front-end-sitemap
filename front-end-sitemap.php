<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.lyra-network.com
 * @since             1.0.0
 * @package           Front_End_Sitemap
 *
 * @wordpress-plugin
 * Plugin Name:       Front End Sitemap
 * Plugin URI:        https://payzen.eu
 * Description:       Display a sitemap in the front end
 * Version:           1.0.0
 * Author:            LYRA NETWORK
 * Author URI:        https://www.lyra-network.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       front-end-sitemap
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function get_wp_fes_plugin_dir(){
	$url_plugins =  plugin_dir_path( __FILE__ );
	return $url_plugins;
}

function get_wp_fes_plugin_uri(){
	$url_plugins = plugin_dir_url(__FILE__);
	return $url_plugins;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-front-end-sitemap-activator.php
 */
function activate_front_end_sitemap() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-front-end-sitemap-activator.php';
	Front_End_Sitemap_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-front-end-sitemap-deactivator.php
 */
function deactivate_front_end_sitemap() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-front-end-sitemap-deactivator.php';
	Front_End_Sitemap_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_front_end_sitemap' );
register_deactivation_hook( __FILE__, 'deactivate_front_end_sitemap' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-front-end-sitemap.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_front_end_sitemap() {

	$plugin = new Front_End_Sitemap();
	$plugin->run();

}
run_front_end_sitemap();
