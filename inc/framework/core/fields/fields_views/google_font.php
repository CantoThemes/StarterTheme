        <div class="ctf-input-field ctf-input-field-google-font">
        	<# if( parseFloat(data.choices['font-family']) || _.isUndefined(data.choices['font-family']) ){ #>
			<div class="ctf-if-gf-font-family">
				<label><?php esc_html_e('Font Family', '_s'); ?></label>
				<select class="ctf-gf-ff-input">
					<option value=""><?php esc_html_e('Select a font...', '_s'); ?></option>
					<# for ( key in ctf_google_fonts ) { #>
						<option value="{{ key }}"<# if ( key === data.value['font-family'] ) { #>selected<# } #>>{{ key }}</option>
					<# } #>
				</select>
			</div>
			<# } #>
			<# if( parseFloat(data.choices['font-weight']) || _.isUndefined(data.choices['font-weight']) ){ #>
			<div class="ctf-if-gf-font-weight">
				<# var fontWeights = ctf_google_fonts[data.value['font-family']]; #>
				<label><?php esc_html_e('Font Weight', '_s'); ?></label>
				<select class="ctf-gf-fw-input">
					<# for ( key in fontWeights ) { #>
						<option value="{{ fontWeights[ key ] }}"<# if ( fontWeights[ key ] === data.value['font-weight'] ) { #>selected<# } #>>{{ fontWeights[ key ] }}</option>
					<# } #>
				</select>
			</div>
			<# } #>
			<# if( parseFloat(data.choices['font-size']) || _.isUndefined(data.choices['font-size']) ){ #>
			<div class="ctf-if-gf-font-size ctf-input-field-dimension">
				<#
				var fzNumber = '';
        		var fzUnit = '';
        		
        		if( ! _.isUndefined(data.value['font-size']) ){
        			fzNumber = parseFloat( data.value['font-size'] );
        		}
        		
        		if( ! _.isUndefined(data.value['font-size']) ){
        			fzUnit = data.value['font-size'].replace( parseFloat( data.value['font-size'] ), '' );
        		}
        		
        		var units = ['px', '%', 'em'];
		        if( ! _.isEmpty(data.choices['units']) ){
		        	units = data.choices['units'];
		        }
				#>
				<label><?php esc_html_e('Font Size', '_s'); ?></label>
				<div class="ctf-input-dimension-number">
					<input type="number" value="{{ fzNumber }}" min="0" class="ctf-gf-fz-value-input">
				</div>
				<div class="ctf-input-dimension-select">
					<select class="ctf-gf-fz-unit-input">
						<# for ( key in units ) { #>
						<option value="{{ units[ key ] }}"<# if ( units[ key ] === fzUnit ) { #>selected<# } #>>{{ units[ key ] }}</option>
						<# } #>
					</select>
				</div>
			</div>
			<# } #>
			<# if( parseFloat(data.choices['line-height']) || _.isUndefined(data.choices['line-height']) ){ #>
			<div class="ctf-if-gf-line-height ctf-input-field-dimension">
				<#
				var lhNumber = '';
        		var lhUnit = '';
 
        		
        		if( ! _.isUndefined(data.value['line-height']) ){
        			lhNumber = parseFloat( data.value['line-height'] );
        		}
        		
        		if( ! _.isUndefined(data.value['line-height']) ){
        			lhUnit = data.value['line-height'].replace( parseFloat( data.value['line-height'] ), '' );
        		}
        		
        		var units = ['px', '%', 'em'];
		        if( ! _.isEmpty(data.choices['units']) ){
		        	units = data.choices['units'];
		        }
				#>
				<label><?php esc_html_e('Line Height', '_s'); ?></label>
				<div class="ctf-input-dimension-number">
					<input type="number" value="{{ lhNumber }}" min="0" class="ctf-gf-lh-value-input">
				</div>
				<div class="ctf-input-dimension-select">
					<select class="ctf-gf-lh-unit-input">
						<# for ( key in units ) { #>
						<option value="{{ units[ key ] }}"<# if ( units[ key ] === lhUnit ) { #>selected<# } #>>{{ units[ key ] }}</option>
						<# } #>
					</select>
				</div>
			</div>
			<# } #>
			<# if( parseFloat(data.choices['letter-spacing']) ){ #>
			<div class="ctf-if-gf-letter-spacing ctf-input-field-dimension">
				<#
				var lsNumber = parseFloat( data.value['letter-spacing'] );
        		var lsUnit = data.value['font-size'].replace( parseFloat( data.value['letter-spacing'] ), '' );
        		
        		var units = ['px', '%', 'em'];
		        if( ! _.isEmpty(data.choices['units']) ){
		        	units = data.choices['units'];
		        }
				#>
				<label><?php esc_html_e('Latter Spacing', '_s'); ?></label>
				<div class="ctf-input-dimension-number">
					<input type="number" value="{{ lsNumber }}" min="0" class="ctf-gf-ls-value-input">
				</div>
				<div class="ctf-input-dimension-select">
					<select class="ctf-gf-ls-unit-input">
						<# for ( key in units ) { #>
						<option value="{{ units[ key ] }}"<# if ( units[ key ] === lsUnit ) { #>selected<# } #>>{{ units[ key ] }}</option>
						<# } #>
					</select>
				</div>
			</div>
			<# } #>
			<# if( parseFloat(data.choices['word-spacing']) ){ #>
			<div class="ctf-if-gf-word-spacing ctf-input-field-dimension">
				<#
				var wsNumber = parseFloat( data.value['word-spacing'] );
        		var wsUnit = data.value['font-size'].replace( parseFloat( data.value['word-spacing'] ), '' );
        		
        		var units = ['px', '%', 'em'];
		        if( ! _.isEmpty(data.choices['units']) ){
		        	units = data.choices['units'];
		        }
				#>
				<label><?php esc_html_e('Word Spacing', '_s'); ?></label>
				<div class="ctf-input-dimension-number">
					<input type="number" value="{{ wsNumber }}" min="0" class="ctf-gf-ws-value-input">
				</div>
				<div class="ctf-input-dimension-select">
					<select class="ctf-gf-ws-unit-input">
						<# for ( key in units ) { #>
						<option value="{{ units[ key ] }}"<# if ( units[ key ] === wsUnit ) { #>selected<# } #>>{{ units[ key ] }}</option>
						<# } #>
					</select>
				</div>
			</div>
			<# } #>
			<input type="hidden" value="{{ JSON.stringify(data.value) }}" class="ctf-gf-input-val" {{{ data.link }}}>
        </div>
