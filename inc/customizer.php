<?php

function fastr_child_customize_register( $wp_customize ) {
	$wp_customize->add_setting( 'header_color' , array(
		'default' => '#333333',
	) );
	$wp_customize->add_setting( 'tagline_textcolor', array(
		'default' => '#EEEEEE',
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
}
add_action( 'customize_register', 'fastr_child_customize_register' );