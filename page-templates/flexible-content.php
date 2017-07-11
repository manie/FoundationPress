<?php
/*
Template Name: FLEXIBLE CONTENT
*/
get_header(); ?>

<?php get_template_part( 'template-parts/custom/hero-header' ); ?>

<div id="page-flexible-content" role="main">

	<?php do_action( 'foundationpress_before_content' ); ?>

	<?php get_template_part( 'template-parts/custom/FLEXIBLE-CONTENT' ); ?>

	<?php do_action( 'foundationpress_after_content' ); ?>

</div>

<?php get_footer();
