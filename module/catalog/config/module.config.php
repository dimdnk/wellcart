<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Catalog;

return [
    /**
     * =========================================================
     * Service manager configuration
     * =========================================================
     */
    'service_manager'            => [
        'aliases'            => [
            'wellcart_catalog_db_adapter'             => 'Zend\Db\Adapter\Adapter',
            'wellcart_catalog_object_manager'         => 'Doctrine\ORM\EntityManager',
            'wellcart_catalog_doctrine_hydrator'      => 'doctrine_hydrator',
            Spec\BrandRepository::class               => Repository\Brands::class,
            Spec\CategoryRepository::class            => Repository\Categories::class,
            Spec\CategoryI18nRepository::class        => Repository\CategoryI18n::class,
            Spec\ProductTemplateRepository::class     => Repository\ProductTemplates::class,
            Spec\ProductTemplateI18nRepository::class => Repository\ProductTemplateI18n::class,

            Spec\AttributeRepository::class           => Repository\Attributes::class,
            Spec\AttributeI18nRepository::class       => Repository\AttributeI18n::class,
            Spec\AttributeValueRepository::class      => Repository\AttributeValues::class,
            Spec\AttributeValueI18nRepository::class  => Repository\AttributeValueI18n::class,

            Spec\FeatureRepository::class             => Repository\Features::class,
            Spec\FeatureI18nRepository::class         => Repository\FeatureI18n::class,
            Spec\FeatureValueRepository::class        => Repository\FeatureValues::class,
            Spec\FeatureValueI18nRepository::class    => Repository\FeatureValueI18n::class,
            Spec\ProductVariantRepository::class      => Repository\ProductVariants::class,
            Spec\ProductImageRepository::class        => Repository\ProductImages::class,
            Spec\ProductRepository::class             => Repository\Products::class,
            Spec\ProductI18nRepository::class         => Repository\ProductI18n::class,
        ],
        'invokables'         => [
            Command\Handler\PersistProductHandler::class => Command\Handler\PersistProductHandler::class,
            ItemView\Admin\BrandThumbnail::class         => ItemView\Admin\BrandThumbnail::class
        ],
        'factories'          => [],
        'abstract_factories' => [],
        'services'           => [],
        'initializers'       => [],
        'shared'             => [
            PageView\Admin\ProductsGrid::class         => false,
            PageView\Admin\ProductForm::class          => false,
            PageView\Admin\ProductTemplatesGrid::class => false,
            PageView\Admin\ProductTemplateForm::class  => false,
            PageView\Admin\AttributesGrid::class       => false,
            PageView\Admin\AttributeForm::class        => false,
            PageView\Admin\FeaturesGrid::class         => false,
            PageView\Admin\FeatureForm::class          => false,
            PageView\Admin\CategoriesGrid::class       => false,
            PageView\Admin\CategoryForm::class         => false,
            PageView\Admin\BrandsGrid::class           => false,
            PageView\Admin\BrandForm::class            => false,
            ItemView\Admin\BrandThumbnail::class       => false,
        ],
    ],

    'controllers'                => [
        'factories' => [
            'WellCart\Catalog\Controller\Admin\Brands'           => Factory\Controller\Admin\BrandsControllerFactory::class,
            'WellCart\Catalog\Controller\Admin\Products'         => Factory\Controller\Admin\ProductsControllerFactory::class,
            'WellCart\Catalog\Controller\Admin\ProductTemplates' => Factory\Controller\Admin\ProductTemplatesControllerFactory::class,
            'WellCart\Catalog\Controller\Admin\Categories'       => Factory\Controller\Admin\CategoriesControllerFactory::class,
            'WellCart\Catalog\Controller\Admin\Features'         => Factory\Controller\Admin\FeaturesControllerFactory::class,
            'WellCart\Catalog\Controller\Admin\Attributes'       => Factory\Controller\Admin\AttributesControllerFactory::class,
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
                                'controller' => 'WellCart\Catalog\Controller\Admin\Products',
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
            'formCatalogProductImage'                    => Form\View\Helper\FormProductImage::class,
            'formCatalogFeatureCombinationMultiCheckbox' => Form\View\Helper\FormFeatureCombinationMultiCheckbox::class,
            'formCatalogCategoryMultiCheckbox'           => Form\View\Helper\FormCategoryMultiCheckbox::class,
        ],
        'type_map'  => [
            'catalogProductImage'                    => 'formCatalogProductImage',
            'catalogFeatureCombinationMultiCheckbox' => 'formCatalogFeatureCombinationMultiCheckbox',
            'catalogCategoryMultiCheckbox'           => 'formCatalogCategoryMultiCheckbox',
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
                    Spec\BrandEntity::class                => Entity\Brand::class,
                    Spec\CategoryEntity::class             => Entity\Category::class,
                    Spec\CategoryI18nEntity::class         => Entity\CategoryI18n::class,
                    Spec\AttributeEntity::class            => Entity\Attribute::class,
                    Spec\AttributeI18nEntity::class        => Entity\AttributeI18n::class,

                    Spec\AttributeValueEntity::class       => Entity\AttributeValue::class,
                    Spec\AttributeValueI18nEntity::class   => Entity\AttributeValueI18n::class,
                    Spec\ProductTemplateEntity::class      => Entity\ProductTemplate::class,
                    Spec\ProductTemplateI18nEntity::class  => Entity\ProductTemplateI18n::class,

                    Spec\FeatureEntity::class              => Entity\Feature::class,
                    Spec\FeatureI18nEntity::class          => Entity\FeatureI18n::class,

                    Spec\FeatureValueEntity::class         => Entity\FeatureValue::class,
                    Spec\FeatureValueI18nEntity::class     => Entity\FeatureValueI18n::class,

                    Spec\ProductEntity::class              => Entity\Product::class,
                    Spec\ProductI18nEntity::class          => Entity\ProductI18n::class,
                    Spec\ProductVariantEntity::class       => Entity\ProductVariant::class,
                    Spec\AttributeCombinationEntity::class => Entity\AttributeCombination::class,
                    Spec\ProductImageEntity::class         => Entity\ProductImage::class,
                    'Catalog::Brand'                       => Entity\Brand::class,
                    'Catalog::Category'                    => Entity\Category::class,
                    'Catalog::CategoryI18n'                => Entity\CategoryI18n::class,


                    'Catalog::Attribute'                   => Entity\Attribute::class,
                    'Catalog::AttributeI18n'               => Entity\AttributeI18n::class,
                    'Catalog::ProductTemplate'             => Entity\ProductTemplate::class,
                    'Catalog::ProductTemplateI18n'         => Entity\ProductTemplateI18n::class,

                    'Catalog::Feature'                     => Entity\Feature::class,
                    'Catalog::FeatureI18n'                 => Entity\FeatureI18n::class,

                    'Catalog::FeatureValue'                => Entity\Feature::class,
                    'Catalog::FeatureI18nValue'            => Entity\FeatureI18n::class,

                    'Catalog::Product'                     => Entity\Product::class,
                    'Catalog::ProductI18n'                 => Entity\ProductI18n::class,
                    'Catalog::ProductImage'                => Entity\ProductImage::class,
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
            'formCatalogProductImage'                    => Form\View\Helper\FormProductImage::class,
            'formCatalogFeatureCombinationMultiCheckbox' => Form\View\Helper\FormFeatureCombinationMultiCheckbox::class,
            'formCatalogCategoryMultiCheckbox'           => Form\View\Helper\FormCategoryMultiCheckbox::class,
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
            'catalogProductPrice' => Factory\Form\Element\ProductPriceFactory::class,
        ],
        'invokables' => [
            'catalogProductImage' => Form\Element\ProductImage::class,
        ],
    ],

    'command_bus'                => [
        'command_map' => [
            Command\PersistProduct::class => Command\Handler\PersistProductHandler::class,
        ],
    ],
];
