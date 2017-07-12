<?php while ( have_posts() ) : the_post(); ?>

	<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS/modules.php'));

	// Content Module
		$module_title = get_the_title();
		$module_name = get_row_layout();

	// Add to default post class array
		$post_class_array[] = 'main-content';

	// Extra class for panel content
		$content_class = 'entry-content';

	// Override default module label with custom text
		if ( isset($module_title) && ( !empty($module_title) ) ) { $module_label = $module_title; }

	// WP default vars
		$tag = get_the_tags();

	?>

	<?php if ( !empty_content($post->post_content) && !$disable_mobile ) { ?>

		<article aria-label="<?php echo $module_label; ?>" data-module="<?php echo $module_name; ?>" <?php post_class($post_class_array); ?> <?php if ( isset($module_design_style) ) { echo $module_design_style; } ?>>

			<?php if ( !is_front_page() && !is_home() && ( get_field('dcf_header_option') == 'none' ) ) { ?>
				<header>
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>
			<?php } //end if ?>

			<?php do_action( 'foundationpress_page_before_entry_content' ); ?>

			<?php if (!empty_content($post->post_content)) { ?>
				<div class="section <?php echo $content_class; ?>">
					<?php the_content(); ?>
				</div>
			<?php } ?>

			<?php if ( dando_is_paginated_post() || $tag ) { ?>
				<footer>
					<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
					<?php if ( $tag ) { ?> <p><?php the_tags(); ?></p> <?php } ?>
				</footer>
			<?php } ?>
		</article>

	<?php } ?>

<?php endwhile;?>

<?php
	// Restore original Post Data
	wp_reset_postdata();
?>