<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS-modules.php'));

	// Content Module
		$module_label = "Contact Form";
		$module_name = get_row_layout();

	// Add to default post class array
		// $post_class_array[] = 'posts-panel';

	// Extra class for panel content
		$content_class = 'content';

	// Override default module label with custom text
		if ( isset($module_title) && ( !empty($module_title) ) ) { $module_label = $module_title; }

	// Custom Content variables
		if ( get_sub_field('dcf_gravity_form_selection') ) { $form_selection = get_sub_field('dcf_gravity_form_selection'); }
		if ( get_sub_field('dcf_gravity_form_options') ) { $form_options = get_sub_field('dcf_gravity_form_options'); }
		if ( get_sub_field('dcf_gravity_form_tabindex') ) { $form_tabindex = get_sub_field('dcf_gravity_form_tabindex'); }

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

		<?php if ( isset($form_selection) && ( !empty($form_selection) ) ) { ?>
			<div class="panel-content">
				<section class="<?php echo $content_class; ?>">
					<?php

						// Gravity form ID to be used
						$form_id = $form_selection['id'];

						// Gravity function call vars
						$display_title = false;
						$display_description = false;
						$display_inactive = false;
						$field_values = null;
						$ajax = false;
						$tabindex = null;
						$echo = true;

						if ( isset($form_options) ) {
							if( in_array('title', $form_options) ) { $display_title = true; }
							if( in_array('description', $form_options) ) { $display_description = true; }
							if( in_array('ajax', $form_options) ) { $ajax = true; }
						}
						if ( isset($form_tabindex) ) { $tabindex = $form_tabindex; }

						if ( isset($form_id) ) {
							gravity_form( $form_id, $display_title, $display_description, $display_inactive, $field_values, $ajax, $tabindex, $echo );
						}
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