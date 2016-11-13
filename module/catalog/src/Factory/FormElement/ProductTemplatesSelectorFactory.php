<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Catalog\Factory\FormElement;

use Interop\Container\ContainerInterface;
use WellCart\Catalog\Spec\ProductTemplateRepository;

class ProductTemplatesSelectorFactory
{
    public function __invoke(ContainerInterface $sm)
    {
        $services = $sm->getServiceLocator();
        $values = $services->get(
            ProductTemplateRepository::class
        )
            ->toOptionsList();
        return new \WellCart\Form\Element\Select(
            null,
            ['value_options' => $values]
        );
    }
}
