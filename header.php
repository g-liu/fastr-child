<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package fastr
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<?php do_action( 'before' ); ?>
		<header id="masthead" class="site-header" role="banner">
			<?php if ( ! is_home() ) : ?>
				<div id="top-strip">
					<div class="site-title">
						<span>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						</span>
					</div>

					<nav></nav>
				</div>
			<?php endif; ?>

			<div class="container">	
				<?php if( is_home() ) : ?>
					<div class="site-branding text-center">
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
					</div>
				<?php else: ?>
					<div class="text-center">
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
									printf( __( 'Day: %s', 'fastr' ), '<span>' . get_the_date() . '</span>' );

								elseif ( is_month() ) :
									printf( __( 'Month: %s', 'fastr' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

								elseif ( is_year() ) :
									printf( __( 'Year: %s', 'fastr' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

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
								
								elseif ( is_single() ) :
									_e( get_the_title(), 'fastr' );

								else :
									_e( 'Archives', 'fastr' );

								endif;
							?>
						</h1>
						<?php
							// Show an optional term description.
							$term_description = term_description();
							if ( ! empty( $term_description ) ) :
								printf( '<div class="taxonomy-description">%s</div>', $term_description );
							endif;
						?>
					</div>
				<?php endif; ?>
			</div>
		</header><!-- #masthead -->

		<div id="content" class="site-content container">
