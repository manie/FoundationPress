<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS-modules.php'));

	// Content Module
		$module_label = "Extra Content";
		$module_name = get_row_layout();

	// Add to default post class array
		// $post_class_array[] = 'posts-panel';

	// Extra class for panel content
		$content_class = 'content';

	// Override default module label with custom text
		if ( isset($module_title) && ( !empty($module_title) ) ) { $module_label = $module_title; }

	// Custom Content variables
		if ( get_sub_field('dcf_extra_content_editor') ) { $extra_content = get_sub_field('dcf_extra_content_editor'); }
		// NB: No fallback

?>

<?php if ( have_posts() ) { ?>

	<article aria-label="<?php echo $module_label; ?>" data-module="<?php echo $module_name; ?>" <?php post_class($post_class_array); ?> <?php if ( isset($module_design_style) ) { echo $module_design_style; } ?>>

		<?php get_template_part( 'template-parts/custom/module/module', 'header' );  ?>

		<?php if ( isset($extra_content) && ( !empty($extra_content) ) ) { ?>
			<div class="panel-content">
				<section class="section <?php echo $content_class; ?>">
					<?php
						// Apply WP content filter
						echo apply_filters('the_content', $extra_content);
					?>
				</section>
			</div>
		<?php } ?>
	</article>

<?php } ?>

<?php
	// Restore original Post Data
	wp_reset_postdata();
?>