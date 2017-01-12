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
use WellCart\Catalog\Spec\ProductTemplateRepository;

class ProductTemplateSelectorFactory
{

    public function __invoke(ContainerInterface $sm)
    {
        $services = $sm->getServiceLocator();
        $groups = $services->get(
            ProductTemplateRepository::class
        )
            ->toOptionsList();

        return new \WellCart\Form\Element\Select(
            null,
            ['value_options' => $groups]
        );
    }
}
