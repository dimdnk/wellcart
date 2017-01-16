<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\ModuleManager\Feature;

interface ModulePathProviderInterface
{

    /**
     * Expected to return absolute path to module directory
     *
     * @return string
     */
    public function getAbsolutePath();
}