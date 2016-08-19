<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Setup\Controller;

use WellCart\Mvc\Controller\AbstractControllerTrait;
use WellCart\Setup\Service\Setup as SetupService;
use WellCart\Utility\Arr;
use Zend\Console\ColorInterface as Color;
use Zend\I18n\Translator\TranslatorAwareInterface;
use Zend\Log\LoggerAwareInterface;
use Zend\Mvc\Controller\AbstractConsoleController;

class ConsoleSetupController extends AbstractConsoleController implements
    LoggerAwareInterface,
    TranslatorAwareInterface
{
    use AbstractControllerTrait;

    /**
     * @param SetupService $setupService
     */
    public function handleAction(SetupService $setupService)
    {
        $console = $this->getConsole();
        $params = (array)$this->getRequest()->getParams();
        $dbConfig = [
            'driver'   => Arr::get($params, 'db-driver', 'pdo_mysql'),
            'port'     => Arr::get($params, 'db-port', 3306),
            'host'     => Arr::get($params, 'db-host', 'localhost'),
            'database' => Arr::get($params, 'db-name', 'wellcart'),
            'username' => Arr::get($params, 'db-username'),
            'password' => Arr::get($params, 'db-password'),
        ];

        $websiteConfig = [
            'website_name' => Arr::get($params, 'website-name'),
            'base_path'    => Arr::get($params, 'base-path'),
        ];

        $adminParams = [
            'email'      => Arr::get($params, 'admin-email'),
            'password'   => Arr::get($params, 'admin-password'),
            'first_name' => Arr::get($params, 'admin-first-name', 'Admin'),
            'last_name'  => Arr::get($params, 'admin-last-name', 'Account'),
        ];

        try {
            $console->writeLine(
                "WellCart installation started:",
                Color::CYAN
            );

            $console->writeLine(
                " * Setup database",
                Color::GREEN
            );
            $setupService->installDatabase($dbConfig);
            $setupService->setupWebsiteConfiguration($websiteConfig);

            $console->writeLine(
                " * Publish assets",
                Color::GREEN
            );
            $setupService->publishAssets();

            $console->writeLine(
                " * Create admin account",
                Color::GREEN
            );
            $setupService->createAdminAccount($adminParams);

            $console->writeLine(
                " * Finalize installation",
                Color::GREEN
            );
            $setupService->createInstalledManifest();

            $console->writeLine(
                sprintf(
                    "For security, remove write permissions from %s directory.",
                    WELLCART_ROOT . 'config/'
                ),
                Color::GREEN
            );
            $console->writeLine(
                "WellCart installed successfully.",
                Color::GREEN
            );
        } catch (\Throwable $e) {
            error_log($e->__toString());
            $console->writeLine(
                sprintf(
                    "Error during installation: %s \n %s", $e->getMessage(),
                    $e->__toString()
                ),
                Color::WHITE,
                Color::RED
            );
        }
    }

    /**
     * @param SetupService $setupService
     */
    public function upgradeAction(SetupService $setupService)
    {
        $console = $this->getConsole();
        try {
            $console->writeLine(
                "Updating system modules...\n",
                Color::CYAN
            );
            $setupService->upgrade();
            $console->writeLine(
                "WellCart upgraded successfully.",
                Color::GREEN
            );
        } catch (\Throwable $e) {
            error_log($e->__toString());
            $console->writeLine(
                sprintf(
                    "Error during system upgrade: %s",
                    $e->getMessage()
                ),
                Color::WHITE,
                Color::RED
            );
        }
    }

    /**
     * @param SetupService $setupService
     */
    public function publishAssetsAction(SetupService $setupService)
    {
        $console = $this->getConsole();
        try {
            $console->writeLine(
                "Dumps all assets to the filesystem:\n",
                Color::CYAN
            );
            $result = $setupService->publishAssets();
            foreach ($result as $source => $destination) {
                $source = str_replace(WELLCART_ROOT, '', $source);
                $destination = str_replace(WELLCART_ROOT, '', $destination);
                $msg = sprintf(
                    " * %s -> %s",
                    $source,
                    $destination
                );
                $console->writeLine($msg, Color::GREEN);
            }
            $console->writeLine(
                "Finished.",
                Color::GREEN
            );
        } catch (\Throwable $e) {
            error_log($e->__toString());
            $console->writeLine(
                sprintf(
                    "Error during assets publishing: %s",
                    $e->getMessage()
                ),
                Color::WHITE,
                Color::RED
            );
        }
    }
}
