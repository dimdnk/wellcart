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
        'input_filter' => [
            Entity\Brand::class =>
                [
                    'name'            =>
                        [
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
                                        'entity_class' => Entity\Brand::class,
                                        'fields'       => ['name'],
                                        'messages'     => [
                                            'objectFound' => 'Brand name already exists!',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    'metaTitle'       =>
                        [
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
                    'metaKeywords'    =>
                        [
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
                    'metaDescription' =>
                        [
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
                    'image'           =>
                        [
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
                        ],
                ],


            Entity\ProductTemplate::class     =>
                [
                    'isSystem'  =>
                        [
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
                    'sortOrder' =>
                        [

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
            Entity\ProductTemplateI18n::class =>
                [
                    'name' =>
                        [
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


            Entity\ProductImage::class =>
                [
                    'description' =>
                        [
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
                    'image'       =>
                        [
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
                        ],
                ],
            Entity\Product::class      =>
                [
                    'productTemplate' => [
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
                    'status'          =>
                        [
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
                    'urlKey'          =>
                        [

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
                                        'entity_class' => Entity\Product::class,
                                        'fields'       => ['urlKey'],
                                        'messages'     => [
                                            'objectFound' => 'Url key already exists!',
                                        ],
                                    ],
                                ],

                            ],
                        ],
                    'sortOrder'       =>
                        [

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
            Entity\ProductI18n::class  =>
                [
                    'name'            =>
                        [
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
                    'description'     =>
                        [
                            'required'   => false,
                            'filters'    => [
                                'StripTags'     => [
                                    'name'    => 'StripTags',
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
                                                'width',
                                            ],
                                            'a'   => [
                                                'href',
                                            ],
                                        ],
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
                    'metaTitle'       =>
                        [
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
                    'metaKeywords'    =>
                        [
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
                    'metaDescription' =>
                        [
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
            Entity\Category::class     =>
                [
                    'isVisible' =>
                        [
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
                    'urlKey'    =>
                        [
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
                    'sortOrder' =>
                        [
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
            Entity\CategoryI18n::class =>
                [
                    'name'            =>
                        [
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
                    'description'     =>
                        [
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
                    'metaTitle'       =>
                        [
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
                    'metaKeywords'    =>
                        [
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
                    'metaDescription' =>
                        [
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

            Entity\Feature::class     =>
                [
                    'backendName' =>
                        [
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
                    'sortOrder'   =>
                        [
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
            Entity\FeatureI18n::class =>
                [
                    'name' =>
                        [
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


            Entity\FeatureValue::class     =>
                [
                    'sortOrder' =>
                        [
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
            Entity\FeatureValueI18n::class =>
                [
                    'name' =>
                        [
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


            Entity\Attribute::class     =>
                [

                    'backendName' =>
                        [
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
                    'sortOrder'   =>
                        [
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
            Entity\AttributeI18n::class =>
                [
                    'name' =>
                        [
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


            Entity\AttributeValue::class     =>
                [
                    'sortOrder' =>
                        [
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
            Entity\AttributeValueI18n::class =>
                [
                    'name' =>
                        [
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

            Entity\ProductVariant::class =>
                [
                    'quantity' =>
                        [
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
                    'sku'      =>
                        [
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
                    'price'    =>
                        [
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

            Entity\AttributeCombination::class =>
                [
                ],
            Entity\FeatureCombination::class   =>
                [
                ],
        ],
    ],
];
