<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Setup\Schema;

use WellCart\Setup\SchemaMigration\AbstractMigration;

/**
 * @codeCoverageIgnore
 */
class Install extends AbstractMigration
{

    /**
     * Create config table
     */
    public function up()
    {
        $this->table(
            'setup_data_migration',
            [
                'comment'     => 'Setup Data Versioning',
                'id'          => false,
                'primary_key' => 'version'
            ]
        )
            ->addColumn('version', 'biginteger')
            ->addColumn(
                'migration_name',
                'string',
                ['limit' => 100, 'default' => null, 'null' => true]
            )
            ->save();

        $this->table(
            'base_configuration',
            [
                'comment'     => 'Base System Configuration',
                'id'          => 'config_id',
                'primary_key' => ['config_id']
            ]
        )
            ->addColumn(
                'config_key',
                'string',
                ['null' => false, 'limit' => 255, 'comment' => 'Config Key']
            )
            ->addColumn(
                'config_value',
                'string',
                ['null' => true, 'limit' => 255, 'comment' => 'Config Value']
            )
            ->addColumn(
                'context',
                'string',
                ['null' => true, 'limit' => 15, 'comment' => 'Context']
            )
            ->addColumn(
                'environment',
                'string',
                ['null' => true, 'limit' => 15, 'comment' => 'Environment']
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
                ['config_key', 'config_value'],
                ['name' => 'config_key_idx', 'unique' => true]
            )
            ->create();

        $this->table(
            'base_url_rewrites',
            [
                'comment'     => 'System URL Rewrites',
                'id'          => 'rewrite_id',
                'primary_key' => ['rewrite_id']]
        )
            ->addColumn(
                'request_path',
                'string',
                ['null' => true, 'limit' => 255, 'comment' => 'Request Path']
            )
            ->addColumn(
                'target_path',
                'string',
                ['null' => true, 'limit' => 255, 'comment' => 'Target Path']
            )
            ->addColumn(
                'is_system',
                'boolean',
                ['null'    => false, 'signed' => false, 'default' => false,
                 'comment' => 'Is System URL']
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
                ['request_path', 'target_path'],
                ['name' => 'unique_url_rewrite_path', 'unique' => true]
            )
            ->create();

        $this->table(
            'base_locale_languages',
            [
                'comment'     => 'Locale Languages Data',
                'id'          => 'language_id',
                'primary_key' => ['language_id']]
        )
            ->addColumn(
                'name',
                'string',
                ['null' => false, 'limit' => 255, 'comment' => 'Name']
            )
            ->addColumn(
                'code',
                'string',
                ['null' => false, 'limit' => 6, 'comment' => 'Code']
            )
            ->addColumn(
                'locale',
                'string',
                ['null' => false, 'limit' => 6, 'comment' => 'Locale']
            )
            ->addColumn(
                'territory',
                'string',
                ['null' => false, 'limit' => 6, 'comment' => 'Territory']
            )
            ->addColumn(
                'is_system',
                'boolean',
                ['null'    => false, 'signed' => false, 'default' => false,
                 'comment' => 'Is Internal Language']
            )
            ->addColumn(
                'is_default',
                'boolean',
                ['null'    => false, 'signed' => false, 'default' => false,
                 'comment' => 'Is Default Language']
            )
            ->addColumn(
                'is_active',
                'boolean',
                ['null'    => false, 'signed' => false, 'default' => true,
                 'comment' => 'Is Active']
            )
            ->addColumn(
                'sort_order',
                'integer',
                ['null'    => false, 'signed' => false, 'default' => 0,
                 'comment' => 'Sort Order']
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
            ->create();

        $this->table(
            'base_job_queue',
            [
                'comment'     => 'Queue Data',
                'id'          => 'id',
                'primary_key' => ['id']
            ]
        )
            ->addColumn(
                'queue',
                'string',
                ['null' => false, 'limit' => 64, 'comment' => 'Queue']
            )
            ->addColumn(
                'data',
                'text',
                ['null' => false, 'comment' => 'Queue Data']
            )
            ->addColumn(
                'status',
                'boolean',
                ['null' => false, 'default' => true, 'comment' => 'Status']
            )
            ->addColumn(
                'created',
                'datetime',
                ['null'    => true, 'default' => null,
                 'comment' => 'Created At']
            )
            ->addColumn(
                'scheduled',
                'datetime',
                ['null'    => true, 'default' => null,
                 'comment' => 'Updated At']
            )
            ->addColumn(
                'executed',
                'datetime',
                ['null' => true, 'default' => null, 'comment' => 'Executed At']
            )
            ->addColumn(
                'finished',
                'datetime',
                ['null' => true, 'default' => null, 'comment' => 'Finished At']
            )
            ->addColumn(
                'message',
                'text',
                ['null' => true, 'comment' => 'Message']
            )
            ->addColumn('trace', 'text', ['null' => true, 'comment' => 'Trace'])
            ->addIndex(['status', 'queue', 'scheduled'], ['name' => 'pop'])
            ->addIndex(['status', 'queue', 'finished'], ['name' => 'prune'])
            ->create();
    }

    /**
     * Drop config table
     */
    public function down()
    {
        $this->table('base_job_queue')->drop();
        $this->table('base_locale_languages')->drop();
        $this->table('base_url_rewrites')->drop();
        $this->table('base_configuration')->drop();

        $this->table('setup_data_migration')->drop();
    }
}
