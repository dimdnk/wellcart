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
use WellCart\Catalog\Spec\BrandRepository;

class BrandSelectorFactory
{

    public function __invoke(ContainerInterface $sm)
    {
        $services = $sm->getServiceLocator();
        $brands = $services->get(
            BrandRepository::class
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
