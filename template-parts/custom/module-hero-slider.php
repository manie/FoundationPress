<?php

	$module_name = get_row_layout();
	$post_class[] = 'flexible-content';
	$post_class[] = 'hero-slider';
	$post_class[] = 'orbit';

	  // Custom Query vars
	$post_type[] = 'sliders';

	if ( get_sub_field('dcf_post_listing_selection') ) { $listing_selection = get_sub_field('dcf_post_listing_selection'); }
	if ( get_sub_field('dcf_post_listing_type') ) {
		$post_type[] = get_sub_field('dcf_post_listing_type');
	} else { $post_type[] = 'slider'; }
	if ( get_sub_field('dcf_post_listing_term_restriction') ) { $post_term_restriction[] = get_sub_field('dcf_post_listing_term_restriction'); }
	if ( get_sub_field('dcf_post_listing_count') ) {
		$post_count = get_sub_field('dcf_post_listing_count');
	} else { $post_count = get_option( 'posts_per_page' ); }
	if ( get_sub_field('dcf_post_listing_items') ) { $listing_items = get_sub_field('dcf_post_listing_items'); }

	// WP_Query arguments
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	if ( isset($listing_items) && ($listing_selection == 'custom') ) {
		$args = array(
			'post_type' 		=> $post_type,
			'post_status' 		=> array( 'publish' ),
			'post__in' 			=> $listing_items,
			'nopaging' 			=> false,
			'paged' 			=> $paged,
			'posts_per_page' 	=> $post_count,
			'order' 			=> 'ASC',
			'orderby' 			=> 'menu_order',
		);
	} elseif ( isset($post_term_restriction) && ($listing_selection == 'recent') ) {

		// Override selected post type based on selected taxonomy
		$restrictedTerm = $post_term_restriction[0][0]->slug;
		$restrictedTaxonomy = $post_term_restriction[0][0]->taxonomy;
		$taxObject = get_taxonomy($restrictedTaxonomy);
		$postTypeArray = $taxObject->object_type;
		$post_type = $postTypeArray[0];

		$args = array(
			'post_type' 		=> $post_type,
			'post_status' 		=> array( 'publish' ),
			'nopaging' 			=> false,
			'paged' 			=> $paged,
			'posts_per_page' 	=> $post_count,
			'order' 			=> 'ASC',
			'orderby' 			=> 'menu_order',
			'tax_query' => array(
				array (
					'taxonomy' 	=> $restrictedTaxonomy,
					'field' 	=> 'slug',
					'terms' 	=> $restrictedTerm,
				)
			),
		);
	} else {
		$args = array(
			'post_type' 		=> $post_type,
			'post_status' 		=> array( 'publish' ),
			'nopaging' 			=> false,
			'paged' 			=> $paged,
			'posts_per_page' 	=> $post_count,
			'order' 			=> 'DESC',
			'orderby' 			=> 'date',
		);
	}

	// The Query & Count
	$query = new WP_Query( $args );
	$count = $query->post_count;

	// Extra class for first active item
	$i = 0; if ( $i == 1 ) { $active = 'is-active'; }

	if ( get_sub_field('dcf_module_opt_grid') ) { $post_class[] = get_sub_field('dcf_module_opt_grid'); }
	if ( get_sub_field('dcf_module_opt_columns') ) { $post_class[] = get_sub_field('dcf_module_opt_columns'); }
	if ( get_sub_field('dcf_module_opt_margin') ) { $post_class[] = 'margin'; }
	$post_class_string = implode(" ", $post_class);
?>

<?php if ( $query->have_posts() ) { ?>

	<div class="<?php echo $post_class_string; ?>" role="region" aria-label="FullScreen Slider"  data-module="<?php echo $module_name; ?> data-count="<?php echo $count; ?>" data-orbit>
		<ul class="orbit-container">

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

			<?php while ( $query->have_posts() ) { $query->the_post(); ?>

				<?php
					// ACF fields
					$image = get_field('dcf_slide_image');
					$overlay = get_field('dcf_slide_overlay');
					$caption = get_field('dcf_slide_caption');
					$link_type = get_field('dcf_slide_link');
					$link_url = get_field('dcf_slide_link_url');
					$link_text = get_field('dcf_slide_link_text');

					if( !empty($image) ) {

						// Image vars
						$image_id = $image['id'];
						$image_url = $image['url'];

						// Get WP responsive markup
						$responsive_image = wp_get_attachment_image( $image_id, 'full', false, array( 'class' => 'orbit-image' ) );
						$responsive_image_src = wp_get_attachment_image_url( $image_id, 'full' );
					}
				?>

				<li class="orbit-slide<?php if ( isset($active) ) { echo $active; } ?>" <?php if ( isset($responsive_image_src) ) { echo 'style="background-image: url(\''.$responsive_image_src.'\')'; } ?>">

					<?php if ( $link_type == 'slide' && !empty($link_url) ) { ?><a href="<?php echo $link_url; ?>"><?php } ?>

					<?php if ( isset($responsive_image) ) { echo apply_filters( 'the_content', $responsive_image ); } ?>
					<?php if ( isset($caption) ) { ?>
						<figcaption class="orbit-caption">
							<h1><?php echo $caption; ?></h1>
							<?php if ( $link_type == 'button' && !empty($link_url) ) { ?>
								<a href="<?php echo $link_url; ?>" class="button"><?php if (!empty($link_text)) { echo $link_text; } else { echo 'Find our more'; } ?></a>
							<?php } ?>
						</figcaption>
					<?php } ?>
					<?php if ( isset($overlay) ) { ?><div class="orbit-overlay <?php echo $overlay; ?>"></div><?php } ?>

					<?php if ( $link_type == 'slide' && !empty($link_url) ) { ?></a><?php } ?>

				</li>
			<?php } ?>

		</ul>
	</div>

<?php } ?>

<?php
	// Restore original Post Data
	wp_reset_postdata();
?>