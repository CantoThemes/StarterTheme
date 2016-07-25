<?php

if ( ! class_exists( 'CTFC' ) ) :

/**
 * 
 */
class CTFC
{
	private static $options;

	function __construct(){}

	public static function add_option( $manager, $args = array(), $options = array(), $section = array(), $panel = array())
	{

		// Add Panel if panel array is set
		$panel_id = '';
		if (is_array($panel) && count($panel) && !empty($panel)) {
			$panel_id = $panel['id'];

			self::add_panel( $manager, $panel_id, $panel );
		}
		
	}

	public static function add_panel($manager, $panel_id, $args = array())
	{
		$manager->add_setting( $panel_id , $args );
	}

	public static function add_section($manager, $section_id, $args = array(), $panel_id = '')
	{
		// Add Settings if not set
		$args['panel'] =  $panel_id;

		$manager->add_section( $section_id , $args );
	}

	public static function add_control($manager, $option_name, $option_id, $args = array(), $section_id = '')
	{
		// Add Settings if not set
		$args['settings'] =  (isset($args['settings']) && !empty($args['settings'])) ? $args['settings'] : $option_name.'['.$option_id.']';

		// Add Section ID if not set
		$args['section'] =  (isset($args['section']) && !empty($args['section'])) ? $args['section'] : $section_id;

		$manager->add_control( new CTF_Customize_Control($manager, $option_id , $args) );
	}

	public static function add_setting($manager, $option_name, $option_id, $args = array())
	{
		$manager->add_setting( $option_name.'['.$option_id.']' , $args );
	}
}

endif; // End if class_exists check