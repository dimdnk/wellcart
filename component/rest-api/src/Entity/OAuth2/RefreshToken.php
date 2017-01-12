<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\RestApi\Entity\OAuth2;

use Doctrine\Common\Collections\ArrayCollection;
use WellCart\ORM\AbstractEntity;
use WellCart\ORM\Entity;
use WellCart\ORM\EntityTrait;
use ZF\OAuth2\Doctrine\Entity\UserInterface;

class RefreshToken extends AbstractEntity implements Entity
{

    use EntityTrait;

    /**
     * @var string
     */
    protected $refreshToken;

    /**
     * @var \DateTime
     */
    protected $expires;

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $scope;

    /**
     * UserInterface
     *
     * @var object
     */
    protected $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->scope = new ArrayCollection();
    }

    public function exchangeArray(array $array)
    {
        foreach ($array as $key => $value) {
            switch ($key) {
                case 'refreshToken':
                    $this->setRefreshToken($value);
                    break;
                case 'expires':
                    $this->setExpires($value);
                    break;
                case 'client':
                    $this->setClient($value);
                    break;
                case 'scope':
                    // Clear old collection
                    foreach ($value as $remove) {
                        $this->removeScope($remove);
                        $remove->removeRefreshToken($this);
                    }

                    // Add new collection
                    foreach ($value as $scope) {
                        $this->addScope($scope);
                        $scope->removeRefreshToken($this);
                    }
                    break;
                case 'user':
                    $this->setUser($value);
                    break;
                default:
                    // @codeCoverageIgnoreStart
                    break;
            }
            // @codeCoverageIgnoreEnd
        }

        return $this;
    }

    /**
     * Remove scope
     *
     * @param Scope $scope
     */
    public function removeScope(Scope $scope)
    {
        $this->scope->removeElement($scope);
    }

    /**
     * Add scope
     *
     * @param Scope $scope
     *
     * @return RefreshToken
     */
    public function addScope(Scope $scope)
    {
        $this->scope[] = $scope;

        return $this;
    }

    public function getArrayCopy()
    {
        return [
            'id'           => $this->getId(),
            'refreshToken' => $this->getRefreshToken(),
            'expires'      => $this->getExpires(),
            'client'       => $this->getClient(),
            'scope'        => $this->getScope(),
            'user'         => $this->getUser(),
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
     * Get refreshToken
     *
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * Set refreshToken
     *
     * @param string $refreshToken
     *
     * @return RefreshToken
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    /**
     * Get expires
     *
     * @return \DateTime
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * Set expires
     *
     * @param \DateTime $expires
     *
     * @return RefreshToken
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;

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
     * @return RefreshToken
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get scope
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Get user
     *
     * @return user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param $user
     *
     * @return AuthorizationCode
     */
    public function setUser(UserInterface $user = null)
    {
        $this->user = $user;

        return $this;
    }
}
