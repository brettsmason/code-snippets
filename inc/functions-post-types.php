<?php
// Register Custom Post Type
function code_snippets_register_post_type() {

	$labels = array(
		'name'                  => _x( 'Code Snippets', 'Post Type General Name', 'code-snippets' ),
		'singular_name'         => _x( 'Code Snippet', 'Post Type Singular Name', 'code-snippets' ),
		'menu_name'             => __( 'Code Snippets', 'code-snippets' ),
		'name_admin_bar'        => __( 'Code Snippets', 'code-snippets' ),
		'parent_item_colon'     => __( 'Parent Code Snippet:', 'code-snippets' ),
		'all_items'             => __( 'All Code Snippets', 'code-snippets' ),
		'add_new_item'          => __( 'Add New Code Snippet', 'code-snippets' ),
		'add_new'               => __( 'Add New', 'code-snippets' ),
		'new_item'              => __( 'New Code Snippet', 'code-snippets' ),
		'edit_item'             => __( 'Edit Code Snippet', 'code-snippets' ),
		'update_item'           => __( 'Update Code Snippet', 'code-snippets' ),
		'view_item'             => __( 'View Code Snippet', 'code-snippets' ),
		'search_items'          => __( 'Search Code Snippets', 'code-snippets' ),
		'not_found'             => __( 'Not found', 'code-snippets' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'code-snippets' ),
		'items_list'            => __( 'Items list', 'code-snippets' ),
		'items_list_navigation' => __( 'Items list navigation', 'code-snippets' ),
		'filter_items_list'     => __( 'Filter items list', 'code-snippets' ),
	);
	$args = array(
		'label'                 => __( 'Code Snippet', 'code-snippets' ),
		'description'           => __( 'Code Snippets post type.', 'code-snippets' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', ),
		'taxonomies'            => array( 'code_snippet_category', 'code_snippet_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-editor-code',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'rewrite'	            => array(
			'slug' => 'snippet'
		)
	);
	register_post_type( 'code_snippet', $args );

}
add_action( 'init', 'code_snippets_register_post_type', 0 );