<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\RestApi\Factory\FormElement;

use Interop\Container\ContainerInterface;

class ApiClientSelectorFactory
{
    /**
     * @param ContainerInterface $sm
     *
     * @return \WellCart\Form\Element\Select
     */
    public function __invoke(ContainerInterface $sm
    ): \WellCart\Form\Element\Select {
        $services = $sm->getServiceLocator();
        $clients = $services->get(
            Repository\OAuth2\Clients'
        )
            ->toOptionsList();
        return new \WellCart\Form\Element\Select(
            null,
            ['value_options' => $clients,
             'empty_option'  => __(
                 ' - Select client - '
             ),
            ]
        );
    }
}
