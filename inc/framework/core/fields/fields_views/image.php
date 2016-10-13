        <#
        
          var addbtnHiddenClass = '';
          var hiddenClass = '';
          
          if ( _.isEmpty(data.value['url']) ) {
            hiddenClass = 'ctf-hidden';
          } else {
            addbtnHiddenClass = 'ctf-hidden';
          }

          var imgVal = '';
          if ( typeof data.value != 'undefined'){
            if( _.isEmpty(data.value['thumbnail']) ) {
              imgVal = data.value['url'];
            } else {
              imgVal = data.value['thumbnail'];
            }
          }

          
        #>
        <div class="ctf-input-field ctf-input-field-image clearfix">
          <input type="hidden" class="ctf-ii-data-field" value="{{ JSON.stringify(data.value) }}" {{{ data.link }}} >
          <div class="ctf-ifi-view-image">
            <# if ( ! _.isEmpty(imgVal) ) { #>
              <img class="" src="{{ imgVal }}" alt="" />
            <# } #>
          </div>
          <div class="ctf-ifi-btn-set">
            <button type="button" class="ctf-btn ctf-btn-small image-change-button {{ hiddenClass }}"><i class="fa fa-pencil" aria-hidden="true"></i> <?php esc_html_e('Change Image', '_s'); ?></button>
            <button type="button" class="ctf-btn ctf-btn-small ctf-btn-cancel image-remove-button {{ hiddenClass }}"><i class="fa fa-times" aria-hidden="true"></i> <?php esc_html_e('Remove Image', '_s'); ?></button>
          </div>
          
          <button type="button" class="ctf-btn image-upload-button {{ addbtnHiddenClass }}"><i class="fa fa-picture-o" aria-hidden="true"></i> <?php esc_html_e('Add Image', '_s'); ?></button>
          
        </div>
