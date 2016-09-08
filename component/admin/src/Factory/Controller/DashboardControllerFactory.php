<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Admin\Factory\Controller;

use Interop\Container\ContainerInterface;
use WellCart\Admin\Controller\DashboardController;

class DashboardControllerFactory
{
    public function __invoke(ContainerInterface $sm): DashboardController
    {
        return new DashboardController;
    }
}
