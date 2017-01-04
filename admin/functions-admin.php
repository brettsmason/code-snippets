<?php

add_action( 'admin_enqueue_scripts', 'code_snippets_admin_register_styles',  0 );
add_action( 'admin_enqueue_scripts', 'code_snippets_admin_register_scripts', 0 );

/**
 * Registers admin styles.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function code_snippets_admin_register_styles( $hook_suffix ) {
	global $post_type, $taxonomy;

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_register_style( 'code-snippets-style-admin', code_snippets_plugin()->css_uri . 'code-snippets-admin.css' );

	if( 'code_snippet' == $post_type ) {
		/* Add/Edit Screen */
		if( in_array( $hook_suffix, array( 'post-new.php', 'post.php' ) ) ) {
			wp_enqueue_style( 'code-snippets-style-admin' );
		}
	}
}

/**
 * Registers admin scripts.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function code_snippets_admin_register_scripts( $hook_suffix ) {
	global $post_type, $taxonomy;

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_register_script( 'code-snippets-script-admin', code_snippets_plugin()->js_uri . 'code-snippets-admin.js', array( 'jquery' ), '', true );
	wp_register_script( 'ace', code_snippets_plugin()->js_uri . 'src-noconflict/ace.js', array(), '', true );

	if( 'code_snippet' == $post_type ) {
		/* Add/Edit Screen */
		if( in_array( $hook_suffix, array( 'post-new.php', 'post.php' ) ) ){
			wp_enqueue_script( 'ace' );
			wp_enqueue_script( 'code-snippets-script-admin' );
		}
	}
}