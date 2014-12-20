<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package fastr
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'search' ); ?>

			<?php endwhile; ?>

			<nav class="page-links">
				<?php
					echo paginate_links( array(
						'format' => 'page/%#%',
						'add_args' => array(
							's' => get_search_query(),
						),
					) );
				?>
			</nav><!-- #page-links -->

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
