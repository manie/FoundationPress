<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS/modules.php'));

	// Content Module
		$module_label = "Post Listing";
		$module_name = get_row_layout();

	// Add to default post class array
		$post_class_array[] = 'posts-panel';

	// Extra class for panel content
		$content_class = 'content';

	// Override default module label with custom text
		if ( isset($module_title) && ( !empty($module_title) ) ) { $module_label = $module_title; }

	// Custom Content variables
		$default_post_type = 'post';
		$default_order = 'ASC'; // 'DESC';
		$default_orderby = 'menu_order'; // 'date';

		if ( get_sub_field('dcf_post_listing_selection') ) { $listing_selection = get_sub_field('dcf_post_listing_selection'); }
		if ( get_sub_field('dcf_post_listing_type') ) { $post_type[] = get_sub_field('dcf_post_listing_type'); } else { $post_type[] = $default_post_type; }
		if ( get_sub_field('dcf_post_listing_term_restriction') ) { $post_term_restriction[] = get_sub_field('dcf_post_listing_term_restriction'); }
		if ( get_sub_field('dcf_post_listing_count') ) { $post_count = get_sub_field('dcf_post_listing_count'); } else { $post_count = get_option( 'posts_per_page' ); }
		if ( get_sub_field('dcf_post_listing_items') ) { $listing_items = get_sub_field('dcf_post_listing_items'); }
		$content_class = implode(" ", $post_type);

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
				'order' 			=> $default_order,
				'orderby' 			=> $default_orderby,
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
				'order' 			=> $default_order,
				'orderby' 			=> $default_orderby,
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
				'order' 			=> $default_order,
				'orderby' 			=> $default_orderby,
			);
		}

	// The Query & Count
		$query = new WP_Query( $args );
		$count = $query->post_count;

	// Extra class for first active item
		$i = 0; if ( $i == 1 ) { $active = 'pinned-post'; } else { $active = 'posts-list'; }

?>

<?php if ( $query->have_posts() && !$disable_mobile ) { ?>

	<article aria-label="<?php echo $module_label; ?>" data-module="<?php echo $module_name; ?>" <?php post_class($post_class_array); ?> <?php if ( isset($module_design_style) ) { echo $module_design_style; } ?>>

		<?php get_template_part( 'template-parts/custom/module/module', 'header' );  ?>

		<div class="panel-content">
			<section class="section <?php echo $content_class; ?>">
				<?php while ( $query->have_posts() ) { $query->the_post(); ?>
					<?php
						$i++; // Increment count for active class
						if ( get_post_type() == 'testimonials' ){
							get_template_part( 'template-parts/custom/content/archive', 'testimonials');
						} elseif ( get_post_type() == 'ctas' ){
							get_template_part( 'template-parts/custom/content/archive', 'ctas');
						} else {
							get_template_part( 'template-parts/content', 'custom');
						}
					?>
				<?php } ?>
			</section>
		</div>
	</article>

<?php } ?>

<?php
	// Restore original Post Data
	wp_reset_postdata();
?>