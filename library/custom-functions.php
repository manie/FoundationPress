<?php
/**
 * Custom functions
 *
 * @package foundationWP
 */

function is_sidebar_active($index) {
    global $wp_registered_sidebars;
    $widgetcolums = wp_get_sidebars_widgets();
    if ($widgetcolums[$index])
        return true;
    return false;
}