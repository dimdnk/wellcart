<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Factory\Controller;

use Interop\Container\ContainerInterface;
use WellCart\Base\Controller\ImageResizeController;

class ImageResizeControllerFactory
{
    public function __invoke(ContainerInterface $sm
    ): ImageResizeController {
        $controller = new ImageResizeController(
            $sm->getServiceLocator()
                ->get('TckImageResizer\Service\ImageProcessing'),
            WELLCART_PUBLIC_PATH
        );
        return $controller;
    }
}
