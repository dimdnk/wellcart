<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Setup\Composer;


class ScriptHandler
{
    /**
     * Set permissions for directories
     */
    public static function setPermissions()
    {
        $prefix = '';
        if (is_dir(getcwd().'/tests')) {
            $prefix = 'tests/';
        }
        $directories = [
            'config/autoload',
            'data',
            'data/cache',
            'data/logs',
            'data/db/migrations',
            'data/db/seeds',
            'data/sessions',
            'data/upload',
            'public/assets',
            'public/themes',
            'public/media',
        ];
        foreach ($directories as $directory) {
            chmod($prefix . $directory, 0777);
        }
    }
}
