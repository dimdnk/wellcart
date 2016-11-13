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

class FeaturesMultiCheckboxSelectorFactory
{
    public function __invoke(ContainerInterface $sm)
    {
        $services = $sm->getServiceLocator();
        $values = $services->get(
            FeatureRepository::class
        )
            ->toOptionsList();
        return new \WellCart\Form\Element\MultiCheckbox(
            null,
            ['value_options' => $values]
        );
    }
}
