<?php

namespace Modules\uxMAX\Actions;

use CController, CControllerResponseData;
use Modules\uxMAX\Module;

/**
 * @property Modules\uxMAX\Module $module
 */
class ConfigurationForm extends CController {

    public Module $module;

    public const FONT = [
        'Courier New' => '"Courier New", Courier, monospace',
        'Lucida Console' => '"Lucida Console", Monaco, monospace',
        'Source Code Pro' => '"Source Code Pro", monospace',
        'JetBrains Mono' => '"JetBrains Mono", monospace',
        'Fira Code' => '"Fira Code", monospace',
        'Ubuntu Mono' => '"Ubuntu Mono", monospace'
    ];

    public function init() {
        $this->disableCsrfValidation();
    }

    protected function checkInput() {
        $fields = [
            'state' =>      'array',
            'color' =>      'array',
            'colortags' =>  'array',
            'syntax' =>     'array'
        ];

        $ret = $this->validateInput($fields);

        return $ret;
    }

    protected function checkPermissions() {
        return true;
    }

    protected function doAction() {
        $data = $this->module->preferences->get();
        $this->getInputs($data, array_keys($data));

        $this->setResponse((new CControllerResponseData($data)));
    }
}
