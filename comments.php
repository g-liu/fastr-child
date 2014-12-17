<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to fastr_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package fastr-child
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">


	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'fastr' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>
	<?php endif; ?>

	<?php
		// If comments are closed, let's leave a little note, shall we?
		if ( ! comments_open() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'fastr' ); ?></p>
	<?php endif; ?>

	<?php if ( have_comments() ) : ?>

		<ol class="comment-list">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use fastr_comment() to format the comments.
				 * If you want to override this in a child theme, then you can
				 * define fastr_comment() and that will be used instead.
				 * See fastr_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array( 'callback' => 'fastr_comment' ) );
			?>
		</ol><!-- .comment-list -->

		<?php fastr_comment_nav(); ?>

	<?php endif; // have_comments() ?>


	<?php comment_form( array(
			'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
			'<p class="form-allowed-tags">' . sprintf( __( 'Allowed <abbr title="HyperText Markup Language">HTML</abbr> tags: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
		) );
	?>

</div><!-- #comments -->
