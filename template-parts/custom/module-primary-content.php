<?php while ( have_posts() ) : the_post(); ?>

	<?php

		// Content Module
		$module_name = get_row_layout();

		// Module Options - Post Class array
		$post_class[] = 'main-content';
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

	<?php if (!empty_content($post->post_content)) { ?>

		<article class="<?php echo $post_class_string; ?>" data-module="<?php echo $module_name; ?>" <?php if ( isset($module_design_style) ) { echo $module_design_style; } ?> id="post-<?php the_ID(); ?>">

			<?php if ( !is_front_page() && !is_home() ) { ?>
				<header>
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>
			<?php } //end if ?>

			<?php do_action( 'foundationpress_page_before_entry_content' ); ?>

			<?php if (!empty_content($post->post_content)) { ?>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			<?php } ?>

			<?php $tag = get_the_tags(); ?>
			<?php if ( dando_is_paginated_post() || $tag ) { ?>
				<footer>
					<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
					<?php if ( $tag ) { ?> <p><?php the_tags(); ?></p> <?php } ?>
				</footer>
			<?php } ?>

		</article>

	<?php } ?>

<?php endwhile;?>