<?php while ( have_posts() ) : the_post(); ?>

	<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS-modules.php'));

	// Content Module
		$module_label = "Primary Content";
		$module_name = get_row_layout();

	// Extra class for panel content
		// $content_class = '';

	// Add to default post class array
		// $post_class_array[] = '';

	// WP default vars
		$tag = get_the_tags();

	?>

	<?php if (!empty_content($post->post_content)) { ?>

		<article aria-label="<?php echo $module_label; ?>" data-module="<?php echo $module_name; ?>" <?php post_class($post_class_array); ?> <?php if ( isset($module_design_style) ) { echo $module_design_style; } ?>>

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