        <# var defaultValue = '';
        if ( data.defaultValue ) {

            defaultValue = data.defaultValue;

            defaultValue = ' data-default-color=' + defaultValue; // Quotes added automatically.
        } #>
        <div class="ctf-input-field ctf-input-field-color-rgba">
          <input type="text" class="ctf-rgba-color-field" value="{{ data.value }}" placeholder="<?php esc_attr_e( 'RGBA Value', '_s' ); ?>" {{ defaultValue }} {{{ data.link }}} >
        </div>
