<?php

	// Content Module
	$module_name = get_row_layout();

	// Custom Query vars
	if ( get_sub_field('dcf_post_listing_selection') ) { $listing_selection = get_sub_field('dcf_post_listing_selection'); }
	if ( get_sub_field('dcf_post_listing_type') ) {
		$post_type[] = get_sub_field('dcf_post_listing_type');
	} else { $post_type[] = 'post'; }
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
	$post_class[] = 'flexible-content posts-panel';
	if ( get_sub_field('dcf_module_opt_grid') ) { $post_class[] = get_sub_field('dcf_module_opt_grid'); }
	if ( get_sub_field('dcf_module_opt_columns') ) { $post_class[] = get_sub_field('dcf_module_opt_columns'); }
	$post_class_string = implode(" ", $post_class);

	// Module Content - Text strings with fallback
	if ( get_sub_field('dcf_module_title') ) { $module_title = get_sub_field('dcf_module_title'); }
	if ( get_sub_field('dcf_module_introduction') ) { $module_introduction = get_sub_field('dcf_module_introduction'); }

?>

<?php if ( $query->have_posts() ) { ?>

	<div class="<?php echo $post_class_string; ?>" data-module="<?php echo $module_name; ?>">

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

		<div class="panel-content">
			<section class="<?php echo $active; ?>">
				<?php while ( $query->have_posts() ) { $query->the_post(); ?>
					<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
				<?php } ?>
			</section>
		</div>
	</div>

<?php } ?>

<?php
  // Restore original Post Data
  wp_reset_postdata();
?>