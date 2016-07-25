        <#

        var miniAttr = '',
            maxAttr = '',
            stepAttr = '',
            number = '',
            unit = '',
            units = ['px', '%', 'em'];
            
        
        if ( typeof data.value != 'undefined' && ! _.isNull(data.value) && ! _.isArray(data.value) ){
          number = parseFloat( data.value );
          unit = data.value.replace( parseFloat( data.value ), '' );
        }

        if ( typeof data.choices != 'undefined' ){
          
          if ( ! _.isUndefined(data.choices[ 'min' ]) ){
          	miniAttr = 'min="'+data.choices[ 'min' ]+'"';
          }

          if ( ! _.isUndefined(data.choices[ 'max' ]) ){
          	maxAttr = 'max="'+data.choices[ 'max' ]+'"';
          }

          if ( ! _.isUndefined(data.choices[ 'step' ]) ){
          	stepAttr = 'data-step="'+data.choices[ 'step' ]+'"';
          }

          if( ! _.isEmpty(data.choices['units']) ){
            units = data.choices['units'];
          }

        }
        #>
        <div class="ctf-input-field ctf-input-field-dimension">
          <div class="ctf-input-dimension-number">
            <input type="number" value="{{ number }}" {{{ miniAttr }}} {{{ maxAttr }}} {{{ stepAttr }}} {{{ data.link }}}>
          </div>
          <div class="ctf-input-dimension-select">
            <select {{{ data.link }}}>
              <# for ( key in units ) { #>
                <option value="{{ units[ key ] }}"<# if ( units[ key ] === unit ) { #>selected<# } #>>{{ units[ key ] }}</option>
              <# } #>
            </select>
          </div>
          
          
        </div>
