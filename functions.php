<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

function enqueue_parent_theme_style() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_parent_theme_style' );

function additional_styles_and_scripts() {
	wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );
}
add_action( 'wp_enqueue_scripts', 'additional_styles_and_scripts' );

function custom_excerpt_length( $length ) {
	return 60;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
 * Register widgetized area and update sidebar with default widgets.
 * This will replace "BottomBar" the parent theme
 */
function fastr_child_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer left', 'fastr-child' ),
		'id'            => 'sidebar-far-left',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer center left', 'fastr-child' ),
		'id'            => 'sidebar-left',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer center right', 'fastr-child' ),
		'id'            => 'sidebar-right',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer right', 'fastr-child' ),
		'id'            => 'sidebar-far-right',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'fastr_child_widgets_init' );

if ( file_exists( get_stylesheet_directory() . '/inc/template-tags.php' ) )
	require get_stylesheet_directory() . '/inc/template-tags.php';

add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-header', array(
	'width' => 1400,
	'height' => 500,
	'flex-height' => true,
	'flex-width' => true,
	'default-text-color' => '#fff',
) );

add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'caption' ) );


/**
 * Retrieves the first image from a post
 *
 * @see http://www.wprecipes.com/how-to-get-the-first-image-from-the-post-and-display-it
 *
 * @return the HTML tag of the first image if post contains one or more images; false otherwise
 */
function catch_that_image() {
	global $post, $posts;
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
