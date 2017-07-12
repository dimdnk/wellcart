<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Catalog;

return [
    /**
     * =========================================================
     * Doctrine configuration
     * =========================================================
     */
    'doctrine' => [
        'driver'          => [
            'wellcart_catalog_driver' => [
                'class' => 'WellCart\ORM\Mapping\Driver\SystemConfigDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ => __DIR__ . '/../src/Entity/',
                ],
            ],
            // default metadata driver, aggregates all other drivers into a single one.
            'orm_default'             => [
                'drivers' => [
                    'WellCart\Catalog\Entity' => 'wellcart_catalog_driver',
                ],
            ],
        ],
        'entity_resolver' => [
            'orm_default' => [
                'resolvers' => [
                    Spec\BrandEntity::class         => Entity\Brand::class,
                    Spec\CategoryEntity::class      => Entity\Category::class,
                    Spec\CategoryI18nEntity::class  => Entity\CategoryI18n::class,
                    Spec\AttributeEntity::class     => Entity\Attribute::class,
                    Spec\AttributeI18nEntity::class => Entity\AttributeI18n::class,

                    Spec\AttributeValueEntity::class      => Entity\AttributeValue::class,
                    Spec\AttributeValueI18nEntity::class  => Entity\AttributeValueI18n::class,
                    Spec\ProductTemplateEntity::class     => Entity\ProductTemplate::class,
                    Spec\ProductTemplateI18nEntity::class => Entity\ProductTemplateI18n::class,

                    Spec\FeatureEntity::class     => Entity\Feature::class,
                    Spec\FeatureI18nEntity::class => Entity\FeatureI18n::class,

                    Spec\FeatureValueEntity::class     => Entity\FeatureValue::class,
                    Spec\FeatureValueI18nEntity::class => Entity\FeatureValueI18n::class,

                    Spec\ProductEntity::class              => Entity\Product::class,
                    Spec\ProductI18nEntity::class          => Entity\ProductI18n::class,
                    Spec\ProductVariantEntity::class       => Entity\ProductVariant::class,
                    Spec\AttributeCombinationEntity::class => Entity\AttributeCombination::class,
                    Spec\ProductImageEntity::class         => Entity\ProductImage::class,
                    'Catalog::Brand'                       => Entity\Brand::class,
                    'Catalog::Category'                    => Entity\Category::class,
                    'Catalog::CategoryI18n'                => Entity\CategoryI18n::class,


                    'Catalog::Attribute'           => Entity\Attribute::class,
                    'Catalog::AttributeI18n'       => Entity\AttributeI18n::class,
                    'Catalog::ProductTemplate'     => Entity\ProductTemplate::class,
                    'Catalog::ProductTemplateI18n' => Entity\ProductTemplateI18n::class,

                    'Catalog::Feature'     => Entity\Feature::class,
                    'Catalog::FeatureI18n' => Entity\FeatureI18n::class,

                    'Catalog::FeatureValue'     => Entity\Feature::class,
                    'Catalog::FeatureI18nValue' => Entity\FeatureI18n::class,

                    'Catalog::Product'      => Entity\Product::class,
                    'Catalog::ProductI18n'  => Entity\ProductI18n::class,
                    'Catalog::ProductImage' => Entity\ProductImage::class,
                ],
            ],
        ],
    ],
];
