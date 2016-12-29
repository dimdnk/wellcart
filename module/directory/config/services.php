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

        PageView\Backend\CurrenciesGrid::class =>
            function (ContainerInterface $services) {
                return new PageView\Backend\CurrenciesGrid(
                    $services->get(
                        Spec\CurrencyRepository::class
                    ),
                    $services
                        ->get('Zend\Authentication\AuthenticationService')
                        ->getIdentity()
                        ->getTimeZone()
                );
            },

        PageView\Backend\CurrencyForm::class =>
            function (ContainerInterface $services) {
                return new PageView\Backend\CurrencyForm(
                    $services->get(Spec\CurrencyRepository::class)
                );
            },

        PageView\Backend\CountriesGrid::class =>
            function (ContainerInterface $services) {
                return new PageView\Backend\CountriesGrid(
                    $services->get(Spec\CountryRepository::class)
                );
            },

        PageView\Backend\CountryForm::class =>
            function (ContainerInterface $services) {
                return new PageView\Backend\CountryForm(
                    $services->get(Spec\CountryRepository::class)
                );
            },

        PageView\Backend\ZonesGrid::class =>
            function (ContainerInterface $services) {
                return new PageView\Backend\ZonesGrid(
                    $services->get(Spec\ZoneRepository::class)
                );
            },

        PageView\Backend\ZoneForm::class =>
            function (ContainerInterface $services) {
                return new PageView\Backend\ZoneForm(
                    $services->get(Spec\ZoneRepository::class)
                );
            },

        PageView\Backend\GeoZonesGrid::class =>
            function (ContainerInterface $services) {
                return new PageView\Backend\GeoZonesGrid(
                    $services->get(Spec\GeoZoneRepository::class)
                );
            },

        PageView\Backend\GeoZoneForm::class =>
            function (ContainerInterface $services) {
                return new PageView\Backend\GeoZoneForm(
                    $services->get(Spec\GeoZoneRepository::class)
                );
            },

        Repository\Currencies::class  =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_directory_object_manager')
                    ->getRepository(
                        Spec\CurrencyEntity::class
                    );
            },
        Form\Currency::class          =>
            function (ContainerInterface $services) {
                $form = new Form\Currency(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_directory_doctrine_hydrator')
                );
                return $form;
            },
        Repository\Countries::class   =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_directory_object_manager')
                    ->getRepository(
                        Spec\CountryEntity::class
                    );
            },
        Form\Country::class           =>
            function (ContainerInterface $services) {
                $form = new Form\Country(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_directory_doctrine_hydrator')
                );
                return $form;
            },
        Repository\Zones::class       =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_directory_object_manager')
                    ->getRepository(
                        Spec\ZoneEntity::class
                    );
            },
        Form\Zone::class              =>
            function (ContainerInterface $services) {
                $form = new Form\Zone(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_directory_doctrine_hydrator'),
                    $services->get(
                        Repository\Countries::class
                    )
                        ->toOptionsList()
                );
                return $form;
            },
        Repository\GeoZones::class    =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_directory_object_manager')
                    ->getRepository(
                        Spec\GeoZoneEntity::class
                    );
            },
        Repository\GeoZoneMaps::class =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_directory_object_manager')
                    ->getRepository(
                        Spec\GeoZoneMapEntity::class
                    );
            },
        Form\GeoZone::class           =>
            function (ContainerInterface $services) {
                $geoZonePrototype = $services->get(
                    Spec\GeoZoneRepository::class
                )->createEntity();


                $geoZoneMapPrototype = $services->get(
                    Spec\GeoZoneMapRepository::class
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
                    Spec\CurrencyRepository::class
                )
                    ->findPrimaryCurrency();
            },
    ],
];
