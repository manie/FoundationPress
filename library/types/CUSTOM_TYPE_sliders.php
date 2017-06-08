<?php
/**
 * Clean up WordPress defaults
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */


// Register Custom Post Type
function custom_post_type_SLIDERS() {

 	$labels = array(
 		'name'                  => _x( 'Sliders', 'Sliders Post Type', 'DANDO' ),
 		'singular_name'         => _x( 'Slider', 'Slider Post Type', 'DANDO' ),
 		'menu_name'             => __( 'Sliders', 'DANDO' ),
 		'name_admin_bar'        => __( 'Sliders', 'DANDO' ),
 		'archives'              => __( 'Item Archives', 'DANDO' ),
 		'attributes'            => __( 'Item Attributes', 'DANDO' ),
 		'parent_item_colon'     => __( 'Parent Item:', 'DANDO' ),
 		'all_items'             => __( 'All Items', 'DANDO' ),
 		'add_new_item'          => __( 'Add New Item', 'DANDO' ),
 		'add_new'               => __( 'Add New', 'DANDO' ),
 		'new_item'              => __( 'New Item', 'DANDO' ),
 		'edit_item'             => __( 'Edit Item', 'DANDO' ),
 		'update_item'           => __( 'Update Item', 'DANDO' ),
 		'view_item'             => __( 'View Item', 'DANDO' ),
 		'view_items'            => __( 'View Items', 'DANDO' ),
 		'search_items'          => __( 'Search Item', 'DANDO' ),
 		'not_found'             => __( 'Not found', 'DANDO' ),
 		'not_found_in_trash'    => __( 'Not found in Trash', 'DANDO' ),
 		'featured_image'        => __( 'Featured Image', 'DANDO' ),
 		'set_featured_image'    => __( 'Set featured image', 'DANDO' ),
 		'remove_featured_image' => __( 'Remove featured image', 'DANDO' ),
 		'use_featured_image'    => __( 'Use as featured image', 'DANDO' ),
 		'insert_into_item'      => __( 'Insert into item', 'DANDO' ),
 		'uploaded_to_this_item' => __( 'Uploaded to this item', 'DANDO' ),
 		'items_list'            => __( 'Items list', 'DANDO' ),
 		'items_list_navigation' => __( 'Items list navigation', 'DANDO' ),
 		'filter_items_list'     => __( 'Filter items list', 'DANDO' ),
 	);
 	$args = array(
 		'label'                 => __( 'Slider', 'DANDO' ),
 		'description'           => __( 'Hero Slider', 'DANDO' ),
 		'labels'                => $labels,
 		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', ),
 		'taxonomies'            => array( 'slider_cat' ),
 		'hierarchical'          => false,
 		'public'                => true,
 		'show_ui'               => true,
 		'show_in_menu'          => true,
 		'menu_position'         => 5,
 		'menu_icon'             => 'dashicons-slides',
 		'show_in_admin_bar'     => true,
 		'show_in_nav_menus'     => true,
 		'can_export'            => true,
 		'has_archive'           => true,
 		'exclude_from_search'   => false,
 		'publicly_queryable'    => true,
 		'capability_type'       => 'post',
 	);
 	register_post_type( 'sliders', $args );

}
add_action( 'init', 'custom_post_type_SLIDERS', 0 );

// Register Custom Taxonomy
function custom_taxonomy_SLIDER_CAT() {

	$labels = array(
		'name'                       => _x( 'Slider Categories', 'Slider Categories', 'DANDO' ),
		'singular_name'              => _x( 'Slider Category', 'Slider Category', 'DANDO' ),
		'menu_name'                  => __( 'Categories', 'DANDO' ),
		'all_items'                  => __( 'All Items', 'DANDO' ),
		'parent_item'                => __( 'Parent Item', 'DANDO' ),
		'parent_item_colon'          => __( 'Parent Item:', 'DANDO' ),
		'new_item_name'              => __( 'New Item Name', 'DANDO' ),
		'add_new_item'               => __( 'Add New Item', 'DANDO' ),
		'edit_item'                  => __( 'Edit Item', 'DANDO' ),
		'update_item'                => __( 'Update Item', 'DANDO' ),
		'view_item'                  => __( 'View Item', 'DANDO' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'DANDO' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'DANDO' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'DANDO' ),
		'popular_items'              => __( 'Popular Items', 'DANDO' ),
		'search_items'               => __( 'Search Items', 'DANDO' ),
		'not_found'                  => __( 'Not Found', 'DANDO' ),
		'no_terms'                   => __( 'No items', 'DANDO' ),
		'items_list'                 => __( 'Items list', 'DANDO' ),
		'items_list_navigation'      => __( 'Items list navigation', 'DANDO' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => false,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'slider_cat', array( 'sliders' ), $args );

}
add_action( 'init', 'custom_taxonomy_SLIDER_CAT', 0 );
