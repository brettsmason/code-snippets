<?php
class Code_Snippets_Meta_Box {

	public function __construct() {

		if ( is_admin() ) {
			add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
		}

	}

	public function init_metabox() {

		add_action( 'add_meta_boxes', array( $this, 'add_metabox'  )        );
		add_action( 'save_post',      array( $this, 'save_metabox' ), 10, 2 );

	}

	public function add_metabox() {

		add_meta_box(
			'code-snippets-code',
			__( 'Code', 'code-snippets' ),
			array( $this, 'render_metabox' ),
			'code_snippet',
			'advanced',
			'high'
		);

	}

	public function render_metabox( $post ) {

		// Add nonce for security and authentication.
		wp_nonce_field( 'code_snippets_code_nonce_action', 'code_snippets_code_nonce' );

		// Retrieve an existing value from the database.
		$cs_html = get_post_meta( $post->ID, 'cs_html', true );
		$cs_css  = get_post_meta( $post->ID, 'cs_css',  true );
		$cs_scss = get_post_meta( $post->ID, 'cs_scss', true );
		$cs_js   = get_post_meta( $post->ID, 'cs_js',   true );

		// Set default values.
		if( empty( $cs_html ) ) $cs_html = '';
		if( empty( $cs_css ) )  $cs_css  = '';
		if( empty( $cs_scss ) ) $cs_scss = '';
		if( empty( $cs_js ) )   $cs_js   = '';

		// Form fields.
		echo '	<p>';
		echo '		<h3><label for="cs-html" class="cs-html-label">' . __( 'HTML', 'code-snippets' ) . '</label></h3>';
		echo '		<textarea id="cs-html" name="cs_html" class="cs-html-field widefat cs-code-hidden">' . esc_attr__( $cs_html ) . '</textarea>';
		echo '		<div class="cs-editor-container"><div id="cs-code-html" class="cs-code-editor">' . esc_attr__( $cs_html ) . '</div></div>';
		echo '	</p>';

		echo '	<p>';
		echo '		<h3><label for="cs-css" class="cs-css-label">' . __( 'CSS', 'code-snippets' ) . '</label></h3>';
		echo '		<textarea id="cs-css" name="cs_css" class="cs-css-field widefat cs-code-hidden">' . esc_attr__( $cs_css ) . '</textarea>';
		echo '		<div class="cs-editor-container"><div id="cs-code-css" class="cs-code-editor">' . esc_attr__( $cs_css ) . '</div></div>';
		echo '	</p>';

		echo '	<p>';
		echo '		<h3><label for="cs-scss" class="cs-scss-label">' . __( 'SCSS', 'code-snippets' ) . '</label></h3>';
		echo '		<textarea id="cs-scss" name="cs_scss" class="cs-scss-field widefat cs-code-hidden">' . esc_attr__( $cs_scss ) . '</textarea>';
		echo '		<div class="cs-editor-container"><div id="cs-code-scss" class="cs-code-editor">' . esc_attr__( $cs_scss ) . '</div></div>';
		echo '	</p>';

		echo '	<p>';
		echo '		<h3><label for="cs-js" class="cs-js-label">' . __( 'JavaScript', 'code-snippets' ) . '</label></h3>';
		echo '		<textarea id="cs-js" name="cs_js" class="cs-js-field widefat cs-code-hidden">' . esc_attr__( $cs_js ) . '</textarea>';
		echo '		<div class="cs-editor-container"><div id="cs-code-js" class="cs-code-editor">' . esc_attr__( $cs_js ) . '</div></div>';
		echo '	</p>';

	}

	public function save_metabox( $post_id, $post ) {

		// Add nonce for security and authentication.
		$nonce_name   = $_POST['code_snippets_code_nonce'];
		$nonce_action = 'code_snippets_code_nonce_action';

		// Check if a nonce is set.
		if ( ! isset( $nonce_name ) )
			return;

		// Check if a nonce is valid.
		if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) )
			return;

		// Check if the user has permissions to save data.
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return;

		// Check if it's not an autosave.
		if ( wp_is_post_autosave( $post_id ) )
			return;

		// Check if it's not a revision.
		if ( wp_is_post_revision( $post_id ) )
			return;

		// Sanitize user input.
		$cs_new_html  = isset( $_POST[ 'cs_html' ] )  ? $_POST[ 'cs_html' ] : '';
		$cs_new_css   = isset( $_POST[ 'cs_css' ] )   ? $_POST[ 'cs_css' ] : '';
		$cs_new_scss  = isset( $_POST[ 'cs_scss' ] )  ? $_POST[ 'cs_scss' ] : '';
		$cs_new_js    = isset( $_POST[ 'cs_js' ] )    ? $_POST[ 'cs_js' ] : '';

		// Update the meta field in the database.
		update_post_meta( $post_id, 'cs_html', $cs_new_html );
		update_post_meta( $post_id, 'cs_css',  $cs_new_css );
		update_post_meta( $post_id, 'cs_scss', $cs_new_scss );
		update_post_meta( $post_id, 'cs_js',   $cs_new_js );

	}
}

new Code_Snippets_Meta_Box;