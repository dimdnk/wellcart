<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Directory\Factory\FormElement;

use Interop\Container\ContainerInterface;
use WellCart\Directory\Form\Element\ZoneSelector;

class ZoneSelectorFactory
{
    public function __invoke(ContainerInterface $sm) {
        $zones = $sm->getServiceLocator()->get(
            'WellCart\Directory\Spec\ZoneRepository'
        );
        return new ZoneSelector(
            null,
            [],
            $zones
        );
    }
}