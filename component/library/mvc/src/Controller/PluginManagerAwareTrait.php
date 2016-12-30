<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Mvc\Controller;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Mvc\Controller\PluginManager;

trait PluginManagerAwareTrait
{
    /**
     * @var PluginManager
     */
    protected $controllerPlugins;

    /**
     * @param $plugin
     *
     * @return AbstractPlugin
     */
    public function getControllerPlugin($plugin)
    {
        return $this->getControllerPlugins()->get($plugin);
    }

    /**
     * @return PluginManager
     */
    public function getControllerPlugins()
    {
        return $this->controllerPlugins;
    }

    /**
     * @param PluginManager $plugins
     *
     * @return void
     */
    public function setControllerPlugins(PluginManager $plugins)
    {
        $this->controllerPlugins = $plugins;
        return $this;
    }
}