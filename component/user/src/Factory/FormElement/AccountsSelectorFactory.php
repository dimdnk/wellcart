<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);
namespace WellCart\User\Factory\FormElement;

use Interop\Container\ContainerInterface;

class AccountsSelectorFactory
{
    public function __invoke(ContainerInterface $sm
    ) {
        $services = $sm->getServiceLocator();
        $users = $services->get(
            'WellCart\User\Spec\UserRepository'
        )
            ->toOptionsList();
        return new \WellCart\Form\Element\Select(
            null,
            ['value_options' => $users,
             'empty_option'  => __(
                 '- Select user account -'
             ),
            ]
        );
    }
}
