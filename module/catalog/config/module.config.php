<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

use WellCart\Catalog;

return [
    /**
     * =========================================================
     * Service manager configuration
     * =========================================================
     */
    'service_manager'            => [
        'aliases'            => [
            'wellcart_catalog_db_adapter'                     => 'Zend\Db\Adapter\Adapter',
            'wellcart_catalog_object_manager'                 => 'Doctrine\ORM\EntityManager',
            'wellcart_catalog_doctrine_hydrator'              => 'doctrine_hydrator',
            Catalog\Spec\BrandRepository::class               => Catalog\Repository\Brands::class,
            Catalog\Spec\CategoryRepository::class            => Catalog\Repository\Categories::class,
            Catalog\Spec\CategoryI18nRepository::class        => Catalog\Repository\CategoryI18n::class,
            Catalog\Spec\ProductTemplateRepository::class     => Catalog\Repository\ProductTemplates::class,
            Catalog\Spec\ProductTemplateI18nRepository::class => Catalog\Repository\ProductTemplateI18n::class,

            Catalog\Spec\AttributeRepository::class           => Catalog\Repository\Attributes::class,
            Catalog\Spec\AttributeI18nRepository::class       => Catalog\Repository\AttributeI18n::class,
            Catalog\Spec\AttributeValueRepository::class      => Catalog\Repository\AttributeValues::class,
            Catalog\Spec\AttributeValueI18nRepository::class  => Catalog\Repository\AttributeValueI18n::class,

            Catalog\Spec\FeatureRepository::class             => Catalog\Repository\Features::class,
            Catalog\Spec\FeatureI18nRepository::class         => Catalog\Repository\FeatureI18n::class,
            Catalog\Spec\FeatureValueRepository::class        => Catalog\Repository\FeatureValues::class,
            Catalog\Spec\FeatureValueI18nRepository::class    => Catalog\Repository\FeatureValueI18n::class,
            Catalog\Spec\ProductVariantRepository::class      => Catalog\Repository\ProductVariants::class,
            Catalog\Spec\ProductImageRepository::class        => Catalog\Repository\ProductImages::class,
            Catalog\Spec\ProductRepository::class             => Catalog\Repository\Products::class,
            Catalog\Spec\ProductI18nRepository::class         => Catalog\Repository\ProductI18n::class,
        ],
        'invokables'         => [
            Catalog\Command\Handler\PersistProductHandler::class => Catalog\Command\Handler\PersistProductHandler::class,
            Catalog\ItemView\Admin\BrandThumbnail::class         => Catalog\ItemView\Admin\BrandThumbnail::class
        ],
        'factories'          => [],
        'abstract_factories' => [],
        'services'           => [],
        'initializers'       => [],
        'shared'             => [
            Catalog\PageView\Admin\ProductsGrid::class         => false,
            Catalog\PageView\Admin\ProductForm::class          => false,
            Catalog\PageView\Admin\ProductTemplatesGrid::class => false,
            Catalog\PageView\Admin\ProductTemplateForm::class  => false,
            Catalog\PageView\Admin\AttributesGrid::class       => false,
            Catalog\PageView\Admin\AttributeForm::class        => false,
            Catalog\PageView\Admin\FeaturesGrid::class         => false,
            Catalog\PageView\Admin\FeatureForm::class          => false,
            Catalog\PageView\Admin\CategoriesGrid::class       => false,
            Catalog\PageView\Admin\CategoryForm::class         => false,
            Catalog\PageView\Admin\BrandsGrid::class           => false,
            Catalog\PageView\Admin\BrandForm::class            => false,
            Catalog\ItemView\Admin\BrandThumbnail::class       => false,
        ],
    ],

    /**
     * =========================================================
     * Router configuration
     * =========================================================
     */
    'router'                     => [
        'routes' => [
            'zfcadmin' => [
                'child_routes' => [
                    'catalog' => [
                        'type'         => 'WellCart\Router\Http\Literal',
                        'priority'     => -500,
                        'options'      => [
                            'route'    => 'catalog/',
                            'defaults' => [
                                'controller' => Catalog\Controller\Admin\Products::class,
                                'action'     => 'list',
                            ],
                        ],
                        'child_routes' => [
                            'products'          => [
                                'type'             => \WellCart\Router\Http\Segment::class,
                                'javascript_route' => true,
                                'priority'         => -500,
                                'options'          => [
                                    'route'       => 'products[/:action][/][:id][/:template]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '(list|update|create|variants|group-action-handler)',
                                        'id'         => '([0-9]+)',
                                        'template'   => '([0-9]+)',
                                    ],
                                    'defaults'    => [
                                        'controller' => 'WellCart\Catalog\Controller\Admin\Products',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],
                            'categories'        => [
                                'type'             => 'WellCart\Router\Http\Segment',
                                'javascript_route' => true,
                                'priority'         => -500,
                                'options'          => [
                                    'route'       => 'categories[/:action][/][:id]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '(list|update|create|delete|group-action-handler)',
                                        'id'         => '([0-9]+|deleteCategories)',
                                    ],
                                    'defaults'    => [
                                        'controller' => 'WellCart\Catalog\Controller\Admin\Categories',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],
                            'features'          => [
                                'type'             => 'WellCart\Router\Http\Segment',
                                'javascript_route' => true,
                                'options'          => [
                                    'route'       => 'features[/:action][/][:id]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '(list|update|create|delete)',
                                        'id'         => '([0-9]+|delete)',
                                    ],
                                    'defaults'    => [
                                        'controller' => 'WellCart\Catalog\Controller\Admin\Features',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],

                            'product-templates' => [
                                'type'             => 'WellCart\Router\Http\Segment',
                                'javascript_route' => true,
                                'options'          => [
                                    'route'       => 'product-templates[/:action][/][:id]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '(list|update|create|delete|group-action-handler)',
                                        'id'         => '([0-9]+|deleteProductTemplates)',
                                    ],
                                    'defaults'    => [
                                        'controller' => 'WellCart\Catalog\Controller\Admin\ProductTemplates',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],

                            'attributes'        => [
                                'type'             => 'WellCart\Router\Http\Segment',
                                'javascript_route' => true,
                                'options'          => [
                                    'route'       => 'attributes[/:action][/][:id]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '(list|update|create|delete|group-action-handler)',
                                        'id'         => '([0-9]+|deleteAttributes)',
                                    ],
                                    'defaults'    => [
                                        'controller' => 'WellCart\Catalog\Controller\Admin\Attributes',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],

                            'brands'            => [
                                'type'             => 'WellCart\Router\Http\Segment',
                                'javascript_route' => true,
                                'options'          => [
                                    'route'       => 'brands[/:action][/][:id]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '(list|update|create|delete)',
                                        'id'         => '([0-9]+|delete)',
                                    ],
                                    'defaults'    => [
                                        'controller' => 'WellCart\Catalog\Controller\Admin\Brands',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'form_element_configuration' => [
        'class_map' => [
            'formCatalogProductImage'                    => Catalog\Form\View\Helper\FormProductImage::class,
            'formCatalogFeatureCombinationMultiCheckbox' => Catalog\Form\View\Helper\FormCatalogFeatureCombinationMultiCheckbox::class,
        ],
        'type_map'  => [
            'catalogProductImage'                    => 'formCatalogProductImage',
            'catalogFeatureCombinationMultiCheckbox' => 'formCatalogFeatureCombinationMultiCheckbox',
        ],
    ],
    'twbbundle'                  => [
        'ignoredViewHelpers' => [
            'catalogProductImage' => 'catalogProductImage',
        ]
    ],


    /**
     * =========================================================
     * Doctrine configuration
     * =========================================================
     */
    'doctrine'                   => [
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
                ]
            ]
        ],
        'entity_resolver' => [
            'orm_default' => [
                'resolvers' => [
                    Catalog\Spec\BrandEntity::class                => Catalog\Entity\Brand::class,
                    Catalog\Spec\CategoryEntity::class             => Catalog\Entity\Category::class,
                    Catalog\Spec\CategoryI18nEntity::class         => Catalog\Entity\CategoryI18n::class,
                    Catalog\Spec\AttributeEntity::class            => Catalog\Entity\Attribute::class,
                    Catalog\Spec\AttributeI18nEntity::class        => Catalog\Entity\AttributeI18n::class,

                    Catalog\Spec\AttributeValueEntity::class       => Catalog\Entity\AttributeValue::class,
                    Catalog\Spec\AttributeValueI18nEntity::class   => Catalog\Entity\AttributeValueI18n::class,
                    Catalog\Spec\ProductTemplateEntity::class      => Catalog\Entity\ProductTemplate::class,
                    Catalog\Spec\ProductTemplateI18nEntity::class  => Catalog\Entity\ProductTemplateI18n::class,

                    Catalog\Spec\FeatureEntity::class              => Catalog\Entity\Feature::class,
                    Catalog\Spec\FeatureI18nEntity::class          => Catalog\Entity\FeatureI18n::class,

                    Catalog\Spec\FeatureValueEntity::class         => Catalog\Entity\FeatureValue::class,
                    Catalog\Spec\FeatureValueI18nEntity::class     => Catalog\Entity\FeatureValueI18n::class,

                    Catalog\Spec\ProductEntity::class              => Catalog\Entity\Product::class,
                    Catalog\Spec\ProductI18nEntity::class          => Catalog\Entity\ProductI18n::class,
                    Catalog\Spec\ProductVariantEntity::class       => Catalog\Entity\ProductVariant::class,
                    Catalog\Spec\AttributeCombinationEntity::class => Catalog\Entity\AttributeCombination::class,
                    Catalog\Spec\ProductImageEntity::class         => Catalog\Entity\ProductImage::class,
                    'Catalog::Brand'                               => Catalog\Entity\Brand::class,
                    'Catalog::Category'                            => Catalog\Entity\Category::class,
                    'Catalog::CategoryI18n'                        => Catalog\Entity\CategoryI18n::class,


                    'Catalog::Attribute'                           => Catalog\Entity\Attribute::class,
                    'Catalog::AttributeI18n'                       => Catalog\Entity\AttributeI18n::class,
                    'Catalog::ProductTemplate'                     => Catalog\Entity\ProductTemplate::class,
                    'Catalog::ProductTemplateI18n'                 => Catalog\Entity\ProductTemplateI18n::class,

                    'Catalog::Feature'                             => Catalog\Entity\Feature::class,
                    'Catalog::FeatureI18n'                         => Catalog\Entity\FeatureI18n::class,

                    'Catalog::FeatureValue'                        => Catalog\Entity\Feature::class,
                    'Catalog::FeatureI18nValue'                    => Catalog\Entity\FeatureI18n::class,

                    'Catalog::Product'                             => Catalog\Entity\Product::class,
                    'Catalog::ProductI18n'                         => Catalog\Entity\ProductI18n::class,
                    'Catalog::ProductImage'                        => Catalog\Entity\ProductImage::class,
                ],
            ],
        ]
    ],
    /**
     * =========================================================
     * Static assets configuration
     * =========================================================
     */
    'asset_manager'              => [
        'resolver_configs' => [
            'paths' => [
                __DIR__ => __DIR__ . '/../public/',
            ],
        ],
    ],

    /**
     * =========================================================
     * Translator configuration
     * =========================================================
     */
    'translator'                 => [
        'translation_file_patterns' => [
            __FILE__ => [
                'text_domain' => 'default',
                'type'        => 'gettext',
                'base_dir'    => __DIR__ . '/../language',
                'pattern'     => '%s.mo',
            ],
        ],
    ],

    /**
     * =========================================================
     * View manager configuration
     * =========================================================
     */
    'view_manager'               => [
        'template_map' => include __DIR__ . '/section/template_map.php',
    ],
    'view_helpers'               => [
        'invokables' => [
            'formCatalogProductImage'                    => Catalog\Form\View\Helper\FormProductImage::class,
            'formCatalogFeatureCombinationMultiCheckbox' => Catalog\Form\View\Helper\FormCatalogFeatureCombinationMultiCheckbox::class,
        ],
    ],

    /**
     * =========================================================
     * Object mapping configuration
     * =========================================================
     */
    'object_mapping'             => include __DIR__
        . '/section/object_mapping.php',
    'layout_updates'             => include __DIR__
        . '/section/layout_updates.php',
    'navigation'                 => [
        'backend_main_navigation' => include __DIR__
            . '/backend_main_navigation.php',
    ],
    'form_elements'              => [
        'factories'  => [
            'catalogProductPrice' => Catalog\Factory\Form\Element\ProductPriceFactory::class,
        ],
        'invokables' => [
            'catalogProductImage' => Catalog\Form\Element\ProductImage::class,
        ],
    ],

    'command_bus'                => [
        'command_map' => [
            Catalog\Command\PersistProduct::class => Catalog\Command\Handler\PersistProductHandler::class,
        ],
    ],
];
