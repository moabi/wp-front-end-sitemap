<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.lyra-network.com
 * @since      1.0.0
 *
 * @package    Front_End_Sitemap
 * @subpackage Front_End_Sitemap/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Front_End_Sitemap
 * @subpackage Front_End_Sitemap/admin
 * @author     LYRA NETWORK <david.fieffe@lyra-network.com>
 */
class Front_End_Sitemap_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Front_End_Sitemap_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Front_End_Sitemap_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/front-end-sitemap-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Front_End_Sitemap_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Front_End_Sitemap_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/front-end-sitemap-admin.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 * Add menu pages in wp admin
	 */
	public function wp_admin_menu(){
		//add settings page
		add_submenu_page( 'tools.php','Front-end Sitemap', 'FE Sitemap', 'publish_pages', 'front-end-sitemap', array( $this, 'helper' ) );
		//register settings
		add_action( 'admin_init', array($this, 'register_plugins_settings') );
	}



	/**
	 * admin wiews
	 */
	public function helper(){
		$admin_view = plugin_dir_path( __FILE__ ) . 'partials/front-end-sitemap-admin-display.php';
		include_once $admin_view;
	}

	/**
	 * Register settings
	 */
	public function register_plugins_settings() {
		//register our settings
		register_setting( 'fes8x-settings-group', 'excluded_pages' );

	}

}
