<?php

/**
 * Register all settings, sections, and controls for the theme
 *
 * @param object $wp_customize The wp-customize callback object.
 */
function fastr_child_customize_register( $wp_customize ) {
	$wp_customize->add_setting( 'header_color' , array(
		'default' => '#333333',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_setting( 'tagline_textcolor', array(
		'default' => '#EEEEEE',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_color',
			array(
				'label'    => __( 'Header color', 'fastr-child' ),
				'section'  => 'colors',
				'settings' => 'header_color',
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'tagline_textcolor',
			array(
				'label'    => __( 'Tagline text color', 'fastr-child' ),
				'section'  => 'colors',
				'settings' => 'tagline_textcolor',
			)
		)
	);

	if ( ! get_theme_mod( 'header_color' ) ) {
		set_theme_mod( 'header_color', '#333333' );
	}
	if ( ! get_theme_mod( 'tagline_textcolor' ) ) {
		set_theme_mod( 'tagline_textcolor', '#EEEEEE' );
	}
}
add_action( 'customize_register', 'fastr_child_customize_register' );


if ( ! function_exists( 'sanitize_hex_color' ) ) :
/**
 * Sanitize a generic hex color
 *
 * @param string $color The color to be sanitized.
 *
 * @return string The sanitized color.
 */
function sanitize_hex_color( $color ) {
	if ( $color[0] != '#' ) {
		$color = '#' . $color;
	}
	if ( ! preg_match( '/(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i', $color ) ) {
		return '#000000';
	}
	return $color;
}
endif;
