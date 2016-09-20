<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

return
    [
        'zfcadmin:catalog-section' => [
            'label'      => 'Catalog',
            'icon'       => 'icon-grid',
            'route'      => 'zfcadmin/catalog/products',
            'order'      => -300,
            'permission' => 'catalog/view',
            'pages'      => [
                'zfcadmin/catalog/products'          => [
                    'label'      => 'Products',
                    'route'      => 'zfcadmin/catalog/products',
                    'action'     => 'list',
                    'order'      => -300,
                    'permission' => 'catalog/products/list',
                ],
                'zfcadmin/catalog/categories'        => [
                    'label'      => 'Categories',
                    'route'      => 'zfcadmin/catalog/categories',
                    'action'     => 'list',
                    'order'      => -300,
                    'permission' => 'catalog/categories/list',
                ],
                'zfcadmin/catalog/product-templates' => [
                    'label'      => 'Product Templates',
                    'route'      => 'zfcadmin/catalog/product-templates',
                    'action'     => 'list',
                    'order'      => -300,
                    'permission' => 'catalog/product-templates/list',
                ],
                'zfcadmin/catalog/attributes'        => [
                    'label'      => 'Attributes',
                    'route'      => 'zfcadmin/catalog/attributes',
                    'action'     => 'list',
                    'order'      => -300,
                    'permission' => 'catalog/attributes/list',
                ],

                'zfcadmin/catalog/features' => [
                    'label'      => 'Features',
                    'route'      => 'zfcadmin/catalog/features',
                    'action'     => 'list',
                    'order'      => -300,
                    'permission' => 'catalog/features/list',
                ],
                'zfcadmin/catalog/brands'   => [
                    'label'      => 'Brands',
                    'route'      => 'zfcadmin/catalog/brands',
                    'action'     => 'list',
                    'order'      => -300,
                    'permission' => 'catalog/brands/list',
                ],
            ]
        ],
    ];
