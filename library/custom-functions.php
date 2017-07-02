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