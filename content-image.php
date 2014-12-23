<?php
/**
 * The template used for displaying image attachments in image.php
 *
 * @package fastr
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<div class="entry-attachment">
			<div class="attachment">
				<a href="<?php echo wp_get_attachment_url(); ?>">
					<?php echo wp_get_attachment_image( get_the_ID(), 'full' ); ?>
				</a>
			</div><!-- .attachment -->

			<?php if ( has_excerpt() ) : ?>
			<div class="entry-caption">
				<?php the_excerpt(); ?>
			</div><!-- .entry-caption -->
			<?php endif; ?>
		</div><!-- .entry-attachment -->

		<?php
			fastr_link_pages( array(
				'before' => '<nav class="page-links">',
				'after'  => '</nav>',
				'link_before' => '<span>',
				'link_after' => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
