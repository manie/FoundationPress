<?php

	// *** Page Header
	// *** Module Variables

	// Header Module
		$page_title = get_the_title();

	// Type variables
		if ( get_field('dcf_header_option') ) { $header_option = get_field('dcf_header_option'); } else { $header_option = null; }

	// Content variables
		if ( get_field('dcf_header_content_heading') ) { $content_heading = get_field('dcf_header_content_heading'); } else { $content_heading = $page_title; }
		if ( get_field('dcf_header_content_subheading') ) { $content_subheading = get_field('dcf_header_content_subheading'); }
		if ( get_field('dcf_header_content_description') ) { $content_description = get_field('dcf_header_content_description'); }

?>