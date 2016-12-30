<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Form;

use WellCart\Catalog\Entity\ProductImage;
use WellCart\Catalog\Exception;
use WellCart\Catalog\Spec\FeatureCombinationEntity;
use WellCart\Catalog\Spec\ProductEntity;
use WellCart\Catalog\Spec\ProductI18nEntity;
use WellCart\Catalog\Spec\ProductImageEntity;
use WellCart\Catalog\Spec\ProductVariantEntity;
use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use WellCart\Ui\Form\TabbedForm as AbstractForm;
use WellCart\Utility\Arr;
use Zend\Form\Factory;
use Zend\Form\FormInterface;

class Product extends AbstractForm
{
    /**
     * Form constructor
     *
     * @param Factory                  $factory
     * @param ObjectHydrator           $hydrator
     * @param ProductEntity            $productPrototype
     * @param ProductI18nEntity        $productTranslationPrototype
     * @param ProductVariantEntity     $productVariantPrototype
     * @param FeatureCombinationEntity $productFeatureCombinationPrototype
     * @param ProductImageEntity       $productImagePrototype
     */
    public function __construct(
        Factory $factory,
        ObjectHydrator $hydrator,
        ProductEntity $productPrototype,
        ProductI18nEntity $productTranslationPrototype,
        ProductVariantEntity $productVariantPrototype,
        FeatureCombinationEntity $productFeatureCombinationPrototype,
        ProductImageEntity $productImagePrototype
    ) {
        $this->setFormFactory($factory);
        parent::__construct('catalog_product');

        $this->setAttribute('enctype', 'multipart/form-data');

        $this->setWrapElements(true);

        $this->setHydrator($hydrator);

        $productFieldset = new Product\ProductFieldset(
            $factory,
            $hydrator,
            $productPrototype,
            $productTranslationPrototype,
            $productVariantPrototype,
            $productFeatureCombinationPrototype,
            $productImagePrototype
        );

        $productFieldset->setAttribute('id', 'product-fieldset');
        $productFieldset->setAttribute('class', 'product-fieldset');
        $productFieldset->setUseAsBaseFieldset(true);
        $this->add($productFieldset, ['priority' => 700]);

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


        $validationGroup = [
            'product' => [
                //'product_template',
                'status',
                'url_key',
                'features',
                'categories',
                'variants'     => [
                    'quantity',
                    'price',
                    'sku',
                ],
                'translations' => [
                    'language',
                    'name',
                    'description',
                    'meta_title',
                    'meta_keywords',
                    'meta_description',
                ],
                'images'       => [
                    'description',
                    'image',
                ],
            ],
        ];
        if ($productFieldset->has('brand')) {
            Arr::set($validationGroup, 'product.-10', 'brand');
        }

        $this->setValidationGroup($validationGroup);

        $this->getEventManager()->trigger('init', $this);
        $this->prepareTabs();
    }

    /**
     * Prepare tabs
     */
    protected function prepareTabs()
    {
        $this->getEventManager()->trigger(__FUNCTION__ . '.pre', $this);
        $this->addTab('general', __('General'));
        $this->addTab('features', __('Features'));
        $this->addTab('categories', __('Categories'));
        $this->addTab('images', __('Images'));
        $items = $this->get('product');

        $general = $this->getTab('general')
            ->setOption('layout', '2columns');
        $fields = [
            'translations'    => 'left',
            'status'          => 'right',
            'brand'           => 'right',
            'url_key'         => 'right',
            // 'product_template' => 'right',
            'add_new_variant' => 'right',
            'variants'        => 'right',
        ];
        foreach ($fields as $field => $tabPosition) {
            if ($items->has($field)) {
                $general->add(
                    $field,
                    $items->get($field)
                        ->setOption('tab', 'general-' . $tabPosition)
                );
            }
        }

        $features = $this->getTab('features');
        $features->add('add_feature', $items->get('add_feature'));
        $features->add('features', $items->get('features'));

        $categories = $this->getTab('categories');
        $categories->add('categories', $items->get('categories'));

        $images = $this->getTab('images');
        $images->add('add_new_image', $items->get('add_new_image'));
        $images->add('images', $items->get('images'));

        $this->getEventManager()->trigger(__FUNCTION__ . '.post', $this);
    }

    /**
     * @inheritdoc
     */
    public function getData($flag = FormInterface::VALUES_NORMALIZED)
    {
        $product = parent::getData($flag);

        if ($product instanceof ProductEntity) {
            $inputFilter = $this->getInputFilter();

            $raw = $inputFilter->getRawValues();

            if (empty($raw['product']['categories'])) {
                $product->noCategories();
            }


            if (empty($raw['product']['images'])) {
                $product->noImages();
            } else {
                $images = $product->getImages();
                $imagesFilter = $inputFilter->get('product')->get('images');
                $imagesData = $imagesFilter->getValues();

                /**
                 * @var $image ProductImage
                 */
                foreach ($images as $k => $image) {
                    $imageData = Arr::get($imagesData, $k . '.image');
                    if (empty($imageData['tmp_name'])) {
                        if (!$image->getFullPath()) {
                            $product->removeImage($image);
                        }
                        continue;
                    }
                }
            }
        }

        return $product;
    }

    /**
     * @inheritdoc
     */
    public function bind($object, $flags = FormInterface::VALUES_NORMALIZED)
    {
        if (!$object instanceof ProductEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\ProductEntity'
            );
        }
        return parent::bind($object, $flags);
    }

    /**
     * @inheritdoc
     */
    public function setObject($object)
    {
        if (!$object instanceof ProductEntity) {
            throw new Exception\InvalidArgumentException(
                'Object must implement interface WellCart\Catalog\ProductEntity'
            );
        }
        return parent::setObject($object);
    }
}
