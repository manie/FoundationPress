<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS-modules.php'));

	// Content Module
		$module_label = "Extra Content & Media";
		$module_name = get_row_layout();

	// Add to default post class array
		// $post_class_array[] = 'posts-panel';

	// Extra class for panel content
		$content_class = 'content';

	// Override default module label with custom text
		if ( isset($module_title) && ( !empty($module_title) ) ) { $module_label = $module_title; }

	// Custom Content variables
		if ( get_sub_field('dcf_extra_content_editor') ) { $extra_content = get_sub_field('dcf_extra_content_editor'); }
		if ( get_sub_field('dcf_extra_media_type') ) { $extra_media_type = get_sub_field('dcf_extra_media_type'); }
		if ( get_sub_field('dcf_extra_media_image') ) { $extra_media_image = get_sub_field('dcf_extra_media_image'); }
		if ( get_sub_field('dcf_extra_media_video') ) { $extra_media_video = get_sub_field('dcf_extra_media_video'); }
		if ( get_sub_field('dcf_extra_media_slider') ) { $extra_media_slider = get_sub_field('dcf_extra_media_slider'); }

?>

<?php if ( have_posts() ) { ?>

	<article aria-label="<?php echo $module_label; ?>" data-module="<?php echo $module_name; ?>" <?php post_class($post_class_array); ?> <?php if ( isset($module_design_style) ) { echo $module_design_style; } ?>>

		<?php if ( isset($module_title) || isset($module_introduction) ) { ?>
			<header class="panel-header">
				<?php if ( isset($module_title) && ( !empty($module_title) ) ) { ?>
					<h1 class="panel-title"><?php echo $module_title; ?></h1>
				<?php } ?>

				<?php if ( isset($module_introduction) && ( !empty($module_introduction) ) ) { ?>
					<div class="panel-introduction"><?php echo $module_introduction; ?></div>
				<?php } ?>
			</header>
		<?php } ?>

		<?php if ( isset($extra_content) || isset($extra_media_image) || isset($extra_media_video) || isset($extra_media_slider) ) { ?>
			<div class="panel-content">
				<section class="section <?php echo $content_class; ?>">

					<?php if ( isset($extra_content) && ( !empty($extra_content) ) ) { ?>
						<div class="extra-content">
							<?php echo apply_filters('the_content', $extra_content); ?>
						</div>
					<?php } ?>

					<?php if ( $extra_media_type == 'image') { ?>

						<?php if ( isset($extra_media_image) && ( !empty($extra_media_image) ) ) { ?>
							<div class="extra-media <?php echo $extra_media_type; ?>">
								<?php
									if( !empty($extra_media_image) ) {

										// Image vars
										$image_id = $extra_media_image['id'];
										$image_url = $extra_media_image['url'];

										// Get WP responsive markup
										$responsive_image = wp_get_attachment_image( $image_id, 'full', false, array( 'class' => '' ) );
										$responsive_image_src = wp_get_attachment_image_url( $image_id, 'full' );
									}

									if ( isset($responsive_image) ) { echo apply_filters( 'the_content', $responsive_image ); }

								?>
							</div>
						<?php } ?>

					<?php } elseif ( $extra_media_type == 'video') { ?>

						<?php if ( isset($extra_media_video) && ( !empty($extra_media_video) ) ) { ?>
							<div class="extra-media <?php echo $extra_media_type; ?>">
								<div class="responsive-embed"><?php echo $extra_media_video; ?></div>
							</div>
						<?php } ?>

					<?php } elseif ( $extra_media_type == 'slider') { ?>

						<?php if ( isset($extra_media_slider) && ( !empty($extra_media_slider) ) ) { ?>
							<div class="extra-media s<?php echo $extra_media_type; ?>">
							<?php //echo $extra_media_slider; ?>

							<?php if( $extra_media_slider ):
								$count = count( $extra_media_slider );
								$i = 0;
							?>
								<article aria-label="Image Slider" role="region" data-count="<?php echo $count; ?>" data-orbit class="content-slider">

									<ul class="orbit inlinelist">

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

										<?php foreach( $extra_media_slider as $image ): ?>

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

								</article>

							<?php endif; ?>
							</div>
						<?php } ?>

					<?php } ?>

				</section>
			</div>
		<?php } ?>
	</article>

<?php } ?>

<?php
	// Restore original Post Data
	wp_reset_postdata();
?>