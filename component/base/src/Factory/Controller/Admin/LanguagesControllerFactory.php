<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Base\Factory\Controller\Admin;

use WellCart\Base\Controller\Admin\LanguagesController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LanguagesControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $controller = new LanguagesController(
            $sm->getServiceLocator()
                ->get('WellCart\Base\Spec\LocaleLanguageRepository')
        );
        return $controller;
    }
}
