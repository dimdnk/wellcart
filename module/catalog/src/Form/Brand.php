<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Form;

use WellCart\Catalog\Exception;
use WellCart\Catalog\Hydrator\BrandHydrator;
use WellCart\Catalog\Spec\BrandEntity;
use WellCart\Form\Form as AbstractForm;
use WellCart\Utility\Arr;
use Zend\Form\Factory;
use Zend\Form\FormInterface;

class Brand extends AbstractForm
{

    /**
     * Form constructor
     *
     * @param Factory       $factory
     * @param BrandHydrator $hydrator
     */
    public function __construct(
        Factory $factory,
        BrandHydrator $hydrator
    ) {
        $this->setFormFactory($factory);
        parent::__construct('catalog_brand');

        $this->setHydrator($hydrator);

        $this->setWrapElements(true);
        $this->setAttribute('enctype', 'multipart/form-data');


        $this->add(
            [
                'name'       => 'name',
                'type'       => 'Text',
                'options'    => [
                    'label'            => __('Brand Name'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'id'        => 'catalog_brand_name',
                    'autofocus' => 'autofocus',
                ],
            ],
            ['priority' => 700]
        );


        $this->add(
            [
                'name'       => 'image',
                'type'       => 'File',
                'options'    => [
                    'label'            => __('Brand Image'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'id' => 'catalog_brand_image',
                ],
            ],
            ['priority' => 650]
        );

        $this->add(
            [
                'name'       => 'meta_title',
                'type'       => 'Text',
                'options'    => [
                    'label'            => __('Page Title'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'id' => 'catalog_brand_meta_title',
                ],
            ],
            ['priority' => 600]
        );

        $this->add(
            [
                'name'       => 'meta_keywords',
                'type'       => 'Textarea',
                'options'    => [
                    'label'            => __('Meta Keywords'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'id' => 'catalog_brand_meta_keywords',
                ],
            ],
            ['priority' => 550]
        );

        $this->add(
            [
                'name'       => 'meta_description',
                'type'       => 'Textarea',
                'options'    => [
                    'label'            => __('Meta Description'),
                    'twb-layout'       => 'horizontal',
                    'column-size'      => 'md-8',
                    'help-block'       => __('Maximum 255 chars'),
                    'label_attributes' => [
                        'class' => 'col-md-4',
                    ],
                ],
                'attributes' => [
                    'id' => 'catalog_brand_meta_description',
                ],
            ],
            ['priority' => 500]
        );

        $this->add(
            [
                'type'       => 'Csrf',
                'name'       => 'csrf',
                'attributes' => [
                    'id' => 'catalog_brand_csrf',
                ],
            ],
            ['priority' => 450]
        );

        $this->addToolbarButton(
            [
                'name'       => 'save',
                'type'       => 'Submit',
                'options'    => [
                    'label'       => __('Save'),
                    'fontAwesome' => [
                        'icon' => 'check'
                    ],
                ],
                'attributes' => [
                    'class' => 'btn btn-toolbar-action btn-circle btn-success pull-right',
                ],
            ]
        );

        $saveAndContinue = clone $this->get('save');
        $saveAndContinue
            ->setName('save_and_continue_edit')
            ->setLabel(__('Save & Continue Edit'))
            ->setOption('fontAwesome', ['icon' => 'check-circle']);
        $this->addToolbarButton($saveAndContinue, 120000);

        $this->getEventManager()->trigger('init', $this);
    }

    /**
     * @inheritdoc
     */
    public function getInputFilter()
    {
        $filter = parent::getInputFilter();

        $imageValue = $this->get('image')->getValue();
        if (!empty($imageValue['name'])
        ) {
            $imageFilter = $filter->get('image');
            if (!$imageFilter->isValid()) {
                $value = $imageFilter->getValue();
                if ($tempFile = Arr::get($value, 'tmp_name')) {
                    is_file($tempFile) && unlink($tempFile);
                }
            }
        }

        return $filter;
    }

    /**
     * @inheritdoc
     */
    public function bind($object, $flags = FormInterface::VALUES_NORMALIZED)
    {
        if (!$object instanceof BrandEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\BrandEntity'
            );
        }

        if ($object->getImageFullPath()) {
            $this->add(
                [
                    'name'       => 'remove_image',
                    'type'       => 'checkbox',
                    'options'    => [
                        'label'               => __('Remove Image'),
                        'strokerform-exclude' => true,
                        'twb-layout'          => 'horizontal',
                        'column-size'         => 'md-12',
                        'label_attributes'    => [
                            'class' => 'col-md-8 col-md-offset-4',
                        ],
                        'use_hidden_element'  => true,
                        'checked_value'       => 1,
                        'unchecked_value'     => 0,
                    ],
                    'attributes' => [
                        'id'    => 'catalog_brand_remove_image',
                        'class' => 'icheck-element',
                    ],
                ],
                ['priority' => 650]
            );
        }

        return parent::bind($object, $flags);
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof BrandEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\Spec\BrandEntity'
            );
        }
        return parent::setObject($object);
    }
}
