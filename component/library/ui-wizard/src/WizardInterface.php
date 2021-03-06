<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard;

use WellCart\Ui\Wizard\Form\FormFactory;
use WellCart\Ui\Wizard\Step\StepInterface;
use WellCart\Ui\Wizard\Step\StepCollection;
use WellCart\Ui\Wizard\Wizard\IdentifierAccessor;
use Zend\View\Model\ViewModel;

interface WizardInterface
{
    /**
     * @param  FormFactory $factory
     * @return self
     */
    public function setFormFactory(FormFactory $factory);

    /**
     * @param  WizardProcessor $processor
     * @return self
     */
    public function setWizardProcessor(WizardProcessor $processor);

    /**
     * @param  IdentifierAccessor $accessor
     * @return self
     */
    public function setIdentifierAccessor(IdentifierAccessor $accessor);

    /**
     * @return \Zend\EventManager\EventManager
     */
    public function getEventManager();

    /**
     * @return \Zend\Session\Container
     */
    public function getSessionContainer();

    /**
     * @param  array|Traversable|WizardOptionsInterface $options
     * @return self
     */
    public function setOptions($options);

    /**
     * @return WizardOptionsInterface
     */
    public function getOptions();

    public function previousStep();

    public function nextStep();

    /**
     * @param  string|StepInterface $step
     * @return self
     */
    public function setCurrentStep($step);

    /**
     * @return StepInterface|null
     */
    public function getCurrentStep();

    /**
     * @return int
     */
    public function getCurrentStepNumber();

    /**
     * @return \Zend\Form\Form|null
     */
    public function getForm();

    /**
     * @param  StepCollection $steps
     * @return self
     */
    public function setSteps(StepCollection $steps);

    /**
     * @return StepCollection
     */
    public function getSteps();

    /**
     * @return int
     */
    public function getTotalStepCount();

    /**
     * @return int
     */
    public function getPercentProgress();

    /**
     * @return \Zend\Http\Response
     */
    public function process();

    /**
     * @param ViewModel $model
     */
    public function setViewModel(ViewModel $model);

    /**
     * @return ViewModel
     */
    public function getViewModel();
}
