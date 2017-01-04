<?php
class Code_Snippets_CSS_Libraries_Meta_Box {

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
			'code-snippets-css-libraries',
			__( 'CSS Libraries', 'code-snippets' ),
			array( $this, 'render_metabox' ),
			'code_snippet',
			'side',
			'low'
		);

	}

	public function render_metabox( $post ) { ?>

		<?php
		// Add nonce for security and authentication.
		wp_nonce_field( 'code_snippets_css_libraries_nonce_action', 'code_snippets_css_libraries_nonce' );

		// Retrieve an existing value from the database.
		$cs_css_libraries = get_post_meta( $post->ID, 'cs_css_libraries', true );
		// Set default values.
		if( empty( $cs_css_libraries ) ) $cs_css_libraries = '';

		// Form fields.
		?>

		<p>
			<label><input type="checkbox" name="cs_css_libraries[]" id="cs-css-libraries" value="foundation-6" <?php if ( is_array( $cs_css_libraries ) && in_array( 'foundation-6', $cs_css_libraries ) ) { echo 'checked="checked"'; } ?>>Foundation 6</label></br>
			<label><input type="checkbox" name="cs_css_libraries[]" id="cs-css-libraries" value="foundation-5" <?php if ( is_array( $cs_css_libraries ) && in_array( 'foundation-5', $cs_css_libraries ) ) { echo 'checked="checked"'; } ?>>Foundation 5</label>
		</p>

	<?php }

	public function save_metabox( $post_id, $post ) {

		// Add nonce for security and authentication.
		$nonce_name   = $_POST['code_snippets_css_libraries_nonce'];
		$nonce_action = 'code_snippets_css_libraries_nonce_action';

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
		$cs_new_css_libraries  = isset( $_POST[ 'cs_css_libraries' ] )  ? $_POST[ 'cs_css_libraries' ] : '';

		// Update the meta field in the database.
		update_post_meta( $post_id, 'cs_css_libraries', $cs_new_css_libraries );

	}
}

new Code_Snippets_CSS_Libraries_Meta_Box;