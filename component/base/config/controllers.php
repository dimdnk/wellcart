<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Base;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use WellCart\ServiceManager\ServiceLocatorAwareInterface;
use Zend\Mvc\Controller\ControllerManager;

return [
    'initializers' => [
        'WellCart\ServiceManager\ServiceLocatorAwareInterface' =>
            function ( $sm, $service) {
                if ($service instanceof
                    ServiceLocatorAwareInterface
                ) {
                  $service->setServiceLocator($sm->getServiceLocator());
                }
            },
        'ObjectManagerInitializer'                             =>
            function ($sm, $service
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
            function ($sm, $service) {
                if ($service instanceof \Zend\Log\LoggerAwareInterface
                ) {
                    $logger = $sm->getServiceLocator()->get('logger');
                    $service->setLogger($logger);
                }
            },
        'Zend\I18n\Translator\TranslatorAwareInterface'
                                                               =>
            function ($sm, $service) {
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
];
