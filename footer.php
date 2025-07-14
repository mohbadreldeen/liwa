<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package liwa
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="container footer-widgets">
			<div class="footer-column">
				<?php if ( is_active_sidebar( 'footer-column-1' ) ) : ?>
					<div class="footer-column">
						<?php dynamic_sidebar( 'footer-column-1' ); ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="footer-column">
				<?php if ( is_active_sidebar( 'footer-column-2' ) ) : ?>
					<div class="footer-column">
						<?php dynamic_sidebar( 'footer-column-2' ); ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="footer-column">
				<?php if ( is_active_sidebar( 'footer-column-3' ) ) : ?>
					<div class="footer-column">
						<?php dynamic_sidebar( 'footer-column-3' ); ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="footer-column">
				<?php if ( is_active_sidebar( 'footer-column-4' ) ) : ?>
					<div class="footer-column">
						<?php dynamic_sidebar( 'footer-column-4' ); ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="footer-column">
				<?php if ( is_active_sidebar( 'footer-column-5' ) ) : ?>
					<div class="footer-column">
						<?php dynamic_sidebar( 'footer-column-5' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	 
	</footer><!-- #colophon -->
	<?php if ( is_active_sidebar( 'footer-bottom' ) ) : ?>
	<footer class="bottom-footer">
		<div class="container">
			<div class="footer-widgets">
					<?php dynamic_sidebar( 'footer-bottom' ); ?>
			</div>
		</div>
	</footer>
	<?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
