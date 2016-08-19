<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Controller\Console\Ember;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use WellCart\Mvc\Controller\AbstractControllerTrait;
use WellCart\ORM\Ember\Converter;
use WellCart\ORM\Ember\Generator;
use Zend\Console\ColorInterface as Color;
use Zend\I18n\Translator\TranslatorAwareInterface;
use Zend\Log\LoggerAwareInterface;
use Zend\Mvc\Controller\AbstractConsoleController;

class ModelGeneratorController extends AbstractConsoleController implements
    LoggerAwareInterface,
    TranslatorAwareInterface,
    ObjectManagerAwareInterface
{
    use AbstractControllerTrait;

    /**
     * @param Converter $converter
     * @param Generator $generator
     */
    public function generateAction(
        Converter $converter,
        Generator $generator
    ) {
        $console = $this->getConsole();
        try {
            $metadata = $this->getObjectManager()
                ->getMetadataFactory()
                ->getAllMetadata();
            $classes = $converter->processingMetadata($metadata);
            $generator->generate($classes);
            $console->writeLine(
                sprintf(
                    'Generated %d models in %s directory', count($classes),
                    $generator->getPath()
                ),
                Color::CYAN
            );
        } catch (\Throwable $e) {
            error_log($e->__toString());
            $console->writeLine(
                sprintf(
                    "Error during JavaScript code generation: %s",
                    $e->getMessage()
                ),
                Color::WHITE,
                Color::RED
            );
        }
    }
}
