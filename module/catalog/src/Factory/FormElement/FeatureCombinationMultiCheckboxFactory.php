<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Catalog\Factory\FormElement;

use Interop\Container\ContainerInterface;
use WellCart\Catalog\Spec\FeatureRepository;

class FeatureCombinationMultiCheckboxFactory
{
    public function __invoke(ContainerInterface $sm)
    {
        $services = $sm->getServiceLocator();
        $options = $services->get(
            FeatureRepository::class
        )
            ->toGroupedOptionsList();
        return new \WellCart\Catalog\Form\Element\FeatureCombinationMultiCheckbox(
            null,
            [
                'value_options'             => $options,
                'disable_inarray_validator' => true,
            ]
        );
    }
}
