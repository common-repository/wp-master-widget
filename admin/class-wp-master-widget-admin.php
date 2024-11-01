<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       //wpmaster.com
 * @since      1.0.0
 *
 * @package    Wp_Master_Widget
 * @subpackage Wp_Master_Widget/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Master_Widget
 * @subpackage Wp_Master_Widget/admin
 * @author     Sean Roh <sean@wpmaster.com>
 */
class Wp_Master_Widget_Admin {

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
		 * defined in Wp_Master_Widget_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Master_Widget_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-master-widget-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-jquery-ui', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-jquery-ui-theme', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.theme.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-font-awesome-style', plugins_url( 'common/css/font-awesome.css', plugin_dir_path( __FILE__ ) ), array(), '4.7.0' );
		wp_enqueue_style( 'wp-color-picker' );
		//wp_register_style( 'Font_Awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css' );
		//wp_enqueue_style('Font_Awesome');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_register_script( $this->plugin_name . '-widget', plugin_dir_url( __FILE__ ) . 'js/wp-master-widget-admin.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-accordion', 'jquery-ui-sortable','jquery-ui-dialog' ), $this->version, false );
		$params = array(
			'ajax_nonce' => wp_create_nonce( 'wpmw-widget-control-nonce' )
		);
		wp_localize_script( $this->plugin_name . '-widget', 'wpmw_widget', $params );
		wp_enqueue_script( $this->plugin_name . '-widget' );
		wp_enqueue_script( $this->plugin_name . '-wp-color-picker-alpha', plugin_dir_url( __FILE__ ) . 'js/wp-color-picker-alpha.min.js', array( 'wp-color-picker' ), '1.2.2', true );
	}

	/**
	 * Register the WP Master Widget.
	 *
	 * @since    1.0.0
	 */
	public function register_wp_master_widget(){
		register_widget( 'wp_master_widget_widget' );
	}

}
