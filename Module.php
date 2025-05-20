<?php

namespace Modules\uxMAX;

use APP, CMenu, CMenuItem;
use CController as Action;
use Modules\uxMAX\Services\Preferences;
use Zabbix\Core\CModule;

class Module extends CModule {

    public Preferences $preferences;

    public function getAssets(): array {
        $assets = parent::getAssets();
        $action = APP::Component()->router->getAction();
        $preferences = $this->preferences->get();

        if ($action === 'mod.uxmax.form') {
            $assets['js'][] = 'uxmax.form.js';
        }

        if ($preferences['state']['windrag'] || $action === 'mod.uxmax.form') {
            $assets['js'][] = 'uxmax.dragm.js';
        }

        if ($preferences['state']['bodybg']) {
            zbx_add_post_js("document.documentElement.setAttribute('uxmax-coloring-body', 'on')");
        }

        if ($preferences['state']['asidebg']) {
            zbx_add_post_js("document.documentElement.setAttribute('uxmax-coloring-sidebar', 'on')");
        }

        if ($preferences['state']['colortags'] || $preferences['state']['bodybg'] || $preferences['state']['asidebg']) {
            $assets['css'][] = '../../../../zabbix.php?action=mod.uxmax.css';
        }

        if ($preferences['state']['syntax'] || $action === 'mod.uxmax.form') {
            $assets['js'] = array_merge($assets['js'], [
                'uxmax.ace.js', 'ace.1.5.0/ace.js', 'ace.1.5.0/ext-language_tools.js', 'ace.1.5.0/worker-base.js',
                'ace.1.5.0/worker-javascript.js', 'ace.1.5.0/mode-javascript.js', 'ace.1.5.0/worker-css.js',
                'ace.1.5.0/mode-css.js', 'ace.1.5.0/theme-twilight.js'
            ]);
        }

        $assets['css'][] = 'uxmax.css';

        return $assets;
    }

    public function init(): void {
        $this->preferences = new Preferences($this);
        $this->registerMenuEntry();
    }

    public function onBeforeAction(Action $action): void {
        if (strpos($action::class, __NAMESPACE__) === 0) {
            $action->module = $this;
        }
    }

    public function onTerminate(Action $action): void {
    }

    protected function registerMenuEntry() {
        /** @var CMenuItem $menu */
        $menu = APP::Component()->get('menu.main')->find(_('Administration'));

        if ($menu instanceof CMenuItem) {
            $menu->getSubMenu()
                ->add((new CMenuItem(_('uxMAX configuration')))->setAction('mod.uxmax.form'));
        }
    }
}
