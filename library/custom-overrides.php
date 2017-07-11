<?php
/**
 * Overrides on both FoundationPress and WP
 *
 * @package foundationWP
 */

// Custom WP deafult settings on theme activate

	// First we check to see if our default theme settings have been applied.
	$the_theme_status = get_option( 'theme_setup_status' );

	// If the theme has not yet been used we want to run our default settings.
	if ( $the_theme_status !== '1' ) {

		// Setup Default WordPress settings
		$core_settings = array(

			// General Settings
				// Tagline
				'blogdescription'						=> '',			// SHOULD BE BLANK !!!

			// Writing Settings
				// Formatting
				'use_smilies'							=> '',			// Convert emoticons like :-) and :-P to graphics on display

			// Reading Settings
				'posts_per_page'						=> 9,			// Blog pages show at most X posts
				'posts_per_rss'							=> 3,			// Syndication feeds show the most recent X items
				'rss_use_excerpt'						=> '1',			// For each article in a feed, show 1=Summary, 0=Full text
				// 'blog_public'						=> '',			// Discourage search engines from indexing this site

			// Discussion Settings
				// Default article settings
				'default_pingback_flag'					=> '',			// Attempt to notify any blogs linked to from the article
				'default_ping_status'					=> '',			// Allow link notifications from other blogs (pingbacks and trackbacks)
				'default_comment_status'				=> '',			// Allow people to post comments on new articles
				// Other comment settings
				'require_name_email'					=> '1',			// Comment author must fill out name and e-mail
				'comment_registration'					=> '',			// Users must be registered and logged in to comment
				'close_comments_for_old_posts'			=> '',			// Automatically close comments on articles older than X days
				'close_comments_days_old'				=> 14,			// Automatically close comments on articles older than X days (SET X)
				'thread_comments'						=> '1',			// Enable threaded (nested) comments X levels deep
				'thread_comments_depth'					=> 5,			// Enable threaded (nested) comments X levels deep (SET X)
				'page_comments'							=> '1',			// Break comments into pages with X top level comments per page and the Y page displayed by default
				'comments_per_page'						=> 5,			// Break comments into pages with X top level comments per page and the Y page displayed by default (SET X)
				'default_comments_page'					=> 'newest',	// Break comments into pages with X top level comments per page and the Y page displayed by default (SET Y)
				'comment_order'							=> 'desc',		// Comments should be displayed with the X comments at the top of each page
				// E-mail me whenever
				'comments_notify'						=> '',			// Anyone posts a comment
				'moderation_notify'						=> '1',			// A comment is held for moderation
				// Before a comment appears
				'comment_moderation'					=> '1',			// Comment must be manually approved
				'comment_whitelist'						=> '',			// Comment author must have a previously approved comment
				// Comment Moderation
				'comment_max_links'						=> 0,			// Hold a comment in the queue if it contains X or more links.
				// Comment Blacklist
				// 'name'				=> 'set',		//

			// Avatars
				// Avatar Display
				// 'name'				=> 'set',		//
				// Maximum Rating
				'avatar_rating'					=> 'G',							// Avatar rating
				// Default Avatar
				'avatar_default'				=> 'gravatar_default',			// Comment Avatars should be using mystery by Gravatar

		);
		foreach ( $core_settings as $k => $v ) {
			update_option( $k, $v );
		}

		// Delete dummy post, page and comment.
		wp_delete_post( 1, true );
		wp_delete_post( 2, true );
		wp_delete_comment( 1 );

		// Change default Uncategorized category name (ID is always 1)
		wp_update_term( 1, 'category', array(
			'name' => 'Other',
			'slug' => 'other',
			'description' => 'Default Category or Uncategorized'
		));

		// Once done, we register our setting to make sure we don't duplicate everytime we activate.
		update_option( 'theme_setup_status', '1' );

		// Lets let the admin know whats going on.
		$msg = '
		<div class="error">
			<p>The <strong>' . get_option( 'current_theme' ) . '</strong> theme has changed your default settings, renamed the "uncategorized" category and deleted the default post, page & comment. <br> The theme also created a few new pages with specially assigned page templates and added menus with pre-populated links to those pages.</p>
		</div>';
		add_action( 'admin_notices', $c = create_function( '', 'echo "' . addcslashes( $msg, '"' ) . '";' ) );
	} elseif ( $the_theme_status === '1' and isset( $_GET['activated'] ) ) { // Else if we are re-activing the theme
		$msg = '
		<div class="error">
			<p>The <strong>' . get_option( 'current_theme' ) . '</strong> theme was successfully re-activated.</p>
		</div>';
		add_action( 'admin_notices', $c = create_function( '', 'echo "' . addcslashes( $msg, '"' ) . '";' ) );
	}

// Remove frontend admin bar
	add_filter('show_admin_bar', '__return_false');

// Remove customizer sections
	function foundatiowp_remove_customizer_options( $wp_customize ) {
		$wp_customize->remove_section( 'static_front_page' );
		$wp_customize->remove_section( 'title_tagline'     );
		//$wp_customize->remove_section( 'nav'             );
		$wp_customize->remove_section( 'custom_css'        );
		$wp_customize->remove_section( 'themes'            );
	}
	add_action( 'customize_register', 'foundatiowp_remove_customizer_options', 30 );

// Remove theme & plugin editor
	if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) { define('DISALLOW_FILE_EDIT', true); }

// Unregister default WP widgets
	function unregister_default_widgets() {
		// unregister_widget('WP_Widget_Pages');
		unregister_widget('WP_Widget_Calendar');
		// unregister_widget('WP_Widget_Archives');
		unregister_widget('WP_Widget_Links');
		unregister_widget('WP_Widget_Meta');
		// unregister_widget('WP_Widget_Search');
		// unregister_widget('WP_Widget_Text');
		// unregister_widget('WP_Widget_Categories');
		// unregister_widget('WP_Widget_Recent_Posts');
		// unregister_widget('WP_Widget_Recent_Comments');
		unregister_widget('WP_Widget_RSS');
		unregister_widget('WP_Widget_Tag_Cloud');
		// unregister_widget('WP_Nav_Menu_Widget');
		unregister_widget('Twenty_Eleven_Ephemera_Widget');
	}
	add_action('widgets_init', 'unregister_default_widgets', 11);

// Remove 'p' tags around images
	function filter_ptags_on_images($content) {
	    $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
	    return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
	}
	add_filter('acf_the_content', 'filter_ptags_on_images');
	add_filter('the_content', 'filter_ptags_on_images');

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
