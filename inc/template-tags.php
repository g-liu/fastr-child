<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package fastr-child
 */

if ( ! function_exists( 'fastr_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function fastr_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h3 class="screen-reader-text"><?php _e( 'Posts navigation', 'fastr' ); ?></h3>
		<div class="nav-links">
			<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'fastr' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'fastr' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'fastr_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function fastr_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h3 class="screen-reader-text"><?php _e( 'Post navigation', 'fastr' ); ?></h3>
		<div class="nav-links">
			<?php if ( $previous ) : ?>
				<div class="nav-previous">
					<div class="nav-previous-label">
						<span>Previous post</span>
					</div>
					<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'fastr' ) ); ?>
				</div>
			<?php endif; ?>

			<?php if ( $next ) : ?>
				<div class="nav-next">
					<div class="nav-next-label">
						<span>Next post</span>
					</div>
					<?php next_post_link(     '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'fastr' ) ); ?>
				</div>
			<?php endif; ?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;


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
					'reply_text' => 'Reply &darr;',
					'after'      => '</div>',
				) ) );
			?>
			<?php edit_comment_link( __( 'Edit', 'fastr' ), '<span class="edit-link">', '</span>' ); ?>
		</article><!-- #div-comment-##.comment-body -->

	<?php
	endif;
}

endif;


if ( ! function_exists( 'fastr_comment_nav' ) ) :
/**
 * Displays comment navigation for comments
 */
function fastr_comment_nav() {
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h3 class="screen-reader-text"><?php _e( 'Comment navigation', 'fastr' ); ?></h3>
			<div class="nav-links">
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'fastr' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'fastr' ) ); ?></div>
			</div>
		</nav><!-- #comment-nav-below -->
	<?php endif;
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

if ( ! function_exists( 'get_first_attachment_metadata' ) ) :
/**
 * Retrieves the metadata for the first attachment to a post
 * 
 * @return an array of the same format as wp_get_attachment_metadata(), or false if no attachments
 */
function fastr_get_first_attachment_metadata() {
	global $post;
	$attachments = get_posts( array(
		'post_type' => 'attachment',
		'posts_per_page' => -1,
		'post_parent' => $post->ID,
		'exclude' => get_post_thumbnail_id(),
	) );

	if ( $attachments && array_key_exists( 0, $attachments ) ) {
		return wp_get_attachment_metadata( $attachments[0]->ID );
	}
	return false;
}
endif;


if ( ! function_exists( 'get_first_image' ) ) :
/**
 * Retrieves the first image from a post
 *
 * @see http://www.wprecipes.com/how-to-get-the-first-image-from-the-post-and-display-it
 *
 * @return HTML element of the image
 */
function fastr_get_first_image() {
	global $post;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all( '/(<img.+src=[\'"][^\'"]+[\'"].*>)/i', $post->post_content, $matches );
	$first_img = $matches[1][0];

	if ( empty( $first_img ) ) {
		$first_img = false;
	}
	return $first_img;
}
endif;


if ( ! function_exists( 'fastr_post_format_to_fa' ) ) :
/**
 * Converts a post format string to a font-awesome icon
 * 
 * @see http://fontawesome.io/icons
 * 
 * @param {string} $format - the post format
 *
 * @return an HTML string containing the font-awesome icon, or empty string
 * 	if no associated genericon
 */
function fastr_post_format_to_fa( $format = '' ) {
	switch ( $format ) {
		case 'aside' : $genericon_name = 'paint-brush'; break;
		case 'chat' : $genericon_name = 'comments'; break;
		case 'gallery' : $genericon_name = 'picture-o'; break;
		case 'link' : $genericon_name = 'link'; break;
		case 'image' : $genericon_name = 'image'; break;
		case 'quote' : $genericon_name = 'quote-right'; break;
		case 'status' : $genericon_name = 'comment'; break;
		case 'video' : $genericon_name = 'film'; break;
		case 'audio' : $genericon_name = 'volume-up'; break;
		default : $genericon_name = false; break;
	}

	if ( $genericon_name ) {
		return sprintf( '<span class="fa fa-%s"></span>', $genericon_name );
	}
	return '';
}
endif;
