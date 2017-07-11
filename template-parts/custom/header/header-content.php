<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS-header.php'));

	// Extra class for panel content
		$content_class = 'hero-content';

?>

<?php if ( isset($header_option) && $header_option != 'slider' ) { ?>
	<div class="<?php echo $content_class; ?> <?php if (isset($has_media)) { echo $has_media; } ?>">
		<?php if ( isset($content_heading) && ( !empty($content_heading) ) ) { ?>
			<h1 class="heading"><?php echo $content_heading; ?></h1>
		<?php } ?>

		<?php if ( isset($content_subheading) && ( !empty($content_subheading) ) ) { ?>
			<h2 class="subheading"><?php echo $content_subheading; ?></h2>
		<?php } ?>

		<?php if ( isset($content_description) && ( !empty($content_description) ) ) { ?>
			<p class="description"><?php echo $content_description; ?></p>
		<?php } ?>

		<?php if ( isset($link_enable) && isset($link_type) && ( $link_type == 'text' || $link_type == 'buttons' ) ) { ?>
			<?php if( have_rows('dcf_header_link_array') ): ?>
				<ul class="links inlinelist">
					<?php while( have_rows('dcf_header_link_array') ): the_row();
						$link_text = get_sub_field('link_text');
						$link_url = get_sub_field('link_url');
						?>
						<li class="link">
							<?php if( $link_url ): ?>
								<a href="<?php echo $link_url['url']; ?>" target="<?php echo $link_url['target']; ?>" class="<?php echo $link_class; ?>"><?php if( $link_text ){ ?> <?php echo $link_text; ?> <?php } else { ?> <?php echo $link_url['title']; ?> <?php } ?></a>
							<?php endif; ?>
						</li>
					<?php endwhile; ?>
				</ul>
			<?php endif; ?>
		<?php } ?>

		<?php if ( isset($link_enable) && isset($link_video) && !empty($link_video) && $link_type == 'popup' ) { ?>
			<button class="video-popup" data-open="video-popup-modal">
				<i class="fa fa-play-circle fa-5x" aria-hidden="true"></i>
			</button>
			<div id="video-popup-modal" class="reveal-modal small" data-reveal>
				<div class="iframe responsive-embed"> <?php echo $link_video; ?> </div>
				<button class="close-button" data-close aria-label="Close modal" type="button">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php } ?>
	</div>
<?php } ?>