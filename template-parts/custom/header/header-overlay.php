<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS-header.php'));

	// Extra class for panel content
		$content_class = 'hero-overlay';

?>

<?php if ( isset($overlay_enable) && isset($overlay_style) && $overlay_style != 'none' && $header_option != 'slider' ) { ?>
	<div class="<?php echo $content_class; ?>" data-overlay-type="<?php echo $overlay_type; ?>"></div>
<?php } ?>