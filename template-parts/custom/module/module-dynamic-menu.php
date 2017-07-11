<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS-modules.php'));

	// Content Module
		$module_label = "Dynamic Menu";
		$module_name = get_row_layout();

	// Add to default post class array
		// $post_class_array[] = 'posts-panel';

	// Extra class for panel content
		$content_class = 'content';

	// Override default module label with custom text
		if ( isset($module_title) && ( !empty($module_title) ) ) { $module_label = $module_title; }

	// Custom Content variables
		$menu_class = 'menu-module inlinelist';
		if ( get_sub_field('dcf_menu_selection') ) { $menu_selection = get_sub_field('dcf_menu_selection'); }

?>

<?php if ( have_posts() && !$disable_mobile ) { ?>

	<article aria-label="<?php echo $module_label; ?>" data-module="<?php echo $module_name; ?>" <?php post_class($post_class_array); ?> <?php if ( isset($module_design_style) ) { echo $module_design_style; } ?>>

		<?php get_template_part( 'template-parts/custom/module/module', 'header' );  ?>

		<?php if ( isset($menu_selection) && ( !empty($menu_selection) ) ) { ?>
			<div class="panel-content">
				<section class="section <?php echo $content_class; ?>">
					<?php
						wp_nav_menu( array(
							'menu' 			=> $menu_selection,
							'container' 	=> false,
							'menu_class' 	=> $menu_class,
							'items_wrap' 	=> '<ul id="%1$s" class="%2$s" >%3$s</ul>',
							'depth' 		=> 1,
							'fallback_cb' 	=> false,
						));
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