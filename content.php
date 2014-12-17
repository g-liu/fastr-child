<?php
/**
 * @package fastr
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
        <?php if ( get_post_type() === 'post' ) : ?>
		<div class="entry-meta">
			<div class="meta-date"><a href="<?php the_permalink(); ?>"><?php fastr_posted_on(); ?></a></div>
			<div class="meta-author">
				<span class="fa fa-user"></span>
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
					<cite role="author"><?php the_author(); ?></cite>
				</a>
			</div><!-- .meta-author -->
		</div><!-- .entry-meta -->
		<?php endif; ?>

		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>		
	</header><!-- .entry-header -->

	
	<div class="entry-summary">
        <?php
			if ( get_post_format() === 'image' ) : # show the first image instead
				$first_img = catch_that_image();
				if ( $first_img ) : ?>
					<a href="<?php the_permalink(); ?>"><?php echo $first_img; ?></a>
				<?php endif;
			else :
	        	the_excerpt();
	        endif;
        ?>
	</div><!-- .entry-summary -->
</article><!-- #post-## -->
