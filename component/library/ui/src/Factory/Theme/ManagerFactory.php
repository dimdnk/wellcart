<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

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

        $manager = new Manager($container, $config['wellcart']['theme']);
        return $manager;
    }
}