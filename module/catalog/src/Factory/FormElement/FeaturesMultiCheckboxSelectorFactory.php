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
use WellCart\Catalog\Spec\FeatureRepository;
use \WellCart\Form\Element\MultiCheckbox;

class FeaturesMultiCheckboxSelectorFactory
{

    public function __invoke(ContainerInterface $sm): MultiCheckbox
    {
        $services = $sm->getServiceLocator();
        $values = $services->get(
            FeatureRepository::class
        )
            ->toOptionsList();

        return new MultiCheckbox(
            null,
            ['value_options' => $values]
        );
    }
}
