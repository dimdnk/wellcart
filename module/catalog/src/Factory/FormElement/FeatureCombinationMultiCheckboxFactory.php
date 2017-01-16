<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Catalog\Factory\FormElement;

use Interop\Container\ContainerInterface;
use WellCart\Catalog\Form\Element\FeatureCombinationMultiCheckbox;
use WellCart\Catalog\Spec\FeatureRepository;

class FeatureCombinationMultiCheckboxFactory
{

    public function __invoke(ContainerInterface $sm): FeatureCombinationMultiCheckbox
    {
        $services = $sm->getServiceLocator();
        $options = $services->get(
            FeatureRepository::class
        )
            ->toGroupedOptionsList();

        return new FeatureCombinationMultiCheckbox(
            null,
            [
                'value_options'             => $options,
                'disable_inarray_validator' => true,
            ]
        );
    }
}
