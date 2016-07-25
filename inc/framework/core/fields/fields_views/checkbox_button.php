	<div class="ctf-input-field ctf-input-field-checkbox-button clearfix">
		<#
			var nameAttr = '';

			if( typeof isAddon == 'undefined' ){
				nameAttr = 'name="ctf_checkbox_input_'+data.id+'"';
			}
		#>
		<# for ( key in data.choices ) { #>
			<label>
				<input type="checkbox" value="{{ key }}" {{{ data.link }}} {{{ nameAttr }}} <# if ( _.contains(data.value, key) ) { #>checked="checked"<# } #> > 
				<span class="ctf-input-checkbox-button">{{ data.choices[ key ] }}</span>
			</label>
		<# } #>
	</div>