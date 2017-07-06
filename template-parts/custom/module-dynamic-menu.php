<?php

	// Content Module
	$module_name = get_row_layout();

	// Custom Content
	if ( get_sub_field('dcf_menu_selection') ) { $menu_selection = get_sub_field('dcf_menu_selection'); }

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

		<?php if ( isset($menu_selection) && ( !empty($menu_selection) ) ) { ?>
			<div class="panel-content">
				<section class="<?php echo $active; ?>">
					<?php

						// WP Menu
						wp_nav_menu( array(
							'menu' 			=> $menu_selection,
							'container' 	=> false,
							'menu_class' 	=> 'menu-module',
							'items_wrap' 	=> '<ul id="%1$s" class="%2$s desktop-menu" >%3$s</ul>',
							'depth' 		=> 1,
							'fallback_cb' 	=> false,
						));

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