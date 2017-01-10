<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Catalog;

return [
    'domain' => [
        'mapping' => [
            Entity\Brand::class =>
                [
                    'type' => 'entity',
                    'repositoryClass' => Repository\Brands::class,
                    'table' => 'catalog_brands',
                    'id' =>
                        [
                            'id' =>
                                [
                                    'column' => 'brand_id',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'oneToMany' => [
                        'products' => [
                            'targetEntity' => Entity\Product::class,
                            'mappedBy' => 'brand',
                            'orphanRemoval' => true,
                            'cascade' => ['persist', 'merge', 'detach'],
                            'fetch' => "EAGER",
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
                                            'NoObjectExists' => [
                                                'name' => 'WellCart\ORM\Validator\NoObjectExists',
                                                'options' => [
                                                    'entity_class' => Entity\Brand::class,
                                                    'fields' => ['name'],
                                                    'messages' => [
                                                        'objectFound' => 'Brand name already exists!'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            'imageFullPath' =>
                                [
                                    'column' => 'image_full_path',
                                    'type' => 'string',
                                    'nullable' => false,
                                ],
                            'metaTitle' =>
                                [
                                    'column' => 'meta_title',
                                    'type' => 'string',
                                    'nullable' => true,
                                    'input_filter_specification' => [
                                        'required' => false,
                                        'filters' => [
                                            'StripTags' => ['name' => 'StripTags'],
                                            'StringTrim' => ['name' => 'StringTrim'],
                                            'StripNewlines' => ['name' => 'StripNewlines'],
                                            'Null' => ['name' => 'Null'],
                                        ],
                                        'validators' => [
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
                            'metaKeywords' =>
                                [
                                    'column' => 'meta_keywords',
                                    'type' => 'string',
                                    'nullable' => true,
                                    'input_filter_specification' => [
                                        'required' => false,
                                        'filters' => [
                                            'StripTags' => ['name' => 'StripTags'],
                                            'StringTrim' => ['name' => 'StringTrim'],
                                            'StripNewlines' => ['name' => 'StripNewlines'],
                                            'Null' => ['name' => 'Null'],
                                        ],
                                        'validators' => [
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
                            'metaDescription' =>
                                [
                                    'column' => 'meta_description',
                                    'type' => 'string',
                                    'nullable' => true,
                                    'input_filter_specification' => [
                                        'required' => false,
                                        'filters' => [
                                            'StripTags' => ['name' => 'StripTags'],
                                            'StringTrim' => ['name' => 'StringTrim'],
                                            'StripNewlines' => ['name' => 'StripNewlines'],
                                            'Null' => ['name' => 'Null'],
                                        ],
                                        'validators' => [
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
                    'formFields' => [
                        'image' =>
                            [
                                'column' => 'image',
                                'input_filter_specification' => [
                                    'required' => false,
                                    'filters' => [
                                        'RenameUpload' =>
                                            [
                                                'name' => 'WellCart\Filter\File\RenameUpload',
                                                'options' => [
                                                    'use_upload_name' => true,
                                                    'enable_file_dispersion' => true,
                                                    'target_directory' => WELLCART_UPLOAD_PATH,
                                                    'randomize' => true,
                                                    'overwrite' => true,
                                                    'use_upload_extension' => true,
                                                ],
                                            ],
                                    ],
                                    'validators' => [
                                        'File\Size' => [
                                            'name' => 'WellCart\Validator\File\Size',
                                            'options' => [
                                                'max' => 204800 * 4,
                                                'allowEmpty' => true,
                                            ],
                                        ],
                                        'File\MimeType' => [
                                            'name' => 'WellCart\Validator\File\MimeType',
                                            'options' => [
                                                'mimeType' => 'image/png,image/x-png,image/jpeg,image/pjpeg,image/gif',
                                                'magicFile' => false,
                                                'allowEmpty' => true,
                                            ],
                                        ],
                                        'File\ImageSize' => [
                                            'name' => 'WellCart\Validator\File\ImageSize',
                                            'options' => [
                                                'maxWidth' => 1800,
                                                'maxHeight' => 1800,
                                                'allowEmpty' => true,
                                            ],
                                        ],
                                        'File\IsImage' => [
                                            'name' => 'WellCart\Validator\File\IsImage',
                                            'options' => [
                                                'allowEmpty' => true,
                                            ],
                                        ],
                                    ],
                                ]
                            ],
                    ],
                ],


            Entity\ProductTemplate::class =>
                [
                    'type' => 'entity',
                    'repositoryClass' => Repository\ProductTemplates::class,
                    'table' => 'catalog_product_templates',
                    'id' =>
                        [
                            'id' =>
                                [
                                    'column' => 'product_template_id',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'manyToMany' => [
                        'features' => [
                            'targetEntity' => Entity\Feature::class,
                            'mappedBy' => 'productTemplates',
                            'cascade' => ['persist', 'merge', 'detach'],
                        ],
                        'attributes' => [
                            'targetEntity' => Entity\Attribute::class,
                            'mappedBy' => 'productTemplates',
                            'cascade' => ['persist', 'merge', 'detach'],
                        ],
                    ],
                    'oneToMany' => [
                        'translations' => [
                            'targetEntity' => Entity\ProductTemplateI18n::class,
                            'mappedBy' => 'productTemplate',
                            'orphanRemoval' => true,
                            'cascade' => ['persist', 'merge', 'detach'],
                            'fetch' => "EAGER",
                        ],
                        'products' => [
                            'targetEntity' => Entity\Product::class,
                            'mappedBy' => 'productTemplate',
                            'cascade' => ['persist', 'merge', 'detach'],
                        ],
                    ],
                    'fields' =>
                        [
                            'isSystem' =>
                                [
                                    'column' => 'is_system',
                                    'type' => 'boolean',
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
                            'sortOrder' =>
                                [
                                    'column' => 'sort_order',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'input_filter_specification' => [
                                        'required' => false,
                                        'filters' => [
                                            'StringTrim' => ['name' => 'StringTrim'],
                                        ],
                                        'validators' => [
                                            'Digits' => [
                                                'name' => 'Digits',
                                            ],
                                            'Between' => [
                                                'name' => 'Between',
                                                'options' => [
                                                    'min' => 0,
                                                    'max' => PHP_INT_MAX,
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                        ],
                ],
            Entity\ProductTemplateI18n::class =>
                [
                    'type' => 'entity',
                    'repositoryClass' => Repository\ProductTemplateI18n::class,
                    'table' => 'catalog_product_template_i18n',
                    'id' =>
                        [
                            'id' =>
                                [
                                    'column' => 'translation_id',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'oneToOne' => [
                        'language' => [
                            'targetEntity' => 'WellCart\Base\Entity\Locale\Language',
                            'joinColumn' => [
                                'name' => 'language_id',
                                'referencedColumnName' => 'language_id'
                            ],
                        ],

                    ],
                    'manyToOne' => [
                        'productTemplate' => [
                            'targetEntity' => Entity\ProductTemplate::class,
                            'inversedBy' => 'translations',
                            'joinColumn' => [
                                'name' => 'product_template_id',
                                'referencedColumnName' => 'product_template_id'
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
                            'productTemplateId' =>
                                [
                                    'column' => 'product_template_id',
                                    'type' => 'integer',
                                    'nullable' => true,
                                ],
                        ],
                ],


            Entity\ProductImage::class =>
                [
                    'type' => 'entity',
                    'repositoryClass' => Repository\ProductImages::class,
                    'table' => 'catalog_images',
                    'id' =>
                        [
                            'id' =>
                                [
                                    'column' => 'image_id',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'manyToOne' => [
                        'product' => [
                            'targetEntity' => Entity\Product::class,
                            'inversedBy' => 'images',
                            'joinColumn' => [
                                'name' => 'product_id',
                                'referencedColumnName' => 'product_id'
                            ],
                        ],
                    ],
                    'fields' =>
                        [
                            'fullPath' =>
                                [
                                    'column' => 'full_path',
                                    'type' => 'string',
                                    'nullable' => false,
                                ],
                            'filename' =>
                                [
                                    'column' => 'filename',
                                    'type' => 'string',
                                    'nullable' => false,
                                ],
                            'originalFilename' =>
                                [
                                    'column' => 'original_filename',
                                    'type' => 'string',
                                    'nullable' => false,
                                ],
                            'description' =>
                                [
                                    'column' => 'description',
                                    'type' => 'string',
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
                            'imageX' =>
                                [
                                    'column' => 'image_x',
                                    'type' => 'integer',
                                    'nullable' => false,
                                ],
                            'imageY' =>
                                [
                                    'column' => 'image_y',
                                    'type' => 'integer',
                                    'nullable' => false,
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
                    'formFields' => [
                        'image' =>
                            [
                                'column' => 'image',
                                'input_filter_specification' => [
                                    'required' => false,
                                    'filters' => [
                                        'RenameUpload' =>
                                            [
                                                'name' => 'WellCart\Filter\File\RenameUpload',
                                                'options' => [
                                                    'use_upload_name' => true,
                                                    'enable_file_dispersion' => true,
                                                    'target_directory' => WELLCART_UPLOAD_PATH,
                                                    'randomize' => true,
                                                    'overwrite' => true,
                                                    'use_upload_extension' => true,
                                                ],
                                            ],
                                    ],
                                    'validators' => [
                                        'File\IsImage' => [
                                            'name' => 'WellCart\Validator\File\IsImage',
                                            'options' => [
                                                'allowEmpty' => true,
                                            ],
                                        ],
                                        'File\Size' => [
                                            'name' => 'WellCart\Validator\File\Size',
                                            'options' => [
                                                'max' => 204800 * 4,
                                                'allowEmpty' => true,
                                            ],
                                        ],
                                        'File\MimeType' => [
                                            'name' => 'WellCart\Validator\File\MimeType',
                                            'options' => [
                                                'mimeType' => 'image/png,image/x-png,image/jpeg,image/pjpeg,image/gif',
                                                'magicFile' => false,
                                                'allowEmpty' => true,
                                            ],
                                        ],
                                        'File\ImageSize' => [
                                            'name' => 'WellCart\Validator\File\ImageSize',
                                            'options' => [
                                                'maxWidth' => 1800,
                                                'maxHeight' => 1800,
                                                'allowEmpty' => true,
                                            ],
                                        ],
                                    ],
                                ]
                            ],
                    ],
                ],
            Entity\Product::class =>
                [
                    'type' => 'entity',
                    'repositoryClass' => Repository\Products::class,
                    'table' => 'catalog_products',
                    'id' =>
                        [
                            'id' =>
                                [
                                    'column' => 'product_id',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'manyToMany' => [
                        'categories' => [
                            'targetEntity' => Entity\Category::class,
                            'orphanRemoval' => false,
                            'inversedBy' => 'products',
                            'joinTable' => [
                                'name' => 'catalog_products_to_categories',
                                'joinColumns' => [
                                    'product_id' => [
                                        'referencedColumnName' => 'product_id',
                                        'nullable' => false,
                                    ],
                                ],
                                'inverseJoinColumns' => [
                                    'category_id' => [
                                        'referencedColumnName' => 'category_id',
                                        'nullable' => false,
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'oneToMany' => [
                        'translations' => [
                            'targetEntity' => Entity\ProductI18n::class,
                            'mappedBy' => 'product',
                            'orphanRemoval' => true,
                            'cascade' => ['persist', 'merge', 'detach'],
                        ],
                        'features' => [
                            'targetEntity' => Entity\FeatureCombination::class,
                            'mappedBy' => 'product',
                            'orphanRemoval' => true,
                            'cascade' => ['persist', 'merge', 'detach'],
                        ],
                        'variants' => [
                            'targetEntity' => Entity\ProductVariant::class,
                            'mappedBy' => 'product',
                            'orphanRemoval' => true,
                            'cascade' => ['persist', 'merge', 'detach'],
                        ],
                        'images' => [
                            'targetEntity' => Entity\ProductImage::class,
                            'mappedBy' => 'product',
                            'orphanRemoval' => true,
                            'cascade' => ['persist', 'merge', 'detach'],
                        ],
                        'children' => [
                            'targetEntity' => Entity\Product::class,
                            'mappedBy' => 'parent',
                            'cascade' => ['persist', 'merge', 'detach'],
                        ]
                    ],
                    'manyToOne' => [
                        'productTemplate' => [
                            'targetEntity' => Entity\ProductTemplate::class,
                            'inversedBy' => 'products',
                            'joinColumn' => [
                                'name' => 'product_template_id',
                                'referencedColumnName' => 'product_template_id',
                            ],
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
                                ],
                            ],
                        ],
                        'parent' => [
                            'targetEntity' => Entity\Product::class,
                            'inversedBy' => 'children',
                            'joinColumn' => [
                                'name' => 'parent_id',
                                'referencedColumnName' => 'product_id',
                            ],
                        ],
                        'brand' => [
                            'targetEntity' => Entity\Brand::class,
                            'inversedBy' => 'products',
                            'joinColumn' => [
                                'name' => 'brand_id',
                                'referencedColumnName' => 'brand_id',
                            ],
                        ],
                    ],
                    'fields' =>
                        [
                            'parentId' =>
                                [
                                    'column' => 'parent_id',
                                    'type' => 'integer',
                                    'nullable' => true,
                                ],

                            'status' =>
                                [
                                    'column' => 'status',
                                    'type' => 'boolean',
                                    'nullable' => false,
                                    'input_filter_specification' => [
                                        'filters' => [
                                            'StringTrim' => ['name' => 'StringTrim'],
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
                            'urlKey' =>
                                [
                                    'column' => 'url_key',
                                    'type' => 'string',
                                    'nullable' => false,
                                    'input_filter_specification' => [
                                        'required' => true,
                                        'filters' => [
                                            'StripTags' => ['name' => 'StripTags'],
                                            'StringTrim' => ['name' => 'StringTrim'],
                                            'StripNewlines' => ['name' => 'StripNewlines'],
                                            'Null' => ['name' => 'Null'],
                                            'StringToLower' => ['name' => 'StringToLower'],
                                            'Slugify' => ['name' => 'WellCart\Filter\Slugify'],
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
                                                    'max' => 30,
                                                ],
                                            ],
                                            'NoObjectExists' => [
                                                'name' => 'WellCart\ORM\Validator\NoObjectExists',
                                                'options' => [
                                                    'entity_class' => Entity\Product::class,
                                                    'fields' => ['urlKey'],
                                                    'messages' => [
                                                        'objectFound' => 'Url key already exists!'
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            'sortOrder' =>
                                [
                                    'column' => 'sort_order',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'input_filter_specification' => [
                                        'required' => false,
                                        'filters' => [
                                            'StringTrim' => ['name' => 'StringTrim'],
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
                                                    'max' => PHP_INT_MAX,
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
            Entity\ProductI18n::class =>
                [
                    'type' => 'entity',
                    'repositoryClass' => Repository\ProductI18n::class,
                    'table' => 'catalog_product_i18n',
                    'id' =>
                        [
                            'id' =>
                                [
                                    'column' => 'translation_id',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'oneToOne' => [
                        'language' => [
                            'targetEntity' => 'WellCart\Base\Entity\Locale\Language',
                            'joinColumn' => [
                                'name' => 'language_id',
                                'referencedColumnName' => 'language_id'
                            ],
                        ],
                    ],
                    'manyToOne' => [
                        'product' => [
                            'targetEntity' => Entity\Product::class,
                            'inversedBy' => 'translations',
                            'joinColumn' => [
                                'name' => 'product_id',
                                'referencedColumnName' => 'product_id'
                            ],
                        ],
                    ],
                    'fields' =>
                        [
                            'productId' =>
                                [
                                    'column' => 'product_id',
                                    'type' => 'integer',
                                    'nullable' => false,
                                ],
                            'languageId' =>
                                [
                                    'column' => 'language_id',
                                    'type' => 'integer',
                                    'nullable' => false,
                                ],
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
                            'description' =>
                                [
                                    'column' => 'description',
                                    'type' => 'string',
                                    'nullable' => false,
                                    'input_filter_specification' => [
                                        'required' => false,
                                        'filters' => [
                                            'StripTags' => [
                                                'name' => 'StripTags',
                                                'options' => [
                                                    'allowTags' => [
                                                        'h1', 'h2',
                                                        'h3', 'h4', 'h5',
                                                        'h6', 'blockquote',
                                                        'cite', 'article',
                                                        'aside',
                                                        'code', 'em', 'i', 'b',
                                                        'strong', 'dfn',
                                                        'footer', 'header',
                                                        'p', 'ol', 'ul', 'li',
                                                        'dl', 'dt', 'hgroup',
                                                        'img' => [
                                                            'src',
                                                            'width'
                                                        ],
                                                        'a' => [
                                                            'href'
                                                        ]
                                                    ]
                                                ],
                                            ],
                                            'StringTrim' => ['name' => 'StringTrim'],
                                            'StripNewlines' => ['name' => 'StripNewlines'],
                                            'Null' => ['name' => 'Null'],
                                        ],
                                        'validators' => [
                                            'StringLength' => [
                                                'name' => 'StringLength',
                                                'options' => [
                                                    'encoding' => 'UTF-8',
                                                    'min' => 1,
                                                    'max' => 21845,
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            'metaTitle' =>
                                [
                                    'column' => 'meta_title',
                                    'type' => 'string',
                                    'nullable' => true,
                                    'input_filter_specification' => [
                                        'required' => false,
                                        'filters' => [
                                            'StripTags' => ['name' => 'StripTags'],
                                            'StringTrim' => ['name' => 'StringTrim'],
                                            'StripNewlines' => ['name' => 'StripNewlines'],
                                            'Null' => ['name' => 'Null'],
                                        ],
                                        'validators' => [
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
                            'metaKeywords' =>
                                [
                                    'column' => 'meta_keywords',
                                    'type' => 'string',
                                    'nullable' => true,
                                    'input_filter_specification' => [
                                        'required' => false,
                                        'filters' => [
                                            'StripTags' => ['name' => 'StripTags'],
                                            'StringTrim' => ['name' => 'StringTrim'],
                                            'StripNewlines' => ['name' => 'StripNewlines'],
                                            'Null' => ['name' => 'Null'],
                                        ],
                                        'validators' => [
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
                            'metaDescription' =>
                                [
                                    'column' => 'meta_description',
                                    'type' => 'string',
                                    'nullable' => true,
                                    'input_filter_specification' => [
                                        'required' => false,
                                        'filters' => [
                                            'StripTags' => ['name' => 'StripTags'],
                                            'StringTrim' => ['name' => 'StringTrim'],
                                            'StripNewlines' => ['name' => 'StripNewlines'],
                                            'Null' => ['name' => 'Null'],
                                        ],
                                        'validators' => [
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
                        ],
                ],
            Entity\Category::class =>
                [
                    'type' => 'entity',
                    'repositoryClass' => Repository\Categories::class,
                    'table' => 'catalog_categories',
                    'gedmo' => [
                        'tree' =>
                            ['type' => 'nested'],
                    ],
                    'id' =>
                        [
                            'id' =>
                                [
                                    'column' => 'category_id',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'manyToOne' => [
                        'parent' => [
                            'targetEntity' => Entity\Category::class,
                            'inversedBy' => 'children',
                            'joinColumn' => [
                                'name' => 'parent_id',
                                'referencedColumnName' => 'category_id',
                                'onDelete' => 'CASCADE',
                            ],
                            'gedmo' => [
                                'treeParent',
                            ]
                        ],
                    ],
                    'oneToMany' => [
                        'translations' => [
                            'targetEntity' => Entity\CategoryI18n::class,
                            'mappedBy' => 'category',
                            'orphanRemoval' => true,
                            'cascade' => ['persist', 'merge', 'detach'],
                        ],
                        'children' => [
                            'targetEntity' => Entity\Category::class,
                            'mappedBy' => 'parent',
                            'cascade' => ['persist', 'merge', 'detach'],
                            'orderBy' => ['lft' => 'ASC']
                        ],
                    ],
                    'manyToMany' => [
                        'products' => [
                            'targetEntity' => Entity\Product::class,
                            'mappedBy' => 'categories',
                            'cascade' => ['persist', 'merge', 'detach'],
                        ],
                    ],
                    'fields' =>
                        [
                            'lft' =>
                                [
                                    'column' => 'lft',
                                    'type' => 'integer',
                                    'nullable' => true,
                                    'gedmo' => ['treeLeft'],
                                ],
                            'rgt' =>
                                [
                                    'column' => 'rgt',
                                    'type' => 'integer',
                                    'nullable' => true,
                                    'gedmo' => ['treeRight'],
                                ],
                            'root' =>
                                [
                                    'column' => 'root',
                                    'type' => 'integer',
                                    'nullable' => true,
                                    'gedmo' => ['treeRoot'],
                                ],
                            'lvl' =>
                                [
                                    'column' => 'lvl',
                                    'type' => 'integer',
                                    'nullable' => true,
                                    'gedmo' => ['treeLevel'],
                                ],
                            'isVisible' =>
                                [
                                    'column' => 'is_visible',
                                    'type' => 'boolean',
                                    'nullable' => false,
                                    'input_filter_specification' => [
                                        'required' => true,
                                        'filters' => [
                                            'StringTrim' => ['name' => 'StringTrim'],
                                            'Null' => ['name' => 'Null'],
                                        ],
                                        'validators' => [
                                            'NotEmpty' => [
                                                'name' => 'NotEmpty',
                                            ],
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
                            'urlKey' =>
                                [
                                    'column' => 'url_key',
                                    'type' => 'string',
                                    'nullable' => false,
                                    'input_filter_specification' => [
                                        'required' => true,
                                        'filters' => [
                                            'StripTags' => ['name' => 'StripTags'],
                                            'StringTrim' => ['name' => 'StringTrim'],
                                            'StripNewlines' => ['name' => 'StripNewlines'],
                                            'Null' => ['name' => 'Null'],
                                            'StringToLower' => ['name' => 'StringToLower'],
                                            'Slugify' => ['name' => 'WellCart\Filter\Slugify'],
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
                                                    'max' => 50,
                                                ],
                                            ],
                                            /**
                                             * array(
                                             * 'name'    => 'WellCart\ORM\Validator\NoObjectExists',
                                             * 'options' => array(
                                             * 'entity_class' => Entity\Category',
                                             * 'fields'       => ['urlKey'],
                                             * 'messages'     => array(
                                             * 'objectFound' => 'Url key already exists!'
                                             * ),
                                             * ),
                                             * ),
                                             */
                                        ],
                                    ],
                                ],
                            'sortOrder' =>
                                [
                                    'column' => 'sort_order',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'input_filter_specification' => [
                                        'required' => false,
                                        'filters' => [
                                            'StringTrim' => ['name' => 'StringTrim'],
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
                                                    'max' => PHP_INT_MAX,
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
            Entity\CategoryI18n::class =>
                [
                    'type' => 'entity',
                    'repositoryClass' => Repository\CategoryI18n::class,
                    'table' => 'catalog_category_i18n',
                    'id' =>
                        [
                            'id' =>
                                [
                                    'column' => 'translation_id',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'oneToOne' => [
                        'language' => [
                            'targetEntity' => 'WellCart\Base\Entity\Locale\Language',
                            'joinColumn' => [
                                'name' => 'language_id',
                                'referencedColumnName' => 'language_id'
                            ],
                        ],
                    ],
                    'manyToOne' => [
                        'category' => [
                            'targetEntity' => Entity\Category::class,
                            'inversedBy' => 'translations',
                            'joinColumn' => [
                                'name' => 'category_id',
                                'referencedColumnName' => 'category_id'
                            ],
                        ],
                    ],
                    'fields' =>
                        [
                            'categoryId' =>
                                [
                                    'column' => 'category_id',
                                    'type' => 'integer',
                                    'nullable' => false,
                                ],
                            'languageId' =>
                                [
                                    'column' => 'language_id',
                                    'type' => 'integer',
                                    'nullable' => false,
                                ],
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
                            'description' =>
                                [
                                    'column' => 'description',
                                    'type' => 'string',
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
                                            'StringLength' => [
                                                'name' => 'StringLength',
                                                'options' => [
                                                    'encoding' => 'UTF-8',
                                                    'min' => 1,
                                                    'max' => 21845,
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            'metaTitle' =>
                                [
                                    'column' => 'meta_title',
                                    'type' => 'string',
                                    'nullable' => true,
                                    'input_filter_specification' => [
                                        'required' => false,
                                        'filters' => [
                                            'StripTags' => ['name' => 'StripTags'],
                                            'StringTrim' => ['name' => 'StringTrim'],
                                            'StripNewlines' => ['name' => 'StripNewlines'],
                                            'Null' => ['name' => 'Null'],
                                        ],
                                        'validators' => [
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
                            'metaKeywords' =>
                                [
                                    'column' => 'meta_keywords',
                                    'type' => 'string',
                                    'nullable' => true,
                                    'input_filter_specification' => [
                                        'required' => false,
                                        'filters' => [
                                            'StripTags' => ['name' => 'StripTags'],
                                            'StringTrim' => ['name' => 'StringTrim'],
                                            'StripNewlines' => ['name' => 'StripNewlines'],
                                            'Null' => ['name' => 'Null'],
                                        ],
                                        'validators' => [
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
                            'metaDescription' =>
                                [
                                    'column' => 'meta_description',
                                    'type' => 'string',
                                    'nullable' => true,
                                    'input_filter_specification' => [
                                        'required' => false,
                                        'filters' => [
                                            'StripTags' => ['name' => 'StripTags'],
                                            'StringTrim' => ['name' => 'StringTrim'],
                                            'StripNewlines' => ['name' => 'StripNewlines'],
                                            'Null' => ['name' => 'Null'],
                                        ],
                                        'validators' => [
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
                        ],
                ],

            Entity\Feature::class =>
                [
                    'type' => 'entity',
                    'repositoryClass' => Repository\Features::class,
                    'table' => 'catalog_features',
                    'id' =>
                        [
                            'id' =>
                                [
                                    'column' => 'feature_id',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'manyToMany' => [
                        'productTemplates' => [
                            'targetEntity' => Entity\ProductTemplate::class,
                            'inversedBy' => 'features',
                            'cascade' => ['persist', 'merge', 'detach'],
                            'joinTable' => [
                                'name' => 'catalog_feature_to_template',
                                'joinColumns' =>
                                    [
                                        'feature_id' =>
                                            [
                                                'referencedColumnName' => 'feature_id'
                                            ]
                                    ],
                                'inverseJoinColumns' => [
                                    'product_template_id' =>
                                        [
                                            'referencedColumnName' => 'product_template_id'
                                        ]
                                ]
                            ],
                        ],
                    ],
                    'oneToMany' => [
                        'values' => [
                            'targetEntity' => Entity\FeatureValue::class,
                            'mappedBy' => 'feature',
                            'orphanRemoval' => true,
                            'cascade' => ['persist', 'merge', 'detach'],
                        ],
                        'translations' => [
                            'targetEntity' => Entity\FeatureI18n::class,
                            'mappedBy' => 'feature',
                            'orphanRemoval' => true,
                            'cascade' => ['persist', 'merge', 'detach'],
                        ],
                    ],
                    'fields' =>
                        [
                            'backendName' =>
                                [
                                    'column' => 'backend_name',
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
                            'sortOrder' =>
                                [
                                    'column' => 'sort_order',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'input_filter_specification' => [
                                        'required' => true,
                                        'filters' => [
                                            'StringTrim' => ['name' => 'StringTrim'],
                                        ],
                                        'validators' => [
                                            'Digits' => [
                                                'name' => 'Digits',
                                            ],
                                            'Between' => [
                                                'name' => 'Between',
                                                'options' => [
                                                    'min' => 0,
                                                    'max' => PHP_INT_MAX,
                                                ],
                                            ],
                                        ],
                                    ],
                                ],

                        ],
                ],
            Entity\FeatureI18n::class =>
                [
                    'type' => 'entity',
                    'repositoryClass' => Repository\FeatureI18n::class,
                    'table' => 'catalog_feature_i18n',
                    'id' =>
                        [
                            'id' =>
                                [
                                    'column' => 'translation_id',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'oneToOne' => [
                        'language' => [
                            'targetEntity' => 'WellCart\Base\Entity\Locale\Language',
                            'joinColumn' => [
                                'name' => 'language_id',
                                'referencedColumnName' => 'language_id'
                            ],
                        ],
                    ],
                    'manyToOne' => [
                        'feature' => [
                            'targetEntity' => Entity\Feature::class,
                            'inversedBy' => 'translations',
                            'joinColumn' => [
                                'name' => 'feature_id',
                                'referencedColumnName' => 'feature_id'
                            ],
                        ],
                    ],
                    'fields' =>
                        [
                            'featureId' =>
                                [
                                    'column' => 'feature_id',
                                    'type' => 'integer',
                                    'nullable' => true,
                                ],
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
                        ],
                ],


            Entity\FeatureValue::class =>
                [
                    'type' => 'entity',
                    'repositoryClass' => Repository\FeatureValues::class,
                    'table' => 'catalog_feature_values',
                    'id' =>
                        [
                            'id' =>
                                [
                                    'column' => 'feature_value_id',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'manyToOne' => [
                        'feature' => [
                            'targetEntity' => Entity\Feature::class,
                            'inversedBy' => 'values',
                            'joinColumn' => [
                                'name' => 'feature_id',
                                'referencedColumnName' => 'feature_id'
                            ],
                        ],
                    ],
                    'oneToMany' => [
                        'translations' => [
                            'targetEntity' => Entity\FeatureValueI18n::class,
                            'mappedBy' => 'featureValue',
                            'orphanRemoval' => true,
                            'cascade' => ['persist', 'merge', 'detach'],
                        ],
                    ],
                    'fields' =>
                        [
                            'sortOrder' =>
                                [
                                    'column' => 'sort_order',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'input_filter_specification' => [
                                        'required' => true,
                                        'filters' => [
                                            'StringTrim' => ['name' => 'StringTrim'],
                                        ],
                                        'validators' => [
                                            'Digits' => [
                                                'name' => 'Digits',
                                            ],
                                            'Between' => [
                                                'name' => 'Between',
                                                'options' => [
                                                    'min' => 0,
                                                    'max' => PHP_INT_MAX,
                                                ],
                                            ],
                                        ],
                                    ],
                                ],

                        ],
                ],
            Entity\FeatureValueI18n::class =>
                [
                    'type' => 'entity',
                    'repositoryClass' => Repository\FeatureValueI18n::class,
                    'table' => 'catalog_feature_value_i18n',
                    'id' =>
                        [
                            'id' =>
                                [
                                    'column' => 'translation_id',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'oneToOne' => [
                        'feature' => [
                            'targetEntity' => Entity\Feature::class,

                            'joinColumn' => [
                                'name' => 'feature_id',
                                'referencedColumnName' => 'feature_id'
                            ],
                        ],

                        'language' => [
                            'targetEntity' => 'WellCart\Base\Entity\Locale\Language',
                            'joinColumn' => [
                                'name' => 'language_id',
                                'referencedColumnName' => 'language_id'
                            ],
                        ],
                    ],
                    'manyToOne' => [
                        'featureValue' => [
                            'targetEntity' => Entity\FeatureValue::class,
                            'inversedBy' => 'translations',
                            'joinColumn' => [
                                'name' => 'feature_value_id',
                                'referencedColumnName' => 'feature_value_id'
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
                        ],
                ],


            Entity\Attribute::class =>
                [
                    'type' => 'entity',
                    'repositoryClass' => Repository\Attributes::class,
                    'table' => 'catalog_attributes',
                    'id' =>
                        [
                            'id' =>
                                [
                                    'column' => 'attribute_id',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'manyToMany' => [
                        'productTemplates' => [
                            'targetEntity' => Entity\ProductTemplate::class,
                            'inversedBy' => 'attributes',
                            'cascade' => ['persist', 'merge', 'detach'],
                            'joinTable' => [
                                'name' => 'catalog_attribute_to_template',
                                'joinColumns' =>
                                    [
                                        'attribute_id' =>
                                            [
                                                'referencedColumnName' => 'attribute_id'
                                            ]
                                    ],
                                'inverseJoinColumns' => [
                                    'product_template_id' =>
                                        [
                                            'referencedColumnName' => 'product_template_id'
                                        ]
                                ]
                            ],
                        ],
                    ],
                    'oneToMany' => [
                        'values' => [
                            'targetEntity' => Entity\AttributeValue::class,
                            'mappedBy' => 'attribute',
                            'orphanRemoval' => true,
                            'cascade' => ['persist', 'merge', 'detach'],
                        ],
                        'translations' => [
                            'targetEntity' => Entity\AttributeI18n::class,
                            'mappedBy' => 'attribute',
                            'orphanRemoval' => true,
                            'cascade' => ['persist', 'merge', 'detach'],
                        ],
                    ],
                    'fields' =>
                        [
                            'backendName' =>
                                [
                                    'column' => 'backend_name',
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
                            'sortOrder' =>
                                [
                                    'column' => 'sort_order',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'input_filter_specification' => [
                                        'required' => true,
                                        'filters' => [
                                            'StringTrim' => ['name' => 'StringTrim'],
                                        ],
                                        'validators' => [
                                            'Digits' => [
                                                'name' => 'Digits',
                                            ],
                                            'Between' => [
                                                'name' => 'Between',
                                                'options' => [
                                                    'min' => 0,
                                                    'max' => PHP_INT_MAX,
                                                ],
                                            ],
                                        ],
                                    ],
                                ],

                        ],
                ],
            Entity\AttributeI18n::class =>
                [
                    'type' => 'entity',
                    'repositoryClass' => Repository\AttributeI18n::class,
                    'table' => 'catalog_attribute_i18n',
                    'id' =>
                        [
                            'id' =>
                                [
                                    'column' => 'translation_id',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'oneToOne' => [
                        'language' => [
                            'targetEntity' => 'WellCart\Base\Entity\Locale\Language',
                            'joinColumn' => [
                                'name' => 'language_id',
                                'referencedColumnName' => 'language_id'
                            ],
                        ],
                    ],
                    'manyToOne' => [
                        'attribute' => [
                            'targetEntity' => Entity\Attribute::class,
                            'inversedBy' => 'translations',
                            'joinColumn' => [
                                'name' => 'attribute_id',
                                'referencedColumnName' => 'attribute_id'
                            ],
                        ],
                    ],
                    'fields' =>
                        [
                            'attributeId' =>
                                [
                                    'column' => 'attribute_id',
                                    'type' => 'integer',
                                    'nullable' => true,
                                ],
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
                        ],
                ],


            Entity\AttributeValue::class =>
                [
                    'type' => 'entity',
                    'repositoryClass' => Repository\AttributeValues::class,
                    'table' => 'catalog_attribute_values',
                    'id' =>
                        [
                            'id' =>
                                [
                                    'column' => 'attribute_value_id',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'manyToOne' => [
                        'attribute' => [
                            'targetEntity' => Entity\Attribute::class,
                            'inversedBy' => 'values',
                            'joinColumn' => [
                                'name' => 'attribute_id',
                                'referencedColumnName' => 'attribute_id'
                            ],
                        ],
                    ],
                    'oneToMany' => [
                        'translations' => [
                            'targetEntity' => Entity\AttributeValueI18n::class,
                            'mappedBy' => 'attributeValue',
                            'orphanRemoval' => true,
                            'cascade' => ['persist', 'merge', 'detach'],
                        ],
                    ],
                    'fields' =>
                        [
                            'sortOrder' =>
                                [
                                    'column' => 'sort_order',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'input_filter_specification' => [
                                        'required' => true,
                                        'filters' => [
                                            'StringTrim' => ['name' => 'StringTrim'],
                                        ],
                                        'validators' => [
                                            'Digits' => [
                                                'name' => 'Digits',
                                            ],
                                            'Between' => [
                                                'name' => 'Between',
                                                'options' => [
                                                    'min' => 0,
                                                    'max' => PHP_INT_MAX,
                                                ],
                                            ],
                                        ],
                                    ],
                                ],

                        ],
                ],
            Entity\AttributeValueI18n::class =>
                [
                    'type' => 'entity',
                    'repositoryClass' => Repository\AttributeValueI18n::class,
                    'table' => 'catalog_attribute_value_i18n',
                    'id' =>
                        [
                            'id' =>
                                [
                                    'column' => 'translation_id',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'oneToOne' => [
                        'attribute' => [
                            'targetEntity' => Entity\Attribute::class,
                            'joinColumn' => [
                                'name' => 'attribute_id',
                                'referencedColumnName' => 'attribute_id'
                            ],
                        ],

                        'language' => [
                            'targetEntity' => 'WellCart\Base\Entity\Locale\Language',
                            'joinColumn' => [
                                'name' => 'language_id',
                                'referencedColumnName' => 'language_id'
                            ],
                        ],
                    ],
                    'manyToOne' => [
                        'attributeValue' => [
                            'targetEntity' => Entity\AttributeValue::class,
                            'inversedBy' => 'translations',
                            'joinColumn' => [
                                'name' => 'attribute_value_id',
                                'referencedColumnName' => 'attribute_value_id'
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
                        ],
                ],

            Entity\ProductVariant::class =>
                [
                    'type' => 'entity',
                    'repositoryClass' => Repository\ProductVariants::class,
                    'table' => 'catalog_product_variants',
                    'id' =>
                        [
                            'id' =>
                                [
                                    'column' => 'variant_id',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'oneToMany' => [
                        'combinations' => [
                            'targetEntity' => Entity\AttributeCombination::class,
                            'mappedBy' => 'variant',
                            'orphanRemoval' => true,
                            'cascade' => ['persist', 'merge', 'detach'],
                        ],
                    ],
                    'manyToOne' => [
                        'product' => [
                            'targetEntity' => Entity\Product::class,
                            'inversedBy' => 'variants',
                            'joinColumn' => [
                                'name' => 'product_id',
                                'referencedColumnName' => 'product_id'
                            ],
                        ],
                    ],
                    'fields' =>
                        [
                            'quantity' =>
                                [
                                    'column' => 'quantity',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'input_filter_specification' => [
                                        'required' => true,
                                        'filters' => [
                                            'StringTrim' => ['name' => 'StringTrim'],
                                        ],
                                        'validators' => [
                                            'NotEmpty' => [
                                                'name' => 'NotEmpty',
                                            ],
                                            'Digits' => [
                                                'name' => 'Digits',
                                            ],
                                            'Between' => [
                                                'name' => 'Between',
                                                'options' => [
                                                    'min' => 0,
                                                    'max' => PHP_INT_MAX,
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            'sku' =>
                                [
                                    'column' => 'sku',
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
                                            /**
                                             * 'NoObjectExists' => [
                                             * 'name'    => 'WellCart\ORM\Validator\NoObjectExists',
                                             * 'options' => [
                                             * 'entity_class' => Entity\ProductVariant',
                                             * 'fields'       => ['sku'],
                                             * 'messages'     => [
                                             * 'objectFound' => 'This SKU already exists!'
                                             * ],
                                             * ],
                                             * ],
                                             */

                                        ],
                                    ],
                                ],
                            'price' =>
                                [
                                    'column' => 'price',
                                    'type' => 'decimal',
                                    'nullable' => false,
                                    'input_filter_specification' => [
                                        'required' => true,
                                        'filters' => [
                                            'StringTrim' => ['name' => 'StringTrim'],
                                            'Null' => ['name' => 'Null'],
                                        ],
                                        'validators' => [
                                            'NotEmpty' => [
                                                'name' => 'NotEmpty',
                                            ],
                                            'Zend\I18n\Validator\IsFloat' => [
                                                'name' => 'Zend\I18n\Validator\IsFloat',
                                            ],
                                            'Between' => [
                                                'name' => 'Between',
                                                'options' => [
                                                    'min' => 0,
                                                    'max' => PHP_INT_MAX,
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

            Entity\AttributeCombination::class =>
                [
                    'type' => 'entity',
                    'table' => 'catalog_attribute_combinations',
                    'id' =>
                        [
                            'id' =>
                                [
                                    'column' => 'combination_id',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'manyToOne' => [
                        'variant' => [
                            'targetEntity' => Entity\ProductVariant::class,
                            'inversedBy' => 'combinations',
                            'joinColumn' => [
                                'name' => 'variant_id',
                                'referencedColumnName' => 'variant_id'
                            ],
                        ],
                        'attribute' => [
                            'targetEntity' => Entity\Attribute::class,
                            //'inversedBy'   => 'combinations',
                            'joinColumn' => [
                                'name' => 'attribute_id',
                                'referencedColumnName' => 'attribute_id'
                            ],
                        ],
                        'attributeValue' => [
                            'targetEntity' => Entity\AttributeValue::class,
                            //'inversedBy'   => 'combinations',
                            'joinColumn' => [
                                'name' => 'attribute_value_id',
                                'referencedColumnName' => 'attribute_value_id'
                            ],
                        ],
                    ],
                    'fields' =>
                        [

                        ],
                ],

            Entity\FeatureCombination::class =>
                [
                    'type' => 'entity',
                    'table' => 'catalog_feature_combinations',
                    'id' =>
                        [
                            'id' =>
                                [
                                    'column' => 'combination_id',
                                    'type' => 'integer',
                                    'nullable' => false,
                                    'generator' =>
                                        [
                                            'strategy' => 'AUTO',
                                        ],
                                ],
                        ],
                    'manyToOne' => [
                        'product' => [
                            'targetEntity' => Entity\Product::class,
                            'inversedBy' => 'features',
                            'joinColumn' => [
                                'name' => 'product_id',
                                'referencedColumnName' => 'product_id'
                            ],
                        ],
                        'feature' => [
                            'targetEntity' => Entity\Feature::class,
                            'joinColumn' => [
                                'name' => 'feature_id',
                                'referencedColumnName' => 'feature_id'
                            ],
                        ],
                        'featureValue' => [
                            'targetEntity' => Entity\FeatureValue::class,
                            'joinColumn' => [
                                'name' => 'feature_value_id',
                                'referencedColumnName' => 'feature_value_id'
                            ],
                        ],
                    ],
                    'fields' =>
                        [

                        ],
                ],
        ],
    ]
];
