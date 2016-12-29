<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
return [
    'object_mapping' => [
        'WellCart\Directory\Entity\Country' =>
            [
                'type' => 'entity',
                'repositoryClass' => 'WellCart\Directory\Repository\Countries',
                'table' => 'directory_countries',
                'id' =>
                    [
                        'id' =>
                            [
                                'column' => 'country_id',
                                'type' => 'integer',
                                'nullable' => false,
                                'generator' =>
                                    [
                                        'strategy' => 'AUTO',
                                    ],
                            ],
                    ],
                'fields' =>
                    [
                        'name' =>
                            [
                                'column' => 'name',
                                'type' => 'string',
                                'nullable' => false,
                                'input_filter_specification' => [
                                    'required' => true,
                                    'filters' => [
                                        'StripTags' => ['name' => 'StripTags'],
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null' => ['name' => 'Null'],
                                    ],
                                    'validators' => [
                                        'NotEmpty' => [
                                            'name' => 'NotEmpty',
                                        ],
                                        'StringLength' => [
                                            'name' => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min' => 1,
                                                'max' => 255,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'status' =>
                            [
                                'column' => 'status',
                                'type' => 'integer',
                                'nullable' => false,
                                'input_filter_specification' => [
                                    'required' => false,
                                    'filters' => [
                                        'StripTags' => ['name' => 'StripTags'],
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                    ],
                                    'validators' => [
                                        'Digits' => [
                                            'name' => 'Digits',
                                        ],
                                        'Between' => [
                                            'name' => 'Between',
                                            'options' => [
                                                'min' => 0,
                                                'max' => 1,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'postcodeRequired' =>
                            [
                                'column' => 'postcode_required',
                                'type' => 'boolean',
                                'nullable' => true,
                                'input_filter_specification' => [
                                    'required' => false,
                                    'filters' => [
                                        'StripTags' => ['name' => 'StripTags'],
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                    ],
                                    'validators' => [
                                        'Between' => [
                                            'name' => 'Between',
                                            'options' => [
                                                'min' => 0,
                                                'max' => 1,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'addressFormat' =>
                            [
                                'column' => 'address_format',
                                'type' => 'string',
                                'nullable' => true,
                                'input_filter_specification' => [
                                    'required' => false,
                                    'filters' => [
                                        'StripTags' => ['name' => 'StripTags'],
                                        'Null' => ['name' => 'Null'],
                                    ],
                                    'validators' => [
                                        'StringLength' => [
                                            'name' => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'max' => 255,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'isoCode2' =>
                            [
                                'column' => 'iso_code_2',
                                'type' => 'string',
                                'nullable' => true,
                                'input_filter_specification' => [
                                    'required' => true,
                                    'filters' => [
                                        'StripTags' => ['name' => 'StripTags'],
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null' => ['name' => 'Null'],
                                    ],
                                    'validators' => [
                                        'NotEmpty' => [
                                            'name' => 'NotEmpty',
                                        ],
                                        'StringLength' => [
                                            'name' => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min' => 2,
                                                'max' => 2,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'isoCode3' =>
                            [
                                'column' => 'iso_code_3',
                                'type' => 'string',
                                'nullable' => true,
                                'input_filter_specification' => [
                                    'required' => true,
                                    'filters' => [
                                        'StripTags' => ['name' => 'StripTags'],
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null' => ['name' => 'Null'],
                                    ],
                                    'validators' => [
                                        'NotEmpty' => [
                                            'name' => 'NotEmpty',
                                        ],
                                        'StringLength' => [
                                            'name' => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min' => 3,
                                                'max' => 3,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'createdAt' =>
                            [
                                'column' => 'created_at',
                                'type' => 'datetime',
                                'nullable' => false,
                                'gedmo' =>
                                    [
                                        'timestampable' =>
                                            [
                                                'on' => 'create',
                                            ],
                                    ],
                            ],
                        'updatedAt' =>
                            [
                                'column' => 'updated_at',
                                'type' => 'datetime',
                                'nullable' => true,
                                'gedmo' =>
                                    [
                                        'timestampable' =>
                                            [
                                                'on' => 'update',
                                            ],
                                    ],
                            ],
                    ],
            ],
        'WellCart\Directory\Entity\Currency' =>
            [
                'type' => 'entity',
                'entityListeners' => [
                    'WellCart\Directory\EventListener\Entity\CurrencyEntityListener' => [
                        'prePersist' => ['prePersist' => 'prePersist'],
                        'preUpdate' => ['prePersist' => 'preUpdate'],
                        'postPersist' => ['postPersist' => 'postPersist'],
                        'postUpdate' => ['postUpdate' => 'postUpdate'],
                        'preRemove' => ['preRemove' => 'preRemove'],
                    ],
                ],
                'repositoryClass' => 'WellCart\Directory\Repository\Currencies',
                'table' => 'directory_currencies',
                'id' =>
                    [
                        'id' =>
                            [
                                'column' => 'currency_id',
                                'type' => 'integer',
                                'nullable' => false,
                                'generator' =>
                                    [
                                        'strategy' => 'AUTO',
                                    ],
                            ],
                    ],
                'fields' =>
                    [
                        'title' =>
                            [
                                'column' => 'title',
                                'type' => 'string',
                                'nullable' => true,
                                'input_filter_specification' => [
                                    'required' => true,
                                    'filters' => [
                                        'StripTags' => ['name' => 'StripTags'],
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null' => ['name' => 'Null'],
                                    ],
                                    'validators' => [
                                        'NotEmpty' => [
                                            'name' => 'NotEmpty',
                                        ],
                                        'StringLength' => [
                                            'name' => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min' => 1,
                                                'max' => 255,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'code' =>
                            [
                                'column' => 'code',
                                'type' => 'string',
                                'nullable' => true,
                                'input_filter_specification' => [
                                    'required' => true,
                                    'filters' => [
                                        'StripTags' => ['name' => 'StripTags'],
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'StringToUpper' => ['name' => 'StringToUpper',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                            ],],
                                        'Null' => ['name' => 'Null'],
                                    ],
                                    'validators' => [
                                        'NotEmpty' => [
                                            'name' => 'NotEmpty',
                                        ],
                                        'StringLength' => [
                                            'name' => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min' => 3,
                                                'max' => 3,
                                            ],
                                        ],
                                        'CurrencyCode' => ['name' => 'NetglueMoney\Validator\CurrencyCode'],
                                        'NoObjectExists' => [
                                            'name' => 'WellCart\ORM\Validator\NoObjectExists',
                                            'options' => [
                                                'entity_class' => 'WellCart\Directory\Entity\Currency',
                                                'fields' => ['code'],
                                                'messages' => [
                                                    'objectFound' => 'Currency with this code already exists!'
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'symbol' =>
                            [
                                'column' => 'symbol',
                                'type' => 'string',
                                'nullable' => true,
                                'input_filter_specification' => [
                                    'required' => true,
                                    'filters' => [
                                        'StripTags' => ['name' => 'StripTags'],
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null' => ['name' => 'Null'],
                                    ],
                                    'validators' => [
                                        'NotEmpty' => [
                                            'name' => 'NotEmpty',
                                        ],
                                        'StringLength' => [
                                            'name' => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min' => 1,
                                                'max' => 3,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'symbolPosition' =>
                            [
                                'column' => 'symbol_position',
                                'type' => 'string',
                                'nullable' => true,
                                'input_filter_specification' => [
                                    'required' => true,
                                    'filters' => [
                                        'StripTags' => ['name' => 'StripTags'],
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null' => ['name' => 'Null'],
                                    ],
                                    'validators' => [
                                        'NotEmpty' => [
                                            'name' => 'NotEmpty',
                                        ],
                                        'StringLength' => [
                                            'name' => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min' => 1,
                                                'max' => 5,
                                            ],
                                        ],
                                        'InArray' => [
                                            'name' => 'InArray',
                                            'options' => [
                                                'haystack' => [
                                                    'left',
                                                    'right'
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'exchangeRate' =>
                            [
                                'column' => 'exchange_rate',
                                'type' => 'decimal',
                                'nullable' => true,
                                'input_filter_specification' => [
                                    'required' => true,
                                    'filters' => [
                                        'StripTags' => ['name' => 'StripTags'],
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null' => ['name' => 'Null'],
                                    ],
                                    'validators' => [
                                        'Zend\I18n\Validator\IsFloat' => [
                                            'name' => 'Zend\I18n\Validator\IsFloat',
                                        ],
                                        'NotEmpty' => [
                                            'name' => 'NotEmpty',
                                        ],
                                    ],
                                ],
                            ],
                        'decimals' =>
                            [
                                'column' => 'decimals',
                                'type' => 'integer',
                                'nullable' => true,
                                'input_filter_specification' => [
                                    'required' => true,
                                    'filters' => [
                                        'StripTags' => ['name' => 'StripTags'],
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null' => ['name' => 'Null'],
                                    ],
                                    'validators' => [
                                        'Digits' => [
                                            'name' => 'Digits',
                                        ],
                                        'Between' => [
                                            'name' => 'Between',
                                            'options' => [
                                                'min' => 0,
                                                'max' => 4,
                                            ],
                                        ],
                                        'NotEmpty' => [
                                            'name' => 'NotEmpty',
                                        ],
                                    ],
                                ],
                            ],
                        'decimalsSeparator' =>
                            [
                                'column' => 'decimals_separator',
                                'type' => 'string',
                                'nullable' => true,
                                'input_filter_specification' => [
                                    'required' => true,
                                    'filters' => [
                                        'StripTags' => ['name' => 'StripTags'],
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null' => ['name' => 'Null'],
                                    ],
                                    'validators' => [
                                        'NotEmpty' => [
                                            'name' => 'NotEmpty',
                                        ],
                                        'StringLength' => [
                                            'name' => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min' => 1,
                                                'max' => 1,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'thousandsSeparator' =>
                            [
                                'column' => 'thousands_separator',
                                'type' => 'string',
                                'nullable' => true,
                                'input_filter_specification' => [
                                    'required' => true,
                                    'filters' => [
                                        'StripTags' => ['name' => 'StripTags'],
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null' => ['name' => 'Null'],
                                    ],
                                    'validators' => [
                                        'NotEmpty' => [
                                            'name' => 'NotEmpty',
                                        ],
                                        'StringLength' => [
                                            'name' => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min' => 1,
                                                'max' => 1,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'status' =>
                            [
                                'column' => 'status',
                                'type' => 'integer',
                                'nullable' => true,
                                'input_filter_specification' => [
                                    'required' => false,
                                    'filters' => [
                                        'StripTags' => ['name' => 'StripTags'],
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                    ],
                                    'validators' => [
                                        'Digits' => [
                                            'name' => 'Digits',
                                        ],
                                        'NotEmpty' => [
                                            'name' => 'NotEmpty',
                                        ],
                                    ],
                                ],
                            ],
                        'isPrimary' =>
                            [
                                'column' => 'is_primary',
                                'type' => 'boolean',
                                'nullable' => true,
                                'input_filter_specification' => [
                                    'required' => false,
                                    'filters' => [
                                        'StripTags' => ['name' => 'StripTags'],
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                    ],
                                    'validators' => [
                                        'Between' => [
                                            'name' => 'Between',
                                            'options' => [
                                                'min' => 0,
                                                'max' => 1,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'createdAt' =>
                            [
                                'column' => 'created_at',
                                'type' => 'datetime',
                                'nullable' => false,
                                'gedmo' =>
                                    [
                                        'timestampable' =>
                                            [
                                                'on' => 'create',
                                            ],
                                    ],
                            ],
                        'updatedAt' =>
                            [
                                'column' => 'updated_at',
                                'type' => 'datetime',
                                'nullable' => true,
                                'gedmo' =>
                                    [
                                        'timestampable' =>
                                            [
                                                'on' => 'update',
                                            ],
                                    ],
                            ],
                    ],
            ],
        'WellCart\Directory\Entity\GeoZone' =>
            [
                'type' => 'entity',
                'repositoryClass' => 'WellCart\Directory\Repository\GeoZones',
                'table' => 'directory_geo_zones',
                'oneToMany' => [
                    'geoZoneMaps' => [
                        'targetEntity' => 'WellCart\Directory\Entity\GeoZoneMap',
                        'mappedBy' => 'geoZone',
                        'orphanRemoval' => true,
                        'cascade' => ['persist', 'merge', 'detach'],
                    ],
                ],
                'id' =>
                    [
                        'id' =>
                            [
                                'column' => 'geo_zone_id',
                                'type' => 'integer',
                                'nullable' => false,
                                'generator' =>
                                    [
                                        'strategy' => 'AUTO',
                                    ],
                            ],
                    ],
                'fields' =>
                    [
                        'name' =>
                            [
                                'column' => 'name',
                                'type' => 'string',
                                'nullable' => true,
                                'input_filter_specification' => [
                                    'required' => true,
                                    'filters' => [
                                        'StripTags' => ['name' => 'StripTags'],
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null' => ['name' => 'Null'],
                                    ],
                                    'validators' => [
                                        'NotEmpty' => [
                                            'name' => 'NotEmpty',
                                        ],
                                        'StringLength' => [
                                            'name' => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min' => 1,
                                                'max' => 255,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'description' =>
                            [
                                'column' => 'description',
                                'type' => 'string',
                                'nullable' => true,
                                'input_filter_specification' => [
                                    'required' => true,
                                    'filters' => [
                                        'StripTags' => ['name' => 'StripTags'],
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null' => ['name' => 'Null'],
                                    ],
                                    'validators' => [
                                        'NotEmpty' => [
                                            'name' => 'NotEmpty',
                                        ],
                                        'StringLength' => [
                                            'name' => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min' => 1,
                                                'max' => 255,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'createdAt' =>
                            [
                                'column' => 'created_at',
                                'type' => 'datetime',
                                'nullable' => false,
                                'gedmo' =>
                                    [
                                        'timestampable' =>
                                            [
                                                'on' => 'create',
                                            ],
                                    ],
                            ],
                        'updatedAt' =>
                            [
                                'column' => 'updated_at',
                                'type' => 'datetime',
                                'nullable' => true,
                                'gedmo' =>
                                    [
                                        'timestampable' =>
                                            [
                                                'on' => 'update',
                                            ],
                                    ],
                            ],
                    ],
            ],
        'WellCart\Directory\Entity\GeoZoneMap' =>
            [
                'type' => 'entity',
                'repositoryClass' => 'WellCart\Directory\Repository\GeoZoneMaps',
                'table' => 'directory_zone_to_geo_zone',
                'id' =>
                    [
                        'id' =>
                            [
                                'column' => 'zone_to_geo_zone_id',
                                'type' => 'integer',
                                'nullable' => false,
                                'generator' =>
                                    [
                                        'strategy' => 'AUTO',
                                    ],
                            ],
                    ],
                'oneToOne' => [
                    'country' => [
                        'targetEntity' => 'WellCart\Directory\Entity\Country',
                        'joinColumn' => [
                            'name' => 'country_id',
                            'referencedColumnName' => 'country_id'
                        ],
                    ],
                    'zone' => [
                        'targetEntity' => 'WellCart\Directory\Entity\Zone',
                        'joinColumn' => [
                            'name' => 'zone_id',
                            'referencedColumnName' => 'zone_id'
                        ],
                    ],
                ],
                'manyToOne' => [
                    'geoZone' => [
                        'targetEntity' => 'WellCart\Directory\Entity\GeoZone',
                        'inversedBy' => 'geoZoneMaps',
                        'joinColumn' => [
                            'name' => 'geo_zone_id',
                            'referencedColumnName' => 'geo_zone_id'
                        ],
                    ],
                ],
                'fields' =>
                    [
                        'countryId' =>
                            [
                                'column' => 'country_id',
                                'type' => 'integer',
                                'nullable' => true,
                            ],
                        'zoneId' =>
                            [
                                'column' => 'zone_id',
                                'type' => 'integer',
                                'nullable' => true,
                            ],
                        'geoZoneId' =>
                            [
                                'column' => 'geo_zone_id',
                                'type' => 'integer',
                                'nullable' => true,
                            ],
                        'createdAt' =>
                            [
                                'column' => 'created_at',
                                'type' => 'datetime',
                                'nullable' => false,
                                'gedmo' =>
                                    [
                                        'timestampable' =>
                                            [
                                                'on' => 'create',
                                            ],
                                    ],
                            ],
                        'updatedAt' =>
                            [
                                'column' => 'updated_at',
                                'type' => 'datetime',
                                'nullable' => true,
                                'gedmo' =>
                                    [
                                        'timestampable' =>
                                            [
                                                'on' => 'update',
                                            ],
                                    ],
                            ],
                    ],
            ],
        'WellCart\Directory\Entity\Zone' =>
            [
                'type' => 'entity',
                'repositoryClass' => 'WellCart\Directory\Repository\Zones',
                'table' => 'directory_zones',
                'oneToOne' => [
                    'country' => [
                        'targetEntity' => 'WellCart\Directory\Entity\Country',
                        'joinColumn' => [
                            'name' => 'country_id',
                            'referencedColumnName' => 'country_id'
                        ],
                    ],
                ],
                'id' =>
                    [
                        'id' =>
                            [
                                'column' => 'zone_id',
                                'type' => 'integer',
                                'nullable' => false,
                                'generator' =>
                                    [
                                        'strategy' => 'AUTO',
                                    ],
                            ],
                    ],
                'fields' =>
                    [
                        'name' =>
                            [
                                'column' => 'name',
                                'type' => 'string',
                                'nullable' => false,
                                'input_filter_specification' => [
                                    'required' => true,
                                    'filters' => [
                                        'StripTags' => ['name' => 'StripTags'],
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null' => ['name' => 'Null'],
                                    ],
                                    'validators' => [
                                        'NotEmpty' => [
                                            'name' => 'NotEmpty',
                                        ],
                                        'StringLength' => [
                                            'name' => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min' => 1,
                                                'max' => 255,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'code' =>
                            [
                                'column' => 'code',
                                'type' => 'string',
                                'nullable' => false,
                                'input_filter_specification' => [
                                    'required' => true,
                                    'filters' => [
                                        'StripTags' => ['name' => 'StripTags'],
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null' => ['name' => 'Null'],
                                    ],
                                    'validators' => [
                                        'NotEmpty' => [
                                            'name' => 'NotEmpty',
                                        ],
                                        'StringLength' => [
                                            'name' => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min' => 1,
                                                'max' => 32,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'status' =>
                            [
                                'column' => 'status',
                                'type' => 'integer',
                                'nullable' => false,
                                'input_filter_specification' => [
                                    'required' => false,
                                    'filters' => [
                                        'StripTags' => ['name' => 'StripTags'],
                                        'StringTrim' => ['name' => 'StringTrim'],
                                        'StripNewlines' => ['name' => 'StripNewlines'],
                                        'Null' => ['name' => 'Null'],
                                    ],
                                    'validators' => [
                                        'Digits' => [
                                            'name' => 'Digits',
                                        ],
                                        'InArray' => [
                                            'name' => 'InArray',
                                            'options' => [
                                                'haystack' => [0, 1],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        'countryId' =>
                            [
                                'column' => 'country_id',
                                'type' => 'integer',
                                'nullable' => true,
                            ],
                        'createdAt' =>
                            [
                                'column' => 'created_at',
                                'type' => 'datetime',
                                'nullable' => false,
                                'gedmo' =>
                                    [
                                        'timestampable' =>
                                            [
                                                'on' => 'create',
                                            ],
                                    ],
                            ],
                        'updatedAt' =>
                            [
                                'column' => 'updated_at',
                                'type' => 'datetime',
                                'nullable' => true,
                                'gedmo' =>
                                    [
                                        'timestampable' =>
                                            [
                                                'on' => 'update',
                                            ],
                                    ],
                            ],
                    ],
            ]
    ]
];
