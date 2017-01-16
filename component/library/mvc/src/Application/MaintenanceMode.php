<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Mvc\Application;

class MaintenanceMode
{

    /**
     * Maintenance flag file name
     */
    const FLAG_FILENAME = 'maintenance.flag';

    /**
     * @return bool
     */
    public function enable(): bool
    {
        return $this->set(true);
    }

    /**
     * Sets maintenance mode "on" or "off"
     *
     * @param bool $isEnabled
     *
     * @return bool
     */
    protected function set(bool $isEnabled): bool
    {
        if ($isEnabled) {
            return touch(WELLCART_STORAGE_PATH . self::FLAG_FILENAME);
        }
        if ($this->isEnabled()) {
            return unlink(WELLCART_STORAGE_PATH . self::FLAG_FILENAME);
        }

        return true;
    }

    /**
     * Checks whether mode is on
     *
     * @return bool
     */
    public function isEnabled()
    {
        return is_file(WELLCART_STORAGE_PATH . self::FLAG_FILENAME);
    }

    /**
     * @return bool
     */
    public function disable(): bool
    {
        return $this->set(false);
    }
}
