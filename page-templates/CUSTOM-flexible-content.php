<?php
/*
Template Name: Flexible Content
*/
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>

<div id="page-flexible-content" role="main">

	<?php do_action( 'foundationpress_before_content' ); ?>

	<?php

		// check if the flexible content field has rows of data
		if( have_rows('dcm') ):

			// loop through the rows of data
			while ( have_rows('dcm') ) : the_row();

				if( get_row_layout() == 'primary_content' ):

					get_template_part( 'template-parts/custom/module-primary-content' );

				elseif( get_row_layout() == 'horizontal_break' ):

					get_template_part( 'template-parts/custom/module-hr' );

				elseif( get_row_layout() == 'grid_slider' ):

					get_template_part( 'template-parts/custom/module-grid-slider' );

				elseif( get_row_layout() == 'extra_content' ):

					get_template_part( 'template-parts/custom/module-extra-content' );

				elseif( get_row_layout() == 'post_listing' ):

					get_template_part( 'template-parts/custom/module-post-listing' );

				endif;

			endwhile;

		else :

			// no layouts found
			get_template_part( 'template-parts/custom/module-none' );

		endif;

	?>

	<?php do_action( 'foundationpress_after_content' ); ?>

</div>

<?php get_footer();
