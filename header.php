<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package fastr-child
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<?php
			do_action( 'before' );
			$url = get_header_image();
			$post_header_url = $post ? wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) : false;
			if( $url ) {
				$url = $post_header_url ? $post_header_url : $url;
			}
			else {
				$url = $post_header_url && ! ( is_home() || is_archive() ) ? $post_header_url : false;
			}
		?>
		<header id="masthead" class="site-header"<?php echo $url ? ' style="background-image:url(\'' . $url . '\')"' : '' ?> role="banner">
			<div id="top-strip">
				<?php if ( ! is_home() ) : ?>
					<div class="site-title">
						<span>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						</span>
					</div>
				<?php endif; ?>

				<nav id="site-navigation" class="main-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				</nav><!-- #site-navigation -->
			</div>

			<div class="container narrow">	
				<?php if( is_home() ) : ?>
					<div class="site-branding text-center">
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
					</div>
				<?php else: ?>
					<h1 class="page-title">
						<?php
							if ( is_category() ) :
								single_cat_title( ':' );

							elseif ( is_tag() ) :
								single_tag_title( '#' );

							elseif ( is_author() ) :
								/* Queue the first post, that way we know
								 * what author we're dealing with (if that is the case).
								*/
								the_post();
								printf( __( 'Author: %s', 'fastr' ), '<span class="vcard">' . get_the_author() . '</span>' );
								/* Since we called the_post() above, we need to
								 * rewind the loop back to the beginning that way
								 * we can run the loop properly, in full.
								 */
								rewind_posts();

							elseif ( is_day() ) :
								printf( __( 'Posts from %s', 'fastr-child' ), '<span>' . get_the_date() . '</span>' );

							elseif ( is_month() ) :
								printf( __( 'Posts from %s', 'fastr-child' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

							elseif ( is_year() ) :
								printf( __( 'Posts from %s', 'fastr-child' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

							elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
								_e( 'Asides', 'fastr' );

							elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
								_e( 'Images', 'fastr');

							elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
								_e( 'Videos', 'fastr' );

							elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
								_e( 'Quotes', 'fastr' );

							elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
								_e( 'Links', 'fastr' );

							elseif ( is_attachment() ) :
								# _e( sprintf( 'Attachment: %s', get_the_title() ), 'fastr-child' );
								echo '<span class="fa fa-paperclip"></span> ' . get_the_title();
							
							elseif ( is_single() || is_page() ) :
								the_title();

							elseif ( is_search() ) :
								_e( sprintf( 'Results for "%s"', get_search_query() ), 'fastr-child' );

							elseif ( is_404() ) :
								_e( 'Oops! That page can&rsquo;t be found.', 'fastr' );

							else :
								_e( 'Archives', 'fastr' );

							endif;
						?>
					</h1><!-- #page-title -->

					<div class="entry-meta">
						<?php if ( is_single() || is_page() ) : ?>
							<div class="meta-date">
								<?php fastr_posted_on(); ?>
							</div>
							<?php
								/* translators: used between list items, there is a space after the comma */
								$categories_list = get_the_category_list( __( ', ', 'fastr' ) );
								if ( $categories_list && fastr_categorized_blog() ) :
							?>
								<div class="cat-links">
									<span class="fa fa-folder-o"></span>
									<?php printf( '%1$s', $categories_list ); ?>
								</div>
							<?php endif; // End if categories ?>
							<?php
								/* translators: used between list items, there is a space after the comma */
								$tags_list = get_the_tag_list( '', __( ', ', 'fastr' ) );
								if ( $tags_list ) :
							?>
								<div class="tags-links">
									<span class="fa fa-tags"></span>
									<?php printf( '%1$s', $tags_list ); ?>
								</div>
							<?php endif; // End if $tags_list ?>
						<?php endif; // End if single ?>
						
						<?php
							// Show an optional term description.
							$term_description = term_description();
							if ( ! empty( $term_description ) ) :
								printf( '<div class="taxonomy-description">%s</div>', $term_description );
							endif;
						?>

					</div><!-- .entry-meta -->
				<?php endif; ?>
			</div>
		</header><!-- #masthead -->

		<div id="content" class="site-content container">
