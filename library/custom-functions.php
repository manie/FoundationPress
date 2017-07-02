<?php
/**
 * Custom functions
 *
 * @package foundationWP
 */

// Check if sidebar is active
	function is_sidebar_active($index) {
		global $wp_registered_sidebars;
		$widgetcolums = wp_get_sidebars_widgets();
		if ($widgetcolums[$index])
			return true;
		return false;
	}

// Update CSS within in Admin
	function admin_style() {
		wp_enqueue_style('admin-styles', get_template_directory_uri().'/assets/stylesheets/admin.css');
	}
	add_action('admin_enqueue_scripts', 'admin_style');

// ACF Hide post types in Post Object field
	function dando_post_object_query( $args, $field, $post_id ) {

		$args = array( 'public' => true, );
		$post_types = get_post_types( $args );

		// Remove Media posts
		if (in_array('attachment', $post_types)) {
		    unset($post_types[array_search('attachment',$post_types)]);
		}

		$args['post_type'] = $post_types;

		// return
		return $args;

	}

	// filter for every field
	add_filter('acf/fields/post_object/query', 'dando_post_object_query', 10, 3);