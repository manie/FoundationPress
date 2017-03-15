<?php
/**
 * Overrides on both FoundationPress and WP
 *
 * @package foundationWP
 */

// Remove frontend admin bar
// if ( ! current_user_can( 'manage_options' ) ) {
    add_filter('show_admin_bar', '__return_false');
// }

// Remove customizer sections
function foundatiowp_remove_customizer_options( $wp_customize ) {
   $wp_customize->remove_section( 'static_front_page' );
   $wp_customize->remove_section( 'title_tagline'     );
   //$wp_customize->remove_section( 'nav'               );
   $wp_customize->remove_section( 'custom_css'          );
   $wp_customize->remove_section( 'themes'              );
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