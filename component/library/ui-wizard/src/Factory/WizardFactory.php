<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard\Factory;

use WellCart\Ui\Wizard\Wizard;
use WellCart\Ui\Wizard\WizardInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class WizardFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceLocator
     * @return Wizard
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /* @var $wizard WizardInterface */
        $wizard = new \WellCart\Ui\Wizard\Wizard();

        $formFactory = $serviceLocator->get('WellCart\Ui\Wizard\Form\FormFactory');
        $wizard->setFormFactory($formFactory);

        $wizardProcessor = $serviceLocator->get('WellCart\Ui\Wizard\WizardProcessor');
        $wizard->setWizardProcessor($wizardProcessor);

        $identifierAccessor = $serviceLocator->get('WellCart\Ui\Wizard\Wizard\IdentifierAccessor');
        $wizard->setIdentifierAccessor($identifierAccessor);

        $wizardListener = $serviceLocator->get('WellCart\Ui\Wizard\Listener\WizardListener');
        $wizard->getEventManager()->attachAggregate($wizardListener);

        $stepCollection = $wizard->getSteps();

        $stepCollectionListener = $serviceLocator->get('WellCart\Ui\Wizard\Listener\StepCollectionListener');
        $stepCollection->getEventManager()->attachAggregate($stepCollectionListener);

        return $wizard;
    }
}
