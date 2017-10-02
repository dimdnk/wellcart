<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard\Step;

use WellCart\Ui\Wizard\Step\StepPluginManager;
use Zend\Form\FormElementManager;

class StepFactory
{
    /**
     * @var StepPluginManager
     */
    protected $stepPluginManager;

    /**
     * @var FormElementManager
     */
    protected $formPluginManager;

    /**
     * @param StepPluginManager $stepPluginManager
     * @param FormElementManager $formPluginManager
     */
    public function __construct(
        StepPluginManager $stepPluginManager,
        FormElementManager $formPluginManager
    ) {
        $this->stepPluginManager = $stepPluginManager;
        $this->formPluginManager = $formPluginManager;
    }

    /**
     * @param  string $name
     * @param  array $options
     * @return \Wizard\Step\StepInterface
     */
    public function create($name, array $options = [])
    {
        $step = $this->stepPluginManager->get($name);

        if (isset($options['form'])) {
            $form = $this->formPluginManager->get($options['form']);
            $step->setForm($form);
            unset($options['form']);
        }

        $step->setName($name);
        $step->getOptions()->setFromArray($options);

        return $step;
    }
}
