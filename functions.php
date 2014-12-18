<?php

if ( file_exists( get_stylesheet_directory() . '/inc/template-tags.php' ) ) {
	require get_stylesheet_directory() . '/inc/template-tags.php';
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 960; /* pixels */
}


if ( ! function_exists( 'enqueue_parent_theme_style' ) ) :

/**
 * Enqueue the parent theme's style.css file
 */
function enqueue_parent_theme_style() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
endif;
add_action( 'wp_enqueue_scripts', 'enqueue_parent_theme_style' );


if ( ! function_exists( 'additional_styles_and_scripts' ) ) :

/**
 * Add any additional styles and scripts used by this theme
 */
function additional_styles_and_scripts() {
	wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );
}
endif;
add_action( 'wp_enqueue_scripts', 'additional_styles_and_scripts' );


if ( ! function_exists( 'custom_excerpt_length' ) ) :

/**
 * Redefine the excerpt length in words
 *
 * @param {string} $length - the maximum length of the excerpt in words
 */
function custom_excerpt_length( $length ) {
	return 60;
}
endif;
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


if ( ! function_exists( 'fastr_child_widgets_init' ) ) :

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
endif;
add_action( 'widgets_init', 'fastr_child_widgets_init' );


if ( ! function_exists( 'fastr_child_theme_setup' ) ) :
/**
 * Add additional theme features
 */
function fastr_child_theme_setup() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header', array(
		'flex-height' => true,
		'flex-width' => true,
		'default-text-color' => '#fff',
	) );

	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'caption' ) );
}
endif;
add_action( 'after_setup_theme', 'fastr_child_theme_setup' );
