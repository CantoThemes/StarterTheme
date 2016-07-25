<?php

if ( ! class_exists( 'CTF_Field' ) ) :

/**
 * Class for all type of input fileds used for Option
 */
class CTF_Field
{

  /**
   * Private properties for assign value for input type
   */
  private $type = 'text';


  /**
   * construct method for init class
   */
  function __construct($type)
  {
    $this->type = $type;
  }

  /**
   * Put Underscore.js template input file based on field type
   */
  public function js_template()
  {
    $inputPath = apply_filters('ctf_'.$this->type.'_input_murkup_path', CTF_PATH.'/core/fields/fields_views/'.$this->type.'.php');
    $this->js_template_render($inputPath);
  }

  /**
   *  Underscore.js template container
   */
  public function js_template_render( $inputPath )
  {
    ?>
    <div class="ctf-cc-container clearfix">
      <div class="ctf-title-container">
        <# if ( data.label ) { #>
          <span class="ctf-control-title" data-ctf-tooltip="{{ data.toltip }}">{{{ data.label }}}</span>
        <# } #>
        <# if ( data.subtitle ) { #>
          <span class="ctf-customize-control-subtitle">{{{ data.subtitle }}}</span>
        <# } #>
      </div>
        <div class="ctf-input-field-container">
          <?php include $inputPath; ?>
          <# if ( data.description ) { #>
            <p class="ctf-customize-control-description">{{{ data.description }}}</p>
          <# } #>
        </div>
        
    </div>
    <?php
  }


  public function print_js_template()
  {
    ?>
    <script type="text/html" id="tmpl-ctf-field-<?php echo $this->type; ?>">
      <?php $this->js_template(); ?>
    </script>
    <?php
  }
}

endif; // End if class_exists check