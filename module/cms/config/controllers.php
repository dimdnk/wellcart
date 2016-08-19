<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\CMS;

use Zend\Mvc\Controller\ControllerManager;

return [
    'factories' => [
        'WellCart\CMS\Controller\Admin\Pages' =>
            function (ControllerManager $sm) {
                $services = $sm->getServiceLocator();
                $controller = new Controller\Admin\PagesController(
                    $services->get(
                        'WellCart\CMS\Spec\PageI18nRepository'
                    )
                );
                return $controller;
            },
    ],
];
