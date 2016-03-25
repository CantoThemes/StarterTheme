<?php
/**
 * _s Theme Customizer.
 *
 * @package _s
 */

$options = array();

// Should be removed these controls
// Direct "Section > Control" Example
$options[] = array(
	'id'				=> 'direct_section_example',
	'priority'			=> 10,
	'title'				=> __('Direct Section Example'),
	'description'		=> __('Without panel. Directly section example.'),
	'active_callback'	=> '',
	'options'			=> array(
		array(
			'setting' => array(
				'id'		=> 'test_option_2',
				'default'	=> 'Test Feild',
				'type'		=> 'theme_mod',
				'transport'	=> 'postMessage'
			),
			'control' => array(
				'label'		=> __( 'Example Control', 'mytheme' ),
				'subtitle'	=> __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
				'type'		=> 'text'
			),
		),
	)
);

if (class_exists('CTF_Customizer')) {
	$args = array(
		'opt_name' => 'test_opt'
	);
	new CTF_Customizer($args, $options);
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function _s_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', '_s_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function _s_customize_preview_js() {
	wp_enqueue_script( '_s_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', '_s_customize_preview_js' );
