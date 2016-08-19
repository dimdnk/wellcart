<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\Service;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use DoctrineModule\Persistence\ProvidesObjectManager;
use WellCart\Base\Exception;
use WellCart\Base\Spec\ConfigurationRepository;
use WellCart\Form\Form;
use WellCart\Utility\Arr;
use Zend\Stdlib\PriorityList;
use ZfcBase\EventManager\EventProvider;

class ConfigurationEditor extends EventProvider
    implements ObjectManagerAwareInterface
{

    use ProvidesObjectManager;

    /**
     * Configuration
     *
     * @var array
     */
    protected $config = [];

    /**
     * @var Form
     */
    protected $form;

    /**
     * Constructor
     *
     * @param array $config
     * @param Form  $form
     */
    public function __construct(array $config, Form $form)
    {
        $this->config = $config;
        $form->setName('configuration_editor');
        $this->form = $form;
    }

    /**
     * Save config value
     *
     * @param string $key
     * @param string $value
     */
    public function saveConfig($key, $value)
    {
        $manager = $this->getObjectManager();

        /**
         * @var $repository ConfigurationRepository
         */
        $repository = $manager->getRepository(
            'WellCart\Base\Spec\ConfigurationEntity'
        );
        $configItem = $repository->findOneBy(['configKey' => $key]);
        if ($configItem == null) {
            $configItem = $repository->createEntity();
        }
        $configItem->setConfigKey($key)
            ->setConfigValue($value);
        $this->getEventManager()
            ->trigger(
                __FUNCTION__ . '.pre',
                $this,
                [
                    'configItem' => $configItem,
                    'repository' => $repository,
                ]
            );

        $manager->persist($configItem);
        $manager->flush();

        $this->getEventManager()
            ->trigger(
                __FUNCTION__ . '.post',
                $this,
                [
                    'configItem' => $configItem,
                    'repository' => $repository,
                ]
            );
    }

    /**
     * Save config set
     *
     * @param array $values
     */
    public function saveConfigSet(array $values)
    {
        if (!count($values)) {
            return;
        }

        $manager = $this->getObjectManager();
        /**
         * @var $repository ConfigurationRepository
         */
        $repository = $manager->getRepository(
            'WellCart\Base\Spec\ConfigurationEntity'
        );

        $this->getEventManager()
            ->trigger(
                __FUNCTION__ . '.pre',
                $this,
                [
                    'values'     => &$values,
                    'repository' => $repository,
                ]
            );

        foreach ($values as $key => $value) {
            $configItem = $repository->findOneBy(['configKey' => $key]);
            if ($configItem == null) {
                $configItem = $repository->createEntity();
            }
            $configItem->setConfigKey($key)
                ->setConfigValue($value);

            $manager->persist($configItem);
        }

        $manager->flush();
        $this->getEventManager()
            ->trigger(
                __FUNCTION__ . '.post',
                $this,
                [
                    'repository' => $repository,
                ]
            );
    }

    /**
     * Retrieve fieldsets (config groups) for selected tab
     *
     * @param string $tabId
     * @param string $default
     *
     * @throws \InvalidArgumentException
     *
     * @return PriorityList
     */
    public function getFieldSetsSpecification($tabId, $default = 'general')
    {
        $list = new PriorityList();
        $tab = $this->tabInfo($tabId, $default);

        $tabFieldsets = Arr::get($tab, 'fieldset', []);
        foreach ($tabFieldsets as $fieldsetId => $fieldset) {
            if (!Arr::get($fieldset, 'priority')) {
                throw new Exception\InvalidArgumentException(
                    'Config fieldset must contain priority value.'
                );
            }
            if (!Arr::get($fieldset, 'label')) {
                throw new Exception\InvalidArgumentException(
                    'Config fieldset must have label.'
                );
            }

            if (isset($fieldset['element'])) {
                unset($fieldset['element']);
            }
            $list->insert($fieldsetId, $fieldset, (int)$fieldset['priority']);
        }
        return $list;
    }

    /**
     * Retrieve tab info
     *
     * @param string $tabId
     * @param string $default
     *
     * @return array
     */
    protected function tabInfo($tabId, $default = 'general')
    {
        $path = 'system_config_editor.tab.';
        $tab = Arr::get($this->config, $path . $tabId, []);
        if (empty($tab)) {
            $tab = Arr::get($this->config, $path . $default, []);
        }
        return $tab;
    }

    /**
     * Retrieve Form object with fields specified for selected tab
     *
     * @param string $tabId
     * @param string $default
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    public function composeForm($tabId, $default = 'general')
    {
        $this->form->removeAll();
        $this->form->setWrapElements(true);
        $prototype = clone $this->form;
        $tab = $this->tabInfo($tabId, $default);
        $tabFieldsets = Arr::get($tab, 'fieldset', []);

        foreach ($tabFieldsets as $fieldsetId => $fieldsetSpec) {
            $fieldset = clone $prototype;
            $fieldset->setAttribute('name', $fieldsetId);
            $elements = Arr::get($fieldsetSpec, 'element', []);
            $fieldsetPriority = Arr::get($fieldsetSpec, 'priority', 0);
            foreach ($elements as $element) {
                $elementName = Arr::get($element, 'name');
                $priority = Arr::get($element, 'priority', 0);
                $element['attributes']['value'] = Arr::get(
                    $this->config,
                    $elementName
                );
                $fieldset->add($element, ['priority' => $priority]);
            }
            $fieldset->setUseAsBaseFieldset(true);
            $this->form->add($fieldset, ['priority' => $fieldsetPriority]);
        }

        $inputFilter = $this->form->getInputFilter();
        $filterFactory = $inputFilter->getFactory();
        foreach ($tabFieldsets as $fieldsetId => $fieldsetSpec) {
            $elements = Arr::get($fieldsetSpec, 'element', []);
            foreach ($elements as $element) {
                if (!empty($element['input_filter_specification'])) {
                    $elementName = Arr::get($element, 'name');
                    $filter = $inputFilter->get($fieldsetId)
                        ->get($elementName);
                    $input = $filterFactory->createInput(
                        $element['input_filter_specification']
                    );
                    $filter->merge($input);
                }
            }
        }


        $this->form->add(
            [
                'type' => 'Csrf',
                'name' => 'csrf'
            ],
            ['priority' => 100000]
        );

        $this->form->add(
            [
                'name'       => 'save',
                'type'       => 'Submit',
                'options'    => [
                    'label'       => __('Save'),
                    'fontAwesome' => [
                        'icon' => 'check'
                    ],
                ],
                'attributes' => [
                    'class'             => 'btn btn-toolbar-action btn-circle btn-success pull-right',
                    'role'              => 'button',
                    'value'             => __('Save'),
                    'id'                => 'submit_form',
                    'data-disable-with' => sprintf(
                        '<span class="fa fa-%s"></span> %s',
                        'check',
                        __('Save')
                    )
                ],
            ],
            ['priority' => 1000000]
        );

        $this->form->getEventManager()->trigger('init', $this);
        return $this->form;
    }
}
