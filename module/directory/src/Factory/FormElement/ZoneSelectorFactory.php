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
use WellCart\Directory\Form\Element\ZoneSelector;
use WellCart\Directory\Spec\ZoneRepository;

class ZoneSelectorFactory
{

    public function __invoke(ContainerInterface $sm): ZoneSelector
    {
        $zones = $sm->getServiceLocator()->get(
            ZoneRepository::class
        );

        return new ZoneSelector(
            null,
            [],
            $zones
        );
    }
}
