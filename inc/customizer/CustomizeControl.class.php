<?php

if ( ! class_exists( 'CTF_Customize_Control' ) ) :

/**
* 
*/
class CTF_Customize_Control extends WP_Customize_Control
{
	public $type = 'ctf_text';
	public $field_type = 'text';

	public $subtitle = '';

	public $description = '';

	public $choices = '';
	
	public $id = '';

	function __construct( $manager, $id, $args = array() )
	{
		$args = apply_filters('ctf_before_pass_args', $args);
		
		parent::__construct( $manager, $id, $args );

		$this->type = (isset($args['type']) && !empty($args['type'])) ? 'ctf_'.$args['type'] : 'ctf_text';
		$this->field_type = (isset($args['type']) && !empty($args['type'])) ? $args['type'] : 'text';
		$this->description = (isset($args['description']) && !empty($args['description'])) ? $args['description'] : '';
		$this->subtitle = (isset($args['subtitle']) && !empty($args['subtitle'])) ? $args['subtitle'] : '';
		
		$this->choices = (isset($args['choices']) && !empty($args['choices'])) ? $args['choices'] : '';
		
		$this->id = $id;
	}

	public function to_json() {
		parent::to_json();

		$this->json['value']   = $this->value();
		$this->json['link']    = $this->get_link();
		$this->json['description']    = $this->description;
		$this->json['subtitle']    = $this->subtitle;

		$this->json['defaultValue'] = $this->setting->default;

		$this->json['choices'] = $this->choices;
		$this->json['id'] = $this->id;
	}

	public function render_content() {}

	public function content_template() {
		$field_obj = new CTF_Field($this->field_type);
		$field_obj->js_template();
	}
}

endif; // End if class_exists check