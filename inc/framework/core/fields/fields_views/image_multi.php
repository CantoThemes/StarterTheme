
        <div class="ctf-input-field ctf-input-field-image-multi clearfix">
          <input type="hidden" class="ctf-img-multi-data-all" value="{{ JSON.stringify(data.value) }}" {{{ data.link }}} >
          <div class="ctf-ifi-view-image-multi clearfix">
            <# if ( ! _.isEmpty(data.value) ) { #>
              <# _.each( data.value, function ( img_item ) {
              
                  var imgVal = '';
                  if ( typeof img_item != 'undefined'){
                    if( _.isEmpty(img_item['thumbnail']) ) {
                      imgVal = img_item['url'];
                    } else {
                      imgVal = img_item['thumbnail'];
                    }
                  }
              #>
                <div class="ctf-multi-img-item">
                  <img class="" src="{{ imgVal }}" alt="" />
                  <button class="ctf-mi-item-close">x</button>
                  <input type="hidden" class="ctf-img-multi-data" value="{{ JSON.stringify(img_item) }}" >
                </div>
              <# } );#>
              
            <# } #>
          </div>
          
          <button type="button" class="ctf-btn image-upload-button"><i class="fa fa-picture-o" aria-hidden="true"></i> Add Image(s)</button>
          
        </div>
