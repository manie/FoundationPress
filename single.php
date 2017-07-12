<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>

<div id="single-post" role="main">

	<?php do_action( 'foundationpress_before_content' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php if ( is_singular('testimonials') ){ ?>

			<?php get_template_part( 'template-parts/custom/content/single', 'testimonials'); ?>

		<?php } elseif ( is_singular('ctas') ){ ?>

			<?php get_template_part( 'template-parts/custom/content/single', 'ctas'); ?>

		<?php } else { ?>

			<article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
				<header>
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php foundationpress_entry_meta(); ?>
				</header>
				<?php do_action( 'foundationpress_post_before_entry_content' ); ?>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php edit_post_link( __( 'Edit', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
				</div>
				<footer>
					<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
					<p><?php the_tags(); ?></p>
				</footer>
				<?php the_post_navigation(); ?>
				<?php do_action( 'foundationpress_post_before_comments' ); ?>
				<?php comments_template(); ?>
				<?php do_action( 'foundationpress_post_after_comments' ); ?>
			</article>

		<?php } ?>

	<?php endwhile;?>

	<?php do_action( 'foundationpress_after_content' ); ?>

	<?php
		// Default sidebar only for posts
		if ( is_singular('post') ){ get_sidebar(); }
	?>

</div>
<?php get_footer();
