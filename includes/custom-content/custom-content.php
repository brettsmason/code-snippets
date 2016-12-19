<?php
namespace building_blocks;
if ( ! defined( 'WPINC' ) ) { die; }
Custom_Content::get_instance();

/**
 * Custom Content: Post Type & Taxonomy
 * @since 1.0.0
 */
class Custom_Content{

	/**
	 * Returns the instance.
	 */
	public static function get_instance() {
		static $instance = null;
		if ( is_null( $instance ) ) $instance = new self;
		return $instance;
	}

	/**
	 * Constructor.
	 */
	public function __construct() {

		/* Var */
		$this->uri  = trailingslashit( plugin_dir_url( __FILE__ ) );
		$this->path = trailingslashit( plugin_dir_path( __FILE__ ) );

		/* Register Post Type & Taxonomy */
		add_action( 'init', array( $this, 'register' ) );

		/* Admin Scripts */
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
	}

	/**
	 * Register Post Type & Taxonomy
	 */
	public function register() {

		/* Custom Post Type
		------------------------------------------ */
		$cpt_args = array(
			'description'           => '',
			'public'                => true,
			'publicly_queryable'    => true,
			'show_in_nav_menus'     => true,
			'show_in_admin_bar'     => true,
			'exclude_from_search'   => false,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 3,
			'menu_icon'             => 'dashicons-screenoptions',
			'can_export'            => true,
			'delete_with_user'      => false,
			'hierarchical'          => false,
			'has_archive'           => true, 
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'building-blocks', 'with_front' => false ),
			'capability_type'       => 'page',
			'supports'              => array( 'title', 'thumbnail' ),
			'labels'                => array(
				'name'                      => __( 'Building Blocks', 'building-blocks' ),
				'singular_name'             => __( 'Building Block', 'building-blocks' ),
				'add_new'                   => __( 'Add New', 'building-blocks' ),
				'add_new_item'              => __( 'Add New Item', 'building-blocks' ),
				'edit_item'                 => __( 'Edit Item', 'building-blocks' ),
				'new_item'                  => __( 'New Item', 'building-blocks' ),
				'all_items'                 => __( 'All Items', 'building-blocks' ),
				'view_item'                 => __( 'View Item', 'building-blocks' ),
				'search_items'              => __( 'Search Items', 'building-blocks' ),
				'not_found'                 => __( 'Not Found', 'building-blocks' ),
				'not_found_in_trash'        => __( 'Not Found in Bin', 'building-blocks' ), 
				'menu_name'                 => __( 'Building Blocks', 'building-blocks' ),
			),
		);
		register_post_type( 'building_block', $cpt_args );


		/* Custom Taxonomy
		------------------------------------------ */
		$ctax_args = array(
			'public'            => true,
			'show_ui'           => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'show_admin_column' => true,
			'hierarchical'      => true,
			'query_var'         => true,
			'labels' => array(
				'name'                       => __( 'Categories', 'building-blocks' ),
				'singular_name'              => __( 'Category', 'building-blocks' ),
				'name_admin_bar'             => __( 'Category', 'building-blocks' ),
				'search_items'               => __( 'Search Items', 'building-blocks' ),
				'popular_items'              => __( 'Popular Items', 'building-blocks' ),
				'all_items'                  => __( 'All Items', 'building-blocks' ),
				'edit_item'                  => __( 'Edit Item', 'building-blocks' ),
				'view_item'                  => __( 'View Item', 'building-blocks' ),
				'update_item'                => __( 'Update Item', 'building-blocks' ),
				'add_new_item'               => __( 'Add New Item', 'building-blocks' ),
				'new_item_name'              => __( 'New Item Name', 'building-blocks' ),
				'separate_items_with_commas' => __( 'Separate items with commas', 'building-blocks' ),
				'add_or_remove_items'        => __( 'Add or remove items', 'building-blocks' ),
				'choose_from_most_used'      => __( 'Choose from the most used items', 'building-blocks' ),
				'menu_name'                  => __( 'Categories', 'building-blocks' ),
			),
		);
		register_taxonomy( 'building_blocks_cat', array( 'building_blocks' ), $ctax_args );
	}


	/**
	 * Admin Scripts
	 */
	public function admin_scripts( $hook_suffix ) {
		global $post_type, $taxonomy;

		/* Register */
		wp_register_style( 'bb-style-admin', $this->uri . 'assets/style.css', array(), VERSION );
		wp_register_script( 'bb-script-admin', $this->uri . 'assets/script.js', array( 'jquery' ), VERSION, true );

		wp_register_script( 'ace', $this->uri . 'assets/src-noconflict/ace.js', array(), VERSION, true );

		/* Post Type Screen */
		if( 'building_block' == $post_type ) {

			/* Columns/List */
			if( 'edit.php' == $hook_suffix ) {
			}

			/* Add/Edit Screen */
			if( in_array( $hook_suffix, array( 'post-new.php', 'post.php' ) ) ) {
				wp_enqueue_style( 'bb-style-admin' );
				wp_enqueue_script( 'ace' );
				wp_enqueue_script( 'bb-script-admin' );
			}
		}

		/* Taxonomy Screen */
		if( 'building_blocks_category' == $taxonomy ) {

			/* Add New & Column/List */
			if( "edit-tags.php" == $hook_suffix ) {
			}

			/* Edit Screen */
			if( "term.php" == $hook_suffix ) {
			}
		}

	}

}