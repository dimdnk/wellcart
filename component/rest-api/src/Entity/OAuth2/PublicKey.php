<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\RestApi\Entity\OAuth2;

use WellCart\ORM\AbstractEntity;
use WellCart\ORM\Entity;
use WellCart\ORM\EntityTrait;

class PublicKey extends AbstractEntity implements Entity
{

    use EntityTrait;

    /**
     * @var string
     */
    protected $publicKey;

    /**
     * @var string
     */
    protected $privateKey;

    /**
     * @var string
     */
    protected $encryptionAlgorithm;

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Client
     */
    protected $client;

    public function getArrayCopy()
    {
        return [
            'id'                  => $this->getId(),
            'publicKey'           => $this->getPublicKey(),
            'privateKey'          => $this->getPrivateKey(),
            'encryptionAlgorithm' => $this->getEncryptionAlgorithm(),
            'client'              => $this->getClient(),
        ];
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get publicKey
     *
     * @return string
     */
    public function getPublicKey()
    {
        return $this->publicKey;
    }

    /**
     * Set publicKey
     *
     * @param string $publicKey
     *
     * @return PublicKey
     */
    public function setPublicKey($publicKey)
    {
        $this->publicKey = $publicKey;

        return $this;
    }

    /**
     * Get privateKey
     *
     * @return string
     */
    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    /**
     * Set privateKey
     *
     * @param string $privateKey
     *
     * @return PublicKey
     */
    public function setPrivateKey($privateKey)
    {
        $this->privateKey = $privateKey;

        return $this;
    }

    /**
     * Get encryptionAlgorithm
     *
     * @return string
     */
    public function getEncryptionAlgorithm()
    {
        return $this->encryptionAlgorithm;
    }

    /**
     * Set encryptionAlgorithm
     *
     * @param string $encryptionAlgorithm
     *
     * @return PublicKey
     */
    public function setEncryptionAlgorithm($encryptionAlgorithm)
    {
        $this->encryptionAlgorithm = $encryptionAlgorithm;

        return $this;
    }

    /**
     * Get client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set client
     *
     * @param Client $client
     *
     * @return PublicKey
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }
}
