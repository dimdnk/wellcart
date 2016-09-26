<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\User\Factory\FormElement;

use Interop\Container\ContainerInterface;

class RolesMultiCheckboxSelectorFactory
{
    public function __invoke(ContainerInterface $sm
    ) {
        $services = $sm->getServiceLocator();
        $roles = $services->get(
            'WellCart\User\Spec\AclRoleRepository'
        )
            ->toOptionsList();
        return new \WellCart\Form\Element\MultiCheckbox(
            null,
            ['value_options' => $roles]
        );
    }
}
