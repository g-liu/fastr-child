<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package fastr-child
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="main" class="site-main" role="main">

			<section class="error-404 not-found">

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Try the search bar below!', 'fastr-child' ); ?></p>

					<?php get_search_form(); ?>

					<p><a href="<?php echo get_home_url(); ?>">&larr; Back to Home Page</a></p>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</div><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>