<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Catalog;

use Interop\Container\ContainerInterface;
use WellCart\Catalog\Entity\FeatureCombination;
use Zend\Form\Factory as FormFactory;

return [
    'factories' => [
        'WellCart\Catalog\PageView\Admin\ProductForm'          =>
            function (ContainerInterface $services
            ) {
                return new PageView\Admin\ProductForm(
                    $services->get(
                        'WellCart\Catalog\Spec\ProductRepository'
                    )
                );
            },
        'WellCart\Catalog\PageView\Admin\ProductsGrid'         =>
            function (ContainerInterface $services
            ) {
                return new PageView\Admin\ProductsGrid(
                    $services->get(
                        'WellCart\Catalog\Spec\ProductI18nRepository'
                    )
                );
            },
        'WellCart\Catalog\PageView\Admin\ProductTemplateForm'  =>
            function (ContainerInterface $services
            ) {
                return new PageView\Admin\ProductTemplateForm(
                    $services->get(
                        'WellCart\Catalog\Spec\ProductTemplateRepository'
                    )
                );
            },
        'WellCart\Catalog\PageView\Admin\ProductTemplatesGrid' =>
            function (ContainerInterface $services
            ) {
                return new PageView\Admin\ProductTemplatesGrid(
                    $services->get(
                        'WellCart\Catalog\Spec\ProductTemplateI18nRepository'
                    )
                );
            },
        'WellCart\Catalog\PageView\Admin\AttributeForm'        =>
            function (ContainerInterface $services
            ) {
                return new PageView\Admin\AttributeForm(
                    $services->get('WellCart\Catalog\Spec\AttributeRepository')
                );
            },
        'WellCart\Catalog\PageView\Admin\AttributesGrid'       =>
            function (ContainerInterface $services
            ) {
                return new PageView\Admin\AttributesGrid(
                    $services->get(
                        'WellCart\Catalog\Spec\AttributeI18nRepository'
                    )
                );
            },
        'WellCart\Catalog\PageView\Admin\FeatureForm'          =>
            function (ContainerInterface $services
            ) {
                return new PageView\Admin\FeatureForm(
                    $services->get(
                        'WellCart\Catalog\Spec\FeatureRepository'
                    )
                );
            },
        'WellCart\Catalog\PageView\Admin\FeaturesGrid'         =>
            function (ContainerInterface $services
            ) {
                return new PageView\Admin\FeaturesGrid(
                    $services->get(
                        'WellCart\Catalog\Spec\FeatureI18nRepository'
                    )
                );
            },
        'WellCart\Catalog\PageView\Admin\CategoryForm'         =>
            function (ContainerInterface $services
            ) {
                return new PageView\Admin\CategoryForm(
                    $services->get(
                        'WellCart\Catalog\Spec\CategoryRepository'
                    )
                );
            },
        'WellCart\Catalog\PageView\Admin\CategoriesGrid'       =>
            function (ContainerInterface $services
            ) {
                return new PageView\Admin\CategoriesGrid(
                    $services->get(
                        'WellCart\Catalog\Spec\CategoryI18nRepository'
                    )
                );
            },
        'WellCart\Catalog\PageView\Admin\BrandForm'            =>
            function (ContainerInterface $services
            ) {
                return new PageView\Admin\BrandForm(
                    $services->get('WellCart\Catalog\Spec\BrandRepository')
                );
            },
        'WellCart\Catalog\PageView\Admin\BrandsGrid'           =>
            function (ContainerInterface $services
            ) {
                return new PageView\Admin\BrandsGrid(
                    $services->get('WellCart\Catalog\Spec\BrandRepository')
                );
            },
        'WellCart\Catalog\Repository\ProductVariants'          =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        'WellCart\Catalog\Spec\ProductVariantEntity'
                    );
            },
        'WellCart\Catalog\Repository\ProductImages'            =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        'WellCart\Catalog\Spec\ProductImageEntity'
                    );
            },
        'WellCart\Catalog\Repository\ProductTemplates'         =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        'WellCart\Catalog\Spec\ProductTemplateEntity'
                    );
            },
        'WellCart\Catalog\Repository\ProductTemplateI18n'      =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        'WellCart\Catalog\Spec\ProductTemplateI18nEntity'
                    );
            },

        'WellCart\Catalog\Repository\Attributes'         =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        'WellCart\Catalog\Spec\AttributeEntity'
                    );
            },
        'WellCart\Catalog\Repository\AttributeI18n'      =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        'WellCart\Catalog\Spec\AttributeI18nEntity'
                    );
            },
        'WellCart\Catalog\Repository\AttributeValues'    =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        'WellCart\Catalog\Spec\AttributeValueEntity'
                    );
            },
        'WellCart\Catalog\Repository\AttributeValueI18n' =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        'WellCart\Catalog\Spec\AttributeValueI18nEntity'
                    );
            },

        'WellCart\Catalog\Repository\Features'         =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        'WellCart\Catalog\Spec\FeatureEntity'
                    );
            },
        'WellCart\Catalog\Repository\FeatureI18n'      =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        'WellCart\Catalog\Spec\FeatureI18nEntity'
                    );
            },
        'WellCart\Catalog\Repository\FeatureValues'    =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        'WellCart\Catalog\Spec\FeatureValueEntity'
                    );
            },
        'WellCart\Catalog\Repository\FeatureValueI18n' =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        'WellCart\Catalog\Spec\FeatureValueI18nEntity'
                    );
            },
        'WellCart\Catalog\Repository\Categories'       =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        'WellCart\Catalog\Spec\CategoryEntity'
                    );
            },
        'WellCart\Catalog\Repository\CategoryI18n'     =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        'WellCart\Catalog\Spec\CategoryI18nEntity'
                    );
            },
        'WellCart\Catalog\Repository\Products'         =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        'WellCart\Catalog\Spec\ProductEntity'
                    );
            },
        'WellCart\Catalog\Form\Brand'                  =>
            function (ContainerInterface $services) {
                $form = new Form\Brand(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_catalog_brand_hydrator')
                );
                return $form;
            },
        'WellCart\Catalog\Repository\Brands'           =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        'WellCart\Catalog\Spec\BrandEntity'
                    );
            },
        'WellCart\Catalog\Repository\ProductI18n'      =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        'WellCart\Catalog\Spec\ProductI18nEntity'
                    );
            },
        'WellCart\Catalog\Form\Product'                =>
            function (ContainerInterface $services) {
                $productPrototype = $services->get(
                    'WellCart\Catalog\Spec\ProductRepository'
                )->createEntity();

                $productTranslationPrototype = $services->get(
                    'WellCart\Catalog\Spec\ProductI18nRepository'
                )->createEntity();

                $productVariantPrototype = $services->get(
                    'WellCart\Catalog\Spec\ProductVariantRepository'
                )->createEntity();

                $productFeatureCombinationPrototype = new FeatureCombination();
                $productImagePrototype = $services->get(
                    'WellCart\Catalog\Spec\ProductImageRepository'
                )->createEntity();

                $form = new Form\Product(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_catalog_product_hydrator'),
                    $productPrototype,
                    $productTranslationPrototype,
                    $productVariantPrototype,
                    $productFeatureCombinationPrototype,
                    $productImagePrototype
                );
                return $form;
            },
        'WellCart\Catalog\Form\Category'               =>
            function (ContainerInterface $services) {
                $categoryPrototype = $services->get(
                    'WellCart\Catalog\Spec\CategoryRepository'
                )->createEntity();

                $categoryTranslationPrototype = $services->get(
                    'WellCart\Catalog\Spec\CategoryI18nRepository'
                )->createEntity();

                $form = new Form\Category(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_catalog_doctrine_hydrator'),
                    $categoryPrototype,
                    $categoryTranslationPrototype
                );
                return $form;
            },

        'WellCart\Catalog\Form\ProductTemplate' =>
            function (ContainerInterface $services) {
                $productTemplatePrototype = $services->get(
                    'WellCart\Catalog\Spec\ProductTemplateRepository'
                )->createEntity();
                $productTemplateI18nPrototype = $services->get(
                    'WellCart\Catalog\Spec\ProductTemplateI18nRepository'
                )->createEntity();

                $form = new Form\ProductTemplate(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_catalog_doctrine_hydrator'),
                    $productTemplatePrototype,
                    $productTemplateI18nPrototype
                );
                return $form;
            },


        'WellCart\Catalog\Form\Attribute' =>
            function (ContainerInterface $services) {
                $attributePrototype = $services->get(
                    'WellCart\Catalog\Spec\AttributeRepository'
                )->createEntity();

                $attributeI18nPrototype = $services->get(
                    'WellCart\Catalog\Spec\AttributeI18nRepository'
                )->createEntity();

                $attributeValuePrototype = $services->get(
                    'WellCart\Catalog\Spec\AttributeValueRepository'
                )->createEntity();

                $attributeValueI18nPrototype = $services->get(
                    'WellCart\Catalog\Spec\AttributeValueI18nRepository'
                )->createEntity();

                $form = new Form\Attribute(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_catalog_doctrine_hydrator'),
                    $attributePrototype,
                    $attributeI18nPrototype,
                    $attributeValuePrototype,
                    $attributeValueI18nPrototype
                );
                return $form;
            },

        'WellCart\Catalog\Form\Feature'     =>
            function (ContainerInterface $services) {
                $featurePrototype = $services->get(
                    'WellCart\Catalog\Spec\FeatureRepository'
                )->createEntity();

                $featureI18nPrototype = $services->get(
                    'WellCart\Catalog\Spec\FeatureI18nRepository'
                )->createEntity();

                $featureValuePrototype = $services->get(
                    'WellCart\Catalog\Spec\FeatureValueRepository'
                )->createEntity();

                $featureValueI18nPrototype = $services->get(
                    'WellCart\Catalog\Spec\FeatureValueI18nRepository'
                )->createEntity();

                $form = new Form\Feature(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_catalog_doctrine_hydrator'),
                    $featurePrototype,
                    $featureI18nPrototype,
                    $featureValuePrototype,
                    $featureValueI18nPrototype
                );
                return $form;
            },
        'wellcart_catalog_product_hydrator' =>
            function (ContainerInterface $services) {
                return new Hydrator\ProductHydrator(
                    $services->get('wellcart_catalog_object_manager')
                );
            },
        'wellcart_catalog_brand_hydrator'   =>
            function (ContainerInterface $services) {
                return new Hydrator\BrandHydrator(
                    $services->get('wellcart_catalog_object_manager')
                );
            },
    ],
];
