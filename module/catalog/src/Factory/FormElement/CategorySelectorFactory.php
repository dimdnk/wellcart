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
use WellCart\Catalog\Spec\CategoryRepository;
use WellCart\Form\Element\Select;

class CategorySelectorFactory
{

    public function __invoke(ContainerInterface $sm
    ) {
        $services = $sm->getServiceLocator();
        $categories = $services->get(
            CategoryRepository::class
        )
            ->toOptionsList();

        return new Select(
            null,
            [
                'value_options'             => $categories,
                'disable_inarray_validator' => true,
            ]
        );
    }
}
