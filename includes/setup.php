<?php
/**
 * Setup Plugin
 * @since 1.0.0
**/
namespace building_blocks;
if ( ! defined( 'WPINC' ) ) { die; }

/* Constants
------------------------------------------ */

define( __NAMESPACE__ . '\URI', $uri );
define( __NAMESPACE__ . '\PATH', $path );
define( __NAMESPACE__ . '\FILE', $file );
define( __NAMESPACE__ . '\PLUGIN', $plugin );
define( __NAMESPACE__ . '\VERSION', $version );


/* Load Files
------------------------------------------ */

/* Post Type & Taxonomy */
require_once( PATH . 'includes/custom-content/custom-content.php' );
require_once( PATH . 'includes/custom-content/metaboxes.php' );
