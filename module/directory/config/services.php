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

        'WellCart\Directory\PageView\Backend\CurrenciesGrid' =>
            function (ContainerInterface $services) {
                return new PageView\Backend\CurrenciesGrid(
                    $services->get(
                        'WellCart\Directory\Spec\CurrencyRepository'
                    ),
                    $services
                        ->get('Zend\Authentication\AuthenticationService')
                        ->getIdentity()
                        ->getTimeZone()
                );
            },

        'WellCart\Directory\PageView\Backend\CurrencyForm' =>
            function (ContainerInterface $services) {
                return new PageView\Backend\CurrencyForm(
                    $services->get('WellCart\Directory\Spec\CurrencyRepository')
                );
            },

        'WellCart\Directory\PageView\Backend\CountriesGrid' =>
            function (ContainerInterface $services) {
                return new PageView\Backend\CountriesGrid(
                    $services->get('WellCart\Directory\Spec\CountryRepository')
                );
            },

        'WellCart\Directory\PageView\Backend\CountryForm' =>
            function (ContainerInterface $services) {
                return new PageView\Backend\CountryForm(
                    $services->get('WellCart\Directory\Spec\CountryRepository')
                );
            },

        'WellCart\Directory\PageView\Backend\ZonesGrid' =>
            function (ContainerInterface $services) {
                return new PageView\Backend\ZonesGrid(
                    $services->get('WellCart\Directory\Spec\ZoneRepository')
                );
            },

        'WellCart\Directory\PageView\Backend\ZoneForm' =>
            function (ContainerInterface $services) {
                return new PageView\Backend\ZoneForm(
                    $services->get('WellCart\Directory\Spec\ZoneRepository')
                );
            },

        'WellCart\Directory\PageView\Backend\GeoZonesGrid' =>
            function (ContainerInterface $services) {
                return new PageView\Backend\GeoZonesGrid(
                    $services->get('WellCart\Directory\Spec\GeoZoneRepository')
                );
            },

        'WellCart\Directory\PageView\Backend\GeoZoneForm' =>
            function (ContainerInterface $services) {
                return new PageView\Backend\GeoZoneForm(
                    $services->get('WellCart\Directory\Spec\GeoZoneRepository')
                );
            },

        'WellCart\Directory\Repository\Currencies'  =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_directory_object_manager')
                    ->getRepository(
                        'WellCart\Directory\Spec\CurrencyEntity'
                    );
            },
        'WellCart\Directory\Form\Currency'          =>
            function (ContainerInterface $services) {
                $form = new Form\Currency(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_directory_doctrine_hydrator')
                );
                return $form;
            },
        'WellCart\Directory\Repository\Countries'   =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_directory_object_manager')
                    ->getRepository(
                        'WellCart\Directory\Spec\CountryEntity'
                    );
            },
        'WellCart\Directory\Form\Country'           =>
            function (ContainerInterface $services) {
                $form = new Form\Country(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_directory_doctrine_hydrator')
                );
                return $form;
            },
        'WellCart\Directory\Repository\Zones'       =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_directory_object_manager')
                    ->getRepository(
                        'WellCart\Directory\Spec\ZoneEntity'
                    );
            },
        'WellCart\Directory\Form\Zone'              =>
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
        'WellCart\Directory\Repository\GeoZones'    =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_directory_object_manager')
                    ->getRepository(
                        'WellCart\Directory\Spec\GeoZoneEntity'
                    );
            },
        'WellCart\Directory\Repository\GeoZoneMaps' =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_directory_object_manager')
                    ->getRepository(
                        'WellCart\Directory\Spec\GeoZoneMapEntity'
                    );
            },
        'WellCart\Directory\Form\GeoZone'           =>
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
        'wellcart_directory_geo_zone_hydrator'      =>
            function (ContainerInterface $services) {
                return new Hydrator\GeoZoneHydrator(
                    $services->get('wellcart_directory_object_manager')
                );
            },
        'directory\primary_currency'                =>
            function (ContainerInterface $services) {
                return $services->get(
                    'WellCart\Directory\Spec\CurrencyRepository'
                )
                    ->findPrimaryCurrency();
            },
    ],
];
