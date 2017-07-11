<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS-header.php'));

	// Extra class for panel content
		$module_name = 'Hero Header';

?>

<?php if ( isset($header_option) && $header_option != 'none' ) { ?>

	<div id="header-container">
		<header class="page-header <?php echo $header_option; ?>">

			<div class="hero-content <?php if (isset($has_media)) { echo $has_media; } ?>">
				<?php if ( isset($content_heading) && ( !empty($content_heading) ) ) { ?>
					<h1 class="heading"><?php echo $content_heading; ?></h1>
				<?php } ?>

				<?php if ( isset($content_subheading) && ( !empty($content_subheading) ) ) { ?>
					<h2 class="subheading"><?php echo $content_subheading; ?></h2>
				<?php } ?>

				<?php if ( isset($content_description) && ( !empty($content_description) ) ) { ?>
					<p class="description"><?php echo $content_description; ?></p>
				<?php } ?>
			</div>

		</header>
	</div>

<?php } ?>