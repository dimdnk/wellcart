<?php
/**
 * @package WellCart\Ui\Layout

 */

namespace WellCart\Ui\Layout\Updater\Collector;

use Zend\Config\Config;

interface CollectorInterface
{
    /**
     * @param string $handle
     * @param null|string $area
     * @return Config
     */
    public function collect($handle, $area = null);
}
