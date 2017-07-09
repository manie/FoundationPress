<?php
/**
 * Custom WP Super Admin user
 *
 * @package FoundationPress
 */

// Adds new theme user capability when the them first loads.
add_action( 'init', function() {

	$result = add_role(
		'site_administrator',
		'Site Administrator',
		array(

			// Super Admin
				'manage_network'				=> true,
				'manage_sites'					=> false,
				'manage_network_users'			=> true,
				'manage_network_plugins'		=> false,
				'manage_network_themes'			=> false,
				'manage_network_options'		=> false,
				'unfiltered_html'				=> false,
				'unfiltered_upload'				=> false,

			// Administrator ( level 1 )
				'activate_plugins'				=> false,
				'add_users'						=> true,
				'create_users'					=> true,
				'delete_plugins'				=> false,
				'delete_themes'					=> false,
				'delete_users'					=> false,
				'edit_files'					=> false,
				'edit_plugins'					=> false,
				'edit_theme_options'			=> true,
				'edit_themes'					=> false,
				'edit_users'					=> true,
				'export'						=> false,
				'import'						=> false,

			// Administrator ( level 2 )
				'install_plugins'				=> false,
				'install_themes'				=> false,
				'list_users'					=> true,
				'manage_options'				=> true,
				'promote_users'					=> true,
				'remove_users'					=> false,
				'switch_themes'					=> false,
				'update_core'					=> false,
				'update_plugins'				=> false,
				'update_themes'					=> false,
				'edit_dashboard'				=> true,

			// Editor
				'moderate_comments'				=> true,
				'manage_categories'				=> true,
				'edit_categories'				=> true,
				'assign_categories'				=> true,
				'delete_categories'				=> false,
				'manage_links'					=> true,
				'edit_others_posts'				=> true,
				'edit_pages'					=> true,
				'edit_others_pages'				=> true,
				'edit_published_pages'			=> true,
				'publish_pages'					=> true,
				'delete_pages'					=> true,
				'delete_others_pages'			=> true,
				'delete_published_pages'		=> true,
				'delete_others_posts'			=> true,
				'delete_private_posts'			=> false,
				'edit_private_posts'			=> false,
				'read_private_posts'			=> false,
				'delete_private_pages'			=> false,
				'edit_private_pages'			=> false,
				'read_private_pages'			=> false,

			// Author
				'edit_published_posts'			=> true,
				'upload_files'					=> true,
				'publish_posts'					=> true,
				'delete_published_posts'		=> true,

			// Contributor
				'edit_posts'					=> true,
				'delete_posts'					=> true,

			// Subscriber
				'read'							=> true,

			// PLUGINS: Gravity Forms
				'gravityforms_edit_forms'		=> true,
				'gravityforms_delete_forms'		=> false,
				'gravityforms_create_form'		=> true,
				'gravityforms_view_entries'		=> true,
				'gravityforms_edit_entries'		=> false,
				'gravityforms_delete_entries'	=> false,
				'gravityforms_view_settings'	=> true,
				'gravityforms_edit_settings'	=> false,
				'gravityforms_export_entries'	=> true,
				'gravityforms_uninstall'		=> false,
				'gravityforms_view_entry_notes'	=> true,
				'gravityforms_edit_entry_notes'	=> true,
				'gravityforms_view_updates'		=> false,
				'gravityforms_view_addons'		=> true,
				'gravityforms_preview_forms'	=> false,

			// PLUGINS: WooCommerce
				'manage_woocommerce'			=> false,
				'view_woocommerce_reports'		=> true,

			// PLUGINS: Other Custom
				'copy_posts'					=> true,
				'manage_capabilities'			=> false,

		)
	);
	if ( null !== $result ) {
		// echo 'Yay! New role created!';
	}
} );
