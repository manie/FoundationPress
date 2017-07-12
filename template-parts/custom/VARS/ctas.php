<?php

	// *** Custom Post Type
	// *** Testimonial Variables

	// Check if ACF is active first
	if ( class_exists('acf') ) {

		// Type
			if ( get_field('dcf_cta_type') ) { $cta_type = get_field('dcf_cta_type'); }

		// Design
			if ( get_field('dcf_cta_design_colour') ) { $design_colour = get_field('dcf_cta_design_colour'); }
			if ( get_field('dcf_cta_design_bg') ) { $design_bg = get_field('dcf_cta_design_bg'); }

		// Content
			if ( get_field('dcf_cta_content_title') ) { $content_title = get_field('dcf_cta_content_title'); }
			if ( get_field('dcf_cta_content_icon') ) { $content_icon = get_field('dcf_cta_content_icon'); }
			if ( get_field('dcf_cta_content_intro') ) { $content_intro = get_field('dcf_cta_content_intro'); }

		// Link
			if ( get_field('dcf_cta_link_type') ) {
				$link_type = get_field('dcf_cta_link_type');
				if ( $link_type == 'links' ) { $link_class = 'link'; } else { $link_class = 'button'; }
			}
			if ( get_field('dcf_cta_link_single') ) {
				$link_single = get_field('dcf_cta_link_single');
				$link_single_url = $link_single['url'];
				$link_single_target = $link_single['target'];
			} else {
				$link_single_target = '';
			}
			if ( get_field('dcf_cta_link_list') ) { $link_list = get_field('dcf_cta_link_list'); }

		// Make Inline Styles
			if ( isset($design_colour) ) {
				$cta_design_style = 'style="background-color:' . $design_colour . '"';
			}
			if ( isset($design_bg) ) {
				$image_size = 'large';
				$image_with_size_limit = $design_bg['sizes'][ $image_size ];
				$cta_design_style = 'style="background-image: url(' . $image_with_size_limit . ')"';
			}

	}
?>