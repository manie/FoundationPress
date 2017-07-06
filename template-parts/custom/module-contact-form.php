<?php

	// Content Module
	$module_name = get_row_layout();

	// Custom Content
	if ( get_sub_field('dcf_gravity_form_selection') ) { $form_selection = get_sub_field('dcf_gravity_form_selection'); }
	if ( get_sub_field('dcf_gravity_form_options') ) { $form_options = get_sub_field('dcf_gravity_form_options'); }
	if ( get_sub_field('dcf_gravity_form_tabindex') ) { $form_tabindex = get_sub_field('dcf_gravity_form_tabindex'); }

	// Extra class for first active item
	$active = 'posts-list';

	// Module Options - Post Class array
	$post_class[] = 'flexible-content posts-panel';
	if ( get_sub_field('dcf_module_opt_grid') ) { $post_class[] = get_sub_field('dcf_module_opt_grid'); }
	if ( get_sub_field('dcf_module_opt_columns') ) { $post_class[] = get_sub_field('dcf_module_opt_columns'); }
	if ( get_sub_field('dcf_module_opt_margin') ) { $post_class[] = 'margin'; }
	if ( get_sub_field('dcf_module_design_bg_image') ) { $post_class[] = 'bgimg'; }
	$post_class_string = implode(" ", $post_class);

	// Module Content - Text string with fallback
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

<?php if ( have_posts() ) { ?>

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

		<?php if ( isset($form_selection) && ( !empty($form_selection) ) ) { ?>
			<div class="panel-content">
				<section class="<?php echo $active; ?>">
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

	</div>

<?php } ?>

<?php
  // Restore original Post Data
  wp_reset_postdata();
?>