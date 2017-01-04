<?php
class Code_Snippets_Embed {

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

		// Code Snippet post meta CSS
		add_action( 'embed_head', array( $this, 'head_styles' ) );

		// Code Snippet post meta JavaScript
		add_action( 'embed_footer', array( $this, 'footer_scripts' ) );

	}

	public function title( $title, $id ) {
		$post = get_post( $id );

		if ( is_embed() && 'code_snippet' === $post->post_type ) {
		  // return '';
		}

		return $title;
	}

	public function embed_code() {
		if ( 'code_snippet' !== get_post_type() ) {
		  return;
		}

		$output = '<div class="wp-embed-content">' . get_post_meta( get_the_ID(), 'cs_html', true ) . '</div>';

		echo $output;
	}

	/**
	 * Add the plugin's custom embed styles
	 */
	function enqueue_styles() {
		if ( 'code_snippet' !== get_post_type() ) {
	      return;
		}

		wp_enqueue_style( 'code-snippets-embed-styles', code_snippets_plugin()->dir_uri . 'css/wp-embed-template.css', array(), '6.3.0' );
		wp_enqueue_style( 'foundation-css', code_snippets_plugin()->dir_uri . 'css/foundation.min.css', array(), '6.3.0' );
	}


	/**
	 * Add the plugin's custom embed scripts
	 */
	function enqueue_scripts() {
		if ( 'code_snippet' !== get_post_type() ) {
	      return;
		}

		wp_enqueue_script( 'foundation-js', code_snippets_plugin()->dir_uri . 'js/foundation.min.js', array('jquery'), '6.3.0', true );
		wp_enqueue_script( 'foundation-init', code_snippets_plugin()->dir_uri . 'js/foundation-init.js', array('foundation-js'), '6.3.0', true );
	}

	/**
	 * Add the building blocks custom styles to the embed
	 */
	function head_styles() {
		if ( 'code_snippet' !== get_post_type() ) {
	      return;
		}

		$css = get_post_meta( get_the_ID(), 'cs_css', true );
		echo '<style>' . $css . '</style>';
	}

	/**
	 * Add the building blocks custom styles to the embed
	 */
	function footer_scripts() {
		if ( 'code_snippet' !== get_post_type() ) {
	      return;
		}

		$js = get_post_meta( get_the_ID(), 'cs_js', true );
		echo '<script>' . $js . '</script>';
	}
}

new Code_Snippets_Embed;