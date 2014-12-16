<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package fastr-child
 */

if ( ! function_exists( 'fastr_comment' ) ) :

/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function fastr_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<div class="comment-body">
				<?php _e( 'Pingback:', 'fastr' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'fastr' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						if ( 0 != $args['avatar_size'] ) {
							echo get_avatar( $comment, 64 );
						}
						printf( '<cite class="fn">%s</cite>', get_comment_author_link() );
					?>
					<time datetime="<?php comment_time( 'c' ); ?>">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'fastr' ), get_comment_date(), get_comment_time() ); ?>
						</a>
					</time>				
				</div><!-- .comment-author -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'fastr' ); ?></p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php
				comment_reply_link( array_merge( $args, array(
					'add_below'  => 'div-comment',
					'depth'      => $depth,
					'max_depth'  => $args['max_depth'],
					'before'     => '<div class="reply">',
					'reply_text' => 'Reply ↓',
					'after'      => '</div>',
				) ) );
			?>
			<?php edit_comment_link( __( 'Edit', 'fastr' ), '<span class="edit-link">', '</span>' ); ?>
		</article><!-- #div-comment-##.comment-body -->

	<?php
	endif;
}

endif;

if ( ! function_exists( 'fastr_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function fastr_posted_on() {
	$time_string = '<span class="fa fa-clock-o"></span> <time class="entry-date published" datetime="%1$s">%2$s at %3$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_html( get_the_time() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">%1$s</span>', 'fastr' ), $time_string);
}
endif;
