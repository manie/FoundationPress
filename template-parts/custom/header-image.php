<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS-header.php'));

	// Extra class for panel content
		$content_class = 'content';

?>

<?php if ( $header_option ) { ?>

	<div aria-label="<?php echo $module_label; ?>" id="header-container" data-module="<?php echo $module_name; ?>">
		<header class="page-header <?php echo $header_option; ?>">

		</header>
	</div>

<?php } ?>