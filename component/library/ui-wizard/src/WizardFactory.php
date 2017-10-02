<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Ui\Wizard;

use Symfony\Component\OptionsResolver\OptionsResolver;
use WellCart\Ui\Wizard\Step\StepFactory;
use WellCart\Ui\Wizard\WizardInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;

class WizardFactory implements ServiceManagerAwareInterface
{
    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * @var StepFactory
     */
    protected $stepFactory;

    /**
     * @var array
     */
    protected $config = [];

    /**
     * @var array
     */
    protected $instances = [];

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = (array) $config;
    }

    /**
     * @param ServiceManager $serviceManager
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    /**
     * @param StepFactory $factory
     */
    public function setStepFactory(StepFactory $factory)
    {
        $this->stepFactory = $factory;
    }

    /**
     * @param  string $name
     * @return array
     * @throws Exception\RuntimeException
     */
    protected function getWizardOptions($name)
    {
        if (!isset($this->config['wizards'][$name])) {
            throw new Exception\RuntimeException(sprintf(
                'The wizard "%s" does not exists.',
                $name
            ));
        }

        return $this->prepareWizardOptions($this->config['wizards'][$name]);
    }

    /**
     * @param  array $options
     * @return array
     */
    protected function prepareWizardOptions(array $options)
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setDefined([
                'class', 'route', 'title', 'redirect_url',
                'cancel_url', 'steps', 'listeners',
            ])
            ->setAllowedTypes('steps', 'array')
            ->setAllowedTypes('listeners', 'array')
            ->setDefault('layout_template', $this->config['default_layout_template'])
            ->setDefault('listeners', []);

        return $resolver->resolve($options);
    }

    /**
     * @param  string $name
     * @return WizardInterface
     */
    public function create($name)
    {
        if (array_key_exists($name, $this->instances)) {
            return $this->instances[$name];
        }

        $options = $this->getWizardOptions($name);

        /* @var $wizard WizardInterface */
        $wizard = $this->serviceManager->get('WellCart\Ui\Wizard\Wizard');

        $wizard->getOptions()->setFromArray($options);

        if (!empty($options['steps'])) {
            $this->addSteps($options['steps'], $wizard);
        }

        foreach ($options['listeners'] as $listener) {
            $instance = $this->serviceManager->get($listener);
            $wizard->getEventManager()->attach($instance);
        }

        $wizard->getViewModel()->setTemplate($options['layout_template']);

        $wizard->init();

        $this->instances[$name] = $wizard;

        return $wizard;
    }

    /**
     * @param array $steps
     * @param Wizard $wizard
     */
    protected function addSteps(array $steps, Wizard $wizard)
    {
        foreach ($steps as $key => $values) {
            $step = $this->stepFactory->create($key, $values);
            if (!$step) {
                continue;
            }

            $step
                ->setWizard($wizard)
                ->init();

            $wizard->getSteps()->add($step);
        }
    }
}
