<?php
/*
 * Plugin Name: Code Snippets
 * Plugin URI: http://www.brettmason.co.uk
 * Description: Add a CodePen style code snippets library.
 * Version: 1.0.0
 * Author: Brett Mason
 * Author URI: http://www.brettmason.co.uk
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: code-snippets
 * Domain Path: /languages/
 *
 */

/**
 * Singleton class for setting up the plugin.
 *
 * @since  1.0.0
 * @access public
 */
final class Code_Snippets_Plugin {
	/**
	 * Plugin directory path.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $dir_path = '';
	/**
	 * Plugin directory URI.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $dir_uri = '';
	/**
	 * Plugin admin directory path.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $admin_dir = '';
	/**
	 * Plugin includes directory path.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $inc_dir = '';
	/**
	 * Plugin templates directory path.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $templates_dir = '';
	/**
	 * Plugin CSS directory URI.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $css_uri = '';
	/**
	 * Plugin JS directory URI.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $js_uri = '';
	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {
		static $instance = null;
		if ( is_null( $instance ) ) {
			$instance = new Code_Snippets_Plugin;
			$instance->setup();
			$instance->includes();
			$instance->setup_actions();
		}
		return $instance;
	}
	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}
	/**
	 * Magic method to output a string if trying to use the object as a string.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function __toString() {
		return 'code-snippets';
	}
	/**
	 * Magic method to keep the object from being cloned.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Whoah, partner!', 'code-snippets' ), '1.0.0' );
	}
	/**
	 * Magic method to keep the object from being unserialized.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Whoah, partner!', 'code-snippets' ), '1.0.0' );
	}
	/**
	 * Magic method to prevent a fatal error when calling a method that doesn't exist.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return null
	 */
	public function __call( $method = '', $args = array() ) {
		_doing_it_wrong( "Code_Snippets_Plugin::{$method}", esc_html__( 'Method does not exist.', 'code-snippets' ), '1.0.0' );
		unset( $method, $args );
		return null;
	}
	/**
	 * Sets up globals.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	private function setup() {
		// Main plugin directory path and URI.
		$this->dir_path = trailingslashit( plugin_dir_path( __FILE__ ) );
		$this->dir_uri  = trailingslashit( plugin_dir_url(  __FILE__ ) );
		// Plugin directory paths.
		$this->inc_dir       = trailingslashit( $this->dir_path . 'inc'       );
		$this->admin_dir     = trailingslashit( $this->dir_path . 'admin'     );
		$this->templates_dir = trailingslashit( $this->dir_path . 'templates' );
		// Plugin directory URIs.
		$this->css_uri = trailingslashit( $this->dir_uri . 'css' );
		$this->js_uri  = trailingslashit( $this->dir_uri . 'js'  );
	}
	/**
	 * Loads files needed by the plugin.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	private function includes() {

		// Load functions files.
		require_once( $this->dir_path . 'inc/class-embed.php' );
		require_once( $this->dir_path . 'inc/class-metabox-code.php' );
		require_once( $this->dir_path . 'inc/class-metabox-css-libraries.php' );
		require_once( $this->dir_path . 'inc/class-metabox-js-libraries.php' );
		require_once( $this->dir_path . 'inc/functions-post-types.php' );
		require_once( $this->dir_path . 'inc/functions-taxonomies.php' );
		require_once( $this->dir_path . 'inc/functions-template.php' );

		// Load admin files.
		if ( is_admin() ) {
			require_once( $this->admin_dir . 'functions-admin.php'  );
		}
	}
	/**
	 * Sets up main plugin actions and filters.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	private function setup_actions() {
		// Internationalize the text strings used.
		add_action( 'plugins_loaded', array( $this, 'i18n' ), 2 );
		// Register activation hook.
		register_activation_hook( __FILE__, array( $this, 'activation' ) );
	}
	/**
	 * Loads the translation files.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function i18n() {
		load_plugin_textdomain( 'code-snippets', false, trailingslashit( dirname( plugin_basename( __FILE__ ) ) ). 'languages' );
	}
}
/**
 * Gets the instance of the `Code_Snippets_Plugin` class.  This function is useful for quickly grabbing data
 * used throughout the plugin.
 *
 * @since  1.0.0
 * @access public
 * @return object
 */
function Code_Snippets_plugin() {
	return Code_Snippets_Plugin::get_instance();
}
// Let's roll!
Code_Snippets_plugin();