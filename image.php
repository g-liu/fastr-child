<?php
/**
 * The Template for displaying all image attachments.
 *
 * @package fastr-child
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'image' ); ?>

			<?php fastr_post_nav(); ?>

			<?php comments_template(); ?>

		<?php endwhile; // end of the loop. ?>

		</div><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
