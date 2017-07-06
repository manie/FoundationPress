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
	function dando_admin_style() {
		wp_enqueue_style('admin-styles', get_template_directory_uri().'/assets/stylesheets/wp-admin.css');
	}
	add_action('admin_enqueue_scripts', 'dando_admin_style');

// Update Login CSS
	function dando_login_style() {
		wp_enqueue_style('admin-styles', get_template_directory_uri().'/assets/stylesheets/wp-login.css');
	}
	add_action('login_head', 'dando_login_style');

// ACF Hide post types in Post Object field
	function dando_post_object_query( $args, $field, $post_id ) {

		$args = array( 'public' => true, );
		$post_types = get_post_types( $args );

		// Remove Media posts
		if (in_array('attachment', $post_types)) {
		    unset($post_types[array_search('attachment',$post_types)]);
		    // unset($post_types[array_search('sliders',$post_types)]);
		}

		$args['post_type'] = $post_types;

		// return
		return $args;

	}

	// filter for every field
	add_filter('acf/fields/post_object/query', 'dando_post_object_query', 10, 3);

// Remove h1 from the WordPress editor.
	function dando_remove_h1_from_editor( $init ) {
		$init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Preformatted=pre;';
		return $init;
	}
	add_filter( 'tiny_mce_before_init', 'dando_remove_h1_from_editor' );

// Determines whether or not the current post is a paginated post.
	function dando_is_paginated_post() {
		global $multipage;
		return 0 !== $multipage;
	} // end dando_is_paginated_post

// Check if content is REALLY empty
	function empty_content($str) {
		return trim(str_replace('&nbsp;','',strip_tags($str))) == '';
	}