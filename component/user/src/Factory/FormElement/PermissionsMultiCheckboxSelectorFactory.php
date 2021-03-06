<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\User\Factory\FormElement;

use Interop\Container\ContainerInterface;

class PermissionsMultiCheckboxSelectorFactory
{

    public function __invoke(ContainerInterface $sm
    ) {
        $services = $sm->getServiceLocator();
        $permissions = $services->get(
            'WellCart\User\Spec\AclPermissionRepository'
        )
            ->toOptionsList();

        return new \WellCart\Form\Element\MultiCheckbox(
            null,
            ['value_options' => $permissions]
        );
    }
}
