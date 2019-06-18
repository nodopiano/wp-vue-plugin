<?php

namespace Nodopiano\ExamplePlugin;

use Nodopiano\ExamplePlugin\ScriptLoader\ScriptLoader;

class MainClass {
    protected $pluginDir = '';
    protected $pluginUrl = '';
    protected $scriptLoader;

    public function __construct(String $pluginDir, String $pluginUrl)
    {
        // Your main plugin class
        $this->pluginDir = $pluginDir;
        $this->pluginUrl = $pluginUrl;

        $this->scriptLoader = new ScriptLoader($this->pluginDir, $this->pluginUrl, 'your-plugin-name');

        $this->loadScripts();
    }

    protected function loadScripts()
    {
        add_action('wp_enqueue_scripts', function () {
            $this->scriptLoader->registerStyle('app');
            $this->scriptLoader->registerScript('app');
            $this->scriptLoader->registerStyle('chunk-vendors');
            $this->scriptLoader->registerScript('chunk-vendors');
        });

        add_action('admin_enqueue_scripts', function () {
            $this->scriptLoader->registerStyle('admin');
            $this->scriptLoader->registerScript('admin');
            $this->scriptLoader->registerStyle('chunk-vendors');
            $this->scriptLoader->registerScript('chunk-vendors');
        });
    }
}
