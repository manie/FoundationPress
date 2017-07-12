<?php

	// *** Custom Post Type
	// *** Testimonial Variables

	// Check if ACF is active first
	if ( class_exists('acf') ) {

		// Type
			if ( get_field('dcf_testimonial_type') ) { $testimonial_type = get_field('dcf_testimonial_type'); }

		// Options
			if ( get_field('dcf_testimonial_option_readmore') ) { $option_readmore = get_field('dcf_testimonial_option_readmore'); }
			if ( get_field('dcf_testimonial_option_intro') ) { $option_intro = get_field('dcf_testimonial_option_intro'); }
			if ( get_field('dcf_testimonial_option_title') ) { $option_title = get_field('dcf_testimonial_option_title'); }

		// Content
			if ( get_field('dcf_testimonial_excerpt') ) { $testimonial_excerpt = get_field('dcf_testimonial_excerpt'); }
			if ( get_field('dcf_testimonial_content') ) { $testimonial_content = get_field('dcf_testimonial_content'); }
			if ( get_field('dcf_testimonial_video') ) { $testimonial_video = get_field('dcf_testimonial_video'); }

		// Image
			if ( get_field('dcf_testimonial_image_type') ) { $image_type = get_field('dcf_testimonial_image_type'); }
			if ( get_field('dcf_testimonial_image_square') ) { $image_square = get_field('dcf_testimonial_image_square'); }
			if ( get_field('dcf_testimonial_image_portrait') ) { $image_portrait = get_field('dcf_testimonial_image_portrait'); }
			if ( get_field('dcf_testimonial_image_full') ) { $image_full = get_field('dcf_testimonial_image_full'); }

		// Author
			if ( get_field('dcf_testimonial_author_name') ) { $author_name = get_field('dcf_testimonial_author_name'); }
			if ( get_field('dcf_testimonial_author_lastname') ) { $author_lastname = get_field('dcf_testimonial_author_lastname'); }
			if ( get_field('dcf_testimonial_author_location') ) { $author_location = get_field('dcf_testimonial_author_location'); }

		// Readmore
			if ( isset($option_readmore)) { $has_readmore = true; } else { $has_readmore = false; }

	}
?>