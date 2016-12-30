<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\Directory\Factory\FormElement;

use Interop\Container\ContainerInterface;
use WellCart\Directory\Form\Element\CountrySelector;

class CountrySelectorFactory
{
    public function __invoke(ContainerInterface $sm)
    {
        $countries = $sm->getServiceLocator()->get(
            'WellCart\Directory\Spec\CountryRepository'
        );

        $options = $countries->toOptionsList();
        $countrySelector = new CountrySelector(
            null,
            [],
            $options
        );

        $value = current(array_keys($options));
        $countrySelector->setValue($value);
        return $countrySelector;
    }
}
