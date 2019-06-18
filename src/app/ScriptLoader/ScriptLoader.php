<?php

namespace Nodopiano\ExamplePlugin\ScriptLoader;

use Symfony\Component\Finder\Finder;

class ScriptLoader {
    protected $pluginDir = '';
    protected $pluginUrl = '';
    protected $slug = '';
    protected $finder;
    protected $filesList = [];

    public function __construct($pluginDir, $pluginUrl, $slug)
    {
        $this->pluginDir = $pluginDir;
        $this->pluginUrl = $pluginUrl;
        $this->slug = $slug;

        $this->finder = new Finder();
        
        $this->findScripts();
    }
    
    public function registerScript(String $name, Bool $inFooter = true)
    {
        if (array_key_exists($name, $this->filesList['js'])) {
            $file = $this->filesList['js'][$name];
            return wp_enqueue_script(
                $this->slug . '_script_' . $name,
                $this->pluginUrl . 'dist/' . $file['path'],
                [],
                $file['hash'] ?: false,
                $inFooter
            );
        }
        return false;
    }
    
    public function registerStyle(String $name)
    {
        if (array_key_exists($name, $this->filesList['css'])) {
            $file = $this->filesList['css'][$name];
            return wp_enqueue_style(
                $this->slug . '_style_' . $name,
                $this->pluginUrl . 'dist/' . $file['path'],
                [],
                $file['hash'] ?: false
            );
        }
        return false;
    }

    protected function findScripts()
    {
        $this->finder->files()
            ->in($this->pluginDir . 'dist')
            ->name('*.css')
            ->name('/^((?!hot-update).)*.js$/m')
            ->sortByChangedTime()
            ->reverseSorting();
        
        $this->extractScripts();
    }

    protected function extractScripts()
    {
        foreach ($this->finder as $file) {
            $path = $file->getRelativePathname();

            if (strpos("\/", $path)) {
                $fileArray = explode('/', $path);
                $fileSplit = explode('.', $fileArray[1]);
            } else {
                $fileSplit = explode('.', $path);
            }
            $fileName = explode('.', $file->getFilename())[0];
            $fileType = end($fileSplit);

            $fileDetails = [
                'path' => $path,
                'hash' => count($fileSplit) === 3 ? $fileSplit[1] : false
            ];

            if (!array_key_exists($fileType, $this->filesList) ||!array_key_exists($fileName, $this->filesList[$fileType]))
                $this->filesList[$fileType][$fileName] = $fileDetails;
        }
    }
}