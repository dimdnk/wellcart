<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Setup\Schema;

use WellCart\Setup\SchemaMigration\AbstractMigration;

/**
 * @codeCoverageIgnore
 */
class Install extends AbstractMigration
{

    public function up()
    {

        /**
         * Brands
         */
        $this->table(
            'catalog_brands',
            [
                'comment'     => 'Brands',
                'id'          => 'brand_id',
                'primary_key' => ['brand_id']]
        )
            ->addColumn(
                'name',
                'string',
                ['null' => false, 'limit' => 255, 'comment' => 'I18n']
            )
            ->addColumn(
                'image_full_path',
                'string',
                ['null' => true, 'comment' => 'Image Full Path']
            )
            ->addColumn(
                'meta_title',
                'string',
                ['null' => true, 'limit' => 255, 'comment' => 'Meta Title']
            )
            ->addColumn(
                'meta_keywords',
                'string',
                ['null' => true, 'limit' => 255, 'comment' => 'Meta Keywords']
            )
            ->addColumn(
                'meta_description',
                'string',
                ['null'    => true,
                 'limit'   => 255,
                 'comment' => 'Meta Description']
            )
            ->addColumn(
                'created_at',
                'datetime',
                ['null' => false, 'comment' => 'Created At']
            )
            ->addColumn(
                'updated_at',
                'datetime',
                ['null' => true, 'default' => null, 'comment' => 'Updated At']
            )
            ->addIndex(
                ['name'],
                ['name' => 'unique_catalog_brand_name', 'unique' => true]
            )
            ->create();

        $this->table(
            'catalog_categories',
            [
                'comment'     => 'Categories',
                'id'          => 'category_id',
                'primary_key' => ['category_id']]
        )
            ->addColumn(
                'parent_id',
                'integer',
                ['null' => true, 'default' => null, 'comment' => 'Parent ID']
            )
            ->addColumn(
                'lft',
                'integer',
                ['null' => true, 'default' => null, 'comment' => 'Left ID']
            )
            ->addColumn(
                'rgt',
                'integer',
                ['null' => true, 'default' => null, 'comment' => 'Right ID']
            )
            ->addColumn(
                'root',
                'integer',
                ['null' => true, 'default' => null, 'comment' => 'Root ID']
            )
            ->addColumn(
                'lvl',
                'integer',
                ['null' => true, 'default' => null, 'comment' => 'Level']
            )
            ->addColumn(
                'is_visible',
                'boolean',
                ['null'    => true, 'default' => true, 'signed' => false,
                 'comment' => 'Is Visible']
            )
            ->addColumn(
                'url_key',
                'string',
                ['null' => true, 'limit' => 30, 'comment' => 'Url Key']
            )
            ->addColumn(
                'sort_order',
                'integer',
                ['null' => true, 'default' => null, 'comment' => 'Sort Order']
            )
            ->addColumn(
                'created_at',
                'datetime',
                ['null' => false, 'comment' => 'Created At']
            )
            ->addColumn(
                'updated_at',
                'datetime',
                ['null' => true, 'default' => null, 'comment' => 'Updated At']
            )
            ->addForeignKey(
                'parent_id',
                'catalog_categories',
                'category_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();

        $this->table(
            'catalog_products',
            [
                'comment' => 'Products',
                'id'      => 'product_id', 'primary_key' => ['product_id']]
        )
            ->addColumn(
                'product_template_id',
                'integer',
                ['null' => false, 'comment' => 'Product Template ID']
            )
            ->addColumn(
                'brand_id',
                'integer',
                ['null' => true, 'default' => null, 'comment' => 'Brand ID']
            )
            ->addColumn(
                'parent_id',
                'integer',
                ['null' => true, 'default' => null, 'comment' => 'Parent ID']
            )
            ->addColumn(
                'status',
                'boolean',
                ['null'    => true, 'default' => true, 'signed' => false,
                 'comment' => 'Status']
            )
            ->addColumn(
                'url_key',
                'string',
                ['null' => false, 'limit' => 30, 'comment' => 'URL Key']
            )
            ->addColumn(
                'sort_order',
                'integer',
                ['null' => true, 'default' => null, 'comment' => 'Sort Order']
            )
            ->addColumn(
                'created_at',
                'datetime',
                ['null' => false, 'comment' => 'Created At']
            )
            ->addColumn(
                'updated_at',
                'datetime',
                ['null' => true, 'default' => null]
            )
            ->addIndex(
                ['url_key'],
                ['name'   => 'unique_catalog_product_url_key',
                 'unique' => true]
            )
            ->addForeignKey(
                'parent_id',
                'catalog_products',
                'product_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'brand_id',
                'catalog_brands',
                'brand_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();

        $this->table(
            'catalog_product_i18n',
            [
                'comment'     => 'Product Text Description',
                'id'          => 'translation_id',
                'primary_key' => ['translation_id']]
        )
            ->addColumn('product_id', 'integer', ['null' => false,])
            ->addColumn('language_id', 'integer', ['null' => false,])
            ->addColumn('name', 'string', ['null' => true, 'limit' => 255])
            ->addColumn('description', 'text', ['null' => true,])
            ->addColumn(
                'meta_title',
                'string',
                ['null' => true, 'limit' => 255]
            )
            ->addColumn(
                'meta_keywords',
                'string',
                ['null' => true, 'limit' => 255]
            )
            ->addColumn(
                'meta_description',
                'string',
                ['null' => true, 'limit' => 255]
            )
            ->addForeignKey(
                'product_id',
                'catalog_products',
                'product_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'language_id',
                'base_locale_languages',
                'language_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();


        $this->table(
            'catalog_category_i18n',
            [
                'comment'     => 'Category Text Description',
                'id'          => 'translation_id',
                'primary_key' => ['translation_id']]
        )
            ->addColumn(
                'category_id',
                'integer',
                ['null' => false, 'comment' => 'Category ID']
            )
            ->addColumn(
                'language_id',
                'integer',
                ['null' => false, 'comment' => 'Language ID']
            )
            ->addColumn(
                'name',
                'string',
                ['null' => true, 'limit' => 255, 'comment' => 'I18n']
            )
            ->addColumn(
                'description',
                'text',
                ['null' => true, 'comment' => 'Description']
            )
            ->addColumn(
                'meta_title',
                'string',
                ['null' => true, 'limit' => 255, 'comment' => 'Meta Title']
            )
            ->addColumn(
                'meta_keywords',
                'string',
                ['null' => true, 'limit' => 255, 'comment' => 'Meta Keywords']
            )
            ->addColumn(
                'meta_description',
                'string',
                ['null'    => true,
                 'limit'   => 255,
                 'comment' => 'Meta Description']
            )
            ->addForeignKey(
                'category_id',
                'catalog_categories',
                'category_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'language_id',
                'base_locale_languages',
                'language_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();

        $this->table(
            'catalog_products_to_categories',
            [
                'comment'     => 'Product to Category mapping',
                'id'          => false,
                'primary_key' => ['product_id', 'category_id']
            ]
        )
            ->addColumn(
                'product_id',
                'integer',
                ['null' => false, 'comment' => 'Product ID']
            )
            ->addColumn(
                'category_id',
                'integer',
                ['null' => false, 'comment' => 'Category ID']
            )
            ->addForeignKey(
                'product_id',
                'catalog_products',
                'product_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'category_id',
                'catalog_categories',
                'category_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();


        $this->table(
            'catalog_images',
            [
                'comment' => 'Product Images',
                'id'      => 'image_id', 'primary_key' => ['image_id']]
        )
            ->addColumn(
                'product_id',
                'integer',
                ['null' => false, 'comment' => 'Product ID']
            )
            ->addColumn(
                'full_path',
                'string',
                ['null' => false, 'limit' => 255, 'comment' => 'Full Path']
            )
            ->addColumn(
                'filename',
                'string',
                ['null' => false, 'limit' => 255, 'comment' => 'Filename']
            )
            ->addColumn(
                'original_filename',
                'string',
                ['null'    => false,
                 'limit'   => 255,
                 'comment' => 'Original Filename']
            )
            ->addColumn(
                'description',
                'string',
                ['null' => true, 'limit' => 255, 'comment' => 'Alt Text']
            )
            ->addColumn(
                'image_x',
                'integer',
                ['null' => false, 'comment' => 'Image width']
            )
            ->addColumn(
                'image_y',
                'integer',
                ['null' => false, 'comment' => 'Image height']
            )
            ->addColumn(
                'is_base',
                'boolean',
                ['null'    => false, 'default' => false, 'signed' => false,
                 'comment' => 'Is Base']
            )
            ->addColumn(
                'created_at',
                'datetime',
                ['null' => false, 'comment' => 'Created At']
            )
            ->addColumn(
                'updated_at',
                'datetime',
                ['null' => true, 'default' => null, 'comment' => 'Updated At']
            )
            ->addForeignKey(
                'product_id',
                'catalog_products',
                'product_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();

        $this->table(
            'catalog_features',
            [
                'comment'     => 'Features',
                'id'          => 'feature_id',
                'primary_key' => ['feature_id']]
        )
            ->addColumn(
                'backend_name',
                'string',
                ['null'    => false, 'limit' => 255,
                 'comment' => 'Feature Backend Name']
            )
            ->addColumn(
                'sort_order',
                'integer',
                ['null' => false, 'default' => 0, 'comment' => 'Sort Order']
            )
            ->create();


        $this->table(
            'catalog_feature_i18n',
            [
                'comment'     => 'Feature Names',
                'id'          => 'translation_id',
                'primary_key' => ['translation_id']]
        )
            ->addColumn(
                'feature_id',
                'integer',
                ['null' => true, 'comment' => 'Feature ID']
            )
            ->addColumn(
                'language_id',
                'integer',
                ['null' => false, 'comment' => 'Language ID']
            )
            ->addColumn(
                'name',
                'string',
                ['null' => true, 'limit' => 255, 'comment' => 'I18n']
            )
            ->addForeignKey(
                'feature_id',
                'catalog_features',
                'feature_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'language_id',
                'base_locale_languages',
                'language_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();

        $this->table(
            'catalog_feature_values',
            [
                'comment'     => 'Feature Values',
                'id'          => 'feature_value_id',
                'primary_key' => ['feature_value_id']]
        )
            ->addColumn(
                'feature_id',
                'integer',
                ['null' => true, 'comment' => 'Feature ID']
            )
            ->addColumn(
                'sort_order',
                'integer',
                ['null' => true, 'default' => null, 'comment' => 'Sort Order']
            )
            ->addForeignKey(
                'feature_id',
                'catalog_features',
                'feature_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();


        $this->table(
            'catalog_feature_value_i18n',
            [
                'comment'     => 'Feature Value Names',
                'id'          => 'translation_id',
                'primary_key' => ['translation_id']]
        )
            ->addColumn(
                'feature_id',
                'integer',
                ['null' => true, 'comment' => 'Feature ID']
            )
            ->addColumn(
                'feature_value_id',
                'integer',
                ['null' => true, 'comment' => 'Feature ID']
            )
            ->addColumn(
                'language_id',
                'integer',
                ['null' => false, 'comment' => 'Language ID']
            )
            ->addColumn(
                'name',
                'string',
                ['null' => true, 'limit' => 255, 'comment' => 'I18n']
            )
            ->addForeignKey(
                'feature_id',
                'catalog_features',
                'feature_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'feature_value_id',
                'catalog_feature_values',
                'feature_value_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'language_id',
                'base_locale_languages',
                'language_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();

        $this->table(
            'catalog_product_templates',
            [
                'comment'     => 'Product templates',
                'id'          => 'product_template_id',
                'primary_key' => ['product_template_id']]
        )->addColumn(
            'is_system',
            'boolean',
            ['null'    => false, 'signed' => false, 'default' => false,
             'comment' => 'Is Internal Template']
        )
            ->addColumn(
                'sort_order',
                'integer',
                ['null' => false, 'default' => 0, 'comment' => 'Sort Order']
            )
            ->create();

        $this->table(
            'catalog_products'
        )
            ->addForeignKey(
                'product_template_id',
                'catalog_product_templates',
                'product_template_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->save();


        $this->table(
            'catalog_product_template_i18n',
            [
                'comment'     => 'Product template names',
                'id'          => 'translation_id',
                'primary_key' => ['translation_id']]
        )
            ->addColumn(
                'product_template_id',
                'integer',
                ['null' => true, 'comment' => 'Group ID']
            )
            ->addColumn(
                'language_id',
                'integer',
                ['null' => false, 'comment' => 'Language ID']
            )
            ->addColumn(
                'name',
                'string',
                ['null' => true, 'limit' => 255, 'comment' => 'I18n']
            )
            ->addForeignKey(
                'product_template_id',
                'catalog_product_templates',
                'product_template_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'language_id',
                'base_locale_languages',
                'language_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();


        $this->table(
            'catalog_attributes',
            [
                'comment'     => 'Attributes',
                'id'          => 'attribute_id',
                'primary_key' => ['attribute_id']]
        )
            ->addColumn(
                'backend_name',
                'string',
                ['null'    => false, 'limit' => 255,
                 'comment' => 'Feature Backend Name']
            )
            ->addColumn(
                'sort_order',
                'integer',
                ['null' => false, 'default' => 0, 'comment' => 'Sort Order']
            )
            ->create();


        $this->table(
            'catalog_attribute_i18n',
            [
                'comment'     => 'Attribute Names',
                'id'          => 'translation_id',
                'primary_key' => ['translation_id']]
        )
            ->addColumn(
                'attribute_id',
                'integer',
                ['null' => true, 'comment' => 'Attribute ID']
            )
            ->addColumn(
                'language_id',
                'integer',
                ['null' => false, 'comment' => 'Language ID']
            )
            ->addColumn(
                'name',
                'string',
                ['null' => true, 'limit' => 255, 'comment' => 'I18n']
            )
            ->addForeignKey(
                'attribute_id',
                'catalog_attributes',
                'attribute_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'language_id',
                'base_locale_languages',
                'language_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();

        $this->table(
            'catalog_attribute_values',
            [
                'comment'     => 'Attribute Values',
                'id'          => 'attribute_value_id',
                'primary_key' => ['attribute_value_id']]
        )
            ->addColumn(
                'attribute_id',
                'integer',
                ['null' => true, 'comment' => 'Attribute ID']
            )
            ->addColumn(
                'sort_order',
                'integer',
                ['null' => true, 'default' => null, 'comment' => 'Sort Order']
            )
            ->addForeignKey(
                'attribute_id',
                'catalog_attributes',
                'attribute_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();


        $this->table(
            'catalog_attribute_value_i18n',
            [
                'comment'     => 'Attribute Value Names',
                'id'          => 'translation_id',
                'primary_key' => ['translation_id']]
        )
            ->addColumn(
                'attribute_id',
                'integer',
                ['null' => true, 'comment' => 'Attribute ID']
            )
            ->addColumn(
                'attribute_value_id',
                'integer',
                ['null' => true, 'comment' => 'Attribute ID']
            )
            ->addColumn(
                'language_id',
                'integer',
                ['null' => false, 'comment' => 'Language ID']
            )
            ->addColumn(
                'name',
                'string',
                ['null' => true, 'limit' => 255, 'comment' => 'I18n']
            )
            ->addForeignKey(
                'attribute_id',
                'catalog_attributes',
                'attribute_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'attribute_value_id',
                'catalog_attribute_values',
                'attribute_value_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'language_id',
                'base_locale_languages',
                'language_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();

        $this->table(
            'catalog_feature_to_template',
            [
                'comment'     => 'Feature to Template mapping',
                'id'          => false,
                'primary_key' => ['feature_id', 'product_template_id']
            ]
        )
            ->addColumn(
                'feature_id',
                'integer',
                ['null' => false, 'comment' => 'Feature ID']
            )
            ->addColumn(
                'product_template_id',
                'integer',
                ['null' => false, 'comment' => 'Template ID']
            )
            ->addForeignKey(
                'feature_id',
                'catalog_features',
                'feature_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'product_template_id',
                'catalog_product_templates',
                'product_template_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();

        $this->table(
            'catalog_attribute_to_template',
            [
                'comment'     => 'Attribute to Template mapping',
                'id'          => false,
                'primary_key' => ['attribute_id', 'product_template_id']
            ]
        )
            ->addColumn(
                'attribute_id',
                'integer',
                ['null' => false, 'comment' => 'Attribute ID']
            )
            ->addColumn(
                'product_template_id',
                'integer',
                ['null' => false, 'comment' => 'Template ID']
            )
            ->addForeignKey(
                'attribute_id',
                'catalog_attributes',
                'attribute_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'product_template_id',
                'catalog_product_templates',
                'product_template_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();

        $this->table(
            'catalog_product_variants',
            [
                'comment' => 'Product Variants',
                'id'      => 'variant_id', 'primary_key' => ['variant_id']]
        )
            ->addColumn('product_id', 'integer', ['null' => false,])
            ->addColumn(
                'sku',
                'string',
                ['null'    => false, 'limit' => 32,
                 'comment' => 'Stock Keeping Unit']
            )
            ->addColumn(
                'price',
                'decimal',
                ['null'   => true, 'precision' => 12, 'scale' => 4,
                 'signed' => true, 'comment' => 'Price']
            )
            ->addColumn(
                'quantity',
                'integer',
                ['null' => true, 'default' => null, 'comment' => 'Quantity']
            )
            ->addColumn(
                'sort_order',
                'integer',
                ['null' => false, 'default' => 0, 'comment' => 'Sort Order']
            )
            ->addColumn(
                'created_at',
                'datetime',
                ['null' => false, 'comment' => 'Created At']
            )
            ->addColumn(
                'updated_at',
                'datetime',
                ['null' => true, 'default' => null]
            )
            ->addIndex(
                ['sku'],
                ['name' => 'unique_product_variant_sku', 'unique' => true]
            )
            ->addForeignKey(
                'product_id',
                'catalog_products',
                'product_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();


        $this->table(
            'catalog_attribute_combinations',
            [
                'comment'     => 'Attribute Combinations',
                'id'          => 'combination_id',
                'primary_key' => ['combination_id']
            ]
        )
            ->addColumn(
                'attribute_id',
                'integer',
                ['null' => false, 'comment' => 'Attribute ID']
            )
            ->addColumn(
                'attribute_value_id',
                'integer',
                ['null' => false, 'comment' => 'Attribute Value ID']
            )
            ->addColumn(
                'variant_id',
                'integer',
                ['null' => false, 'comment' => 'Product Variant ID']
            )
            ->addForeignKey(
                'attribute_id',
                'catalog_attributes',
                'attribute_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'attribute_value_id',
                'catalog_attribute_values',
                'attribute_value_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'variant_id',
                'catalog_product_variants',
                'variant_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();

        $this->table(
            'catalog_feature_combinations',
            [
                'comment'     => 'Product Feature Combination',
                'id'          => 'combination_id',
                'primary_key' => ['combination_id']
            ]
        )
            ->addColumn(
                'feature_id',
                'integer',
                ['null' => false, 'comment' => 'Feature ID']
            )
            ->addColumn(
                'feature_value_id',
                'integer',
                ['null' => false, 'comment' => 'Feature Value ID']
            )
            ->addColumn(
                'product_id',
                'integer',
                ['null' => false, 'comment' => 'Product Variant ID']
            )
            ->addForeignKey(
                'feature_id',
                'catalog_features',
                'feature_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'feature_value_id',
                'catalog_feature_values',
                'feature_value_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'product_id',
                'catalog_products',
                'product_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();

    }

    public function down()
    {
        $table = $this->table('catalog_feature_combinations');
        $table->dropForeignKey('feature_id');
        $table->dropForeignKey('feature_value_id');
        $table->dropForeignKey('product_id');
        $table->drop();

        $table = $this->table('catalog_attribute_combinations');
        $table->dropForeignKey('attribute_id');
        $table->dropForeignKey('attribute_value_id');
        $table->dropForeignKey('variant_id');
        $table->drop();

        $table = $this->table('catalog_product_variants');
        $table->dropForeignKey('product_id');
        $table->drop();


        $table = $this->table('catalog_attribute_to_template');
        $table->dropForeignKey('attribute_id');
        $table->dropForeignKey('product_template_id');
        $table->drop();


        $table = $this->table('catalog_feature_to_template');
        $table->dropForeignKey('feature_id');
        $table->dropForeignKey('product_template_id');
        $table->drop();

        $table = $this->table('catalog_attribute_value_i18n');
        $table->dropForeignKey('language_id');
        $table->dropForeignKey('attribute_id');
        $table->dropForeignKey('attribute_value_id');
        $table->drop();

        $table = $this->table('catalog_attribute_values');
        $table->dropForeignKey('attribute_id');
        $table->drop();


        $table = $this->table('catalog_attribute_i18n');
        $table->dropForeignKey('language_id');
        $table->dropForeignKey('attribute_id');
        $table->drop();

        $table = $this->table('catalog_attributes');
        $table->drop();


        $table = $this->table('catalog_product_template_i18n');
        $table->dropForeignKey('language_id');
        $table->dropForeignKey('product_template_id');
        $table->drop();

        $table = $this->table('catalog_products');
        $table->dropForeignKey('product_template_id');
        $table->save();

        $table = $this->table('catalog_product_templates');
        $table->drop();


        $table = $this->table('catalog_feature_value_i18n');
        $table->dropForeignKey('language_id');
        $table->dropForeignKey('feature_id');
        $table->dropForeignKey('feature_value_id');
        $table->drop();

        $table = $this->table('catalog_feature_values');
        $table->dropForeignKey('feature_id');
        $table->drop();


        $table = $this->table('catalog_feature_i18n');
        $table->dropForeignKey('language_id');
        $table->dropForeignKey('feature_id');
        $table->drop();

        $table = $this->table('catalog_features');
        $table->drop();

        $table = $this->table('catalog_images');
        $table->dropForeignKey('product_id');
        $table->drop();

        $table = $this->table('catalog_products_to_categories');
        $table->dropForeignKey('product_id');
        $table->dropForeignKey('category_id');
        $table->drop();


        $table = $this->table('catalog_category_i18n');
        $table->dropForeignKey('language_id');
        $table->dropForeignKey('category_id');
        $table->drop();

        $table = $this->table('catalog_product_i18n');
        $table->dropForeignKey('language_id');
        $table->dropForeignKey('product_id');
        $table->drop();

        $table = $this->table('catalog_products');
        $table->dropForeignKey('brand_id');
        $table->drop();


        $table = $this->table('catalog_categories');
        $table->drop();


        $table = $this->table('catalog_brands');
        $table->drop();
    }
}
