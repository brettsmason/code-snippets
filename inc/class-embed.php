<?php
class Building_Block_Embed {

	public function __construct() {

		// Remove title from embed
		add_filter( 'the_title',  array( $this, 'title' ), 10, 2 );

		// Add post meta to embed
		add_action( 'embed_content', array( $this, 'embed_code' ) );

		// Remove default embed styles
		remove_action( 'embed_head', 'print_embed_styles' );

		// Enqueue custom styles for embed
		add_action( 'enqueue_embed_scripts', array( $this, 'enqueue_styles' ) );

		// Enqueue custom scripts for embed
		add_action( 'enqueue_embed_scripts', array( $this, 'enqueue_scripts' ) );

		// Building block post meta CSS
		add_action( 'embed_head', array( $this, 'head_styles' ) );

		// Building block post meta JavaScript
		add_action( 'embed_footer', array( $this, 'footer_scripts' ) );

	}

	public function title( $title, $id ) {
		$post = get_post( $id );

		if ( is_embed() && 'building_block' === $post->post_type ) {
		  return '';
		}

		return $title;
	}

	public function embed_code() {
		if ( 'building_block' !== get_post_type() ) {
		  return;
		}

		$output = get_post_meta( get_the_ID(), 'bb_html', true );

		echo $output;
	}

	/**
	 * Add the plugin's custom embed styles
	 */
	function enqueue_styles() {
		if ( 'building_block' !== get_post_type() ) {
	      return;
		}

		wp_enqueue_style( 'bb-embed-styles', building_blocks_plugin()->dir_uri . 'css/wp-embed-template.css', array(), '6.3.0' );
		wp_enqueue_style( 'foundation-css', building_blocks_plugin()->dir_uri . 'css/foundation.min.css', array(), '6.3.0' );
	}


	/**
	 * Add the plugin's custom embed scripts
	 */
	function enqueue_scripts() {
		if ( 'building_block' !== get_post_type() ) {
	      return;
		}

		wp_enqueue_script( 'foundation-js', building_blocks_plugin()->dir_uri . 'js/foundation.min.js', array('jquery'), '6.3.0', true );
		wp_enqueue_script( 'foundation-init', building_blocks_plugin()->dir_uri . 'js/foundation-init.js', array('foundation-js'), '6.3.0', true );
	}

	/**
	 * Add the building blocks custom styles to the embed
	 */
	function head_styles() {
		if ( 'building_block' !== get_post_type() ) {
	      return;
		}

		$css = get_post_meta( get_the_ID(), 'bb_css', true );
		echo '<style>' . $css . '</style>';
	}

	/**
	 * Add the building blocks custom styles to the embed
	 */
	function footer_scripts() {
		if ( 'building_block' !== get_post_type() ) {
	      return;
		}

		$js = get_post_meta( get_the_ID(), 'bb_js', true );
		echo '<script>' . $js . '</script>';
	}
}

new Building_Block_Embed;