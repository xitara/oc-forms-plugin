<?php namespace Xitara\Forms;

use Event;
use System\Classes\PluginBase;
use Xitara\Forms\Models\Settings;

class Plugin extends PluginBase
{
    /**
     * @var string Event namespace
     */
    const EVENTS_PREFIX = 'xw.forms.';

    /**
     * Register Plugin Components
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Xitara\Forms\Components\CustomForm' => 'customForm',
        ];
    }
    public function registerPageSnippets()
    {
        return $this->registerComponents();
    }

    /**
     * Register Plugin Settings
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label' => 'Custom Forms',
                'description' => 'Simple multipurpose form builder',
                'category' => 'Small plugins',
                'icon' => 'icon-inbox',
                'class' => 'Xitara\Forms\Models\Settings',
                'keywords' => 'form custom contact xw recaptcha antispam',
                'order' => 555,
                'permissions' => ['xitara.forms.access_settings'],
            ],
        ];
    }

    /**
     * Register Plugin Mail Templates
     *
     * @return array
     */
    public function registerMailTemplates()
    {
        return [
            'xitara.forms::mail.autoreply' => 'xitara.forms::lang.mail.templates.autoreply',
            'xitara.forms::mail.notification' => 'xitara.forms::lang.mail.templates.notification',
        ];
    }

    /**
     * Inject patch JS and CSS when creating/updating forms
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'xitara.forms');

        Event::listen('backend.page.beforeDisplay', function ($controller, $action, $params) {
            if ($controller instanceof \Xitara\Forms\Controllers\Form) {
                // Check this is the settings page for this plugin:
                if ($action === 'update' || $action === 'create') {
                    // Add CSS (minor patch)
                    $controller->addCss('/plugins/xitara/forms/assets/settings-patch.css');
                    $controller->addJs('/plugins/xitara/forms/assets/settings-patch.js');
                }
            }
        });
    }
}
