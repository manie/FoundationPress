<?php while ( have_posts() ) : the_post(); ?>

	<?php

		$module_name = get_row_layout();
		$post_class = 'flexible-content';

		if ( get_sub_field('dcf_module_opt_grid') ) {
			$module_opt_grid = get_sub_field('dcf_module_opt_grid');
		} else { $module_opt_grid = ''; }

		if ( get_sub_field('dcf_module_opt_columns') ) {
			$module_opt_columns = get_sub_field('dcf_module_opt_columns');
		} else { $module_opt_columns = ''; }

		$post_class .= ' '. $module_opt_grid . ' col-'. $module_opt_columns;
	?>

	<article class="<?php echo $post_class; ?>" data-module="<?php echo $module_name; ?>">

		<div class="entry-content">
			<?php echo $module_name; ?>
		</div>

	</article>
<?php endwhile;?>