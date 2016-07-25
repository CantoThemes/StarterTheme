	<div class="ctf-input-field ctf-input-field-checkbox-image clearfix">
		<#
			var nameAttr = '';

			if( typeof isAddon == 'undefined' ){
				nameAttr = 'name="ctf_checkbox_input_'+data.id+'"';
			}
		#>
		
		<# for ( key in data.choices ) { #>
			<label>
				<input type="checkbox" value="{{ key }}" {{{ data.link }}} {{{ nameAttr }}} <# if ( _.contains(data.value, key) ) { #>checked="checked"<# } #> > 
				<img src="{{ data.choices[ key ] }}" alt="{{ key }}" class="ctf-input-checkbox-img">
			</label>
		<# } #>
	</div>