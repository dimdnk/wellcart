<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Controller\Console;

use WellCart\Base\Service\Route\Listing;
use WellCart\Mvc\Controller\AbstractControllerTrait;
use Zend\Console\ColorInterface as Color;
use Zend\I18n\Translator\TranslatorAwareInterface;
use Zend\Log\LoggerAwareInterface;
use Zend\Mvc\Controller\AbstractConsoleController;

class RouteController extends AbstractConsoleController implements
    LoggerAwareInterface,
    TranslatorAwareInterface
{
    use AbstractControllerTrait;

    /**
     * @param Listing $listing
     */
    public function listAction(Listing $listing)
    {
        $console = $this->getConsole();
        try {
           $console->writeLine($listing->asTable()->__toString());
        } catch (\Throwable $e) {
            error_log($e->__toString());
            $console->writeLine(
                sprintf(
                    "Error during generating routes: %s",
                    $e->getMessage()
                ),
                Color::WHITE,
                Color::RED
            );
        }
    }
}
