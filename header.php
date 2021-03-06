<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package fastr-child
 */

	$header_text_color = get_theme_mod( 'header_textcolor', 'inherit' );
	$header_bg_color = get_theme_mod( 'header_color', 'inherit' );
	$tagline_text_color = get_theme_mod( 'tagline_textcolor', 'inherit' );
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<?php
			do_action( 'before' );
			$url = get_header_image();

			if ( is_singular() ) {
				// show featured image instead for single posts and pages
				$post_header_url = $post ? wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) : false;
				$url = $post_header_url;
			}
		?>


		<div id="top-strip">
			<?php if ( ! is_home() ) : ?>
				<div class="site-title">
					<span>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</span>
				</div>
			<?php endif; ?>

			<button id="menu-toggle"><span class="fa fa-bars fa-lg"></span></button>

			<div id="sidebar-cover"></div>
			
			<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container' => 'nav',
					'fallback_cb' => false, # show nothing if no menu is set as "primary"
				) );
			?>
		</div>

		<header id="masthead" class="site-header" style="background-color:<?php echo $header_bg_color; ?>;<?php echo $url ? 'background-image:url(\'' . $url . '\');' : '' ?>" role="banner">

			<div class="container">

				<?php if ( is_home() ) : ?>
					<div class="site-branding text-center">
						<h1 class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color: #<?php echo $header_text_color; ?>;" rel="home">
								<?php bloginfo( 'name' ); ?>
							</a>
						</h1>
						<h2 class="site-description" style="color:<?php echo $tagline_text_color; ?>"><?php bloginfo( 'description' ); ?></h2>
					</div>
				<?php else : ?>
					<?php if ( is_author() ) : ?>
						<div class="gravatar author-avatar">
							<?php
								$author = get_queried_object(); # works around edge case where author has no post
								if ( $author ) {
									echo get_avatar( $author->ID, 128, 'mm' );
								}
							?>
						</div>
					<?php endif; ?>
					<h1 class="page-title">
						<?php
							if ( is_category() ) :
								single_cat_title( ':' );

							elseif ( is_tag() ) :
								single_tag_title( '#' );

							elseif ( is_author() ) :
								$author = get_queried_object();
								printf( __( 'Posts by %s', 'fastr-child' ), '<span class="vcard">' . ( $author ? $author->display_name : 'the author' ) . '</span>' );

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
								echo '<span class="fa fa-paperclip"></span> ' . get_the_title();
							
							elseif ( is_single() || is_page() ) :
								echo fastr_post_format_to_fa( get_post_format() ) . ' ' . get_the_title();

							elseif ( is_search() ) :
								_e( sprintf( 'Results for "%s"', get_search_query() ), 'fastr-child' );

							elseif ( is_404() ) :
								_e( '404: File not found', 'fastr' );

							else :
								_e( 'Archives', 'fastr' );

							endif;
						?>
					</h1><!-- #page-title -->

					<div class="entry-meta">
						<?php if ( is_single() || is_page() && ! is_front_page() ) : ?>
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
							elseif ( is_author() ) :
								$author = get_queried_object();
								if ( $author && ! empty ( $author->description ) ) :
									// show the author's biography
									printf( '<div class="taxonomy-description">%s</div>', $author->description );
								endif;
								
							endif;
						?>

					</div><!-- .entry-meta -->
				<?php endif; ?>

			</div><!-- .container.narrow -->
			
		</header><!-- #masthead -->

		<div id="content" class="site-content container">

