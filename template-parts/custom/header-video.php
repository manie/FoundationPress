<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS-header.php'));

	// Extra class for panel content
		// $content_class = 'content';

?>

<?php if ( isset($video) && isset($header_style) ) { ?>
	<div class="hero-media" <?php echo $header_style; ?>>
		<div id="bgndVideo" class="player" data-property="{videoURL: '<?php echo $video_url; ?>',autoPlay: true, showControls: true, optimizeDisplay: true, quality: 'default', mute: true, loop: true, remember_last_time: true, stopMovieOnBlur: false, containment: 'self' }"></div>
		<script> jQuery(function(){ jQuery("#bgndVideo").YTPlayer(); }); </script>
	</div>
<?php } ?>