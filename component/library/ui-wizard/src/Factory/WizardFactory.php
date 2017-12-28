<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use WellCart\Ui\Wizard\Wizard;
use WellCart\Ui\Wizard\WizardInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WellCart\Ui\Wizard\Form\FormFactory;

class WizardFactory implements FactoryInterface
{
  /**
   * @inheritDoc
   */
  public function __invoke(ContainerInterface $container, $requestedName,
    array $options = null
  ) {
    /* @var $wizard WizardInterface */
    $wizard = new \WellCart\Ui\Wizard\Wizard();

    $formFactory = new FormFactory($container->get('FormElementManager'));
    $wizard->setFormFactory($formFactory);

    $wizardProcessor = $container->get('WellCart\Ui\Wizard\WizardProcessor');
    $wizard->setWizardProcessor($wizardProcessor);

    $identifierAccessor = $container->get('WellCart\Ui\Wizard\Wizard\IdentifierAccessor');
    $wizard->setIdentifierAccessor($identifierAccessor);

    $wizardListener = $container->get('WellCart\Ui\Wizard\Listener\WizardListener');
    $wizard->getEventManager()->attachAggregate($wizardListener);

    $stepCollection = $wizard->getSteps();

    $stepCollectionListener = $container->get('WellCart\Ui\Wizard\Listener\StepCollectionListener');
    $stepCollection->getEventManager()->attachAggregate($stepCollectionListener);

    return $wizard;
  }
}
