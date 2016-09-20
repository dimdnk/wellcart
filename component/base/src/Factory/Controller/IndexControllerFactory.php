<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Base\Factory\Controller;

use Interop\Container\ContainerInterface;
use WellCart\Base\Controller\IndexController;

class IndexControllerFactory
{
    public function __invoke(ContainerInterface $sm,
        $requestedName,
        array $options = null
    ): IndexController
    {
        return new IndexController;
    }
}
