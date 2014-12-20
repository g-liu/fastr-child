<?php
/**
 * Displays an archive of all posts given any author.
 *
 * @package fastr-child
 */

get_header( 'author' ); ?>

	<div id="primary" class="content-area">
		<div id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content' );
				?>

			<?php endwhile; ?>

			<nav class="page-links">
				<?php
					echo paginate_links( array(
						'format' => 'page/%#%',
					) );
				?>
			</nav><!-- #page-links -->

		<?php else : ?>

			<?php $author = get_queried_object(); ?>

			<section class="no-results">
				<header class="page-header">
					<h2 class="page-title"><?php _e( 'No posts... yet!', 'fastr-child' ); ?></h2>
				</header><!-- .page-header -->

				<div class="page-content">
					<p>Looks like <?php echo $author ? $author->display_name : 'the author'; ?> hasn't posted anything yet. Check back soon!</p>
				</div><!-- .page-content -->
			</section><!-- .no-results -->

		<?php endif; ?>

		</div><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
