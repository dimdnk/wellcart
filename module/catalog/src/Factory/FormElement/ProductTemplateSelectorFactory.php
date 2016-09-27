<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Catalog\Factory\FormElement;

use Interop\Container\ContainerInterface;

class ProductTemplateSelectorFactory
{
    public function __invoke(ContainerInterface $sm) {
        $services = $sm->getServiceLocator();
        $groups = $services->get(
            'WellCart\Catalog\Spec\ProductTemplateRepository'
        )
            ->toOptionsList();
        return new \WellCart\Form\Element\Select(
            null,
            ['value_options' => $groups]
        );
    }
}
