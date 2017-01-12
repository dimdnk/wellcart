<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\CMS\Factory\Controller\Backend;

use Interop\Container\ContainerInterface;
use WellCart\CMS\Controller\Backend\PagesController;
use WellCart\CMS\Spec\PageI18nRepository;

class PagesControllerFactory
{

    public function __invoke(ContainerInterface $sm): PagesController
    {
        $controller = new PagesController(
            $sm->getServiceLocator()
                ->get(PageI18nRepository::class)
        );

        return $controller;
    }
}
