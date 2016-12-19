<?php
class Building_Block_Code_Meta_Box {

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
			'bb_code',
			__( 'Code', 'text_domain' ),
			array( $this, 'render_metabox' ),
			'building_block',
			'advanced',
			'high'
		);

	}

	public function render_metabox( $post ) {

		// Add nonce for security and authentication.
		wp_nonce_field( 'bb_code_nonce_action', 'bb_code_nonce' );

		// Retrieve an existing value from the database.
		$bb_html = get_post_meta( $post->ID, 'bb_html', true );
		$bb_css  = get_post_meta( $post->ID, 'bb_css', true );
		$bb_scss = get_post_meta( $post->ID, 'bb_scss', true );
		$bb_js   = get_post_meta( $post->ID, 'bb_js', true );

		// Set default values.
		if( empty( $bb_html ) ) $bb_html = '';
		if( empty( $bb_css ) ) $bb_css = '';
		if( empty( $bb_scss ) ) $bb_scss = '';
		if( empty( $bb_js ) ) $bb_js = '';

		// Form fields.
		echo '	<p>';
		echo '		<h3><label for="bb_html" class="bb_html_label">' . __( 'HTML', 'text_domain' ) . '</label></h3>';
		echo '		<textarea id="bb_html" name="bb_html" class="bb_html_field widefat bb_code_hidden">' . esc_attr__( $bb_html ) . '</textarea>';
		echo '		<div class="bb_editor_container"><div id="bb_code_html" class="bb_code_editor">' . esc_attr__( $bb_html ) . '</div></div>';
		echo '	</p>';

		echo '	<p>';
		echo '		<h3><label for="bb_css" class="bb_css_label">' . __( 'CSS', 'text_domain' ) . '</label></h3>';
		echo '		<textarea id="bb_css" name="bb_css" class="bb_css_field widefat bb_code_hidden">' . esc_attr__( $bb_css ) . '</textarea>';
		echo '		<div class="bb_editor_container"><div id="bb_code_css" class="bb_code_editor">' . esc_attr__( $bb_css ) . '</div></div>';
		echo '	</p>';

		echo '	<p>';
		echo '		<h3><label for="bb_scss" class="bb_scss_label">' . __( 'SCSS', 'text_domain' ) . '</label></h3>';
		echo '		<textarea id="bb_scss" name="bb_scss" class="bb_scss_field widefat bb_code_hidden">' . esc_attr__( $bb_scss ) . '</textarea>';
		echo '		<div class="bb_editor_container"><div id="bb_code_scss" class="bb_code_editor">' . esc_attr__( $bb_scss ) . '</div></div>';
		echo '	</p>';

		echo '	<p>';
		echo '		<h3><label for="bb_js" class="bb_js_label">' . __( 'JavaScript', 'text_domain' ) . '</label></h3>';
		echo '		<textarea id="bb_js" name="bb_js" class="bb_js_field widefat bb_code_hidden">' . esc_attr__( $bb_js ) . '</textarea>';
		echo '		<div class="bb_editor_container"><div id="bb_code_js" class="bb_code_editor">' . esc_attr__( $bb_js ) . '</div></div>';
		echo '	</p>';

	}

	public function save_metabox( $post_id, $post ) {

		// Add nonce for security and authentication.
		$nonce_name   = $_POST['bb_code_nonce'];
		$nonce_action = 'bb_code_nonce_action';

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
		$bb_new_html  = isset( $_POST[ 'bb_html' ] )  ? wp_kses_post( $_POST[ 'bb_html' ] ) : '';
		$bb_new_css   = isset( $_POST[ 'bb_css' ] )   ? wp_strip_all_tags( $_POST[ 'bb_css' ] )  : '';
		$bb_new_scss  = isset( $_POST[ 'bb_scss' ] )  ? wp_strip_all_tags( $_POST[ 'bb_scss' ] )  : '';
		$bb_new_js    = isset( $_POST[ 'bb_js' ] )    ? esc_js( $_POST[ 'bb_js' ] )   : '';

		// Update the meta field in the database.
		update_post_meta( $post_id, 'bb_html', $bb_new_html );
		update_post_meta( $post_id, 'bb_css', $bb_new_css );
		update_post_meta( $post_id, 'bb_scss', $bb_new_scss );
		update_post_meta( $post_id, 'bb_js', $bb_new_js );

	}
}

new Building_Block_Code_Meta_Box;