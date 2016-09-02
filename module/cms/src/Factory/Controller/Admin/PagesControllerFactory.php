<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\CMS\Factory\Controller\Admin;

use WellCart\CMS\Controller\Admin\PagesController;
use WellCart\CMS\Spec\PageI18nRepository;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PagesControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $controller = new PagesController(
            $sm->getServiceLocator()
                ->get(PageI18nRepository::class)
        );
        return $controller;
    }
}
