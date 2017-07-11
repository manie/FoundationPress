<?php if ( isset($module_title) || isset($module_introduction) ) { ?>
	<header class="panel-header">
		<?php if ( isset($module_title) && ( !empty($module_title) ) ) { ?>
			<h1 class="panel-title"><?php echo $module_title; ?></h1>
		<?php } ?>
		<?php if ( isset($module_introduction) && ( !empty($module_introduction) ) ) { ?>
			<div class="panel-introduction"><?php echo $module_introduction; ?></div>
		<?php } ?>
	</header>
<?php } ?>