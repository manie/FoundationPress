<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS-header.php'));

	// Extra class for panel content
		$content_class = 'content';

	// Custom content vars
		$video = get_field('dcf_header_hero_video');
		if( !empty($video) ) {
			$video_url = get_field('dcf_header_hero_video', false, false);
		}

		if (has_post_thumbnail()) {
			// get featured image
			$image_size = 'large';
			$featured_image_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID), $image_size );

			if ( isset($featured_image_src) ) {
				$header_style = 'style="background-image: url(' . $featured_image_src . ')"';
			}
		}

		if ( isset($video_url) && ( !empty($video_url) ) ) {
			$has_media = 'has-video';
		} else { $has_media = 'no-video'; }

?>

<?php if ( isset($header_option) && $header_option != 'none' ) { ?>

	<div id="header-container">
		<header class="page-header <?php echo $header_option; ?>">

			<div class="hero-content <?php echo $has_media; ?>">
				<?php if ( isset($content_heading) && ( !empty($content_heading) ) ) { ?>
					<h1 class="heading"><?php echo $content_heading; ?></h1>
				<?php } ?>

				<?php if ( isset($content_subheading) && ( !empty($content_subheading) ) ) { ?>
					<h2 class="subheading"><?php echo $content_subheading; ?></h2>
				<?php } ?>

				<?php if ( isset($content_description) && ( !empty($content_description) ) ) { ?>
					<p class="subheading"><?php echo $content_description; ?></p>
				<?php } ?>
			</div>

			<?php if ( isset($video_url) && ( !empty($video_url) ) ) { ?>
				<div class="hero-media" <?php echo $header_style; ?>>
					<div id="bgndVideo" class="player" data-property="{videoURL: '<?php echo $video_url; ?>', mobileFallbackImage: '<?php if (has_post_thumbnail()) { echo $featured_image_src; } ?>', autoPlay: true, showControls: true, optimizeDisplay: true, quality: 'default', mute: true, loop: true, remember_last_time: true, stopMovieOnBlur: false, containment: 'self' }"></div>
					<script> jQuery(function(){ jQuery("#bgndVideo").YTPlayer(); }); </script>
				</div>
			<?php } ?>

		</header>
	</div>

<?php } ?>