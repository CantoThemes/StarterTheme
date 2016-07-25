<div class="ctf-input-field ctf-input-field-editor">
    <div id="wp-{{ data.id }}-wrap" class="wp-core-ui wp-editor-wrap tmce-active">
        <div id="wp-{{ data.id }}-editor-tools" class="wp-editor-tools hide-if-no-js">
            <div id="wp-{{ data.id }}-media-buttons" class="wp-media-buttons">
                
            </div>
            <div class="wp-editor-tabs">
                <button type="button" id="{{ data.id }}-tmce" class="wp-switch-editor switch-tmce" data-wp-editor-id="{{ data.id }}">Visual</button>
                <button type="button" id="{{ data.id }}-html" class="wp-switch-editor switch-html" data-wp-editor-id="{{ data.id }}">Text</button>
            </div>
        </div>
        <div id="wp-{{ data.id }}-editor-container" class="wp-editor-container">
            <div id="qt_{{ data.id }}_toolbar" class="quicktags-toolbar"></div>
            <textarea class="wp-editor-area" rows="20"  autocomplete="off" cols="40" id="{{ data.id }}" {{{ data.link }}}>{{{ data.value }}}</textarea>
        </div>
    </div>
</div>