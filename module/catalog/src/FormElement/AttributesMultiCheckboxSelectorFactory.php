<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Catalog\Factory\FormElement;

use Interop\Container\ContainerInterface;

class AttributesMultiCheckboxSelectorFactory
{
    public function __invoke(ContainerInterface $sm,
        $requestedName,
        array $options = null
    ) {
        $services = $sm->getServiceLocator();
        $values = $services->get(
            'WellCart\Catalog\Spec\AttributeRepository'
        )
            ->toOptionsList();
        return new \WellCart\Form\Element\MultiCheckbox(
            null,
            ['value_options' => $values]
        );
    }
}
