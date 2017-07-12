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
	function dando_admin_style() {
		wp_enqueue_style('admin-styles', get_template_directory_uri().'/assets/stylesheets/wp-admin.css');
	}
	add_action('admin_enqueue_scripts', 'dando_admin_style');

// Update Login CSS
	function dando_login_style() {
		wp_enqueue_style('admin-styles', get_template_directory_uri().'/assets/stylesheets/wp-login.css');
	}
	add_action('login_head', 'dando_login_style');

// ACF Hide post types in Post Object field
	function dando_post_object_query( $args, $field, $post_id ) {

		$args = array( 'public' => true, );
		$post_types = get_post_types( $args );

		// Remove Media posts
		if (in_array('attachment', $post_types)) {
		    unset($post_types[array_search('attachment',$post_types)]);
		}

		$args['post_type'] = $post_types;

		// return
		return $args;

	}

	// filter for every field
	add_filter('acf/fields/post_object/query', 'dando_post_object_query', 10, 3);

	function dando_acf_flexible_content_layout_title( $title, $field, $layout, $i ) {

		// remove layout title from text
		// $title = '';

		// add text sub field
		if( $module_title = get_sub_field('dcf_module_title') ) {
			$title .= ' - <strong>' . $module_title . '</strong>';
		}

		// return
		return $title;
	}

	add_filter('acf/fields/flexible_content/layout_title/name=dcm', 'dando_acf_flexible_content_layout_title', 10, 4);


// Remove h1 from the WordPress editor.
	function dando_remove_h1_from_editor( $init ) {
		$init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Preformatted=pre;';
		return $init;
	}
	add_filter( 'tiny_mce_before_init', 'dando_remove_h1_from_editor' );

// Determines whether or not the current post is a paginated post.
	function dando_is_paginated_post() {
		global $multipage;
		return 0 !== $multipage;
	} // end dando_is_paginated_post

// Check if content is REALLY empty
	function empty_content($str) {
		return trim(str_replace('&nbsp;','',strip_tags($str))) == '';
	}

// Custom Social Sharing, hooked into the content filter
	function dando_social_sharing_buttons($content) {
		global $post;
		if(is_single() && !is_home()){

			// Get current page URL
			$post_URL = urlencode(get_permalink());

			// Get current page title
			$post_Title = str_replace( ' ', '%20', get_the_title());

			// Get Post Thumbnail for pinterest
			$post_Thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

			// Get Post Excerpt for captions
			// $post_Excerpt = get_the_excerpt( $post->ID );

			if ( empty( $post->post_excerpt ) ) {
				$post_Excerpt = wp_kses_post( wp_trim_words( $post->post_content, 20 ) );
			} else {
				$post_Excerpt = wp_kses_post( $post->post_excerpt );
			}

			// Construct sharing URL without using any script
			$twitterURL = 'https://twitter.com/intent/tweet?text='.$post_Title.'&amp;url='.$post_URL;
			$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$post_URL;
			$googleURL = 'https://plus.google.com/share?url='.$post_URL;
			$bufferURL = 'https://bufferapp.com/add?url='.$post_URL.'&amp;text='.$post_Title;
			$whatsappURL = 'whatsapp://send?text='.$post_Title . ' ' . $post_URL;
			$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$post_URL.'&amp;title='.$post_Title;
			$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$post_URL.'&amp;media='.$post_Thumbnail[0].'&amp;description='.$post_Title;
			$tumblrURL = 'https://www.tumblr.com/widgets/share/tool?canonicalUrl='.$post_URL.'&title='.$post_Title.'&caption='.$post_Excerpt.'';

			// Add sharing button at the end of page/page content
			$content .= '<div class="post-social">';
			$content .= '<h5>SHARE ON</h5>';
			$content .= '<a href="'.$facebookURL.'" target="_blank" class="button social facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook </a>';
			$content .= '<a href="'.$twitterURL.'" target="_blank" class="button social twitter"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter </a>';
			$content .= '<a href="'.$linkedInURL.'" target="_blank" class="button social linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i> Linkedin </a>';
			// $content .= '<a href="#" class="button social youtube"><i class="fa fa-youtube" aria-hidden="true"></i> Youtube </a>';
			// $content .= '<a href="#" class="button social instagram"><i class="fa fa-instagram" aria-hidden="true"></i> Instagram </a>';
			// $content .= '<a href="'.$pinterestURL.'" data-pin-custom="true" target="_blank" class="button social pinterest"><i class="fa fa-pinterest-p" aria-hidden="true"></i> Pinterest </a>';
			$content .= '<a href="'.$googleURL.'" target="_blank" class="button social google-plus"><i class="fa fa-google-plus" aria-hidden="true"></i> Google + </a>';
			// $content .= '<a href="#" class="button social github"><i class="fa fa-github" aria-hidden="true"></i> Github </a>';
			// $content .= '<a href="'.$tumblrURL.'" target="_blank" class="button social tumblr"><i class="fa fa-tumblr" aria-hidden="true"></i> Tumblr </a>';
			// $content .= '<a href="'.$bufferURL.'" target="_blank" class="button social buffer"><i class="fa fa-share-square-o" aria-hidden="true"></i> Buffer </a>';
			$content .= '<a href="'.$whatsappURL.'" target="_blank" class="button social whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i> WhatsApp </a>';
			$content .= '</div>';

			return $content;

		}else{
			// if not a post/page then don't include sharing button
			return $content;
		}
	};
	add_filter( 'the_content', 'dando_social_sharing_buttons');