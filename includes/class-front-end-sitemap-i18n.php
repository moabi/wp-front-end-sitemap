<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.lyra-network.com
 * @since      1.0.0
 *
 * @package    Front_End_Sitemap
 * @subpackage Front_End_Sitemap/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Front_End_Sitemap
 * @subpackage Front_End_Sitemap/includes
 * @author     LYRA NETWORK <david.fieffe@lyra-network.com>
 */
class Front_End_Sitemap_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'front-end-sitemap',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
