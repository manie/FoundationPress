<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS-header.php'));

	// Extra class for panel content
		// $content_class = 'content';

?>

<?php if ( isset($gallery) && isset($header_option) ) { ?>
	<div class="hero-media">
		<?php if( $gallery ):
			$count = count( $gallery );
			$i = 0;
		?>
			<div aria-label="Hero Gallery" class="orbit" role="region" data-count="<?php echo $count; ?>" data-orbit class="header-gallery">

				<ul class="orbit-container inlinelist">

					<?php if ( $count > 1 ) { ?>
						<button class="orbit-previous">
							<span class="show-for-sr">Previous Slide</span>
							<span class="nav fa fa-chevron-left fa-3x"></span>
						</button>
						<button class="orbit-next">
							<span class="show-for-sr">Next Slide</span>
							<span class="nav fa fa-chevron-right fa-3x"></span>
						</button>
					<?php } ?>

					<?php foreach( $gallery as $image ): ?>

						<?php
							// ACF galery fields
							// $image = $image['url'];
							// $caption = $image['caption'];

							if( !empty($image) ) {

								// Image vars
								$image_id = $image['id'];
								$image_url = $image['url'];

								// Get WP responsive markup
								$responsive_image = wp_get_attachment_image( $image_id, 'full', false, array( 'class' => 'orbit-image' ) );
								$responsive_image_src = wp_get_attachment_image_url( $image_id, 'full' );
							}

							// Increment count for active class
							$i++;
						?>

						<li class="orbit-slide <?php if ( isset($active) ) { echo $active; } ?>" <?php if ( isset($responsive_image_src) ) { echo 'style="background-image: url(\''.$responsive_image_src.'\')'; } ?>">

							<?php if ( isset($responsive_image) ) { echo apply_filters( 'the_content', $responsive_image ); } ?>
							<?php if ( isset($caption) ) { ?>
								<figcaption class="orbit-caption">
									<h1><?php echo $caption; ?></h1>
									<?php if ( $link_type == 'button' && !empty($link_url) ) { ?>
										<a href="<?php echo $link_url; ?>" class="button"><?php if (!empty($link_text)) { echo $link_text; } else { echo 'Find our more'; } ?></a>
									<?php } ?>
								</figcaption>
							<?php } ?>

						</li>

					<?php endforeach; ?>
				</ul>

			</div>

		<?php endif; ?>
	</div>
<?php } ?>