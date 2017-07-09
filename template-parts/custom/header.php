<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS-header.php'));

	// Extra class for panel content
		$module_name = 'Hero Header';

?>

<?php if ( isset($header_option) && $header_option != 'none' ) { ?>

	<div id="header-container">
		<header class="page-header <?php echo $header_option; ?>">

			<div class="hero-content">

				<?php if ( $header_option == 'default') { ?>
					<?php if ( isset($content_heading) && ( !empty($content_heading) ) ) { ?>
						<h1 class="heading"><?php echo $content_heading; ?></h1>
					<?php } ?>
				<?php } elseif ( $header_option == 'image') { ?>

				<?php } ?>

			</div>

		</header>
	</div>

<?php } ?>