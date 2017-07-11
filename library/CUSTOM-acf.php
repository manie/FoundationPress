<?php
/**
 * Custom functions for ACF
 *
 * @package foundationWP
 */

// ACF PRO - Remove WP Custom fields meta box
	add_filter('acf/settings/remove_wp_meta_box', '__return_true');

// ACF PRO - Change auto SAVE & LOAD path
	add_filter('acf/settings/save_json', 'dando_acf_json_save_point');
	function dando_acf_json_save_point( $path ) {
		$path = get_stylesheet_directory() . '/library/acf';
		return $path;
	}
	add_filter('acf/settings/load_json', 'dando_acf_json_load_point');
	function dando_acf_json_load_point( $paths ) {
		unset($paths[0]);
		$paths[] = get_stylesheet_directory() . '/library/acf';
		return $paths;
	}

// ACF PRO - Register theme options page
	if( function_exists('acf_add_options_page') ) {
		acf_add_options_page(array(
			'page_title' 	=> '',
			'menu_title' 	=> 'Theme Options',
			'menu_slug' 	=> 'theme_options',
			// 'parent_slug' 	=> 'themes.php',
			'capability' 	=> 'manage_options',
			'icon_url' 		=> 'dashicons-dashboard',
			'redirect' 		=> false
		));
	}

// ACF PRO - Register & define a Google Maps API key to allow the location field to work correctly.
	if( function_exists('get_field') ) {
		if (get_field('dcf_google_maps_api_key', 'option')) {
			$google_maps_api_key = get_field('dcf_google_maps_api_key', 'option');
		} else { $google_maps_api_key = null; }
	}

	if ( isset($google_maps_api_key) ) {

		// ASC settings
		function dando_acf_init_api() {
			if (get_field('dcf_google_maps_api_key', 'option')) {
				$google_maps_api_key = get_field('dcf_google_maps_api_key', 'option');
			} else { $google_maps_api_key = null; }
			if ( isset($google_maps_api_key) ) {
				acf_update_setting('google_api_key', $google_maps_api_key);
			}
		}
		add_action('acf/init', 'dando_acf_init_api');

		// Enquee Google Maps scripts
		function dando_acf_google_maps_enqueue(){
			if (get_field('dcf_google_maps_api_key', 'option')) {
				$google_maps_api_key = get_field('dcf_google_maps_api_key', 'option');
			} else { $google_maps_api_key = null; }
			if ( isset($google_maps_api_key) ) {
				wp_enqueue_script( 'google-maps-api', '//maps.googleapis.com/maps/api/js?libraries=places&key='.$google_maps_api_key, array( 'jquery' ), null, false );
			}
		}
		add_action( 'wp_enqueue_scripts', 'dando_acf_google_maps_enqueue' );
	}
