<?php

if ( ! class_exists( 'CTF_Addon' ) ) :

class CTF_Addon
{
	public $all_fields = array();
	
    function __construct()
	{
		// Set Fields Name
		$this->set_fields_name();

		add_action( 'admin_enqueue_scripts', array(&$this,'load_admin_js'), 99 );
		add_action( 'admin_enqueue_scripts', array(&$this,'load_admin_css') );
		
		add_action('admin_head', array($this,'print_window_js_var'));
	}
	
	public function print_window_js_var (){
        ?>
        <script type="text/javascript">
            window.isAddon = true;
    	</script>
        <?php
    }

	function load_admin_js(){
		global $tinymce_version;
		
		wp_enqueue_script( 'editor' );
		wp_enqueue_script( 'quicktags' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'jquery-ui-spinner' );
		wp_enqueue_media();
		wp_enqueue_script('ctf-selectize', CTF_URL.'assets/vendor/selectize/js/standalone/selectize.min.js', array('jquery'));
		wp_enqueue_script('ctf-tinymce', includes_url( 'js/tinymce' ).'/tinymce.min.js', array('jquery'), $tinymce_version, true);
		wp_enqueue_script('ctf-tinymce-compat3x', includes_url( 'js/tinymce' ).'/plugins/compat3x/plugin.min.js', array('jquery'), $tinymce_version, true);
        wp_enqueue_script( 'ctf-core-script', CTF_URL . 'assets/js/main.js', array('jquery', 'underscore'), '1.0', true );
        
        $ctf_google_fonts_json = array(
			'l10n_print_after' => 'ctf_google_fonts = ' . CTF_Help::get_google_font_json(),
		);
		wp_localize_script('ctf-core-script', 'ctf_google_fonts', $ctf_google_fonts_json);
		
		$ctf_fa_icons_json = array(
			'l10n_print_after' => 'ctf_fa_icons = ' . CTF_Help::get_icons_json(),
		);
		wp_localize_script('ctf-core-script', 'ctf_fa_icons', $ctf_fa_icons_json);
    }

    function load_admin_css(){
    	wp_enqueue_style( 'ctf-roboto-font', '//fonts.googleapis.com/css?family=Roboto:400,900italic,900,700italic,700,500italic,500,400italic,300italic,300,100italic,100' );
    	wp_enqueue_style( 'wp-color-picker' );
    	wp_enqueue_style( 'editor-buttons' );
    	wp_enqueue_style( 'ctf-selectize', CTF_URL.'assets/vendor/selectize/css/selectize.css' );
		wp_enqueue_style( 'ctf-font-awesome', CTF_URL.'assets/vendor/font-awesome/css/font-awesome.min.css' );
        wp_enqueue_style( 'ctf-core-style', CTF_URL.'assets/css/main.css' );
    }
	
	public function add_js_tmlp_to_admin_footer(){
		if ( !CTF_Help::is_js_tmpl_printed() ) {
			add_action('admin_footer', array($this,'print_js_templates'));
			CTF_Help::set_js_tmpl_printed(true);
		}
		
	}
	
	public function print_js_templates(){
	    $fields = $this->get_fields_name();
	    
	    foreach($fields as $field){
	    	$filed_obj = new CTF_Field($field);
	    	
	    	$filed_obj->print_js_template();
	    }
	}
	
	public function get_fields_name(){
	    return $this->all_fields;
	}
	
	public function set_fields_name(){
	    $this->all_fields = CTF_Help::get_all_fields_name();
	}
	
	public static function get_instance(){
		return $this;
	}
}

endif; // End if class_exists check