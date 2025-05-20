<?php

use Modules\uxMAX\Actions\ConfigurationForm;
use Modules\uxMAX\Services\Preferences;

/**
 * @var Cview $this
 * @var array $data
 */

$this->addJsFile('multilineinput.js');

$grid = (new CFormGrid([
    new CLabel(_('Enable dragging of modal windows'), 'windrag'),
    new CFormField((new CCheckBox('state[windrag]', 1))->setChecked((int) $data['state']['windrag'])),

    new CLabel(_('Custom color theme')),
    new CFormField([
        new CDiv([
            (new CCheckBox('state[bodybg]', 1))->setChecked((int) $data['state']['bodybg']),
            (new CLabel([
                (new CInput('color', 'color[bodybg]', $data['color']['bodybg']))
                    ->setEnabled(!!$data['state']['bodybg']),
                _('Body background color')
            ]))->addClass(!!$data['state']['bodybg'] ? null : ZBX_STYLE_DISABLED)
        ]),
        new CDiv([
            (new CCheckBox('state[asidebg]', 1))->setChecked((int) $data['state']['asidebg']),
            (new CLabel([
                (new CInput('color', 'color[asidebg]', $data['color']['asidebg']))
                    ->setEnabled(!!$data['state']['asidebg']),
                _('Navigation background color')
            ]))->addClass(!!$data['state']['asidebg'] ? null : ZBX_STYLE_DISABLED)
        ])
    ]),

    new CLabel(_('Color tags')),
    new CFormField([
        (new CCheckBox('state[colortags]', 1))->setChecked((int) $data['state']['colortags']),
        (new CDiv([
            (new CTable())
                ->setHeader([
                    new CColHeader(_('Match')),
                    new CColHeader(_('String')),
                    '',
                    ''
                ])
                ->setFooter(
                    (new CCol(
                        (new CButtonLink(_('Add')))->addClass('element-table-add')
                    ))->setColSpan(4)
                ),
            new CTemplateTag('colortag-row-tmpl', (new CRow([
                    (new CSelect('colortags[#{rowNum}][match]'))
                        ->removeId()
                        ->addOptions(CSelect::createOptionsFromArray([
                            Preferences::MATCH_BEGIN => _('Starts with'),
                            Preferences::MATCH_CONTAIN => _('Contains'),
                            Preferences::MATCH_END => _('Ends with')
                        ]))
                        ->setWidth(ZBX_TEXTAREA_SMALL_WIDTH),
                    (new CTextBox('colortags[#{rowNum}][value]', '#{value}'))
                        ->removeId()
                        ->setAttribute('placeholder', _('value'))
                        ->setWidth(ZBX_TEXTAREA_STANDARD_WIDTH),
                    (new CLabel([
                        (new CInput('color', 'colortags[#{rowNum}][color]', '#{color}'))->removeId()
                    ])),
                    (new CButtonLink(_('Remove')))->addClass('element-table-remove')
                ]))->addClass('form_row')
            ),
            new CTemplateTag('colortag-data', json_encode($data['colortags']))
        ]))
            ->setId('uxmax-colortag-table')
            ->addClass(ZBX_STYLE_TABLE_FORMS_SEPARATOR)
    ]),

    new CLabel(_('Code highlight')),
    new CFormField([
        (new CCheckBox('state[syntax]', 1))->setChecked((int) $data['state']['syntax']),
        (new CDiv())->addClass(ZBX_STYLE_FORM_INPUT_MARGIN),
        (new CTextBox('syntax[fontSize]', $data['syntax']['fontSize']))
            ->removeId()
            ->setWidth(ZBX_TEXTAREA_SMALL_WIDTH),
        (new CDiv())->addClass(ZBX_STYLE_FORM_INPUT_MARGIN),
        (new CSelect('syntax[font]'))
            ->removeId()
            ->setValue($data['syntax']['font'])
            ->addOptions(CSelect::createOptionsFromArray(ConfigurationForm::FONT))
            ->setWidth(ZBX_TEXTAREA_MEDIUM_WIDTH),
        (new CDiv(implode("\n", [
                '// Playground syntax higlight mode javascript.',
                'function foo() {',
                '    let x = "Hello world";',
                '',
                '    return x;',
                '}'
            ])))
                ->setId('uxmax-ace-playground')
    ])
]));


(new CHtmlPage())
    ->setTitle(_('uxMAX'))
    ->addItem(
        (new CForm('post', (new CUrl('zabbix.php'))->getUrl()))
            ->addVar(CSRF_TOKEN_NAME, CCsrfTokenHelper::get('mod.uxmax.form.update'))
            ->addVar('action', 'mod.uxmax.form.update')
            ->addItem(getMessages())
            ->addItem(
                (new CTabView())
                    ->addTab('uxmax', _('General'), $grid)
                    ->setFooter(makeFormFooter(new CSubmit('update', _('Update'))))
    ))
    ->show();
