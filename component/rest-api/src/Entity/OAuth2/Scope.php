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

class Scope extends AbstractEntity implements Entity
{

    use EntityTrait;

    /**
     * @var string
     */
    protected $scope;

    /**
     * @var boolean
     */
    protected $isDefault = false;

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $client;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $authorizationCode;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $refreshToken;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $accessToken;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->client = new ArrayCollection();
        $this->authorizationCode = new ArrayCollection();
        $this->refreshToken = new ArrayCollection();
        $this->accessToken = new ArrayCollection();
    }

    public function getArrayCopy()
    {
        return [
            'id'        => $this->getId(),
            'scope'     => $this->getScope(),
            'isDefault' => $this->isDefault(),
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
     * Get scope
     *
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Set scope
     *
     * @param string $scope
     *
     * @return Scope
     */
    public function setScope($scope)
    {
        $this->scope = $scope;

        return $this;
    }

    /**
     * Get isDefault
     *
     * @return boolean
     */
    public function isDefault()
    {
        return boolval($this->isDefault);
    }

    /**
     * Set isDefault
     *
     * @param boolean $isDefault
     *
     * @return Scope
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = (bool)$isDefault;

        return $this;
    }

    /**
     * Add client
     *
     * @param Client $client
     *
     * @return Scope
     */
    public function addClient(Client $client)
    {
        $this->client[] = $client;

        return $this;
    }

    /**
     * Remove client
     *
     * @param Client $client
     */
    public function removeClient(Client $client)
    {
        $this->client->removeElement($client);
    }

    /**
     * Get client
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Add authorizationCode
     *
     * @param AuthorizationCode $authorizationCode
     *
     * @return Scope
     */
    public function addAuthorizationCode(AuthorizationCode $authorizationCode)
    {
        $this->authorizationCode[] = $authorizationCode;

        return $this;
    }

    /**
     * Remove authorizationCode
     *
     * @param AuthorizationCode $authorizationCode
     */
    public function removeAuthorizationCode(AuthorizationCode $authorizationCode
    ) {
        $this->authorizationCode->removeElement($authorizationCode);
    }

    /**
     * Get authorizationCode
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAuthorizationCode()
    {
        return $this->authorizationCode;
    }

    /**
     * Add refreshToken
     *
     * @param RefreshToken $refreshToken
     *
     * @return Scope
     */
    public function addRefreshToken(RefreshToken $refreshToken)
    {
        $this->refreshToken[] = $refreshToken;

        return $this;
    }

    /**
     * Remove refreshToken
     *
     * @param RefreshToken $refreshToken
     */
    public function removeRefreshToken(RefreshToken $refreshToken)
    {
        $this->refreshToken->removeElement($refreshToken);
    }

    /**
     * Get refreshToken
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * Add accessToken
     *
     * @param AccessToken $accessToken
     *
     * @return Scope
     */
    public function addAccessToken(AccessToken $accessToken)
    {
        $this->accessToken[] = $accessToken;

        return $this;
    }

    /**
     * Remove accessToken
     *
     * @param AccessToken $accessToken
     */
    public function removeAccessToken(AccessToken $accessToken)
    {
        $this->accessToken->removeElement($accessToken);
    }

    /**
     * Get accessToken
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }
}
