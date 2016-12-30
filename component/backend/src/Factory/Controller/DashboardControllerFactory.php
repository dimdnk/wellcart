<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\Factory\Controller;

use Interop\Container\ContainerInterface;
use WellCart\Backend\Controller\DashboardController;

class DashboardControllerFactory
{
    public function __invoke(ContainerInterface $sm
    ): DashboardController {
        return new DashboardController;
    }
}
