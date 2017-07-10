<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS-header.php'));

	// Extra class for panel content
		$content_class = 'content';

	// Custom content vars
		$image = get_field('dcf_header_hero_image');

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

		if ( isset($header_style) && ( !empty($header_style) ) ) {
			$has_media = 'has-img';
		} else { $has_media = 'no-img'; }

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

			<?php if ( isset($header_style) && ( !empty($header_style) ) ) { ?>
				<div class="hero-media">
					<span class="bgimg" <?php echo $header_style; ?>></span>
				</div>
			<?php } ?>

		</header>
	</div>

<?php } ?>