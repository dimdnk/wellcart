<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */


return [
    'WellCart\Catalog\Entity\Brand'                =>
        [
            'type'            => 'entity',
            'repositoryClass' => 'WellCart\Catalog\Repository\Brands',
            'table'           => 'catalog_brands',
            'id'              =>
                [
                    'id' =>
                        [
                            'column'    => 'brand_id',
                            'type'      => 'integer',
                            'nullable'  => false,
                            'generator' =>
                                [
                                    'strategy' => 'AUTO',
                                ],
                        ],
                ],
            'oneToMany'       => [
                'products' => [
                    'targetEntity'  => 'WellCart\Catalog\Entity\Product',
                    'mappedBy'      => 'brand',
                    'orphanRemoval' => true,
                    'cascade'       => ['persist', 'merge', 'detach'],
                    'fetch'         => "EAGER",
                ],
            ],
                'fields'          =>
                [
                    'name'            =>
                        [
                            'column'                     => 'name',
                            'type'                       => 'string',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => true,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'NotEmpty'       => [
                                        'name' => 'NotEmpty',
                                    ],
                                    'StringLength'   => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 255,
                                        ],
                                    ],
                                    'NoObjectExists' => [
                                        'name'    => 'WellCart\ORM\Validator\NoObjectExists',
                                        'options' => [
                                            'entity_class' => 'WellCart\Catalog\Entity\Brand',
                                            'fields'       => ['name'],
                                            'messages'     => [
                                                'objectFound' => 'Brand name already exists!'
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'imageFullPath'   =>
                        [
                            'column'   => 'image_full_path',
                            'type'     => 'string',
                            'nullable' => false,
                        ],
                    'metaTitle'       =>
                        [
                            'column'                     => 'meta_title',
                            'type'                       => 'string',
                            'nullable'                   => true,
                            'input_filter_specification' => [
                                'required'   => false,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'StringLength' => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 255,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'metaKeywords'    =>
                        [
                            'column'                     => 'meta_keywords',
                            'type'                       => 'string',
                            'nullable'                   => true,
                            'input_filter_specification' => [
                                'required'   => false,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'StringLength' => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 255,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'metaDescription' =>
                        [
                            'column'                     => 'meta_description',
                            'type'                       => 'string',
                            'nullable'                   => true,
                            'input_filter_specification' => [
                                'required'   => false,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'StringLength' => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 255,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'createdAt'       =>
                        [
                            'column'   => 'created_at',
                            'type'     => 'datetime',
                            'nullable' => false,
                            'gedmo'    =>
                                [
                                    'timestampable' =>
                                        [
                                            'on' => 'create',
                                        ],
                                ],
                        ],
                    'updatedAt'       =>
                        [
                            'column'   => 'updated_at',
                            'type'     => 'datetime',
                            'nullable' => true,
                            'gedmo'    =>
                                [
                                    'timestampable' =>
                                        [
                                            'on' => 'update',
                                        ],
                                ],
                        ],
                ],
            'formFields'      => [
                'image' =>
                    [
                        'column'                     => 'image',
                        'input_filter_specification' => [
                            'required'   => false,
                            'filters'    => [
                                'RenameUpload' =>
                                    [
                                        'name'    => 'WellCart\Filter\File\RenameUpload',
                                        'options' => [
                                            'use_upload_name'        => true,
                                            'enable_file_dispersion' => true,
                                            'target_directory'       => WELLCART_UPLOAD_PATH,
                                            'randomize'              => true,
                                            'overwrite'              => true,
                                            'use_upload_extension'   => true,
                                        ],
                                    ],
                            ],
                            'validators' => [
                                'File\Size'      => [
                                    'name'    => 'WellCart\Validator\File\Size',
                                    'options' => [
                                        'max'        => 204800 * 4,
                                        'allowEmpty' => true,
                                    ],
                                ],
                                'File\MimeType'  => [
                                    'name'    => 'WellCart\Validator\File\MimeType',
                                    'options' => [
                                        'mimeType'   => 'image/png,image/x-png,image/jpeg,image/pjpeg,image/gif',
                                        'magicFile'  => false,
                                        'allowEmpty' => true,
                                    ],
                                ],
                                'File\ImageSize' => [
                                    'name'    => 'WellCart\Validator\File\ImageSize',
                                    'options' => [
                                        'maxWidth'   => 1800,
                                        'maxHeight'  => 1800,
                                        'allowEmpty' => true,
                                    ],
                                ],
                                'File\IsImage'   => [
                                    'name'    => 'WellCart\Validator\File\IsImage',
                                    'options' => [
                                        'allowEmpty' => true,
                                    ],
                                ],
                            ],
                        ]
                    ],
            ],
        ],


    'WellCart\Catalog\Entity\ProductTemplate'      =>
        [
            'type'            => 'entity',
            'repositoryClass' => 'WellCart\Catalog\Repository\ProductTemplates',
            'table'           => 'catalog_product_templates',
            'id'              =>
                [
                    'id' =>
                        [
                            'column'    => 'product_template_id',
                            'type'      => 'integer',
                            'nullable'  => false,
                            'generator' =>
                                [
                                    'strategy' => 'AUTO',
                                ],
                        ],
                ],
            'manyToMany'      => [
                'features'   => [
                    'targetEntity' => 'WellCart\Catalog\Entity\Feature',
                    'mappedBy'     => 'productTemplates',
                    'cascade'      => ['persist', 'merge', 'detach'],
                ],
                'attributes' => [
                    'targetEntity' => 'WellCart\Catalog\Entity\Attribute',
                    'mappedBy'     => 'productTemplates',
                    'cascade'      => ['persist', 'merge', 'detach'],
                ],
            ],
                'oneToMany'       => [
                'translations' => [
                    'targetEntity'  => 'WellCart\Catalog\Entity\ProductTemplateI18n',
                    'mappedBy'      => 'productTemplate',
                    'orphanRemoval' => true,
                    'cascade'       => ['persist', 'merge', 'detach'],
                    'fetch'         => "EAGER",
                ],
                'products'     => [
                    'targetEntity' => 'WellCart\Catalog\Entity\Product',
                    'mappedBy'     => 'productTemplate',
                    'cascade'      => ['persist', 'merge', 'detach'],
                ],
                ],
                'fields'          =>
                [
                    'isSystem'  =>
                        [
                            'column'                     => 'is_system',
                            'type'                       => 'boolean',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => false,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                ],
                                'validators' => [
                                    'Digits'  => [
                                        'name' => 'Digits',
                                    ],
                                    'Between' => [
                                        'name'    => 'Between',
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
                            'column'                     => 'sort_order',
                            'type'                       => 'integer',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => false,
                                'filters'    => [
                                    'StringTrim' => ['name' => 'StringTrim'],
                                ],
                                'validators' => [
                                    'Digits'  => [
                                        'name' => 'Digits',
                                    ],
                                    'Between' => [
                                        'name'    => 'Between',
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
    'WellCart\Catalog\Entity\ProductTemplateI18n'  =>
        [
            'type'            => 'entity',
            'repositoryClass' => 'WellCart\Catalog\Repository\ProductTemplateI18n',
            'table'           => 'catalog_product_template_i18n',
            'id'              =>
                [
                    'id' =>
                        [
                            'column'    => 'translation_id',
                            'type'      => 'integer',
                            'nullable'  => false,
                            'generator' =>
                                [
                                    'strategy' => 'AUTO',
                                ],
                        ],
                ],
            'oneToOne'        => [
                'language' => [
                    'targetEntity' => 'WellCart\Base\Entity\Locale\Language',
                    'joinColumn'   => [
                        'name'                 => 'language_id',
                        'referencedColumnName' => 'language_id'
                    ],
                ],

            ],
                'manyToOne'       => [
                'productTemplate' => [
                    'targetEntity' => 'WellCart\Catalog\Entity\ProductTemplate',
                    'inversedBy'   => 'translations',
                    'joinColumn'   => [
                        'name'                 => 'product_template_id',
                        'referencedColumnName' => 'product_template_id'
                    ],
                ],
                ],
                'fields'          =>
                [
                    'name'              =>
                        [
                            'column'                     => 'name',
                            'type'                       => 'string',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => true,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'NotEmpty'     => [
                                        'name' => 'NotEmpty',
                                    ],
                                    'StringLength' => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 255,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'productTemplateId' =>
                        [
                            'column'   => 'product_template_id',
                            'type'     => 'integer',
                            'nullable' => true,
                        ],
                ],
        ],


    'WellCart\Catalog\Entity\ProductImage'         =>
        [
            'type'            => 'entity',
            'repositoryClass' => 'WellCart\Catalog\Repository\ProductImages',
            'table'           => 'catalog_images',
            'id'              =>
                [
                    'id' =>
                        [
                            'column'    => 'image_id',
                            'type'      => 'integer',
                            'nullable'  => false,
                            'generator' =>
                                [
                                    'strategy' => 'AUTO',
                                ],
                        ],
                ],
            'manyToOne'       => [
                'product' => [
                    'targetEntity' => 'WellCart\Catalog\Entity\Product',
                    'inversedBy'   => 'images',
                    'joinColumn'   => [
                        'name'                 => 'product_id',
                        'referencedColumnName' => 'product_id'
                    ],
                ],
            ],
                'fields'          =>
                [
                    'fullPath'         =>
                        [
                            'column'   => 'full_path',
                            'type'     => 'string',
                            'nullable' => false,
                        ],
                    'filename'         =>
                        [
                            'column'   => 'filename',
                            'type'     => 'string',
                            'nullable' => false,
                        ],
                    'originalFilename' =>
                        [
                            'column'   => 'original_filename',
                            'type'     => 'string',
                            'nullable' => false,
                        ],
                    'description'      =>
                        [
                            'column'                     => 'description',
                            'type'                       => 'string',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => false,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'StringLength' => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 255,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'imageX'           =>
                        [
                            'column'   => 'image_x',
                            'type'     => 'integer',
                            'nullable' => false,
                        ],
                    'imageY'           =>
                        [
                            'column'   => 'image_y',
                            'type'     => 'integer',
                            'nullable' => false,
                        ],
                    'createdAt'        =>
                        [
                            'column'   => 'created_at',
                            'type'     => 'datetime',
                            'nullable' => false,
                            'gedmo'    =>
                                [
                                    'timestampable' =>
                                        [
                                            'on' => 'create',
                                        ],
                                ],
                        ],
                    'updatedAt'        =>
                        [
                            'column'   => 'updated_at',
                            'type'     => 'datetime',
                            'nullable' => true,
                            'gedmo'    =>
                                [
                                    'timestampable' =>
                                        [
                                            'on' => 'update',
                                        ],
                                ],
                        ],
                ],
            'formFields'      => [
                'image' =>
                    [
                        'column'                     => 'image',
                        'input_filter_specification' => [
                            'required'   => false,
                            'filters'    => [
                                'RenameUpload' =>
                                    [
                                        'name'    => 'WellCart\Filter\File\RenameUpload',
                                        'options' => [
                                            'use_upload_name'        => true,
                                            'enable_file_dispersion' => true,
                                            'target_directory'       => WELLCART_UPLOAD_PATH,
                                            'randomize'              => true,
                                            'overwrite'              => true,
                                            'use_upload_extension'   => true,
                                        ],
                                    ],
                            ],
                            'validators' => [
                                'File\IsImage'   => [
                                    'name'    => 'WellCart\Validator\File\IsImage',
                                    'options' => [
                                        'allowEmpty' => true,
                                    ],
                                ],
                                'File\Size'      => [
                                    'name'    => 'WellCart\Validator\File\Size',
                                    'options' => [
                                        'max'        => 204800 * 4,
                                        'allowEmpty' => true,
                                    ],
                                ],
                                'File\MimeType'  => [
                                    'name'    => 'WellCart\Validator\File\MimeType',
                                    'options' => [
                                        'mimeType'   => 'image/png,image/x-png,image/jpeg,image/pjpeg,image/gif',
                                        'magicFile'  => false,
                                        'allowEmpty' => true,
                                    ],
                                ],
                                'File\ImageSize' => [
                                    'name'    => 'WellCart\Validator\File\ImageSize',
                                    'options' => [
                                        'maxWidth'   => 1800,
                                        'maxHeight'  => 1800,
                                        'allowEmpty' => true,
                                    ],
                                ],
                            ],
                        ]
                    ],
            ],
        ],
    'WellCart\Catalog\Entity\Product'              =>
        [
            'type'            => 'entity',
            'repositoryClass' => 'WellCart\Catalog\Repository\Products',
            'table'           => 'catalog_products',
            'id'              =>
                [
                    'id' =>
                        [
                            'column'    => 'product_id',
                            'type'      => 'integer',
                            'nullable'  => false,
                            'generator' =>
                                [
                                    'strategy' => 'AUTO',
                                ],
                        ],
                ],
            'manyToMany'      => [
                'categories' => [
                    'targetEntity'  => 'WellCart\Catalog\Entity\Category',
                    'orphanRemoval' => false,
                    'inversedBy'    => 'products',
                    'joinTable'     => [
                        'name'               => 'catalog_products_to_categories',
                        'joinColumns'        => [
                            'product_id' => [
                                'referencedColumnName' => 'product_id',
                                'nullable'             => false,
                            ],
                        ],
                        'inverseJoinColumns' => [
                            'category_id' => [
                                'referencedColumnName' => 'category_id',
                                'nullable'             => false,
                            ],
                        ],
                    ],
                ],
            ],
                'oneToMany'       => [
                'translations' => [
                    'targetEntity'  => 'WellCart\Catalog\Entity\ProductI18n',
                    'mappedBy'      => 'product',
                    'orphanRemoval' => true,
                    'cascade'       => ['persist', 'merge', 'detach'],
                ],
                'features'     => [
                    'targetEntity'  => 'WellCart\Catalog\Entity\FeatureCombination',
                    'mappedBy'      => 'product',
                    'orphanRemoval' => true,
                    'cascade'       => ['persist', 'merge', 'detach'],
                ],
                'variants'     => [
                    'targetEntity'  => 'WellCart\Catalog\Entity\ProductVariant',
                    'mappedBy'      => 'product',
                    'orphanRemoval' => true,
                    'cascade'       => ['persist', 'merge', 'detach'],
                ],
                'images'       => [
                    'targetEntity'  => 'WellCart\Catalog\Entity\ProductImage',
                    'mappedBy'      => 'product',
                    'orphanRemoval' => true,
                    'cascade'       => ['persist', 'merge', 'detach'],
                ],
                'children'     => [
                    'targetEntity' => 'WellCart\Catalog\Entity\Product',
                    'mappedBy'     => 'parent',
                    'cascade'      => ['persist', 'merge', 'detach'],
                ]
                ],
                'manyToOne'       => [
                'productTemplate' => [
                    'targetEntity'               => 'WellCart\Catalog\Entity\ProductTemplate',
                    'inversedBy'                 => 'products',
                    'joinColumn'                 => [
                        'name'                 => 'product_template_id',
                        'referencedColumnName' => 'product_template_id',
                    ],
                    'nullable'                   => false,
                    'input_filter_specification' => [
                        'required'   => true,
                        'filters'    => [
                            'StripTags'     => ['name' => 'StripTags'],
                            'StringTrim'    => ['name' => 'StringTrim'],
                            'StripNewlines' => ['name' => 'StripNewlines'],
                            'Null'          => ['name' => 'Null'],
                        ],
                        'validators' => [
                            'NotEmpty' => [
                                'name' => 'NotEmpty',
                            ],
                        ],
                    ],
                ],
                'parent'          => [
                    'targetEntity' => 'WellCart\Catalog\Entity\Product',
                    'inversedBy'   => 'children',
                    'joinColumn'   => [
                        'name'                 => 'parent_id',
                        'referencedColumnName' => 'product_id',
                    ],
                ],
                'brand'           => [
                    'targetEntity' => 'WellCart\Catalog\Entity\Brand',
                    'inversedBy'   => 'products',
                    'joinColumn'   => [
                        'name'                 => 'brand_id',
                        'referencedColumnName' => 'brand_id',
                    ],
                ],
                ],
            'fields'          =>
                [
                    'parentId'  =>
                        [
                            'column'   => 'parent_id',
                            'type'     => 'integer',
                            'nullable' => true,
                        ],

                    'status'    =>
                        [
                            'column'                     => 'status',
                            'type'                       => 'boolean',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'filters'    => [
                                    'StringTrim' => ['name' => 'StringTrim'],
                                ],
                                'validators' => [
                                    'Digits'  => [
                                        'name' => 'Digits',
                                    ],
                                    'Between' => [
                                        'name'    => 'Between',
                                        'options' => [
                                            'min' => 0,
                                            'max' => 1,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'urlKey'    =>
                        [
                            'column'                     => 'url_key',
                            'type'                       => 'string',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => true,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                    'StringToLower' => ['name' => 'StringToLower'],
                                    'Slugify'       => ['name' => 'WellCart\Filter\Slugify'],
                                ],
                                'validators' => [
                                    'NotEmpty'       => [
                                        'name' => 'NotEmpty',
                                    ],
                                    'StringLength'   => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 30,
                                        ],
                                    ],
                                    'NoObjectExists' => [
                                        'name'    => 'WellCart\ORM\Validator\NoObjectExists',
                                        'options' => [
                                            'entity_class' => 'WellCart\Catalog\Entity\Product',
                                            'fields'       => ['urlKey'],
                                            'messages'     => [
                                                'objectFound' => 'Url key already exists!'
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'sortOrder' =>
                        [
                            'column'                     => 'sort_order',
                            'type'                       => 'integer',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => false,
                                'filters'    => [
                                    'StringTrim' => ['name' => 'StringTrim'],
                                    'Null'       => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'Digits'  => [
                                        'name' => 'Digits',
                                    ],
                                    'Between' => [
                                        'name'    => 'Between',
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
                            'column'   => 'created_at',
                            'type'     => 'datetime',
                            'nullable' => false,
                            'gedmo'    =>
                                [
                                    'timestampable' =>
                                        [
                                            'on' => 'create',
                                        ],
                                ],
                        ],
                    'updatedAt' =>
                        [
                            'column'   => 'updated_at',
                            'type'     => 'datetime',
                            'nullable' => true,
                            'gedmo'    =>
                                [
                                    'timestampable' =>
                                        [
                                            'on' => 'update',
                                        ],
                                ],
                        ],
                ],
        ],
    'WellCart\Catalog\Entity\ProductI18n'          =>
        [
            'type'            => 'entity',
            'repositoryClass' => 'WellCart\Catalog\Repository\ProductI18n',
            'table'           => 'catalog_product_i18n',
            'id'              =>
                [
                    'id' =>
                        [
                            'column'    => 'translation_id',
                            'type'      => 'integer',
                            'nullable'  => false,
                            'generator' =>
                                [
                                    'strategy' => 'AUTO',
                                ],
                        ],
                ],
            'oneToOne'        => [
                'language' => [
                    'targetEntity' => 'WellCart\Base\Entity\Locale\Language',
                    'joinColumn'   => [
                        'name'                 => 'language_id',
                        'referencedColumnName' => 'language_id'
                    ],
                ],
            ],
                'manyToOne'       => [
                'product' => [
                    'targetEntity' => 'WellCart\Catalog\Entity\Product',
                    'inversedBy'   => 'translations',
                    'joinColumn'   => [
                        'name'                 => 'product_id',
                        'referencedColumnName' => 'product_id'
                    ],
                ],
                ],
                'fields'          =>
                [
                    'productId'       =>
                        [
                            'column'   => 'product_id',
                            'type'     => 'integer',
                            'nullable' => false,
                        ],
                    'languageId'      =>
                        [
                            'column'   => 'language_id',
                            'type'     => 'integer',
                            'nullable' => false,
                        ],
                    'name'            =>
                        [
                            'column'                     => 'name',
                            'type'                       => 'string',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => true,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'NotEmpty'     => [
                                        'name' => 'NotEmpty',
                                    ],
                                    'StringLength' => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 255,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'description'     =>
                        [
                            'column'                     => 'description',
                            'type'                       => 'string',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => false,
                                'filters'    => [
                                    'StripTags'     => [
                                        'name'    => 'StripTags',
                                        'options' => [
                                            'allowTags' => [
                                                'h1', 'h2',
                                                'h3', 'h4', 'h5',
                                                'h6', 'blockquote',
                                                'cite', 'article', 'aside',
                                                'code', 'em', 'i', 'b',
                                                'strong', 'dfn',
                                                'footer', 'header',
                                                'p', 'ol', 'ul', 'li',
                                                'dl', 'dt', 'hgroup',
                                                'img' => [
                                                    'src',
                                                    'width'
                                                ],
                                                'a'   => [
                                                    'href'
                                                ]
                                            ]
                                        ],
                                    ],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'StringLength' => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 21845,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'metaTitle'       =>
                        [
                            'column'                     => 'meta_title',
                            'type'                       => 'string',
                            'nullable'                   => true,
                            'input_filter_specification' => [
                                'required'   => false,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'StringLength' => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 255,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'metaKeywords'    =>
                        [
                            'column'                     => 'meta_keywords',
                            'type'                       => 'string',
                            'nullable'                   => true,
                            'input_filter_specification' => [
                                'required'   => false,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'StringLength' => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 255,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'metaDescription' =>
                        [
                            'column'                     => 'meta_description',
                            'type'                       => 'string',
                            'nullable'                   => true,
                            'input_filter_specification' => [
                                'required'   => false,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'StringLength' => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 255,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                ],
        ],
    'WellCart\Catalog\Entity\Category'             =>
        [
            'type'            => 'entity',
            'repositoryClass' => 'WellCart\Catalog\Repository\Categories',
            'table'           => 'catalog_categories',
            'gedmo'           => [
                'tree' =>
                    ['type' => 'nested'],
            ],
            'id'              =>
                [
                    'id' =>
                        [
                            'column'    => 'category_id',
                            'type'      => 'integer',
                            'nullable'  => false,
                            'generator' =>
                                [
                                    'strategy' => 'AUTO',
                                ],
                        ],
                ],
            'manyToOne'       => [
                'parent' => [
                    'targetEntity' => 'WellCart\Catalog\Entity\Category',
                    'inversedBy'   => 'children',
                    'joinColumn'   => [
                        'name'                 => 'parent_id',
                        'referencedColumnName' => 'category_id',
                        'onDelete'             => 'CASCADE',
                    ],
                    'gedmo'        => [
                        'treeParent',
                    ]
                ],
            ],
                'oneToMany'       => [
                'translations' => [
                    'targetEntity'  => 'WellCart\Catalog\Entity\CategoryI18n',
                    'mappedBy'      => 'category',
                    'orphanRemoval' => true,
                    'cascade'       => ['persist', 'merge', 'detach'],
                ],
                'children'     => [
                    'targetEntity' => 'WellCart\Catalog\Entity\Category',
                    'mappedBy'     => 'parent',
                    'cascade'      => ['persist', 'merge', 'detach'],
                    'orderBy'      => ['lft' => 'ASC']
                ],
                ],
                'manyToMany'      => [
                'products' => [
                    'targetEntity' => 'WellCart\Catalog\Entity\Product',
                    'mappedBy'     => 'categories',
                    'cascade'      => ['persist', 'merge', 'detach'],
                ],
                ],
            'fields'          =>
                [
                    'lft'       =>
                        [
                            'column'   => 'lft',
                            'type'     => 'integer',
                            'nullable' => true,
                            'gedmo'    => ['treeLeft'],
                        ],
                    'rgt'       =>
                        [
                            'column'   => 'rgt',
                            'type'     => 'integer',
                            'nullable' => true,
                            'gedmo'    => ['treeRight'],
                        ],
                    'root'      =>
                        [
                            'column'   => 'root',
                            'type'     => 'integer',
                            'nullable' => true,
                            'gedmo'    => ['treeRoot'],
                        ],
                    'lvl'       =>
                        [
                            'column'   => 'lvl',
                            'type'     => 'integer',
                            'nullable' => true,
                            'gedmo'    => ['treeLevel'],
                        ],
                    'isVisible' =>
                        [
                            'column'                     => 'is_visible',
                            'type'                       => 'boolean',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => true,
                                'filters'    => [
                                    'StringTrim' => ['name' => 'StringTrim'],
                                    'Null'       => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'NotEmpty' => [
                                        'name' => 'NotEmpty',
                                    ],
                                    'Digits'   => [
                                        'name' => 'Digits',
                                    ],
                                    'Between'  => [
                                        'name'    => 'Between',
                                        'options' => [
                                            'min' => 0,
                                            'max' => 1,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'urlKey'    =>
                        [
                            'column'                     => 'url_key',
                            'type'                       => 'string',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => true,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                    'StringToLower' => ['name' => 'StringToLower'],
                                    'Slugify'       => ['name' => 'WellCart\Filter\Slugify'],
                                ],
                                'validators' => [
                                    'NotEmpty'     => [
                                        'name' => 'NotEmpty',
                                    ],
                                    'StringLength' => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 50,
                                        ],
                                    ],
                                    /**
                                     * array(
                                     * 'name'    => 'WellCart\ORM\Validator\NoObjectExists',
                                     * 'options' => array(
                                     * 'entity_class' => 'WellCart\Catalog\Entity\Category',
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
                            'column'                     => 'sort_order',
                            'type'                       => 'integer',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => false,
                                'filters'    => [
                                    'StringTrim' => ['name' => 'StringTrim'],
                                    'Null'       => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'Digits'  => [
                                        'name' => 'Digits',
                                    ],
                                    'Between' => [
                                        'name'    => 'Between',
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
                            'column'   => 'created_at',
                            'type'     => 'datetime',
                            'nullable' => false,
                            'gedmo'    =>
                                [
                                    'timestampable' =>
                                        [
                                            'on' => 'create',
                                        ],
                                ],
                        ],
                    'updatedAt' =>
                        [
                            'column'   => 'updated_at',
                            'type'     => 'datetime',
                            'nullable' => true,
                            'gedmo'    =>
                                [
                                    'timestampable' =>
                                        [
                                            'on' => 'update',
                                        ],
                                ],
                        ],
                ],
        ],
    'WellCart\Catalog\Entity\CategoryI18n'         =>
        [
            'type'            => 'entity',
            'repositoryClass' => 'WellCart\Catalog\Repository\CategoryI18n',
            'table'           => 'catalog_category_i18n',
            'id'              =>
                [
                    'id' =>
                        [
                            'column'    => 'translation_id',
                            'type'      => 'integer',
                            'nullable'  => false,
                            'generator' =>
                                [
                                    'strategy' => 'AUTO',
                                ],
                        ],
                ],
            'oneToOne'        => [
                'language' => [
                    'targetEntity' => 'WellCart\Base\Entity\Locale\Language',
                    'joinColumn'   => [
                        'name'                 => 'language_id',
                        'referencedColumnName' => 'language_id'
                    ],
                ],
            ],
                'manyToOne'       => [
                'category' => [
                    'targetEntity' => 'WellCart\Catalog\Entity\Category',
                    'inversedBy'   => 'translations',
                    'joinColumn'   => [
                        'name'                 => 'category_id',
                        'referencedColumnName' => 'category_id'
                    ],
                ],
                ],
                'fields'          =>
                [
                    'categoryId'      =>
                        [
                            'column'   => 'category_id',
                            'type'     => 'integer',
                            'nullable' => false,
                        ],
                    'languageId'      =>
                        [
                            'column'   => 'language_id',
                            'type'     => 'integer',
                            'nullable' => false,
                        ],
                    'name'            =>
                        [
                            'column'                     => 'name',
                            'type'                       => 'string',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => true,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'NotEmpty'     => [
                                        'name' => 'NotEmpty',
                                    ],
                                    'StringLength' => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 255,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'description'     =>
                        [
                            'column'                     => 'description',
                            'type'                       => 'string',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => false,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'StringLength' => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 21845,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'metaTitle'       =>
                        [
                            'column'                     => 'meta_title',
                            'type'                       => 'string',
                            'nullable'                   => true,
                            'input_filter_specification' => [
                                'required'   => false,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'StringLength' => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 255,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'metaKeywords'    =>
                        [
                            'column'                     => 'meta_keywords',
                            'type'                       => 'string',
                            'nullable'                   => true,
                            'input_filter_specification' => [
                                'required'   => false,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'StringLength' => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 255,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'metaDescription' =>
                        [
                            'column'                     => 'meta_description',
                            'type'                       => 'string',
                            'nullable'                   => true,
                            'input_filter_specification' => [
                                'required'   => false,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'StringLength' => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 255,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                ],
        ],

    'WellCart\Catalog\Entity\Feature'              =>
        [
            'type'            => 'entity',
            'repositoryClass' => 'WellCart\Catalog\Repository\Features',
            'table'           => 'catalog_features',
            'id'              =>
                [
                    'id' =>
                        [
                            'column'    => 'feature_id',
                            'type'      => 'integer',
                            'nullable'  => false,
                            'generator' =>
                                [
                                    'strategy' => 'AUTO',
                                ],
                        ],
                ],
            'manyToMany'      => [
                'productTemplates' => [
                    'targetEntity' => 'WellCart\Catalog\Entity\ProductTemplate',
                    'inversedBy'   => 'features',
                    'cascade'      => ['persist', 'merge', 'detach'],
                    'joinTable'    => [
                        'name'               => 'catalog_feature_to_template',
                        'joinColumns'        =>
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
                'oneToMany'       => [
                'values'       => [
                    'targetEntity'  => 'WellCart\Catalog\Entity\FeatureValue',
                    'mappedBy'      => 'feature',
                    'orphanRemoval' => true,
                    'cascade'       => ['persist', 'merge', 'detach'],
                ],
                'translations' => [
                    'targetEntity'  => 'WellCart\Catalog\Entity\FeatureI18n',
                    'mappedBy'      => 'feature',
                    'orphanRemoval' => true,
                    'cascade'       => ['persist', 'merge', 'detach'],
                ],
                ],
                'fields'          =>
                [
                    'backendName' =>
                        [
                            'column'                     => 'backend_name',
                            'type'                       => 'string',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => true,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'NotEmpty'     => [
                                        'name' => 'NotEmpty',
                                    ],
                                    'StringLength' => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 255,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'sortOrder'   =>
                        [
                            'column'                     => 'sort_order',
                            'type'                       => 'integer',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => true,
                                'filters'    => [
                                    'StringTrim' => ['name' => 'StringTrim'],
                                ],
                                'validators' => [
                                    'Digits'  => [
                                        'name' => 'Digits',
                                    ],
                                    'Between' => [
                                        'name'    => 'Between',
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
    'WellCart\Catalog\Entity\FeatureI18n'          =>
        [
            'type'            => 'entity',
            'repositoryClass' => 'WellCart\Catalog\Repository\FeatureI18n',
            'table'           => 'catalog_feature_i18n',
            'id'              =>
                [
                    'id' =>
                        [
                            'column'    => 'translation_id',
                            'type'      => 'integer',
                            'nullable'  => false,
                            'generator' =>
                                [
                                    'strategy' => 'AUTO',
                                ],
                        ],
                ],
            'oneToOne'        => [
                'language' => [
                    'targetEntity' => 'WellCart\Base\Entity\Locale\Language',
                    'joinColumn'   => [
                        'name'                 => 'language_id',
                        'referencedColumnName' => 'language_id'
                    ],
                ],
            ],
                'manyToOne'       => [
                'feature' => [
                    'targetEntity' => 'WellCart\Catalog\Entity\Feature',
                    'inversedBy'   => 'translations',
                    'joinColumn'   => [
                        'name'                 => 'feature_id',
                        'referencedColumnName' => 'feature_id'
                    ],
                ],
                ],
                'fields'          =>
                [
                    'featureId' =>
                        [
                            'column'   => 'feature_id',
                            'type'     => 'integer',
                            'nullable' => true,
                        ],
                    'name'      =>
                        [
                            'column'                     => 'name',
                            'type'                       => 'string',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => true,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'NotEmpty'     => [
                                        'name' => 'NotEmpty',
                                    ],
                                    'StringLength' => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 255,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                ],
        ],


    'WellCart\Catalog\Entity\FeatureValue'         =>
        [
            'type'            => 'entity',
            'repositoryClass' => 'WellCart\Catalog\Repository\FeatureValues',
            'table'           => 'catalog_feature_values',
            'id'              =>
                [
                    'id' =>
                        [
                            'column'    => 'feature_value_id',
                            'type'      => 'integer',
                            'nullable'  => false,
                            'generator' =>
                                [
                                    'strategy' => 'AUTO',
                                ],
                        ],
                ],
            'manyToOne'       => [
                'feature' => [
                    'targetEntity' => 'WellCart\Catalog\Entity\Feature',
                    'inversedBy'   => 'values',
                    'joinColumn'   => [
                        'name'                 => 'feature_id',
                        'referencedColumnName' => 'feature_id'
                    ],
                ],
            ],
                'oneToMany'       => [
                'translations' => [
                    'targetEntity'  => 'WellCart\Catalog\Entity\FeatureValueI18n',
                    'mappedBy'      => 'featureValue',
                    'orphanRemoval' => true,
                    'cascade'       => ['persist', 'merge', 'detach'],
                ],
                ],
                'fields'          =>
                [
                    'sortOrder' =>
                        [
                            'column'                     => 'sort_order',
                            'type'                       => 'integer',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => true,
                                'filters'    => [
                                    'StringTrim' => ['name' => 'StringTrim'],
                                ],
                                'validators' => [
                                    'Digits'  => [
                                        'name' => 'Digits',
                                    ],
                                    'Between' => [
                                        'name'    => 'Between',
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
    'WellCart\Catalog\Entity\FeatureValueI18n'     =>
        [
            'type'            => 'entity',
            'repositoryClass' => 'WellCart\Catalog\Repository\FeatureValueI18n',
            'table'           => 'catalog_feature_value_i18n',
            'id'              =>
                [
                    'id' =>
                        [
                            'column'    => 'translation_id',
                            'type'      => 'integer',
                            'nullable'  => false,
                            'generator' =>
                                [
                                    'strategy' => 'AUTO',
                                ],
                        ],
                ],
            'oneToOne'        => [
                'feature'  => [
                    'targetEntity' => 'WellCart\Catalog\Entity\Feature',

                    'joinColumn'   => [
                        'name'                 => 'feature_id',
                        'referencedColumnName' => 'feature_id'
                    ],
                ],

                'language' => [
                    'targetEntity' => 'WellCart\Base\Entity\Locale\Language',
                    'joinColumn'   => [
                        'name'                 => 'language_id',
                        'referencedColumnName' => 'language_id'
                    ],
                ],
            ],
                'manyToOne'       => [
                'featureValue' => [
                    'targetEntity' => 'WellCart\Catalog\Entity\FeatureValue',
                    'inversedBy'   => 'translations',
                    'joinColumn'   => [
                        'name'                 => 'feature_value_id',
                        'referencedColumnName' => 'feature_value_id'
                    ],
                ],
                ],
                'fields'          =>
                [
                    'name' =>
                        [
                            'column'                     => 'name',
                            'type'                       => 'string',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => true,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'NotEmpty'     => [
                                        'name' => 'NotEmpty',
                                    ],
                                    'StringLength' => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 255,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                ],
        ],


    'WellCart\Catalog\Entity\Attribute'            =>
        [
            'type'            => 'entity',
            'repositoryClass' => 'WellCart\Catalog\Repository\Attributes',
            'table'           => 'catalog_attributes',
            'id'              =>
                [
                    'id' =>
                        [
                            'column'    => 'attribute_id',
                            'type'      => 'integer',
                            'nullable'  => false,
                            'generator' =>
                                [
                                    'strategy' => 'AUTO',
                                ],
                        ],
                ],
            'manyToMany'      => [
                'productTemplates' => [
                    'targetEntity' => 'WellCart\Catalog\Entity\ProductTemplate',
                    'inversedBy'   => 'attributes',
                    'cascade'      => ['persist', 'merge', 'detach'],
                    'joinTable'    => [
                        'name'               => 'catalog_attribute_to_template',
                        'joinColumns'        =>
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
                'oneToMany'       => [
                'values'       => [
                    'targetEntity'  => 'WellCart\Catalog\Entity\AttributeValue',
                    'mappedBy'      => 'attribute',
                    'orphanRemoval' => true,
                    'cascade'       => ['persist', 'merge', 'detach'],
                ],
                'translations' => [
                    'targetEntity'  => 'WellCart\Catalog\Entity\AttributeI18n',
                    'mappedBy'      => 'attribute',
                    'orphanRemoval' => true,
                    'cascade'       => ['persist', 'merge', 'detach'],
                ],
                ],
                'fields'          =>
                [
                    'backendName' =>
                        [
                            'column'                     => 'backend_name',
                            'type'                       => 'string',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => true,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'NotEmpty'     => [
                                        'name' => 'NotEmpty',
                                    ],
                                    'StringLength' => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 255,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'sortOrder'   =>
                        [
                            'column'                     => 'sort_order',
                            'type'                       => 'integer',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => true,
                                'filters'    => [
                                    'StringTrim' => ['name' => 'StringTrim'],
                                ],
                                'validators' => [
                                    'Digits'  => [
                                        'name' => 'Digits',
                                    ],
                                    'Between' => [
                                        'name'    => 'Between',
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
    'WellCart\Catalog\Entity\AttributeI18n'        =>
        [
            'type'            => 'entity',
            'repositoryClass' => 'WellCart\Catalog\Repository\AttributeI18n',
            'table'           => 'catalog_attribute_i18n',
            'id'              =>
                [
                    'id' =>
                        [
                            'column'    => 'translation_id',
                            'type'      => 'integer',
                            'nullable'  => false,
                            'generator' =>
                                [
                                    'strategy' => 'AUTO',
                                ],
                        ],
                ],
            'oneToOne'        => [
                'language' => [
                    'targetEntity' => 'WellCart\Base\Entity\Locale\Language',
                    'joinColumn'   => [
                        'name'                 => 'language_id',
                        'referencedColumnName' => 'language_id'
                    ],
                ],
            ],
                'manyToOne'       => [
                'attribute' => [
                    'targetEntity' => 'WellCart\Catalog\Entity\Attribute',
                    'inversedBy'   => 'translations',
                    'joinColumn'   => [
                        'name'                 => 'attribute_id',
                        'referencedColumnName' => 'attribute_id'
                    ],
                ],
                ],
                'fields'          =>
                [
                    'attributeId' =>
                        [
                            'column'   => 'attribute_id',
                            'type'     => 'integer',
                            'nullable' => true,
                        ],
                    'name'        =>
                        [
                            'column'                     => 'name',
                            'type'                       => 'string',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => true,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'NotEmpty'     => [
                                        'name' => 'NotEmpty',
                                    ],
                                    'StringLength' => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 255,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                ],
        ],


    'WellCart\Catalog\Entity\AttributeValue'       =>
        [
            'type'            => 'entity',
            'repositoryClass' => 'WellCart\Catalog\Repository\AttributeValues',
            'table'           => 'catalog_attribute_values',
            'id'              =>
                [
                    'id' =>
                        [
                            'column'    => 'attribute_value_id',
                            'type'      => 'integer',
                            'nullable'  => false,
                            'generator' =>
                                [
                                    'strategy' => 'AUTO',
                                ],
                        ],
                ],
            'manyToOne'       => [
                'attribute' => [
                    'targetEntity' => 'WellCart\Catalog\Entity\Attribute',
                    'inversedBy'   => 'values',
                    'joinColumn'   => [
                        'name'                 => 'attribute_id',
                        'referencedColumnName' => 'attribute_id'
                    ],
                ],
            ],
                'oneToMany'       => [
                'translations' => [
                    'targetEntity'  => 'WellCart\Catalog\Entity\AttributeValueI18n',
                    'mappedBy'      => 'attributeValue',
                    'orphanRemoval' => true,
                    'cascade'       => ['persist', 'merge', 'detach'],
                ],
                ],
                'fields'          =>
                [
                    'sortOrder' =>
                        [
                            'column'                     => 'sort_order',
                            'type'                       => 'integer',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => true,
                                'filters'    => [
                                    'StringTrim' => ['name' => 'StringTrim'],
                                ],
                                'validators' => [
                                    'Digits'  => [
                                        'name' => 'Digits',
                                    ],
                                    'Between' => [
                                        'name'    => 'Between',
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
    'WellCart\Catalog\Entity\AttributeValueI18n'   =>
        [
            'type'            => 'entity',
            'repositoryClass' => 'WellCart\Catalog\Repository\AttributeValueI18n',
            'table'           => 'catalog_attribute_value_i18n',
            'id'              =>
                [
                    'id' =>
                        [
                            'column'    => 'translation_id',
                            'type'      => 'integer',
                            'nullable'  => false,
                            'generator' =>
                                [
                                    'strategy' => 'AUTO',
                                ],
                        ],
                ],
            'oneToOne'        => [
                'attribute' => [
                    'targetEntity' => 'WellCart\Catalog\Entity\Attribute',
                    'joinColumn'   => [
                        'name'                 => 'attribute_id',
                        'referencedColumnName' => 'attribute_id'
                    ],
                ],

                'language'  => [
                    'targetEntity' => 'WellCart\Base\Entity\Locale\Language',
                    'joinColumn'   => [
                        'name'                 => 'language_id',
                        'referencedColumnName' => 'language_id'
                    ],
                ],
            ],
                'manyToOne'       => [
                'attributeValue' => [
                    'targetEntity' => 'WellCart\Catalog\Entity\AttributeValue',
                    'inversedBy'   => 'translations',
                    'joinColumn'   => [
                        'name'                 => 'attribute_value_id',
                        'referencedColumnName' => 'attribute_value_id'
                    ],
                ],
                ],
                'fields'          =>
                [
                    'name' =>
                        [
                            'column'                     => 'name',
                            'type'                       => 'string',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => true,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'NotEmpty'     => [
                                        'name' => 'NotEmpty',
                                    ],
                                    'StringLength' => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 255,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                ],
        ],

    'WellCart\Catalog\Entity\ProductVariant'       =>
        [
            'type'            => 'entity',
            'repositoryClass' => 'WellCart\Catalog\Repository\ProductVariants',
            'table'           => 'catalog_product_variants',
            'id'              =>
                [
                    'id' =>
                        [
                            'column'    => 'variant_id',
                            'type'      => 'integer',
                            'nullable'  => false,
                            'generator' =>
                                [
                                    'strategy' => 'AUTO',
                                ],
                        ],
                ],
            'oneToMany'       => [
                'combinations' => [
                    'targetEntity'  => 'WellCart\Catalog\Entity\AttributeCombination',
                    'mappedBy'      => 'variant',
                    'orphanRemoval' => true,
                    'cascade'       => ['persist', 'merge', 'detach'],
                ],
            ],
                'manyToOne'       => [
                'product' => [
                    'targetEntity' => 'WellCart\Catalog\Entity\Product',
                    'inversedBy'   => 'variants',
                    'joinColumn'   => [
                        'name'                 => 'product_id',
                        'referencedColumnName' => 'product_id'
                    ],
                ],
                ],
                'fields'          =>
                [
                    'quantity'  =>
                        [
                            'column'                     => 'quantity',
                            'type'                       => 'integer',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => true,
                                'filters'    => [
                                    'StringTrim' => ['name' => 'StringTrim'],
                                ],
                                'validators' => [
                                    'NotEmpty' => [
                                        'name' => 'NotEmpty',
                                    ],
                                    'Digits'   => [
                                        'name' => 'Digits',
                                    ],
                                    'Between'  => [
                                        'name'    => 'Between',
                                        'options' => [
                                            'min' => 0,
                                            'max' => PHP_INT_MAX,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'sku'       =>
                        [
                            'column'                     => 'sku',
                            'type'                       => 'string',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => true,
                                'filters'    => [
                                    'StripTags'     => ['name' => 'StripTags'],
                                    'StringTrim'    => ['name' => 'StringTrim'],
                                    'StripNewlines' => ['name' => 'StripNewlines'],
                                    'Null'          => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'NotEmpty'     => [
                                        'name' => 'NotEmpty',
                                    ],
                                    'StringLength' => [
                                        'name'    => 'StringLength',
                                        'options' => [
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 32,
                                        ],
                                    ],
                                    /**
                                     * 'NoObjectExists' => [
                                     * 'name'    => 'WellCart\ORM\Validator\NoObjectExists',
                                     * 'options' => [
                                     * 'entity_class' => 'WellCart\Catalog\Entity\ProductVariant',
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
                    'price'     =>
                        [
                            'column'                     => 'price',
                            'type'                       => 'decimal',
                            'nullable'                   => false,
                            'input_filter_specification' => [
                                'required'   => true,
                                'filters'    => [
                                    'StringTrim' => ['name' => 'StringTrim'],
                                    'Null'       => ['name' => 'Null'],
                                ],
                                'validators' => [
                                    'NotEmpty'                    => [
                                        'name' => 'NotEmpty',
                                    ],
                                    'Zend\I18n\Validator\IsFloat' => [
                                        'name' => 'Zend\I18n\Validator\IsFloat',
                                    ],
                                    'Between'                     => [
                                        'name'    => 'Between',
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
                            'column'   => 'created_at',
                            'type'     => 'datetime',
                            'nullable' => false,
                            'gedmo'    =>
                                [
                                    'timestampable' =>
                                        [
                                            'on' => 'create',
                                        ],
                                ],
                        ],
                    'updatedAt' =>
                        [
                            'column'   => 'updated_at',
                            'type'     => 'datetime',
                            'nullable' => true,
                            'gedmo'    =>
                                [
                                    'timestampable' =>
                                        [
                                            'on' => 'update',
                                        ],
                                ],
                        ],
                ],
        ],

    'WellCart\Catalog\Entity\AttributeCombination' =>
        [
            'type'      => 'entity',
            'table'     => 'catalog_attribute_combinations',
            'id'        =>
                [
                    'id' =>
                        [
                            'column'    => 'combination_id',
                            'type'      => 'integer',
                            'nullable'  => false,
                            'generator' =>
                                [
                                    'strategy' => 'AUTO',
                                ],
                        ],
                ],
            'manyToOne' => [
                'variant'        => [
                    'targetEntity' => 'WellCart\Catalog\Entity\ProductVariant',
                    'inversedBy'   => 'combinations',
                    'joinColumn'   => [
                        'name'                 => 'variant_id',
                        'referencedColumnName' => 'variant_id'
                    ],
                ],
                'attribute'      => [
                    'targetEntity' => 'WellCart\Catalog\Entity\Attribute',
                    //'inversedBy'   => 'combinations',
                    'joinColumn'   => [
                        'name'                 => 'attribute_id',
                        'referencedColumnName' => 'attribute_id'
                    ],
                ],
                'attributeValue' => [
                    'targetEntity' => 'WellCart\Catalog\Entity\AttributeValue',
                    //'inversedBy'   => 'combinations',
                    'joinColumn'   => [
                        'name'                 => 'attribute_value_id',
                        'referencedColumnName' => 'attribute_value_id'
                    ],
                ],
            ],
                'fields'    =>
                [

                ],
        ],

    'WellCart\Catalog\Entity\FeatureCombination'   =>
        [
            'type'      => 'entity',
            'table'     => 'catalog_feature_combinations',
            'id'        =>
                [
                    'id' =>
                        [
                            'column'    => 'combination_id',
                            'type'      => 'integer',
                            'nullable'  => false,
                            'generator' =>
                                [
                                    'strategy' => 'AUTO',
                                ],
                        ],
                ],
            'manyToOne' => [
                'product'      => [
                    'targetEntity' => 'WellCart\Catalog\Entity\Product',
                    'inversedBy'   => 'features',
                    'joinColumn'   => [
                        'name'                 => 'product_id',
                        'referencedColumnName' => 'product_id'
                    ],
                ],
                'feature'      => [
                    'targetEntity' => 'WellCart\Catalog\Entity\Feature',
                    'joinColumn'   => [
                        'name'                 => 'feature_id',
                        'referencedColumnName' => 'feature_id'
                    ],
                ],
                'featureValue' => [
                    'targetEntity' => 'WellCart\Catalog\Entity\FeatureValue',
                    'joinColumn'   => [
                        'name'                 => 'feature_value_id',
                        'referencedColumnName' => 'feature_value_id'
                    ],
                ],
            ],
                'fields'    =>
                [

                ],
        ],
];
