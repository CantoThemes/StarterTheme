<?php
/**
 * _s Theme Metaboxes.
 *
 * @package _s
 */

// Test data should be removed at development
$_s_post_meta_options = array(
	'id' => '_s_test_meta',
	'title' => __('Test Metabox2', 'textdomain'),
	'post_type' => array('post', 'page'),
	'options' => array(
		array(
			'id' => 'ctfif_tst_text',
			'label'    => __( 'Text Input', 'mytheme' ),
			'subtitle'    => __( 'Lorem ipsum dolor sit amet', 'mytheme' ),
			'type'     => 'text',
			'default' => 'Test Text',
		),
	)
);


if( class_exists('CantoMetabox') ){
	CantoMetabox::add_metabox($_s_post_meta_options);
}
