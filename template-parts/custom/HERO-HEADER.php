<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS/header.php'));

	// Extra header classes for panel content
		$content_class[] = 'page-header';
		if ( isset($header_option) && $header_option != 'none' ) { $content_class[] = $header_option; }
		if ( isset($link_type) && $link_type != 'none' ) {$content_class[] = $link_type; }
		if ( isset($details_class) && $details_class != 'none' ) {$content_class[] = $details_class; }
		$content_class = implode( " ", $content_class );
?>

<?php if ( isset($header_option) && $header_option != 'none' ) { ?>

	<div id="header-container">
		<header class="<?php echo $content_class; ?>" data-overlay="<?php if (isset($overlay_style)) { echo $overlay_style; } ?>">

			<?php
				// START - Add module wide link
				if ( isset($link_enable) && isset($link_url) && $link_type == 'header' && $header_option != 'map' ) { ?>
				<a href="<?php echo $link_url['url']; ?>" title="<?php echo $link_url['title']; ?>" target="<?php echo $link_url['target']; ?>">
			<?php } ?>

				<?php

					// get header content
					get_template_part( 'template-parts/custom/header/header', 'content' );

					// get header option types
					if( $header_option ):

						if ( $header_option == 'image' ):
							get_template_part( 'template-parts/custom/header/header', 'image' );
						elseif ( $header_option == 'video' ):
							get_template_part( 'template-parts/custom/header/header', 'video' );
						elseif ( $header_option == 'gallery' ):
							get_template_part( 'template-parts/custom/header/header', 'gallery' );
						elseif ( $header_option == 'slider' ):
							get_template_part( 'template-parts/custom/header/header', 'slider' );
						elseif ( $header_option == 'map' ):
							get_template_part( 'template-parts/custom/header/header', 'map' );
						else:
							// no header options found
							get_template_part( 'template-parts/custom/header/header' );
						endif;

					else :

						// fallback to default template header
						get_template_part( 'template-parts/featured-image' );

					endif;

					// get header overlay
					get_template_part( 'template-parts/custom/header/header', 'overlay' );

					// get header border
					get_template_part( 'template-parts/custom/header/header', 'border' );
				?>

			<?php
				// END - Add module wide link
				if ( isset($link_enable) && isset($link_url) && $link_type == 'header' && $header_option != 'map' ) { ?>
				</a>
			<?php } ?>

		</header>
	</div>

<?php } ?>