<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS-header.php'));

	// Extra class for panel content
		$content_class = 'content';

?>

<?php if ( isset($header_option) && $header_option != 'none' ) { ?>

	<div id="header-container">
		<header class="page-header <?php echo $header_option; ?>" data-overlay="<?php echo $overlay_style; ?>" data-links="<?php echo $link_type; ?>" data-map="<?php echo $details_class; ?>">

			<?php if ( isset($link_enable) && isset($link_url) && $link_type == 'header' && $header_option != 'map' ) { ?>
				<a href="<?php echo $link_url['url']; ?>" title="<?php echo $link_url['title']; ?>" target="<?php echo $link_url['target']; ?>">
			<?php } ?>

				<?php

					// get header content
					get_template_part( 'template-parts/custom/header', 'content' );

					// get header option types
					if( $header_option ):

						if ( $header_option == 'image' ):
							get_template_part( 'template-parts/custom/header', 'image' );
						elseif ( $header_option == 'video' ):
							get_template_part( 'template-parts/custom/header', 'video' );
						elseif ( $header_option == 'gallery' ):
							get_template_part( 'template-parts/custom/header', 'gallery' );
						elseif ( $header_option == 'slider' ):
							get_template_part( 'template-parts/custom/header', 'slider' );
						elseif ( $header_option == 'map' ):
							get_template_part( 'template-parts/custom/header', 'map' );
						else:
							get_template_part( 'template-parts/custom/header' );
						endif;

					else :

						// default template header
						get_template_part( 'template-parts/featured-image' );

					endif;

					// get header overlay
					get_template_part( 'template-parts/custom/header', 'overlay' );

					// get header border
					get_template_part( 'template-parts/custom/header', 'border' );
				?>

			<?php if ( isset($link_enable) && isset($link_url) && $link_type == 'header' && $header_option != 'map' ) { ?>
				</a>
			<?php } ?>

		</header>
	</div>

<?php } ?>