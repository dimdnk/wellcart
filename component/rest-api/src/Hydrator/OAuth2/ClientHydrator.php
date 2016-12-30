<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\RestApi\Hydrator\OAuth2;

use WellCart\Hydrator\DoctrineObject as ObjectHydrator;
use WellCart\Utility\Arr;
use Zend\Crypt\Password\Bcrypt;

class ClientHydrator extends ObjectHydrator
{
    /**
     * @inheritdoc
     */
    public function hydrate(array $data, $object)
    {
        $secret = Arr::get($data, 'new_secret');
        $secretVerify = Arr::get($data, 'new_secret_verify');
        if (($secret && $secretVerify) && ($secret === $secretVerify)) {
            $bcrypt = new Bcrypt();
            $bcrypt->setCost(14);
            $data['secret'] = $bcrypt->create($secret);
        }
        return parent::hydrate($data, $object);
    }
}
