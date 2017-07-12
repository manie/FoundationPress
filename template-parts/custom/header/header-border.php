<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS/header.php'));

	// Extra class for panel content
		$content_class = 'hero-border';

?>

<?php if ( isset($border_enable) && isset($border_enable) ) { ?>
	<div class="<?php echo $content_class; ?>"></div>
<?php } ?>