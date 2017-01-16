<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Ui\Container;

interface PreparableContainerInterface
{

    /**
     * This method is called to allow the action to prepare itself.
     *
     * @param  string                  $template The script/resource process
     * @param  null|array|\ArrayAccess $values   Values to use during rendering
     *
     * @return PreparableContainerInterface
     */
    public function prepare($template = null, $values = null);
}