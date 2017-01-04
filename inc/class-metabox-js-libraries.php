<?php
class Code_Snippets_JS_Libraries_Meta_Box {

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
			'code-snippets-js-libraries',
			__( 'JS Libraries', 'code-snippets' ),
			array( $this, 'render_metabox' ),
			'code_snippet',
			'side',
			'low'
		);

	}

	public function render_metabox( $post ) { ?>

		<?php
		// Add nonce for security and authentication.
		wp_nonce_field( 'code_snippets_js_libraries_nonce_action', 'code_snippets_js_libraries_nonce' );

		// Retrieve an existing value from the database.
		$cs_js_libraries = get_post_meta( $post->ID, 'cs_js_libraries', true );
		// Set default values.
		if( empty( $cs_js_libraries ) ) $cs_js_libraries = '';

		// Form fields.
		?>

		<p>
			<label><input type="checkbox" name="cs_js_libraries[]" id="cs-js-libraries" value="foundation-6" <?php if ( is_array( $cs_js_libraries ) && in_array( 'foundation-6', $cs_js_libraries ) ) { echo 'checked="checked"'; } ?>>Foundation 6</label></br>
			<label><input type="checkbox" name="cs_js_libraries[]" id="cs-js-libraries" value="foundation-5" <?php if ( is_array( $cs_js_libraries ) && in_array( 'foundation-5', $cs_js_libraries ) ) { echo 'checked="checked"'; } ?>>Foundation 5</label>
		</p>

	<?php }

	public function save_metabox( $post_id, $post ) {

		// Add nonce for security and authentication.
		$nonce_name   = $_POST['code_snippets_js_libraries_nonce'];
		$nonce_action = 'code_snippets_js_libraries_nonce_action';

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
		$cs_new_js_libraries  = isset( $_POST[ 'cs_js_libraries' ] )  ? $_POST[ 'cs_js_libraries' ] : '';

		// Update the meta field in the database.
		update_post_meta( $post_id, 'cs_js_libraries', $cs_new_js_libraries );

	}
}

new Code_Snippets_JS_Libraries_Meta_Box;