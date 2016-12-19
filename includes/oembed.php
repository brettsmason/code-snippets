<?php

// Remove the embed title
function remove_embed_title( $title, $id ) {
    $post = get_post( $id );

    if ( is_embed() && 'building_block' === $post->post_type ) {
      return '';
    }

    return $title;
}
add_filter( 'the_title', 'remove_embed_title', 10, 2 );


/**
 * Add the author div to the embed iframe.
 */
function embed_code_html() {
    if ( 'building_block' !== get_post_type() ) {
      return;
    }

    $output = get_post_meta( get_the_ID(), 'bb_html', true );;

    echo $output;
}
add_action( 'embed_content', 'embed_code_html' );



/**
 * Embed the plugin's custom styles
 */
function embed_styles() {
	if ( 'building_block' !== get_post_type() ) {
      return;
    }

	wp_enqueue_style( 'bb-code-embed-styles', BUILDING_BLOCKS_URI . 'assets/wp-embed-template.css', array(), '6.3.0' );

    $css = get_post_meta( get_the_ID(), 'bb_css', true );
	echo '<style>' . $css . '</style>';

	// Foundation
	wp_enqueue_style( 'foundation-css', BUILDING_BLOCKS_URI . 'assets/foundation/foundation.min.css', array(), '6.3.0' );
	// wp_enqueue_style( 'foundation-flex-css', BUILDING_BLOCKS_URI . 'assets/foundation/foundation-flex.min.css', array(), '6.3.0' );
}
add_action( 'embed_head', 'embed_styles' );


/**
 * Embed the plugin's custom scripts
 */
function embed_scripts() {
	if ( 'building_block' !== get_post_type() ) {
      return;
    }

	// Foundation
	wp_enqueue_script( 'foundation-js', BUILDING_BLOCKS_URI . 'assets/foundation/foundation.min.js', array('jquery'), '6.3.0', true );
	wp_enqueue_script( 'foundation-init', BUILDING_BLOCKS_URI . 'assets/foundation/foundation-init.js', array('foundation-js'), '6.3.0', true );

    $js = get_post_meta( get_the_ID(), 'bb_js', true );
	echo '<script>' . $js . '</script>';
}
add_action( 'embed_footer', 'embed_scripts' );


// Remove default embed styles
remove_action( 'embed_head', 'print_embed_styles' );