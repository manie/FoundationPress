<?php

	// Include required module variables
		include(locate_template('template-parts/custom/VARS/ctas.php'));

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blogpost-entry post-item'); ?>>

	<header>
		<?php if ( isset($content_title) && !empty($content_title) ) { ?>
			<h3 class="title"><?php echo $content_title; ?></h3>
		<?php } else { ?>
			<h3 class="title"><?php the_title(); ?></h3>
		<?php } ?>
	</header>

	<?php if ( isset($content_intro) && !empty($content_intro) ) { ?>
		<div class="entry-content">
			<?php echo $content_intro; ?>
		</div>
	<?php } ?>

	<?php if ( isset($link_list) && !empty($link_list) ) { ?>
		<footer>
			<?php if( have_rows('dcf_cta_link_list') ): ?>
				<ul class="links inlinelist">
					<?php while( have_rows('dcf_cta_link_list') ): the_row();
						$link_text = get_sub_field('link_text');
						$link_url = get_sub_field('link_url');
						?>
						<li class="link">
							<?php if( $link_url ): ?>
								<a href="<?php echo $link_url['url']; ?>" target="<?php echo $link_url['target']; ?>" class="<?php echo $link_class; ?>"><?php if( $link_text ){ ?> <?php echo $link_text; ?> <?php } else { ?> <?php echo $link_url['title']; ?> <?php } ?></a>
							<?php endif; ?>
						</li>
					<?php endwhile; ?>
				</ul>
			<?php endif; ?>
		</footer>
	<?php } ?>

</article>