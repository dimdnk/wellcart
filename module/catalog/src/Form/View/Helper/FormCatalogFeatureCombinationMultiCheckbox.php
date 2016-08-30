<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Catalog\Form\View\Helper;

use WellCart\Form\View\Helper\FormMultiCheckbox;
use WellCart\Utility\Arr;
use Zend\Form\Element\MultiCheckbox as MultiCheckboxElement;

class FormCatalogFeatureCombinationMultiCheckbox extends FormMultiCheckbox
{
    /**
     * @inheritDoc
     */
    protected function renderOptions(MultiCheckboxElement $element,
        array $options, array $selectedOptions, array $attributes
    ) {
        $isMulti = (bool)Arr::get(current($options), 'label');
        if (!$isMulti) {
            return parent::renderOptions(
                $element, $options, $selectedOptions, $attributes
            );
        }

        $html = '';
        foreach ($options as $group) {
            $label = Arr::get($group, 'label');
            if (!empty($label)) {
                $html .= sprintf('<h4>%s</h4>', $label);
            }
            $html .= parent::renderOptions(
                $element, Arr::get($group, 'options', []), $selectedOptions,
                $attributes
            );
        }
        return $html;
    }

}
