<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Factory\Controller\Backend;

use Interop\Container\ContainerInterface;
use WellCart\Base\Controller\Backend\UrlRewritesController;
use WellCart\Base\Spec\UrlRewriteRepository;

class UrlRewritesControllerFactory
{

    public function __invoke(ContainerInterface $sm
    ): UrlRewritesController {
        $controller = new UrlRewritesController(
            $sm->getServiceLocator()
                ->get(UrlRewriteRepository::class)
        );

        return $controller;
    }
}
