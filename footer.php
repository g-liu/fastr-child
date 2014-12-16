<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package fastr
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<a class="back-to-top" href="#">&uarr;</a>
		<div class="container wide row">
			<div class="col col-1-4">
				<?php if ( ! dynamic_sidebar( 'sidebar-far-left' ) ) : ?>

				<?php endif; ?>
			</div>
			<div class="col col-1-4">
				<?php if ( ! dynamic_sidebar( 'sidebar-left' ) ) : ?>

				<?php endif; ?>
			</div>
			<div class="col col-1-4">
				<?php if ( ! dynamic_sidebar( 'sidebar-right' ) ) : ?>

				<?php endif; ?>
			</div>
			<div class="col col-1-4">
				<?php if ( ! dynamic_sidebar( 'sidebar-far-right' ) ) : ?>

				<?php endif; ?>
			</div>
		</div><!-- .container.wide -->
		<div class="container">
			<div class="site-info text-center">
				<?php do_action( 'fastr_credits' ); ?>
				<?php printf( __( 'Proudly powered by %s', 'fastr' ), '<a href="http://wordpress.org/" rel="generator"  target="_blank">WordPress</a>' ); ?>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>