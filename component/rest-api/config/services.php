<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\RestApi;

use Interop\Container\ContainerInterface;
use Zend\Form\Factory as FormFactory;

return [
    'factories' => [
        PageView\Backend\OAuth2\PublicKeysGrid' =>
            function (ContainerInterface $services) {
                return new PageView\Backend\OAuth2\PublicKeysGrid(
                    $services->get(
                        Repository\OAuth2\PublicKeys'
                    )
                );
            },
        PageView\Backend\OAuth2\PublicKeyForm'  =>
            function (ContainerInterface $services) {
                return new PageView\Backend\OAuth2\PublicKeyForm(
                    $services->get(
                        Repository\OAuth2\PublicKeys'
                    )
                );
            },
        PageView\Backend\OAuth2\ClientForm'     =>
            function (ContainerInterface $services) {
                return new PageView\Backend\OAuth2\ClientForm(
                    $services->get(
                        Repository\OAuth2\Clients'
                    )
                );
            },
        PageView\Backend\OAuth2\ScopeForm'      =>
            function (ContainerInterface $services) {
                return new PageView\Backend\OAuth2\ScopeForm(
                    $services->get(
                        Repository\OAuth2\Scopes'
                    )
                );
            },
        PageView\Backend\OAuth2\ClientsGrid'    =>
            function (ContainerInterface $services) {
                return new PageView\Backend\OAuth2\ClientsGrid(
                    $services->get(
                        Repository\OAuth2\Clients'
                    )
                );
            },
        PageView\Backend\OAuth2\ScopesGrid'     =>
            function (ContainerInterface $services) {
                return new PageView\Backend\OAuth2\ScopesGrid(
                    $services->get(
                        Repository\OAuth2\Scopes'
                    )
                );
            },


        Repository\OAuth2\AccessTokens' =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_api_object_manager')
                    ->getRepository(
                        Entity\OAuth2\AccessToken'
                    );
            },

        Repository\OAuth2\PublicKeys' =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_api_object_manager')
                    ->getRepository(
                        Entity\OAuth2\PublicKey'
                    );
            },
        Form\OAuth2\PublicKey'        =>
            function (ContainerInterface $services) {
                $form = new Form\OAuth2\PublicKey(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_api_doctrine_hydrator')
                );
                return $form;
            },

        Repository\OAuth2\Clients' =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_api_object_manager')
                    ->getRepository(
                        Entity\OAuth2\Client'
                    );
            },
        Form\OAuth2\Client'        =>
            function (ContainerInterface $services) {

                $hydrator = new Hydrator\OAuth2\ClientHydrator(
                    $services->get('wellcart_api_object_manager')
                );
                $form = new Form\OAuth2\Client(
                    new FormFactory($services->get('FormElementManager')),
                    $hydrator
                );
                return $form;
            },

        Repository\OAuth2\Scopes' =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_api_object_manager')
                    ->getRepository(
                        Entity\OAuth2\Scope'
                    );
            },
        Form\OAuth2\Scope'        =>
            function (ContainerInterface $services) {
                $form = new Form\OAuth2\Scope(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_api_doctrine_hydrator')
                );
                return $form;
            },
    ],
];
