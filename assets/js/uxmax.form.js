$(() => {
    const $nav = $('#uxmax');

    $nav.on('click', '[name="state[bodybg]"],[name="state[asidebg]"]', e => {
        const input = e.target.parentNode.querySelector('input[type="color"]');
        const input_bodyattr = {
            'state[bodybg]': 'uxmax-coloring-body',
            'state[asidebg]': 'uxmax-coloring-sidebar'
        }

        input.toggleAttribute('disabled', !e.target.checked);
        input.closest('label').classList.toggle('disabled', !e.target.checked);
        document.documentElement.toggleAttribute(input_bodyattr[e.target.getAttribute('name')], e.target.checked);
    });
    $nav.on('input', '[name="color[bodybg]"],[name="color[asidebg]"]', e => {
        const input_cssvar = {
            'color[bodybg]': '--uxmax-body-bgcolor',
            'color[asidebg]': '--uxmax-sidebar-bgcolor'
        }

        document.body.style.setProperty(input_cssvar[e.target.getAttribute('name')], e.target.value);
    });

    $nav.find('#uxmax-colortag-table table').dynamicRows({
        template: '#colortag-row-tmpl',
        rows: JSON.parse($nav.find('#colortag-data').html()),
        dataCallback: (row) => ({color: '#000000', ...row})
    });

    initCodeHighlight('uxmax-ace-playground');

    $nav.on('change', 'state[syntax],[name="syntax[fontSize]"],[name="syntax[font]"]', e => {
        const container = $nav.find('.ace_editor');
        const enabled = $nav.find('input[name="state[syntax]"]:checked').length > 0;

        container.css('font-size','');
        container.css('font-family','');

        if (enabled) {
            container.css('font-family', $nav.find('[name="syntax[font]"]').val());
            container.css('font-size', $nav.find('[name="syntax[fontSize]"]').val());
        }
    });


    function initCodeHighlight(containerid) {
        const theme = document.documentElement.getAttribute('color-scheme') === 'dark' ? 'ace/theme/twilight' : '';
        const editor = ace.edit(containerid, {
            mode: 'ace/mode/javascript',
            theme,
            enableBasicAutocompletion: true,
            enableLiveAutocompletion: true,
            showGutter: true,
            readOnly: document.querySelector('[name="state[syntax]"]:checked') === null,
            tooltipFollowsMouse: true
        });

        document.querySelector('[name="state[syntax]"]').addEventListener('change', e => {
            editor.setOption('readOnly', !e.target.checked);
            editor.renderer.$cursorLayer.element.style.display = editor.getReadOnly() ? 'none' : '';
        });

        editor.session.setUseWorker(true);
        editor.renderer.$cursorLayer.element.style.display = editor.getReadOnly() ? 'none' : '';
    }
});
