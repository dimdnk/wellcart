<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Catalog\Factory\FormElement;

use Interop\Container\ContainerInterface;

class BrandSelectorFactory
{
    public function __invoke(ContainerInterface $sm,
        $requestedName,
        array $options = null
    ) {
        $services = $sm->getServiceLocator();
        $brands = $services->get(
            'WellCart\Catalog\Spec\BrandRepository'
        )
            ->toOptionsList();
        return new \WellCart\Form\Element\Select(
            null,
            [
                'empty_option'              => '',
                'value_options'             => $brands,
                'disable_inarray_validator' => true,
            ]
        );
    }
}
