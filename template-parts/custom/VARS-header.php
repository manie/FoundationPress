<?php

	// *** Page Header
	// *** Module Variables

	// Header Module
		$page_title = get_the_title();

	// Type variables
		if ( get_field('dcf_header_option') ) { $header_option = get_field('dcf_header_option'); } else { $header_option = null; }

	// Header options
		if ( get_field('dcf_header_overlay_enable') ) { $overlay_enable = get_field('dcf_header_overlay_enable'); }
		if ( get_field('dcf_header_link_enable') ) { $link_enable = get_field('dcf_header_link_enable'); }
		if ( get_field('dcf_header_border_enable') ) { $border_enable = get_field('dcf_header_border_enable'); }

	// Content variables
		if ( get_field('dcf_header_content_heading') ) { $content_heading = get_field('dcf_header_content_heading'); } else { $content_heading = $page_title; }
		if ( get_field('dcf_header_content_subheading') ) { $content_subheading = get_field('dcf_header_content_subheading'); }
		if ( get_field('dcf_header_content_description') ) { $content_description = get_field('dcf_header_content_description'); }

	// Overlay variables
		if ( get_field('dcf_header_overlay_style') ) { $overlay_style = get_field('dcf_header_overlay_style'); }
		if ( get_field('dcf_header_overlay_type') ) { $overlay_type = get_field('dcf_header_overlay_type'); }

	// link variables
		if ( get_field('dcf_header_link_type') ) { $link_type = get_field('dcf_header_link_type'); }
		if ( get_field('dcf_header_link_array') ) { $link_array = get_field('dcf_header_link_array'); }
		if ( get_field('dcf_header_link_url') ) { $link_url = get_field('dcf_header_link_url'); }
		if ( get_field('dcf_header_link_video') ) {
			$link_video_url = get_field('dcf_header_link_video', false, false );
			$link_video = get_field('dcf_header_link_video');
		}

		if ( $link_type == 'text' ) { $link_class = 'text'; } elseif ( $link_type == 'button' ) { $link_class = 'button'; } else { $link_class = null; }

	// Image vars
		if ( isset($header_option) && $header_option == 'image' ) {
			$image = get_field('dcf_header_hero_image');
			$header_style = '';

			if( !empty($image) ) {

				// ACF Image vars
				$image_id = $image['id'];
				$image_url = $image['url'];

				// Get WP responsive markup
				$responsive_image = wp_get_attachment_image( $image_id, 'full', false, array( 'class' => 'orbit-image' ) );
				$responsive_image_src = wp_get_attachment_image_url( $image_id, 'full' );

				if ( isset($responsive_image_src) ) {
					$header_style = 'style="background-image: url(' . $responsive_image_src . ')"';
				}
			} elseif (has_post_thumbnail()) {

				// get featured image
				$image_size = 'large';
				$featured_image_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID), $image_size );
				if ( isset($featured_image_src) ) {
					$header_style = 'style="background-image: url(' . $featured_image_src . ')"';
				}
			}

			if ( isset($header_style) && ( !empty($header_style) ) ) { $has_media = 'has-img'; } else { $has_media = 'no-img'; }
		}

	// Video vars
		if ( isset($header_option) && $header_option == 'video' ) {
			$video = get_field('dcf_header_hero_video');
			$header_style = '';

			if( !empty($video) ) {

				// Get YouTube thumbnail if video set
				$video_url = get_field('dcf_header_hero_video', false, false);

				preg_match('/src="(.+?)"/', $video, $matches_url );
				$src = $matches_url[1];

				preg_match('/embed(.*?)?feature/', $src, $matches_id );
				$id = $matches_id[1];
				$id = str_replace( str_split( '?/' ), '', $id );

				$video_id = $id;

				$video_thumbnail = 'http://img.youtube.com/vi/'. $video_id .'/maxresdefault.jpg';
			}

			if( !empty($video_thumbnail) ) {

				if ( isset($video_thumbnail) ) {
					$header_style = ' style="background-image: url(' . $video_thumbnail . ')" ';
				}
			} elseif (has_post_thumbnail()) {
				// get featured image
				$image_size = 'large';
				$featured_image_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID), $image_size );

				if ( isset($featured_image_src) ) {
					$header_style = ' style="background-image: url(' . $featured_image_src . ')" ';
				}
			}

			if ( isset($video_url) && ( !empty($video_url) ) ) { $has_media = 'has-video'; } else { $has_media = 'no-video'; }
		}
?>