<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
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
     * Object constructor.
     *
     * @param string|array $dirOrArray
     */
    public function __construct($dirOrArray)
    {
        $allowModifications = true;
        if (is_string($dirOrArray)) {
            parent::__construct([], $allowModifications);
            $this->dir = rtrim(str_replace('\\', '/', $dirOrArray), DS) . DS;
            $this->load();
        } else {
            parent::__construct($dirOrArray, $allowModifications);
            $this->allowModifications = false;
            $this->isLoaded = true;
        }
    }

    private function load()
    {
        if ($this->isLoaded) {
            return;
        }

        $context = application_context();
        $commonPath = $this->dir . Application::CONTEXT_COMMON . DS
            . '{{,*.}global,{,*.}local}.php';
        $contextPath = $this->dir . $context . DS
            . '{{,*.}global,{,*.}local}.php';

        $files = array_merge(
            [$this->dir . 'module.config.php'],
            glob($commonPath, GLOB_BRACE)
        );
        if (
        !application_context(Application::CONTEXT_COMMON)
        ) {
            $files = array_merge(
                $files,
                glob($contextPath, GLOB_BRACE)
            );
        }

        foreach ($files as $file) {
            $config = include $file;
            $this->merge(new static($config));
        }
        $this->allowModifications = false;
        $this->isLoaded = true;
    }
}