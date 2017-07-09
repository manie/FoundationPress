<?php

	// check if the flexible content field has rows of data
	if( get_field('dcf_header_option') ):

		if( get_field('dcf_header_option') == 'default' ):

			get_template_part( 'template-parts/custom/header' );

		elseif ( get_field('dcf_header_option') == 'image' ):

			get_template_part( 'template-parts/custom/header', 'image' );

		else :

			// none selected
			get_template_part( 'template-parts/custom/header', 'none' );

		endif;

	else :

		// default template header
		get_template_part( 'template-parts/featured-image' );

	endif;
?>
