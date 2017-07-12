<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS/header.php'));

	// Extra class for panel content
		$content_class = 'hero-media';

?>

<?php if ( isset($image) && isset($header_style) ) { ?>
	<div class="<?php echo $content_class; ?>">
		<span class="bgimg" <?php echo $header_style; ?>></span>
	</div>
<?php } ?>