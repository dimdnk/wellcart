<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Directory;

use Zend\Mvc\Controller\ControllerManager;

return [
    'invokables' => [
        'WellCart\Directory\Controller\Console\UpdateCurrencyRates' => 'WellCart\Directory\Controller\Console\UpdateCurrencyRatesController',
    ],
    'factories'  => [
        'WellCart\Directory\Controller\Admin\Currencies' =>
            function (ControllerManager $sm) {
                $services = $sm->getServiceLocator();
                $controller = new Controller\Admin\CurrenciesController(
                    $services->get(
                        'WellCart\Directory\Spec\CurrencyRepository'
                    )
                );
                return $controller;
            },
        'WellCart\Directory\Controller\Admin\Countries'  =>
            function (ControllerManager $sm) {
                $services = $sm->getServiceLocator();
                $controller = new Controller\Admin\CountriesController(
                    $services->get(
                        'WellCart\Directory\Spec\CountryRepository'
                    )
                );
                return $controller;
            },
        'WellCart\Directory\Controller\Admin\Zones'      =>
            function (ControllerManager $sm) {
                $services = $sm->getServiceLocator();
                $controller = new Controller\Admin\ZonesController(
                    $services->get(
                        'WellCart\Directory\Spec\ZoneRepository'
                    )
                );
                return $controller;
            },
        'WellCart\Directory\Controller\Admin\GeoZones'   =>
            function (ControllerManager $sm) {
                $services = $sm->getServiceLocator();
                $controller = new Controller\Admin\GeoZonesController(
                    $services->get(
                        'WellCart\Directory\Spec\GeoZoneRepository'
                    )
                );
                return $controller;
            },
    ],
];
