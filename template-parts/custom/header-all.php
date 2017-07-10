<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS-header.php'));

	// Extra class for panel content
		$content_class = 'content';

?>

<?php if ( isset($header_option) && $header_option != 'none' ) { ?>

	<div id="header-container">
		<header class="page-header <?php echo $header_option; ?>" data-overlay="<?php echo $overlay_style; ?>" data-links="<?php echo $link_type; ?>">

			<?php if ( isset($link_url) && $link_type == 'header' ) { ?>
				<a href="<?php echo $link_url['url']; ?>" title="<?php echo $link_url['title']; ?>" target="<?php echo $link_url['target']; ?>">
			<?php } ?>

				<div class="hero-content <?php if (isset($has_media)) { echo $has_media; } ?>">
					<?php if ( isset($content_heading) && ( !empty($content_heading) ) ) { ?>
						<h1 class="heading"><?php echo $content_heading; ?></h1>
					<?php } ?>

					<?php if ( isset($content_subheading) && ( !empty($content_subheading) ) ) { ?>
						<h2 class="subheading"><?php echo $content_subheading; ?></h2>
					<?php } ?>

					<?php if ( isset($content_description) && ( !empty($content_description) ) ) { ?>
						<p class="description"><?php echo $content_description; ?></p>
					<?php } ?>

					<?php if ( isset($link_type) && ( $link_type == 'text' || $link_type == 'button' ) ) { ?>
						<?php if( have_rows('dcf_header_link_array') ): ?>
							<ul class="links inlinelist">
								<?php while( have_rows('dcf_header_link_array') ): the_row();

									$link_text = get_sub_field('link_text');
									$link_url = get_sub_field('link_url');

									?>

									<li class="link">

										<?php if( $link_url ): ?>

											<?php if( $link_text ){ ?>
												<a href="<?php echo $link_url['url']; ?>" target="<?php echo $link_url['target']; ?>" class="<?php echo $link_class; ?>"><?php echo $link_text; ?></a>
											<?php } else { ?>
												<a href="<?php echo $link_url['url']; ?>" target="<?php echo $link_url['target']; ?>" class="<?php echo $link_class; ?>"><?php echo $link_url['title']; ?></a>
											<?php } ?>

										<?php endif; ?>

									</li>
								<?php endwhile; ?>
							</ul>
						<?php endif; ?>
					<?php } ?>

					<?php if ( isset($link_video) && !empty($link_video) && $link_type == 'video' ) { ?>
						<button class="video-popup" data-open="video-popup-modal">
							<i class="fa fa-play-circle fa-5x" aria-hidden="true"></i>
						</button>
						<div id="video-popup-modal" class="reveal-modal small" data-reveal>
							<div class="iframe responsive-embed">
								<?php echo $link_video; ?>
							</div>
							<button class="close-button" data-close aria-label="Close modal" type="button">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php } ?>
				</div>

				<?php if ( isset($image) && ( !empty($image) && isset($header_style) ) && $header_option == 'image' ) { ?>
					<div class="hero-media">
						<span class="bgimg" <?php echo $header_style; ?>></span>
					</div>
				<?php } ?>

				<?php if ( isset($video) && ( !empty($video) && isset($header_style) ) && $header_option == 'video' ) { ?>
					<div class="hero-media" <?php echo $header_style; ?>>
						<div id="bgndVideo" class="player" data-property="{videoURL: '<?php echo $video_url; ?>',autoPlay: true, showControls: true, optimizeDisplay: true, quality: 'default', mute: true, loop: true, remember_last_time: true, stopMovieOnBlur: false, containment: 'self' }"></div>
						<script> jQuery(function(){ jQuery("#bgndVideo").YTPlayer(); }); </script>
					</div>
				<?php } ?>

				<?php if ( isset($overlay_enable) && isset($overlay_style) && $overlay_style != 'none' ) { ?>
					<div class="hero-overlay" data-overlay-type="<?php echo $overlay_type; ?>"></div>
				<?php } ?>

			<?php if ( isset($link_url) && $link_type == 'header' ) { ?>
				</a>
			<?php } ?>

		</header>
	</div>

<?php } ?>