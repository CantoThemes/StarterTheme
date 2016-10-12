<?php

if ( ! class_exists( 'CTF_Customize_Section' ) ) :

/**
* 
*/
class CTF_Customize_Section extends WP_Customize_Section
{
	
	function __construct()
	{
		# code...
	}

	protected function render_template() {
        ?>
        <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }}">
            <h3 class="accordion-section-title" tabindex="0">
                <span><i class="fa {{ data.icon }}"></i></span>
                {{ data.title }}
                <span class="screen-reader-text"><?php _e( 'Press return or enter to open this section' ); ?></span>
            </h3>
            <ul class="accordion-section-content">
                <li class="customize-section-description-container">
                    <div class="customize-section-title">
                        <button class="customize-section-back" tabindex="-1">
                            <span class="screen-reader-text"><?php _e( 'Back' ); ?></span>
                        </button>
                        <h3>
                            <span class="customize-action">
                                {{{ data.customizeAction }}}
                            </span>
                            {{ data.title }}
                        </h3>
                    </div>
                    <# if ( data.description ) { #>
                        <div class="description customize-section-description">
                            {{{ data.description }}}
                        </div>
                    <# } #>
                </li>
            </ul>
        </li>
        <?php
    }
}

endif; // End if class_exists check