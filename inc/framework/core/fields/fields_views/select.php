	<div class="ctf-input-field ctf-input-field-text">
		<select {{{ data.link }}} >
			<# for ( key in data.choices ) { #>
				<option value="{{ key }}"<# if ( key === data.value ) { #>selected<# } #>>{{ data.choices[ key ] }}</option>
			<# } #>
		</select>
	</div>