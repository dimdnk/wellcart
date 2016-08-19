<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Service\Cache;

class Flusher
{
    /**
     * @var array
     */
    protected $paths
        = [
            WELLCART_STORAGE_PATH . 'cache' . DS,
            WELLCART_STORAGE_PATH . 'code' . DS,
            WELLCART_MEDIA_PATH,
        ];

    /**
     * Flush all system caches
     */
    public function flush()
    {
        foreach ($this->paths as $path) {
            $files = glob($path . '*', GLOB_MARK);
            foreach ($files as $target) {
                remove_directory($target);
            }
        }
    }
}
