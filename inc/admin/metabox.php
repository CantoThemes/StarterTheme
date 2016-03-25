<?php
/**
 * _s Theme Metaboxes.
 *
 * @package _s
 */

// Test data should be removed at development
$_s_post_meta_options = array(
	'id' => '_s_test_meta',
	'title' => esc_html__('Test Metabox2', '_s'),
	'post_type' => array('post', 'page'),
	'options' => array(
		array(
			'id' => 'ctfif_tst_text',
			'label'    => esc_html__( 'Text Input', '_s' ),
			'subtitle'    => esc_html__( 'Lorem ipsum dolor sit amet', '_s' ),
			'type'     => 'text',
			'default' => 'Test Text',
		),
	)
);


if( class_exists('CantoMetabox') ){
	CantoMetabox::add_metabox($_s_post_meta_options);
}
