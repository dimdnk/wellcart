<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Base\Factory\Controller;

use WellCart\Base\Controller\ImageResizeController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ImageResizeControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $controller = new ImageResizeController(
            $sm->getServiceLocator()
                ->get('TckImageResizer\Service\ImageProcessing'),
            WELLCART_PUBLIC_PATH
        );
        return $controller;
    }
}
