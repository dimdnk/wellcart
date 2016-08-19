<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\CMS\Setup\Schema;

use WellCart\Setup\SchemaMigration\AbstractMigration;

/**
 * @codeCoverageIgnore
 */
class Install extends AbstractMigration
{

    public function up()
    {
        $this->table(
            'cms_pages',
            [
                'comment' => 'CMS Pages',
                'id'      => 'page_id', 'primary_key' => ['page_id']]
        )
            ->addColumn(
                'status',
                'boolean',
                ['null'    => false, 'default' => true, 'signed' => false,
                 'comment' => 'Status']
            )
            ->addColumn(
                'url_key',
                'string',
                ['null' => false, 'limit' => 50, 'comment' => 'URL Key']
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
                ['url_key'],
                ['name' => 'unique_cms_page_url_key', 'unique' => true]
            )
            ->create();


        $this->table(
            'cms_page_i18n',
            [
                'comment'     => 'CMS Page Text Content',
                'id'          => 'translation_id',
                'primary_key' => ['translation_id']]
        )
            ->addColumn(
                'page_id',
                'integer',
                ['null' => false, 'comment' => 'Page ID']
            )
            ->addColumn(
                'language_id',
                'integer',
                ['null' => false, 'comment' => 'Language ID']
            )
            ->addColumn(
                'title',
                'string',
                ['null' => false, 'limit' => 255, 'comment' => 'Title']
            )
            ->addColumn(
                'body',
                'text',
                ['null' => true, 'comment' => 'Body']
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
            ->addForeignKey(
                'page_id',
                'cms_pages',
                'page_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'language_id',
                'base_locale_languages',
                'language_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();
    }

    public function down()
    {
        $table = $this->table('cms_page_i18n');
        $table->dropForeignKey('page_id');
        $table->dropForeignKey('language_id');
        $table->drop();

        $this->table('cms_pages')->drop();
    }
}
