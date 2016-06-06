<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.lyra-network.com
 * @since      1.0.0
 *
 * @package    Front_End_Sitemap
 * @subpackage Front_End_Sitemap/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Front_End_Sitemap
 * @subpackage Front_End_Sitemap/public
 * @author     LYRA NETWORK <david.fieffe@lyra-network.com>
 */
class Front_End_Sitemap_Public {

	public $timeout = 1800;

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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
		global $post;
		$post_content = (isset($post->post_content)) ? $post->post_content : null;
		if( has_shortcode( $post_content, 'frontend-sitemap') ) {
			wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/front-end-sitemap-public.css', array(), $this->version, 'all');
		}

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/front-end-sitemap-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * @param $type
	 * @return string
	 */
	public function the_sitemap($type){
		$output= '';

		$thumbmenu = new Thumbnail_walker();
		$defaults = array(
			'depth' => 0,
			'show_date' => '',
			'date_format' => get_option('date_format'),
			'child_of' => 0,
			'exclude' => '',
			'title_li' => '',
			'echo' => false,
			'authors' => '',
			'post_type' => $type,
			'sort_column' => 'menu_order, post_title',
			'link_before' => '',
			'link_after' => '',
			'walker' => $thumbmenu, // this fires our new thumbnail walker menu
		);
		
		$output .= wp_list_pages($defaults);
		

		return $output;
	}



	/**
	 * wp_query_shortcode
	 * provide a shortcode
	 *
	 * @param $atts
	 * @return string
	 */
	public function wp_query_shortcode($atts){

		$type = (isset($atts['type'])) ? $atts['type'] : false;

		if( !isset($type))
			return false;
		$menuClass = (!isset($atts['class']))? 'fes-wrapper': $atts['class'];

		//var_dump(get_wp_fes_plugin_dir() .'cache/');
		//test cache
		if( $this->get($type) == null){

			$data = $this->the_sitemap($type);
			
			$this->set($type,$data);

			$output = '<ul class="'.$menuClass.'">';
			$output .= $this->get($type);
			$output .= '</ul>';
			

		} elseif ( isset($type) && $this->get($type) != null ){

			$output = '<ul class="'.$menuClass.'">';
			$output .= $this->get($type);
			$output .= '</ul>';

		} else {
			$output = 'please define a "type" attribute in your shortcode';
		}

		return $output;

	}

	/**
	 * my_add_excerpts_to_pages
	 */
	public function my_add_excerpts_to_pages() {
		add_post_type_support( 'page', 'excerpt' );
	}


	/**
	 * Get cache file.
	 * @param $file
	 * @return array|mixed|null|object
	 */
	public function get($type) {
		$file = get_wp_fes_plugin_dir() .'cache/'. $type.'.json';
		$file_age = filemtime($file) + $this->timeout;
		$file_timed_out = intval($file_age - time());
		//check if file exist and is still valid
		if (file_exists($file) && $file_timed_out < 0) {
			$content = json_decode(file_get_contents($file));
			return $content;

		} else {
			$data = $this->the_sitemap($type);
			$this->set($type,$data);
			$content = json_decode(file_get_contents($file));
			return $content;
		}
	}
	/**
	 * Set cache file.
	 * create static file
	 * @param $file string name of the file
	 * @param $content string content of the file
	 */
	public function set($file, $content) {
		@file_put_contents(get_wp_fes_plugin_dir() .'cache/'. $file.'.json', json_encode($content));
	}

	/**
	 * clear
	 * delete all files
	 */
	public function clear() {
		$files = glob(get_wp_fes_plugin_dir() .'cache/*.json');
		foreach ($files as $file) {
			if (is_file($file)) {
				@unlink($file);
			}
		}
	}
	
}
