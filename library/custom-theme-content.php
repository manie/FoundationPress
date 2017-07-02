<?php
/**
 * Custom Theme Content
 *
 * @package foundationWP
 */

// Programmatically create some basic pages, and then set Home and Blog

	// First we check to see if our default theme settings have been applied.
	$the_theme_content = get_option( 'theme_setup_content' );

	// If the theme has not yet been used we want to run our default settings.
	if ( $the_theme_status !== '1' ) {

		// Home
		if (isset($_GET['activated']) && is_admin()){
			$new_page_title = 'Home Page';
			$new_page_content = '';
			$new_page_template = 'page-templates/page-full-width.php'; //ex. template-custom.php. Leave blank if you don't want a custom page template.
			//don't change the code bellow, unless you know what you're doing
			$page_check = get_page_by_title($new_page_title);
			$new_page = array(
				'post_type' => 'page',
				'post_title' => $new_page_title,
				'post_content' => $new_page_content,
				'post_status' => 'publish',
				'post_author' => 1,
				'comment_status' => 'closed',
			);
			if(!isset($page_check->ID)){
				$new_page_id = wp_insert_post($new_page);
				if(!empty($new_page_template)){
					update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
				}
			}
		}

		// About Us
		if (isset($_GET['activated']) && is_admin()){
			$new_page_title = 'About Us';
			$new_page_content = '';
			$new_page_template = ''; //ex. template-custom.php. Leave blank if you don't want a custom page template.
			//don't change the code bellow, unless you know what you're doing
			$page_check = get_page_by_title($new_page_title);
			$new_page = array(
				'post_type' => 'page',
				'post_title' => $new_page_title,
				'post_content' => $new_page_content,
				'post_status' => 'publish',
				'post_author' => 1,
				'comment_status' => 'closed',
			);
			if(!isset($page_check->ID)){
				$new_page_id = wp_insert_post($new_page);
				if(!empty($new_page_template)){
					update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
				}
			}
		}

		// Contact Us
		if (isset($_GET['activated']) && is_admin()){
			$new_page_title = 'Contact Us';
			$new_page_content = '';
			$new_page_template = ''; //ex. template-custom.php. Leave blank if you don't want a custom page template.
			//don't change the code bellow, unless you know what you're doing
			$page_check = get_page_by_title($new_page_title);
			$new_page = array(
				'post_type' => 'page',
				'post_title' => $new_page_title,
				'post_content' => $new_page_content,
				'post_status' => 'publish',
				'post_author' => 1,
				'comment_status' => 'closed',
			);
			if(!isset($page_check->ID)){
				$new_page_id = wp_insert_post($new_page);
				if(!empty($new_page_template)){
					update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
				}
			}
		}

		// Sitemap
		// if (isset($_GET['activated']) && is_admin()){
		// 	$new_page_title = 'Sitemap';
		// 	$new_page_content = '[lorem]';
		// 	$new_page_template = 'templates/-custom-SITEMAP.php'; //ex. template-custom.php. Leave blank if you don't want a custom page template.
		// 	//don't change the code bellow, unless you know what you're doing
		// 	$page_check = get_page_by_title($new_page_title);
		// 	$new_page = array(
		// 		'post_type' => 'page',
		// 		'post_title' => $new_page_title,
		// 		'post_content' => $new_page_content,
		// 		'post_status' => 'publish',
		// 		'post_author' => 1,
		// 		'comment_status' => 'closed',
		// 	);
		// 	if(!isset($page_check->ID)){
		// 		$new_page_id = wp_insert_post($new_page);
		// 		if(!empty($new_page_template)){
		// 			update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
		// 		}
		// 	}
		// }

		// Terms & Conditions
		if (isset($_GET['activated']) && is_admin()){
			$new_page_title = 'Terms & Conditions';
			$new_page_content = '[lorem]';
			$new_page_template = 'page-templates/page-full-width.php'; //ex. template-custom.php. Leave blank if you don't want a custom page template.
			//don't change the code bellow, unless you know what you're doing
			$page_check = get_page_by_title($new_page_title);
			$new_page = array(
				'post_type' => 'page',
				'post_title' => $new_page_title,
				'post_content' => $new_page_content,
				'post_status' => 'publish',
				'post_author' => 1,
				'comment_status' => 'closed',
			);
			if(!isset($page_check->ID)){
				$new_page_id = wp_insert_post($new_page);
				if(!empty($new_page_template)){
					update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
				}
			}
		}

		// Privacy Policy
		if (isset($_GET['activated']) && is_admin()){
			$new_page_title = 'Privacy Policy';
			$new_page_content = '';
			$new_page_template = 'page-templates/page-full-width.php'; //ex. template-custom.php. Leave blank if you don't want a custom page template.
			//don't change the code bellow, unless you know what you're doing
			$page_check = get_page_by_title($new_page_title);
			$new_page = array(
				'post_type' => 'page',
				'post_title' => $new_page_title,
				'post_content' => $new_page_content,
				'post_status' => 'publish',
				'post_author' => 1,
				'comment_status' => 'closed',
			);
			if(!isset($page_check->ID)){
				$new_page_id = wp_insert_post($new_page);
				if(!empty($new_page_template)){
					update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
				}
			}
		}

		// Styleguide
		if (isset($_GET['activated']) && is_admin()){
			$new_page_title = 'Styleguide';
			$new_page_content = '';
			$new_page_template = 'page-templates/kitchen-sink.php'; //ex. template-custom.php. Leave blank if you don't want a custom page template.
			//don't change the code bellow, unless you know what you're doing
			$page_check = get_page_by_title($new_page_title);
			$new_page = array(
				'post_type' => 'page',
				'post_title' => $new_page_title,
				'post_content' => $new_page_content,
				'post_status' => 'publish',
				'post_author' => 1,
				'comment_status' => 'closed',
			);
			if(!isset($page_check->ID)){
				$new_page_id = wp_insert_post($new_page);
				if(!empty($new_page_template)){
					update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
				}
			}
		}

		if (isset($_GET['activated']) && is_admin()){
			// Set the blog page
			// $blog = get_page_by_title( 'Blog' );
			// update_option( 'page_for_posts', $blog->ID );

			// Use a static front page
			$front_page_check = get_page_by_title('Home Page');
			// $front_page = 4; // this is the default page created above
			update_option( 'page_on_front', $front_page_check->ID );
			update_option( 'show_on_front', 'page' );
		}
	}

