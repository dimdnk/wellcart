<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Backend\EventListener\Config;

use Zend\EventManager\EventInterface;

class RemoveConfigCacheFile
{

    /**
     * @param EventInterface $event
     *
     * @return bool
     */
    public function __invoke(EventInterface $event)
    {
        /**
         * Clear cache directory
         */
        $cachePath = WELLCART_STORAGE_PATH . 'cache/';
        $files = scandir($cachePath);
        foreach ($files as $file) {
            $fullPath = $cachePath . $file;
            if (substr($file, 0, 1) != '.' && is_file($fullPath)) {
                remove_directory($fullPath);
            }
        }
        return true;
    }
}
