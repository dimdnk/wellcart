<?php
/**
 * @package WellCart\Ui\Layout
 
 */

namespace WellCart\Ui\Layout;

use Zend\Mvc\Service\AbstractPluginManagerFactory;

class BlockManagerFactory extends AbstractPluginManagerFactory
{
    const PLUGIN_MANAGER_CLASS = 'WellCart\Ui\Layout\BlockManager';
}
