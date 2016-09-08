<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Base\Factory\Controller\Admin;

use Interop\Container\ContainerInterface;
use WellCart\Base\Controller\Admin\UrlRewritesController;
use WellCart\Base\Spec\UrlRewriteRepository;

class UrlRewritesControllerFactory
{
    public function __invoke(ContainerInterface $sm)
    {
        $controller = new UrlRewritesController(
            $sm->getServiceLocator()
                ->get(UrlRewriteRepository::class)
        );
        return $controller;
    }
}
