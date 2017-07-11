<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS-modules.php'));

	// Content Module
		$module_label = "Flexible Module";
		$module_name = get_row_layout();

	// Add to default post class array
		$post_class_array[] = 'main-content';

	// Extra class for panel content
		$content_class = 'content';

	// Override default module label with custom text
		if ( isset($module_title) && ( !empty($module_title) ) ) { $module_label = $module_title; }

	// Custom Content variables
		// if ( get_sub_field('FIELDNAME') ) { $FIELDNAME = get_sub_field('FIELDNAME'); }

?>

<?php if ( have_posts() ) { ?>

	<article aria-label="<?php echo $module_label; ?>" data-module="<?php echo $module_name; ?>" <?php post_class($post_class_array); ?> <?php if ( isset($module_design_style) ) { echo $module_design_style; } ?>>

		<!-- No Flexible Modules Selected -->

	</article>

<?php } ?>

<?php
	// Restore original Post Data
	wp_reset_postdata();
?>