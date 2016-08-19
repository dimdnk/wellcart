<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Mvc\Controller;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Mvc\Controller\PluginManager;

interface PluginManagerAwareInterface
{
    /**
     * @param PluginManager $plugins
     *
     * @return void
     */
    public function setControllerPlugins(PluginManager $plugins);

    /**
     * @param $plugin
     *
     * @return AbstractPlugin
     */
    public function getControllerPlugin($plugin);

    /**
     * @return PluginManager
     */
    public function getControllerPlugins();
}