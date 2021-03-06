<?php

require_once get_stylesheet_directory() . '/inc/template-tags.php';
require_once get_stylesheet_directory() . '/inc/customizer.php';

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
	/** font-awesome fonticons */
	wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );

	/** print styles */
	wp_enqueue_style( 'print-styles', get_stylesheet_directory_uri() . '/print.css', array( 'fastr-style' ), false, 'print' );

	/** theme javascript */
	wp_enqueue_script( 'core-javascript', get_stylesheet_directory_uri() . '/js/fastr-child.js', array( 'jquery-core' ), false, true );
}
endif;
add_action( 'wp_enqueue_scripts', 'additional_styles_and_scripts' );


if ( ! function_exists( 'custom_excerpt_length' ) ) :

/**
 * Redefine the excerpt length in words
 *
 * @param string $length The maximum length of the excerpt in words.
 */
function custom_excerpt_length( $length ) {
	return 60;
}
endif;
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


if ( ! function_exists( 'fastr_child_add_search_box' ) ) :
/**
 * Adds a search box and a mobile-only label to the navigation menu
 *
 * @see http://www.wprecipes.com/how-to-automatically-add-a-search-field-to-your-navigation-menu
 *
 * @param string $items The existing navigation bar items.
 *
 * @param mixed[] $args Any additional arguments.
 */
function fastr_child_add_search_box( $items, $args ) {
	$items = '<li id="menu-item-mobile-only" class="menu-item menu-item-mobile-only"><span>Navigation</span></li>' . $items;
	$items .= '<li id="menu-item-search" class="menu-item menu-item-search">' . get_search_form( false ) . '</li>';
	return $items;
}
add_filter( 'wp_nav_menu_items', 'fastr_child_add_search_box', 10, 2 );
endif;


if ( ! function_exists( 'fastr_child_widgets_init' ) ) :

/**
 * Register widgetized area and update sidebar with default widgets.
 *  This will replace "BottomBar" the parent theme
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
	add_theme_support( 'title-tag' );

	add_editor_style( array( 'css/editor-style.css' ) );
	
	remove_filter( 'wp_title', 'fastr_wp_title' );
}
endif;
add_action( 'after_setup_theme', 'fastr_child_theme_setup' );


if ( ! function_exists( '_wp_render_title_tag' ) ) :
/**
 * Backwards compatibility with title suppot
 * 
 * @see https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
 */
function theme_slug_render_title() {
?>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
}
add_action( 'wp_head', 'theme_slug_render_title' );
endif;
