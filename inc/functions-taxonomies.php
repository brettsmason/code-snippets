<?php
// Register Custom Taxonomy
function code_snippets_category_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Categories', 'Taxonomy General Name', 'code-snippets' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'code-snippets' ),
		'menu_name'                  => __( 'Categories', 'code-snippets' ),
		'all_items'                  => __( 'All Items', 'code-snippets' ),
		'parent_item'                => __( 'Parent Item', 'code-snippets' ),
		'parent_item_colon'          => __( 'Parent Item:', 'code-snippets' ),
		'new_item_name'              => __( 'New Item Name', 'code-snippets' ),
		'add_new_item'               => __( 'Add New Item', 'code-snippets' ),
		'edit_item'                  => __( 'Edit Item', 'code-snippets' ),
		'update_item'                => __( 'Update Item', 'code-snippets' ),
		'view_item'                  => __( 'View Item', 'code-snippets' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'code-snippets' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'code-snippets' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'code-snippets' ),
		'popular_items'              => __( 'Popular Items', 'code-snippets' ),
		'search_items'               => __( 'Search Items', 'code-snippets' ),
		'not_found'                  => __( 'Not Found', 'code-snippets' ),
		'items_list'                 => __( 'Items list', 'code-snippets' ),
		'items_list_navigation'      => __( 'Items list navigation', 'code-snippets' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'code_snippet_category', array( 'code_snippet' ), $args );

}
add_action( 'init', 'code_snippets_category_taxonomy', 0 );


// Register Custom Taxonomy
function code_snippets_tag_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Tags', 'Taxonomy General Name', 'code-snippets' ),
		'singular_name'              => _x( 'Tag', 'Taxonomy Singular Name', 'code-snippets' ),
		'menu_name'                  => __( 'Tags', 'code-snippets' ),
		'all_items'                  => __( 'All Items', 'code-snippets' ),
		'parent_item'                => __( 'Parent Item', 'code-snippets' ),
		'parent_item_colon'          => __( 'Parent Item:', 'code-snippets' ),
		'new_item_name'              => __( 'New Item Name', 'code-snippets' ),
		'add_new_item'               => __( 'Add New Item', 'code-snippets' ),
		'edit_item'                  => __( 'Edit Item', 'code-snippets' ),
		'update_item'                => __( 'Update Item', 'code-snippets' ),
		'view_item'                  => __( 'View Item', 'code-snippets' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'code-snippets' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'code-snippets' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'code-snippets' ),
		'popular_items'              => __( 'Popular Items', 'code-snippets' ),
		'search_items'               => __( 'Search Items', 'code-snippets' ),
		'not_found'                  => __( 'Not Found', 'code-snippets' ),
		'items_list'                 => __( 'Items list', 'code-snippets' ),
		'items_list_navigation'      => __( 'Items list navigation', 'code-snippets' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'code_snippet_tag', array( 'code_snippet' ), $args );

}
add_action( 'init', 'code_snippets_tag_taxonomy', 0 );