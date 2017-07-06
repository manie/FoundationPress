<?php while ( have_posts() ) : the_post(); ?>

	<?php

		$module_name = get_row_layout();
		$post_class = 'flexible-content';

		if ( get_sub_field('dcf_module_opt_grid') ) { $post_class[] = get_sub_field('dcf_module_opt_grid'); }
		if ( get_sub_field('dcf_module_opt_columns') ) { $post_class[] = get_sub_field('dcf_module_opt_columns'); }
		if ( get_sub_field('dcf_module_opt_margin') ) { $post_class[] = 'margin'; }
		$post_class_string = implode(" ", $post_class);
	?>

	<article class="<?php echo $post_class_string; ?>" data-module="<?php echo $module_name; ?>">

		<div class="entry-content">
			<?php echo $module_name; ?>
		</div>

	</article>
<?php endwhile;?>