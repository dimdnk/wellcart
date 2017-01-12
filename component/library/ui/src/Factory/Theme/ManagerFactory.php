<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Ui\Factory\Theme;

use Interop\Container\ContainerInterface;
use WellCart\Ui\Theme\Manager;

class ManagerFactory
{

    /**
     * @param ContainerInterface $container
     *
     * @return Manager
     */
    public function __invoke(ContainerInterface $container): Manager
    {
        $config = $container->get('Configuration');

        $manager = new Manager($container, $config['ze_theme']);

        return $manager;
    }
}