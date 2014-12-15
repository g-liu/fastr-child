<?php
# error_reporting( E_ALL );
# ini_set( "display_errors", 1 );

function enqueue_parent_theme_style() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_parent_theme_style' );

if ( file_exists( get_stylesheet_directory() . '/inc/template-tags.php' ) )
	require get_stylesheet_directory() . '/inc/template-tags.php';
