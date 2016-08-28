<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Directory;

use Interop\Container\ContainerInterface;
use Zend\Form\Factory as FormFactory;

return [
    'factories' => [

        'WellCart\Directory\PageView\Admin\CurrenciesGrid' =>
            function (ContainerInterface $services) {
                return new PageView\Admin\CurrenciesGrid(
                    $services->get(
                        'WellCart\Directory\Spec\CurrencyRepository'
                    ),
                    $services
                        ->get('Zend\Authentication\AuthenticationService')
                        ->getIdentity()
                        ->getTimeZone()
                );
            },

        'WellCart\Directory\PageView\Admin\CurrencyForm'   =>
            function (ContainerInterface $services) {
                return new PageView\Admin\CurrencyForm(
                    $services->get('WellCart\Directory\Spec\CurrencyRepository')
                );
            },

        'WellCart\Directory\PageView\Admin\CountriesGrid'  =>
            function (ContainerInterface $services) {
                return new PageView\Admin\CountriesGrid(
                    $services->get('WellCart\Directory\Spec\CountryRepository')
                );
            },

        'WellCart\Directory\PageView\Admin\CountryForm'    =>
            function (ContainerInterface $services) {
                return new PageView\Admin\CountryForm(
                    $services->get('WellCart\Directory\Spec\CountryRepository')
                );
            },

        'WellCart\Directory\PageView\Admin\ZonesGrid'      =>
            function (ContainerInterface $services) {
                return new PageView\Admin\ZonesGrid(
                    $services->get('WellCart\Directory\Spec\ZoneRepository')
                );
            },

        'WellCart\Directory\PageView\Admin\ZoneForm'       =>
            function (ContainerInterface $services) {
                return new PageView\Admin\ZoneForm(
                    $services->get('WellCart\Directory\Spec\ZoneRepository')
                );
            },

        'WellCart\Directory\PageView\Admin\GeoZonesGrid'   =>
            function (ContainerInterface $services) {
                return new PageView\Admin\GeoZonesGrid(
                    $services->get('WellCart\Directory\Spec\GeoZoneRepository')
                );
            },

        'WellCart\Directory\PageView\Admin\GeoZoneForm'    =>
            function (ContainerInterface $services) {
                return new PageView\Admin\GeoZoneForm(
                    $services->get('WellCart\Directory\Spec\GeoZoneRepository')
                );
            },

        'WellCart\Directory\Repository\Currencies'         =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_directory_object_manager')
                    ->getRepository(
                        'WellCart\Directory\Spec\CurrencyEntity'
                    );
            },
        'WellCart\Directory\Form\Currency'                 =>
            function (ContainerInterface $services) {
                $form = new Form\Currency(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_directory_doctrine_hydrator')
                );
                return $form;
            },
        'WellCart\Directory\Repository\Countries'          =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_directory_object_manager')
                    ->getRepository(
                        'WellCart\Directory\Spec\CountryEntity'
                    );
            },
        'WellCart\Directory\Form\Country'                  =>
            function (ContainerInterface $services) {
                $form = new Form\Country(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_directory_doctrine_hydrator')
                );
                return $form;
            },
        'WellCart\Directory\Repository\Zones'              =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_directory_object_manager')
                    ->getRepository(
                        'WellCart\Directory\Spec\ZoneEntity'
                    );
            },
        'WellCart\Directory\Form\Zone'                     =>
            function (ContainerInterface $services) {
                $form = new Form\Zone(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_directory_doctrine_hydrator'),
                    $services->get(
                        'WellCart\Directory\Repository\Countries'
                    )
                        ->toOptionsList()
                );
                return $form;
            },
        'WellCart\Directory\Repository\GeoZones'           =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_directory_object_manager')
                    ->getRepository(
                        'WellCart\Directory\Spec\GeoZoneEntity'
                    );
            },
        'WellCart\Directory\Repository\GeoZoneMaps'        =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_directory_object_manager')
                    ->getRepository(
                        'WellCart\Directory\Spec\GeoZoneMapEntity'
                    );
            },
        'WellCart\Directory\Form\GeoZone'                  =>
            function (ContainerInterface $services) {
                $geoZonePrototype = $services->get(
                    'WellCart\Directory\Spec\GeoZoneRepository'
                )->createEntity();


                $geoZoneMapPrototype = $services->get(
                    'WellCart\Directory\Spec\GeoZoneMapRepository'
                )->createEntity();

                $form = new Form\GeoZone(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_directory_geo_zone_hydrator'),
                    $geoZonePrototype,
                    $geoZoneMapPrototype
                );
                return $form;
            },
        'wellcart_directory_geo_zone_hydrator'             =>
            function (ContainerInterface $services) {
                return new Hydrator\GeoZoneHydrator(
                    $services->get('wellcart_directory_object_manager')
                );
            },
        'directory\primary_currency'                       =>
            function (ContainerInterface $services) {
                return $services->get(
                    'WellCart\Directory\Spec\CurrencyRepository'
                )
                    ->findPrimaryCurrency();
            },
    ],
];
