<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\RestApi;

use Interop\Container\ContainerInterface;
use Zend\Form\Factory as FormFactory;

return [
    'factories' => [
        PageView\Backend\OAuth2\PublicKeysGrid::class =>
            function (ContainerInterface $services) {
                return new PageView\Backend\OAuth2\PublicKeysGrid(
                    $services->get(
                        Repository\OAuth2\PublicKeys::class
                    )
                );
            },
        PageView\Backend\OAuth2\PublicKeyForm::class  =>
            function (ContainerInterface $services) {
                return new PageView\Backend\OAuth2\PublicKeyForm(
                    $services->get(
                        Repository\OAuth2\PublicKeys::class
                    )
                );
            },
        PageView\Backend\OAuth2\ClientForm::class     =>
            function (ContainerInterface $services) {
                return new PageView\Backend\OAuth2\ClientForm(
                    $services->get(
                        Repository\OAuth2\Clients::class
                    )
                );
            },
        PageView\Backend\OAuth2\ScopeForm::class      =>
            function (ContainerInterface $services) {
                return new PageView\Backend\OAuth2\ScopeForm(
                    $services->get(
                        Repository\OAuth2\Scopes::class
                    )
                );
            },
        PageView\Backend\OAuth2\ClientsGrid::class    =>
            function (ContainerInterface $services) {
                return new PageView\Backend\OAuth2\ClientsGrid(
                    $services->get(
                        Repository\OAuth2\Clients::class
                    )
                );
            },
        PageView\Backend\OAuth2\ScopesGrid::class     =>
            function (ContainerInterface $services) {
                return new PageView\Backend\OAuth2\ScopesGrid(
                    $services->get(
                        Repository\OAuth2\Scopes::class
                    )
                );
            },


        Repository\OAuth2\AccessTokens::class =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_api_object_manager')
                    ->getRepository(
                        Entity\OAuth2\AccessToken::class
                    );
            },

        Repository\OAuth2\PublicKeys::class =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_api_object_manager')
                    ->getRepository(
                        Entity\OAuth2\PublicKey::class
                    );
            },
        Form\OAuth2\PublicKey::class        =>
            function (ContainerInterface $services) {
                $form = new Form\OAuth2\PublicKey(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_api_doctrine_hydrator')
                );
                return $form;
            },

        Repository\OAuth2\Clients::class =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_api_object_manager')
                    ->getRepository(
                        Entity\OAuth2\Client::class
                    );
            },
        Form\OAuth2\Client::class        =>
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

        Repository\OAuth2\Scopes::class =>
            function (ContainerInterface $services) {
                return $services->get('wellcart_api_object_manager')
                    ->getRepository(
                        Entity\OAuth2\Scope::class
                    );
            },
        Form\OAuth2\Scope::class        =>
            function (ContainerInterface $services) {
                $form = new Form\OAuth2\Scope(
                    new FormFactory($services->get('FormElementManager')),
                    $services->get('wellcart_api_doctrine_hydrator')
                );
                return $form;
            },
    ],
];
