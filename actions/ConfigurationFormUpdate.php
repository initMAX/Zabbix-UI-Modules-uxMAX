<?php

namespace Modules\uxMAX\Actions;

use CController, CControllerResponseRedirect, CMessageHelper, CUrl;
use Modules\uxMAX\Module;

/**
 * @property Modules\uxMAX\Module $module
 */
class ConfigurationFormUpdate extends CController {

    public Module $module;

    protected function checkInput() {
        $fields = [
            'state' =>      'array',
            'color' =>      'array',
            'colortags' =>  'array',
            'css' =>        'array',
            'syntax' =>     'array'
        ];

        $ret = $this->validateInput($fields) && $this->validatePreferences($this->getInputAll());

        if (!$ret) {
            $response = new CControllerResponseRedirect(
                (new CUrl('zabbix.php'))->setArgument('action', 'mod.uxmax.form')
            );
            $response->setFormData($this->getInputAll());
            CMessageHelper::setErrorTitle(_('Cannot update configuration'));
            $this->setResponse($response);
        }

        return $ret;
    }

    protected function checkPermissions() {
        return true;
    }

    protected function validatePreferences(array $data) {
        return $this->module->preferences->validate($data);
    }

    protected function doAction() {
        $data = $this->getInputAll();
        $default = $this->module->preferences->getDefault();
        $data['state'] = array_merge($default['state'], $data['state'] ?? []);
        $this->module->preferences->set($data);
        $curl = (new CUrl('zabbix.php'))->setArgument('action', 'mod.uxmax.form');

        $this->setResponse((new CControllerResponseRedirect($curl)));
    }
}
