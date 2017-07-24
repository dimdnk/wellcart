<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types=1);

namespace WellCart\Directory\Setup\Schema;

use WellCart\Setup\SchemaMigration\AbstractMigration;

/**
 * @codeCoverageIgnore
 */
class Install extends AbstractMigration
{

    public function up()
    {
        $this->table(
            'directory_countries',
            ['id' => 'country_id', 'primary_key' => ['country_id']]
        )
            ->addColumn(
                'name',
                'string',
                ['null' => false, 'limit' => 255, 'comment' => 'Name']
            )
            ->addColumn(
                'status',
                'boolean',
                ['null'    => true, 'default' => true, 'signed' => false,
                 'comment' => 'Status']
            )
            ->addColumn(
                'postcode_required',
                'boolean',
                ['null'    => true, 'default' => false, 'signed' => false,
                 'comment' => 'Is Postcode Required']
            )
            ->addColumn(
                'address_format',
                'text',
                ['null' => true, 'comment' => 'Address Format']
            )
            ->addColumn(
                'iso_code_2',
                'string',
                ['null' => true, 'limit' => 255, 'comment' => 'ISO Code 2']
            )
            ->addColumn(
                'iso_code_3',
                'string',
                ['null' => true, 'limit' => 255, 'comment' => 'ISO Code 3']
            )
            ->addColumn(
                'created_at',
                'timestamp',
                ['null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => 'Created At']
            )
            ->addColumn(
                'updated_at',
                'timestamp',
                ['null' => true, 'default' => null, 'comment' => 'Updated At']
            )
            ->addIndex(
                ['name'],
                ['name'   => 'unique_directory_country_name',
                 'unique' => true]
            )
            ->create();


        $this->table(
            'directory_currencies',
            ['id' => 'currency_id', 'primary_key' => ['currency_id']]
        )
            ->addColumn(
                'title',
                'string',
                ['null' => true, 'limit' => 128, 'comment' => 'Title']
            )
            ->addColumn(
                'code',
                'string',
                ['null' => true, 'limit' => 10, 'comment' => 'Code']
            )
            ->addColumn(
                'symbol',
                'string',
                ['null' => true, 'limit' => 30, 'comment' => 'Symbol']
            )
            ->addColumn(
                'symbol_position',
                'string',
                ['null' => true, 'limit' => 30, 'comment' => 'Symbol Position']
            )
            ->addColumn(
                'exchange_rate',
                'decimal',
                ['null'   => true, 'precision' => 12, 'scale' => 4,
                 'signed' => true, 'comment' => 'Exchange Rate']
            )
            ->addColumn(
                'decimals',
                'integer',
                ['null' => true, 'signed' => false, 'comment' => 'Decimals']
            )
            ->addColumn(
                'decimals_separator',
                'string',
                ['null'    => true,
                 'limit'   => 1,
                 'comment' => 'Decimals Separator']
            )
            ->addColumn(
                'thousands_separator',
                'string',
                ['null'    => true,
                 'limit'   => 1,
                 'comment' => 'Thousands Separator']
            )
            ->addColumn(
                'status',
                'boolean',
                ['null'    => true, 'default' => true, 'signed' => false,
                 'comment' => 'Status']
            )
            ->addColumn(
                'is_primary',
                'boolean',
                ['null'    => true, 'default' => false, 'signed' => false,
                 'comment' => 'Is Primary']
            )
            ->addColumn(
                'created_at',
                'timestamp',
                ['null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => 'Created At']
            )
            ->addColumn(
                'updated_at',
                'timestamp',
                ['null' => true, 'default' => null, 'comment' => 'Updated At']
            )
            ->addIndex(
                ['title'],
                ['name'   => 'unique_directory_currency_title',
                 'unique' => true]
            )
            ->addIndex(
                ['code'],
                ['name'   => 'unique_directory_currency_code',
                 'unique' => true]
            )
            ->create();


        $this->table(
            'directory_geo_zones',
            ['id' => 'geo_zone_id', 'primary_key' => ['geo_zone_id']]
        )
            ->addColumn(
                'name',
                'string',
                ['null' => false, 'limit' => 255, 'comment' => 'Name']
            )
            ->addColumn(
                'description',
                'string',
                ['null' => true, 'limit' => 255, 'comment' => 'Description']
            )
            ->addColumn(
                'created_at',
                'timestamp',
                ['null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => 'Created At']
            )
            ->addColumn(
                'updated_at',
                'timestamp',
                ['null' => true, 'default' => null, 'comment' => 'Updated At']
            )
            ->addIndex(
                ['name'],
                ['name'   => 'unique_directory_geo_zone_name',
                 'unique' => true]
            )
            ->create();


        $this->table(
            'directory_zones',
            ['id' => 'zone_id', 'primary_key' => ['zone_id']]
        )
            ->addColumn(
                'country_id',
                'integer',
                ['null' => true, 'default' => null, 'comment' => 'Country ID']
            )
            ->addColumn(
                'name',
                'string',
                ['null' => false, 'limit' => 255, 'comment' => 'Name']
            )
            ->addColumn(
                'code',
                'string',
                ['null' => false, 'limit' => 32, 'comment' => 'Code']
            )
            ->addColumn(
                'status',
                'boolean',
                ['null'    => false, 'default' => true, 'signed' => false,
                 'comment' => 'Status']
            )
            ->addColumn(
                'created_at',
                'timestamp',
                ['null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => 'Created At']
            )
            ->addColumn(
                'updated_at',
                'timestamp',
                ['null' => true, 'default' => null, 'comment' => 'Updated At']
            )
            ->addForeignKey(
                'country_id',
                'directory_countries',
                'country_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addIndex(
                ['country_id', 'name', 'code'],
                ['name'   => 'unique_directory_country_zone',
                 'unique' => true,]
            )
            ->create();


        $this->table(
            'directory_zone_to_geo_zone',
            ['id'          => 'zone_to_geo_zone_id',
             'primary_key' => ['zone_to_geo_zone_id']]
        )
            ->addColumn(
                'geo_zone_id',
                'integer',
                ['null' => true, 'default' => null, 'comment' => 'Geo Zone ID']
            )
            ->addColumn(
                'country_id',
                'integer',
                ['null' => true, 'default' => null, 'comment' => 'Country ID']
            )
            ->addColumn(
                'zone_id',
                'integer',
                ['null' => true, 'default' => null, 'comment' => 'Zone ID']
            )
            ->addColumn(
                'created_at',
                'timestamp',
                ['null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => 'Created At']
            )
            ->addColumn(
                'updated_at',
                'timestamp',
                ['null' => true, 'default' => null, 'comment' => 'Updated At']
            )
            ->addForeignKey(
                'country_id',
                'directory_countries',
                'country_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'zone_id',
                'directory_zones',
                'zone_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'geo_zone_id',
                'directory_geo_zones',
                'geo_zone_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();
    }

    public function down()
    {
        $table = $this->table('directory_zone_to_geo_zone');
        $table->dropForeignKey('country_id');
        $table->removeIndex(['country_id']);
        $table->dropForeignKey('zone_id');
        $table->removeIndex(['zone_id']);
        $table->dropForeignKey('geo_zone_id');
        $table->removeIndex(['geo_zone_id']);
        $table->drop();


        $table = $this->table('directory_zones');
        $table->dropForeignKey('country_id');
        $table->removeIndex(['country_id']);
        $table->drop();

        $this->table('directory_geo_zones')->drop();
        $this->table('directory_currencies')->drop();
        $this->table('directory_countries')->drop();
    }
}
