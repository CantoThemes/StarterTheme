<?php

if ( ! class_exists( 'CTF_Customizer' ) ) :

/**
* 
*/
class CTF_Customizer
{

	public $wp_customize;

	public $options = array();
	
	public $args = array();
	
	function __construct( $args = array(), $options = array() )
	{
		global $wp_customize;

		$this->wp_customize = $wp_customize;
		$this->args = $args;
		$this->options = $options;

		if ( ! class_exists( 'WP_Customize_Control' ) ) {
			require_once( ABSPATH . WPINC . '/class-wp-customize-control.php' );
		}
		require_once CTF_PATH .'core/customizer/CustomizeControl.class.php';

		add_action( 'customize_controls_enqueue_scripts', array( $this, 'customizer_scripts' ), 100 );

		add_action( 'customize_controls_print_footer_scripts', array( $this, 'register_customizer_controls' ), 10 );

		add_action( 'customize_register', array($this, 'add_options') );
		
		add_filter( 'ctf_before_pass_args', array($this, 'add_editor_controll_options') );
	}


	public function customizer_scripts()
	{
		wp_enqueue_style( 'ctf-roboto-font', '//fonts.googleapis.com/css?family=Roboto:400,900italic,900,700italic,700,500italic,500,400italic,300italic,300,100italic,100' );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'editor-buttons' );
		wp_enqueue_style( 'ctf-selectize', CTF_URL.'assets/vendor/selectize/css/selectize.css' );
		wp_enqueue_style( 'ctf-font-awesome', CTF_URL.'assets/vendor/font-awesome/css/font-awesome.min.css' );
		wp_enqueue_style( 'ctf-customizer', CTF_URL.'core/customizer/assets/css/customizer.css', array('customize-controls', 'ctf-selectize') );

		$dependency = array(
			'jquery',
			'customize-base',
			'jquery-ui-core',
			'jquery-ui-button',
			'jquery-ui-sortable',
			'jquery-ui-spinner',
			'customize-controls',
			'ctf-selectize',
			'wp-color-picker'
		);
		wp_enqueue_script( 'editor' );
		wp_enqueue_script( 'quicktags' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_media();
		wp_enqueue_script('ctf-selectize', CTF_URL.'assets/vendor/selectize/js/standalone/selectize.min.js', array('jquery'));
		wp_enqueue_script('ctf-tinymce', includes_url( 'js/tinymce' ).'/tinymce.min.js', array('jquery'));
		wp_enqueue_script('ctf-tinymce-compat3x', includes_url( 'js/tinymce' ).'/plugins/compat3x/plugin.min.js', array('jquery'));
		wp_enqueue_script('ctf-customizer', CTF_URL.'core/customizer/assets/js/customizer.js', $dependency);

		$ctf_google_fonts_json = array(
			'l10n_print_after' => 'ctf_google_fonts = ' . CTF_Help::get_google_font_json(),
		);
		wp_localize_script('ctf-customizer', 'ctf_google_fonts', $ctf_google_fonts_json);
		
		$ctf_fa_icons_json = array(
			'l10n_print_after' => 'ctf_fa_icons = ' . CTF_Help::get_icons_json(),
		);
		wp_localize_script('ctf-customizer', 'ctf_fa_icons', $ctf_fa_icons_json);
	}
	
	public function add_editor_controll_options( $args )
	{
		if($args['type'] == 'editor'){
			$args['choices']['content_css'] = includes_url( "css/dashicons.min.css" ).','.includes_url( 'js/tinymce' ).'/skins/wordpress/wp-content.css';
			$args['choices']['plugins'] = 'colorpicker,lists,fullscreen,image,wordpress,wpeditimage,wplink';
		}
		
		return $args;
	}

	public function register_customizer_controls()
	{
		global $wp_customize;
		/*$all_fields = array(
			'text',
			'text_multi',
			'textarea',
			'email',
			'number',
			'dimension',
			'range',
			'password',
			'url',
			'select',
			'radio',
			'radio_image',
			'radio_button',
			'checkbox',
			'checkbox_image',
			'checkbox_button',
			'color',
			'color_rgba',
			'google_font',
			'font_style',
			'text_align',
			'icon',
			'image',
			'editor',
			'image_multi'
		);*/
		
		$all_fields = CTF_Help::get_all_fields_name();

		foreach ($all_fields as $field) {
			$control = new CTF_Customize_Control( $wp_customize, 'temp', array('type' => $field) );

			$control->print_template();
		}
	}

	public function add_options( $wp_customize )
	{
		if ( is_array($this->options) && count($this->options) ) {
			foreach ( $this->options as $option ) {
				if ( is_array($option) && isset($option['sections']) ) {
					$this->panel_section_option( $wp_customize, $option );
				} else if ( is_array($option) ){
					$this->section_option( $wp_customize, $option );
				}
			}
		}
	}

	public function panel_section_option( $manager, $panel )
	{
		if ( is_array($panel) ) {

			$panel_id = $panel['id'];
			// $panel_id = $panel['sections'];
			$panel_args = $panel;
			unset($panel_args['id']);
			unset($panel_args['sections']);

			$manager->add_panel( $panel_id, $panel_args );

			foreach ( $panel['sections'] as $section ) {
				if ( is_array($section) ) {

					$section_id = $section['id'];
					$section_args = $section;

					unset($section_args['id']);
					unset($section_args['options']);

					$section_args['panel'] = $panel_id;

					$manager->add_section( $section_id, $section_args );
					
					if( isset($section['options']) && is_array($section['options']) && count($section['options']) ){
						foreach ($section['options'] as $field) {
							if (isset($field['setting']) && isset($field['control'])) {

								$setting_id = (isset($this->args['opt_name']) && !empty($this->args['opt_name'])) ? $this->args['opt_name'].'['.$field['setting']['id'].']' : $field['setting']['id'];
								$setting_args = $field['setting'];

								unset($setting_args['is']);

								$manager->add_setting( $setting_id, $setting_args );

								$control_id = $field['setting']['id'];
								$control_args = $field['control'];
								$control_args['section'] = $section_id;
								$control_args['settings'] = $setting_id;

								$manager->add_control( new CTF_Customize_Control( $manager, $control_id, $control_args ) );


							}
						}
					}
				}
			}
		}
	}



	public function section_option( $manager, $section )
	{
		if ( is_array($section) ) {

			$section_id = $section['id'];
			$section_args = $section;

			unset($section_args['id']);
			unset($section_args['options']);

			$manager->add_section( $section_id, $section_args );
			
			if( isset($section['options']) && is_array($section['options']) && count($section['options']) ){
				foreach ($section['options'] as $field) {
					if (isset($field['setting']) && isset($field['control'])) {

						$setting_id = (isset($this->args['opt_name']) && !empty($this->args['opt_name'])) ? $this->args['opt_name'].'['.$field['setting']['id'].']' : $field['setting']['id'];
						$setting_args = $field['setting'];

						unset($setting_args['is']);

						$manager->add_setting( $setting_id, $setting_args );

						$control_id = $field['setting']['id'];
						$control_args = $field['control'];
						$control_args['section'] = $section_id;
						$control_args['settings'] = $setting_id;

						$manager->add_control( new CTF_Customize_Control( $manager, $control_id, $control_args ) );


					}
				}
			}
		}
	}
}


endif; // End if class_exists check