		<div class="ctf-input-field ctf-input-field-text-multi">
			<div class="ctf-mt-input-container">
				<# for ( key in data.value ) { #>
					<div class="ctf-mt-input-item">
						<input type="text" class="ctf-txt-field" value="{{ data.value[key] }}" {{{ data.link }}} >
						<button class="ctf-mt-input-delete">x</button>
					</div>
				<# } #>
			</div>
			<button class="ctf-mt-add-new ctf-btn ctf-btn-small" data-name="{{{ _.escape(data.link) }}}"><i class="fa fa-plus"></i> Add</button>
			<div class="ctf-mt-input-item ctf-hidden ctf-mt-tmpl">
				<input type="text" class="ctf-txt-field" >
				<button class="ctf-mt-input-delete">x</button>
			</div>
		</div>