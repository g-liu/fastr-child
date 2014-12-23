<?php
/**
 * @package fastr-child
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			fastr_link_pages( array(
				'before' => '<div class="nav-links">',
				'after'  => '</div>',
				'link_before' => '<span>',
				'link_after' => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php fastr_author_info(); ?>

</article><!-- #post-## -->
