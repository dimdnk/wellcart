<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Catalog\Factory\FormElement;

use Interop\Container\ContainerInterface;
use WellCart\Catalog\Form\Element\CategoryMultiCheckbox;
use WellCart\Catalog\Spec\CategoryRepository;

class CategoryMultiCheckboxFactory
{
    public function __invoke(ContainerInterface $sm
    ) {
        $services = $sm->getServiceLocator();
        $categories = $services->get(
            CategoryRepository::class
        )
            ->toOptionsList();
        return new CategoryMultiCheckbox(
            null,
            [
                'value_options'             => $categories,
                'disable_inarray_validator' => true,
            ]
        );
    }
}
