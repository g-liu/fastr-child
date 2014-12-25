<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package fastr-child
 */

// count number of active sidebars. this determines the columning of the footer widget area
$widget_areas = array( 'sidebar-far-left', 'sidebar-left', 'sidebar-right', 'sidebar-far-right' );
$widget_active = array();
foreach ( $widget_areas as $key=>$area ) {
	if ( is_active_sidebar( $area ) )
		$widget_active[] = $area;
}
$cols = count( $widget_active );
$width = "";
switch( $cols ) {
	case 0:
	case 1:
	case 2: $width = " narrow"; break;
	case 4: $width = " wide"; break;
	default: "";
}

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<a class="back-to-top" href="#">&uarr;</a>
		<?php if ( $cols ) : ?>
			<div class="container<?php echo $width; ?> row">
				<?php foreach ( $widget_active as $key => $active ) : ?>
					<div class="col col-1-<?php echo $cols; ?>">
						<?php if ( ! dynamic_sidebar( $active ) ) : ?>

						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div><!-- .container.wide -->
		<?php endif; ?>
		<div class="container">
			<div class="site-info text-center">
				<?php do_action( 'fastr_credits' ); ?>
				<?php printf( __( 'Proudly powered by %s', 'fastr' ), '<a href="http://wordpress.org/" target="_blank">WordPress</a>' ); ?>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>