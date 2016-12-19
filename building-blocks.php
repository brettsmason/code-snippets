<?php
/*
 * Plugin Name: Building Blocks
 * Plugin URI: http://www.brettmason.co.uk
 * Description: Add a CodePen style building blocks library.
 * Version: 1.0.0
 * Author: Brett Mason
 * Author URI: http://www.brettmason.co.uk
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: building-blocks
 * Domain Path: /languages/
 *
 */
if ( ! defined( 'WPINC' ) ) { die; }


/* Constants
------------------------------------------ */

define( 'BUILDING_BLOCKS_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'BUILDING_BLOCKS_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'BUILDING_BLOCKS_FILE', __FILE__ );
define( 'BUILDING_BLOCKS_PLUGIN', plugin_basename( __FILE__ ) );
define( 'BUILDING_BLOCKS_VERSION', '1.0.0' );


/* Init
------------------------------------------ */

/* Load plugin in "plugins_loaded" hook */
add_action( 'plugins_loaded', 'building_blocks_init' );

/**
 * Plugin Init
 * @since 0.1.0
 */
function building_blocks_init() {

	/* Load Files
	------------------------------------------ */

	/* Post Type & Taxonomy */
	require_once( BUILDING_BLOCKS_PATH . 'includes/register-cpt.php' );

	/* Metaboxes */
	require_once( BUILDING_BLOCKS_PATH . 'includes/metaboxes.php' );
}


/* Activation
------------------------------------------ */

/* Register activation hook. */
register_activation_hook( __FILE__, 'building_blocks_plugin_activation' );