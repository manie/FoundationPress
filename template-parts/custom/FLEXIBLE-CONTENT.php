<?php

	// Check if ACF is active first
	if ( class_exists('acf') ) {

		// check if the flexible content field has rows of data
		if( have_rows('dcm') ):

			// loop through the rows of data
			while ( have_rows('dcm') ) : the_row();

				if( get_row_layout() == 'primary_content' ):
					get_template_part( 'template-parts/custom/module/module', 'primary-content' );
				elseif( get_row_layout() == 'hero_slider' ):
					get_template_part( 'template-parts/custom/module/module', 'hero-slider' );
				elseif( get_row_layout() == 'horizontal_break' ):
					get_template_part( 'template-parts/custom/module/module', 'hr' );
				elseif( get_row_layout() == 'extra_content' ):
					get_template_part( 'template-parts/custom/module/module', 'extra-content' );
				elseif( get_row_layout() == 'extra_content_media' ):
					get_template_part( 'template-parts/custom/module/module', 'extra-content-media' );
				elseif( get_row_layout() == 'post_listing' ):
					get_template_part( 'template-parts/custom/module/module', 'post-listing' );
				elseif( get_row_layout() == 'grid_slider' ):
					get_template_part( 'template-parts/custom/module/module', 'grid-slider' );
				elseif( get_row_layout() == 'contact_form' ):
					get_template_part( 'template-parts/custom/module/module', 'contact-form' );
				elseif( get_row_layout() == 'dynamic_menu' ):
					get_template_part( 'template-parts/custom/module/module', 'dynamic-menu' );
				elseif( get_row_layout() == 'widget_area' ):
					get_template_part( 'template-parts/custom/module/module', 'widget-area' );
				endif;

			endwhile;

		else :

			// no layouts found
			get_template_part( 'template-parts/custom/module/module' );

		endif;

	} else { // Get stardard page content ?>

		<?php do_action( 'foundationpress_before_content' ); ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">

				<?php if ( !is_front_page() && !is_home() ) { ?>
					<header>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header>
				<?php } //end if ?>

				<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php edit_post_link( __( 'Edit', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
				</div>
				<footer>
					<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
					<p><?php the_tags(); ?></p>
				</footer>

				<?php do_action( 'foundationpress_page_before_comments' ); ?>
				<?php comments_template(); ?>
				<?php do_action( 'foundationpress_page_after_comments' ); ?>
			</article>
		<?php endwhile;?>

		<?php do_action( 'foundationpress_after_content' ); ?>

	<?php }

?>
