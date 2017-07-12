<?php

	// *** Flexible Content
	// *** Module Variables

	// Module Options - Post Class array
		// NB: this class will be added to the standard WP post class
		$post_class_array = array (
			'flexible-content',
			'module-panel',
		);

	// Check if ACF is active first
	if ( class_exists('acf') ) {

		// Add Module Options to $post_class_array based on options
			if ( get_sub_field('dcf_module_option_grid') ) { $post_class_array[] = get_sub_field('dcf_module_option_grid'); }
			if ( get_sub_field('dcf_module_option_columns') ) { $post_class_array[] = get_sub_field('dcf_module_option_columns');
			if ( get_sub_field('dcf_module_option_ratio') ) { $post_class_array[] = get_sub_field('dcf_module_option_ratio'); }}
			if ( get_sub_field('dcf_module_option_float') ) { $post_class_array[] = get_sub_field('dcf_module_option_float'); }
			if ( get_sub_field('dcf_module_option_margin') ) {
				$module_option_margin = get_sub_field('dcf_module_option_margin');
				$post_class_array = array_merge($post_class_array, $module_option_margin);
			}
			if ( get_sub_field('dcf_module_design_bg_image') ) { $post_class_array[] = 'bgimg'; }

		// Turn the post_class_array into a string if required
			// $post_class_string = implode(" ", $post_class_array);

		// Module Content - Text string with no fallback
			if ( get_sub_field('dcf_module_title') ) {
				$module_title = get_sub_field('dcf_module_title');
			} else { $module_title = null; }
			if ( get_sub_field('dcf_module_introduction') ) {
				$module_introduction = get_sub_field('dcf_module_introduction');
			} else { $module_introduction = null; }

		// Module Design - CSS colour & background fo INLINE style
			if ( get_sub_field('dcf_module_design_bg_colour') ) { $module_bg_colour = get_sub_field('dcf_module_design_bg_colour'); }
			if ( get_sub_field('dcf_module_design_bg_image') ) { $module_bg_image = get_sub_field('dcf_module_design_bg_image'); }

			// Add Module Design Options in a style="OPTIONS" variable
			if ( isset($module_bg_colour) ) {
				$module_design_style = 'style="background-color:' . $module_bg_colour . '"';
			}
			if ( isset($module_bg_image) ) {
				$image_size = 'large';
				$image_with_size_limit = $module_bg_image['sizes'][ $image_size ];
				$module_design_style = 'style="background-image: url(' . $image_with_size_limit . ')"';
			}

		// Mobile Detect Script - Remove module

			// Include and instantiate the class.
			require_once get_template_directory() . '/library/Mobile_Detect.php';
			$detect = new Mobile_Detect;

			if ( get_sub_field('dcf_module_option_disable_mobile') ) {
				if( $detect->isMobile() && !$detect->isTablet() ){
	 				$disable_mobile = true;
				} else { $disable_mobile = false; }
			} else { $disable_mobile = false; }
	}

?>