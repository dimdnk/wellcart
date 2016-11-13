<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\Base\Factory\Controller\Admin;

use Interop\Container\ContainerInterface;
use WellCart\Base\Controller\Admin\LanguagesController;

class LanguagesControllerFactory
{
    public function __invoke(ContainerInterface $sm
    ): LanguagesController {
        $controller = new LanguagesController(
            $sm->getServiceLocator()
                ->get('WellCart\Base\Spec\LocaleLanguageRepository')
        );
        return $controller;
    }
}
