<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\ModuleManager\Feature;

interface SetupMigrationsProviderInterface
{
    /**
     * Retrieve array of migration classes
     *
     * @return \WellCart\SchemaMigration\AbstractMigration[]
     */
    public function getSetupMigrations(): array;

}