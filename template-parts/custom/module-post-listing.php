<?php

	// Content Module
	$module_name = get_row_layout();

	// Custom Query vars
	if ( get_sub_field('dcf_post_listing_selection') ) { $listing_selection = get_sub_field('dcf_post_listing_selection'); }
	if ( get_sub_field('dcf_post_listing_type') ) {
		$post_type[] = get_sub_field('dcf_post_listing_type');
	} else { $post_type[] = 'post'; }
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
	$i = 0; if ( $i == 1 ) { $active = 'pinned-post'; } else { $active = 'posts-list'; }

	// Module Options - Post Class array
	$post_class[] = 'flexible-content';
	$post_class[] = 'posts-panel';
	if ( get_sub_field('dcf_module_opt_grid') ) { $post_class[] = get_sub_field('dcf_module_opt_grid'); }
	if ( get_sub_field('dcf_module_opt_columns') ) { $post_class[] = get_sub_field('dcf_module_opt_columns'); }
	if ( get_sub_field('dcf_module_opt_margin') ) { $post_class[] = 'margin'; }
	$post_class_string = implode(" ", $post_class);

	// Module Content - Text strings with fallback
	if ( get_sub_field('dcf_module_title') ) { $module_title = get_sub_field('dcf_module_title'); }
	if ( get_sub_field('dcf_module_introduction') ) { $module_introduction = get_sub_field('dcf_module_introduction'); }

	// Module Design - CSS colour & background
	if ( get_sub_field('dcf_module_design_bg_colour') ) { $module_bg_colour = get_sub_field('dcf_module_design_bg_colour'); }
	if ( get_sub_field('dcf_module_design_bg_image') ) { $module_bg_image = get_sub_field('dcf_module_design_bg_image'); }
	if ( isset($module_bg_colour) ) { $module_design_style = 'style="background-color:' . $module_bg_colour . '"'; }
	if ( isset($module_bg_image) ) {
		$image_url = $module_bg_image['url'];
		$image_size = 'large';
		$image_with_size = $module_bg_image['sizes'][ $image_size ];
		$module_design_style = 'style="background-image: url(' . $image_with_size . ')"';
	}

?>

<?php if ( $query->have_posts() ) { ?>

	<div class="<?php echo $post_class_string; ?>" data-module="<?php echo $module_name; ?>" <?php if ( isset($module_design_style) ) { echo $module_design_style; } ?>>

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

		<?php while ( $query->have_posts() ) { $query->the_post(); ?>
			<div class="panel-content">
				<section class="<?php echo $active; ?>">
					<?php get_template_part( 'template-parts/content', 'custom'); ?>
				</section>
			</div>
		<?php } ?>
	</div>

<?php } ?>

<?php
  // Restore original Post Data
  wp_reset_postdata();
?>