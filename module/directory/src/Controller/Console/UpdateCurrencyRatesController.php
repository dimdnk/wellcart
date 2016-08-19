<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Directory\Controller\Console;

use WellCart\Directory\Spec\CurrencyRepository;
use WellCart\Mvc\Controller\AbstractControllerTrait;
use Zend\Console\ColorInterface as Color;
use Zend\I18n\Translator\TranslatorAwareInterface;
use Zend\Log\LoggerAwareInterface;
use Zend\Mvc\Controller\AbstractConsoleController;

class UpdateCurrencyRatesController extends AbstractConsoleController implements
    LoggerAwareInterface,
    TranslatorAwareInterface
{
    use AbstractControllerTrait;

    public function handleAction(CurrencyRepository $currencyRepository)
    {
        $console = $this->getConsole();
        try {
            $rates = $currencyRepository->performGroupUpdateRates();
            $console->writeLine(
                "Currency rates updated successfully:\n",
                Color::CYAN
            );
            foreach ($rates as $currencyCode => $rate) {
                $console->writeLine(
                    sprintf("%s: %s", $currencyCode, $rate),
                    Color::GREEN
                );
            }
        } catch (\Throwable $e) {
            $this->getLogger()->crit($e);
            $console->writeLine(
                sprintf("Error during import: %s", $e->getMessage()),
                Color::WHITE,
                Color::RED
            );
        }
    }
}
