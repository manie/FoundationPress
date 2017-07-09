<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS-modules.php'));

	// Content Module
		$module_label = "Widget Area";
		$module_name = get_row_layout();

	// Add to default post class array
		$post_class_array[] = 'posts-panel';

	// Extra class for panel content
		$content_class = 'content';

	// Override default module label with custom text
		if ( isset($module_title) && ( !empty($module_title) ) ) { $module_label = $module_title; }

	// Custom Content variables
		if ( get_sub_field('dcf_widget_area') ) { $widget_area = get_sub_field('dcf_widget_area'); }

?>

<?php if ( have_posts() ) { ?>

	<article aria-label="<?php echo $module_label; ?>" data-module="<?php echo $module_name; ?>" <?php post_class($post_class_array); ?> <?php if ( isset($module_design_style) ) { echo $module_design_style; } ?>>

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

		<?php if ( isset($widget_area) && ( !empty($widget_area) ) ) { ?>
			<div class="panel-content">
				<section class="<?php echo $content_class; ?>">
					<?php dynamic_sidebar( $widget_area ); ?>
				</section>
			</div>
		<?php } ?>
	</article>

<?php } ?>

<?php
	// Restore original Post Data
	wp_reset_postdata();
?>