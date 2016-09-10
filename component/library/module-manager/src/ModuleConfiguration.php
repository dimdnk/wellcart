<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\ModuleManager;

use WellCart\Mvc\Application;
use Zend\Config\Config;

class ModuleConfiguration extends Config
{
    /**
     * Config directory
     *
     * @var string
     */
    protected $dir;
    protected $isLoaded = false;

    /**
     *
     * Object constructor.
     *
     * @param array      $array
     * @param bool|false $allowModifications
     * @param string     $dir
     */
    public function __construct(
        array $array,
        $allowModifications = false,
        string $dir = null
    ) {
        $allowModifications = true;
        parent::__construct($array, $allowModifications);
        if (null !== $dir) {
            $this->dir = rtrim(str_replace('\\', '/', $dir), DS) . DS;
            $this->load();
        } else {
            $this->allowModifications = false;
            $this->isLoaded = true;
        }
    }

    private function load()
    {
        if ($this->isLoaded) {
            return;
        }
        $files = ['module.config.php'];
        if (application_context(Application::CONTEXT_API)) {
            $files[] = 'api.config.php';
        }
        foreach ($files as $file) {
            $config = include $this->dir . $file;
            $this->merge(new static($config));
        }
        $this->allowModifications = false;
        $this->isLoaded = true;
    }
}