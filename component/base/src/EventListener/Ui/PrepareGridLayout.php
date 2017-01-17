<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Base\EventListener\Ui;

use WellCart\Ui\Datagrid\PageViewInterface;
use WellCart\Utility\Arr;
use WellCart\Utility\Config;
use Zend\EventManager\EventInterface;

class PrepareGridLayout
{

    /**
     * @param EventInterface $event
     */
    public function __invoke(EventInterface $event)
    {
        $page = $event->getTarget();
        if (!$page instanceof PageViewInterface) {
            return;
        }
        $grid = $event->getParam('grid');
        $name = $page->getUiConfigKey();
        $config = Config::get('ui.component.grid.' . $name, []);
        if (empty($config)) {
            return;
        }
        if(!empty($config['options']))
        {
            $page->setOptions($config['options']);
            unset($config['options']);
        }
        if(!empty($config['attributes']))
        {
            $page->setAttributes($config['attributes']);
            unset($config['attributes']);
        }
        $this->composeGrid($page, $config);
    }

    /**
     * Compose form layout
     *
     * @param FieldsetInterface $fieldset
     * @param array             $config
     */
    public function composeGrid(
        FieldsetInterface $fieldset,
        array $config
    ) {
        if ($fieldset instanceof Element\Collection) {
            $fieldset = $fieldset
                ->getTargetElement();
        }
        foreach ($fieldset as $element) {
            if ($element instanceof FieldsetInterface) {
                $this->composeGrid(
                    $element, Arr::get($config, $element->getName(), [])
                );
                continue;
            }

            $name = $element->getName();
            $elementConfig = Arr::get($config, $name, [], '>');
            if (!empty($elementConfig)) {
                $this->composeElement($element, $elementConfig);
            }
            unset($elementConfig);
        }
    }

    protected function composeElement(
        Element $element,
        array $config
    ) {
        $options = Arr::get($config, 'options', []);
        foreach ($options as $option => $value) {
            switch ($option) {
                case 'label_attributes':
                    $element->setLabelAttributes($value);
                    break;
                default:
                    $element->setOption($option, $value);
                    break;
            }
        }
        $attributes = Arr::get($config, 'attributes', []);
        foreach ($attributes as $attribute => $value) {
            $element->setAttribute($attribute, $value);

        }
        unset($options, $attributes);
    }
}
