<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Setup\Controller\Console;

use WellCart\Mvc\Application\MaintenanceMode;
use WellCart\Mvc\Controller\AbstractControllerTrait;
use Zend\Console\ColorInterface as Color;
use Zend\I18n\Translator\TranslatorAwareInterface;
use Zend\Log\LoggerAwareInterface;
use Zend\Mvc\Controller\AbstractConsoleController;

class MaintenanceModeController extends AbstractConsoleController implements
    LoggerAwareInterface,
    TranslatorAwareInterface
{
    use AbstractControllerTrait;

    /**
     * @param MaintenanceMode $maintenanceMode
     */
    public function statusAction(MaintenanceMode $maintenanceMode)
    {
        $console = $this->getConsole();
        try {
            $console->writeLine(
                'Status: maintenance mode is ' .
                ($maintenanceMode->isEnabled() ? 'active' : 'not active')
            );
        } catch (\Throwable $e) {
            error_log($e->__toString());
            $console->writeLine(
                sprintf(
                    "Error during maintenance mode status check: %s",
                    $e->getMessage()
                ),
                Color::WHITE,
                Color::RED
            );
        }
    }


    /**
     * @param MaintenanceMode $maintenanceMode
     */
    public function enableAction(MaintenanceMode $maintenanceMode)
    {
        $console = $this->getConsole();
        try {
            $maintenanceMode->enable();
            $console->writeLine('Maintenance mode enabled');
        } catch (\Throwable $e) {
            error_log($e->__toString());
            $console->writeLine(
                sprintf(
                    "Error during enabling maintenance mode: %s",
                    $e->getMessage()
                ),
                Color::WHITE,
                Color::RED
            );
        }
    }

    /**
     * @param MaintenanceMode $maintenanceMode
     */
    public function disableAction(MaintenanceMode $maintenanceMode)
    {
        $console = $this->getConsole();
        try {
            $maintenanceMode->disable();
            $console->writeLine('Maintenance mode disabled');
        } catch (\Throwable $e) {
            error_log($e->__toString());
            $console->writeLine(
                sprintf(
                    "Error during disabling maintenance mode: %s",
                    $e->getMessage()
                ),
                Color::WHITE,
                Color::RED
            );
        }
    }
}
