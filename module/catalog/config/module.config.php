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
    'service_manager' => [
        'aliases'            => [
            'wellcart_catalog_db_adapter'             => 'Zend\Db\Adapter\Adapter',
            'wellcart_catalog_object_manager'         => 'Doctrine\ORM\EntityManager',
            'wellcart_catalog_doctrine_hydrator'      => 'doctrine_hydrator',
            Spec\BrandRepository::class               => Repository\Brands::class,
            Spec\CategoryRepository::class            => Repository\Categories::class,
            Spec\CategoryI18nRepository::class        => Repository\CategoryI18n::class,
            Spec\ProductTemplateRepository::class     => Repository\ProductTemplates::class,
            Spec\ProductTemplateI18nRepository::class => Repository\ProductTemplateI18n::class,

            Spec\AttributeRepository::class          => Repository\Attributes::class,
            Spec\AttributeI18nRepository::class      => Repository\AttributeI18n::class,
            Spec\AttributeValueRepository::class     => Repository\AttributeValues::class,
            Spec\AttributeValueI18nRepository::class => Repository\AttributeValueI18n::class,

            Spec\FeatureRepository::class          => Repository\Features::class,
            Spec\FeatureI18nRepository::class      => Repository\FeatureI18n::class,
            Spec\FeatureValueRepository::class     => Repository\FeatureValues::class,
            Spec\FeatureValueI18nRepository::class => Repository\FeatureValueI18n::class,
            Spec\ProductVariantRepository::class   => Repository\ProductVariants::class,
            Spec\ProductImageRepository::class     => Repository\ProductImages::class,
            Spec\ProductRepository::class          => Repository\Products::class,
            Spec\ProductI18nRepository::class      => Repository\ProductI18n::class,
        ],
        'invokables'         => [
            Command\Handler\PersistProductHandler::class => Command\Handler\PersistProductHandler::class,
            ItemView\Backend\BrandThumbnail::class         => ItemView\Backend\BrandThumbnail::class
        ],
        'factories'          => [],
        'abstract_factories' => [],
        'services'           => [],
        'initializers'       => [],
        'shared'             => [
            PageView\Backend\ProductsGrid::class         => false,
            PageView\Backend\ProductForm::class          => false,
            PageView\Backend\ProductTemplatesGrid::class => false,
            PageView\Backend\ProductTemplateForm::class  => false,
            PageView\Backend\AttributesGrid::class       => false,
            PageView\Backend\AttributeForm::class        => false,
            PageView\Backend\FeaturesGrid::class         => false,
            PageView\Backend\FeatureForm::class          => false,
            PageView\Backend\CategoriesGrid::class       => false,
            PageView\Backend\CategoryForm::class         => false,
            PageView\Backend\BrandsGrid::class           => false,
            PageView\Backend\BrandForm::class            => false,
            ItemView\Backend\BrandThumbnail::class       => false,
        ],
    ],

    'controllers'                => [
        'aliases'   => [
            'Catalog::Backend\Brands'           => Controller\Backend\BrandsController::class,
            'Catalog::Backend\Products'         => Controller\Backend\ProductsController::class,
            'Catalog::Backend\ProductTemplates' => Controller\Backend\ProductTemplatesController::class,
            'Catalog::Backend\Categories'       => Controller\Backend\CategoriesController::class,
            'Catalog::Backend\Features'         => Controller\Backend\FeaturesController::class,
            'Catalog::Backend\Attributes'       => Controller\Backend\AttributesController::class,
        ],
        'factories' => [
            Controller\Backend\BrandsController::class           => Factory\Controller\Backend\BrandsControllerFactory::class,
            Controller\Backend\ProductsController::class         => Factory\Controller\Backend\ProductsControllerFactory::class,
            Controller\Backend\ProductTemplatesController::class => Factory\Controller\Backend\ProductTemplatesControllerFactory::class,
            Controller\Backend\CategoriesController::class       => Factory\Controller\Backend\CategoriesControllerFactory::class,
            Controller\Backend\FeaturesController::class         => Factory\Controller\Backend\FeaturesControllerFactory::class,
            Controller\Backend\AttributesController::class       => Factory\Controller\Backend\AttributesControllerFactory::class,
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
                                'controller' => 'Catalog::Backend\Products',
                                'action'     => 'list',
                            ],
                        ],
                        'child_routes' => [
                            'products'   => [
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
                                        'controller' => 'Catalog::Backend\Products',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],
                            'categories' => [
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
                                        'controller' => 'Catalog::Backend\Categories',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],
                            'features'   => [
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
                                        'controller' => 'Catalog::Backend\Features',
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
                                        'controller' => 'Catalog::Backend\ProductTemplates',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],

                            'attributes' => [
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
                                        'controller' => 'Catalog::Backend\Attributes',
                                        'action'     => 'list',
                                    ],
                                ],
                            ],

                            'brands' => [
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
                                        'controller' => 'Catalog::Backend\Brands',
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

    'view_helpers'               => [
        'invokables' => [
            'formCatalogProductImage'                    => Form\View\Helper\FormProductImage::class,
            'formCatalogFeatureCombinationMultiCheckbox' => Form\View\Helper\FormFeatureCombinationMultiCheckbox::class,
        ],
    ],
    'form_elements'              => [
        'aliases'    => [
            'catalogFeatureCombinationMultiCheckbox' => Form\Element\FeatureCombinationMultiCheckbox::class,
        ],
        'factories'  => [
            'catalogProductPrice'                               => Factory\Form\Element\ProductPriceFactory::class,
            Form\Element\FeatureCombinationMultiCheckbox::class => Factory\FormElement\FeatureCombinationMultiCheckboxFactory::class,
            'catalogCategorySelector'                           => Factory\FormElement\CategorySelectorFactory::class,
            'catalogProductTemplateSelector'                    => Factory\FormElement\ProductTemplateSelectorFactory::class,
            'catalogBrandSelector'                              => Factory\FormElement\BrandSelectorFactory::class,
            'catalogAttributesMultiCheckboxSelector'            => Factory\FormElement\AttributesMultiCheckboxSelectorFactory::class,
            'catalogFeaturesMultiCheckboxSelector'              => Factory\FormElement\FeaturesMultiCheckboxSelectorFactory::class,
            'catalogProductTemplatesMultiCheckboxSelector'      => Factory\FormElement\ProductTemplatesMultiCheckboxSelectorFactory::class,
            'catalogProductTemplatesSelector'                   => Factory\FormElement\ProductTemplatesSelectorFactory::class,
        ],
        'invokables' => [
            'catalogProductImage' => Form\Element\ProductImage::class,
        ],
    ],

    'command_bus' => [
        'command_map' => [
            Command\PersistProduct::class => Command\Handler\PersistProductHandler::class,
        ],
    ],
];
