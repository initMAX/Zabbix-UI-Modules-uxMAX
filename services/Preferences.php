<?php

namespace Modules\uxMAX\Services;

use Modules\uxMAX\Module;

class Preferences {

    const MATCH_BEGIN = 1;
    const MATCH_CONTAIN = 2;
    const MATCH_END = 3;

    protected Module $module;

    public function __construct(Module $module) {
        $this->module = $module;
    }

    public function getDefault(): array {
        return [
            'state' => [
                'windrag' => 0,
                'bodybg' => 0,
                'asidebg' => 0,
                'colortags' => 0,
                'syntax' => 0
            ],
            'color' => [
                'bodybg' => '#000000',
                'asidebg' => '#403030'
            ],
            'colortags' => [
                ['value' => '', 'match' => Preferences::MATCH_BEGIN, 'color' => '#ff0000']
            ],
            'syntax' => [
                'theme' => 'auto',
                'font' => 'Lucida Console',
                'fontSize' => '12px'
            ]
        ];
    }

    public function get(): array {
        $data = $this->getDefault();
        $config = $this->module->getConfig();

        if (is_array($config)) {
            $data = array_replace_recursive($data, $config);
        }

        return $data;
    }

    public function set(array $data) {
        $data = array_replace_recursive($this->module->getConfig(), $data);
        $this->module->setConfig($data);
    }

    public function validate($data): bool {
        $valid = true;
        $default = $this->getDefault();

        if (is_array($data['state'] ?? null) && array_diff_key($data['state'], $default['state'])) {
            $valid = false;
        }

        if (is_array($data['color'] ?? null) && array_diff_key($data['color'], $default['color'])) {
            $valid = false;
        }

        foreach ($data['colortags'] ?? [] as $colortag) {
            if (array_diff_key($colortag, $default['colortags'][0])) {
                $valid = false;

                break;
            }
        }

        if (is_array($data['syntax'] ?? null) && array_diff_key($data['syntax'], $default['syntax'])) {
            $valid = false;
        }

        return $valid;
    }
}
