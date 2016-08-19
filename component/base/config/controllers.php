<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Base;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use WellCart\ServiceManager\ServiceLocatorAwareInterface;
use Zend\Mvc\Controller\ControllerManager;

return [
    'initializers' => [
        'WellCart\ServiceManager\ServiceLocatorAwareInterface' =>
            function ($service, $sm) {
                if ($service instanceof
                    ServiceLocatorAwareInterface
                ) {
                    $service->setServiceLocator($sm->getServiceLocator());
                }
            },
        'ObjectManagerInitializer'                             =>
            function (
                $service,
                $sm
            ) {
                if ($service instanceof ObjectManagerAwareInterface) {
                    $services = $sm->getServiceLocator();
                    $entityManager = $services->get(
                        'Doctrine\ORM\EntityManager'
                    );
                    $service->setObjectManager($entityManager);
                }
            },
        'Zend\Log\LoggerAwareInterface'
                                                               =>
            function ($service, ControllerManager $sm) {
                if ($service instanceof \Zend\Log\LoggerAwareInterface
                ) {
                    $logger = $sm->getServiceLocator()->get('logger');
                    $service->setLogger($logger);
                }
            },
        'Zend\I18n\Translator\TranslatorAwareInterface'
                                                               =>
            function ($service, ControllerManager $sm) {
                if ($service instanceof
                    \Zend\I18n\Translator\TranslatorAwareInterface
                ) {
                    $translator = $sm->getServiceLocator()->get(
                        'translator'
                    );
                    $service->setTranslator($translator);
                }
            },
    ],
    'factories'    => [
        'WellCart\Base\Controller\Index'             =>
            function (ControllerManager $sm) {
                $controller = new Controller\IndexController();
                return $controller;
            },
        'WellCart\Base\Controller\ImageService'      =>
            function (ControllerManager $sm) {
                $services = $sm->getServiceLocator();
                $controller = new Controller\ImageServiceController(
                    $services->get('HtImgModule\Service\ImageService')
                );
                return $controller;
            },
        'WellCart\Base\Controller\Admin\Languages'   =>
            function (ControllerManager $sm) {
                $services = $sm->getServiceLocator();
                $controller = new Controller\Admin\LanguagesController(
                    $services->get(
                        'WellCart\Base\Spec\LocaleLanguageRepository'
                    )
                );
                return $controller;
            },
        'WellCart\Base\Controller\Admin\UrlRewrites' =>
            function (ControllerManager $sm) {
                $services = $sm->getServiceLocator();
                $controller = new Controller\Admin\UrlRewritesController(
                    $services->get(
                        'WellCart\Base\Spec\UrlRewriteRepository'
                    )
                );
                return $controller;
            },
    ],
];
