<?php
// Register Custom Post Type
function bb_register_post_type() {

	$labels = array(
		'name'                  => _x( 'Building Blocks', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Building Block', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Building Blocks', 'text_domain' ),
		'name_admin_bar'        => __( 'Building Blocks', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Building Block:', 'text_domain' ),
		'all_items'             => __( 'All Building Blocks', 'text_domain' ),
		'add_new_item'          => __( 'Add New Building Block', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Building Block', 'text_domain' ),
		'edit_item'             => __( 'Edit Building Block', 'text_domain' ),
		'update_item'           => __( 'Update Building Block', 'text_domain' ),
		'view_item'             => __( 'View Building Block', 'text_domain' ),
		'search_items'          => __( 'Search Building Block', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Building Block', 'text_domain' ),
		'description'           => __( 'Building Block post type.', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', ),
		'taxonomies'            => array( 'bb_code_category', 'bb_code_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-screenoptions',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'building_block', $args );

}
add_action( 'init', 'bb_register_post_type', 0 );