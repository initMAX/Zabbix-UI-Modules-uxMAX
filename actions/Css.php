<?php

namespace Modules\uxMAX\Actions;

use CController, CControllerResponseData, CWebUser;
use Modules\uxMAX\Module;
use Modules\uxMAX\Services\Preferences;

class Css extends CController {

    public Module $module;

    protected function init() {
        $this->disableCsrfValidation();
    }

    public function checkInput() {
        return true;
    }

    public function checkPermissions() {
        return true;
    }

    public function doAction() {
        $preferences = $this->module->preferences->get();
        $uri = $_SERVER['HTTP_REFERER'] ?? '';

        $this->setResponse((new CControllerResponseData([
            'css' => $this->getCssForAction($uri, $preferences)
        ])));
    }

    /**
     * Get custom styles matched passed$action.
     *
     * @param string $uri
     * @param array  $preferences
     */
    protected function getCssForAction(string $uri, array $preferences): string {
        $css = [];

        $debug = CWebUser::getDebugMode();
        parse_str(parse_url($uri, PHP_URL_QUERY), $query_args);
        $action = $query_args['action']??'';

        if ($action === '') {
            $action = basename(parse_url($uri, PHP_URL_PATH));
            $query_args['action'] = $action;
        }

        if ($debug) {
            $css[] = "/* uri: {$uri} */";
            $css[] = "/* action: {$action} */";
        }

        $tags = $preferences['state']['colortags'] ? $preferences['colortags'] : [];
        if ($debug) {
            $css[] = '/* tags css */';
        }

        foreach ($tags as $tag) {
            $rule = '';

            switch ($tag['match']) {
                case Preferences::MATCH_BEGIN:
                    $rule = '.tag[data-hintbox-contents^="%1$s"] { background-color: %2$s }';
                    break;

                case Preferences::MATCH_CONTAIN:
                    $rule = '.tag[data-hintbox-contents*="%1$s"] { background-color: %2$s }';
                    break;

                case Preferences::MATCH_END:
                    $rule = '.tag[data-hintbox-contents$="%1$s"] { background-color: %2$s }';
                    break;
            }

            if ($rule !== '') {
                $css[] = sprintf($rule, $tag['value'], $tag['color']);
            }
        }

        if ($preferences['state']['syntax']) {
            $css[] = implode("\r\n", [
                '.ace_editor {',
                    'font-family: "'.$preferences['syntax']['font'].'", monospace;',
                    'font-size: '.$preferences['syntax']['fontSize'].';',
                '}'
            ]);
        }

        $css[] = implode("\r\n", [
        ':root {',
            '--uxmax-body-bgcolor: '.$preferences['color']['bodybg'].';',
            '--uxmax-sidebar-bgcolor: '.$preferences['color']['asidebg'].';',
        '}']);

        return implode("\r\n", $css);
    }
}
