<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

return [
    'navigation' => [
        'backend_main_navigation' => [
            'backend:catalog-section' => [
                'label'      => 'Catalog',
                'icon'       => 'icon-grid',
                'route'      => 'backend/catalog/products',
                'order'      => -300,
                'permission' => 'catalog/view',
                'pages'      => [
                    'backend/catalog/products'          => [
                        'label'      => 'Products',
                        'route'      => 'backend/catalog/products',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'catalog/products/list',
                    ],
                    'backend/catalog/categories'        => [
                        'label'      => 'Categories',
                        'route'      => 'backend/catalog/categories',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'catalog/categories/list',
                    ],
                    'backend/catalog/product-templates' => [
                        'label'      => 'Product Templates',
                        'route'      => 'backend/catalog/product-templates',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'catalog/product-templates/list',
                    ],
                    'backend/catalog/attributes'        => [
                        'label'      => 'Attributes',
                        'route'      => 'backend/catalog/attributes',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'catalog/attributes/list',
                    ],

                    'backend/catalog/features' => [
                        'label'      => 'Features',
                        'route'      => 'backend/catalog/features',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'catalog/features/list',
                    ],
                    'backend/catalog/brands'   => [
                        'label'      => 'Brands',
                        'route'      => 'backend/catalog/brands',
                        'action'     => 'list',
                        'order'      => -300,
                        'permission' => 'catalog/brands/list',
                    ],
                ],
            ],
        ],
    ],
];
