<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Controller\Console;

use WellCart\Base\Service\Cache\Flusher;
use WellCart\Mvc\Controller\AbstractControllerTrait;
use WellCart\Setup\Service\Setup as SetupService;
use Zend\Console\ColorInterface as Color;
use Zend\I18n\Translator\TranslatorAwareInterface;
use Zend\Log\LoggerAwareInterface;
use Zend\Mvc\Controller\AbstractConsoleController;

class CacheController extends AbstractConsoleController implements
    LoggerAwareInterface,
    TranslatorAwareInterface
{

    use AbstractControllerTrait;

    /**
     * @param Flusher $flusher
     */
    public function flushAction(Flusher $flusher, SetupService $setupService)
    {
        $console = $this->getConsole();
        try {
            $console->writeLine(
                "Flushed cache directories.",
                Color::CYAN
            );

            $flusher->flush();
            $setupService->generateProxyClasses();

            $console->writeLine(
                "Finished.",
                Color::GREEN
            );
        } catch (\Throwable $e) {
            error_log($e->__toString());
            $console->writeLine(
                sprintf(
                    "Error during flushing cache: %s",
                    $e->getMessage()
                ),
                Color::WHITE,
                Color::RED
            );
        }
    }
}
