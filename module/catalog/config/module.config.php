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
