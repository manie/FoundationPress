<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS-header.php'));

	// Extra class for panel content
		// $content_class = 'content';

?>

<?php if ( isset($image) && isset($header_style) ) { ?>
	<div class="hero-media">
		<span class="bgimg" <?php echo $header_style; ?>></span>
	</div>
<?php } ?>