        <# var defaultValue = '';
        if ( data.defaultValue ) {
            if ( '#' !== data.defaultValue.substring( 0, 1 ) ) {
                defaultValue = '#' + data.defaultValue;
            } else {
                defaultValue = data.defaultValue;
            }
            defaultValue = ' data-default-color=' + defaultValue; // Quotes added automatically.
        } #>
        <div class="ctf-input-field ctf-input-field-color">
          <input type="text" class="ctf-color-field" maxlength="7" value="{{ data.value }}" placeholder="<?php esc_attr_e( 'Hex Value', '_s' ); ?>" {{{ data.link }}} {{ defaultValue }} >
        </div>
