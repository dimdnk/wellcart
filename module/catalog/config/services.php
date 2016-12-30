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
        PageView\Backend\ProductForm::class          =>
            function (ContainerInterface $services
            ) {
                return new PageView\Backend\ProductForm(
                    $services->get(
                        Spec\ProductRepository::class
                    )
                );
            },
        PageView\Backend\ProductsGrid::class         =>
            function (ContainerInterface $services
            ) {
                return new PageView\Backend\ProductsGrid(
                    $services->get(
                        Spec\ProductI18nRepository::class
                    )
                );
            },
        PageView\Backend\ProductTemplateForm::class  =>
            function (ContainerInterface $services
            ) {
                return new PageView\Backend\ProductTemplateForm(
                    $services->get(
                        Spec\ProductTemplateRepository::class
                    )
                );
            },
        PageView\Backend\ProductTemplatesGrid::class =>
            function (ContainerInterface $services
            ) {
                return new PageView\Backend\ProductTemplatesGrid(
                    $services->get(
                        Spec\ProductTemplateI18nRepository::class
                    )
                );
            },
        PageView\Backend\AttributeForm::class        =>
            function (ContainerInterface $services
            ) {
                return new PageView\Backend\AttributeForm(
                    $services->get(Spec\AttributeRepository::class)
                );
            },
        PageView\Backend\AttributesGrid::class       =>
            function (ContainerInterface $services
            ) {
                return new PageView\Backend\AttributesGrid(
                    $services->get(
                        Spec\AttributeI18nRepository::class
                    )
                );
            },
        PageView\Backend\FeatureForm::class          =>
            function (ContainerInterface $services
            ) {
                return new PageView\Backend\FeatureForm(
                    $services->get(
                        Spec\FeatureRepository::class
                    )
                );
            },
        PageView\Backend\FeaturesGrid::class         =>
            function (ContainerInterface $services
            ) {
                return new PageView\Backend\FeaturesGrid(
                    $services->get(
                        Spec\FeatureI18nRepository::class
                    )
                );
            },
        PageView\Backend\CategoryForm::class         =>
            function (ContainerInterface $services
            ) {
                return new PageView\Backend\CategoryForm(
                    $services->get(
                        Spec\CategoryRepository::class
                    )
                );
            },
        PageView\Backend\CategoriesGrid::class       =>
            function (ContainerInterface $services
            ) {
                return new PageView\Backend\CategoriesGrid(
                    $services->get(
                        Spec\CategoryI18nRepository::class
                    )
                );
            },
        PageView\Backend\BrandForm::class            =>
            function (ContainerInterface $services
            ) {
                return new PageView\Backend\BrandForm(
                    $services->get(Spec\BrandRepository::class)
                );
            },
        PageView\Backend\BrandsGrid::class           =>
            function (ContainerInterface $services
            ) {
                return new PageView\Backend\BrandsGrid(
                    $services->get(Spec\BrandRepository::class)
                );
            },
        Repository\ProductVariants::class            =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        Spec\ProductVariantEntity::class
                    );
            },
        Repository\ProductImages::class              =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        Spec\ProductImageEntity::class
                    );
            },
        Repository\ProductTemplates::class           =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        Spec\ProductTemplateEntity::class
                    );
            },
        Repository\ProductTemplateI18n::class        =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        Spec\ProductTemplateI18nEntity::class
                    );
            },

        Repository\Attributes::class         =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        Spec\AttributeEntity::class
                    );
            },
        Repository\AttributeI18n::class      =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        Spec\AttributeI18nEntity::class
                    );
            },
        Repository\AttributeValues::class    =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        Spec\AttributeValueEntity::class
                    );
            },
        Repository\AttributeValueI18n::class =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        Spec\AttributeValueI18nEntity::class
                    );
            },

        Repository\Features::class         =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        Spec\FeatureEntity::class
                    );
            },
        Repository\FeatureI18n::class      =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        Spec\FeatureI18nEntity::class
                    );
            },
        Repository\FeatureValues::class    =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        Spec\FeatureValueEntity::class
                    );
            },
        Repository\FeatureValueI18n::class =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        Spec\FeatureValueI18nEntity::class
                    );
            },
        Repository\Categories::class       =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        Spec\CategoryEntity::class
                    );
            },
        Repository\CategoryI18n::class     =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        Spec\CategoryI18nEntity::class
                    );
            },
        Repository\Products::class         =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        Spec\ProductEntity::class
                    );
            },
        Form\Brand::class                  =>
            function (ContainerInterface $services) {
                $form = new Form\Brand(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_catalog_brand_hydrator')
                );
                return $form;
            },
        Repository\Brands::class           =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        Spec\BrandEntity::class
                    );
            },
        Repository\ProductI18n::class      =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_catalog_object_manager')
                    ->getRepository(
                        Spec\ProductI18nEntity::class
                    );
            },
        Form\Product::class                =>
            function (ContainerInterface $services) {
                $productPrototype = $services->get(
                    Spec\ProductRepository::class
                )->createEntity();

                $productTranslationPrototype = $services->get(
                    Spec\ProductI18nRepository::class
                )->createEntity();

                $productVariantPrototype = $services->get(
                    Spec\ProductVariantRepository::class
                )->createEntity();

                $productFeatureCombinationPrototype = new FeatureCombination();
                $productImagePrototype = $services->get(
                    Spec\ProductImageRepository::class
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
        Form\Category::class               =>
            function (ContainerInterface $services) {
                $categoryPrototype = $services->get(
                    Spec\CategoryRepository::class
                )->createEntity();

                $categoryTranslationPrototype = $services->get(
                    Spec\CategoryI18nRepository::class
                )->createEntity();

                $form = new Form\Category(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_catalog_doctrine_hydrator'),
                    $categoryPrototype,
                    $categoryTranslationPrototype
                );
                return $form;
            },

        Form\ProductTemplate::class =>
            function (ContainerInterface $services) {
                $productTemplatePrototype = $services->get(
                    Spec\ProductTemplateRepository::class
                )->createEntity();
                $productTemplateI18nPrototype = $services->get(
                    Spec\ProductTemplateI18nRepository::class
                )->createEntity();

                $form = new Form\ProductTemplate(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_catalog_doctrine_hydrator'),
                    $productTemplatePrototype,
                    $productTemplateI18nPrototype
                );
                return $form;
            },


        Form\Attribute::class =>
            function (ContainerInterface $services) {
                $attributePrototype = $services->get(
                    Spec\AttributeRepository::class
                )->createEntity();

                $attributeI18nPrototype = $services->get(
                    Spec\AttributeI18nRepository::class
                )->createEntity();

                $attributeValuePrototype = $services->get(
                    Spec\AttributeValueRepository::class
                )->createEntity();

                $attributeValueI18nPrototype = $services->get(
                    Spec\AttributeValueI18nRepository::class
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

        Form\Feature::class                 =>
            function (ContainerInterface $services) {
                $featurePrototype = $services->get(
                    Spec\FeatureRepository::class
                )->createEntity();

                $featureI18nPrototype = $services->get(
                    Spec\FeatureI18nRepository::class
                )->createEntity();

                $featureValuePrototype = $services->get(
                    Spec\FeatureValueRepository::class
                )->createEntity();

                $featureValueI18nPrototype = $services->get(
                    Spec\FeatureValueI18nRepository::class
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