// Programmatically create some basic menus, and then assing them to theme locations

	// function theme_activation_function ($oldname, $oldtheme = false) {

	// 	/* Create header and footer menus */
	// 	$menus = array(
	// 		'Main Menu'  => array(
	// 			'home'  => 'Home',
	// 			'about-us'  => 'About Us',
	// 			'contact-us'  => 'Contact Us'
	// 		),
	// 		'Footer Menu' => array(
	// 			// 'sitemap'  => 'Sitemap',
	// 			'terms-conditions' => 'Terms & Conditions',
	// 			'privacy-policy' => 'Privacy Policy',
	// 			'styleguide'  => 'Styleguide'
	// 		)
	// 	);

	// 	$locations = get_theme_mod('nav_menu_locations');
	// 	foreach($menus as $menuname => $menuitems) {

	// 		$menu_exists = wp_get_nav_menu_object($menuname);

	// 		// If it doesn't exist, let's create it.
	// 		if ( !$menu_exists) {

	// 			$menu_id = wp_create_nav_menu($menuname);

	// 			foreach($menuitems as $slug => $item) {
	// 				if ( $slug == 'styleguide' ) {
	// 					wp_update_nav_menu_item(
	// 						$menu_id, 0, array(
	// 							'menu-item-title'  => $item,
	// 							'menu-item-object'  => 'page',
	// 							'menu-item-object-id'  => get_page_by_path($slug)->ID,
	// 							'menu-item-type' => 'post_type',
	// 							'menu-item-target' => '_blank',
	// 							'menu-item-status'  => 'publish'
	// 						)
	// 					);
	// 				} else {
	// 					wp_update_nav_menu_item(
	// 						$menu_id, 0, array(
	// 							'menu-item-title'  => $item,
	// 							'menu-item-object'  => 'page',
	// 							'menu-item-object-id'  => get_page_by_path($slug)->ID,
	// 							'menu-item-type' => 'post_type',
	// 							'menu-item-status'  => 'publish'
	// 						)
	// 					);
	// 				}
	// 			}

	// 			if ( $menuname == 'Main Menu' ) {
	// 				$locations['primary'] = $menu_id;
	// 			}

	// 			if ( $menuname == 'Footer Menu' ) {
	// 				$locations['footer'] = $menu_id;
	// 			}

	// 		}
	// 	}

	// 	//$locations['primary'] = $term_id_of_menu;
	// 	set_theme_mod( 'nav_menu_locations', $locations );
	// }
