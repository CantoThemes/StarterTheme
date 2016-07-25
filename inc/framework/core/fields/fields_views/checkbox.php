	<div class="ctf-input-field ctf-input-field-checkbox">
		<#
			var nameAttr = '';

			if( typeof isAddon == 'undefined' ){
				nameAttr = 'name="ctf_checkbox_input_'+data.id+'"';
			}
		#>
		<# for ( key in data.choices ) { #>
			<label>
				<input type="checkbox" value="{{ key }}" {{{ data.link }}} {{{ nameAttr }}} <# if ( _.contains(data.value, key) ) { #>checked="checked"<# } #> > 
				<span class="ctf-input-checkbox-box"></span>
				<span class="ctf-input-checkbox-title">{{ data.choices[ key ] }}</span>
			</label>
		<# } #>
	</div>