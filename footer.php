<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

if (is_active_sidebar( 'footer-widgets' )) { echo 'here'; };

?>

		</section>
		<div id="footer-container">
			<?php if( function_exists('is_sidebar_active') && is_sidebar_active( 'footer-widgets' ) && is_active_sidebar( 'footer-widgets' ) ): ?>
				<footer id="footer">
					<?php do_action( 'foundationpress_before_footer' ); ?>
					<?php dynamic_sidebar( 'footer-widgets' ); ?>
					<?php do_action( 'foundationpress_after_footer' ); ?>
				</footer>
			<?php endif; ?>
			<div class="copyright"> &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> </div>
		</div>

		<?php do_action( 'foundationpress_layout_end' ); ?>

<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
		</div><!-- Close off-canvas wrapper inner -->
	</div><!-- Close off-canvas wrapper -->
</div><!-- Close off-canvas content wrapper -->
<?php endif; ?>


<?php wp_footer(); ?>
<?php do_action( 'foundationpress_before_closing_body' ); ?>
</body>
</html>
