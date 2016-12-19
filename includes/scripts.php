<?php

// Registers scripts
function bb_code_scripts() {

  global $post_type;

	/* Register */
	wp_register_style( 'bb-style-admin', BUILDING_BLOCKS_URI . 'assets/style.css', array(), BUILDING_BLOCKS_VERSION );
	wp_register_script( 'bb-script-admin', BUILDING_BLOCKS_URI . 'assets/script.js', array( 'jquery' ), BUILDING_BLOCKS_VERSION, true );
	wp_register_script( 'ace', BUILDING_BLOCKS_URI . 'assets/src-noconflict/ace.js', array(), BUILDING_BLOCKS_VERSION, true );

  if( 'building_block' == $post_type ) {
    wp_enqueue_script( 'ace' );
    wp_enqueue_style( 'bb-style-admin' );
    wp_enqueue_script( 'bb-script-admin' );
  }

}
add_action( 'admin_print_scripts-post-new.php', 'bb_code_scripts', 11 );
add_action( 'admin_print_scripts-post.php', 'bb_code_scripts', 11 );