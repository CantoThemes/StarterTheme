	<div class="ctf-input-field ctf-input-field-radio-button clearfix">
		<#
			var nameAttr = '';

			if( typeof isAddon == 'undefined' ){
				nameAttr = 'name="ctf_radio_input_'+data.id+'"';
			}
		#>
		<# for ( key in data.choices ) { #>
			<label>
				<input type="radio" value="{{ key }}" {{{ data.link }}} {{{ nameAttr }}} <# if ( key === data.value ) { #>checked="checked"<# } #> > 
				<span class="ctf-input-radio-button">{{ data.choices[ key ] }}</span>
			</label>
		<# } #>
	</div>