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

class AuthorizationCode extends AbstractEntity implements Entity
{

    use EntityTrait;

    /**
     * @var string
     */
    protected $authorizationCode;

    /**
     * @var string
     */
    protected $redirectUri;

    /**
     * @var \DateTime
     */
    protected $expires;

    /**
     * @var string
     */
    protected $idToken;

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

    public function getArrayCopy()
    {
        return [
            'id'                => $this->getId(),
            'authorizationCode' => $this->getAuthorizationCode(),
            'redirectUri'       => $this->getRedirectUri(),
            'expires'           => $this->getExpires(),
            'idToken'           => $this->getIdToken(),
            'scope'             => $this->getScope(),
            'client'            => $this->getClient(),
            'user'              => $this->getUser(),
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
     * Get authorizationCode
     *
     * @return string
     */
    public function getAuthorizationCode()
    {
        return $this->authorizationCode;
    }

    /**
     * Set authorizationCode
     *
     * @param string $authorizationCode
     *
     * @return AuthorizationCode
     */
    public function setAuthorizationCode($authorizationCode)
    {
        $this->authorizationCode = $authorizationCode;

        return $this;
    }

    /**
     * Get redirectUri
     *
     * @return string
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    /**
     * Set redirectUri
     *
     * @param string $redirectUri
     *
     * @return AuthorizationCode
     */
    public function setRedirectUri($redirectUri)
    {
        $this->redirectUri = $redirectUri;

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
     * @return AuthorizationCode
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * Get idToken
     *
     * @return string
     */
    public function getIdToken()
    {
        return $this->idToken;
    }

    /**
     * Set idToken
     *
     * @param string $idToken
     *
     * @return AuthorizationCode
     */
    public function setIdToken($idToken)
    {
        $this->idToken = $idToken;

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
     * @return AuthorizationCode
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
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

    public function exchangeArray(array $array)
    {
        foreach ($array as $key => $value) {
            switch ($key) {
                case 'authorizationCode':
                    $this->setAuthorizationCode($value);
                    break;
                case 'redirectUri':
                    $this->setRedirectUri($value);
                    break;
                case 'expires':
                    $this->setExpires($value);
                    break;
                case 'idToken':
                    $this->setIdToken($value);
                    break;
                case 'client':
                    $this->setClient($value);
                    break;
                case 'scope':
                    // Clear old collection
                    foreach ($value as $remove) {
                        $this->removeScope($remove);
                        $remove->removeAuthorizationCode($this);
                    }
                    // Add new collection
                    foreach ($value as $scope) {
                        $this->addScope($scope);
                        $scope->addAuthorizationCode($this);
                    }
                    break;
                case 'user':
                    $this->setUser($value);
                    break;
                default:
                    break;
            }
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
     * @return AuthorizationCode
     */
    public function addScope(Scope $scope)
    {
        $this->scope[] = $scope;

        return $this;
    }
}
