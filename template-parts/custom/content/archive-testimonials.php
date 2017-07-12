<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS/testimonials.php'));

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blogpost-entry post-item'); ?>>

	<header>
		<?php if( isset($option_title) && $option_title ) { ?>
			<h2 class="author">
				<span class="author-name"><?php echo $author_name; ?></span>
				<?php if( isset($author_lastname) ) { ?>
					<span class="author-lastname"><?php echo $author_lastname; ?></span>
				<?php } ?>
				<?php if( isset($author_location) ) { ?>
					<span class="author-location"><small> - <?php echo $author_location; ?></small></span>
				<?php } ?>
			</h2>
		<?php } else { ?>
			<h2><?php the_title(); ?></h2>
		<?php }?>
	</header>

	<?php if ( isset($image_type) && $image_type != 'none' ) { ?>
		<div class="entry-image <?php echo $image_type ?>">
			<?php if ( isset($image_type) ) { ?>

				<?php

					if ( isset($image_type) && $image_type != 'none') {
						if ( isset($image_square) && $image_type == 'square' ) {
							$testimonial_image = $image_square;
						} elseif ( isset($image_portrait) && $image_type == 'portrait' ) {
							$testimonial_image = $image_portrait;
						} elseif ( isset($image_full) && $image_type == 'full' ) {
							$testimonial_image = $image_full;
						}
					}

					if( !empty($testimonial_image) ) {

						// Image vars
						$image_id = $testimonial_image['id'];
						$image_url = $testimonial_image['url'];

						// Get WP responsive markup
						$responsive_image = wp_get_attachment_image( $image_id, 'full', false, array( 'class' => '' ) );
						$responsive_image_src = wp_get_attachment_image_url( $image_id, 'full' );
					}

					// if ( isset($responsive_image) ) { echo apply_filters( 'the_content', $responsive_image ); }
					if ( isset($responsive_image) ) { echo $responsive_image; };

				?>
			<?php } ?>
		</div>
	<?php }?>

	<?php if ( isset($testimonial_type) && $testimonial_type == 'text' ) { ?>

		<div class="entry-content">
			<?php if( isset($testimonial_excerpt) &&  $testimonial_excerpt ) { ?>
				<p><?php echo $testimonial_excerpt; ?></p>
			<?php } ?>
			<?php if( isset($testimonial_content) &&  $testimonial_content && !$has_readmore ) { ?>
				<?php echo apply_filters( 'the_content', $testimonial_content ); ?>
			<?php } else { ?>
				<a href="<?php the_permalink(); ?>">Read more</a>
			<?php } ?>
		</div>
	<?php } elseif ( isset($testimonial_type) && $testimonial_type == 'video' ) { ?>

		<div class="entry-content">

			<?php if( isset($option_intro) && $option_intro ) { ?>
				<div class="testimonial-excerpt">
					<?php if( isset($testimonial_excerpt) && $testimonial_excerpt ) { ?>
						<p><?php echo $testimonial_excerpt; ?></p>
					<?php } ?>
				</div>
			<?php } ?>

			<?php if( isset($testimonial_video) && $testimonial_video ) { ?>

				<div class="testimonial-video media-container">
					<?php echo $testimonial_video; ?>
				</div>
			<?php } ?>
		</div>
	<?php } ?>

	<?php if( !isset($option_title) && isset($author_name) && !empty($author_name) ) { ?>
		<footer>
			<h4 class="author">
				<span class="author-name"><?php echo $author_name; ?></span>
				<?php if( isset($author_lastname) ) { ?>
					<span class="author-lastname"><?php echo $author_lastname; ?></span>
				<?php } ?>
				<?php if( isset($author_location) ) { ?>
					<span class="author-location"><small> - <?php echo $author_location; ?></small></span>
				<?php } ?>
			</h4>
		</footer>
	<?php } ?>

</article>