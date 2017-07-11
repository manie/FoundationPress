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

		if ( isset($link_type) && $link_type == 'text' ) { $link_class = 'text'; }
		elseif ( isset($link_type) && $link_type == 'button' ) { $link_class = 'button'; }
		else { $link_class = null; }

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

	// Gallery vars
		if ( isset($header_option) && $header_option == 'gallery' ) {
			$gallery = get_field('dcf_header_hero_gallery');
		}

	// Slider vars
		if ( get_field('dcf_header_hero_slider') ) { $post_term_restriction = get_field('dcf_header_hero_slider'); }

	// Map vars
		if ( get_field('dcf_header_hero_map_option') ) { $hero_map_option = get_field('dcf_header_hero_map_option'); }
		if ( get_field('dcf_header_hero_map_custom') ) { $hero_map_custom = get_field('dcf_header_hero_map_custom'); }
		if ( get_field('dcf_header_hero_map_details') ) { $hero_map_details = get_field('dcf_header_hero_map_details'); }
		if ( get_field('dcf_header_hero_map_static') ) { $hero_map_static = get_field('dcf_header_hero_map_static'); }

	// GLOBAl contact details
		if ( get_field('dcf_contact_phone_number', 'option') ) { $contact_phone_number = get_field('dcf_contact_phone_number', 'option'); }
		if ( get_field('dcf_contact_fax_number', 'option') ) { $contact_fax_number = get_field('dcf_contact_fax_number', 'option'); }
		if ( get_field('dcf_contact_mobile_number', 'option') ) { $contact_mobile_number = get_field('dcf_contact_mobile_number', 'option'); }
		if ( get_field('dcf_contact_email_address', 'option') ) { $contact_email_address = get_field('dcf_contact_email_address', 'option'); }
		if ( get_field('dcf_contact_address_text', 'option') ) { $contact_address_text = get_field('dcf_contact_address_text', 'option'); }
		if ( get_field('dcf_contact_address_map', 'option') ) {
			// $contact_address_map = get_field('dcf_contact_address_map', 'option');

			if ( isset($hero_map_custom) && $hero_map_option == 'custom' ) {
				$contact_address_map = $hero_map_custom;
			} else {
				$contact_address_map = get_field('dcf_contact_address_map', 'option');
			}

			$contact_address = $contact_address_map['address'];
			$contact_address_lat = $contact_address_map['lat'];
			$contact_address_lng = $contact_address_map['lng'];
		}

		if ( isset($hero_map_details) && $hero_map_details ) {
			$details_class = "detail";
		} else { $details_class = "none"; }

		if ( isset($hero_map_static) ) {
			$map_class = "acf-map-static";
		} else { $map_class = "acf-map"; }

		// Get Google Maps API key from options
		if (get_field('dcf_google_maps_api_key', 'option')) {
			$google_maps_api_key = get_field('dcf_google_maps_api_key', 'option');
		} else { $google_maps_api_key = null; }

		if ( isset($contact_address_map) && isset($hero_map_static) ) {
			if ( isset($google_maps_api_key) && $hero_map_static ) {
				$header_map_style = "style=\"background-image:url('http://maps.google.com/maps/api/staticmap?center=".$contact_address_lat.",".$contact_address_lng ."&markers=".$contact_address_lat.",".$contact_address_lng."&zoom=14&size=640x640&scale=2&key=" . $google_maps_api_key . "');\"";
			}
		} else { $header_map_style = null; }

?>