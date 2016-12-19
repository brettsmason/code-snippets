<?php

add_action( 'admin_enqueue_scripts', 'building_blocks_admin_register_styles',  0 );
add_action( 'admin_enqueue_scripts', 'building_blocks_admin_register_scripts', 0 );

/**
 * Registers admin styles.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function building_blocks_admin_register_styles() {
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_register_style( 'bb-style-admin', building_blocks_plugin()->css_uri . 'bb-admin.css' );

	wp_enqueue_style( 'bb-style-admin' );
}

/**
 * Registers admin scripts.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function building_blocks_admin_register_scripts() {
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_register_script( 'bb-script-admin', building_blocks_plugin()->js_uri . 'bb-admin.js', array( 'jquery' ), '', true );
	wp_register_script( 'ace', building_blocks_plugin()->js_uri . 'src-noconflict/ace.js', array(), '', true );

	wp_enqueue_script( 'ace' );
	wp_enqueue_script( 'bb-script-admin' );
}