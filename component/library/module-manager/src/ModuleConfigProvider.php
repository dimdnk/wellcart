<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\ModuleManager;

use WellCart\Mvc\Application;
use Zend\ConfigAggregator\GlobTrait;
use Zend\Config\Factory as ConfigFactory;

class ModuleConfigProvider
{
    use GlobTrait;
  /***
   * @var string
   */
    private $dir;

    /**
     * Object constructor.
     *
     * @param string $directory
     */
    public function __construct($directory)
    {
        $this->dir = rtrim(str_replace('\\', '/', $directory), DS) . DS;
    }

    /**
     * Provide configuration.
     *
     * Globs the given files, and passes the result to ConfigFactory::fromFiles
     * for purposes of returning merged configuration.
     *
     * @return array
     */
    public function __invoke()
    {
        $context = application_context();
        $commonPath = $this->dir . Application::CONTEXT_COMMON . DS . '*.php';
        $contextPath = $this->dir . $context . DS . '*.php';

        $files = array_merge( [$this->dir . 'module.config.php'], glob($commonPath, GLOB_BRACE));
        if (!application_context(Application::CONTEXT_COMMON)) {
            $files = array_merge($files, glob($contextPath, GLOB_BRACE));
        }
        return ConfigFactory::fromFiles($files);
    }
}